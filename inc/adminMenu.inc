<nav>
    <ul>
        <li><a <?php if ($shade === 'bookRecord.php' || $shade === 'addBook.php') { echo 'class="shaded"'; } ?> href="bookRecord.php">Book Records</a></li>
        <li><a <?php if ($shade === 'orderRecord.php' || $shade === 'orderDetails_admin.php') { echo 'class="shaded"'; } ?> href="orderRecord.php">Order Records</a></li>
        <li><a <?php if ($shade === 'order_report.php') { echo 'class="shaded"'; } ?> href="order_report.php">Order Report</a></li>
        <li><a <?php if ($shade === 'helpdeskRecord.php') { echo 'class="shaded"'; } ?> href="helpdeskRecord.php">Helpdesk Records</a></li>
        <li><a <?php if ($shade === 'addAdmin.php') { echo 'class="shaded"'; } ?> href="addAdmin.php">Create Admin</a></li>
    </ul>
</nav>
