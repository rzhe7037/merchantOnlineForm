<?php include_once('./header.php') ?>
    <style>
        .wrapper{
            width: 70%;
            margin: 100px auto;
            
        }
        input,.btn, a{
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            margin: 5px 0;
            opacity: 0.85;
            display: inline-block;
            font-size: 17px;
            line-height: 20px;
            text-decoration: none; /* remove underline from anchors */
            }

        input:hover,
            .btn:hover {
            opacity: 1;
            }


        .header{
            text-align: center;
        }  
        .btn a{
            color: white;
        }      
    </style>
    <div class="container">
        <div class="wrapper">
            <h2 class="header">Create New Account</h2>
            <form action="../models/verify_new_account.php" method="post">
                <div class="from-group">
                    <input class="from-control" name="username" placeholder="username">
                </div>
                <div class="from-group">
                    <input class="from-control" name="password" type="password" placeholder="password">
                </div>
                <button class="btn btn-primary" type="submit">Create</button>
                <div class="btn btn-primary py-0 mx-3 ml-auto"><a href="/ShopInfo/pages/main.php">Back to Home</a></div>
            </form>
        </div>
    </div>
<?php include_once('./footer.php') ?>