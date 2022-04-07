<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 日報
 */
class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = ['content'];
}
