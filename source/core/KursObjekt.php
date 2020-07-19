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
 *		Add(objekt $objekt) -> Fügt einem KursObjekt ein anderes Objekt auf Basis von KursObjekt hinzu.
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
 *	Rev: 1.03
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
	
	function Add(object $objekt)
	{
		if(get_class($this) != "KursObjekt")
		{
			if(get_class($this) == get_class($objekt))
			{
				throw new ObjectSelfAdditionException('Objekte vom Typ "' . get_class($this) . '" können sich keine Objekte vom selben Typen hinzufügen!');
			}
			switch(get_class($this))
			{
				case "Kursvorlage":
					if(get_class($objekt) != "Modul")
					{
						throw new InvalidObjectAdditionException('Objekten vom Typ "' . get_class($this) . '" können nur Objekte vom Typ "Modul" hinzugefügt werden!');
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
				break;
				
				case "Modul":
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
				break;
				
				case "Lernfeld":
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
				break;
			}
		}
		else
		{
			array_push($this->data, $objekt);
			$this->Update();
		}
	}
	
	function Rem(object $objekt)
	{	
		if(get_class($this) != "KursObjekt")
		{
			if(get_class($this) == get_class($objekt))
			{
				throw new ObjectSelfRemovalException('Objekte vom Typ "' . get_class($this) . '" können keine Objekte vom selben Typen aus sich entfernen!');
			}
			switch(get_class($this))
			{
				case "Kursvorlage":
					if(get_class($objekt) != "Modul")
					{
						throw new InvalidObjectRemovalException('Objekten vom Typ "' . get_class($this) . '" können nur Objekte vom Typ "Modul" entfernt werden!');
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
				break;
				
				case "Modul":
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
				break;
				
				case "Lernfeld":
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
				break;
			}
		}
		else
		{
			$index = array_search($objekt, $this->data);
			array_splice($this->data, $index, 1);
			$this->Update();
		}
		
	}
	
	function Update()
	{
		if(get_class($this) == "Lernfeld")
		{
			throw new ObjectShouldNotBeUpdatedException('Objekte vom Typ "' . get_class($this) . '" können nicht Aktualisiert werden, da die in ihnen befindlichen Objekte keine Eigenschaft "$ue" Implementieren!');
		}
		else
		{
			$myUE = 0;
			foreach($this->data as $objekt)
			{
				$myUE += $objekt->ue;
			}
			$this->ue = $myUE;
		}
	}
}
?>