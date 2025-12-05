<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DigitalWave Solutions - À propos</title>
    <link rel="stylesheet" href="@asset('css/app.css')">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body class="bg-white text-gray-800">

    @view('templates.header')
    <div class="w-full min-h-screen">
        @yield('content')
    </div>
    @view('templates.footer')
</body>

</html>