<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;
use Support\Configuration\Configuration;

class User extends BaseService{

    const TOKEN_KEY = 'asfdhkgjlr;ofijhgbfdklfsadf';

    private static $currentUserId;

    public function getByEmail($email){
        $parameters = [
            ':email' => $email
        ];
        return $this->fetch("SELECT * FROM user WHERE email = :email", $parameters);
        
    }

    public function getByUserId($userId){
        $parameters = [
            ':user_id' => $userId
        ];
        return $this->fetch("SELECT * FROM user WHERE user_id = :user_id", $parameters);
    }

    public function getList(){

        return $this->fetchAll("SELECT * FROM user");
    }

    public function insert($name, $email, $password){
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $parameters = [
            ':name'=> $name,
            ':email'=> $email,
            ':password'=> $passwordHash
        ];
        $rows = $this->execute('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)', $parameters);
        
        return $rows == 1;
    }

    public function verify($email, $password){
        $user = $this->getByEmail($email);

        return password_verify($password, $user["password"]);
    }

    
    public function generateToken($userId){
        $payload = [
            'user_id' => $userId,
        ];
        $payloadEncoded = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);

        return sprintf('%s.%s', $payloadEncoded, $signature);
    }

    public function getTokenPayload($token){ 
        [$payloadEncoded] = explode('.', $token);

        
        return json_decode(base64_decode($payloadEncoded), true);
    }

    public function verifyToken($token){
        $payload = $this->getTokenPayload($token);
        $userId = $payload['user_id'];

        
        return $this->generateToken($userId) == $token;
    }

    public static function getCurrentUserId(){
        return self::$currentUserId;
    }

    public static function setCurrentUserId($userId){
       self::$currentUserId = $userId;
    }
}

?>
