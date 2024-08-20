<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\FranchiseOrder;
use App\Models\FranchiseOrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Deposit;
use Illuminate\Support\Facades\Validator;


class FranchiseController extends Controller
{


    public function dashboard()
    {
        $page_title = 'Dashboard';

        $latestFranchise = Franchise::latest()->limit(6)->get();
        $user = Auth::guard('franchise')->user();

        return view('franchise.dashboard', compact('page_title','latestFranchise','user'));
    }

    public function request()
    {
        $page_title = 'Request Stock';

        $products = Product::latest()->get();

        return view('franchise.request_stock.index', compact('page_title', 'products'));
    }

    public function placeOrder(Request $request) {
        try{
            $product_details = $request->product_details;
            $order_details = $request->order_details;

            // create franchise order
            $franchise_order = new FranchiseOrder();
            $franchise_order->franchise_id = auth('franchise')->user()->franchise_id;
            $franchise_order->total_dp = (float) $order_details['total_dp'];
            $franchise_order->total_bv = (float) $order_details['total_bv'];
            $franchise_order->net_payable = (float) $order_details['total_dp'];
            $franchise_order->status = 'pending';
            $franchise_order->created_at = \Carbon\Carbon::now();
            $franchise_order->updated_at = \Carbon\Carbon::now();

            $franchise_order->save();


            // update wallet balance
            $new_balance = auth('franchise')->user()->balance - (float) $order_details['total_dp'];
            Franchise::where('franchise_id', auth('franchise')->user()->franchise_id)->update(['balance'=>$new_balance]);

            // save products
            foreach ($product_details as $data) {
                $product_id = (int) $data['product_id'];
                $product = Product::findOrFail($product_id);

                $franchise_product = new FranchiseOrderProduct();

                $franchise_product->franchise_order_id = $franchise_order->id;
                $franchise_product->product_id = $product_id;
                $franchise_product->product_name = $product->name;
                $franchise_product->quantity = $data['quantity'];
                $franchise_product->mrp = $product->mrp;
                $franchise_product->dp = $product->dp;
                $franchise_product->bv = $product->bv;
                $franchise_product->pv = $product->pv;
                $franchise_product->gst = $product->gst;
                $franchise_product->total_dp = $data['dp'];
                $franchise_product->total_bv = $data['bv'];
                $franchise_product->status = '1';
                $franchise_product->created_at = \Carbon\Carbon::now();
                $franchise_product->updated_at = \Carbon\Carbon::now();

                $franchise_product->save();
            }

            $response = ['success' => true, 'msg' => 'Order placed successfully.'];

        }  catch (\Exception $e) {
            $response = ['success' => false, 'msg' => 'Failled to place order', 'data' => $e->getMessage()];
        }

        return response()->json($response);
    }

    public function addProduct(Request $request) {

        $response = [];
        try {
            $qty = $request->quantity;

            $product = Product::findorFail($request->product_id);

            $total_dp = (float) $product->dp * $qty;
            $total_bv = (float) $product->bv * $qty;

            $data = '<tr id="product-row-'. $product->id .'" data-id="'.$product->id.'" data-qty="'.$qty.'" data-dp="'.$total_dp.'" data-bv="'.$total_bv.'">
                <td data-label="S.No." class="sr-no"></td>
                <td data-label="Product ID" class="product-row-id">'. $product->id .'</td>
                <td data-label="Product Name">'. $product->name .'</td>
                <td data-label="DP">'. number_format($product->dp, 2 ,'.','') .'</td>
                <td data-label="BV">'. number_format($product->bv, 2 ,'.','') .'</td>
                <td data-label="GST">'. number_format($product->gst, 2 ,'.','') .'</td>
                <td data-label="Quanty" class="product-row-qty">'. $qty .'</td>
                <td data-label="Total DP" class="product-dp"> '. number_format($total_dp, 2 ,'.','') .'</td>
                <td data-label="Total BV" class="product-bv">'. number_format($total_bv, 2 ,'.','') .'</td>
                <td data-label="Action">
                    <a href="javascript:void(0)" class="icon-btn btn--danger deleteProduct ml-1" data-toggle="tooltip" data-original-title="Delete" data-id="product-row-'. $product->id .'" ">
                    <i class="la la-trash"></i></a>
                </td>
            </tr>';

            $response = ['success' => true, 'msg' => 'Product added successfully', 'data' => $data];
        } catch (\Exception $e) {
            $response = ['success' => false, 'msg' => 'Failled to add product'];
        }

        return response()->json($response);

    }


    // Order History Index
    public function orderHistory()
    {
        $page_title = 'Franchise Order History';
        $empty_message = 'No order found';
        $orders = FranchiseOrder::where('franchise_id',auth('franchise')->user()->franchise_id)->paginate(getPaginate());

        $orderBy = auth('franchise')->user()->franchise_id.'('.auth('franchise')->user()->franchise_name.')';

        return view('franchise.request_stock.orderHistory', compact('page_title', 'empty_message', 'orders', 'orderBy'));
    }

    public function orderSearch(Request $request)
    {
        $search = $request->search;
        $orders = FranchiseOrder::where(function ($user) use ($search) {
            $user->where('id', 'like', "%$search%")
                ->orWhere('total_dp', 'like', "%$search%")
                ->orWhere('total_bv', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ->orWhere('action_date', 'like', "%$search%")
                ->orWhere('franchise_id', 'like', "%$search%");
        });
        $page_title = '';
        $orders = $orders->paginate(getPaginate());
        if($search !== null){
            $page_title .= 'Order Search - ' . $search;
        } else {
            $page_title .= 'Franchise Order History';
        }

        $orderBy = auth('franchise')->user()->franchise_id.'('.auth('franchise')->user()->franchise_name.')';

        $empty_message = 'No search result found';
        return view('franchise.request_stock.orderHistory', compact('page_title', 'search', 'empty_message', 'orders','orderBy'));
    }

    public function orderHistoryProducts(Request $request)
    {
        $response = [];
        try {
            $order_id = $request->order_id;
            $order_products = FranchiseOrderProduct::where('franchise_order_id',$order_id)->latest()->get();

            $data = '';
            foreach ($order_products as $product) {

                $total_mrp = (float) $product->mrp * $product->quantity;
                $total_dp = (float) $product->dp * $product->quantity;
                $total_bv = (float) $product->bv * $product->quantity;
                $data .= '<tr>
                            <td data-label="S.No." class="sr-no"></td>
                            <td data-label="Product" class="product-row-id">'. $product->product_name .'</td>
                            <td data-label="Quantity">'. $product->quantity .'</td>
                            <td data-label="MRP">'. $product->mrp .'</td>
                            <td data-label="DP">'. $product->dp .'</td>
                            <td data-label="BV">'. $product->dv .'</td>
                            <td data-label="Total MRP">'. number_format($total_mrp, 2 ,'.','') .'</td>
                            <td data-label="Total DP"> '. number_format($total_dp, 2 ,'.','') .'</td>
                            <td data-label="Total BV">'. number_format($total_bv, 2 ,'.','') .'</td>
                        </tr>';

            }


            $response = ['success' => true, 'msg' => 'Products fetched successfully', 'data' => $data];
        }
        catch (\Exception $e) {
            $response = ['success' => false, 'msg' => 'Failled to fetch products'];
        }

        return response()->json($response);

    }
    public function depositHistory()
    {
        $page_title = 'Deposit History';
        $empty_message = 'No history found.';
        $logs = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'franchise.deposit_history', compact('page_title', 'empty_message', 'logs'));
    }

}
