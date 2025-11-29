<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol']    = 'smtp';
$config['smtp_host']   = 'smtp.dreamhost.com';
$config['smtp_port']   = 587; // or 465 if SSL
$config['smtp_user']   = $_ENV['EMAIL'];
$config['smtp_pass']   = $_ENV['SMTP_PASS'];
$config['smtp_crypto'] = 'tls'; // use 'ssl' if you set port 465
$config['mailtype']    = 'html';
$config['charset']     = 'utf-8';
$config['newline']     = "\r\n";
