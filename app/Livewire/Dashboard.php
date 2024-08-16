<?php

namespace App\Livewire;

use App\Events\PurchaseEvent;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Dashboard extends Component
{
    public $products;

    public function render()
    {
        $this->products = Product::all();

        return view('livewire.dashboard');
    }

    public function buy(int $productId)
    {
        $purchase = Auth::user()
                        ->purchases()
                        ->create([
                            'product_id' => $productId
                        ]);
                        
        PurchaseEvent::dispatch($purchase);

        $previousRoute = request()->header('Referer');
        return redirect($previousRoute);
    }
}
