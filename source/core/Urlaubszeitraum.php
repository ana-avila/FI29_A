<?php
/*
 *	Kurseditor FPA MWA Grp A - Urlaubszeitraum.php
 *
 *	Urlaubszeitraum Klasse zum Erstellen von Urlaubszeitraum Objekten
 *
 *	Urlaubszeitraum Objekte verfügen über die für zeiträume typischen
 *	eigenschaften eines Anfangsdatums sowie eines Enddatums.
 *
 *	Verwendung:
 *		Urlaubszeitraum(string $anfang[, string $ende])
 *
 *	Wird für den Parameter $ende kein Argument bei der Instanziierung
 *	übergeben, so ist das Enddatum gleich dem Anfangsdatum um eine 
 *	Dauer von einem Tag zu signalisieren.
 *
 *	Beispiel:
 *		$uz1 = new Urlaubszeitraum("2020-07-01", "2020-08-01");
 *
 *	Rev: 1.00
 *
 *	Autor(en): Andreas Biester
 *	
 */
class Urlaubszeitraum
{
	//Eigenschaftsdeklaration
	public $anfang;
	public $ende;
	
	//Konstruktor - nach dieser Syntax wird das Objekt Instanziiert
	function __construct(string $anfang, string $ende = null)
	{
		//Eigenschaften des daraus erstellen Objektes bestücken
		$this->anfang = $anfang;
		if($ende == null)
		{
			$this->ende = $anfang;
		}
		else
		{
			$this->ende = $ende;
		}
	}
}
?>