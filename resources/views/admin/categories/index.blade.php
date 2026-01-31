<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-vintage-900 leading-tight">
            {{ __('Manage Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-admin-message />

            <div class="bg-vintage-50 border border-vintage-200 shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between mb-6">
                    <h3 class="text-xl font-serif font-bold text-vintage-800">Category List</h3>
                    <a href="{{ route('admin.categories.create') }}" class="btn-vintage text-sm">
                        + New Category
                    </a>
                </div>

                <table class="min-w-full text-left font-serif">
                    <thead class="bg-vintage-200 text-vintage-900 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Artifacts Count</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-vintage-200 bg-white">
                        @foreach($categories as $category)
                        <tr class="hover:bg-vintage-100 transition-colors">
                            <td class="px-6 py-4 font-bold text-vintage-900">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $category->description ?? 'No description' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-vintage-200 text-vintage-800 py-1 px-3 rounded-full text-xs">
                                    {{ $category->products->count() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-3">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>