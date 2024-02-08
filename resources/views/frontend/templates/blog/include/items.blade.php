@foreach($articles as $article)
<div class="blog__item">
    <a href="{{ $article->alias }}">
        <div class="blog__item-img">
            <?php  $page_add_fields = $article->page_template->page_additional_field; ?>
            @foreach($page_add_fields as $field)
            @php($value = $field->page_additional_field_value->where('page_id', $article->id)->first() && $field->page_additional_field_value->where('page_id', $article->id)->first()->translate()
            ? $field->page_additional_field_value->where('page_id', $article->id)->first()->translate()->value
            : null)
            @php($type = $field->page_additional_field_type->type)
            @if($type == 'file' && $value != '' && Storage::disk('public')->exists(\App\Models\Page\Page::GALLERY_PATH. $article->id . '/' . $value))
            <picture>
                <img src="{{ asset("/storage/pages/$article->id/$value") }}"  alt="{{ $article->name }}" title="{{ $article->name }}">

                <source type="image/webp" srcset="{{ asset("/storage/pages/$article->id/$value") }}">
                </picture>
                @endif
                @endforeach
                
                
            </div>
            <div class="blog__item-title">
                {{ $article->name }}
            </div>
            <div class="blog__item-date">
                <span class="icon icon-calendar"></span>
                {{ $article->updated_at->translatedFormat('j F Y') }}
            </div>
        </a>
    </div>
    @endforeach
