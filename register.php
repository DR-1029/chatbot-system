<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $message = "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            $error = "Error: Username may already exist.";
        }
    } else {
        $error = "Please fill all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Ticket Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #a1c4fd, #c2e9fb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #4facfe;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #3f8dfc;
        }

        .error, .message {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }

        .error {
            color: red;
        }

        .message {
            color: green;
        }

        @media (max-width: 500px) {
            .register-container {
                margin: 20px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>

    <?php
    if (isset($error)) echo "<div class='error'>$error</div>";
    if (isset($message)) echo "<div class='message'>$message</div>";
    ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Choose a Username" required>
        <input type="password" name="password" placeholder="Create a Password" required>
        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>