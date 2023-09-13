<?php 

namespace Models;
use PDO;
use Exception;

class Reservation 
{
    protected $reservation_id;

    public function __construct()
    {

    }

    public function getId() {
        return $this->reservation_id;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getPendingReservations($user_id){
		try {
            $sql = "SELECT apt_reservations.*, apt_user_information.first_name, apt_user_information.last_name, apt_user_information.contact_number, apt_users.email, apt_properties.property_name, apt_properties.property_type, apt_rooms.room_type, apt_property_locations.* FROM apt_reservations 
            INNER JOIN apt_users ON apt_reservations.user_id=apt_users.user_id 
            INNER JOIN apt_property_locations ON apt_reservations.property_id=apt_property_locations.property_id 
            INNER JOIN apt_user_information ON apt_reservations.user_id=apt_user_information.user_id 
            INNER JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id 
            LEFT JOIN apt_rooms ON apt_reservations.room_id=apt_rooms.room_id WHERE apt_properties.landlord_id=$user_id AND apt_reservations.status=2;";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyReservations($user_id){
		try {
            $sql = "SELECT apt_reservations.reservation_id, apt_reservations.user_id, apt_reservations.property_id, apt_reservations.room_id, apt_reservations.payment_status, apt_reservations.status, apt_users.first_name, apt_users.last_name, apt_users.contact_number, apt_users.email, apt_properties.property_name, apt_rooms.total_beds FROM apt_reservations INNER JOIN apt_users ON apt_reservations.user_id=apt_users.user_id INNER JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id LEFT JOIN apt_rooms ON apt_reservations.room_id=apt_rooms.room_id WHERE apt_properties.owner_id=$user_id AND apt_reservations.status=1 OR apt_reservations.status=3;";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getUserReservations($user_id){
		try {
            $sql = "SELECT apt_reservations.*, apt_properties.property_type, apt_properties.property_name, apt_property_locations.*, apt_rooms.room_type FROM apt_reservations JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id JOIN apt_property_locations ON apt_reservations.property_id=apt_property_locations.property_id JOIN apt_rooms ON apt_reservations.room_id=apt_rooms.room_id WHERE user_id=$user_id AND apt_reservations.status!=0";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function acceptReservation($reservation_id){
		try {
            $sql = "UPDATE apt_reservations SET status=? WHERE reservation_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
				1, //Accepted
				$reservation_id,
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function declineReservation($reservation_id){
		try {
            $sql = "UPDATE apt_reservations SET status=? WHERE reservation_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
				3, //Declined
				$reservation_id,
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function deleteReservation($reservation_id){
		try {
            $sql = "UPDATE apt_reservations SET status=? WHERE reservation_id=?";
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
				0, //Deleted
				$reservation_id,
			]);
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

	public function addReservationaddReservation($user_id, $property_id, $room_id, $payment_status, $status){
        try {
			$sql = "INSERT INTO apt_reservations SET user_id=?, property_id=?, room_id=?, payment_status=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $user_id, 
                $property_id, 
                $room_id, 
                $payment_status, 
                $status
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}