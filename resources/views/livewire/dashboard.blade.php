<layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            {{-- Products --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/2 shadow">
                <div class="p-6 text-gray-900 ">
                    <h1 class='text-2xl mt-2 mb-4'>Products</h1>

                    <table class="w-full">
                        <thead class="uppercase text-gray-400">
                            <tr>
                                <th class='text-left'>Id</th>
                                <th class='text-left'>Name</th>
                                <th class='text-left'>Price</th>
                                <th class='text-left'>Buy</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <button wire:click='buy({{$product->id}})' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>
                                            Buy
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Purchases --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-1/2 shadow ml-4">
                <div class="p-6 text-gray-900">
                    <h1 class='text-2xl mt-2 mb-4'>Purchases</h1>

                    <table class="w-full">
                        <thead class="uppercase text-gray-400">
                            <tr>
                                <th class='text-left'>Id</th>
                                <th class='text-left'>Date</th>
                                <th class='text-left'>Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->created_at }}</td>
                                    <td>{{ $purchase->product->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan='3' class='text-gray-400'>No purchases yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<layout>
