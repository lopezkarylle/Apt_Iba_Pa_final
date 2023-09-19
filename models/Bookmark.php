<?php
namespace Models;
use \PDO;
use Exception;

class Bookmark
{

    protected $bookmark_id;

    public function __construct(){

    }

    public function setConnection($connection)
	{
		$this->connection = $connection;
	}


    public function addBookmark($property_id, $user_id, $status)
    {
        try{
            $sql = 'INSERT INTO apt_bookmarks SET property_id=?, user_id=?, status=?';
            $statement = $this->connection->prepare($sql);
            return $statement->execute([
                $property_id, 
                $user_id, 
                $status
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function updateBookmark($property_id, $user_id, $status)
    {
        try {
            $sql = 'UPDATE apt_bookmarks SET status=? WHERE property_id=? AND user_id=?';
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				$status,
				$property_id, 
                $user_id, 
			]);
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }

    public function checkBookmark($property_id, $user_id){
        try {
            $sql = 'SELECT status FROM apt_bookmarks WHERE property_id=? AND user_id=?;';
            $statement = $this->connection->prepare($sql);
            $statement->execute([
                $property_id, 
                $user_id, 
            ]);
            $row = $statement->fetch();
            return $row;
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
    }
}