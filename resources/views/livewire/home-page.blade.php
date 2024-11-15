<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-4xl text-center text-blue-500 font-bold mb-6">Page d'accueil</h1>

        <p class="text-center text-gray-700 mb-6">Entrez votre code</p>
        
        <form wire:submit="submit" class="space-y-4">
            <div>
                <input 
                    type="text" 
                    wire:model.live="token" 
                    placeholder="Entrez votre code" 
                    required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                >
            </div>
            <div>
                <button 
                    type="submit" 
                    class="w-full p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring focus:ring-blue-300">
                    Accéder à l'examen
                </button>
            </div>
        </form>
    </div>
</div>
