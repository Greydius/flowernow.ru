<?php

namespace App;

use App\Model\Product;
use App\Model\Order;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function totalProducts($status = [], $dop = 0) {
            $productsModel= Product::select('id')->whereNull('single')->where('dop', $dop);

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
                    $ordersModel->whereIn('shop_id', $this->shops->pluck('id')->toArray())->where('confirmed', 1);
            }

            $status = ['new', 'accepted'];

            $ordersModel->whereIn('status', $status);

            return $ordersModel->count();
    }

        public function sendPasswordResetNotification($token)
        {
                $this->notify(new Notifications\ResetPassword($token));
        }

        // relation for Supervisor
        function supervisor() {
                return $this->hasMany('App\Model\Supervisor');
        }

        public function isSupervisor($cityId = null) {
                return self::whereHas('supervisor', function($q) use ($cityId) {
                        $q->where('user_id', $this->id);
                        if(!empty($cityId)) {
                                $q->where('city_id', $cityId);
                        }
                })->count();
        }
}
