@props([
    'columns' => [],
    'indicators' => [],
])

<div
    {{ $attributes->class(['fi-ta-filter-indicators flex items-start justify-between gap-x-3 bg-gray-50 px-3 py-1.5 dark:bg-white/5 sm:px-6']) }}
>
    <div class="flex flex-col gap-x-3 gap-y-1 sm:flex-row sm:items-center">
        <span
            class="text-sm font-medium leading-6 text-gray-700 dark:text-gray-200"
        >
            {{ __('filament-tables::table.sort.indicator') }}
        </span>

        <div class="flex gap-1.5">
            @foreach ($indicators as $column => $direction)
                @php
                    $direction = match ($direction) {
                        'asc' => 'A-Z',
                        'desc' => 'Z-A',
                        default => null,
                    };
                @endphp

                <x-filament::badge>
                    {{ $columns[$column] }}: {{ $direction }}

                    <x-slot
                        name="deleteButton"
                        :label="__('filament-tables::table.filters.actions.remove.label')"
                        wire:click="removeTableSort('{{ $column }}')"
                        wire:loading.attr="disabled"
                        wire:target="removeTableSort"
                    ></x-slot>
                </x-filament::badge>
            @endforeach
        </div>
    </div>

    <x-filament::icon-button
        color="gray"
        icon="heroicon-m-x-mark"
        icon-alias="tables::filters.remove-all-button"
        size="sm"
        :tooltip="__('filament-tables::table.filters.actions.remove_all.tooltip')"
        wire:click="removeTableSort"
        wire:target="removeTableSort"
        class="-mx-1.5 -my-1"
    />
</div>
