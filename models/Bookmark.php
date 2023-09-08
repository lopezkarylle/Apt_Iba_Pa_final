<?php
namespace Models;
use \PDO;

class Auth
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
            $statement->execute([
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
}