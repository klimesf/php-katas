<?php

namespace Test;

use Tester;
use Tester\Assert;
use RomanNumeral;

require __DIR__ . '/bootstrap.php';

/**
 * @package   Test
 * @author    Filip Klimes <filipklimes@startupjobs.cz>
 * @copyright 2015, Filip Klimes
 * @testCase
 */
class RomanNumeralTest extends Tester\TestCase
{

	public function __construct()
	{
	}

	/**
	 * Sets up environment before every test method.
	 */
	public function setUp()
	{
	}

	/**
	 * Cleans up after every test method.
	 */
	public function tearDown()
	{
	}

	/**
	 * Tests convertFromArabic() method.
	 * @dataProvider provideArabicAndRomanNumerals
	 * @param integer $arabic
	 * @param string  $roman
	 */
	public function testConvertFromArabic($arabic, $roman)
	{
		Assert::same($roman, \RomanNumeral\convertFromArabic($arabic));
	}

	/**
	 * Provides array of sub-arrays containing number in arabic and roman numerals.
	 * @return array
	 */
	protected function provideArabicAndRomanNumerals()
	{
		return [
			[1, "I"],
			[2, "II"],
			[3, "III"],
			[4, "IV"],
			[5, "V"],
			[6, "VI"],
			[7, "VII"],
			[8, "VIII"],
			[9, "IX"],
			[10, "X"],
			[11, "XI"],
			[12, "XII"],
			[13, "XIII"],
			[14, "XIV"],
			[15, "XV"],
			[16, "XVI"],
			[20, "XX"],
			[30, "XXX"],
			[40, "XL"],
			[50, "L"],
			[60, "LX"],
			[70, "LXX"],
			[80, "LXXX"],
			[90, "XC"],
			[100, "C"],
			[110, "CX"],
			[200, "CC"],
			[213, "CCXIII"],
			[300, "CCC"],
			[400, "CD"],
			[500, "D"],
			[600, "DC"],
			[700, "DCC"],
			[800, "DCCC"],
			[900, "CM"],
			[1000, "M"],
			[1066, "MLXVI"],
			[1989, "MCMLXXXIX"],
			[2000, "MM"],
			[2213, "MMCCXIII"],
		];
	}

}

(new RomanNumeralTest())->run();