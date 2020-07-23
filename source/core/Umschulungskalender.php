<?php
include_once("jahr.php");
include_once("monat.php");
include_once("tag.php");

class Umschulungskalender
{
	public $startDatum;
	public $kurs;
	public $dauer;
	public $jahre = array();
	
	function __construct(string $startDatum, string $kurs, int $dauer = 2)
	{
		$wochentage = array("Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
		$Monate = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
		$MonatTage = array(31, null, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		$holidayMoveNumBln = [-2, 0, 1, 39, 49, 50];
		$holidayNameBln = ["Karfreitag", "Ostersonntag","Ostermontag", "Christi Himmelfahrt", "Pfingstsonntag", "Pfingstmontag"];
		
		$this->startDatum = $startDatum;
		$this->kurs = $kurs;
		$this->dauer = $dauer;
		$calData = explode('-', $this->startDatum);
		$jahr = $calData[0];
		$monat = (int) $calData[1];
		$tag = (int) $calData[2];
		$startMonat = $calData[1];
		$startTag = $calData[2];
		$numTage = $this->dauer * 365 + 1;
		$osMonat = 3;
		
		for($dauer; $dauer >= 0; $dauer--)
		{
			// Oster Formel -> Ostersonntag bestimmen
			$k = floor($jahr / 100);
			$m = 15 + floor((3*$k + 3) / 4) - floor((8*$k + 13) / 25);
			$s = 2 - floor((3*$k + 3) / 4);
			$a = $jahr % 19;
			$d = (19 * $a + $m) % 30;
			$r = floor(floor(($d + $a / 11)) / 29);
			$og = 21 + $d - $r;
			$sz = 7 - floor(($jahr + $jahr / 4 + $s)) % 7;
			$oe = 7 - ($og - $sz) % 7;
			$os = $og + $oe;
			$os = $os - $MonatTage[2];

			if(isset($feierTage))
			{
				unset($feierTage);
			}
			//Fixen Feiertage einfügen
			$feierTage[$jahr . '-01-01'] = "Neujahr";
			$feierTage[$jahr . '-03-08'] = "Internationaler Frauentag";
			$feierTage[$jahr . '-05-01'] = "Tag der Arbeit";
			if($jahr == 2020)
			{
				$feierTage[$jahr . '-05-08'] = "Tag der Befreiung";
			}
			$feierTage[$jahr . '-10-03'] = "Tag der Deutschen Einheit";
			$feierTage[$jahr . '-12-25'] = "1. Weihnachtsfeiertag";
			$feierTage[$jahr . '-12-26'] = "2. Weihnachtsfeiertag";
			
			//Beweglichen Feiertage einfügen
			for($i = 0; $i < count($holidayMoveNumBln); $i++)
			{
				if($os + $holidayMoveNumBln[$i] > $MonatTage[$osMonat])
				{
					$holidayDate = $os + $holidayMoveNumBln[$i] - $MonatTage[$osMonat];
					$holidayMonatCalc = $osMonat + 1;
					while($holidayDate > $MonatTage[$holidayMonatCalc])
					{
						$holidayDate = $holidayDate - $MonatTage[$holidayMonatCalc];
						$holidayMonatCalc++;
					}
					$holidayMonat = $holidayMonatCalc + 1;
					if($holidayMonat < 10)
					{
						$holidayMonat = '0' . $holidayMonat;
					}
					if($holidayDate < 10)
					{
						$holidayDate = '0' . $holidayDate;
					}
					$feierTage[$jahr . '-' . $holidayMonat . '-' . $holidayDate] = $holidayNameBln[$i];
				}
				else
				{
					$holidayDate = $os + $holidayMoveNumBln[$i];
					$holidayMonat = $osMonat + 1;
					if($holidayMonat < 10)
					{
						$holidayMonat = '0' . $holidayMonat;
					}
					if($holidayDate < 10)
					{
						$holidayDate = '0' . $holidayDate;
					}
					$feierTage[$jahr . '-' . $holidayMonat . '-' . $holidayDate] = $holidayNameBln[$i];
				}
			}
			
			//Erzeugung der Objekte für den Kalender
			$aktJahr = new Jahr($jahr);
			for($monat; $monat <= 12; $monat++)
			{
				if($monat < 10)
				{
					$monat = '0' . $monat;
				}
				$aktMonat = new Monat($Monate[$monat - 1] ,$monat);
				$aktMonatTage = 0;
				if($monat == 2)
				{
					if($aktJahr->schaltJahr)
					{
						$aktMonatTage = 29;
					}
					else
					{
						$aktMonatTage = 28;
					}
				}
				else
				{
					$aktMonatTage = $MonatTage[$monat - 1];
				}
				if($dauer <= 0 && $monat == $startMonat)
				{
					if($startTag == 1)
					{
						$aktMonatTage = $startTag;
					}
					else
					{
						$aktMonatTage = $startTag - 1;
					}
				}
				for($tag; $tag <= $aktMonatTage; $tag++)
				{
					if($tag < 10)
					{
						$tag = '0' . $tag;
					}
					$datum = $jahr . '-' . $monat . '-' . $tag;
					$unixTimeStamp = strtotime($datum);
					$dayOfWeek = date("N", $unixTimeStamp);
					$dayOfWeek = $dayOfWeek -1;
					if($dayOfWeek == 5 || $dayOfWeek == 6)
					{
						if(isset ($feierTage[$jahr . '-' . $monat . '-' . $tag]))
						{
							$aktTag = new Tag($wochentage[$dayOfWeek], $tag, true, false, true, $feierTage[$jahr . '-' . $monat . '-' . $tag]);
						}
						else
						{
							$aktTag = new Tag($wochentage[$dayOfWeek], $tag, true);
						}
					}
					else
					{
						if(isset ($feierTage[$jahr . '-' . $monat . '-' . $tag]))
						{
							$aktTag = new Tag($wochentage[$dayOfWeek], $tag, false, false, true, $feierTage[$jahr . '-' . $monat . '-' . $tag]);
						}
						else
						{
							$aktTag = new Tag($wochentage[$dayOfWeek], $tag, false);
						}
					}
					array_push($aktMonat->tage, $aktTag);
				}
				array_push($aktJahr->monate, $aktMonat);
				
				if($dauer <= 0 && $monat == $startMonat)
				{
					break;
				}
				
				$tag = 01;
			}
			array_push($this->jahre, $aktJahr);
			$monat = 01;
			$jahr++;
		}
	}
}
?>