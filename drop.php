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
    
    $query = "SELECT isbn, name FROM library";
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
    
    <form method="post" action="/challenge4/drop.php">
    <div class="input-field inline">
        <label for="ISBN">Please type the ISBN of the book you would like to remove</label>
          <input id="ISBN" type="text" class="validate" name="isbn" required>
          
        </div>
        
<?php
	$mysqli = new mysqli('localhost', 'root', '123456789', 'challenge4');
	       if ($mysqli->connect_errno) 
           { //Terminate script if there is a connection error
	           echo "Failed to connect to MySQLI on Line 52";
	           exit();
	       }
        $isbnValue=$_POST['isbn'];
        $query = "SELECT COUNT(*) FROM library WHERE isbn = '$isbnValue'";
        $result = $mysqli->query($query);
        if($result->num_rows>0)
        {
            $query = "DELETE FROM library WHERE isbn = '$isbnValue'";
            $result = $mysqli->query($query);            
        }
        else{
            echo "Sorry that isbn doesnt exist in the library";
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
        

              
    ?>
        
</form>
    
</body>

</html>