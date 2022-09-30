<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="description" content="花生糖">
        <meta name="author" content="ttshop">
        <meta property="og:locale" content="zh_TW">
        <meta property="og:type" content="website">
        <meta property="og:title" content="花生糖">
        <meta property="og:description" content="花生糖">
        <meta property="og:url" content="http://www.ttshop.com/">
        <meta property="og:site_name" content="ttshop Home page">
        <meta property="og:image" content="">
        <meta property="og:video" content="">
        <meta name="robots" content="index, follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ttshop</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <noscript>
            <strong>We're sorry but this app doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="app">
            <hello-world></hello-world>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
