<?php

namespace Filament\Panel\Concerns;

trait HasActivityManager
{
    protected ?string $activityManager = null;

    public function activityManager(string $manager): static
    {
        $this->activityManager = $manager;

        return $this;
    }

    public function hasActivityManager(): bool
    {
        return filled($this->activityManager);
    }

    public function getActivityManager(): ?string
    {
        return $this->activityManager;
    }
}
