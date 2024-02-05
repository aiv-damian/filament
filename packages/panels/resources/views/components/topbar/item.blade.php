@props([
    'active' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'badgeTooltip' => null,
    'icon' => null,
    'shouldOpenUrlInNewTab' => false,
    'url' => null,
])

@php
    $tag = $url ? 'a' : 'button';
@endphp

<li
    @class([
        'fi-topbar-item',
        // @deprecated `fi-topbar-item-active` has been replaced by `fi-active`.
        'fi-active fi-topbar-item-active' => $active,
    ])
>
    <{{ $tag }}
        @if ($url)
            {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab) }}
        @else
            type="button"
        @endif
        @class([
            'fi-topbar-item-button flex items-center justify-center gap-x-2 rounded-lg px-3 py-2 text-sm font-semibold outline-none transition duration-75 hover:bg-white/5 focus-visible:bg-white/5',
            'text-gray-300' => ! $active,
            'bg-white/5 text-primary-400' => $active,
        ])
    >
        @if ($icon || $activeIcon)
            <x-filament::icon
                :icon="($active && $activeIcon) ? $activeIcon : $icon"
                @class([
                    'fi-topbar-item-icon h-5 w-5',
                    'text-primary-300 dark:text-gray-500' => ! $active,
                    'text-primary-400 dark:text-primary-700' => $active,
                ])
            />
        @endif

        <span
            @class([
                'fi-topbar-item-label font-medium text-sm',
                'text-gray-300 dark:text-gray-600' => ! $active,
                'text-primary-400 dark:text-primary-600' => $active,
            ])
        >
            {{ $slot }}
        </span>

        @if (filled($badge))
            <x-filament::badge
                :color="$badgeColor"
                size="sm"
                :tooltip="$badgeTooltip"
            >
                {{ $badge }}
            </x-filament::badge>
        @endif

        @if (! $url)
            <x-filament::icon
                icon="heroicon-m-chevron-down"
                icon-alias="panels::topbar.group.toggle-button"
                @class([
                    'fi-topbar-group-toggle-icon h-5 w-5',
                    'text-gray-400 dark:text-gray-500' => ! $active,
                    'text-primary-500 dark:text-primary-700' => $active,
                ])
            />
        @endif
    </{{ $tag }}>
</li>
