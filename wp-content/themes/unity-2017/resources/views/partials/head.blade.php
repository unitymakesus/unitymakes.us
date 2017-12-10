<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "url": "https://www.unitymakes.us",
    "logo": "http://www.example.com/logo.png",  //TODO: Add square logo
    "sameAs": [
      "https://www.facebook.com/unitymakesus",
      "https://twitter.com/unitymakesus",
      "https://www.linkedin.com/company/unity-digital-agency",
      "https://plus.google.com/+UnitymakesUs1"
    ],
    "contactPoint": [{
      "@type": "ContactPoint",
      "telephone": "+1-919-391-4961",
      "contactType": "customer service"
    }]
  }
  </script>
  @if (!is_user_logged_in())
    <!-- Google Tag Manager -->
      <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-WWVMGLG');
      </script>
    <!-- End Google Tag Manager -->
  @endif
  @php(wp_head())
</head>
