<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <x-base-layout>
            <div class="space-y-10 mt-10">
                <h1 class="text-2xl font-bold text-center">
                    Welcome To TGM-Math
                </h1>
                <img src="{{ asset('assets/logo.jpeg') }}" alt="" width="200" class="m-auto" />
                <div class="flex justify-center">
                    <a
                        href="{{ route("login") }}"
                        class="py-2 w-40 text-center bg-green-600 rounded-md text-white font-bold"
                    >
                        Login
                    </a>
                </div>
            </div>
        </x-base-layout>
    </body>
</html>
