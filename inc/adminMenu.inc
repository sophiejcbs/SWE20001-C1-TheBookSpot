<nav>
    <ul>
        <li><a <?php if ($shade === 'bookRecord.php') { echo 'class="shaded"'; } ?> href="bookRecord.php">Book Record</a></li>
        <li><a <?php if ($shade === 'orderRecord.php') { echo 'class="shaded"'; } ?> href="orderRecord.php">Order Record</a></li>
        <li><a <?php if ($shade === 'addBook.php') { echo 'class="shaded"'; } ?> href="addBook.php">Create New Book</a></li>
        <li><a <?php if ($shade === 'addAdmin.php') { echo 'class="shaded"'; } ?> href="addAdmin.php">Create Admin</a></li>
    </ul>
</nav>
