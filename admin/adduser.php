<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
    if(!Session::get('userRole') == '0'){
        echo "<script>window.location = 'index.php';</script>";
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock"> 

        <?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $fm->validation($_POST['username']);
            $Password = $fm->validation(md5($_POST['Password']));
            $email    = $fm->validation($_POST['email']);
            $role     = $fm->validation($_POST['role']);

			$username = mysqli_real_escape_string($db->link, $username);
            $Password = mysqli_real_escape_string($db->link, $Password);
            $email    = mysqli_real_escape_string($db->link, $email);
            $role     = mysqli_real_escape_string($db->link, $role);

            if(empty($username) || empty($Password) || empty($email) || empty($role)){
                echo "<span class='error'>Feild must not empty !!</span>";
            }

            else{
                $mailquery = "select * from tbl_user where email = '$email' limit 1";
                $mailcheck = $db->select($mailquery);
                if($mailcheck != false){
                    echo "<span class='error'>Email Already Exist !!</span>";
                }

                else{
                    $query = "insert into tbl_user(username, Password, email, role) values('$username', '$Password', '$email', '$role')";
                    $catinsert = $db->insert($query);
                    if($catinsert){
                        echo "<span class='success'>User Created suceefully !!</span>";
                    }
                    else{
                        echo "<span class='error'>User not Created !!</span>";
                    }
                }
            }
        }
        ?>

            <form action="" method="POST">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter username..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Password</label>
                        </td>
                        <td>
                            <input type="text" name="Password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter valid Email Address..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>User role</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option>Select User Role</option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>
                            </select>
                        </td>
                    </tr>

                    <tr> 
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
