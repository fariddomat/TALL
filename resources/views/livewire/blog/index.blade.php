<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <div class="p-4">
        <!-- Search and Filter -->
        <div class="flex space-x-4">
            <input type="text" wire:model="search" placeholder="Search blogs..." class="p-2 border rounded" />
            <select wire:model="category" class="p-2 border rounded">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="w-full border-collapse">
        <thead class="bg-gray-900 text-white">
            <tr>
                <th class="px-4 py-2 border text-left">Title</th>
                <th class="px-4 py-2 border text-left">Category</th>
                <th class="px-4 py-2 border text-left">Slug</th>
                <th class="px-4 py-2 border text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td class="px-4 py-2 border">{{ $blog->title }}</td>
                    <td class="px-4 py-2 border">{{ $blog->category->name }}</td>
                    <td class="px-4 py-2 border">{{ $blog->slug }}</td>
                    <td class="px-4 py-2 border text-center">
                        <a href="{{ route('dashboard.blogs.edit', $blog->id) }}" class="text-yellow-500">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.blogs.destroy', $blog->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="p-4">
        {{ $blogs->links() }}
    </div>
</div>
