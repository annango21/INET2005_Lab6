<?php

require_once('../model/ActorModel.php');

class ActorController
{
    public $model;
    
    public function __construct()
    {
        $this->model = new ActorModel();
    }
    
    public function displayAction()
    {
        //retrieve an array of all the customers in the db
        //as customer objects
        $arrayOfActors = $this->model->getAllActors();

        //include the view that will iterate over the array
        //and display the customers in a table
        include '../view/displayActors.php';
    }
    public function searchAction($actorID)
    {

        $currentActor = $this->model->getActor($actorID);
        $currentActor -> getID($actorID);
        $currentActor->getFirstName();
        $currentActor->getLastName();
        include '../view/displayById.php';
    }
    public function insertAction()
    {

        include '../view/insertActor.php';
    }

    public function commitInsertAction($actorID,$fName,$lName)
    {
        $lastOperationResults = "";

        //get the current customer as it currently exists
        //in the database...get it as a customer object
        $currentActor = $this->model->getActor($actorID);

        //update the object with the new values from the form
        $currentActor -> setID($actorID);
        $currentActor->setFirstName($fName);
        $currentActor->setLastName($lName);

        //send the updated customer object back to the database
        //so that it can be saved in the db
        $lastOperationResults = $this->model->insertActor($currentActor);

        //get the entire customer list again...this time
        //containing the updated customer you just finished
        //updating
        $arrayOfActors = $this->model->getAllActors();

        //choose the displayCustomers view to display the
        //customers in the array
        include '../view/displayActors.php';
    }

    public function updateAction($actorID)
    {
        //get the current customer by id as it is in the db
        //return it as a customer object
        $currentActor = $this->model->getActor($actorID);

        //load in the editCustomer view which contains the form
        //and pre-populate the form with the customer data
        //you just retrieved from the db
        include '../view/editActor.php';
    }

    public function commitUpdateAction($actorID,$fName,$lName)
    {
        $lastOperationResults = "";

        //get the current customer as it currently exists
        //in the database...get it as a customer object
        $currentActor = $this->model->getActor($actorID);

        //update the object with the new values from the form
        $currentActor->setFirstName($fName);
        $currentActor->setLastName($lName);

        //send the updated customer object back to the database
        //so that it can be saved in the db
        $lastOperationResults = $this->model->updateActor($currentActor);

        //get the entire customer list again...this time
        //containing the updated customer you just finished
        //updating
        $arrayOfActors = $this->model->getAllActors();

        //choose the displayCustomers view to display the
        //customers in the array
        include '../view/displayActors.php';
    }
    public function deleteAction($actorID)
    {
        //get the current customer by id as it is in the db
        //return it as a customer object
        $currentActor = $this->model->getActor($actorID);

        //load in the editCustomer view which contains the form
        //and pre-populate the form with the customer data
        //you just retrieved from the db
        include '../view/deleteActor.php';
    }
    public function commitDeleteAction($actorID)
    {
        $lastOperationResults = "";

        //get the current customer as it currently exists
        //in the database...get it as a customer object
        $currentActor = $this->model->getActor($actorID);


        //send the updated customer object back to the database
        //so that it can be saved in the db
        $lastOperationResults = $this->model->deleteActor($currentActor);

        //get the entire customer list again...this time
        //containing the updated customer you just finished
        //updating
        $arrayOfActors = $this->model->getAllActors();

        //choose the displayCustomers view to display the
        //customers in the array
        include '../view/displayActors.php';
    }


}

?>
