<?php

namespace RomanNumerals;

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
 * @param string $prefix
 * @return string
 */
$prepend = function ($original, $prefix) {
	return $prefix . $original;
};

/**
 * If conditions are met, appends or prepends units numeral (I,X,C,M) to the given string.
 * @param integer $number
 * @param string  $numeral
 * @param string  $string
 * @return string
 */
$solveUnitsOrder = function ($number, $numeral, $string = "") use ($append, $prepend, $addNumerals) {
	if ($number % 5 < 4) {
		return $addNumerals($append, $number % 5, $numeral, $string);
	} else {
		return $addNumerals($prepend, $number % 5 - 3, $numeral, $string);
	}
};

/**
 * If conditions are met, appends or prepends halves numeral (V,L,D) to the given string.
 * @param integer $number
 * @param string  $numeral
 * @param string  $string
 * @return string
 */
$solveHalvesOrder = function ($number, $numeral, $string = "") use ($append, $prepend) {
	if ($number % 10 > 3 && $number % 10 < 6) {
		return $append($string, $numeral);
	} elseif ($number % 10 > 5 && $number % 10 < 9) {
		return $prepend($string, $numeral);
	} else {
		return $string;
	}
};

/**
 * If conditions are met, appends next unit numeral (C,D,M) to the given number.
 * @param integer $number
 * @param string  $numeral
 * @param string  $string
 * @return string
 */
$solveNextUnit = function ($number, $numeral, $string = "") use ($append) {
	if ($number % 10 > 8) {
		return $append($string, $numeral);
	} else {
		return $string;
	}
};

/**
 * Creates part of string with five numeral (V).
 * @param integer $number
 * @param string $string
 * @return string
 */
$solveFives = function ($number, $string = "") use ($append, $prepend, $solveHalvesOrder) {
	return $solveHalvesOrder($number, "V", $string);
};

/**
 * Creates part of string with fifty numeral (L).
 * @param integer $number
 * @param string $string
 * @return string
 */
$solveFifties = function ($number, $string = "") use ($append, $prepend, $solveHalvesOrder) {
	return $solveHalvesOrder($number / 10, "L", $string);
};

/**
 * Creates part of string with five hundred numeral (V).
 * @param integer $number
 * @param string $string
 * @return string
 */
$solveFiveHundred = function ($number, $string = "") use ($append, $prepend, $solveHalvesOrder) {
	return $solveHalvesOrder($number / 100, "D", $string);
};

/**
 * Creates part of string with one numeral (I).
 * @param integer $number
 * @param string $string
 * @return string
 */
$solveOnes = function ($number, $string = "") use ($solveUnitsOrder, $prepend, $solveFives, $solveNextUnit) {
	return $solveFives($number,
		$prepend($string,
			$solveUnitsOrder($number, "I",
				$solveNextUnit($number, "X"))));
};

/**
 * Creates part of string with ten numeral (X).
 * @param integer $number
 * @param string $string
 * @return string
 */
$solveTens = function ($number, $string = "") use ($solveUnitsOrder, $prepend, $solveFifties, $solveNextUnit) {
	return $solveFifties($number,
		$prepend($string,
			$solveUnitsOrder($number / 10, "X",
				$solveNextUnit($number / 10, "C"))));
};

/**
 * Creates part of string with hundred numeral (C).
 * @param integer $number
 * @param string $string
 * @return string
 */
$solveHundreds = function ($number, $string = "") use ($solveUnitsOrder, $prepend, $solveFiveHundred, $solveNextUnit) {
	return $solveFiveHundred($number, $prepend($string,
		$solveUnitsOrder($number / 100, "C",
			$solveNextUnit($number / 100, "M"))));
};

/**
 * Creates part of string with thousand numeral (M).
 * @param integer $number
 * @param string $string
 * @return string
 */
$solveThousands = function ($number, $string = "") use ($solveUnitsOrder, $prepend) {
	return $prepend($string, $solveUnitsOrder($number / 1000, "M"));
};

/**
 * Converts given number in arabic numerals to roman numerals.
 * @param integer $number
 * @return string
 */
function convertFromArabic($number)
{
	if (!is_numeric($number) || $number < 1 || $number > 3999) {
		throw new \InvalidArgumentException();
	}
	// PHP bullshit
	global $solveOnes;
	global $solveTens;
	global $solveHundreds;
	global $solveThousands;

	return
		$solveThousands($number,
			$solveHundreds($number,
				$solveTens($number,
					$solveOnes($number))));
}