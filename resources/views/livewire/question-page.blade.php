<div class="flex flex-row items-center justify-center min-h-screen" translate="no">
    <div class="max-w-3xl mx-auto p-8">
        @if ($exam)
            <div class="bg-white rounded-lg shadow-lg mb-6">
                <div class="p-8 bg-gray-50 rounded-lg">
                    <h1 class="text-2xl font-bold text-center mb-4">Examen</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-12">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                </svg>
                                <label class="text-sm font-medium text-gray-700">Abattoir</label>
                            </div>
                            <p class="mt-2 ml-3 text-m font-medium"><strong>{{ $exam->user->company->name }}</strong>
                            </p>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-3">
                                <svg width="25" height="25" class="text-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <label class="text-sm font-medium text-gray-700">Date de l'examen</label>
                            </div>
                            <p class="mt-2 ml-3 text-m font-medium"><strong>{{ $exam->exam_date }}</strong></p>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-3">
                                <svg width="25" height="25" class="text-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <label class="text-sm font-medium text-gray-700">Nom du participant</label>
                            </div>
                            <p class="mt-2 ml-3 text-m font-medium"><strong>{{ $exam->user->name }}</strong></p>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-3">
                                <svg width="25" height="25" class="text-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <label class="text-sm font-medium text-gray-700">Lieu de l'examen</label>
                            </div>
                            <p class="mt-2 ml-3 text-m font-medium"><strong>{{ $exam->place }}</strong></p>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"
                                        d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                                </svg>
                                <label class="text-sm font-medium text-gray-700">Nationalité</label>
                            </div>
                            @if ($exam->user->nationality)
                                <p class="mt-2 ml-3 text-m font-medium">
                                    <strong>{{ $exam->user->nationality->name }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-3">
                                <svg width="25" height="25" class="text-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <label class="text-sm font-medium text-gray-700">Espèces</label>
                            </div>
                            <p class="mt-2 ml-3 text-m font-medium"><strong>{{ $exam->topic->name }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="w-1/2 mx-auto p-4">
        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium">
                    Question {{ $currentQuestionNumber }} / {{ $totalQuestions }}
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-slate-700 h-2.5 rounded-full"
                    style="width: {{ ($currentQuestionNumber / $totalQuestions) * 100 }}%">
                </div>
            </div>
        </div>

    <form wire:submit="submitResponses" class="space-y-8">
        @if ($currentResponse)
            <!-- Question -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-center text-gray-800 px-4">
                    {{ $currentResponse->question->text }}
                </h2>

                <!-- Image de la question -->
                @if ($currentResponse->question->image)
                    <div class="flex justify-center my-6">
                        <img src="{{ asset('storage/' . $currentResponse->question->image) }}"
                            class="rounded-lg shadow-md object-cover w-64 h-64" alt="Question Image">
                    </div>
                @endif

                <!-- Options de réponse -->
                <div class="flex justify-center gap-8 mt-8">
                    <!-- Option Oui -->
                    <label class="relative group cursor-pointer">
                        <!-- Radio button caché -->
                        <input type="radio" 
                               name="user_response_{{ $currentQuestionIndex }}"
                               wire:model.live="userAnswers.{{ $currentQuestionIndex }}" 
                               value="1"
                               class="hidden peer">
                    
                        <!-- Conteneur stylisé -->
                        <div class="flex flex-col items-center space-y-3 p-4 rounded-lg transition-all
                                    hover:bg-green-50 peer-checked:bg-green-50 peer-checked:ring-2 peer-checked:ring-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" 
                                class="w-12 h-12 text-green-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                            </svg>
                        </div>
                    </label>
                    <!-- Option Non -->
                    <label class="relative group cursor-pointer">
                        <!-- Radio button caché -->
                        <input type="radio" 
                               name="user_response_{{ $currentQuestionIndex }}"
                               wire:model.live="userAnswers.{{ $currentQuestionIndex }}" 
                               value="0"
                               class="hidden peer">
                    
                        <!-- Conteneur stylisé -->
                        <div class="flex flex-col items-center space-y-3 p-4 rounded-lg transition-all
                                    hover:bg-red-50 peer-checked:bg-red-50 peer-checked:ring-2 peer-checked:ring-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" 
                                    class="w-12 h-12 text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                </svg>
                        </div>
                    </label>
                </div>

            </div>
        @endif

        <!-- Boutons de navigation -->
        <div class="flex justify-center pt-6">
            @if ($currentQuestionIndex === $totalQuestions - 1)
                <button type="button"
                    class="px-8 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg
                               shadow-lg hover:bg-blue-700 transform transition-all duration-200 
                               hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 
                               focus:ring-offset-2"
                    wire:click="submitResponses">
                    Valider et terminer l'examen
                </button>
            @else
                <button type="button"
                    class="px-8 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg
                               shadow-lg hover:bg-blue-700 transform transition-all duration-200 
                               hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 
                               focus:ring-offset-2"
                    wire:click="nextQuestion">
                    Valider
                </button>
            @endif
        </div>

        <!-- Message de confirmation -->
        @if (session()->has('message'))
            <div class="mt-6 text-center">
                <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 rounded-lg">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('message') }}</span>
                </div>
            </div>
        @endif
    </form>
    @endif
</div>
</div>