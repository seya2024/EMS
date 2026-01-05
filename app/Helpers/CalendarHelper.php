<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;
use Andegna\DateTimeFactory;

class CalendarHelper
{
    /**
     * Convert a Gregorian date to Ethiopian date
     * Format: DD-MM-YYYY ዓ.ም
     *
     * @param \DateTime|string $gcDate
     * @return string
     */
    public static function gcToEc(DateTime|string $gcDate): string
    {
        // Convert string to DateTime if needed
        $gregorian = $gcDate instanceof DateTime ? $gcDate : new DateTime($gcDate);

        // Convert to Ethiopian
        $ethiopic = DateTimeFactory::fromDateTime($gregorian);

        // Return formatted as DD-MM-YYYY ዓ.ም
        return sprintf(
            '%02d-%02d-%04d ዓ.ም',
            $ethiopic->getDay(),
            $ethiopic->getMonth(),
            $ethiopic->getYear()
        );
    }


    /**
     * Check if a Gregorian date is in the current Ethiopian quarter
     */
    public static function isInCurrentQuarter(DateTime|string $gcDate): bool
    {
        $gregorian = $gcDate instanceof DateTime ? $gcDate : new DateTime($gcDate);
        $ethiopian = DateTimeFactory::fromDateTime($gregorian);

        $now = DateTimeFactory::now();

        $currentQuarter = ceil($now->getMonth() / 3);
        $dateQuarter = ceil($ethiopian->getMonth() / 3);

        return $ethiopian->getYear() === $now->getYear() && $dateQuarter === $currentQuarter;
    }


    // **
    //  * Get current week dates (Monday → Saturday) as a string in DD-MM-YYYY format
    //  *
    //  * @return string
    //  */
    public static function getCurrentWeekEcDates(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek(); // Monday
        $endOfWeek = $startOfWeek->copy()->addDays(5); // Saturday

        $dates = [];
        $current = $startOfWeek->copy();

        while ($current <= $endOfWeek) {
            $dates[] = self::gcToEc($current);
            $current->addDay();
        }

        return $dates;
    }

    public static function getCurrentWeekEcDatesRow(): string
    {
        return implode('  ', self::getCurrentWeekEcDates()); // double space separator
    }


    /**
     * Get all days in current month as array of EC dates
     */
    public static function getCurrentMonthEcDates(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $dates = [];
        $current = $startOfMonth->copy();

        while ($current <= $endOfMonth) {
            $dates[] = self::gcToEc($current);
            $current->addDay();
        }

        return $dates;
    }


    /**
     * Get all Gregorian dates in the current quarter
     *
     * @return array ['quarterName' => string, 'dates' => array of d-m-Y strings]
     */
    public static function getCurrentQuarterDates(): array
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        if ($month >= 1 && $month <= 3) {
            $quarterName = "Quarter I - $year";
            $quarterStart = Carbon::create($year, 1, 1);
            $quarterEnd = Carbon::create($year, 3, 31);
        } elseif ($month >= 4 && $month <= 6) {
            $quarterName = "Quarter II - $year";
            $quarterStart = Carbon::create($year, 4, 1);
            $quarterEnd = Carbon::create($year, 6, 30);
        } elseif ($month >= 7 && $month <= 9) {
            $quarterName = "Quarter III - $year";
            $quarterStart = Carbon::create($year, 7, 1);
            $quarterEnd = Carbon::create($year, 9, 30);
        } else {
            $quarterName = "Quarter IV - $year";
            $quarterStart = Carbon::create($year, 10, 1);
            $quarterEnd = Carbon::create($year, 12, 31);
        }

        $dates = [];
        $current = $quarterStart->copy();

        while ($current <= $quarterEnd) {
            $dates[] = $current->format('d-m-Y');
            $current->addDay();
        }

        return [
            'quarterName' => $quarterName,
            'dates' => $dates
        ];
    }
}
