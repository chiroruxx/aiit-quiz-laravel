<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\DailyReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * 日報に関するテスト
 */
class DailyReportTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 日報保存APIにアクセスすると 201 になること
     *
     * @return void
     */
    public function test_store_response_code(): void
    {
        $this->postJson(route('daily_reports.store'))
            ->assertCreated();
    }

    /**
     * 日報保存APIにアクセスすると日報が保存されること
     *
     * @return void
     */
    public function test_store_save(): void
    {
        $requestContents = ['content' => '今日はこれをやりました。'];

        $this->postJson(route('daily_reports.store'), $requestContents);
        $this->assertDatabaseHas(DailyReport::class, $requestContents);
    }

    /**
     * 日報保存APIにアクセスすると日報が返ること
     *
     * @return void
     */
    public function test_store_return_content(): void
    {
        $response = $this->postJson(route('daily_reports.store'), ['content' => '今日はこれをやりました。']);

        $response->assertJsonStructure([
            'id',
            'content',
            'created_at',
            'updated_at'
        ]);

        $response->assertJson([
            'content' => '今日はこれをやりました。'
        ]);
    }
}
