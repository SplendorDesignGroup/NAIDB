<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'naidb_wp');

/** MySQL database username */
define('DB_USER', 'naidb_wp');

/** MySQL database password */
define('DB_PASSWORD', 'r_rUT$1pF^IM');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         '*/8jV|e(fs*w|E-1q0K{r}1/V-zCKn_tw-^armA^d<l%+H0pN&_(7)P=X^^8Z&Rv');
define('SECURE_AUTH_KEY',  'w<Yj]_UvWp.+30H.Tfbnwzt-D4<h.WCN6qsW%1zj744 ln76MVk6,(<1NT&*)+!M');
define('LOGGED_IN_KEY',    'gIXOTgt|~I.=j=b=o-+V)u]h&A;aHul<:]g.n:DF*] FsM5v`T!d(4:~we@!tJ[z');
define('NONCE_KEY',        'Y Wco_:Q7F-WW+(yF!e^He[Kg|)s[)UZ0J+cU=g,gnA3+qZ]^}w`8!Dn*[6qZ<VO');
define('AUTH_SALT',        '-azGi<mJ);mt.0 jR5&#6y1| #PhT)u4}H$pAF=r -{+M]lL1.tS+GxtrCWR):E:');
define('SECURE_AUTH_SALT', '<S?q77z%pdfhHu=N2Uy08>{DW/U^Y, 93lR`@ppBj{48[aNMV?8g0s+<n^S.Xn/(');
define('LOGGED_IN_SALT',   'mmGo1+QyBE!D=9PAG/kOJRL*wVBXYxBXq>6LF5HVsSg%-]M=%C.L0{{^+%% [,rF');
define('NONCE_SALT',       'A(DP~e[67U&2i.qnvM$$9(I}9+-1+]X+b[N)b/Q!#S9;9C(#`dt%rr1y^$E>LAxQ');


$table_prefix = 'wp_';





define('ALLOW_UNFILTERED_UPLOADS', true);
define('WP_MEMORY_LIMIT','64M');
define('WP_DEBUG', false);
define('FORCE_SSL_ADMIN',true);
define('FORCE_SSL_LOGIN',true);
//define('ALTERNATE_WP_CRON', true);
define('EMPTY_TRASH_DAYS', 1);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define('FS_METHOD','direct');

