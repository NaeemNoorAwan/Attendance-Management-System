<?php
require_once 'admin-db.php';

$admin = new Admin();
session_start();

//Handle Admin Login Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'adminLogin') {
    $username = $admin->test_input($_POST['username']);
    $password = $admin->test_input($_POST['password']);

    $hpassword = sha1($password);

    $loggedInAdmin = $admin->admin_login($username, $hpassword);

    if ($loggedInAdmin != null) {
        echo 'admin_login';
        $_SESSION['username'] = $username;
    } else {
        echo $admin->showMessage('danger', 'Username or Password is Incorrect');
    }
}

//Handle Fetch ALL Users Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers') {
    $output = '';
    $data = $admin->fetchAllUsers(0);
    $path = '../assets/php/'; //To show Images of Users in admin-users.php, we have to give the Path of the images.. we have written Uploads in photo Col in db so no need to write Uploads here..
    if ($data) {
        $output .= '<table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Verified</th>
                        <th>Action</th>
                    </tr
                </thead>
                <tbody>';
        foreach ($data as $row) {
            if ($row['photo'] != '') {
                $uphoto = $path . $row['photo'];
            } else {
                $uphoto = '../assets/img/no_image_available.PNG';
            }
            $output .= '<tr>
                                    <td>' . $row['id'] . '</td>
                                    <td><img src="' . $uphoto . '" class="rounded-circle" width="40px"></td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['phone'] . '</td>
                                    <td>' . $row['gender'] . '</td>
                                    <td>' . $row['verified'] . '</td>
                                    <td>
                                    <a href="#" id="' . $row['id'] . '" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fas fa-info-circle fa-lg"></i>
                                    </a>&nbsp;&nbsp;

                                    <a href="#" id="' . $row['id'] . '" title="Delete User" class="text-danger deleteUserIcon"><i class="fas fa-trash-alt fa-lg"></i>
                                    </a>&nbsp;&nbsp;
                                    </td>
                                </tr>';
        }
        $output .= '</tbody>
                </table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary">:( No any user registered yet!)</h3>';
    }
}

//Handle Display User In Details Ajax Request
if (isset($_POST['details_id'])) {
    $id = $_POST['details_id'];

    $data = $admin->fetchUserDetailsByID($id);

    echo json_encode($data);
}

//Handle Delete an User Ajax Request
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $admin->userAction($id, 0);
}

//Handle Fetch ALL Attendance Ajax Request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllAttendance') {
    $output = '';
    $data = $admin->fetchAllAttendance();

    if ($data) {
        $output .= '<table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Attendance Date</th>
                        <th>Attendance Status</th>
                        <th>Action</th>
                    </tr
                </thead>
                <tbody>';
        foreach ($data as $row) {
            $output .= '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['user_id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['attendance_date'] . '</td>
                    <td>' . $row['attendance_status'] . '</td>

                    <td>
                        <a href="#" id="' . $row['id'] . '" title="View Details" class="text-success attendanceDetailsIcon" data-toggle="modal" data-target="#showAttendanceDetailsModal"><i class="fas fa-info-circle fa-lg"></i>
                        </a>&nbsp;&nbsp;

                        <a href="#" id="' . $row['id'] . '" title="Edit Attendance" class="text-primary editAttendanceIcon" data-toggle="modal" data-target="#editAttendanceModal"><i class="fas fa-edit fa-lg"></i>
                        </a>&nbsp;&nbsp;

                        <a href="#" id="' . $row['id'] . '" title="Delete Attendance" class="text-danger deleteAttendanceIcon"><i class="fas fa-trash-alt fa-lg"></i>
                        </a>&nbsp;&nbsp;

                    </td>
                    </tr>';
        }
        $output .= '</tbody>
                </table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary">:( No any user registered yet!)</h3>';
    }
}

//Handle Display Attendance In Details Ajax Request
if (isset($_POST['attendanceDetails_id'])) {
    $id = $_POST['attendanceDetails_id'];

    $data = $admin->fetchAttendanceDetailsByID($id);

    echo json_encode($data);
}

//Handle Delete User Attendance Ajax Request
if (isset($_POST['deleteAttendance_id'])) {
    $id = $_POST['deleteAttendance_id'];
    $admin->deleteAttendanceAction($id);
}

//Handle Edit User Attendance Ajax Request
if (isset($_POST['attendanceEdit_id'])) {
    $id = $_POST['attendanceEdit_id'];

    $data = $admin->editAttendanceByID($id);
    echo json_encode($data);
}


//Handle Update User Attendance Ajax Request

// if (isset($_POST['action']) && $_POST['action'] == 'update_attendance') {
//     $id = $admin->test_input($_POST['id']);
//     $attendance_date = $admin->test_input($_POST['attendance_date']);
//     $attendance_status = $admin->test_input($_POST['attendance_status']);

//     $admin->update_attendance($id, $attendance_date, $attendance_status);
// }
