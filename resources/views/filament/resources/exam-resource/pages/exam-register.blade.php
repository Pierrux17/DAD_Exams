<x-filament-panels::page>
    <form wire:submit="register">
        {{ $this->form }}
        
        <div class="mt-4 flex justify-end">
            <x-filament::button type="submit">
                S'inscrire à l'examen
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>