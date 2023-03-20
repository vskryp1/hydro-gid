{!! Form::open(['url' => $url, 'method' => 'GET']) !!}
<div class="title_right">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
            {!! Form::search('search', request('search') ?? old('search'), [
                'class'       => 'form-control',
                'placeholder' => __('backend.search_for'),
            ]) !!}
            <span class="input-group-btn">
                <button class="btn btn-warning" type="submit">
                    <span style="color:white!important;">
                        <i class="fa fa-search"></i>
                        <span class="text-uppercase">
                            {{ __('backend.search') }}
                        </span>
                    </span>
                </button>
            </span>
        </div>
    </div>
</div>
{!! Form::close() !!}