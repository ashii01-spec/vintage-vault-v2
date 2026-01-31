@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-4 shadow-md font-serif" role="alert">
        <p class="font-bold">System Notification:</p>
        <p>{{ session('success') }}</p>
    </div>
@endif
@if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-4 shadow-md font-serif" role="alert">
        <p class="font-bold">Error:</p>
        <p>{{ session('error') }}</p>
    </div>
@endif