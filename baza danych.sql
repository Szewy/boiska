/* Stworzenie tabeli boiska */
CREATE TABLE `boiska`.`boiska` ( `id_boiska` INT UNSIGNED NOT NULL AUTO_INCREMENT , `id_typu` INT UNSIGNED NOT NULL , `powierzchnia` INT UNSIGNED NOT NULL , PRIMARY KEY (`id_boiska`)) ENGINE = InnoDB;

/* Stworzenie tabeli typ_boiska */
CREATE TABLE `boiska`.`typ_boiska` ( `id_typu` INT UNSIGNED NOT NULL AUTO_INCREMENT , `typ` VARCHAR(30) NOT NULL , PRIMARY KEY (`id_typu`)) ENGINE = InnoDB;

/* Wype³nienie tabeli typ_boiska */
INSERT INTO `typ_boiska` (`id_typu`, `typ`) VALUES (NULL, 'pi³ka no¿na'), (NULL, 'siatkówka'), (NULL, 'koszykówka'), (NULL, 'pi³ka rêczna'), (NULL, 'siatkówka pla¿owa')

/* Wype³nienie tabeli boiska */
INSERT INTO `boiska` (`id_boiska`, `id_typu`, `powierzchnia`) VALUES (NULL, '1', '120'), (NULL, '2', '80'), (NULL, '2', '90'), (NULL, '3', '122'), (NULL, '5', '32'), (NULL, '5', '73'), (NULL, '3', '38'), (NULL, '4', '43'), (NULL, '4', '78'), (NULL, '3', '233'), (NULL, '2', '100'), (NULL, '1', '120'), (NULL, '1', '7140'), (NULL, '1', '7140'), (NULL, '2', '288'), (NULL, '1', '7140'), (NULL, '2', '500'), (NULL, '3', '322'), (NULL, '1', '7140'), (NULL, '1', '7140')

/* Stworzenie tabeli rezerwacje */
CREATE TABLE `boiska`.`rezerwacje` ( `id_rezerwacji` INT UNSIGNED NOT NULL AUTO_INCREMENT , `id_uzytkownika` INT UNSIGNED NOT NULL , `id_boiska` INT UNSIGNED NOT NULL , `data` DATE NOT NULL , `godzina_od` TIME NOT NULL , `godzina_do` TIME NOT NULL , PRIMARY KEY (`id_rezerwacji`)) ENGINE = InnoDB;

/* Stworzenie tabeli grafik */
CREATE TABLE `boiska`.`grafik` ( `id_grafiku` INT UNSIGNED NOT NULL AUTO_INCREMENT , `id_pracownika` INT UNSIGNED NOT NULL , `data` DATE NOT NULL , `godzina_od` TIME NOT NULL , `godzina_do` TIME NOT NULL , PRIMARY KEY (`id_grafiku `)) ENGINE = InnoDB;

/* Wype³nienie tabeli rezerwacje */
INSERT INTO `rezerwacje` (`id_rezerwacji`, `id_uzytkownika`, `id_boiska`, `data`, `godzina_od`, `godzina_do`) VALUES (NULL, '1', '16', '2018-01-19', '9:00:00', '10:00:00'), (NULL, '1', '16', '2018-01-19', '18:00:00', '19:00:00');

/* Wype³nienie tabeli grafik */
INSERT INTO `grafik` (`id_grafiku`, `id_pracownika`, `data`, `godzina_od`, `godzina_do`) VALUES (NULL, '1', '2018-01-19', '8:00:00', '22:00:00'), (NULL, '1', '2018-01-18', '10:00:00', '18:00:00');

/* Stworzenie tabeli uzytkownicy */
CREATE TABLE `boiska`.`uzytkownicy` ( `id_uzytkownika` INT UNSIGNED NOT NULL AUTO_INCREMENT , `login` VARCHAR(30) NOT NULL , `haslo` VARCHAR(30) NOT NULL , `imie` VARCHAR(30) NOT NULL , `nazwisko` VARCHAR(40) NOT NULL , `admin` BOOLEAN NOT NULL DEFAULT FALSE , `pracownik` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id_uzytkownika`)) ENGINE = InnoDB;

/* Wype³nienie tabeli uzytkownicy */
INSERT INTO `uzytkownicy` (`id_uzytkownika`, `login`, `haslo`, `imie`, `nazwisko`, `admin`, `pracownik`) VALUES(1, 'adrian', '12345678', 'Adrian', 'Szewczyk', 1, 1),(2, 'maciej', '1234', 'Maciek', 'Asdf', 0, 1),(3, 'darek', '4321', 'Dariusz', 'Fdsa', 0, 0);