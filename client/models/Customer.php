<?php
require_once "config/connect.php";
class Customer
{
    public static function addCustommer($name, $email, $phone, $password, $address)
    {
        global $cont;

        $sql = "SELECT * FROM customer where email ='$email' or phone='$phone'";

        $result = mysqli_query($cont, $sql);

        if (mysqli_num_rows($result) > 0) {
            return -1;
        }
        $sqlinsert = "INSERT INTO customer(name,email,phone,password,address) value ('$name','$email','$phone','$password','$address')";

        if (mysqli_query($cont, $sqlinsert)) {
            return 1;
        }
        return 0;

    }

    public static function checkstatus($email, $password)
    {
        global $cont;

        $sql = "SELECT * from customer where email='$email' and password='$password' and status = 0";

        $result = mysqli_query($cont, $sql);

        if (mysqli_num_rows($result) > 0) {
            return 0;
        }
        return 1;
    }
    public static function checkLogin($email, $password)
    {
        global $cont;

        $sql = "SELECT * from customer where email='$email' and password='$password'";

        $result = mysqli_query($cont, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row["id"];
        }
        return -1;
    }

    public static function getCustomerById($id)
    {
        global $cont;

        $sql = "SELECT * FROM customer where id = $id";

        $result = mysqli_query($cont, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    }

    public static function updateCustomer($id, $name, $email, $phone, $address)
    {
        global $cont;

        $sql = "UPDATE customer SET name='$name', email='$email',phone = '$phone', address='$address' where id = $id ";

        if (mysqli_query($cont, $sql)) {
            return true;
        }
        return false;
    }

    public static function checkPass($id, $password)
    {
        global $cont;
        $sql = "SELECT * FROM customer where id = $id and password = '$password'";

        $result = mysqli_query($cont, $sql);

        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        return false;
    }

    public static function updatePass($id, $newpassword)
    {
        global $cont;

        $sql = "UPDATE customer set password = '$newpassword' where id = $id";

        if (mysqli_query($cont, $sql)) {
            return true;
        }
        return false;
    }

    public static function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function getCustomerByEmail($email)
    {
        global $cont;

        $sql = "SELECT * FROM customer where email = '$email'";
        $data = null;
        $result = mysqli_query($cont, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data = $row;
            }
        }
        return $data;
    }

    public static function addRecoveryCode($id, $recoverycode)
    {
        global $cont;
        $sql = "UPDATE customer set recoverycode = '$recoverycode' where id = $id";
        if (mysqli_query($cont, $sql)) {
            return true;
        }
        return false;
    }


    public static function checkRecoveryCode($recoverycode)
    {
        global $cont;
        $sql = "SELECT * FROM customer where recoverycode = '$recoverycode' and updated_at >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)";

        $result = mysqli_query($cont, $sql);

        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        return false;
    }

    public static function resetPass($recoverycode, $pass)
    {
        global $cont;
        $rc = Customer::generateRandomString(50);
        $sql = "UPDATE customer set password='$pass',recoverycode='$rc' where recoverycode = '$recoverycode'";
        if (mysqli_query($cont, $sql)) {
            return true;
        }
        return false;
    }
}
?>