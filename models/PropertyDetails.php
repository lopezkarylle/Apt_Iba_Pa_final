<?php 

namespace Models;
use PDO;
use Exception;

class PropertyDetails
{
    protected $property_id;
    protected $property_type;
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
    protected $lowest;
    protected $reservation_fee;
    protected $advance_deposit;
    protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct()
	{

	}

    public function getId() {
        return $this->property_id;
    }

    public function getPropertyName() {
        return $this->property_name;
    }

    public function getPropertyType() {
        return $this->property_type;
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
            $sql = "SELECT * FROM apt_properties INNER JOIN apt_user_information on apt_properties.owner_id=apt_user_information.user_id WHERE apt_user_information.user_type=1 AND apt_properties.status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyDetails($property_id){
		try {
            $sql = "SELECT * FROM apt_properties INNER JOIN apt_user_information on apt_properties.owner_id=apt_user_information.user_id WHERE apt_properties.property_id=? AND apt_user_information.user_type=1";
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

    public function updateProperty($property_id, $property_type, $property_name, $owner_id, $total_rooms, $total_floors, $description, $property_number, $street, $region, $province, $city, $barangay, $postal_code, $latitude, $longitude, $reservation_fee, $advance_deposit){
		try {
            $sql = "UPDATE apt_properties SET property_name=?, owner_id=?, total_rooms=?, total_floors=?, description=?, property_number=?, street=?, region=?, province=?, city=?, barangay=?, postal_code=?, latitude=?, longitude=?, reservation_fee=?, advance_deposit=? WHERE property_id=? AND status=1";
            
            $statement = $this->connection->prepare($sql);

			$statement->execute([
                $property_type,
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

    public function addProperty($property_type, $property_name, $owner_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$postal_code,$latitude,$longitude,$lowest_rate,$reservation_fee,$advance_deposit, $status){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_properties SET property_type=?, property_name=?, owner_id=?, total_rooms=?, total_floors=?, description=?, property_number=?, street=?, region=?, province=?, city=?, barangay=?, postal_code=?, latitude=?, longitude=?, lowest_rate=?,reservation_fee=?, advance_deposit=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
                $property_type, 
                $property_name, 
                $owner_id, 
                $total_rooms,
                $total_floors,
                $description,
                $property_number,
                $street,
                $region_text,
                $province_text,
                $city_text,
                $barangay_text,
                $postal_code,
                $latitude,
                $longitude,
                $lowest_rate,
                $reservation_fee,
                $advance_deposit,
                $status
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