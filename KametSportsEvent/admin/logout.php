<?php
require_once '../includes/labels.php';
session_start();
unset($_SESSION[SESSION_ALIAS]);
header("Location:" . SITE_URL);