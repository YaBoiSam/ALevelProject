<html>
<title>Login</title>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="http://fabrizio.me.uk/wp-content/uploads/2010/07/11949848541326072700padlock_aj_ashton_01.svg_.hi1_.png" />
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="webpagebackground.css">
    <script src="buttonFunctions.js"></script>
    <script src="functions.js"></script>
</head>
<body>


<!-- <h3>Don't put in real passwords it isn't encrypted yet!</h3> -->

<?php
if ((array_key_exists('loginUsername',$_POST)) and ($_POST['loginUsername']) and (array_key_exists('loginPassword',$_POST)) and ($_POST['loginPassword']))
{
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

<form id="loginForm" name="loginForm" method="post" action="<?php echo $PHP_SELF?>">
    <table width="500px" border="0" cellpadding="4" cellspacing="4">
        <tr>
            <td width="30%" class="normal_text"><usernameInputDesign><b>Username</b></usernameInputDesign></td>
            <td colspan="2"> <p>
                    <input class="mainLoginRegisterInput" name="loginUsername" type="text" id="loginUsername" size="25" maxlength="15" placeholder="Username"  required/>
                </p>
        </tr>
        <tr>
            <td width="30%" class="normal_text"><passwordInputDesign><b>Password</b></passwordInputDesign></td>
            <td colspan="2"> <p>
                    <input class="mainLoginRegisterInput" name="loginPassword" type="password" id="loginPassword" size="25" maxlength="15" placeholder="Password"  required/>
                </p>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Login">
            </td>
        </tr>
    </table>
</form>

<div class="FixedBackground"></div>
<registerButton><button id="registerButton" class="buttonFormat">Register</button></registerButton>
<script>document.getElementById("registerButton").onclick = function() {registerButtonOnClick()};</script>
</body>

</html>