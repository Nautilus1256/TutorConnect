<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="description" content="家庭教師として働く大学生のためのQ&Aプラットフォーム。家庭教師が抱える不安や悩み、日常の課題を共有し、解決策やアドバイスを得ることができる場を提供します。">
        
        <meta property="og:title" content="TutorConnect">
        <meta property="og:type" content="website">
        <meta propetry="og:url" content="https://tutorconnect-11e9659f9c5d.herokuapp.com/">
        <meta property="og:image" content="https://tutorconnect-11e9659f9c5d.herokuapp.com/icon-orange.png">
        <meta property="og:description" content="家庭教師として働く大学生のためのQ&Aプラットフォーム。家庭教師が抱える不安や悩み、日常の課題を共有し、解決策やアドバイスを得ることができる場を提供します。">

        <title>{{ config("app.name", "Laravel") }}</title>
        <link rel="icon" href="{{ asset('icon-orange.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&family=Pangolin&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/ef224dbb5e.js" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="mx-4 min-h-screen overflow-hidden bg-white">
            @include("layouts.mynavigation")

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="font-body">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
