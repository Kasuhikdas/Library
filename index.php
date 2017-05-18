
<?php
$return=0;
$issue=0;
$msg=0;
$id='';
$book_id='';
$name='';
$fine='';
$return_date='';
$issue_id='';
  if (isset($_GET['return_id'])) {
    $return=1;
    $id=$_GET['return_id'];
    $name=$_GET['name'];
    $fine=$_GET['fine'];
    $book_id=$_GET['book_id'];
  }
 elseif (isset($_GET['msg'])) {
  $msg=1;
 }
 elseif (isset($_GET['issue'])) {
   $issue=1;
   $return_date=$_GET['return_date'];
   $issue_id=$_GET['id'];
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
 var i=0;
 i=<?php echo $return;?>;
 msg=<?php echo $msg;?>;
 issue=<?php echo $issue;?>;
 $(document).ready(function() {
  if (i==1) {
    
     $("#return").modal("show");
  }
  else if (msg==1) {
    
     $("#msg").modal("show");
  }
  else if (issue==1) {
     $("#issue").modal("show");
  }
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

</script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <style media="screen">
        @import url(http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300ita‌​lic,400italic,500,500italic,700,700italic,900italic,900);
        html, html * {
            font-family: Roboto;
            font-weight: 400;
        }
        </style>

         <style media="screen">
        </style>
        <style>

</style>
        </head>
        <body >
<div class="container">
	<div class="row" >
        <div class="col-lg-11 bhoechie-tab-container">
            <div class="col-md-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class="glyphicon glyphicon-export"></h4><br/>Issue Book
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-import"></h4><br/>Return Book
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-plus-sign"></h4><br/>Add Book
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-th-list"></h4><br/>View Book
                </a>
               
              </div>
            </div>
            <div class="col-xs-9 bhoechie-tab " style="height: 70%;">
                <!-- Issue section -->
                <div class="bhoechie-tab-content active">
                   
                   <div class="container" >
                     <div class="row">
                       <div class="col-md-4">
                        <h3>Issue Book</h3>
                         <form class="form-group"  method="POST" action="php/issue.php" >
                           <label for="book_id">Book ID</label>
                           <input type="number" name="book_id" placeholder="Book ID" class="form-control" required>
                           <label>Roll</label>
                           <input type="text" name="roll" placeholder="Roll No" class="form-control" required>
                           <label>Name</label>
                           <input type="text" name="name" pattern="[a-zA-Z][a-zA-Z ]+" placeholder="Name" class="form-control" required>
                            <label>Standard</label>
                           <input type="number" name="std" min="1" max="12" placeholder="Standard" class="form-control" required>
                           <label>Section</label>
                           <input type="text" name="section" pattern="[a-zA-Z]" placeholder="section" class="form-control" required>
                           <button class="btn btn-primary">Issue</button>
                         </form>
                       </div>
                     </div>
                   </div>
                   
                </div>
                <!-- Return section -->
                <div class="bhoechie-tab-content">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4" >
                        <h3>Return Book</h3>
                        <form class="form-group" method="POST" action="php/return.php">
                        <label>Issue ID</label>
                          <input type="text" name="issue_id" placeholder="Issue ID" class="form-control" required>
                          <button class=" btn btn-primary">Take Back</button>
                        </form>
                        </div>
                      </div>
                    </div>
                </div>
    
                <!-- hotel search -->
                <div class="bhoechie-tab-content">
                    <div class="row">
                      <div class="col-md-4">
                        <h3>Add Boook</h3>
                        <form class="form-group" method="POST" action="php/book_insert.php">
                          <label>Book Name</label>
                          <input type="text" name="book_name" pattern="[a-zA-Z][a-zA-Z ]+" placeholder="Book Name" class="form-control" required>
                          <label>Author</label>
                          <input type="text" name="author" pattern="[a-zA-Z][a-zA-Z ]+" placeholder="Author" class="form-control" required>
                          <label>Publisher</label>
                          <input type="text" name="publisher" pattern="[a-zA-Z][a-zA-Z ]+" placeholder="Publisher" class="form-control" required>
                          <label>Edition</label>
                          <input type="text" name="edition" placeholder="Edition" class="form-control" required> 
                          <button class="btn btn-primary">Add Book</button>
                        </form>
                      </div>
                    </div>
                </div>
                <div class="bhoechie-tab-content">
                <?php
                  include 'php/connection.php';
                  $sql="SELECT * FROM books order by id desc limit 5";
                  $result=$conn->query($sql);
                  while($row=$result->fetch_assoc())
                  {
                    echo '<div class="Panel with panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title">ID:'.$row['id'].'  '.$row['name'].'</h3>
                      </div>
                     <div class="panel-body">
                        <ul>
                     <li>Author:'.$row['author'].' </li>
                     <li>Publisher:'.$row['publisher'].'</li>
                     <li>Edition:'.$row['edition'].'</li>
                     <li>Availability:'.$row['status'].'</li>
                   </ul>
                    </div>
                  </div>';
                  }
                ?>

                    <a data-toggle="modal" data-target="#books">Show More</a>
                    </div>
                </div>
               
            </div>
        </div>
  </div>
</div>
<!--Return Modal -->
<div class="modal" id="return" role="dialog" style="margin-top:100px;" >
   <div class="modal-dialog">

     <!-- Modal content-->
     <div class="modal-content" >
       <div class="modal-header" style="background-color:#5A55A0; ">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <p style="font-size:30px; color:white; font-family:Roboto; font-weight:300;">Take Back</p>
       </div>
       <div class="modal-body">
           <div class="logdiv">
           <form action="php/returned.php" method="POST">
           <div class="jumbotron">
           <div class="row"><div class="col-md-1"></div><div class="col-md-4">
                <?php
                  include 'php/connection.php';
                  $sql="SELECT * from books where id=$book_id";
                  $result=$conn->query($sql);
                  $row=mysqli_fetch_assoc($result);
                  echo "<h4>Book Id:".$row['id']."</h4>";
                  echo "<h4>Book Name:".$row['name']."</h4>";
                  echo "<h4>Author:".$row['author']."</h4>";
                  echo "<h4>Publisher:".$row['publisher']."</h4>";
                   echo "<h4>Withdrawer:".$name."</h4>";
                  
                  echo "<h4>Fine:".$fine."</h3><hr>";

                ?>
                <input type="hidden" name="id" value="<?php echo $id ;?>">
                 <input type="hidden" name="fine" value="<?php echo $fine;?>">
                  <input type="hidden" name="book_id" value="<?php echo $book_id;?>">
                <input class="btn btn-primary" type="submit" name="Book">
                </div>
                </div>
                </div>
            </div>
            </form>
           </div>
         </div>
       <div class="modal-footer">
        
       </div>
     </div>

   </div>

 </div>
 <div class="modal" id="msg" role="dialog" style="margin-top:100px;" >
   <div class="modal-dialog">

     <!-- Modal content-->
     <div class="modal-content" >
       <div class="modal-header" style="background-color:#5A55A0; ">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <p style="font-size:30px; color:white; font-family:Roboto; font-weight:300;">Message</p>
       </div>
       <div class="modal-body">
           <div class="logdiv">
           
                <?php
                  echo $_GET['msg'];
                  
                ?>
               
            
           
           </div>
         </div>
       <div class="modal-footer">
        
       </div>
     </div>

   </div>

 </div>
  <div class="modal" id="issue" role="dialog" style="margin-top:100px;" >
   <div class="modal-dialog">

     <!-- Modal content-->
     <div class="modal-content" >
       <div class="modal-header" style="background-color:#5A55A0; ">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <p style="font-size:30px; color:white; font-family:Roboto; font-weight:300;">Message</p>
       </div>
       <div class="modal-body">
           <div class="logdiv">
           <h3>Issue Id:
                <?php
                  echo $_GET['id'];
                  echo $_GET['return_date'];
                  
                ?></h3>
                <hr>
                <h3>Return Date:
                <?php
                  
                  echo $_GET['return_date'];
                  
                ?></h3>
               
            
           
           </div>
         </div>
       <div class="modal-footer">
        
       </div>
     </div>

   </div>

 </div>
  <div class="modal" id="books" role="dialog"  >
   <div class="modal-dialog">

     <!-- Modal content-->
     <div class="modal-content" >
       <div class="modal-header" style="background-color:#5A55A0; ">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <p style="font-size:30px; color:white; font-family:Roboto; font-weight:300;">Message</p>
       </div>
       <div class="modal-body">
            <?php
                  include 'php/connection.php';
                  $sql="SELECT * FROM books ";
                  $result=$conn->query($sql);
                  while($row=$result->fetch_assoc())
                  {
                    echo '<div class="Panel with panel-info">
                    <div class="panel-heading">
                      <h3 class="panel-title">ID:'.$row['id'].'  '.$row['name'].'</h3>
                      </div>
                     <div class="panel-body">
                        <ul>
                     <li>Author:'.$row['author'].' </li>
                     <li>Publisher:'.$row['publisher'].'</li>
                     <li>Edition:'.$row['edition'].'</li>
                     <li>Availability:'.$row['status'].'</li>
                   </ul>
                    </div>
                  </div>';
                  }
                ?>
         </div>
       <div class="modal-footer">
        
       </div>
     </div>

   </div>

 </div>

</body>
</html>
