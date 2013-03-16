<?php

// We're capturing the options in an array.
$options = array('good', 'bad', 'ugly');
$random_key = array_rand($options);

// By using $output, we can play with the string later.
if ($options[$random_key] == 'good') {
  $output = 'This peach is very good.';
} elseif ($options[$random_key] == 'bad') {
  $output = 'This peach is lame.';
} else {
  $output = 'Sorry, the peach rating is not valid.';
}

// Let's make it uppercase and add an exclaimation mark at the end half the time.
$yell = rand(0,1);

if ($yell == 1) {
  $output = strtoupper($output);
  $output = str_replace('.', '!', $output);
}

print $output;

?>