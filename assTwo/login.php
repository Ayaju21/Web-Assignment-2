<?php
session_start();
require_once 'dbconfig.in.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        
        $stmt = $pdo->prepare("SELECT id, user_type, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

       
        if ($user && $password === $user['password']) {
          
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['user_type'];

        
            if ($_SESSION['role'] == 'manager') {
                header("Location: mdash.php"); 
                exit();
            } elseif ($_SESSION['role'] == 'customer') {
                header("Location: cdash.php"); 
                exit();
            } elseif ($_SESSION['role'] == 'staff') {
                header("Location: staff_dash.php"); 
                exit();
            }
        } else {
            
            $error_message = "The email or password you entered is incorrect. Please try again.";
        }
    } catch (PDOException $e) {
        $error_message = "An error occurred. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<header>
    <img id="icon" src="Lo.jpg" alt="SALV" width="60" height="60">
    <h1>SALV</h1>
    <h1>Maintenance Request System</h1>
    <hr>
    <nav>
    <a href="home.html">Home Page</a> 
    </nav>
    <hr>
</header>

<h2>Login</h2>
<body>
<?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

<form action="login.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>

    <input type="submit" name="login" value="Login"><br><br>
</form>

<hr>

<footer>
    <p><a href="contact.html">Contact us Page | </a> <a href="tel:+97022956768">+970 2 254 6353</a> | <a href="mailto:ayaju2003@gmail.com">SALV@gmail.com</a></p>
    <address> 5th Floor Al-Jameel Center Building, Al-Ersal street Ramallah, Palestine</address>
    <p> &copy; 2024 Ayah Abdalmuti - ID 1212074 |  <a href="http://web1212074.studentprojects.ritaj.ps/">Ayah Abdalmuti Home Page</a></p>
</footer>

</body>

</html>
