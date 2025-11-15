<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use App\Models\User;
use App\Models\Client;
use App\Models\Program;
use Livewire\Component;
use App\Services\Whatsapp;
use Livewire\WithFileUploads;
use App\Exports\ClientsExport;
use App\Models\Category;
use App\Models\WhatsappMessage;
use App\Traits\livewireResource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class Categories extends Component
{
    use livewireResource, WithFileUploads;
    public $name_ar,$name_en, $status = 'possible', $notes, $search,$parent_id ,$category,$cover,$img ,$filter_category;
    public Collection $allClients;
    // public function export()
    // {
    //     return Excel::download(new ClientsExport($this->allClients), 'clients' . time() . '.xlsx');
    // }
    public function rules()
    {
        return ['name_ar' => 'required','name_en' => 'required', 'status' => 'nullable','cover' => 'nullable'];
    }
    public function changeContact(Category $category)
    {
        $category->update(['contact' => !$category->contact]);
        session()->flash('success', 'تم التعديل بنجاح');
    }
    public function beforeSubmit()
    {
        if($this->img){
            $this->data['cover']=store_file($this->img,'departments');
        }
    }
    public function mount()
    {
 

        if (request('parent_id')) {
            $this->filter_category = request('parent_id');
        }
    }
    // public function beforeSubmit()
    // {
    //     $this->data['user_id'] = auth()->id();
    // }
    public function render()
    {
        // dd($this->filter_city);
        $categories = Category::where('parent_id','=',null)->where(function ($q) {
          if ($this->search) {
            $locale = app()->getLocale();
            $q->where("name_$locale", 'LIKE', "%" . $this->search . "%")
            ->orWhere('name', 'LIKE', "%" . $this->search . "%"); // احتياطي لو الاسم الأساسي موجود
        }
            if (request('parent_id')) {
                $this->filter_category = request('parent_id');
            }
        })->latest('id')->paginate(10);
        return view('livewire.admin.categories.index', compact('categories'))->extends('admin.layouts.admin')->section('content');
    }

    public function categorytId($id)
    {
        $this->category = Category::find($id);
    }

   
}
