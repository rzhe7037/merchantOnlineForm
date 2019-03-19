<?php
include_once('../config/Database.php');
$database = new Database();
$conn = $database->connect();
$PAYMENT_LENGTH = 11;
$trading_name_msg = $address_msg = $business_type_msg = $owner_name_msg = $owner_mobile_msg = $manager_msg= $pos_msg= $payment_msg=$satisfaction_msg="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // verify user input  
    $verify = true;
    if($_POST['trading_name'] == ""){
        $verify = false;
        $trading_name_msg = "Trading name is required";           
    }


    if($_POST['satisfaction'] == ""){
        $verify = false;
        $satisfaction_msg = "Satisfaction is required";           
    }

    if(!preg_match("/^[a-zA-Z ]*$/",$_POST['owner_name'] )){
        $verify = false;
        $owner_name_msg = "Only letters and white space allowed"; 
    }

    if(!empty($_POST['owner_mobile']) && !preg_match("/^[0-9]{10}$/", $_POST['owner_mobile'])) {
        $verify = false;
        $owner_mobile_msg = "Mobile number is not valid"; 
    }

    if(!empty($_POST['shop_number']) && !preg_match("/^[0-9]{10}$/", $_POST['shop_number'])){
        $verify = false;
        $owner_mobile_msg = "Shop number is not valid";       
    }

    if($_POST['manager_phone'] != "" && !preg_match("/^[0-9]{10}$/", $_POST['manager_phone'])){
        $verify = false;
        $manager_msg .= "Manager mobile number is not valid </br>";       
    }
    
    if($_POST['manager_name'] != "" && !preg_match("/^[a-zA-Z]*$/",$_POST['manager_name'] )){
        $verify = false;
        $manager_msg .= "Manager name only allows  letters and white space </br>"; 
    }

    if(isset($_POST['pos_trigger']) && empty($_POST['pos'])){
        $verify = false;
        $pos_msg = "Pos field is required";       
    }


    // check qr payment field whether are all empty

    if(!isset($_POST['qrpay_trigger'])){
        $QR_payment = "None";
    }
    
    else{
        $QR_payment = "";
        for($index=0; $index< $PAYMENT_LENGTH; $index++){
            $payment =isset($_POST["payment_group".$index]) ? $_POST["payment_group".$index].", " : "";
            $QR_payment.= $payment;
        }
    
        $QR_payment=rtrim($QR_payment,", ");
        if(empty($QR_payment)){
            $verify = false;
            $payment_msg = "Payment field is required";
        }

    }




    if($verify){
         //Create company_address
        
        $address_street = $_POST['address_street_number']." ".$_POST['address_route'];
        $address_suburb = $_POST['address_suburb'];
        $address_postcode = $_POST['address_postcode'];
        $address_state = $_POST['address_state'];


        $query = 'INSERT INTO `company_address` (`address_street`, `address_suburb`, `address_postcode`, `address_state`) VALUES (:address_street,:address_suburb,:address_postcode,:address_state)';
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':address_street',$address_street);
        $stmt->bindParam(':address_suburb',$address_suburb);
        $stmt->bindParam(':address_postcode',$address_postcode);
        $stmt->bindParam(':address_state',$address_state);
        $stmt->execute();
        $company_address_id = $conn->lastInsertId();

        // Create owner_id
        $owner_name = $_POST['owner_name'];
        $owner_mobile = $_POST['owner_mobile'];
        $shop_number = $_POST['shop_number'];
        $manager_name = $_POST['manager_name'];
        $manager_phone = $_POST['manager_phone'];
        $managed_by = isset($_POST['managed_by']) ? "owner" : "manager";

        $query = 'INSERT INTO `company_owner` (`owner_name`, `owner_mobile`, `shop_number`, `managed_by`, `manager_name`,`manager_phone`) VALUES (:owner_name, :owner_mobile, :shop_number, :managed_by, :manager_name,:manager_phone)';
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':owner_name',$owner_name);
        $stmt->bindParam(':owner_mobile',$owner_mobile);
        $stmt->bindParam(':shop_number',$shop_number);
        $stmt->bindParam(':managed_by',$managed_by);
        $stmt->bindParam(':manager_name',$manager_name);
        $stmt->bindParam(':manager_phone',$manager_phone);

        $stmt->execute();
        $owner_id = $conn->lastInsertId();


        // Create company_id
        $pos = "None";
        if(isset($_POST['pos_trigger']) && isset($_POST['pos'])){
            $pos = $_POST['pos'];            
        }

        $satisfaction = $_POST['satisfaction'];
        $comment = $_POST['comment'];

        $query = 'INSERT INTO `company_system` (`pos`, `QR_payment`, `satisfaction`, `comment`) VALUES (:pos, :QR_payment, :satisfaction, :comment)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pos',$pos);
        $stmt->bindParam(':QR_payment',$QR_payment);
        $stmt->bindParam(':satisfaction',$satisfaction);
        $stmt->bindParam(':comment',$comment);

        $stmt->execute();
        $company_id = $conn->lastInsertId();


        // Create business_type_id
        $business_type = isset($_POST['business_type']) ? $_POST['business_type'] : 'None';
        $business_subtype  = (!empty($_POST['business_subtype_other']))?$_POST['business_subtype_other']:$_POST['business_subtype'];


        $query = 'INSERT INTO  `company_business` (`business_type`,`business_subtype`) VALUES(:business_type, :business_subtype)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':business_type',$business_type);
        $stmt->bindParam(':business_subtype',$business_subtype);
   
        $stmt->execute();
        $business_type_id = $conn->lastInsertId();

        // Create company_info

        $trading_name = $_POST['trading_name'];
        $company_name = (isset($_POST['company_name']))?$_POST['company_name']:"";
        $creator = $_POST['username'];
        $nationality = $_POST['nationality'];

        $query = 'INSERT INTO `company_info` (`company_id`, `trading_name`,`company_name`,`company_address_id`, `business_type_id`, `owner_id`,`nationality`,`creator`) VALUES (:company_id, :trading_name, :company_name, :company_address_id, :business_type_id, :owner_id, :nationality, :creator)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':company_id',$company_id);
        $stmt->bindParam(':trading_name',$trading_name);
        $stmt->bindParam(':company_name',$company_name);
        $stmt->bindParam(':company_address_id',$company_address_id);
        $stmt->bindParam(':business_type_id',$business_type_id);
        $stmt->bindParam(':owner_id',$owner_id);
        $stmt->bindParam(':nationality',$nationality);
        $stmt->bindParam(':creator',$creator);
        $stmt->execute();

        echo "<script type='text/javascript'>
        window.location.href = '/ShopInfo/pages/main.php?msg=create_success';
        </script>";
    }


}