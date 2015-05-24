<?php

namespace RomanNumeral;

/**
 * Adds $number times "I" to the given string using given function
 * @param callable $stringModifier
 * @param integer  $number
 * @param string   $string
 * @return string
 */
$addOnes = function ($stringModifier, $number, $string = "") use (&$addOnes) {
	if ($number < 1) {
		return $string;
	} else {
		return $addOnes($stringModifier, $number - 1, $stringModifier($string, "I"));
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

/**
 * Prepends or appends roman one numerals of given number to the given string.
 * @param string $number
 * @param string $string
 * @return string
 */
$solveOnes = function ($number, $string = "") use ($append, $prepend, $addOnes) {
	if ($number % 5 < 4) {
		return $addOnes($append, $number % 5, $string);
	} else {
		return $addOnes($prepend, $number % 5 - 3, $string);
	}
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
 * Appends or prepends roman ten numerals of given number to the given string.
 * @param integer $number
 * @param string  $string
 * @return string
 */
$solveTens = function ($number, $string = "") use ($append, $prepend) {
	if ($number % 10 > 8 || ($number > 0 && $number % 10 === 0)) {
		return $append($string, "X");
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

	return $solveOnes($number, $solveFives($number, $solveTens($number)));
}