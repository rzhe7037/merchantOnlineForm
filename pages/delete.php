<?php include_once('./header.php') ?>
<form action="./models/delete_shop.php"> 
    <div class="container">
        <div class="input-group mb-1">
            <div class="input-group-prepend">
                <span class="input-group-text">Enter the company Id you would like to delete</span>
            </div>
            <input class="form-control" type="text" name="company_id"/>
        </div>
        <div class="form-inline">
            <button type="submit" class="btn btn-danger ml-auto">Delete</button>
        </div>
    </div>
</form>
