<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

/**
 * 日報を管理するコントローラー
 */
class DailyReportController extends Controller
{
    /**
     * 日報を保存します。
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $report = new DailyReport();
        $report->fill(['content' => '']);
        $report->save();

        return response()->json($report, ResponseCode::HTTP_CREATED);
    }
}
