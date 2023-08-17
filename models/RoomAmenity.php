<?php 

namespace Models;
use PDO;
use Exception;

class RoomAmenity 
{
    protected $amenity_id;
	protected $room_id;
	protected $amenity_name;
	protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct($room_id,
	 $amenity_name, $status)
	{
        $this->room_id = $room_id;
		$this->amenity_name = $amenity_name;
		$this->status = $status;
	}

    public function getId() {
        return $this->amenity_id;
    }
	public function getRoomId() {
        return $this->room_id;
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

	public function getAmenities($room_id){
		try {
			$sql = "SELECT amenity_name FROM apt_room_amenities WHERE room_id=$room_id";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function updateRoomAmenities($room_id ,$roomAmenities_csv){
		try {
			$sql = 'UPDATE apt_room_amenities SET amenity_name=? WHERE room_id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$roomAmenities_csv,
				$room_id,
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

	public function addRoomAmenities(){
        try {
            //status 1=active, 2=pending, 0=inactive
			$sql = "INSERT INTO apt_room_amenities SET room_id=?, amenity_name=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getRoomId(),
				$this->getAmenityName(),
                $this->getStatus()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}