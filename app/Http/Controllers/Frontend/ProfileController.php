<?php

    namespace App\Http\Controllers\Frontend;

    use App\Enums\PageAlias;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Frontend\Profile\ChangePasswordRequest;
    use App\Http\Requests\Frontend\Profile\UpdateUserFormRequest;
    use App\Models\Client\Client;
    use App\Models\Product\Product;
    use Exception;
    use Gloudemans\Shoppingcart\Facades\Cart;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Response;
    use RealRashid\SweetAlert\Facades\Alert;

    class ProfileController extends Controller
    {
        public function update(UpdateUserFormRequest $request, Client $user)
        {
            $user->update($request->all());

            return $this->redirect(__('frontend/profile/index.profile_updated'));
        }

        public function putInWishlist(string $user_id, Product $product)
        {
            try {
                Cart::instance('wishlist');
                Cart::instance('wishlist')->restore('wishlist.' . $user_id);
                $item = Cart::instance('wishlist')->add($product)->associate(Product::class);
                Cart::instance('wishlist')->store('wishlist.' . $user_id);

                return Response::json([
                                          'type'      => 'success',
                                          'removeUrl' => route('ajax.user.remove.from.wishlist', [
                                              'user_id' => auth('web')->id(),
                                              'row_id'  => $item->rowId,
                                          ]),
                                          'html'      => __('frontend/profile/index.wishlist_messages.putted'),
                                      ]);
            } catch (Exception $exception) {
                return Response::json([
                    'type' => 'warning',
                    'html' => $exception->getMessage(),
                ]);
            }
        }

        public function removeFromWishlist(string $user_id, string $rowId)
        {
            try {
                Cart::instance('wishlist');
                Cart::instance('wishlist')->restore('wishlist.' . $user_id);
                Cart::instance('wishlist')->remove($rowId);
                if (Cart::instance('wishlist')->count() > 0) {
                    Cart::instance('wishlist')->store('wishlist.' . $user_id);
                }

                return Response::json([
                    'type' => 'success',
                    'html' => __('frontend/profile/index.wishlist_messages.removed'),
                ]);
            } catch (Exception $exception) {
                return Response::json([
                    'type' => 'warning',
                    'html' => $exception->getMessage(),
                ]);
            }
        }

        public function putInWaitinglist(string $user_id, Product $product)
        {
            try {
                Cart::instance('waitinglist');
                Cart::instance('waitinglist')->restore('waitinglist.' . $user_id);
                Cart::instance('waitinglist')->add($product)->associate(Product::class);
                Cart::instance('waitinglist')->store('waitinglist.' . $user_id);

                return Response::json([
                    'type' => 'success',
                    'html' => __('frontend/profile/index.waitinglist_messages.putted'),
                ]);
            } catch (Exception $exception) {
                return Response::json([
                    'type' => 'warning',
                    'html' => $exception->getMessage(),
                ]);
            }
        }

        public function removeFromWaitinglist(string $user_id, string $rowId)
        {
            try {
                Cart::instance('waitinglist');
                Cart::instance('waitinglist')->restore('waitinglist.' . $user_id);
                Cart::instance('waitinglist')->remove($rowId);
                if (Cart::instance('waitinglist')->count() > 0) {
                    Cart::instance('waitinglist')->store('waitinglist.' . $user_id);
                }

                return Response::json([
                    'type' => 'success',
                    'html' => __('frontend/profile/index.waitinglist_messages.removed'),
                ]);
            } catch (Exception $exception) {
                return Response::json([
                    'type' => 'warning',
                    'html' => $exception->getMessage(),
                ]);
            }
        }

        public function putInComparelist(string $user_id, Product $product)
        {
            try {
                $cart = Cart::instance('comparelist');
                if (auth('web')->check()) {
                    $cart->restore('comparelist.' . $user_id);
                }
                $item = $cart->add($product)->associate(Product::class);
                if (auth('web')->check()) {
                    $cart->store('comparelist.' . $user_id);
                }

                return Response::json([
                    'type' => 'success',
                    'removeUrl' => route('ajax.user.remove.from.comparelist', [
                        'user_id' => auth('web')->id() ?? 'guest',
                        'row_id'  => $item->rowId,
                    ]),
                    'html' => __('frontend/profile/index.comparelist_messages.putted'),
                ]);
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
                return Response::json([
                    'type' => 'warning',
                    'html' => __('frontend.error_title'),
                ]);
            }
        }

        public function removeFromComparelist(string $user_id, string $rowId)
        {
            try {
                $cart = Cart::instance('comparelist');
                if (auth('web')->check()) {
                    $cart->restore('comparelist.' . $user_id);
                }
	            $categoryId = Product::whereId($cart->get($rowId)->id)->first()->mainCategory->id;
                $cart->remove($rowId);
                if ($cart->count() > 0 && auth('web')->check()) {
                    $cart->store('comparelist.' . $user_id);
                }
	            $count = $cart->content()->reverse()->filter(function ($item) use ($categoryId){
		            return $item->model->mainCategory->id == $categoryId;
	            })->count();

                return Response::json([
                    'type'  => 'success',
                    'html'  => __('frontend/profile/index.comparelist_messages.removed'),
	                'count' => $count,
                ]);
            } catch (Exception $exception) {
                return Response::json([
                    'type' => 'warning',
                    'html' => $exception->getMessage(),
                ]);
            }
        }

        public function clearComparelistByCategory(string $user_id, string $categoryId)
        {
            $cart = Cart::instance('comparelist');
            if (auth('web')->check()) {
                $cart->restore('comparelist.' . $user_id);
            }
            $comparelist = Cart::instance('comparelist')->content()->reverse();
            $productIds  = Product::whereIn('id', $comparelist->pluck('id'))
                                  ->selectRaw('products.id')
                                  ->join('page_product', 'products.id', '=', 'page_product.product_id')
                                  ->where('page_product.page_id', $categoryId)
                                  ->pluck('id');
            $comparelist->whereIn('id', $productIds)->each(function($cartItem) use ($cart) {
                $cart->remove($cartItem->rowId);
            });
            if ($cart->count() > 0 && auth('web')->check()) {
                $cart->store('comparelist.' . $user_id);
            }

            return redirect(route('frontend.page', PageAlias::PAGE_COMPARE_CART))
                ->with(__('frontend/profile/index.comparelist_messages.сategory_removed'));
        }

        /**
         * @param \App\Http\Requests\Frontend\Profile\ChangePasswordRequest $request
         *
         * @return string
         */
        public function changePassword(ChangePasswordRequest $request)
        {
            if (Hash::check($request->oldPassword, auth()->user()->password)) {
                $user           = auth()->user();
                $user->password = bcrypt($request->newPassword);
                $user->save();
                Alert::success(__('frontend/profile/index.congratulation'), __('frontend/profile/index.update_password'));
            } else {
                Alert::error(__('frontend/profile/index.error'), __('frontend/profile/index.false_old_password'));
            }
            return redirect()->back();
        }
    }