<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * 日報を管理するコントローラー
 */
class DailyReportController extends Controller
{
    /**
     * 日報を保存します。
     *
     * @return Response
     */
    public function store(): Response
    {
        return response()->noContent();
    }
}
