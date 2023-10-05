<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Siswa
      </h2>
      <a href="{{ route('students.create') }}" class="font-bold">
          Tambah
      </a>
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg">
            <section>
              <header>
                  <h2 class="text-lg font-medium text-gray-900">
                    Informasi Siswa
                  </h2>
          
                  <p class="mt-1 text-sm text-gray-600">
                    Masukan beberapa informasi berikut.
                  </p>
              </header>
          
              <form method="post" action="{{ route('students.store') }}" class="mt-6 space-y-6">
                  @csrf

                  <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="nim" value="Nim" />
                    <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                  </div>

                  <div>
                    <x-input-label for="password" value="Password" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                  </div>
          
                  <div class="flex items-center gap-4">
                      <x-primary-button>{{ __('Save') }}</x-primary-button>
                  </div>
              </form>
          </section>
          
          </div>
      </div>
  </div>
</x-app-layout>
