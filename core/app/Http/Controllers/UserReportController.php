<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function bvBonusLog(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Matching Bonus search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'matching_bonus')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Matching Bonus';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'matching_bonus')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function investLog(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Invest search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Invest Log';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function binaryCom(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Binary Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Binary Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function refCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Referral Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'referral_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Referral Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'referral_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function transactions(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Transaction search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Transaction Log';
            $data['transactions'] = auth()->user()->transactions()->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No transactions.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function depositHistory(Request $request)
    {

        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Deposit search : " . $search;
            $data['logs'] = auth()->user()->deposits()->where('trx', 'like', "%$search%")->with(['gateway'])->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Deposit Log';
            $data['logs'] = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No history found.';


        return view($this->activeTemplate . 'user.deposit_history', $data);
    }


    public function withdrawLog(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Withdraw search : " . $search;
            $data['withdraws'] = auth()->user()->withdrawals()->where('trx', 'like', "%$search%")->with('method')->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = "Withdraw Log";
            $data['withdraws'] = auth()->user()->withdrawals()->with('method')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = "No Data Found!";
        return view($this->activeTemplate . 'user.withdraw.log', $data);
    }

    
    public function starCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Star Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'star_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Star Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'star_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function superCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Super Star Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'super_star_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Super Star Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'super_star_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function rubyCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Ruby Star Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'ruby_star_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Ruby Star Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'ruby_star_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function diamondCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Diamond Star Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'diamond_star_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Diamond Star Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'diamond_star_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function autopoolCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Autopool Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'autopool_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Autopool Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'autopool_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function rewardCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Reward Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'reward_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Reward Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'reward_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }


}
