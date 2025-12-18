<header class="bg-white shadow-md">
    <nav class="container mx-auto flex justify-between items-center py-4">
        <img class="w-[180px]" src="@asset('images/logodigital.png')" alt="LOGO">
        <ul class="flex space-x-8">
        <li><a href="<?php echo route('index', ['id' => 1]) ?>" class="<?php echo page() === '' ? 'text-blue-600' : 'hover:text-blue-600' ?>">Home</a></li>
        <li><a href="<?php echo route('services') ?>" class="<?php echo page() === 'services' ? 'text-blue-600' : 'hover:text-blue-600' ?>">Services</a></li>
        <li><a href="<?php echo route('about') ?>" class="<?php echo page() === 'about' ? 'text-blue-600' : 'hover:text-blue-600' ?>">About us</a></li>
        <li><a href="<?php echo route('contact') ?>" class="<?php echo page() === 'contact' ? 'text-blue-600' : 'hover:text-blue-600' ?>">Contact</a></li>
        </ul>
    </nav>
</header>