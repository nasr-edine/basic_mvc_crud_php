<?php
require '../model/models.php';
session_start();
$sporttb = isset($_SESSION['sporttbl0']) ? unserialize($_SESSION['sporttbl0']) : new user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
</head>

<body>
    <h2>Add</h2>
    <p>Please fill this form and submit to add new record in the database.</p>

    <form action="../index.php?act=add" method="post">
        <div>
            <label>first_name</label>
            <input type="text" name="first_name" value="<?php echo $sporttb->first_name; ?>">
            <span><?php echo $sporttb->first_name_msg; ?></span>
        </div>
        <div>
            <label>last_name</label>
            <input name="last_name" value="<?php echo $sporttb->last_name; ?>">
            <span><?php echo $sporttb->last_name_msg; ?></span>
        </div>
        <div>
            <label>email</label>
            <input name="email" value="<?php echo $sporttb->email; ?>">
            <span><?php echo $sporttb->email_msg; ?></span>
        </div>
        <input type="submit" name="addbtn" value="Submit">
        <a href="../index.php">Cancel</a>
    </form>
</body>

</html>