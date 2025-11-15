@extends('front.layouts.front')
@section('title', ' المنتجات')

@section('content')
    <script src="{{ asset('front-asset/js/vue.js') }}"></script>

    <!-- Start Section -->
    <div id="app" class="main-section">
        <div class="container-xxl">
            <div class="row" v-cloak>
                <div class="col-12 col-lg-4 col-xl-3">
                    <div class="box-product filters" :class="{ 'show': sliderFilter }">
                        <div class="d-flex d-lg-none align-items-center justify-content-between mb-3">
                            <h1 class="mb-0 fs-4">
                                {{ __('Filter') }}
                            </h1>
                            <button type="button" class="btn-close" @click="toggleActive('sliderFilter')"></button>
                        </div>
                        <div class="form-holder">
                            <label class="fw-bold mb-1">
                                {{ __('Category') }}
                            </label>
                            <div v-for="item in categories.slice(0, categoryDisplayCount)" :key="item.id"
                                class="d-flex align-items-center justify-content-between gap-2 mb-2">
                                <div class="d-flex align-items-center gap-1">
                                    <input class="" v-model="categoryFilter" type="checkbox" :value="item"
                                        :id="`item${item.id}`">
                                    <label class="" :for="`item${item.id}`">
                                        @{{ item.name }}
                                    </label>
                                </div>
                                <small class="float-end text-body-secondary">(@{{ item.products_count }})</small>
                            </div>
                            <div v-if="categories.length >= categoryDisplayCount">
                                <a v-if="categoryDisplayCount === categories.length" href=""
                                    @click.prevent="showLess('categoryDisplayCount')" class="show-more">
                                    {{ __('Show less') }}
                                </a>
                                <a v-else href="" @click.prevent="showMore('categoryDisplayCount','categories')"
                                    class="show-more">
                                    {{ __('Show more') }}
                                </a>
                            </div>
                        </div>
                        <div class="form-holder">
                            <label class="fw-bold mb-1">
                                {{ __('Price') }}
                            </label>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" min="1" v-model="minFilter" placeholder="{{ __('From') }}"
                                    class="form-control">
                                <input type="number" min="1" v-model="maxFilter" placeholder="{{ __('To') }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="d-none justify-content-center d-lg-flex">
                            <button @click="resetFilter()" class="main-btn mt-3">
                                {{ __('Reset filters') }}
                            </button>
                        </div>
                        <div class="d-flex d-lg-none flex-column gap-2 mt-3">
                            <button @click="resetFilter()" class="main-btn w-100 white">
                                {{ __('Reset filters') }}
                            </button>
                            <button @click="toggleActive('sliderFilter')" class="main-btn w-100">
                                {{ __('Show') }}
                                @{{ totalProducts }}
                                {{ __('product') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 col-xl-9">
                    <button @click="toggleActive('sliderFilter')" class="btn-filter d-flex d-lg-none mb-3">
                        <i class="fa-solid fa-sliders"></i>
                        {{ __('Filter') }}
                    </button>
                    <div class="box-product p-0 bg-transparent ms-lg-4">
                        <h6 class="main-heading">
                            {{ __('Products') }}:
                        </h6>

                        <div class="row g-2 g-lg-4 row-cols-1 row-cols-md-3  row-cols-lg-3 row-cols-xl-3">
                            <div class="col" v-for="(product,index) in products" :key="product.id">
                                <div class="product-card">
                                    <!-- Badge Container -->
                                    <div class="badge-container">
                                        <span v-if="product.discount_percentage"
                                            class="badge badge-discount">@{{ product.discount_percentage }}% خصم</span>
                                        <span v-if="product.quantity <= 0"
                                            class="badge badge-stock">{{ __('Out of Stock') }}</span>
                                        <span v-if="product.is_new" class="badge badge-new">{{ __('New') }}</span>
                                    </div>

                                    <!-- Product Image with Link -->
                                    <a :href="`{{ route('products.show', '') }}/${product.id}`"
                                        class="product-image-container">
                                        <img :src="product.image ? product.image :
                                            '{{ asset('front-asset/img/image-preview.webp') }}'"
                                            class="product-image" :alt="product.name">
                                    </a>

                                    <!-- Product Details -->
                                    <div class="product-details">
                                        <!-- Category -->
                                        <div class="product-category">
                                            <i class="fas fa-tag"></i>
                                            {{-- @{{ product.category ? product.category.name : __('Uncategorized') }} --}}
                                            @{{ product.category ? product.category : __('Uncategorized') }}
                                        </div>

                                        <!-- Product Title -->
                                        <a :href="`{{ route('products.show', '') }}/${product.id}`" class="product-title">
                                            <h3>@{{ product.name }}</h3>
                                        </a>

                                        <!-- Product Description -->
                                        <div class="product-description">
                                            @{{ stripHtml(product.description).substring(0, 40) }}...
                                        </div>

                                        <!-- Price Section -->
                                        <div class="product-price">
                                            <template v-if="product.price_before_discount">
                                                <span class="original-price">@{{ product.price_before_discount }}
                                                    {{ setting('currency') }}</span>
                                                <span class="discounted-price">@{{ product.price }}
                                                    {{ setting('currency') }}</span>
                                            </template>
                                            <template v-else>
                                                <span class="regular-price">@{{ product.price }}
                                                    {{ setting('currency') }}</span>
                                            </template>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="product-actions">
                                            <button v-if="product.quantity > 1" class="btn-whats-new"
                                                @click="addCart(product.id)">
                                                <i class="fas fa-cart-plus"></i> أضف للسلة
                                            </button>
                                            @if (setting('is_active_pre_order') && setting('pre_order_days'))
                                                <button v-if="product.quantity < 1" class="btn-whats-new"
                                                    @click="addCart(product.id, true)">
                                                    <i class="fas fa-cart-plus"></i> حجز مسبق
                                                </button>
                                            @endif
                                            <a :href="`{{ route('products.show', '') }}/${product.id}`"
                                                class="btn-details">{{ __('Details') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="loading && !allProductsLoaded"
                            class="spinner-border text-main-color mt-3 mx-auto d-block" role="status">
                            <span class="visually-hidden">{{ __('Loading...') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Section -->
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    token: {
                        '_token': '{{ csrf_token() }}'
                    },
                    products: [],
                    totalProducts: 0,
                    allProductsLoaded: false,
                    categories: [],
                    categoryFilter: [],
                    categoryDisplayCount: 10,
                    minFilter: "",
                    maxFilter: "",
                    loading: false,
                    page: 1,
                    limit: 5,
                    sliderFilter: false,
                }
            },
            watch: {
                categoryFilter: function(newVal, oldVal) {
                    this.filterNow();
                },
                maxFilter: function(newVal, oldVal) {
                    this.filterNow();
                },
                minFilter: function(newVal, oldVal) {
                    this.filterNow();
                },
            },
            methods: {
                checkScroll() {
                    const nearBottom = window.innerHeight + window.scrollY >= document.body.offsetHeight - 500;
                    if (nearBottom && !this.loading) {
                        this.loadMore();
                    }
                },
                stripHtml(html) {
                    const tempDiv = document.createElement("div");
                    tempDiv.innerHTML = html;
                    return tempDiv.textContent || tempDiv.innerText || "";
                },
                async loadMore(reload) {
                    this.loading = true;
                    let url =
                        `/api/products?page=${this.page}&limit=${this.limit}`;
                    if (this.minFilter !== undefined && this.minFilter !== null) {
                        url += `&price_min=${this.minFilter}`;
                    }
                    if (this.maxFilter !== undefined && this.maxFilter !== null) {
                        url += `&price_max=${this.maxFilter}`;
                    }
                    if (this.categoryFilter !== undefined && this.categoryFilter !== null && Array.isArray(this
                            .categoryFilter)) {
                        this.categoryFilter.forEach((category, index) => {
                            url += `&category_id[${index}]=${category.id}`;
                        });
                    }

                    const response = await fetch(url);
                    const newProducts = await response.json();
                    if (reload) {
                        this.products = [...newProducts.data];
                    } else {
                        this.products.push(...newProducts.data);
                    }
                    this.totalProducts = newProducts.meta.total;
                    this.page += 1;
                    this.loading = false;
                    if (newProducts.meta.total <= this.products.length) {
                        this.allProductsLoaded = true;
                    }
                },
                async cart_count(id) {
                    // Animation
                    const cartSpan = document.querySelector(".btn-cart .icon-holder .count");
                    const rect = cartSpan.getBoundingClientRect();
                    const imgCart = document.querySelector(`.box-product-land-${id} .img-cart`);
                    const imgCartRect = imgCart.getBoundingClientRect();
                    imgCart.style.transform =
                        `translate(${rect.left - imgCartRect.left}px, ${rect.top - imgCartRect.top}px)`;
                    imgCart.style.transition = "1s ease-out";
                    imgCart.style.width = "20px";
                    imgCart.style.height = "20px";
                    imgCart.style.opacity = "0.5";
                    setTimeout(() => {
                        imgCart.style.transition = "0s";
                        imgCart.style.transform = `translate(0, 0)`;
                        imgCart.style.width = "calc(100% - 40px)";
                        imgCart.style.height = "250px";
                        imgCart.style.opacity = "1";
                    }, 1000);
                    // Add Count
                    let url = `/api/cart_count`;
                    const response = await fetch(url)
                    const data = await response.json()
                    if (cartSpan) {
                        cartSpan.textContent = data.cart_count;
                    }
                },

                async addCart(id, pre_order) {
                    let url = `/api/products/addToCart/${id}`;
                    if (pre_order) {
                        url += `?pre_order=${pre_order}`;
                    }
                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },

                            body: JSON.stringify(this.token)
                        });
                        const responseData = await response.json();
                        // Add Number Cart
                        // Use Swal
                        Swal.fire({
                            position: 'bottom',
                            toast: true,
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: "success",
                            title: responseData.message,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        await this.cart_count(id);

                    } catch (error) {
                        console.error('Error:', error);
                    }
                },
                async addToFavourite(id) {
                    let url = `/api/products/addToFavourite/${id}`;
                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        });
                        const responseData = await response.json();
                        Swal.fire({
                            position: 'bottom',
                            toast: true,
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 3000,
                            timerProgressBar: true,
                            icon: responseData.status === true ? "success" : "error",
                            title: responseData.msg,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        this.products.find((item) => {
                            if (item.id === id && responseData.status === true) {
                                item.is_my_favourite = !item.is_my_favourite;
                            }
                        })

                    } catch (error) {
                        console.error('Error:', error);
                    }
                },
                async fetchFilters() {
                    const response = await fetch(
                        `/api/filters`);
                    const data = await response.json();
                    this.categories = data.categories
                },
                filterNow() {
                    this.products = [];
                    this.page = 1;
                    this.loadMore(true);
                },
                resetFilter() {
                    this.categoryFilter = [];
                    this.minFilter = "";
                    this.maxFilter = "";
                },
                showMore(displayCount, arry) {
                    this[displayCount] = this[arry].length; // display all items
                },
                showLess(displayCount) {
                    this[displayCount] = 5; // display only 5 items
                },
                toggleActive(ele) {
                    this[ele] = !this[ele];
                },
            },
            async mounted() {
                await this.fetchFilters();
                // Get Params category_id
                const urlParams = new URLSearchParams(window.location.search);
                const categoryId = urlParams.get('category_id');
                if (categoryId) {
                    const category = this.categories.filter(cat => cat.parent_id == categoryId);
                    if (category) {
                        this.categoryFilter = (category);
                        this.loadMore(true)
                    } else {
                        this.loadMore();
                    }
                } else {
                    this.loadMore();
                }
                window.addEventListener('scroll', this.checkScroll);
            },
            unmounted() {
                window.removeEventListener('scroll', this.checkScroll);
            },
        }).mount('#app')
    </script>
@endsection
