<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    @foreach ($getChildComponentContainers() as $container)
        @php
            $record = $container->getRecord();
        @endphp

        <li class="block flex items-center justify-between text-sm">
            <div class="w-0 flex-1 flex items-center">
                <x-heroicon-o-paper-clip class="h-5 w-5 text-gray-400" />
                <span class="ml-2 flex-1 w-0 truncate"> {{ $record->file_name }} </span>
            </div>
            <div class="ml-4 flex items-center space-x-1 flex-shrink-0">
                <a href="{{ $record->getUrl() }}" target="_blank" class="text-primary-600 hover:bg-primary-600 hover:text-white rounded-md p-0.5 transition">
                    <x-heroicon-o-eye class="h-5 w-5" />
                </a>
                <a href="{{ route('download.media', $record) }}" class="text-primary-600 hover:bg-primary-600 hover:text-white rounded-md p-0.5 transition">
                    <x-heroicon-o-cloud-arrow-down class="h-5 w-5" />
                </a>
            </div>
        </li>
    @endforeach
</x-dynamic-component>
