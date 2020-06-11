@php
$promotion_1 = $twoPromotions[0];
$promotion_2 = $twoPromotions[1];
@endphp
<!-- Begin Li's Static Banner Area -->
<div class="li-static-banner li-static-banner-3 text-center">
    <div class="container">
        <div class="row">
            <!-- Begin Single Banner Area -->
            <div class="col-lg-6 col-md-6">
                <div class="single-banner pb-xs-30">
                    <a href="/promotions/{{$promotion_1->id}}">
                        <img src="{{$promotion_1->poster}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
            <!-- Begin Single Banner Area -->
            <div class="col-lg-6 col-md-6">
                <div class="single-banner">
                    <a href="/promotions/{{$promotion_2->id}}">
                        <img src="{{$promotion_2->poster}}" alt="Li's Static Banner">
                    </a>
                </div>
            </div>
            <!-- Single Banner Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Static Banner Area End Here -->