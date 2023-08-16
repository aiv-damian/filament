<?php

namespace Filament\Infolists\Components;

use Filament\Infolists\ComponentContainer;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SpatieMediaLibraryEntry extends Entry
{
    /**
     * @var view-string
     */
    protected string $view = 'filament-media-library::components.spatie-media-library-entry';

    protected ?string $collection = null;

    public function collection(string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }

    public function getCollection(): ?string
    {
        return $this->collection ?? 'default';
    }

    /**
     * @return array<string>
     */
    public function getState(): array
    {
        $collection = $this->getCollection();

        return $this->getRecord()->getRelationValue('media')
            ->filter(fn (Media $media): bool => blank($collection) || ($media->getAttributeValue('collection_name') === $collection))
            ->all();
    }
}
