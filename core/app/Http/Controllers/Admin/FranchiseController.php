<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use App\Models\FranchiseOrder;
use App\Models\FranchiseOrderProduct;
use App\Rules\FileTypeValidate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FranchiseController extends Controller
{
    public function registrationForm()
    {
        $page_title = 'Franchise Registration';
        return view('admin.franchise.registrationForm', compact('page_title'));
    }

    public function create(Request $request)
    {
        $validation_rule = [
            'franchise_type' => 'required',
            'sponsor_distributor_id' => 'required',
            'gst_registration_status' => 'required',
            'sponsor_distributor_name' => 'required',
            'direct_seller_id' => 'required',
            'direct_seller' => 'required',
            'franchise_name' => 'required|string',
            'phone'        => 'required|max:15|regex:/[0-9]/',
            'address'      => 'required',
            'state'      => 'required',
            'city'      => 'required',
            'pin_code'      => 'required|numeric',
            'password_confirmation' => 'required|min:5',
            'password' => 'required|min:5|same:password_confirmation'

        ];
        $validator = Validator::make($request->all(), $validation_rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $franchise = new Franchise();

        //Franchise Id
        $count = Franchise::count();
        $franchiseId= 'F'.date('y').''.date('d').''.date('m').($count+1);
        $franchise->franchise_id = $franchiseId;

        $franchise->franchise_type = $request->franchise_type;
        $franchise->gst_registration_status = $request->gst_registration_status;

        if($request->gst_registration_status == 'registered'){
            $franchise->gst_number = $request->gst_number;
        }

        $franchise->sponsor_distributor_id = $request->sponsor_distributor_id;
        $franchise->sponsor_distributor_name = $request->sponsor_distributor_name;
        $franchise->direct_seller_id = $request->direct_seller_id;
        $franchise->direct_seller = $request->direct_seller;
        $franchise->franchise_name = $request->franchise_name;
        $franchise->phone = $request->phone;
        $franchise->email = $request->email;
        $franchise->pan = $request->pan;

        // Password
        $password = Hash::make($request->password);
        $franchise->password = $password;

        $franchise->bank_name = $request->bank_name;
        $franchise->branch_name = $request->branch_name;
        $franchise->account_number = $request->account_number;
        $franchise->ifsc_code = $request->ifsc_code;
        $franchise->address = $request->address;
        $franchise->state = $request->state;
        $franchise->city = $request->city;
        $franchise->pin_code = $request->pin_code;
        $franchise->created_by = auth('admin')->user()->username;
        $franchise->created_at = \Carbon\Carbon::now();
        $franchise->updated_at = \Carbon\Carbon::now();


        $franchise->save();

        $notify[] = ['success', 'Franchise Added successfully.'];
        return redirect()->back()->withNotify($notify);
    }

    public function franchiseList()
    {
        $page_title = 'Franchise List';
        $empty_message = 'No user found';
        $franchises = Franchise::latest()->paginate(getPaginate());
        return view('admin.franchise.list', compact('page_title', 'empty_message', 'franchises'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $franchises = Franchise::where(function ($user) use ($search) {
            $user->where('franchise_id', 'like', "%$search%")
                ->orWhere('franchise_type', 'like', "%$search%")
                ->orWhere('franchise_name', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%")
                ->orWhere('created_by', 'like', "%$search%");
        });
        $page_title = '';
        $franchises = $franchises->paginate(getPaginate());
        if($search !== null){
            $page_title .= 'Franchise Search - ' . $search;
        } else {
            $page_title .= 'Franchise List';
        }

        $empty_message = 'No search result found';
        return view('admin.franchise.list', compact('page_title', 'search', 'empty_message', 'franchises'));
    }

    public function edit($id)
    {
        $page_title = 'Edit Franchise';
        $franchise = Franchise::findOrFail($id);
        return view('admin.franchise.edit', compact('page_title', 'franchise'));
    }

    public function update(Request $request, $id)
    {
        $validation_rule = [
            'sponsor_distributor_id' => 'required',
            'sponsor_distributor_name' => 'required',
            'gst_registration_status' => 'required',
            'direct_seller_id' => 'required',
            'direct_seller' => 'required',
            'franchise_name' => 'required|string',
            'phone'        => 'required|max:15|regex:/[0-9]/',
            'address'      => 'required',
            'state'      => 'required',
            'city'      => 'required',
            'pin_code'      => 'required|numeric'
        ];
        $validator = Validator::make($request->all(), $validation_rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $franchise = Franchise::findOrFail($id);

        $franchise->gst_registration_status = $request->gst_registration_status;
        $franchise->gst_number = $request->gst_number;
        $franchise->sponsor_distributor_id = $request->sponsor_distributor_id;
        $franchise->sponsor_distributor_name = $request->sponsor_distributor_name;
        $franchise->direct_seller_id = $request->direct_seller_id;
        $franchise->direct_seller = $request->direct_seller;
        $franchise->franchise_name = $request->franchise_name;
        $franchise->phone = $request->phone;
        $franchise->email = $request->email;
        $franchise->pan = $request->pan;

        // Password
        if($request->password !== null){
            $validator = Validator::make($request->all(),
            ['password_confirmation' => 'required|min:5',
            'password' => 'required|min:5|same:password_confirmation']
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $password = Hash::make($request->password);
            $franchise->password = $password;
        }


        $franchise->bank_name = $request->bank_name;
        $franchise->branch_name = $request->branch_name;
        $franchise->account_number = $request->account_number;
        $franchise->ifsc_code = $request->ifsc_code;
        $franchise->address = $request->address;
        $franchise->state = $request->state;
        $franchise->city = $request->city;
        $franchise->pin_code = $request->pin_code;
        $franchise->created_by = auth('admin')->user()->username;
        $franchise->updated_at = \Carbon\Carbon::now();

        $franchise->save();

        $notify[] = ['success', 'Franchise Updated successfully.'];
        return redirect()->back()->withNotify($notify);
    }

    public function delete (Request $request) {
        $franchise = Franchise::findOrFail($request->id);
        $franchise->delete();
        $notify[] = ['success', 'Franchise Deleted successfully.'];
        return redirect()->back()->withNotify($notify);
    }

     public function franchiseOrderRequest()
     {
         $page_title = 'Franchise Order Request';
         $empty_message = 'No order found';
         $orders = FranchiseOrder::latest()->paginate(getPaginate());

         return view('admin.stock.franchiseOrderRequest', compact('page_title', 'empty_message', 'orders'));
     }

     public function searchOrderRequest(Request $request)
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
            $page_title .= 'Franchise Order Request';
        }


        $empty_message = 'No search result found';
        return view('admin.stock.franchiseOrderRequest', compact('page_title', 'search', 'empty_message', 'orders'));
    }

    public function franchiseOrderProducts(Request $request)
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
                $data .= '<tr data-id="'.$product->id.'">
                            <td data-label="S.No." class="sr-no"></td>
                            <td data-label="Product" class="product-row-id">'. $product->product_name .'</td>
                            <td data-label="Quantity">'. $product->quantity .'</td>
                            <td data-label="DP">'. $product->dp .'</td>
                            <td data-label="Total DP" class="total-dp"> '. number_format($total_dp, 2 ,'.','') .'</td>
                            <td data-label="Discount"><input type="number" class="update-product-discount form-control" value="'. $product->discount_percent .'"/></td>
                        </tr>';

            }


            $response = ['success' => true, 'msg' => 'Products fetched successfully', 'data' => $data];
        }
        catch (\Exception $e) {
            $response = ['success' => false, 'msg' => 'Failled to fetch products'];
        }

        return response()->json($response);

    }

    public function franchiseOrderApprove(Request $request)
    {
        try {
            $order_id = $request->order_id;

            FranchiseOrder::findorFail($order_id)->update(['status' => 'approved', 'action_date' => \Carbon\Carbon::now()]);

            $notify = ['success', 'Order approved successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            $notify = ['error' , 'Failled to approve order'];
            return redirect()->back()->withNotify($notify);

        }
    }

    public function franchiseOrderDiscountApprove(Request $request)
    {
        try {
            $discountData = $request->discountData;
            $franchiseId = $request->franchise_id;
            $order_id = (int) $request->order_id;
            $netPayable = 0;

            // update discount in franchise_order_products table
            foreach ($discountData as $data) {
                $orderProductId = $data['product_id'];
                $discount_percent = $data['discount_percent'];
                $total_dp = $data['total_dp'];
                $netPayable += $total_dp - ($total_dp * ($discount_percent/100));
                FranchiseOrderProduct::findorFail($orderProductId)->update(['discount_percent' => $discount_percent, 'updated_at' => \Carbon\Carbon::now()]);
            }

            // update discount in franchise_orders table
            $order = FranchiseOrder::findorFail($order_id);
            $discountAmount = $order->total_dp - $netPayable;
            FranchiseOrder::findorFail($order_id)->update(
                [
                    'net_payable' => $netPayable,
                    'discount' => $discountAmount,
                    'status' => 'approved',
                    'action_date' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]
            );

            // Update user Wallet balance after discount
            $franchiseBalance = Franchise::where('franchise_id',$franchiseId)->pluck('balance')[0];
            Franchise::where('franchise_id',$franchiseId)->update(['balance' => $franchiseBalance + $discountAmount]);


            $response = ['success' => true, 'msg' => 'Order approved successfully'];
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ['success' => false, 'msg' => 'Failled to approve order'];
            return response()->json($response);
        }
    }

    public function franchiseOrderReject(Request $request)
    {
        try {

            $order_id = $request->order_id;
            $franchise_id = $request->franchise_id;

            // update franchise_orders table
            $order = FranchiseOrder::findorFail($order_id);
            $total_dp = $order->total_dp;
            FranchiseOrder::findorFail($order_id)->update(['status' => 'rejected', 'action_date' => \Carbon\Carbon::now()]);

             // Update user Wallet balance after reject order
             $franchiseBalance = Franchise::where('franchise_id',$franchise_id)->pluck('balance')[0];
             Franchise::where('franchise_id',$franchise_id)->update(['balance' => $franchiseBalance + $total_dp]);

            $notify = ['success', 'Order rejected successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            $notify = ['error' , 'Failled to reject order'];
            return redirect()->back()->withNotify($notify);

        }
    }


}
