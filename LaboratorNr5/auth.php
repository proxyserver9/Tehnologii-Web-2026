<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //validate
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $fullname = $row['fullname'];
        
        //save localSt
        echo "<script>
                localStorage.setItem('user_fullname', '" . addslashes($fullname) . "');
                alert('Autentificare cu succes! Bine ai venit, " . addslashes($fullname) . ".');
                window.location.href = 'hp.html';
              </script>";
    } else {        //redir login 
        echo "<script>
                alert('Eroare: Email sau parola incorecta!');
                window.location.href = 'login.html';
              </script>";
    }
}
$conn->close();
?>