<?php
/*
 *	Kurseditor FPA MWA Grp A - ClassExtensions.php
 *
 *	"Leer-Spezialisierung" der Klasse KursObjekt sowie KursObjektBasis um die
 *	Verständlichkeit beim Arbeiten, also dem erzeugen von Objekten, sowie die
 *	Code-Lesbarkeit zu erleichtern.
 *
 *	Diese Implementierung erlaubt es außderdem unter Verwendung der get_class(object)
 *	Methode zu überprüfen mithilfe welcher Klasse ein Objekt instaziiert wurde.
 *
 *
 *	Diesen Klassen stehen alle Eigenschaften und Methoden zur Verfügung über
 *	welche die Klasse KursObjekt bzw. KursObjektBasis auch verfügt.
 *
 *	Verwendung von Kursvorlage, Modul, Lernfeld siehe KursObjekt.php
 *
 *	Verwendung von Schwerpunkt siehe KursObjektBasis.php
 *
 *	Rev: 1.02
 *
 *	Autor(en): Andreas Biester
 */

include_once("KursObjektBasis.php");
include_once("KursObjekt.php");
include_once("TrainerObjekt.php");

//Klassen welche KursObjektBasis extenden
class Schwerpunkt extends KursObjektBasis {}

// Klassen welche KursObject extenden
class Kursvorlage extends KursObjekt {}
class Modul extends KursObjekt {}
class Lernfeld extends KursObjekt {
	//Lernfeld ist die kleinste Basis, sie muss die Dauer der Unterrichtseinheiten enthalten!
	function __construct(string $bezeichnung, int $ue)
	{
		$this->bezeichnung = $bezeichnung;
		$this->ue = $ue;
	}
}

//Klassen welche TrainerObjekt extenden
class TrainerSchwerpunkt extends TrainerObjekt {}
class TrainerLernfeld extends TrainerObjekt {}
?>