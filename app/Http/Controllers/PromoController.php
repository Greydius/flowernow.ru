<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\User;
use App\Model\Shop;
use App\Model\City;

/**
 * @group Promo
 */

class PromoController extends Controller
{
        public function index(Request $request) {
            if($this->user && $this->user->admin) {
                $shopsQ = Shop::where('copy_id', '=', 350)->with('users')->with('city');
                $spell = $request->spell;
                if($spell) {
                    $shopsQ->whereHas('city', function(Builder $query) use($spell) {
                        $query->where('name', 'like', $spell . '%');
                    }); 
                } else {
                    $shopsQ->whereHas('city', function(Builder $query) {
                        $query->where('name', 'like', 'А%');
                    }); 
                }

                $shops = $shopsQ->get();

                return response()->view('front.promo', [
                        'shops' => $shops
                ]);
            } else {
                return redirect('/');
            }
                
        }
}