<?php
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if (!empty($username)||!empty($email)||!empty($password)||empty($cpassword)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "dishari";
    $conn= new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if (mysqli_connect_error()) {

      die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else{
      $SELECT = "SELECT email from donorinfo where email = ? Limit 1 ";
      $INSERT = "INSERT Into donorinfo (username,email,password,cpassword) values(?,?,?,?)";
      $stmt= $conn->prepare($SELECT);
      $stmt->bind_param("s",$email);
      $stmt->execute();
      $stmt->bind_result($email);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

      if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssss",$username,$email,$password,$cpassword);
        $stmt->execute();
        echo "Registration is Completed";
       

       }else{
        echo "Someone already register using this email";


       }
       $stmt->close();
       $conn->close();






    }

  }
  else{
    echo "All field are required";
    die();
  }

  
?>