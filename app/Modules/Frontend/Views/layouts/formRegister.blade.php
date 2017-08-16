<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 ">
            <form class="reg-box" accept-charset="true" method="POST" action="{!!route('contact.postRegister')!!}" id="formOSC">
                {!!Form::token()!!}
                <input type="hidden" name="content_type" value="osc@du-hoc-he"/>
                <input type="hidden" name="id_program" value="21" />
                <input type="hidden" name="id_center" id="id_center" />
                <input type="hidden" name="inquiry" value="Du Hoc He 2017" />
                <input type="hidden" name="id_hash"  />

                <div class="col-xs-12">
                    <input class="form-control" value="{!!old('name')!!}" name="name" required title="Ho Ten" type="text" placeholder="Họ và Tên">
                </div>
                <div class="col-xs-12 col-sm-6">
                     <input class="form-control" value="{!!old('email')!!}" name="email" required title="Email" type="email" placeholder="Email">
                </div>
                <div class="col-xs-12 col-sm-6">
                     <input class="form-control" value="{!!old('phone')!!}" name="phone" required title="So dien thoai" type="tel" placeholder="Số điện thoại">
                </div>
                @if($location_list)
                <div class="col-xs-12 col-sm-6">
                    {!!Form::select('id_city',[''=>'Chọn Thành Phố']+$location_list,old('id_city'),['class'=>'form-control','id'=>'id_city'])!!}
                </div>
                @endif
                @if($country_list)
                <div class="col-xs-12 col-sm-6">
                    {!!Form::select('country',[''=>'Quốc gia']+$country_list,old('country'),['class'=>'form-control'])!!}
                </div>
                @endif
                <!-- <div class="col-xs-12">
                   <textarea name="message" rows="3" class="form-control" placeholder="Ý kiến của bạn"></textarea>
                </div> -->
                <div class="col-xs-12 text-center mar-top">
                     {!!Form::submit('ĐĂNG KÝ',['class' => 'btn btn-reg btn-lp'])!!}
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {!!Session::get('success')!!}
                    </div>
                @endif

                @include('Admin::errors.listerror')
                <script type="text/javascript" src="{!!asset('public/assets/backend')!!}/js/dms-analytics.js"></script>
                <script type="text/javascript">
                    _swga.base_url_post = 'http://marketingtool.ilavietnam.edu.vn';
                    _swga.init('SW-000019', "formOSC", "manual");
                    _swga.loadForm({
                        fullname: 'name',
                        phone: 'phone',
                        email: 'email',
                        address: '',
                        id_city: 'id_city',
                        id_center: 'id_center',
                        note: 'message',
                        id_hash: 'id_hash',
                        content_type: 'content_type',
                    });
                </script>
            </form>
        </div>
    </div>
</div>

