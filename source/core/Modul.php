<?php
class Modul extends KursObjekt
{
	function Add(object $objekt)
	{
		if(get_class($this) == get_class($objekt))
		{
			throw new ObjectSelfAdditionException('Objekte vom Typ "' . get_class($this) . '" können sich keine Objekte vom selben Typen hinzufügen!');
		}
		if(get_class($objekt) != "Lernfeld")
		{
			throw new InvalidObjectAdditionException('Objekten vom Typ "' . get_class($this) . '" können nur Objekte vom Typ "Lernfeld" hinzugefügt werden!');
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
				$this->Update();
			}
		}
	}
	
	function Rem(object $objekt)
	{
		if(get_class($this) == get_class($objekt))
		{
			throw new ObjectSelfRemovalException('Objekte vom Typ "' . get_class($this) . '" können keine Objekte vom selben Typen aus sich entfernen!');
		}
		if(get_class($objekt) != "Lernfeld")
		{
			throw new InvalidObjectRemovalException('Objekten vom Typ "' . get_class($this) . '" können nur Objekte vom Typ "Lernfeld" entfernt werden!');
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
				$this->Update();
			}
		}
	}
}
?>