<?php
  $Name = $_POST['Name'];
  $Email = $_POST['Email'];
  $Massage = $_POST['Massage'];
  

  if (!empty($Name)||!empty($Email)||!empty($Massage) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "contact";
    $conn= new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if (mysqli_connect_error()) {

      die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }else{
      $SELECT = "SELECT Email from contact where Email = ? Limit 1 ";
      $INSERT = "INSERT Into contact (Name,Email,Massage) values(?,?,?)";
      $stmt= $conn->prepare($SELECT);
      $stmt->bind_param("s",$Email);
      $stmt->execute();
      $stmt->bind_result($Email);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

      if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sss",$Name,$Email,$Massage);
        $stmt->execute();
        echo "Thank you for your suggestion";
       

       }else{
        echo "We have already got your suggestion";


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