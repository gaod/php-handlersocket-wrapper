<?php
require_once 'config.php';
require_once 'handlersocket_wrapper.php';

$db_host = DB_HOST;
$db_rw_secret = DB_RW_SECRET;
$db_read_secret = DB_READ_SECRET;
$port_read = 9998;
$port_write = 9999;
$dbname = DB_NAME;
$debug_mode = TRUE;
$table = 'user';
$indexid = 1;

$hsr = new HandlerScoketWrapper($db_host, $port_read, $dbname, $table, $debug_mode, $db_read_secret);
if ($hsr) {
    $hsr->init(array('user_id', 'user_email'), $indexid);
    $result = $hsr->get('101');
    $result = $hsr->get(array('101', '102', '111'));
}
$hsw = new HandlerScoketWrapper($db_host, $port_write, $dbname, $table, $debug_mode);
if ($hsw) {
    $hsw->init(array('user_id', 'user_name', 'user_email'), $indexid + 1);
    /**
     * https://github.com/ahiguti/HandlerSocket-Plugin-for-MySQL/blob/master/docs-en/protocol.en.txt
     * 
     * ...
     * Once an 'open_index' request is issued, the HandlerSocket plugin opens the
     * specified index and keep it open until the client connection is closed. Each
     * open index is identified by <indexid>. If <indexid> is already open, the old
     * open index is closed. You can open the same combination of <dbname>
     * <tablename> <indexname> multple times, possibly with different <columns>.
     * For efficiency, keep <indexid> small as far as possible.
     * ...
     * 
     */
    $result = $hsw->add(array('104', 'cool', 'cool@example.com'));
    /* the first element of the array is the Primary Key, and the rest elements are value of each column. */

    $result = $hsw->get('104');
    /* use primary key to get value */

    $data = array('hot', 'hot@example.com');
    $result = $hsw->update('104', $data);
    /* first param is primary key, second param is data (as an array) */

    $status = $hsw->del('104');
    /* delete the record by primary key. */
}
