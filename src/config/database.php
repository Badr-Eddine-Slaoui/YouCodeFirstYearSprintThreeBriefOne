<?php

$host = getenv('POSTGRES_HOST');
$user = getenv('POSTGRES_USER');
$pass = getenv('POSTGRES_PASSWORD');
$dbname = getenv('POSTGRES_DB');

if (!$host || !$user || !$pass || !$dbname) {
    abort(500, 'Missing environment variables');
}

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    show_error_view($e);
}