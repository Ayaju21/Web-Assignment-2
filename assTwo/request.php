
<?php
// Start output buffering to avoid "headers already sent" issues
ob_start();

require_once 'dbconfig.in.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sname = $_POST['sname'];
    $semail = $_POST['semail'];
    $slocation = $_POST['slocation'];
    $mssg = $_POST['mssg'];
    $urgency = $_POST['urgency'];

    $ticketID = time(); 
    $ticketStatus = "Pending";
    $submissionDate = date("Y-m-d"); 

    $filePath = '';
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowedTypes = ['image/jpeg'];
        $maxFileSize = 2 * 1024 * 1024;

        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];
        $fileSize = $_FILES['file']['size'];

        if (in_array($fileType, $allowedTypes) && $fileSize <= $maxFileSize) {
            $newFileName = $ticketID . '.jpeg';
            $uploadDir = 'images/';

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($fileTmpPath, $uploadDir . $newFileName)) {
                $filePath = $uploadDir . $newFileName;
            } else {
                echo "Error uploading the file.";
                exit;
            }
        } else {
            echo "Invalid file type or size.";
            exit;
        }
    }

    $sql = "INSERT INTO requests (ticket_id, full_name, email, location, issue_description, urgency_level, file_path, submission_date, status)
            VALUES (:ticketID, :sname, :semail, :slocation, :mssg, :urgency, :filePath, :submissionDate, :ticketStatus)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':ticketID' => $ticketID,
        ':sname' => $sname,
        ':semail' => $semail,
        ':slocation' => $slocation,
        ':mssg' => $mssg,
        ':urgency' => $urgency,
        ':filePath' => $filePath,
        ':submissionDate' => $submissionDate,
        ':ticketStatus' => $ticketStatus
    ]);

    // Redirect to confirmation page
    header("Location: confirm.php?ticketID=" . $ticketID);
    exit;
}

// End output buffering and flush the buffer
ob_end_flush();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Maintenance Requestd</title>
</head>


<header>
    <img id="icon" src="Lo.jpg" alt="SALV" width="60" height="60">
    <h1>SALV</h1>
    <h1>Maintenance Request System</h1>

    <hr>
</header>

<body>
    <header>
        <nav>
        <a href="home.html">Home Page</a> |
        <a href="login.php">Login Page</a> |
        <a href="cdash.php">Customer Dashboard</a> |
        <a href="cview.php">Ticket View Page</a> |
        <a href="request.php">Submit a Maintenance Request</a> |
        <a href="confirm.php">Request Submitted Successfully</a> 

        <hr>
       
        </nav>
    </header>

    <main>
        <article>
            <header>
                <p>Welcome Mazen AlJamel</p>
            </header>
            <hr>
<body>
    <h1>Submit a Maintenance Request</h1>
    <form method="POST" action="request.php" enctype="multipart/form-data">
    <label for="sname">Full Name:</label>
    <input type="text" id="sname" name="sname" placeholder="Enter your name"  required><br>

    <label for="semail">Email Address:</label>
    <input type="email" id="semail" name="semail" placeholder="Enter your email" required><br>

    <label for="slocation">Location/Room Number:</label>
    <input type="text" id="slocation" name="slocation" placeholder="Enter the room or location" required><br>

    <label for="mssg">Issue Description:</label>
    <textarea id="mssg" name="mssg" rows="3" placeholder="Describe the issue..." required></textarea><br>

    <label for="urgency">Urgency Level:</label>
    <select name="urgency" id="urgency" required>
        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
    </select><br><br>

    <label for="file">Upload a Photo of the Issue (optional):</label>
    <input type="file" id="file" name="file" accept="jpg"><br><br>

    <input type="submit" value="Submit Request">
</form>


    <hr>
<footer>
    <p><a href="contact.html">Contact us Page | </a> <a href="tel:+97022956768">+970 2 254 6353</a> | <a href="mailto:ayaju2003@gmail.com">SALV@gmail.com</a></p>
    <address> 5th Floor Al-Jameel Center Building, Al-Ersal street Ramallah, Palestine</address>
    <p> &copy; 2024 Ayah Abdalmuti - ID 1212074 |  <a href="http://web1212074.studentprojects.ritaj.ps/">Ayah Abdalmuti Home Page</a></p>
</footer>

</body>

</html>

