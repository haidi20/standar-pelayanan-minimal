<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token">
    <title>Standar Pelayanan Minimal</title>
    @include('_layouts.script-top')
    @yield('script-top')
  </head>
  <body>
    <div id="app">
      @yield('tubuh')
    </div>
    <script>
      var Laravel = {
        csrfToken: '{{ csrf_token() }}'
      }
    </script>
    @include('_layouts.script-bottom')
    @yield('script-bottom')
  </body>
</html>
