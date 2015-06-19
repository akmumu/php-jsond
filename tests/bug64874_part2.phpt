--TEST--
Case-sensitivity part of bug #64874 ("json_decode handles whitespace and case-sensitivity incorrectly")
--SKIPIF--
<?php if (!extension_loaded("jsond")) print "skip"; ?>
--FILE--
<?php
require_once "bootstrap.inc";

function decode($jsond) {
    global $jsond_decode, $jsond_last_error;

    var_dump($jsond_decode($jsond));
    echo (($jsond_last_error() !== 0) ? 'ERROR' : 'SUCCESS') . PHP_EOL;
}

// Only lowercase should work
decode('true');
decode('True');
decode('[true]');
decode('[True]');
echo PHP_EOL;

decode('false');
decode('False');
decode('[false]');
decode('[False]');
echo PHP_EOL;

decode('null');
decode('Null');
decode('[null]');
decode('[Null]');
echo PHP_EOL;

echo "Done\n";
?>
--EXPECT--
bool(true)
SUCCESS
NULL
ERROR
array(1) {
  [0]=>
  bool(true)
}
SUCCESS
NULL
ERROR

bool(false)
SUCCESS
NULL
ERROR
array(1) {
  [0]=>
  bool(false)
}
SUCCESS
NULL
ERROR

NULL
SUCCESS
NULL
ERROR
array(1) {
  [0]=>
  NULL
}
SUCCESS
NULL
ERROR

Done
