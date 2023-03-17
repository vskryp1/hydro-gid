<?php

    use App\Models\Order\Payment;
    use App\Models\Region\Region;
    use Illuminate\Database\Seeder;
    use App\Enums\PaymentType;

    /**
     * Class PaymentsSeeder
     */
    class PaymentsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $payments = [
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'type'       => PaymentType::CASHLESS,
                    'position'   => 1,
                    'uk'         => ['name' => 'Безготівковій розрахунок'],
                    'ru'         => ['name' => 'Безналичный расчет'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => true,
                    'type'       => PaymentType::CASH,
                    'position'   => 2,
                    'uk'         => ['name' => 'Готівкою'],
                    'ru'         => ['name' => 'Наличными'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'type'       => PaymentType::VISA,
                    'position'   => 3,
                    'uk'         => ['name' => 'Visa/MasterCard'],
                    'ru'         => ['name' => 'Visa/MasterCard'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'type'       => PaymentType::PRIVAT24,
                    'position'   => 4,
                    'uk'         => ['name' => 'Приват24'],
                    'ru'         => ['name' => 'Приват24'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'type'       => PaymentType::LIQPAY,
                    'position'   => 5,
                    'uk'         => ['name' => 'Liqpay'],
                    'ru'         => ['name' => 'Liqpay'],
                ],
                [
                    'is_active'  => true,
                    'is_default' => false,
                    'type'       => PaymentType::PRIVAT24_BY_PART,
                    'position'   => 6,
                    'uk'         => ['name' => 'Оплата частями'],
                    'ru'         => ['name' => 'Оплата частями'],
                ],
            ];
            $regions  = Region::all()->pluck('id');
            foreach ($payments as $payment) {
                $payment = Payment::create($payment);
                $payment->regions()->attach($regions);
            }
        }
    }
