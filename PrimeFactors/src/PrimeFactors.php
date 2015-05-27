<?php


/**
 * @author    Filip Klimes <filipklimes@startupjobs.cz>
 * @copyright 2015, Startupedia s.r.o.
 */
class PrimeFactors
{

	/**
	 * Returns prime factors of given number.
	 * @param int $number
	 * @return array|int[]
	 */
	public static function of($number)
	{
		$factors = [];

		for ($divisor = 2; $number > 1; ++$divisor) {
			for (; $number % $divisor === 0; $number /= $divisor) {
				$factors[] = $divisor;
			}
		}

		return $factors;
	}

}