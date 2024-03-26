<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'target_fund',
    ];

    protected $appends = [
        'collected_fund',
        'used_fund',
        'current_fund',
        'funding_progress_percentage',
        'short_description',
    ];

    public function getCollectedFundAttribute()
    {
        return round($this->donations->where('payment_status', '2')->sum('amount'), 2);
    }

    public function getUsedFundAttribute()
    {
        return round($this->programActivities->sum('amount'), 2);
    }

    public function getCurrentFundAttribute()
    {
        return round($this->getCollectedFundAttribute() - $this->getUsedFundAttribute(), 2);
    }

    public function getFundingProgressPercentageAttribute()
    {
        return floor($this->getCollectedFundAttribute() / ($this->attributes['target_fund'] / 100));
    }

    public function getShortDescriptionAttribute()
    {
        $maxDescriptionLength = 100;
        $description = strip_tags($this->attributes['description']);
        $description = substr($description, 0, $maxDescriptionLength);
        $description = rtrim($description);
        $description .= '...';
        return $description;
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function programActivities()
    {
        return $this->hasMany(ProgramActivity::class);
    }
}
