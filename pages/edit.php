<?php include_once('./header.php') ?>
<?php include_once('./models/fetch_business_type.php') ?>
<?php include_once('./models/update_shop.php') ?>
<?php include_once("session_checker.php")?>


<style>
    .star{
      color:red;
    }
    .btn a{
        color: white;
    }
    .msg{
        color: red;
        margin-left: 30px;
    }
    .divider {
        height: 1px;
        width:100%;
        display:block; /* for use on default inline elements like span */
        margin: 9px 0;
        overflow: hidden;
        background-color: #e5e5e5;
    }
    #managedBy ,#qrpay_trigger, #pos_trigger{
        width: 20px;
        height: 20px;
        margin: 10px;
    }

    #address{
        display:none;
    }
    #autocomplete,#locationField{
        width: 100%;
    }
    #street_number{
        max-width:30% !important;
    }

    #business_type_select{
        width:0%;
        margin-left:auto;
    }

    .business_select{
        width:12%;
        margin-left:auto;
    }
    *{
        color: #505458;
        font-size: 14px;
    }


    #QR_pay_bar,#pos_bar{
        padding: 5px;
        border: 1px solid #c9c9c9;
    }

    .col-4{
        padding-right: 5px !important;
    }

    .form-label{
        width: 80%;
    }

    .other_payment{
        height:25px;
        width: 70%;
    }

    #pos-select-box, #other_pos_textbox{
        width: 200px;
    }

</style>

<script>
    function updateSubType() {
        var business_type = document.getElementById('business_type').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById('business_subtype').innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("GET", "/ShopInfo/pages/models/fetch_business_subtype.php?business_type=" + business_type, true);
        xhttp.send();

    }


    function toggleOtherSubBar(){
        document.getElementById('other_sub_bar').style.display="block";
    }
    function toggleManagerInput() {
        if (document.getElementById("managedBy").checked == false) {
            document.getElementById("manager_bar").style.display = "block";
        }
        else if (document.getElementById("managedBy").checked == true) {
            document.getElementById("manager_bar").style.display = "none";
        }

    }

    function togglePosInput() {
        if (document.getElementById("pos_trigger").checked == false) {
            document.getElementById("pos_bar").style.display = "none";
        }
        else if (document.getElementById("pos_trigger").checked == true) {
            document.getElementById("pos_bar").style.display = "block";
        }

    }

    function toggleQRpayInput() {
        if (document.getElementById("qrpay_trigger").checked == false) {
            document.getElementById("QR_pay_bar").style.display = "none";
        }
        else if (document.getElementById("qrpay_trigger").checked == true) {
            document.getElementById("QR_pay_bar").style.display = "block";
        }

    }

    function updateBusinessType(e){
        $business_type = document.getElementById("business_type");
        $business_type.value = e.target.value;
    }

    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


</script>
    
<script >
    window.onload = function(e){
        const PAYMENT_NUMBER = 11;


        var nationality = '<?php echo $row['nationality']?>';    
        var nationality_options = document.getElementsByName('nationality')[0].children;
        for (i = 0; i < nationality_options.length; i++) {
            if (nationality_options[i].value == nationality) {
                nationality_options[i].selected = true;
            }
        }

        var business_type = '<?php echo $row['business_type']?>';
        var business_type_select = document.getElementsByName('business_type')[0];
        business_type_select.value = business_type;

        var business_subtype = '<?php echo $row['business_subtype']?>';
        var business_subtype_option = document.getElementById('business_subtype_first_option');
        business_subtype_option.innerHTML = business_subtype;
        business_subtype_option.value = business_subtype;

        var satisfaction = '<?php echo $row['satisfaction']?>';
        var satisfaction_options = document.getElementsByName('satisfaction')[0].children;
        for (i = 0; i < satisfaction_options.length; i++) {
            if (satisfaction_options[i].value == satisfaction) {
                satisfaction_options[i].selected = true;
            }
        }

        var pos = '<?php echo $row['pos']?>';
        if(pos == "None"){
            document.getElementById('pos_trigger').checked = false;
            document.getElementById('pos_bar').style.display = "none";
        }
        else{
            var isknown = false;
            var pos_options = document.getElementById('pos-select-box').children;

            for (i = 0; i < pos_options.length; i++) {
                if (pos_options[i].value == pos) {
                    document.getElementById('known_pos').click();
                    pos_options[i].selected = true;
                    isknown = true;
                    break;
                }
            }
            if(!isknown){
                document.getElementById('other_pos').click();
                document.getElementById('other_pos_textbox').value = pos;              
            }
        }
        

        var payments = '<?php echo $row['QR_payment']?>'.split(", ");
        if(payments == "" || payments == "None"){
            document.getElementById('qrpay_trigger').checked = false;
            document.getElementById('QR_pay_bar').style.display = "none";
        }
        else{
            for(i = 0; i < payments.length; i++){
            var payment = payments[i];
            for(j = 0; j < PAYMENT_NUMBER; j++){
                var payment_option = document.getElementsByName('payment_group'+j)[0];
                if(payment_option.value == payment){
                    payment_option.checked = true;
                }
            }
        }
        }

        

    
    }
</script>

<div class="container">
    <h5 class="my-3 font-weight-bold">Edit shop</h5>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Trading Name<span class="star">*</span>
                    </div>
                    <input type="text" class="form-control " name="trading_name" value='<?php echo $row['trading_name'] ?>'>
                </div>
            </div>
        </div>
        <div class="row">
            <span class="msg">
                <?php echo $trading_name_msg;?></span>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Name</span>
                    </div>
                    <input type="text" class="form-control " name="company_name" value=<?php echo $row['company_name'] ?>>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="table-title my-3">
            <h6>Company/Shop address:<h6>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div id="locationField">
                        <input id="autocomplete" name="address" placeholder="Enter your address" onfocus="geolocate()"
                            type="text" autocomplete="off" class="form-control" placeholder="Enter your address">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <span class="msg">
                <?php echo $address_msg;?></span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="input-group mb-1"id="street_name">
                    <div class="input-group-prepend">
                        <span class="input-group-text">street</span>
                    </div>
                    <input type="text" class="form-control" name="address_street_number" id="street_number" value=<?php echo isset($_POST['address_street_number'])?$_POST['address_street_number']:explode(" ",$row['address_street'])[0]?>>
                    <input type="text" class="form-control" name="address_route" id="route" value='<?php 
                        if(isset($_POST['address_route'])){
                            echo $_POST['address_route'];
                        }
                        else{
                            $street_array = explode(" ",$row['address_street']);
                            array_shift($street_array);
                            echo implode(" ",$street_array);
                        }

                    ?>'>
                
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">suburb</span>
                    </div>
                    <input id="locality" type="text" class="form-control field" name="address_suburb" value=<?php echo isset($_POST['address_suburb'])?$_POST['address_suburb']:$row['address_suburb']?>>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-6 pr-0">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">state</span>
                    </div>
                    <input id="administrative_area_level_1" type="text" class="form-control field" name="address_state" value=<?php $address_state= isset($_POST['address_state'])?$_POST['address_state']:$row['address_state']; echo $address_state;?>>
                </div>
            </div>
            <div class="col-6 pl-0">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">postcode</span>
                    </div>
                    <input type="number" id="postal_code" class="form-control field" name="address_postcode" value=<?php $address_postcode= isset($_POST['address_postcode'])?$_POST['address_postcode']:$row['address_postcode']; echo $address_postcode;?>>

                </div>
            </div>
        </div>


        <div class="divider"></div>

        <div class="table-title my-3">
            <h6>Company/Shop Business Info:<h6>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text">nationality</label>
                    </div>
                    <select class="custom-select" id="nationality" name="nationality">
                        <option selected>--None--</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Aussie">Aussie</option>
                        <option value="Vietnamese">Vietnamese</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Indian">Indian</option>
                        <option value="Korean">Korean</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Malaysian">Malaysian</option>
                        <option value="France">France</option>
                        <option value="Italy">Italy</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">bussiness type</label>
                    </div>
                    <input id="business_type" class="form-control field" name="business_type" onchange="updateSubType()" value='<?php echo isset($_POST['business_type']) ? $_POST['business_type']:"";?>'>
                    <div class="business_select">
                    <select class="custom-select" onchange="updateBusinessType(event);updateSubType()" id="business_type_select">                    
                        <?php print_r($business_types)?>
                        
                    </select>
                        
        
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">subtype</label>
                    </div>
                    <select class="custom-select" id="business_subtype" name="business_subtype">
                        <option selected id="business_subtype_first_option" value="">--None--</option>                      
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">other subtype</label>
                    </div>
                    <input type="text" name="business_subtype_other" class="form-control">
                </div>
            </div>
        </div>

        <div class="row">
            <span class="msg">
                <?php echo $business_type_msg;?></span>

        </div>




        <div class="divider"></div>

        <div class="table-title my-3">
            <h6>Director info:<h6>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Owner name</label>
                    </div>
                    <input type="text" class="form-control" name="owner_name" value=<?php echo $row['owner_name'] ?>>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">managed by owner</label>
                    </div>
                    <input type="checkbox" id="managedBy" name="managed_by" onclick="toggleManagerInput()" <?php if($row['managed_by'] =="owner") echo "checked"?>>
                </div>
            </div>
        </div>
        <div class="row">

            <span class="msg">
                <?php echo $owner_name_msg;?></span>

        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">mobile number</label>
                    </div>
                    <input type="tel" class="form-control" name="owner_mobile" placeholder="04xx xxx xxx " value=<?php echo $row['owner_mobile'] ?>>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">shop phone number</label>
                    </div>
                    <input type="tel" class="form-control" name="shop_number" placeholder="04xx xxx xxx " value=<?php echo $row['shop_number'] ?>>
                </div>
            </div>
        </div>
        <div class="row">

            <span class="msg">
                <?php echo $owner_mobile_msg;?></span>

        </div>



        <div class="row" id="manager_bar">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01" id="managerName">manager name</span></label>
                    </div>
                    <input type="text" class="form-control" name="manager_name" value='<?php echo $row['manager_name'] ?>'>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">manager phone</span></label>
                    </div>
                    <input type="tel" class="form-control" name="manager_phone" placeholder="04xx xxx xxx" value='<?php echo $row['manager_phone'] ?>' >
                </div>
            </div>
        </div>
        <div class="row">
                <div class="input-group mb-1">
                    <span class="msg"><?php echo $manager_msg;?></span>
                </div>
            </div>

        <div class="divider"></div>

        <div class="table-title my-3">
            <h6>POS & payment method:<h6>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Use Pos system?<span class="star">*</span></label>
                    </div>
                    <input checked type="checkbox" id="pos_trigger" name="pos_trigger" value="true" onclick="togglePosInput()">
                </div>
            </div>
            <div class="col-md-6">
            
                <div class="input-group mb-1"  id="pos_bar">
                    <div class="form-check form-check-inline my-1">
                        <input class="form-check-input" type="radio" name="pos_type" id="known_pos" value="known" onclick="togglePosTextBox()">
                        <label class="form-check-label" >Known:&nbsp</label>
                        <select disabled id="pos-select-box" name="pos" class="custom-select">
                            <option value="">--Select Pos--</option>
                            <option value="AUPOS">Aupos</option>
                            <option value="Ipos">Ipos</option>
                            <option value="Pospal">Pospal</option>
                            <option value="Varipos">Varipos</option>
                            <option value="Cash register">Cash register</option>
                            <option value="PosiFlex">PosiFlex</option>
                            <option value="Suncorp">Suncorp</option>
                        </select>
                    </div>
                    <div class="form-check form-check-inline my-1">
                        <input class="form-check-input" type="radio" name="pos_type" id="other_pos" value="unknown" onclick="togglePosTextBox()">
                        <label class="form-check-label" >Others:&nbsp</label>
                        <input disabled id="other_pos_textbox" type="text" class="form-control" name="pos">
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <span class="msg"><?php echo $pos_msg;?></span>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Use QR payment?<span class="star">*</span></label>
                    </div>
                    <input checked type="checkbox" id="qrpay_trigger" name="qrpay_trigger" value="true" onclick="toggleQRpayInput()">
                </div>
            </div>

        </div>
        <div id="QR_pay_bar">
            <div class="row">
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">redpayment</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group0" value="Red Payment" >
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">superpay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group1" value="superpay" >
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">royalpay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group2" value="royalpay" >
                    </div>
                </div>   
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">omipay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group3" value="omipay" >
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">mipay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group4" value="mipay" >
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">paylinx</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group5" value="paylinx" >
                    </div>
                </div>   
            </div>


            <div class="row">
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">applepay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group6" value="applepay" >
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">zippay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group7" value="zippay" >
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">afterpay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group8" value="afterpay" >
                    </div>
                </div>   
            </div>
                    
            <div class="row">
                <div class="col-4">
                    <div class="form-inline">
                        <label class="form-label">googlepay</label>
                        <input class="form-checkbox" type="checkbox" name="payment_group9" value="googlepay" >
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-inline">
                        <input type="text" class="form-control other_payment" name="payment_group10" placeholder="Others...">
                    </div>
                </div>

            </div>        


        </div>

        <div class="row">
            <span class="msg"><?php echo $payment_msg;?></span>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1 my-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Satisfaction<span class="star">*</span></label>
                    </div>
                    <select class="custom-select" id="satisfaction" name="satisfaction">
                        <option value="">--None--</option>
                        <option value="Poor">Poor</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Satisfied">Satisfied</option>
                        <option value="Very satisfied">Very satisfied</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <span class="msg"><?php echo $satisfaction_msg;?></span>
        </div>


        <div class="table-title my-3">
            <h6>Comment:</h6>
        </div>
        <div class="form-group">

            <textarea class="form-control" name="comment"><?php echo $row['comment'] ?></textarea>
        </div>

        <?php $pageGet = isset($_GET['page']) ? "&&page=".$_GET['page']:"" ?>
        <div class="row">
            <button class="btn btn-primary mx-3 my-3" type="submit">Save</button>
            <?php
                $company_id = isset($_POST['company_id'])?$_POST['company_id']:$row['company_id']; 
                //echo "<div class='btn btn-primary my-3 mx-3 ml-auto'><a href=".$_SERVER['HTTP_REFERER'].">Back</a></div>"; 
            ?>
        </div>

        <input value=<?php echo $_SESSION['username']?> name="username" type="hidden">
        <input value=<?php if(!isset($_POST['company_id'])) {echo $row['company_id'];}else {echo $_POST['company_id'];}?> name="company_id"  type="hidden">
        <input value=<?php echo $row['company_address_id']?> name="company_address_id" type="hidden">
        <input value=<?php echo $row['owner_id']?> name="owner_id" type="hidden">
        <input value=<?php echo $row['business_type_id']?> name="business_type_id" type="hidden">
        <input value=<?php echo $pageGet?> name="page" type="hidden">
    </form>


    

    <table id="address">
      <tr>
        <td class="wideField" colspan="3"><input class="field"
              id="country" disabled="true"/></td>
      </tr>
    </table>
    
</div>
<script>
    
    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            { types: ['geocode'] });

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }

</script>
 
<script>
    // Keep the form selection values
    var satisfaction = document.getElementById('satisfaction');
    var satisfact_value = "<?php if(isset($_POST['satisfaction']))echo $_POST['satisfaction']?>";
    var children = satisfaction.children;
    for (var i = 0; i < children.length; i++) {
        var satisfactionChild = children[i];
        if(satisfactionChild.value == satisfact_value){
            satisfactionChild.selected = true;
        }
        
    }

    var nationality = document.getElementById('nationality');
    var nationality_value = "<?php if(isset($_POST['nationality']))echo $_POST['nationality']?>";
    var children = nationality.children;
    for (var i = 0; i < children.length; i++) {
        var nationalityChild = children[i];
        if(nationalityChild.value == nationality_value){
            nationalityChild.selected = true;
        }
        
    }

    var business_type = document.getElementById('business_type');
    var business_type_value = "<?php if(isset($_POST['business_type']))echo $_POST['business_type']?>";
    var children = business_type.children;
    for (var i = 0; i < children.length; i++) {
        var business_typeChild = children[i];
        if(business_typeChild.value == business_type_value){
            business_typeChild.selected = true;
        }
        
    }

    // clear other field
    function togglePosTextBox(){
        var pos_checkbox = document.getElementById('other_pos');
        var pos_textbox = document.getElementById('other_pos_textbox');
        var pos_selectbox = document.getElementById('pos-select-box');
        if(pos_checkbox.checked == false){
            
            pos_textbox.value = "";
            pos_textbox.disabled = true; 
            pos_selectbox.disabled = false; 
           
        }
        else{
            pos_textbox.disabled = false; 
            pos_selectbox.disabled = true; 
            pos_selectbox.value = "";
            
        }

    }

    function togglePaymentTextBox(){
        var payment_checkbox = document.getElementById('other_payment');
        if(payment_checkbox.checked == false){
            var payment_textbox = document.getElementById('other_payment_textbox');
            payment_textbox.value = "";          
        }

    }

    var business_subtype = document.getElementById('business_subtype');
    var business_subtype_value = "<?php if(isset($_POST['business_subtype']))echo $_POST['business_subtype']?>";
    if(business_subtype_value != "--None--" && business_subtype_value != ""){
        document.getElementById('business_subtype').innerHTML="<option selected>"+business_subtype_value+"</option>";
    }



</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCD8uHTzcRXMVNHokmoEdEc2KHHdfr_fL8&libraries=places&callback=initAutocomplete"
    async defer></script>

    