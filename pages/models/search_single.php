<?php

include_once('../config/Database.php');
$database = new Database();
$conn = $database->connect();
$company_id = (isset($_GET['company_id'])) ?$_GET['company_id']: null;

$query = 'SELECT * FROM company_address NATURAL JOIN company_info NATURAL JOIN company_owner NATURAL JOIN company_business NATURAL JOIN company_system WHERE company_id= :company_id';
$stmt = $conn->prepare($query);
$stmt->bindParam(':company_id',$company_id);
$stmt->execute();
$row = $stmt->fetch();