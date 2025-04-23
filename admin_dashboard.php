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

<?php if(isset($_SESSION['success_message'])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php 
        echo $_SESSION['success_message']; 
        unset($_SESSION['success_message']);
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
        
<div class="container">
    <div class="row mb-5">
        <div class="col-md-6">
            <h2>Register Member</h2>
            <form action="register_member.php" method="post" enctype="multipart/from-data">  
                First Name: <input class="form-control" type="text" name="first_name"> <br>
                Last Name: <input class ="form-control" type="text" name="last_name">  <br>
                Email: <input class ="form-control" type="email" name="email">  <br>
                Phone Number: <input class ="form-control" type="text" name="phone_number">  <br>

                Training plan:
                <select class="form-control" name="training_plan_id">
                    <option value="" disabled selected> Training Plan</option>
                 
                    <?php
                    $sql = "SELECT * FROM training_plans";
                    $run = $conn->query($sql);
                    $results = $run->fetch_all(MYSQLI_ASSOC);

                    foreach($results as $result) {
                        echo "<option value='" . $result['plan_id'] . "'>" . $result['name'] . "</option>";
                    }

                    ?>

                    </select><br>
                    <input type="hidden" name="photo_path" id="photoPathInput">
                    <div id="dropzone-upload" class="dropzone"></div>

                    <input class="btn btn-primary mt-3" type="submit" value="Register Member">
            </form>         
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    </body>
</html>