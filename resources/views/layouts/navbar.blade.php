<nav class="bg-vintage-900 text-white shadow-md relative overflow-hidden">
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
                <a href="#" class="hover:text-vintage-100">GALLERY</a>
                <a href="#" class="hover:text-vintage-100">CONTACT US</a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('cart') }}" class="hover:text-vintage-100 font-bold">CART</a>
                    <a href="{{ url('/dashboard') }}" class="text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm border border-white px-3 py-1 rounded">Register</a>
                @endauth
            </div>
        </div>
    </nav>