<!DOCTYPE HTML> <!--The following file loads all the messages which 
have spome relation to the logged user/group(they are a member or are 
from their members or are direct in some way)--> <html> <head> <script 
src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<title>CONMAN -- Main Page</title> </head> <body> 
<div id="newPost" class="postMain"> 
<h3>Make a new post to a group that we do later</h3>
<form action="userPost.php" method="post" 
enctype="multipart/form-data">
  <input name="replyTo" id="newPostReplyTo" type="hidden" value="-1">
  <input name="msgTo" id="newPostMsgTo" type="hidden" value="-1">
  <input name="msgFrom" id="newPostMsgFrom" type="hidden" value="<?php echo $_COOKIE['loggedUser'];?>">
  <input name="msgSubject" id="newPostMsgSubject" type="hidden" value="POST">
  <label for="newPostMsgText">Say Something To The Group: </label>
  <input type="text" id="newPostMsgText" name="msgText" value="">
  <label for="newPostFileToUpload">Upload a File: </label>
  <input type="file" name="msgAttach" id="newPostFileToUpload">

  <input type="reset" value="Clear Post">
  <input type="submit" value="Submit">
</form> 
</div>
<div id="wall" class="wall">
<!--Generate the posts from the messages as needed-->
<script>
function loadMessages() {
  // Declare variables
  var filter, table, tr, td, i, txtValue;//input
  //input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("messagesDataTable");
  tr = table.getElementsByTagName("tr");
  var entityTable = document.getElementById("entityDataTable");
  var etr = entityTable.getElementsByTagName("tr");

  var wallElement = document.getElementById("wall");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = "mid:"+tr[i].getElementsByTagName("td")[0];
    var nameTo=null;
    var nameFrom=null;
    for (var ik=0;ik<etr.length;ik++){
      if(etr[ik].getElementsByTagName("td")[2]==tr[i].getElementsByTagName("td")[0]){
        nameTo = tr[i].getElementsByTagName("td")[1]+"("+tr[i].getElementsByTagName("td")[2]+" "+tr[i].getElementsByTagName("td")[3]+")";
      }
      if(etr[ik].getElementsByTagName("td")[3]==tr[i].getElementsByTagName("td")[0]){
        nameTo = tr[i].getElementsByTagName("td")[1]+"("+tr[i].getElementsByTagName("td")[2]+" "+tr[i].getElementsByTagName("td")[3]+")";
      }
      if(nameTo!=null && nameFrom!=null){
        break;//break the loop when you find both the values
      }
    }  
    //get the subject value and POST
    if(tr[i].getElementsByTagName("td")[4]=="POST"){
      //main card
      var postCard = document.createElement("div");
      postCard.setAttribute("id",td);//set the if to the one generated by mid
      postCard.setAttribute("class", "card");
      //the header on the card
      var postHeader = document.createElement("h3");
      postHeader.innerHTML = nameFrom +" -> "+nameTo;
      postCard.appendChild(postHeader);//append the to/from info to the card
      //the card text
      var postData = document.createElement("p");
      postData.innerHTML = tr[i].getElementsByTagName("td")[5];
      postCard.appendChild(postData);//append the post data to the card
      //the image if there is one
      if(tr[i].getElementsByTagName("td")[6]!=""){
        var postImage = document.createElement("img");
        postData.setAttribute("src",tr[i].getElementsByTagName("td")[6]);
        postCard.appendChild(postImage);//append the post data to the card
      }
      //this section lets me put everything into this single point when needed
      var postComments = document.createElement("details");
      postComments.setAttribute("id",td+"com");//set the if to the one generated by mid
      postComments.setAttribute("class", "card");
      var postCommentsSum = document.createElement("summary");
      postCommentsSum.innerHTML = "Comments On Post";
      postComments.appendChild(postCommentsSum);
      postCard.appendChild(postComments);//append the post data to the card
      // Create a clone of element with id ddl_1:
      var postNewComments = document.createElement("details");
      postNewComments.setAttribute("class", "card");
      var postNewCommentsSum = document.createElement("summary");
      postNewCommentsSum.innerHTML = "Comments On Post";
      postNewComments.appendChild(postNewCommentsSum);
      let clone = document.getElementById("newPost").cloneNode( true );
      // Change the id attribute of the newly created element:
      clone.setAttribute( 'id', td+"posting" );
      postNewComments.appendChild(clone);
      postCard.appendChild(postNewComments);
      //
      wallElement.appendChild(postCard);
    }
    //get the subject value and COMMENT
    if(tr[i].getElementsByTagName("td")[4]=="COMMENT"){
      //use replyTo to generate a temp element to bind the comment(s) to as we go along
      ttd = "mid:"+tr[i].getElementsByTagName("td")[1]+"com";
      //mainPost
      tCard = document.getElementById(ttd);
      //main card
      var postCard = document.createElement("div");
      postCard.setAttribute("id",td);//set the if to the one generated by mid
      postCard.setAttribute("class", "card");
      //the header on the card
      var postHeader = document.createElement("h3");
      postHeader.innerHTML = nameFrom +" -> "+nameTo;
      postCard.appendChild(postHeader);//append the to/from info to the card
      //the card text
      var postData = document.createElement("p");
      postData.innerHTML = tr[i].getElementsByTagName("td")[5];
      postCard.appendChild(postData);//append the post data to the card
      //the image if there is one
      if(tr[i].getElementsByTagName("td")[6]!=""){
        var postImage = document.createElement("img");
        postData.setAttribute("src",tr[i].getElementsByTagName("td")[6]);
        postCard.appendChild(postImage);//append the post data to the card
      }
      //this section lets me put everything into this single point when needed
      var postComments = document.createElement("details");
      postComments.setAttribute("id",td+"com");//set the if to the one generated by mid
      postComments.setAttribute("class", "card");
      var postCommentsSum = document.createElement("summary");
      postCommentsSum.innerHTML = "Comments On Post";
      postComments.appendChild(postCommentsSum);
      postCard.appendChild(postComments);//append the post data to the card
      // Create a clone of element with id ddl_1:
      var postNewComments = document.createElement("details");
      postNewComments.setAttribute("class", "card");
      var postNewCommentsSum = document.createElement("summary");
      postNewCommentsSum.innerHTML = "Comments On Post";
      postNewComments.appendChild(postNewCommentsSum);
      let clone = document.getElementById("newPost").cloneNode( true );
      // Change the id attribute of the newly created element:
      clone.setAttribute( 'id', td+"posting" );
      postNewComments.appendChild(clone);
      postCard.appendChild(postNewComments);
      //
      tCard.appendChild(postCard);
    }
    //USE AS REF...
    /*
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
    */
  }
}
loadMessages();
</script>
</div>
<footer>
<detail>
<summary>Show All Data</summary>
<?php
  $loggedUser = 0;
  echo "<table id='messagesDataTable' style='border: solid 1px black;'>";
  echo "<tr><th>MID</th><th>TO</th><th>FROM</th><th>Subject</th><th>Text</th><th>Attachments</th></tr>";

  class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
      echo "<tr>";
      $counterVal=0;
    }

    function endChildren() {
      echo "</tr>" . "\n";
    }
  }

  $servername = "localhost";
  $username = "root";
  $password = "database";
  $dbname = "CONMANSYSTEM";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT mid, replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages 
    WHERE msgTo = $loggedUser 
    OR msgFrom = $loggedUser 
    OR msgTo IN (SELECT eid FROM relate WHERE tid = $loggedUser) 
    OR msgTo IN (SELECT tid FROM relate WHERE eid = $loggedUser)
    OR msgFrom IN (SELECT eid FROM relate WHERE tid = $loggedUser)
    OR msgFrom IN (SELECT tid FROM relate WHERE eid = $loggedUser)
    ");
    /*above lists out the following cases
    msgTO = $loggedUser: The message is directly to the logged user
    msgFrom = $loggedUser: The message is directly from the logged user 
    msgTo IN (SELECT eid FROM relate WHERE tid = $loggedUser): The message is to a group/person to whom the logged user is related
    msgTo IN (SELECT tid FROM relate WHERE eid = $loggedUser): The message is to a person/group who has a relation to the logged user
    msgFrom IN (SELECT eid FROM relate WHERE tid = $loggedUser): The message is from an entity which is related to the logged user
    msgFrom IN (SELECT tid FROM relate WHERE eid = $loggedUser): The message is from an entity which is related to the logged user
    */
    //this is for System Admin user (eid=0)
    if ($loggedUser = 0){
      $stmt = $conn->prepare("SELECT mid,replyTo, msgTo, msgFrom, msgSubject, msgText, msgAttach FROM messages");
    }
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
      echo $v;
    }
    

  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  //$conn = null;
  echo "</table>";
?> 
<!--Another is a list of related entities-->
<?php
  $loggedUser = 0;
  echo "<table id='entityDataTable' style='border: solid 1px black;'>";
  echo "<tr><th>MID</th><th>TO</th><th>FROM</th><th>Subject</th><th>Text</th><th>Attachments</th></tr>";

  class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
      return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
      echo "<tr>";
      $counterVal=0;
    }

    function endChildren() {
      echo "</tr>" . "\n";
    }
  }

  $servername = "localhost";
  $username = "root";
  $password = "database";
  $dbname = "CONMANSYSTEM";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT eid,userId,firstName, lastName FROM entity
    WHERE eid = $loggedUser 
    OR eid IN (SELECT eid FROM relate WHERE tid = $loggedUser) 
    OR eid IN (SELECT tid FROM relate WHERE eid = $loggedUser)
    ");
    /*above lists out the following cases
    the first and last name of every group plus the userId
    */
    //this is for System Admin user (eid=0)
    if ($loggedUser = 0){
      $stmt = $conn->prepare("SELECT eid,userId,firstName, lastName FROM entity");
    }
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
      echo $v;
    }
    

  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
  //$conn = null;
  echo "</table>";
?> 
</detail>
</footer>
</body>
</html>