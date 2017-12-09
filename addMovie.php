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
    <form class="col s12" action="/challenge4/addMovie.php" method="post">
      <div class="row">
        <div class="input-field inline">
          <label for="first_name">Title</label>
          <input id="first_name" type="text" class="validate" name="title" required>
          
        </div>
        <div class="input-field inline">
            <label for="Author">Genre</label>
          <input id="Author" type="text" class="validate" name="genre" required>
          
        </div>
      </div>
      <div class="row">
        <div class="input-field inline">
          <label for="ISBN">Rating</label>
          <input id="ISBN" type="text" class="validate" name="rating" required>
           
        </div>
          <div class="input-field inline">
          <label for="publisher">Producer</label>
          <input id="publisher" type="text" class="validate" name="producer" required>
          
        </div>
      </div>
         <div class="row">
        <div class="input-field inline">
           <label for="Year">Year</label>
          <input id="Year" type="number" class="validate" name="year" required min="1901" max="2155">
         
        </div>
          <div class="input-field inline">
         <label for="Edition">Studio</label>
          <input id="Edition" type="number" class="validate" name="studio"  required>
          
        </div>
      </div>
        <div class="row">
        <div class="input-field inline">
            <label for="test5">Reboot?</label>
           <input type="checkbox" name="type" />
      
        </div>
            
      
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
       // print_r($_POST);
	$mysqli = new mysqli('localhost', 'root', '123456789', 'challenge4');
	       if ($mysqli->connect_errno) 
           { //Terminate script if there is a connection error
	           echo "Failed to connect to MySQLI on Line 90";
	           exit();
	       }
        $query = "INSERT INTO Movies VALUES(?,?,?,?,?,?,?,?)";
        #$stmt = $mysqli->stmt_init();
            #if($stmt->prepare($query))
            if(!($stmt = $mysqli->prepare($query)))
            {
                echo "Didn't prepare the statement properly";
                #print_r($stmt->error_list);
                #print_r($mysqli->error_list);
                #var_dump($stmt);
                #var_dump($mysqli);
                exit();
            }
        
        $numMovies = $_POST['NumMovies'] === 'on'?1:0;
        $reboot =$_POST['reboot'] === 'on'?1:0;
        $stmt->bind_param(
            'ssssssii',
            $_POST['title'],
            $_POST['genre'],
            $_POST['rating'],
            $_POST['producer'],
            $_POST['studio'],
            $_POST['year'],
            $reboot,
            $numMovies
        );
        if(!$stmt->execute()){
            echo "FAILURE";
            print_r($stmt->error_list);
        }
        
        $query = "SELECT * FROM Movies";
        $result = $mysqli->query($query);
/*
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
    */
    $mysqli->close();

    
    }
    
    ?>

</body>

</html>