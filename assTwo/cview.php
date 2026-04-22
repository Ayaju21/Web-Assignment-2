<?php
session_start();

require_once 'dbconfig.in.php';

$ticket_id = $_GET['id'] ?? null;

$ticket = null;

if ($ticket_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM tickets WHERE id = :ticket_id");
        $stmt->bindParam(':ticket_id', $ticket_id, PDO::PARAM_STR);
        $stmt->execute();
        $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ticket) {
            $ticket = null;
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket View Page</title>
</head>

<header>
    <img id="icon" src="Lo.jpg" alt="SALV" width="60" height="60">
    <h1>SALV</h1>
    <h1>Maintenance Request System</h1>
    <hr>
    <nav>
    <a href="home.html">Home Page</a> |
        <a href="login.php">Login Page</a> |
        <a href="cdash.php">Customer Dashboard</a> |
        <a href="cview.php">Ticket View Page</a> |
        <a href="request.php">Submit a Maintenance Request</a> |
        <a href="confirm.php">Request Submitted Successfully</a> 
    </nav>
    <hr>
</header>

<body>

    <main>
        <article>
            

            <?php if ($ticket): ?>
                <header>
                <p>Welcome Mazen AlJamel</p>
                <hr>
                    <h2>View Ticket: <?php echo htmlspecialchars($ticket_id); ?></h2>
                </header>
                <p>Here is a summary of the information about <?php echo htmlspecialchars($ticket_id); ?> </p>

                <section>
                    <ul>
                        <li><strong>Submitted by Customer:</strong> <?php echo htmlspecialchars($ticket['customer_name']); ?></li>
                        <li><strong>Email:</strong> <?php echo htmlspecialchars($ticket['email']); ?></li>
                        <li><strong>Location:</strong> <?php echo htmlspecialchars($ticket['location']); ?></li>
                        <li><strong>Issue Description:</strong> <?php echo htmlspecialchars($ticket['description']); ?></li>
                        <li><strong>Urgency Level:</strong> <?php echo htmlspecialchars($ticket['urgency_level']); ?></li>
                        <li><strong>Submitted Date:</strong> <?php echo htmlspecialchars($ticket['date_submitted']); ?></li>
                        <li><strong>Ticket Status:</strong> <?php echo htmlspecialchars($ticket['status']); ?></li>
                        <li><strong>Assigned to:</strong> <?php echo htmlspecialchars($ticket['assigned_to']); ?></li>
                        <li><strong>Photo Uploaded:</strong><br>
                            <img src="<?php echo htmlspecialchars($ticket['photo_url']); ?>" alt="Ticket Photo" width="100">
                        </li>
                    </ul>
                </section>
            <?php else: ?>
                <p>Error: Invalid or missing ticket ID.</p>
            <?php endif; ?>
        </article>
    </main>
    <hr>
    <footer>
        <p><a href="contact.html">Contact us Page</a> | <a href="tel:+97022956768">+970 2 254 6353</a> | <a href="mailto:ayaju2003@gmail.com">SALV@gmail.com</a></p>

        <address>5th Floor Al-Jameel Center Building, Al-Ersal Street, Ramallah, Palestine</address>
        <p>&copy; 2024 Ayah Abdalmuti - ID 1212074 | <a href="http://web1212074.studentprojects.ritaj.ps/">Ayah Abdalmuti Home Page</a></p>
    </footer>
</body>

</html>
