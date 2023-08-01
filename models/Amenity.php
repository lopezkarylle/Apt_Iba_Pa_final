<?php 

namespace Models;
use PDO;
use Exception;

class Amenity 
{
    protected $amenity_id;
	protected $property_id;
	protected $amenity_name;
	protected $is_available;

    // Database Connection Object
	protected $connection;

	public function __construct($property_id, $amenity_name, $is_available)
	{
        $this->property_id = $property_id;
        $this->amenity_name = $amenity_name;
        $this->is_available = $is_available;
	}

    public function getId() {
        return $this->property_id;
    }

    public function getAmenityName() {
        return $this->amenity_name;
    }

    public function getAvailability() {
        return $this->is_available;
    }
    
	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getAmenities($property_id){
		try {
			$sql = "SELECT amenity_name, is_available FROM apt_property_amenities WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getById($id){
        try {
            $sql = 'SELECT * FROM apt_users WHERE user_id=:user_id AND user_type=1 AND status=1';
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
            $this->user_type = $row['user_type'];
            $this->status = $row['status'];


        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addLandlord(){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=?, user_type=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getFirstName(),
				$this->getLastName(),
				$this->getContactNumber(),
				$this->getEmail(),
				$this->getPassword(),
				$this->getUserType(),
                $this->getStatus(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateLandlord($first_name, $last_name, $contact_number, $email, $password){
		try {
            $sql = "UPDATE apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=? WHERE user_id=? AND user_type=1 AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
				$first_name,
				$last_name,
				$contact_number,
                $email,
                $password,
                $this->getId()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteLandlord(){
		try {
			$sql = 'UPDATE apt_users SET status=2 WHERE user_id=? AND user_type=1';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}