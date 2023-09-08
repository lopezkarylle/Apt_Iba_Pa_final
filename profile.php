<?php
use Models\User;
include ("init.php");
include ("session.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 2){
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'] ?? NULL;

$user = new User();
$user->setConnection($connection);
$user = $user->getById($user_id);

$first_name = $user['first_name'];
$last_name = $user['last_name'];
$contact_number = $user['contact_number'];
$email = $user['email'];
$salt = $user['salt'];
$password = $user['password'];
$image_name = $user['image_name'] ?? NULL;
?>
<?php if(isset($image_name)): ?>
<img src="../resources/images/users/<?= $image_name ?>" height="100" width="100">
<?php endif ?>
<input type="text" value="<?= $first_name ?>">
<input type="text" value="<?= $last_name ?>">
<input type="text" value="<?= $contact_number ?>">
<input type="text" value="<?= $email ?>">
<input type="text" value="<?= $password ?>">
<input type="submit" name="update_user" value="Update">

<?php
try {
     if(isset($_POST['update_user'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $salt = $_POST['salt'];
        $password = $_POST['password'];
        $image_name = $_POST['image_name'];
     }
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}
?>