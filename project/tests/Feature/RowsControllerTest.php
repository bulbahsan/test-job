<?php

// tests/Feature/RowsControllerTest.php

namespace Tests\Feature;

use App\Models\Row;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RowsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_rows_grouped_by_date()
    {
        Row::factory()->create(['id' => 1, 'name' => 'Test 1', 'date' => '2021-01-01']);
        Row::factory()->create(['id' => 2, 'name' => 'Test 2', 'date' => '2021-01-01']);
        Row::factory()->create(['id' => 3, 'name' => 'Test 3', 'date' => '2021-02-01']);

        $response = $this->get('/rows');

        $response->assertStatus(200);
        $response->assertViewHas('rows');
        $rows = $response->viewData('rows');
        $this->assertArrayHasKey('2021-01-01', $rows);
        $this->assertArrayHasKey('2021-02-01', $rows);
        $this->assertCount(2, $rows['2021-01-01']);
        $this->assertCount(1, $rows['2021-02-01']);
    }
}
