<?php

require_once "result.php";
require_once "user.php";

final class DatabaseContext
{
    private PDO $pdo;
    private const DB_SERVER = 'localhost';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';
    private const DB_DATABASE = 'hello_php';
    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:server=' . self::DB_SERVER . ';dbname=' . self::DB_DATABASE, self::DB_USERNAME, self::DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'ERROR :' . $ex;
            die();
        }
    }

    public function createUser($userFullName, $email, $password): Result
    {
        $stmt = $this->pdo->prepare("INSERT INTO `user` (user_full_name,email,password) VALUES (:userFullName,:email,:password);");
        $stmt->bindValue('userFullName', $userFullName);
        $stmt->bindValue('email', $email);

        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $stmt->bindValue('password', $hashed_password);

        $stmt->execute();
        return Result::success();
    }

    public function checkEmailExist($email) :Result{
        $stmt = $this->pdo->prepare("SELECT 1 FROM `user` WHERE email = :email;");
        $stmt->bindValue("email",$email);

        $stmt->execute();
        if($stmt->rowCount() === 1){
            return Result::failure('ایمیل تکراری است');
        }
        return Result::success();
    }
    public function validateUser($email,$password) : Result{
        $stmt = $this->pdo->prepare("SELECT user_id,user_full_name,password FROM `user` WHERE email = :email;");
//        $stmt = $this->pdo->prepare("SELECT 1,5,2;");
        $stmt->bindValue('email',$email);
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_OBJ);
        if($stmt->rowCount() === 1 && password_verify($password,$res->password)){
            unset($res->password);
            return Result::success($res);
        }
        return Result::failure("ایمیل / کلمه عبور اشتباه است !");
    }
}

return new DatabaseContext();