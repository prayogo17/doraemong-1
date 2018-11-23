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

defined('SupianIDz') || die('No direct script access allowed.');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php' ;
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

class Controller
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $tmp = 'attachment';

    /**
     * @param string $db
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct($config)
    {
        $this->config = $config;

        try {
            extract($config['database']);
            $this->pdo = new PDO("mysql:dbname=$database;host=$hostname", $username, $password, array(
                PDO::ATTR_PERSISTENT         => true,
                PDO::ATTR_CASE               => PDO::CASE_LOWER,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_WARNING,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ));
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * @return string
     */
    public function getListCostumers()
    {
        $data = $this->pdo->query(
            'SELECT `job_no`, `company_name`, `date_time` FROM `costumers`'
        )->fetchAll();

        $format = '<tr><td>#%s</td><td>%s</td><td>%s</td>';

        $output = '';
        foreach ($data as $row) {
            $output .= sprintf($format, $row->job_no, $row->company_name, $row->date_time);
        }

        return $output;
    }

    /**
     * @return void
     */
    public function saveNewSubmission()
    {
        foreach ($this->request as $col => $value) {
            $data['`' . $col . '`'] = "'" . addslashes($value) . "'";
        }

        $column = implode(',', array_keys($data));
        $values = implode(',', array_values($data));

        $query = $this->pdo->query("INSERT INTO `costumers` ($column) VALUES ($values)");

        if ($query) {
            $id = $this->pdo->lastInsertId();
            if (!is_dir($tmp = __DIR__ . DIRECTORY_SEPARATOR . $this->tmp . DIRECTORY_SEPARATOR)) {
                mkdir($tmp, 0755, true);
            }

            $attachment = array();

            $signature = md5(uniqid(rand(), true)) . '.png';
            $signature_img = base64_decode(explode(',', $this->signature)[1]);
            if (file_put_contents($attachment[] = $tmp . $signature, $signature_img)) {
                $this->pdo->query(
                    "INSERT INTO `attachments` (`costumer_id`, `file_name`, `type`) VALUES ('$id', '$signature', 'signature')"
                );
            }

            foreach ($this->files['attachment']['tmp_name'] as $i => $tmp_name) {
                $filename = $this->files['attachment']['name'][$i];
                if (move_uploaded_file($tmp_name, $attachment[] = $tmp . $filename)) {
                    $this->pdo->query(
                        "INSERT INTO `attachments` (`costumer_id`, `file_name`, `type`) VALUES ('$id', '$filename', 'attachment')"
                    );
                }
            }

            $this->sendEmail($tmp . $signature, $attachment);
        }
    }

    /**
     * @param  array $attachment
     * @return void
     */
    protected function sendEmail($output_file, $attachment)
    {
        $mail = new PHPMailer;
        try {
            extract($this->config['smtp']);
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $hostname;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = $security;
            $mail->Port = $port;
            $mail->setFrom($sender_email, $sender_name);
           
            $mail->addAddress($recipient_email, $recipient_name);
           
            //Attachments
            
            $mail->AddEmbeddedImage($output_file, 'signature');

            foreach ($attachment as $file) {
                $mail->addAttachment($file);
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            ob_start();
            extract($this->request);
            require __DIR__ . '/template.php';
            $mail->Body = ob_get_clean();
            
            if ($mail->send()) {
                $_SESSION['status'] = 1;
                $_SESSION['message'] = 'Email sent successfully';
                // echo 'Message has been sent';
            }
        } catch (Exception $e) {
            $_SESSION['status'] = 0;
            $_SESSION['message'] = 'Something went wrong, please try again.';
            // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    /**
     * @param array $request
     */
    public function setRequest($request)
    {
        $this->signature = $request['signature'];
        unset($request['signature']);

        // Set Request
        $request['date_time'] = date('Y-m-d H:i:s');
        $this->request = array_map('trim', $request);
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = array_map(function ($file) {
            return $file;
        }, $files);
    }

    /**
     * @return void
     */
    public function redirectBack()
    {
        header('location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
