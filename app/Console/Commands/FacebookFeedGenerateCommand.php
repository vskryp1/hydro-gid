<?php

namespace App\Console\Commands;

use App\Helpers\PageHelper;
use App\Helpers\ShopHelper;
use App\Models\Product\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Vitalybaev\GoogleMerchant\Feed;
use Vitalybaev\GoogleMerchant\Product as MerchantProduct;
use Vitalybaev\GoogleMerchant\Product\Availability\Availability;
use App\Enums\ProductAvailability;

class FacebookFeedGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facebook:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate facebook_feed.xml file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Create feed object
        $feed = new Feed(ShopHelper::setting('site_name'), env('APP_URL'), __('frontend.seo_title_main'));
        $products = Product::onlyActive()->get();

        $bar      = $this->output->createProgressBar(count($products));
        $bar->start();

        // Put products to the feed ($products - some data from database for example)
        foreach ($products as $product) {
            $item = new MerchantProduct();

            // Set common product properties
            $item->setId($product->sku);
            $item->setTitle($product->name);
            $product->description = preg_replace('/<[\s]*?img.*?>/i', '', $product->description);
            $item->setDescription($this->isValidDescription($product->description) ? $product->description : $product->name);
            $item->setLink($product->alias);
            $item->setImage($product->cover->getUrl('prod_md'));
            switch ((string) $product->availability) {
                case (ProductAvailability::AVAILABLE):
                    $item->setAvailability(Availability::IN_STOCK);
                    break;
                case (ProductAvailability::NOT_AVAILABLE):
                    $item->setAvailability(Availability::OUT_OF_STOCK);
                    break;
                case (ProductAvailability::UNDER_ORDER || ProductAvailability::EXPECTED_DELIVERY):
                    $item->setAvailability(Availability::PREORDER);
                    break;
            }
            $item->setPrice(str_replace(' ', '', $product->format_price) . ' UAH');
            if($product->hasDiscount()) {
                $item->setPrice(str_replace(' ', '', $product->format_price_old) . ' UAH');
                $item->setSalePrice(str_replace(' ', '', $product->format_price) . ' UAH');
                $item->setAttribute('sale_price_effective_date',
                    $product->stock->first()->start_date->format('Y-m-d') . ' / ' . $product->stock->first()->expiration_date->format('Y-m-d'),
                    false);
            }

            $product_type = Arr::pluck(PageHelper::getBreadcrumbsPage($product->main_category), 'name');
            $product_type[] = $product->name;
            $item->setProductType(implode(' > ', $product_type));
            $item->setBrand(ShopHelper::setting('site_name'));
            $item->setIdentifierExists('no');
            $item->setCondition('new');

            // Add this product to the feed
            $feed->addProduct($item);

            $bar->advance();
        }

        // Here we get complete XML of the feed, that we could write to file or send directly
        $feedXml = $feed->build();
        Storage::disk('public')
            ->put('facebook_feed.xml', $feedXml);
        $bar->finish();
    }

    public function isValidDescription($description) {
        $description = str_replace(array("\r\n", "\r", "\n"), '',  strip_tags(str_replace(' ', '', html_entity_decode($description))));
        return preg_match('/[a-zA-Z0-9]/', $description);
    }
}
