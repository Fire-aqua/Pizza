<?php

namespace App\Http\Controllers;

use App\Models\ {Customer, Good, Order, OrderElement};
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class OrderController extends Controller
{
    public function receiveOrder(Request $request)
    {
        $order = new Order();  
        $customer = new Customer();
        DB::transaction(function() use($request, &$order, &$customer) {            
            $customer->fio = $request->orderCustomer['fio'];
            $customer->phone = $request->orderCustomer['phone'];
            $customer->street = $request->orderCustomer['street'];
            $customer->house = $request->orderCustomer['house'];
            $customer->flat = $request->orderCustomer['flat'];
            $customer->save();
            $order->customer()->associate($customer);
            $order->save();
            foreach($request->orderElements as $orderElement) { 
                $newOrderElement = new OrderElement();
                $newOrderElement->count = $orderElement['count'];
                $newOrderElement->size = $orderElement['size'];
                $newOrderElement->price = $orderElement['price'];
                $newOrderElement->order()->associate($order);
                $good = Good::findOrFail($orderElement['good_id']);
                $newOrderElement->good()->associate($good);
                $toppings = Arr::pluck( $orderElement['toppings'], 'id');
                $newOrderElement->save();
                $newOrderElement->ingredients()->sync($toppings);
            }
        });
        return response()->json([
            'orderNumber' => $order->id,
            'fio' => $customer->fio,
            'phone' => $customer->phone,
            'street' => $customer->street,
            'house' => $customer->house,
            'flat' => $customer->flat
        ]);
    }
    
    private function getOrders()
    {
        return Order::with([
            'orderElements.good',
            'orderElements.ingredients',
            'customer'
            ])
            ->get();
    }

    public function list()
    {        
        return response()->json($this->getOrders());
    }

    public function deleteOrder(Request $request)
    {
        Order::where('id', $request->id)->delete();
        return response()->json();
    }

    public function downloadOrder()
    {        
        $orders= $this->getOrders();
        $pdf = PDF::loadView('orders_pdf', compact('orders'));
        return $pdf->download('orders_pdf.pdf');
    }
}
