<?php

/*
 * How to translate metadata names and values ?
 *
 * Metadata names and values are not translated with a /language/*.lang.php file
 * but they are stored in a .po and .mo files, respectively localized into
 *  - /JpegMetaData/Locale/xx_XX/Tag.po
 *  - /JpegMetaData/Locale/xx_XX/LC_MESSAGES/Tag.mo
 *
 * More information about GNU gettext l10n system and method to edit the .po & .mo
 * files on wikipedia :
 *  - http://en.wikipedia.org/wiki/GNU_gettext
 *
 */

$lang['Grum Plugin Classes is not installed'] = "Il plugin <b>Grum Plugin Classes</b> non è installato";

$lang['amd_title_page'] = "Gestione esperta dei metadati";
$lang['g003_version'] = "v";

$lang['g003_error_invalid_ajax_call'] = "Chiamata alla funzione non valido!";

$lang['g003_metadata'] = "Metadati";
$lang['g003_database'] = "Repository";
$lang['g003_status'] = "Stato";
$lang['g003_show'] = "Visualizzare";

$lang['g003_numberOfNotAnalyzedPictures'] = "%d immagini non sono state analizzate";
$lang['g003_analyze_not_analyzed_pictures'] = "L\'analisi si concentra sulle immagini che non sono mai state analizzati e vengono aggiunte al repository corrente";
$lang['g003_analyze_all_pictures'] = "L\'analisi comprende tutte le immagini in galleria, e sostituisce il repository attuale";
$lang['g003_analyze_caddie_add_pictures'] = "L\'analisi si concentra sulle immagini del cestino e vengono aggiunte al repository corrente";
$lang['g003_analyze_caddie_replace_pictures'] = "L\'analisi si concentra sulle immagini del cestino e sostituisce il repository attuale";
$lang['g003_analyze'] = "Analizzare";
$lang['g003_update_metadata'] = "Aggiornare il Repository dei metadati";
$lang['g003_status_of_database'] = "Stato del Repository";
$lang['g003_updating_metadata'] = "Aggiornamento del Repository";
$lang['g003_analyze_in_progress'] = "Trattamento in corso ...";
$lang['g003_analyze_is_finished'] = "Trattamento completato";
$lang['g003_loading'] = "Caricamento ...";
$lang['g003_numberOfPicturesWithoutTags'] = "%d immagini non hanno metadati";
$lang['g003_no_items_selected'] = "Nessun metadato è selezionato";
$lang['g003_selected_tag_isnot_linked_with_any_picture'] = "Il metadato selezionato non è collegato a nessun immagine";
$lang['g003_TagId'] = "Metadati";
$lang['g003_TagLabel'] = "Nome";
$lang['g003_NumOfImage'] = "Immagini";
$lang['g003_Pct'] = "%";
$lang['g003_select'] = "Selezione";
$lang['g003_display'] = "Visualizzazione";
$lang['g003_order'] = "Ordinare per";
$lang['g003_filter'] = "Filtrare";
$lang['g003_tagOrder'] = "Metadati";
$lang['g003_numOrder'] = "Numero di immagini";
$lang['g003_valueOrder'] = "Valore";
$lang['g003_no_filter'] = "Nessun filtro";
$lang['g003_magic_filter'] = "Magic (metadati calcolati)";
$lang['g003_exclude_unused_tags'] = "Escludi i metadati inutilizzati";
$lang['g003_Value'] = "Valore";
$lang['g003_selected_tags_only'] = "Restituire solo i metadati selezionati";

$lang['g003_select_metadata'] = "Selezione dei metadati";
$lang['g003_display_management'] = "Gestione della visualizzazione dei metadati";
$lang['g003_number_of_filtered_metadata'] = "Numero i metadati :";
$lang['g003_number_of_distinct_values'] = "Numero di valori distinti :";

$lang['g003_click_to_edit_group'] = "Cliccare per modificare le proprietà del gruppo di metadati ";
$lang['g003_click_to_delete_group'] = "Cliccare per cancellare il gruppo di metadati";
$lang['g003_click_to_manage_group'] = "Cliccare per gestire gli elementi del gruppo di metadati ";
$lang['g003_click_to_manage_list'] = "Cliccare per aggiungere/cancellare dei metadati";
$lang['g003_add_a_group'] = "Aggiungere un gruppo di metadati";
$lang['g003_adding_a_group'] = "Aggiunta di un gruppo di metadati";
$lang['g003_editing_a_group'] = "Modifica di un gruppo di metadati";
$lang['g003_deleting_a_group'] = "Eliminazione di un gruppo di metadati";
$lang['g003_new_group'] = "Nuovo gruppo di metadati";
$lang['g003_name'] = "Nome";
$lang['g003_add_delete_tags'] = "Aggiungere/Rimuovere dei metadati";
$lang['g003_confirm_group_delete'] = "Sei sicuro di voler cancellare il gruppo di metadati %s?";
$lang['g003_default_group_name'] = "Condizioni della ripresa";

$lang['g003_ok'] = "Ok";
$lang['g003_cancel'] = "Cancellare";
$lang['g003_yes'] = "Sì";
$lang['g003_no'] = "No";


$lang['g003_invalid_group_id'] = "ID del gruppo di metadati non valido";
$lang['g003_no_tag_can_be_selected'] = "Nessun metadato disponibile";


$lang['g003_warning_on_analyze_3'] = "Il repository è alimentato poco a poco ogni volta che una pagina della galleria è visitata. Il tempo necessario per l\'alimentazione completa del repository dipende :";
$lang['g003_warning_on_analyze_3a'] = "Dal numero di foto nella galleria";
$lang['g003_warning_on_analyze_3b'] = "Dal numero di pagine viste ogni giorno";

$lang['g003_warning_on_analyze_5'] = "Al fine di avere rapidamente un repository completo, è possibile realizzare un\'analisi diretta dalla galleria :";
$lang['g003_warning_on_analyze_0'] = "Attenzione!";
$lang['g003_warning_on_analyze_1'] = "L\'alimentazione del repository via il processo di analisi diretta può rivelarsi lunga (fino a diversi minuti di trattamento) e consomatrice di risorse del server in base al numero di foto selezionate per l\'analisi.";
$lang['g003_warning_on_analyze_2'] = "Alcuni provider possono sanzionare tale utilizzo.";



$lang['g003_metadata_detail'] = "Intervallo i valori per il metadati";

$lang['g003_help'] = "Guida sui metadati";
$lang['g003_help_tab_exif'] = "Exif";
$lang['g003_help_tab_iptc'] = "IPTC";
$lang['g003_help_tab_xmp'] = "XMP";
$lang['g003_help_tab_magic'] = "Magic";
$lang['g003_help_exif'] = "I metadati EXIF sono le informazioni che sono memorizzate nell\'immagine, dalla fotocamera, durante lo scatto.

Le informazioni sono principalmente tecniche :
[ul]
[li]attrezzature utilizzata (modello della fotocamera, fabbricante)[/li]
[li]condizioni di scatto (apertura, tempo di esposizione, focale)[/li]
[li]il momento dello scatto (data, ora)[/li]
[li]posizione geografica (dati GPS)[/li]
[li]informazioni sul formato delle foto (dimensioni, risoluzione, compressione)[/li]
[/ul]

L\'alimentation dei metadati EXIF è standardizzato ([url]http://www.exif.org/Exif2-2.PDF[/url]), tuttavia :
[ul]
[li]questo standard definito dalla [url=http://www.jeita.or.jp]JEITA[/url] (Japan Electronics e Information Technology Industries Association) non evolve più dal 2002 [/ li]
[li]ogni metadato definito nello standard è facoltativo : tutti i dispositivi non usano tutti i metadati[/li]
[li]esiste un metadato [i]MakerNote[/i], campo libero usato dai produttori che memorizza le informazioni non presenti nelle specifiche (ad esempio, i riferimenti al obbiettivo); queste informazioni sono specifiche per ogni fabbricante, forse anche ad ogni modello. Il plugin è in grado di interpretare alcune di queste informazioni per apparecchi [b]Pentax[/b], [b]Canon[/b], [b]Nikon[/b].[/li]
[/ul]";

$lang['g003_help_iptc'] = "I metadati IPTC sono informazioni che sono memorizzate nella immagine, dal fotografo, attraverso un software appropriato.

La natura delle informazioni che si trovano è essenzialmente orientata verso il mondo professionale :
[ul]
[li]le informazioni del fotografo (nome, contatto)[/li]
[li]informazioni relative al Copyright[/li]
[li]la descrizione della foto (titolo, descrizione, commenti, parole-chiavi)[/li]
[li]informazioni diverse relative al mondo professionale[/li]
[/ul]

L\'alimentazione dei metadati IPTC è standardizzata ([url]http://www.iptc.org[/url]).
Questo standard è stato stabilito da un consorzio che riunisce le più importanti agenzie di stampa, L\'[i]International Press Telecommunications Council[/i] (abbreviato come IPTC).";
$lang['g003_help_xmp'] = "I metadati XMP sono essenzialmente dei metadati EXIF e IPTC archiviati nell\'immagine in formato XML.

Il vantaggio dei metadati XMP è l\'aggiunta di una certa flessibilità :
[ul]
[li]le informazioni possono essere memorizzate in diverse lingue[/li]
[li]utilizzare di set di caratteri Unicode consente (principalmente) l\'utilizzo di caratteri non latini[/li]
[li]il formato XML facilita lo scambio di informazioni e di interpretazione[/li]
[/ul]

L\'alimentazione dei metadati XMP è standardizzata ([url]http://www.metadataworkinggroup.org/specs[/url]).
Le norme consigliano di utilizzare preferibilmente, se presenti, i metadati EXIF e IPTC.

La conversione dei metadati EXIF e IPTC in XMP viene realizzato solitamente usando un software fotografico.

Il modello XMP essando più povero rispetto al modello EXIF, le conseguenze di questa conversione si traduce con una perdita di informazioni al livello della fotografia. Di solito la perdita di informazioni non è di grande importanza per la maggior parte degli utenti, tuttavia, la norma raccomanda che i software che registrano i metadati XMP conservino i metadati originali : purtroppo non è sempre il caso.
";
$lang['g003_help_magic'] = "Le stesse informazioni possono essere memorizzati in diversi formati all\'interno della foto :
[ul]
[li]può essere presente in tutti i formati[/li]
[li]può essere presente in un solo formato, ma non in un altro[/li]
[/ul]

Ad esempio, l\'apertura del diaframma può essere presente in 4 metadati differenti :
[ul]
[li][b]exif.exif.FNumber[/b][/li]
[li][b]exif.exif.ApertureValue[/b][/li]
[li][b]xmp.exif:ApertureValue[/b][/li]
[li][b]xmp.exif:FNumber[/b][/li]
[/ul]

Per facilitare le restituzione di informazioni che possono essere disperse, il plugin offre un piccolo campione di metadati dei più utilizzati verificandone l\'utilizzo nelle foto, e restituendone le informazioni più pertinenti.
Sono i metadati chiamati [b]Magic[/b].

E dunque, il metadato [b]magic.ShotInfo.Aperture[/b] restituisce :
[ul]
[li]il valore del metadato [b]exif.exif.FNumber[/b] se è presente nella foto, altrimenti[/li]
[li]il valore del metadato [b]xmp.exif:FNumber[/b] se è presente nella foto, altrimenti[/li]
[li]il valore del metadato [b]exif.exif.ApertureValue[/b] se è presente nella foto, altrimenti[/li]
[li]il valore del metadato [b]xmp.exif:ApertureValue[/b] se è presente nella foto[/li]
[/ul]";



/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.0/0.5.1
 */

$lang['g003_y'] = "Sì";
$lang['g003_n'] = "No";

$lang['g003_state'] = "Stato";
$lang['g003_update'] = "Aggiorna";
$lang['g003_personnal'] = "Personali";
$lang['g003_search'] = "Ricerca";

$lang['g003_personnal_metadata'] = "Metadati personalizzati";
$lang['g003_add_a_new_md'] = "Aggiungi un nuovo metadato";
$lang['g003_fill_database'] = "Alimentare il repository";
$lang['g003_num_of_rules'] = "Numero di regole";
$lang['g003_metadatId'] = "Id del metadato";
$lang['g003_rules'] = "Regole";
$lang['g003_add_a_rule'] = "Aggiungere regola";
$lang['g003_typeText'] = "Testo";
$lang['g003_typeMetadata'] = "Metadato";
$lang['g003_typeCondition'] = "Condizione";
$lang['g003_typeCIfExist'] = "Esiste";
$lang['g003_typeCIfNotExist'] = "No esiste";
$lang['g003_typeCIfEqual'] = "E\' uguale a";
$lang['g003_typeCIfNotEqual'] = "Non è uguale a";
$lang['g003_typeCIfLike'] = "Contiene";
$lang['g003_typeCIfNotLike'] = "Non contiene";
$lang['g003_typeCIfBeginWith'] = "Inizia con";
$lang['g003_typeCIfNotBeginWith'] = "Non inizia con";
$lang['g003_typeCIfEndWith'] = "Finisce con";
$lang['g003_typeCIfNotEndWith'] = "Non finisce con";
$lang['g003_conditionIf'] = "Controlla se il metadato";

$lang['g003_invalidId'] = "L\'id del metadato non è valido";
$lang['g003_oneRuleIsNeeded'] = "Ci deve essere almeno una regola di gestione";
$lang['g003_textRuleInvalid'] = "Tipo di regola \"testo\" : il testo non può essere vuoto";
$lang['g003_metadataRuleInvalid'] = "Tipo di regola \"metadato\" : un metadato deve essere selezionato";
$lang['g003_conditionMdRuleInvalid'] = "Tipo di regola \"condizione\" : un metadato deve essere selezionato";
$lang['g003_conditionRulesRuleInvalid'] = "Tipo di regola \"condizione\" : ci deve essere almeno una regola di gestione";

$lang['g003_tagIdAlreadyExist'] = "Un metadato con questo ID esiste già!";

$lang['g003_pleaseConfirmMetadataDelete'] = "Confermare la cancellazione del metadato?";
$lang['g003_deleteMetadata'] = "Cancellazione del metadato";
$lang['g003_delete'] = "Cancella";

$lang['g003_userDefined_filter'] = "Metadati personalizzati";

$lang['g003_informations'] = "Informazioni";
$lang['g003_databaseInformation'] = "Importanti informazioni approposito del repository";
$lang['g003_databaseWarning1'] = "[p]Il repository è costituito da metadati contenuti nelle immagini della galleria, nonché da metadati calcolati dal plugin. A seconda del numero di immagini ed il numero di metadati allegati, il repository può essere molto grande.
Prima di alimentare il repository, assicurarsi che il database fornito dal vostro host consente questo tipo di utilizzo.
[/p][p]E\' da notare che l\'utilizzo del repository è facoltativo, quest\'ultimo non viene utilizzato per la visualizzazione dei metadati delle foto nella galleria.
[/p][p]L\'alimentazione del repository è necessario se si desidera :[/p]
[ul]
[li]disporre di statistiche sui metadati presenti nelle foto (ed è anche un\'aiuto alla selezione dei metadati)[/li]
[li]disporre del motore di ricerca[/li]
[/ul]
";
$lang['g003_sizeAndRows'] = "Il repository fa %s ed è composto da %s metadati";
$lang['g003_numberOfAnalyzedPictures'] = "ùd immagini sono state analizzate";

$lang['g003_options'] = "Opzioni";
$lang['g003_fillDatabaseContinuously'] = "Alimentazione del repository a mano a mano";
$lang['g003_ignoreMetadata'] = "Ignora i metadati seguenti :";

$lang['g003_analyze_analyzed_pictures'] = "L\'analisi riguarda solo le immagini che sono già state analizzate ";
$lang['g003_fillDatabaseIgnoreWarning'] = "Per essere presi in conto, la modifica dei parametri di questa opzione richiede di effettuare un\'analisi";


$lang['g003_add_metadata'] = "Aggiungere un metadato";

$lang['g003_choose_a_metadata'] = "Ricerca sulla valutazione di un metadato";
$lang['g003_add'] = "Aggiungere";
$lang['g003_metadata_value_check_one'] = "Almeno uno dei valori seguenti deve essere controllato :";
$lang['g003_metadata_value_check_all'] = "Tutti i valori riportati di seguito devono essere controllati :";

$lang['g003_metadata_exists'] = "Il metadato %s è presente";
$lang['g003_metadata_dont_exists'] = "Il metadato %s non è presente";
$lang['g003_metadata_equals_all'] = "Il metadato %s è presente ed è uguale ad uno dei seguenti valori :";
$lang['g003_metadata_equals_one'] = "Il metadato %s è presente ed è pari al seguente valore :";
$lang['g003_metadata_not_equals_all'] = "Il metadato %s è presente e non è uguale a nessuno dei seguenti valori :";
$lang['g003_metadata_not_equals_one'] = "Il metadato %s è presente e non è uguale al seguente valore :";
$lang['g003_metadata_like_all'] = "Il metadato %s è presente e contiene uno dei seguenti valori :";
$lang['g003_metadata_like_one'] = "Il metadato %s è presente e contiene il seguente valore :";
$lang['g003_metadata_not_like_all'] = "Il metadato %s è presente e non contiene nessuno dei seguenti valori :";
$lang['g003_metadata_not_like_one'] = "Il metadato %s è presente e non contiene il seguente valore :";
$lang['g003_metadata_begin_all'] = "Il metadato %s è presente ed inizia con uno dei seguenti valori :";
$lang['g003_metadata_begin_one'] = "Il metadato %s è presente ed inizia con il seguente valore :";
$lang['g003_metadata_not_begin_all'] = "Il metadato %s è presente e non inizia con uno dei seguenti valori :";
$lang['g003_metadata_not_begin_one'] = "Il metadato %s è presente e non inizia con il seguente valore :";
$lang['g003_metadata_end_all'] = "Il metadato %s è presente e finisce con uno dei seguenti valori :";
$lang['g003_metadata_end_one'] = "Il metadato %s è presente e finisce con il seguente valore :";
$lang['g003_metadata_not_end_all'] = "Il metadato %s è presente e non finisce con nessuno dei seguenti valori :";
$lang['g003_metadata_not_end_one'] = "Il metadato %s è presente e non finisce con il seguente valore :";

$lang['g003_value_already_set'] = "Il valore è già definito nel dominio dei valori";
$lang['g003_please_set_a_value'] = "Indicare un valore";


$lang['g003_install'] = "Installazione";
$lang['g003_basic_mode'] = "Basica";
$lang['g003_advanced_mode'] = "Avanzata";
$lang['g003_validate'] = "Salvare";
$lang['g003_step_1'] = "Scelta del tipo di uso del plugin";
$lang['g003_basic_mode_help'] = "
La modalità [i]basica[/i] si rivolge a chi vuole semplicemente mostrare le foto con i metadati e propone: [ul]
[li]un\'interfaccia semplificata al massimo [/li]
[li]una breve lista di metadati (circa 140 tra le più comuni)[/li]
[/ul]";
$lang['g003_advanced_mode_help'] = "
La modalità [i]avanzata[/i]si rivolge a chi desidera massimizzare l\'uso dei metadati delle foto e propone : [ul]
[li]un\'interfaccia più complessa, ma completa[/li]
[li]un elenco più completo di metadati (circa 540)[/li]
[li]delle funzionalità estese (statistiche, ricerche, ...)[/li]
[/ul]
La modalità [i]avanzata[/i] richiede la creazione di un repository. ";


$lang['g003_tags'] = "Tag";
$lang['g003_number_of_keywords'] = "Numero di parole chiavi :";
$lang['g003_keyword'] = "Parola chiave";
$lang['g003_tag_in_piwigo'] = "Presente in Piwigo";
$lang['g003_num_of_pictures'] = "Numero di foto";
$lang['g003_num_of_pictures_already_tagged'] = "Numero di foto già taggate";
$lang['g003_convert_ok'] = "La conversione è stata completata con successo";
$lang['g003_convert_keywords_and_apply'] = "Convertire";
$lang['g003_no_keywords'] = "Nessuna parola chiave suscettibile di essere convertita è stata trovata.";


$lang['g003_tags_page_help'] = "Questa funzionalità esegue un\'estrazione di parole chiavi presenti nei metadati per le foto e ti permette di convertirli in [i]Tags[/i].
Le immagini per le quali delle parole chiave sono già state convertite non appaiono più : solo le parole chiave delle immagini per i quali è proposta una conversione e una possibile associazione vengono proposte.";

$lang['g003_search_page_help'] = "E\'possibile effettuare varie ricerche sul contenuto dei metadati, dalle più semplice alle complesse : Aggiungete dei criteri e combinateli usando il drag and drop.";

$lang['g003_personnal_page_help'] = "È possibile creare facilmente dei propri metadati a partire dei metadati esistenti.
[ul]
[li]Aggiungere un\'nuovo metadato[/li]
[li]inserire le sue proprietà[/li]
[li]Aggiungere le regole di gestione e combinatele a piacere con il drag and drop[/li]
[/ul]";

$lang['g003_select_page_help'] = "Solo i metadati qui selezionati sono disponibili nelle altre interfacce di configurazione : ciò permette di ridurre l\'elenco dei metadati a solo quelli che vi sembrano i più rilevanti per il vostro uso.
La selezione è immediatamente prese in considerazione (non è necessario confermarla).";


$lang['g003_display_page_help'] = "I metadati visualizzati con la foto possono essere ordinati e raggruppati.
Di default, solo il gruppo [i]".$lang['g003_default_group_name']."[/i] è disponibile, ma è possibile crearne altri ([i]IPTC[/i], [i]Geolocalizzazione[/i], ...).
[ul]
[li]Create dei gruppi di metadati in base alle vostre esigenze[/li]
[li]Aggiungeteci i metadati da visualizzare[/li]
[li]All\'interno di un gruppo, scegliete l\'ordine di visualizzazione dei metadati con il drag and drop[/li]
[li]Ordinamento dei gruppi di visualizzazione con il drag and drop[/li]
[/ul]
Selezioni & ordinamento sono disponibili immediatamente (non è necessario convalidare).";

$lang['g003_gpc_not_up_to_date'] = "E\' necessario che il plugin <i>Grum Plugin Classes</i> versione %s sia installato.
Attualmente, la versione %s è installata : siete pregati di procedere con l\'aggiornamento della versione del plugin <i>Grum Plugin Classes</i>.";

/** ----------------------------------------------------------------------------
 * removed keys from releases 0.5.0/0.5.1
 */
//$lang['g003_warning_on_analyze_4a']
//$lang['g003_warning_on_analyze_4b']



/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.3
 */
$lang['g003_1_picture_in_caddie'] = "1 immagine nel cestino";
$lang['g003_n_pictures_in_caddie'] = "%s immagini nel cestino";
$lang['g003_analyze_random_pictures'] = "L\'analisi si concentra su %s immagini scelte a caso tra le immagini che non sono mai state analizzate ed aggiunte al repository corrente";
$lang['g003_invalid_random_number'] = "Il numero di immagini da processare non è valido";

$lang['g003_database_is_not_up_to_date'] = "Il repository non è aggiornato!";
$lang['g003_databaseWarning2_1'] = "[p]Un\'nuovo metadato è disponibile dopo l\'ultimo aggiornamento del plugin :[/p][ul]%s[/ul]
[p]
Per potere essere sfruttato, è necessario procedere all\'aggiornare del repository.[/p]";
$lang['g003_databaseWarning2_n'] = "[p]Nuovi metadati sono disponibili dopo l\'ultimo aggiornamento del plugin :[/p][ul]%s[/ul]
[p]
Per potere essere sfruttati, è necessario procedere all\'aggiornare del repository.[/p]";

// help for metadata translation is given at the beginning of this file


?>
