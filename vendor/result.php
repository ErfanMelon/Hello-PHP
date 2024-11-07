<?php

final class Result
{
    public bool $isSuccess;
    public bool $isFailure;
    public ?string $errors;
    public $value;

    public function __construct(bool $isSuccess, $value, $error)
    {
        $this->isSuccess = $isSuccess;
        $this->isFailure = !$isSuccess;
        $this->errors= $error;
        $this->value = $value;
    }
    public static function success($value = null) :Result
    {
        return new self(true, $value, null);
    }
    public static function failure($error) :Result
    {
        return new self(false, null,$error);
    }
    public function ensure($func,$err=null) : Result{
        if($this->isFailure){
            return $this;
        }

        $result= $func($this->value);
        if($result === true){
            return self::success($this->value);
        }
        return self::failure($err);
    }
    public function __toString()
    {
        return (string) $this->isSuccess;
    }

    public static function firstFailureOrSuccess(...$results) : Result{
        foreach($results as $result){
            if($result->isFailure){
                return $result;
            }
        }
        return self::success();
    }
}