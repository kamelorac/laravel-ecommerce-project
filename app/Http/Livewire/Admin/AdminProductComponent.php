<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class AdminProductComponent extends Component
{

    use WithPagination;

    public function deleteProduct($id)
    {
      $product= Product::find($id);
      $product->delete();
      session()->flash('message','product has been deleted');
    }

    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.base');
    }
}
