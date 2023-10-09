<header>
    <div class="logo">
        <a href="index.php" >
            <h1> <i class="fas fa-book text-primary"></i> The Book Spot</h1>
        </a>    
    </div>
    
    <div class="search">
        <form action="">
            <input type="text" placeholder="Search..." name="search">
            <button type="submit"><i class="fa fa-search text-white"></i></button>
        </form>
    </div>

    <div class="func">
        <a href="">
            <span class="carticon">
                <i class="bi bi-cart carticon"></i>
                <?php
                    session_start();
                    if(isset($_SESSION["cart"])) {
                        $totalQty = 0;
                        foreach ($_SESSION["cart"] as $index => $item) {
                            $totalQty += $item['qty'];
                        }
                        echo '<span class="cart_count" id = "cart_num">'.$totalQty.'</span>';
                    }
                    else {
                        echo '<span class="cart_count" id = "cart_num">0</span>';
                    }
                ?>
            </span> 
            <span class="cart">Cart</span></a>
        <a href=""><i class="bi bi-question-circle"></i><span class="title">Help</span></a>
        <?php
        //displays Profile button only when user is logged in, otherwise Log In button
        if(isset($_SESSION["userid"])){
            echo "<a href=''><i class='bi bi-person-circle'></i><span class='title'>Profile</span></a>";
            echo "<a href='inc/logout.inc.php'><i class='bi bi-lock'></i><span class='title'>Log Out</span></a>";
        }
        else{
            echo "<a href='loginUser.php'><i class='bi bi-lock'></i><span class='title'>Log In</span>";
        }
        ?>
    </div>
</header>
