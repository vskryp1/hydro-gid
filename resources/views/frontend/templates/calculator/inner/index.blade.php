@extends('frontend.layout')

@section('title', $page->name)

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/calculator.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
    @switch($page->getOriginal('alias'))
        @case('calculators/hydraulic')
            {!! Html::script(mix('/assets/vue/calculators/Hydraulic/index.js')) !!}

            @break
        @case('calculators/drive')
            {!! Html::script(mix('/assets/vue/calculators/Drive/index.js')) !!}

            @break
        @case('calculators/pipeline')

            @break
    @endswitch
@endsection
<script>
        window.categories = '{!! json_encode($categories) !!}';
</script>
@section('content')
    <main>
        <div class="calculator-page">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="page__title page--line">
                <div class="container">
                    {{ $page->name }}
                </div>
            </div>
            <div class="container">
                @switch($page->getOriginal('alias'))
                    @case('calculators/hydraulic')
                        <div id="hydraulic">
                            <hydraulic></hydraulic>
                        </div>

                        @break
                    @case('calculators/drive')
                        <div id="drive">
                            <drive></drive>
                        </div>

                        @break
                    @case('calculators/pipeline')

                        @break
                @endswitch
            </div>
        </div>

        <div class="page--line">
            <div class="container">
                <div class="calculator-page__link">
                    @forelse($page->parent->children_active as $i => $child)
                        @unless(Request::is('*' . $child->getOriginal('alias') . '*'))
                            @php(++$i)
                            <a href="{{ route('frontend.page', ['alias' => $child->getOriginal('alias')]) }}" class="calculator__item">
                                <div class="calculator__img">
                                    {!! Html::image('/assets/frontend/images/calc/item-' . $i . '.png', $child->name, ['title' => $child->name]) !!}
                                </div>
                                <div class="calculator__text">
                                    {{ $child->name }}
                                </div>
                            </a>
                        @endunless
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

        @if($page->seo_title && $page->seo_description)
            <div class="seo">
                <div class="container">
                    <div class="seo__title">
                        {{ $page->seo_title }}
                    </div>
                    <div class="sep__text-wrapper">
                        <div class="seo__text">
                            {{ $page->seo_description }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
