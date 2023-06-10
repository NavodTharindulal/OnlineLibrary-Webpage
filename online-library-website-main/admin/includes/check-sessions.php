<?php 
    // checking if a user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?log_out=5');
    }
// checking if a admin or user
$userid = $_SESSION['user_id'];
// get user status
$query = "SELECT * FROM admins WHERE id='{$userid}'";
$login = mysqli_query($connection, $query);
$login_u = mysqli_fetch_assoc($login);

if($login_u["is_deleted"] == 1){?>
	<script>parent.location.href = 'logout.php?log_out_code=2';</script>
<?php } ?>
