<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tambah Quiz Untuk {{$quiz->title}}
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
          
              <form method="post" action="{{ route('quizzes.detail.store', ['id' => $quiz->id]) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                  @csrf

                  <div>
                    <x-input-label for="photo" value="Photo (optional)" />
                    <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="explain" value="Penjelasan (optional)" />
                    <x-text-input id="explain" name="explain" type="file" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('explain')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="question" value="Pertanyaan" />
                    <x-text-input id="question" name="question" type="text" value="{{ old('question') }}" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('question')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="a" value="A" />
                    <div class="flex items-center">
                      <x-text-input id="a" name="a" type="text" value="{{ old('a') }}" class="mt-1 block w-full" />
                      <x-text-input id="ra" name="correct_answer" type="radio" value="a" class="ml-2" />
                    </div>
                    <x-input-error :messages="$errors->get('a')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="b" value="B" />
                    <div class="flex items-center">
                      <x-text-input id="b" name="b" type="text" value="{{ old('b') }}" class="mt-1 block w-full" />
                      <x-text-input id="ba" name="correct_answer" type="radio" value="b" class="ml-2" />
                    </div>
                    <x-input-error :messages="$errors->get('b')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="c" value="C" />
                    <div class="flex items-center">
                      <x-text-input id="c" name="c" type="text" value="{{ old('c') }}" class="mt-1 block w-full" />
                      <x-text-input id="ca" name="correct_answer" type="radio" value="c" class="ml-2" />
                    </div>
                    <x-input-error :messages="$errors->get('c')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="d" value="D" />
                    <div class="flex items-center">
                      <x-text-input id="d" name="d" type="text" value="{{ old('d') }}" class="mt-1 block w-full" />
                      <x-text-input id="da" name="correct_answer" type="radio" value="d" class="ml-2" />
                    </div>
                    <x-input-error :messages="$errors->get('d')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="e" value="E" />
                    <div class="flex items-center">
                      <x-text-input id="e" name="e" type="text" value="{{ old('e') }}" class="mt-1 block w-full" />
                      <x-text-input id="ea" name="correct_answer" type="radio" value="e" class="ml-2" />
                    </div>
                    <x-input-error :messages="$errors->get('e')" class="mt-2" />
                  </div>
                    
                  <x-input-error :messages="$errors->get('correct_answer')" class="mt-2" />
                  
                    <div class="flex items-center gap-4">
                      <x-primary-button>{{ __('Save') }}</x-primary-button>
                  </div>
              </form>
          </section>
          
          </div>
      </div>
  </div>
</x-app-layout>
