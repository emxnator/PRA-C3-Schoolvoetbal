<x-base-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <p class="text-gray-600">Bekijk alle afgelopen toernooien</p>
            </div>

            @if($tournaments->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <p class="text-gray-500 text-lg">Er zijn nog geen gearchiveerde toernooien.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tournaments as $tournament)
                        <a href="{{ route('tournaments.show', $tournament) }}" class="block">
                            <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                                <div class="bg-gradient-to-r from-gray-500 to-gray-700 p-6">
                                    <h3 class="text-2xl font-bold text-white">{{ $tournament->name }}</h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-base-layout>
