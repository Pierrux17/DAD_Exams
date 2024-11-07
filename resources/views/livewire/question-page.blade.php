<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-3/5 p-8 p-8 bg-white shadow-lg rounded-lg">
        @if ($exam)
            {{-- <livewire:exam-info :exam="$exam" /> --}}

            <div class="p-4 border-b">
                <div class="flex justify-end">
                    <span class="text-sm text-blue-500 font-semibold">
                        Examen ID: {{ $exam->id }}
                    </span>
                </div>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div>
                                <svg width="25" height="25" class="text-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-700.">Nom du participant</p>
                                <p class="text-xl"><strong>{{ $exam->user->name }}</strong></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg width="25" height="25" class="text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-base text-gray-500">Date</p>
                                <p class="text-xl"><strong>{{ $exam->exam_date }}</strong></p>
                            </div>
                        </div>
                        {{-- <p class="text-gray-700 mb-4"><strong>Lieu de l'examen :</strong> {{ $exam->place }}</p> --}}

                        <div class="flex items-center gap-3">
                            <svg width="25" height="25" class="text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-base text-gray-500">Lieu de l'examen</p>
                                <p class="text-xl"><strong>{{ $exam->place }}</strong></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg width="25" height="25" class="text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <div>
                                <p class="text-base text-gray-500">Topic</p>
                                <p class="text-xl"><strong>{{ $exam->topic->name }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl text-center text-blue-500 font-bold mb-4">Questions :</h2>

                <form wire:submit="submitResponses">
                    <ul class="space-y-4">
                        @foreach ($responses as $index => $response)
                            <li class="flex flex-col items-center p-4 border rounded-lg shadow hover:bg-gray-50">
                                <p class="mb-2 text-center">{{ $response->question->text }}</p>
                                @if($response->question->image)
                                    <img src="{{ asset('storage/' . $response->question->image) }}" class="w-64 h-64 mb-2" alt="Question Image">
                                @endif
                                <div class="flex space-x-4">
                                    <label class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                        </svg>
                                        <input type="radio" name="user_response_{{ $index }}"
                                            wire:model.live="userAnswers.{{ $index }}" value="1"
                                            class="mr-2 ml-2">
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="user_response_{{ $index }}"
                                            wire:model.live="userAnswers.{{ $index }}" value="0"
                                            class="mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                        </svg>

                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <button type="submit"
                        class="w-1/5 mx-auto mt-4 p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">
                        Soumettre les réponses
                    </button>

                    @if (session()->has('message'))
                        <p class="mt-4 text-center text-green-500">{{ session('message') }}</p>
                    @endif
                </form>
            @else
                <p class="text-center text-red-500">Examen introuvable</p>
        @endif
    </div>
</div>
