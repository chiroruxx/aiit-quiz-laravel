<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\DailyReportRequest;
use App\Models\DailyReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

/**
 * 日報を管理するコントローラー
 */
class DailyReportController extends Controller
{
    /**
     * 日報の一覧を取得します。
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(DailyReport::all());
    }

    /**
     * 日報を取得します。
     *
     * @param DailyReport $report
     * @return JsonResponse
     */
    public function show(DailyReport $report): JsonResponse
    {
        return response()->json($report);
    }

    /**
     * 日報を保存します。
     *
     * @param DailyReportRequest $request
     * @return JsonResponse
     */
    public function store(DailyReportRequest $request): JsonResponse
    {
        $report = new DailyReport();
        $report->fill(['content' => $request->json('content')]);
        $report->save();

        return response()->json($report, ResponseCode::HTTP_CREATED);
    }

    /**
     * 日報を更新します。
     *
     * @param Request $request
     * @param DailyReport $report
     * @return Response
     */
    public function update(Request $request, DailyReport $report): Response
    {
        $report->fill(['content' => $request->json('content', $report->content)]);
        $report->save();

        return response()->noContent();
    }
}
