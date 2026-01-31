@include('layouts.navbar')
<x-guest-layout>
    <!-- Main Wrapper -->
    <div class="bg-vintage-100 min-h-screen py-16">
        
        <!-- Header Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-vintage-900 uppercase tracking-widest">
                Connect with the Vault
            </h1>
            <p class="mt-4 text-xl font-serif italic text-vintage-800 opacity-80 decoration-vintage-500">
                "Your inquiries are part of our history. Send us a message."
            </p>
            <div class="w-32 h-1 bg-vintage-900 mx-auto mt-6"></div>
        </div>

        <!-- Content Container -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-2xl overflow-hidden flex flex-col md:flex-row">
                
                <!-- Left Column: Contact Info (Dark Vintage Theme) -->
                <div class="w-full md:w-1/2 bg-vintage-900 text-vintage-50 p-10 md:p-12 relative">
                    <!-- Texture Overlay -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none" 
                         style="background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');">
                    </div>

                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl font-serif font-bold uppercase tracking-widest mb-10 border-b border-vintage-700 pb-4">
                                Contact Information
                            </h2>
                            
                            <div class="space-y-8 font-serif">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10">
                                        <svg class="w-6 h-6 text-vintage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-lg mb-1">The Vintage Vault HQ</p>
                                        <p class="opacity-80 leading-relaxed">123 Antiquity Lane, History District<br>London, UK - VV2 4VL</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10">
                                        <svg class="w-6 h-6 text-vintage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-lg mb-1">Electronic Dispatch</p>
                                        <p class="opacity-80">curator@vintage-vault.com</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-10">
                                        <svg class="w-6 h-6 text-vintage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-lg mb-1">Telephone</p>
                                        <p class="opacity-80">+44 20 7946 0124</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <h3 class="text-sm font-bold uppercase tracking-widest text-vintage-500 mb-2">Curatorial Hours</h3>
                            <p class="text-sm opacity-60 font-serif italic">
                                Mon - Sat: 9:00 AM - 6:00 PM <br>
                                Closed Sundays & Holidays
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Form (Light Theme) -->
                <div class="w-full md:w-1/2 bg-white p-10 md:p-12 relative">
                    <!-- Texture Overlay -->
                     <div class="absolute inset-0 opacity-5 pointer-events-none" 
                         style="background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');">
                    </div>

                    <div class="relative z-10">
                         <h2 class="text-2xl font-serif font-bold text-vintage-900 uppercase tracking-widest mb-10 border-b border-vintage-200 pb-4">
                            Send a Dispatch
                        </h2>

                        <form action="#" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-vintage-900 mb-2">Full Name</label>
                                    <input type="text" class="w-full bg-vintage-50 border border-gray-300 text-vintage-900 px-4 py-3 rounded focus:outline-none focus:ring-2 focus:ring-vintage-500 focus:border-transparent transition-all" placeholder="Enter your name">
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-vintage-900 mb-2">Email Address</label>
                                    <input type="email" class="w-full bg-vintage-50 border border-gray-300 text-vintage-900 px-4 py-3 rounded focus:outline-none focus:ring-2 focus:ring-vintage-500 focus:border-transparent transition-all" placeholder="Enter your email">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-vintage-900 mb-2">Subject</label>
                                    <select class="w-full bg-vintage-50 border border-gray-300 text-vintage-900 px-4 py-3 rounded focus:outline-none focus:ring-2 focus:ring-vintage-500 focus:border-transparent transition-all">
                                        <option>General Inquiry</option>
                                        <option>Valuation Request</option>
                                        <option>Purchase Assistance</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-vintage-900 mb-2">Message</label>
                                    <textarea rows="4" class="w-full bg-vintage-50 border border-gray-300 text-vintage-900 px-4 py-3 rounded focus:outline-none focus:ring-2 focus:ring-vintage-500 focus:border-transparent transition-all" placeholder="Write your message here..."></textarea>
                                </div>
                            </div>

                            <button type="button" class="w-full bg-vintage-900 text-vintage-50 font-bold uppercase tracking-widest py-4 rounded hover:bg-vintage-800 transition-colors shadow-lg mt-4">
                                Seal & Send
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    @include('layouts.footer')
</x-guest-layout>
