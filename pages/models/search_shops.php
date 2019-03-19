<?php

// Initiliz
include_once('../config/Database.php');
include_once('../config/Pagination.php');
include_once('./models/readsession.php');
$db = new Database();
$conn = $db->connect();
$pagination = new Pagination($conn);

$query = "SELECT * FROM company_address NATURAL JOIN company_info NATURAL JOIN company_owner NATURAL JOIN company_business NATURAL JOIN company_system 
          WHERE ".$company_name_condition." AND ".$business_type_condition." AND ".$address_street_condition." AND ".$address_suburb_condition." AND ".$owner_name_condition." AND ".$owner_mobile_condition." AND ".$pos_condition." AND ".$qr_payment_condition." AND ".$business_subtype_condition." AND ".$nationality_condition." AND ".$satisfaction_condition;

$rows = $pagination->queryWithPagination($query,"company_info");

