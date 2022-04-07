<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\DailyReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * 日報に関するテスト
 */
class DailyReportTest extends TestCase
{
    use RefreshDatabase;

    private array $defaultStoreRequestContent = ['content' => '今日はこれをやりました。'];

    /**
     * 日報取得APIにアクセスすると 204 になること
     *
     * @return void
     */
    public function test_show_response_code(): void
    {
        $report = DailyReport::factory()->create();

        $this->get(route('daily_reports.show', $report))
            ->assertNoContent();
    }

    /**
     * 日報取得APIで存在しない日報にアクセスすると 404 になること
     *
     * @return void
     */
    public function test_show_response_code_not_found(): void
    {
        $this->get(route('daily_reports.show', -1))
            ->assertNotFound();
    }

    /**
     * 日報保存APIにアクセスすると 201 になること
     *
     * @return void
     */
    public function test_store_response_code(): void
    {
        $this->postJson(route('daily_reports.store'), $this->defaultStoreRequestContent)
            ->assertCreated();
    }

    /**
     * 日報保存APIにアクセスすると日報が保存されること
     *
     * @return void
     */
    public function test_store_save(): void
    {
        $this->postJson(route('daily_reports.store'), $this->defaultStoreRequestContent);
        $this->assertDatabaseHas(DailyReport::class, $this->defaultStoreRequestContent);
    }

    /**
     * 日報保存APIにアクセスすると日報が返ること
     *
     * @return void
     */
    public function test_store_return_content(): void
    {
        $response = $this->postJson(route('daily_reports.store'), $this->defaultStoreRequestContent);

        $response->assertJsonStructure([
            'id',
            'content',
            'created_at',
            'updated_at'
        ]);

        $response->assertJson($this->defaultStoreRequestContent);
    }

    /**
     * 日報保存APIに不正なリクエストをすると 422 になること
     *
     * @param array $requestContent
     * @return void
     * @dataProvider invalid_store_request_contents_provider
     */
    public function test_store_validation(array $requestContent): void
    {
        $this->postJson(route('daily_reports.store'), $requestContent)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * 不正なリクエストのデータプロバイダ
     *
     * @return array
     */
    public function invalid_store_request_contents_provider(): array
    {
        return [
            'content なし' => ['requestContent' => []],
            'content が数字' => ['requestContent' => ['content' => 1]],
            'content が191文字以上' => ['requestContent' => ['content' => str_repeat('a', 192)]],
        ];
    }
}
