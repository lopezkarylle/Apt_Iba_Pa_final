<?php
namespace Models;
use \PDO;

class Auth
{
    protected $email;
    protected $password;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function landlordLogin($email, $password){
        //$encrypted_password = sha1($password);
        $sql = 'SELECT * FROM apt_users WHERE email=? AND password=? AND status=1 AND user_type!=2';
		$statement = $this->connection->prepare($sql);
		$statement->execute([
				$email,
                $password
		]);
        $row = $statement->fetch();
        return $row;
    }

    public function userLogin($email, $password){
        //$encrypted_password = sha1($password);
        $sql = 'SELECT * FROM apt_users WHERE email=? AND password=? AND user_type=2';
		$statement = $this->connection->prepare($sql);
		$statement->execute([
				$email,
                $password
		]);
        $row = $statement->fetch();
        return $row;
    }
}