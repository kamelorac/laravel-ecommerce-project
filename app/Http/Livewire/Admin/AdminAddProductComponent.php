<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;

    public function mount(){
        $this->stock_status='instock';
        $this->featured=0;
    }

    public function generateSlug(){
        $this->slug= Str::slug($this->name,'-');
    }

    public function update($fields){
        $this->validateOnly($fields,[

            'name'=>'required',
            'slug'=>'required|unique:products',
            'short_description'=>'required',
            'description'=>'required',
            'regular_price'=>'required|numeric',
            'stock_status'=>'required',
            'quantity'=>'required|numeric',
            'image'=>'required|mimes:jpeg,png,jpg',
            'category_id'=>'required',
            'sale_price'=>'numeric'
        ]);

    }
    public function addProduct(){
        $this->validate([
             'name'=>'required',
             'slug'=>'required|unique:products',
             'short_description'=>'required',
             'description'=>'required',
             'regular_price'=>'required|numeric',
             'stock_status'=>'required',
             'quantity'=>'required|numeric',
             'image'=>'required|mimes:jpeg,png,jpg',
             'category_id'=>'required',
             'sale_price'=>'numeric'
        ]);
        $product= new Product();
        $product->name=$this->name;
        $product->slug=$this->slug;
        $product->short_description=$this->short_description;
        $product->description=$this->description;
        $product->regular_price=$this->regular_price;
        $product->sale_price=$this->sale_price;
        $product->SKU=$this->SKU;
        $product->stock_status=$this->stock_status;
        $product->featured=$this->featured;
        $product->quantity=$this->quantity;
        $imageName=Carbon::now()->timestamp. '.' . $this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->image=$imageName;
        $product->category_id=$this->category_id;
        $product->save();
        session()->flash('message','Product has been created');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}
