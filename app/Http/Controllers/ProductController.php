<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Batter;
use App\Models\Topping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['batters', 'toppings'])->get();

        // Kalau Vue minta JSON
        if (request()->wantsJson()) {
            return response()->json(['products' => $products]);
        }

        // Kalau browser biasa
        return view('products.index', compact('products'));
    }

    public function fetchAndStore()
    {
        $url = 'https://repocodes.s3.amazonaws.com/interview.json';
        $data = Http::get($url)->json();

        DB::transaction(function () use ($data) {
            DB::table('product_batter')->delete();
            DB::table('product_topping')->delete();
            Product::query()->delete();
            Batter::query()->delete();
            Topping::query()->delete();

            foreach ($data as $item) {
                $product = Product::create([
                    'id' => $item['id'],
                    'type' => $item['type'],
                    'name' => $item['name'],
                    'ppu' => $item['ppu']
                ]);

                foreach ($item['batters']['batter'] as $b) {
                    $batter = Batter::firstOrCreate(
                        ['id' => $b['id']],
                        ['type' => $b['type']]
                    );
                    $product->batters()->attach($batter->id);
                }

                foreach ($item['topping'] as $t) {
                    $topping = Topping::firstOrCreate(
                        ['id' => $t['id']],
                        ['type' => $t['type']]
                    );
                    $product->toppings()->attach($topping->id);
                }
            }
        });

        return redirect()->route('products.index')->with('success', 'Data fetched & stored!');
    }
}
