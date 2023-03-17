<?php

    use App\Models\Client\Client;
    use App\Models\Currency\Currency;
    use App\Models\Order\Delivery;
    use App\Models\Order\Order;
    use App\Models\Order\OrderStatus;
    use App\Models\Order\Payment;
    use App\Models\Product\Product;
    use App\Models\Product\Promocode;
    use App\Models\Region\Region;
    use App\Models\User;
    use Illuminate\Database\Seeder;

    /**
     * Class OrdersSeeder
     */
    class OrdersSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run(): void
        {
            $clients        = Client::with('addresses')->get();
            $managers       = User::role('Manager')->get();
            $products       = Product::all();
            $order_statuses = OrderStatus::whereProcessed(true)->get();
            $promocodes     = Promocode::all();
            $regions        = Region::all();
            $currencies     = Currency::all();
            $deliveries     = Delivery::all();
            $payments       = Payment::all();

            for ($i = 1; $i <= 200; $i++) {
                $order_products = [];
                $sum            = 0;
                foreach ($products->random(rand(1, 5)) as $op) {
                    $qty              = rand(1, 5);
                    $order_products[] = ['product_id' => $op->id, 'qty' => $qty, 'price' => $op->price];
                    $sum              += $op->price * $qty;
                }
                $date                    = \Carbon\Carbon::now()->subDays(rand(0, 400));
                $client                  = $clients->random();
                $delivery                = $deliveries->random();
                $data['total_price']     = $sum;
                $data['client_id']       = $client->id;
                $data['address_id']      = $client->addresses->random()->id;
                $data['user_id']         = $managers->random()->id;
                $data['unique_id']       = 'SEED-' . $i;
                $data['order_status_id'] = $order_statuses->random()->id;
                $data['currency_id']     = $currencies->random()->id;
                $data['delivery_id']     = $deliveries->random()->id;
                $data['region_id']       = $regions->random()->id;
                $data['payment_id']      = $payments->random()->id;
                $data['locale']          = 'en';
                $data['delivery_price']  = $delivery->price;
                $data['created_at']      = $date;
                $data['updated_at']      = $date;

                if (rand(0, 1)) {
                    $promocode = $promocodes->random();
                    if ($promocode) {
                        $discount = $promocode->discount_size;
                        if ($promocode->type == Promocode::PERCENT) {
                            $discount = $sum * $promocode->discount_size / 100;
                        }
                        $data['promocode_id'] = $promocode->id;
                        $data['discount']     = $discount;
                        $promocode->increment('used');
                    }
                }

                $order = Order::create($data);
                $order->products()->attach($order_products);
            }
        }
    }
