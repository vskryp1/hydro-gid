<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab" aria-controls="base" aria-selected="true">
                {{ __('backend.base') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="base-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="inputUserName">
                            {{ __('backend/review/index.username') }}
                            @unless(isset($review))
                                <span class="text-danger">*</span>
                            @endunless
                        </label>
                        @isset($review)
                            {!! Form::text('username', null, [
                                'id'       => 'inputUserName',
                                'class'    => 'form-control',
                                'disabled' => true,
                                'readonly' => true,
                            ]) !!}
                            {!! Form::hidden('username', $review->username) !!}
                        @else
                            {!! Form::text('username', null, [
                                'id'       => 'inputUserName',
                                'class'    => 'form-control',
                                'disabled' => false,
                                'readonly' => false,
                            ]) !!}
                        @endisset
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">
                            {{ __('backend/review/index.email') }}
                            @unless(isset($review))
                                <span class="text-danger">*</span>
                            @endunless
                        </label>
                        @isset($review)
                            {!! Form::email('email', null, [
                                'id'       => 'inputEmail',
                                'class'    => 'form-control',
                                'disabled' => true,
                                'readonly' => true,
                            ]) !!}
                            {!! Form::hidden('email', $review->email) !!}
                        @else
                            {!! Form::email('email', null, [
                                'id'       => 'inputEmail',
                                'class'    => 'form-control',
                                'disabled' => false,
                                'readonly' => false,
                            ]) !!}
                        @endisset
                    </div>
                    <div class="form-group">
                        <label for="inputType">
                            {{ __('backend/review/index.type') }}
                            @unless(isset($review))
                                <span class="text-danger">*</span>
                            @endunless
                        </label>
                        @isset($review)
                            {!! Form::text('reviewable_type', Review::getTranslationType($review->reviewable_type), [
                                'id'       => 'inputType',
                                'class'    => 'form-control',
                                'disabled' => true,
                                'readonly' => true,
                            ]) !!}
                            {!! Form::hidden('reviewable_type', $review->reviewable_type) !!}
                        @else
                            {!! Form::select('reviewable_type', Review::getTranslationType(), [], [
                                'id'       => 'inputType',
                                'class'    => 'form-control',
                                'disabled' => false,
                                'readonly' => false,
                            ]) !!}
                        @endisset
                    </div>
                    <div class="form-group">
                        <label for="inputObject">
                            {{ __('backend/review/index.object') }}
                            @unless(isset($review))
                                <span class="text-danger">*</span>
                            @endunless
                        </label>
                        @isset($review)
                            {!! Form::text('reviewable_id', $review->reviewable->format_name ?? $review->reviewable->name, [
                                'id'       => 'inputObject',
                                'class'    => 'form-control',
                                'disabled' => true,
                                'readonly' => true,
                            ]) !!}
                            {!! Form::hidden('reviewable_id', $review->reviewable_id) !!}
                        @else
                            <div class="form-group">
                                {!! Form::select('reviewable_id', [], null, [
                                'class' => 'form-control js_items_search has-feedback-left',
                                'id' => 'inputObject',
                                'disabled' => true])!!}
                            </div>
                        @endisset
                    </div>
                    <div class="form-group">
                        <label for="inputRating">
                            {{ __('backend/review/index.rating') }}
                        </label>
                        {!! Form::number('rating', $review->rating ?? 5, [
                            'id'    => 'inputRating',
                            'class' => 'form-control',
                            'min'   => 1,
                            'max'   => 5,
                            'step'  => 1,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputIsActive">
                            {{ __('backend/review/index.is_active') }}
                        </label><br>
                        {!! Form::hidden('is_active', 0) !!}
                        {!! Form::checkbox('is_active', 1, null, [
                            'id'    => 'inputIsActive',
                            'class' => 'js-switch',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputComment">
                            {{ __('backend/review/index.comment') }}
                        </label>
                        {!! Form::textarea('comment', null, [
                            'id'    => 'inputComment',
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputAnswer">
                            {{ __('backend/review/index.answer') }}
                        </label>
                        {!! Form::textarea('answer', null, [
                            'id'    => 'inputAnswer',
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.reviews.index')])