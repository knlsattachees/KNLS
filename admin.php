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

// Handle form submission for check-out
if (isset($_POST['check_out'])) {
    $client_id = $_POST['client_id'];
    $sql = "UPDATE clients SET check_out = NOW() WHERE id = $client_id";
    if ($conn->query($sql) === TRUE) {
        echo "Client checked out successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all clients
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            text-align: center;
        }
        nav {
            text-align: center;
            margin-bottom: 20px;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #007bff;
        }
        nav a:hover {
            text-decoration: underline;
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="register.php">Register New Client</a>
        <a href="admin.php">Admin Panel</a>
    </nav>

    <h2>Client List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>ID Number</th>
            <th>Address</th>
            <th>Date Registered</th>
            <th>Check In</th>
            <th>Check Out</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['id_no']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['date_stamp']}</td>
                        <td>{$row['check_in']}</td>
                        <td>{$row['check_out']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No clients found</td></tr>";
        }
        ?>
    </table>

    <h2>Check In Client</h2>
    <form method="post" action="">
        <label for="client_id">Select Client:</label>
        <select id="client_id" name="client_id" required>
            <option value="">--Select Client--</option>
            <?php
            $sql = "SELECT id, name FROM clients WHERE check_in IS NULL";
            $result = $conn->query($sql);
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

    <h2>Check Out Client</h2>
    <form method="post" action="">
        <label for="client_id">Select Client:</label>
        <select id="client_id" name="client_id" required>
            <option value="">--Select Client--</option>
            <?php
            $sql = "SELECT id, name FROM clients WHERE check_in IS NOT NULL AND check_out IS NULL";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            } else {
                echo "<option value=''>No clients available</option>";
            }
            ?>
        </select>
        <button type="submit" name="check_out">Check Out</button>
    </form>
</body>
</html>
