<?php
session_start();
require_once "includes/config.php";

$login_error = "";
$register_error = "";
$register_success = "";

// Handle Login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT id, password, name FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password, $name);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $name;
            $_SESSION["user_email"] = $email;
            header("Location: dashboard.php");
            exit;
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "No user found with this email.";
    }
}

// Handle Registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $name = $_POST["reg_name"];
    $email = $_POST["reg_email"];
    $password = $_POST["reg_password"];
    $confirm_password = $_POST["confirm_password"];
    
    // Validation
    if ($password !== $confirm_password) {
        $register_error = "Passwords do not match.";
    } else if (strlen($password) < 6) {
        $register_error = "Password must be at least 6 characters long.";
    } else {
        // Check if email already exists
        $check_sql = "SELECT id FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();
        
        if ($check_stmt->num_rows > 0) {
            $register_error = "Email already registered.";
        } else {
            // Register new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("sss", $name, $email, $hashed_password);
            
            if ($insert_stmt->execute()) {
                $register_success = "Account created successfully! You can now login.";
            } else {
                $register_error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven - Login & Register</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .user-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        /* Main Content */
        main {
            margin-top: 100px;
            padding: 2rem 0;
            min-height: calc(100vh - 100px);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-container {
            display: flex;
            gap: 3rem;
            max-width: 900px;
            width: 100%;
        }

        .form-section {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .form-section h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #667eea;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #f1f2f6;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            background: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .error-message {
            background: #ff6b6b;
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .success-message {
            background: #51cf66;
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
            color: #666;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #ddd;
            z-index: 1;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            z-index: 2;
        }

        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .form-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .auth-container {
                flex-direction: column;
                gap: 2rem;
            }
            
            .form-section {
                padding: 2rem;
            }
        }

        .cart-icon {
            position: relative;
            font-size: 1.5rem;
            cursor: pointer;
            color: #667eea;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 3rem;
            color: white;
        }

        .welcome-text h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .welcome-text p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <a href="index.php" class="logo">📚 BookHaven</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="user-actions">
                <div class="cart-icon">
                    🛒
                    <span style="position: absolute; top: -8px; right: -8px; background: #ff4757; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 0.8rem; display: flex; align-items: center; justify-content: center;">0</span>
                </div>
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="welcome-text">
                <h1>Welcome to BookHaven</h1>
                <p>Login to your account or create a new one to start your reading journey</p>
            </div>
            
            <div class="auth-container">
                <!-- Login Form -->
                <div class="form-section">
                    <h2>Login</h2>
                    
                    <?php if (!empty($login_error)): ?>
                        <div class="error-message"><?php echo htmlspecialchars($login_error); ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required placeholder="Enter your password">
                        </div>
                        
                        <button type="submit" name="login" class="submit-btn">Login</button>
                    </form>
                    
                    <div class="form-footer">
                        <p>Don't have an account? <a href="register.php">Register here!</a></p>
                    </div>
                </div>
        </div>
    </main>

    <script>
        // Add some interactive effects
        document.querySelectorAll('.form-group input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>