<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-4xl text-center text-blue-500 font-bold mb-6">Page d'accueil</h1>

        <p class="text-center text-gray-700 mb-6">Entrez votre code</p>

        <form wire:submit="submit" class="space-y-4">
            <div>
                <input type="text" wire:model.live="token" placeholder="Entrez votre code" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <button type="submit"
                    class="w-full p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">
                    Accéder à l'examen
                </button>
            </div>
        </form>
    </div>

    @if (session()->has('error'))
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            wire:click.self="$set('showErrorPopup', false)">

            <div class="relative bg-white p-6 rounded-lg shadow-lg max-w-sm w-full text-center">

                <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 focus:outline-none"
                    wire:click="$set('showErrorPopup', false)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <h2 class="text-lg font-bold text-red-600 mb-4">Erreur</h2>
                <p class="text-gray-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif
</div>
