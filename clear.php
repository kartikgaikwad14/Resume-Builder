<?php
session_start();
unset($_SESSION['resume']);
session_destroy();
header('Location: index.php');
exit;
