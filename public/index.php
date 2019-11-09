<?php

require_once '../controller/ActorController.php';

$actorController = new ActorController();

if(isset($_GET['idUpdate']))
{
    $actorController->updateAction($_GET['idUpdate']);
}
elseif(isset($_POST['searchBtn']))
{
    $actorController->searchAction($_POST['idSearch']);
}
elseif(isset($_GET['actorInsert']))
{
    $actorController->insertAction();
}
elseif (isset($_POST['InsertBtn']))
{
    $actorController->commitInsertAction($_POST['inserttActorId'],$_POST['firstName'],$_POST['lastName']);
}
elseif (isset($_POST['UpdateBtn']))
{
    $actorController->commitUpdateAction($_POST['editActorId'],$_POST['firstName'],$_POST['lastName']);
}
elseif (isset($_GET['idDelete']))
{
    $actorController->deleteAction($_GET['idDelete']);}
elseif (isset($_POST['DeleteBtn']))
{
    $actorController->commitDeleteAction($_POST['deleteActorId']);
}
else
{
    $actorController->displayAction();
}

?>