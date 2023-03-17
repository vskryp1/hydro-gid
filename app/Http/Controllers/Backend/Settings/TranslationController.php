<?php

	namespace App\Http\Controllers\Backend\Settings;

	use App\Helpers\ShopHelper;
    use App\Models\Faq\FaqTranslation;
    use App\Models\Filters\FilterTranslation;
    use App\Models\Filters\FilterValueTranslation;
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
    use App\Models\Sliders\SliderItemTranslation;
    use App\Models\Sliders\SliderTranslation;
    use App\Models\TemplateTranslation;
    use Barryvdh\TranslationManager\Controller;
    use Barryvdh\TranslationManager\Models\Translation;
    use File;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Artisan;
	use Setting;

	class TranslationController extends Controller
	{

		public function index ($group = null)
		{
		    if($group){
		        $arr = explode('.', $group);
                $group = implode('/', $arr);
            }

			return $this->getIndex($group);
		}

		/**
		 * Add locale with additional data
		 *
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function postAddLocale (Request $request)
		{
			$request->validate([
				'new-locale'  => 'required|min:2|max:3|regex:/^[A-Za-z]+$/',
				'locale_name' => 'required|string|max:10|regex:/^[A-Za-z]+$/',
				'locale_flag' => 'nullable|image|mimes:' . ShopHelper::setting('image_mimes', config('app.image_mimes')) . '|max:' . ShopHelper::setting('image_size', config('app.image_size')),
			]);

			$locales   = $this->manager->getLocales();
			$newLocale = str_replace([], '-', trim($request->input('new-locale')));
			if (!$newLocale || in_array($newLocale, $locales)) {
				return redirect()->back();
			}
			$this->manager->addLocale($newLocale);
			$locales = Setting::get('locales', []);
			if (isset($request->locale_flag)) {
				$icon = $request->locale_flag->store('public/flags');
			} else {
				$icon = 'assets/backend/images/flags/' . $newLocale . '.png';
			}
			$locales[$newLocale] = ['id' => $newLocale, 'name' => $request->locale_name, 'icon' => $icon];
			Setting::set('locales', $locales);
			return redirect()->back();
		}

		/**
		 * Delete locale
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function postRemoveLocale (Request $request)
		{
			foreach ($request->input('remove-locale', []) as $locale => $val) {
//				$this->manager->removeLocale($locale);
                Translation::whereLocale($locale)->delete();
                FaqTranslation::whereLocale($locale)->delete();
                FilterTranslation::whereLocale($locale)->delete();
                FilterValueTranslation::whereLocale($locale)->delete();
                DeliveryPlaceTranslation::whereLocale($locale)->delete();
                DeliveryTranslation::whereLocale($locale)->delete();
                OrderStatusTranslation::whereLocale($locale)->delete();
                PaymentTranslation::whereLocale($locale)->delete();
                PageAdditionalFieldValueTranslation::whereLocale($locale)->delete();
                PageTranslation::whereLocale($locale)->delete();
                ProductImageTranslation::whereLocale($locale)->delete();
                ProductStatusTranslation::whereLocale($locale)->delete();
                ProductTranslation::whereLocale($locale)->delete();
                RegionTranslation::whereLocale($locale)->delete();
                SliderItemTranslation::whereLocale($locale)->delete();
                SliderTranslation::whereLocale($locale)->delete();
                TemplateTranslation::whereLocale($locale)->delete();

				File::chmod(app()->langPath() . '/' . $locale, 0777);
				File::deleteDirectory(app()->langPath() . '/' . $locale);
				Setting::forget('locales.' . $locale);
			}
			return redirect()->back();
		}

		/**
		 * Import from Google Spreadsheet
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function gsImport (Request $request)
		{
			Artisan::call('translation_sheet:pull');
			Artisan::call('translations:import', ['--replace' => true]);
			$request->session()->flash('success', ['text' => __('backend.gs_import_success')]);
			return response()->json(['status' => 'OK']);
		}

		/**
		 * Export to Google Spreadsheet
		 * @param Request $request
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function gsExport (Request $request)
		{
			Artisan::call('translation_sheet:push');
			$request->session()->flash('success', ['text' => __('backend.gs_export_success')]);
			return response()->json(['status' => 'OK']);
		}
	}
