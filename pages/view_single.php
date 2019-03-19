<?php include_once('./header.php') ?>
<?php include_once('./models/search_single.php')?>
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
    *{
        color: #505458;
        font-size: 14px;
    }  

</style>
<div class="container">
    <h5 class="font-weight-bold my-3">View shop</h5>

    <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Trading Name</span>
                    </div>
                    <input disabled type="text" class="form-control " name="trading_name" value='<?php echo $row['trading_name']?>'>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Company Name</span>
                    </div>
                    <input disabled type="text" class="form-control " name="company_name" value=<?php echo $row['company_name']?>>
                </div>
            </div>
        </div>


        <div class="divider"></div>

        <div class="table-title my-3">
            <h6>Company/Shop address:<h6>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1"id="street_name">
                    <div class="input-group-prepend">
                        <span class="input-group-text">street</span>
                    </div>
                    <input disabled type="text" class="form-control" name="address_street_number" id="street_number" value=<?php echo explode(" ",$row['address_street'])[0]?>>
                    <input disabled type="text" class="form-control" name="address_route" id="route" value='<?php 
                        $street_array = explode(" ",$row['address_street']);
                        array_shift($street_array);
                        echo implode(" ",$street_array);

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
                    <input disabled id="locality" type="text" class="form-control field" name="address_suburb" value=<?php echo $row['address_suburb']?>>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-6 pr-0">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">state</span>
                    </div>
                    <input disabled id="administrative_area_level_1" type="text" class="form-control field" name="address_state" value=<?php echo $row['address_state']?>>
                </div>
            </div>
            <div class="col-6 pl-0">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">postcode</span>
                    </div>
                    <input disabled type="number" id="postal_code" class="form-control field" name="address_postcode" value=<?php echo $row['address_postcode']?>>

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
                        <label class="input-group-text" for="inputGroupSelect01">bussiness type</label>
                    </div>
                    <input disabled id="business_type" class="form-control field" name="business_type" value='<?php echo $row['business_type']?>'>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Subtype</label>
                    </div>
                    <input disabled id="business_subtype" class="form-control field" name="business_subtype" value='<?php echo $row['business_subtype']?>'>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">nationality</label>
                    </div>
                    <select disabled class="custom-select" id="inputGroupSelect01" name="nationality">
                        <option selected><?php echo $row['nationality']?></option>
                    </select>
                </div>
            </div>
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
                    <input disabled type="text" class="form-control" name="owner_name" value=<?php echo $row['owner_name']?>>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">managed by owner</label>
                    </div>
                    <input disabled type="checkbox" id="managedBy" name="managed_by" <?php if($row['managed_by'] == "owner") echo "checked";?>>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">mobile number</label>
                    </div>
                    <input disabled type="number" class="form-control" name="owner_mobile" value=<?php echo $row['owner_mobile']?>>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">shop phone number</label>
                    </div>
                    <input disabled type="number" class="form-control" name="shop_number" value=<?php echo $row['shop_number']?>>
                </div>
            </div>
        </div>


        <?php
            if($row['managed_by'] != "owner"){
                echo "  <div class='row' id='manager_bar'>
                <div class='col-md-6'>
                    <div class='input-group mb-1'>
                        <div class='input-group-prepend'>
                            <label class='input-group-text' for='inputGroupSelect01' id='managerName'>manager name</span></label>
                        </div>
                        <input disabled type='text' class='form-control' name='manager_name' value=".$row['manager_name'].">
                    </div>
                </div>
                <div class='col-md-6'>
                    <div class='input-group mb-1'>
                        <div class='input-group-prepend'>
                            <label class='input-group-text' for='inputGroupSelect01'>manager phone</span></label>
                        </div>
                        <input disabled type='number' class='form-control' name='manager_phone' value=".$row['manager_phone'].">
                    </div>
                </div>
            </div>";
            }
        ?>


        <div class="divider"></div>

        <div class="table-title my-3">
            <h6>POS & payment method:<h6>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1"  id="pos_bar">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">POS</label>
                    </div>
                    <input disabled type="text" class="form-control"  name="pos" value='<?php echo $row['pos']?>'>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1" id="QR_pay_bar">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">QR payment</label>
                    </div>
                    <textarea disabled class="form-control" name="QR_payment"><?php echo $row['QR_payment']?></textarea>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Satisfaction</label>
                    </div>
                    <select disabled class="custom-select" id="inputGroupSelect01" name="satisfaction">
                        <option selected><?php echo $row['satisfaction']?></option>
                    </select>
                </div>
            </div>
        </div>


        <div class="table-title my-3">
            <h6>Comment:</h6>
        </div>
        <div class="form-group">

            <textarea disabled class="form-control" name="comment"><?php echo $row['comment']?></textarea>
        </div>

        <?php $pageGet = isset($_GET['page']) ? "&&page=".$_GET['page']:"" ?>
        <div class="row">
            <?php echo "<div class='btn btn-primary my-3 mx-3'><a href=/ShopInfo/pages/edit.php?company_id=".$row['company_id'].$pageGet.">Edit Shop</a></div>"; ?>
            <?php //echo "<div class='btn btn-primary my-3 mx-3 ml-auto'><a href=/ShopInfo/pages/view.php?".$pageGet.">Back</a></div>";?>
        </div>
</div>