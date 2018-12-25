DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saving your book information</title>
</head>
<body>

<?php
// store the form inputs in variables
$book_title = filter_input(INPUT_POST, 'book_title');
$book_genre =  filter_input(INPUT_POST, 'book_genre');
$book_review =  filter_input(INPUT_POST, 'book_review');
$full_name = filter_input(INPUT_POST, 'full_name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$link_to_website = filter_input(INPUT_POST, 'link_to_website');

  
// add the movie id in case you are editing 

$ID_Number = NULL; 
$ID_Number = $_POST['ID_Number'];
  
//set up a flag variable 
  
$ok = true; 

//checking if name is filled in
  
if(empty($book_title)) {
  echo "<p> Book title is required.</p>";
  $ok = false; 
}
if(empty($book_genre)) {
    echo "<p> Book genre is required.</p>";
    $ok = false; 
}
if(empty($book_review)) {
    echo "<p> Your Review will be very useful.</p>";
    $ok = false; 
}
if(empty($full_name)) {
    echo "<p> Full name is required.</p>";
    $ok = false; 
}
if(empty($link_to_website)) {
    echo "<p> Link to website for is required.</p>";
    $ok = false; 
}
  
//check if user has provided email 
  
if(empty($email)) {
  echo "<p> Email is required.</p>";
  $ok = false; 
}
  
//check that email is valid 
  
if($email === FALSE ) {
  echo "<p> Email is not valid.</p>";
  $ok = false; 
}
  
//check that movie was filled out 
  
if($ok == TRUE) {

    // connecting to the database
    require_once('db.php'); 

    //add this for update 
   if(!empty($ID_Number)) {
      
    $sql = "UPDATE books SET book_title = :book_title, book_genre = :book_genre, book_review = :book_review, full_name = :full_name, email = :email, link_to_website = :link_to_website WHERE ID_Number = :ID_Number";  
      
    }
    //take out else and start with insert 
   else {
    // set up an SQL command to save the new game
    $sql = "INSERT INTO books (book_title, book_genre, book_review, full_name, email, link_to_website) VALUES (:book_title, :book_genre, :book_review, :full_name, :email, :link_to_website)";
    
    }

    // set up a command object
    $cmd = $conn->prepare($sql);

    // fill the placeholders with the 4 input variables
    $cmd->bindParam(':book_title', $book_title);
    $cmd->bindParam(':book_genre', $book_genre);
    $cmd->bindParam(':book_review', $book_review);
    $cmd->bindParam(':full_name', $full_name);
    $cmd->bindParam(':email', $email);
    $cmd->bindParam(':link_to_website', $link_to_website);
  
    if(!empty($ID_Number)) {
      $cmd->bindParam(':ID_Number', $ID_Number);   
    }

    // execute the insert
    $cmd->execute();

    // show message
    echo "Book Saved";

    // disconnecting
    $cmd->closeCursor();
    echo "<br>All Done.";
  }
  

?>
<p><a href="index.php">Add new BOOK to database</a></p>
<p><a href="books.php"> View All Books </a></p>
    
</body>
</html>