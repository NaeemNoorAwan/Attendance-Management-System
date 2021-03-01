<?php

require_once 'session.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

//Handle Profile Update Ajex Request 
if (isset($_FILES['image'])) {
    $name = $cuser->test_input($_POST['name']);
    $gender = $cuser->test_input($_POST['gender']);
    $dob = $cuser->test_input($_POST['dob']);
    $phone = $cuser->test_input($_POST['phone']);

    $oldImage = $_POST['oldimage'];
    $folder = 'uploads/';

    if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
        $newImage = $folder . $_FILES['image']['name']; //Path of Uploaded Image that will stored in $newImage Variable
        move_uploaded_file($_FILES['image']['tmp_name'], $newImage); // This will move the uploaded image to uploads Folder

        if ($oldImage != null) {
            unlink($oldImage); // Delete the old image

        }
    } else {
        $newImage = $oldImage;
    }
    $cuser->update_profile($name, $gender, $dob, $phone, $newImage, $cid); // Call update_profile method Here
}


//Handle Verify Email Request
if (isset($_POST['action']) && $_POST['action'] == 'verify_email') {

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = Database::USERNAME;
        $mail->Password = Database::PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom(Database::USERNAME, 'NaeemNoorSoft');
        $mail->addAddress($cemail);

        // Content
        $mail->isHtml(true);
        $mail->Subject = 'E-Mail Verification';
        $mail->Body = '<h3>Click the below link to Verify Your E-Mail.<br><a href="http://localhost/attendance-system/verify-email.php?email=' . $cemail . '">http://localhost/attendance-system/verify-email.php?email=' . $cemail . '</a><br>Regards<br>NaeemNoorSoft!</h3>';

        $mail->send();
        echo $cuser->showMessage('success', 'Verification link sent to your E-mail ID, Please check your E-mail!');
    } catch (Exception $e) {
        echo $cuser->showMessage('danger', 'Something went wrong please try again later!');
    }
}

//Handle Mark Attendance Ajax Request------  
if (isset($_POST['action']) && $_POST['action'] == 'mark_atten') {
    $attendance_date = $cuser->test_input($_POST['attendanceDate']);

    $attendance_status = $cuser->test_input($_POST['attendanceStatus']);
    if ($cuser->attendance_exist($cid, $attendance_date)) {
        echo $cuser->showMessage('warning', 'Attendance is already marked!');
    } else {
        if ($cuser->add_attendance($cid, $cname, $cemail, $attendance_date, $attendance_status)) {
            echo $cuser->showMessage('success', 'Attendance marked successfully!');
            $_SESSION['cuser'] = $attendance_date;
        } else {
            echo $cuser->showMessage('danger', 'Something went wrong! Please try again later!');
        }
    }
}

//Handle Display All Attendance of An User
if (isset($_POST['action']) && $_POST['action'] == 'display_attendance') {
    $output = '';
    $allAttendance = $cuser->get_all_attendance($cid);

    if ($allAttendance) {
        $output .= '<table class="table table-striped text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Attendance Date</th>
                <th>Attendance Status</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($allAttendance as $row) {
            $output .= '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['user_id'] . '</td>
            <td>' . $row['name'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['attendance_date'] . '</td>
            <td>' . $row['attendance_status'] . '</td>
            </tr>';
        }
        $output .= '</tbody>
        </table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary">:( You have No Attendance!</h3>';
    }
}

//Handle Send Leave to Admin Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'leave') {
    $leave_type = $cuser->test_input($_POST['leaveType']);
    $from_date = $cuser->test_input($_POST['fromDate']);
    $to_date = $cuser->test_input($_POST['toDate']);
    $description = $cuser->test_input($_POST['description']);

    $cuser->send_Leave_Request($cid, $cname, $leave_type, $from_date, $to_date, $description);
}
