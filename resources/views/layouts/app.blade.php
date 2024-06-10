<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Fontawesome 6.4.2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
    @include('partials.components.header')
        <main class="">
            @yield('content')
        </main>
    </div>
</body>

</html>

<style type="text/css">
    body {
        background-color: var(--bg-blue);
        color: var(--text-white);
    }

    .navbar{
        font-size: 16px;
    }
    a {
        text-decoration: none;
        color: inherit;
    }

    .pages {
        width: calc((100%/12)*9);
        margin-left: -1rem;
    }

    .user {
        width: calc((100%/12)*3);
        margin-right: -1rem;
    }

    li {
        cursor: pointer;
        margin: 0.5rem 1rem;

    }

    li:hover {
        box-shadow: 0px 2px 0px 0px var(--button-mag);
    }   
</style>