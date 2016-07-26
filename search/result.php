<?php
include('db.php');
if($_POST)
{
    $q = mysqli_real_escape_string($connection,$_POST['search']);
    $strSQL_Result = mysqli_query($connection,"select Staff_ID, S_Name, S_Username from staff where S_Name like '%$q%' or S_Username like '%$q%' order by Staff_ID LIMIT 5");
    while($row=mysqli_fetch_array($strSQL_Result))
    {
        $username   = $row['S_Name'];
        $email      = $row['S_Username'];
        $b_username = '<strong>'.$q.'</strong>';
        $b_email    = '<strong>'.$q.'</strong>';
        
        ?>
            <div class="show" align="left">
                <span class="name"><?php echo $username; ?></span>&nbsp;<br/>         </div>
        <?php
    }
}
?>