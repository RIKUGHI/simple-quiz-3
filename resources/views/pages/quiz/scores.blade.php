<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Score Quiz {{ $quiz->title }}
      </h2>
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <div class="relative overflow-x-auto">
                  <table class="w-full text-sm text-left text-gray-500">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                          <tr>
                              <th class="px-6 py-3">Name</th>
                              <th class="px-6 py-3">Nim</th>
                              <th class="px-6 py-3">Benar</th>
                              <th class="px-6 py-3">Salah</th>
                              <th class="px-6 py-3">Tidak Dijawab</th>
                              <th class="px-6 py-3">Score</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($students as $student)
                          <tr class="bg-white border-b">
                              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                  {{ $student->name }}
                              </th>
                              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $student->nim }}
                              </th>
                              <td class="px-6 py-4">
                                {{ $student->correctCount }}
                              </td>
                              <td class="px-6 py-4">
                                {{ $student->wrongCount }}
                              </td>
                              <td class="px-6 py-4">
                                {{ $student->notAnswered }}
                              </td>
                              <td class="px-6 py-4">
                                {{ $student->score }}
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
