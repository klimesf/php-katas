<?php

namespace RomanNumeral;

/**
 * Adds $number times $numeral to the given string using given $stringModifier function.
 * @param callable $stringModifier
 * @param integer  $number
 * @param string   $numeral
 * @param string   $string
 * @return string
 */
$addNumerals = function ($stringModifier, $number, $numeral, $string = "") use (&$addNumerals) {
	if ($number < 1) {
		return $string;
	} else {
		return $addNumerals($stringModifier, $number - 1, $numeral, $stringModifier($string, $numeral));
	}
};

/**
 * Appends string to the original.
 * @param string $original
 * @param string $appendix
 * @return string
 */
$append = function ($original, $appendix) {
	return $original . $appendix;
};

/**
 * Prepends string to the original.
 * @param string $original
 * @param string $prependix
 * @return string
 */
$prepend = function ($original, $prependix) {
	return $prependix . $original;
};

$solveOrder = function ($number, $numeral, $string) use ($append, $prepend, $addNumerals) {
	if ($number % 5 < 4) {
		return $addNumerals($append, $number % 5, $numeral, $string);
	} else {
		return $addNumerals($prepend, $number % 5 - 3, $numeral, $string);
	}
};

/**
 * Prepends or appends roman one numerals of given number to the given string.
 * @param string $number
 * @param string $string
 * @return string
 */
$solveOnes = function ($number, $string = "") use ($solveOrder) {
	return $solveOrder($number, "I", $string);
};

/**
 * Appends or prepends roman ten numerals of given number to the given string.
 * @param integer $number
 * @param string  $string
 * @return string
 */
$solveTens = function ($number, $string = "") use ($solveOrder) {
	return $solveOrder($number / 10, "X", $string);
};

$solveHundreds = function ($number, $string = "") use ($solveOrder) {
	return $solveOrder($number / 100, "C", $string);
};

$solveThousands = function ($number, $string = "") use ($solveOrder) {
	return $solveOrder($number / 1000, "M", $string);
};

/**
 * Appends roman five numeral of given number to the given string.
 * @param integer $number
 * @param string  $string
 * @return string
 */
$solveFives = function ($number, $string = "") use ($append) {
	if ($number % 10 > 3 && $number % 10 < 9) {
		return $append($string, "V");
	} else {
		return $string;
	}
};

/**
 * Converts given number in arabic numerals to roman numerals.
 * @param integer $number
 * @return string
 */
function convertFromArabic($number)
{
	// PHP bullshit
	global $solveOnes;
	global $solveFives;
	global $solveTens;
	global $solveHundreds;
	global $solveThousands;

	return $solveOnes($number, $solveFives($number, $solveTens($number, $solveHundreds($number, $solveThousands($number)))));
}