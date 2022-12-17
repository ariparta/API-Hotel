<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
 
class CreateSnapTokenService extends Midtrans
{
    protected $transaction;
 
    public function __construct($transaction)
    {
        parent::__construct();
 
        $this->transaction = $transaction;
    }
 
    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->transaction->id,
                'gross_amount' => $this->transaction->total_price,
            ],
            // 'item_details' => [
            //     [
            //         'id' => 1,
            //         'price' => '50000',
            //         'quantity' => '1',
            //         'name' => 'Kamar PT1',
            //     ]
            // ],
            'customer_details' => [
                'first_name' => 'Martin Mulyo Syahidin',
                'email' => 'mulyosyahidin95@gmail.com',
                'phone' => '081234567890',
            ]
        ];
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}