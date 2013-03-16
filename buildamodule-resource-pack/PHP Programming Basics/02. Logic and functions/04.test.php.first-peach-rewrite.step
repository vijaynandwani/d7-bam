<?php

// We're using array_flip to get the value of the array instead of the key.
$adjective_array = array('good', 'bad', 'ugly');
$adjective = array_rand(array_flip($adjective_array));

$adverb_array = array('very', 'kind of', 'super', 'not');
$adverb = array_rand(array_flip($adverb_array));

$punctuation_array = array('!', '?', '...', '.');
$punctuation = array_rand(array_flip($punctuation_array));

$output = 'This peach is ' . $adverb . ' ' . $adjective . $punctuation;

// Only yell if it's an exclaimation mark.
if ($punctuation == '!') {
  $output = strtoupper($output);
}

print $output;

?>