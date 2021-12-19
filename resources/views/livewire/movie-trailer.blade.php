<div>
    <x-jet-button wire:click="showMovieTrailerModal">{{ $trailer->name }}</x-jet-button>
    <x-jet-dialog-modal wire:model="showMovieEmbedModal">
        <x-slot name="title">{{ $trailer->name }}</x-slot>
        <x-slot name="content">
            <div class="aspect-w-16 aspect-h-9">
                {!! $trailer->embed_html !!}
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="closeMovieTrailerModal" class="bg-gray-600 hover:bg-gray-800 text-white">Cancel
            </x-m-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
