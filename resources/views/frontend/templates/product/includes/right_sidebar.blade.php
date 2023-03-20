<div class="filter-nav">
    <form action="" class="js_filters">
        <div class="filter-block">
            <div class="filter-wrapp">
                <p class="filter-title js_open-filter">
                    @lang('frontend/product/index.payments')
                    <span class="symbol"></span>
                </p>
                <div class="filter__items">
                    <ul class="list-discript">
                        @foreach($payments as $payment)
                            <li><a>{{ $payment->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="filter-wrapp">
                <p class="filter-title js_open-filter close-filter">
                    @lang('frontend/product/index.delivery')
                    <span class="symbol"></span>
                </p>
                <div class="filter__items checkbox">
                    <ul class="list-discript">
                        @foreach($deliveries as $delivery)
                            <li><a>{{ $delivery->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="filter-wrapp">
                <p class="filter-title js_open-filter close-filter">
                    @lang('frontend/product/index.refund')
                    <span class="symbol"></span>
                </p>
                <div class="filter__items checkbox">
                    <ul class="list-discript">
                        @php $i = 1; @endphp
                        @while(Setting::has("refund_$i"))
                            <li><a href="#">{{ ShopHelper::setting("refund_$i") }}</a></li>
                            @php $i++; @endphp
                        @endwhile
                    </ul>
                </div>
            </div>
            @if($warranties->isNotEmpty())
                <div class="filter-wrapp">
                    <p class="filter-title js_open-filter close-filter">
                        @lang('frontend/product/index.warranty')
                        <span class="symbol"></span>
                    </p>
                    <div class="filter__items checkbox">
                        <ul class="list-discript">
                            @foreach($warranties as $warranty)
                                <li>
                                    <a>
                                        @lang('frontend/product/index.garanty_on') {{ $warranty->amount }}
                                        @lang(trans_choice('frontend/product/index.month', ($warranty->amount < 20 ? $warranty->amount : $warranty->amount % 10)))
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </form>
</div>
