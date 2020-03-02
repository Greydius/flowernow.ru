<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

/**
 * @group Promo
 */

class PromoController extends Controller
{
        public function index() {
                $users = User::where('confirmation_code', '=', 'eGSbgWeVWdGz9YPQVxhoesx2wIigFq')->with('shops')->get();
                return response()->view('front.promo', [
                        'users' => $users
                ]);
        }
}