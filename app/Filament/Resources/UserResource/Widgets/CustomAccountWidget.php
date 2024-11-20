<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\Widget;

class CustomAccountWidget extends Widget
{
    // protected static ?int $sort = -3;
    protected int | string | array $columnSpan = 'half';
    protected static string $view = 'filament.resources.user-resource.widgets.custom-account-widget';
}
