-- Anmeldung bei MariaDB in Xampp

mysql -u root

CREATE DATABASE IF NOT EXISTS kursplanung;

USE kursplanung;

-- als erstes die Tabellen erstellen die keinen Fremdschlüssel enthalten

CREATE TABLE IF NOT EXISTS trainer(
trainerid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
vorname VARCHAR(100) NOT NULL,
nachname VARCHAR(100) NOT NULL,
email VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS kursvorlage(
kursvorlageid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
kursvorlagenname VARCHAR(100) NOT NULL,
description TEXT
);
	
CREATE TABLE IF NOT EXISTS admins(
admindid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
vorname	 VARCHAR(100) NOT NULL,
nachname VARCHAR(100) NOT NULL,
email VARCHAR(100) NOT NULL,
pwhash VARCHAR(100) NOT NULL,
username VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS zeitzuweisung(
zeitzuweisungid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
startdatum DATE NOT NULL,
enddatum DATE
);
	
CREATE TABLE IF NOT EXISTS moduldauer(
dauerid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
dauer INTEGER NOT NULL
);	

CREATE TABLE IF NOT EXISTS schwerpunktthemen(
schwerpunktthemenid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
schwerpunktthemenname VARCHAR(100) NOT NULL,
description TEXT
);

CREATE TABLE IF NOT EXISTS lernfelder(
lernfeldid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
lernfeldname VARCHAR(100) NOT NULL,
description TEXT
);	

-- nun damit beginnen die Tabellen mit FK zu erstellen.

CREATE TABLE IF NOT EXISTS trainerurlaub(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
trainerid INTEGER UNSIGNED NOT NULL,
urlaubstart DATE NOT NULL,
urlaubende DATE,
FOREIGN KEY (trainerid) REFERENCES trainer(trainerid)
);

CREATE TABLE IF NOT EXISTS lernfelderschwerpunktthemen(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
lernfeldid INTEGER UNSIGNED NOT NULL,
schwerpunktthemenid INTEGER UNSIGNED NOT NULL,
FOREIGN KEY (lernfeldid) REFERENCES lernfelder(lernfeldid),
FOREIGN KEY (schwerpunktthemenid) REFERENCES schwerpunktthemen(schwerpunktthemenid)
);

CREATE TABLE IF NOT EXISTS trainerschwerpunktthemen(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
trainerid INTEGER UNSIGNED NOT NULL,
schwerpunktthemenid INTEGER UNSIGNED NOT NULL,
schwerpunktthementyp BOOLEAN NOT NULL,
FOREIGN KEY (trainerid) REFERENCES trainer(trainerid),
FOREIGN KEY (schwerpunktthemenid) REFERENCES schwerpunktthemen(schwerpunktthemenid)
);

CREATE TABLE IF NOT EXISTS trainerzeitzuweisung(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
trainerid INTEGER UNSIGNED NOT NULL,
kursid INTEGER UNSIGNED NOT NULL,
zeitzuweisungid INTEGER UNSIGNED NOT NULL,
FOREIGN KEY (zeitzuweisungid) REFERENCES zeitzuweisung(zeitzuweisungid),
FOREIGN KEY (trainerid) REFERENCES trainer(trainerid)
);

CREATE TABLE IF NOT EXISTS kurse(
kursid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
klassenname VARCHAR(100) NOT NULL,
startdatum DATE NOT NULL,
kursvorlageid INTEGER UNSIGNED NOT NULL,
FOREIGN KEY (kursvorlageid) REFERENCES kursvorlage(kursvorlageid)
);

CREATE TABLE IF NOT EXISTS kurstrainer(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
kursid INTEGER UNSIGNED NOT NULL,
trainerid INTEGER UNSIGNED NOT NULL,
FOREIGN KEY (kursid) REFERENCES kurse(kursid),
FOREIGN KEY (trainerid) REFERENCES trainer(trainerid)
);

CREATE TABLE IF NOT EXISTS kurseurlaub(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
kursid INTEGER UNSIGNED NOT NULL,
urlaubsstart DATE NOT NULL,
urlaubende DATE,
FOREIGN KEY (kursid) REFERENCES kurse(kursid)
);

CREATE TABLE IF NOT EXISTS trainerlernfelder(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
trainerid INTEGER UNSIGNED NOT NULL,
lernfeldid INTEGER UNSIGNED NOT NULL,
lernfeldtyp BOOLEAN NOT NULL,
FOREIGN KEY (lernfeldid) REFERENCES lernfelder(lernfeldid),
FOREIGN KEY (trainerid) REFERENCES trainer(trainerid)
);

CREATE TABLE IF NOT EXISTS modul(
modulid INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
modulname VARCHAR(100) NOT NULL,
dauerid INTEGER UNSIGNED NOT NULL,
FOREIGN KEY (dauerid) REFERENCES moduldauer(dauerid)
);

CREATE TABLE IF NOT EXISTS kursvorlagemodule(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
kursvorlageid INTEGER UNSIGNED NOT NULL,
modulid INTEGER UNSIGNED NOT NULL,
FOREIGN KEY (kursvorlageid) REFERENCES kursvorlage(kursvorlageid),
FOREIGN KEY (modulid) REFERENCES modul(modulid)
);

CREATE TABLE IF NOT EXISTS modullernfelder(
id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
modulid INTEGER UNSIGNED NOT NULL,
lernfeldid INTEGER UNSIGNED NOT NULL,
FOREIGN KEY (modulid) REFERENCES modul(modulid),
FOREIGN KEY (lernfeldid) REFERENCES lernfelder(lernfeldid)
);












