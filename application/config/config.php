<?php

define('BASE_URL', 'http://localhost/samskrita/');
define('PUBLIC_URL', BASE_URL . 'public/');
define('STOCK_IMAGE_URL', BASE_URL . 'public/images/stock/');
define('API_URL', BASE_URL . 'api/');
define('BOOKS_METADATA_URL', BASE_URL . 'md-src/books/');

// Physical location of resources
define('PHY_BASE_URL', '/var/www/html/samskrita/');
define('PHY_PUBLIC_URL', PHY_BASE_URL . 'public/');
define('PHY_FLAT_URL', PHY_BASE_URL . 'application/views/flat/');
define('PHY_BOOKS_METADATA_URL', PHY_BASE_URL . 'md-src/books/');

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '27017');
define('DB_NAME', 'samskritaSAMPATTI');
define('DB_USER', 'samskritaSAMPATTIUSER');
define('DB_PASSWORD', 'samskritaSAMPATTI123');

// use iasINFRA;
// db.createUser(
//    {
//      user: "iasUSER",
//      pwd: "ias123",
//      roles:
//        [
//          { role: "readWrite", db: "iasINFRA" }
//        ]
//    }
// )

// chmod -R 775 .git md-src/
// chmod -R ug+s .git md-src/
// chown -R owner:group .git md-src/

?>
