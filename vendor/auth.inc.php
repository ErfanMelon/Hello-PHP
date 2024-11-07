<?php
require_once 'user.php';
require_once 'result.php';
function signupUser($model): Result
{
    // validate model
    $email = $model['useremail'];
    $username = $model['username'];
    $password = $model['password'];
    $confirm_password = $model['confirm_password'];

    $emailResult = Result::success($email)
        ->ensure(fn($e) => !empty($e), "ایمیل اجباری است")
        ->ensure(fn($em) => filter_var($em, FILTER_VALIDATE_EMAIL) ? true : false, "قالب ایمیل را به درستی وارد کنید");

    $usernameResult = Result::success($username)
        ->ensure(fn($u)=>!empty($u),"نام را وارد نمایید")
        ->ensure(fn($u)=>preg_match('/^[a-zA-Z0-9_]{5,}$/',$u)===1,"نام کاربری باید حداقل 5 کاراکتر شامل حروف و اعداد باشد !");

    $passwordResult = Result::success($password)
        ->ensure(fn($p)=>!empty($p),"کلمه عبور را وارد نمایید")
        ->ensure(fn($p)=>strlen($p)>=8,"کلمه عبور باید بیشتر از 8 کاراکتر باشد.");

    $confirm_passwordResult= Result::success($confirm_password)
        ->ensure(fn($p)=>!empty($p),"تکرار کلمه عبور را وارد نمایید!")
        ->ensure(fn($p)=> $p ===$password,"کلمه عبور با تکرار آن برابر نیست");

    $result = Result::firstFailureOrSuccess($emailResult,$usernameResult,$passwordResult,$confirm_passwordResult);
    if ($result->isFailure) {
        return $result;
    }
    $db = require_once 'DatabaseContext.inc.php';

    $emailDuplicatedResult = $db->checkEmailExist($email);
    if($emailDuplicatedResult->isFailure){
        return $emailDuplicatedResult;
    }
    return $db->createUser($username,$email,$password);
}

function loginUser($email,$password) : Result{
    $emailResult = Result::success($email)
        ->ensure(fn($e) => !empty($e), "ایمیل اجباری است")
        ->ensure(fn($em) => filter_var($em, FILTER_VALIDATE_EMAIL) ? true : false, "قالب ایمیل را به درستی وارد کنید");
    $passwordResult = Result::success($password)
        ->ensure(fn($p)=>!empty($p),"کلمه عبور را وارد نمایید")
        ->ensure(fn($p)=>strlen($p)>=8,"کلمه عبور باید بیشتر از 8 کاراکتر باشد.");

    $result= Result::firstFailureOrSuccess($emailResult,$passwordResult);
    if ($result->isFailure) {
        return $result;
    }
    $db = require_once 'DatabaseContext.inc.php';
    return $db->validateUser($email,$password);
}