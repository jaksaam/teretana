<?php

require_once 'config.php';

if(!isset($_SESSION['admin_id'])) {
    header('location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    </head>
    <body>
        
<div class="container">

</div>

    </body>
</html>