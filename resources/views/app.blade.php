<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" href="{{asset('dist/favicon.ico') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>  {{ env('APP_NAME') }}   </title>

    <script>
      window.config = {
        config: {
          URL_API: 'https://gentle-hollows-57049.herokuapp.com/'
        }
      }
    </script>
		<link href="{{ asset('/dist/css/chunk-210452ed.9b2c5b6b.css') }}"  type="text/css"  rel="prefetch" />
		<link href="{{ asset('/dist/css/chunk-5d09c4e2.26fb9dcc.css') }}"  type="text/css"  rel="prefetch" />
		<link href="{{ asset('/dist/js/about.e5d86d95.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-210452ed.62bce3c7.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d0b1d7b.da9427d4.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d0b2d57.df35902f.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d0c061b.782c3d81.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d0d2b06.f6857163.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d0d6909.3210c090.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d216214.926a9779.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d216257.256ee085.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d217abc.22876c62.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-2d2244c4.8ac469b9.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-33a72d9b.96c30720.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-354a9ca9.fb404b17.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-3c126d84.0fe1726f.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-5d09c4e2.50df2277.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-7c2a37e4.a6b9c081.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/js/chunk-9e9c9b90.5c5cdf13.js') }}" rel="prefetch" />
		<link href="{{ asset('/dist/css/app.96098bc6.css') }}"  type="text/css"  rel="preload" as="style" />
		<link href="{{ asset('/dist/js/app.5c352651.js') }}" rel="preload" as="script" />
		<link href="{{ asset('/dist/js/chunk-vendors.46955cb0.js') }}" rel="preload" as="script" />
		<link href="{{ asset('/dist/css/app.96098bc6.css') }}"  type="text/css"  rel="stylesheet" />








  
  
    
</head>
<body>
    <noscript
      ><strong
        >We're sorry but sare-front doesn't work properly without JavaScript
        enabled. Please enable it to continue.</strong
      ></noscript
    >
    <div id="app"></div>
    <script src="{{ asset('/dist/js/chunk-vendors.46955cb0.js')}}"></script>
    <script src="{{ asset('/dist/js/app.5c352651.js')}}"></script>
  </body>
</html>

{{-- web: vendor/bin/heroku-php-apache2 public/ --}}