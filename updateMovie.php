<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
    <form method="post" action="/challenge4/index.php">
    <button type="submit">Click to go home</button>
</form>
<?php
$mysqli = new mysqli('localhost', 'root', '123456789', 'challenge4');
$query = "SELECT * FROM Movies";
        $result = $mysqli->query($query);
    echo "<table class='table table-hover'>"; 
    echo "Number of Results: " . $result->num_rows; 
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
    <form method="post" action="/challenge4/updateMovie.php">
<div class="input-field inline">
        <label for="ISBN">Please type the title of the movie you would like to checkout</label>
          <input id="title" type="text" class="validate" name="title" required>
          
        </div>
<?php
$mysqli = new mysqli('localhost', 'root', '123456789', 'challenge4');
	       if ($mysqli->connect_errno) 
           { //Terminate script if there is a connection error
	           echo "Failed to connect to MySQLI on Line 52";
	           exit();
	       }
        $TitleValue=$_POST['title'];
        $query = "SELECT COUNT(*) FROM Movies WHERE Title = '$TitleValue'";
        $result = $mysqli->query($query);
        $query2= "SELECT nummovies from Movies where Title = '$TitleValue'";
        $result2 = $mysqli->query($query2);
        if($result->num_rows>0)
        {
            if($result2->num_rows>0)
            {
                $query3 = "UPDATE Movies SET nummovies=(nummovies-1) WHERE Title = '$TitleValue'"; 
                $result3 = $mysqli->query($query3);
                echo "Thanks for checking out a movie";
                $query="";
            }                
        }
        else{
            echo "Sorry that title doesnt exist in the library";
            exit();
        }
$mysqli->close(); 
?>
   
</form>
    
</body>

</html>
