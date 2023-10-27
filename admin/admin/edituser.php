
<?php
session_start();
include("../../db.php");
$user_id = $_REQUEST['user_id'];

$first_name = ""; // Initialize the variables with empty values
$last_name = "";
$email = "";
$user_password = "";

// Check if the form has been submitted
if (isset($_POST['btn_save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Update user data in the database
    mysqli_query($con, "UPDATE user_info SET first_name='$first_name', last_name='$last_name', email='$email', password='$user_password' WHERE user_id='$user_id'") or die("Query is incorrect..........");

    header("location: manageuser.php");
    mysqli_close($con);
} else {
    // Fetch user data from the database
    $result = mysqli_query($con, "SELECT * FROM user_info WHERE user_id='$user_id'");
    if ($row = mysqli_fetch_assoc($result)) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $user_password = $row['password'];
    } else {
        // Handle the case where the user with the specified user_id is not found.
        // You can redirect or display an error message.
    }
}

include "sidenav.php";
include "topheader.php";
?>


<!-- HTML form for editing user information -->
<div class="content">
    <div class="container-fluid">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h5 class="title">Edit User</h5>
                </div>
                <form action="edituser.php" name="form" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" id="password" class="form-control" value="<?php echo $user_password; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
