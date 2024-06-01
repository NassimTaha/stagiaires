<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    </head>
    <body  class="font-sans text-gray-900 antialiased ">    
        <div style="background-image: linear-gradient(45deg, rgb(240, 92, 24) 0%, rgb(240, 92, 24) 18%,rgb(239, 116, 49) 18%, rgb(239, 116, 49) 33%,rgb(238, 140, 73) 33%, rgb(238, 140, 73) 38%,rgb(237, 165, 98) 38%, rgb(237, 165, 98) 53%,rgb(235, 189, 122) 53%, rgb(235, 189, 122) 56%,rgb(234, 213, 147) 56%, rgb(234, 213, 147) 83%,rgb(233, 237, 171) 83%, rgb(233, 237, 171) 100%),linear-gradient(0deg, rgb(240, 92, 24) 0%, rgb(240, 92, 24) 18%,rgb(239, 116, 49) 18%, rgb(239, 116, 49) 33%,rgb(238, 140, 73) 33%, rgb(238, 140, 73) 38%,rgb(237, 165, 98) 38%, rgb(237, 165, 98) 53%,rgb(235, 189, 122) 53%, rgb(235, 189, 122) 56%,rgb(234, 213, 147) 56%, rgb(234, 213, 147) 83%,rgb(233, 237, 171) 83%, rgb(233, 237, 171) 100%),linear-gradient(67.5deg, rgb(240, 92, 24) 0%, rgb(240, 92, 24) 18%,rgb(239, 116, 49) 18%, rgb(239, 116, 49) 33%,rgb(238, 140, 73) 33%, rgb(238, 140, 73) 38%,rgb(237, 165, 98) 38%, rgb(237, 165, 98) 53%,rgb(235, 189, 122) 53%, rgb(235, 189, 122) 56%,rgb(234, 213, 147) 56%, rgb(234, 213, 147) 83%,rgb(233, 237, 171) 83%, rgb(233, 237, 171) 100%),linear-gradient(22.5deg, rgb(240, 92, 24) 0%, rgb(240, 92, 24) 18%,rgb(239, 116, 49) 18%, rgb(239, 116, 49) 33%,rgb(238, 140, 73) 33%, rgb(238, 140, 73) 38%,rgb(237, 165, 98) 38%, rgb(237, 165, 98) 53%,rgb(235, 189, 122) 53%, rgb(235, 189, 122) 56%,rgb(234, 213, 147) 56%, rgb(234, 213, 147) 83%,rgb(233, 237, 171) 83%, rgb(233, 237, 171) 100%),linear-gradient(90deg, rgb(243, 116, 163),rgb(252, 182, 229)); background-blend-mode:overlay,overlay,overlay,overlay,normal;" class=" min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="#">
                    <img style="margin-bottom: 30px;" src="{{ asset('storage/img/Sonatrach.png') }}" class="rounded" height="70px" width="70px">
                </a>
            </div>

            <div >
                {{ $slot }}
            </div>
        </div>
        
    </body>
    
</html>
