<?php
global $lang;

$lang['UAM_restricTitle'] = 'Einschränkungen für Registrierungen';
$lang['UAM_confirmTitle'] = 'Bestätigungen und Validierungen der Registrierung';
$lang['UAM_confirmTitle_d'] = '
- Informationen E-Mail generation<br>
- Registrieren und Validierung E-Mail generation<br>
- Gruppen oder Status automatisch Beitritt<br>
- Anmeldeschluss Validierung<br>
- Reminder per E-Mail generation<br>
...
';
$lang['UAM_miscTitle'] = 'Registrierung gefolgt und andere Optionen';
$lang['UAM_carexcTitle'] = 'Benutzernamen: Ausschluss von Zeichen';
$lang['UAM_carexcTitle_d'] = 'Es mag interessant sein, bestimmte Zeichen in Benutzernamen verbieten (Beispiel: verweigern Logins mit &quot;@&quot;). Diese Option erm&ouml;glicht es, Zeichen oder Zeichenfolge, Veranstaltungen auszuschlie&szlig;en.<br>
NB: Die Option kann auch ausschließen, ganze Wörter.
<br><br>
<b style=&quot;color: red;&quot;>Warnung: Diese Option hat keine Auswirkungen auf den Benutzernamen erstellt vor ihrer Aktivierung.</b>';
$lang['UAM_passwTitle'] = 'Stärkung des Sicherheitsniveaus von Kennwörtern';
$lang['UAM_passwTitle_d'] = 'Durch die Aktivierung dieser Option ist zwingend die Beschlagnahme eines Passwortes bei der Anmeldung und das Kennwort erfordert vom Besucher ausgewählt, um ein Mindestmaß an Komplexität gerecht zu werden. Wird der Schwellenwert nicht erreicht wird, die Gäste erzielt, und die Mindestpunktzahl erreicht werden soll angezeigt werden, zusammen mit Empfehlungen an den Wert dieser Gäste zu steigern.<br><br>
Es gibt Feldtest der Komplexität eines Passworts zu messen und sich leisten können, eine Vorstellung von der Partitur zu erhalten, um komplexe, kundenspezifische definieren.<br><br>
Hinweis: Die Gäste eines Passwortes ist auf der Grundlage mehrerer Parameter: Länge berechnet, die Art der verwendeten Zeichen (Buchstaben, Ziffern, Großbuchstaben, Kleinbuchstaben, Sonderzeichen). Ein Wert unter 100 wird als gering, zwischen 100 und 500, die Komplexität ist durchschnittlich, mehr als 500, die Sicherheit ist sehr gut.';
$lang['UAM_passwtestTitle'] = 'Prüfung der Komplexität eines Passworts';
$lang['UAM_passwtestTitle_d'] = 'Geben Sie das Kennwort zu testen, und klicken Sie auf &quot;Ergebnis Berechnung&quot;, um das Ergebnis zu sehen.';
$lang['UAM_passwadmTitle'] = 'Die Anwendung für Administratoren';
$lang['UAM_passwadmTitle_d'] = 'Ein Administrator kann einen Benutzer-Account erstellen, mit oder ohne Anwendung der Regel der Komplexität des Computings.<br><br>
Hinweis: Wenn der Benutzer erstellte Konto will Passwort zu ändern und Passwörter für die Benutzer Stärkung aktiv ist, wird es vorbehaltlich der Regel-Satz.';
$lang['UAM_mailexcTitle'] = 'Ausschluss von Mail-Domänen';
$lang['UAM_infomailTitle'] = 'Informationen E-Mail an Benutzer';
$lang['UAM_infomailTitle_d'] = 'Diese Option ermöglicht die Automatisierung Senden einer E-Mail-Informationen an einen Benutzer bei der Anmeldung oder bei Änderungen sein Passwort oder E-Mail-Adresse in ihrem Profil.<br><br>
Der Inhalt der Nachricht gesendet wird von einem anpassbaren Teil komponiert, um eine kleine Begrüßung und Einführung fester Bestandteil in denen die Login, Passwort und E-Mail-Adresse des Benutzers.';
$lang['UAM_infotxtTitle'] = 'Anpassen der Informationen per E-Mail';
$lang['UAM_confirmtxtTitle'] = 'Anpassen der E-Mail-Bestätigung';
$lang['UAM_confirmgrpTitle'] = 'Validation Gruppen';
$lang['UAM_confirmgrpTitle_d'] = '<b style=&quot;color: red;&quot;>WARNUNG: Validierung Gruppen setzt voraus, dass Sie mindestens einen Benutzer Gruppe angelegt haben und definiert ist &quot;by default&quot; im User-Gruppen Piwigo-Management.</b><br><br>
Die Gruppen sind validiert f&uuml;r den Einsatz in Verbindung mit der &quot;Best&auml;tigung der Anmeldung&quot;';
$lang['UAM_confirmstatTitle'] = 'Validation Satzung';
$lang['UAM_confirmstatTitle_d'] = '<b style=&quot;color: red;&quot;>WARNUNG: Die Verwendung des Status Validierung erfordert, dass Sie die &quot;Gast&quot;-Nutzer mit Standard-Einstellung (als User Template) f&uuml;r neu registrierte gehalten haben. Hinweis: Sie k&ouml;nnen einem anderen Benutzer als neue Vorlage f&uuml;r registrierte gesetzt. Bitte beachten Sie die Dokumentation des Piwigo f&uuml;r weitere Details.</b><br><br>
Die Satzung sind validiert f&uuml;r den Einsatz in Verbindung mit der &quot;Best&auml;tigung der Anmeldung&quot;';
$lang['UAM_validationlimitTitle'] = 'Anmeldeschluss Validierung beschränkt';
$lang['UAM_remailTitle'] = 'Erinnern Unvalidierte User';
$lang['UAM_remailtxt1Title'] = 'Reminder per E-Mail mit den neuen Schlüssel generiert';
$lang['UAM_remailtxt2Title'] = 'Reminder per E-Mail, ohne dass neue Schlüssel generiert';
$lang['UAM_ghosttrackerTitle'] = 'Geist Besucher-Management';
$lang['UAM_gttextTitle'] = 'Geist Tracker Erinnerungs-Nachricht';
$lang['UAM_lastvisitTitle'] = 'Tracking registrierte Benutzer';
$lang['UAM_lastvisitTitle_d'] = 'Dies aktiviert einen Tisch in der &quot;Tracking users&quot;-Reiter, die Mitglieder der Galerie aufgef&uuml;hrt sind und zum Zeitpunkt ihres letzten Besuch und verbrachte Zeit (Tage) seit ihrem letzten Besuch. Die &Uuml;berwachung ist rein informativ f&uuml;r den Administrator der Galerie.';
$lang['UAM_tipsTitle'] = 'Tipps und Beispiele';
$lang['UAM_tipsTitle_d'] = 'Tipps und verschiedene Anwendungsbeispiele';
$lang['UAM_userlistTitle'] = 'Tracking Benutzer';
$lang['UAM_usermanTitle'] = 'Tracking Validierungen';
$lang['UAM_gtTitle'] = 'Geist Besucher-Management';


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_adminconfmailTitle'] = 'Best&auml;tigung der Anmeldung f&uuml;r Administratoren';
$lang['UAM_adminconfmailTitle_d'] = 'Sie k&ouml;nnen diese Validierung deaktivieren nur f&uuml;r Benutzer-Accounts durch den Administrator &uuml;ber Piwigo\'s Benutzer-Management-Schnittstelle geschaffen.<br><br>
Bei Aktivierung dieser Option, E-Mail-Best&auml;tigung f&uuml;r die Registrierung wird f&uuml;r jeden Benutzer vom Administrator erstellt wurde gesendet werden.<br><br>
Durch die Deaktivierung dieser Option (Standard), nur die E-Mail-Informationen gesendet werden (wenn &quot;Informations-E-Mail an Benutzer&quot; aktiviert ist).';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_restricTitle_d'] = '
- Charaktere Ausgrenzung<br>
- Passwort Durchsetzung<br>
- E-Mail-Domänen Ausgrenzung<br>
...
';
$lang['UAM_userlistTitle_d'] = 'Diese Seite gibt es zur Information an den Administrator. Es zeigt eine Liste von allen Nutzern auf der Galerie zeigt das Datum und die Anzahl der Tage seit dem letzten Besuch registriert. Die Liste ist in aufsteigender Reihenfolge der Anzahl der Tage sortiert.
<br><br>
<b><u>Erst wenn der Geist Tracker aktiv ist</u></b>, wird die Anzahl der Tage ohne einen Besuch wie der folgende Farbcode nach dem Maximum in der Geist Tracker Optionen:
<br>
- <b style=&quot;color: lime;&quot;>Grün</b> : Wenn der Benutzer hat die Galerie <b style=&quot;color:lime;&quot;><u>weniger als 50%</u></b> besucht der angegebene H&ouml;chstzahl in der Geist-Tracker.<br>
- <b style=&quot;color: orange;&quot;>Orange</b> : Wenn der Benutzer hat die Galerie <b style=&quot;color:orange;&quot;><u>zwischen 50% und 99%</u></b> besucht der angegebene H&ouml;chstzahl in der Geist-Tracker.<br>
- <b style=&quot;color: red;&quot;>Rot</b> : Wenn der Benutzer hat die Galerie <b style=&quot;color:red;&quot;><u>f&uuml;r mehr als 100%</u></b> besucht der angegebene H&ouml;chstzahl in der Geist-Tracker. <b><u>In diesem Fall muss der Benutzer sich auch in der Geist-Tracker-Tabelle.</u></b><br>
<br>
Beispiel:
<br>
Die Höchstdauer von Geist Tracker ist so konfiguriert, dass 100 Tage.
<br>
Ein Benutzer wird in grün angezeigt, wenn er die Galerie für weniger als 50 Tagen besucht haben, in orange, wenn sein letzter Besuch stattgefunden hat zwischen 50 und 99 Tage und rot für 100 Tage und mehr.
<br><br>
<b>HINWEIS</b>: Die Liste wird nicht angezeigt, die nicht validiert ihrer Registrierung (falls die M&ouml;glichkeit der Validierung der Registrierung aktiviert ist). Diese Benutzer werden dann in besonderer Weise in der &quot;Tracking Validierungen verwaltet&quot; aus.
<br><br>
<b>Die Sortierung der Tabelle Function</b>: Sie können die Daten mit einem Klick auf die Spaltenüberschriften angezeigt. Halten Sie SHIFT-Taste, um Art bis zu 4 gleichzeitige maximale Spalten.';
$lang['UAM_usermanTitle_d'] = 'Wenn die Begrenzung der Frist für die Anmeldung aktiviert ist, finden Sie weiter unten die Liste der Benutzer, deren Validierung Eintragung erwartet wird, <b style=&quot;text-decoration: underline;&quot;>ob oder nicht</b> sind sie in der Zeit zu validieren.<br><br>
Das Datum der Eintragung wird in grün angezeigt, wenn der Benutzer unter dem betreffenden Frist wird auf seine Registrierung zu bestätigen. In diesem Fall ist die Validierung Schlüssel noch gültig ist, und wir können eine E-Mail mit oder ohne eine neue Validierung Schlüssel zu schicken.<br><br>
Wenn das Datum der Eintragung erscheint in Rot, die Validierung abgelaufen. In diesem Fall müssen Sie eine E-Mail mit der Regeneration der Validierung Schlüssel senden, wenn Sie dem Benutzer die Möglichkeit, ihre Anmeldung bestätigen möchten.<br><br>
In allen Fällen ist es möglich, manuell die Validierung Kraft.<br><br>
In dieser Ansicht können Sie:
<br><br>
- Löschen Sie manuell Konten <b>(Handbuch Drain)</b>
<br>
- Generieren Sie per E-Mail-Erinnerung <b>ohne</b> erzeugt einen neuen Schlüssel. Warnung: Senden Sie eine E-Mail-Erinnerung für die angestrebten Besucher. Diese Funktion kann nicht zurückgesetzt dem Zeitpunkt der Eintragung des angestrebten Besucher und das Zeitlimit ist weiterhin gültig.
<br>
- Generieren Sie per E-Mail-Erinnerung <b>mit</b> erzeugt einen neuen Schlüssel. Warnung: Senden Sie eine E-Mail-Erinnerung für die angestrebten Besucher. Diese Funktion setzt auch den Zeitpunkt der Eintragung des angestrebten Besucher, die die Frist für die Validierung erweitern entspricht.
<br>
- Senden einer Registrierung erwartet Validierung von Hand, auch wenn das Ablaufdatum überschritten ist <b>(zwingen Validierung)</b>.
<br><br>
<b>Die Sortierung der Tabelle Function</b> : Sie können die Daten mit einem Klick auf die Spaltenüberschriften angezeigt. Halten Sie SHIFT-Taste, um Art bis zu 4 gleichzeitige maximale Spalten.';
$lang['UAM_gtTitle_d'] = 'Als Ghost Tracker aktiviert ist und initialisiert wurde, finden Sie weiter unten die Liste der registrierten Besucher, die sich seit x Tagen zur&uuml;ckgegeben haben. &quot;x&quot; ist die Anzahl der Tage konfiguriert in der General-Setup. Dar&uuml;ber hinaus finden Sie eine Spalte angibt, ob eine E-Mail-Erinnerung hat, um die angestrebten Besucher gesendet wurde. So k&ouml;nnen Sie auf einen Blick sehen und zu behandeln Besucher, die nicht wegen der Erinnerung genommen haben.<br><br>In dieser Ansicht können Sie:
<br><br>
- Löschen Sie manuell Konten <b>(Handbuch Drain)</b>
<br>
- Generieren Sie per E-Mail-Erinnerung <b>mit dem Zurücksetzen der letzte Besuch date</b>. Dies erlaubt es, einen Platzhalter, um die angestrebten Besucher geben. Wenn der Besucher bereits eine Mahnung erhalten haben, durch nichts daran gehindert, eine neue Mail, die wieder zurückgesetzt werden, in der Tat übel, dem letzten Tag besuchen.
<br><br>
<b>Die Sortierung der Tabelle Function</b> : Sie können die Daten mit einem Klick auf die Spaltenüberschriften angezeigt. Halten Sie SHIFT-Taste, um Art bis zu 4 gleichzeitige maximale Spalten.';
$lang['UAM_confirmmailTitle'] = 'Die Bestätigung der Anmeldung';
/*TODO*/$lang['UAM_confirmmailTitle_d'] = 'This option allows a user to either confirm registration by clicking on a link received in an email sent upon registration or the administrator to manually activate the registration.<br><br>
In first case, the e-mail is composed of a customizable part to introduce a little welcome note and a fixed part containing the activation link that is generated from a random key that can possibly regenerate through the &quot;Tracking validations&quot; tab.<br><br>
<br><br>
In second case, <b><u>there is no validation key send by email!</u></b>. Visitors have to wait until an administrator validate them himself in &quot;Validation tracking&quot; tab. It\s recommanded to activate the Piwigo\'s option &quot;Email admins when a new user registers&quot; (see in Piwigo\'s configuration options) and to use the &quot;Information email to user&quot; to warn new registers to wait on their account activation.
<br>
<b style=&quot;color: red;&quot;>NB: Options &quot;Deadline for registration validation limited&quot; and &quot;Remind unvalidated users  &quot; have to be set to off when admin\'s manual validation is enabled.</b>
<br><br>
Diese Option ist in der Regel mit der automatischen Zuordnung der Gruppe und / oder Satzung verwendet. Zum Beispiel, ein Benutzer, der nicht validiert ihre Eintragung in eine bestimmte Gruppe von Nutzern eingestellt werden (mit oder ohne Einschr&auml;nkungen auf der Galerie), w&auml;hrend ein Benutzer, der seine Registrierung best&auml;tigt wird in einem &quot;normalen&quot; Gruppe eingestellt werden.';
$lang['UAM_RedirTitle'] = 'Umleitung auf &quot;Benutzerdaten&quot; Seite';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.15.6
$lang['UAM_RedirTitle_d'] = 'Diese Option automatisch umleiten ein registrierter Benutzer zum sein Benutzerdaten Seite nur bei seinem ersten Anschluss an die Galerie.<br><br>
Bitte beachten Sie: Dieses Feature funktioniert nicht für alle registrierten Nutzer. Diejenigen mit &quot;admin&quot;, &quot;Webmaster&quot; oder &quot;Generic&quot; Status sind ausgeschlossen.';
// --------- End: New or revised $lang ---- from version 2.15.6


// --------- Starting below: New or revised $lang ---- from version 2.16.0
$lang['UAM_confirmmail_custom1'] = 'Text der Best&auml;tigungs-Seite - Best&auml;tigung akzeptiert';
$lang['UAM_confirmmail_custom2'] = 'Text der Best&auml;tigungs-Seite - Best&auml;tigung abgelehnt';
$lang['UAM_miscTitle_d'] = '
- Automatische oder manuelle Verwaltung von Geist Benutzern<br>
- Gefolgt registrierte Benutzer<br>
- Nickname obligatorisch für Gäste Kommentare<br>
...
';
$lang['UAM_ghosttrackerTitle_d'] = 'Auch bekannt als &quot;Geist Tracker&quot;, wenn diese Funktion aktiviert ist, k&ouml;nnen Sie verwalten Ihre Besucher je nach der H&auml;ufigkeit ihrer Besuche. 2 Betriebsarten stehen zur Verfügung:
- Manuelle Verwaltung: Wenn die Zeit zwischen 2 Besuche erreicht ist, erscheint dem Besucher in der &quot;Ghost Tracker&quot; Table, an dem Sie in der Lage für die Besucher per E-Mail erinnern oder löschen ihn wird.<br><br>
- Automatisiertes Management: Wenn der Zeitraum zwischen 2 aufeinander folgenden Aufenthalte erreicht ist, wird der Besucher automatisch gelöscht oder verschoben in eine Gruppe warten und / oder Status. In diesem zweiten Fall kann eine Information E-Mail an ihn gesendet werden.<br><br>
<b style=&quot;color: red;&quot;>Wenn Sie diese Funktion zum ersten Mal oder haben Sie nach einem langen Zeitraum aus, in dem neue Besucher registriert sind, müssen Sie initialisieren, oder setzen Sie den Geist Tracker reaktiviert.</b>';
$lang['UAM_mailexcTitle_d'] = 'Standardmäßig akzeptiert Piwigo alle E-Mail-Adressen im Format xxx@yyy.zz. Durch die Aktivierung dieser Option können Sie auf bestimmte Domains im Format ausschließen: @[Domänenname].[Domain Extension].<br><br>
Beispiele:<br>
@hotmail.com -> Ausnahme-Adressen *@hotmail.com<br>
@hotmail -> ohne alle Adressen *@hotmail *';
$lang['UAM_GTAutoTitle'] = 'Automatische Verwaltung von Geist Benutzern';
$lang['UAM_GTAutoTitle_d'] = 'Diese Option ermöglicht es, Regeln für die automatisierte Verwaltung von Geistern Benutzer anwenden.
<br><br>Grundprinzip: Ein Benutzer, der die maximale Zeit zwischen den Besuchen <b><u>und</u></b> hat bereits per E-Mail gilt als abgelaufen gemeldet erreicht. Dann können Sie automatisierte Verarbeitung Regeln wie das automatische Löschen von abgelaufenen Konten oder Herabstufung durch Beschränkung des Zugangs zur Galerie (schaltet automatisch auf eine eingeschränkte Gruppe und / oder Status).
<br><br>Die Ansteuerung dieser Automatisierung wird erreicht, wenn eine Verbindung Nutzer (alle Benutzer!) Auf der Galerie.';
$lang['UAM_GTAutoDelTitle'] = 'Benutzerdefinierte Meldung auf gelöschtes Konto';
$lang['UAM_GTAutoGpTitle'] = 'Automatischer Wechsel der Gruppe / Status';
/*TODO*/$lang['UAM_GTAutoGpTitle_d'] = 'The automatic change of group or status equivalent to a demotion of the accounts involved and working on the same principle as the group or the status of validation (see &quot;Setting confirmations and validations of registration&quot;). Therefore be to define a group and / or status demoting access to the gallery. If this has already been defined with the use of registration confirmation function, you can use the same group / status.<br><br>
<b style=&quot;color: red;&quot;>Important note :</b> If a ghost user still has not heard from after the time limit and despite the automatic notification by email (if enabled), he\'s automatically deleted from the database.';
$lang['UAM_GTAutoMailTitle'] = 'Automatisches Versenden einer E-Mail beim Wechsel Gruppe / Status';
/*TODO*/$lang['UAM_GTAutoMailTitle_d'] = 'When an account is expired (group / status change demoting the visitor), an email information can be sent to clarify the reasons for this change and the means to recover the initial access to the gallery.
<br>To do this, a link to revalidation of registration is attached to the email (automatic generation of a new validation key).<b style=&quot;color: red;&quot;>If the user has already been notified, his account is automatically destroyed.</b> 
<br><br>Enter the custom text that also explain the reasons for the demotion, to accompany the validation link. The custom text is not mandatory but strongly recommended. In fact, your visitors will not appreciate receiving an email containing only a single link without further explanation. ;-)
<br><br>Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.
<br><br><b style=&quot;color: red;&quot;>Warning: The use of this function is intimately associated with the confirmation of registration by the user (confirmation by mail) and can not be activated without this option.</b>';
$lang['UAM_AdminValidationMail'] = 'Mitteilung der manuellen Registrierung Validierung';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
/*TODO*/$lang['UAM_CustomPasswRetrTitle'] = 'Customize lost password email content';
/*TODO*/$lang['UAM_validationlimitTitle_d'] = 'Diese Option ermöglicht es, die Gültigkeit der Schlüssel Validierung E-Mail-Grenze geschickt, um neue Registranten. Besucher, wer x Tage Zeit haben, um sich identifizieren, zu registrieren. Nach Ablauf dieser Frist die Validierung Link läuft.
<br><br>
Diese Option ist in Verbindung mit der &quot;Best&auml;tigung der Anmeldung verwendet&quot;
<br><br>
If this option and the option &quot;Erinnern Unvalidierte User&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/*TODO*/$lang['UAM_remailTitle_d'] = 'Mit dieser Option k&ouml;nnen Sie eine Erinnerung per E-Mail an registrierte Benutzer zu senden, aber noch nicht best&auml;tigt ihre Eintragung in die Zeit. Es funktioniert also in Verbindung mit der &quot;Best&auml;tigung der Anmeldung&quot;
<br><br>
2 Arten von E-Mails gesendet werden können: Mit oder ohne Regeneration der Validierung Schlüssel. Gegebenenfalls kann der Inhalt von E-Mails angepasst werden.
<br><br>
Wenden Sie sich an die &quot;Tracking Validierungen&quot; aus.
<br><br>
If this option and the option &quot;Anmeldeschluss Validierung beschränkt&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/*TODO*/$lang['UAM_USRAutoTitle'] = 'Automatic management of unvalidated users';
/*TODO*/$lang['UAM_USRAutoTitle_d'] = 'Automatic handling of unvalidated visitors is triggered each time you connect to the gallery and works as follows:
<br><br>
- Automatic deletion of accounts not validated in the allotted time without sending automatic email reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> and &quot;Remind unvalidated users&quot; <b><u>disabled</u></b>.
<br><br>
- Automatically sending a reminder message with a new generation of validation key and automatic deletion of accounts not validated in the time after sending the reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> et &quot;Remind unvalidated users&quot; <b><u>enabled</u></b>.';
/*TODO*/$lang['UAM_USRAutoDelTitle'] = 'Custom message on deleted account';
/*TODO*/$lang['UAM_USRAutoMailTitle'] = 'Automated email reminder';
/*TODO*/$lang['UAM_USRAutoMailTitle_d'] = 'When activated, this function will automatically send personalized content in &quot;Reminder email with new key generated&quot; to visitors who match criteria.';
$lang['UAM_StuffsTitle'] = 'PWG Stuffs Modul';
/*TODO*/$lang['UAM_StuffsTitle_d'] = 'This enables an additional UAM block in PWG Stuffs plugin (if installed) to inform your visitors who did not validate their registration about their condition.
<br><br>
Please refer to the <b>Tipps und Beispiele</b> at the bottom of this page for details.';
// --------- End: New or revised $lang ---- from version 2.20.0


// --------- Starting below: New or revised $lang ---- from version 2.20.3
$lang['UAM_DumpTitle'] = 'Sichern Sie Ihre Konfiguration';
$lang['UAM_DumpTitle_d'] = 'Dies ermöglicht Ihnen die gesamte Konfiguration des Plugins in eine Datei zu speichern damit Sie sie wiederherstellen können wenn etwas schief geht (falsche Manipulation oder vor einem Update, zum Beispiel). Standardmäßig wird die Datei in diesem Ordner gespeichert ../plugins/UserAdvManager/include/backup/ und heißt &quot;UAM_dbbackup.sql&quot;.
<br><br>
<b style=&quot;color: red;&quot;>Achtung: Die Datei wird überschrieben jedem Backup Aktion!</b>
<br><br>
Es kann manchmal nützlich sein, um die Backup-Datei auf Ihrem Computer abrufen. Zum Beispiel: Um zu einer anderen Datenbank auslagern wiederherzustellen oder zu halten mehrere Dateien speichern. Dazu markieren Sie das Kontrollkästchen, um die Datei herunterzuladen.
<br><br>
Die Erholung von dieser Schnittstelle wird nicht unterstützt. Verwenden Sie Tools wie phpMyAdmin.';
// --------- End: New or revised $lang ---- from version 2.20.3


// --------- Starting below: New or revised $lang ---- from version 2.20.4
$lang['UAM_HidePasswTitle'] = 'Passwort im Klartext in der Informations-E-Mail';
/*TODO*/$lang['UAM_HidePasswTitle_d'] = 'Choose here if you want to display the password chosen by the visitor in the information email. If you enable the option, the password will then appear in clear text. If you disable the password will not appear at all.';
// --------- End: New or revised $lang ---- from version 2.20.4


// --------- Starting below: New or revised $lang ---- from version 2.20.11
/*TODO*/$lang['UAM_gttextTitle_d'] = 'Geben Sie den gewünschten Text in die E-Mail-Erinnerung angezeigt, die Benutzer rechtzeitig, um wieder zur Galerie zu besuchen (Anm.: Der Text Fertigpen mit der Installation des Plugins ist als Beispiel vorgesehen).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options. Use <b style=&quot;color: red;&quot;>[days]</b> to insert the maximum numbers of days between two visits.
<br><br>
Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_confirmtxtTitle_d'] = 'Geben Sie den einleitenden Text, den Sie in der E-Mail-Bestätigung der Anmeldung erscheinen.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Anmeldeschluss Validierung beschränkt;&quot; have to be enabled).
<br><br>
Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_remailtxt1Title_d'] = 'Geben Sie den einleitenden Text, den Sie in der E-Mail-Erinnerung angezeigt wird, zusätzlich zu der Prüfschlüssel regeneriert.
<br><br>
Wenn leer, wird die E-Mail-Erinnerung nur den Bestätigungslink. Es wird daher dringend empfohlen, ein wenig erläuternden Text zu nehmen. (NB: Der Text Fertigpen mit der Installation des Plugins ist als Beispiel vorgesehen).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Anmeldeschluss Validierung beschränkt;&quot; have to be enabled).
<br><br>
Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_remailtxt2Title_d'] = 'Geben Sie den einleitenden Text, den Sie in der Erinnerung, ohne eine Bestätigung per E-Mail-Taste erscheinen regeneriert.
<br><br>
Wenn links leer ist, wird die E-Mail-Erinnerung leer sein. Es wird daher dringend empfohlen, ein wenig erläuternden Text zu nehmen. (NB: Der Text Fertigpen mit der Installation des Plugins ist als Beispiel vorgesehen).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Anmeldeschluss Validierung beschränkt;&quot; have to be enabled).
<br><br>
Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_infotxtTitle_d'] = 'Geben Sie den einleitenden Text, den Sie in der Informations-E-Mail angezeigt.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_AdminValidationMail_d'] = 'Wenn ein Administrator oder Webmaster der Galerie manuell gültige Registrierung anhängig ist, ist eine Benachrichtigungs-Email automatisch an den Benutzer gesendet. Geben Sie hier den Text ein, in dieser E-Mail angezeigt.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_confirmmail_custom1_d'] = 'Wenn die Option &quot;Bestätigung der Anmeldung&quot; aktiv ist, können Sie in diesem zu <b><u>Akzeptanz Text anpassen</u></b> auf der Anmeldebestätigung Seite angezeigt, wenn Benutzer auf den Bestätigungs-Link, die empfangen wurde per E-Mail.
<br><br>
Nach der Installation des Plugin ist ein Standard-Text als Beispiel vorangehen.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Dieses Feld ist kompatibel mit den FCK-Editor und, um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_confirmmail_custom2_d'] = 'Wenn die Option &quot;Bestätigung der Anmeldung&quot; aktiv ist, können Sie in diesem zu <b><u>rejectance Text anpassen</u></b> auf der Anmeldebestätigung Seite angezeigt, wenn Benutzer auf den Bestätigungs-Link, die empfangen wurde per E-Mail.
<br><br>
Nach der Installation des Plugin ist ein Standard-Text als Beispiel vorangehen.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Dieses Feld ist kompatibel mit den FCK-Editor und, um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_GTAutoDelTitle_d'] = 'Dies ist nur gültig, wenn der Benutzer, dessen Konto ist abgelaufen selbst löst die Streichung Mechanismus (selten, aber möglich). Er ist dann der Galerie getrennt und umgeleitet auf eine Seite mit der Löschung seines Accounts und gegebenenfalls die Gründe für die Streichung dieses Absatzes.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
<b style=&quot;color: red;&quot;>[username]</b> is not available here because concerned user has been deleted.
<br><br>
Custom Text für die Weiterleitungsseite können in dieses Feld eingegeben werden dass ist kompatibel mit den FCK-Editor und, um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.';
/*TODO*/$lang['UAM_GTAutoMailTitle_d'] = 'When an account is expired (group / status change demoting the visitor), an email information can be sent to clarify the reasons for this change and the means to recover the initial access to the gallery.
<br>To do this, a link to revalidation of registration is attached to the email (automatic generation of a new validation key).<b style=&quot;color: red;&quot;>If the user has already been notified, his account is automatically destroyed.</b> 
<br><br>
Enter the custom text that also explain the reasons for the demotion, to accompany the validation link. The custom text is not mandatory but strongly recommended. In fact, your visitors will not appreciate receiving an email containing only a single link without further explanation. ;-)
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Um mehrere Sprachen zu benutzen, können Sie die Extended description Plugin-Tags verwenden, wenn er aktiv ist.
<br><br>
<b style=&quot;color: red;&quot;>Warning: The use of this function is intimately associated with the confirmation of registration by the user (confirmation by mail) and can not be activated without this option.</b>';
/*TODO*/$lang['UAM_CustomPasswRetrTitle_d'] = 'By default, when a user has lost his password and selects the option of recovery, he receives an email containing only his username and his new password.
<br><br>
Here, you can add text of your choice to be inserted <b><u>before</u></b> the standard information.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
To use multiple languages, you can use the Extended description plugin\'s tags if it is active.';
/*TODO*/$lang['UAM_USRAutoDelTitle_d'] = 'This is only valid when the user whose account has expired itself triggers the deletion mechanism (rare but possible). he\'s then disconnected of the gallery and redirected to a page showing the deletion of his account and, possibly, the reasons for this deletion.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
<b style=&quot;color: red;&quot;>[username]</b> is not available here because concerned user has been deleted.
<br><br>
Custom text for the redirect page can be entered in this field that is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
// --------- End: New or revised $lang ---- from version 2.20.11
?>