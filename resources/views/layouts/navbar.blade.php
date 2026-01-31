<nav class="bg-vintage-900 text-white shadow-md relative">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none" 
             style="background-image: url('https://www.transparenttextures.com/patterns/aged-paper.png');">
        </div>
        <div class="container mx-auto flex justify-between items-center relative z-10 p-4">
            <div class="text-2xl font-serif font-bold tracking-wider">
                <img src="./images/logo.png" alt="logo" class="w-12 h-12 inline-block mr-2">
                <a href="/">VINTAGE VAULT</a>
            </div>
            <div class="hidden md:flex space-x-8 font-serif ">
                <a href="/" class="hover:text-vintage-100">HOME</a>
                <a href="{{ route('shop') }}" class="hover:text-vintage-100">SHOP</a>
                <a href="{{ route('gallery') }}" class="hover:text-vintage-100">GALLERY</a>
                <a href="#" class="hover:text-vintage-100">CONTACT US</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('cart') }}" class="hover:text-vintage-100 font-bold">CART</a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-sm hover:text-vintage-100 focus:outline-none">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-vintage-900 border border-vintage-700 rounded shadow-lg py-1 z-50">
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-sm hover:bg-vintage-800">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-vintage-800">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm border border-white px-3 py-1 rounded">Register</a>
                @endauth
            </div>
        </div>
    </nav>