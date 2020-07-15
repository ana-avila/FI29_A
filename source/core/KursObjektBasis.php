<?php
/*
 *	Kurseditor FPA MWA Grp A - KursObjektBasis.php
 *
 *	Basisklasse für alle Objekte, welche im Zusammenhang mit der Erstellung von
 *	Kursvorlagen im Kurseditor stehen. Sämtliche Objekte für die Kursvorlagenerstellung
 *	müssen zumind. die hier definierten Attribute/Eigenschaften besitzen.
 *
 *	Verwendung:
 *		KursObjektBasis(string $bezeichnung)
 *
 *	Erstellen eines KursObjektBasis Objektes für Schwerpunkte:
 *		$schwerpunkt = new KursObjektBasis("Dies ist ein Kursschwerpunkt");
 *
 *	Rev: 1.01
 *
 *	Author(en): Andreas Biester
 */
 
class KursObjektBasis
{
	public $bezeichnung;
	
	function __construct(string $bezeichnung)
	{
		$this->bezeichnung = $bezeichnung;
	}
}
?>