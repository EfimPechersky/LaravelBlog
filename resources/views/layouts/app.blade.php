<html>
    <head>
        <title>@yield('title')</title>
        @yield('css')
    </head>
    <header>
        <div class='menu'>
        <a class="logo" href="/"></a>
        <a class="menubutton" href="/">Блог</a>
        </div>
        <div class='auth'>
        @guest
        <a href="/registration">Регистрация</a>
        <a >/</a>
        <a  href="/login">Вход</a>
        @endguest
        @auth
        <a href="/logout">Выход</a>
        @endauth
        </div>
    </header>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>