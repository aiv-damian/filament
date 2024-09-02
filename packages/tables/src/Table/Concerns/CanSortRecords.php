<?php

namespace Filament\Tables\Table\Concerns;

use Closure;
use Filament\Tables\Columns\Column;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait CanSortRecords
{
    protected array | Closure $defaultSort = [];

    protected bool | Closure | null $persistsSortInSession = true;

    protected bool | Closure | null $sortsMultipleColumns = true;

    protected string | Htmlable | Closure | null $defaultSortOptionLabel = null;

    public function defaultSort(array | Closure $sort): static
    {
        $this->defaultSort = $sort;

        return $this;
    }

    public function persistSortInSession(bool | Closure $condition = true): static
    {
        $this->persistsSortInSession = $condition;

        return $this;
    }

    public function defaultSortOptionLabel(string | Htmlable | Closure | null $label): static
    {
        $this->defaultSortOptionLabel = $label;

        return $this;
    }

    public function getSortableVisibleColumn(string $name): ?Column
    {
        $column = $this->getColumn($name);

        if (! $column) {
            return null;
        }

        if ($column->isHidden()) {
            return null;
        }

        if (! $column->isSortable()) {
            return null;
        }

        return $column;
    }

    public function getDefaultSort(): array
    {
        return $this->evaluate($this->defaultSort);
    }

    public function getSort(?string $column = null): array | string | null
    {
        $sorting = $this->getLivewire()->getTableSort();

        if (isset($column)) {
            return $sorting[$column] ?? null;
        }

        return $sorting;
    }

    public function sortsMultipleColumns(): bool
    {
        return (bool) $this->evaluate($this->sortsMultipleColumns);
    }

    public function persistsSortInSession(): bool
    {
        return (bool) $this->evaluate($this->persistsSortInSession);
    }

    public function getDefaultSortOptionLabel(): string | Htmlable | null
    {
        return $this->evaluate($this->defaultSortOptionLabel) ?? '-';
    }
}
