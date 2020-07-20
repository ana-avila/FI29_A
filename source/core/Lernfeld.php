<?php
class Lernfeld extends KursObjekt 
{
	//Lernfeld ist die kleinste Basis, sie muss die Dauer der Unterrichtseinheiten enthalten!
	function __construct(string $bezeichnung, int $ue)
	{
		$this->bezeichnung = $bezeichnung;
		$this->ue = $ue;
	}
	
	function Add(object $objekt)
	{
		if(get_class($this) == get_class($objekt))
		{
			throw new ObjectSelfAdditionException('Objekte vom Typ "' . get_class($this) . '" können sich keine Objekte vom selben Typen hinzufügen!');
		}
		if(get_class($objekt) != "Schwerpunkt")
		{
			throw new InvalidObjectAdditionException('Objekten vom Typ "' . get_class($this) . '" können nur Objekte vom Typ "Schwerpunkt" hinzugefügt werden!');
		}
		else
		{
			if(in_array($objekt, $this->data))
			{
				throw new ObjectAllreadyInCollectionException('Das "' . get_class($this) . '" Objekt mit der Bezeichnung "' . $this->bezeichnung . '" enthält bereits ein "' . get_class($objekt) . '" Objekt mit der Bezeichnung "' . $objekt->bezeichnung . '".');
			}
			else
			{
				array_push($this->data, $objekt);
			}
		}
	}
	
	function Rem(object $objekt)
	{
		if(get_class($this) == get_class($objekt))
		{
			throw new ObjectSelfRemovalException('Objekte vom Typ "' . get_class($this) . '" können keine Objekte vom selben Typen aus sich entfernen!');
		}
		if(get_class($objekt) != "Schwerpunkt")
		{
			throw new InvalidObjectRemovalException('Objekten vom Typ "' . get_class($this) . '" können nur Objekte vom Typ "Schwerpunkt" entfernt werden!');
		}
		else
		{
			if(in_array($objekt, $this->data))
			{
				throw new ObjectAllreadyInCollectionException('Das "' . get_class($this) . '" Objekt mit der Bezeichnung "' . $this->bezeichnung . '" enthält kein "' . get_class($objekt) . '" Objekt mit der Bezeichnung "' . $objekt->bezeichnung . '".');
			}
			else
			{
				$index = array_search($objekt, $this->data);
				array_splice($this->data, $index, 1);
			}
		}
	}
	
	function Update()
	{
		throw new ObjectShouldNotBeUpdatedException('Objekte vom Typ "' . get_class($this) . '" können nicht Aktualisiert werden, da die in ihnen befindlichen Objekte keine Eigenschaft "$ue" Implementieren!');
	}
}
?>