<?php
include_once("../core/Exceptions.php");
include_once("../core/KursObjektBasis.php");
include_once("../core/KursObjekt.php");
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
		<h1>Der Kommentierte Code is zu finden unter: fpa/beispiele/kursobjekte.php</h1>
	<?php
	//Erstellen eines Kursvorlage-Objektes
	$kursvorlage = new Kursvorlage("Umschulung Fachinformatiker");

	//Erstellen eines Modul Objektes
	$modul1 = new Modul("IT-Tanzen für Anfänger");

	//Erstellen von Lernfeld Objekten
	$lernfeld1 = new Lernfeld("Grundschritte A", 80);
	$lernfeld2 = new Lernfeld("Grundschritte B", 40);

	/*
	 *	Da gegenwärtig das Verhalten vorsieht, das ein KursObjekt
	 *	(Basis für die Klassen: Kursvorlage, Modul, Lernfeld)
	 *	beim Hinzufügen anderer Objekte mit basis KursObjekt deren Dauer zu ihrer eigenen
	 *	Addieren, müssen beim Bilden einer Kursvorlage mit korrekter Gesamtdauer
	 *	zunächst die Lernfelder eines Moduls zu diesem Hinzugefügt werden und im 
	 *	Anschluss daran das Modul der Entsprechenden Kursvorlage.
	 *
	 *	Dieses Vorgehen basiert auf dem Gedanken, das die Dauer einees Lernfeldes
	 *	immer Bekannt ist, ein Modul jedoch auch einer variablen Anzahl von
	 *	Lernfeldern bestehen kann. Die Dauer eines Moduls ist somit die Summe
	 *	der Dauer seiner Lernfelder.
	 *
	 *	Die selbe Logik wird auf Kursvorlagen angewandt, da deren Dauer die Summe
	 *	der Dauer seiner Module ist.
	 */
	 
	/*
	 *	Dem zuvor erzeugten Modul Objekt wird mit Aufruf der Methode Add(object KursObjekt)
	 *	die angelegten Lernfelder hinzugefügt. Das Modul Objekt führt eine Liste sämtlicher
	 *	in ihm befindlicher Lernfeld Objekte zu der diese nun also gehören.
	 *
	 *	Dabei wird automatisch die Dauer des Modul Objekts um die Dauer der Lernfeld Objekte
	 *	erhöht.
	 */

	$modul1->Add($lernfeld1);
	$modul1->Add($lernfeld2);

	/*
	 *	Dem zuvor erzeugten Kursvorlage Objekt wird mit Aufruf der Methode Add(object KursObjekt)
	 *	das angelegte Modul hinzugefügt. Das Kursvorlage Objekt führt eine Liste sämtlicher
	 *	in ihm Befindlicher Modul Objekte zu der diese nun also gehören.
	 *
	 *	Dabei wird automatisch die Dauer des Kursvorlage Objektes um die Dauer der Modul Objekte
	 *	erhöht.
	 */
	$kursvorlage->Add($modul1);

	?>
<pre>
<?php
/*
 *	Anzeige des Kursvorlage Objektes mit dem die nun erzeuge Struktur verdeutlicht werden soll.
 */
print_r($kursvorlage);
?>
</pre>
	<p><a href="../index.php">Zurück</a></p>
	</body>
</html>
