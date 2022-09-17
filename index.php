<?php
session_start();
session_unset();
session_destroy();
?>
<html lang="en">
<head>
    <title>Games</title>
    <link rel="stylesheet" href="index.css">  <!-- <-- Change on Dir Change -->
</head>
<body>
<div class="login-box">
  <h2>Welcome</h2>
  <form id="main_form" action="db.php" method="post"> <!-- <-- Change on Dir Change -->

    <div class="user-box">
      <input type="text" name="Name" required>
      <label>Name</label>
    </div>

    <div class="user-box">
      <input type="text" name="Room_Id" required>
      <label>Room Id</label>
    </div>
    <input type="hidden" name="" id="type" required>
    
    <a href="javascript:;" onclick="document.getElementById('type').name = 'join';document.getElementById('main_form').submit();">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Join
    </a>

    <a href="javascript:;" onclick="document.getElementById('type').name = 'create';document.getElementById('main_form').submit();">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Create Lobby
    </a>
  </form>
</div>
</body>

<?php

if(isset($_GET['Full'])){
    echo '<script type="text/JavaScript"> 
        alert("The Room You Are Trying To Enter Has Reached Maximum Capacity.");
     </script>';
}
if(isset($_GET['Room_Not_Found'])){
    echo '<script type="text/JavaScript"> 
        alert("The Room You Are Trying To Enter Does Not Exist.");
     </script>';
}
if(isset($_GET['Server_Error']) || isset($_GET['Not_Successful'])){
    echo '<script type="text/JavaScript"> 
        alert("There Is Some Internal Server Error. Please Try Again Later.");
     </script>';
}

?>