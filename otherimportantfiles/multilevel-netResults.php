<?php
include ("sqlcnct.php");
include ("head.html");
?>
<title>SinCoGenesDB</title>
<!-- cytoscapejs CSS and JS -->
    <script src='js/cytoscape.min.js'></script>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.html");
?>

<style>
    #cy {
        width: 100%;
        height: 100%;
        position: relative;
        top: 0px;
        left: 0px;
    }
</style>

<div id="nav">
<div class="topnav">
  <a href="index.php">Home</a>
  <a href="blast_form.php">Blast</a>
  <a class="active" href="cynconet.php">CynCoNet</a>
  <a href="analyze.php">Analyze</a>
  <a href="browse.php">Browse & Download</a>
  <a href="contribution.php">Contribute</a>
  <a href="faq.php">FAQ</a>
  <a href="cite.php">Cite</a>  
</div>
</div>

<div id="content">
<!--  --> 
	<div class="bolder formField">
            <?php
    $query = $_GET['query'];
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
        $resultNumber = 0; 
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM nettable
            WHERE (`Source` LIKE '%".$query."%') ") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
		$flnodes = array();
		$nnodes = array();
		$fledges = array();
		while($results = mysql_fetch_assoc($raw_results)){
			array_push($flnodes, "{ data: {id: '".$results['Target']."' } },");
			array_push($fledges, "{data: {id: '".$results['Source']." to ".$results['Target']."',source: '".$results['Source']."',target: '".$results['Target']."'}},");
			array_push($nnodes, $results['Target']);
			$resultNumber++;
			}
$slnodes = array();
$sledges = array();
foreach ($nnodes as $myitem){
	$query = $myitem;
$query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysql_query("SELECT * FROM nettable
            WHERE (`Source` LIKE '%".$query."%') ") or die(mysql_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
		while($results = mysql_fetch_assoc($raw_results)){
array_push($slnodes, "{ data: {id: '".$results['Target']."' } },");
array_push($sledges, "{data: {id: '".$results['Source']." to ".$results['Target']."',source: '".$results['Source']."',target: '".$results['Target']."'}},");
}
	
}}
		?>
		    <div id="cy"></div>
	    <script>
      var cy = cytoscape({
        container: document.getElementById('cy'),
elements: [
  // nodes
<?php foreach ($flnodes as $nodeitem){echo $nodeitem;}?> 
<?php foreach ($slnodes as $nodeitem){echo $nodeitem;}?> 
// edges
<?php foreach ($fledges as $nodeitem){echo $nodeitem;}?> 
<?php foreach ($sledges as $nodeitem){echo $nodeitem;}?> 
],
style: [
        {
            selector: 'node ',
            style: {
                'shape': 'hexagon',
                'background-color': 'red',
				'label': 'data(id)'
            }
        },
		{
            selector: 'edge',
            style: {
			label: ''
            }
        }]
      });
cy.layout({
    name: 'circle', fit : true, animate: true, circle : true
}).run();

	  </script>
<?php foreach ($flnodes as $nodeitem){echo $nodeitem;}?> 
<br>salam<br>
<?php foreach ($slnodes as $nodeitem){echo $nodeitem;}?> 
<br>salam<br>
<?php foreach ($fledges as $nodeitem){echo $nodeitem;}?> 
<br>salam<br>
<?php foreach ($sledges as $nodeitem){echo $nodeitem;}?> 

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
