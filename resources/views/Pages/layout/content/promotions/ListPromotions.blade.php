<!-- Begin Li's Main Blog Page Area -->
<div class="li-main-blog-page pt-60 pb-55">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Main Content Area -->
            <div class="col-lg-12">
                <div class="row li-main-content">
                    @foreach ($promotionsPagination as $promotion)
                    <div class="col-lg-4 col-md-6" style="height: 450px">
                        <div class="li-blog-single-item pb-25">
                            <div class="li-blog-banner">
                                <a href="/promotions/{{$promotion->id}}"><img class="img-full"
                                        src="{{$promotion->poster}}" alt=""></a>
                            </div>
                            <div class="li-blog-content">
                                <div class="li-blog-details">
                                    <h3 class="li-blog-heading pt-25"><a
                                            href="/promotions/{{$promotion->id}}">{{$promotion->title}}</a></h3>
                                    <div class="li-blog-meta" style="text-align: center">
                                        <a class="post-time"><i class="fa fa-calendar"></i>
                                            {{date_format(date_create($promotion->start_at), 'd/m/y')}} </a>- &nbsp;
                                        <a class="post-time"><i
                                                class="fa fa-calendar"></i>{{date_format(date_create($promotion->end_at), 'd/m/y')}}</a>
                                    </div>
                                    <p>{{$promotion->description}}</p>
                                    <a class="read-more" href="promotions/{{$promotion->id}}">Xem thêm...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @include('Pages.layout.content.promotions.PromotionsPagination',['promotionsPagination'=>$promotionsPagination,'promotions'=>$promotions])
                </div>
            </div>
            <!-- Li's Main Content Area End Here -->
        </div>
    </div>
</div>
<!-- Li's Main Blog Page Area End Here -->