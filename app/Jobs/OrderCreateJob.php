<?php

namespace App\Jobs;

use App\Enums\OrderStatusEnum;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   private $user_id;
    public function __construct($user_id)
    {

        $this->user_id=$user_id;


    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $cart = Cart::with('products')->where('user_id', $this->user_id)->get();


        $order = Order::create([
            'user_id' => $this->user_id,
            'order_code' => str_pad('NO', '3', $this->user_id) . rand(1000, 2000),
            'status' => OrderStatusEnum::Wait->value,
            'total' => $cart->sum('price'),
            'discount' => 0,
        ]);


        foreach ($cart as $item) {
            $price_now = $item->products->price;
            $items = Item::create([
                'order_id' => $order->id,
                'product_id' => $item->products->id,
                'product_name' => $item->products->code,
                'quantity' => $item->quantity,
                'total' => $item->price,
                'price' => $price_now,


            ]);
        };

//            return view('pages.email',compact('order','cart'));

        $data['order'] = $order;
        $data['cart'] = $cart;

        $pdf2 = new TCPDF;

//            $pdf = PDF::loadView('pages.pdf', $data)
//                ->setOptions(['defaultFont' => 'sans-serif'])
//                ->setPaper('a4');
//            return $pdf->stream();
//        Mail::send('pages.email', ['cart' => $cart, 'order' => $order], function ($message) use ($cart, $order) {
//            $message->from(auth()->user()->email)
//                ->to('ehsan.gamor90@gmail.com')
//                ->subject('test');
//        });

        Cart::where('user_id', $this->user_id)->delete();



    }
}
