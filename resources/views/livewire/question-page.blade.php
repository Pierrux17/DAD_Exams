<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-3/5 p-8 p-8 bg-white shadow-lg rounded-lg">
        @if ($exam)
            <livewire:exam-info :exam="$exam" />

            <h2 class="text-2xl text-center text-blue-500 font-bold mb-4">Questions :</h2>

            <form wire:submit.prevent="submitResponses">
                <ul class="space-y-4">
                    @foreach ($responses as $index => $response)
                        <li class="flex flex-col items-center p-4 border rounded-lg shadow hover:bg-gray-50">
                            <p class="mb-2 text-center">{{ $response->question->text }}</p>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="user_response_{{ $index }}"
                                        wire:model="userAnswers.{{ $index }}" value="1" class="mr-2"> Oui
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="user_response_{{ $index }}"
                                        wire:model="userAnswers.{{ $index }}" value="0" class="mr-2"> Non
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <button type="submit" class="w-1/5 mx-auto mt-4 p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">
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

