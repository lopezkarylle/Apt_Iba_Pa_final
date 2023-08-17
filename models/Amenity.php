<?php 

namespace Models;
use PDO;
use Exception;

class Amenity 
{
    protected $amenity_id;
	protected $property_id;
	protected $amenity_name;
	protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct($property_id,
	 $amenity_name, $status)
	{
        $this->property_id = $property_id;
		$this->amenity_name = $amenity_name;
		$this->status = $status;
	}

	public function getId() {
        return $this->amenity_id;
    }

    public function getPropertyId() {
        return $this->property_id;
    }

	public function getAmenityName() {
        return $this->amenity_name;
    }

	public function getStatus() {
        return $this->status;
    }

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getAmenities($property_id){
		try {
			$sql = "SELECT amenity_name FROM apt_property_amenities WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function updateAmenities($property_id, $amenities_csv){
		try {
			$sql = 'UPDATE apt_property_amenities SET amenity_name=? WHERE property_id=? AND status=1';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$amenities_csv,
				$property_id,
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

	public function addAmenities(){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_property_amenities SET property_id=?, amenity_name=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getPropertyId(),
				$this->getAmenityName(),
                $this->getStatus()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}