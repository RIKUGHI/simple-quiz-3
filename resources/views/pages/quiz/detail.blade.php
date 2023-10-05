<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Detail Quiz
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
            <section>
              <header>
                <h2 className="text-lg font-medium text-gray-900">
                    Informasi Quiz
                </h2>
              </header>
          
              <form class="mt-6 space-y-6">
                  <div>
                    <x-input-label for="title" value="Judul" />
                    <x-text-input id="title" name="title" type="text" value="{{ $quiz->title }}" readOnly class="mt-1 block w-full" />
                  </div>
                  
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($questionDetails as $questionDetail)
                    <div class="space-y-6 pb-10">
                      @if ($questionDetail->photo)
                        <div>
                          <img src={{ asset('storage/' . $questionDetail->photo) }} alt="">
                        </div>
                      @endif

                      <div>
                        <x-input-label for="question" value="Pertanyaan {{ $no }}" />
                        <x-text-input id="question" name="question" type="text" value="{{ $questionDetail->question }}" readOnly class="mt-1 block w-full" />
                        <p>
                          Jawaban benar adalah
                          <b>{{ $questionDetail->correct_answer }}</b>
                        </p>
                      </div>

                      <div>
                        <x-input-label for="a" value="A" />
                        <x-text-input id="a" name="a" type="text" value="{{ $questionDetail->a }}" readOnly class="mt-1 block w-full" />
                      </div>

                      <div>
                        <x-input-label for="b" value="B" />
                        <x-text-input id="b" name="b" type="text" value="{{ $questionDetail->b }}" readOnly class="mt-1 block w-full" />
                      </div>

                      <div>
                        <x-input-label for="c" value="C" />
                        <x-text-input id="c" name="c" type="text" value="{{ $questionDetail->c }}" readOnly class="mt-1 block w-full" />
                      </div>

                      <div>
                        <x-input-label for="d" value="D" />
                        <x-text-input id="d" name="d" type="text" value="{{ $questionDetail->d }}" readOnly class="mt-1 block w-full" />
                      </div>

                      <div>
                        <x-input-label for="e" value="E" />
                        <x-text-input id="e" name="e" type="text" value="{{ $questionDetail->e }}" readOnly class="mt-1 block w-full" />
                      </div>

                      @if ($questionDetail->explain)
                        <div>
                          <img src={{ asset('storage/' . $questionDetail->explain) }} alt="">
                        </div>
                      @endif
                      
                      @php
                        $no++;
                      @endphp
                    </div>
                  @endforeach
              </form>
          </section>
          
          </div>
      </div>
  </div>
</x-app-layout>
