<?php

namespace App;

use App\Model\Product;
use App\Model\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shops() {
            return $this->belongsToMany('App\Model\Shop');
    }

    public function getShop() {
            return $this->shops->first();
    }

    public function totalProducts($status = []) {
            $productsModel= Product::select('id');

            if(!$this->admin) {
                    $productsModel->whereIn('shop_id', $this->shops->pluck('id')->toArray());
            }

            if(!empty($status)) {
                    $productsModel->whereIn('status', $status);
            }

            return $productsModel->count();
    }

    public function totalNotCompletedOrders() {
            $ordersModel= Order::select('id')->where('payed', 1);

            if(!$this->admin) {
                    $ordersModel->whereIn('shop_id', $this->shops->pluck('id')->toArray());
            }

            $status = ['new', 'accepted'];

            $ordersModel->whereIn('status', $status);

            return $ordersModel->count();
    }
}
