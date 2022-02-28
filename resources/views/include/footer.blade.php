<footer class="footer">
    <div class="w-100 clearfix">
        <div class="row">
            <div class="col-sm-6">
                    <div class="text-center text-sm-left d-flex align-items-center justify-content-center">
                    {{ __('Copyright ©  ') }}{{date('Y')}} {{ env('APP_NAME')}}
                </div>
            </div>
            <div class="col-sm-6">
                <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">
                    <span class="logo2">
                Powered By:              <img src="{{ asset('assets/footer-logo.png') }}" alt="" >
                </span>
                </span>
            </div>
        </div>
    </div>
</footer>