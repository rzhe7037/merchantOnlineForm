<?php
include_once('./models/search_single.php');
$PAYMENT_LENGTH = 11;
$trading_name_msg = $address_msg = $business_type_msg = $owner_name_msg = $owner_mobile_msg = $manager_msg= $pos_msg= $payment_msg=$satisfaction_msg="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pageGet = empty($_POST['page']) ?"" : $_POST['page'];
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
        $company_address_id = $_POST['company_address_id'];

        

        $query = 'UPDATE `company_address` SET `address_street`=:address_street,`address_suburb`=:address_suburb,`address_postcode`=:address_postcode,`address_state`=:address_state WHERE `company_address_id`=:company_address_id';
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':address_street',$address_street);
        $stmt->bindParam(':address_suburb',$address_suburb);
        $stmt->bindParam(':address_postcode',$address_postcode);
        $stmt->bindParam(':address_state',$address_state);
        $stmt->bindParam(':company_address_id',$company_address_id);
        $stmt->execute();


        // Create owner_id
        $owner_name = $_POST['owner_name'];
        $owner_mobile = $_POST['owner_mobile'];
        $shop_number = $_POST['shop_number'];
        $manager_name = $_POST['manager_name'];
        $manager_phone = $_POST['manager_phone'];
        $owner_id = $_POST['owner_id'];

        if(isset($_POST['managed_by']))
        {
            $managed_by = "owner";
        }
        else{
            $managed_by = "manager";
        }

        $query = 'UPDATE `company_owner` SET `owner_name`=:owner_name,`owner_mobile`=:owner_mobile,`shop_number`=:shop_number,`managed_by`=:managed_by,`manager_name`=:manager_name,`manager_phone`=:manager_phone WHERE `owner_id`=:owner_id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':owner_name',$owner_name);
        $stmt->bindParam(':owner_mobile',$owner_mobile);
        $stmt->bindParam(':shop_number',$shop_number);
        $stmt->bindParam(':managed_by',$managed_by);
        $stmt->bindParam(':manager_name',$manager_name);
        $stmt->bindParam(':manager_phone',$manager_phone);
        $stmt->bindParam(':owner_id',$owner_id);
        

        $stmt->execute();
        


        // Create company_id
        $pos = "None";
        if(isset($_POST['pos_trigger']) && isset($_POST['pos'])){
            $pos = $_POST['pos'];            
        }

        $satisfaction = $_POST['satisfaction'];
        $comment = $_POST['comment'];
        $company_id = $_POST['company_id'];

        $query = 'UPDATE `company_system` SET `pos`=:pos,`QR_payment`=:QR_payment,`satisfaction`=:satisfaction,`comment`=:comment WHERE `company_id`=:company_id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':pos',$pos);
        $stmt->bindParam(':QR_payment',$QR_payment);
        $stmt->bindParam(':satisfaction',$satisfaction);
        $stmt->bindParam(':comment',$comment);
        $stmt->bindParam(':company_id',$company_id);
        $stmt->execute();



        // Create business_type_id
        $business_type = $_POST['business_type'];

        $business_subtype  = (!empty($_POST['business_subtype_other']))?$_POST['business_subtype_other']:$_POST['business_subtype'];

        $business_type_id = $_POST['business_type_id'];


        $query = 'UPDATE `company_business` SET `business_type` = :business_type, `business_subtype` = :business_subtype WHERE `business_type_id` = :business_type_id';

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':business_type',$business_type);
        $stmt->bindParam(':business_subtype',$business_subtype);
        $stmt->bindParam(':business_type_id',$business_type_id);
        $stmt->execute();

        // Update company_info

        $trading_name = $_POST['trading_name'];
        $company_name = $_POST['company_name'];
        $creator = $_POST['username'];
        $nationality = $_POST['nationality'];

        $query = 'UPDATE `company_info` SET `trading_name`=:trading_name,`company_name`=:company_name,`nationality`=:nationality,`creator`=:creator,`business_type_id`=:business_type_id WHERE company_id=:company_id';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':company_id',$company_id);
        $stmt->bindParam(':trading_name',$trading_name);
        $stmt->bindParam(':company_name',$company_name);
        $stmt->bindParam(':nationality',$nationality);
        $stmt->bindParam(':creator',$creator);
        $stmt->bindParam(':business_type_id',$business_type_id);
        $stmt->execute();        

        
        echo "<script type='text/javascript'>
        window.location.href = '/ShopInfo/pages/view_single.php?company_id=".$_POST['company_id'].$pageGet."&&msg=edit_success'</script>";
    
    }
    
   
    $total_error_msg = $trading_name_msg."</br>".$pos_msg."</br>". $payment_msg ."</br>". $satisfaction_msg;
    echo "<script type='text/javascript'>
    window.location.href = '/ShopInfo/pages/view_single.php?company_id=".$_POST['company_id']."&&msg=edit_fail&&msg_info=".$total_error_msg."'</script>";



}