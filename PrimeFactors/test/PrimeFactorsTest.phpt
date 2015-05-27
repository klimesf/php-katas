<?php

namespace Test;

use PrimeFactors;
use Tester;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

/**
 * @package   Test
 * @author    Filip Klimes <filipklimes@startupjobs.cz>
 * @copyright 2015, Startupedia s.r.o.
 * @testCase
 */
class PrimeFactorsTest extends Tester\TestCase
{

	/**
	 * Tests of() method.
	 */
	public function testOf()
	{
		Assert::same([], PrimeFactors::of(1));
		Assert::same([2], PrimeFactors::of(2));
		Assert::same([3], PrimeFactors::of(3));
		Assert::same([2, 2], PrimeFactors::of(4));
		Assert::same([5], PrimeFactors::of(5));
		Assert::same([2, 3], PrimeFactors::of(6));
		Assert::same([7], PrimeFactors::of(7));
		Assert::same([2, 2, 2], PrimeFactors::of(8));
		Assert::same([3, 3], PrimeFactors::of(9));
		Assert::same([2, 5], PrimeFactors::of(10));
		Assert::same([11], PrimeFactors::of(11));
		Assert::same([2, 2, 3], PrimeFactors::of(12));
		Assert::same([13], PrimeFactors::of(13));
		Assert::same([2, 2, 3, 5, 7, 11, 13],
			PrimeFactors::of(2 * 2 * 3 * 5 * 7 * 11 * 13));
	}

}

(new PrimeFactorsTest())->run();