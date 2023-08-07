<?php

namespace Filament\Navigation;

use Illuminate\Support\Traits\Conditionable;

class NavigationBuilder
{
    use Conditionable;

    /** @var NavigationItem[] */
    protected array $items = [];

    public function item(NavigationItem $item): static
    {
        $this->items[] = $item;

        return $this;
    }

    /** @param  array<NavigationItem>  $items */
    public function items(array $items): static
    {
        $this->items = [
            ...$this->items,
            ...$items,
        ];

        return $this;
    }

    /**
     * @return array<NavigationItem>
     */
    public function getNavigation(): array
    {
        return $this->items;
    }
}
