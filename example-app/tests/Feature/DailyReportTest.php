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
    private array $defaultUpdateRequestContent = ['content' => '今日はこれをやりませんでした。'];
    private array $structure = [
        'id',
        'content',
        'created_at',
        'updated_at'
    ];

    /**
     * 日報一覧APIにアクセスすると 200 になること
     *
     * @return void
     */
    public function test_index_response_code(): void
    {
        $this->get(route('daily_reports.index'))
            ->assertOk();
    }

    /**
     * 日報一覧APIにアクセスすると日報データのリストが返ってくること
     *
     * @return void
     */
    public function test_index_return_contents(): void
    {
        $reports = DailyReport::factory()->count(2)->create();

        $response = $this->get(route('daily_reports.index'));

        $response->assertJsonStructure([
            $this->structure,
            $this->structure
        ]);

        $response->assertJson([
            [
                'id' => $reports->first()->id,
                'content' => $reports->first()->content,
            ],
            [
                'id' => $reports->last()->id,
                'content' => $reports->last()->content,
            ]
        ]);
    }

    /**
     * 日報取得APIにアクセスすると 200 になること
     *
     * @return void
     */
    public function test_show_response_code(): void
    {
        $report = DailyReport::factory()->create();

        $this->get(route('daily_reports.show', $report))
            ->assertOk();
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
     * 日報取得APIにアクセスすると日報データが返ってくること
     *
     * @return void
     */
    public function test_show_return_content(): void
    {
        $report = DailyReport::factory()->create();

        $response = $this->get(route('daily_reports.show', $report));

        $response->assertJsonStructure($this->structure);
        $response->assertJson([
            'id' => $report->id,
            'content' => $report->content,
        ]);
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

        $response->assertJsonStructure($this->structure);

        $response->assertJson($this->defaultStoreRequestContent);
    }

    /**
     * 日報保存APIに不正なリクエストをすると 422 になること
     *
     * @param array $requestContent
     * @return void
     * @dataProvider invalid_save_request_contents_provider
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
    public function invalid_save_request_contents_provider(): array
    {
        return [
            'content なし' => ['requestContent' => []],
            'content が数字' => ['requestContent' => ['content' => 1]],
            'content が191文字以上' => ['requestContent' => ['content' => str_repeat('a', 192)]],
        ];
    }

    /**
     * 日報更新APIにアクセスすると 204 になること
     *
     * @return void
     */
    public function test_update_response_code(): void
    {
        $report = DailyReport::factory()->create();

        $this->patchJson(route('daily_reports.update', $report), $this->defaultUpdateRequestContent)
            ->assertNoContent();
    }

    /**
     * 日報更新APIで存在しない日報にアクセスすると 404 になること
     *
     * @return void
     */
    public function test_update_response_code_not_found(): void
    {
        $this->patchJson(route('daily_reports.update', -1), $this->defaultUpdateRequestContent)
            ->assertNotFound();
    }

    /**
     * 日報更新APIにアクセスすると日報が更新されること
     *
     * @return void
     */
    public function test_update_save(): void
    {
        $report = DailyReport::factory()->create();

        $this->patchJson(route('daily_reports.update', $report), $this->defaultUpdateRequestContent);

        $this->assertDatabaseHas(DailyReport::class, ['id' => $report->id, ...$this->defaultUpdateRequestContent]);
    }

    /**
     * 日報更新APIに不正なリクエストをすると 422 になること
     *
     * @param array $requestContent
     * @return void
     * @dataProvider invalid_save_request_contents_provider
     */
    public function test_update_validation(array $requestContent): void
    {
        $report = DailyReport::factory()->create();

        $this->patchJson(route('daily_reports.update', $report), $requestContent)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
