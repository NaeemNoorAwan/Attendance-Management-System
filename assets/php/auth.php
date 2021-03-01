<?php

require_once 'config.php';

class Auth extends Database
{

    //Register New User
    public function register($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email,:pass)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'pass' => $password]);
        return true;
    }

    //Check if User is already registered
    public function user_exist($email)
    {
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //Method for logged Existing User
    public function login($email)
    {
        $sql = "SELECT email, password FROM users WHERE email = :email AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Current user in Session
    public function currentUser($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }
    //Method for Forgot Password
    public function forgot_password($token, $email)
    {
        $sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':token' => $token, ':email' => $email]);

        return true;
    }

    //Reset Password User Auth
    public function reset_pass_auth($email, $token)
    {
        $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email, 'token' => $token]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //Update New Password
    public function update_new_pass($pass, $email)
    {
        $sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted !=0";


        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['pass' => $pass, 'email' => $email]);

        return true;
    }

    //Update Profile of an User
    public function update_profile($name, $gender, $dob, $phone, $photo, $id)
    {
        $sql = "UPDATE users SET name = :name, gender = :gender, dob = :dob, phone = :phone, photo = :photo WHERE id = :id AND deleted !=0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'photo' => $photo, 'id' => $id]);

        return true;
    }

    //Verify E-mail of User
    public function verify_email($email)
    {
        $sql = "UPDATE users SET verified = 1 WHERE email= :email AND deleted !=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return true;
    }

    //Add Mark Attendance
    public function add_attendance($user_id, $name, $email, $attendance_date, $attendance_status)
    {
        $sql = "INSERT INTO attendance (user_id,name,email,attendance_date,attendance_status) VALUES (:user_id,:name,:email,:attendance_date,:attendance_status)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'name' => $name, 'email' => $email, 'attendance_date' => $attendance_date, 'attendance_status' => $attendance_status]);
        return true;
    }

    //Check if Attendance is already Marked
    public function attendance_exist($user_id, $attendance_date)
    {

        $sql = "SELECT user_id, attendance_date FROM attendance WHERE user_id = :user_id AND attendance_date = :attendance_date";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'attendance_date' => $attendance_date]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    //Fetch All Attendance of An User
    public function get_all_attendance($user_id)
    {
        $sql = "SELECT * FROM attendance WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    //Send Leave Request to Admin
    public function send_Leave_Request($user_id, $user_name, $leave_type, $from_date, $to_date, $description)
    {
        $sql = "INSERT INTO leaves (user_id,user_name,leave_type,from_date,to_date,description) VALUES (:user_id,:user_name,:leave_type,:from_date,:to_date,:description)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id, 'user_name' => $user_name, 'leave_type' => $leave_type, 'from_date' => $from_date, 'to_date' => $to_date, 'description' => $description]);

        return true;
    }
}
