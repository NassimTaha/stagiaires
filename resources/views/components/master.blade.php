<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('storage/img/Sonatrach.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-icons-1.11.3/font/bootstrap-icons.css') }}" rel="stylesheet">
    <title>{{$title}}</title>
  </head>
  <body style="background-color:  #F0EAD6">
    @include('partials.nav')
    <div class="container my-2">
      @include('partials.flashbag')
    </div>
    <div class="container">
       {{$slot}}
    </div>
    <script src="{{ asset('bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('js/main.js')}}" ></script>
  </body>
</html>

