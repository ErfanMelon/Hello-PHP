<?php
// include language configuration file based on selected language
$lang = "fa";
if (isset($_GET['lang'])) {
   $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
}
if( isset( $_SESSION['lang'] ) ) {
    $lang = $_SESSION['lang'];
}else {
    $lang = "fa";
}
require_once ("./assets/lang/" . $lang . ".php");

?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>">