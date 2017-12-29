@php ($img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full'))
<span class="vertical-padding-1 horizontal-padding-1 ">
  @include('partials.lazy-image', [
    'alt'    => get_the_title(),
    'class'  => 'valign',
    'src'    => $img[0],
    'width'  => $img[1]/2,
    'height' => $img[2]/2,
  ])
</span>
