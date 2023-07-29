<?php 

namespace Models;
use PDO;
use Exception;

class Landlord 
{
    protected $landlord_id;
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
    protected $id_type;
    protected $id_picture_path;
    protected $picture_path;
    protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct($first_name, $last_name, $contact_number, $email, $password, $birthdate, $street_address, $barangay, $city, $postal_code, $id_type, $id_picture_path, $picture_path, $status=1)
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
        $this->id_type = $id_type;
        $this->id_picture_path = $id_picture_path;
        $this->picture_path = $picture_path;
        $this->status = $status;
	}

    public function getId() {
        return $this->landlord_id;
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
    
    public function getIdType() {
        return $this->id_type;
    }
    
    public function getIdPicture() {
        return $this->id_picture_path;
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

	public function getLandlords(){
		try {
			$sql = "SELECT * FROM apt_landlords WHERE status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function getById($id){
        try {
            $sql = 'SELECT * FROM apt_landlords WHERE landlord_id=:landlord_id';
			$statement = $this->connection->prepare($sql);
            
			$statement->execute([
				':landlord_id' => $id
			]);

            $row = $statement->fetch();
            
			$this->landlord_id = $row['landlord_id'];
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
            $this->id_type = $row['id_type'];
            $this->id_picture_path = $row['id_picture_path'];
            $this->picture_path = $row['picture_path'];
            $this->status = $row['status'];


        } catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addLandlord(){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_landlords SET first_name=?, last_name=?, contact_number=?, email=?, password=?, birthdate=?, street_address=?, barangay=?, city=?, postal_code=?, id_type=?, id_picture_path=?, picture_path=?, status=?"; 
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
				$this->getIdType(),
                $this->getIdPicture(),
                $this->getPicturePath(),
                $this->getStatus(),
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateLandlord($landlord_id, $first_name, $last_name, $contact_number, $email, $password, $birthdate, $street_address, $barangay, $city, $postal_code, $id_type, $id_picture_path, $picture_path){
        global $pdo;
		try {

			// $sql = "UPDATE apt_landlords SET first_name=:first_name, last_name=:last_name, contact_number=:contact_number, email=:email, password=:password, birthdate=:birthdate, street_address=:street_address, barangay=:barangay, city=:city, postal_code=:postal_code, id_type=:id_type, id_picture_path=:id_picture_path, picture_path=:picture_path WHERE landlord_id=$landlord_id AND status=1";
            $sql = "UPDATE apt_landlords SET first_name=?, last_name=?, contact_number=?, email=?, password=?, birthdate=?, street_address=?, barangay=?, city=?, postal_code=?, id_type=?, id_picture_path=?, picture_path=? WHERE landlord_id=? AND status=1";
            
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
				$id_type,
				$id_picture_path,
                $picture_path,
                $landlord_id
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteClass(){
        global $pdo;
		try {

			$sql = "DELETE FROM classes WHERE id=$id";

			$statement = $pdo->prepare($sql);

			return $statement->execute([
				':name' => $this->getName(),
				':description' => $this->getDescription(),
				':class_code' => $this->getClassCode(),
                ':teacher_id' => $this->getTeacherId()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}