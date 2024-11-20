<div class="flex justify-center" translate="no">
    <div class="w-2/5 p-8 mt-12 bg-white shadow-lg rounded-lg">
        @if ($exam)

            <div class="p-4 border-b">
                <div class="flex justify-end">
                    <span class="text-sm text-blue-500 font-semibold">
                        Examen ID: {{ $exam->id }}
                    </span>
                </div>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <div class="grid grid-cols-2 space-y-4">
                        <div class="flex items-center gap-3">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Abattoir</p>
                                <p class="text-xl"><strong>{{ $exam->user->company->name }}</strong></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg width="25" height="25" class="text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Date</p>
                                <p class="text-xl"><strong>{{ $exam->exam_date }}</strong></p>
                            </div>
                        </div>
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
                                <p class="text-sm text-gray-500">Nom du participant</p>
                                <p class="text-xl"><strong>{{ $exam->user->name }}</strong></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"
                                    d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                            </svg>
                            <div>
                                @if ($exam->user->nationality)
                                    <p class="text-sm text-gray-500">Nationalité</p>
                                    <p class="text-xl"><strong>{{ $exam->user->nationality->name }}</strong></p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg width="25" height="25" class="text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Lieu de l'examen</p>
                                <p class="text-xl"><strong>{{ $exam->place }}</strong></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg width="25" height="25" class="size-12 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-500">Topic</p>
                                <p class="text-xl"><strong>{{ $exam->topic->name }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($exam->status == 'En attente')
                    <div class="text-center">
                        <button type="button" wire:click="startExam"
                            class="w-1/2 p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">
                            Commencer l'examen
                        </button>
                    </div>
                @elseif($exam->status == 'En cours')
                    <div class="text-center">
                        <button type="button" wire:click="startExam"
                            class="w-1/2 p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">
                            Reprendre l'examen
                        </button>
                    </div>
                @else
                    <div class="p-6 space-y-6">
                        <div class="flex items-center justify-center">
                            @if ($exam->result >= 50)
                                <div class="bg-green-50 rounded-full p-4">
                                    <svg width="40" height="40" class="text-green-500"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @else
                                <div class="bg-red-50 rounded-full p-4">
                                    <svg width="40" height="40" class="text-red-500"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="text-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Examen terminé</h3>
                        </div>

                        <div class="flex flex-row justify-evenly">
                            <div class="flex items-center gap-3">
                                <svg width="25" height="25" class="text-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Résultat obtenu</p>
                                    <p class="text-xl font-bold">{{ $exam->result }}%</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg width="25" height="25" class="text-blue-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Statut</p>
                                    <p class="text-xl font-bold">{{ $exam->status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <p class="text-center text-red-500">Examen introuvable</p>
        @endif
    </div>
</div>
