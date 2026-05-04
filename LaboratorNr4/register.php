<?php
require 'config.php';

//post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //take from form
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    //verify passw confirmation
    if ($password === $confirm) {
        
        //verify user
        $check_sql = "SELECT id FROM users WHERE email='$email'";
        $check_result = $conn->query($check_sql);

        //email exist q?
        if ($check_result->num_rows > 0) {      
             echo "<script>
                    alert('Eroare: Există deja un cont cu această adresă de email!');
                    window.location.href = 'signin.html';
                  </script>";
        } else {    //free email
            $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";
            
            if ($conn->query($sql) === TRUE) {
                //popup
                echo "<script>
                        alert('Contul a fost creat cu succes! Acum te poți autentifica.');
                        window.location.href = 'login.html';
                      </script>";
            } else {
                //alternative error
                echo "<script>
                        alert('A apărut o eroare la crearea contului. Te rugăm să încerci din nou.');
                        window.location.href = 'signin.html';
                      </script>";
            }
        }

    } else {
        //verify passw confirm = 0
        echo "<script>
                alert('Eroare: Parolele nu coincid!');
                window.location.href = 'signin.html';
              </script>";
    }
}
$conn->close();
?>