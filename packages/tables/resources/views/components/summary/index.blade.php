@props([
    'actions' => false,
    'actionsPosition' => null,
    'columns',
    'extraHeadingColumn' => false,
    'groupColumn' => null,
    'groupsOnly' => false,
    'placeholderColumns' => true,
    'pluralModelLabel',
    'recordCheckboxPosition' => null,
    'records',
    'selectionEnabled' => false,
])

@php
    use Filament\Support\Enums\Alignment;
    use Filament\Tables\Columns\Column;
    use Filament\Tables\Enums\ActionsPosition;
    use Filament\Tables\Enums\RecordCheckboxPosition;

    if ($groupsOnly && $groupColumn) {
        $columns = collect($columns)
            ->reject(fn (Column $column): bool => $column->getName() === $groupColumn)
            ->all();
    }
@endphp

@php
    $query = $this->getAllTableSummaryQuery();
    $selectedState = $this->getTableSummarySelectedState($query)[0] ?? [];
@endphp

<x-filament-tables::summary.row
    :actions="$actions"
    :actions-position="$actionsPosition"
    :columns="$columns"
    :extra-heading-column="$extraHeadingColumn"
    :groups-only="$groupsOnly"
    :heading="__('filament-tables::table.summary.heading', ['label' => $pluralModelLabel])"
    :placeholder-columns="$placeholderColumns"
    :query="$query"
    :record-checkbox-position="$recordCheckboxPosition"
    :selected-state="$selectedState"
    :selection-enabled="$selectionEnabled"
    class="bg-gray-50 dark:bg-white/5"
/>
