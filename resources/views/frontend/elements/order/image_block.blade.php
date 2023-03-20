<picture>
    <source type="image/webp" srcset="{{ $product->cover->getUrl('prod_md', true) }}">
    <img src="{{ $product->cover->getUrl('prod_md') }}"
         alt="{{ $product->cover->getImageAlt() }}"
         title="{{ $product->cover->getImageTitle() }}"/>
</picture>