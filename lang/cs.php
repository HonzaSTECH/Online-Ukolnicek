<?php

/**
 * language: cs
 * encoding: utf-8
 * author: Jan Štěch
 */

//page title
$lang['title'] = "Seznam testů";

//examdirectory.online/index.php
$lang['welcome1'] = "Vítej na examdirectory.online";
$lang['welcome2'] = "Pro pokračování klikni na tlačítko";
$lang['enter'] = "Vstoupit";
$lang['news'] = "Novinky";

//examdirectory.online/scripts/login.php
$lang['logIn'] = "Přihlásit se";
$lang['name'] = "Jméno";
$lang['pass'] = "Heslo";
$lang['newAccountText'] = "Ještě nemáš účet? Zaregistruj se ";
$lang['successfulLogin'] = "Byl jsi úspěšně přihlášen.";
$lang['passFailLogin'] = "Nesprávné heslo";
$lang['nameFailLogin'] = "Uživatel s tímto jménem neexistuje.";
$lang['hereLink'] = "zde";
$lang['fullstop'] = ".";

//examdirectory.online/scripts/register.php
$lang['register'] = "Zaregistrovat se";
$lang['repeatPass'] = "Heslo znovu";
$lang['e-mail'] = "E-mail";
$lang['termsText'] = "Souhlasím s";
$lang['termsLink'] = "podmínkami služeb";
$lang['logInText'] = "Už máš účet? Přihlaš se ";
$lang['successfulRegister'] = "Byl jsi úspěšně zaregistrován.";
$lang['termsFailRegister'] = "Musíš souhlasit s podmínkami služby.";
$lang['shortNameFailRegister'] = "Jméno musí být alespoň 4 znaky dlouhé.";
$lang['longNameFailRegister'] = "Jméno nesmí být více než 16 znaků dlouhé.";
$lang['duplicateNameFailRegister'] = "Toto jméno je již používáno jiným uživatelem.";
$lang['shortPassFailRegister'] = "Heslo musí být alespoň 6 znaků dlouhé.";
$lang['longPassFailRegister'] = "Heslo nemůže být více než 32 znaků dlouhé.";
$lang['unequalPassFailRegister'] = "Hesla se neshodují.";
$lang['noDigitInPassFailRegister'] = "Heslo musí obsahovat alespoň jednu číslici.";
$lang['noLowercaseInPassFailRegister'] = "Heslo musí obsahovat alespoň jedno malé písmeno.";
$lang['noUppercaseInPassFailRegister'] = "Heslo musí obsahovat alespoň jedno velké písmeno.";
$lang['invalidEmailFailRegister'] = "Zadaná e-mailová adresa není platná.";
$lang['longEmailFailRegister'] = "Tvůj e-mail nesmí být více než 64 znaků dlouhý.";
$lang['duplicateEmailFailRegister'] = "Tento e-mail je již používán jiným uživatelem.";
$lang['unknownFailRegister'] = "Vyskytla se chyba. Zkus to znovu později, nebo kontaktuj webmastera na e-mailové adrese honza.stech@gmail.com.";

//header on pages requiring a logged user
$lang['headerText'] = "Jsi přiihlášen jako ";
$lang['logOut'] = "Odhlásit se";
$lang['info'] = "Informace";
$lang['home'] = "Domů";
$lang['class'] = "Třída";
$lang['classManagement'] = "Správa třídy";

//examdirectory.online/scripts/home.php
$lang['homeHeader'] = "Jsi členem v těchto třídách:";
$lang['notMemberInAnyClass'] = "Nejsi členem žádné třídy.";
$lang['admin'] = "Správce";
$lang['mod'] = "Moderátor";
$lang['member'] = "Člen";
$lang['apply'] = "Zažádat o přijetí do existující třídy";
$lang['newClass'] = "Založit novou třídu";

//examdirectory.online/scripts/list.php
$lang['noRecord'] = "Žádné záznamy";
$lang['date'] = "Datum";
$lang['subject'] = "Předmět";
$lang['desc'] = "Popis";
$lang['author'] = "Přidal/a";
$lang['dateOfAdding'] = "Přidáno";
$lang['action'] = "Akce";
$lang['upvote'] = "Líbí se";
$lang['edit'] = "Upravit";
$lang['delete'] = "Smazat";
$lang['confirmDelete'] = "Opravdu chceš smazat tento záznam? Tato akce je nevratná!";
$lang['newRecord'] = "Přidat záznam";
$lang['descPlaceholder'] = "Opakovací test";
$lang['priority'] = "Priorita";
$lang['confirm'] = "Potvrdit";
$lang['cancel'] = "Zrušit";

//examdirectory.online/scripts/apply.php
$lang['applyLore'] = "Vyber si třídu do které se chceš přidat a zadej osobní údaje jako informace pro adminitrátora nebo moderátory třídy, kteří budou muset tvojí žádost o přijetí potvrdit.";
$lang['meberInAll'] = "Už jsi členem všech existujících tříd.";
$lang['fName'] = "Jméno";
$lang['lName'] = "Přijímení";
$lang['applyPlaceholder'] = "Text žádosti";
$lang['applyValue'] = "Ahoj. Rád bych se připojil/a do vaší třídy. Potvrdíte prosím mojí žádost?";
$lang['applicationSend'] = "Odeslat žádost";
$lang['applyEmailSubject1'] = "Nová žádost o přijetí do třídy ";
$lang['applyEmailSubject2'] = " od ";
$lang['applyEmailHeader'] = "Detaily žádosti";
$lang['applyEmailLore1'] = "Žádost můžete přijmout nebo zamítnout na stránce se správou třídy.";
$lang['applyEmailLore2'] = "Tuto Žadost schvalte pouze v případě, že jste si jistí kdo tento uživatel ve skutečnosti je.";
$lang['EmailBottomLore'] = "Tento e-mail byl vygenerován automaticky a tudíž na něj neodpovídejte.";
$lang['applyEmailFooter1'] = "Nechcete od nás dostávat další e-maily? Odhlašte se z odběru e-mailů ";
$lang['applyEmailFooter2'] = "Toto zruší pouze automaticky odesílané e-maily. Pokud odešlete dotaz nebo připomínku, stále můžete dostat webmasterem psanou odpověď.";
$lang['applyAlertText'] = "Vaše žádost o přijetí do této třídy byla odeslána. O přijetí nebo zamítnutí požadavku se dozvíte pomocí e-mailu.";

//examdirectory.online/scripts/newClass.php
$lang['newClassHeader'] = "Zažádat o vytvoření nové třídy";
$lang['newClassLore1'] = "Z důvodu zamezení zakládání nepotřebných a prázdných tříd a zaplňování omezeného místa v naší databázi je nutné k založení třídy vyplnit tento formulář.";
$lang['newClassLore2'] = "Další komunikace bude probíhat prostřednictvím e-mailu, proto se prosím ujistěte, že jste zadali správnou e-mailovou adresu.";
$lang['newClassLore3'] = "Založení třídy je stejně jako všechny ostatní funkce bezplatné.";
$lang['school'] = "Škola";
$lang['newClassPlaceholder'] = "Text žádosti";
$lang['newClassAlertText'] = "Vaše žádost o založení nové třídy byla odeslána. Na vámi specifikované e-mailové adrese budete kontaktování správcem služby.";

//examdirectory.online/scripts/classManagement.php
$lang['generalTab'] = "Obecné";
$lang['subjectsTab'] = "Správa předmětů";
$lang['membersTab'] = "Správa členů";
$lang['applicationsTab'] = "Žádosti o přijetí";
$lang['classId'] = "ID třídy";
$lang['className'] = "Jméno třídy";
$lang['changeButton'] = "Změnit";
$lang['saveButton'] = "Uložit";
$lang['classStatus'] = "Status třídy:";
$lang['openedClass'] = "Otevřená - žádosti o přijetí jsou zapnuty";
$lang['closedClass'] = "Uzavřená - uživatelé nemohou odeslat žádost o přijetí do vaší třídy";
$lang['openButton'] = "Otevřít třídu";
$lang['lockButton'] = "Uzavřít třídu";
$lang['classLockAlertText'] = "Třída byla uzavřena. Přejete si odmítnout a odstranit všechny čekající žádosti o přijetí do vaší třídy?";
$lang['deleteButton'] = "Smazat třídu";
$lang['timeToDelete'] = "Čas do smazání: ";
$lang['stopDelete'] = "Zrušit smazání třídy";
$lang['deleteClassPassword1'] = "Tato akce vyžaduje potvrzení vašeho správcovského hesla.";
$lang['deleteClassPassword2'] = "Zadejte své heslo a pokračujte kliknutím na OK.";
$lang['deleteClassFinal1'] = "Tato akce je nevratná. Vaše třída bude trvale odstraněna z databáze.";
$lang['deleteClassFinal2'] = "Smazání třídy budete moci odvolat během následujících 24 hodin na této stránce.";
$lang['subjectNotSet'] = "Předmět nenastaven";
$lang['editSubjects'] = "Upravit předměty";
$lang['memberKick'] = "Vyloučit";
$lang['kickConfirm'] = "Opravdu chcete vyloučit tohoto uživatele z vaší třídy?";
$lang['noApplications'] = "Žádné žádosti o přijetí.";
$lang['nickname'] = "Přezdívka";
$lang['approve'] = "Schválit";
$lang['reject'] = "Zamítnout";
$lang['classManagementEmailSubject'] = "Žádost o přijetí do třídy ";
$lang['classManagementEmailHeader'] = "Status vaší žádosti";
$lang['classManagementEmailSuccessLore1'] = "Gratulujeme, vaše žádost o přijetí do třídy ";
$lang['classManagementEmailFailLore1'] = "Je nám líto, ale vaše žádost o přijetí do třídy ";
$lang['classManagementEmailLore2'] = " byla ";
$lang['classManagementEmailSuccessLore3'] = "schválena";
$lang['classManagementEmailFailLore3'] = "zamítnuta";
$lang['classManagementEmailLore4'] = "Vaši žádost vyřizoval uživatel ";
$lang['classManagementEmailSuccessFooter1'] = "Další žádosti o přijetí můžete odeslat na examdirectory.online.";
$lang['classManagementEmailFailFooter1'] = "Můžete poslat novou žádost o přijetí na examdirectory.online.";
$lang['classManagementEmailSuccessFooter2'] = "Pokud budete chtít třídu opustit, můžete tak udělat na stránce se seznamem tříd.";
$lang['classManagementEmailFailFooter2'] = "Pokud chcete zažádat o přijetí to tétož třídy znovu, doporučujeme vám napsat lepší text žádosti.";
