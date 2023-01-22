<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basic\Order\StoreUAuthRequest;
use App\Http\Requests\Basic\Order\StoreAuthRequest;
use App\Models\City;
use App\Models\Edge;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Region;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addUAuth(StoreUAuthRequest $request)
    {
        $data = $request->validated();
        $date = date('Y-m-d H:i:s');

        $dataOrder = [
            'price'   => $data['price'] * $data['quantity'],
            'city_id' => $data['city_id'],
            'address' => $data['address'],
        ];

        $order = Order::create($dataOrder);

        $dataOrderDetails = [
            'order_id'   => $order->id,
            'product_id' => $data['product_id'],
            'quantity'   => $data['quantity'],
            'price'      => $data['price'],
            'status'     => 'not sent',
            'order_date' => $date,
        ];

        OrderDetail::create($dataOrderDetails);
        $product  = Product::find($data['product_id']);
        $quantity = $product->quantity - $data['quantity'];
        $product->update([
            'quantity' => $quantity,
        ]);

        return \response($product);
    }

    public function addAuth(StoreAuthRequest $request)
    {
        $data            = $request->validated();
        $data['user_id'] = \auth()->user()->id;
        $order           = Order::where('user_id', $data['user_id'])->first();

        if (isset($order) && ! empty($order)) {
            $order->update([
                'price' => $order->price + $data['price'] * $data['quantity'],
            ]);
        } else {
            $dataOrder = [
                'price'   => $data['price'] * $data['quantity'],
                'user_id' => $data['user_id'],
                'city_id' => $data['city_id'],
                'address' => $data['address'],
            ];

            $order = Order::create($dataOrder);
        }

        $dataOrderDetails = [
            'order_id'   => $order->id,
            'product_id' => $data['product_id'],
            'quantity'   => $data['quantity'],
            'price'      => $data['price'],
            'status'     => 'not sent',
        ];

        $orderDetails = OrderDetail::where('order_id', $order->id)
                                   ->where('order_date', null)
                                   ->get();

        if (isset($orderDetails) && ! empty($orderDetails) && \count($orderDetails) > 0) {
            foreach ($orderDetails as $key => $value) {
                if ($value->product->id === $data['product_id'] && $value->price === $data['price']) {
                    $quantity = $value->quantity + $data['quantity'];
                    $orderDetails[$key]->update(['quantity' => $quantity]);

                    return false;
                }
            }
        }
        OrderDetail::create($dataOrderDetails);

        return \response($orderDetails);
    }

    public function setOrderAuth(OrderDetail $orderDetail)
    {
        $date = date('Y-m-d H:i:s');

        $orderDetail->update([
            'order_date' => $date,
        ]);

        $product  = Product::find($orderDetail->product_id);
        $quantity = $product->quantity - $orderDetail->quantity;
        $product->update([
            'quantity' => $quantity,
        ]);
    }

    public function updateAuth(Request $request)
    {
        $data        = $request->all();
        $orderDetail = OrderDetail::find($data['order_id']);
        $order       = Order::find($orderDetail->order_id);
        if ($data['quantity'] > $orderDetail->quantity) {
            $price = $order->price + ($data['quantity'] - $orderDetail->quantity)
                                     * $orderDetail->price;
        } elseif ($data['quantity'] < $orderDetail->quantity) {
            $price = $order->price - ($data['quantity'] - $orderDetail->quantity)
                                     * $orderDetail->price;
        } else {
            return false;
        }

        $order->update([
            'price' => $price,
        ]);

        $orderDetail->update([
            'quantity' => $data['quantity'],
        ]);
    }

    public function edges()
    {
        $edges = Edge::all();

        return \response($edges);
    }

    public function edgeRegions(Edge $edge)
    {
        $regions = Region::where('edge_id', $edge->id)->get();

        return \response($regions);
    }

    public function edgeCities(Edge $edge)
    {
        $cities = City::where('edge_id', $edge->id)->where('region_id', null)->get();

        return \response($cities);
    }

    public function regionCities(Region $region)
    {
        $cities = City::where('region_id', $region->id)->get();

        return \response($cities);
    }

    public function getCount()
    {
        $order = Order::where('user_id', \auth()->user()->id)->first();
        if (isset($order) && ! empty($order)) {
            $count = OrderDetail::where('order_id', $order->id)
                                ->where('order_date', null)
                                ->count();

            return \response($count);
        } else {
            return \response(0);
        }
    }

    public function getProducts()
    {
        $order = Order::where('user_id', \auth()->user()->id)->first();
        if (isset($order) && ! empty($order)) {
            $orderDetail = OrderDetail::where('order_id', $order->id)
                                      ->where('order_date', null)
                                      ->get();
            $products    = [];
            foreach ($orderDetail as $value) {
                $product                   = $value['product'];
                $product['order_quantity'] = $value['quantity'];
                $product['order_id']       = $value['id'];
                $products[]                = $product;
            }

            return \response($orderDetail);
        }
    }

    public function destroy(OrderDetail $orderDetail)
    {
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
