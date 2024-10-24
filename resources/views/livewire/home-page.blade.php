<div>
    <h1>HomePage</h1>

    <p>Entrez votre code</p>
    
    <form wire:submit.prevent="submit">
        <div>
            <input type="text" wire:model="token" placeholder="Entrez votre code" required>
        </div>
        <div>
            <button type="submit">Accéder à l'examen</button>
        </div>
    </form>
</div>
