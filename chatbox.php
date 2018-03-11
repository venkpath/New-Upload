<?php 
require_once("dboperations.php");
if(session_id() == '') {
	session_start();
}
$username = $_SESSION['username'];


if(!empty($_POST["btn"])) {
$db_handle = new DBOperations();
if (isset($_POST['message']))    
{    
     $message = $_POST['message'];
}
 $query = "INSERT INTO chatComment (username ,message) VALUES('$username', '$message')";
$result = $db_handle->insertQuery($query);
}
?>

<html>
<head>
<style>
.popover{
    max-width: 60% !important; /* Max Width of the popover (depending on the container!) */
}
*{margin:0px; padding:0px;font-family: Helvetica, Arial, sans-serif;}
#logout{width:60px; height:20px; position:absolute; top:6px; right:20px; margin-bottom:40px; text-align:center; color:#fff}
#container{width:75%; height:auto; position:relative; top:8px; margin:auto;}

#session-name{width:100%; height:36px; margin-bottom:30px; font-size:20px}
.session-text{width:300px; height:30px;padding:6px 10px;margin: 8px 0;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box; font-size:24px}

#result-wrapper{width:100%; margin:auto; height:450px;}
#result{height:450px; overflow:scroll;overflow-x: hidden;}

#form-container{width:100%; margin:auto; height:80px;}
.form-text{float:left; width:85%; height:80px;}
#comment{width:100%; height:79px; resize:none;}
.form-btn{float:left; width:15%; height:80px;}
#btn{border:none; height:80px; width:100%; background:tomato; color:#fff; font-size:22px}

.chats{width:100%; margin-bottom:6px;}
.chats strong{color:#6d84b4}
.chats p{ font-size:14px; color:#aaa; margin-right:10px}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body onload="autoRefresh_div()">
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="homeview.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li class="active"><a href="chatbox.php"><span class="glyphicon glyphicon-envelope"></span> Chat</a></li>
      <li><a href="rentpaid.php"><span class="glyphicon glyphicon-calendar"></span> Rent Paid</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="profile.php" data-toggle="popover" data-placement="bottom" title="Popover Header"><span class="glyphicon glyphicon-user" ></span> Profile</a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	  
    </ul>
  </div>
</nav>
	
	<div id="result-wrapper">
	<div id="result">
		<?php
			include("load-messages.php");
		?>
	</div>			
</div>
		<form method='POST' action=""  id="my_form" name="my_form">
<div id="form-container">
	<div class="form-text">
    	<input type="text" style="display:none" id="username" name ="uname" value="<?= $_SESSION['username'] ?>">
    	<textarea id="comment" name="message" ></textarea>
    </div>
    <div class="form-btn">
    	<input type="submit" value="Send" id="btn" name="btn"/>
    </div>
</div>
</form>

<script>

function post()
{
  var comment = document.getElementById("comment").value;
  var name = document.getElementById("username").value;
  if(comment && name)
  {
    $.ajax
    ({
      type: 'post',
      url: 'insert-message.php',
      data: 
      {
         user_comm:comment,
	     user_name:name
      },
      success: function (response) 
      {
	    document.getElementById("comment").value="";
      }
    });
  }
  
  return false;
}

</script>


<script>
 function autoRefresh_div()
 {
      $("#result").load("load-messages.php");// a function which will load data from other file after x seconds
  }
 
  setInterval('autoRefresh_div()', 2000);
</script>
</body>
</html>