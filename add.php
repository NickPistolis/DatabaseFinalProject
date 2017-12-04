<!DOCTYPE html>
<html>
<head>
<title>Challenge 4</title>
    <!--Import Google Icon Font-->
   <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
      <!--Import materialize.css
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <!--Let browser know website is optimized for mobile
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    -->
</head>

<body>
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    
<form method="post" action="/challenge4/index.php">
    <button type="submit">Click to go home</button>
</form>
    
    <div class="row">
    <form class="col s12" action="/challenge4/add.php" method="post">
      <div class="row">
        <div class="input-field inline">
          <label for="first_name">ISBN</label>
          <input id="first_name" type="text" class="validate" name="name" required>
          
        </div>
        <div class="input-field inline">
            <label for="Author">Name</label>
          <input id="Author" type="text" class="validate" name="author" required>
          
        </div>
      </div>
      <div class="row">
        <div class="input-field inline">
          <label for="ISBN">Author</label>
          <input id="ISBN" type="text" class="validate" name="isbn" required>
          
        </div>
          <div class="input-field inline">
          <label for="publisher">Publisher</label>
          <input id="publisher" type="text" class="validate" name="publisher" required>
          
        </div>
      </div>
         <div class="row">
        <div class="input-field inline">
           <label for="Year">Year</label>
          <input id="Year" type="number" class="validate" name="year" required min="1901" max="2155">
         
        </div>
          <div class="input-field inline">
         <label for="Edition">Edition</label>
          <input id="Edition" type="number" class="validate" name="edition"  required>
          
        </div>
      </div>
        <div class="row">
        <div class="input-field inline">
            <label for="test5">Hardcover?</label>
           <input type="checkbox" name="type" />
      
        </div>
            <label for="test5">In Stock?</label>
          <input type="checkbox" name="inStock" />
      
        </div>
      <div class="row">
        <div class="col s12">
          <div class="input-field inline">
            <input type="submit" value="Submit" name="submit">
            <!--<label>Submit</label>-->
          </div>
        </div>
      </div>
    </form>
  </div>
    
    <?php
    if(isset($_POST['submit'])){
        print_r($_POST);
	$mysqli = new mysqli('localhost', 'root', '123456789', 'challenge4');
	       if ($mysqli->connect_errno) 
           { //Terminate script if there is a connection error
	           echo "Failed to connect to MySQLI on Line 90";
	           exit();
	       }
        $query = "INSERT INTO library VALUES(?,?,?,?,?,?,?,?)";
        $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($query))
            {
                echo "Didn't prepare the statement properly";
                exit();
            }
        
        $inStock = $_POST['inStock'] === 'on'?1:0;
        $type =$_POST['type'] === 'on'?1:0;
        $stmt->bind_param(
            'ssssssii',
            $_POST['name'],
            $_POST['author'],
            $_POST['isbn'],
            $_POST['publisher'],
            $_POST['year'],
            $_POST['edition'],
            $type,
            $inStock
        );
        if(!$stmt->execute()){
            echo "FAILURE";
            print_r($stmt->error_list);
        }
        
        $query = "SELECT isbn, name FROM library";
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

    
    }
    
    ?>

</body>

</html>