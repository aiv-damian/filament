@props([
    'navigation',
])

<div
    {{
        $attributes->class([
            'fi-topbar sticky top-0 z-20 overflow-x-clip',
        ])
    }}
>
    <nav
        class="flex h-16 items-center gap-x-4 bg-gray-800 px-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 md:px-6 lg:px-8"
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::topbar.start') }}

        <x-filament::icon-button
            color="gray"
            icon="heroicon-o-bars-3"
            icon-alias="panels::topbar.open-sidebar-button"
            icon-size="lg"
            :label="__('filament-panels::layout.actions.sidebar.expand.label')"
            x-cloak
            x-data="{}"
            x-on:click="$store.sidebar.open()"
            x-show="! $store.sidebar.isOpen"
            @class([
                '-ms-1.5',
                'lg:hidden' => (! filament()->isSidebarFullyCollapsibleOnDesktop()) || filament()->isSidebarCollapsibleOnDesktop(),
            ])
        />

        <x-filament::icon-button
            color="gray"
            icon="heroicon-o-x-mark"
            icon-alias="panels::topbar.close-sidebar-button"
            icon-size="lg"
            :label="__('filament-panels::layout.actions.sidebar.collapse.label')"
            x-cloak
            x-data="{}"
            x-on:click="$store.sidebar.close()"
            x-show="$store.sidebar.isOpen"
            class="-ms-1.5 lg:hidden"
        />

        @if (filament()->hasTopNavigation())
            <div class="me-6 hidden lg:flex">
                @if ($homeUrl = filament()->getHomeUrl())
                    <a
                        href="{{ $homeUrl }}"
                        {{-- wire:navigate --}}
                    >
                        <x-filament-panels::logo />
                    </a>
                @else
                    <x-filament-panels::logo />
                @endif
            </div>

            @if (filament()->hasNavigation())
                <ul class="me-4 hidden items-center gap-x-4 lg:flex">
                    @foreach ($navigation as $item)
                        @if (count($item->getChildren()))
                            <x-filament::dropdown.hover
                                placement="bottom-start"
                                teleport
                            >
                                <x-slot name="trigger">
                                    <x-filament-panels::topbar.item
                                        :active="$item->isActive()"
                                        :icon="$item->getIcon()"
                                        :url="$item->getUrl()"
                                    >
                                        {{ $item->getLabel() }}
                                    </x-filament-panels::topbar.item>
                                </x-slot>

                                <x-filament::dropdown.list>
                                    @foreach ($item->getChildren() as $child)
                                        @php
                                            $icon = $child->getIcon();
                                            $shouldOpenUrlInNewTab = $child->shouldOpenUrlInNewTab();
                                        @endphp

                                        <x-filament::dropdown.list.item
                                            :badge="$child->getBadge()"
                                            :badge-color="$child->getBadgeColor()"
                                            :href="$child->getUrl()"
                                            :icon="$child->isActive() ? ($child->getActiveIcon() ?? $icon) : $icon"
                                            tag="a"
                                            :target="$shouldOpenUrlInNewTab ? '_blank' : null"
                                            {{-- :wire:navigate="$shouldOpenUrlInNewTab ? null : true" --}}
                                        >
                                            {{ $child->getLabel() }}
                                        </x-filament::dropdown.list.item>
                                    @endforeach
                                </x-filament::dropdown.list>
                            </x-filament::dropdown.hover>
                        @else
                            <x-filament-panels::topbar.item
                                :active="$item->isActive()"
                                :active-icon="$item->getActiveIcon()"
                                :badge="$item->getBadge()"
                                :badge-color="$item->getBadgeColor()"
                                :icon="$item->getIcon()"
                                :should-open-url-in-new-tab="$item->shouldOpenUrlInNewTab()"
                                :url="$item->getUrl()"
                            >
                                {{ $item->getLabel() }}
                            </x-filament-panels::topbar.item>
                        @endif
                    @endforeach
                </ul>
            @endif
        @endif

        <div
            {{-- x-persist="topbar.end" --}}
            class="ms-auto flex items-center gap-x-4"
        >
            {{ \Filament\Support\Facades\FilamentView::renderHook('panels::global-search.before') }}

            @if (filament()->isGlobalSearchEnabled())
                @livewire(Filament\Livewire\GlobalSearch::class, ['lazy' => true])
            @endif

            {{ \Filament\Support\Facades\FilamentView::renderHook('panels::global-search.after') }}

            @if (filament()->hasDatabaseNotifications())
                @livewire(Filament\Livewire\DatabaseNotifications::class, ['lazy' => true])
            @endif

            <x-filament-panels::user-menu />
        </div>

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::topbar.end') }}
    </nav>
</div>
