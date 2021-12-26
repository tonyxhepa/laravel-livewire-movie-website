<x-front-layout>
    @if (!empty($episode))
        <main class="my-2">
            <section class="bg-gradient-to-r from-indigo-700 to-transparent">
                <div class="max-w-6xl mx-auto m-4 p-2">
                    <div class="flex">
                        <div class="w-3/12">
                            <div class="w-full">
                                <img class="w-full h-full rounded"
                                    src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $episode->season->poster_path }}">
                            </div>
                        </div>
                        <div class="w-8/12">
                            <div class="m-4 p-6">
                                <h1 class="flex text-white font-bold text-4xl">{{ $episode->name }}</h1>
                                <div class="flex p-3 text-white space-x-4">
                                    <span>{{ $episode->season->name }}</span>

                                </div>
                                <div class="flex space-x-4">
                                    @foreach ($episode->trailers as $trailer)
                                        <livewire:movie-trailer :trailer="$trailer"></livewire:movie-trailer>
                                    @endforeach
                                </div>
                            </div>
                            <div class="p-8 text-white">
                                <p>{{ $episode->overview }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="max-w-6xl mx-auto bg-gray-200 dark:bg-gray-900 p-2 rounded">

                <div class="w-4/12">
                    <h1 class="flex text-white font-bold text-xl">Latest episodes</h1>
                    <div class="grid grid-cols-3 gap-2">
                        @if (!empty($latest))
                            @foreach ($latest as $lepisode)
                                <a href="{{ route('movies.show', $lepisode->slug) }}">
                                    <img class="w-full h-full rounded-lg"
                                        src="https://www.themoviedb.org/t/p/w220_and_h330_face/{{ $lepisode->season->poster_path }}">
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
                </div>
            </section>
        </main>
    @endif

</x-front-layout>
