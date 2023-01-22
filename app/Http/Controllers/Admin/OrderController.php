<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orderSent=OrderDetail::where('order_date', '!=',null)
            ->where('status', 'sent')->paginate(15);
        $orderNoSent=OrderDetail::where('order_date', '!=',null)
            ->where('status', 'not sent')->paginate(15);

        return \response([
            'orderSent'=>$orderSent,
            'orderNoSent'=>$orderNoSent,
        ]);
    }

    public function sent(OrderDetail $orderDetail){
        $orderDetail->update(['status'=>'sent']);
    }

    public function destroy(OrderDetail $orderDetail){
        $order       = Order::find($orderDetail->order_id);
        $priceDetail = $orderDetail->price * $orderDetail->quantity;
        $orderDetail->delete();
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();
        if (\count($orderDetails) === 0) {
            $order->delete();
        } else {
            $price = $order->price - $priceDetail;
            $order->update([
                'price' => $price,
            ]);
        }
    }
}
