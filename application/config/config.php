<?php

define('BASE_URL', 'http://192.168.1.101/samskrita-sampatti/');
define('PUBLIC_URL', BASE_URL . 'public/');
define('STOCK_IMAGE_URL', BASE_URL . 'public/images/stock/');
define('API_URL', BASE_URL . 'api/');
define('BOOKS_METADATA_URL', BASE_URL . 'md-src/books/');
define('JOURNALS_METADATA_URL', BASE_URL . 'md-src/journals/');
define('IMAGE_URL', PUBLIC_URL . 'images/');


// Physical location of resources
define('PHY_BASE_URL', '/var/www/html/samskrita-sampatti/');
define('PHY_PUBLIC_URL', PHY_BASE_URL . 'public/');
define('PHY_FLAT_URL', PHY_BASE_URL . 'application/views/flat/');
define('PHY_BOOKS_METADATA_URL', PHY_BASE_URL . 'md-src/books/');
define('PHY_JOURNALS_METADATA_URL', PHY_BASE_URL . 'md-src/journals/');
define('PHY_JSON_PRECAST_URL', PHY_BASE_URL . 'json-precast/');

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '27017');
define('DB_NAME', 'samskritaSAMPATTI');
define('DB_USER', 'samskritaSAMPATTIUSER');
define('DB_PASSWORD', 'sampati123');

// use samskritaSAMPATTI;
// db.createUser(
//    {
//      user: "samskritaSAMPATTIUSER",
//      pwd: "sampati123",
//      roles:
//        [
//          { role: "readWrite", db: "samskritaSAMPATTI" }
//        ]
//    }
// )

// chmod -R 775 .git md-src/
// chmod -R ug+s .git md-src/
// chown -R owner:group .git md-src/

?>
