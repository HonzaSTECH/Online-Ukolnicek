<?php
header('Content-type: text/html; charset=utf-8');
/**
 * language: pl
 * encoding: utf-8
 * author: Michał Hyla
 */

//page title
$lang['title'] = "Lista egzaminów";

//examdirectory.online/index.php
$lang['welcome1'] = "Witaj na examdirectory.online";
$lang['welcome2'] = "Kliknij poniższy przycisk, aby przejść dalej.";
$lang['enter'] = "Przejdź dalej";
$lang['news'] = "Informacje";

//examdirectory.online/scripts/login.php
$lang['logIn'] = "Zaloguj się";
$lang['name'] = "Nazwa";
$lang['pass'] = "Hasło";
$lang['newAccountText'] = "Nie masz jeszcze konta? Zarejestruj się ";
$lang['successfulLogin'] = "Pomyślnie zalogowano.";
$lang['passFailLogin'] = "Niepoprawne hasło";
$lang['nameFailLogin'] = "Użytkownik o tej nazwie nie istnieje.";
$lang['hereLink'] = "tutaj";
$lang['fullstop'] = ".";

//examdirectory.online/scripts/register.php
$lang['register'] = "Zarejestruj się";
$lang['repeatPass'] = "Powtórz hasło.";
$lang['e-mail'] = "E-mail";
$lang['termsText'] = "Zgadzam się z";
$lang['termsLink'] = "zasadami strony";
$lang['logInText'] = "Masz już konto? Zaloguj się ";
$lang['successfulRegister'] = "Zarejestrowano pomyślnie.";
$lang['termsFailRegister'] = "Musisz zaakceptować zasady serwisu.";
$lang['shortNameFailRegister'] = "Nazwa musi składać się z co najmniej 4 znaków.";
$lang['longNameFailRegister'] = "Nazwa nie może mieć więcej niż 16 znaków.";
$lang['duplicateNameFailRegister'] = "Użytkownik o podanej nazwie już istnieje.";
$lang['shortPassFailRegister'] = "Hasło musi składać się z co najmniej 6 znaków.";
$lang['longPassFailRegister'] = "Hasło nie może mieć więcej niż 32 znaków.";
$lang['unequalPassFailRegister'] = "Hasła nie są jednakowe.";
$lang['noDigitInPassFailRegister'] = "Hasło musi zawierać co najmniej 1 cyfrę.";
$lang['noLowercaseInPassFailRegister'] = "Hasło musi zawierać co najmniej 1 małą literę.";
$lang['noUppercaseInPassFailRegister'] = "Hasło musi zawierać co najmniej 1 dużą literę.";
$lang['invalidEmailFailRegister'] = "Podany email jest nieprawidłowy.";
$lang['longEmailFailRegister'] = "Email nie może mieć więcej niż 64 znaki.";
$lang['duplicateEmailFailRegister'] = "Ten email jest zajęty przez innego użytkownika.";
$lang['unknownFailRegister'] = "Wystąpił błąd. Powtórz swoją próbę później lub skontaktuj się z administratorem strony [honza.stech@gmail.com].";

//header on pages requiring a logged user
$lang['headerText'] = "Jesteś zalogowany, jako ";
$lang['logOut'] = "Wyloguj się";
$lang['info'] = "Informacje";
$lang['home'] = "Strona główna";
$lang['class'] = "Klasa";
$lang['classManagement'] = "Zarządzanie klasą";

//examdirectory.online/scripts/home.php
$lang['homeHeader'] = "Jesteś członkiem tych klas:";
$lang['notMemberInAnyClass'] = "Nie jesteś członkiem żadnej klasy.";
$lang['admin'] = "Administrator";
$lang['mod'] = "Moderator";
$lang['member'] = "Członek";
$lang['apply'] = "Złóż wniosek o przyjęcie do istniejącej klasy.";
$lang['newClass'] = "Stwórz nową klasę.";

//examdirectory.online/scripts/list.php
$lang['noRecord'] = "Brak zapisów";
$lang['date'] = "Data";
$lang['subject'] = "Przedmiot";
$lang['desc'] = "Opis";
$lang['author'] = "Dodane przez:";
$lang['dateOfAdding'] = "Data dodania";
$lang['action'] = "Inne";
$lang['upvote'] = "Lubię to";
$lang['edit'] = "Edytuj";
$lang['delete'] = "Usuń";
$lang['confirmDelete'] = "Czy naprawdę chcesz usunąć ten zapis? To działanie jest nieodwracalne!";
$lang['newRecord'] = "Dodaj nową pozycję";
$lang['descPlaceholder'] = "Opis egzaminu";
$lang['priority'] = "Waga";
$lang['confirm'] = "Zatwierdź";
$lang['cancel'] = "Cofnij";

//examdirectory.online/scripts/apply.php
$lang['applyLore'] = "Wybierz klasę, do której chcesz dołączyć, i podaj swoje dane, jako informacje dla administratora lub moderatora klasy, który będzie musiał zaakceptować twój wniosek.";
$lang['meberInAll'] = "Jesteś już członkiem we wszystkich istniejących klasach.";
$lang['fName'] = "Imię";
$lang['lName'] = "Nazwisko";
$lang['applyPlaceholder'] = "Treść wniosku";
$lang['applyValue'] = "Cześć. Chciałbym dołączyć do twojej klasy. Proszę, czy mógłbyś zatwierdzić mój wniosek?";
$lang['applicationSend'] = "Wyślij wniosek";
$lang['applyEmailSubject1'] = "Nowy wniosek o przyjęcie do klasy ";
$lang['applyEmailSubject2'] = " od ";
$lang['applyEmailHeader'] = "Szczegóły wniosku";
$lang['applyEmailLore1'] = "Możesz zatwierdzić lub odrzucić ten wniosek w zakładce zarządzania klasą.";
$lang['applyEmailLore2'] = "Zatwierdź ten wniosek jedynie w przypadku, gdy jesteś pewien, kim jest ten użytkownik.";
$lang['EmailBottomLore'] = "Ten email został wygenerowany automatycznie, więc nie odpowiadaj na niego.";
$lang['applyEmailFooter1'] = "Nie chcesz dostawać od nas więcej emaili? Przestań nas subskrybować ";
$lang['applyEmailFooter2'] = "Przestaniesz otrzymywać od nas tylko automatycznie wygenerowane emaile. Jeśli wyślesz nam swoją opinie, pytanie lub sugestie, nadal będzie mógł otrzymać pisemną odpowiedź administratora.";
$lang['applyAlertText'] = "Twój wniosek o przyjęcie do tej klasy został wysłany. Dowiesz się o decyzji administratora lub moderatora klasy na swoim emailu.";

//examdirectory.online/scripts/newClass.php
$lang['newClassHeader'] = "Złóż wniosek o stworzenie nowej klasy.";
$lang['newClassLore1'] = "Aby uniknąć tworzenia niepotrzebnych i pustych klas oraz zapełniania ograniczonej przestrzeni, musisz wypełnić ten wniosek.";
$lang['newClassLore2'] = "Dalsza komunikacja będzia odbywać się za pomocą emaila, zatem proszę upewnić się, czy podało się poprawny adres email.";
$lang['newClassLore3'] = "Stworzenie klasy jest bezpłatne, tak jak wszystkie inne funkcje.";
$lang['school'] = "Szkoła";
$lang['newClassPlaceholder'] = "Treść wniosku";
$lang['newClassAlertText'] = "Twój wniosek o stworzenie nowej klasy został wysłany. Administrator strony skontaktuje się z tobą za pomocą emaila.";

//examdirectory.online/scripts/classManagement.php
$lang['generalTab'] = "Podstawy";
$lang['subjectsTab'] = "Zarządzanie przedmiotami";
$lang['membersTab'] = "Zarządzanie członkami";
$lang['applicationsTab'] = "Wnioski o przyjęcie";
$lang['classId'] = "ID klasy";
$lang['className'] = "Nazwa klasy";
$lang['changeButton'] = "Zmień";
$lang['saveButton'] = "Zapisz";
$lang['classStatus'] = "Status klasy:";
$lang['openedClass'] = "Otwarta - można ubiegać się o dołączenie do klasy";
$lang['closedClass'] = "Zamknięta - nie można ubiegać się o dołączenie do klasy";
$lang['openButton'] = "Otwórz klasę";
$lang['lockButton'] = "Zamknij klasę";
$lang['classLockAlertText'] = "Klasa została zamknięta. Czy chcesz odrzucić i usunąć wszystkie wnioski o dołączenie do klasy?";
$lang['deleteButton'] = "Usuń klasę";
$lang['timeToDelete'] = "Czas do usunięcia: ";
$lang['stopDelete'] = "Zatrzymaj proces usuwania";
$lang['deleteClassPassword1'] = "Potrzebna jest weryfikacja za pomocą hasła administratora.";
$lang['deleteClassPassword2'] = "Wpisz swoje hasło i kliknij przycisk Zatwierdź, aby kontynuować.";
$lang['deleteClassFinal1'] = "To działanie jest nieodwracalne. Twoja klasa zostanie na stałe usunięta z bazy danych.";
$lang['deleteClassFinal2'] = "Będziesz mógł zatrzymać proces kasowania na tej stronie internetowej w ciągu najbliższych 24 godzin.";
$lang['subjectNotSet'] = "Nienazwany przedmiot";
$lang['editSubjects'] = "Edytuj przedmiot";
$lang['memberKick'] = "Wyrzuć";
$lang['kickConfirm'] = "Jesteś pewien, że chcesz wyrzucić tego użytkownika z klasy";
$lang['noApplications'] = "Brak wniosków o przyjęcie.";
$lang['nickname'] = "Pseudonim";
$lang['approve'] = "Zatwierdź";
$lang['reject'] = "Odrzuć";
$lang['classManagementEmailSubject'] = "Wniosek o przyjęcie do klasy.";
$lang['classManagementEmailHeader'] = "Status twojego wniosku";
$lang['classManagementEmailSuccessLore1'] = "Gratulacje, ";
$lang['classManagementEmailFailLore1'] = "Przykro nam, ";
$lang['classManagementEmailLore2'] = "twój wniosek o przyjęcie do klasy ";
$lang['classManagementEmailSuccessLore3'] = "został pozytywnie rozpatrzony";
$lang['classManagementEmailFailLore3'] = "został odrzucony.";
$lang['classManagementEmailLore4'] = "Twój wniosek został rozpatrzony przez ";
$lang['classManagementEmailSuccessFooter1'] = "Możesz wysłać więcej wniosków o przyjęcie do innych klas na stronie examdirectory.online.";
$lang['classManagementEmailFailFooter1'] = "Możesz wysłać nowy wniosek o przyjęcie do klasy na stronie examdirectory.online.";
$lang['classManagementEmailSuccessFooter2'] = "Jeśli chcesz opuścić klasę, możesz to zrobić na stronie z listami klas.";
$lang['classManagementEmailFailFooter2'] = "Jeśli chcesz ponownie ubiegać się o przyjęcie do tej samej klasy, zalecamy napisanie lepszego wniosku o przyjęcie.";
