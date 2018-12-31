<?php

/**
 * language: pl
 * encoding: utf-8
 * author: Micha� Hyla
 */

//page title
$lang['title'] = "Lista egzamin�w";

//examdirectory.online/index.php
$lang['welcome1'] = "Witaj na examdirectory.online";
$lang['welcome2'] = "Kliknij poni�szy przycisk, aby przej�� dalej.";
$lang['enter'] = "Przejd� dalej";
$lang['news'] = "Informacje";

//examdirectory.online/scripts/login.php
$lang['logIn'] = "Zaloguj si�";
$lang['name'] = "Nazwa";
$lang['pass'] = "Has�o";
$lang['newAccountText'] = "Nie masz jeszcze konta? Zarejestruj si�.";
$lang['successfulLogin'] = "Pomy�lnie zalogowano.";
$lang['passFailLogin'] = "Niepoprawne has�o";
$lang['nameFailLogin'] = "U�ytkownik o tej nazwie nie istnieje.";
$lang['hereLink'] = "tutaj";

//examdirectory.online/scripts/register.php
$lang['register'] = "Zarejestruj si�";
$lang['repeatPass'] = "Powt�rz has�o.";
$lang['e-mail'] = "E-mail";
$lang['termsText'] = "Zgadzam si� z";
$lang['termsLink'] = "zasadami strony.";
$lang['logInText'] = "Masz ju� konto? Zaloguj si�. ";
$lang['successfulRegister'] = "Zarejestrowano pomy�lnie.";
$lang['termsFailRegister'] = "Musisz zaakceptowa� zasady serwisu.";
$lang['shortNameFailRegister'] = "Nazwa musi sk�ada� si� z co najmniej 4 znak�w.";
$lang['longNameFailRegister'] = "Nazwa nie mo�e mie� wi�cej ni� 16 znak�w.";
$lang['duplicateNameFailRegister'] = "U�ytkownik o podanej nazwie ju� istnieje.";
$lang['shortPassFailRegister'] = "Has�o musi sk�ada� si� z co najmniej 4 znak�w.";
$lang['longPassFailRegister'] = "Has�o nie mo�e mie� wi�cej ni� 16 znak�w.";
$lang['unequalPassFailRegister'] = "Has�a nie s� jednakowe.";
$lang['noDigitInPassFailRegister'] = "Has�o musi zawiera� co najmniej 1 cyfr�.";
$lang['noLowercaseInPassFailRegister'] = "Has�o musi zawiera� co najmniej 1 ma�� liter�.";
$lang['noUppercaseInPassFailRegister'] = "Has�o musi zawiera� co najmniej 1 du�� liter�.";
$lang['invalidEmailFailRegister'] = "Podany email jest nieprawid�owy.";
$lang['longEmailFailRegister'] = "Email nie mo�e mie� wi�cej ni� 64 znaki.";
$lang['duplicateEmailFailRegister'] = "Ten email jest zaj�ty przez innego u�ytkownika.";
$lang['unknownFailRegister'] = "Wyst�pi� b��d. Powt�rz swoj� pr�b� p�niej lub skontaktuj si� z administratorem strony [honza.stech@gmail.com].";

//header on pages requiring a logged user
$lang['headerText'] = "Jeste� zalogowany, jako";
$lang['logOut'] = "Wyloguj si�.";
$lang['info'] = "Informacje";
$lang['home'] = "Strona g��wna";
$lang['class'] = "Klasa";
$lang['classManagement'] = "Zarz�dzanie klas�.";

//examdirectory.online/scripts/home.php
$lang['homeHeader'] = "Jeste� cz�onkiem tych klas:";
$lang['notMemberInAnyClass'] = "Nie jeste� cz�onkiem �adnej klasy.";
$lang['admin'] = "Administrator";
$lang['mod'] = "Moderator";
$lang['member'] = "Cz�onek";
$lang['apply'] = "Z�� wniosek o przyj�cie do istniej�cej klasy.";
$lang['newClass'] = "Stw�rz now� klas�.";

//examdirectory.online/scripts/list.php
$lang['noRecord'] = "Brak zapis�w";
$lang['date'] = "Data";
$lang['subject'] = "Przedmiot";
$lang['desc'] = "Opis";
$lang['author'] = "Dodane przez:";
$lang['dateOfAdding'] = "Data dodania";
$lang['action'] = "Inne";
$lang['upvote'] = "Lubi� to";
$lang['edit'] = "Edytuj";
$lang['delete'] = "Usu�";
$lang['newRecord'] = "Dodaj now� pozycj�";
$lang['descPlaceholder'] = "Wprowad� tekst";
$lang['priority'] = "Waga";
$lang['confirm'] = "Zatwierd�";
$lang['cancel'] = "Cofnij";

//examdirectory.online/scripts/apply.php
$lang['applyLore'] = "Wybierz klas�, do kt�rej chcesz do��czy�, i podaj swoje dane, jako informacje dla administratora lub moderatora klasy, kt�ry b�dzie musia� zaakceptowa� tw�j wniosek.";
$lang['meberInAll'] = "Jeste� ju� cz�onkiem we wszystkich istniej�cych klasach.";
$lang['fName'] = "Pierwsze imi�";
$lang['lName'] = "Nazwisko";
$lang['applyPlaceholder'] = "Tre�� wniosku.";
$lang['applyValue'] = "Cze��. Chcia�bym do��czy� do twojej klasy. Prosz�, czy m�g�by� zatwierdzi� m�j wniosek?";
$lang['applicationSend'] = "Wy�lij wniosek";
$lang['applyEmailSubject1'] = "Nowy wniosek o przyj�cie do klasy";
$lang['applyEmailSubject2'] = "od";
$lang['applyEmailHeader'] = "Szczeg�y wniosku";
$lang['applyEmailLore1'] = "Mo�esz zatwierdzi� lub odrzuci� ten wniosek w zak�adce zarz�dzania klas�.";
$lang['applyEmailLore2'] = "Zatwierd� ten wniosek jedynie w przypadku, gdy jeste� pewien, kim jest ten u�ytkownik.";
$lang['EmailBottomLore'] = "Ten email zosta� wygenerowany automatycznie, wi�c nie odpowiadaj na niego.";
$lang['applyEmailFooter1'] = "Nie chcesz dostawa� od nas wi�cej emaili? Przesta� nas subskrybowa�.";
$lang['applyEmailFooter2'] = "Przestaniesz otrzymywa� od nas tylko automatycznie wygenerowane emaile. Je�li wy�lesz nam swoj� opinie, pytanie lub sugestie, nadal b�dzie m�g� otrzyma� pisemn� odpowied� administratora.";
$lang['applyAlertText'] = "Tw�j wniosek o przyj�cie do tej klasy zosta� wys�any. Dowiesz si� o decyzji administratora lub moderatora klasy na swoim emailu.";

//examdirectory.online/scripts/newClass.php
$lang['newClassHeader'] = "Z�� wniosek o stworzenie nowej klasy.";
$lang['newClassLore1'] = "Aby unikn�� tworzenia niepotrzebnych i pustych klas oraz zape�niania ograniczonej przestrzeni, musisz wype�ni� ten wniosek.";
$lang['newClassLore2'] = "Dalsza komunikacja b�dzia odbywa� si� za pomoc� emaila, zatem prosz� upewni� si�, czy poda�o si� poprawny adres email.";
$lang['newClassLore3'] = "Stworzenie klasy jest bezp�atne, tak jak wszystkie inne funkcje.";
$lang['school'] = "Szko�a";
$lang['newClassPlaceholder'] = "Tre�� wniosku";
$lang['newClassAlertText'] = "Tw�j wniosek o stworzenie nowej klasy zosta� wys�any. Administrator strony skontaktuje si� z tob� emaila. ";

//examdirectory.online/scripts/classManagement.php
$lang['generalTab'] = "Podstawy";
$lang['subjectsTab'] = "Zarz�dzanie przedmiotami";
$lang['membersTab'] = "Zarz�dzanie cz�onkami";
$lang['applicationsTab'] = "Wnioski o przyj�cie";
$lang['classId'] = "ID klasy";
$lang['className'] = "Nazwa klasy";
$lang['changeButton'] = "Zmie�";
$lang['saveButton'] = "Zapisz";
$lang['classStatus'] = "Status klasy";
$lang['openedClass'] = "Otwarta - mo�na ubiega� si� o do��czenie do klasy";
$lang['closedClass'] = "Zamkni�ta - nie mo�na ubiega� si� o do��czenie do klasy";
$lang['openButton'] = "Otw�rz klas�";
$lang['lockButton'] = "Zamknij klas�";
$lang['classLockAlertText'] = "Klasa zosta�a zamkni�ta. Czy chcesz odrzuci� i usun�� wszystkie wnioski o do��czenie do klasy?";
$lang['deleteClassPassword1'] = "Potrzebna jest weryfikacja za pomoc� has�a administratora.";
$lang['deleteClassPassword2'] = "Wpisz swoje has�o i kliknij przycisk \"OK\", aby kontynuowa�.";
$lang['deleteClassFinal1'] = "To dzia�anie jest nieodwracalne. Twoja klasa zostanie na sta�e usuni�ta z bazy danych.";
$lang['deleteClassFinal2'] = "B�dziesz m�g� zatrzyma� proces kasowania na tej stronie internetowej w ci�gu najbli�szych 24 godzin."
$lang['editSubjects'] = "Edytuj przedmiot";
$lang['nickname'] = "Pseudonim";
$lang['approve'] = "Zatwierd�";
$lang['reject'] = "Odrzu�";
$lang['classManagementEmailSubject'] = "Wniosek o przyj�cie do klasy.";
$lang['classManagementEmailSuccessLore1'] = "Gratulacje, ";
$lang['classManagementEmailFailLore1'] = "Przykro nam, ";
$lang['classManagementEmailLore2'] = "tw�j wniosek o przyj�cie do klasy ";
$lang['classManagementEmailSuccessLore3'] = "zosta� pozytywnie rozpatrzony";
$lang['classManagementEmailFailLore3'] = "zosta� odrzucony.";
$lang['classManagementEmailLore4'] = "Tw�j wniosek zosta� rozpatrzony przez ";
$lang['classManagementEmailSuccessFooter1'] = "Mo�esz wys�a� wi�cej wniosk�w o przyj�cie do innych klas na stronie examdirectory.online.";
$lang['classManagementEmailFailFooter1'] = "Mo�esz wys�a� nowy wniosek o przyj�cie do klasy na stronie examdirectory.online.";
$lang['classManagementEmailSuccessFooter2'] = "Je�li chcesz opu�ci� klas�, mo�esz to zrobi� na stronie z listami klas.";
$lang['classManagementEmailFailFooter2'] = "Je�li chcesz ponownie ubiega� si� o przyj�cie do tej samej klasy, zalecamy napisanie lepszego wniosku o przyj�cie.";
