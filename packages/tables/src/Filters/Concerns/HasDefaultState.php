<?php

namespace Filament\Tables\Filters\Concerns;

use BackedEnum;

trait HasDefaultState
{
    protected mixed $defaultState = null;

    public function default(mixed $state = true): static
    {
        $this->defaultState = $state;

        return $this;
    }

    public function getDefaultState(): mixed
    {
        $state = $this->evaluate($this->defaultState);

        if (is_array($state)) {
            $state = array_map(fn ($value) => $value instanceof BackedEnum ? $value->value : $value, $state);
        }

        return $state;
    }
}
