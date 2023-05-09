<?php 
    require ('conn.php');
    session_start();

    $_SESSION['msg'] = 'Authenticated.';
    $contact = $_SESSION["contact"]; 

    $otp1 = $_POST['otp1'];
    $otp2 = $_POST['otp2'];
    $otp3 = $_POST['otp3'];
    $otp4 = $_POST['otp4'];

    $otp_code = $otp1.$otp2.$otp3.$otp4;
    
    if (isset($_POST['validate'])){
        $sql = "SELECT * FROM `otp-auth` WHERE contact = '$contact' AND CAST(updated_at AS DATE) = CURDATE()";

        $result = $conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            $db_otp_code = $row['otp'];

                if ($otp_code == $db_otp_code) {
                    // Set the logged_in flag in the session
                    $_SESSION['logged_in'] = true;

                    header("Location: dashboard.php");
                    exit;
                } else {
                    $_SESSION['msg'] = '<span style="color:red;">Invalid OTP, please try again.</span>';
                    header("Location: otp.php");
                    exit;
                }
    }    
} 

?>



