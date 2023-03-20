{!! Form::open([
    'id'    => 'product-review-form',
    'class' => 'write-us-form',
    'role'  => 'form',
    'route' => 'frontend.forms.review.store',
]) !!}
    {!! Form::hidden('reviewable_id', $reviewable_id) !!}
    {!! Form::hidden('reviewable_type', Review::MODELS[$reviewable_type]) !!}
    <div class="input-field form-star-box ">
        <div class="star js_review-form star-fill hidden-mob" data-mark="0"
             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
             data-star-off="{{asset('assets/frontend/images/off.svg') }}"></div>
    </div>
    <div class="input-field">
        @auth('web')
            {!! Form::hidden('username', auth('web')->user()->name) !!}
            {!! Form::text('username', auth('web')->user()->name, [
                'id'          => 'inputUsername',
                'class'       => 'form-control',
                'placeholder' => ' ',
                'tabindex'    => 1,
                'required',
                'readonly'    => true,
                'disabled'    => true,
            ]) !!}
        @else
            {!! Form::text('username', null, [
                'id'          => 'inputUsername',
                'class'       => 'form-control',
                'placeholder' => ' ',
                'tabindex'    => 1,
                'required',
            ]) !!}
        @endauth
        <label for="inputUsername" class="field-placeholder">
            {{ __('frontend/review/index.username') }}
        </label>
        <i class="icon icon-user"></i>
    </div>
    <div class="input-field">
        @auth('web')
            {!! Form::hidden('email', auth('web')->user()->email) !!}
            {!! Form::email('email', auth('web')->user()->email, [
                'id'          => 'inputEmail',
                'class'       => 'form-control',
                'placeholder' => ' ',
                'tabindex'    => 2,
                'required',
            ]) !!}
        @else
            {!! Form::email('email', null, [
                'id'          => 'inputEmail',
                'class'       => 'form-control',
                'placeholder' => ' ',
                'tabindex'    => 2,
                'required',
            ]) !!}
        @endauth
        <label for="inputEmail" class="field-placeholder">
            {{ __('frontend/review/index.email') }}
        </label>
        <i class="icon icon-union"></i>
    </div>
    <div class="form-field input-field">
        {!! Form::textarea('comment', null, [
            'class'       => 'validate',
            'placeholder' => __('frontend/review/index.comment'),
            'min'         => 30,
            'required',
        ]) !!}
        <span class="pass-input">
            <i class="icon icon-check-c"></i>
        </span>
        <i class="icon icon-comment"></i>
    </div>
    {!! Form::button(__('frontend/review/index.left'), [
        'type'  => 'submit',
        'class' => 'button-reset main-btn main-btn--green',
    ]) !!}
{!! Form::close() !!}
