<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>error</title>
    {{-- icons link --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel='stylesheet' href='{{ asset("icons/bootstrap-icons.min.css") }}'>


  
  
</head>


<body>

	@yield('content')
</body>

</html>
