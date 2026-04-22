<?php
require_once 'dbconfig.in.php';

if (isset($_GET['ticketID'])) {
    $ticketID = $_GET['ticketID'];
} else {
}

if (isset($_GET['ticketID'])) {
    $ticketID = $_GET['ticketID'];

    $sql = "SELECT * FROM requests WHERE ticket_id = :ticketID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':ticketID' => $ticketID]);
    $ticket = $stmt->fetch();

    if ($ticket) {
        $ticketID = sprintf('%03d', $ticket['ticket_id']);
        $fullName = $ticket['full_name'];
    } else {
        echo "Ticket not found.";
        exit;
    }
} else {
    echo "No ticket ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted Successfully</title>
</head>

<body>
    <header>
        <img id="icon" src="Lo.jpg" alt="SALV" width="60" height="60">
        <h1>SALV</h1>
        <h1>Maintenance Request System</h1>
        <hr>
    </header>

    <header>
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

    <main>
        <?php if (isset($error_message)): ?>
            <section>
                <p><strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?></p>
            </section>
        <?php elseif (isset($ticket)): ?>
            <section>
                <p>Welcome, <?php echo htmlspecialchars($ticket['full_name']); ?>!</p>
            </section>

            <article>
                <header>
                    <h2>Request Submitted Successfully</h2>
                </header>

                <p>
                    Dear <?php echo htmlspecialchars($ticket['full_name']); ?>, thank you for submitting your maintenance request. Your ticket has been created with reference number. <br>Here is a summary of the information we have received:
                </p>
                
                <section>
                    <ul>
                        <li><strong>Full Name:</strong> <?php echo htmlspecialchars($ticket['full_name']); ?></li>
                        <li><strong>Email:</strong> <?php echo htmlspecialchars($ticket['email']); ?></li>
                        <li><strong>Location:</strong> <?php echo htmlspecialchars($ticket['location']); ?></li>
                        <li><strong>Issue Description:</strong> <?php echo nl2br(htmlspecialchars($ticket['issue_description'])); ?></li>
                        <li><strong>Urgency Level:</strong> <?php echo htmlspecialchars($ticket['urgency_level']); ?></li>
                        <li><strong>Submitted Date:</strong> <?php echo htmlspecialchars($ticket['submission_date']); ?></li>
                        <li><strong>Ticket Status:</strong> <?php echo htmlspecialchars($ticket['status']); ?></li>
                        <li><strong>Photo Uploaded:</strong> <?php echo $ticket['file_path'] ? "Yes" : "No"; ?></li>
                    </ul>
                </section>

                <?php if ($ticket['file_path']): ?>
                    <figure>
                        <img src="<?php echo htmlspecialchars($ticket['file_path']); ?>" alt="Uploaded Issue Photo" width="300">
                    </figure>
                <?php endif; ?>

                <p>Our maintenance team will respond to your request shortly.</p>
            </article>
        <?php endif; ?>

        <hr>
    </main>

    <footer>
        <p><a href="contact.html">Contact us Page</a> | <a href="tel:+97022956768">+970 2 295 6768</a> | <a href="mailto:ayaju2003@gmail.com">SALV@gmail.com</a></p>
        <address>
            5th Floor Al-Nahda Building, Jaffa Street, Ramallah, Palestine
        </address>
        <p>&copy; 2024 Ayah Abdalmuti - ID 1212074 | <a href="http://web1212074.studentprojects.ritaj.ps/">Ayah Abdalmuti Home Page</a></p>
    </footer>
</body>

</html>
