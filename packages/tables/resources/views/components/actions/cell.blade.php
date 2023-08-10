<x-filament-tables::cell
    :attributes="\Filament\Support\prepare_inherited_attributes($attributes)"
>
    <div class="whitespace-nowrap px-2 py-1">
        {{ $slot }}
    </div>
</x-filament-tables::cell>
