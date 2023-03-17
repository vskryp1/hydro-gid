<?php

    use Illuminate\Database\Seeder;
    use App\Enums\ProductStatus;
    use App\Models\Product\ProductStatus as ProdStatus;

    /**
     * Class ProductStatusesSeeder
     */
    class ProductStatusesAliasSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            foreach (ProductStatus::toSelectArray() as $position => $alias){
                ProdStatus::where('position', $position)->update(['alias' => $position]);
            }
        }
    }
