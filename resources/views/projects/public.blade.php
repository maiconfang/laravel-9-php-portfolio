<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects Public') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse ($projects as $project)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    
                    <h2 class="font-bold text-2xl">
                        <a>{{ $project->title }}</a>
                    </h2>

                    <p class="mt-6 whitespace-pre-wrap">{{ $project->text }}</p>
                   
                </div>
            @empty
            <p>You have no projects yet.</p>
            @endforelse

            {{ $projects->links() }}
        </div>
    </div>
</x-app-layout>
