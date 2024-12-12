<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title> Algeria Rise Summit</title>
        <link rel="icon" href="{{asset('images/favicon-32x32.png')}}"/>
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/apple-touch-icon.png')}}"/>
        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        @filamentStyles
        @vite('resources/css/app.css')

    </head>

    <body class="antialiased relative pb-20">
        {{ $slot }}
        <x-includes.footer/>
        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
