<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Attachment;
use App\Models\ProductType;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use App\Models\ProductCategory;
use App\Traits\livewireResource;

class Products extends Component
{
    use livewireResource;

    public $name, $image, $product_type_id, $product_approval, $category_id, $category_child_id, $quantity, $no_quantity = false, $purchase_price, $sell_price, $delivery_type, $active, $barcode, $images = [], $description, $rejected_reason, $status, $user_id, $search;
    public $filter_type, $filter_vendor_id, $delivery_service, $variants = [], $colors = [], $special_offer = false;

    // variants
    public $variant_size_id, $variant_sell_price, $variant_weight,
    $variant, $variant_purchase_price, $variant_colors = [], $variant_discount_percentage = 0;
    public $variant_key, $toggle_sizes = 0;

    public $discount_percentage = 0;

    public $digital_product, $digital_details;
    public $queryString = ['screen'];
    // public function boot()
    // {
    //     $this->listeners = [
    //         'description-updated' => 'updateDescription'
    //     ];
    // }

    public function mount()
    {
        if (request()->id && request()->screen == 'edit') {
            $this->edit(request()->id);
        }
    }
    // protected $listeners = [
    //     'description-updated' => 'updateDescription',
    //     'updateCkEditor' => 'updateCkEditor'
    // ];

    // public function updateDescription($data)
    // {
    //     $this->description = $data['content'];
    // }

    // public function updateCkEditor($content)
    // {
    //     $this->description = $content;
    // }

    public function hydrate()
    {
        $this->dispatch('refreshSelect2');
        $this->dispatch('ckeditorRefresh');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:products,name,' . $this->obj?->id,
            // 'user_id' => 'nullable',
            'product_type_id' => 'required|exists:product_types,id',
            'category_id' => 'required|exists:categories,id',
            'category_child_id' => 'nullable',
            'quantity' => 'nullable|integer',
            'no_quantity' => 'boolean',
            'purchase_price' => !$this->toggle_sizes ? 'required_if:toggle_sizes,0|numeric' : 'nullable',
            'sell_price' => !$this->toggle_sizes ? 'required|numeric|gt:purchase_price' : 'nullable',
            'variants' => $this->toggle_sizes ? 'required|min:1' : 'nullable',
            'discount_percentage' => 'nullable|between:0,100',
            //            'delivery_type' => 'required',
            'active' => 'required',
            'barcode' => 'nullable',
            'description' => 'nullable',
            'image' => $this->obj ? 'nullable' : 'required' . '|image',
            'images' => 'nullable',
            'images.*' => 'image',
            'delivery_service' => 'nullable',
            'special_offer' => 'boolean',
            'digital_product' => 'nullable',
            // 'digital_details' => 'required_if:digital_product,1',
            'digital_details' => 'nullable',

        ];
    }

    public function validationAttributes()
    {
        return [
            'name' => 'الاسم',
            'product_type_id' => 'نوع المنتج',
            'category_id' => 'القسم',
            'category_child_id' => 'القسم الفرعي',
            'quantity' => 'الكمية',
            'no_quantity' => 'الكمية',
            'purchase_price' => 'سعر الشراء',
            'sell_price' => 'سعر البيع',
            'variants' => 'المواصفات',
            'discount_percentage' => 'نسبة الخصم',
            'delivery_type' => 'نوع التوصيل',

            'variant_size_id' => 'الحجم',
            'variant_sell_price' => 'سعر البيع',
            'variant_weight' => 'الوزن',
            'variant_purchase_price' => 'سعر الشراء',
            'variant_discount_percentage' => 'نسبة الخصم',
            'variant_colors' => 'اللون',
            'image' => 'الصورة',


        ];
    }

    public function beforeSubmit()
    {
        // dd($this->special_offer);
        if ($this->discount_percentage === '' || $this->discount_percentage === null) {
            $this->data['discount_percentage'] = 0;
        }
        unset($this->data['variants']);

        $this->data['status'] = 'accepted';
        $this->data['special_offer'] = $this->special_offer ? true : false;

        if ($this->image) {
            if ($this->obj) {
                delete_file($this->obj->image);
            }
            $this->data['image'] = store_file($this->image, 'products');
        } else {
            $this->data['image'] = $this->obj->image;
        }

        unset($this->data['images']);
    }

    public function afterSubmit()
    {
        // $this->data['category_child_id'] = 1;
        if ($this->images) {
            foreach ($this->images as $file) {
                Attachment::store($file, $this->obj);
            }
        }
        $this->obj->variants()->delete();

        if ($this->variants) {
            foreach ($this->variants as $variant) {
                $color_ids = $variant['colors'];
                unset($variant['colors']);
                $item = $this->obj->variants()->create($variant);
                $item->colors()->delete();
                if (!empty($color_ids)) {
                    foreach ($color_ids as $id) {
                        $item->colors()->create([
                            'color_id' => $id
                        ]);
                    }
                }
            }
        }

        $this->obj->colors()->delete();
        if ($this->colors) {
            foreach ($this->colors as $color) {
                $this->obj->colors()->create([
                    'color_id' => $color
                ]);
            }
        }
    }

    public function whileEditing()
    {
        $this->image = '';
        $variants = $this->obj->variants()->get();
        if ($variants->isNotEmpty()) {
            $this->variants = $variants->map(function ($item) {
                $colors = ProductColor::where('variant_id', $item->id)->pluck('color_id')->toArray();
                return array_merge($item->toArray(), ['colors' => $colors]);
            });
        } else {
            $this->variants = [];
        }
        $this->colors = $this->obj->colors()->pluck('color_id')->toArray();
        $this->toggle_sizes = !empty($this->variants);
        if ($this->toggle_sizes) {
            $this->sell_price = 0;
            $this->purchase_price = 0;
            $this->colors = [];
        }
        $this->digital_product = $this->obj->digital_product;
        //dd($this->variants);
    }

    public function render()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        $childCategories = $this->category_id ? Category::active()->where('parent_id', $this->category_id)->get() : [];
        $product_types = ProductType::Active()->get();
        $vendorsIds = User::vendors()->pluck('id')->toArray();
       $products = Product::where(function ($q) use ($vendorsIds) {
        if ($this->search) {
            $q->where('name', 'LIKE', '%' . $this->search . '%');
        }
        if ($this->filter_type == 'platform') {
            $q->whereNotIn('user_id', $vendorsIds);
        } elseif ($this->filter_type == 'vendor') {
            if ($this->filter_vendor_id) {
                $q->where('user_id', $this->filter_vendor_id);
            } else {
                $q->whereIn('user_id', $vendorsIds);
            }
        }
    })
    ->when(request('user_id'), function ($q) {
        $q->where('user_id', request('user_id'));
    })
    ->when(request('quantity_filter'), function ($q) {
        $q->where('quantity', 0);
    })
    ->withCount([
        // نحسب الطلبات فقط التي ليست مرفوضة
        'orders as orders_count' => function ($query) {
            $query->where('status', '!=', 'refused');
        },
        'rates'
    ])
    ->latest()
    ->paginate(10);

        $vendors = User::vendors()->active()->latest()->pluck('name', 'id')->toArray();
        return view('livewire.admin.products', compact('products', 'parentCategories', 'childCategories', 'product_types', 'vendors'))->extends('admin.layouts.admin')->section('content');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        delete_file($product->image);
        if ($product->files) {
            foreach ($product->files as $file) {
                $file->delete();
                delete_file($file->path);
            }
        }
        $product->delete();
        session()->flash('success', 'تم الحذف بنجاح');
    }

    public function accept($id)
    {
        $product = Product::find($id);
        $product->update(['status' => 'accepted']);

        session()->flash('success', 'تم قبول المنتج بنجاح');
    }

    public function reject($id)
    {
        $this->validate([
            'rejected_reason' => 'required'
        ]);

        $product = Product::find($id);
        $product->update(['status' => 'rejected', 'rejected_reason' => $this->rejected_reason]);

        session()->flash('success', 'تم رفض المنتج بنجاح');
    }

    // variants
    public function addVariant()
    {
        $this->validate([
            'variant_size_id' => 'required',
            'variant_purchase_price' => 'required',
            'variant_sell_price' => 'required|gt:variant_purchase_price',
        ]);
        if (in_array($this->variant_size_id, collect($this->variants)->pluck('size_id')->toArray()) && !$this->variant) {
            $this->addError('variant_size_id.unique', 'المقاس مضاف بالفعل');
            return 0;
        }
        $data = [
            'sell_price' => $this->variant_sell_price,
            'weight' => $this->variant_weight,
            'size_id' => $this->variant_size_id,
            'purchase_price' => $this->variant_purchase_price,
            'colors' => $this->variant_colors,
            'discount_percentage' => $this->variant_discount_percentage ?? 0

        ];
        if ($this->variant) {
            $this->variants[$this->variant_key] = $data;
        } else {
            $this->variants[] = $data;
        }
        $this->reset('variant', 'variant_discount_percentage', 'variant_size_id', 'variant_weight', 'variant_sell_price', 'variant_purchase_price', 'variant_colors');
    }

    public function removeVariant($key)
    {
        unset($this->variants[$key]);
    }

    public function editVariant($key)
    {
        $this->variant_key = $key;
        $this->variant = $this->variants[$key];
        $this->variant_sell_price = $this->variant['sell_price'];
        $this->variant_weight = $this->variant['weight'];
        $this->variant_size_id = $this->variant['size_id'];
        $this->variant_purchase_price = $this->variant['purchase_price'];
        $this->variant_discount_percentage = $this->variant['discount_percentage'];
        $this->variant_colors = $this->variant['colors'];
    }



    public function updatedToggleSizes()
    {
        if ($this->toggle_sizes) {
            $this->reset('sell_price', 'purchase_price', 'discount_percentage', 'colors');
        } else {
            $this->reset('variants');
            $this->sell_price = $this->obj?->sell_price;
            $this->purchase_price = $this->obj?->purchase_price;
            $this->discount_percentage = $this->obj?->discount_percentage;
        }
        $this->resetValidation();
        $this->validateOnly('toggle_sizes');
    }

    public function resetInputs()
    {
        $this->reset([
            'name',
            'description',
            // 'parent_category_id',
            // 'child_category_id',
            'product_type_id',
            'quantity',
            'sell_price',
            'purchase_price',
            'discount_percentage',
            'colors',
            'toggle_sizes',
            'variants',
            'variant_size_id',
            'variant_sell_price',
            'variant_purchase_price',
            'variant_discount_percentage',
            'variant_weight',
            'variant_colors',
            'rejected_reason'

        ]);
    }
}
