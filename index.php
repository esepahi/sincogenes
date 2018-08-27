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
include ("home-header.html");
?>


<div id="nav">
<div class="topnav">
  <a class="active" href="index.php">Home</a>
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
	<p class="intro">
	<b><i>Single-Copy Genes DataBase </i></b> is a database about homology between genes that belong to a species (in-genome homology).
	To See how we obtained these data click here. You can search the database using the folowing search form or go to <a href="#about">browse and download</a> data page. you can also analyze one to many name or sequences 
	by going to <a href="#about">Blast</a>, <a href="#about">CynCoNet</a> and <a href="#about">Analyze</a> pages. 
	There is a <a href="#about">tutorial</a> on how to better work with this database. In <a href="#about">FAQ</a> we previousely answered some frequently asked questions but if you have any
	other question(s) about in-genome orthology or working with SinCoGenesDB do not hesitate to <a href="mailto:esepahi@ut.ac.ir">email</a> or <a href="#about">contact</a> us. 
	In <a href="#about">contribute</a> we said how can you help us to grow this database faster. Currently SinCoGenes has in-genome homology data for <a href="#about">30 species</a> from protein and RNA-Seq sources, and it is still growing... 
	</p><br> 
	<div class="bolder formField" align= "center" >
		<form  action="search.php" method="GET" class="">
			Database:
			<select name="db" class="dbSelect border-radius">
				<option value="mytable1" selected>Gene & protein names</option>
				<option value="1">Species names</option>
				<option value="2">GO terms</option>
				<option value="3">Networks</option>
				<option value="4">Raw blast results (Gene name)</option>
			</select>
			<input type="search" name="query" placeholder="search term.." class="searchInput border-radius">
			<input type="submit" value="Search" class="button border-radius">	
		</form>
		Examples: <a href="search.php?db=?????&query=Arabidopsis thaliana">  <i>Arabidopsis thaliana</i>  </a>, <a href="search.php?db=mytable1&query=AT1G09370"> AT1G09370 </a>, <a href="search.php?db=?????&query=ATP transport"> ATP transport	</a>
		<br><br>
		<ul>
		  <li>Don't search multiple terms together. </li>
		  <li>Don't use search for sequences. go to blast for working on sequences.</li>
		  <li>You can search whole or part of a term. for example "AT1G09370" returns results for just this "AT1G09370" protein but "AT1G093" returns results for all protein names start with "AT1G093"</li>
		</ul>
	</div>

<?php
include ("footer.html");
?>
