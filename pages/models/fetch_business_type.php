<?php

include_once('../config/Database.php');
$database = new Database();
$conn = $database->connect();


$query = 'SELECT DISTINCT business_type FROM company_business_lookup';
$stmt = $conn->prepare($query);
$stmt->execute();

$rows = $stmt->fetchAll();
$business_types=["<option value=''>--select--</option>"];
foreach($rows as $row){
    array_push($business_types,"<option value=".$row['business_type'].">".$row['business_type']."</option>");
}

