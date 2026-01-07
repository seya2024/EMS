<?php

namespace App\Models;

use Carbon\Carbon;
use App\Helpers\CalendarHelper;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quarter extends Model
{
    use HasFactory, Notifiable, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log all attributes
            ->logOnlyDirty() // optional, only log changed fields
            ->useLogName('Quarter'); // optional, name of the log
    }

    protected $fillable = [
        'name',        // "Q1", "Q2", etc.
        'year',        // e.g., 2026
        'start_date',  // e.g., "2026-01-01"
        'end_date',    // e.g., "2026-03-31"
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Accessor: Full label for UI
     */
    public function getLabelAttribute(): string
    {
        return "{$this->name} - {$this->year}";
    }

    /**
     * Scope: Current quarter based on today's date
     */
    public function scopeCurrent($query)
    {
        $today = now()->toDateString();
        return $query->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today);
    }

    /**
     * Static helper: return the current quarter instance
     */
    // public static function getCurrentQuarter(): ?self
    // {
    //     return self::current()->first();
    // }

    // Static helper to get current quarter
    public static function getCurrentQuarter(): ?self
    {
        return self::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }

    public static function gcToEc(Carbon|string $date)
    {
        // same code as above]
        // $ecDate = Quarter::gcToEc('2026-01-05'); 
        //echo $ecDate; // e.g., 2018-04-27
    }


//curser ide for ai support
    /**
     * Static helper: return current quarter name (e.g., Q2 - 2026)
     */
    public static function getCurrentQuarterLabel(): ?string
    {
        $quarter = self::getCurrentQuarter();
        return $quarter ? $quarter->label : null;
    }

    /**
     * Static helper: get quarter for a given date
     */
    public static function getQuarterByDate(Carbon|string $date): ?self
    {
        $date = $date instanceof Carbon ? $date : Carbon::parse($date);
        return self::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->first();
    }

    /**
     * Static helper: determine quarter name (Q1, Q2, Q3, Q4) from month
     */
    public static function determineQuarterFromMonth(int $month): string
    {
        if ($month >= 1 && $month <= 3) return 'Q1';
        if ($month >= 4 && $month <= 6) return 'Q2';
        if ($month >= 7 && $month <= 9) return 'Q3';
        return 'Q4';
    }
}
############ Usage #######################3
#Get current quarter instance
// $currentQuarter = Quarter::getCurrentQuarter();

#Get current quarter label
// $label = Quarter::getCurrentQuarterLabel(); // e.g., "Q2 - 2026"

#Get quarter for a specific date
// $quarterForDate = Quarter::getQuarterByDate('2026-05-15');

#Determine quarter name from month
// $quarterName = Quarter::determineQuarterFromMonth(5); // "Q2"