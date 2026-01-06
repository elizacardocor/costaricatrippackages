<?php
// Loader for Adminer (no IP restriction)
// Try to load Adminer from vendor if present
$vendorAdminerDir = __DIR__ . '/../vendor/vrana/adminer/adminer';
$vendorAdminer = $vendorAdminerDir . '/index.php';
if (file_exists($vendorAdminer)) {
  // Ensure relative includes inside Adminer resolve correctly
  chdir($vendorAdminerDir);
  require $vendorAdminer;
  exit;
}

// Fallback: attempt to include a locally bundled adminer file if present
$localAdminer = __DIR__ . '/adminer-full.php';
if (file_exists($localAdminer)) {
    require $localAdminer;
    exit;
}

// If neither exists, show instructions to download Adminer
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Adminer not installed</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;padding:2rem}</style>
  </head>
  <body>
    <h1>Adminer no está instalado</h1>
    <p>Para usar Adminer descarga <a href="https://www.adminer.org/latest.php">latest.php</a> y guárdalo como <code>public/adminer-full.php</code>, o instala el paquete <code>vrana/adminer</code> vía Composer.</p>
    <pre>composer require vrana/adminer --dev</pre>
    <p>Luego visita <a href="/adminer.php">/adminer.php</a> en tu navegador (desde localhost).</p>
  </body>
  </html>
