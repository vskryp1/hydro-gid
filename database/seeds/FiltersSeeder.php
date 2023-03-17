<?php

    use App\Models\Filters\Filter;
    use App\Models\Filters\FilterType;
    use App\Models\Filters\FilterValue;
    use App\Models\Page\Page;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Str;

    /**
     * Class FiltersSeeder
     */
    class FiltersSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::Table('filter_translations')->truncate();
            DB::Table('filter_value_translations')->truncate();
            DB::Table('filter_values')->truncate();
            DB::Table('filter_page')->truncate();
            DB::Table('filters')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            $checkbox_id = Str::uuid()->toString();
            FilterType::insert([
                ['id' => $checkbox_id, 'name' => 'Checkbox', 'file' => 'checkbox'],
                ['id' => Str::uuid()->toString(), 'name' => 'Radiobutton', 'file' => 'radiobutton'],
                ['id' => Str::uuid()->toString(), 'name' => 'Slider', 'file' => 'slider'],
            ]);

            $categories = Page::productCategories()->get();
            $filter     = Filter::create([
                'filter_type_id' => $checkbox_id,
                'alias'          => 'pressure',
                'position'       => 3,
                'ru'             => [
                    'name'        => 'Максимальное давление',
                    'description' => '',
                ],
            ]);
            $filter->pages()->sync($categories->pluck('id')->toArray());
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => '100bar',
                'position'  => 1,
                'ru'        => [
                    'name' => '100 бар',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => '200bar',
                'position'  => 2,
                'ru'        => [
                    'name' => '200 бар',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => '260bar',
                'position'  => 3,
                'ru'        => [
                    'name' => '260 бар',
                ],
            ]);

            $filter = Filter::create([
                'filter_type_id' => $checkbox_id,
                'alias'          => 'packing',
                'is_option'      => true,
                'position'       => 1,
                'ru'             => [
                    'name'        => 'Упаковка',
                    'description' => '',
                ],
            ]);
            $filter->pages()->sync($categories->pluck('id')->toArray());
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => '40cm3',
                'position'  => 1,
                'ru'        => [
                    'name' => '40 cm3',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => '63cm3',
                'position'  => 2,
                'ru'        => [
                    'name' => '63 cm3',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => '80cm3',
                'position'  => 3,
                'ru'        => [
                    'name' => '80 cm3',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => '110cm3',
                'position'  => 3,
                'ru'        => [
                    'name' => '110 cm3',
                ],
            ]);

            $filter = Filter::create([
                'filter_type_id' => $checkbox_id,
                'alias'          => 'type',
                'position'       => 4,
                'ru'             => [
                    'name'        => 'Корпус',
                    'description' => '',
                ],
            ]);
            $filter->pages()->sync($categories->pluck('id')->toArray());
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => 'aluminium',
                'position'  => 1,
                'ru'        => [
                    'name' => 'Алюминиевый',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => 'steal',
                'position'  => 2,
                'ru'        => [
                    'name' => 'Стальной',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => 'chugun',
                'position'  => 3,
                'ru'        => [
                    'name' => 'Чугунный',
                ],
            ]);

            $filter = Filter::create([
                'filter_type_id' => $checkbox_id,
                'alias'          => 'producer',
                'position'       => 2,
                'ru'             => [
                    'name'        => 'Производитель',
                    'description' => '',
                ],
            ]);
            $filter->pages()->sync($categories->pluck('id')->toArray());
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => 'japan',
                'position'  => 1,
                'ru'        => [
                    'name' => 'Япония',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => 'usa',
                'position'  => 2,
                'ru'        => [
                    'name' => 'США',
                ],
            ]);
            FilterValue::create([
                'filter_id' => $filter->id,
                'alias'     => 'ukraine',
                'position'  => 3,
                'ru'        => [
                    'name' => 'Украина',
                ],
            ]);
        }
    }
