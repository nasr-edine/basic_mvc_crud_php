<?php
require '../model/models.php';
session_start();
$user = isset($_SESSION['user0']) ? unserialize($_SESSION['user0']) : new User();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
</head>

<body>
    <h2>Update</h2>
    <form action="../index.php?act=update" method="post">
        <div class="form-group <?php echo (!empty($user->first_name_msg)) ? 'has-error' : ''; ?>">
            <label>first_name</label>
            <input type="text" name="first_name" value="<?php echo $user->first_name; ?>">
            <span><?php echo $user->first_name_msg; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($user->last_name_msg)) ? 'has-error' : ''; ?>">
            <label>last_name</label>
            <input type="text" name="last_name" value="<?php echo $user->last_name; ?> ">
            <span><?php echo $user->last_name_msg; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($user->email_msg)) ? 'has-error' : ''; ?>">
            <label>email</label>
            <input type="text" name="email" value="<?php echo $user->email; ?> ">
            <span><?php echo $user->email_msg; ?></span>
        </div>
        <input type="hidden" name="id" value="<?php echo $user->id; ?>" />
        <input type="submit" name="updatebtn" value="Submit">
        <a href="../index.php">Cancel</a>
    </form>

</body>

</html>