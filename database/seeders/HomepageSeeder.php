<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeHero;
use App\Models\HomeCategory;
use App\Models\HomeTrustItem;
use App\Models\HomeFeaturedProduct;
use App\Models\HomeProductSection;
use App\Models\HomeSectionProduct;
use App\Models\HomeBrand;
use App\Models\HomeAboutBanner;
use App\Models\HomeClient;
use App\Models\HomeReview;
use App\Models\HomeCtaSection;

class HomepageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Hero Section
        if (HomeHero::count() === 0) {
            HomeHero::create([
                'image_path' => 'assets/images/hero.jpg',
                'logo_path' => 'assets/images/logo.jpg',
                'alt_text' => 'Corporate gifts: travel essentials, tech accessories and drinkware',
                'logo_alt_text' => 'More Than Giftz - it\'s an experience',
                'is_active' => true,
                'sort_order' => 0,
            ]);
        }

        // Seed Categories
        if (HomeCategory::count() === 0) {
            $categories = [
                [
                    'title' => 'Smart Phone',
                    'image_path' => 'assets/images/cat-smartphone.jpg',
                    'alt_text' => 'Smart Phone',
                    'items' => ['Phone Accessories', 'Phone Cases', 'Postpaid Phones', 'Refurbished Phones'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 0,
                ],
                [
                    'title' => 'Television',
                    'image_path' => 'assets/images/cat-television.jpg',
                    'alt_text' => 'Television',
                    'items' => ['HD DVD Players', 'Projection Screens', 'Television Accessories', 'TV-DVD Combos'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 1,
                ],
                [
                    'title' => 'Computers',
                    'image_path' => 'assets/images/cat-computers.jpg',
                    'alt_text' => 'Computers',
                    'items' => ['Computer Com.', 'Computer Acc.', 'Desktops', 'Monitors'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 2,
                ],
                [
                    'title' => 'Electronics',
                    'image_path' => 'assets/images/cat-electronics.jpg',
                    'alt_text' => 'Electronics',
                    'items' => ['Office Electronics', 'Audio & Video', 'Washing Machine', 'Accessories & Supplies'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 3,
                ],
                [
                    'title' => 'Laptop & Tablet',
                    'image_path' => 'assets/images/cat-laptop.jpg',
                    'alt_text' => 'Laptop & Tablet',
                    'items' => ['Office laptop', 'Gaming laptop', 'Laptop accessories', 'Tablet'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 4,
                ],
                [
                    'title' => 'Smartwatches',
                    'image_path' => 'assets/images/cat-smartwatches.jpg',
                    'alt_text' => 'Smartwatches',
                    'items' => ['Sport Watches', 'Watches', 'Kids Watches', 'Luxury Watches'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 5,
                ],
                [
                    'title' => 'Gaming',
                    'image_path' => 'assets/images/cat-gaming.jpg',
                    'alt_text' => 'Gaming',
                    'items' => ['Game Controllers', 'Gaming Keyboards', 'PC Gaming Mice', 'PC Game Headsets'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 6,
                ],
                [
                    'title' => 'Outdoor Camera',
                    'image_path' => 'assets/images/cat-outdoor-camera.jpg',
                    'alt_text' => 'Outdoor Camera',
                    'items' => ['Security & Surveillance', 'Surveillance DVR Kits', 'Surveillance NVR Kits', 'Smart Outdoor Lighting'],
                    'link_text' => 'View all',
                    'link_url' => '#',
                    'sort_order' => 7,
                ],
            ];

            foreach ($categories as $category) {
                HomeCategory::create($category);
            }
        }

        // Seed Trust Items
        if (HomeTrustItem::count() === 0) {
            $trustItems = [
                [
                    'icon_path' => 'assets/images/trust-google.png',
                    'title' => '50,000+ Happy Customers',
                    'subtitle' => null,
                    'stars' => '★★★★★',
                    'sort_order' => 0,
                ],
                [
                    'icon_path' => 'assets/images/trust-gift.png',
                    'title' => '1,000+ Custom Products',
                    'subtitle' => 'High quality. No minimums!',
                    'stars' => null,
                    'sort_order' => 1,
                ],
                [
                    'icon_path' => 'assets/images/trust-discount.png',
                    'title' => 'Affordable Prices',
                    'subtitle' => 'Up to 40% bulk discounts!',
                    'stars' => null,
                    'sort_order' => 2,
                ],
                [
                    'icon_path' => 'assets/images/trust-shipping.png',
                    'title' => 'Fast & Free Shipping',
                    'subtitle' => 'Global delivery. On-time!',
                    'stars' => null,
                    'sort_order' => 3,
                ],
                [
                    'icon_path' => 'assets/images/trust-support.png',
                    'title' => 'Worry Free',
                    'subtitle' => 'Instant 24/7 support',
                    'stars' => null,
                    'sort_order' => 4,
                ],
            ];

            foreach ($trustItems as $item) {
                HomeTrustItem::create($item);
            }
        }

        // Seed Featured Products
        if (HomeFeaturedProduct::count() === 0) {
            for ($i = 1; $i <= 5; $i++) {
                HomeFeaturedProduct::create([
                    'title' => 'Bag',
                    'description' => 'VINGA Baltimore RCS essentials sling bag',
                    'image_path' => "assets/images/featured-{$i}.jpg",
                    'alt_text' => "Featured product {$i}",
                    'price' => '50.00 AED',
                    'whatsapp_message' => 'Hi%2C%20I%20am%20interested%20in%20VINGA%20Baltimore%20RCS%20essentials%20sling%20bag',
                    'sort_order' => $i - 1,
                ]);
            }
        }

        // Seed Product Sections
        if (HomeProductSection::count() === 0) {
            $drinkwareSection = HomeProductSection::create([
                'name' => 'drinkware_kitchenware',
                'title' => 'Drinkware & Kitchenware',
                'subtitle' => 'Extraordinary Events and Exhibition Products Delivered',
                'sort_order' => 0,
            ]);

            $drinkwareProducts = [
                ['title' => 'Botella Pro', 'code' => 'SG4776', 'image_path' => 'assets/images/drink-1.jpg', 'alt_text' => 'Botella Pro'],
                ['title' => 'Botella Ultra', 'code' => 'SG4953', 'image_path' => 'assets/images/drink-2.jpg', 'alt_text' => 'Botella Ultra'],
                ['title' => 'Cozy Tumbler', 'code' => 'SG4954', 'image_path' => 'assets/images/drink-3.jpg', 'alt_text' => 'Cozy Tumbler'],
                ['title' => 'Espresso Stackable', 'code' => 'SG4955', 'image_path' => 'assets/images/drink-4.jpg', 'alt_text' => 'Espresso Stackable'],
                ['title' => 'Espresso go set', 'code' => 'SG4956', 'image_path' => 'assets/images/drink-5.jpg', 'alt_text' => 'Espresso go set'],
                ['title' => 'Gahwa Go Set', 'code' => 'SG4957', 'image_path' => 'assets/images/drink-6.jpg', 'alt_text' => 'Gahwa Go Set'],
                ['title' => 'Prime Flask', 'code' => 'SG4958', 'image_path' => 'assets/images/drink-7.jpg', 'alt_text' => 'Prime Flask'],
            ];

            foreach ($drinkwareProducts as $index => $product) {
                HomeSectionProduct::create([
                    'home_product_section_id' => $drinkwareSection->id,
                    'title' => $product['title'],
                    'code' => $product['code'],
                    'image_path' => $product['image_path'],
                    'alt_text' => $product['alt_text'],
                    'price' => '50.00 AED',
                    'whatsapp_message' => 'Hi%2C%20I%20am%20interested%20in%20' . urlencode($product['title']),
                    'sort_order' => $index,
                ]);
            }

            $giftSection = HomeProductSection::create([
                'name' => 'gift_sets',
                'title' => 'Gift Sets',
                'subtitle' => 'We have unique Apparels no matter how you put it',
                'sort_order' => 1,
            ]);

            for ($i = 1; $i <= 7; $i++) {
                HomeSectionProduct::create([
                    'home_product_section_id' => $giftSection->id,
                    'title' => 'Leather Gift Set',
                    'code' => 'SG4883',
                    'image_path' => "assets/images/gift-{$i}.jpg",
                    'alt_text' => 'Leather Gift Set',
                    'price' => '50.00 AED',
                    'whatsapp_message' => 'Hi%2C%20I%20am%20interested%20in%20Leather%20Gift%20Set',
                    'sort_order' => $i - 1,
                ]);
            }
        }

        // Seed Brands
        if (HomeBrand::count() === 0) {
            $brands = [
                ['name' => 'Stormtech', 'image_path' => 'assets/images/brand-stormtech.jpg', 'alt_text' => 'Stormtech'],
                ['name' => 'Cross', 'image_path' => 'assets/images/brand-cross.jpg', 'alt_text' => 'Cross'],
                ['name' => 'Moleskine', 'image_path' => 'assets/images/brand-moleskine.jpg', 'alt_text' => 'Moleskine'],
                ['name' => 'XD Design', 'image_path' => 'assets/images/brand-xddesign.jpg', 'alt_text' => 'XD Design'],
                ['name' => 'Hans Larsen', 'image_path' => 'assets/images/brand-hanslarsen.jpg', 'alt_text' => 'Hans Larsen'],
                ['name' => 'Change Collection', 'image_path' => 'assets/images/brand-change.jpg', 'alt_text' => 'Change Collection'],
            ];

            foreach ($brands as $index => $brand) {
                HomeBrand::create(array_merge($brand, ['sort_order' => $index]));
            }
        }

        // Seed About Banner
        if (HomeAboutBanner::count() === 0) {
            HomeAboutBanner::create([
                'title' => 'Corporate Gifts & Promotional Gifts Item Supplier in Dubai, UAE.',
                'description' => 'Premium corporate gifts and custom merchandise that leave a lasting impression.',
                'image_path' => 'assets/images/about.jpg',
                'alt_text' => 'Illustration of a professional with earbuds in Dubai',
            ]);
        }

        // Seed Clients
        if (HomeClient::count() === 0) {
            $clients = [
                ['image_path' => 'assets/images/client-1.jpg', 'alt_text' => 'Client logo'],
                ['image_path' => 'assets/images/client-2.jpg', 'alt_text' => 'Client logo'],
                ['image_path' => 'assets/images/client-3.jpg', 'alt_text' => 'Client logo'],
                ['image_path' => 'assets/images/client-4.jpg', 'alt_text' => 'Client logo'],
                ['image_path' => 'assets/images/client-5.jpg', 'alt_text' => 'Client logo'],
                ['image_path' => 'assets/images/client-2.jpg', 'alt_text' => 'Client logo'],
                ['image_path' => 'assets/images/client-3.jpg', 'alt_text' => 'Client logo'],
            ];

            foreach ($clients as $index => $client) {
                HomeClient::create(array_merge($client, ['sort_order' => $index]));
            }
        }

        // Seed Reviews
        if (HomeReview::count() === 0) {
            for ($i = 1; $i <= 5; $i++) {
                HomeReview::create([
                    'name' => 'Guest Relations Manager',
                    'time' => '1 year ago',
                    'avatar' => 'G',
                    'stars' => '★★★★★',
                    'review_text' => 'They deserved to be the number # 1 in the uae when it comes to the supplier for corporate gifts and more.. Starting from i sent …',
                    'platform' => 'Google',
                    'platform_icon' => 'assets/images/trust-google.png',
                    'link_url' => '#',
                    'sort_order' => $i - 1,
                ]);
            }
        }

        // Seed CTA Section
        if (HomeCtaSection::count() === 0) {
            HomeCtaSection::create([
                'eyebrow' => 'Elevate your brand',
                'title' => '<b>Corporate</b> Gifting, Made Simple.',
                'subtitle' => 'Custom solutions for teams, clients and every special occasion.',
                'button_text' => 'Get a Quote',
                'button_url' => 'https://wa.me/971557863450',
                'bow_image_path' => 'assets/images/cta-bow.jpg',
                'features' => [
                    [
                        'icon' => 'assets/images/cta-bulk.png',
                        'title' => 'Bulk Orders',
                        'subtitle' => 'Special Pricing',
                    ],
                    [
                        'icon' => 'assets/images/cta-branding.png',
                        'title' => 'Custom Branding',
                        'subtitle' => 'Your Logo, Your Story',
                    ],
                    [
                        'icon' => 'assets/images/cta-delivery.png',
                        'title' => 'Fast & Reliable Delivery',
                        'subtitle' => 'Across UAE',
                    ],
                    [
                        'icon' => 'assets/images/cta-support.png',
                        'title' => 'Dedicated Support',
                        'subtitle' => 'We\'re Here to Help',
                    ],
                ],
            ]);
        }
    }
}
