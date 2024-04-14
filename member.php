<?php
session_start();
// Check if user is not logged in, redirect to the home page
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Get user information from session
$user = $_SESSION['user'];
?>

<?php require_once 'templates/header.php'; ?>

        <p>This is the member page. </p>
        <!-- Print user details - name and email -->    
        <p>You are logged in as <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>.</p>

        <p>Your Email is <?php echo $user['email']; ?></p>
        <!-- Secret message :) -->

        <p>Here is a secret message for you.</p>

        <pre>
        In darkened woods the smell of fallen showers all around
        keep in time with may day flowers make love to the ground
        I see the tree that watches me and listens to my sound
        a tree by any other name would surely cut me down

        I am the lord high human being seeing, knowing all
        I am mother nature's matricidal son and that is all

        A black hawk moving slowly through the darkness of the night
        some creature small with back to wall shall be his prey tonight
        the morning sun creates world news as he puts up a fight
        a sun by any other name would surely shed me light

        </pre>
        <!-- Additional logout button -->
        <p>You can <a href="logout.php">logout</a> if you're done.</p>

<?php require_once 'templates/footer.php'; ?>