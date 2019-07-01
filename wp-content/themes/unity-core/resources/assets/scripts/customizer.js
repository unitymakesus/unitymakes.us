import $ from 'jquery';

// Live Preview Controls
wp.customize('blogname', (value) => {
  value.bind(to => $('.brand').text(to));
});
