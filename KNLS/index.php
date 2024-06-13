<!DOCTYPE html>
<html>
<head>
    <title>Client Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
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
    <h1>Client Management System</h1>
    <nav>
        <a href="register.php">Register New Client</a>
        <a href="check_in.php">Check In Client</a>
        <a href="check_out.php">Check Out Client</a>
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
        include 'db.php';
        $sql = "SELECT * FROM clients";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['id_no']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['check_in']}</td>
                        <td>{$row['check_out']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No clients found</td></tr>";
        }
        ?> 
    </table>
</body>
</html>
