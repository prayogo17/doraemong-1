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

/**
 * Security For Direct Access
 */
define('SupianIDz', 'Yeah');

session_start();

require 'controller.php';

$config['database'] = array(
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => 'secret',
	'database' => 'form'
);

$config['smtp'] = array(
	// Server Settings
	'hostname'        => 'smtp.gmail.com',
	'username'        => 'email@gmail.com',
	'password'        => 'secret',
	'security'        => 'tls',
	'port'            => 587,
	
	// Detail sender
	'sender_email'    => 'supianidz@gmail.com',
	'sender_name'     => 'Supian M',
	
	// Detail Recipient
	'recipient_email' => 'privcodes@gmail.com',
	'recipient_name'  => 'Supian M',
	
	// Subject
	'subject'         => 'Email Subject'
);

$controller = new Controller($config);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo $controller->getListCostumers();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->setFiles($_FILES);
    $controller->setRequest($_POST);
    $controller->saveNewSubmission();

    $controller->redirectBack();
}
