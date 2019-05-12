<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    @include('layout.header')
  </head>
  <body>
    <div id="app">
    </div>
    @yield('content')
  </body>
  @include('layout.scripts')
</html>
