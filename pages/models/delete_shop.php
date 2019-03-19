<?php
include_once('../../config/Database.php');
$database = new Database();
$conn = $database->connect();

$company_id = isset($_GET['company_id']) ? $_GET['company_id'] : "";

if(empty($company_id)){
    echo "company_id cannot be empty!";
    die();
}    

$query = 'SELECT * FROM company_info WHERE company_id = :company_id';
$stmt = $conn->prepare($query);
$stmt->bindParam(':company_id',$company_id);
$stmt->execute();
$row = $stmt->fetch();
$company_address_id = $row['company_address_id'];
$business_type_id = $row['business_type_id'];
$owner_id = $row['owner_id'];
$trading_name = $row['trading_name'];

if(!empty($row)){
    $query = '  DELETE FROM `company_info` WHERE company_id = :company_id;
                DELETE FROM `company_address` WHERE company_address_id = :company_address_id;
                DELETE FROM `company_business` WHERE business_type_id = :business_type_id;
                DELETE FROM `company_system` WHERE company_id = :company_id;
                DELETE FROM `company_owner` WHERE owner_id = :owner_id;
             ';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':company_id',$company_id);
    $stmt->bindParam(':company_address_id',$company_address_id);
    $stmt->bindParam(':owner_id',$owner_id);
    $stmt->bindParam(':business_type_id',$business_type_id);
    $stmt->execute();
    echo $trading_name . " is deleted";

}
else{
    echo "No such shop exists!";
}
