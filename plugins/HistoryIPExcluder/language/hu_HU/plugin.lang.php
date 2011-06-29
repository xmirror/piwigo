<?php
global $lang;

$lang['HIPE_description'] = 'Ezzel a bővítménnyel kizárhat IP címeket, vagy IP tartományokat az előzményekből és a statisztikából. <br>A blokkolt rekordokat az IP *_history táblában az alábbi táblázat tartalmazza.';
$lang['HIPE_admin_section1'] = 'IP-k kizárása';
$lang['HIPE_admin_description1'] = 'IP címek kizárásához írja be az alábbi mezőbe a kizárandó IP-ket, vagy adjon meg IP tartományokat (soronként egyet). IP tartomány kizárásához használja a helyettesítő karaktert "%".<br>Példa : 74.6.1.2 vagy 74.6.%';
$lang['HIPE_save_config']='Beállítások mentve.';
$lang['HIPE_CleanHist']='Előzmények törlése';
$lang['submit']='Elküld';
$lang['HIPE_admin_section2'] = 'Előzmények tábla lekérdezése';
$lang['HIPE_admin_section3'] = 'Előzmények lekérdezésének eredménye';
$lang['HIPE_IPByMember'] = 'Felhasználói IP-k';
$lang['HIPE_IPByMember_description'] = 'Tagok által használt IP címeket mutatja IP cím szerint rendezve.';
$lang['HIPE_OnlyGuest'] = 'Csak vendég IP-k';
$lang['HIPE_OnlyGuest_description'] = 'Az előzmények tábla szerint rendezve csak azon IP címeket mutatja melyekről a vendégek meglátogatták az oldalt. Felsorolja az IP címeket és azt, hogy az adott IP-ről hányszor kapcsolódtak.';
$lang['HIPE_IPnoGuest'] = '';
$lang['HIPE_IPnoGuest_description'] = '';

$lang['HIPE_IPForMember'] = 'IP cím keresése felhasználónév szerint';
$lang['HIPE_IPForMember_description'] = 'Megkeresi és megjeleníti a regisztrált felhasználó  IP címét (rendezve IP szerint).';
$lang['HIPE_MemberForIp'] = 'Felhasználó keresése IP cím szerint';
$lang['HIPE_MemberForIp_description'] = 'Megkeresi és megjeleníti az IP címről csatlakozott felhasználót (rendezve név szerint).';

$lang['HIPE_resquet_ok'] = 'Sikeres lekérdezés.';
$lang['HIPE_hist_cleaned'] = 'Az előzmények tábla tisztítása kész.';

$lang['IP_geolocalisation'] = 'Földrajzi hely';

// --------- Starting below: New or revised $lang ---- from version 2.1.0
$lang['HIPE_version'] = ' - Változat: ';
// --------- End: New or revised $lang ---- from version 2.1.0

// --------- Starting below: New or revised $lang ---- from version 2.1.1
$lang['HIPE_IPBlacklist_title'] = 'Regisztrációs feketelista';
$lang['HIPE_IPBlacklisted'] = ' Regisztráció tiltása az alábbi IP címekről (feketelista)';
$lang['Error_HIPE_BlacklistedIP'] = 'Hiba! Az IP címed le van tiltva, nem regisztrálhatsz a galériába. További részletekért fordulj a galéria adminisztrátorához.';
// --------- End: New or revised $lang ---- from version 2.1.1
?>
