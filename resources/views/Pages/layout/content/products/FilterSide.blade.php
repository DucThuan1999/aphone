<?php 
    $queryCategories = request()->input('categories');
    $querySuppliers = request()->input('suppliers');
    $queryScreenSize = request()->input('screen-size');
    $queryColors = request()->input('colors');
    $queryRam = request()->input('ram');
    $queryMemory = request()->input('memory');
    $queryBattery = request()->input('battery');
    $queryOs = request()->input('os');
    $queryPriceFrom = request()->input('price_from');
    $queryPriceTo = request()->input('price_to');
?>
<div class="col-lg-3 order-2 order-lg-1">
    <!--sidebar-categores-box start  -->
    <div class="sidebar-categores-box">
        <div class="sidebar-title">
            <h2>Lọc theo</h2>
        </div>
        <!-- btn-clear-all start -->
        <button id="eliminate-filter" class="btn-clear-all mb-sm-30 mb-xs-30">Xoá hết bộ lọc</button>
        <!-- btn-clear-all end -->
        <form id='form-filter'>
            <!-- filter-sub-area start -->
            <div class="filter-sub-area">
                <h5 class="filter-sub-titel">Danh mục</h5>
                <div class="categori-checkbox">
                    {{-- <form action="#"> --}}
                    <ul>
                        @foreach ($categories as $category)
                        <li><input type="radio" <?php echo $queryCategories == $category->id ? "checked" : "" ?>
                                value="{{$category->id}}" name="categories"><a
                                href="{{route('products.index',['categories'=> $category->id])}}">{{$category->name}}
                                ({{count($category->product)}})</a>
                        </li>
                        @endforeach
                    </ul>
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <!-- filter-sub-area start -->
            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                <h5 class="filter-sub-titel">Hãng sản xuất</h5>
                <div class="categori-checkbox">
                    {{-- <form action="#"> --}}
                    <ul>
                        @foreach($suppliers as $supplier)
                        <li><input type="radio" <?php echo $querySuppliers == $supplier->id ? "checked" : "" ?>
                                value="{{$supplier->id}}" name="suppliers"><a
                                href="/products?suppliers={{$supplier->id}}">{{$supplier->name}}
                                ({{count($supplier->product)}})</a></li>
                        @endforeach

                    </ul>
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <div class="filter-sub-area">
                <h5 class="filter-sub-titel">Giá</h5>
                <div class="range-slider">
                    <input type="text" class="js-range-slider" value="" />
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-6"><input name="price-from" type="text" class="js-input-from"
                                style="background-color: #DDDDDD" />
                        </div>
                        <div class="col-6"><input name="price-to" type="text" class="js-input-to "
                                style="background-color: #DDDDDD" /></div>
                    </div>
                </div>
            </div>
            <!-- filter-sub-area start -->
            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                <h5 class="filter-sub-titel">Kích thước màn hình</h5>
                <div class="size-checkbox">
                    <select name="screen-size" style="background-color: #dddddd ">
                        <option selected disabled> Vui lòng chọn kích thước</option>
                        <option <?php echo $queryScreenSize == "1" ? "selected" : "" ?> value="1">
                            < 5 inches</option> <option <?php echo $queryScreenSize == "2" ? "selected" : "" ?>
                                value="2">Từ 5 đến 5.5 inches
                        </option>
                        <option <?php echo $queryScreenSize == "3" ? "selected" : "" ?> value="3">Từ 5.5 đến 6 inches
                        </option>
                        <option <?php echo $queryScreenSize == "4" ? "selected" : "" ?> value="4">>= 6 inches</option>
                    </select>
                    {{-- <form action="#"> --}}
                    {{-- <ul> --}}
                    {{-- <li><input type="radio" name="screen-size"><a href="#">S (3)</a></li> --}}
                    {{-- </ul> --}}
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <!-- filter-sub-area start -->
            <div class="filter-sub-area pt-sm-10 pt-xs-10">
                <h5 class="filter-sub-titel">Màu sắc</h5>
                <div class="categori-checkbox">
                    {{-- <form action="#"> --}}
                    {{-- <ul> --}}
                    <select name="colors" style="background-color: #dddddd ">
                        <option selected disabled>Vui lòng chọn màu</option>
                        @foreach($colors as $color)
                        <option <?php echo $queryColors == $color->id ? "selected" : "" ?> value="{{$color->id}}">
                            {{$color->name}}</option>
                        @endforeach
                    </select>

                    {{-- <li><input type="radio" name="color">
                            <a href="#">{{$color->name}}</a>
                    </li> --}}


                    {{-- <li><input class="black" type="radio" name="color"><a href="#">Black (1)</a></li>
                        <li><input class="orange" type="radio" name="color"><a href="#">Orange (3) </a>
                        </li>
                        <li><input class="blue" type="radio" name="color"><a href="#">Blue (2) </a></li> --}}
                    {{-- </ul> --}}
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <!-- filter-sub-area start -->
            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                <h5 class="filter-sub-titel">Ram</h5>
                <div class="categori-checkbox">
                    {{-- <form action="#"> --}}
                    <select name="ram" style="background-color: #dddddd ">
                        <option selected disabled>Vui lòng chọn dung lượng</option>
                        <option <?php echo $queryRam == "2" ? "selected" : "" ?> value="2">2 GB</option>
                        <option <?php echo $queryRam == "3" ? "selected" : "" ?> value="3">3 GB</option>
                        <option <?php echo $queryRam == "4" ? "selected" : "" ?> value="4">4 GB</option>
                        <option <?php echo $queryRam == "6" ? "selected" : "" ?> value="6">6 GB</option>
                        <option <?php echo $queryRam == "8" ? "selected" : "" ?> value="8">8 GB</option>
                        <option <?php echo $queryRam == "12" ? "selected" : "" ?> value="12">12 GB</option>
                        <option <?php echo $queryRam == "16" ? "selected" : "" ?> value="16">16 GB</option>
                        <option <?php echo $queryRam == "32" ? "selected" : "" ?> value="32">32 GB</option>
                        <option <?php echo $queryRam == "64" ? "selected" : "" ?> value="64">64 GB</option>
                    </select>
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <!-- filter-sub-area start -->
            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                <h5 class="filter-sub-titel">Bộ nhớ trong</h5>
                <div class="categori-checkbox">
                    {{-- <form action="#"> --}}
                    <select name="memory" style="background-color: #dddddd ">
                        <option selected disabled>Vui lòng chọn dung lượng</option>
                        <option <?php echo $queryMemory == "64" ? "selected" : "" ?> value="64">64 GB</option>
                        <option <?php echo $queryMemory == "128" ? "selected" : "" ?> value="128">128 GB</option>
                        <option <?php echo $queryMemory == "256" ? "selected" : "" ?> value="256">256 GB</option>
                        <option <?php echo $queryMemory == "512" ? "selected" : "" ?> value="512">512 GB</option>
                    </select>
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <!-- filter-sub-area start -->
            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                <h5 class="filter-sub-titel">Dung lượng pin</h5>
                <div class="categori-checkbox">
                    {{-- <form action="#"> --}}
                    <select name="battery" style="background-color: #dddddd ">
                        <option selected disabled>Vui lòng chọn dung lượng</option>
                        <option <?php echo $queryBattery == "1" ? "selected" : "" ?> value='1'>
                            < 2000 mAh</option> <option <?php echo $queryBattery == "2" ? "selected" : "" ?> value="2">
                                2000-3000 mAh
                        </option>
                        <option <?php echo $queryBattery == "3" ? "selected" : "" ?> value="3">3000-4000 mAh</option>
                        <option <?php echo $queryBattery == "4" ? "selected" : "" ?> value="4">> 4000 mAh</option>
                    </select>
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <!-- filter-sub-area start -->
            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                <h5 class="filter-sub-titel">Hệ điều hành</h5>
                <div class="categori-checkbox">
                    {{-- <form action="#"> --}}
                    <select name="os" style="background-color: #dddddd ">
                        <option selected disabled>Vui lòng chọn hệ điều hành</option>
                        <option <?php echo $queryOs == "Android" ? "selected" : "" ?> value="Android">Android</option>
                        <option <?php echo $queryOs == "IOS" ? "selected" : "" ?> value="IOS">iOS</option>
                        <option <?php echo $queryOs == "iPadOS" ? "selected" : "" ?> value="iPadOS">iPadOS</option>
                    </select>
                    {{-- </form> --}}
                </div>
            </div>
            <!-- filter-sub-area end -->
            <br>
            <div class="filter-sub-area pt-sm-10 pb-sm-15 pb-xs-15">
                <button id="button-filter" type="button" class="btn"
                    style="background-color: #293a6c;color: white;width:100%">Tìm</button>
            </div>
        </form>
    </div>
    <!--sidebar-categores-box end  -->
</div>