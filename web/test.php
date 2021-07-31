<?php
$str = "Mary Had A Little Lamb and She LOVED It So";
$str = 'Τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός';
$str = strtoupper($str);
echo $str; // Prints MARY HAD A LITTLE LAMB AND SHE LOVED IT SO

$arr = ["a" => "Blue", "b" => "White", "d" => "Red", "c" => "Orange"];
//sort($arr);
asort($arr);
//ksort($arr);
//rsort($arr);
print_r($arr);

?>
