<?php
namespace Models;
use \PDO;

class Review
{
    protected $review_id;
    protected $rating;
    protected $description;
    protected $review_date;
    protected $user_id;
    protected $property_id;
    protected $status;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}

    // public function addImage($property_id, $targetFilePath, $status){
    //     //$encrypted_password = sha1($password);
    //     $sql = 'INSERT INTO apt_property_images SET property_id=:property_id, image_path=:image_path, status=:status';
	// 	$statement = $this->connection->prepare($sql);
	// 	return $statement->execute([
    //         ':property_id' => $property_id,
    //         ':image_path' => $targetFilePath,
    //         ':status' => $status,
    //     ]);
    // }

    public function getReviews($property_id){
        try {
			$sql = "SELECT * FROM apt_reviews JOIN apt_users ON apt_reviews.user_id=apt_users.user_id WHERE apt_reviews.property_id=$property_id AND apt_reviews.status=1";
			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }

    public function deleteReview($review_id ,$property_id){
        try {
			$sql = 'UPDATE apt_reviews SET status=2 WHERE review_id=:review_id AND property_id=:property_id';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
                ':review_id' => $review_id,
                ':property_id' => $property_id,
            ]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
    }
}