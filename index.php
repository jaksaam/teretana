<?php

require_once 'config.php';


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT admin_id, password FROM admins WHERE username = ?";

    $run = $conn->prepare($sql);
    $run->bind_param("s", $username);
    $run->execute();  //izvrsenje

    $results = $run->get_result();

    
    if($results->num_rows == 1) {
       
        $admin = $results->fetch_assoc();

        if(password_verify($password, $admin['password'])) {                  //$admin['password'] === $password pre je ovo bilo u zagradi dok nije dosao momenat za hashovanje sifre.
            $_SESSION['admin_id'] = $admin['admin_id'];    // ovde smo u sesiji sacuvali admin_id, to je zbog zastite ulaska na admin_dashboard i ovo pored je admin koji smo koristili gore vec tu su nam i sifra i sve.
           
            $conn->close();
            header('location: admin_dashboard.php');            // ovaj header nam sluzi kao redirect i ovde smo izmenili tacna sifra i namestili da nas vuce ka admin dashboard-u(kontronoj tabli gde se sve odvija sa nasom aplikacijom u smislu dodvanja trenera clanovima itd...)
        } else {
            $_SESSION['error'] = "Netacna lozinka";         //varijabla koja postoji u php $_SESSION i pisali smo tu da nam izbaci poruku nakon pogresnog unosa zavisi sta je u pitanju. Ovde je slucaj sa lozinkom.
           
            $conn->close();
            header('location: index.php');   // ovaj header nam sluzi kao redirect i ovde smo izmenili sifra netacna da nam ustvari vuce nazad na stranicu kad pogresimo.
            exit();  //obavezno pisati nakon redirecta da se ne bi mesalo izvrsavanje koje smo dole pisali pa da nam na primer ne obrise poruku odma.
        }

    } else {
        $_SESSION['error'] = "Netacan username";     //varijabla koja postoji u php $_SESSION i pisali smo tu da nam izbaci poruku nakon pogresnog unosa zavisi sta je u pitanju. Ovde je slucaj sa username.
       
        $conn->close();
        header('location: index.php');      // ovaj header nam sluzi kao redirect i ovde smo izmenili admin(username) ne postoji netacna da nam ustvari vuce nazad na stranicu kad pogresimo.
        exit(); //obavezno pisati nakon redirecta da se ne bi mesalo izvrsavanje koje smo dole pisali pa da nam na primer ne obrise poruku odma.
    }
} 

?>


<!DOCTYPE html>
<html>
    <head>
    <title>
        Admin login
    </title>
    </head>
    <body>

<?php

if(isset($_SESSION['error'])) {      //znaci ovako smo ucitavali one session-se i dodali smo najpre uslov isset? da li je setovano, da li je postavljeno ako nije postavljeno onda ne smemo nista da radimo.
    echo $_SESSION['error'] . "<br>";   //ispis ovog svega, i na kraju nam je ostao problem sto nam je nakon refresh-a to sve ostajalo gore te poruke, znaci moramo obrisati i u sledecoj liniji smo obrisali.
    unset($_SESSION['error']);    //brisanje poruka nakon refresha.
}

?>
        <form action="" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="login">
        </form>
    </body>
</html>