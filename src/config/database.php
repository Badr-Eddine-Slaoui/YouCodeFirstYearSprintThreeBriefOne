<?php

$host = getenv('POSTGRES_HOST');
$user = getenv('POSTGRES_USER');
$pass = getenv('POSTGRES_PASSWORD');
$dbname = getenv('POSTGRES_DB');

if (!$host || !$user || !$pass || !$dbname) {
    die("Missing environment variables");
}