<?php

namespace Foundations\DB;

use PDO;

class Database extends PDO
{
    public function __construct() {
        require_once __DIR__ . '/../../config/database.php';
        parent::__construct("pgsql:host=$host;dbname=$dbname", $user, $pass);
    }
}