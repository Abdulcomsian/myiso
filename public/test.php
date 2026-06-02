<?php
$text = 'This text
spans multiple
lines.';
echo str_replace(array("\r", "\n"), ' ', $text);
?>