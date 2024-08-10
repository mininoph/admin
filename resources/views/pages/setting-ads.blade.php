@extends('layouts.main')
@section('title', 'Ads Setting')
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
                        <h5>{{ __('Ads Setting')}}</h5>
                        <span>{{ __('')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{url('dashboard')}}"><i class="ik ik-home"></i></a>
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

        <div class="row">
            <div class="col-sm-6">
                <div class="card ">
                    <div class="card-header">
                        <h3>{{ __('Ads Setting')}}</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="/setting/update" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="ads" />
                            

                            <div class="form-group row">
                                <div class="col-sm-1"></div>
                                <label for="exampleInput" class="col-lg-2 form-label">{{ __('Admob App ID
                                    :-')}}</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="admob_app_id"
                                        value="{{$ad[0]->admob_app_id}}" placeholder="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-1"></div>
                                <label for="exampleInput" class="col-lg-2 form-label">{{ __('Unity Game ID
                                    :-')}}</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="unity_gameid"
                                        value="{{$ad[0]->unity_gameid}}" placeholder="">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-1"></div>
                                <label for="exampleInput" class="col-lg-2 form-label">{{ __('Ironsource Key
                                    :-')}}</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="ironsource_key"
                                        value="{{$ad[0]->ironsource_key}}" placeholder="">
                                </div>
                            </div>

      
                            
                             <div class="form-group row">
                                <div class="col-sm-1"></div>
                                <label for="exampleInput" class="col-lg-2 form-label">{{ __('StaratApp App ID
                                    :-')}}</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" name="startio_id"
                                        value="{{$ad[0]->startio_id}}" placeholder="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 card">
                                    <div class="card-header bg-dark">
                                        <h3 style="color:white;">Banner Ads</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="exampleInputConfirmPassword2"
                                                class="col-sm-12 col-form-label">{{ __('Select Banner Ad
                                                Type')}}</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select2" name="banner_type">
                                                    <option value="off" {{ ($setting[0]->banner_type == 'off' ) ?
                                                        'selected' : '' }} >OFF</option>
                                                    <option value="admob" {{ ($setting[0]->banner_type == 'admob' ) ?
                                                        'selected' : '' }} >Google Admob</option>
                                                    <option value="fb" {{ ($setting[0]->banner_type == 'fb' ) ?
                                                        'selected' : '' }} >Facebook Audience Network</option>
                                                    <option value="startapp" {{ ($setting[0]->banner_type == 'startapp'
                                                        ) ? 'selected' : '' }} >Startapp</option>
                                                    <option value="unity" {{ ($setting[0]->banner_type == 'unity' ) ?
                                                        'selected' : '' }} >Unity</option>
                                                    <option value="applovin" {{ ($setting[0]->banner_type == 'applovin'
                                                        ) ? 'selected' : '' }} >Applovin</option>
                                                    <option value="ironsource" {{ ($setting[0]->banner_type == 'ironsource'
                                                        ) ? 'selected' : '' }} >IronSource</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInput" class="col-lg-12 form-label">{{ __('Banner Adunit
                                                ( not reiuired for startapp):-')}}</label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control"
                                                    value="{{$setting[0]->bannerid}}" name="bannerid" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 card">
                                    <div class="card-header bg-dark">
                                        <h3 style="color:white;">Interstital Ads</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="exampleInputConfirmPassword2"
                                                class="col-sm-12 col-form-label">{{ __('Select Interstital Ad
                                                Type')}}</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select2" name="interstital_type">
                                                    <option value="off" {{ ($setting[0]->interstital_type == 'off' ) ?
                                                        'selected' : '' }} >OFF</option>
                                                    <option value="admob" {{ ($setting[0]->interstital_type == 'admob' )
                                                        ? 'selected' : '' }} >Google Admob</option>
                                                    <option value="fb" {{ ($setting[0]->interstital_type == 'fb' ) ?
                                                        'selected' : '' }} >Facebook Audience Network</option>
                                                    <option value="unity" {{ ($setting[0]->interstital_type == 'unity' )
                                                        ? 'selected' : '' }} >Unity</option>
                                                    <option value="startapp" {{ ($setting[0]->interstital_type ==
                                                        'startapp' ) ? 'selected' : '' }} >Startapp</option>
                                                    <option value="applovin" {{ ($setting[0]->interstital_type ==
                                                        'applovin' ) ? 'selected' : '' }} >Applovin</option>
                                                    <option value="ironsource" {{ ($setting[0]->interstital_type == 'ironsource'
                                                        ) ? 'selected' : '' }} >IronSource</option>    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInput" class="col-lg-12 form-label">{{ __('Interstitial
                                                Ad Interval :-')}}</label>
                                            <div class="col-lg-12">
                                                <input type="number" class="form-control"
                                                    value="{{$setting[0]->interstital_count}}" name="interstital_count"
                                                    placeholder="0">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInput" class="col-lg-12 form-label">{{ __('Interstitial
                                                Adunit :-')}}</label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control"
                                                    value="{{$setting[0]->interstital_ID}}" name="interstital_ID"
                                                    placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 card">
                                    <div class="card-header bg-dark">
                                        <h3 style="color:white;">Native Ads</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="exampleInputConfirmPassword2"
                                                class="col-sm-12 col-form-label">{{ __('Select Native Ad
                                                Type')}}</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select2" name="nativeType">
                                                    <option value="off" {{ ($setting[0]->nativeType == 'off' ) ?
                                                        'selected' : '' }} >OFF</option>
                                                    <option value="admob" {{ ($setting[0]->nativeType == 'admob' ) ?
                                                        'selected' : '' }} >Google Admob</option>
                                                    <option value="fb" {{ ($setting[0]->nativeType == 'fb' ) ?
                                                        'selected' : '' }} >Facebook Audience Network</option>
                                                    <option value="startapp" {{ ($setting[0]->nativeType == 'startapp' )
                                                        ? 'selected' : '' }} >Startapp</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInput" class="col-lg-12 form-label">{{ __('Native Ads
                                                After How Many Item :-')}}</label>
                                            <div class="col-lg-12">
                                                <input type="number" class="form-control"
                                                    value="{{$setting[0]->nativeCount}}" name="nativeCount"
                                                    placeholder="0">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInput" class="col-lg-12 form-label">{{ __('Native Adunit
                                                ( Not Required for Startapp ):-')}}</label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control"
                                                    value="{{$setting[0]->nativeId}}" name="nativeId" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                    </div>
                </div>
                
            </div>

            <div class="col-sm-6">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3>{{ __('Task Ads Setting')}}</h3>
                        </div>
                        <div class="card-body">
                                
                           <div class="form-group row">
                                
                                <div class="col-sm-4">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-danger"><b>Admob</b> Ad Type</label>
                                    <div class="col-sm-12">
                                     <select name="admob_adtype" class="form-control">
                                         <option value="off" {{($ad[0]->admob_adtype == 'off') ? 'selected':''}} >OFF</option>
                                         <option value="inter"  {{($ad[0]->admob_adtype == 'inter') ? 'selected':''}} >Interstital Ad</option>
                                         <option value="reward" {{($ad[0]->admob_adtype == 'reward') ? 'selected':''}} >Rewarded Ad</option>
                                     </select>    
                                    </div> 
                                </div>  
                                
                                
                                <div class="col-sm-8">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-primary"><b>Admob</b> Ad UNIT (add selected ad Format adunit)</label>
                                    <div class="col-sm-12">
                                        <input   type="text" class="form-control" name="au_admob" value="{{$ad[0]->au_admob}}" placeholder="xxxxxxx" >
                                  </div> 
                                </div>
                            </div> 
                            
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-danger"><b>Audience Network (FB)</b> Ad Type</label>
                                    <div class="col-sm-12">
                                     <select name="fb_adtype" class="form-control">
                                         <option value="off" {{($ad[0]->fb_adtype == 'off') ? 'selected':''}} >OFF</option>
                                         <option value="inter"  {{($ad[0]->fb_adtype == 'inter') ? 'selected':''}} >Interstital Ad</option>
                                         <option value="reward" {{($ad[0]->fb_adtype == 'reward') ? 'selected':''}} >Rewarded Ad</option>
                                     </select>    
                                    </div> 
                                </div>  
                                
                                
                                <div class="col-sm-8">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-primary"><b>Audience Network (FB)</b> Ad UNIT (add selected ad Format adunit)</label>
                                    <div class="col-sm-12">
                                        <input   type="text" class="form-control" name="au_fb" value="{{$ad[0]->au_fb}}" placeholder="xxxxxxx" >
                                  </div> 
                                </div>
                            </div> 
                            
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-danger"><b>Applovin</b> Ad Type</label>
                                    <div class="col-sm-12">
                                     <select name="applovin_adtype" class="form-control">
                                         <option value="off" {{($ad[0]->applovin_adtype == 'off') ? 'selected':''}} >OFF</option>
                                         <option value="inter"  {{($ad[0]->applovin_adtype == 'inter') ? 'selected':''}} >Interstital Ad</option>
                                         <option value="reward" {{($ad[0]->applovin_adtype == 'reward') ? 'selected':''}} >Rewarded Ad</option>
                                     </select>    
                                    </div> 
                                </div>  
                                
                                
                                <div class="col-sm-8">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-primary"><b>Applovin</b> Ad UNIT (add selected ad Format adunit)</label>
                                    <div class="col-sm-12">
                                        <input   type="text" class="form-control" name="au_applovin" value="{{$ad[0]->au_applovin}}" placeholder="xxxxxxx" >
                                  </div> 
                                </div>
                            </div>
                            
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-danger"><b>Unity</b> Ad Type</label>
                                    <div class="col-sm-12">
                                     <select name="unity_adtype" class="form-control">
                                         <option value="off" {{($ad[0]->unity_adtype == 'off') ? 'selected':''}} >OFF</option>
                                         <option value="inter"  {{($ad[0]->unity_adtype == 'inter') ? 'selected':''}} >Interstital Ad</option>
                                         <option value="reward" {{($ad[0]->unity_adtype == 'reward') ? 'selected':''}} >Rewarded Ad</option>
                                     </select>    
                                    </div> 
                                </div>  
                                
                                
                                <div class="col-sm-8">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-primary"><b>Unity</b> Ad UNIT (add selected ad Format adunit)</label>
                                    <div class="col-sm-12">
                                        <input   type="text" class="form-control" name="au_unity" value="{{$ad[0]->au_unity}}" placeholder="xxxxxxx" >
                                  </div> 
                                </div>
                            </div>
                            
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-danger"><b>IronSource</b> Ad Type</label>
                                    <div class="col-sm-12">
                                     <select name="iron_adtype" class="form-control">
                                         <option value="off" {{($ad[0]->iron_adtype == 'off') ? 'selected':''}} >OFF</option>
                                         <option value="inter"  {{($ad[0]->iron_adtype == 'inter') ? 'selected':''}} >Interstital Ad</option>
                                         <option value="reward" {{($ad[0]->iron_adtype == 'reward') ? 'selected':''}} >Rewarded Ad</option>
                                     </select>    
                                    </div> 
                                </div>  
      
                            
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-danger"><b>StartIo</b> Ad Type</label>
                                    <div class="col-sm-12">
                                     <select name="ad_startio" class="form-control">
                                         <option value="off" {{($ad[0]->ad_startio == 'off') ? 'selected':''}} >OFF</option>
                                         <option value="on"  {{($ad[0]->ad_startio == 'on') ? 'selected':''}} >Auto Ad</option>
                                     </select>    
                                    </div> 
                                </div>  
                            </div>
                            
<hr>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label text-danger"><b>Without Ad Credit</b> Sometime ad not load so you want complete that time?</label>
                                    <div class="col-sm-12">
                                     <select name="ad_not_load_credit" class="form-control">
                                         <option value="off" {{($ad[0]->ad_not_load_credit == 'off') ? 'selected':''}} >No</option>
                                         <option value="on"  {{($ad[0]->ad_not_load_credit == 'on') ? 'selected':''}} >Yes</option>
                                     </select>    
                                    </div> 
                                </div>  
                            </div>

<button type="submit" class="btn btn-primary btn-xl mr-2 float-right">{{ __('Update')}}</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
                
        </div>
        <!-- push external js -->
        @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/form-advanced.js') }}"></script>
        <!--get role wise permissiom ajax script-->
        @endpush
        @endsection