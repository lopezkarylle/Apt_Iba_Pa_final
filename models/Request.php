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

	public function editRequest($application_id, $property_id, $status){
		try {
			$sql1 = 'UPDATE apt_application_requests SET status=? WHERE application_id=?';
			$statement1 = $this->connection->prepare($sql1);
			$statement1->execute([
				$status,
				$application_id,
			]);

            $sql = 'UPDATE apt_properties SET status=? WHERE property_id=?';
			$statement2 = $this->connection->prepare($sql);
			$statement2->execute([
				$status,
				$property_id,
			]);

            $sql = 'UPDATE apt_property_details SET status=? WHERE property_id=?';
			$statement3 = $this->connection->prepare($sql);
			$statement3->execute([
				$status,
				$property_id,
			]);

            $sql = 'UPDATE apt_property_images SET status=? WHERE property_id=?';
			$statement4 = $this->connection->prepare($sql);
			$statement4->execute([
				$status,
				$property_id,
			]);

            $sql = 'UPDATE apt_locations SET status=? WHERE property_id=?';
			$statement5 = $this->connection->prepare($sql);
			$statement5->execute([
				$status,
				$property_id,
			]);

            $sql = 'UPDATE apt_property_rules SET status=? WHERE property_id=?';
			$statement6 = $this->connection->prepare($sql);
			$statement6->execute([
				$status,
				$property_id,
			]);

            $sql = 'UPDATE apt_rooms SET status=? WHERE property_id=?';
			$statement7 = $this->connection->prepare($sql);
			$statement7->execute([
				$status,
				$property_id,
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

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