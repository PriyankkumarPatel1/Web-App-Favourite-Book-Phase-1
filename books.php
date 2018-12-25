<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>All The Books </title>
 <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
  <div class="container">
   
    <h1> The List of Top books in the world... </h1>
    <!--link for adding new book in database-->
    <a href="index.php">Add new BOOK to database</a>
    
    <?php
    
    ob_start(); // turn on the output buffering
    
    try { // this will execute and if any error occurs then the catch block will be execute excepting remaining code to be execute.
    
    //access the database
    
    require('db.php');
 
    //set up our SQL query 
    
    $sql = "SELECT * FROM books";
    
    //prepare
    
    $cmd = $conn->prepare($sql);
    
    //run that query 
    
    $cmd->execute(); 
    
    //use fetchAll to store results 
    
    $books = $cmd->fetchAll(); 
    
    //echo out table header 
    
    echo '<table class="table table-striped">
            <thead>
                <th> book_title </th>
                <th> book_genre </th>
                <th> book_review </th>
                <th> full_name </th>
                <th> email </th>
                <th> link_to_website </th>
                <th> Edit? </th>
                <th> Delete? </th>
            </thead>
          <tbody>';
    
    //loop through data and create a new table row for each record 
    
    foreach ($books as $book) {
      echo '<tr><td>' . $book['book_title'] . 
      '</td><td>' . $book['book_genre'] . 
      '</td><td>' . $book['book_review'] . 
      '</td><td>' . $book['full_name'] . 
      '</td><td>' . $book['email'] .
      '</td><td>' . $book['link_to_website'] .
      '</td><td><a href="index.php?ID_Number=' . $book['ID_Number'] . '">Edit</a></td>
      <td><a href="delete_book.php?ID_Number=' . $book['ID_Number'] . '"onclick="return confirm(\'Are you sure to delete this book?\');"> Delete </a></td></tr>';
    }
    
    echo '</tbody></table>';
    
    //close the database connection 
    
    $conn = NULL; 
      
    }
    catch(Exception $e) {
      //send an email to the app admin 
      mail('pppriyank157@gmail.com', 'Book Database Problems!!!', $e);
      
      header('location:error.php');
      
    }
    
    ob_flush(); // send the output buffer

    ?>
  
  </div>

</body>
</html>