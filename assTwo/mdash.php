<?php
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'manager') {
    header("Location: login.php");
    exit();
}

require_once 'dbconfig.in.php';

$filtered_tickets = [];
$params = [];
$conditions = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['description'])) {
        $conditions[] = "description LIKE :description";
        $params[':description'] = '%' . $_POST['description'] . '%';
    }
    if (!empty($_POST['date_submitted'])) {
        $conditions[] = "date_submitted = :date_submitted";
        $params[':date_submitted'] = $_POST['date_submitted'];
    }
    if (!empty($_POST['status']) && $_POST['status'] != 'All') {
        $conditions[] = "status = :status";
        $params[':status'] = $_POST['status'];
    }
    if (!empty($_POST['Emergency_level']) && $_POST['Emergency_level'] != 'All') {
        $conditions[] = "urgency_level = :Emergency_level";
        $params[':Emergency_level'] = $_POST['Emergency_level'];
    }
} else {
    
    $conditions[] = "status = 'Pending'";
}


$sql = "SELECT * FROM tickets";
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $filtered_tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
</head>
<body>

<header>
    <img id="icon" src="Lo.jpg" alt="SALV" width="60" height="60">
    <h1>SALV</h1>
    <h1>Maintenance Request System</h1>
    <hr>
    <nav>
        <a href="home.html">Home Page</a> |
        <a href="login.php">Login Page</a> |
        <a href="mdash.php">Manager Dashboard</a> |
        <a href="view.php">Ticket View Page</a> |
        <a href="assign.php">Assign Ticket</a>
    </nav>
    <hr>
</header>

<main>
    <article>
        <header>
            <p>Welcome Ali AL-Faris</p>
        </header>
        <hr>

        <section>
            <form method="POST" action="mdash.php">
                <fieldset>
                    <legend>Advanced Ticket Search</legend>
                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description" placeholder="Search...">

                    <label for="date_submitted">Submission Date:</label>
                    <input type="date" id="date_submitted" name="date_submitted">

                    <label for="status">Status:</label>
                    <select id="status" name="status">
                        <option value="All">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Assigned">Assigned</option>

                    </select>

                    <label for="Emergency_level">Emergency Level:</label>
                    <select id="Emergency_level" name="Emergency_level">
                        <option value="All">All</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>

                    <input type="submit" value="Filter">
                </fieldset>
            </form>
        </section>

        <section>
            <h2>Ticket List</h2>
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Issue Description</th>
                        <th>Date Submitted</th>
                        <th>Customer Name</th>
                        <th>Urgency Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($filtered_tickets)) : ?>
                        <?php foreach ($filtered_tickets as $ticket) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ticket['id']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['description']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['date_submitted']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['customer_name']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['urgency_level']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['status']); ?></td>
                                <td>
                                  

                        
                                   <a href="assign.php?id=<?php echo $ticket['id']; ?>">
                                     
                                    </a> <a href="assign.php?id=<?php echo urlencode($ticket['id']); ?>" class="hidden-ticket-id"><img id="icon" src="images/assign.jpg" alt="Assign" width="20" height="20"></a>
                                    
                                    <a href="view.php?id=<?php echo $ticket['id']; ?>">
                                    <a href="view.php?id=<?php echo urlencode($ticket['id']); ?>" class="hidden-ticket-id"><img id="icon" src="images/view.jpg" alt="View" width="20" height="20"></a>

                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">No tickets found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </article>
</main>

<hr>
<footer>
    <p><a href="contact.html">Contact us Page</a> | <a href="tel:+97022956768">+970 2 254 6353</a> | <a href="mailto:ayaju2003@gmail.com">SALV@gmail.com</a></p>
    <address>5th Floor Al-Jameel Center Building, Al-Ersal street Ramallah, Palestine</address>
    <p>&copy; 2024 Ayah Abdalmuti - ID 1212074 | <a href="http://web1212074.studentprojects.ritaj.ps/">Ayah Abdalmuti Home Page</a></p>
</footer>

</body>
</html>
