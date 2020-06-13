<?php 
    $querySort = request()->input('sort');
?>
<!-- shop-top-bar start -->
<div class="shop-top-bar mt-30">
    <div class="shop-bar-inner">
        <div class="product-view-mode">
            <!-- shop-item-filter-list start -->
            <ul class="nav shop-item-filter-list" role="tablist">
                <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab"
                        role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i
                            class="fa fa-th-list"></i></a></li>
            </ul>
            <!-- shop-item-filter-list end -->
        </div>
        <div class="toolbar-amount">
            <span>Hiển thị {{count($productsPagination)}} trên {{count($resultProducts)}} sản phẩm</span>
        </div>
    </div>
    <!-- product-select-box start -->
    <div class="product-select-box">
        <div class="product-short">
            <p>Sắp xếp theo:</p>
            <select id="select-filter" style="width:300px;height:30px">
                <option selected disabled>Vui lòng chọn sắp xếp</option>
                <option <?php echo $querySort == 'rating' ? "selected" : "" ?> value="rating">Đánh giá</option>
                <option <?php echo $querySort == 'asc' ? "selected" : "" ?> value="asc">Giá từ thấp tới cao</option>
                <option <?php echo $querySort == 'desc' ? "selected" : "" ?> value="desc">Giá từ cao xuống thấp</option>
            </select>
        </div>
    </div>
    <!-- product-select-box end -->
</div>
<!-- shop-top-bar end -->