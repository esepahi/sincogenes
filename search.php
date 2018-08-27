<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>SinCoGenesDB</title>
<!-- DataTables CSS and JS -->
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

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.html");
?>


<div id="nav">
<div class="topnav">
  <a href="index.php">Home</a>
  <a href="blast_form.php">Blast</a>
  <a href="cynconet.php">CynCoNet</a>
  <a href="analyze.php">Analyze</a>
  <a href="classify.php">Classify</a>
  <a href="browse.php">Browse & Download</a>
  <a href="faq.php">FAQ</a>
  <a href="cite.php">Cite</a>  
</div>
</div>

<div id="content">
<!--  --> 
	<div class="bolder formField">
            <?php
    $db = $_GET['db'];
	$query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM ".$db."
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
        <th>CynCoNet</th>
        </tr>
      </thead>
<?php
    while($results = mysql_fetch_assoc($raw_results)){
?>
    <tr style = "background-color: <?php if ($results['Paralogs']=="") {    echo '#81F79F';} ?>; text-align: left; border-bottom: 1px solid #ddd">
	  <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Genename']; ?> </td>
      <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Crossreferences']; ?></td>
      <td style = "border-bottom: 1px solid #ddd;"><?php echo $results['Paralogs']; ?></td>
      <td style = "border-bottom: 1px solid #ddd;"><?php if ($results['Paralogs']=="") {    echo "Yes";}else{ echo "No";}  ?></td>
      <td style = "border-bottom: 1px solid #ddd;"><?php echo '<a href="netResults.php?learner=SVM&query='.$query.'">Draw</a>'; ?>  </td>
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

<?php
include ("footer.html");
?>
