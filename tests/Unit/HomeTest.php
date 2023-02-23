<?php

namespace Tests\Unit;

use App\Http\Controllers\HomeController;
use PHPUnit\Framework\TestCase;

class HomeTest extends TestCase
{
    /**
     * @test
     */
    public function hash_sha256(): void
    {
        $data = [
            'time_to_live_in_seconds' => 500,
            'merchant_id' => "focusgroupdev1_devtest1",
            'order_id' => "964262",
            'amount' => "1500",
            'backend_result_url' => "https://merchant.test",
            'merchant_reference_id' => "wave-954560"
        ];

        $homeController = new HomeController();
        $value = $homeController->hash($data, "f6298a18c678e5e683f407169c59e721ff6bd33b1995d74e78039f4fca0b8044");
        $this->assertEquals("51b86cd55997721780c7d796799b70507d212cd5561af2fe1a61e8dd0e3583e0", $value);
    }
}
