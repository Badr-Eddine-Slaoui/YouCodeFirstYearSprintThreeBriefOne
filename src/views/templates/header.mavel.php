<header class="bg-white shadow-md">
    <nav class="container mx-auto flex justify-between items-center py-4">
        <img class="w-[180px]" src="@asset('images/logodigital.png')" alt="LOGO">
        <ul class="flex space-x-8">
        <li><a href="@route('index')" class="@page('' ? 'text-blue-600' : 'hover:text-blue-600')">Home</a></li>
        <li><a href="@route('services')" class="@page('services' ? 'text-blue-600' : 'hover:text-blue-600')">Services</a></li>
        <li><a href="@route('about')" class="@page('about' ? 'text-blue-600' : 'hover:text-blue-600')">About us</a></li>
        <li><a href="@route('contact')" class="@page('contact' ? 'text-blue-600' : 'hover:text-blue-600')">Contact</a></li>
        @guest
            <li><a href="@route('signup')" class="@page('signup' ? 'text-blue-600' : 'hover:text-blue-600')">Signup</a></li>
            <li><a href="@route('login')" class="@page('login' ? 'text-blue-600' : 'hover:text-blue-600')">Login</a></li>
        @endguest
        @auth
            <li><a href="@route('profile', ["user" => auth()->user()->id ])" class="@page('profile' ? 'text-blue-600' : 'hover:text-blue-600')">Profile</a></li>
            <li>
                <form action="@route('logout')" method="post">
                    <button type="submit" class="hover:text-blue-600">Logout</button>
                </form>
            </li>
        @endauth
        </ul>
    </nav>
</header>