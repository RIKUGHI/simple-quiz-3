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
          <div class="bg-green-200 p-10 rounded-xl flex flex-col items-center space-y-5">
            <span class="font-bold text-green-600 bg-white rounded-full p-2">
                Yey Quiz {{ $question->title }} Selesai
            </span>
            <p class="text-green-600 font-bold">
                Kamu mendapatkan nilai
            </p>
            <div class="bg-white w-40 h-40 rounded-full flex justify-center items-center text-2xl font-bold">
                {{ $score }}
            </div>
        </div>
        <div class="mt-10 flex">
            <div class="flex-auto">
                <p class="text-xs">Jawaban Benar</p>
                <p class="font-bold">{{ $correctCount }} Soal</p>
            </div>
            <div class="flex-auto">
                <p class="text-xs">Jawaban Salah</p>
                <p class="font-bold">{{ $wrongCount }} Soal</p>
            </div>
        </div>
          <a
              href="{{ route("my-quizzes.index") }}"
              class="mt-10 py-2 px-5 rounded-full mx-auto block w-fit border border-green-600 text-sm font-bold"
          >
              Selesai
          </a>
        </x-base-layout>
    </body>
</html>
