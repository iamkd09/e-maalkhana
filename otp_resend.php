<?php 
    include('header_login.php');
    require ('conn.php');
    $_SESSION['msg'] = 'OTP resent successfully!';
    $contact = $_SESSION["contact"]; 
    
    if (!empty($contact)) {
        $mob = "SELECT * FROM `users` WHERE contact = $contact";
          $res = $conn->query($mob);
          $row = $res->fetch_assoc();
          if(is_array($row) && !empty($res)) {
            $check_mob = $row['contact'];
            $status = $row['status'];
          } else {
            $check_mob = '';
            $status = '';
          }
          
        if (!empty($check_mob)) {

          if ($status == 1) {
                        if(!empty($contact)){
                          
           
                          $users = json_decode($saveInService, true);
                          $status = $users['status'] ?? 1;
                          $state = $users['state'] ?? null;
                          $otp = $users['otp'] ?? 0000;
    
                          $mobile_number = "SELECT * FROM `otp-auth` WHERE `contact` = $contact ";
                          $result = $conn->query($mobile_number);
                          $row = $result->fetch_assoc();
                          $check_contact = $row['contact'] ?? null;
                              if(!empty($check_contact)){
                $update = "UPDATE `otp-auth` SET `otp` =  '$otp', `state` = '$state',`updated_at` = NOW() WHERE `contact` = $contact ";
                $updated_result = $conn->query($update);
                                $_SESSION['resend'] = $updated_result;
                if($updated_result){
                  header("Location: otp.php");
                }
              }else{
                               $insert = "INSERT INTO `otp-auth` (`contact`, `otp`,`state`) VALUES ( '$contact', '$otp','$state')";
                               $result_insert = $conn->query($insert);
                                  if($result_insert){
            header("Location: otp.php");
          }
        }
      }
    }
          else {
            $error ='<span style="color:red;">User is not active, please try again.</span>';
          }
      } else {
        $error ='<span style="color:red;">Invalid User!.</span>';
         }
      }

?>



