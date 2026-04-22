<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'web1212074_db');
define('DB_USER', 'web1212074_dbuser');
define('DB_PASS', 'z!NxwyHyQ2');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}


function my_footer()
{
?>
<footer>
<nav>
    <small>Phone number: +972 59911542</small><br>
    <small>Email: a$plus-clothing@gmail.com</small><br>
    <small>Location: Rammallah Al-ersal street</small><br>
    <small>Last update: <time>10:36 PM</time></small><br>
    <button type="submit" onclick="window.location.href='contact_us.html';">Contact Us</button>
</nav>
</footer>
<?php
}

?>