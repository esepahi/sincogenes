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
    $query = $_GET['query'];
	$tbl = $_GET['db'];
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM $tbl
            WHERE (`Query` LIKE '%".$query."%') OR (`QueryisSC` LIKE '%".$query."%')") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
		$resultNumber = 0;
		?>
		<div class="intro">
			<ul>
				  <li>Click on column headers to sort ascending and descending.</li>
				  <li>Don't use search for sequences. go to blast for working on sequences.</li>
				  <li>You can search whole or part of a term, for example "AT1G09370" return this protein and "AT1G093" return all protein names start with "AT1G093"</li>
				</ul>
		</div><br>
		<table id="myTable" class="stripe">
		  <thead>
			<tr>
			<th>Species</th>
			<th>Gene Name</th>
			<th>Cross refernces</th>
			<th>Is Single Copy?</th>
			<th>CynCoNet</th>
			</tr>
		  </thead>
	<?php
		while($results = mysql_fetch_assoc($raw_results)){
	?>
    <tr>
		<td> <?php echo "Arabidopsis thaliana"; ?> </td>
		<td><?php $link_address = 'http://plants.ensembl.org/Arabidopsis_thaliana/Gene/Summary?db=core;g='.$results['Query'] ;echo "<a href='$link_address'>{$results['Query']}</a>";  ?></td>
		<td><?php $link_address = 'https://www.arabidopsis.org/servlets/TairObject?name='.$results['Query'].'&type=locus';echo "<a href='$link_address'>[1]</a>"; $link_address = 'https://www.ncbi.nlm.nih.gov/nuccore/?term='.$results['Query'] ;echo "<a href='$link_address'>[2]</a>";  $link_address = 'http://plants.ensembl.org/Arabidopsis_thaliana/Gene/Compara_Paralog?db=core;g='.$results['Query'] ;echo "<a href='$link_address'>[3]</a>";  ?></td>
		<td bgcolor=  <?php if ($results['QueryisSC']=="1") {echo "#81F79F";}
?> ><?php echo $results['QueryisSC']; ?></td>
		<td> <?php echo '<a href="netResults.php?query='.$results['Query'].'">Draw'; ?> </td>

	</tr>
<?php             
	}
?>
</table>
<?php
}
else{ // if there is no matching rows do following
  echo "<div class="."intro".">
	<p>	<b>Search found nothing for ".$query.'</b>. Click here to come back <a href="index.php">Home & search</a>. </p>'."
	<ul>
		<li>Maybe we have no data related to your search term.</li>
		<li>Don't search multiple terms together. </li>
		<li>Don't use search for sequences. go to blast for working on sequences.</li>
		<li>You can search whole or part of a term. for example". "AT1G09370"." returns results for just this "."AT1G09370"." protein but "."AT1G093"." returns results for all protein names start with "."AT1G093".".</li>
		
	</ul>
</div>";
}         
    }
    else{ // if query length is less than minimum
        echo "<div class="."intro"."><p><b>Minimum term length is ".$min_length.' </b>. Click here to come back <a href="index.php">Home & search</a>. </p></div>';
    }
?>
			

	</div>

<?php
include ("footer.html");
?>
