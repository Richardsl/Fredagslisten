<?php 
/*
	echo '<pre>';
	print_r($info);
	echo '</pre>';			
	exit(); 
*/
?>
	<div class="centertext"><h2>Info om <?php echo $_SESSION['name']; ?></h2></div>
	<?php if($error != ''){echo $error;} ?>
	
	
<form class="form" name="form" action="." method="post" enctype="multipart/form-data">	
	
	<div class="stylizedinfo" style="height: 500px; width: 670px;">	
	
		<h2>Info</h2>	
		<p>Informasjon om båten</p>		
			<table style="float: left; padding: 0px 20px 20px 20px;">
				<tbody>
					<tr>
						<td>
							<label for="boatname">
								<span class="small">Navn:</span>
							</label>
						</td>	
						<td>
							<input type="text" name="boatname" id="boatname" value="<?php htmlout($info[0]['name']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="year">
								<span class="small">Årstall:</span>
							</label>
						</td>	
						<td>
							<input type="text" name="year" id="year" value="<?php htmlout($info[0]['year']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fromwhere">
								<span class="small">Fra:</span>
							</label>
						</td>	
						<td>
							<input type="text" name="fromwhere" id="name" value="<?php htmlout($info[0]['fromwhere']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="identifier">
								<span class="small">Identifier:</span>
							</label>
						</td>	
						<td>
							<input type="text" name="identifier" id="name" value="<?php htmlout($info[0]['identifier']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="imo">
								<span class="small">Imo:</span>
							</label>
						</td>	
						<td>
							<input type="mmsi" name="imo" id="name" value="<?php htmlout($info[0]['imo']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="loa">
								<span class="small">loa:</span>
							</label>
						</td>	
						<td>
							<input type="text" name="loa" id="name" value="<?php htmlout($info[0]['loa']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="loa">
								<span class="small">mmsi:</span>
							</label>
						</td>	
						<td>
							<input type="text" name="mmsi" id="name" value="<?php htmlout($info[0]['mmsi']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="bt">
								<span class="small">Bruttotonn:</span>
							</label>
						</td>	
						<td>
							<input type="text" name="bt" id="name" value="<?php htmlout($info[0]['bt']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="kw">
								<span class="small">Kilowatt</span>
							</label>
						</td>	
						<td>
							<input type="text" name="kw" id="name" value="<?php htmlout($info[0]['kw']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="fax">
								<span class="small">fax</span>
							</label>
						</td>	
						<td>
							<input type="text" name="fax" id="name" value="<?php htmlout($info[0]['fax']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="tlf1">
								<span class="small">Tlf1</span>
							</label>
						</td>	
						<td>
							<input type="text" name="tlf1" id="name" value="<?php htmlout($info[0]['tlf1']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="tlf2">
								<span class="small">Tlf2</span>
							</label>
						</td>	
						<td>
							<input type="text" name="tlf2" id="name" value="<?php htmlout($info[0]['tlf2']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="tlf3">
								<span class="small">Tlf3</span>
							</label>
						</td>	
						<td>
							<input type="text" name="tlf3" id="name" value="<?php htmlout($info[0]['tlf3']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="tlf4">
								<span class="small">Tlf4</span>
							</label>
						</td>	
						<td>
							<input type="text" name="tlf4" id="name" value="<?php htmlout($info[0]['tlf4']); ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email1">
								<span class="small">Email</span>
							</label>
						</td>	
						<td>
							<input type="text" name="email1" id="name" value="<?php htmlout($info[0]['email1']); ?>"/>
						</td>
					</tr>
					
				</tbody>
			</table>
			
		<div class="stylized" style="height: 390px; width:300px; float:left; margin-top: 0px;">	
				
					<h2>Bilde:</h2>	
					<p>Last opp bilde av båten</p>		
					<div class="centertext" style="float: left;">
					<?php
					if(isset($info[0]['image2']) AND $info[0]['image2'] != '')
					{
					 ?>
					<img src="images/small/<?php htmlout($info[0]['image2']); ?>" alt="boat image" />
					<button id="removepic" type="submit" class="smallbutton" name="action" value="removepic">Fjern bilde</button>	
					
					<?php
					}
					else{ 
					?>
						<div class="centercell" style="float: left;">
						
							<label for="file">Filnavn:</label><br>
							<input type="file" name="file" id="file" style = "width: 270px;">
							<p style="border-bottom: none;">Maks 4MB</p>
						</div>
					<?php	
					} 
					?>
					
					</div>
					
				
		</div>	
		<div class="spacer"></div>	
	</div>
	
	<div class="stylized" style="height: 15px; width:670px; float:left; margin: 0 20px 10px;">	
		<h3 style="float: left; display: block;margin-top: 3px;">Skiftdato:</h3>
		<input type="text" name="changedate" id="shiftdate" class="changedate" value="<?php if(isset($info[0]['changedate'])){htmlout($info[0]['changedate']);} ?>"/>		
		<p style="float:left; margin-left:10px;margin-top: 7px;padding-bottom: 0;">Neste skift dato i følgende format: <b>YYYY-MM-DD</b> <i>eg. 2013-04-15</i></p>
	</div>
	<div class="stylized" style="height: 15px; width:670px; float:left; margin: 0 20px 0px;">	
		<h3 style="float: left; display: block;margin-top: 3px;">Rotasjon:</h3>
		<input type="text" name="rotation" id="rotation" class="rotation" value="<?php if(isset($info[0]['rotation'])){htmlout($info[0]['rotation']);} ?>"/>		
		<p style="float:left; margin-left:10px;margin-top: 7px;padding-bottom: 0;">Rotasjon i antall dager <i>eg. <b>28</b> (4 uker)</i></p>
	</div>
	
	<div class="stylized">	
	
		<h2>Sjø:</h2>	
		<p></p>		
		
			<?php foreach($posNameA as $key){ ?>
				
				
				<input type="text" name="positionname<?php echo $idA; ?>[]" id="positionname" class="positionname" value="<?php if(isset($key['positionname'])){htmlout($key['positionname']);} ?>"/>
				<input type="text" name="name<?php echo $idA; ?>[]" id="name" value="<?php if(isset($key['name'])){htmlout($key['name']);} ?>"/>
	
				<input type="hidden" name="id<?php echo $idA; ?>[]" value="<?php htmlout($key['id']); ?>">
			<?php } ?>			
				
					
	
			
			
			<div class="spacer"></div>
		<?php /* 
			<div class="centertext">
				<button id="fiveless1" ype="submit" class="smallbutton" name="action" value="fiveless1">Fjern fem mannskap</button>
				<button id="fiveextra1" type="submit" class="smallbutton" name="action" value="fiveextra1">Legg til fem mannskap</button>	
			</div>
			 
		<p class="notice">NB! Tomme ruter vil ikke vises på den endelige listen</p>
		*/ ?>
	</div>
	
	<div class="stylized">	
		
		<h2>Hjemme:</h2>	
		<p></p>		
			
			<?php foreach($posNameB as $key){ ?>
				
				<input type="text" name="positionname<?php echo $idB; ?>[]" id="positionname" class="positionname" value="<?php if(isset($key['positionname'])){htmlout($key['positionname']);} ?>"/>
				<input type="text" name="name<?php echo $idB; ?>[]" id="name" value="<?php if(isset($key['name'])){htmlout($key['name']);} ?>"/>
				
				<input type="hidden" name="id<?php echo $idB; ?>[]" value="<?php htmlout($key['id']); ?>">
			<?php } ?>		
				
			
			
			
			
			
			<div class="spacer"></div>
		<?php /* 
			<div class="centertext">
				<button id="fiveless2" type="submit" class="smallbutton" name="action" value="fiveless2">Fjern fem mannskap</button>
				<button id="fiveextra2" type="submit" class="smallbutton" name="action" value="fiveextra2">Legg til fem mannskap</button>
			</div>
			
		<p class="notice">NB! Tomme ruter vil ikke vises på den endelige listen</p>
		*/ ?>
	</div>
	
	<div class="centertext"><button class="button" type="submit" name="action" value="update">Oppdater</button></div>
	<div class="centertext"><button class="button" type="submit" name="action" value="prepdf">Forhåndsvis</button></div>
</form>


	<div class="centertext"><a href=".">Tilbake til start</a></div>
		



