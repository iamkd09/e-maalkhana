<?php
session_start();
include('conn.php');

if (isset($_POST['gd_number'])) {
    $gd_number = $_POST['gd_number'];

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM `inventory` WHERE `Gd_Number` = '$gd_number' AND (`category_id` = 2 OR `category_id` = 4) AND  `Created_By` = '$user_id' ";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $current_status = $row['Status'];

        if ($current_status = 1) {
            $created_at = $row['Created_at'];
            $created_by = $row['Created_By'];
            $gd_number = $row['Gd_Number'];
            $id = $row['id'];
            $current_date = date('Y-m-d');
            $date_diff = date_diff(date_create($created_at), date_create($current_date));
            $days_diff = $date_diff->days;

            if ($days_diff >= 365) {
                $update_query = "UPDATE `inventory` SET `Status` = '3' WHERE `Gd_Number` = '$gd_number' AND (`category_id` = 2 OR `category_id` = 4) AND  `Created_By` = '$user_id'  ";
                $update_result = mysqli_query($conn, $update_query);

                if ($update_result) {
                    $inward_id = $id;
                    $subject = 'Scrapped';

                    $insert_query = "INSERT INTO `sa_log` (`inward_id`, `subject`, `created_by`) VALUES ('$inward_id', '$subject', '$created_by')";
                    $insert_result = mysqli_query($conn, $insert_query);

                    if ($insert_result) {
                        echo 'success';
                    } else {
                        echo 'error';
                    }
                } else {
                    echo 'error';
                }
            } else {
                echo 'not_scrapable';
            }
        } else {
            echo 'already_scraped';
        }
    } else {
        echo 'not_found';
    }
} else {
    echo 'invalid_request';
}
?>
