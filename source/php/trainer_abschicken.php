<?php
include_once("config/config.php");
include_once("../core/Exceptions.php");
include_once("../core/ClassExtensions.php");
include_once("../core/Trainer.php");
include_once("../core/TrainerObjekt.php");
include_once("../core/Lernfeld.php");
include_once("../core/Urlaubszeitraum.php");

session_start();

$trainertable  = "trainer";
$trainerlftable  = "trainerlernfelder";
$trainersptable = "trainerschwerpunktthemen";
$lftable  = "lernfelder";
$sptable = "schwerpunktthemen";
$trainerurlaub = "trainerurlaub";
$spTyp = 0;
$lfTyp = 0;
$trUploadWasSuccessful = true;

try 
{
	$dbh = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
}
catch (PDOException $e) 
{
    die('Die Verbindung zur Datenbank ist fehlgeschlagen: ' . $e->getMessage());
}

$trObj = !empty($_SESSION["trainerObject"]) ? ($_SESSION["trainerObject"]) : FALSE;
$trVorname = !empty($trObj->vorname) ? ($trObj->vorname) : FALSE;
$trNachname = !empty($trObj->nachname) ? ($trObj->nachname) : FALSE;
$trEmail = !empty($trObj->email) ? ($trObj->email) : FALSE;

$trCount = $dbh->query("SELECT COUNT(trainerid) FROM $trainertable WHERE (vorname='$trVorname' AND nachname='$trNachname' AND email='$trEmail')")->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(trainerid)"];

if($trCount =="0")
{
	$trStmt = $dbh->prepare("INSERT INTO $trainertable (vorname,nachname,email) VALUES (?,?,?)");
	$trStmt->execute(array($trVorname,$trNachname,$trEmail));
}

$trId = $dbh->query("SELECT trainerid FROM $trainertable WHERE (vorname='$trVorname' AND nachname='$trNachname' AND email='$trEmail')")->fetchAll(PDO::FETCH_ASSOC)[0]["trainerid"];

$spNameStmt = $dbh->prepare("INSERT INTO $sptable (schwerpunktthemenname) VALUES (?)");

$trSpStmt = $dbh->prepare("INSERT INTO $trainersptable (trainerid,schwerpunktthemenid,schwerpunktthementyp) VALUES (?,?,?)");

$trLfStmt = $dbh->prepare("INSERT INTO $trainerlftable (trainerid,lernfeldid,lernfeldtyp) VALUES (?,?,?)");

$uzStmt = $dbh->prepare("INSERT INTO $trainerurlaub (urlaubstart,urlaubende,trainerid) VALUES (?,?,?)");

try
{
	foreach($trObj->schwerpunkte as $schwerpunkt)
	{
		$spName = $schwerpunkt->bezeichnung;
		$countOfSpInDatabase = $dbh->query("SELECT COUNT(schwerpunktthemenid) FROM $sptable WHERE schwerpunktthemenname='$spName'")->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(schwerpunktthemenid)"];
		?>
		<pre>
		<?php
		print_r("schwerpunkt $spName: ");
		print_r($countOfSpInDatabase);
		print_r(gettype($countOfSpInDatabase));
		?>
		</pre>
		<?php
		if($countOfSpInDatabase == "0")
		{
			$spNameStmt->execute(array($spName));
		}
		$spId = (int)$dbh->query("SELECT schwerpunktthemenid FROM $sptable WHERE schwerpunktthemenname='$spName'")->fetchAll(PDO::FETCH_ASSOC)[0]["schwerpunktthemenid"];
		if($schwerpunkt->primaer == 1)
		{
			$spTyp = 1;
		}
		print_r("schwerpunkttyp");
		print_r($spTyp);
		$trSpCount = $dbh->query("SELECT COUNT(*) FROM $trainersptable WHERE (trainerid=$trId AND schwerpunktthemenid=$spId AND schwerpunktthementyp=$spTyp)")->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
		if($trSpCount == "0")
		{
			$trSpStmt->execute(array($trId,$spId,$spTyp));
		}
	}

	foreach($trObj->urlaubszeitraeume as $urlaubszeitraum)
	{
		$uzAnfang = $urlaubszeitraum->anfang;
		$uzEnde = $urlaubszeitraum->ende;
		$trUzCount = $dbh->query("SELECT COUNT(id) FROM $trainerurlaub WHERE (trainerid=$trId AND urlaubstart='$uzAnfang' AND urlaubende='$uzEnde')")->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(id)"];
		if($trUzCount == "0")
		{
			$uzStmt->execute(array($uzAnfang,$uzEnde,$trId));
		}
	}

	foreach($trObj->lernfelder as $lernfeld)
	{
		$lfName = $lernfeld->bezeichnung;
		$countOfLfInDatabase = $dbh->query("SELECT COUNT(lernfeldid) FROM $lftable WHERE lernfeldname='$lfName'")->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(lernfeldid)"];
		?>
		<pre>
		<?php
		print_r("lernfeld $lfName: ");
		print_r($countOfLfInDatabase);
		print_r(gettype($countOfLfInDatabase));
		?>
		</pre>
		<?php
		if($countOfLfInDatabase == "0")
		{
			?>
			<p id="alreadySetLf">Das Lernfeld <?php echo $lfName;?> muss erst angelegt werden, bevor es dem Trainer zugewiesen werden kann. Alle Lernfelder vor diesem, sowie die Schwerpunkte und Urlaubszeiträume wurden gespeichert</p>
			<?php
			$trUploadWasSuccessful = false;
			break;
		}
		$lfId = (int)$dbh->query("SELECT lernfeldid FROM $lftable WHERE lernfeldname='$lfName'")->fetchAll(PDO::FETCH_ASSOC)[0]["lernfeldid"];
		if($lernfeld->primaer == 1)
		{
			$lfTyp = 1;
		}
		$trLfCount = $dbh->query("SELECT COUNT(*) FROM $trainerlftable WHERE (trainerid=$trId AND lernfeldid=$lfId AND lernfeldtyp=$lfTyp)")->fetchAll(PDO::FETCH_ASSOC)[0]["COUNT(*)"];
		if($trLfCount == "0")
		{
			$trLfStmt->execute(array($trId,$lfId,$lfTyp));
		}

	}
	if($trUploadWasSuccessful)
	{
		?>
		<p id="successfulTrUpload">Der Trainer wurde erfolgreich angelegt.</p>
		<?php
	}
}
catch (Exception $e) 
{
		?>
		<p id="uploadFailmsg">Es ist ein Fehler beim Anlegen des Trainers aufgetreten. Die abgefangene Exception lautet: " ,<?php echo $e->getMessage();?></p>
		<?php
}
?>
<form method="post" action="kursvorlage_anlegen.php">
	<input type="submit" name="back" value="Zurück">
</form>	