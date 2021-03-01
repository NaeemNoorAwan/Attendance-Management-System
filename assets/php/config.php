<?php
class Database
{

    const USERNAME = 'naeemnoorawan23@gmail.com';
    const PASSWORD = '<Mylove 100>';

    private $dsn = "mysql:host=localhost;dbname=db_attendance_system";
    private $dbuser = "root";
    private $dbpass = "";

    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->dbuser, $this->dbpass);

            // echo 'Connected Successfully to the Database';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $this->conn;
    }

    //Check Input------ method
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Error Success Message Alert--------Method
    public function showMessage($type, $message)
    {
        return '<div class="alert alert-' . $type . ' alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong class="text-center">' . $message . '</strong>
        </div>';
    }
}
