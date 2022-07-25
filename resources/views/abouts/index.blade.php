<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Abouts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <a href="{{ route('abouts.create') }}" class="btn-link btn-lg mb-2">+ New About</a>

            @forelse ($abouts as $about)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('abouts.show', $about) }}">{{ $about->title }}</a>
                    </h2>                   
                    <span class="block mt-4 text-sm opacity-70">{{ $about->updated_at->diffForHumans() }}</span>
                </div>
            @empty
            <p>You have no abouts yet.</p>
            @endforelse

            {{ $abouts->links() }}
        </div>
    </div>
</x-app-layout>
