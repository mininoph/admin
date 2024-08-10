@extends('layouts.main')
@section('title', 'Daily Task Setting')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/switches.css') }}">

@endpush


<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('App Setting')}}</h5>
                        <span>{{ __('')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}"><i class="ik ik-target"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <!-- <a href="#">{{ __('Add User')}}</a> -->
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- start message area-->
        @include('include.message')
        <!-- end message area-->
        <div class="col-md-12">
            
            <div class="card ">
                <div class="card-header">
                        <h3>{{ __('App Setting')}}</h3>
                    </div>
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-task-tab" data-toggle="pill" href="#task" role="tab"
                            aria-controls="pills-task" aria-selected="true">{{ __('Task Setting')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="pills-noti-tab" data-toggle="pill" href="#noti" role="tab"
                            aria-controls="pills-noti" aria-selected="true">{{ __('Notification Setting')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-security-tab" data-toggle="pill" href="#security" role="tab"
                            aria-controls="pills-security" aria-selected="false">{{ __('Security Setting')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-update-tab" data-toggle="pill" href="#update" role="tab"
                            aria-controls="pills-update" aria-selected="false">{{ __('Update Popup Setting')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-email-tab" data-toggle="pill" href="#email" role="tab"
                            aria-controls="pills-email" aria-selected="false">{{ __('Email Smtp')}}</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="pills-cn-tab" data-toggle="pill" href="#cn" role="tab"
                            aria-controls="pills-cn" aria-selected="false">{{ __('Block Country')}}</a>
                    </li>

                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="task" role="tabpanel" aria-labelledby="pills-task-tab">
                        <div class="card-body">
                            <form class="forms-sample" method="POST" action="/setting/app-setting">
                                @csrf

                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Daily Spin
                                        Limit')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="spin" value="{{env('spn')}}"
                                            placeholder="0" required>
                                    </div>
                                </div>
                              
                              <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Daily Scratch
                                        Limit')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="scratch" value="{{env('scratch')}}"
                                            placeholder="0" required>
                                    </div>
                                </div>
                              
                              <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Scratch
                                        Coin')}}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control " name="scratch_coin" value="{{env('scratch_coin')}}"
                                            placeholder="10,20" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Daily
                                        Checkin Reward')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="daily" value="{{env('daily')}}"
                                            placeholder="0" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Welcome
                                        Bonus')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="bonus" value="{{env('bonus')}}"
                                            placeholder="0" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Referral
                                        Coin')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="refer" value="{{env('ref')}}"
                                            placeholder="0" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Math Quiz
                                        Every Quiz Rewards')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="mathCoin"
                                            value="{{env('mathCoin')}}" placeholder="0" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Daily Math
                                        Quiz Limit')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="mathLimit"
                                            value="{{env('mathLimit')}}" placeholder="0" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Daily VideoZone Task Limit')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="video"
                                            value="{{env('video')}}" placeholder="0" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __(' Offers Task Limit')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="app"
                                            value="{{env('app')}}" placeholder="0" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Daily Read Article Task Limit')}}</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control " name="web"
                                            value="{{env('web')}}" placeholder="0" required>
                                    </div>
                                </div>
                               

                                 <button type="submit" class="btn btn-dark m-10 float-left">{{ __('Update')}}</button>
                            <br>
                            </form>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="noti" role="tabpanel" aria-labelledby="pills-noti-tab">
                        <div class="card-body">
                            <br>
                           <form class="forms-sample" method="POST" action="/setting/update"
                                enctype="multipart/form-data">
                                @csrf
                                
                            <input type="hidden" name="type" value="noti"/>
          

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">OneSignal App ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control " name="onesignal_appid" value="{{$admin[0]->onesignal_appid}}"
                                         placeholder="xxxxx-xxxxx" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-2 col-form-label">OneSignal Rest Api Key</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control " name="onesignal_restapi" value="{{$admin[0]->onesignal_restapi}}"
                                       placeholder="xxxxx-xxxxx"  required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark m-10 float-left">{{ __('Update')}}</button>
                            <br>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="pills-security-tab">
                        <div class="card-body">
                            <br>
                           <form class="forms-sample" method="POST" action="/setting/update"
                                enctype="multipart/form-data">
                                @csrf
                                
                            <input type="hidden" name="type" value="secure"/>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">VPN PROTECTION [ App will not Work if Vpn Connected]</label>
                                <div class="col-sm-6">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                         <input type="checkbox" name="isVpn" {{ ($data[0]->isVpn == 'true'
                                            ) ? 'checked' : '' }}>
                                        <span class="slider round">
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">{{ __('One Device One
                                    Account ( user can create only one account in one device)')}}</label>
                                <div class="col-sm-6">
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                         <input type="checkbox" name="one_device" {{ ($data[0]->one_device == 'true'
                                            ) ? 'checked' : '' }}>
                                        <span class="slider round">
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-6 col-form-label">{{ __('One Ip Account
                                    Limit ( how many account user can create with on ip adress)')}}</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control " name="one_ip" value="{{$data[0]->one_ip}}"
                                        placeholder="3" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark m-10 float-left">{{ __('Update')}}</button>
                            <br>
                            </form>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="pills-update-tab">
                        <div class="card-body">
                            <br>
                            <form class="forms-sample" method="POST" action="/setting/update"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="type" value="update" />
                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('App Update &
                                        Maintenance Popup Show/Hide:- ')}}</label>
                                    <div class="col-lg-8">
                                        <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="up_status" {{ ($setting[0]->up_status == 'true'
                                            ) ? 'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('Select Mode')}}</label>
                                    <div class="col-lg-8">
                                        <select name="up_mode" class="form-control">
                                            <option value="update" {{ ($setting[0]->up_mode == 'update' ) ? 'selected' :
                                                '' }} >Update Popup ( Update Popup show Force use to Update App )
                                            </option>
                                            <option value="maintenance" {{ ($setting[0]->up_mode == 'maintenance' ) ?
                                                'selected' : '' }} >Maintenance Popup ( App will Not Work Show
                                                Maintenance Popup ) </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('Android Version
                                        Code')}}</label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" name="up_version"
                                            value="{{$setting[0]->up_version}}" placeholder="1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('Message')}}</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" col="5" rows="5" name="up_msg">
                                               {{$setting[0]->up_msg}}
                                            </textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('App URL')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="up_link"
                                            value="{{$setting[0]->up_link}}"
                                            placeholder="https://play.google.com/store/apps/details?id=com.app.reward">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">Cancel Option :- <br>
                                        Cancel button option will show in app update popup</label>
                                    <div class="col-lg-8">
                                        <label class="switch s-icons s-outline s-outline-success mr-2">
                                            <input type="checkbox" name="up_btn" {{ ($setting[0]->up_btn == 'true' ) ?
                                            'checked' : '' }}>
                                            <span class="slider round"></label>
                                    </div>
                                </div>
                                  <button type="submit" class="btn btn-dark btn-xl mr-2 float-left">{{
                                    __('Save')}}</button>
                                    <br>

                        </div>
                        </form>
                    </div>
                    
                    <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="pills-email-tab">
                        <div class="card-body">
                            <br>
                            <form class="forms-sample" method="POST" action="/setting/update"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="type" value="smtp" />
                       
                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('MAIL MAILER')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="MAIL_MAILER"
                                        value="{{env('MAIL_MAILER')}}" placeholder="smtp">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('MAIL HOST')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="MAIL_HOST"
                                        value="{{env('MAIL_HOST')}}" placeholder="smtp">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('PORT')}}</label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" name="MAIL_PORT"
                                            value="{{env('MAIL_PORT')}}" placeholder="1">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('MAIL USERNAME')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="MAIL_USERNAME"
                                        value="{{env('MAIL_USERNAME')}}" placeholder="smtp">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('MAIL PASSWORD')}}</label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control" name="MAIL_PASSWORD"
                                        value="{{env('MAIL_PASSWORD')}}" placeholder="**">
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('Encryption Mode')}}</label>
                                    <div class="col-lg-8">
                                        <select name="MAIL_ENCRYPTION" class="form-control">
                                            <option value="ssl" {{ (env('MAIL_ENCRYPTION') == 'ssl' ) ? 'selected' :
                                                '' }} >SSL</option>
                                            <option value="tls" {{ (env('MAIL_ENCRYPTION') == 'tls' ) ?
                                                'selected' : '' }} >TLS</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark btn-xl mr-2 float-left">{{
                                    __('Save')}}</button>
                                    <br>

                        </div>
                        </form>
                    </div>
               
                
                    <div class="tab-pane fade" id="cn" role="tabpanel" aria-labelledby="pills-cn-tab">
                        <div class="card-body">
                            <br>
                            <form class="forms-sample" method="POST" action="/setting/update"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="type" value="cn" />
                       
                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('Block Country Access with ISO Code')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="cn"
                                        value="{{env('cn')}}" placeholder="US,IN">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exampleInput" class="col-lg-3 form-label">{{ __('Block Country Access Message')}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="msg"
                                        value="{{str_replace('_', ' ',env('msg'))}}" placeholder="Sorry Our App Not Available in your Country">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark btn-xl mr-2 float-left">{{
                                    __('Save')}}</button>
                                    <br>

                        </div>
                        </form>
                    </div>
                </div>

 </div>

            </div>
        </div>




    </div>
    <!-- push external js -->
    @push('script')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/form-advanced.js') }}"></script>
    <!--get role wise permissiom ajax script-->
    @endpush
    @endsection