<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
        // relation for shop
        function shop() {
                return $this->belongsTo('App\Model\Shop');
        }


        public function createTransaction() {



                \DB::beginTransaction();

                try{
                        $transaction = new Transaction();
                        $transaction->shop_id = $this->shop_id;
                        $transaction->action = 'out';
                        $transaction->action_id = $this->id;
                        $transaction->amount = $this->amount;
                        $transaction->subtract = 0;

                        if($transaction->save()) {
                                $shop = Shop::find($this->shop_id);
                                $shop->balance = $shop->balance - $transaction->amount;
                                if($shop->save()) {
                                        \DB::commit();
                                }

                                return $transaction->id;
                        }

                        \DB::rollBack();

                } catch (\Exception $e) {

                        \DB::rollBack();

                        throw $e;
                }

                return null;
        }
}
