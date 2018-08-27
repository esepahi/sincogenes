<?php
include ("head.html");
?>
<title>SinCoGenesDB</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/searchBox.css" />
<script>
</script>

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.html");
?>


<div id="nav">
<div class="topnav">
  <a href="index.php">Home</a>
  <a href="blast_form.php">Blast</a>
  <a class="active" href="cynconet.php">CynCoNet</a>
  <a href="analyze.php">Analyze</a>
  <a href="classify.php">Classify</a>
  <a href="browse.php">Browse & Download</a>
  <a href="faq.php">FAQ</a>
  <a href="cite.php">Cite</a>  
</div>
</div>

<div id="content">
	<p class="intro"> Some thing brief about CynCoNet, what is it and how it works...</p><br> 
	<div class="bolder formField" align= "center" >
		<form  action="netResults.php" method="GET" class="">
			Learner:
			<select name="learner" class="dbSelect border-radius">
				<option value="SVM" selected>Suppor vector machine (SVM)</option>
				<option value="KNN">K nearest neighbours (KNN)</option>
			</select>
			<input type="search" name="query" placeholder="search term.." class="cyncosearchInput border-radius">
			<input type="submit" value="Search" class="button border-radius">	
		</form>
		Examples: <a href="netResults.php?learner=SVM&query=AT2G01060"> AT2G01060 </a>, <a href="netResults.php?learner=SVM&query=AT2G010">AT2G010</a>
		<br><br>
		<ul>
		  <li>Don't search multiple terms together. </li>
		  <li>For searching in known genomes datasets select "Gene & protein names in known genomes"</li>
		  <li>For searching in RNA-Seq based datasets select "Putative gene & protein names in RNA-Seq based data". 
		  these data are named based on (up to three) best hit(s) on remote blast of contig sequences against NCBI database.
		  </li>
		</ul>
	</div>

<?php
include ("footer.html");
?>
