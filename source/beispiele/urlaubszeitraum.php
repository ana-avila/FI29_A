<?php
class Urlaubszeitraum
{
	//Eigenschaftsdeklaration
	public $anfang;
	public $ende;
	
	//Konstruktor - nach dieser Syntax wird das Objekt Instanziiert
	function __construct(string $anfang, string $ende = null)
	{
		//Eigenschaften des daraus erstellen Objektes bestücken
		$this->anfang = $anfang;
		if($ende == null)
		{
			$this->ende = $anfang;
		}
		else
		{
			$this->ende = $ende;
		}
	}
}

$uz1 = new Urlaubszeitraum("2020-07-01", "2020-08-01");
$uz2 = new Urlaubszeitraum("2020-07-01");
$uz3 = new Urlaubszeitraum("2020-07-01", "2020-08-01");
$uz4 = $uz1;

//Exakter Vergleich. Neben Überprüfung ob die Objekte anhand der selben
//Klasse instanziiert wurden, wird geprüft ob die Variablen auf die (exakt) selbe
//Instanz dieser Klasse referenzieren(im Arbeitsspeicher darauf verweisen).
if(!($uz1 === $uz3))
{
	echo get_class($uz1) . ' Objekt $uz1 ist nicht 1:1 ' . get_class($uz3) . ' Objekt $uz3';
	echo nl2br("\n");
}

echo nl2br("\n");

//Schwacher Vergleich. Es wird verglichen ob die Objekte anhand der selben
//Klasse instanziiert wurden, und ob deren Eigenschaftswerte übereinstimmen.
if($uz1 == $uz4)
{
	echo get_class($uz1) . ' Objekt $uz1 ist 1:1 ' . get_class($uz4) . ' Objekt $uz4';
	echo nl2br("\n");
}

$uzListe = array();

array_push($uzListe, $uz1);
array_push($uzListe, $uz2);
//Foreach(<array der durchlaufen wird> as <element des array im aktuellen durchgang>)
foreach($uzListe as $urlaubsZeitraum)
{
	echo nl2br($urlaubsZeitraum->anfang . "\n");
	echo nl2br($urlaubsZeitraum->ende . "\n");
	echo nl2br("\n");
	if($urlaubsZeitraum->anfang == $urlaubsZeitraum->ende)
	{
		echo "Urlaubszeitraum ist 1 Tag";
	}
}

echo nl2br("\n\n");
?>