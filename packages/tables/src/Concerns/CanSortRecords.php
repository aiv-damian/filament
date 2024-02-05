<?php

namespace Filament\Tables\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait CanSortRecords
{
    public array $tableSort = [];

    public function sortTable(?string $column = null, ?string $direction = null): void
    {
        if (in_array($column, array_keys($this->tableSort))) {
            $direction ??= match ($this->tableSort[$column]) {
                'asc' => 'desc',
                'desc' => null,
                default => 'asc',
            };
        } else {
            $direction ??= 'asc';
        }

        if (! $this->getTable()->sortsMultipleColumns()) {
            $this->tableSort = [];
        }

        if (is_null($direction)) {
            $this->removeTableSort($column);
        } else {
            $this->tableSort[$column] = $direction;
        }

        $this->updatedTableSort();
    }

    protected function applySortingToTableQuery(Builder $query): Builder
    {
        if ($this->getTable()->isGroupsOnly()) {
            return $query;
        }

        if ($this->isTableReordering()) {
            return $query->orderBy($this->getTable()->getReorderColumn());
        }

        if (count($this->getTableSort()) === 0) {
            return $this->applyDefaultSortingToTableQuery($query);
        }

        foreach ($this->getTableSort() as $sortColumn => $sortDirection) {
            $column = $this->getTable()->getSortableVisibleColumn($sortColumn);

            if ($column) {
                $sortDirection = $sortDirection === 'desc' ? 'desc' : 'asc';

                $query = $column->applySort($query, $sortDirection);
            }

            if (! $this->getTable()->sortsMultipleColumns()) {
                return $query;
            }
        }

        return $query;
    }

    protected function applyDefaultSortingToTableQuery(Builder $query): Builder
    {
        $sorting = $this->getTable()->getDefaultSort();

        if (count($sorting) === 0) {
            return $query->orderBy($query->getModel()->getQualifiedKeyName());
        }

        foreach ($sorting as $sortColumnName => $sortDirection) {
            if (
                $sortColumnName &&
                ($sortColumn = $this->getTable()->getSortableVisibleColumn($sortColumnName))
            ) {
                $query = $sortColumn->applySort($query, $sortDirection);
            } else {
                $query = $query->orderBy($sortColumnName, $sortDirection);
            }
        }

        return $query;
    }

    public function updatedTableSort(): void
    {
        if ($this->getTable()->persistsSortInSession()) {
            session()->put(
                $this->getTableSortSessionKey(),
                $this->getTableSort()
            );
        }

        $this->resetPage();
    }

    public function removeTableSort(?string $columnName = null): void
    {
        if (isset($columnName)) {
            $this->tableSort = collect($this->getTableSort())
                ->reject(fn ($sortDirection, $sortColumn) => $sortColumn === $columnName)
                ->all();
        } else {
            $this->tableSort = [];
        }

        $this->updatedTableSort();
    }

    public function getTableSort(): array
    {
        return $this->tableSort;
    }

    /**
     * @deprecated Override the `table()` method to configure the table.
     */
    protected function getDefaultTableSort(): array | Closure
    {
        return [];
    }

    public function getTableSortSessionKey(): string
    {
        $table = $this::class;

        return "tables.{$table}_sort";
    }

    /**
     * @deprecated Override the `table()` method to configure the table.
     */
    protected function shouldPersistTableSortInSession(): bool
    {
        return false;
    }
}
