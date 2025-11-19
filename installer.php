#!/usr/bin/php
<?php
/****************************************************
 *  PyNoxi — Composer For cPanel
 *  Website : https://pynoxi.com
 *  Forum   : https://forum.pynoxi.com
 *  Repo    : https://github.com/pynoxi/Composer-For-cPanel
 ****************************************************/

// ---------- CLI ONLY ----------
if (php_sapi_name() !== 'cli') {
    http_response_code(403);
    die("403 - CLI access only.\n");
}

// ---------- Detect HOME & USERNAME ----------
$home = getenv("HOME");
$username = basename($home);

if (!$home && function_exists('posix_getpwuid')) {
    $info     = posix_getpwuid(posix_getuid());
    $home     = $info['dir'] ?? null;
    $username = $info['name'] ?? "unknown";
}

if (!$home || !chdir($home)) {
    echo "Error: Unable to access HOME directory.\n";
    exit(1);
}

// ---------- COLORS ----------
$B = "\033[1m";
$R = "\033[0m";
$C = "\033[36m";
$G = "\033[32m";
$Y = "\033[33m";
$D = "\033[90m";
$RED = "\033[31m";

// ---------- Smooth output ----------
function smooth($text, $delay = 20000) {
    for ($i = 0; $i < strlen($text); $i++) {
        echo $text[$i];
        usleep($delay);
    }
    echo "\n";
}

function progress($seconds = 2) {
    $total = 28;
    for ($i = 0; $i <= $total; $i++) {
        $bar = str_repeat("█", $i) . str_repeat("░", $total - $i);
        printf("\r[%s] %d%%", $bar, ($i / $total) * 100);
        usleep(($seconds * 1000000) / $total);
    }
    echo "\n";
}

// ---------- CLEAR SCREEN ----------
echo chr(27)."[H".chr(27)."[2J";

// ---------- Responsive Professional Box ----------
echo $B.$C."
╔═══════════════════════════════════════════════════════════╗
║                Composer Installer Utility                 ║
╠═══════════════════════════════════════════════════════════╣
║  Website : https://pynoxi.com                             ║
║  Forum   : https://forum.pynoxi.com                       ║
║  Repo    : https://github.com/pynoxi/Composer-For-cPanel  ║
╚═══════════════════════════════════════════════════════════╝
".$R;

echo "\n".$B.$Y."Installing Composer for cPanel Account ($username)".$R."\n";
echo $D."Home Directory: $home\n\n".$R;

// ---------- Step 1: Check Composer ----------
smooth($C."Checking existing Composer installation...".$R);
progress(1.2);

exec("composer -v 2>&1", $chOut, $chRet);

if ($chRet === 0) {
    echo $G.$B."\nComposer is already installed.\n".$R;
    echo $Y."Nothing to do.\n".$R;
    exit(0);
}

// ---------- Step 2: Download installer ----------
smooth($C."Downloading Composer installer (installer.php)...".$R);
exec('php -r "copy(\'https://getcomposer.org/installer\', \'installer.php\');"');
progress();

if (!file_exists("installer.php")) {
    echo $RED.$B."Error: Failed to download installer.php\n".$R;
    exit(1);
}

// ---------- Step 3: Run Composer installer ----------
smooth($C."Running Composer installer...".$R);
exec("php installer.php", $iOut, $iRet);
progress();

if (!file_exists("composer.phar")) {
    echo $RED.$B."Error: composer.phar not created.\n".$R;
    exit(1);
}

// ---------- Step 4: Move composer ----------
smooth($C."Finalizing installation...".$R);

$targetDir = "$home/.local/bin";
if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

rename("composer.phar", "$targetDir/composer");
chmod("$targetDir/composer", 0755);
progress();

// ---------- CLEANUP ----------
if (file_exists("installer.php")) unlink("installer.php");

// ---------- CLEAR OLD SCREEN BEFORE SUCCESS ----------
sleep(1);
echo chr(27)."[H".chr(27)."[2J";

// ---------- FINAL SUCCESS SCREEN WITH BRANDING ----------
echo $B.$C."
╔═══════════════════════════════════════════════════════════╗
║                Composer Installer Utility                 ║
╠═══════════════════════════════════════════════════════════╣
║  Website : https://pynoxi.com                             ║
║  Forum   : https://forum.pynoxi.com                       ║
║  Repo    : https://github.com/pynoxi/Composer-For-cPanel  ║
╚═══════════════════════════════════════════════════════════╝
".$R;

echo "\n".$B.$G."
╔══════════════════════════════════════════════════════╗
║              Composer Installed Successfully!        ║
╚══════════════════════════════════════════════════════╝
".$R;

echo $C."Installed For User: ".$B.$username.$R."\n";
echo $C."Composer Path: ".$D."$home/.local/bin/composer".$R."\n\n";

echo $G."Thank you for using PyNoxi Installer!".$R."\n";
echo $C."Support Community: https://forum.pynoxi.com".$R."\n\n";

exit(0);
?>
