<picture>
    <source type="image/webp" class="lazy-srcset" data-srcset="{{ $product->cover->getUrl('prod_md', true) }}">
    <img  class="lazy" data-src="{{ $product->cover->getUrl('prod_md_optimize') }}"
         alt="{{ $product->cover->getImageAlt() }}"
         title="{{ $product->cover->getImageTitle() }}">
</picture>