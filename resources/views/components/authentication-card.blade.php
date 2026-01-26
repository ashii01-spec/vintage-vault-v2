<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-vintage-900 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none" 
             style="background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');">
    </div>
    <div class="relative z-10">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-vintage-50 border border-vintage-100 shadow-xl overflow-hidden sm:rounded-lg relative z-10">
        {{ $slot }}
    </div>
</div>
