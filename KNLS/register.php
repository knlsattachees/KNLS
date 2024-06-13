<?php
include 'db.php';

// Handle form submission for client registration
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id_no = $_POST['id_no'];
    $address = $_POST['address'];

    $sql = "INSERT INTO clients (name, email, phone, id_no, address) VALUES ('$name', '$email', '$phone', '$id_no', '$address')";
    if ($conn->query($sql) === TRUE) {
        echo "Client registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client Registration</title>
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
        input[type="text"], input[type="email"], input[type="tel"], textarea {
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
    <h1>Client Registration</h1>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="id_no">ID Number:</label>
        <input type="text" id="id_no" name="id_no" required>
        
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
        
        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>
