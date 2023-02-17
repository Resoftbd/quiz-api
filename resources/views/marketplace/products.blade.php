@push('styles')
{{--    <link href="{{ mix('/mix/css/data-table.css')}}" rel="stylesheet"/>--}}
@endpush

@extends('layout.main')

@section('container')

<input type="hidden" name="_token" value="{{csrf_token()}}">

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Shop</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">eCommerce</a>
                            </li>
                            <li class="breadcrumb-item active">Shop
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detached content-right">
        <div class="content-body">
            <!-- E-commerce Content Section Starts -->
            <section id="ecommerce-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="ecommerce-header-items">
                            <div class="result-toggler">
                                <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                    <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                                </button>
                                <div class="search-results">16285 results found</div>
                            </div>
                            <div class="view-options d-flex">
                                <div class="btn-group dropdown-sort">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="active-sorting">Featured</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">Featured</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Lowest</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Highest</a>
                                    </div>
                                </div>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-icon btn-outline-primary view-btn grid-view-btn">
                                        <input type="radio" name="radio_options" id="radio_option1" checked />
                                        <i data-feather="grid" class="font-medium-3"></i>
                                    </label>
                                    <label class="btn btn-icon btn-outline-primary view-btn list-view-btn">
                                        <input type="radio" name="radio_options" id="radio_option2" />
                                        <i data-feather="list" class="font-medium-3"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- E-commerce Content Section Starts -->

            <!-- background Overlay when sidebar is shown  starts-->
            <div class="body-content-overlay"></div>
            <!-- background Overlay when sidebar is shown  ends-->

            <!-- E-commerce Search Bar Starts -->
            <section id="ecommerce-searchbar" class="ecommerce-searchbar">
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control search-product" id="shop-search" placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search" />
                            <div class="input-group-append">
                                <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- E-commerce Search Bar Ends -->

            <!-- E-commerce Products Starts -->
            <section id="ecommerce-products" class="grid-view">
                @if($totalPages >0)
                    @foreach($products as $key => $product)
                        <div class="card ecommerce-card">
                            <div class="item-img text-center">
                                <a href="app-ecommerce-details.html">
                                    <img class="img-fluid card-img-top" src="" alt="img-placeholder" /></a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        </ul>
                                    </div>
                                    <div class="item-cost">
                                        <h6 class="item-price">${{$product->price}}</h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="app-ecommerce-details.html">{{$product->name}}</a>
                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">OneOdio</a></span>
                                </h6>
                                <p class="card-text item-description">
                                    {{$product->description}}
                                </p>
                            </div>
                            <div class="item-options text-center">
                                <div class="item-wrapper">
                                    <div class="item-cost">
                                        <h4 class="item-price">${{$product->price}}</h4>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                    <i data-feather="heart"></i>
                                    <span>Wishlist</span>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                    <i data-feather="shopping-cart"></i>
                                    <span class="add-to-cart">Subscribe</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>
            <!-- E-commerce Products Ends -->

            <!-- E-commerce Pagination Starts -->
            <section id="ecommerce-pagination">
                <div class="row">
                    <div class="col-sm-12">
                        <nav aria-label="Page navigation example">
                            @if($totalPages >0)
                                <ul class="pagination justify-content-center mt-2">
                                    <li class="page-item prev-item"><a class="page-link" href="javascript:void(0);"></a></li>
                                     @for($i=1;$i<=$totalPages;$i++)
                                        @php($active='')
                                        @if($i==1)
                                            @php($active='active')
                                        @endif
                                        <li class="page-item {{$active}}"><a class="page-link" href="javascript:void(0);">{{$i}}</a></li>
                                     @endfor
                                    <li class="page-item next-item" id="next"><a class="page-link" href="javascript:void(0);"></a></li>
                                </ul>
                            @endif
                        </nav>
                    </div>
                </div>
            </section>
            <!-- E-commerce Pagination Ends -->

        </div>
    </div>
    <div class="sidebar-detached sidebar-left">
        <div class="sidebar">
            <!-- Ecommerce Sidebar Starts -->
            <div class="sidebar-shop">
                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Price Filter starts -->
                        <div class="multi-range-price">
                            <h6 class="filter-title mt-0">Multi Range</h6>
                            <ul class="list-unstyled price-range" id="price-range">
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="priceAll" name="price-range" class="custom-control-input" checked />
                                        <label class="custom-control-label" for="priceAll">All</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="priceRange1" name="price-range" class="custom-control-input" />
                                        <label class="custom-control-label" for="priceRange1">&lt;=$10</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="priceRange2" name="price-range" class="custom-control-input" />
                                        <label class="custom-control-label" for="priceRange2">$10 - $100</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="priceARange3" name="price-range" class="custom-control-input" />
                                        <label class="custom-control-label" for="priceARange3">$100 - $500</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="priceRange4" name="price-range" class="custom-control-input" />
                                        <label class="custom-control-label" for="priceRange4">&gt;= $500</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Price Filter ends -->

                        <!-- Price Slider starts -->
                        <div class="price-slider">
                            <h6 class="filter-title">Price Range</h6>
                            <div class="price-slider">
                                <div class="range-slider mt-2" id="price-slider"></div>
                            </div>
                        </div>
                        <!-- Price Range ends -->

                        <!-- Categories Starts -->
                        <div id="product-categories">
                            <h6 class="filter-title">Categories</h6>
                            <ul class="list-unstyled categories-list">
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category1" name="category-filter" class="custom-control-input" checked />
                                        <label class="custom-control-label" for="category1">Appliances</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category2" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category2">Audio</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category3" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category3">Cameras & Camcorders</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category4" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category4">Car Electronics & GPS</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category5" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category5">Cell Phones</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category6" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category6">Computers & Tablets</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category7" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category7">Health, Fitness & Beauty</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category8" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category8">Office & School Supplies</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category9" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category9">TV & Home Theater</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="category10" name="category-filter" class="custom-control-input" />
                                        <label class="custom-control-label" for="category10">Video Games</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Categories Ends -->

                        <!-- Brands starts -->
                        <div class="brands">
                            <h6 class="filter-title">Brands</h6>
                            <ul class="list-unstyled brand-list">
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand1" />
                                        <label class="custom-control-label" for="productBrand1">Insignia™</label>
                                    </div>
                                    <span>746</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand2" checked />
                                        <label class="custom-control-label" for="productBrand2">Samsung</label>
                                    </div>
                                    <span>633</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand3" />
                                        <label class="custom-control-label" for="productBrand3">Metra</label>
                                    </div>
                                    <span>591</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand4" />
                                        <label class="custom-control-label" for="productBrand4">HP</label>
                                    </div>
                                    <span>530</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand5" checked />
                                        <label class="custom-control-label" for="productBrand5">Apple</label>
                                    </div>
                                    <span>442</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand6" />
                                        <label class="custom-control-label" for="productBrand6">GE</label>
                                    </div>
                                    <span>394</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand7" />
                                        <label class="custom-control-label" for="productBrand7">Sony</label>
                                    </div>
                                    <span>350</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand8" />
                                        <label class="custom-control-label" for="productBrand8">Incipio</label>
                                    </div>
                                    <span>320</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand9" />
                                        <label class="custom-control-label" for="productBrand9">KitchenAid</label>
                                    </div>
                                    <span>318</span>
                                </li>
                                <li>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="productBrand10" />
                                        <label class="custom-control-label" for="productBrand10">Whirlpool</label>
                                    </div>
                                    <span>298</span>
                                </li>
                            </ul>
                        </div>
                        <!-- Brand ends -->

                        <!-- Rating starts -->
                        <div id="ratings">
                            <h6 class="filter-title">Ratings</h6>
                            <div class="ratings-list">
                                <a href="javascript:void(0)">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li>& up</li>
                                    </ul>
                                </a>
                                <div class="stars-received">160</div>
                            </div>
                            <div class="ratings-list">
                                <a href="javascript:void(0)">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li>& up</li>
                                    </ul>
                                </a>
                                <div class="stars-received">176</div>
                            </div>
                            <div class="ratings-list">
                                <a href="javascript:void(0)">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li>& up</li>
                                    </ul>
                                </a>
                                <div class="stars-received">291</div>
                            </div>
                            <div class="ratings-list">
                                <a href="javascript:void(0)">
                                    <ul class="unstyled-list list-inline">
                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                        <li>& up</li>
                                    </ul>
                                </a>
                                <div class="stars-received">190</div>
                            </div>
                        </div>
                        <!-- Rating ends -->

                        <!-- Clear Filters Starts -->
                        <div id="clear-filters">
                            <button type="button" class="btn btn-block btn-primary">Clear All Filters</button>
                        </div>
                        <!-- Clear Filters Ends -->
                    </div>
                </div>
            </div>
            <!-- Ecommerce Sidebar Ends -->

        </div>
    </div>
</div>

@endsection

@push('scripts')

    <script>
        $("#next").click(function() {
            alert("clicked");
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "https://api.triggerup.net/api/v1/public/product/list/",
                // data: {
                //     id: $(this).val(), // < note use of 'this' here
                //     access_token: $("#access_token").val()
                // },
                success: function(result) {
                    console.log(result);
                    alert('ok');
                },
                error: function(result) {
                    alert('error');
                }
            });
        });
    </script>
    <script src="{{ mix('/mix/js/marketplace.js') }}"></script>

@endpush
