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
        $this->post(route('daily_reports.store'))
            ->assertCreated();
    }

    /**
     * 日報保存APIにアクセスすると日報が保存されること
     *
     * @return void
     */
    public function test_store_save(): void
    {
        $this->post(route('daily_reports.store'));
        $this->assertDatabaseCount(DailyReport::class, 1);
    }

    /**
     * 日報保存APIにアクセスすると日報が返ること
     *
     * @return void
     */
    public function test_store_return_content(): void
    {
        $response = $this->post(route('daily_reports.store'));

        $response->assertJsonStructure([
            'id',
            'content',
            'created_at',
            'updated_at'
        ]);

        $response->assertJson([
            'content' => ''
        ]);
    }
}
