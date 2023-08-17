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

	public function __construct($user_id,$property_id,$status)
	{
		$this->user_id = $user_id;
		$this->$property_id = $property_id;
		$this->status = $status;
	}

    public function getId() {
        return $this->application_id;
    }
	public function getUserId() {
        return $this->user_id;
    }
	public function getPropertyId() {
        return $this->$property_id;
    }
    public function getStatus() {
        return $this->status;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	// public function getAmenities($property_id){
	// 	try {
	// 		$sql = "SELECT amenity_name FROM apt_property_amenities WHERE property_id=$property_id";
	// 		$data = $this->connection->query($sql)->fetch();
	// 		return $data;

	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
	// }

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

	public function addRequest(){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_application_requests SET user_id=?, property_id=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getUserId(),
				$this->getPropertyId(),
                $this->getStatus()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}