{{-- How you use --}}
{{--
<x-table
    :columns="['name', 'email', 'created_at']"
    :data="$users"
    :show="true"
    :routePrefix=""
    :edit="true"
    :delete="true"
/>
--}}



@props([
    'columns' => [],
    'data' => [],
    'routePrefix' => '',
    'show' => false,
    'edit' => false,
    'delete' => false,
])

<div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="w-full border-collapse">
        <!-- Table Head -->
        <thead class="bg-gray-900 text-white">
            <tr>
                @foreach ($columns as $col)
                    <th class="px-4 py-2 border border-gray-300 text-left">
                        {{ ucfirst(str_replace('_', ' ', $col)) }}
                    </th>
                @endforeach
                @if ($show || $edit || $delete)
                    <th class="px-4 py-2 border border-gray-300 text-center">Actions</th>
                @endif
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($data as $row)
                <tr class="hover:bg-gray-50">
                    @foreach ($columns as $col)
                        <td class="px-4 py-2 border border-gray-300">
                            {{ is_object($row) ? $row->$col : $row[$col] ?? '—' }}
                        </td>
                    @endforeach

                    @if ($show || $edit || $delete)
                        <td class="px-4 py-2 border border-gray-300 text-center">
                            <div class="flex justify-center space-x-2">
                                @if ($show)
                                    <a href="{{ route($routePrefix.'.show', $row->id) }}" class="text-blue-500 hover:text-blue-700"  wire:navigate>
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if ($edit)
                                    <a href="{{ route($routePrefix.'.edit', $row->id) }}" class="text-yellow-500 hover:text-yellow-700"  wire:navigate>
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if ($delete)
                                    <form action="{{ route($routePrefix.'.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
