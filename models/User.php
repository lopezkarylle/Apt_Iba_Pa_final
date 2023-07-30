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
    protected $birthdate;
    protected $street_address;
    protected $barangay;
    protected $city;
    protected $postal_code;
    protected $picture_path;
    protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct($first_name, $last_name, $contact_number, $email, $password, $birthdate, $street_address, $barangay, $city, $postal_code, $picture_path, $status=1)
	{
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->contact_number = $contact_number;
        $this->email = $email;
        $this->password = $password;
        $this->birthdate = $birthdate;
        $this->street_address = $street_address;
        $this->barangay = $barangay;
        $this->city = $city;
        $this->postal_code = $postal_code;
        $this->picture_path = $picture_path;
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
    
    public function getBirthdate() {
        return $this->birthdate;
    }
    
    public function getStreetAddress() {
        return $this->street_address;
    }
    
    public function getBarangay() {
        return $this->barangay;
    }
    
    public function getCity() {
        return $this->city;
    }
    
    public function getPostalCode() {
        return $this->postal_code;
    }
    
    public function getPicturePath() {
        return $this->picture_path;
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
			$sql = "SELECT * FROM apt_users WHERE status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getById($id){
        try {
            $sql = 'SELECT * FROM apt_users WHERE user_id=:user_id';
			$statement = $this->connection->prepare($sql);
            
			$statement->execute([
				':user_id' => $id
			]);

            $row = $statement->fetch();
            
			$this->user_id = $row['user_id'];
            $this->first_name = $row['first_name'];
            $this->last_name = $row['last_name'];
            $this->contact_number = $row['contact_number'];
            $this->email = $row['email'];
            $this->password = $row['password'];
            $this->birthdate = $row['birthdate'];
            $this->street_address = $row['street_address'];
            $this->barangay = $row['barangay'];
            $this->city = $row['city'];
            $this->postal_code = $row['postal_code'];
            $this->picture_path = $row['picture_path'];
            $this->status = $row['status'];


        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addUser(){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=?, birthdate=?, street_address=?, barangay=?, city=?, postal_code=?, picture_path=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getFirstName(),
				$this->getLastName(),
				$this->getContactNumber(),
				$this->getEmail(),
				$this->getPassword(),
				$this->getBirthdate(),
				$this->getStreetAddress(),
				$this->getBarangay(),
				$this->getCity(),
				$this->getPostalCode(),
                $this->getPicturePath(),
                $this->getStatus(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateUser($first_name, $last_name, $contact_number, $email, $password, $birthdate, $street_address, $barangay, $city, $postal_code, $picture_path){
		try {

			// $sql = "UPDATE apt_users SET first_name=:first_name, last_name=:last_name, contact_number=:contact_number, email=:email, password=:password, birthdate=:birthdate, street_address=:street_address, barangay=:barangay, city=:city, postal_code=:postal_code, id_type=:id_type, id_picture_path=:id_picture_path, picture_path=:picture_path WHERE user_id=$user_id AND status=1";
            $sql = "UPDATE apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=?, birthdate=?, street_address=?, barangay=?, city=?, postal_code=?, picture_path=? WHERE user_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
				$first_name,
				$last_name,
				$contact_number,
                $email,
                $password,
                $birthdate,
				$street_address,
				$barangay,
                $city,
                $postal_code,
                $picture_path,
                $this->getId()
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