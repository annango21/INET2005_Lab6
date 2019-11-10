<?php

require_once '../model/data/iActorDataModel.php';//interface file must be included

class PDOSQLiteActorDataModel implements iActorDataModel
{
    private $dbConnection; //<-the db connection is stored here after successful connection
    private $result; //<-results of queries are stored here
    private $stmt;

    //IMPLEMENTED
    public function connectToDB()
    {
        try
        {
            //connects to mysql db via PDO
            //if connection is successful, the resulting connection
            //is stored in the $dbConnection member variable defined above
            $this->dbConnection = new PDO("sqlite:/home/NSCCStudent/PhpstormProjects/Ngo-Diem-w0428985/Lab6/model/db/actors.sqlite");
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex)
        {
            die('Could not connect to the SQLite Database via PDO: ' . $ex->getMessage());
        }
    }

    //IMPLEMENTED
    public function closeDB()
    {
        // set a PDO connection object to null to close it
        $this->dbConnection = null;
    }

    //IMPLEMENTED
    public function selectActors()
    {
        // hard-coding for first ten rows
        $start = 0;
        $count = 10;

        //build the SQL STATEMENT
        //notice the placeholders for the start and count
        $selectStatement = "SELECT * FROM actor";
        $selectStatement .= " LIMIT :start,:count;";

        try
        {
            //prepare the select statement by inserting the two values
            //into the parameters/placeholders
            $this->stmt = $this->dbConnection->prepare($selectStatement );
            $this->stmt->bindParam(':start', $start, PDO::PARAM_INT);
            $this->stmt->bindParam(':count', $count, PDO::PARAM_INT);
            //execute the select statement and store it in the $stmt
            //member variable
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from Sakila Database via PDO: ' . $ex->getMessage());
        }
    }

    public function selectActorById($actorID)
    {
        //build select statment with WHERE clause to get
        //specific customer from db
        //note the :custID parameter placeholder...this is PDO-specific
        $selectStatement = "SELECT * FROM actor";
        $selectStatement .= " WHERE actor.actor_id = :actorID;";

        try
        {
            //prepare the statement by inserting in the customer id
            //that was passed into the function
            $this->stmt = $this->dbConnection->prepare($selectStatement);
            $this->stmt->bindParam(':actorID', $actorID, PDO::PARAM_INT);
            //execute the select statement and store in $stmt member variable
            $this->stmt->execute();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from Sakila Database via PDO: ' . $ex->getMessage());
        }
    }

    //IMPLEMENTED
    public function fetchActor()
    {
        //at this point....a query should have been executed and stored
        //in the $stmt variable. here we can fetch the results
        //row by row by calling the fetch method off of the statement
        try
        {
            //this returns one row of data if there is one
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            return $this->result;
        }
        catch(PDOException $ex)
        {
            die('Could not retrieve from SQLite Database via PDO: ' . $ex->getMessage());
        }
    }
    public function insertActor($actorID,$first_name,$last_name){
        $insertStatement = "INSERT INTO actor";
        $insertStatement .= "(actor_id,first_name,last_name)";
        $insertStatement .= " VALUES (:actorID, :firstName, :lastName);";

        try
        {
            //prepare the sql statement by inserting into the
            //placeholders the values that we wish to use to perform
            //the update
            $this->stmt = $this->dbConnection->prepare($insertStatement);
            $this->stmt->bindParam(':firstName', $first_name, PDO::PARAM_STR);
            $this->stmt->bindParam(':lastName', $last_name, PDO::PARAM_STR);
            $this->stmt->bindParam(':actorID', $actorID, PDO::PARAM_INT);
            //perform the update statement and store in the $stmt member variable
            $this->stmt->execute();
            //return the number of rows that the update statement
            //affected - if successful in this case, the value returned should
            //be 1 - it could possibly return 0 if no rows were affected
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from Sakila Database via PDO: ' . $ex->getMessage());
        }
    }
    public function updateActor($actorID,$first_name,$last_name)
    {
        //build an UPDATE sql statment with the data provided to the function
        //this should always include the customer id
        //note the parameters/placeholders in the statement
        $updateStatement = "UPDATE actor";
        $updateStatement .= " SET first_name = :firstName,last_name=:lastName";
        $updateStatement .= " WHERE actor_id = :actorID;";

        try
        {
            //prepare the sql statement by inserting into the
            //placeholders the values that we wish to use to perform
            //the update
            $this->stmt = $this->dbConnection->prepare($updateStatement);
            $this->stmt->bindParam(':firstName', $first_name, PDO::PARAM_STR);
            $this->stmt->bindParam(':lastName', $last_name, PDO::PARAM_STR);
            $this->stmt->bindParam(':actorID', $actorID, PDO::PARAM_INT);
            //perform the update statement and store in the $stmt member variable
            $this->stmt->execute();
            //return the number of rows that the update statement
            //affected - if successful in this case, the value returned should
            //be 1 - it could possibly return 0 if no rows were affected
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from Sakila Database via PDO: ' . $ex->getMessage());
        }
    }
    public function deleteActor($actorID)
    {
        //build an DELETE sql statment with the data provided to the function
        //this should always include the customer id
        //note the parameters/placeholders in the statement
        $deleteStatement = "DELETE FROM actor";
        $deleteStatement .= " WHERE actor_id = :actorID;";

        try
        {
            //prepare the sql statement by inserting into the
            //placeholders the values that we wish to use to perform
            //the update
            $this->stmt = $this->dbConnection->prepare($deleteStatement);
            $this->stmt->bindParam(':actorID', $actorID, PDO::PARAM_INT);
            //perform the update statement and store in the $stmt member variable
            $this->stmt->execute();
            //return the number of rows that the update statement
            //affected - if successful in this case, the value returned should
            //be 1 - it could possibly return 0 if no rows were affected
            return $this->stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            die('Could not select records from Sakila Database via PDO: ' . $ex->getMessage());
        }
    }

    public function fetchActorID($row)
    {
        //extract the specific customer id from the appropriate
        //column with the current row of customer data you are focused on
        return $row['actor_id'];
    }

    public function fetchActorFirstName($row)
    {
        return $row['first_name'];
    }

    public function fetchActorLastName($row)
    {
        return $row['last_name'];
    }

}