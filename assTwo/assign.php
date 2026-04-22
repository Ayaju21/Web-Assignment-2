<?php
session_start();

require_once 'dbconfig.in.php';

$ticket_id = $_GET['id'] ?? null;

if (!$ticket_id) {
    die("Error: Ticket ID is missing.");
}

$ticket = null;

try {
    $stmt = $pdo->prepare("SELECT * FROM tickets WHERE id = :ticket_id");
    $stmt->bindParam(':ticket_id', $ticket_id, PDO::PARAM_STR);
    $stmt->execute();
    $ticket = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$ticket) {
        die("Error: Ticket not found.");
    }

    if ($ticket['status'] == 'assigned' || $ticket['status'] == 'completed') {
        die("Error: Ticket has already been assigned or completed.");
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$staff_stmt = $pdo->prepare("SELECT DISTINCT assigned_to FROM tickets WHERE assigned_to IS NOT NULL");
$staff_stmt->execute();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_ticket'])) {
    $staff_name = $_POST['assigned_to'];
    $assign_date = date('Y-m-d H:i:s');

    $update_stmt = $pdo->prepare("UPDATE tickets SET status = 'assigned', assigned_to = :staff_name WHERE id = :ticket_id");
    $update_stmt->bindParam(':staff_name', $staff_name, PDO::PARAM_STR);
    $update_stmt->bindParam(':ticket_id', $ticket_id, PDO::PARAM_STR);

    if ($update_stmt->execute()) {
        header("Location: view.php?id=" . urlencode($ticket_id));
        exit();
    } else {
        echo "Error: Failed to assign ticket.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Ticket</title>
</head>
<header>
    <h1>Maintenance Request System</h1>
    <hr>
    <nav>
        <a href="home.html">Home Page</a> |
        <a href="login.php">Login Page</a> |
        <a href="mdash.php">Manager Dashboard</a> |
        <a href="view.php">Ticket View Page</a> |
        <a href="assign.php">Assign Ticket</a>
    </nav>
</header>
<hr>
<body>
<main>
    <p>Welcome Ali Al-Fares</p>

    <?php if ($ticket): ?>
        <header>
            <h2>Assign Ticket <?php echo htmlspecialchars($ticket_id); ?></h2>
        </header>
        <br>
        <section>
            <strong>Issue Description:</strong> <?php echo htmlspecialchars($ticket['description']); ?> <br><br>
            <strong>Urgency Level:</strong> <?php echo htmlspecialchars($ticket['urgency_level']); ?><br><br>
            <strong>Date Submitted:</strong> <?php echo htmlspecialchars($ticket['date_submitted']); ?> <br><br>

            <form method="POST" action="assign.php?id=<?php echo urlencode($ticket_id); ?>">
                <label>Assign to Staff Member: </label>
                <select name="assigned_to" required>
                    <?php while ($staff = $staff_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo htmlspecialchars($staff['assigned_to']); ?>"><?php echo htmlspecialchars($staff['assigned_to']); ?></option>
                    <?php endwhile; ?>
                </select><br><br>

                <button type="submit" name="assign_ticket">Assign Ticket</button>
            </form>

        </section>
    <?php else: ?>
        <p>Error: Invalid or missing ticket ID.</p>
    <?php endif; ?>
</main>
<footer>
    <p>© 2024 Ticket Management System | <a href="privacy.php">Privacy Policy</a></p>
    <p> Contact us at  <a href="support@ticketsystem.com">support@ticketsystem.com</a> </p>
    <hr>
    <p><a href="contact.html">Contact us Page</a> | <a href="tel:+97022956768">+970 2 254 6353</a> | <a href="mailto:ayaju2003@gmail.com">SALV@gmail.com</a></p>

    <address>5th Floor Al-Jameel Center Building, Al-Ersal Street, Ramallah, Palestine</address>
    <p>&copy; 2024 Ayah Abdalmuti - ID 1212074 | <a href="http://web1212074.studentprojects.ritaj.ps/">Ayah Abdalmuti Home Page</a></p>
</footer>
</body>
</html>