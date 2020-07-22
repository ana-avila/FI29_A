<?php
class Kurs
{
	public $bezeichnung;
	public $startDatum;
	public $kursvorlage;
	public $urlaubszeitraeume = array();
	
	function __construct(string $bezeichnung, string $startDatum, int $kursvorlage = -1)
	{
		$this->bezeichnung = $bezeichnung;
		$this->startDatum = $startDatum:
	}
	
	function Add(object $uz)
	{
		if(get_class($uz) != "Urlaubszeitraum")
		{
			throw new InvalidObjectAdditionException('Objekte vom Typ ' . get_class($this) . ' können nur Objekte vom Typ "Urlaubszeitraum" hinzugefügt werden! Typ übergeben: ' . get_class($objekt));
		}
		else
		{
			array_push($this->urlaubszeitraeume, $uz);
		}
	}
}
?>