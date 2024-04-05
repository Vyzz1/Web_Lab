<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'lab08');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function open_database()
{
    $conn = new mysqli(HOST, USER, PASS, DB);
    if ($conn->connect_error) {
        die('Connection error: ' . $conn->connect_error);
    }
    return $conn;
}
function login($user, $pass)
{
    $sql = "SELECT * FROM account WHERE username=?";
    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $user);
    if (!$stm->execute()) {
        return array('code' => 1, 'error' => 'cannot execute');
    }
    $result = $stm->get_result();
    if ($result->num_rows == 0) {
        return array('code' => 1, 'error' => 'User not found');
    }
    $data = $result->fetch_assoc();
    $hashed_password = $data['password'];
    if (!password_verify($pass, $hashed_password)) {
        return array('code' => 2, 'error' => 'Invalid password');
    } else if ($data['activated'] == 0) {
        return array('code' => 3, 'error' => 'This acccount is not activated');
    }
    return array('code' => 0, 'error' => '', 'data' => $data);
}
function is_email_exists($email)
{
    $sql = 'SELECT username FROM account WHERE email=?';
    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $email);
    if (!$stm->execute()) {
        die("Query failed" . $stm->error);
    }
    $result = $stm->get_result();
    return $result->num_rows > 0;
}
function register($user, $pass, $first, $last, $email)
{
    if (is_email_exists($email)) {
        return array('code' => 1, 'error' => 'Email already exists');
    }
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $rand = random_int(0, 1000);
    $token = md5($user . '+' . $rand);
    $sql = 'insert into account(username,firstname,lastname,email,password,activate_token) values (?,?,?,?,?,?)';
    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('ssssss', $user, $first, $last, $email, $hash, $token);
    if (!$stm->execute()) {
        return array('code' => 2, 'error' => 'cannot execute');
    }
    send_ActivationEmail($email, $token);
    return array('code' => 0, 'error' => 'created successfully');
}
function send_reset_email($email, $token)
{

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function


    //Load Composer's autoloader

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';                          //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vykhanghuynh@gmail.com';                     //SMTP username
        $mail->Password   = 'boydnvvkqsvilerc';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('vykhanghuynh@gmail.com', 'Admin');
        $mail->addAddress($email, 'Người nhận');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Khôi phục mật khẩu của bạn';
        $mail->Body    = "Click <a href='http://localhost:8012/lab8/reset_password.php?email=$email&token=$token'>vào  đây để xác minh";
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
function send_ActivationEmail($email, $token)
{

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function


    //Load Composer's autoloader

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'vykhanghuynh@gmail.com';                     //SMTP username
        $mail->Password   = 'boydnvvkqsvilerc';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('vykhanghuynh@gmail.com', 'Admin');
        $mail->addAddress($email, 'Người nhận');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Xác minh';
        $mail->Body    = "Click <a href='http://localhost:8012/lab8/activate.php?email=$email&token=$token'>vào  đây để xác minh";
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
function activeAccount($email, $token)
{
    $sql = 'select username from account where email = ? and activate_token = ? and activated = 0';

    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('ss', $email,  $token);

    if (!$stm->execute()) {
        return array('code' => 1, 'error' => 'Can not execute command');
    }

    $result = $stm->get_result();
    if ($result->num_rows == 0) {
        return array('code' => 2, 'error' => 'Email address or token not found');
    }

    // found

    $sql = "update account set activated = 1, activate_token = '' where email = ?";
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $email);
    if (!$stm->execute()) {
        return array('code' => 1, 'error' => 'Can not execute command');
    }
    return array('code' => 0, 'message' => 'Account activated');
}
function reset_password($email)
{
    if (!is_email_exists($email)) {
        return array('code' => 1, 'error' => 'Email does not exist');
    }

    $token = md5($email . '+' . random_int(1000, 2000));
    $sql = 'update reset_token set token = ? where email = ?';

    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('ss',  $token, $email);

    if (!$stm->execute()) {
        return array('code' => 2, 'error' => 'Can not execute command');
    }
    if ($stm->affected_rows == 0) {
        $exp = time() + 3600 * 24;
        $sql = 'insert into reset_token values(?,?,?)';
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssi', $email, $token, $exp);
        if (!$stm->execute()) {
            return array('code' => 1, 'error' => 'Can not execute command');
        }
        $success = send_reset_email($email, $token);
        return array('code' => 0, 'success' => $success);
    }
}
