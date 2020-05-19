<div class="paginatoin-area">
    <div class="row">
        <div class="col-lg-6 col-md-6 pt-xs-15">
            <p>Hiển thị {{count($productsPagination)}} trên {{count($resultProducts)}} sản phẩm</p>
        </div>
        <div class="col-lg-6 col-md-6">
            {{-- <ul class="pagination-box pt-xs-20 pb-xs-15">
                <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i> Previous</a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li>
                    <a href="#" class="Next"> Next <i class="fa fa-chevron-right"></i></a>
                </li>
            </ul> --}}
            {{ $productsPagination->links() }}
        </div>
    </div>
</div>