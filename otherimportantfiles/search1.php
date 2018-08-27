<?php
    mysql_connect("localhost", "iraninvi_SiCoGen", "9Pjq_wY!DnE_") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysql_select_db("iraninvi_sinco") or die(mysql_error());
    /* csv is the name of database I've created */
?>

<!doctype html>
<html lang="en">
<head>
    <title>SiCoGenesDB > Single Copy Genes Database</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Main css -->
    <link href="css/style.css" rel="stylesheet">


    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>

    <script>
		$(document).ready( function () {
			$('#myTable').DataTable();
		} );
	</script>
	
	<style type="text/css">
		table.hover {
			font-family: verdana, arial, sans-serif;
			font-size: 13px;
			color: #333333;
		}

	</style>
		
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">

    <!-- Nav Menu -->
    <div class="nav-menu fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-dark navbar-expand-lg">
                        <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="img-fluid" alt="logo"></a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"> <a class="nav-link active" href="index.php">HOME <span class="sr-only">(current)</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" href="download.php">Download Data</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="upload.php">Upload Data</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="tools.php">Tools</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="browse.php">Browse Data</a> </li>
                                <li class="nav-item"><a href="citing.php" class="btn btn-outline-light my-3 my-sm-0 ml-lg-3">Cite Us</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <header class="bg-gradient" id="home">

	<div class="section light-bg">
        <div class="container">
            <div class="section-title">
			                <h4>Search Results</h4>
				<p>Some more information like searched table name...</p>
				<p>----------------------------------------------------------------------------------</p>

            <?php
    $query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM mytable
            WHERE (`genename` LIKE '%".$query."%') OR (`crossreferences` LIKE '%".$query."%') OR (`paralogs` LIKE '%".$query."%')") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
?>
    <table id="myTable" class="hover">
      <thead>
        <tr style = "text-align: left; border-bottom: 1px solid #ddd;">
		<th>Gene Name</th>
		<th>Cross refernces</th>
        <th>Paralogs (Top 10 best hits)</th>
        <th>Single Copy</th>
        </tr>
      </thead>
<?php
    while($results = mysql_fetch_assoc($raw_results)){
?>
    <tr style = "background-color: <?php if ($results['Paralogs']=="") {    echo '#81F79F';} ?>; text-align: left; border-bottom: 1px solid #ddd">
	  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Genename']; ?> </td>
      <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Crossreferences']; ?></td>
      <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Paralogs']; ?></td>
      <td style = "border-bottom: 1px solid #ddd;"><?php if ($results['Paralogs']=="") {    echo "Yes";}  ?></td>
    </tr>
<?php             
	}
?>
</table>
<?php
}
else{ // if there is no matching rows do following
  echo "<h5>No Results</h5>";
}         
    }
    else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
			
			</div>
					

			
        </div>
</div>


        </div>
    </div>
    <!-- // end .section -->

	
    </header>


	
    <footer class="my-5 text-center">
        <!-- Copyright removal is not prohibited! -->
        <p class="mb-2"><small>COPYRIGHT © 2017. ALL RIGHTS RESERVED to <a href="http://cbb.ut.ac.ir">CBB Lab</a>.</small></p>

        <small>
            <a href="#" class="m-2">PRESS</a>
            <a href="#" class="m-2">TERMS</a>
            <a href="#" class="m-2">PRIVACY</a>
        </small>
    </footer>
</body>

</html>