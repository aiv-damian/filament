<?php

namespace Filament\Tables\Columns\Concerns;

use Closure;

trait HasPopover
{
    protected string | Closure | null $popoverView = null;

    protected array | Closure $popoverAttributes = [];

    public function popover(string | Closure | null $view, array | Closure $attributes = []): static
    {
        $this->popoverView = $view;
        $this->popoverAttributes = $attributes;

        return $this;
    }

    public function getPopoverView(): ?string
    {
        return $this->evaluate($this->popoverView);
    }

    public function getPopoverAttributes(): array
    {
        return $this->evaluate($this->popoverAttributes);
    }

    public function hasPopover(): bool
    {
        return isset($this->popoverView);
    }
}
