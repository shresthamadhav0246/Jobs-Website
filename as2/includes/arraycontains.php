<?php

function arrayContains($array, $value) {
 $found = false;
 for ($i = 0; $i < count($array); $i++) {
 if ($array[$i] == $value) {
 $found = true;
 }
 }
 return $found;
}
?>