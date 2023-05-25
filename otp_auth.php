<?php 
    require('header.php');
    require ('conn.php');
    $_SESSION['msg'] = 'Authenticated.';
    $contact = $_SESSION["contact"]; 
    $otp1 = $_POST['otp1'];
    $otp2 = $_POST['otp2'];
    $otp3 = $_POST['otp3'];
    $otp4 = $_POST['otp4'];

    $otp_code = $otp1.$otp2.$otp3.$otp4;
    

    if(!isset($otp_code) || empty($otp_code)) {
        header("Location:index.php");
        exit;
     }
    if (isset($_POST['validate'])){
        $sql = "SELECT * FROM `otp-auth` WHERE contact = '$contact' AND CAST(updated_at AS DATE) = CURDATE()";

        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $db_otp_code = $row['otp'];
            $state = $row['state'];
            $url = user_service_url."/api/v2/user/clientOTPVerification/";
            $postData = json_encode([
              "phone_number" => $contact,
              "otp" => $otp_code,
              "state" => $state
            ]);
            $saveInService = postCurl($url,$postData);
            $VerifyData = json_decode($saveInService,true);
           
                if ($VerifyData['status'] == 0 && isset($VerifyData['data']['token'])) {
                    // Set the logged_in flag in the session
                    $_SESSION['logged_in'] = true;
                    $sql = "SELECT * FROM `users` WHERE `contact` = '$contact'";
                    $result_role = $conn->query($sql);
                    if ($result_role) {
                        $row = $result_role->fetch_assoc();
                        $role_id = $row['role_id'];
                        $user_id = $row['id'];
                        $token = $VerifyData['data']['token'];

                        $updateToken = "UPDATE `users` SET `token_auth` = '".$token."' WHERE `id` = $user_id";
                        $update_result = mysqli_query($conn,$updateToken);
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['role_id'] = $role_id; 
                        header("Location: dashboard.php");
                        exit;
                    }else{
                        $_SESSION['msg'] = '<span style="color:red;">Invalid OTP, please try again.</span>';
                        header("Location: otp.php");
                        exit;
                    }
                } else {
                    $_SESSION['msg'] = '<span style="color:red;">Invalid OTP, please try again.</span>';
                    header("Location: otp.php");
                    exit;
                }  
 } 
}

?>



