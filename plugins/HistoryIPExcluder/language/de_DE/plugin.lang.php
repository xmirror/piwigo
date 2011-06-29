<?php
global $lang;

$lang['HIPE_description'] = 'Diese Erweiterung erlaubt es, einzelne IP Adressen oder Adressbereiche von der Erfassung in der Historie und den Statistiken auszunehmen . <br>Wird die Erweiterung aktiviert, werden die unten angegebenen IP Adressen nicht in die *_history Tabellen übernommen.';
$lang['HIPE_admin_section1'] = 'Auszunehmende IP Adressen';
$lang['HIPE_admin_description1'] = 'Geben Sie die auszunehmen IP Adresse oder den auszunehmenden Addressbereich (ein Eintrag pro Zeile) in das Feld unten ein. Benutzen Sie das Stellvertretersymbol "%", um Adressbereiche einzugeben.<br>Beispiel: 74.6.1.2 oder 74.6.%';
$lang['HIPE_save_config']='Einstellungen gespeichert.';
$lang['HIPE_CleanHist']='Historie löschen';

$lang['HIPE_admin_section2'] = 'Abfragen in der History Tabelle';
$lang['HIPE_admin_section3'] = 'Ergebnis der Abfrage';
$lang['HIPE_IPByMember'] = 'IP Adressen von Mitgliedern';
$lang['HIPE_IPByMember_description'] = 'Zeigt die IP Adressen an, die von Mitgliedern benutzt werden (nach IP Adresse sortiert)';
$lang['HIPE_OnlyGuest'] = 'IP Adressen von Gästen';
$lang['HIPE_OnlyGuest_description'] = 'Zeigt die IP Adressen von Gastbenutzern und die Anzahl der Einträge in der History Tabelle an (sortiert nach der Anzahl der Einträge)';
$lang['HIPE_IPnoGuest'] = '';
$lang['HIPE_IPnoGuest_description'] = '';

$lang['HIPE_IPForMember'] = 'IP Adressen eines Mitglieds';
$lang['HIPE_IPForMember_description'] = 'Zeigt die IP Adressen, die von einem registrierten Mitglied verwendet werden (nach IP Adressen sortiert)';
$lang['HIPE_MemberForIp'] = 'Einer IP Adresse zugeordnete Mitglieder';
$lang['HIPE_MemberForIp_description'] = 'Zeigt die Mitglieder, die einer IP Adresse zugeordnet sind (sortiert nach Name)';

$lang['HIPE_resquet_ok'] = 'Anfrage OK.';
$lang['HIPE_hist_cleaned'] = 'Die Einträge wurden aus der History Tabelle entfernt.';

$lang['IP_geolocalisation'] = 'Geolokalisierung';

// --------- Starting below: New or revised $lang ---- from version 2.1.0
$lang['HIPE_version'] = ' - Version: ';
// --------- End: New or revised $lang ---- from version 2.1.0

// --------- Starting below: New or revised $lang ---- from version 2.1.1
$lang['HIPE_IPBlacklist_title'] = 'Registrierungs-Blacklist';
$lang['HIPE_IPBlacklisted'] = 'Verhindert, sich von gesperrten IP Adressen zu registrieren';
$lang['Error_HIPE_BlacklistedIP'] = 'Fehler! Ihre IP Adresse wurde gesperrt, Sie können sich nicht registrieren. Kontaktieren Sie den Administrator, um weitere Informationen zu erhalten.';
// --------- End: New or revised $lang ---- from version 2.1.1
?>