<?php 
  session_start();
  header("Content-type:text/html;charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset='utf-8' />
  <meta http-equiv="Content-Type"content="text/html; charset=UTF-8"/>  
  <title>Merchant online form</title>
  <meta name='viewport' content='width=device-width, initial-scale=1' />
  <link
    rel='stylesheet'
    href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'
    integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm'
    crossorigin='anonymous'
  />
  <script
    src='https://code.jquery.com/jquery-3.2.1.slim.min.js'
    integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN'
    crossorigin='anonymous'
  ></script>
  <script
    src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'
    integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q'
    crossorigin='anonymous'
  ></script>
  <script
    src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'
    integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl'
    crossorigin='anonymous'
  ></script>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
  <style>
    .navbar {
      background-color: #FFFFFF !important;
    }
    
  </style>
</head>
<body>
  <nav class='navbar navbar-expand-sm navbar-dark'>
    <div class='container'>
        <?php echo "<a class='navbar-brand'><img src='http://".$_SERVER['SERVER_NAME']."/ShopInfo/img/logo-red.png' /></a>"?>
    <?php echo "</nav>";?>
    
    <?php echo "<div class='container msg_wrapper'>";?>
      <?php 
    
          if(isset($_GET['msg']) && $_GET['msg'] == 'create_success'){
              echo "<div class='alert alert-success mt-3' role='alert'>You have created a new shop</div>";
          }
          else if(isset($_GET['msg']) && $_GET['msg'] == 'edit_success'){
            echo "<div class='alert alert-success mt-3' role='alert'>Changed the shop successfully</div>";
          }
          else if(isset($_GET['msg']) && $_GET['msg'] == 'edit_fail'){
            echo "<div class='alert alert-danger mt-3' role='alert'>Update shop fail:<br />".$_GET['msg_info']."</div>";
          }
          else if(isset($_GET['msg']) && $_GET['msg'] == 'login_incomplete'){
            echo "<div class='alert alert-danger mt-3' role='alert'>Username or password is missing</div>";
          }
          else if(isset($_GET['msg']) && $_GET['msg'] == 'login_fail'){
            echo "<div class='alert alert-danger mt-3' role='alert'>Username or password is incorrect</div>";
          }
          else if(isset($_GET['msg']) && $_GET['msg'] == 'edit_incomplete_info'){
            echo "<div class='alert alert-danger mt-3' role='alert'>Form data format is incorrect, please try editting again</div>";
          }
      ?>
    <?php echo "</div>";?>
    
    

