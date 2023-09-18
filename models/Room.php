<?php 

namespace Models;
use PDO;
use Exception;

class Room 
{
    protected $room_id;
	protected $property_id;
    protected $room_type;
    protected $bed_per_room;
    protected $total_rooms;
	protected $total_beds;
	protected $occupied_beds;
    protected $furnished_type;
	protected $monthly_rent;
	protected $status;

    // Database Connection Object
	protected $connection;

	public function __construct()
	{

	}

    public function getId() {
        return $this->room_id;
    }
    
	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function getRooms($property_id){
		try {
			$sql = "SELECT * FROM apt_rooms WHERE property_id=$property_id";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

    public function addRoom($property_id, $room_type, $bed_per_room, $total_rooms, $total_beds, $occupied_beds, $furnished_type, $monthly_rent, $status){
        try {
			//$encrypted_password = sha1($this->getPassword());
			$sql = "INSERT INTO apt_rooms SET property_id=?, room_type=?, total_rooms=?, total_beds=?, occupied_beds=?, furnished_type=?, monthly_rent=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$property_id, 
                $room_type, 
                $bed_per_room,
                $total_rooms, 
                $total_beds, 
                $occupied_beds, 
                $furnished_type, 
                $monthly_rent, 
                $status,
			]);
			$lastInsertedId = $this->connection->lastInsertId();
            return $lastInsertedId;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    // public function updateLandlord($first_name, $last_name, $contact_number, $email, $password){
	// 	try {
    //         $sql = "UPDATE apt_users SET first_name=?, last_name=?, contact_number=?, email=?, password=? WHERE user_id=? AND user_type=1 AND status=1";
            
    //         $statement = $this->connection->prepare($sql);

	// 		$statement->execute([
	// 			$first_name,
	// 			$last_name,
	// 			$contact_number,
    //             $email,
    //             $password,
    //             $this->getId()
	// 		]);

	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
    // }

    // public function deleteLandlord(){
	// 	try {
	// 		$sql = 'UPDATE apt_users SET status=2 WHERE user_id=? AND user_type=1';
	// 		$statement = $this->connection->prepare($sql);
	// 		$statement->execute([
	// 			$this->getId()
	// 		]);
	// 	} catch (Exception $e) {
	// 		error_log($e->getMessage());
	// 	}
    // }
}