<?php
/*
 *	Kurseditor FPA MWA Grp A - Exceptions.php
 *
 *	Diese Datei soll dazu dienen, Ausnahmen mit eigenem Ausnahmenamen zu Implementieren.
 *	Dadurch soll die Lesbarkeit des Codes versch. Klassen / Funktionen gesteigert werden,
 *	indem nur anhand des Names einer Ausnahme das Problem erkenntlich wird.
 *
 *	Rev: 1.01
 *
 *	Autor(en): Andreas Biester
 */
 
class ObjectSelfAdditionException extends Exception {}
class ObjectSelfRemovalException extends Exception {}
class InvalidObjectAdditionException extends Exception {}
class InvalidObjectRemovalException extends Exception {}
class ObjectAllreadyInCollectionException extends Exception {}
class ObjectNotInCollectionException extends Exception {}
class ObjectShouldNotBeUpdatedException extends Exception {}
?>