<?php
include_once("../core/Exceptions.php");
include_once("../core/Trainer.php");
include_once("../core/ClassExtensions.php");
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>Index - Kursplaner</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="expires" content="0">
	</head>
	<body>
		<h1>Der Kommentierte Code is zu finden unter: fpa/beispiele/trainer.php</h1>
		<?php
			/*
			 *	Beispiel für den Umgang mit dem Trainer-Objekt
			 *
			 *	Grundgedanke:
			 *	Jeder in dem System hinterlegte Trainer muss zumind. die Eigenschaften
			 *		- Vorname
			 *		- Nachname
			 *		- E-Mail
			 *		- Trainer Schwerpunkte -> mit möglichkeit zur Unterscheidung zwischen Primär/Sekundär
			 *	besitzen.
			 *
			 *	Das Trainer Objekt unterstützt all diese Eigenschaften, wobei es sich bei den Schwerpunkten
			 *	um eine Sammlung von TrainerSchwerpunkt-Objekten des jeweiligen Trainer-Objekts ist. (Array von Objekten).
			 */
			 
			/*
			 *	Erstellen einer Auflistung von Trainern, wird mit 2 Trainer-Objekten befüllt
			 */
			$trainerList = array();
			
			
			/*
			 *	Erstellen einer neuen Instanz des Trainer-Objekts
			 *
			 *	Syntax:
			 *	$var = new Trainer(string $vorname, string $nachname, string $email)
			 *
			 *	Jedes Trainer-Objekt besitzt die Eigenschaft $schwerpunkte welches bei instanziierung zunächst
			 *	einen leeren Array darstellt. Dieser Array kann nun _AUSSCHLIEßLICH_ mit TrainerSchwerpunkt-Objekten
			 *	befüllt werden.
			 */
			$trainer1 = new Trainer("Markus", "Badzura", "m.badzura@test.de");
			
			/*
			 *	Erstellen neuer TrainerSchwerpunkt-Objekt instanzen
			 *
			 *	Syntax:
			 *	$var = new TrainerSchwerpunkt(string $typ, string $bezeichnung [, bool $primaer]);
			 *
			 *	Ein TrainerSchwerpunkt-Objekt zeichnet sich dadurch auf, das ihm der entsprechende Typ
			 *	und seine Bezeichnung als Eigenschaft zugeordnet werden können.
			 *
			 *	Bei der Eigenschaft $primaer handelt es sich um ein optionales Argument.
			 *	Standard wert wenn es nicht bei der Instanziierung übergeben wird:
			 *		- false
			 *	Das TrainerSchwerpunkt-Objekt ist damit automatisch als Sekundär zu erkennen!
			 *
			 *	Soll ein TrainerSchwerpunkt-Objekt as ein Primäres erkennbar sein, muss es mit angabe
			 *	von $primaer Instanziiert werden.
			 *
			 *	Bsp: $var = new TrainerSchwerpunkt("TrainerSchwerpunkt", "Dies ist ein Primärer Schwerpunkt!", true);
			 */
			$t1sp1 = new TrainerSchwerpunkt("Datenbanken", true);
			$t1sp2 = new TrainerSchwerpunkt("PhP", true);
			$t1sp3 = new TrainerSchwerpunkt("JavaScript", false);
			$t1sp4 = new TrainerSchwerpunkt("Lua", false);
			
			//Trainer 2
			$trainer2 = new Trainer("Thomas", "Meyer", "i.dontknow@test.de");
			$t2sp1 = new TrainerSchwerpunkt("Datenbanken", true);
			$t2sp2 = new TrainerSchwerpunkt("PhP", true);
			$t2sp3 = new TrainerSchwerpunkt("JavaScript", true);
			
			/*
			 *	Ausnahmebehandlung
			 *
			 *	Jedes Trainer-Objekt verfügt über die Methode Add um TrainerSchwerpunkt-Objekte zu der
			 *	Trainer-Objekt Eigenschaft $schwerpunkte hinzuzufügen.
			 *
			 *	Syntax: $trainerObject->Add(object $trainerSchwerpunkt)
			 *
			 *	Eine Ausnahmebehandlung ist an diesem Punkt angebracht da die Methode auschließlich in der Lage ist:
			 *		- Objekte des typ TrainerSchwerpunkt
			 *		- Noch nicht in der Liste der Schwerpunkte des Trainer-Objekt vorhandene TrainerSchwerpunkte
			 *	hinzuzufügen.
			 *
			 *	Auch ist es _NICHT_ möglich dem Trainer-Objekt sich selbst hinzuzufügen!
			 *
			 *	Missachtet man das, löst ein Trainer Objekt entsprechende Ausnahmen aus um dies zu Signalisieren!
			 */
			try
			{
				$trainer1->Add($t1sp1);
				$trainer1->Add($t1sp2);
				$trainer1->Add($t1sp3);
				$trainer1->Add($t1sp4);
				$trainer2->Add($t2sp1);
				$trainer2->Add($t2sp2);
				$trainer2->Add($t2sp3);
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
			}
			
			/*
			 *	Wurden die Trainer-Objekte korrekt instanziiert und mit TrainerSchwerpunkt-Objekten versehen,
			 *	fügen wir sie der Liste der Trainer hinzu.
			 *
			 *	Syntax für array_push:
			 *
			 *	array_push(array <liste der etwas hinzugefügt wird>, mixed <was ihr hinzugefügt wird>);
			 *	Der als Argument 1 angegebene Array wird automatisch erweitert!
			 */
			array_push($trainerList, $trainer1);
			array_push($trainerList, $trainer2);
			
			/*
			 *	Auslesen der Trainer-Objekte in der Auflistung aller Trainer, sowie der zu ihnen gehörenden
			 *	Schwerpunkte samt unterscheidung ob sie Primär oder aber Sekundär sind.
			 *
			 *	Schleife foreach -> Für jedes Element in der Trainerliste soll etwas gemacht werden,
			 *	das aktuelle element wird innerhalb der Schleife als $trainer bezeichnet
			 *
			 *	Wird der PhP-Code nun innerhalb des Schleifenkörpers unterbrochen,
			 *	kann HTML-Code für jedes der Elemente geschrieben werden. Anschließend wird der PhP-Code
			 *	weitergeführt um in PhP die weitere Logik zu beschreiben.
			 */
			foreach($trainerList as $trainer)
			{
				?>
				
				<h1>Trainer: <?= $trainer->vorname ?> <?= $trainer->nachname ?> </h1>
				
				<?php
				/*
				 *	Da jedes Trainer-Objekt über die Eigenschaft $schwerpunkte verfügt, welche
				 *	einen Array darstellt, können wir eine weitere foreach-Schleife verwenden
				 *	um nun für jeden Trainer die entsprechenden TrainerSchwerpunkt-Objekte
				 *	auslesen und ausgeben zu können.
				 */
				foreach($trainer->schwerpunkte as $schwerpunkt)
				{
					?>
					
					<h3>Schwerpunkt: <?= $schwerpunkt->bezeichnung ?></h3>
					
					<?php
					if($schwerpunkt->primaer)
					{
						echo nl2br("Schwerpunkt ist Primär\n");
					}
					else
					{
						echo nl2br("Schwerpunkt ist Sekundär\n");
					}
					echo nl2br("\n");
				}
			}
		?>
		<p><a href="../index.php">Zurück</a></p>
	</body>
</html>


