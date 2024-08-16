<?php

namespace App\Livewire;

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
        Auth::user()
            ->purchases()
            ->create([
                'product_id' => $productId
            ]);

        $previousRoute = request()->header('Referer');
        return redirect($previousRoute);
    }
}
