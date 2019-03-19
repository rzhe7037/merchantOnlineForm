<?php
// Show all options in <select>
// return $suburbs $$business_types $poses $payments

include_once('../config/Database.php');
$database = new Database();
$conn = $database->connect();


function preload_options($conn,$query,$attribute){

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $rows = $stmt->fetchAll();
    $results=[];
    array_push($results,"<option selected value=''>--select--</option>");
    foreach($rows as $row){
        $value = $row[$attribute];
        if($value !="" ){
            array_push($results,"<option value='".$value."'>".$value."</option>");
        }    
    }
    return $results;
}


// Show All suburb
$query = 'SELECT DISTINCT address_suburb FROM company_address';
$suburbs = preload_options($conn,$query,'address_suburb');


// Show All business type
$query = 'SELECT DISTINCT business_type FROM company_business';
$business_types = preload_options($conn,$query,'business_type');


// Show All pos
$query = 'SELECT DISTINCT pos FROM company_system';
$poses = preload_options($conn,$query,'pos');

// Show All nationality
$query = 'SELECT DISTINCT nationality FROM company_info';
$nationalitys = preload_options($conn,$query,'nationality');



// Show All payments
$query = 'SELECT DISTINCT QR_payment FROM company_system';


$stmt = $conn->prepare($query);
$stmt->execute();

$payments_arrays = $stmt->fetchAll();
$payments=[];
$payments_options=[];

foreach ($payments_arrays as $payments_array){
    foreach( explode(", ",$payments_array['QR_payment']) as $payment){
        array_push($payments,$payment);
    }    
}

$payments = array_unique($payments);

array_push($payments_options,"<option selected value=''>--select--</option>");
foreach($payments as $payment){
    $value = $payment;
    if($value !="" ){
        array_push($payments_options,"<option value='".$value."'>".$value."</option>");
    }    
}

