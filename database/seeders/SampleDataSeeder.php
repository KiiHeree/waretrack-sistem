<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Stock;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $w = Warehouse::create(['name' => 'Gudang Utama', 'address' => 'Jln A no 1', 'city' => 'Jakarta', 'phone' => '081200000']);
        $c1 = Category::create(['name' => 'Elektronik', 'description' => 'Perangkat elektronik']);
        $i1 = Item::create(['sku' => 'EL-001', 'name' => 'Adaptor 5V', 'category_id' => $c1->id, 'min_stock' => 5, 'unit' => 'pcs']);
        Stock::create(['warehouse_id' => $w->id, 'item_id' => $i1->id, 'quantity' => 50]);
        $c2 = Category::create(['name' => 'Furnitur', 'description' => 'Furniture']);
        $i2 = Item::create(['sku' => 'FR-001', 'name' => 'Kursi Kantor', 'category_id' => $c2->id, 'min_stock' => 2, 'unit' => 'pcs']);
        Stock::create(['warehouse_id' => $w->id, 'item_id' => $i2->id, 'quantity' => 15]);
    }
}
