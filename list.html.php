
<h1>Fredagslisten</h1></br>
<table id="ombord" class="hor-zebra" summary="Employee Pay Sheet">	
	<thead>
		<tr>
			<th scope="col">Ombord</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$odd = TRUE;
		foreach($posNameA as $key){ ?>
		<tr <?php if($odd){ echo ' class="odd"';} ?>>
			<td><?php htmlout($key['position']); ?></td>
			<td><?php if(isset($key['name'])){htmlout($key['name']);} ?></td>
		</tr>
		<?php $odd = !$odd; }  ?>
	</tbody>
</table>
	
<table id="hjemme" class="hor-zebra" summary="Employee Pay Sheet">	
	<thead>
		<tr>
			<th scope="col">Hjemme</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$odd = TRUE;
		foreach($posNameB as $key){ ?>
		<tr <?php if($odd){ echo ' class="odd"';} ?>>
			<td><?php htmlout($key['position']); ?></td>
			<td><?php if(isset($key['name'])){htmlout($key['name']);} ?></td>
		</tr>
		<?php $odd = !$odd; }  ?>
	</tbody>
</table>

