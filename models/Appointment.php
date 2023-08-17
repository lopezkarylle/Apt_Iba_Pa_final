<?php 

namespace Models;
use PDO;
use Exception;

class Appointment 
{
    protected $appointment_id;
    protected $property_id;
    protected $user_id;
    protected $date;
    protected $time;
    protected $status;
    
    public function __construct($property_id, $user_id, $date, $time, $status)
    {
        $this->property_id = $property_id;
        $this->user_id = $user_id;
        $this->date = $date;
        $this->time = $time;
        $this->status = $status;
    }

    public function getId() {
        return $this->appointment_id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTime() {
        return $this->time;
    }

    public function getPropertyId() {
        return $this->property_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    

    public function checkAppointments(){
		try {
            $sql = "SELECT * FROM apt_appointments";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getAppointments($property_id){
		try {
            $sql = "SELECT * FROM apt_appointments WHERE property_id=$property_id AND status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getPropertyAppointments($user_id){
		try {
            $sql = "SELECT * FROM apt_appointments JOIN apt_properties ON  apt_appointments.property_id=apt_properties.property_id JOIN apt_users ON apt_appointments.user_id=apt_users.user_id WHERE apt_properties.owner_id=$user_id AND apt_appointments.status=1";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

    public function getUserAppointments($user_id){
		try {
            $sql = "SELECT * FROM apt_appointments WHERE user_id=$user_id";
            $data = $this->connection->query($sql)->fetchAll();
            return $data;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
	}

	public function setAppointment(){
        try {
            //status 1=active, 0=inactive
			$sql = "INSERT INTO apt_appointments SET property_id=?, user_id=?, date=?, time=?, status=?"; 
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$this->getPropertyId(),
                $this->getUserId(),
				$this->getDate(),
                $this->getTime(),
                $this->getStatus()
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateAppointment($appointment_id){
        try {
            //status 1=active, 0=inactive
			$sql = "UPDATE apt_appointments SET status=? WHERE appointment_id=?"; 
			$statement = $this->connection->prepare($sql);
			$statement->execute([
                2,
				$appointment_id, 
			]);

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}