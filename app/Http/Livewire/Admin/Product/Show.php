<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\Component;
use App\Models\Category as CategoryModel;
use App\Models\Product;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;
    public $perPage = 10;
    protected $paginationTheme ='bootstrap';
    public $search;

    public function mount(){
        $this->search="";
    }
    public function resetSearch(){
        $this->search="";
        $this->resetPage();
    }
    public function updatedSearch(){
      $this->resetPage();
    }

    public function delete($id){
        $product = Product::find($id);
        if(!empty($product)){
            $product->delete();
        }
    }

    public function render()
    {
        $products = Product::search($this->search)->paginate($this->perPage);
        return view('livewire.admin.product.show')->layout('layouts.admin.home')->with('products',$products);
    }

    public function updatedPerPage(){
        $this->resetPage();
    }
}
