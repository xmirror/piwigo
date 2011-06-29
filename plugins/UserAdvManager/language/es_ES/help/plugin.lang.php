<?php
global $lang;

$lang['UAM_restricTitle'] = 'Restricciones para el registro';
$lang['UAM_confirmTitle'] = 'Confirmaciones y validaciones de registro';
$lang['UAM_confirmTitle_d'] = '
- Información por correo electrónico para el usuario<br>
- Confirmación de registro<br>
- Grupos o estatutos de validación<br>
- Plazo para la validación de registro<br>
- Recuerde a los usuarios no validados<br>
...
';
$lang['UAM_miscTitle'] = 'Registros seguido y otras opciones';
$lang['UAM_carexcTitle'] = 'Nombres de usuario: Excluyendo los caracteres';
$lang['UAM_carexcTitle_d'] = 'Puede ser interesante para prohibir ciertos caracteres en nombres de usuario (por ejemplo, se niegan los inicios de sesi&oacute;n que contiene &quot;@&quot;). Esta opci&oacute;n permite excluir caracteres o secuencia de caracteres, los acontecimientos.<br>
Nota: La opción también puede excluir palabras completas.
<br><br>
<b style=&quot;color: red;&quot;>Advertencia: Esta opción no tiene efecto sobre los nombres de usuario creados antes de su activación.</b>';
$lang['UAM_passwTitle'] = 'Fortalecimiento del nivel de seguridad de las contraseñas';
$lang['UAM_passwTitle_d'] = 'Al habilitar esta opción hace obligatoria la creación de una contraseña en el registro, y requiere la contraseña elegida por el usuario para cumplir un nivel mínimo de complejidad. Si el umbral no se alcanza, la puntuación obtenida y la puntuación mínima que deben alcanzarse se muestran, junto con recomendaciones para aumentar el valor de esta puntuación.<br><br>
Un campo de prueba permite medir la complejidad de la contraseña, y puede hacerse una idea de la puntuación necesaria para alcanzar una contraseña valida .<br><br>
Nota: La puntuación de una contraseña se calcula en función de varios parámetros: longitud, tipo de caracteres utilizados (letras, números, mayúsculas, minúsculas, caracteres especiales). Una puntuación por debajo de 100 se considera bajo, de 100 a 500, la complejidad es mediana, más allá de 500, la seguridad es excelente.';
$lang['UAM_passwtestTitle'] = 'Prueba de la complejidad de la contraseña';
$lang['UAM_passwtestTitle_d'] = 'Introduzca la contrase&ntilde;a para pruebar y luego haga clic en &quot;c&aacute;lcular complejidad&quot; para ver el resultado.';
$lang['UAM_passwadmTitle'] = 'Aplicando a los administradores';
$lang['UAM_passwadmTitle_d'] = 'Un administrador puede crear una cuenta de usuario, con o sin aplicación de la regla de la complejidad informática.<br><br>
Nota: Si el  usuario de la cuenta  creada quiere cambiar la contraseña, y el fortalecimiento de las contraseñas de los usuarios está activo, la misma estará sujeta a la norma establecida.';
$lang['UAM_mailexcTitle'] = 'Exclusión de dominios de correo electrónico';
$lang['UAM_infomailTitle'] = 'Información por correo electrónico para el usuario';
$lang['UAM_infomailTitle_d'] = 'Esta opción permite automatizar el envío de un correo electrónico y la información a un usuario cuando se registra o cuando cambie su contraseña o dirección de correo electrónico en su perfil.<br><br>
El contenido del mensaje enviado se compone de una parte personalizable para introducir una nota de bienvenida, y una parte fija que indica el inicio de sesión, contraseña y dirección de correo electrónico del usuario.';
$lang['UAM_infotxtTitle'] = 'Personalización del correo electrónico de información';
$lang['UAM_confirmtxtTitle'] = 'Personalización del mensaje recordatorio';
$lang['UAM_confirmgrpTitle'] = 'Grupos de validación';
$lang['UAM_confirmgrpTitle_d'] = '<b style=&quot;color: red;&quot;>ADVERTENCIA: El uso de grupos de validación requiere que se haya creado al menos un grupo de usuarios y se define &quot;por defecto&quot; en la gestión de Piwigo de grupos de usuarios.</b><br><br>
Los grupos est&aacute;n validados para su uso en relaci&oacute;n con la &quot;confirmaci&oacute;n de registro&quot;';
$lang['UAM_confirmstatTitle'] = 'Estatutos de validación';
$lang['UAM_confirmstatTitle_d'] = '<b style=&quot;color: red;&quot;>ADVERTENCIA: El uso de la validaci&oacute;n de estado requiere que se haya mantenido el &quot;Invitado&quot; del usuario con la configuraci&oacute;n predeterminada (como usuario de plantilla) para los nuevos registrados. Nota Puede establecer cualquier otro usuario como una plantilla para nuevos registrados. Por favor, consulte la documentaci&oacute;n de Piwigo para obtener m&aacute;s detalles.</b><br><br>
Los estatutos son validados para su uso en relaci&oacute;n con la &quot;confirmaci&oacute;n de registro&quot;';
$lang['UAM_validationlimitTitle'] = 'Plazo para la validación de registro limitado';
$lang['UAM_remailTitle'] = 'Recordarle a los usuarios no validados';
$lang['UAM_remailtxt1Title'] = 'Recordatorio por correo electrónico con la llave generada';
$lang['UAM_remailtxt2Title'] = 'Recordatorio por correo electrónico sin la llave generada';
$lang['UAM_ghosttrackerTitle'] = 'Gestión de usuarios fantasmas';
$lang['UAM_gttextTitle'] = 'Mensaje recordatorio de Ghost Tracker';
$lang['UAM_lastvisitTitle'] = 'Seguimiento de usuarios registrados';
$lang['UAM_lastvisitTitle_d'] = 'Esto activa una tabla de &quot;Seguimiento de los usuarios&quot; ficha de matriculaci&oacute;n de los usuarios que aparecen en la galer&iacute;a y la fecha de su &uacute;ltima visita y el tiempo (en d&iacute;as) desde su &uacute;ltima visita. El seguimiento es meramente informativo para el administrador de la galer&iacute;a.';
$lang['UAM_tipsTitle'] = 'Consejos y ejemplos';
$lang['UAM_tipsTitle_d'] = 'Consejos y diversos ejemplos de uso de';
$lang['UAM_userlistTitle'] = 'Seguimiento de los usuarios';
$lang['UAM_usermanTitle'] = 'Seguimiento de las Validaciones';
$lang['UAM_gtTitle'] = 'Gestión de los usuarios fantasmas';


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_adminconfmailTitle'] = 'Confirmaci&oacute;n de registro por los administradores';
$lang['UAM_adminconfmailTitle_d'] = 'Puede desactivar esta validaci&oacute;n s&oacute;lo para las cuentas de usuario creadas por el administrador de Piwigo a trav&eacute;s de la interfaz de gesti&oacute;n de los usuarios.<br><br>
Al activar esta opci&oacute;n, la validaci&oacute;n del email de registro ser&aacute; enviado a cada usuario creado por el administrador.<br><br>
Al deshabilitar esta opci&oacute;n (por defecto), s&oacute;lo el coreo de informaci&oacute;n  se env&iacute;a (si &quot;Informaci&oacute;n por correo electr&oacute;nico para el usuario&quot; est&aacute; activado).';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_restricTitle_d'] = '
- Excluyendo los caracteres<br>
- Ejecución Contraseña<br>
- Exclusión de dominios de correo electrónico<br>
...
';
$lang['UAM_userlistTitle_d'] = 'Esta p&aacute;gina es para informaci&oacute;n al administrador. Se muestra una lista de todos los usuarios registrados en la galer&iacute;a que indique la fecha y el n&uacute;mero de d&iacute;as transcurridos desde su &uacute;ltima visita. La lista est&aacute; ordenada por orden ascendente del n&uacute;mero de d&iacute;as.
<br><br>
<b><u>S&oacute;lo cuando el Ghost Tracker est&aacute; activo</u></b>, el n&uacute;mero de d&iacute;as sin visita aparece con el c&oacute;digo de color siguientes, seg&uacute;n el plazo m&aacute;ximo establecido en las opciones de Ghost Tracker:
<br>
- <b style=&quot;color: lime;&quot;>Verde</b> : Cuando el usuario ha visitado la galer&iacute;a de <b style=&quot;color: lime;&quot;><u>menos del 50%</u></b> del plazo m&aacute;ximo indicado en el Ghost Tracker.<br>
- <b style=&quot;color: orange;&quot;>Naranja</b> : Cuando el usuario ha visitado la galer&iacute;a de <b style=&quot;color: orange;&quot;><u>entre 50% y 99%</u></b> del plazo m&aacute;ximo indicado en el Ghost Tracker.<br>
- <b style=&quot;color: red;&quot;>Rojo</b> : Cuando el usuario ha visitado la galer&iacute;a de <b style=&quot;color: red;&quot;><u>por más de 100%</u></b> del plazo m&aacute;ximo indicado en el Ghost Tracker. <b><u>En este caso, el usuario tambi&eacute;n debe aparecer en el cuadro Ghost Tracker.</u></b><br>
<br>
Ejemplo :
<br>
El per&iacute;odo m&aacute;ximo de Ghost Tracker est&aacute; configurado para 100 d&iacute;as.
<br>
Un usuario aparecer&aacute; en verde si visit&oacute; la galer&iacute;a hace menos de 50 d&iacute;as, en naranja si su &uacute;ltima visita tuvo lugar entre el 50 y 99 d&iacute;as y el rojo durante 100 d&iacute;as o m&aacute;s.
<br><br>
<b>NOTA</b>: La lista no muestra que no han validado su registro (si la opci&oacute;n de validar el registro est&aacute; activado). Estos usuarios estan administrados despu&eacute;s de una manera particular en la pestaña &quot;Seguimiento de las Validaciones&quot;.
<br><br>
<b>Funciones Clasificación de la tabla</b>: Puede ordenar los datos mostrados, haga clic en los encabezados de columna. Sostenga la tecla SHIFT para ordenar hasta 4 columnas máxima simultánea.';
$lang['UAM_usermanTitle_d'] = 'Cuando el limite de plazo de inscripción está habilitado, podrá encontrar más adelante la lista de usuarios cuya validación de registro esta en espera, <b style=&quot;text-decoration: underline;&quot;>si o no</b> que están en el tiempo para validar.<br><br>
La fecha de registro se muestra en verde cuando el usuario en cuestión está por debajo del límite de tiempo para validar su inscripción. En este caso, la clave de validación es todavía válida y que puede enviar un correo electrónico con o sin una clave de validación nueva.<br><br>
Cuando la fecha de registro aparece en rojo, el período de validación ha caducado. En este caso, debe enviar un correo electrónico con la regeneración de la clave de validación si desea que el usuario pueda validar su inscripción.<br><br>
En todos los casos, es posible forzar manualmente la validación.<br><br>
En esta vista, puede:
<br><br>
- Eliminar manualmente las cuentas de <b>(drenaje manual)</b>
<br>
- Generar recordatorio por correo electrónico <b>sin</b> generar una nueva clave. Advertencia: Enviar un recordatorio por correo electrónico dirigido a los visitantes. Esta función no restaura la fecha de registro de visitantes apuntado y el tiempo de espera sigue siendo válido.
<br>- Generar recordatorio por correo electrónico <b>con</b> generar una nueva clave. Advertencia: Enviar un recordatorio por correo electrónico dirigido a los visitantes. Esta función también restablece la fecha de registro de visitantes y específicos, que equivale a prorrogar el plazo para la validación.
<br>
- Presentar una solicitud de registro en espera de validación manual, aunque la fecha de caducidad ha pasado <b>(forzando la validación)</b>.
<br><br>
<b>Funciones Clasificación de la tabla</b>: Puede ordenar los datos mostrados, haga clic en los encabezados de columna. Sostenga la tecla SHIFT para ordenar hasta 4 columnas máxima simultánea.';
$lang['UAM_gtTitle_d'] = 'Cuando el Tracker Ghost est&aacute; habilitado y se inicializa, se encuentra por debajo de la lista de visitantes registrados que no han regresado desde los x d&iacute;as. &quot;x&quot; es el n&uacute;mero de d&iacute;as configurado en la pesta&ntilde;a Configuraci&oacute;n general. Adem&aacute;s, usted encontrar&aacute; una columna que indica si un recordatorio por correo electr&oacute;nico ha sido enviado a los visitantes espec&iacute;ficos. As&iacute;, se puede ver a simple vista y tratar a los visitantes que no han tenido en cuenta el recordatorio.<br><br>
En esta vista, puede:
<br><br>
- Elimine manualmente las cuentas de <b>(drenaje manual)</b>
<br>
- Generar recordatorio por correo electrónico <b>con el cambio de la fecha de última visita</b>. Esto permite dar un comodín a los visitantes específicos. Si el visitante ya ha recibido un recordatorio, nada impide a enviar un nuevo correo que se restablecerá la fecha de la última visita.
<br><br>
<b>Funciones Clasificación de la tabla</b>: Puede ordenar los datos mostrados, haga clic en los encabezados de columna. Sostenga la tecla SHIFT para ordenar hasta 4 columnas máxima simultánea.';
$lang['UAM_confirmmailTitle'] = 'Confirmación de registro';
/*TODO*/$lang['UAM_confirmmailTitle_d'] = 'This option allows a user to either confirm registration by clicking on a link received in an email sent upon registration or the administrator to manually activate the registration.<br><br>
In first case, the e-mail is composed of a customizable part to introduce a little welcome note and a fixed part containing the activation link that is generated from a random key that can possibly regenerate through the &quot;Tracking validations&quot; tab.<br><br>
Dans le premier cas, le message envoyé comprend une partie fixe, avec le lien d\'activation généré à partir d\'une clef aléatoire (cette clé peut éventuellement être régénérée via l\'onglet &quot;Suivi des validations&quot;), et une partie personnalisable par un texte d\'accueil.
<br><br>
In second case, <b><u>there is no validation key send by email!</u></b>. Visitors have to wait until an administrator validate them himself in &quot;Validation tracking&quot; tab. It\s recommanded to activate the Piwigo\'s option &quot;Email admins when a new user registers&quot; (see in Piwigo\'s configuration options) and to use the &quot;Information email to user&quot; to warn new registers to wait on their account activation.
<br>
<b style=&quot;color: red;&quot;>NB: Options &quot;Deadline for registration validation limited&quot; and &quot;Remind unvalidated users  &quot; have to be set to off when admin\'s manual validation is enabled.</b>
<br><br>
Esta opci&oacute;n se utiliza generalmente con la asignaci&oacute;n autom&aacute;tica de grupo y / o estatutos. Por ejemplo, un usuario que no ha validado su registro se encuentra en un grupo espec&iacute;fico de usuarios (con o sin restricciones a la galer&iacute;a) mientras que un usuario que haya validado su registro se encuentra en un &quot;normal&quot; del grupo.';
$lang['UAM_RedirTitle'] = 'Redirigir a la página de &quot;personalizaci&oacute;n&quot;';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.15.6
$lang['UAM_RedirTitle_d'] = 'Esta opción se redireccionan automáticamente un usuario registrado para su página de personalización sólo en su primera conexión a la galería.<br><br>
Atención: Esta característica no se aplica a todos los usuarios registrados. Las personas con estados &quot;admin&quot;, &quot;webmaster&quot; o &quot;generic&quot; están excluidos.';
// --------- End: New or revised $lang ---- from version 2.15.6


// --------- Starting below: New or revised $lang ---- from version 2.16.0
$lang['UAM_confirmmail_custom1'] = 'Texto de la página de confirmación - Confirmación aceptada';
$lang['UAM_confirmmail_custom2'] = 'Texto de la página de confirmación - Confirmación rechazada';
/*TODO*/$lang['UAM_ghosttrackerTitle_d'] = 'Also called &quot;Ghost Tracker&quot;, when this function is activated, you can manage your visitors depending on the frequency of their visits. 2 operating modes are available:<br><br>
- Manual management : When the time between 2 visits is reached,, the visitor appears in the &quot;Ghost Tracker&quot; table where you will be able to remind visitors via email or delete him.<br><br>
- Automated management : When the period between 2 successive visits is reached, the visitor is automatically deleted or moved into a wait group and/or status. In this second case, an information email can be sent to him.<br><br>
<b style=&quot;color: red;&quot;>Important note : If you enable this feature for the first time or you have reactivated after a long period off during which new visitors are registered, you must initialize or reset the Ghost Tracker (see corresponding instructions on &quot;Ghost Tracker&quot; tab).</b>';
$lang['UAM_miscTitle_d'] = '
- Automatic or manual management of ghosts users<br>
- Followed registered users<br>
- Nickname mandatory for guests comments<br>
...
';
$lang['UAM_mailexcTitle_d'] = 'De forma predeterminada, Piwigo acepta todas las direcciones de correo electrónico en el  formato xxx@yyy.zz. Al habilitar esta opción le permite excluir ciertos dominios en el formato: @[nombreDeDominio].[Domain_extension].<br><br>
Ejemplos :<br>
@hotmail.com -> con exclusión de direcciones *@hotmail.com<br>
@hotmail -> con exclusión de todas las direcciones de *@hotmail*';
$lang['UAM_GTAutoTitle'] = 'Gestión automática de los Espíritus usuarios';
/*TODO*/$lang['UAM_GTAutoTitle_d'] = 'This option allows to apply rules for automated management of ghosts users.
<br><br>Basic Principle: A user who reaches the maximum time between visits <b><u>and</u></b> has already been notified by email is considered as expired. Then you can apply automated processing rules such as automatic deletion of expired accounts or demotion by restricting access to the gallery (switch automatically to a restricted group and/or status).
<br><br>The triggering of these automation is achieved when connecting users (any user!) to the gallery.';
$lang['UAM_GTAutoDelTitle'] = 'Mensaje personalizado en cuenta eliminada';
$lang['UAM_GTAutoGpTitle'] = 'Cambio automático de grupo / estado';
/*TODO*/$lang['UAM_GTAutoGpTitle_d'] = 'The automatic change of group or status equivalent to a demotion of the accounts involved and working on the same principle as the group or the status of validation (see &quot;Setting confirmations and validations of registration&quot;). Therefore be to define a group and / or status demoting access to the gallery. If this has already been defined with the use of registration confirmation function, you can use the same group / status.<br><br>
<b style=&quot;color: red;&quot;>Important note :</b> If a ghost user still has not heard from after the time limit and despite the automatic notification by email (if enabled), he\'s automatically deleted from the database.';
$lang['UAM_GTAutoMailTitle'] = 'Automáticamente el envío de un correo electrónico cuando se cambia de grupo / estado';
$lang['UAM_AdminValidationMail'] = 'Notificación de la validación manual de registro';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
/*TODO*/$lang['UAM_CustomPasswRetrTitle'] = 'Customize lost password email content';
/*TODO*/$lang['UAM_validationlimitTitle_d'] = 'Esta opción permite limitar la validez de la validación de claves de correo electrónico enviado a los solicitantes de registro nuevo. Los visitantes que se registren tendrán x días de tiempo para validar su inscripción. Después de este período el enlace de validación expira.
<br><br>
Esta opci&oacute;n se utiliza en conjunci&oacute;n con la &quot;confirmaci&oacute;n de registro&quot;
<br><br>
If this option and the option &quot;Recordarle a los usuarios no validados&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/*TODO*/$lang['UAM_remailTitle_d'] = 'Esta opci&oacute;n le permite enviar un recordatorio por correo electr&oacute;nico a los usuarios registrados, que no han validado su inscripci&oacute;n a tiempo. Por lo tanto, trabaja en conjunto con la &quot;confirmaci&oacute;n de registro&quot;
<br><br>
2 tipos de mensajes de correo electrónico se pueden enviar: Con o sin regeneración de la clave de validación. Según proceda, el contenido de los mensajes de correo electrónico se pueden personalizar.
<br><br>
Consulte la ficha &quot;Seguimiento de las Validaciones&quot;.
<br><br>
If this option and the option &quot;Plazo para la validación de registro limitado&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/*TODO*/$lang['UAM_USRAutoTitle'] = 'Automatic management of unvalidated users';
/*TODO*/$lang['UAM_USRAutoTitle_d'] = 'Automatic handling of unvalidated visitors is triggered each time you connect to the gallery and works as follows:
<br><br>
- Automatic deletion of accounts not validated in the allotted time without sending automatic email reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> and &quot;Remind unvalidated users&quot; <b><u>disabled</u></b>.
<br><br>
- Automatically sending a reminder message with a new generation of validation key and automatic deletion of accounts not validated in the time after sending the reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> et &quot;Remind unvalidated users&quot; <b><u>enabled</u></b>.';
/*TODO*/$lang['UAM_USRAutoDelTitle'] = 'Custom message on deleted account';
/*TODO*/$lang['UAM_USRAutoMailTitle'] = 'Automated email reminder';
/*TODO*/$lang['UAM_USRAutoMailTitle_d'] = 'When activated, this function will automatically send personalized content in &quot;Reminder email with new key generated&quot; to visitors who match criteria.';
$lang['UAM_StuffsTitle'] = 'PWG Stuffs módulo';
/*TODO*/$lang['UAM_StuffsTitle_d'] = 'This enables an additional UAM block in PWG Stuffs plugin (if installed) to inform your visitors who did not validate their registration about their condition.
<br><br>
Please refer to the <b>Consejos y ejemplos</b> at the bottom of this page for details.';
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
$lang['UAM_HidePasswTitle'] = 'Contraseña en texto claro en la información del correo electrónico';
/*TODO*/$lang['UAM_HidePasswTitle_d'] = 'Choose here if you want to display the password chosen by the visitor in the information email. If you enable the option, the password will then appear in clear text. If you disable the password will not appear at all.';
// --------- End: New or revised $lang ---- from version 2.20.4


// --------- Starting below: New or revised $lang ---- from version 2.20.11
/*TODO*/$lang['UAM_gttextTitle_d'] = 'Introduzca el texto que desea que aparezca en el recordatorio por correo electrónico para pedir al usuario volver a visitar su galería (Nota: El texto pre-llenado con la instalación del plugin se presenta como un ejemplo).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options. Use <b style=&quot;color: red;&quot;>[days]</b> to insert the maximum numbers of days between two visits.
<br><br>
Para utilizar varios idiomas, puede utilizar las etiquetas para el plugin Extended description si está activo.';
/*TODO*/$lang['UAM_confirmtxtTitle_d'] = 'Introduzca el texto de introducción que desea que aparezca en el correo electrónico de confirmación de registro.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Plazo para la validación de registro limitado;&quot; have to be enabled).
<br><br>
Para utilizar varios idiomas, puede utilizar las etiquetas para el plugin Extended description si está activo.';
/*TODO*/$lang['UAM_remailtxt1Title_d'] = 'Introduzca el texto de introducción que desea que aparezca en el recordatorio por correo electrónico, además de la clave de validación regenerada.
<br><br>
Si se deja en blanco, el aviso de correo electrónico sólo incluirá el enlace de validación. Por tanto, es muy recomendable tomar un pequeño texto explicativo. (Nota: El texto pre-llenado con la instalación del plugin se proporciona como un ejemplo).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Plazo para la validación de registro limitado;&quot; have to be enabled).
<br><br>
Para utilizar varios idiomas, puede utilizar las etiquetas para el plugin Extended description si está activo.';
/*TODO*/$lang['UAM_remailtxt2Title_d'] = 'Introduzca el texto de introducción que desea que aparezca en el recordatorio por correo electrónico sin una clave de validación regenerada.
<br><br>
Si se deja en blanco, el aviso de correo electrónico estará vacío. Por lo tanto, es muy recomendable poner un pequeño texto explicativo. (Nota: El texto pre-llenado con la instalación del plugin se proporciona como un ejemplo).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Plazo para la validación de registro limitado;&quot; have to be enabled).
<br><br>
Para utilizar varios idiomas, puede utilizar las etiquetas para el plugin Extended description si está activo.';
/*TODO*/$lang['UAM_infotxtTitle_d'] = 'Introduzca el texto de introducción que desea ver en el correo electrónico de la información.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Para utilizar varios idiomas, puede utilizar las etiquetas para el plugin Extended description si está activo.';
/*TODO*/$lang['UAM_AdminValidationMail_d'] = 'When an administrator or Webmaster of the gallery manually valid registration pending, a notification email is automatically sent to the user. Enter here the text that appears in this email.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
To use multiple languages, you can use the Extended description plugin\'s tags if it is active.';
/*TODO*/$lang['UAM_confirmmail_custom1_d'] = 'When the option &quot;Confirmation of registration&quot; is active, this field allows you to customize the <b><u>acceptance text</u></b> on the registration confirmation page displayed when user clicks the confirmation link that was received by email.
<br><br>
After installing the plugin, a standard text is set as an example.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
This field is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
/*TODO*/$lang['UAM_confirmmail_custom2_d'] = 'When the option &quot;Confirmation of registration&quot; is active, this field allows you to customize the <b><u>rejectance text</u></b> on the registration confirmation page displayed when user clicks the confirmation link that was received by email.
<br><br>
After installing the plugin, a standard text is set as an example.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
This field is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
/*TODO*/$lang['UAM_GTAutoDelTitle_d'] = 'This is only valid when the user whose account has expired itself triggers the deletion mechanism (rare but possible). he\'s then disconnected of the gallery and redirected to a page showing the deletion of his account and, possibly, the reasons for this deletion.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
<b style=&quot;color: red;&quot;>[username]</b> is not available here because concerned user has been deleted.
<br><br>
Custom text for the redirect page can be entered in this field that is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
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
To use multiple languages, you can use the Extended description plugin\'s tags if it is active.
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