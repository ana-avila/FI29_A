<?php
include_once("config/config.php");
include_once("../core/Exceptions.php");
include_once("../core/ClassExtensions.php");
include_once("../core/Kursvorlage.php");
include_once("../core/Modul.php");
include_once("../core/Lernfeld.php");

session_start();

$kvtable  = "kursvorlage";
$modultable  = "modul";
$moduldauertable = "moduldauer";
$lftable  = "lernfelder";
$kvmoduletable = "kursvorlagemodule";
$modullftable = "modullernfelder";
$sptable = "schwerpunktthemen";
$lfsptable = "lernfelderschwerpunktthemen";

// don't use try...catch, though
// correct error reporting for PHP and PDO: https://phpdelusions.net/articles/error_reporting
try 
{
	$dbh = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
}
catch (PDOException $e) 
{
    die('Die Verbindung zur Datenbank ist fehlgeschlagen: ' . $e->getMessage());
}

$kvObj = !empty($_SESSION["kvObject"]) ? ($_SESSION["kvObject"]) : FALSE;
$kvName = !empty($kvObj->bezeichnung) ? ($kvObj->bezeichnung) : FALSE;
$kvDauer = !empty($kvObj->ue) ? ($kvObj->ue) : FALSE;
$kvNameUeStmt = $dbh->prepare("INSERT INTO $kvtable (kursvorlagenname,dauer) VALUES (?,?)");
$kvNameUeStmt->execute(array($kvName, $kvDauer));
$kvId = $dbh->query("SELECT kursvorlageid FROM $kvtable WHERE kursvorlagenname='$kvName'")->fetchAll(PDO::FETCH_ASSOC)[0]["kursvorlageid"];

$modulNameStmt = $dbh->prepare("INSERT INTO $modultable (modulname, dauerid) VALUES (?, ?)");

// doppelte Einträge des Attributes "dauer" in der Tabelle moduldauer sind nicht möglich, da das Attribut datenbankseitig UNIQUE ist.
// Ein SELECT * FROM moduldauer sortiert jetzt jedoch aufsteigend nach der moduldauer statt nach den PrimaryKeys
$modulDauerStmt = $dbh->prepare("INSERT INTO $moduldauertable (dauer) VALUES (?)"); 

$kvModuleStmt = $dbh->prepare("INSERT INTO $kvmoduletable (kursvorlageid,modulid) VALUES (?,?)");

$lfNameUeStmt = $dbh->prepare("INSERT INTO $lftable (lernfeldname, dauer) VALUES (?,?)");

$modulLfStmt = $dbh->prepare("INSERT INTO $modullftable (modulid,lernfeldid) VALUES (?,?)");

$spNameStmt = $dbh->prepare("INSERT INTO $sptable (schwerpunktthemenname) VALUES (?)");

$lfSpStmt = $dbh->prepare("INSERT INTO $lfsptable (lernfeldid,schwerpunktthemenid) VALUES (?,?)");

try
{
	foreach($kvObj->data as $modul)
	{
		$dauer = $modul->ue;
		$modulDauerStmt->execute(array($dauer));
		$dauerid = (int)$dbh->query("SELECT dauerid FROM $moduldauertable WHERE dauer=$dauer")->fetchAll(PDO::FETCH_ASSOC)[0]["dauerid"];
		$modulName = $modul->bezeichnung;
		$modulNameStmt->execute(array($modulName,$dauerid));
		$modulId = $dbh->query("SELECT modulid FROM $modultable WHERE modulname='$modulName'")->fetchAll(PDO::FETCH_ASSOC)[0]["modulid"];
		$kvModuleStmt->execute(array($kvId,$modulId));
		foreach($modul->data as $lernfeld)
		{
			$lfName = !empty($lernfeld->bezeichnung) ? ($lernfeld->bezeichnung) : FALSE;
			$lfDauer = !empty($lernfeld->ue) ? ($lernfeld->ue) : FALSE;
			$lfNameUeStmt->execute(array($lfName,$lfDauer));
			$lfId = $dbh->query("SELECT lernfeldid FROM $lftable WHERE lernfeldname='$lfName'")->fetchAll(PDO::FETCH_ASSOC)[0]["lernfeldid"];
			$modulLfStmt->execute(array($modulId,$lfId));
			foreach($lernfeld->data as $schwerpunkt)
			{
				$spName = !empty($schwerpunkt->bezeichnung) ? ($schwerpunkt->bezeichnung) : FALSE;
				$spNameStmt->execute(array($spName));
				$spId = $dbh->query("SELECT schwerpunktthemenid FROM $sptable WHERE schwerpunktthemenname='$spName'")->fetchAll(PDO::FETCH_ASSOC)[0]["schwerpunktthemenid"];
				$lfSpStmt->execute(array($lfId,$spId));
			}
		}
	}
	echo "Die Kursvorlage wurde erfolgreich angelegt.";
} 
catch (Exception $e) 
{
	echo "Es ist ein Fehler beim Anlegen der Kursvorlage aufgetreten. Die abgefangene Exception lautet: " , $e->getMessage(), "\n";
}

?>
<form method="post" action="kursvorlage_anlegen.php">
	<input type="submit" name="back" value="Zurück">
</form>	

	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	