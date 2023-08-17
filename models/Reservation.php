<?php 

namespace Models;
use PDO;
use Exception;

class Reservation 
{
    protected $reservation_id;
    protected $user_id;
    protected $property_id;
    protected $room_id;
    protected $payment_status;
    protected $status;

    public function __construct($user_id, $property_id, $room_id, $payment_status, $status)
    {
        $this->user_id = $user_id;
        $this->property_id = $property_id;
        $this->room_id = $room_id;
        $this->payment_status = $payment_status;
        $this->status = $status;
    }

    public function getId() {
        return $this->reservation_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getPropertyId() {
        return $this->property_id;
    }

    public function getRoomId() {
        return $this->room_id;
    }

    public function getPayment() {
        return $this->payment_status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function getPendingReservations($user_id){
		try {
            $sql = "SELECT apt_reservations.reservation_id, apt_reservations.user_id, apt_reservations.property_id, apt_reservations.room_id, apt_reservations.payment_status, apt_reservations.status, apt_users.first_name, apt_users.last_name, apt_users.contact_number, apt_users.email, apt_properties.property_name, apt_rooms.total_beds FROM apt_reservations INNER JOIN apt_users ON apt_reservations.user_id=apt_users.user_id INNER JOIN apt_properties ON apt_reservations.property_id=apt_properties.property_id LEFT JOIN apt_rooms ON apt_reservations.room_id=apt_rooms.room_id WHERE apt_properties.owner_id=$user_id AND apt_reservations.status=2;";
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

	public function addReservation(){
        try {
			$sql = "INSERT INTO apt_reservations SET user_id=?, property_id=?, room_id=?, payment_status=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $this->getUserId(),
				$this->getPropertyId(),
                $this->getRoomId(),
				$this->getPayment(),
                $this->getStatus()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}