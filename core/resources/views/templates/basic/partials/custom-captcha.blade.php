@if(\App\Models\Extension::where('act', 'custom-captcha')->where('status', 1)->first())
    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                @php echo  getCustomCaptcha($height = 46, $width = '100%', $bgcolor = '#003', $textcolor = '#abc') @endphp
            </div>
            <div class="col-md-12 mt-4">
                <input type="text" name="captcha" maxlength="6" placeholder="@lang('Enter the code above')" required class="form-control
                {{ request()->routeIs('contact') ? 'form--control' : 'form--control-2' }}"
                >
            </div>
        </div>
    </div>
@endif
