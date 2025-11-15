<div class="main-side d-flex flex-column">
    <x-message-admin />
    @if ($screen == 'index')
        <div class="main-title">
            <div class="small">
                @lang('admin.Home')
            </div>
            <div class="large">
                @lang('admin.Products')
            </div>
        </div>

        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="d-flex gap-2 flex-wrap ">
                <div class="btn-holder d-flex gap-2 flex-wrap">
                    @can('create_products')
                        <a href="{{ route('admin.products', ['screen' => 'create']) }}" class="main-btn">@lang('admin.Add')</a>
                    @endcan

                    <div class="inp-holder" @if (count($products) == 0) style="display:none;" @endif>
                        <select wire:model.live='filter_type' class="form-select">
                            <option value="">@lang('admin.Product')</option>
                            <option value="vendor">@lang('admin.Vendor')</option>
                            <option value="platform">@lang('admin.Platform')</option>
                        </select>
                    </div>
                    @if ($filter_type == 'vendor')
                        <div class="inp-holder">
                            <select wire:model.live='filter_vendor_id' class="form-select">
                                <option value="">@lang('admin.Choose vendor')</option>
                                @foreach ($vendors as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </div>

            <div class="d-flex align-items-center gap-2 flex-wrap">
                <div class="main-btn btn-orange px-5">@lang('admin.Purchase amounts'):
                    {{ \App\Models\Product::sum('purchase_price') }}
                </div>
                <div class="main-btn bg-danger px-5">@lang('admin.Losses') :
                    @if (\App\Models\Product::sum('purchase_price') > \App\Models\Product::sum('sell_price'))
                        {{ \App\Models\Product::sum('purchase_price') - \App\Models\Product::sum('sell_price') }}
                    @else
                        0
                    @endif
                </div>
                <div class="main-btn bg-success px-5">@lang('admin.Profits') :
                    {{ \App\Models\Product::sum('sell_price') - \App\Models\Product::sum('purchase_price') }}
                </div>
                <div class="main-btn bg-danger px-5">
                    <a class="text-white" href="{{ route('admin.products', ['quantity_filter' => 1]) }}">
                        @lang('admin.Out of stock')
                        ({{ \App\Models\Product::where('quantity', 0)->count() }})
                    </a>
                </div>
            </div>

            <div class="box-search">
                <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                <input type="search" wire:model.live="search" placeholder="@lang('admin.Search')" />
            </div>
        </div>

        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('admin.Image')</th>
                        <th>@lang('admin.Name')</th>
                        <th>@lang('admin.Product type')</th>
                        <th>@lang('admin.Main category')</th>
                        <th>@lang('admin.Sub category')</th>
                        <th>@lang('admin.Type')</th>
                        <th>@lang('admin.Status')</th>
                        <th>@lang('admin.Quantity')</th>
                        <th>@lang('admin.Sales count')</th>
                        <th>@lang('admin.Purchase price')</th>
                        <th>@lang('admin.Sell price')</th>
                        <th>@lang('admin.Views')</th>
                        <th>@lang('admin.Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if (!$product->image)
                                    <img src="{{ asset('admin-asset/img/no-image.jpeg') }}"
                                        class="img-thumbnail img-preview" width="50">
                                @else
                                    <img src="{{ display_file($product->image) }}" class="img-thumbnail img-preview"
                                        width="50">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->digital_product ? __('admin.Digital') : __('admin.Normal') }}</td>
                            <td>
                                {{ $product->category?->name ??
                                    ($product->category
                                        ? (app()->getLocale() == 'ar'
                                            ? $product->category->name_ar
                                            : $product->category->name_en)
                                        : '') }}
                            </td>
                            <td>
                                {{ $product->categoryChild?->name }}
                            </td>

                            <td>{{ $product->type?->name }}</td>
                            <td>
                                <span class="badge bg-{{ $product->active ? 'success' : 'danger' }}">
                                    {{ $product->active ? __('admin.Active') : __('admin.Inactive') }}
                                </span>
                            </td>
                            <td>
                                {{ $product->digital_product ? ($product->orders->count() ? 0 : 1) : $product->quantity }}
                            </td>
                            <td>
                                <a href="{{ route('admin.orders', ['product_id' => $product->id]) }}">
                                    <div class="main-btn btn-orange ">
                                        {{ $product->orders_count }}
                                    </div>
                                </a>
                            </td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->sell_price }}</td>
                            <td>{{ $product->views }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @can('update_products')
                                        @if ($product->status == 'pending')
                                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#accept{{ $product->id }}">
                                                @lang('admin.Accept')
                                            </button>
                                            <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal"
                                                data-bs-target="#reject{{ $product->id }}">
                                                @lang('admin.Reject')
                                            </button>
                                            @include('admin.products.accept')
                                            @include('admin.products.reject')
                                        @endif

                                        <a
                                            href="{{ route('admin.products', ['screen' => 'edit', 'id' => $product->id]) }}">
                                            <i class="fa-solid fa-pen text-info icon-table"></i>
                                        </a>
                                    @endcan

                                    @can('delete_products')
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $product->id }}">
                                            <i class="fa-solid fa-trash text-danger icon-table"></i>
                                        </button>
                                        @include('admin.products.delete-modal')
                                    @endcan

                                    <a title="@lang('admin.Product report')"
                                        href="{{ route('admin.products-report', ['product_id' => $product->id]) }}">
                                        <i class="fa-regular fa-file-lines text-warning"></i>
                                    </a>
                                    <a href="{{ route('admin.product.comments', $product->id) }}"
                                        class="btn btn-info text-nowrap btn-sm">
                                        @lang('admin.Comments')
                                        <span class="badge bg-white text-info">{{ $product->rates_count }}</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13">
                                <div class="alert alert-warning">@lang('admin.No products found.')</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $products->withQueryString()->links() }}
        </div>
    @else
        @if (auth()->user()->can('update_products') || auth()->user()->can('create_products'))
            @include('admin.products.createOrUpdate')
        @endif
    @endif
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            function select2init() {
                $(document).ready(function() {
                    $('.select2').each(function() {
                        $(this).select2();

                        $(this).on('change', function() {
                            var data = $(this).val();
                            var name = $(this).attr('id');
                            @this.set(name, data);
                        });
                    })

                });
            }

            select2init();

            document.addEventListener('refreshSelect2', () => {
                select2init();
            });
        </script>


        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            function initCKEditor() {
                const editorElement = document.querySelector('#ckeditor');
                if (editorElement) {
                    ClassicEditor
                        .create(editorElement)
                        .then(editor => {
                            editor.model.document.on('change:data', () => {
                                @this.set('description', editor.getData());
                            });
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            }

            initCKEditor();

            // document.addEventListener('livewire:load', () => {
            //     initCKEditor();
            // });

            document.addEventListener('livewire:update', () => {
                initCKEditor();
            });
        </script>
    @endpush

</div>
