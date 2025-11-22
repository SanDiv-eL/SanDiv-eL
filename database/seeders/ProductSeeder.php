<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $laptopCategory = \App\Models\Category::create([
            'name' => 'Laptops',
            'slug' => 'laptops',
            'description' => 'High-performance laptops for work and play.'
        ]);

        $desktopCategory = \App\Models\Category::create([
            'name' => 'Desktops',
            'slug' => 'desktops',
            'description' => 'Powerful desktop computers for gaming and productivity.'
        ]);

        $accessoriesCategory = \App\Models\Category::create([
            'name' => 'Accessories',
            'slug' => 'accessories',
            'description' => 'Essential computer accessories and peripherals.'
        ]);

        // Laptops (10 products)
        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'ProBook Elite X1',
            'slug' => 'probook-elite-x1',
            'description' => 'Premium ultrabook with stunning OLED display and all-day battery life. Perfect for professionals who demand excellence.',
            'price' => 18500000,
            'stock' => 45,
            'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i7-13700H',
                'RAM' => '16GB DDR5',
                'Storage' => '512GB NVMe SSD',
                'Display' => '14" 2.8K OLED',
                'GPU' => 'Intel Iris Xe Graphics'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'Gaming Beast ROG X7',
            'slug' => 'gaming-beast-rog-x7',
            'description' => 'Ultimate gaming powerhouse with RGB keyboard and advanced cooling system. Dominate every game.',
            'price' => 35000000,
            'stock' => 20,
            'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'AMD Ryzen 9 7945HX',
                'RAM' => '32GB DDR5',
                'Storage' => '1TB NVMe SSD',
                'Display' => '16" QHD+ 240Hz',
                'GPU' => 'NVIDIA RTX 4080 12GB'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'ThinkPad Carbon X1',
            'slug' => 'thinkpad-carbon-x1',
            'description' => 'Business-class laptop with military-grade durability and legendary keyboard. Built for productivity.',
            'price' => 22000000,
            'stock' => 30,
            'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i7-1365U',
                'RAM' => '16GB LPDDR5',
                'Storage' => '512GB PCIe SSD',
                'Display' => '14" WUXGA IPS',
                'GPU' => 'Integrated Intel Graphics'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'MacBook Air M2',
            'slug' => 'macbook-air-m2',
            'description' => 'Incredibly thin and light with the powerful M2 chip. Perfect blend of performance and portability.',
            'price' => 19500000,
            'stock' => 50,
            'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Apple M2 8-Core',
                'RAM' => '16GB Unified Memory',
                'Storage' => '512GB SSD',
                'Display' => '13.6" Liquid Retina',
                'GPU' => 'Apple M2 10-Core GPU'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'ZenBook Pro 15',
            'slug' => 'zenbook-pro-15',
            'description' => 'Creator-focused laptop with stunning 4K OLED display and powerful performance for content creation.',
            'price' => 28000000,
            'stock' => 25,
            'image' => 'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i9-13900H',
                'RAM' => '32GB DDR5',
                'Storage' => '1TB NVMe SSD',
                'Display' => '15.6" 4K OLED',
                'GPU' => 'NVIDIA RTX 4060 8GB'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'Pavilion Gaming 15',
            'slug' => 'pavilion-gaming-15',
            'description' => 'Affordable gaming laptop with solid performance. Great entry point for casual gamers.',
            'price' => 12500000,
            'stock' => 60,
            'image' => 'https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i5-12500H',
                'RAM' => '16GB DDR4',
                'Storage' => '512GB SSD',
                'Display' => '15.6" FHD 144Hz',
                'GPU' => 'NVIDIA RTX 3050 4GB'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'Swift 3 Ultrabook',
            'slug' => 'swift-3-ultrabook',
            'description' => 'Lightweight and portable ultrabook perfect for students and mobile professionals.',
            'price' => 9500000,
            'stock' => 70,
            'image' => 'https://images.unsplash.com/photo-1484788984921-03950022c9ef?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'AMD Ryzen 5 7530U',
                'RAM' => '8GB DDR4',
                'Storage' => '512GB SSD',
                'Display' => '14" FHD IPS',
                'GPU' => 'AMD Radeon Graphics'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'Legion 5 Pro',
            'slug' => 'legion-5-pro',
            'description' => 'Mid-range gaming laptop with excellent price-to-performance ratio and premium build quality.',
            'price' => 24000000,
            'stock' => 35,
            'image' => 'https://images.unsplash.com/photo-1587202372634-32705e3bf49c?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'AMD Ryzen 7 7745HX',
                'RAM' => '16GB DDR5',
                'Storage' => '1TB SSD',
                'Display' => '16" WQXGA 165Hz',
                'GPU' => 'NVIDIA RTX 4060 8GB'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'Chromebook Plus',
            'slug' => 'chromebook-plus',
            'description' => 'Fast and secure Chromebook for everyday computing and cloud-based work.',
            'price' => 6500000,
            'stock' => 80,
            'image' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i3-1215U',
                'RAM' => '8GB LPDDR4X',
                'Storage' => '256GB eMMC',
                'Display' => '14" FHD Touch',
                'GPU' => 'Intel UHD Graphics'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $laptopCategory->id,
            'name' => 'Predator Helios 300',
            'slug' => 'predator-helios-300',
            'description' => 'High-performance gaming laptop with advanced thermal management and customizable RGB.',
            'price' => 29500000,
            'stock' => 18,
            'image' => 'https://images.unsplash.com/photo-1593642702821-c8da6771f0c6?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i7-13700HX',
                'RAM' => '32GB DDR5',
                'Storage' => '1TB NVMe SSD',
                'Display' => '15.6" QHD 240Hz',
                'GPU' => 'NVIDIA RTX 4070 8GB'
            ]
        ]);

        // Desktops (5 products)
        \App\Models\Product::create([
            'category_id' => $desktopCategory->id,
            'name' => 'WorkStation Pro Z9',
            'slug' => 'workstation-pro-z9',
            'description' => 'Professional workstation for 3D rendering, video editing, and heavy computational tasks.',
            'price' => 48000000,
            'stock' => 10,
            'image' => 'https://images.unsplash.com/photo-1587831990711-23ca6441447b?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i9-13900K',
                'RAM' => '64GB DDR5',
                'Storage' => '2TB NVMe SSD + 4TB HDD',
                'GPU' => 'NVIDIA RTX 4090 24GB',
                'Motherboard' => 'ASUS ProArt Z790'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $desktopCategory->id,
            'name' => 'Gaming Rig Ultimate',
            'slug' => 'gaming-rig-ultimate',
            'description' => 'Top-tier gaming desktop with liquid cooling and RGB everything. Maximum FPS guaranteed.',
            'price' => 42000000,
            'stock' => 12,
            'image' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'AMD Ryzen 9 7950X3D',
                'RAM' => '32GB DDR5 6000MHz',
                'Storage' => '2TB Gen4 NVMe SSD',
                'GPU' => 'NVIDIA RTX 4080 16GB',
                'Cooling' => '360mm AIO Liquid Cooler'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $desktopCategory->id,
            'name' => 'Office Pro Desktop',
            'slug' => 'office-pro-desktop',
            'description' => 'Reliable desktop for office work with excellent multitasking capabilities.',
            'price' => 15000000,
            'stock' => 40,
            'image' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'Intel Core i5-13400',
                'RAM' => '16GB DDR4',
                'Storage' => '512GB SSD + 1TB HDD',
                'GPU' => 'Intel UHD Graphics 730',
                'Case' => 'Compact Mini Tower'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $desktopCategory->id,
            'name' => 'Creator Station Pro',
            'slug' => 'creator-station-pro',
            'description' => 'Optimized for content creators with powerful GPU and ample storage.',
            'price' => 38000000,
            'stock' => 15,
            'image' => 'https://images.unsplash.com/photo-1547082299-de196ea013d6?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'AMD Ryzen 9 7900X',
                'RAM' => '64GB DDR5',
                'Storage' => '1TB NVMe + 2TB SSD',
                'GPU' => 'NVIDIA RTX 4070 Ti 12GB',
                'PSU' => '850W 80+ Gold'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $desktopCategory->id,
            'name' => 'Budget Gaming PC',
            'slug' => 'budget-gaming-pc',
            'description' => 'Entry-level gaming PC that delivers solid 1080p gaming performance.',
            'price' => 11000000,
            'stock' => 50,
            'image' => 'https://images.unsplash.com/photo-1587202372583-49330a15584d?w=400&h=300&fit=crop',
            'specifications' => [
                'CPU' => 'AMD Ryzen 5 5600',
                'RAM' => '16GB DDR4 3200MHz',
                'Storage' => '512GB NVMe SSD',
                'GPU' => 'AMD RX 6600 8GB',
                'PSU' => '550W 80+ Bronze'
            ]
        ]);

        // Accessories (5 products)
        \App\Models\Product::create([
            'category_id' => $accessoriesCategory->id,
            'name' => 'Mechanical Gaming Keyboard RGB',
            'slug' => 'mechanical-gaming-keyboard-rgb',
            'description' => 'Premium mechanical keyboard with Cherry MX switches and per-key RGB lighting.',
            'price' => 1850000,
            'stock' => 100,
            'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?w=400&h=300&fit=crop',
            'specifications' => [
                'Switch Type' => 'Cherry MX Red',
                'Backlight' => 'Per-Key RGB',
                'Layout' => 'Full Size (104 Keys)',
                'Connection' => 'USB-C Wired',
                'Features' => 'Hot-swappable, Aluminum Frame'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $accessoriesCategory->id,
            'name' => 'Wireless Gaming Mouse Pro',
            'slug' => 'wireless-gaming-mouse-pro',
            'description' => 'Ultra-lightweight wireless gaming mouse with 20,000 DPI sensor.',
            'price' => 1250000,
            'stock' => 120,
            'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400&h=300&fit=crop',
            'specifications' => [
                'Sensor' => 'Optical 20,000 DPI',
                'Connection' => 'Wireless 2.4GHz + Bluetooth',
                'Battery' => 'Up to 70 hours',
                'Weight' => '63 grams',
                'Buttons' => '6 Programmable'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $accessoriesCategory->id,
            'name' => '27" 4K Gaming Monitor',
            'slug' => '27-4k-gaming-monitor',
            'description' => 'Stunning 4K IPS monitor with HDR support and 144Hz refresh rate.',
            'price' => 6500000,
            'stock' => 35,
            'image' => 'https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=400&h=300&fit=crop',
            'specifications' => [
                'Size' => '27 inches',
                'Resolution' => '3840 x 2160 (4K UHD)',
                'Refresh Rate' => '144Hz',
                'Panel Type' => 'IPS',
                'Response Time' => '1ms (GtG)',
                'HDR' => 'HDR10'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $accessoriesCategory->id,
            'name' => 'USB-C Docking Station',
            'slug' => 'usb-c-docking-station',
            'description' => 'All-in-one docking station with dual 4K display support and 100W power delivery.',
            'price' => 3200000,
            'stock' => 45,
            'image' => 'https://images.unsplash.com/photo-1625948515291-69613efd103f?w=400&h=300&fit=crop',
            'specifications' => [
                'Ports' => '2x HDMI, 4x USB 3.0, 2x USB-C',
                'Display Support' => 'Dual 4K @ 60Hz',
                'Power Delivery' => '100W USB-C PD',
                'Ethernet' => 'Gigabit LAN',
                'Audio' => '3.5mm Jack'
            ]
        ]);

        \App\Models\Product::create([
            'category_id' => $accessoriesCategory->id,
            'name' => 'Wireless Headset Premium',
            'slug' => 'wireless-headset-premium',
            'description' => 'Premium wireless headset with active noise cancellation and studio-quality sound.',
            'price' => 2800000,
            'stock' => 60,
            'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop',
            'specifications' => [
                'Driver' => '50mm Neodymium',
                'Connection' => 'Wireless 2.4GHz + Bluetooth 5.2',
                'Battery Life' => 'Up to 30 hours',
                'Microphone' => 'Detachable Boom Mic',
                'Features' => 'ANC, Surround Sound 7.1'
            ]
        ]);
    }
}
