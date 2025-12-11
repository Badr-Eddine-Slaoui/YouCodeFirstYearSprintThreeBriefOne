<?php

$driver = getenv('DATABASE_DRIVER') ?? 'pgsql';
$host = getenv('DATABASE_HOST') ?? 'localhost';
$port = getenv('DATABASE_PORT') ?? 5432;
$user = getenv('DATABASE_USER') ?? 'mavel';
$pass = getenv('DATABASE_PASSWORD') ?? 'mavel';
$dbname = getenv('DATABASE_NAME') ?? 'mavel';