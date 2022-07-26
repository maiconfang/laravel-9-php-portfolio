<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Itens') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <a href="{{ route('aboutItens.create') }}" class="btn-link btn-lg mb-2">+ New About Itens</a>

            @forelse ($aboutItens as $aboutIten)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('aboutItens.show', $aboutIten) }}">{{ $aboutIten->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ Str::limit($aboutIten->text, 200) }}
                    </p>
                    <span class="block mt-4 text-sm opacity-70">{{ $aboutIten->updated_at->diffForHumans() }}</span>
                </div>
            @empty
            <p>You have no about itens yet.</p>
            @endforelse

            {{ $aboutItens->links() }}
        </div>
    </div>
</x-app-layout>
