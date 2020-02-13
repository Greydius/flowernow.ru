<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ToAppController extends Controller
{
  public function redirect(Request $request) {
    $agent = $request->header('User-Agent');
    $iPod    = stripos($agent,"iPod");
    $iPhone  = stripos($agent,"iPhone");
    $iPad    = stripos($agent,"iPad");
    $Android = stripos($agent,"Android");

    if( $iPod || $iPhone || $iPad ){
      return redirect('https://apps.apple.com/us/app/floristum-shop/id1490079810?ign-mpt=uo%3D4');
    }else if($Android){
      return redirect('https://play.google.com/store/apps/details?id=ru.floristum.app&hl=en_US');
    }else {
      return redirect()->route('front.index');
    }
  }
}