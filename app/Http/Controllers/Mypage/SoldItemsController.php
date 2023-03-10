<?php

namespace App\Http\Controllers\MyPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoldItemsController extends Controller
{
     public function showSoldItems()
     {
         $user = Auth::user();
 
         $items = $user->soldItems()
            ->with('secondaryCategory.primaryCategory')
            // ->with(['secondaryCategory', 'secondaryCategory.primaryCategory'])
            ->orderBy('id', 'DESC')->get();
 
         return view('mypage.sold_items')
             ->with('items', $items);
     }
}
