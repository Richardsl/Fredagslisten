<?php
/*
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
	exit();
*/
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">  
<style>
@page { margin: 20px; }

body {
    width: 750px;
    margin: 20px;
    font-family: 'trebuchet MS', 'Lucida sans', Arial;
    font-size: 10px;
    color: #444;
	page-break-inside: avoid;

}
table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;   
text-align:center;	
}
th{  
text-align:left;	
}
.bordered {
    border: solid #ccc 1px;  
	width: 250px;
	font-size: 10px;
	
	
}
.bordered tbody, .bordered thead .bordered th{ 
	width: 150px;
}
.bordered th {
    background-color: #dce9f9;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);     
    border-top: none;   
}
.boatwrapper {
	border: solid #ccc 1px;
	width: 751px;
	padding: 1px;
	page-break-inside: avoid;
	height: 457px;
	margin: 15px 0px;
	position: relative;
	overflow: hidden;
}
#info {
	width: 249px;	
	position: absolute;
	left: 1px;
	top: 220px;
}
#header{
	width: 249px;	
	position: absolute;
	left: 300px;
	height 40px;
	top: 1px;
}
#crew1 { 
	width: 250px;	
	position: absolute;
	left: 251px;
	top: 41px;
	height: 415px;
}
#crew2 {
	width: 250px;
	position: absolute;
	left: 502px;
	top: 41px;
	height: 415px;
}
#crew1 th, #crew2 th { 
	padding: 0px 2px 0px 2px;
	height: 15px;
}

#image{
	width: 249px;
	height: 215px;	
	position: absolute;
	left: 1px;
	top: 1px;
}
#image img{
	position: absolute;
    top: 0; bottom:0; left: 0; right:0;
    display: block;
    margin: auto auto;
}

</style>
</head>

<body>
	
	 <h1 style="margin: 300px 0px 350px;" align="center">Fredagslisten - 
	 <?php echo $arr['companyname'];?> </h1>

	<?php foreach($arr as $key => $boat) 
	{ 
		if(is_numeric($key))
		{
		?>
			
			<div class="boatwrapper">
			
				<div id="image">
					
						<?php
						if(isset($boat['info']['image2']) AND $boat['info']['image2'] != '')
						{
						 ?>
						 
							<img src="images/small/<?php htmlout($boat['info']['image2']); ?>" alt="boat image"/>
						
						<?php
						}
						?>
						
				</div>
				<div id="header">
					<h2><?php htmlout($boat['info']['name']); ?></h2>
				</div>
				<!--<h2>Info</h2>-->
				<table class="bordered" id="info">
					<thead>

						<tr>
							<th>Info</th>        
							<th></th>	
						</tr>
					</thead>				
					<tbody>
						<tr>
							<td><b>Navn</b></td>        
							<td><?php htmlout($boat['info']['name']); ?></td> 
						</tr>  
						<tr>
							<td><b>Årstall:</b></td>        
							<td><?php htmlout($boat['info']['year']); ?></td> 
						</tr> 
						<tr>
							<td><b>Fra:</b></td>        
							<td><?php htmlout($boat['info']['fromwhere']); ?></td> 
						</tr> 
						<tr>
							<td><b>Identifier:</b></td>        
							<td><?php htmlout($boat['info']['identifier']); ?></td> 
						</tr> 
						<tr>
							<td><b>Imo:</b></td>        
							<td><?php htmlout($boat['info']['imo']); ?></td> 
						</tr> 
						<tr>
							<td><b>loa:</b></td>        
							<td><?php htmlout($boat['info']['mmsi']); ?></td> 
						</tr> 
						<tr>
							<td><b>mmsi:</b></td>        
							<td><?php htmlout($boat['info']['loa']); ?></td> 
						</tr> 
						<tr>
							<td><b>Bruttotonn:</b></td>        
							<td><?php htmlout($boat['info']['bt']); ?></td> 
						</tr> 
						<tr>
							<td><b>Kilowatt</b></td>        
							<td><?php htmlout($boat['info']['kw']); ?></td> 
						</tr> 
						<tr>
							<td><b>fax</b></td>        
							<td><?php htmlout($boat['info']['fax']); ?></td> 
						</tr> 
						<tr>
							<td><b>Tlf1</b></td>        
							<td><?php htmlout($boat['info']['tlf1']); ?></td> 
						</tr> 
						<tr>
							<td><b>Tlf2</b></td>        
							<td><?php htmlout($boat['info']['tlf2']); ?></td> 
						</tr> 
						<tr>
							<td><b>Tlf3</b></td>        
							<td><?php htmlout($boat['info']['tlf3']); ?></td> 
						</tr> 
						<tr>
							<td><b>Tlf4</b></td>        
							<td><?php htmlout($boat['info']['tlf4']); ?></td> 
						</tr> 
						<tr>
							<td><b>Email</b></td>        
							<td><?php htmlout($boat['info']['email1']); ?></td> 
						</tr> 
						
					</tbody>	
				</table>
				
				<table class="bordered" id="crew1">
					<thead>
						<tr>
							<th><u><b>Ombord</b></u></th>  
							<th></th> 					
						</tr>
					</thead>
					
					<tbody>
						<?php foreach($boat['crew']['1']as $key){ ?>
						<tr>
							<td><b><?php if($key['positionname']){htmlout($key['positionname']);} ?></b></td>
							
						<?php if(isset($key['name']) AND $key['name'] != ''){?>
						
							<td><?php htmlout($key['name']); ?></td>
						</tr>
						<?php }else { ?> 
						<td>&nbsp;</td>
						</tr>
						<?php }/*if*/ }/*foreach*/ ?>
					</tbody>
				</table>
				
				<table class="bordered" id="crew2">
					<thead>
						<tr>
							<th><u><b>Hjemme</b></u></th>  
							<th></th> 					
						</tr>
					</thead>
				
					<tbody>
						<?php foreach($boat['crew']['2']as $key){ ?>
						<tr>
							<td><b><?php if($key['positionname']){htmlout($key['positionname']);} ?></b></td>
							
						<?php if(isset($key['name']) AND $key['name'] != ''){?>
						
							<td><?php htmlout($key['name']); ?></td>
						</tr>
						<?php }else { ?> 
						<td>&nbsp;</td>
						</tr>
						<?php }/*if*/ }/*foreach*/ ?>
					</tbody>
				</table>

			</div>
		
<?php 	}
	} ?>
	

		</tbody></table>

	</div>


</body>
</html>
 

<?php
$date = date("d.m.y");

$filename = 'fredagslisten_' . $arr['companyname'] . '_' . $date;
$htmlfilename = $filename . '.html';
$pdffilename = $filename . '.pdf';
file_put_contents(ROOTS . 'htmltmp/' . $htmlfilename, ob_get_contents());
ob_end_flush();




$dompdf = new DOMPDF();
$dompdf->load_html(file_get_contents(ROOTS . 'htmltmp/' . $htmlfilename));
$dompdf->render();
//$dompdf->stream("sample.pdf");
$output = $dompdf->output();
file_put_contents(ROOTS . 'fredagslister/' . $pdffilename, $output);

/*
$files = scandir('htmltmp/');
foreach($files as $file) {
  
}
*/
?>
