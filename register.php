<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all input fields are not empty
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // Check if the email is in a valid format
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Database connection (assuming you have already included dbconfig.php)
            require_once 'config/dbconfig.php'; 
            // Check if the user's email already exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                // Email does not exist, insert the new user into the database
                $insertStmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
                $insertStmt->bindParam(':first_name', $_POST['first_name']);
                $insertStmt->bindParam(':last_name', $_POST['last_name']);
                $insertStmt->bindParam(':email', $_POST['email']);
                $insertStmt->bindParam(':password', $_POST['password']);
                $insertStmt->execute();
                // Save user's information into session
                $_SESSION['user'] = [
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email']
                ];
                $_SESSION['logged_in'] = true;
                // Redirect to member page
                header("Location: member.php");
                exit;
            } else {
                $error = "Email already exists.";
            }
        } else {
            $error = "Invalid email format.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<?php require_once 'templates/header.php'; ?>

        <p>Please fill out the form below to complete your registration:</p>
        
        <!-- Show error if email already exists -->
        <?php if(isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            
            <button type="submit">Register</button>
        </form>
        <?php require_once 'templates/footer.php'; ?>
