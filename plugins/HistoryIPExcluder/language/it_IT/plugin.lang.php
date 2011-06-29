<?php
global $lang;

$lang['HIPE_description'] = 'Questo plugin esclude gli indirizzi IP o intervalli d\indieizzi dalla cronologgia e dalle statistiche.<br>Attivandolo, gli indirizzi IP specifici della tabella sottostante non saranno più registrati nella tabella *.history de PWG.';
$lang['HIPE_admin_section1'] = 'Esclusione d\'IP';
$lang['HIPE_admin_description1'] = 'Riempite le tabella sottostante con gli indirizzi IP o intervalli da escludere (uno per riga). Potete usare degli IP completi o una serie usando il carattere jolly "%".<br>Per esempio : 74.6.2.1 o 74.6.%<br><br>';
$lang['HIPE_save_config']='Configurazione registrata.';
$lang['HIPE_CleanHist']='Ripulire la cronologgia';

$lang['HIPE_admin_section2'] = 'Selezioni sulla cronologgia';
$lang['HIPE_admin_section3'] = 'Risultato della selezione';
$lang['HIPE_IPByMember'] = 'IP per utente';
$lang['HIPE_IPByMember_description'] = 'Visualizza gli indirizzi IP legati a degli utenti, per indirizzo';
$lang['HIPE_OnlyGuest'] = 'IP solo degli ospiti';
$lang['HIPE_OnlyGuest_description'] = 'Visualizza gli indirizzi IP usati unicamente dagli ospiti e il numero di volte che appaiono nella base, per numero di volte per IP';
$lang['HIPE_IPnoGuest'] = '';
$lang['HIPE_IPnoGuest_description'] = '';

$lang['HIPE_IPForMember'] = 'IP di un\'utente';
$lang['HIPE_IPForMember_description'] = 'Visualizza gli indirizzi IP legati agli utenti, per IP';
$lang['HIPE_MemberForIp'] = 'Utenti di un\'indirizzo IP';
$lang['HIPE_MemberForIp_description'] = 'Visualizza gli utenti legati ad un\'indirizzo IP, per utente';

$lang['HIPE_resquet_ok'] = 'Esecuzzione della selezzione riuscita.';
$lang['HIPE_hist_cleaned'] = 'Operazzione di "pulizzia" della cronologgia riuscito.';

$lang['IP_geolocalisation'] = 'Geolocalizzazione';

// --------- Starting below: New or revised $lang ---- from version 2.1.0
$lang['HIPE_version'] = ' - Versione: ';
// --------- End: New or revised $lang ---- from version 2.1.0

// --------- Starting below: New or revised $lang ---- from version 2.1.1
/*TODO*/$lang['HIPE_IPBlacklist_title'] = 'Registration blacklist';
/*TODO*/$lang['HIPE_IPBlacklisted'] = ' Prevent registration to the gallery of excluded IPs (blacklist)';
/*TODO*/$lang['Error_HIPE_BlacklistedIP'] = 'Error! Your IP has been banned. You can not subscribe to this gallery. Contact the administrator for further details.';
// --------- End: New or revised $lang ---- from version 2.1.1
?>