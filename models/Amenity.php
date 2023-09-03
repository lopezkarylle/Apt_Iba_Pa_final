<?php 

namespace Models;
use PDO;
use Exception;

class Amenity 
{
    protected $amenity_id;

    // Database Connection Object
	protected $connection;

	public function __construct()
	{
   
	}

	public function getId() {
        return $this->amenity_id;
    }


	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getAmenities($property_id){
		try {
			$sql = "SELECT * FROM apt_property_amenities WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function updateAmenities($property_id,$aircon, $cabinet,$cctv,$drinking_water,$elevator,$emergency_exit,$food_hall,$laundry, $lounge, $microwave, $parking,$refrigerator,$roof_deck,$security, $sink,$study_area, $tv,$wifi){
		try {
			$sql = 'UPDATE apt_property_amenities SET aircon=?, cabinet=?,cctv=?,drinking_water=?,elevator=?,emergency_exit=?,food_hall=?,laundry=?, lounge=?, microwave=?, parking=?,refrigerator=?,roof_deck=?,security=?, sink=?,study_area=?, tv=?,wifi=? WHERE property_id=? AND status=1';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$aircon, 
                $cabinet,
                $cctv,
                $drinking_water,
                $elevator,
                $emergency_exit,
                $food_hall,
                $laundry, 
                $lounge, 
                $microwave, 
                $parking,
                $refrigerator,
                $roof_deck,
                $security, 
                $sink,
                $study_area, 
                $tv,
                $wifi,
                $property_id,
                $status
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

	public function addAmenities($property_id,$aircon, $cabinet,$cctv,$drinking_water,$elevator,$emergency_exit,$food_hall,$laundry, $lounge, $microwave, $parking,$refrigerator,$roof_deck,$security, $sink,$study_area, $tv,$wifi,$status){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_property_amenities SET property_id=?,aircon=?, cabinet=?,cctv=?,drinking_water=?,elevator=?,emergency_exit=?,food_hall=?,laundry=?, lounge=?, microwave=?, parking=?,refrigerator=?,roof_deck=?,security=?, sink=?,study_area=?, tv=?,wifi=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $property_id,
				$aircon, 
                $cabinet,
                $cctv,
                $drinking_water,
                $elevator,
                $emergency_exit,
                $food_hall,
                $laundry, 
                $lounge, 
                $microwave, 
                $parking,
                $refrigerator,
                $roof_deck,
                $security, 
                $sink,
                $study_area, 
                $tv,
                $wifi,
                $status
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}