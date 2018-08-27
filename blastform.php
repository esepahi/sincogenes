<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SincoBLAST form</title>

<style type="text/css">
html {
	box-sizing: border-box;
	-webkit-text-size-adjust: 100%;
	-webkit-font-smoothing: antialiased;
}
html, body {
	background-color: lightblue;
    height: 100%;
    margin: 0px;
    padding: 0px;
}
.form{
	background-color: white;
	position: absolute;
	top: 50%;
	left: 40%;
	width: 60%;
	height: 60%;
	margin-top: -160px; /* Half the height */
	margin-left: -255px; /* Half the width */
	vertical-align: middle;
	border: 10px solid gray;
	box-shadow: 0px 0px 3px #ccc, 0 10px 15px #eee inset;
	border-radius: 2px;
	font-family:  Georgia, Serif;
}
.error{
	position: absolute;
	top: 50%;
	left: 50%;
	width: 300px;
	height: 50px;
	margin-top: -25px; /* Half the height */
	margin-left: -150px; /* Half the width */
	vertical-align: middle;
	border: 1px solid red;
	box-shadow: 0px 0px 3px #ccc, 0 10px 15px #eee inset;
	border-radius: 2px;
	color: red;
	text-align: center;
	font-weight: bold;
	line-height: 50px;
	font-family: "Times New Roman", Georgia, Serif;
}
.output{
	position: relative;
	top: 20%;
	box-sizing: border-box;
	width: 650px;
	height: auto;
	margin: 0 auto;
	vertical-align: middle;
	border: 3px solid gray;
	font-size: 12px;
	box-shadow: 0px 0px 3px #ccc, 0 10px 15px #eee inset;
	border-radius: 2px;
}
.space {
	padding: 10px;
}
abbr {
	text-decoration: none;
	color: blue;
	cursor: pointer;
}
.effect {
	border: 1px solid #aaa;
	box-shadow: 0px 0px 3px #ccc, 0 10px 15px #eee inset;
	border-radius: 2px;
}
.heffect {
    border: 0;
    height: 1px;
    background: blue;
}
a { text-decoration: none; }
table.hover {font-family: verdana, arial, sans-serif; font-size: 13px; color: #333333;}
</style>
</head>
<body>
<div class="form">
	<form action="blastresult.php" method="post" name="blastform" enctype= "multipart/form-data">
	<h3 style="text-align: center;"><i style="font-size: small;">SinCo</i><span style="color:blue">BLAST</span> - Remote and Local BLAST+ Search</h3>
	<hr class="heffect" />
	<p style="padding: 0 3px 0 3px;">
	Database:
	<select class="effect" id="datalib" name="datalib">
		<option selected value="-db db/Arabidopsis-thaliana-SinCoGenes"> <i>Arabidopsis thaliana</i> SinCoGenes</option>
		<option value="-db db/cos_sunflower">Sunflower SinCoGenes</option>
		<option value='-db nr -remote'>(Remote) NCBI Nucleotides</option>
		<option value='-db swissprot -remote'>(Remote) SwissProt</option>
		<option value="-db pdb -remote">(Remote) PDB</option>
		<option value="-db db/test_aa">test aa</option>
		<option value="-db db/pdt">test pdt</option>
	</select>	
	<br><br>
	Program:
	<select class="effect" id="program" name="program">
		<option value="blastn.exe">blastn</option>
		<option selected value="blastp.exe">blastp</option>
		<option value="blastx.exe">blastx</option>
		<option value="tblastn.exe">tblastn</option>
		<option value="tblastx.exe">tblastx</option>
		<option value="deltablastx.exe">deltablast</option>
		<option value="psiblast.exe">psiblast</option>
		<option value="rpsblast.exe">rpsblast</option>
		<option value="rpstblastn.exe">rpstblastn</option>
	</select>

	</p>
	<p style="padding: 0 3px 0 3px;">
	Enter sequence below in 
	<abbr title="This is a sample sequence in fasta format:
&gt;gi|532319|pir|TVFV2E|TVFV2E envelope protein&#13;ELRLRYCAPAGFALLKCNDADYDGFKTNCSNVSVVHCTNLMNTTVTTGLLLNGSYSENRT&#13;QIWQKHRTSNDSALILLNKHYNLTVTCKRPGNKTVLPVTIMAGLVFHSQKYNLRLRQAWC&#13;HFPSNWKGAWKEVKEEIVNLPKERYRGTNDPKRIFFQRQWGDPETANLWFNCHGEFFYCK&#13;MDWFLNYLNNLTVDADHNECKNTSGTKSGNKRAPGP">FASTA</abbr>  format (<a style="font-size:small" onclick="javascript:document.getElementById('program').value='blastp.exe';
	document.getElementById('datalib').value='-db db/Arabidopsis-thaliana-SinCoGenes';
	document.getElementById('sequence').value='>tr|A0PQ23|A0PQ23_MYCUA Chorismate pyruvate-lyase\nMLAVLPEKREMTECHLSDEEIRKLNRDLRILIATNGTLTRILNVLANDEIVVEIVKQQIQ\nDAAPEMDGCDHSSIGRVLRRDIVLKGRRSGIPFVAAESFIAIDLLPPEIVASLLETHRPI\nGEVMAASCIETFKEEAKVWAGESPAWLELDRRRNLPPKVVGRQYRVIAEGRPVIIITEYF\nLRSVFEDNSREEPIRHQRSVGTSARSGRSICT';" href="javascript:void()">Demo Sequence</a>)
	<br />
	<textarea class="effect" style="min-width: 498px;" name="sequence" id="sequence" rows=6 cols=60></textarea>
	<br />
	Or load it from disk 
	<input class="effect" type="file" name="seqfile">
	</p>
	<p style="padding: 0 3px 0 3px;">
	<input class="effect" type="button" name="clear" value="Clear Sequence" onClick="document.getElementById('sequence').value=''; document.getElementById('sequence').focus();">
	<input class="effect" type="submit" name="submit" value="Search">
	</p>
	</form>
	</div>
</body>
</html>