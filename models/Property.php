<?php 

namespace Models;
use PDO;
use Exception;

class Property 
{
    protected $property_id;
    protected $property_type;
	protected $property_name;
	protected $landlord_id;
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

    public function getLandlordId() {
        return $this->landlord_id;
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
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id   
            WHERE apt_user_information.user_type=1 AND apt_properties.status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertiesByBarangay($barangay){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id   
            WHERE apt_user_information.user_type=1 AND apt_properties.status=1 AND apt_property_locations.barangay=$barangay";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getProperty($landlord_id){
		try {
            //status 1=active, 2=pending, 0=inactive
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id 
            WHERE apt_user_information.user_type=1 AND apt_properties.status=1 AND apt_properties.landlord_id=$landlord_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyDetails($property_id){
		try {
            $sql = "SELECT * FROM apt_properties 
            INNER JOIN apt_user_information ON apt_properties.landlord_id=apt_user_information.user_id 
            LEFT JOIN apt_property_details ON apt_properties.property_id=apt_property_details.property_id 
            LEFT JOIN apt_property_locations ON apt_properties.property_id=apt_property_locations.property_id 
            LEFT JOIN apt_property_images ON apt_properties.property_id=apt_property_images.property_id
            LEFT JOIN apt_property_amenities ON apt_properties.property_id=apt_property_amenities.property_id
            WHERE apt_properties.property_id=? AND apt_user_information.user_type=1 AND apt_properties.status=1";
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

    public function addProperty($property_type, $property_name, $landlord_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$postal_code,$latitude,$longitude,$lowest_rate,$reservation_fee,$advance_deposit, $status){
        try {
            // Insert data into the apt_properties table
            $sql1 = "INSERT INTO apt_properties SET property_type=?, property_name=?, landlord_id=?, status=?";
            $statement1 = $this->connection->prepare($sql1);
            $statement1->execute([
                $property_type,
                $property_name,
                $landlord_id,
                $status
            ]);
          
            $lastInsertedId = $this->connection->lastInsertId();
            $property_id = $lastInsertedId;
            // Insert data into the apt_property_details table
            $sql2 = "INSERT INTO apt_property_details SET property_id=?,description=?, total_floors=?, total_rooms=?, lowest_rate=?,reservation_fee=?, advance_deposit=?, status=?";
            $statement2 = $this->connection->prepare($sql2);
            $statement2->execute([
                $property_id,
                $description,
                $total_floors,
                $total_rooms,
                $lowest_rate,
                $reservation_fee,
                $advance_deposit,
                $status
            ]);
          
            // Insert data into the apt_property_locations table
            $sql3 = "INSERT INTO apt_property_locations SET property_id=?,property_number=?, street=?, barangay=?, city=?, province=?, region=?, postal_code=?, latitude=?, longitude=?, status=?";
            $statement3 = $this->connection->prepare($sql3);
            $statement3->execute([
                $property_id,
                $property_number,
                $street,
                $barangay_text,
                $city_text,
                $province_text,
                $region_text,
                $postal_code,
                $latitude,
                $longitude,
                $status
            ]);
          
            
            return $lastInsertedId;
          
          } catch (Exception $e) {
            error_log($e->getMessage());
          }
    }

    public function updateProperty($property_id, $property_type, $property_name, $landlord_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$postal_code,$latitude,$longitude,$lowest_rate,$reservation_fee,$advance_deposit){
        try {
            $sql1 = "UPDATE apt_properties SET property_type=?, property_name=?, landlord_id=? WHERE property_id=?";
            $statement1 = $this->connection->prepare($sql1);
            $statement1->execute([
                $property_type,
                $property_name,
                $landlord_id,
                $property_id
            ]);
          
            $sql2 = "UPDATE apt_property_details SET description=?, total_floors=?, total_rooms=?, lowest_rate=?,reservation_fee=?, advance_deposit=? WHERE property_id=?";
            $statement2 = $this->connection->prepare($sql2);
            $statement2->execute([
                $description,
                $total_floors,
                $total_rooms,
                $lowest_rate,
                $reservation_fee,
                $advance_deposit,
                $property_id
            ]);
          
            $sql3 = "UPDATE apt_property_locations SET property_number=?, street=?, barangay=?, city=?, province=?, region=?, postal_code=?, latitude=?, longitude=? WHERE property_id=?";
            $statement3 = $this->connection->prepare($sql3);
            $statement3->execute([
                $property_number,
                $street,
                $barangay_text,
                $city_text,
                $province_text,
                $region_text,
                $postal_code,
                $latitude,
                $longitude,
                $property_id
            ]);
          
            if($statement1 && $statement2 && $statement3){
                return true;
            }
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