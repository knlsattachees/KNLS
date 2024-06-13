<?php
include 'db.php';

// Handle form submission for check-in
if (isset($_POST['check_in'])) {
    $client_id = $_POST['client_id'];
    $sql = "UPDATE clients SET check_in = NOW() WHERE id = $client_id";
    if ($conn->query($sql) === TRUE) {
        echo "Client checked in successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all registered clients
$sql = "SELECT id, name FROM clients WHERE check_in IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client Check-In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        form {
            margin: 20px auto;
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Client Check-In</h1>
    <form method="post" action="">
        <label for="client_id">Select Client:</label>
        <select id="client_id" name="client_id" required>
            <option value="">--Select Client--</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            } else {
                echo "<option value=''>No clients available</option>";
            }
            ?>
        </select>
        <button type="submit" name="check_in">Check In</button>
    </form>
</body>
</html>
