<?php 

namespace Models;
use PDO;
use Exception;

class Property 
{
    protected $property_id;
	protected $property_name;
	protected $owner_id;
	protected $total_rooms;
    protected $total_floors;
    protected $description;
    protected $property_number;
    protected $street;
    protected $region;
    protected $province;
    protected $city;
    protected $barangay;
    protected $postal_code;
    protected $latitude;
    protected $longitude;
    protected $reservation_fee;
    protected $advance_deposit;
    protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct($property_name, $owner_id, $total_rooms, $total_floors, $description, $property_number, $street, $region, $province, $city, $barangay, $postal_code, $latitude, $longitude, $reservation_fee, $advance_deposit, $status)
	{
        $this->property_name = $property_name;
        $this->owner_id = $owner_id;
        $this->total_rooms = $total_rooms;
        $this->total_floors = $total_floors;
        $this->description = $description;
        $this->property_number = $property_number;
        $this->street = $street;
        $this->region = $region;
        $this->province = $province;
        $this->city = $city;
        $this->barangay = $barangay;
        $this->postal_code = $postal_code;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->reservation_fee = $reservation_fee;
        $this->advance_deposit = $advance_deposit;
        $this->status = $status;
	}

    public function getId() {
        return $this->property_id;
    }

    public function getPropertyName() {
        return $this->property_name;
    }

    public function getOwnerId() {
        return $this->owner_id;
    }
    
    public function getTotalRooms() {
        return $this->total_rooms;
    }
    
    public function getTotalFloors() {
        return $this->total_floors;
    }

    public function getDescription() {
        return $this->description;
    }
    
    public function getPropertyNumber() {
        return $this->property_number;
    }

	public function getStreet(){
		return $this->street;
	}
    public function getRegion(){
		return $this->region;
	}
    public function getProvince(){
		return $this->province;
	}
    public function getCity(){
		return $this->city;
	}
    public function getBarangay(){
		return $this->barangay;
	}
    public function getPostal(){
		return $this->postal_code;
	}
    public function getLatitude(){
		return $this->latitude;
	}
    public function getLongitude(){
		return $this->longitude;
	}
    public function getReservation(){
		return $this->reservation_fee;
	}
    public function getDeposit(){
		return $this->advance_deposit;
	}
    public function getStatus(){
		return $this->status;
	}


	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getProperties(){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT * FROM apt_properties INNER JOIN apt_users on apt_properties.owner_id=apt_users.user_id WHERE apt_users.user_type=1 AND apt_properties.status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyDetails($property_id){
		try {
            $sql = "SELECT * FROM apt_properties INNER JOIN apt_users on apt_properties.owner_id=apt_users.user_id WHERE apt_properties.property_id=? AND apt_users.user_type=1";
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $property_id
			]);
    
            $data = $statement->fetch();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function updateProperty($property_id, $property_name, $owner_id, $total_rooms, $total_floors, $description, $property_number, $street, $region, $province, $city, $barangay, $postal_code, $latitude, $longitude, $reservation_fee, $advance_deposit){
		try {
            $sql = "UPDATE apt_properties SET property_name=?, owner_id=?, total_rooms=?, total_floors=?, description=?, property_number=?, street=?, region=?, province=?, city=?, barangay=?, postal_code=?, latitude=?, longitude=?, reservation_fee=?, advance_deposit=? WHERE property_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
				$property_name, 
                $owner_id, 
                $total_rooms, 
                $total_floors, 
                $description, 
                $property_number, 
                $street, 
                $region, 
                $province, 
                $city, 
                $barangay, 
                $postal_code, 
                $latitude, 
                $longitude, 
                $reservation_fee, 
                $advance_deposit,
                $property_id
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function addProperty(){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_properties SET property_name=?, owner_id=?, total_rooms=?, total_floors=?, description=?, property_number=?, street=?, region=?, province=?, city=?, barangay=?, postal_code=?, latitude=?, longitude=?, reservation_fee=?, advance_deposit=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getPropertyName(),
				$this->getOwnerId(),
				$this->getTotalRooms(),
				$this->getTotalFloors(),
				$this->getDescription(),
				$this->getPropertyNumber(),
                $this->getStreet(),
                $this->getRegion(),
				$this->getProvince(),
				$this->getCity(),
				$this->getBarangay(),
				$this->getPostal(),
				$this->getLatitude(),
                $this->getLongitude(),
                $this->getReservation(),
                $this->getDeposit(),
                $this->getStatus()
			]);
            $lastInsertedId = $this->connection->lastInsertId();
            return $lastInsertedId;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
    // public function getById($id){
    //     try {
    //         $sql = 'SELECT * FROM apt_properties WHERE user_id=:user_id AND user_type=1 AND status=1';
	// 		$statement = $this->connection->prepare($sql);
            
	// 		$statement->execute([
	// 			':user_id' => $id
	// 		]);

    //         $row = $statement->fetch();
            
	// 		$this->user_id = $row['user_id'];
    //         $this->first_name = $row['first_name'];
    //         $this->last_name = $row['last_name'];
    //         $this->contact_number = $row['contact_number'];
    //         $this->email = $row['email'];
    //         $this->password = $row['password'];
    //         $this->user_type = $row['user_type'];
    //         $this->status = $row['status'];


    //     } catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
    // }
}