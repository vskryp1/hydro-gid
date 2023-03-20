{!! Form::open([
    'id'    => 'page-review-form',
    'route' => 'frontend.forms.review.store',
]) !!}
    {!! Form::hidden('reviewable_id', $reviewable_id) !!}
    {!! Form::hidden('reviewable_type', Review::MODELS[$reviewable_type]) !!}
    <div class="star-box">
        <div data-mark="5"
             data-star-on="{{ asset('assets/frontend/images/on.svg') }}"
             data-star-off="{{ asset('assets/frontend/images/off.svg') }}"
             class="star star-fill hidden-mob" id="reviews_rating">
        </div>
    </div>

@if($errors->count())
        <ul>
            {!! implode($errors->all('<li style="color: red">:message</li>')) !!}
        </ul>
@endif

    <label>
        <i class="icon icon-user"></i>
        @auth('web')
            {!! Form::hidden('username', auth('web')->user()->name) !!}
            {!! Form::text('username', auth('web')->user()->name, [
                'class'       => 'form-control',
                'placeholder' => __('frontend/review/index.username'),
                'readonly'    => true,
                'disabled'    => true,
            ]) !!}
        @else
            {!! Form::text('username', null, [
                'class'       => 'form-control',
                'placeholder' => __('frontend/review/index.username'),
                'required',
            ]) !!}
        @endauth
    </label>
    <label>
        <i class="icon icon-union"></i>
        @auth('web')
            {!! Form::hidden('email', auth('web')->user()->email) !!}
            {!! Form::email('email', auth('web')->user()->email, [
                'class'       => 'form-control',
                'placeholder' => __('frontend/review/index.email'),
                'readonly'    => true,
                'disabled'    => true,
            ]) !!}
        @else
            {!! Form::email('email', null, [
                'class'       => 'form-control',
                'placeholder' => __('frontend/review/index.email'),
                'required',
            ]) !!}
        @endauth
    </label>
    <label>
        <i class="icon icon-comment"></i>
        {!! Form::textarea('comment', null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/review/index.comment'),
            'min'         => 30,
            'required',
        ]) !!}
    </label>
    {!! Form::button(__('frontend/review/index.left'), [
        'type' => 'submit',
    ]) !!}
{!! Form::close() !!}
