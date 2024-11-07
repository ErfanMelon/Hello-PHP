<?php

final class User
{
    public int $user_id;
    public string $userFullName;
    public string $email;
    private string $password;
    private int $created_at;
    function __construct($userFullName, string $email)
    {
        $this->userFullName = $userFullName;
        $this->email = $email;
        $this->created_at = time();
    }
    public static function create(string $userFullName, string $email)
    {
        return new self($userFullName, $email);
    }
    public function makePassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function passwordMatch($password){
        return password_verify($password, $this->password);
    }
}