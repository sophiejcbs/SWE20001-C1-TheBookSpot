<nav>
    <ul>
        <li><a <?php if ($genre === 'Young Adult Fantasy') { echo 'class="shaded"'; } ?> href="book_catalogue.php?genre=Young%20Adult%20Fantasy">Young Adult Fantasy</a></li>
        <li><a <?php if ($genre === 'Romance') { echo 'class="shaded"'; } ?> href="book_catalogue.php?genre=Romance">Romance</a></li>
        <li><a <?php if ($genre === 'Science Fiction') { echo 'class="shaded"'; } ?> href="book_catalogue.php?genre=Science%20Fiction">Science Fiction</a></li>
        <li><a <?php if ($genre === 'Crime & Thriller') { echo 'class="shaded"'; } ?> href="book_catalogue.php?genre=Crime%20%26%20Thriller">Crime & Thriller</a></li>
        <li><a <?php if ($genre === 'Children') { echo 'class="shaded"'; } ?> href="book_catalogue.php?genre=Children">Children</a></li>
    </ul>
</nav>
