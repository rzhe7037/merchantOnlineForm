<?php 
session_start();

$_SESSION['post-data'] = $_POST;

header('Location: ./view.php');