<?php

declare(strict_types=1);

namespace Tests\Feature;

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
     * 日報保存APIにアクセスすると 204 になること
     *
     * @return void
     */
    public function test_store_response_code(): void
    {
        $this->post(route('daily_reports.store'))
            ->assertNoContent();
    }
}
