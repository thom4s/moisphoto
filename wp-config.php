<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'moisphoto');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[@Y+Nz%Haktsqw9r4XSsPv{$QSF<^QBogGPo^)[.;-Wri?$~JB.S#DjiGh(uzJ`8');
define('SECURE_AUTH_KEY',  'A&PhbqPkj1F6h4En)$?r*`xELL6noFU%kn~SG7cTDl]udJ2o9k&~ /,(Bj-L@:7p');
define('LOGGED_IN_KEY',    'RKQ]IPY^jlaoJmoUHwI!00puPn:rGm,XdQ|GNle+0.5y(V9C@^D:r)h7^~o0@Y$E');
define('NONCE_KEY',        '{n:!<fNfzeaGvB0Rd__d9 q{y$mK(+No0;&8,#`BOfFfT9:4{I@%i<6f`L7EXN>u');
define('AUTH_SALT',        'MX7)?cb]^~?c4XW]QBmeqCaxU.j#Q[RdnMUHD_5O=ofd{L:i$WO(1Ho!y[Xxy:hs');
define('SECURE_AUTH_SALT', '.:bvurCtp7Z4=0R~3Xm6`-AkyYc/7-%(#W^>|}}q& `4.(B:|0op#~=(}T)V0Ou*');
define('LOGGED_IN_SALT',   'w[B6y89n/1i%U<RbS&c[?d^#u BG zoEH)! 7eL2pb4{jlM^I&Q]yECW:N~0.3!D');
define('NONCE_SALT',       'RxdAPXt~9~X,?weH1(ThGj^*k*ue5=e9P;IfuC4q.J^Ki*R9|xlP)kA7(#dB_HLh');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');