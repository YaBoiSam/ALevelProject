<!DOCTYPE html>
<html>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <script src="buttonFunctions.js"></script>
<body>

<?php
echo "hello";
echo $_POST['loginUsername'];

if ((array_key_exists('loginUsername',$_POST)) and ($_POST['loginUsername']) and (array_key_exists('loginPassword',$_POST)) and ($_POST['loginPassword']))
{
    echo "hello";
    $_loginUsername = $_POST['loginUsername'];
    $_loginPassword = $_POST['loginPassword'];
    $database = new mysqli("computing.warwickschool.org", "Sam", "c0mput1n9", "sam");
    $getLoginInfoQuery = "SELECT username, password FROM logininfo";
    $getLoginInfoResult = mysqli_query($database, $getLoginInfoQuery);
    $AccessGranted = "Denied";

    if($getLoginInfoResult){
        $row=mysqli_fetch_array($getLoginInfoResult);
        while($row)
        {
            if ($row['username']==$_loginUsername)
            {
                if ($row['password']==$_loginPassword)
                {
                    $AccessGranted = "Granted";
                    break;
                }
            }
            $row=mysqli_fetch_array($getLoginInfoResult);
        }
    }
    if ($AccessGranted=="Granted")
    {
        $getUser_idQuery = "SELECT user_id FROM logininfo WHERE username LIKE  '%".$_POST['loginUsername']."%'";
        $getUser_idResult = mysqli_query($database, $getUser_idQuery);
        $row=mysqli_fetch_row($getUser_idResult);
        echo "user_id - " , $row[0];
        $_user_id = $row[0];
        session_start();
        $_SESSION['_user_id'] = $_user_id;
        ?>
        <script>successfulLogin();</script>
        <?php
    }
    mysqli_close($database);
}
?>

    <form id="loginForm" name="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table width="500px" border="0" cellpadding="4" cellspacing="4" class="tableFormat">
            <tr>
                <td width="30%" class="normal_text"><b>Username</b></td>
                <td colspan="2"> <p>
                    <input class="mainLoginRegisterInput" name="loginUsername" type="text" id="loginUsername" size="25" maxlength="15" placeholder="Username"  required/>
                </p>
            </tr>
            <tr>
                <td width="30%" class="normal_text"><b>Password</b></td>
                <td colspan="2"> <p>
                    <input class="mainLoginRegisterInput" name="loginPassword" type="password" id="loginPassword" size="25" maxlength="15" placeholder="Password"  required/>
                </p>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="loginButton" value="Login">
                </td>
            </tr>
        </table>
    </form>
    <div class="FixedBackground"></div>
    <registerButton><button id="registerButton" class="buttonFormat">Register</button></registerButton>
    <script>document.getElementById("registerButton").onclick = function() {registerButtonOnClick()};</script>
</body>

</html>