<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('description')">
        <meta name="author" content="@yield('author')">
        <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf">
        @yield('meta')
        <link rel="icon" href="/favicon.ico">

        <title>{{ \config('app.name') }}</title>

        <link href="/css/app.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
