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
 *		Add(object TrainerSchwerpunkt) -> Fügt einem Trainer Objekt entsprechende TrainerSchwerpunkt Objekte hinzu
 *		Rem(object TrainerSchwerpunkt) -> Entfernt entsprechende TrainerSchwerpunkt Objekte aus einem Trainer Objekt
 *
 *	Rev: 1.01
 *
 *	Author(en): Andreas Biester
 */
 
class Trainer
{
	public $vorname;
	public $nachname;
	public $email;
	public $schwerpunkte = array();
	
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
			if(get_class($objekt) != "TrainerSchwerpunkt")
			{
				throw new InvalidObjectAdditionException('Objekte vom Typ ' . get_class($this) . ' können sich nur Objekte vom Typ "Schwerpunkt" hinzufügen!');
			}
			elseif(in_array($objekt, $this->schwerpunkte))
			{
				throw new ObjectAllreadyInCollectionException('Dem ' . get_class($this) . ' Objekt wurde bereits dieses ' . get_class($objekt) . ' Objekt mit der Bezeichnung ' . $objekt->bezeichnung . ' hinzugefügt!');
			}
			else
			{
				array_push($this->schwerpunkte, $objekt);
			}
		}
	}
	
	function Rem(object $objekt)
	{
		if($this == $objekt)
		{
			throw new ObjectSelfRemoveException('Objekte vom Typ ' . get_class($this) . ' können sich nicht aus sich selbst entfernen!');
		}
		else
		{
			if(get_class($objekt) != "TrainerSchwerpunkt")
			{
				throw new ObjectInvalidRemovalException('Aus ' . get_class($this) . ' Objekten können nur Objekte vom Typ "TrainerSchwerpunkt" entfernt werden!');
			}
			elseif(!in_array($objekt, $this->schwerpunkte))
			{
				throw new InvalidObjectRemoveException(get_class($objekt) . ' Objekt befindet sich nicht in den Schwerpunkten des ' . get_class($this) . ' Objekts mit Namen ' . $this->vorname . ' ' . $this->nachname . '!');
			}
			else
			{
				$index = array_search($objekt, $this->schwerpunkte);
				array_splice($this->schwerpunkte, $index, 1);
			}
		}
	}
}
?>