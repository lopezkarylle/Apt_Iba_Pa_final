<?php 

namespace Models;
use PDO;
use Exception;

class Request 
{
    protected $application_id;
	protected $user_id;
	protected $property_id;
	protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct()
	{
	}

    public function getId() {
        return $this->application_id;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getAllRequests(){
		try {
			$sql = "SELECT apt_application_requests.*, apt_user_information.first_name, apt_user_information.last_name, apt_user_information.contact_number, apt_properties.property_type, apt_properties.property_name, apt_users.email FROM apt_application_requests JOIN apt_user_information ON apt_application_requests.user_id=apt_user_information.user_id JOIN apt_users ON apt_users.user_id=apt_application_requests.user_id JOIN apt_properties ON apt_properties.property_id=apt_application_requests.property_id";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    	public function getRequest($application_id){
		try {
			$sql = "SELECT * FROM apt_application_requests 
            JOIN apt_user_information ON apt_application_requests.user_id=apt_user_information.user_id 
            JOIN apt_users ON apt_users.user_id=apt_application_requests.user_id 
            JOIN apt_properties ON apt_properties.property_id=apt_application_requests.property_id 
            JOIN apt_property_details ON apt_property_details.property_id=apt_application_requests.property_id 
            JOIN apt_property_locations ON apt_property_locations.property_id=apt_application_requests.property_id 
            JOIN apt_property_amenities ON apt_property_amenities.property_id=apt_application_requests.property_id 
            JOIN apt_property_rules ON apt_property_rules.property_id=apt_application_requests.property_id WHERE application_id=$application_id";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	// public function updateAmenities($property_id, $amenities_csv){
	// 	try {
	// 		$sql = 'UPDATE apt_property_amenities SET amenity_name=? WHERE property_id=? AND status=1';
	// 		$statement = $this->connection->prepare($sql);
	// 		$statement->execute([
	// 			$amenities_csv,
	// 			$property_id,
	// 		]);
	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
    // }

	public function addRequest($user_id, $property_id, $status){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_application_requests SET user_id=?, property_id=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$user_id, 
                $property_id, 
                $status
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}