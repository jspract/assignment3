<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all input fields are not empty
    if (!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        //I have not implemented the actual email functionality
        $success = "Your message has been sent successfully!";
     
}
?>
<?php require_once 'templates/header.php'; ?>

        <?php if(isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        
        <?php if(isset($success)) { ?>
            <p><?php echo $success; ?></p>
        <?php } ?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="5" required></textarea><br>
            
            <button type="submit">Send Message</button>
        </form>
<?php require_once 'templates/footer.php'; ?>
