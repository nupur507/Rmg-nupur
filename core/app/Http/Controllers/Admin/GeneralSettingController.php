<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralSetting;
use App\Models\AutopoolLevel;
use App\Models\RewardLevel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Image;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $general = GeneralSetting::first();
        $page_title = 'General Settings';
        return view('admin.setting.general_setting', compact('page_title', 'general'));
    }

    public function update(Request $request)
    {
        $validation_rule = [
            'base_color' => ['nullable', 'regex:/^[a-f0-9]{6}$/i'],
            'secondary_color' => ['nullable', 'regex:/^[a-f0-9]{6}$/i'],
            'per_question_paid' => ['required', 'numeric', 'gte:0'],
            'bal_trans_fixed_charge' => 'required|numeric|gte:0',
            'bal_trans_per_charge' => 'required|numeric|gte:0'
        ];

        $validator = Validator::make($request->all(), $validation_rule, []);
        $validator->validate();

        $general = GeneralSetting::first();
        $general->sitename                  = $request->sitename;
        $general->cur_text                  = $request->cur_text;
        $general->cur_sym                   = $request->cur_sym;
        $general->bal_trans_fixed_charge    = $request->bal_trans_fixed_charge;
        $general->bal_trans_per_charge      = $request->bal_trans_per_charge;
        $general->per_question_paid         = $request->per_question_paid;
        $general->base_color                = $request->base_color;
        $general->secondary_color           = $request->secondary_color;
        $general->registration              = $request->registration ? 1 : 0;
        $general->secure_password           = $request->secure_password ? 1 : 0;
        $general->force_ssl                 = $request->force_ssl ? 1 : 0;
        $general->agree_policy              = $request->agree_policy ? 1 : 0;
        $general->ev                        = $request->ev ? 1 : 0;
        $general->en                        = $request->en ? 1 : 0;
        $general->sv                        = $request->sv ? 1 : 0;
        $general->sn                        = $request->sn ? 1 : 0;
        $general->save();

        $notify[] = ['success', 'General Setting has been updated.'];
        return back()->withNotify($notify);
    }


    public function logoIcon()
    {
        $page_title = 'Logo & Icon';
        return view('admin.setting.logo_icon', compact('page_title'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpg,jpeg,png',
            'darkLogo' => 'image|mimes:jpg,jpeg,png',
            'favicon' => 'image|mimes:png',
        ]);

        if ($request->hasFile('logo')) {
            try {
                $path = imagePath()['logoIcon']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Logo could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('darkLogo')) {
            try {
                $path = imagePath()['logoIcon']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->darkLogo)->save($path . '/darkLogo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Dark Logo could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = imagePath()['logoIcon']['path'];
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', imagePath()['favicon']['size']);
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Favicon could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $notify[] = ['success', 'Logo Icons has been updated.'];
        return back()->withNotify($notify);
    }

    public function noticeIndex()
    {

        $page_title = 'Notice Settings';
        return view('admin.notice', compact('page_title'));

    }

    public function noticeUpdate(Request $request)
    {

        $general_setting = GeneralSetting::first();
        $general_setting->notice = $request->notice;
        $general_setting->free_user_notice = $request->free_user_notice;
        $general_setting->save();

        $notify[] = ['success', 'Notice has been updated.'];
        return back()->withNotify($notify);

    }

    public function autopool()
    {
        $plans = AutopoolLevel::paginate(getPaginate());;
        $page_title = 'Autopool Settings';
        return view('admin.setting.autopool', compact('page_title', 'plans'));
    }

    public function reward()
    {
        $plans = RewardLevel::paginate(getPaginate());;
        $page_title = 'Reward Settings';
        return view('admin.setting.reward', compact('page_title', 'plans'));
    }

    public function autopoolUpdate(Request $request)
    {

        $autopool = AutopoolLevel::where('id',$request->id)->first();
        if($autopool){
        $autopool->price = $request->price;
        $autopool->save();


        }

        $notify[] = ['success', 'Setting has been updated.'];
        return back()->withNotify($notify);

    }

    public function rewardUpdate(Request $request)
    {

        $reward = RewardLevel::where('id',$request->id)->first();
        if($reward){
        $reward->price = $request->price;
        $reward->bv = $request->bv;
        $reward->save();


        }

        $notify[] = ['success', 'Setting has been updated.'];
        return back()->withNotify($notify);

    }
}
