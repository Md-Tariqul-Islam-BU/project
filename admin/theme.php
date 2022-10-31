<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Themes</h2>
        <div class="block copyblock">
        
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $theme = mysqli_real_escape_string($db->link, $_POST['theme']); 
            $query = "UPDATE tbl_theme SET theme='$theme' WHERE id='1'";
            $updated_row = $db->update($query);
            
            if($updated_row){
                echo("<span style='color: green; font-size: 18px;'>New Theme updated successfully.</span>"); 
            }
            else{
                echo("<span style='color: red; font-size: 18px;'>Theme not updated.</span>");
            }
        }
        ?>

<?php
    $query = "select * from tbl_theme where id='1'"; 
    $themes = $db->select($query);
    while($result = $themes->fetch_assoc()){
?>

        <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input 
                        <?php if($result['theme'] == 'default'){echo "checked";} ?> 
                        type="radio" name="theme" value="default"/>Default
                    </td>
                </tr>
                <tr>
                    <td>
                        <input 
                        <?php if($result['theme'] == 'color1'){echo "checked";} ?> 
                         type="radio" name="theme" value="color1"/>Color1
                    </td>
                </tr>
                <tr>
                    <td>
                        <input
                        <?php if($result['theme'] == 'color2'){echo "checked";} ?> 
                         type="radio" name="theme" value="color2"/>Color2
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Change" />
                    </td>
                </tr>
            </table>
        </form>
            <?php } ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php';?>
