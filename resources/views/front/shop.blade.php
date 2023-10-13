@extends('front.layouts.base')
@section('content')
    <!-- page-title-wrapper-start -->
    <div class="page-title-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-title">
                        <h3>@lang('front.shop')</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-title-wrapper-end -->
    <!-- bedroom-all-product-area-start -->
    <div class="bedroom-all-product-area ptb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="bedroom-sideber">
                        <div class="bedroom-title text-uppercase">
                            <h4>@lang('front.shopping_options')</h4>
                        </div>
                    </div>
                    <!-- price-slider-area-start -->
                    <form action="{{ route('home.shop') }}" method="GET">
                        <div class="price-slider-area">
                            <h3 class="bedroom-side-title">@lang('front.price')</h3>
                            <div id="slider-range"></div>
                            <p>
                                <input type="text" id="amount" readonly
                                    style="border:0; color:#f6931f; font-weight:bold;">
                            </p>
                            <button style="margin-top:-110px; margin-left: 200px;" id="filter-button" type="button"
                                onclick="applyFilters()" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                    <!-- price-slider-area-end -->
                    <!-- Category-start -->
                    <div class="category-area-start">
                        <div class="caregory">
                            <h3 class="bedroom-side-title">@lang('front.category')</h3>
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <div class="checkbox">
                                            <label>

                                                <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                    {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                                <span>{{ $category->name }}</span>
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <!-- category-products-area-start -->
                    <div class="caregory-products-area">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                <ul class="tab_menu">
                                    <li class="active"><a href="#viewed" data-toggle="tab"><i class="fa fa-th"></i></a></li>
                                    <!--<li><a href="#random " data-toggle="tab"><i class="fa fa-list"></i></a></li>-->
                                </ul>
                            </div>
                            <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                                <div class="product-option">
                                    <div class="porduct-option-left floatleft">
                                        <span> Items 1-16 of 17</span>
                                    </div>
                                    <!-- product-option-right start -->
                                    <div class="product-option-right floatright">
                                        <div class="sort-by">
                                            <label>Sort By:</label>
                                            <select id="sort-by" class="cust-select">
                                                <option value="position" selected="selected">Position</option>
                                                <option value="name_asc">Name (A-Z)</option>
                                                <option value="name_desc">Name (Z-A)</option>
                                                <option value="price_asc">Price (Low to High)</option>
                                                <option value="price_desc">Price (High to Low)</option>
                                            </select>
                                        </div>
                                        <div class="sort-by">
                                            <label>Show:</label>
                                            <select id="show-per-page" class="cust-select cust-select-2">
                                                <option value="20" selected="selected">20</option>
                                                <option value="40">40</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- product-option-right end -->

                                </div>
                            </div>
                        </div>
                    @if (count($newProducts) > 0)
                        <div class="tab-content">
                            <div class="tab-pane active" id="viewed">
                                <div class="row">
                                    @php $itemCount = 0; @endphp
                                    @foreach ($newProducts as $prd)
                                        @if ($itemCount % 4 === 0)
                                            </div><div class="row">
                                        @endif
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                            <div class="single-new-product mt-40 category-new-product">
                                                <div class="product-img">
                                                    <a href="{!! route('home.productdetails', $prd->id) !!}">
                                                        <div class="image-container" style="width: 200px; height: 240px; position: relative;">
                                                            @if (isset($prd) && $prd->hasMedia('image'))
                                                                <img src="{!! url($prd->getFirstMediaUrl('image')) !!}" alt="" style="width: 100%; height: 100%;">
                                                            @else
                                                                <div style="background-color: #ccc; width: 100%; height: 100%;"></div>
                                                            @endif
                                                            <div class="new-product-action" style="position: absolute; bottom: 10px; right: 10px;">
                                                                <a href="javascript:void(0)" onclick="addToCart({{ $prd->id }})">
                                                                    <span class="lnr lnr-cart cart_pad"></span>Add to Cart
                                                                </a>
                                                                <a href="javascript:void(0)" onclick="addToWishList({{ $prd->id }})">
                                                                    <span class="lnr lnr-heart"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="product-content text-center">
                                                    <a href="{!! route('home.productdetails', $prd->id) !!}">
                                                        <h3>{{ $prd->name }}</h3>
                                                    </a>
                                                    <div class="product-price-star">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="price">
                                                        <h4>{!! getPriceColumn($prd, 'offer_price') !!}</h4>
                                                        <h3 class="del-price"><del>{!! getPriceColumn($prd) !!}</del></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $itemCount++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        <br>
                        <br>
                        <br>
                        <br>
                            <div class="col-12 text-center mt-8">
                                <p class="alert alert-info " style="font-size: 30px; color: #999; margin-top: 20px; padding: 10px; background-color: #f5f5f5; border-radius: 5px;">No Products Available.</p>
                            </div>
                        @endif
                    </div>
                    <!-- pagination-area-start -->
                    <div class="pagination-area mt-40 pt-40">
                        <div class="pagination-text">
                            <p>@lang('', ['start' => $newProducts->firstItem(), 'end' => $newProducts->lastItem(), 'total' => $newProducts->total()])</p>
                        </div>
                        <div class="bedroom-pagination">
                            {{ $newProducts->appends(request()->query())->links() }}
                        </div>
                    </div>
                    <!-- pagination-area-end -->
                </div>
            </div>
        </div>
    </div>
    <div id="snackbar">@lang('front.added_item_to_wishlist')</div>
    <div id="snackbarCart">@lang('front.added_item_to_cart')</div>
    <div id="mustlogin">@lang('front.please_login_to_add_to_cart')</div>
    <!-- bedroom-all-product-area-end -->
@endsection
@section('js_custom')
    <script>
        function addToWishList(id) {
            $.post('{{ route('home.storewishlist') }}', {
                _token: '{{ csrf_token() }}',
                id: id
            })
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }

        // function addToCart(id) {
        //     @if (Auth::check())
        //         $.post('{{ route('home.storecart') }}', {
        //             _token: '{{ csrf_token() }}',
        //             id: id
        //         }, function(results) {
        //             dynamicCart(results);
        //         });
        //         var x = document.getElementById("snackbarCart");
        //         x.className = "show";
        //         setTimeout(function() {
        //             x.className = x.className.replace("show", "");
        //         }, 3000);
        //     @else
        //         var x = document.getElementById("mustlogin");
        //         x.className = "show";
        //         setTimeout(function() {
        //             x.className = x.className.replace("show", "");
        //         }, 3000);
        //     @endif
        // }


        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var sortBy = urlParams.get('sort_by');
            var showPerPage = urlParams.get('show_per_page');

            // Set the initial values of the sort by and show per page selectors
            if (sortBy) {
                $('#sort-by').val(sortBy);
            }

            if (showPerPage) {
                $('#show-per-page').val(showPerPage);
            }

            // Event handler for sort by change
            $('#sort-by').on('change', function() {
                var sortByValue = $(this).val();
                updateUrlParams('sort_by', sortByValue);
            });

            // Event handler for show per page change
            $('#show-per-page').on('change', function() {
                var showPerPageValue = $(this).val();
                updateUrlParams('show_per_page', showPerPageValue);
            });

            // Function to update the URL parameters and reload the page
            function updateUrlParams(param, value) {
                urlParams.set(param, value);
                var newUrl = window.location.pathname + '?' + urlParams.toString();
                window.location.href = newUrl;
            }
        });

        $(document).ready(function() {
            paginationsUrlFormating();
            var urlParams = new URLSearchParams(window.location.search);
            var selectedCategories = urlParams.getAll('category[]');

            // Set the initial values of the category checkboxes
            $('input[name="category[]"]').each(function() {
                if ($.inArray($(this).val(), selectedCategories) !== -1) {
                    $(this).prop('checked', true);
                }
            });

            // Event handler for category change
            $('input[name="category[]"]').on('change', function() {
                var selectedCategoryValues = $('input[name="category[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                updateUrlParams('category[]', selectedCategoryValues);
            });

            function replaceInnerNumbers(inputString) {
                const regex = /\[(\d+)\]/g;
                const replacedString = inputString.replace(regex, (_, number) => {
                    return `[]`;
                });
                return replacedString;
            }

            function paginationsUrlFormating() {
                let links = document.querySelectorAll(".page-link");
                for (let i = 0; i < links.length; i++) {
                    let elm = links[i];
                    if (elm.hasAttribute("href")) {
                        let url = elm.getAttribute("href");
                        url = decodeURIComponent(url);
                        newUrl = replaceInnerNumbers(url);
                        elm.setAttribute("href", newUrl);
                    }
                }
            }

            // Function to update the URL parameters and reload the page
            function updateUrlParams(param, values) {
                var newUrl = window.location.pathname;
                var newbaseUrl = window.location.href;
                urlParams.delete(param, values);
                if (values.length > 0) {
                    values.forEach(function(value) {
                        urlParams.append(param, value);
                    });
                }
                if (urlParams.toString() != "") {
                    newUrl = window.location.pathname + '?' + urlParams.toString();
                }
                window.location.href = newUrl;
            }
        });
    </script>
@endsection