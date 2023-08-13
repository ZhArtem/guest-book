<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page.title', config('app.name'))</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="d-flex flex-column justify-content-beetween min-vh-100 container">

        @include('includes.header')

        <main class="flex-grow-1 py-3">

            @yield('content')

        </main>

        @include('includes.footer')
        
    </div>
</body>
</html>