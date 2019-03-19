<?php

// where
$company_name_condition= (isset($_SESSION['post-data']['company_name']) && !empty($_SESSION['post-data']['company_name'])) ? "trading_name='".$_SESSION['post-data']['company_name']."'":1;
$business_type_condition = (isset($_SESSION['post-data']['business_type']) && !empty($_SESSION['post-data']['business_type']) && $_SESSION['post-data']['business_type'] !== "--select--") ? "business_type='".$_SESSION['post-data']['business_type']."'":1;
$business_subtype_condition = (isset($_SESSION['post-data']['business_subtype']) && !empty($_SESSION['post-data']['business_subtype']) && $_SESSION['post-data']['business_subtype'] !== "--select--") ? "business_subtype='".$_SESSION['post-data']['business_subtype']."'":1;
$nationality_condition = (isset($_SESSION['post-data']['nationality']) && !empty($_SESSION['post-data']['nationality'])) ? "nationality='".$_SESSION['post-data']['nationality']."'":1;
$address_street_condition = (isset($_SESSION['post-data']['address_street']) && !empty($_SESSION['post-data']['address_street']))? "address_street='".$_SESSION['post-data']['address_street']."'":1;
$address_suburb_condition = (isset($_SESSION['post-data']['address_suburb']) && !empty($_SESSION['post-data']['address_suburb'] && $_SESSION['post-data']['address_suburb'] !== "--select--"))  ? "address_suburb='".$_SESSION['post-data']['address_suburb']."'":1;
$owner_name_condition = (isset($_SESSION['post-data']['owner_name']) && !empty($_SESSION['post-data']['owner_name'])) ? "owner_name='".$_SESSION['post-data']['owner_name']."'":1;
$owner_mobile_condition = (isset($_SESSION['post-data']['owner_mobile']) && !empty($_SESSION['post-data']['owner_mobile'])) ? "owner_mobile='".$_SESSION['post-data']['owner_mobile']."'":1;
$pos_condition = (isset($_SESSION['post-data']['pos']) && !empty($_SESSION['post-data']['pos']) && $_SESSION['post-data']['pos'] !== "--select--") ? "pos='".$_SESSION['post-data']['pos']."'":1;
$qr_payment_condition= (isset($_SESSION['post-data']['QR_payment']) && !empty($_SESSION['post-data']['QR_payment'])) ? "QR_payment LIKE '%".$_SESSION['post-data']['QR_payment']."%'":1;
$satisfaction_condition= (isset($_SESSION['post-data']['satisfaction']) && !empty($_SESSION['post-data']['satisfaction'])) ? "satisfaction LIKE '%".$_SESSION['post-data']['satisfaction']."%'":1;


//select
$attributes = [];
$attributes['address_suburb'] = (isset($_SESSION['post-data']['attribute_address_suburb'])) ?'active':'disabled';
$attributes['address_street'] = (isset($_SESSION['post-data']['attribute_address_street'])) ?'active':'disabled';
$attributes['owner_name'] = (isset($_SESSION['post-data']['attribute_owner_name'])) ?'active':'disabled';
$attributes['owner_mobile'] = (isset($_SESSION['post-data']['attribute_owner_mobile'])) ?'active':'disabled';
$attributes['pos'] = (isset($_SESSION['post-data']['attribute_pos'])) ?'active':'disabled';
$attributes['QR_payment'] = (isset($_SESSION['post-data']['attribute_QR_payment'])) ?'active':'disabled';
$attributes['business_type'] = (isset($_SESSION['post-data']['attribute_business_type'])) ?'active':'disabled';
$attributes['business_subtype'] = (isset($_SESSION['post-data']['attribute_business_subtype'])) ?'active':'disabled';
$attributes['nationality'] = (isset($_SESSION['post-data']['attribute_nationality'])) ?'active':'disabled';
$attributes['satisfaction'] = (isset($_SESSION['post-data']['attribute_satisfaction'])) ?'active':'disabled';