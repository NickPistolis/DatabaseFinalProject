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
$query = "SELECT * FROM library";
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
    <form method="post" action="/challenge4/updateBook.php">
<div class="input-field inline">
        <label for="ISBN">Please type the ISBN of the book you would like to update</label>
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
        $query2= "SELECT NumBooks from library where isbn = '$isbnValue'";
        $result2 = $mysqli->query($query2);
        if($result->num_rows>0)
        {
            if($result2->num_rows>0)
            {
                $query3 = "UPDATE library SET NumBooks=(NumBooks-1) WHERE isbn = '$isbnValue'"; 
                $result3 = $mysqli->query($query3);
                echo "Thanks for checking out a book";
                $query="";
            }
                        
        }
        else{
            echo "Sorry that isbn doesnt exist in the library";
            exit();
        }
$mysqli->close(); 
?>
</form>
    
</body>

</html>









