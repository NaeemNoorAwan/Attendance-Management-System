<?php
require_once 'config.php';

class Admin extends Database
{

    //Admin Login
    public function admin_login($username, $password)
    {
        $sql = "SELECT username, password FROM admin WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]); // Binding username and password
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Count Total No. of Rows
    public function totalCount($tablename)
    {
        $sql = "SELECT * FROM $tablename";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        return $count;
    }

    //Count Total Verifid/Unverifid Users
    public function verified_users($status)
    {
        $sql = "SELECT * FROM users WHERE verified = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['status' => $status]);
        $count = $stmt->rowCount();

        return $count;
    }

    //Genders Percentage
    public function genderPer()
    {
        $sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // User's Verifid/Unverifid Percentage
    public function verifiedPer()
    {
        $sql = "SELECT verified, COUNT(*) AS number FROM users GROUP BY verified";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //Count Web Hits
    public function site_hits()
    {
        $sql = "SELECT hits FROM visitors";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        return $count;
    }

    //Fetch All Registered Users
    public function fetchAllUsers($val)
    {
        $sql = "SELECT * FROM users WHERE deleted != $val";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //Fetch User's Details by ID
    public function fetchUserDetailsByID($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //Delete An User
    public function userAction($id, $val)
    {
        $sql = "UPDATE users SET deleted = $val WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return true;
    }

    //Fetch All Registered Users Attendance
    public function fetchAllAttendance()
    {
        $sql = "SELECT * FROM attendance";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //Fetch Attendance Details by ID
    public function fetchAttendanceDetailsByID($id)
    {
        $sql = "SELECT * FROM attendance WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //Delete Attendance of User
    public function deleteAttendanceAction($id)
    {
        $sql = "DELETE FROM `attendance` WHERE `attendance`.`id` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return true;
    }

    //Edit Attendance Details by ID
    public function editAttendanceByID($id)
    {
        $sql = "SELECT * FROM attendance WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //Update Attendance of User
    public function update_attendance($id, $attendance_date, $attendance_status)
    {
        $sql = "UPDATE attendance SET attendance_date = :attendance_date, attendance_status = :attendance_status WHERE id=:id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['attendance_date' => $attendance_date, 'attendance_status' => $attendance_status, 'id' => $id]);

        return true;
    }
}
