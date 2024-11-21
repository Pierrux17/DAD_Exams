@php
    $user = filament()->auth()->user();
    $displayRole = match($user->role) {
        'supervisor' => 'Superviseur',
        'admin' => 'Administrateur',
        default => $user->role
    };
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section class="bg-gradient-to-r from-primary-50 to-primary-100 dark:from-primary-900/50 dark:to-primary-900/70 rounded-xl shadow-md p-4">
        <div class="flex items-center space-x-5">
            <div class="flex-shrink-0">
                <x-filament-panels::avatar.user 
                    size="xl" 
                    :user="$user" 
                    class="ring-4 ring-white dark:ring-primary-800 rounded-full"
                />
            </div>
            
            <div class="flex-1 text-center">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ __('Bienvenue') }} {{ filament()->getUserName($user) }}
                </h2>
                
                {{-- <div class="flex items-center justify-around mt-3"> --}}
                <div class="flex items-center justify-center gap-6 mt-3">
                    @if($user->company && $user->company->name)
                    <div class="inline-flex items-center space-x-2">
                        <x-heroicon-m-building-office-2 class="w-6 h-5 text-primary-600 dark:text-primary-400"/>
                        <p class="text-m text-gray-600 dark:text-gray-300 font-medium">
                            {{ $user->company->name }}
                        </p>
                    </div>
                    @endif

                    @if($user->role)
                    <div class="inline-flex items-center space-x-2">
                        <x-heroicon-m-user-circle class="w-6 h-6 text-primary-600 dark:text-primary-400"/>
                        <span class="text-m text-gray-600 dark:text-gray-600 font-medium">
                            {{ $displayRole }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>