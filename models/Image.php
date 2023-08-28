<?php
namespace Models;
use \PDO;

class Image
{
    protected $image_id;
    protected $property_id;
    protected $image_path;
    protected $status;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    public function addImage($property_id, $targetFilePath, $title, $status){
        //$encrypted_password = sha1($password);
        $sql = 'INSERT INTO apt_property_images SET property_id=?, image_path=?, title=?, status=?';
		$statement = $this->connection->prepare($sql);
		return $statement->execute([
            $property_id,
            $targetFilePath,
            $title,
            $status,
        ]);
    }

    public function getImages($property_id){
        try {
			$sql = "SELECT * FROM apt_property_images WHERE property_id=$property_id AND status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function getDisplayImage($property_id){
        try {
			$sql = "SELECT * FROM apt_property_images WHERE property_id=$property_id AND status=1";
			$data = $this->connection->query($sql)->fetch();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteImage($image_id, $property_id){
        try {
			$sql = 'UPDATE apt_property_images SET status=2 WHERE image_id=:image_id AND property_id=:property_id';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                ':image_id' => $image_id,
                ':property_id' => $property_id,
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}