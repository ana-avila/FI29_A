<?php
/*
 *	Kurseditor FPA MWA Grp A - Trainer.php
 *
 *	Trainer Klasse zum Erzeugen von Trainer Objekten
 *
 *	Diese Klasse ermöglicht es Trainer Objekte zu Erzeugen die über für Trainer
 *	typische Eigenschaften wie Vorname, Nachname, E-Mail Adresse sowie deren
 *	Schwerpunkte verfügen.
 *
 *	Die Eigenschaft Schwerpunkte besteht hierbei aus einem Array dem _AUSSCHLIEßLICH_
 *	TrainerSchwerpunkt Objekte hinzugefügt/entfernt werden können. Dieser Array ist beim
 *	Erzeugen von Trainer Objekten zunächst leer.
 *
 *	Verwendung:
 *		TrainerSchwerpunkt(string $vorname, string $nachname, string $email)
 *
 *	Beispiel:
 *		$trainer = new Trainer("Max", "Mustermann", "m.mustermann@example.com");
 *
 *	Methoden:
 *		Add(object TrainerObjekt) -> Fügt einem Trainer Objekt entsprechende TrainerObjekt Objekte hinzu
 *		Rem(object TrainerObjekt) -> Entfernt entsprechende TrainerObjekt Objekte aus einem Trainer Objekt
 *
 *	TrainerObjekt Objekte sind: TrainerSchwerpunkt, TrainerLernfeld Objekte
 *
 *	Rev: 1.05
 *
 *	Autor(en): Andreas Biester
 */
 
class Trainer
{
	public $vorname;
	public $nachname;
	public $email;
	public $schwerpunkte = array();
	public $lernfelder = array();
	public $urlaubszeitraeume = array();
	
	function __construct(string $vorname, string $nachname, string $email)
	{
		$this->vorname = $vorname;
		$this->nachname = $nachname;
		$this->email = $email;
	}
	
	function Add(object $objekt)
	{
		if($this == $objekt)
		{
			throw new ObjectSelfAdditionException('Objekte vom Typ ' . get_class($this) . ' können sich keine Objekte vom selben Typen hinzufügen!');
		}
		else
		{
			if(get_class($objekt) != "TrainerSchwerpunkt" && get_class($objekt) != "TrainerLernfeld" && get_class($objekt) != "Urlaubszeitraum")
			{
				throw new InvalidObjectAdditionException('Objekte vom Typ ' . get_class($this) . ' können sich nur Objekte vom Typ "TrainerSchwerpunkt", "TrainerLernfeld", "Urlaubszeitraum" hinzufügen! Typ übergeben: ' . get_class($objekt));
			}
			elseif(in_array($objekt, $this->schwerpunkte) || in_array($objekt, $this->lernfelder) || in_array($objekt, $this->urlaubszeitraeume))
			{
				throw new ObjectAllreadyInCollectionException('Dem ' . get_class($this) . ' Objekt wurde bereits dieses ' . get_class($objekt) . ' Objekt mit der Bezeichnung ' . $objekt->bezeichnung . ' hinzugefügt!');
			}
			else
			{
				switch(get_class($objekt))
				{
					case "TrainerSchwerpunkt":
						array_push($this->schwerpunkte, $objekt);
					break;
					
					case "TrainerLernfeld":
						array_push($this->lernfelder, $objekt);
					break;
					
					case "Urlaubszeitraum":
						array_push($this->urlaubszeitraeume, $objekt);
					break;
				}
			}
		}
	}
	
	function Rem(object $objekt)
	{
		if($this == $objekt)
		{
			throw new ObjectSelfRemovalException('Objekte vom Typ ' . get_class($this) . ' können sich nicht aus sich selbst entfernen!');
		}
		else
		{
			if(get_class($objekt) != "TrainerSchwerpunkt" && get_class($objekt) != "TrainerLernfeld" && get_class($objekt) != "Urlaubszeitraum")
			{
				throw new InvalidObjectRemovalException('Aus ' . get_class($this) . ' Objekten können nur Objekte vom Typ "TrainerSchwerpunkt", "TrainerLernfeld" oder "Urlaubszeitraum" entfernt werden! Typ übergeben: ' . get_class($objekt));
			}
			elseif(!in_array($objekt, $this->schwerpunkte) && !in_array($objekt, $this->lernfelder) && !in_array($objekt, $this->urlaubszeitraeume))
			{
				throw new ObjectNotInCollectionException(get_class($objekt) . ' Objekt ist nicht im ' . get_class($this) . ' Objekt mit Namen ' . $this->vorname . ' ' . $this->nachname . ' vorhanden!');
			}
			else
			{
				switch(get_class($objekt))
				{
					case "TrainerSchwerpunkt":
						$index = array_search($objekt, $this->schwerpunkte);
						array_splice($this->schwerpunkte, $index, 1);
					break;
					
					case "TrainerLernfeld":
						$index = array_search($objekt, $this->lernfelder);
						array_splice($this->lernfelder, $index, 1);
					break;
					
					case "Urlaubszeitraum":
						$index = array_search($objekt, $this->urlaubszeitraeume);
						array_splice($this->urlaubszeitraeume, $index, 1);
					break;
				}
			}
		}
	}
}
?>