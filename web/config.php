<?php

if (!session_id()) {
  session_start();
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
$redirect_uri = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/callback.php";
$access_token = isset($_SESSION['access_token']) ? $_SESSION['access_token'] : '';
