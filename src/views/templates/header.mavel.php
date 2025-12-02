<header class="bg-white shadow-md">
    <nav class="container mx-auto flex justify-between items-center py-4">
        <h1 class="text-2xl font-bold text-blue-600">DigitalWave</h1>
        <ul class="flex space-x-6">
        <li><a href="<?php echo route('index') ?>" class="<?php echo page() === '' ? 'text-blue-600' : 'hover:text-blue-600' ?>">Accueil</a></li>
        <li><a href="<?php echo route('services') ?>" class="<?php echo page() === 'services' ? 'text-blue-600' : 'hover:text-blue-600' ?>">Services</a></li>
        <li><a href="<?php echo route('about') ?>" class="<?php echo page() === 'about' ? 'text-blue-600' : 'hover:text-blue-600' ?>">À propos</a></li>
        <li><a href="<?php echo route('contact') ?>" class="<?php echo page() === 'contact' ? 'text-blue-600' : 'hover:text-blue-600' ?>">Contact</a></li>
        </ul>
    </nav>
</header>