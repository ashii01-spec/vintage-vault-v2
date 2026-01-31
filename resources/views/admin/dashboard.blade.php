<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl font-serif text-vintage-900 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin-message />
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Manage Artifacts -->
                <div class="bg-white border border-vintage-200 overflow-hidden shadow-xl sm:rounded-lg p-6 hover:shadow-2xl transition-shadow cursor-pointer" onclick="window.location='{{ route('admin.products.index') }}'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold font-serif text-vintage-800">Manage Artifacts</h3>
                        <svg class="w-8 h-8 text-vintage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Add, edit, or delete vintage artifacts from the catalog.</p>
                    <a href="{{ route('admin.products.index') }}" class="text-vintage-700 font-bold hover:underline">Go to Artifacts &rarr;</a>
                </div>

                <!-- Manage Categories -->
                <div class="bg-white border border-vintage-200 overflow-hidden shadow-xl sm:rounded-lg p-6 hover:shadow-2xl transition-shadow cursor-pointer" onclick="window.location='{{ route('admin.categories.index') }}'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold font-serif text-vintage-800">Manage Categories</h3>
                        <svg class="w-8 h-8 text-vintage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Organize artifacts into different categories.</p>
                    <a href="{{ route('admin.categories.index') }}" class="text-vintage-700 font-bold hover:underline">Go to Categories &rarr;</a>
                </div>

                <!-- Manage Users -->
                <div class="bg-white border border-vintage-200 overflow-hidden shadow-xl sm:rounded-lg p-6 hover:shadow-2xl transition-shadow cursor-pointer" onclick="window.location='{{ route('admin.users.index') }}'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold font-serif text-vintage-800">Manage Users</h3>
                        <svg class="w-8 h-8 text-vintage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">View and manage registered users, sellers, and admins.</p>
                    <a href="{{ route('admin.users.index') }}" class="text-vintage-700 font-bold hover:underline">Go to Users &rarr;</a>
                </div>
            </div>
            
            <div class="mt-8 bg-vintage-50 border border-vintage-200 p-6 rounded-lg">
                <h3 class="text-lg font-bold font-serif text-vintage-900 mb-2">Welcome Back, Admin!</h3>
                <p class="text-gray-600">This is your command center. Use the cards above to manage the Vintage Vault content. Ensure everything is in order for the best user experience.</p>
            </div>
        </div>
    </div>
</x-app-layout>
