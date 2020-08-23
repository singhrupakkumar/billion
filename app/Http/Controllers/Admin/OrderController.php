<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use App\Country; 
use App\Helper; 
use Log;
use Session; 

class OrderController extends Controller
{
	public function __construct() {
        $this->middleware('auth:admin', ['except' => ['logout']]);
    }

    public function index(Request $request) {
        $sortby = $request->sort ? $request->sort : 'DESC'; 
        $all = Order::with('orderStatus');

         if ($request->q != "") {
                $all = $all->where('order_number', 'LIKE', '%' . $request->q . '%')
            ->orWhere('phone', 'LIKE', '%' . $request->q . '%')
            ->orWhere('first_name', 'LIKE', '%' . $request->q . '%');
        }
        $all = $all->orderBy('id', $sortby)->paginate(12); 
        return view('admin.order.list', ['all' => $all]);  
    }

    public function show(Request $request,$id) {

        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                'status' => 'required'
            ]);

            Order::where('id', $id)->update(['status' =>$request->status]);  
         return redirect(route('orders.view', $id))->with('success', 'Status updated');

        }

    	$allStatus = OrderStatus::get(); 

        $order = Order::with(['orderStatus','orderItem.category','user','payments'])->where(['id' => $id])->first();

        if(!$order) return back()->with('warning', 'Order not found'); 

        return view('admin.order.view',compact('order','allStatus'));     
    }
}
