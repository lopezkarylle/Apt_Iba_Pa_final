<?php
namespace Models;
use \PDO;

class UserImage
{
    protected $image_id;
    protected $user_id;
    protected $image_name;
    protected $image_path;
    protected $status;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addImage($user_id, $image_name, $image_path){
        $sql = 'INSERT INTO apt_user_images SET user_id=?, image_name=?,image_path=?, status=1';
		$statement = $this->connection->prepare($sql);
		return $statement->execute([
            $user_id,
            $image_name,
            $image_path,
        ]);
    }

    public function getImage($user_id){
        try {
			$sql = "SELECT * FROM apt_user_images WHERE user_id=$user_id AND status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function updateImage($user_id, $image_name, $image_path){
        try {
			$sql = 'UPDATE apt_user_images SET image_name=?, image_path=? WHERE user_id=? AND status=1';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                $image_name, 
                $image_path,
                $user_id, 
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteImage($user_id){
        try {
			$sql = 'UPDATE apt_property_images SET status=2 WHERE user_id=:user_id';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                ':user_id' => $user_id,
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}