<div class="container">
<div class="my-4">
        <h2 class="my-4">
            <?php if(!isset($_SESSION['username'])){
                echo "
                    <h3 class='text-primary mb-3'>Invalid Page</h3>
                    <a href='/ShopInfo/pages/login.php'>Back to Login</a>";
                    exit();
                } 
            ?>
        </h2>
    </div>
</div>