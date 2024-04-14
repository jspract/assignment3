<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password fields are not empty
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Check if the email is in a valid format
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Database connection 
            require_once 'config/dbconfig.php';
            
            // Prepare SQL statement to select user by email and password
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':password', $_POST['password']);
            $stmt->execute();
            
            // Check if user exists
            if ($stmt->rowCount() > 0) {
                // User exists, fetch user data
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                // Save user's information into session
                $_SESSION['user'] = $user;
                $_SESSION['logged_in'] = true;
                // Redirect to member page
                header("Location: member.php");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email format.";
        }
    } else {
        $error = "Both email and password are required.";
    }
}
?>

<?php require_once 'templates/header.php'; ?>

        <p>Welcome to my website! This is a test website demonstrating the logina and register functionality.</p>
        <br>
        <p>There is an option to add user to the database through register page. The public page (index.php) is accessible for all but the prvate page (member.php) can only be accessed by logged in users.</p>

        <br>
        <!-- Show error if the username/password is incorrect -->
        <?php if(isset($error)) { ?>
            <p class="error"><?php echo $error; ?> <br> </p>
        <?php } ?>
        
        <?php if(!isset($_SESSION['user'])) { ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            
            <button type="submit">Login</button>
        </form>
        <?php } ?>



        <?php require_once 'templates/footer.php'; ?>
