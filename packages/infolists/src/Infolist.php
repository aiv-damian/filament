<?php

namespace Filament\Infolists;

class Infolist extends ComponentContainer
{
    protected string $name;

    public static string $defaultCurrency = 'eur';

    public static string $defaultDateDisplayFormat = 'j M Y';

    public static string $defaultDateTimeDisplayFormat = 'j M Y H:i:s';

    public static string $defaultTimeDisplayFormat = 'H:i:s';

    public static ?string $defaultNumberLocale = null;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
