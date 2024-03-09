<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'fcamera' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'root' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );
define( 'FS_METHOD', 'direct' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'GZdmJ,:x[M:<e4Dn?)NAYWbG}-D.rTYy[r9^:<ZTG)vb):,Bbvr(7ai*Ph^cTT4D' );
define( 'SECURE_AUTH_KEY',  'B2j;Twu=r^U1y0ZWgR@4n#=xpaiC5f0v!h~L.5b {!~*Nk/|U,Bw3J2r=U7(]<,0' );
define( 'LOGGED_IN_KEY',    '_0I7Ey6_>!Gll4M+mRT ^?kRYE@|qv1{$aJTRki]XcMjo2?$Ut4V<a BZzZ|-Uw:' );
define( 'NONCE_KEY',        'F(<sZ,Rv$(JxAsfs$N!:1X.Gt8_HJZ/J`FX0wl!T*nf%JRX]F{tjL^m<HYH$kh@;' );
define( 'AUTH_SALT',        'p4u7UN_np:DMRfIHNDBXW,>}=o`8QT{-PvGs b,T;*E2>&-p[WEU<2?-~>Egl*oW' );
define( 'SECURE_AUTH_SALT', 'mKK*Z44c(6ovd&_k4!Z}/}4.Ilz#sztU!h([p|yM7{n2]ngUh]IVZvEt#`X7A: !' );
define( 'LOGGED_IN_SALT',   'P89Pj/%nTF5pSU+?Z9Of,n^RZ^IAI2. $!$JYXq<W38)=i99p9-e&Oq~1Ru)E]Su' );
define( 'NONCE_SALT',       '#,Z![Fr+t~_Cr@bN*!{pP[ s;Z[;0mvf+(lsessYfe!0CPuyBtdYDNB|rPOAsC/.' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
