#!/usr/bin/php
<?php
echo "in";
define( 'LOCK_FILE', "/home/web/import.festival-cannes.com/_offline/import.lock");
define( 'EXEC_FILE', "/home/web/import.festival-cannes.com/_online/app/console base:import:old_fdc --only-create --only-articles");
echo "in";
if( isLocked() ) {
    die( "Already running.\n" );
}
echo "in";
exec("php ".EXEC_FILE);
echo "in";
sleep(5);
unlink( LOCK_FILE );
exit(0);
//If lock file exists, check if stale.  If exists and is not stale, return TRUE
//Else, create lock file and return FALSE.
function isLocked()
{
    if (file_exists(LOCK_FILE)) {
        $lockingPID = trim(file_get_contents(LOCK_FILE));
        $pids = explode("\n", trim(`ps -e | awk '{print $1}'`));
        if (in_array($lockingPID, $pids)) {
            return true;
        }
        unlink(LOCK_FILE);
    }
    file_put_contents(LOCK_FILE, getmypid() . "\n");
    return false;

}
