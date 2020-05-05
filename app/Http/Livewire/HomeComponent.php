<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $lproducts=Product::orderBy('created_at','DESC')->get()->take(8);
        $sproducts=Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        $sale=Sale::find(1);
        return view('livewire.home-component',['lproducts'=>$lproducts,'sproducts'=>$sproducts,'sale'=>$sale])->layout('layouts.base');
    }
}
