<?php

require_once '../model/data/iActorDataModel.php//interface file must be included

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
            $this->dbConnection = new PDO("sqlite:/home/NSCCStudent/PhpstormProjects/Caines-Michael-w0244079/Demos/Oct23Demo-MVC/model/db/customers.sqlite");
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
    public function selectCustomers()
    {
        // hard-coding for first ten rows
        $start = 0;
        $count = 10;

        //build the SQL STATEMENT
        //notice the placeholders for the start and count
        $selectStatement = "SELECT * FROM customers";
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

    public function selectCustomerById($custID)
    {
        // TODO: Implement selectCustomerById() method.
    }

    //IMPLEMENTED
    public function fetchCustomer()
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

    public function updateCustomer($custID, $first_name, $last_name)
    {
        // TODO: Implement updateCustomer() method.
    }


    public function fetchCustomerID($row)
    {
        //extract the specific customer id from the appropriate
        //column with the current row of customer data you are focused on
        return $row['custId'];
    }

    public function fetchCustomerFirstName($row)
    {
        return $row['fname'];
    }

    public function fetchCustomerLastName($row)
    {
        return $row['lname'];
    }

    public function fetchAddressID($row)
    {
        return $row['addrId'];
    }

    public function fetchAddress1($row)
    {
        return $row['addr1'];
    }

    public function fetchAddress2($row)
    {
        return $row['addr2'];
    }
}