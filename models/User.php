<?php 

namespace Models;
use PDO;
use Exception;

class User 
{
    protected $user_id;
	protected $first_name;
	protected $last_name;
	protected $contact_number;
    protected $email;
    protected $password;
    protected $salt;
    protected $user_type;
    protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct($first_name, $last_name, $contact_number, $email, $password, $salt, $user_type, $status=1)
	{
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->contact_number = $contact_number;
        $this->email = $email;
        $this->password = $password;
        $this->salt = $salt;
        $this->user_type = $user_type;
        $this->status = $status;
	}

    public function getId() {
        return $this->user_id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }
    
    public function getContactNumber() {
        return $this->contact_number;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }
    
    public function getUserType() {
        return $this->user_type;
    }

	public function getStatus(){
		return $this->status;
	}


	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getUsers(){
		try {
			$sql = "SELECT * FROM apt_users WHERE user_type=2 AND status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getLandlords(){
		try {
			$sql = "SELECT * FROM apt_users WHERE user_type=1 AND status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getById($user_id){
        try {
            $sql = 'SELECT * FROM apt_users WHERE user_id=? AND status=1';
			$statement = $this->connection->prepare($sql);
            
			$statement->execute([
				$user_id
			]);

            $row = $statement->fetch();
            
			$this->user_id = $row['user_id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->contact_number = $row['contact_number'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->salt = $row['salt'];
        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addLandlord($first_name, $last_name, $contact_number, $email, $hashedPassword, $salt){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=?, salt=?, user_type=1, status=1"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$first_name, 
                $last_name, 
                $contact_number, 
                $email, 
                $hashedPassword, 
                $salt
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addUser($first_name, $last_name, $contact_number, $email, $hashedPassword, $salt){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=?, salt=?, user_type=2, status=1"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$first_name, 
                $last_name, 
                $contact_number, 
                $email, 
                $hashedPassword, 
                $salt
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateUser($user_id, $first_name, $last_name, $contact_number, $email, $password, $salt){
		try {
            $sql = "UPDATE apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=?, salt=? WHERE user_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
				$first_name,
				$last_name,
				$contact_number,
                $email,
                $password,
                $salt,
                $user_id
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteUser(){
		try {
			$sql = 'UPDATE apt_users SET status=2 WHERE user_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}