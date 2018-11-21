<?php

/**
 *   ___       _
 *  / _ \  ___| |_ ___  _ __  _   _
 * | | | |/ __| __/ _ \| '_ \| | | |
 * | |_| | (__| || (_) | |_) | |_| |
 *  \___/ \___|\__\___/| .__/ \__, |
 *                     |_|    |___/
 * @author  : Supian M <supianidz@gmail.com>
 * @version : v1.0
 * @license : MIT
 */

class Controller extends PDO
{
    /**
     * @param string $db
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct($db, $host, $username, $password)
    {
        try {
            parent::__construct("mysql:dbname=$db;host=$host", $username, $password);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * @param array $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}


$controller = new Controller('yogo', 'localhost', 'root', 'exploded');
$controller->setRequest(!empty($_POST) ? $_POST : $_GET);


