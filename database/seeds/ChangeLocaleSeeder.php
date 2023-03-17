<?php

use App\Models\Faq\FaqTranslation;
use App\Models\Filters\FilterTranslation;
use App\Models\Filters\FilterValueTranslation;
use App\Models\Menu\MenuItemTranslation;
use App\Models\Order\DeliveryPlaceTranslation;
use App\Models\Order\DeliveryTranslation;
use App\Models\Order\OrderStatusTranslation;
use App\Models\Order\PaymentTranslation;
use App\Models\Page\PageAdditionalFieldValueTranslation;
use App\Models\Page\PageTranslation;
use App\Models\Product\ProductImageTranslation;
use App\Models\Product\ProductStatusTranslation;
use App\Models\Product\ProductTranslation;
use App\Models\Region\RegionTranslation;
use App\Models\SettingModel;
use App\Models\Sliders\SliderItemTranslation;
use App\Models\Sliders\SliderTranslation;
use App\Models\Stock\StockTranslation;
use App\Models\TemplateTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ChangeLocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$from = 'ua';
    	$to   = 'uk';
	    Log::info('Change locale START');
	    DeliveryTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('DeliveryTranslation updated');
	    DeliveryPlaceTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('DeliveryPlaceTranslation updated');
	    FaqTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('FaqTranslation updated');
	    FilterTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('FilterTranslation updated');
	    FilterValueTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('FilterValueTranslation updated');
	    MenuItemTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('MenuItemTranslation updated');
	    OrderStatusTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('OrderStatusTranslation updated');
	    PageTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('PageTranslation updated');
	    PageAdditionalFieldValueTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('PageAdditionalFieldValueTranslation updated');
	    PaymentTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('PaymentTranslation updated');
	    ProductImageTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('ProductImageTranslation updated');
	    ProductStatusTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('ProductStatusTranslation updated');
	    ProductTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('ProductTranslation updated');
	    RegionTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('RegionTranslation updated');
	    SliderItemTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('SliderItemTranslation updated');
	    SliderTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('SliderTranslation updated');
	    StockTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('StockTranslation updated');
	    TemplateTranslation::where('locale', $from)->update(['locale' => $to]);
	    Log::info('TemplateTranslation updated');
	    SettingModel::where('locale', $from)->update(['locale' => $to]);
	    Log::info('SettingModel updated');
	    Log::info('Change locale FINISH');
    }
}
