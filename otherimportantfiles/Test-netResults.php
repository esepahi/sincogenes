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
		<div class="intro">
			<p>	<b><i>Search found  results for in database. </i></b>
			Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.
			</p>
			<ul>
				  <li>Click on column headers to sort ascending and descending.</li>
				  <li>Don't use search for sequences. go to blast for working on sequences.</li>
				  <li>You can search whole or part of a term, for example "AT1G09370" return this protein and "AT1G093" return all protein names start with "AT1G093"</li>
				</ul>
		</div><br>
		    <div id="cy"></div>
	    <script>
      var cy = cytoscape({
        container: document.getElementById('cy'),
elements: [
  // nodes
  { data: { id: 'a' } },
  { data: { id: 'b' } },
  { data: { id: 'c' } },
  { data: { id: 'd' } },
  { data: { id: 'e' , parent : 'a'} },
  { data: { id: 'f' , parent : 'a'} },
  // edges
  {
    data: {
      id: 'ab',
      source: 'a',
      target: 'b'
    }
  },
  {
    data: {
      id: 'ba',
      source: 'b',
      target: 'a'
    }
  },
  {
    data: {
      id: 'ef',
      source: 'e',
      target: 'f'
    }
  },
  {
    data: {
      id: 'ac',
      source: 'a',
      target: 'c'
    }
  },
  {
    data: {
      id: 'be',
      source: 'b',
      target: 'e'
    }
  }

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
			label: 'data(id)'
            }
        }]
      });
cy.layout({
    name: 'circle', fit : true, animate: true, circle : true
}).run();

	  </script>
	</div>

<?php
include ("footer.html");
?>
