<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use App\Models\BvLog;
use App\Models\RewardLevel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronController extends Controller
{
    public function cron()
    {
        $gnl = GeneralSetting::first();
        $gnl->last_cron = Carbon::now()->toDateTimeString();
		$gnl->save();


        if ($gnl->matching_bonus_time == 'daily_twice') {
            $day = Date('H');
            $days = explode(',',$gnl->matching_when);
            if(!in_array(strtolower($day), $days)){
                return '1';

            }
          
        }

        if ($gnl->matching_bonus_time == 'daily') {
            $day = Date('H');

            if (strtolower($day) != $gnl->matching_when) {
                return '1';
            }
        }

        if ($gnl->matching_bonus_time == 'weekly') {
            $day = Date('D');
            if (strtolower($day) != $gnl->matching_when) {
                return '2';
            }
        }

        if ($gnl->matching_bonus_time == 'monthly') {
            $day = Date('d');
            if (strtolower($day) != $gnl->matching_when) {
                return '3';
            }
        }

        $dateDiff = intval((strtotime(Carbon::now()->toDateTimeString())-strtotime(Carbon::parse($gnl->last_paid)->toDateTimeString()))/60);

        $hours = intval($dateDiff/60);

        // if (Carbon::now()->toDateString() != Carbon::parse($gnl->last_paid)->toDateString() && $hours>2) {
        if ($hours>=12) {

            /////// bv done for today '------'
            ///////////////////LETS PAY THE BONUS

            $gnl->last_paid = Carbon::now()->toDateTimeString();
            $gnl->save();

            $eligibleUsers = UserExtra::where('bv_left', '>=', $gnl->total_bv)->where('bv_right', '>=', $gnl->total_bv)->get();

            foreach ($eligibleUsers as $uex) {
                $user = $uex->user;
                $weak = $uex->bv_left < $uex->bv_right ? $uex->bv_left : $uex->bv_right;
                $weaker = $weak < $gnl->max_bv ? $weak : $gnl->max_bv;

                $pair = intval($weaker / $gnl->total_bv);

                $bonus = $pair * $gnl->bv_price;

                // add balance to User

                $payment = User::find($uex->user_id);
                $payment->balance += $bonus;
                $payment->total_binary_com += $bonus;
                $payment->save();

                $trx = new Transaction();
                $trx->user_id = $payment->id;
                $trx->amount = $bonus;
                $trx->charge = 0;
                $trx->trx_type = '+';
                $trx->post_balance = $payment->balance;
                $trx->remark = 'binary_commission';
                $trx->trx = getTrx();
                $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $pair * $gnl->total_bv . ' BV.';
                $trx->save();

                notify($payment, 'matching_bonus', [
                    'amount' => $bonus,
                    'currency' => $gnl->cur_text,
                    'paid_bv' => $pair * $gnl->total_bv,
                    'post_balance' => $payment->balance,
                    'trx' =>  $trx->trx,
                ]);

                $paidbv = $pair * $gnl->total_bv;
                if ($gnl->cary_flash == 0) {
                    $bv['setl'] = $uex->bv_left - $paidbv;
                    $bv['setr'] = $uex->bv_right - $paidbv;
                    $bv['paid'] = $paidbv;
                    $bv['lostl'] = 0;
                    $bv['lostr'] = 0;
                }
                if ($gnl->cary_flash == 1) {
                    $bv['setl'] = $uex->bv_left - $weak;
                    $bv['setr'] = $uex->bv_right - $weak;
                    $bv['paid'] = $paidbv;
                    $bv['lostl'] = $weak - $paidbv;
                    $bv['lostr'] = $weak - $paidbv;
                }
                if ($gnl->cary_flash == 2) {
                    $bv['setl'] = 0;
                    $bv['setr'] = 0;
                    $bv['paid'] = $paidbv;
                    $bv['lostl'] = $uex->bv_left - $paidbv;
                    $bv['lostr'] = $uex->bv_right - $paidbv;
                }
                $uex->bv_left = $bv['setl'];
                $uex->bv_right = $bv['setr'];
                $uex->save();


                if ($bv['paid'] != 0) {
                    createBVLog($payment->id, 1, $bv['paid'], 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                    createBVLog($payment->id, 2, $bv['paid'], 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                }
                if ($bv['lostl'] != 0) {
                    createBVLog($payment->id, 1, $bv['lostl'], 'Flush ' . $bv['lostl'] . ' BV after Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                }
                if ($bv['lostr'] != 0) {
                    createBVLog($payment->id, 2, $bv['lostr'], 'Flush ' . $bv['lostr'] . ' BV after Paid ' . $bonus . ' ' . $gnl->cur_text . ' For ' . $paidbv . ' BV.');
                }
            }

            $Users = User::where('plan_id', '!=', 0)->get();

            foreach ($Users as $usr) {

                $extra = UserExtra::where('user_id',$usr->id)->first();

                $level = $extra->reward_level +1;
                $bonus = RewardLevel::where('level',$level)->first();

                $leftbv = BvLog::where('user_id', $usr->id)->where('trx_type', '+')->where('position', 1)->sum('amount');
                $rightbv = BvLog::where('user_id', $usr->id)->where('trx_type', '+')->where('position', 2)->sum('amount');



                if($bonus && $leftbv >= $bonus->bv && $rightbv >= $bonus->bv){
                    $usr->balance += $bonus->price;
                    $usr->total_reward_com += $bonus->price;
                    $usr->save();

                    $extra->reward_level = $level;
                    $extra->save();

                    
                    $trx = new Transaction();
                    $trx->user_id = $usr->id;
                    $trx->amount = $bonus->price;
                    $trx->charge = 0;
                    $trx->trx_type = '+';
                    $trx->post_balance = $usr->balance;
                    $trx->remark = 'reward_commission';
                    $trx->trx = getTrx();
                    $trx->details = 'Paid ' . $bonus->price . ' ' . $gnl->cur_text . ' For Reward Level' . $level . '';
                    $trx->save();
                }


              

            }
           

            return '---';
        }
    }

    public function starcron()
    {
        $gnl = GeneralSetting::first();
        $gnl->last_star_cron = Carbon::now()->toDateTimeString();
		$gnl->save();

        $day = Date('d');
        $lastday = Carbon::now()
                        ->endOfMonth()
                        ->format('d');
        if (strtolower($day) != $lastday) {
            // return '3';
        }

        $eligibleUsers = User::all();
        foreach ($eligibleUsers as $uex) {
            if($uex->plan_id)
            updateDirectCount($uex->ref_id);

        }
        dd($eligibleUsers);


        if (Carbon::now()->toDateString() != Carbon::parse($gnl->last_star_paid)->toDateString()) {

            /////// bv done for today '------'
            ///////////////////LETS PAY THE BONUS

            $gnl->last_star_paid = Carbon::now()->toDateTimeString();
            $gnl->save();
            dd();

            // $total_company_bv = 
            dd($total_bv);
            $eligibleUsers = UserExtra::where('bv_left', '>=', $gnl->total_bv)->where('bv_right', '>=', $gnl->total_bv)->get();

           
            return '---';
        }
    }
}
