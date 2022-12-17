<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transaction::create([
            'category_payment_id' => '6c6eb51e-0550-45e2-92b6-dbe794df90f0',
            'room_id' => '319d5c67-266b-46a7-a53a-f1c8a8cef369',
            'customer_id' => '9d47023d-c71d-494b-97ba-b9a624fab25d',
            'admin_id' => '0ee6f3d4-2348-49bf-8485-b8840438d1fa',
            'payment_status' => 1,
            'total_price' => 350000,
            'check_in' => '2022-10-20',
            'check_out' => '2022-10-23',

        ]);
    }
}
