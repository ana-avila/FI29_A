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
 *	Dadurch werden Prüfungen erheblich erleichtert.
 *
 *	Diesen Klassen stehen alle Eigenschaften und Methoden zur Verfügung über
 *	welche die Klasse KursObjekt bzw. KursObjektBasis auch verfügt.
 *
 *	Verwendung von Kursvorlage, Modul, Lernfeld siehe KursObjekt.php
 *
 *	Verwendung von Schwerpunkt siehe KursObjektBasis.php
 *
 *	Rev: 1.00
 *
 *	Author(en): Andreas Biester
 */
 
class Kursvorlage extends KursObjekt {}
class Modul extends KursObjekt {}
class Lernfeld extends KursObjekt {}
class Schwerpunkt extends KursObjektBasis {}
?>