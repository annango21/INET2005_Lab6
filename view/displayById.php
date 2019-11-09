<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Search Result</title>
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
<h1>Search Result</h1>
</div>
<table style="margin: 20px" >
    <thead>
    <tr>
        <th>Actor ID</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $currentActor->getID() ?></td>
            <td><?php echo $currentActor->getFirstName(); ?></td>
            <td><?php echo $currentActor->getLastName(); ?></td>
         </tr>
    </tbody>
    <tfoot></tfoot>
</table>
</body>
</html>
