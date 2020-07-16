<?php
/*
 *	Kurseditor FPA MWA Grp A - KursObjekt.php
 *
 *	Spezilisierte Klasse zum Erzeugen von jeglicher Art von KursObjekt
 *	Objekten für die Verwendung bei der Erstellung von:
 *		- Kursvorlagen
 *		- Modulen
 *		- Lernfeldern
 *
 *	!!!!!!!!! Anm.: Klasse noch Unvollständig !!!!!!!!!!!!!
 *
 *	Verwendung:
 *		KursObjekt(string $bezeichnung[, int $ue])
 *
 *	Beispiel im Bezug auf Kursvorlagen:
 *		$kursvorlage = new KursObjekt("Umschulung für Fachinformatiker");
 *
 *	Beispiel im Bezug auf Module:
 *		$kursvorlage = new KursObjekt("Modul A - Grundausbildung");
 *
 *	Beispiel im Bezug auf Lernfelder:
 *		$kursvorlage = new KursObjekt("Datenbanken", 80);
 *
 *	Methoden:
 *		Add(object $objekt) -> Fügt einem KursObjekt ein anderes Objekt auf Basis von KursObjekt hinzu.
 *
 *	Beim Erzeugen von KursObjekt Objekten ist zumind. immer deren Bezeichnung
 *	zu Übergeben. Grundsätzlich ist es momentan Optional die anzahl der
 *	Unterrichtseinheiten (in vollen Stunden) zu Übergeben.
 *
 *	Das Angedachte verhalten sieht später jedoch vor das Übergeben von
 *	Unterrichtseinheiten zumind. für Lernfelder zwingend erforderlich zu machen
 *	um die Gesamtanzahl von Unterrichtseinheiten eines Moduls und Letztendlich
 *	der Gesamten Kursvorlage daraus bestimmen zu können.
 *
 *	Rev: 1.02
 *
 *	Autor(en): Andreas Biester
 */
 
class KursObjekt extends KursObjektBasis
{
	public $ue;
	public $data = array();
	
	function __construct(string $bezeichnung, int $ue = 0)
	{
		$this->bezeichnung = $bezeichnung;
		$this->ue = $ue;
	}
	
	function Add($objekt)
	{
		array_push($this->data, $objekt);
		$this->ue += $objekt->ue;
	}
}
?>