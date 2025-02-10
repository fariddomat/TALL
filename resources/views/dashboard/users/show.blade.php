<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">User Details</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <!-- User Info -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name:</label>
                <p class="text-lg font-semibold">{{ $user->name }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email:</label>
                <p class="text-lg font-semibold">{{ $user->email }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role:</label>
                <p class="text-lg font-semibold">{{ ucfirst($user->roles->first()->name ?? 'No role') }}</p>
            </div>

            <!-- Actions -->
            <div class="mt-4 flex space-x-2">
                <a href="{{ route('dashboard.users.edit', $user->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded shadow hover:bg-yellow-700"  wire:navigate>
                    ✏️ Edit
                </a>
                <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-700" >
                        🗑 Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
