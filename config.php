<?php

if (!session_id()) {
  session_start();
}

$redirect_uri = 'http://localhost:8000/callback.php';
