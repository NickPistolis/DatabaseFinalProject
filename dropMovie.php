<!DOCTYPE HTML>
<html>
<head>
<title>Challenge 4</title>
</head>

<body>
<form method="post" action="/challenge4/index.php">
    <button type="submit">Click to go home</button>
</form>
<?php
    
    $mysqli = new mysqli('localhost', 'root', '123456789', 'challenge4');
	       if ($mysqli->connect_errno) 
           { //Terminate script if there is a connection error
	           echo "Failed to connect to MySQLI on Line 13";
	           exit();
	       }
    
    $query = "SELECT * FROM Movies";
        $result = $mysqli->query($query);

    echo "<table class='table table-hover'>"; 
    while($fieldInfo = mysqli_fetch_field($result)){
        echo "<th>". $fieldInfo->name. "</th>";
    } 
    echo "</thead>";
    while($row = $result->fetch_array(MYSQLI_NUM)){ 
        echo "<tr>"; 
        
        foreach($row as $r){
            echo "<td>" . $r . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    $mysqli->close();    
?>
    
    <form method="post" action="/challenge4/dropMovie.php">
    <div class="input-field inline">
        <label for="ISBN">Please type the Title of the movie you would like to remove</label>
          <input id="title" type="text" class="validate" name="title" required>
          
        </div>
        
<?php
	$mysqli = new mysqli('localhost', 'root', '123456789', 'challenge4');
	       if ($mysqli->connect_errno) 
           { //Terminate script if there is a connection error
	           echo "Failed to connect to MySQLI on Line 52";
	           exit();
	       }
        $titleValue=$_POST['title'];
        $query = "SELECT COUNT(*) FROM Movies WHERE Title = '$titleValue'";
        $result = $mysqli->query($query);
        if($result->num_rows>0)
        {
            $query = "DELETE FROM Movies WHERE Title = '$titleValue'";
            $result = $mysqli->query($query);            
        }
        else{
            echo "Sorry that title doesnt exist in the library";
        }
        echo "<table class='table table-hover'>"; 
    while($fieldInfo = mysqli_fetch_field($result)){
        echo "<th>". $fieldInfo->name. "</th>";
    } 
    echo "</thead>";
    while($row = $result->fetch_array(MYSQLI_NUM)){ 
        echo "<tr>"; 
        
        foreach($row as $r){
            echo "<td>" . $r . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    $mysqli->close(); 
        
        

      header("Refresh:0");        
    ?>
        
</form>
    
    
    
</body>

</html>