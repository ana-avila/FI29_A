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
		$trainer = json_encode($trainer);
		$_SESSION['trainerObject'] = $trainer;
	}
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
				$trainer = json_decode($_SESSION['trainerObject']);
				?>
				<label for="vn">Objekt-Vorname: </label>
				<input type="text" id="vn" name="vorname" value="<?= $trainer->vorname ?>">
				<label for="nn">Objekt-Nachname: </label>
				<input type="text" id="nn" name="nachname" value="<?= $trainer->nachname ?>">
				<label for="en">Objekt-Email: </label>
				<input type="email" id="en" name="email" value="<?= $trainer->email ?>">
				<?php
					/*	if(count($trainer->schwerpunkte) > 0)
					 *	{
					 *		HIER SCHLEIFENLOGIK UM SCHWERPUNKT OBJEKTE AUSZULESEN UND ANZUZEIGEN
					 *		foreach($trainer->schwerpunkte as $schwerpunt)
					 *		{
					 *			hier zugriff auf das aktuelle element.
					 *			//Ermitteln an welcher position im array das aktuelle element sich befindet
					 *			$index = array_search($schwerpunkt, $trainer->schwerpunkte);
					 *			$schwerpunkt->bezeichnung
					 *			$schwerpunkt->primaer (ist boolean!)
					 *
					 *			Unsichtbares Input-Element um sich selbst leichter die Möglichkeit
					 *			zu Schaffen, zu indentifizieren welches der Objekte Verändert werden muss.
					 *
					 *			<input type="hidden" name="editSP" value="$index">;
					 *
					 *			//Auslesen der Zahl
					 *			$edit = $_POST['editSP'];
					 *			//Bilden des Zugriffsschlüssel für $_POST
					 *			$edit = 'schwerpunkt' + $edit;
					 *			//Auslesen der benötigten Informationen
					 *			$_POST[$edit];
					 *		}
					 *	}					 
					 */
					 /*
						if(count($trainer->schwerpunkte) > 0)
						{
							foreach($trainer->schwerpunkte as $schwerpunkt)
							{
													<zu suchende element>, <array in dem gesucht wird>
								$index = array_search($schwerpunkt, $trainer->schwerpunkt);
								?>
								<form method="post">
									<label for="sp<?= $index ?>">Schwerpunkt </label>
									<input type="text" id="sp<?= $index ?>" name="schwerpunkt<?= $index ?>" value="<?= $schwerpunkt->bezeichnung">
									<input type="radio" id="prim<?= $index ?>" name="primaer<?= $index ?>" value="true">
									<label for="prim<?= $index ?>">Primär</label>
									<input type="radio" id="sek<?= $index ?>" name="primaer<?= $index ?>" value="false">
									<label for="sek<?= $index ?>">Sekundär</label>
									<input type="hidden" name="editSP" value="<?= $index ?>">
									<input type="submit" name="modSP" value="Aktualisieren">
								</form>
								<?php
							}
						}
					 */
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
					/*
					 *	HIER SCHLEIFENLOGIK UM Lernfeld OBJEKTE AUSZULESEN UND ANZUZEIGEN
					 *	foreach($trainer->lernfelder as $lernfeld)
					 *	{
					 *		hier zugriff auf das aktuelle element.
					 *		$lernfeld->bezeichnung
					 *		$lernfeld->primaer (ist boolean!)
					 *	}
					 */
				?>
				<form method="post">
					<label for="sp">Lernfeld </label>
					<input type="text" id="sp" value=""/>
					<input type="radio" id="prim" name="primaer" value="primaer">
					<label for="prim">Primär</label>
					<input type="radio" id="sek" name="primaer" value="sekundaer">
					<label for="sek">Sekundär</label>
					<input type="submit" name="addLF" value="Lernfeld hinzufügen">
				</form>
				<?php
					/*
					 *	HIER SCHLEIFENLOGIK UM Urlaubszeitraum OBJEKTE AUSZULESEN UND ANZUZEIGEN
					 *	foreach($trainer->Urlaubszeitraeume as $urlaubszeitraum)
					 *	{
					 *		hier zugriff auf das aktuelle element.
					 *		$Urlaubszeitraum->anfang
					 *		$Urlaubszeitraum->ende
					 *	}
					 */
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
		<form action="trainerAdd.php" method="post">
			<input type="hidden" name="tObject" value="">
			<input type="submit" name="tAdd" value="Trainer in Datenbank eintragen.">
		</form>
	</body>
</html>
