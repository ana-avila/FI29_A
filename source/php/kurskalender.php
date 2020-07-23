<?php
include_once("../core/Umschulungskalender.php");

if(isset($_GET['kurs']) && !empty($_GET['kurs']) && isset($_GET['kursDate']) && !empty($_GET['kursDate']))
{
	$kurs = $_GET['kurs'];
	$kursDate = $_GET['kursDate'];
	$kursKalender = new Umschulungskalender($kursDate, $kurs);
}
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>Kurskalender Ansehen</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="expires" content="0">
		<style>
			main {
				width: 70%;
				margin: auto;
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
				margin: 1em auto auto auto;
				background-color: lightgray;
			}
			
			.calendar {
				border-spacing: 0;
				margin: 0 auto 20px auto;
			}
			
			.calendar-wrapper {
				border: 1px solid black;
				box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
			}
			
			.calendar-wrapper > h1 {
				text-align: center;
				border-bottom: 1px solid black;
				box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
				margin-top: 0;
				padding: .5em;
			}

			.cell {
			border: 1px solid black;
			text-align: center;
			width: 30px;
			height: 20px;
			}

			.desc {
			border: 1px solid black;
			text-align: center;
			padding: 0 5px 0 5px;
			}

			.heading {
			font-weight: normal;
			}
			
			.filler {
				background-color: #B2B2B2;
			}
			
			.wochenende {
				background-color: #E5E5E5;
			}
			
			.feiertag {
				background-color: #E5E5E5;
				color: red;
				font-weight: bold;
			}
			
			.urlaub {
				color: blue;
				font-weight: bold;
			}
			
			.kurstag {
				background-color: #87DCE5;
			}
		</style>
	</head>
	<body>
		<main>
<?php
			if(isset($kursKalender))
			{
?>
			<div class="calendar-wrapper">
				<h1><?= $kursKalender->kurs ?></h1>
				<table class="calendar">
					<tr>
					<?php
					for($i = 0; $i <= 31; $i++)
					{
						if($i == 0)
						{
					?>
						<th class="heading desc">Monat / Tag</th>
					<?php
						}
						else
						{
					?>
						<th class="heading cell"><?= $i ?></th>
					<?php
						}
					}

					?>
					</tr>
<?php
					foreach($kursKalender->jahre as $jahr)
					{
						foreach($jahr->monate as $monat)
						{
?>
						<tr>
							<td class="desc"><?= $monat->monat . ' ' . $jahr->jahr ?></td>
<?php
							if($monat->tage[0]->tagNum > 1)
							{
								$fillerNum = $monat->tage[0]->tagNum - 1;
								for($i = 1; $i <= $fillerNum; $i++)
								{
?>
									<td class="cell filler"></td>
<?php
								}
							}
							foreach($monat->tage as $tag)
							{
								if($tag->we && $tag->feiertag)
								{
?>
									<td class="cell feiertag">F</td>
<?php
								}
								elseif($tag->we)
								{
?>
									<td class="cell wochenende">S</td>
<?php
								}
								elseif($tag->feiertag)
								{
?>
									<td class="cell feiertag">F</td>
<?php
								}
								else
								{
?>
									<td class="cell kurstag">8</td>
<?php									
								}
							}
						if(count($monat->tage) < 31)
						{
							$lastIndex = count($monat->tage) - 1;
							$lastDayNum = $monat->tage[$lastIndex]->tagNum;
							if($lastDayNum < 31)
							{
								$fillNum = 31 - $lastDayNum;
								for($i = 1; $i <= $fillNum; $i++)
								{
?>
									<td class="cell filler">X</td>
<?php
								}
							}
						}
?>
						</tr>
<?php
						}
					}
?>
				</table>
			</div>
<?php
			}
?>			
		</main>
	</body>
</html>