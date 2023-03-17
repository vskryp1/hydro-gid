<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "BlogPosting",
    "headline": "{{ $page->name }}",
    "image": [
      "{{ $page->getImageUrl('page_blog_one') }}"
    ],
    "datePublished": "{{ $page->created_at->format('Y-m-d') }}",
    "dateModified": "{{ $page->updated_at->format('Y-m-d') }}",
    "author": {
      "@type": "Person",
      "name": "{{ ShopHelper::setting("site_name") }}"
    },
     "publisher": {
       "@type": "Organization",
       "name": "{{ ShopHelper::setting("site_name") }}'",
       "logo": {
         "@type": "ImageObject",
         "url": "{{ asset('/assets/frontend/images/logo@2.png') }}"
       }
     },
     "description": "{{ $page->name }}"
}
</script>