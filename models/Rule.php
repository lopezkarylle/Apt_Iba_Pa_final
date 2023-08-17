<?php 

namespace Models;
use PDO;
use Exception;

class Rule 
{
    protected $property_id;
	protected $short_term;
	protected $min_weeks;
	protected $mix_gender;
    protected $curfew;
	protected $from_curfew;
	protected $to_curfew;
	protected $cooking;
    protected $pets;
	protected $visitors;
	protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct($property_id,$short_term,$min_weeks, $mix_gender,$curfew,$from_curfew,$to_curfew,$cooking,$pets, $visitors,$status)
	{
        $this->property_id = $property_id;
		$this->short_term = $short_term;
		$this->min_weeks = $min_weeks;
        $this->mix_gender = $mix_gender;
		$this->curfew = $curfew;
		$this->from_curfew = $from_curfew;
        $this->to_curfew = $to_curfew;
		$this->cooking = $cooking;
		$this->pets = $pets;
        $this->visitors = $visitors;
		$this->status = $status;
	}

    public function getPropertyId() {
        return $this->property_id;
    }
	public function getShortTerm() {
        return $this->short_term;
    }
	public function getMinWeeks() {
        return $this->min_weeks;
    }
    public function getMixGender() {
        return $this->mix_gender;
    }
    public function getCurfew() {
        return $this->curfew;
    }
    public function getFromCurfew() {
        return $this->from_curfew;
    }
    public function getToCurfew() {
        return $this->to_curfew;
    }
    public function getCooking() {
        return $this->cooking;
    }
    public function getPets() {
        return $this->pets;
    }
    public function getVisitors() {
        return $this->visitors;
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

	public function addRules(){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_property_rules SET property_id=?, short_term=?, min_weeks=?, mix_gender=?, curfew=?, from_curfew=?, to_curfew=?, cooking=?, pets=?, visitors=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getPropertyId(),
				$this->getShortTerm(),
                $this->getMinWeeks(),
                $this->getMixGender(),
				$this->getCurfew(),
                $this->getFromCurfew(),
                $this->getToCurfew(),
				$this->getCooking(),
                $this->getPets(),
                $this->getVisitors(),
                $this->getStatus(),
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}