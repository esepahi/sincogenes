<?php
include ("head.html");
?>
<title>SinCoGenesDB</title>
<!-- Search form CSS -->	
<link rel="stylesheet" type="text/css" href="css/blastform.css" />

<!-- Head tag ends in header.php so insert head content related to this page here -->	
<?php
include ("header.html");
?>


<div id="nav">
<div class="topnav">
  <a href="index.php">Home</a>
  <a href="blast_form.php">Blast</a>
  <a href="cynconet.php">CynCoNet</a>
  <a class="active" href="analyze.php">Analyze</a>
  <a href="classify.php">Classify</a>
  <a href="browse.php">Browse & Download</a>
  <a href="faq.php">FAQ</a>
  <a href="cite.php">Cite</a>  
</div>
</div>

<div id="content">
	<div class="intro">
	<p>Notice: SinCoGenesDB yet is not a huge database. use analyze results carefully.</p> 
	<p> To analyze, enter your sequence(s) in fasta format in the folowing tex erea or browse your fasta file. this tool propose in-genome homology of sequence(s) based on (up to) 10 best blast hits in a KNN manner. </p> 
	</div>
<br>	<div class="blastnav-e1">
	<div class="blastform">
	<form action="blast/Analyzeresult.php" method="post" name="blastform" enctype= "multipart/form-data">
	<p>
	Database:
	<select class="effect" id="datalib" name="datalib">
		<option selected value="-db db/Arabidopsis-thaliana-SinCoGenes"> <i>Arabidopsis thaliana</i> SinCoGenes</option>
		<option value="-db db/cos_sunflower">Sunflower SinCoGenes</option>
		<option value='-db nr -remote'>(Remote) NCBI Nucleotides</option>
		<option value='-db swissprot -remote'>(Remote) SwissProt</option>
		<option value="-db pdb -remote">(Remote) PDB</option>
	</select>	
	<br><br>
	Blast program:
	<select class="effect" id="program" name="program">
		<option value="blastn.exe">blastn</option>
		<option selected value="blastp.exe">blastp</option>
		<option value="blastx.exe">blastx</option>
		<option value="tblastn.exe">tblastn</option>
		<option value="tblastx.exe">tblastx</option>
	</select>

	</p>
	<p>
	Enter sequence below in 
	<abbr title="This is a sample sequence in fasta format:
&gt;gi|532319|pir|TVFV2E|TVFV2E envelope protein&#13;ELRLRYCAPAGFALLKCNDADYDGFKTNCSNVSVVHCTNLMNTTVTTGLLLNGSYSENRT&#13;QIWQKHRTSNDSALILLNKHYNLTVTCKRPGNKTVLPVTIMAGLVFHSQKYNLRLRQAWC&#13;HFPSNWKGAWKEVKEEIVNLPKERYRGTNDPKRIFFQRQWGDPETANLWFNCHGEFFYCK&#13;MDWFLNYLNNLTVDADHNECKNTSGTKSGNKRAPGP">FASTA</abbr>  format (<a style="font-size:small" onclick="javascript:document.getElementById('program').value='blastp.exe';
	document.getElementById('datalib').value='-db db/Arabidopsis-thaliana-SinCoGenes';
	document.getElementById('sequence').value='>At1g03650 GCN5-related N-acetyltransferase\nMDKGVVVELIRGSTSWAKVVEDIVKLEKKTFPKHESLAQTFDAELRKKNAGLLYVDAEGDTVGYAMYSWPSSLSASITKLAVKENCRRQGHGEALLRAAIDKCRSRKVQRVSLHVDPTRTSAVNLYKKLGFQVDCLVKSYYSADRDAYRMYLDFDDSI';" href="javascript:void()">Demo Sequence</a>)
	<br />
	<textarea class="effect" style="width: 100%;" name="sequence" id="sequence" rows=6 cols=60></textarea>
	<br />
	Or load fasta file from disk 
	<input class="effect" type="file" name="seqfile">
	</p>
	<p >
	<input class="effect" type="button" name="clear" value="Clear Sequence" onClick="document.getElementById('sequence').value=''; document.getElementById('sequence').focus();">
	<input class="effect" type="submit" name="submit" value="Search">
	</p>
	</form>
	</div>
	</div>
	<div class="blastnav-e2">
		<div class="blastparag">
			<ul>
				  <li><b>database</b>, is the set of sequences that your sequence will be blasted against it.</li>
				  <li><b>Blast program</b>, is the blast algorithm which will be used. for example if you your query sequence is a protein and want to blast against a protein sequences database you must choose BlastP in the list of blast programs.</li>
				  <li>Whether you blast one or many sequences, your sequence(s) must be in fasta format. click on FASTA to see an example fasta format sequence or click on "Demo Sequence" to fill text erea with a sample sequence with fasta format.</li>
				  <li>paste your sequence(s) into text era or browse and upload a file from your computer. but both filling the text era and browsing a file at the same time will crash blast and echo error.</li>
				  <li>For better performance, just blast <b> up to 100 sequences</b> in each blast run.</li>

				  </ul>
		</div>	
	</div>
	<br>
	<div class="blastnav-e3">
	</div>

<?php
include ("footer.html");
?>
