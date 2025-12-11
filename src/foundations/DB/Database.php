<?php

namespace Foundations\DB;

use PDO;
use PDOException;

class Database extends PDO
{
    public function __construct() {
        try{
            require_once __DIR__ . '/../../config/database.php';

            if (!$driver || !$host || !$port || !$user || !$pass || !$dbname) {
                abort(500, 'Missing environment variables');
            }

            $dsn = '';

            switch ($driver) {
                case 'pgsql':
                    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
                    break;
                case 'mysql':
                    $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
                    break;
                default:
                    abort(500, 'Invalid database driver');
                    break;
            }

            parent::__construct($dsn, $user, $pass);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
        }catch(PDOException $e){
            abort(500, $e->getMessage());
        }
    }
}