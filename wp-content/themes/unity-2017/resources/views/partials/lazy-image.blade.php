<?php
if (!empty($width)) {
  $width_attr = 'width="' . $width .'"';
}
if (!empty($height)) {
  $height_attr = 'height="' . $height .'"';
}
if (!empty($srcset)) {
  $srcset_attr = 'srcset="' . $srcset .'"';
}
?>
<noscript data-src="{{ $src }}" {!! $srcset_attr !!} class="{{ $class }}" alt="{{ $alt }}" {!! $width_attr !!} {!! $height_attr !!}>
  <img class="{{ $class }}" src="{{ $src }}" {!! $srcset_attr !!} alt="{{ $alt }}" {!! $width_attr !!} {!! $height_attr !!}>
</noscript>
