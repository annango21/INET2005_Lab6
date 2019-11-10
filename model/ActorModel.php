<?php

require_once '../model/Actor.php';


//choose which of the two available methods we have to
//communicate with the mysql db by commenting out the
//other method...you will use your chosen data access
//method in the constructor below

require_once '../model/data/MySQLiActorDataModel.php';
//require_once '../model/data/PDOMySQLActorDataModel.php';
//require_once '../model/data/PDOSQLiteActorDataModel.php';


class ActorModel
{

    private $m_DataAccess;
    
    public function __construct()
    {
        //here we can choose between two option of how we wish to connect
        //to our database - via PDO or via MYSQLi
        //toggle between your choice by commenting out one of the options

        $this->m_DataAccess = new MySQLiActorDataModel();
//        $this->m_DataAccess = new PDOMySQLActorDataModel();
//        $this->m_DataAccess = new PDOSQLiteActorDataModel();

    }
    
    public function __destruct()
    {
        // not doing anything at the moment
    }
            
    public function getAllActors()
    {
        //this will be executed based on which method we have enabled
        //PDO with MySQL -or- MYSQLI with MySQL in the constructor
        $this->m_DataAccess->connectToDB();

        //because in this function we get all the customers,
        //we create an empty array which will eventually hold all
        //of the customer objects that will be returned by our model.
        //initially, it will be empty..we will fill it with customer
        //objects with ensuing code
        $arrayOfActorObjects = array();

        //attempt a select query within the model to get all the customers
        $this->m_DataAccess->selectActors();
        //loop to get each customer row that is now available from the query
        //it's possible that no rows were returned if there are no customer records
        while($actorRow = $this->m_DataAccess->fetchActor())
        {
            //for each row of customer of data that we get back,
            //we will

            //create a new address object and fill with address data from
            //the current db record

            //create a new customer object and fill with customer data
            //from the current db record and include the address object
            //just created before
            $currentActor = new Actor($this->m_DataAccess->fetchActorID($actorRow),
                    $this->m_DataAccess->fetchActorFirstName($actorRow),
                    $this->m_DataAccess->fetchActorLastName($actorRow)
            );

            //append the newly created customer object to the array
            //of customer objects to fill up the array one by one
            $arrayOfActorObjects[] = $currentActor;
        }
        
        $this->m_DataAccess->closeDB();

        //array has been filled up with all the available customer objects
        //return back the array of objects to the calling function
        //in the controller
        return $arrayOfActorObjects;
    }

    //retrieves a specific customer record from the database and
    //creates a customer object with the data that is then returned to the caller
    public function getActor($actorID)
    {
        $this->m_DataAccess->connectToDB();

        //execute the query to retrieve the specific customer
        //record by id.
        $this->m_DataAccess->selectActorById($actorID);
        //we only need to call fetch customer once
        //because there should only be one record to return
        //because we queried by ID
        $record =  $this->m_DataAccess->fetchActor();

        //build the customer object with all of the data
        //that was retrieved from the fetched record....
        //this will include both customer and address data
        //create a new address object and fill with address data from the db record

        //create a new customer object and fill with customer data from
        //the db record and also include the newly created address
        //object created just above
        $fetchedActor = new Actor($this->m_DataAccess->fetchActorID($record),
                 $this->m_DataAccess->fetchActorFirstName($record),
                 $this->m_DataAccess->fetchActorLastName($record)
        );
            

        $this->m_DataAccess->closeDB();

        //return the created customer object containing all the customer
        //and address data back to the calling function in the controller
        return $fetchedActor;
    }

    //receives the newly updated customer object from the controller
    //the data is then extracted and sent to the db's updateCustomer
    //in order to save the updates in the database

    public function insertActor($actorToInsert){
        $this->m_DataAccess->connectToDB();
        $recordsAffected = $this->m_DataAccess->insertActor($actorToInsert->getID(),
            $actorToInsert->getFirstName(),
            $actorToInsert->getLastName());

        //return message describing the result of insert
        return "$recordsAffected record(s) inserted succesfully!";
    }
    public function updateActor($actorToUpdate)
    {
        $this->m_DataAccess->connectToDB();

        //pass along the newly updated customer object to the
        //data layer's updateCustomer function so that it can
        //go ahead and perform an UPDATE statement with the new data
        //if the update was successful, the $recordsAffected should be set to 1
        $recordsAffected = $this->m_DataAccess->updateActor($actorToUpdate->getID(),
                $actorToUpdate->getFirstName(),
                $actorToUpdate->getLastName());

        //return message describing the result of update
        return "$recordsAffected record(s) updated succesfully!";
    }
    public function deleteActor($actorToDelete)
    {
        $this->m_DataAccess->connectToDB();

        //pass along the newly deleted customer object to the
        //data layer's deleteCustomer function so that it can
        //go ahead and perform an DELETE statement with the new data
        //if the delete was successful, the $recordsAffected should be set to 1
        $recordsAffected = $this->m_DataAccess->deleteActor($actorToDelete->getID());
//            $actorToDelete->getFirstName(),
//            $actorToDelete->getLastName());

        //return message describing the result of update
        return "$recordsAffected record(s) deleted succesfully!";
    }
}

?>
