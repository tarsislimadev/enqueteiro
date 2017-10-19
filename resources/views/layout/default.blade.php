<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf">
        <link rel="icon" href="/favicon.ico">

        <title>{{ \config('app.name') }}</title>

        <link href="/css/app.css" rel="stylesheet">
        @yield('styles')
    </head>

    <body>

        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation"><a href="{{ route('create') }}">Criar Enquete</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted"><a href="{{ route('home.index') }}">{{ \config('app.name') }}</a></h3>
            </div>

            @yield('content')

            <footer class="footer">
                <hr>
                <p class="text-center">&copy; TL 2017</p>
            </footer>

        </div> <!-- /container -->

        <script src="/js/app.js"></script>
        @yield('scripts')

    </body>
</html>
