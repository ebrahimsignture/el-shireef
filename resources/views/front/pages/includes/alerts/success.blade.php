@if(Session::has('success'))
    <div class="toast" role="alert" id="success" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="{{asset($settings->logo)}}" width="50" class="rounded me-2" alt="Tangle Kids Wear">
            &nbsp;
            <strong class="me-auto ms-auto">{{__('messages.el-shireef-for')}}</strong>
            {{--            <small id="notify_type"></small>--}}
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>

        </div>
        <div class="toast-body alert alert-success" id="notify_msg">
            {{Session::get('success')}}
        </div>
    </div>

{{--    <script>Toasty()</script>--}}
@endif

