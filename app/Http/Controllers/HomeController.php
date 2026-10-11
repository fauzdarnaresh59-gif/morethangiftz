<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

class HomeController extends Controller
{
    public function index()
    {
        $hero = HomeHero::where('is_active', true)->orderBy('sort_order')->first();
        $categories = HomeCategory::where('is_active', true)->orderBy('sort_order')->get();
        $trustItems = HomeTrustItem::where('is_active', true)->orderBy('sort_order')->get();
        $featuredProducts = HomeFeaturedProduct::where('is_active', true)->orderBy('sort_order')->get();
        $productSections = HomeProductSection::where('is_active', true)
            ->with(['products' => function($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();
        $brands = HomeBrand::where('is_active', true)->orderBy('sort_order')->get();
        $aboutBanner = HomeAboutBanner::where('is_active', true)->first();
        $clients = HomeClient::where('is_active', true)->orderBy('sort_order')->get();
        $reviews = HomeReview::where('is_active', true)->orderBy('sort_order')->get();
        $ctaSection = HomeCtaSection::where('is_active', true)->first();

        return view('home', compact(
            'hero',
            'categories',
            'trustItems',
            'featuredProducts',
            'productSections',
            'brands',
            'aboutBanner',
            'clients',
            'reviews',
            'ctaSection'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $results = [];

        if (strlen($query) >= 2) {
            // Search in featured products
            $featuredProducts = HomeFeaturedProduct::where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->get()
                ->map(function($product) {
                    return [
                        'type' => 'Featured Product',
                        'title' => $product->title,
                        'description' => $product->description,
                        'image' => $product->image_path,
                        'price' => $product->price,
                    ];
                });

            // Search in section products
            $sectionProducts = HomeSectionProduct::where('is_active', true)
                ->with('section')
                ->where(function($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('code', 'like', "%{$query}%");
                })
                ->get()
                ->map(function($product) {
                    return [
                        'type' => $product->section->title ?? 'Product',
                        'title' => $product->title,
                        'description' => $product->code,
                        'image' => $product->image_path,
                        'price' => $product->price,
                    ];
                });

            // Search in categories
            $categories = HomeCategory::where('is_active', true)
                ->where('title', 'like', "%{$query}%")
                ->get()
                ->map(function($category) {
                    return [
                        'type' => 'Category',
                        'title' => $category->title,
                        'description' => 'Browse category',
                        'image' => $category->image_path,
                        'price' => null,
                    ];
                });

            $results = collect()
                ->concat($featuredProducts)
                ->concat($sectionProducts)
                ->concat($categories)
                ->take(10)
                ->values();
        }

        return response()->json($results);
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = $request->email;

        // Get the recipient email from .env or use a default
        $recipientEmail = env('NEWSLETTER_RECIPIENT_EMAIL', 'link.supportjaipur@gmail.com');

        try {
            // Log the subscription attempt
            \Log::info("Newsletter subscription attempt from: {$email}");

            // Send email notification to the configured recipient
            Mail::raw("New Newsletter Subscription\n\nEmail: {$email}\n\nDate: " . now()->toDateTimeString(), function ($message) use ($recipientEmail, $email) {
                $message->to($recipientEmail)
                    ->subject('New Newsletter Subscription')
                    ->from(env('MAIL_FROM_ADDRESS', 'link.supportjaipur@gmail.com'), env('MAIL_FROM_NAME', 'More Than Giftz'));
            });

            \Log::info("Newsletter subscription email sent to: {$recipientEmail}");

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing!'
            ]);
        } catch (\Exception $e) {
            \Log::error("Newsletter subscription error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error. Please try again.'
            ], 500);
        }
    }
}
