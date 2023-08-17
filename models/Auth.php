<?php
namespace Models;
use \PDO;

class Auth
{
    protected $email;
    protected $password;
    protected $salt;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function registerUser($first_name, $last_name, $contact_number, $email, $password, $salt){
        try {
            $sql = "INSERT INTO apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=?, salt=?, user_type=?, status=?"; 
            $statement = $this->connection->prepare($sql);
            $success = $statement->execute([
                $first_name, 
                $last_name, 
                $contact_number, 
                $email, 
                $password, 
                $salt,
                2, // user-tenant type
                1 // active
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
        $sql = 'SELECT * FROM apt_users WHERE email=? AND status=1';
		$statement = $this->connection->prepare($sql);
		$statement->execute([
				$email
		]);
        $row = $statement->fetch();
        return $row;
    }
}