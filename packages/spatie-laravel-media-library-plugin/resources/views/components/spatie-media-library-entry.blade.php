<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    @php
        $records = $getState();
    @endphp
    @foreach ($records as $record)
        <li class="block flex items-center justify-between text-sm">
            <a href="{{ $record->getUrl() }}" target="_blank" class="w-0 flex-1 flex items-center">
                @svg('heroicon-o-paper-clip', 'h-4 w-4 text-gray-400')
                <span class="ml-2 flex-1 w-0 truncate"> {{ $record->file_name }} </span>
            </a>
        </li>
    @endforeach
</x-dynamic-component>
