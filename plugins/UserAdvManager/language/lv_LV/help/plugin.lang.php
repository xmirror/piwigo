<?php
global $lang;

$lang['UAM_restricTitle'] = 'Reģistrācijas ierobežojumi';
$lang['UAM_confirmTitle'] = 'Reģistrācijas pārbaude un apstiprināšana';
$lang['UAM_confirmTitle_d'] = '
- Informācijas e-pasta ģenerēšana<br>
- Reģistrācijas pārbaudes e-pasta ģenerēšana<br>
- Autopievienošanās grupas vai statusa ģenerēšana<br>
- Reģistrācijas robežlīnijas pārbaude<br>
- Atgādinājuma e-pasta ģenerēšana<br>
...
';
$lang['UAM_miscTitle'] = 'Pēcreģistrācijas un citas iespējas (options)';
$lang['UAM_casenTitle'] = 'Lietotājvārdi: Reģistrjutīgs';
$lang['UAM_carexcTitle'] = 'Lietotājvārdi: Rakstzīmju izņēmumi';
$lang['UAM_carexcTitle_d'] = 'Varētu būt saistoši aizliegt izmantot lietotājvārdos kādas noteiktas rakstzīmes (piemēram: noraidīt loginus saturošus &quot;@&quot;). Šī iespēja ļauj izslēgt rakstzīmes vai rakstzīmju secību, notikumus.<br>
NB: Šī iespēja ļauj izslēgt arī veselus vārdus.
<br><br>
<b style=&quot;color: red;&quot;>Uzmanību: Šī opcija neatstāj iespaidu uz lietotājvārdiem, kas izveidoti pirms to aktivēšanas.</b>';
$lang['UAM_passwTitle'] = 'Paroļu drošības līmeņa paaugstināšana';
$lang['UAM_passwTitle_d'] = 'Šīs opcijas iespējošana padara par obligātu paroles ietveršanu reģistrējoties, un pieprasa, lai apmeklētāju izvēlētā parole atbilstu minimālajam komplicētības prasībām. Ja šis līmenis nav sasniegts, tiem parādīts sasniegtais komplicētības rādītājs, minimāli pieļaujamais slieksnis, kā arī ieteikumi, kas jādara, lai sasniegtu labāku rezultātu.<br><br>
Pastāv paroles lauka tests, kas mēra paroles komplicētības pakāpi, un var sniegt padomu, kā uzlabot un padarīt šo rezultātu labāku.<br><br>
Note: Komplicētības rādītājs tiek aprēķināts izmantojot vairākus parametrus:
garumu, izmantoto rakstzīmju tipu (burti, cipari, lielie burti, mazie burti, speciālās rakstzīmes). Rezultāts zem100 tiek atzīts par nepietiekami zemu (low), no 100 līdz 500, kā vidēji sarežģīts; virs 500, drošības līmenis ir lielisks.';
$lang['UAM_passwtestTitle'] = 'Paroles komplicētības testēšana';
$lang['UAM_passwtestTitle_d'] = 'Ievadiet testēšanao paredzēto paroli un klikšķiniet uz&quot;Score calculation&quot; lai redzētu rezultātu.';
$lang['UAM_passwadmTitle'] = 'Attiecas uz administratoriem';
$lang['UAM_passwadmTitle_d'] = 'Administrators var izveidot lietotāja kontu ar vai bez paroles komplicētības pārbaudes aplikāciju.<br><br>
Note: Ja lietotājs, kura konts jau izveidots, grib nomainīt savu paroli un ir aktīva paroles stingrības uzlabišanas aplikācija, būs jāievēro visi stingrības uzlabošanas noteikumi.';
$lang['UAM_mailexcTitle'] = 'E-Pasta domēnu izslēgšana';
$lang['UAM_infomailTitle'] = 'Lietotājiem e-nosūtāmā informācija';
$lang['UAM_infomailTitle_d'] = 'Šī opcija ļauj automātiski ar e-pastu nosūtīt lietotājam informatīvu ziņu par reģistrāciju vai profila paroles vai e-pasta adreses maiņu.<br><br>
Nosūtāmā ziņa kompozicionāli sastāv no pielāgojamās daļas, maza ievada un fiksētās daļas, kas ietver info par lietotāja loginu, paroli un e-pasta adresi.';
$lang['UAM_infotxtTitle'] = 'Informatīvā e-pastra pielāgošana';
$lang['UAM_confirmtxtTitle'] = 'Apstiprinājuma e-pasta pielāgošana';
$lang['UAM_confirmgrpTitle'] = 'Pārbaudāmās Grupas';
$lang['UAM_confirmgrpTitle_d'] = '<b style=&quot;color:
red;&quot;>UZMANĪBU : Pārbaudāmo grupu lietošana pieprasa, ka esat izveidojis vismaz vienu lietotājgrupu un, ka tā ir definēta &quot; pēc noklusējuma &quot; Piwigo grupu lietotāju pārvaldītājā.</b><br><br>
Grupas ir validētas (apstiprināti) lietošanai sasaistē ar (apstiprinājums un reģistrācija) &quot;Confirmation of registration&quot;';
$lang['UAM_confirmstatTitle'] = 'Validācijas statūti';
$lang['UAM_confirmstatTitle_d'] = '<b style=&quot;color:
red;&quot;>UZMANĪBU : Statusa pārbaudes lietošana prasa, lai lietotājam &quot;Guest&quot; jaunai reģistrācijai būtu iestatījumi pēc noklusējuma (kā lietotāja paraugā). Nēmiet vērā, ka ir iespējams par paraugu jaunai reģistrācijai izmantot jebkuru citu lietotāju. Papildus informācijai, lūdzu izmantojiet Piwigo dokumentāciju.</b><br><br>
Statūti ir validēti lietošanai sasaistē ar (apstiprinājums un reģistrācija)  &quot;Confirmation of registration&quot;';
$lang['UAM_validationlimitTitle'] = 'Reģistrācijas validācijas termiņa ierobežošana';
$lang['UAM_remailTitle'] = 'Atgādināt nevalidētos lietotājus';
$lang['UAM_remailtxt1Title'] = 'Atgādinājuma e-vēstule ar jauni uzģenerēto atslēgu';
$lang['UAM_remailtxt2Title'] = 'Atgādinājuma e-vēstule bez jauni uzģenerētās atslēgas';
$lang['UAM_ghosttrackerTitle'] = 'Ghost (slēpto) apmeklētāju pārvaldība';
$lang['UAM_ghosttrackerTitle_d'] = 'Arī saukts par &quot;Ghost Tracker&quot; (spoku izsekotāju), kad šī funkcija aktivēta, iespējams sekot lietotājiem atkarībā no to apmeklējuma biežuma. Kad tiek sasniegts laiks starp diviem apmeklējumiem, iekš &quot;Ghost Tracker&quot; tabulas parādās ampmeklētājs ar jautājuma zīmi, kur ar e-pasta palīdzību var nosūtīt atgādinājumu.<br><br>
<b style=&quot;color: red;&quot;>Ja iespējojat šo iespēju pirmo reizi vai reaktivējat pēc lielāka laika perioda, kurā reģistrējušies jauni lietotāji, ir jāinicializē vai jāveic Ghost Tracker reset operācija.</b>';
$lang['UAM_gttextTitle'] = 'Ghost Tracker atgādinājuma ziņojums';
$lang['UAM_lastvisitTitle'] = 'Reģistrēto lietotāju izsekošana (Tracking)';
$lang['UAM_lastvisitTitle_d'] = 'Šis aktivē tabulu &quot;Tracking users&quot; iezīmē (tabā), kurā reģistrēti galeriju apmeklējušie lietotāji, viņu pēdējā apmeklējuma datums, kā arī galerijā pavadītais laiks (dienās) kopš pēdējā apmeklējuma. Monitoringam ir tīri informatīvs raksturs galerijas administratora vajadzībām.';
$lang['UAM_tipsTitle'] = 'Padomi un Piemēri';
$lang['UAM_tipsTitle_d'] = 'Padomi un dažādi izmantošanas piemēri';
$lang['UAM_userlistTitle'] = 'Lietotāju izsekošana';
$lang['UAM_usermanTitle'] = 'Validāciju izsekošana';
$lang['UAM_gtTitle'] = 'Ghost (slēpto) apmeklētāju vadība';


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_adminconfmailTitle'] = 'Reģistrācijas apliecinājums adminiem';
$lang['UAM_adminconfmailTitle_d'] = 'Jūs varat atspējot šo apstiprināšanu tikai tiem lietotāju kontiem, ko izveidojis administrators, lietojot Piwigo lietotāju vadības saskarni.<br><br>
Aktivizējot šo iespēju, katram administratora izveidotajam lietotājam tiks nosūtīta elektroniskā pasta vēstuve ar reģistrācijas apstiprinājumu.<br><br>
Atspējojot šo iespēju (pēc noklusējuma), tiek nosūtīta tikai e-pasta informācija (ja &quot;Information email to user&quot;(Informācijas e-pasts lietotājam) ir iespējots).';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.0
$lang['UAM_confirmmail_custom1'] = 'Apstiprinājuma lapas teksts – Apstiprinājums akceptēts';
$lang['UAM_confirmmail_custom2'] = 'Apstiprinājuma lapas teksts – Apstiprinājums noraidīts';
// --------- End: New or revised $lang ---- from version 2.15.0


// --------- Starting below: New or revised $lang ---- from version 2.15.2
$lang['UAM_casenTitle_d'] = 'Pēc noklusējuma Piwigo ir reģistrjutīgs:
Lielie un mazie burti, veidojot vārdus pie reģistrācijas, tiek uztverti kā atsevišķas rakstzīmes. Tādējādi, &quot;Foo&quot;,
&quot;foo&quot; un &quot;FOO&quot; var būt 3 atšķirīgi lietotāji.<br><br>
Šīs opcijas iespējošana ļauj izanalizēt visas iespējas &quot;foo&quot; kā viena lietotāja gadījumā. Ja &quot;foo&quot; jau eksistē, jauna lietotāja &quot;Foo&quot; izveidošana tiks noraidīta.<br><br>
<b style=&quot;color: red;&quot;>Uzmanību: Šī opcija neattiecas uz lietotājvārdiem, kas izveidoti pirms šīs opcijas aktivēšanas.</b>';
// --------- End: New or revised $lang ---- from version 2.15.2

// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_restricTitle_d'] = '
- Rakstzīmes izslēgšana<br>
- Paroles izpilde<br>
- E-pasta domēnu izslēgšana<br>
...
';
$lang['UAM_userlistTitle_d'] = 'Šī lapa domāta administratoru informēšanai. Tajā ir visu galerijā reģistrēto lietotāju saraksts ar to reģistrācijas datumu un apmeklējumu skaitu dienās līdz pēdējai vizītei. Saraksts sakārtots pēc dienu skaita dilstošā secībā.
<br><br>
<b><u>Tikai tad, kad Ghost Tracker ir aktīvs</u></b>, dienu skaits bez apmeklējuma parādās kā sekojošs krāsu kods, pamatojoties uz Ghost Tracker opcijas maksimālajiem iestatījumiem:
<br>
- <b style=&quot;color: lime;&quot;>Zaļa</b> : Kad lietotājs apmeklējis galeriju <b style=&quot;color: lime;&quot;><u>mazāk par 50%</u></b> no Ghost Tracker norādītā maksimuma.<br>
- <b style=&quot;color: orange;&quot;>Oranža</b> : Kad lietotājs apmeklējis galeriju <b style=&quot;color: orange;&quot;><u> starp 50% un 99% </u></b> no Ghost Tracker norādītā maksimuma. <br>
- <b style=&quot;color: red;&quot;>Sarkana</b> : Kad lietotājs apmeklējis galeriju <b style=&quot;color: red;&quot;><u>vairāk kā 100%</u></b> no Ghost Tracker norādītā maksimuma. <b><u>Šajā gadījumā lietotājam jāparādas arī Ghost Tracker tabulā.</u></b><br>
<br>
Piemērs :
<br>
Maksimālais Ghost Tracker konfigurācijas periods ir 100 dienas.
<br>
Lietotājs būs zaļā krāsā, ja būs apmeklējis galeriju mazāk par 50 dienām, oranžā, ja apmeklējums būs starp 50 un 99 dienām, bet sarkanā, ja 100 un vairāk dienu.
<br><br>
<b>NOTE</b>: Saraksts neatspoguļo tos, kuri nav validējuši savu reģistrāciju (ja aktīva reģistrācijas validācijas opcija). Šie lietotāji, tad tiek pārvaldīti īpašā veidā caur &quot;Tracking validations&quot; iezīmi.
<br><br>
<b>Table Sorting Function</b>: Iespējams kārtot attēlojamos datus noklikšķinot uz tabulas galvenēm. Pieturot SHIFT var kārtot pēc maksimums 4 kolonām vienlaicīgi.';
$lang['UAM_usermanTitle_d'] = 'Kad iespējota reģistrācijas ierobežošana pēc laika, zemāk atradīsit to lietotāju sarakstu, no kuriem tiek gaidīta reģistrācijas validācija, <b style=&quot;text-decoration:
underline;&quot;>ir vai nav</b> laikā, lai validētos.<br><br>
Lietotāja reģistrēšanās datums ir zaļā krāsā, ja lietotājs tiek uzskatīts par esošu reģistrācijas validācijas laika periodā. Šinī gadījumā validācijas atslēga vēl ir derīga un mēs varam nosūtīt jums e-pastu ar vai bez jaunās validācijas atslēgas.<br><br>
Ja reģistrācijas datums parādās sarkanā krāsā, validācijas periods ir beidzies. Šinī gadījumā, ja gribat iespējot, lai lietotājs validē savu reģistrāciju, jums jāsūta e-pasts ar validācijas atslēgas reģenerāciju.<br><br>
Visos gadījumos manuāli veikt validāciju.<br><br>
Šajā logā jūs varat:
<br><br>
- Manuāli dzēst kontus <b>(manuālā drenēšana)</b>
<br>
- Ģenerēt e-atgādinātāja pastu  <b>bez</b> jaunas atslēgas ģenerēšanas. Brīdinājums:
Sūta e-atgādinājumus mērķapmeklētājiem. Šī funkcija neizdzēš mērķlietotāju reģistrācijas datumu un taimauts joprojām ir spēkā.
<br>
- Ģenerēt E-atgādinātāja pastu <b>ar</b> jaunas atslēgas ģenerēšanu. Brīdinājums :
Sūta e-atgādinājumus mērķapmeklētājiem. Šī funkcija atiestata mērķapmeklētāju reģistrācijas datumu, kas pielīdzināms validācijas termiņa pagarināšanai.
<br>
- Iesniegt reģistrācijas apstiprināšanu manuāli, pat ja derīguma termiņš ir beidzies <b>(piespiedu validācija)</b>.
<br><br>
<b>Table Sorting Function</b>: tabulas šķirošanas funkcija ļauj kārtot tabulu noklikšķinot uz tabulas galvenēm. Pieturot SHIFT var kārtot pēc maksimums 4 kolonām vienlaicīgi.';
$lang['UAM_gtTitle_d'] = 'Ja Ghost Tracker ir iespējots un inicializēts, zemāk būs pieejams reģistrēto lietotāju saraksts, kuri nav atgriezušies pēc x dienām. &quot;x&quot; ir General Setup iezīmē konfigurētais dienu skaits. Bez tam, ir kolonna, kas norāda, vai mērķapmeklētājiem ir nosūtīts e-pasta atgādinājums. Tādējādi, uzmetot aci, būs redzami tie lietotāji, kuri nav ņēmuši vērā atgādinājumus.<br><br>Šajā logā jūs varat:
<br><br>
- Manuāli dzēst kontus <b>(manual drain)</b>
<br>
- Ģenerēt e-atgādinātāja pastu <b> atiestatot beidzamā apmeklējuma datumu</b>.
Tas dot wildcard mērķapmeklētājiem. Ja apmeklētājs jau ir saņēmis atgādinājumu, nekas netraucē atsūtīt viņam jaunu e-pastu, kas no jauna atiestatīs beidzamā apmeklējuma datumu.
<br><br>
<b>Table Sorting Function</b>: tabulas šķirošanas funkcija ļauj kārtot tabulu noklikšķinot uz tabulas galvenēm. Pieturot SHIFT var kārtot pēc maksimums 4 kolonām vienlaicīgi.';
$lang['UAM_confirmmailTitle'] = 'Reģistrācijas apstiprināšana';
$lang['UAM_confirmmailTitle_d'] = 'Šī opcija dod iespēju lietotājam apstiprināt savu reģistrāciju ar pie reģistrācijas e-pastā saņemtās saites palīdzību vai to var izdarīt administrators manuāli.<br><br>
Pirmajā gadījumā, e-vēstule tiek veidota no pielāgojamas ievadošās daļas un fiksētās daļas, kas satur aktivēšanas saiti, kas uzģenerēta no gadījuma atslēgas, ko iespējams reģenerēt izmantojot &quot;Tracking validations&quot; iezīmi.<br><br>
Otrajā gadījumā, <b><u>validācijas atslēga ar e-pastu netiek sūtīta!</u></b>.
Apmeklētājiem jāgaida līdz administrators personīgi veic viņu reģistrācijas validāciju caur &quot;Validation tracking&quot; iezīmi. Ieteicams aktivēt Piwigo optciju &quot;Email admins when a new user registers&quot; (skatīt Piwigo konfigurācijas iespējas) un izmantot &quot;Information
email to user&quot; , lai brīdinātu jaunos reģistrantus par nepieciešamību sagaidīt kontu aktivāciju.
<br>
<b style=&quot;color: red;&quot;>NB: Opcijas &quot;Deadline for registration validation limited&quot; un &quot;Remind unvalidated users &quot; jāiestāda atslēgtā (off) stāvoklī, kad iespējota administratora manuālās validācijas funkcija.</b>
<br><br>
Šo iespēju parasti izmanto kopā ar grupas un/vai statūtu automātisku nozīmēšanu. Piemēram, lietotāji, kas nav validējuši savu reģistrāciju, tiks ielikti īpašā lietotāju grupā (ar vai bez ierobežojumie uz piekļuvi galerijai), kamēr lietotājs, kas ir apstiprinājis savu reģistrāciju tiks ielikts grupā &quot;normal&quot;.';
$lang['UAM_RedirTitle'] = 'Novirzīt uz &quot;Customization&quot; lapu';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.15.6
$lang['UAM_RedirTitle_d'] = 'Šī opcija automātiski novirza reģistrēto lietotāju uz tā pielāgošanas lapu tikai pie pirmās viņa konekcijas galerijai. <br><br>
Lūdzu ņemiet vērā: Šī iespēja neaatiecas uz visiem reģistrētajiem lietotājiem. Lietotāji ar &quot;admin&quot;, &quot;webmaster&quot; or &quot;generic&quot; statusu nav iekļauti.';
// --------- End: New or revised $lang ---- from version 2.15.6


// --------- Starting below: New or revised $lang ---- from version 2.16.0
$lang['UAM_ghosttrackerTitle_d'] = 'Arī saukts par &quot;Ghost
Tracker&quot;, kad šī funkcija aktivēta, jūs varat pārvaldīt savus apmeklētājus atkarībā no viņu apmeklējumu biežuma. Iespējami 2 darbības režīmi:<br><br>
- Manuālā pārvaldība : Kad tiek sasniegts laiks starp 2 apmeklējumiem, apmeklētājs parādās &quot;Ghost Tracker&quot; tabulā, kur jums ir iespēja aizsūtīt atgādinājuma e-pastu lietotājam vai to izdzēst.<br><br>
- Automātiskā pārvaldība : Kad tiek sasniegts laiks starp 2 apmeklējumiem, apmeklētājs tiek automātiski izdzēsts vai pārvietots gaidītāju grupā. Šajā otrajā gadījumā lietotājam var tikt nosūtīts informējošs e-pasts.<br><br>
<b style=&quot;color: red;&quot;>Svarīga piezīme : Ja izmantojat šo variantu pirmo reizi vai pēc ilgāka laika, kurā klāt nākuši jauni lietotāji, to reaktivējat, jums jāinicializē vai jāveic Ghost Tracker reset funkcija (skatīt attiecīgās instrukcijas &quot;Ghost Tracker&quot; lapā).</b>';
$lang['UAM_miscTitle_d'] = '
- Ghosts lietotāju automātiskā un manuālā pārvaldība<br>
- Pēc reģistrētie lietotāji<br>
- Viesu komentāriem nepieciešams segvārds (nickname)<br>
...
';
$lang['UAM_mailexcTitle_d'] = 'Pēc noklusējuma Piwigo atbalsta visas e-pasta adreses formātā xxx@yyy.zz. Šīs opcijas iespējošana ļauj izslēgt no adresēm noteiktus domēnus formātā: @
[domain_name].[domain_extension].<br><br>
Piemēri :<br>
@hotmail.com -> izņemot adreses *@hotmail.com<br>
@hotmail -> izņemot visas adreses *@hotmail*';
$lang['UAM_GTAutoTitle'] = ' Ghosts lietotāju automātiskā pārvaldība';
$lang['UAM_GTAutoTitle_d'] = 'Šī opcija dod iespēju pielietot (slēptajiem) ghosts lietotājiem automātiskās pārvaldības nosacījumus.
<br><br>Pamatprincips: Lietotājs, kas sasniedzis maksimālo laiku starp apmeklējumiem <b><u>and</u></b> un ir jau par to ar e-pastu brīdināts, tiek uzskatīts kā vairs neesošs. Tad jūs varat pielietot automātiskās apstrādes nosacījumus, kā notecējušo kontu automātisko dzēšanu vai to pazemināšanu, ierobežojot piekļuvi galerijai (automātiski pārvirzot ierobežojumu grupā vai piešķirot šādu statusu).
<br><br>Šis automātiskais process tiek iedarbināts lietotājiem (jebkuram lietotājam!) pieslēdzoties galerijai.';
$lang['UAM_GTAutoDelTitle'] = 'Pielāgots ziņojums par dzēstu kontu';
$lang['UAM_GTAutoGpTitle'] = 'Grupas/stausa automātiskā nomaiņa';
$lang['UAM_GTAutoGpTitle_d'] = 'Automātiska konta grupas vai statusa maiņa ir ekvivalenta kontu, kas ir iesaistīti un darbojas uz vieniem un tiem pašiem principiem kā validācijas grupas, funkcionalitātes pazemināšanai (skatīt &quot;Setting confirmations and validations of registration&quot;).
Tādējādi jānosaka mainīto (pazemināto) grupu un/vai statusa piekļuves tiesības galerijai. Ja tas jau izdarītslietojot reģistrācijas apstiprināšanas funkciju, varat lietot to pašu grupu vai statusu.<br><br>
<b style=&quot;color: red;&quot;>Important note :</b> Ja no slēptā ghost lietotāja pēc termiņa limita, neskatoties uz informēšanu ar e-pastu (ja iespējots), nav nekādas ziņas, viņš automātiski tie dzēsts no datu bāzes';
$lang['UAM_GTAutoMailTitle'] = 'Automātiska e-pasta nosūtīšana, informējot par grupas vai statusa maiņu.';
$lang['UAM_AdminValidationMail'] = 'Paziņojums par manuālās reģistrācijas apstiprināšanu';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
/* TODO */$lang['UAM_CustomPasswRetrTitle'] = 'Customize lost password email content';
/* TODO */$lang['UAM_validationlimitTitle_d'] = 'Šī opcija ļauj ierobežot jaunajiem reģistrantiem nosūtīto atslēgas validācijas e-pastu validitāti. Lietotājiem, kuri reģistrējas ir x dienas laika, lai apstiprinātu savu reģistrāciju. Pēc šī laika beigsies validācijas saite derīgums.
<br><br>
Šī opcija tiek lietota sasaistē ar &quot;Confirmation of registration&quot;
<br><br>
If this option and the option &quot;Atgādināt nevalidētos lietotājus&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/* TODO */$lang['UAM_remailTitle_d'] = 'Šī iespēja ļauj nosūtīt atgādinājuma e-pastus reģistrētajiem, bet laikā neveikušajiem validāciju, lietotājiem. Tādēļ ši opcija strādā sasaistē ar (apstiprinājumu un reģistrāciju) &quot;Confirmation of registration&quot;
<br><br>
Var tikt nosūtītas 2 tipu e-vēstules: Ar vai bez validācijas atslēgas reģistrāciju. Ja nepieciešams, e-vēstules saturu var pielāgot.<br><br>
Attiecas uz &quot;Validāciju izsekošanas&quot; iezīmi(tab).
<br><br>
If this option and the option &quot;Reģistrācijas validācijas termiņa ierobežošana&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/*TODO*/$lang['UAM_USRAutoTitle'] = 'Automatic management of unvalidated users';
/*TODO*/$lang['UAM_USRAutoTitle_d'] = 'Automatic handling of unvalidated visitors is triggered each time you connect to the gallery and works as follows:
<br><br>
- Automatic deletion of accounts not validated in the allotted time without sending automatic email reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> and &quot;Remind unvalidated users&quot; <b><u>disabled</u></b>.
<br><br>
- Automatically sending a reminder message with a new generation of validation key and automatic deletion of accounts not validated in the time after sending the reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> et &quot;Remind unvalidated users&quot; <b><u>enabled</u></b>.';
/*TODO*/$lang['UAM_USRAutoDelTitle'] = 'Custom message on deleted account';
/*TODO*/$lang['UAM_USRAutoMailTitle'] = 'Automated email reminder';
/*TODO*/$lang['UAM_USRAutoMailTitle_d'] = 'When activated, this function will automatically send personalized content in &quot;Reminder email with new key generated&quot; to visitors who match criteria.';
/*TODO*/$lang['UAM_StuffsTitle'] = 'PWG Stuffs block';
/*TODO*/$lang['UAM_StuffsTitle_d'] = 'This enables an additional UAM block in PWG Stuffs plugin (if installed) to inform your visitors who did not validate their registration about their condition.
<br><br>
Please refer to the <b>Tips and Examples of Use</b> at the bottom of this page for details.';
// --------- End: New or revised $lang ---- from version 2.20.0


// --------- Starting below: New or revised $lang ---- from version 2.20.3
/*TODO*/$lang['UAM_DumpTitle'] = 'Backup your configuration';
/*TODO*/$lang['UAM_DumpTitle_d'] = 'This allows you to save the entire configuration of the plugin in a file so you can restore it if something goes wrong (wrong manipulation or before an update, for example). By default, the file is stored in this folder ../plugins/UserAdvManager/include/backup/ and is called &quot;UAM_dbbackup.sql&quot;.
<br><br>
<b style=&quot;color: red;&quot;>Warning: The file is overwritten each backup action!</b>
<br><br>
It can sometimes be useful to retrieve the backup file on your computer. For example: To restore to another database, to outsource or to keep multiple save files. To do this, just check the box to download the file.
<br><br>
The recovery from this interface is not supported. Use tools like phpMyAdmin.';
// --------- End: New or revised $lang ---- from version 2.20.3


// --------- Starting below: New or revised $lang ---- from version 2.20.4
/*TODO*/$lang['UAM_HidePasswTitle'] = 'Password in clear text in the information email';
/*TODO*/$lang['UAM_HidePasswTitle_d'] = 'Choose here if you want to display the password chosen by the visitor in the information email. If you enable the option, the password will then appear in clear text. If you disable the password will not appear at all.';
// --------- End: New or revised $lang ---- from version 2.20.4


// --------- Starting below: New or revised $lang ---- from version 2.20.11
/* TODO */$lang['UAM_gttextTitle_d'] = 'Ievadiet tekstu , ko jūs gribat atspoguļot e-pasta atgādinājumā, lai atgādinātu lietotājam apmeklēt jūsu galeriju. (NB: Spraudni instalējot, aizpildītais teksts ir piedāvāts kā paraugs).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[days]</b> to insert the maximum numbers of days between two visits.
<br><br>
Lai izmantotu vairākas valodas, jūs varat lietot Paplašinātā apraksta spraudņa tagus (gadījumā, ja tas ir aktīvs).';
/* TODO */$lang['UAM_confirmtxtTitle_d'] = 'Ievadiet teksta, ko jūs gribat atspoguļot informācijas e-vēstulē, ievaddaļu.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Reģistrācijas apstiprināšanas limita robežlīnija;&quot; have to be enabled).
<br><br>
Lai izmantotu vairākas valodas, jūs varat lietot Paplašinātā apraksta spraudņa tagus (gadījumā, ja tas ir aktīvs).';
/* TODO */$lang['UAM_remailtxt1Title_d'] = 'Ievadiet teksta, ko jūs gribat atspoguļot informācijas e-vēstulē, ievaddaļu, kā pielikumu reģenerētajai validācijas atslēgai.
<br><br>
Ja ir atstāts tukšs lauks, e-pasta atgādinātājs ietver sevī tikai validācijas saiti.
Tādēļ ir ieteicams ietvert mazu skaidrojošu tekstu. (NB: Spraudni instalējot, aizpildītais teksts ir piedāvāts kā paraugs).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Reģistrācijas apstiprināšanas limita robežlīnija;&quot; have to be enabled).
<br><br>
Lai izmantotu vairākas valodas, jūs varat lietot Paplašinātā apraksta spraudņa tagus (gadījumā, ja tas ir aktīvs).';
/* TODO */$lang['UAM_remailtxt2Title_d'] = 'Ievadiet teksta, ko jūs gribat atspoguļot informācijas e-vēstulē, ievaddaļu bez validācijas atslēgas.
<br><br>
Ja ir atstāts tukšs lauks, e-pasta atgādinātājvēstule būs tukša. Tādēļ ir ieteicams ietvert mazu skaidrojošu tekstu.(NB: Spraudni instalējot, aizpildītais teksts ir piedāvāts kā paraugs).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Reģistrācijas apstiprināšanas limita robežlīnija;&quot; have to be enabled).
<br><br>
Lai izmantotu vairākas valodas, jūs varat lietot Paplašinātā apraksta spraudņa tagus (gadījumā, ja tas ir aktīvs).';
/* TODO */$lang['UAM_infotxtTitle_d'] = 'Ievadiet teksta, ko jūs gribat atspoguļot informācijas e-vēstulē, ievaddaļu.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Lai izmantotu vairākas valodas, jūs varat lietot Paplašinātā apraksta spraudņa tagus (gadījumā, ja tas ir aktīvs).';
/* TODO */$lang['UAM_AdminValidationMail_d'] = 'Gadījumā, kad administrators vai galerijas Webmāsters manuāli aiztur reģistrācijas procesu, lietotājam automātiski tiek nosūtīts e-pasta paziņojums. Ievadiet šeit tekstu, ko gribat, lai tas parādītos šajā e-pasta ziņojumā.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Ja ir aktivēts paplašinātā apraksta Extended description spraudnis, varat izmantot tā iezīmes (valodu tagus), lai lietotu vairākas pieejamās valodas.';
/* TODO */$lang['UAM_confirmmail_custom1_d'] = 'Tad, kas opcija &quot;Confirmation of registration&quot; ir aktīva, šis lauks ļauj jums pielāgot apstiprinājuma tekstu <b><u>acceptance text</u></b> reģistrācijas apstiprināšanas lapā, kas parādās, kad lietotājs uzklikšķina uz apstiprināšanas saites, ko viņš saņēmis ar e-pastu.
<br><br>
Pēc spraudņa uzinstalēšanas, kā piemērs tiek piedāvāts standarta teksta variants.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Šis lauks ir savietojams ar FCK Redaktoru un, multi-valodu režīmā, varat lietot Paplašināta apraksta (Extended description), gadījumā, ja tas ir aktīvs) [lang] iezīmes- tagus.';
/* TODO */$lang['UAM_confirmmail_custom2_d'] = 'Tad, kad opcija &quot;Confirmation of registration&quot; ir aktīva, šis lauks ļauj jums pielāgot noraidījuma tekstu <b><u>rejectance text</u></b> > reģistrācijas apstiprināšanas lapā, kas parādās, kad lietotājs uzklikšķina uz apstiprināšanas saites, ko viņš saņēmis ar e-pastu.
<br><br>
Pēc spraudņa uzinstalēšanas, kā piemērs tiek piedāvāts standarta teksta variants.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Šis lauks ir savietojams ar FCK Redaktoru un, multi-valodu režīmā, varat lietot Paplašināta apraksta (Extended description), gadījumā, ja tas ir aktīvs) [lang] iezīmes- tagus.';
/* TODO */$lang['UAM_GTAutoDelTitle_d'] = 'Šis variants ir iespējams tikai tad, ja lietotājs, kura konta derīguma termiņš ir beidzies, pats ieslēdz dzēšanas mehānismu (rets, bet iespējams gadījums). Tad viņš tiek atslēgts no galerijas un novirzīts uz lapu, kas atspoguļo viņa konta dzēšanas faktu un iespējamo šīs dzēšanas iemeslu.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
<b style=&quot;color: red;&quot;>[username]</b> is not available here because concerned user has been deleted.
<br><br>
Pāradresācijas lapai paredzēto pielāgoto tekstu var ievadīt šajā laukā, savietojams ar FCK Redaktora standartu, lai izmantotu multi-valodu režīmu, lietojiet spraudņa paplašinātais apraksts Extended description iezīmes [lang], tikai gadījumā, ja spraudnis aktīvs.';
/* TODO */$lang['UAM_GTAutoMailTitle_d'] = 'Kad konta derīguma termiņš izbeidzas (grupas/statusa maiņa, apmeklētāja funkcionāla pazemināšana), var tikt izsūtīts informatīvs e-pasta ziņojums, kas izskaidro notikušā iemeslus, kā arī paskaidro iespējas, kā no jauna atjaunot piekļuvi galerijai.
<br>Lai to paveiktu, e-pastam ir pievienota reģistrācijas revalidācijas saite (jaunas validācijas automātiska uzģenerēšana).<b
style=&quot;color: red;&quot;>Ja lietotājs jau ir bijis brīdināts, viņa konts automātiski tiek iznīcināts.</b>
<br><br>
Lai papildinātu validācijas apstiprināšanas saiti, var pievienot konta funkcionalitātes pazemināšanas paskaidrojošu tekstu. Šis paskaidrojuma teksts nav obligāts, bet stingri iesakāms. Patiesībā, jūsu apmeklētāji nebūs sevišķi apmierināti, saņemot tikai aktivācijas saiti bez nekādiem paskaidrojumiem. ;-)
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
 Ja ir aktivēts paplašinātā apraksta Extended description spraudnis, varat izmantot tā iezīmes (valodu tagus), lai lietotu vairākas pieejamās valodas.
<br><br>
<b style=&quot;color: red;&quot;>Brīdinājums: Šīs funkcijas izmantošana ir cieši saistīta ar lietotāja reģistrācijas apstiprināšanu (apstiprināšana ar e-pastu) un nevar tikt aktivēta bez šīs opcijas.</b>';
/* TODO */$lang['UAM_CustomPasswRetrTitle_d'] = 'By default, when a user has lost his password and selects the option of recovery, he receives an email containing only his username and his new password.
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