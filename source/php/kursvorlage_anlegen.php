<?php
include_once("../core/Exceptions.php");
include_once("../core/ClassExtensions.php");

session_start();

if(isset($_POST['sessionDestroy']))
{
	session_destroy();
}

if(isset($_POST['addKvlg']))
{
	if(isset($_POST['kvlg']) && !empty($_POST['kvlg']))
	{
		$kv = new Kursvorlage($_POST['kvlg']);
		$_SESSION['kvObject'] = $kv;
		unset($_POST['kvlg']);
	}
}

/*
 *	Modul Array hier anlegen. Die Add Methode von Klassen die KursObjekt erweitern (in diesem fall Modul), rechnet die Dauer eines
 *	Objektes das ihm Übergeben wird auf seine eigene. Lernobjekte MÜSSEN eine Dauer implementieren, so setzt sich also
 *	die Dauer eines Moduls aus der dauer seiner Lernobjekte zusammen. Diese werden jedoch erst später angelegt, wir müssen die Module
 *	also vorhalten, bis sämtliche Lernfelder für dieses Modul bekannt sind. Anschließend können sie dem entsprechenden Modul Objekt
 *	hinzugefügt werden.
 */
 
if(isset($_POST['addMod']))
{
	if(isset($_POST['mod']) && !empty($_POST['mod']))
	{
		$kv = $_SESSION['kvObject'];
		$mod = new Modul($_POST['mod']);
		if(count($kv->data) < 8)
		{
			try
			{
				$kv->Add($mod);
				$_SESSION['kvObject'] = $kv;
			}
			catch(Exception $e)
			{
				echo $e;
			}
		}
	}
}

if(isset($_POST['addLF']))
{
	if(isset($_POST['lf']) && !empty($_POST['lf']) && isset($_POST['lfUE']) && !empty($_POST['lfUE']))
	{
		$kv = $_SESSION['kvObject'];
		$lfMod = $_POST['lfMod'];
		$lf = new Lernfeld($_POST['lf'], $_POST['lfUE']);
		try
		{
			$kv->data[$lfMod]->Add($lf);
			try
			{
				$kv->Update();
			}
			catch(Exception $e)
			{
				echo $e;
			}
			
			$_SESSION['kvObject'] = $kv;
		}
		catch(Exception $e)
		{
			echo $e;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>Kursvorlage Anlegen - Kursplaner</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="expires" content="0">
		<style>
			main {
				width: 50%;
				margin: auto;
				background-color: darkgray;
			}
			.modContent
			{
				padding-top: 1em;
			}
			.modAdd
			{
				padding-top: 1em;
			}
			.debug {
				width: 50%;
				margin: 1em auto auto auto;
				background-color: lightgray;
			}
		</style>
	</head>
	<body>
		<main>
		<?php
			/*
			 *	Sofern es angelegt wurde, müssen wir nun das Kursvorlage Objekt auslesen und die
			 *	Website entsprechend mit den Notwendigen HTML-Elementen generieren!
			 */
			if(isset($_SESSION['kvObject']) && !empty($_SESSION['kvObject']))
			{
				$kv = $_SESSION['kvObject'];
				?>
			<form method="post">
				<input type="text" name="kvlg" value="<?= $kv->bezeichnung ?>" style="width: 400px;">
				<input type="hidden" name="editKvlg">
				<input type="submit" name="modKvlg" value="Kursvorlage Aktualisieren">
			</form>
		<?php
				/*
				 *	Existiert ein Modul Objekt, so existiert in diesem Kontext immer auch eine Liste
				 *	von Modulen, welche hier ausgelesen werden Müssen um für JEDES Modul entsprechend
				 *	die HTML-Elemente zu generieren!
				 */
				if(isset($kv->data) && !empty($kv->data))
				{
					foreach($kv->data as $modul)
					{
						$index = array_search($modul, $kv->data);
		?>
					<div class="modContent">
					<form method="post">
						<input type="text" name="mod<?= $index ?>" value="<?= $modul->bezeichnung ?>" style="width: 400px; margin-left: 2em;">
						<input type="hidden" name="editMod" value="<?= $index ?>">
						<input type="submit" name="modMod" value="Modul Aktualisieren">
					</form>
		<?php
						foreach($modul->data as $lf)
						{
							$index = array_search($lf, $modul->data)
		?>
							<form method="post">
								<input type="text" name="lf" value="<?= $lf->bezeichnung ?>" style="width: 400px; margin-left: 4em;">
								<input type="number" name="lfUE" min="8" value="<?= $lf->ue ?>">
								<input type="hidden" name="lfMod" value="<?= $index ?>">
								<input type="submit" name="modLf" value="Lernfeld Aktualisieren">
							</form>
		<?php
						}
		?>		
					<form method="post">
						<input type="text" name="lf" placeholder="Name d. Lernfelds.." style="width: 400px; margin-left: 4em;">
						<input type="number" name="lfUE" min="8" value="8">
						<input type="hidden" name="lfMod" value="<?= $index ?>">
						<input type="submit" name="addLF" value="Lernfeld Anlegen">
					</form>
					</div>
		<?php
					}
				}
				if(!isset($_SESSION['modList']) || count($_SESSION['modList']) < 8)
				{
		?>
				<div class="modAdd">
				<form method="post">
					<input type="text" name="mod" placeholder="Name d. Modul.. 'Office IT'" style="width: 400px;">
					<input type="submit" name="addMod" value="Modul Anlegen">
				</form>
				</div>
		<?php
				}
			}
			else
			{
		?>
			<form method="post">
				<input type="text" name="kvlg" placeholder="Name d. Kursvorlage.. 'Umschulung Fachinformatiker'" style="width: 400px;">
				<input type="submit" name="addKvlg" value="Kursvorlage Anlegen">
			</form>
		<?php				
			}
		?>
		<br>
		<br>
		<br>
		<form method="post">
			<input type="submit" name="sessionDestroy" value="Session Beenden">
		</form>
		</main>
		<?php
			if(isset($_SESSION['kvObject']))
			{
				$kv = $_SESSION['kvObject'];
		?>
			<pre class="debug">
<?= print_r($kv) ?>
			</pre>
		<?php
			}
		?>
	</body>
</html>