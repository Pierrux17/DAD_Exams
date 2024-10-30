<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-2/5 p-8 bg-white shadow-lg rounded-lg">
        @if($exam)
            <livewire:exam-info :exam="$exam" />

            @if($exam->status == 'En attente')
                <form wire:submit.prevent="submit">
                    <button
                        type="submit"
                        class="w-full p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">
                        Commencer l'examen
                    </button>
                </form>
            @else
            <div>
                <p class="text-green-500 font-bold mt-4">Examen terminé</p>
                <p class="text-gray-700 mt-4"><strong>Result :</strong> {{ $exam->result }} %</p>
                <p class="text-gray-700"><strong>Statut :</strong> {{ $exam->status }}</p>
            </div>
            @endif
        @else
            <p class="text-center text-red-500">Examen introuvable</p>
        @endif
    </div>
</div>
