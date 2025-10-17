<?php
getenv($host);
getenv($user);
getenv($user);
getenv($dbname);
$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo $userID;




?>
<html>
<div>
    <form>
        <input>


    </form>
</div>


</html>
