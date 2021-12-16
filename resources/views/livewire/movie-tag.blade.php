<div>
    <div class="w-full m-2">
        @forelse ($movie->tags as $mtag)
            <x-jet-button wire:click="detachTag({{ $mtag->id }})" class="hover:bg-red-500">{{ $mtag->tag_name }}
            </x-jet-button>
        @empty
            No Tags
        @endforelse
    </div>
    <input wire:model="queryTag" type="text" class="rounded w-full" placeholder="Search Tag">
    @if (!empty($queryTag))
        <div class="w-full">
            @if (!empty($tags))
                @foreach ($tags as $tag)
                    <div wire:click="addTag({{ $tag->id }})"
                        class="w-full p-2 m-2 bg-green-300 hover:bg-green-400 cursor-pointer">
                        {{ $tag->tag_name }}</div>
                @endforeach
            @endif
        </div>
    @endif
</div>
