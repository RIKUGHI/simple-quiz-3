<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Quiz
      </h2>
      <a href="{{ route('quizzes.create') }}" class="font-bold">
          Tambah
      </a>
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <div class="relative overflow-x-auto">
                  @if (session('message'))
                    <p class="text-red-600">
                      {{ session('message') }}
                    </p>
                    @endif
                  <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Judul</th>
                            <th class="px-6 py-3">
                                Total Soal
                            </th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($quizzes as $quiz)
                          <tr class="bg-white border-b">
                              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $quiz->title }}
                              </th>
                              <td class="px-6 py-4">
                                  {{ $quiz->question_details_count }}
                              </td>
                              <td class="px-6 py-4">
                                  <a href="{{ route('quizzes.detail', ['id' => $quiz->id]) }}">Detail</a>
                                  /
                                  <a href="{{ route('quizzes.detail.create', ['id' => $quiz->id]) }}">Tambah</a>
                              </td>
                          </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
