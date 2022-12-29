<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
   <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <title>Document</title>
</head>
<body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')
</body>
</html>


