<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DigitalWave Solutions - Debug</title>
    <link rel="stylesheet" href="<?= asset("css/app.css") ?>">
</head>

<body class="bg-gray-50 text-gray-800">

    <?php view('templates.header'); ?>
    <section class="container mx-auto py-16">
        <h2 class="text-3xl font-bold mb-6 text-center">Exception</h2>
        <p class="text-gray-700 text-lg leading-8 text-center max-w-3xl mx-auto">
            <?php echo $e->getMessage() ?>
        </p>
        <p class="text-gray-700 text-lg leading-8 text-center max-w-3xl mx-auto">
            <?php echo $e->getLine() ?>
        </p>
        <p class="text-gray-700 text-lg leading-8 text-center max-w-3xl mx-auto">
            <?php echo $e->getFile() ?>
        </p>
        <p class="text-gray-700 text-lg leading-8 text-center max-w-3xl mx-auto">
            <?php echo $e->getTraceAsString() ?>
        </p>
        <p class="text-gray-700 text-lg leading-8 text-center max-w-3xl mx-auto">
            Veuillez retourner sur la page d'accueil.
        </p>
        <p class="text-gray-700 text-lg leading-8 text-center max-w-3xl mx-auto">
            <a href="<?php echo route('index') ?>" class="text-blue-600 hover:underline">Accueil</a>
        </p>
    </section>
    <?php view('templates.footer'); ?>
    
</body>

</html>