<!DOCTYPE HTML>
<html>
    <head>
        <title>Library</title>
    </head>

    <body>
        <h1>Welcome to our library</h1>
        <form method="post" action="/challenge4/add.php">
            <button type="submit">Click to add a book</button>
        </form>
        <form method="post" action="/challenge4/addMovie.php">
            <button type="submit">Click to add a movie</button>
        </form>
        <form method="post" action="/challenge4/updateBook.php">
            <button type="submit">Click to checkout a book</button>
        </form>
        <form method="post" action="/challenge4/updateMovie.php">
            <button type="submit">Click to checkout a movie</button>
        </form>
        <form method="post" action="/challenge4/drop.php">
            <button type="submit">Click to delete a book</button>
        </form>
         <form method="post" action="/challenge4/dropMovie.php">
            <button type="submit">Click to delete a movie</button>
        </form>
        <h2>Our current books in stock:</h2>
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
        <h2>Our current movie in stock:</h2>
        
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
    </body>

</html>