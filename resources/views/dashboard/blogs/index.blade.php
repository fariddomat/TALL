<x-app-layout>


    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Blogs</h1>
        <a href="{{ route('dashboard.blogs.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded shadow"
            wire:navigate>➕ Add Blog</a>

        <div class="overflow-x-auto mt-4">
            <livewire:blog.index />
        </div>
    </div>
</x-app-layout>
