<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basic = Plan::create([
            'name' => 'Basic',
            'slug' => 'basic',
            'description' => 'Secure VPN with essential features.',
            'original_price' => 5.99,
            'discount_price' => 2.99,
            'duration' => 1,
            'duration_unit' => 'month',
        ]);

        $basicFeatures = [
            ['title' => 'Unlimited Bandwidth', 'enabled' => true],
            ['title' => '24/7 Support', 'enabled' => false],
            ['title' => 'Access to All Servers', 'enabled' => true],
            ['title' => 'No Logs Policy', 'enabled' => true],
            ['title' => 'Dedicated IP', 'enabled' => false],
            ['title' => 'Malware Protection', 'enabled' => false],
            ['title' => 'Ad Blocker', 'enabled' => false],
            ['title' => 'Split Tunneling', 'enabled' => false],
            ['title' => 'Kill Switch', 'enabled' => false],
        ];

        foreach ($basicFeatures as $feature) {
            $basic->features()->create($feature);
        }

        $premium = Plan::create([
            'name' => 'Premium',
            'slug' => 'premium',
            'description' => 'Advanced VPN with premium features.',
            'original_price' => 11.99,
            'discount_price' => 5.99,
            'duration' => 1,
            'duration_unit' => 'month',
        ]);
        $premiumFeatures = [
            ['title' => 'Unlimited Bandwidth', 'enabled' => true],
            ['title' => '24/7 Support', 'enabled' => true],
            ['title' => 'Access to All Servers', 'enabled' => true],
            ['title' => 'Dedicated IP', 'enabled' => true],
            ['title' => 'Malware Protection', 'enabled' => true],
            ['title' => 'Ad Blocker', 'enabled' => true],
            ['title' => 'Split Tunneling', 'enabled' => true],
            ['title' => 'Kill Switch', 'enabled' => true],
            ['title' => 'No Logs Policy', 'enabled' => true],
        ];
        foreach ($premiumFeatures as $feature) {
            $premium->features()->create($feature);
        }

        $enterprise = Plan::create([
            'name' => 'Enterprise',
            'slug' => 'enterprise',
            'description' => 'Comprehensive VPN solution for businesses.',
            'original_price' => 29.99,
            'discount_price' => 14.99,
            'duration' => 1,
            'duration_unit' => 'month',
        ]);
        $enterpriseFeatures = [
            ['title' => 'Unlimited Bandwidth', 'enabled' => true],
            ['title' => '24/7 Support', 'enabled' => true],
            ['title' => 'Access to All Servers', 'enabled' => true],
            ['title' => 'Dedicated IP', 'enabled' => true],
            ['title' => 'Malware Protection', 'enabled' => true],
            ['title' => 'Ad Blocker', 'enabled' => true],
            ['title' => 'Split Tunneling', 'enabled' => true],
            ['title' => 'Kill Switch', 'enabled' => true],
            ['title' => 'No Logs Policy', 'enabled' => true],
            ['title' => 'Custom Solutions', 'enabled' => true],
        ];
        foreach ($enterpriseFeatures as $feature) {
            $enterprise->features()->create($feature);
        }
    }
}
