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
          <form method="POST" action="{{ $question->currentPage() + 1 > $question->lastPage() ? route('my-quizzes.done', ['id' => $question->items()[0]->question_id]) : '' }}" class="py-10">
            @csrf
            <p class="text-green-600 font-bold text-center">
              Soal {{ $question->currentPage() }} dari {{ $question->total() }}
            </p>
            <div class="mt-5 text-center text-4xl font-bold">
                {{ $question->items()[0]->question }}
            </div>
            @if ($question->items()[0]->photo)
              <img src={{ asset('storage/' . $question->items()[0]->photo) }} alt="" class="m-auto">
            @endif
            <div class="mt-10 space-y-5 flex flex-col">
              @php
                $correct = "bg-green-200 border-2 border-green-600";
                $wrong = "bg-red-200 border-2 border-red-600";

                $styleA = $variant('a'); 
                $styleB = $variant('b'); 
                $styleC = $variant('c'); 
                $styleD = $variant('d');
                $styleE = $variant('e'); 
              @endphp
              @if ($is_done && !$answer)
                <p class="text-red-600">Anda tidak menjawab soal ini</p>
              @endif
              <button
                  aria-label="choice-btn"
                  type="button"
                  @disabled($is_done)
                  @class([
                    "rounded-lg bg-gray-100 p-2 font-bold flex",
                    $correct => $is_done ? $styleA === 'correct' : $answer?->answer === 'a',
                    $wrong => $is_done ? $styleA === 'wrong' : false
                  ])
              >
                a.
                <span class="flex-auto">
                  {{ $question->items()[0]->a }}
                </span>
              </button>
              <button
                  aria-label="choice-btn"
                  type="button"
                  @disabled($is_done)
                  @class([
                    "rounded-lg bg-gray-100 p-2 font-bold flex",
                    $correct => $is_done ? $styleB === 'correct' : $answer?->answer === 'b',
                    $wrong => $is_done ? $styleB === 'wrong' : false
                  ])
              >
                b.
                <span class="flex-auto">
                  {{ $question->items()[0]->b }}
                </span>
              </button>
              <button
                aria-label="choice-btn"
                type="button"
                @disabled($is_done)
                @class([
                  "rounded-lg bg-gray-100 p-2 font-bold flex",
                  $correct => $is_done ? $styleC === 'correct' : $answer?->answer === 'c',
                  $wrong => $is_done ? $styleC === 'wrong' : false
                ])
              >
                c.
                <span class="flex-auto"> 
                  {{ $question->items()[0]->c }}
                </span>
              </button>
              <button
                  aria-label="choice-btn"
                  type="button"
                  @disabled($is_done)
                  @class([
                    "rounded-lg bg-gray-100 p-2 font-bold flex",
                    $correct => $is_done ? $styleD === 'correct' : $answer?->answer === 'd',
                    $wrong => $is_done ? $styleD === 'wrong' : false
                  ])
              >
                d.
                <span class="flex-auto">
                  {{ $question->items()[0]->d }}
                </span>
              </button>
              <button
                  aria-label="choice-btn"
                  type="button"
                  @disabled($is_done)
                  @class([
                    "rounded-lg bg-gray-100 p-2 font-bold flex",
                    $correct => $is_done ? $styleE === 'correct' : $answer?->answer === 'e',
                    $wrong => $is_done ? $styleE === 'wrong' : false
                  ])
              >
                e.
                <span class="flex-auto">
                  {{ $question->items()[0]->e }}
                </span>
              </button>

              @if ($is_done && $question->items()[0]->explain)
                <img src={{ asset('storage/' . $question->items()[0]->explain) }} alt="" class="m-auto">
              @endif
            </div>
            <div class="mt-5 flex justify-between">
              <a
                  href="{{ $question->currentPage() === 1 ? route('my-quizzes.index') : route('my-quizzes.detail', [
                    'id' => $question->items()[0]->question_id,
                    'page' => $question->currentPage() - 1
                  ]) }}"
              >
                  Kembali
              </a>

              @if ($question->currentPage() + 1 > $question->lastPage())
                <button type="submit">
                  Selesai
                </button>
              @else
                <a
                  href="{{ route('my-quizzes.detail', ['id' => $question->items()[0]->question_id, 'page' => $question->currentPage() + 1]) }}" 
                  class="text-sm"
                >
                  {{ $question->currentPage() === $question->lastPage() ? 'Selesai' : ($is_done ? 'Lanjut' : 'Simpan dan Lanjut') }}
                </a>
              @endif
          </div>
          </form>
        </x-base-layout>
        
        @if (!$is_done)
          <script>
            const answers = ['a', 'b', 'c', 'd', 'e']
            const choiceBtns = document.querySelectorAll('[aria-label="choice-btn"]')
            const form = new FormData()

            choiceBtns.forEach((btn, i) => {
                btn.onclick = () => {
                  choiceBtns.forEach(btn => {
                    btn.classList.remove('bg-green-200')
                    btn.classList.remove('border-2')
                    btn.classList.remove('border-green-600')
                  })

                  btn.classList.add('bg-green-200')
                  btn.classList.add('border-2')
                  btn.classList.add('border-green-600')


                  form.append('_token', document.querySelector('[name="_token"]').value)
                  form.append('answer', answers[i])
                  form.append('question_detail_id', "{{ $question->items()[0]->id }}")
                  form.append('is_done', "{{ $question->currentPage() + 1 > $question->lastPage() }}")

                  fetch("{{ route('my-quizzes.store', ['id' => $question->items()[0]->question_id]) }}", {
                    method: 'POST',
                    body: form
                  })
                }
            });
          </script>
        @endif
    </body>
</html>
