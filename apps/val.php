<?php
class VALIDATE {
    public function valid_number($value) {
        if(!empty($value) && ctype_digit($value)) {if(preg_match('/^[\p{N}]*$/', $value) == true){
        return $value;} else {return false;}} else {return false;}
    }
    public function valid_string($value){
        if(!empty($value)){if(preg_match('/^[\p{L} -.,]*$/', $value) == true){
        return $value;} else {return false;}} else {return false;}
    }
    public function valid_url($value){
        if(!empty($value)){if(preg_match('/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/', $value) == true){
        return $value;} else {return false;}} else {return false;}
    }
    public function valid_alnum($value) {
        if(!empty($value)){if(preg_match('/^[\p{L}\p{N}? -.,]*$/', $value) == true){
        return $value;} else {return false;}} else {return false;}
    }
    public function valid_pass($value) {
        if(!empty($value)){
        return preg_match("/^.*(?=.{8,}).*$/", $value) ? $value : false;}
        else {return false;}
    }
    public function valid_phone($value) {
        if(!empty($value)){if(preg_match('/^[0-9]{11,}$/', $value) == true && ctype_digit($value) == true) {
            return $value;} else {return false;}} else {return false;}
    }
    public function valid_id($value) {
        if(!empty($value)){if(preg_match('/^[0-9]{8}$/', $value) == true && ctype_digit($value) == true) {
            return $value;} else {return false;}} else {return false;}
    }
    public function valid_email($email) {
        $email = trim(strtolower($email));
        return filter_var(filter_var(trim(strtolower($email)), FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) ? $email : false;
    }
}
?>