<?php 
    include('header_login.php');
    require ('conn.php');
    $_SESSION['msg'] = 'Authenticated.';
    $contact = $_SESSION["contact"]; 
    // $otp1 = $_POST['otp1'];
    // $otp2 = $_POST['otp2'];
    // $otp3 = $_POST['otp3'];
    // $otp4 = $_POST['otp4'];

    $otp_code = $_POST['password'];
    

    if(!isset($otp_code) || empty($otp_code)) {
        header("Location:index.php");
        exit;
     }
    if (isset($_POST['validate'])){
        $sql = "SELECT * FROM `users` WHERE contact = '$contact'";

        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $checkId = $row['id'];
            $token_auth = base64_decode($row['token_auth']);
            // echo $token_auth; exit;
                if ($token_auth == $otp_code) {
                    // Set the logged_in flag in the session
                    $_SESSION['logged_in'] = true;
                   
                        $role_id = $row['role_id'];
                        $user_id = $row['id'];
                        $authToken = $user_id."|".$role_id;
                        
                        $tokenData = encrypt($authToken,secret_key);

                        setcookie('tokenData', $tokenData ,time() + (86400 * 365 * 100), "/");
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['role_id'] = $role_id; 
                        header("Location: dashboard.php");
                        exit;
                    
                } else {
                    $_SESSION['msg'] = '<span style="color:red;">'.$lang['invalid_otp'].'</span>';
                    header("Location: otp.php");
                    exit;
                }  
 } 
}

?>



