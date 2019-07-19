<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ config('app.url') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="app">
    <div style="height:100%; display:flex; justify-content: center">
        <div class="spinner-border align-self-center" role="status" style="align-self: center">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ mix('js/app.js') }}" async></script>
</body>
</html>
