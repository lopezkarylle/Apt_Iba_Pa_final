<?php
namespace Models;
use \PDO;

class Auth
{
    protected $email;
    protected $password;
    protected $salt;
    protected $status;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function registerUser($email, $hashedPassword, $salt, $status){
        try {
            $sql = "INSERT INTO apt_users SET email=?, password=?, salt=?, status=?"; 
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $email, 
                $hashedPassword, 
                $salt,
                $status
            ]);
    
            $lastInsertedId = null;
            if ($success) {
                $lastInsertedId = $this->connection->lastInsertId();
            }
    
            return [
                'statement' => $statement,
                'lastInsertedId' => $lastInsertedId
            ];
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function login($email){
        try{
            $sql = 'SELECT * FROM apt_users WHERE email=? AND status=1';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                    $email
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function getAccount($user_id){
        try{
            $sql = 'SELECT * FROM apt_users WHERE user_id=? AND status=1';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                    $user_id
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function updateAccount($user_id, $email, $password, $salt){
        try{
            $sql = "UPDATE apt_users SET email=?, password=?, salt=? WHERE user_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
                $email,
                $password,
                $salt,
                $user_id
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function deleteAccount($user_id){
		try {
			$sql = 'UPDATE apt_users SET status=0 WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$user_id
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function resetToken($email, $token){
        try {
             $sql = 'INSERT INTO apt_password_reset_tokens SET email=?, token=?, expiry=DATE_ADD(NOW(), INTERVAL 1 HOUR)';
             $statement = $this->connection->prepare($sql);
             return $statement->execute([
                        $email,
                        $token
                    ]);

        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}