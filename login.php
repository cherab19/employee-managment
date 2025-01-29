<?php
session_start();
$conn = new mysqli("localhost", "root", "", "diredawa_university");

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Limit login attempts
$maxAttempts = 5;
$lockoutTime = 5 * 60; // 5 minutes
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $maxAttempts) {
    if (time() < $_SESSION['lockout_time']) {
        die("Too many login attempts. Please try again later.");
    } else {
        // Reset attempts after lockout period
        unset($_SESSION['login_attempts']);
        unset($_SESSION['lockout_time']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Regenerate session ID to prevent session fixation
                session_regenerate_id(true);
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Invalid username or password!";
                incrementLoginAttempts();
            }
        } else {
            $error = "Invalid username or password!";
            incrementLoginAttempts();
        }
    }
}

function incrementLoginAttempts() {
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }
    $_SESSION['login_attempts']++;
    if ($_SESSION['login_attempts'] >= 5) {
        $_SESSION['lockout_time'] = time() + (15 * 60); // Lockout for 15 minutes
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DIRE DAWA UNIVERSITY EMPLOYEE MANAGEMENT SYSTEM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://th.bing.com/th/id/OIP.rel6cuERP0IGrt23Rk16lwHaEI?rs=1&pid=ImgDetMain');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 3px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        p {
            text-align: center;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>