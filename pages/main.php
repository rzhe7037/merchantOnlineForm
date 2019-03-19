<?php 
    include_once('./header.php');
?>
<style>
    .btn a{
        color: white;
    }
    .userinfo h2, .userinfo button{
        display: inline-block;
        
    }
    .userinfo button{
        display: inline-block;
        border-radius: 5em;
    }
    .divider {
        height: 1px;
        width:100%;
        display:block; /* for use on default inline elements like span */
        margin: 9px 0;
        overflow: hidden;
        background-color: #e5e5e5;
    }        
    .title{
        text-align: center;
    }
    body{
        background-color: #EBEFF2;
    }
    .btn{
        background-color: #ffffff;
    } 


</style>

<?php include_once "session_checker.php";?>

<div class="wrapper">    
<div class="container">

    <div class="my-4 title">
        <h2  class="my-4 font-weight-bold">Merchant Online Form</h2>
    </div>
    <div class="divider"></div>

    <div class="menu ml-4">
    <div class="userinfo">
        <h3  class="text-dark"><?php echo 'Hi '.$_SESSION['username'].',';?></h3>
    </div>
    <div class="my-4">
        <?php echo "<div class=' mx-3 ml-auto'><a class='btn btn-outline-dark' href='./create.php/?username=".$_SESSION['username']."'><h5>Create new shop info</h5></a></div>" ?>
    </div>
    <div class="my-4"> 
        <?php echo "<div class=' mx-3 ml-auto'><a class='btn btn-outline-dark' href='./view.php'><h5>View all shops info</h5></a></div>" ?>
    </div>
    <div class="my-4"> 
        <?php
            if($_SESSION['privilege'] == "admin"){
                echo "<div class='mx-3 ml-auto'><a class='btn btn-outline-dark' href='./create_account.php/?username=".$_SESSION['username']."'><h5>Create new account</h5></a></div>";
            }             
        ?>
    </div>
    <div class="my-4"> 
        <?php
            if($_SESSION['privilege'] == "admin"){
                echo "<div class='mx-3 ml-auto'><a class='btn btn-outline-dark' href='./delete.php'><h5>Delete Shop</h5></a></div>";
            }             
        ?>
    </div>
    <div class='mx-3 ml-auto my-4'><a class='btn btn-outline-dark' href="/ShopInfo/pages/logout.php"><h5>Log out</h5></a></div>
    </div>
</div>
</div>
