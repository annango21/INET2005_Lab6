<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Actors</title>
        <style type="text/css">
            table
            {
               border: 1px solid purple;
            }
            th, td
            {
               border: 1px solid red;
            }
        </style>
    </head>
    <body>
        <?php
            if(!empty($lastOperationResults)):
        ?>
        <h2><?php echo $lastOperationResults; ?></h2>
        <?php
            endif;
        ?>
        <h1>Current Actors:</h1>
        <div>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?actorInsert" style="text-decoration: none; margin: 20px;">
                <img src="images/plusicon.png" height="25px" width="25px"/> Insert Actor to Table
            </a>
        </div>
        <div class="search" style ="margin: 20px;">
            <form action="<?php $_SERVER['PHP_SELF'] ?>"  method="post" name="searchData">
                <p>Search Actor by ID:
                    <input name="idSearch" type="text">
                </p>
                <p>
                    <input name="searchBtn" type="submit" value="Search">
                </p>
            </form>
        </div>
        <table style="margin: 20px" >
            <thead>
                <tr>
                    <th>Actor ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($arrayOfActors as $actor):
                    ?>
                        <tr>
                            <td><?php echo $actor->getID(); ?></td>
                            <td><?php echo $actor->getFirstName(); ?></td>
                            <td><?php echo $actor->getLastName(); ?></td>
                            <td>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?idUpdate=<?php echo $actor->getID(); ?>">
                                    <img src="images/edit_icon.png" height="25px" width="25px"/>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>?idDelete=<?php echo $actor->getID(); ?>">
                                    <img src="images/DeleteRed.png" height="25px" width="25px"/>
                                </a>
                            </td>

                        </tr>
                    <?php
                    endforeach;
                ?>
            </tbody>
            <tfoot></tfoot>
        </table>  
    </body>
</html>
