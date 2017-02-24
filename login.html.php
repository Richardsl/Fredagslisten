<div id="loginblock">
	<div class="centertext">
		<div class="centercell">
			<h2 class="middle">Login:</h2>
		</div>
	</div>
	
	<div class="centertext">
		<div class="centercell">
			<form class="send" action="." method="post">
				<input type="hidden" name="id" value="<?php htmlout($id); ?>">
				<?php if (isset($loginError) AND $loginError != ''): ?>
				<p class="red"><?php htmlout($loginError); ?></p>
				<?php endif; ?>
				<p>
					<label for="name">Epost: </label>
					<input type="text" name="email" id="email">
				</p>
				<p>
					<label for="name">Passord: </label>
					<input type="password" name="password" id="password">
				</p>
				<p>
				<input type="hidden" name="action" value="login">
				<input type="hidden" name="redirect" value="<?php echo htmlout($redirect); ?>">
				<input type="submit" value="Logg inn">
				</p>
			</form>
		</div>
	</div>
</div>


<div class="centertext">
	<div class="centercell">
		<div id="linetwo">---------------------------------------------------------------------------------------------------</div>
	</div>
</div>


<div id="registerblock">
	<div class="centertext">
		<div class="centercell">
			<h2 class="middle">Registrer båt:</h2>
		</div>
	</div>
	
	<div class="centertext">
		<div class="centercell">
			<form class="send" action="." method="post">
			
				<input type="hidden" name="id" value="<?php htmlout($id); ?>">
				<?php if($error != ''){ ?> 
				<p class="red"><?php echo $error; ?></p>
				<?php } ?>
				
				<div class="registerright">
					<p>
						<label for="name">*Båtnavn: </label>
						<input type="text" name="name">
					</p>
					<p>
						<label for="email">*Epost: </label>
						<input type="text" name="email">
					</p>
					<p>
						<label for="identifier">*Identifier: </label>
						<input type="text" name="identifier">
					</p>
					<p>
						<label for="password">*Passord: </label>
						<input type="password" name="password">
					</p>
					<p>
						<label for="passwordAgain">*Passord igjen: </label>
						<input type="password" name="passwordAgain">
					</p>
				
							
				
				
					<p><input type="hidden" name="action" value="register">
					<input type="submit" name="register" value="Registrer" class="registerbutton"></p>
				</div>
			</form>
		</div>
	</div>	
</div>
			<!--<p>
				<label for="fromwhere">Land Registrert: </label>
				<input type="text" name="fromwhere" value="Norge">
			</p>
			<p>
				<label for="imo">IMO nummer: </label>
				<input type="text" name="imo">
			</p>
			<p>
				<label for="mmsi">MMSI nummer: </label>
				<input type="text" name="mmsi">
			</p>
			<p>
				<label for="loa">Lenght over all: </label>
				<input type="text" name="loa">
			</p>
			<p>
				<label for="bt">Lenght over all: </label>
				<input type="text" name="bt">
			</p>
		</div>
		
		<div class="registerimage">

		</div>

		<div class="registerright">
			<p>
				<label for="kw">Kilowatt: </label>
				<input type="text" name="kw">
			</p>
			<p>
				<label for="tlf1">Tlf1: </label>
				<input type="text" name="tlf1">
			</p>
			<p>
				<label for="tlf2">Tlf2: </label>
				<input type="text" name="tlf2">
			</p>
			<p>
				<label for="tlf3">Tlf3: </label>
				<input type="text" name="tlf3">
			</p>
			<p>
				<label for="tlf4">Tlf4: </label>
				<input type="text" name="tlf4">
			</p>
		</div>
		
		
		<input type="hidden" name="action" value="register">
		<input type="submit" name="register" value="Registrer">
	</form>
	
</div>
-->
