<?php
include_once("../core/Exceptions.php");
include_once("../core/Trainer.php");
include_once("../core/ClassExtensions.php");
include_once("../core/Urlaubszeitraum.php");

session_start();

if(isset($_POST['ssDestroy']))
{
	session_destroy();
	unset($_POST['ssDestroy']);
}

if(isset($_POST['trainerAdd']))
{
	if((isset($_POST['vorname']) && !empty($_POST['vorname'])) && (isset($_POST['nachname']) && !empty($_POST['nachname'])) && (isset($_POST['email']) && !empty($_POST['email'])))
	{
		$trainer = new Trainer($_POST['vorname'], $_POST['nachname'], $_POST['email']);
		$_SESSION['trainerObject'] = $trainer;
	}
}

if(isset($_POST['addSP']))
{
	if((isset($_POST['schwerpunkt']) && !empty($_POST['schwerpunkt'])) && (isset($_POST['primaer']) && !empty($_POST['primaer'])))
	{
		$trainer = $_SESSION['trainerObject'];
		if($_POST['primaer'] == "true")
		{
			$schwerpunkt = new TrainerSchwerpunkt($_POST['schwerpunkt'], true);
		}
		else
		{
			$schwerpunkt = new TrainerSchwerpunkt($_POST['schwerpunkt']);
		}
		try
			{
				$trainer->Add($schwerpunkt);
			}
			catch(Exception $e)
			{
				echo $e;
			}
			$_SESSION['trainerObject'] = $trainer;		
	}
	unset($_POST['addSP']);
	unset($_POST['schwerpunkt']);
	unset($_POST['primaer']);
}

if(isset($_POST['addLF']))
{
	if((isset($_POST['lernfeld']) && !empty($_POST['lernfeld'])) && (isset($_POST['primaer']) && !empty($_POST['primaer'])))
	{
		$trainer = $_SESSION['trainerObject'];
		if($_POST['primaer'] == "true")
		{
			$lernfeld = new TrainerLernfeld($_POST['lernfeld'], true);
		}
		else
		{
			$lernfeld = new TrainerLernfeld($_POST['lernfeld']);
		}
		try
			{
				$trainer->Add($lernfeld);
			}
			catch(Exception $e)
			{
				echo $e;
			}
			$_SESSION['trainerObject'] = $trainer;		
	}
	unset($_POST['addLF']);
	unset($_POST['lernfeld']);
	unset($_POST['primaer']);
}

if(isset($_POST['addUZ']))
{
	if((isset($_POST['anfang']) && !empty($_POST['anfang'])) && (isset($_POST['ende']) && !empty($_POST['ende'])))
	{
		$trainer = $_SESSION['trainerObject'];
		$ulaubszr = new Urlaubszeitraum($_POST['anfang'], $_POST['ende']);
		try
			{
				$trainer->Add($ulaubszr);
			}
			catch(Exception $e)
			{
				echo $e;
			}
			$_SESSION['trainerObject'] = $trainer;		
	}
	unset($_POST['addUZ']);
	unset($_POST['anfang']);
	unset($_POST['ende']);
}

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>Trainer Anlegen - Kursplaner</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="expires" content="0">
	</head>
	<body>
		<?php
			if(isset($_SESSION['trainerObject']))
			{
				$trainer =($_SESSION['trainerObject']);
				?>
				<label for="vn">Objekt-Vorname: </label>
				<input type="text" id="vn" name="vorname" value="<?= $trainer->vorname ?>">
				<label for="nn">Objekt-Nachname: </label>
				<input type="text" id="nn" name="nachname" value="<?= $trainer->nachname ?>">
				<label for="en">Objekt-Email: </label>
				<input type="email" id="en" name="email" value="<?= $trainer->email ?>">
				<?php
					if(count($trainer->schwerpunkte) > 0)
					{
						foreach($trainer->schwerpunkte as $schwerpunkt)
						{
												
							$index = array_search($schwerpunkt, $trainer->schwerpunkte);
							?>
							<form method="post">
								<label for="sp<?= $index ?>">Schwerpunkt </label>
								<input type="text" id="sp<?= $index ?>" name="schwerpunkt<?= $index ?>" value="<?= $schwerpunkt->bezeichnung?>">
								<?php
								if($schwerpunkt->primaer == 1){
								?>
								<input type="radio" id="prim<?= $index ?>" name="primaer<?= $index ?>" value="true" checked>	
								<label for="prim<?= $index ?>">Primär</label>
								<input type="radio" id="sek<?= $index ?>" name="primaer<?= $index ?>" value="false">
								<label for="sek<?= $index ?>">Sekundär</label>									
								<?php
								}
								else {
								?>
								<input type="radio" id="prim<?= $index ?>" name="primaer<?= $index ?>" value="true">	
								<label for="prim<?= $index ?>">Primär</label>
								<input type="radio" id="sek<?= $index ?>" name="primaer<?= $index ?>" value="false" checked>
								<label for="sek<?= $index ?>">Sekundär</label>
								<?php										
								}
								?>								
								<input type="hidden" name="editSP" value="<?= $index ?>">
								<input type="submit" name="modSP" value="Aktualisieren">
							</form>
							<?php
						}
					}					 
				?>
					<form method="post">
						<label for="sp">Schwerpunkt </label>
						<input type="text" id="sp" name="schwerpunkt" value=""/>
						<input type="radio" id="prim" name="primaer" value="true">
						<label for="prim">Primär</label>
						<input type="radio" id="sek" name="primaer" value="false">
						<label for="sek">Sekundär</label>
						<input type="submit" name="addSP" value="Schwerpunkt hinzufügen">
					</form>
				<?php
					if(count($trainer->lernfelder) > 0)
					{
						foreach($trainer->lernfelder as $lernfeld)
						{
												
							$index = array_search($lernfeld, $trainer->lernfelder);
							?>
							<form method="post">
								<label for="lf<?= $index ?>">Lernfeld </label>
								<input type="text" id="lf<?= $index ?>" name="lernfeld<?= $index ?>" value="<?= $lernfeld->bezeichnung?>">
								<?php
								if($lernfeld->primaer == 1){
								?>
								<input type="radio" id="prim<?= $index ?>" name="primaer<?= $index ?>" value="true" checked>	
								<label for="prim<?= $index ?>">Primär</label>
								<input type="radio" id="sek<?= $index ?>" name="primaer<?= $index ?>" value="false">
								<label for="sek<?= $index ?>">Sekundär</label>									
								<?php
								}
								else {
								?>
								<input type="radio" id="prim<?= $index ?>" name="primaer<?= $index ?>" value="true">	
								<label for="prim<?= $index ?>">Primär</label>
								<input type="radio" id="sek<?= $index ?>" name="primaer<?= $index ?>" value="false" checked>
								<label for="sek<?= $index ?>">Sekundär</label>
								<?php										
								}
								?>								
								<input type="hidden" name="editLF" value="<?= $index ?>">
								<input type="submit" name="modLF" value="Aktualisieren">
							</form>
							<?php
						}
					}					 
				?>
				<form method="post">
					<label for="lf">Lernfeld </label>
					<input type="text" id="lf" name="lernfeld" value=""/>
					<input type="radio" id="prim" name="primaer" value="true">
					<label for="prim">Primär</label>
					<input type="radio" id="sek" name="primaer" value="false">
					<label for="sek">Sekundär</label>
					<input type="submit" name="addLF" value="Lernfeld hinzufügen">
				</form>
				<?php
					if(count($trainer->urlaubszeitraeume) > 0)
					{
						foreach($trainer->urlaubszeitraeume as $urlaubszeitraum)
						{					
							$index = array_search($urlaubszeitraum, $trainer->urlaubszeitraeume);
							?>
							<form method="post">
								<label>Urlaubszeitraum </label>
								<label for="anf<?= $index ?>">Von </label>
								<input type="date" id="anf<?= $index ?>" name="anfang<?= $index ?>" value="<?= $urlaubszeitraum->anfang?>"/>
								<label for="end<?= $index ?>">Bis </label>
								<input type="date" id="end<?= $index ?>" name="ende<?= $index ?>" value="<?= $urlaubszeitraum->ende?>"/>
								<input type="hidden" name="editUZ" value="<?= $index ?>">
								<input type="submit" name="modUZ" value="Aktualisieren">							
							</form>
							<?php
						}
					}
				?>
				<form method="post">
					<label>Urlaubszeitraum </label>
					<label for="anf">Von </label>
					<input type="date" id="anf" name="anfang" value=""/>
					<label for="end">Bis </label>
					<input type="date" id="end" name="ende" value=""/>
					<input type="submit" name="addUZ" value="Urlaubszeitraum hinzufügen">
				</form>
				
			<form method="post">
				<input type="submit" name="ssDestroy" value="Session Zerlegen">
			</form>
				<?php
			}
			else
			{
			?>
			<form method="post">
				<label for="vn">Vorname: </label>
				<input type="text" id="vn" name="vorname" value="">
				<label for="nn">Nachname: </label>
				<input type="text" id="nn" name="nachname" value="">
				<label for="en">Email: </label>
				<input type="email" id="en" name="email" value="">
				<input type="submit" name="trainerAdd" value="Trainer Anlegen">
			</form>
			<form method="post">
				<input type="submit" name="ssDestroy" value="Session Zerlegen">
			</form>
			<?php
			}
		?>
		<form action="trainer_abschicken.php" method="post">
			<input type="hidden" name="tObject" value="">
			<input type="submit" name="tAdd" value="Trainer in Datenbank eintragen.">
		</form>
		<pre>
		<?= print_r($_SESSION) ?>
		</pre>
	</body>
</html>
