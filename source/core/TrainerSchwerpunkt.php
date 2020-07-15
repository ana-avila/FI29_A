<?php
/*
 *	Kurseditor FPA MWA Grp A - TrainerSchwerpunkt.php
 *
 *	Spezialisierte Klasse zum Erstellen von TrainerSchwerpunkt Objekten.
 *	Trainer Schwerpunkte haben die besondere Eigenschaft, ob diese 
 *	Schwerpunkte Primär oder Sekundär sind.
 *
 *	Somit ist im Vergleich zu einem Schwerpunkt Objekt diese Eigenschaft notwendig
 *	um die Unterscheidung zu Ermöglichen
 *
 *	Verwendung:
 *		TrainerSchwerpunkt(string $bezeichnung[, bool $primaer])
 *
 *	Beim erstellen von Objekten dieser Klasse muss für einen TrainerSchwerpunkt
 *	zumindest eine Bezeichnung des Schwerpunktes übergeben werden. Der Parameter
 *	$primaer ist optional. Wird dieser nicht mit Übergeben, so wird der Schwerpunkt
 *	als Sekundär angesehen.
 *
 *	Beispiel:
 *		- Primär Schwerpunkt: $trainerSchwerpunkt = new TrainerSchwerpunkt("Datenbanken", true);
 *		- Sekundär Schwerpunkt: $trainerSchwerpunkt = new TrainerSchwerpunkt("Office IT");
 *
 *	Rev: 1.01
 *
 *	Author(en): Andreas Biester
 */
 
class TrainerSchwerpunkt extends KursObjektBasis
{
	public $primaer;
	
	function __construct(string $bezeichnung, bool $primaer = false)
	{
		$this->bezeichnung = $bezeichnung;
		$this->primaer = $primaer;
	}
}
?>