@extends('layouts.main') @section('title', 'Add Offerwall') @section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" />
@endpush

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-user-plus bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Add Offerwall')}}</h5>
                        <span>{{ __('Create new Offerwall')}}</span>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Offerwall Details')}}</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="/offerwall/update" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="id" value="{{$offer->id}}">
                        <input type="hidden" name="oldimage" value="{{$offer->thumb}}">

                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Offerwall
                                Type')}}</label>
                            <div class="col-sm-9">
                                <select class="form-control @error('offer_type') is-invalid @enderror"
                                    name="offer_type">
                                    <option value="offers" {{($offer->offer_type == 'offers') ? 'selected' : ''}}>Offerwall</option>
                                    <option value="survey" {{($offer->offer_type == 'survey') ? 'selected' : ''}}>Survey</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                @error('offer_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ __('Offerwall
                                Name')}}</label>
                            <div class="col-sm-9">
                                <input id="name" type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title"  value="{{ $offer->title}}" placeholder="Cpalead,bitlab or anything" required />
                                <div class="help-block with-errors"></div>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">{{ __('Offerwall
                                Icon')}}</label>
                            <div class="col-sm-9">
                                <input id="icon" type="file" class="form-control @error('icon') is-invalid @enderror"
                                    name="icon" placeholder="Select  ICON" />
                                <div class="help-block with-errors"></div>
                                @error('icon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row" >
                            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label"></label>
                            <div id="imgdiv"></div>
                        </div>
                        
                        <div class="form-group row">
                             <div class="col-sm-3"></div>
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Offerwall <b>Layout Color</b></label>
                                    <div class="col-sm-12">
                                        <input  type="color" class="form-control" style="height:50px;" name="card_color" value="{{$offer->card_color}}"   required>
                                        @error('card_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>
                                
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Offerwall<b>Text Color</b></label>
                                    <div class="col-sm-12">
                                          <input   type="color" class="form-control" style="height:50px;" value="{{$offer->text_color}}"  name="text_color" required>
                                          @error('text_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>  
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Offerwall
                                Description')}}</label>
                            <div class="col-sm-9">
                                <input id="coin" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{$offer->description}}" placeholder="best offers" required />
                                <div class="help-block with-errors"></div>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Offerwall Original
                                Name Must Required')}}</label>
                            <div class="col-sm-9">
                                <input id="currency" type="text"
                                    class="form-control @error('offerwall_slug') is-invalid @enderror"
                                    name="offerwall_slug" value="{{$offer->offerwall_slug}}" placeholder="Cpalead,bitlab" required />
                                <div class="help-block with-errors"></div>
                                @error('offerwall_slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Offerwall Complete Title')}}</label>
                            <div class="col-sm-9">
                                <input id="currency" type="text"
                                    class="form-control @error('offer_complete_title') is-invalid @enderror"
                                    name="offer_complete_title" value="{{$offer->offer_complete_title}}" placeholder="Cpalead offer completed" required />
                                <div class="help-block with-errors"></div>
                                @error('offer_complete_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Offerwall Level - Easy,Medium,Hard')}}</label>
                            <div class="col-sm-9">
                                <input id="currency" type="text"
                                    class="form-control @error('level') is-invalid @enderror"
                                    name="level" value="{{$offer->level}}" placeholder="Easy,Medium,Hard" required />
                                <div class="help-block with-errors"></div>
                                @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        @if($offer->type=='web')
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Web Offerwall
                                    URL')}}</label>
                                <div class="col-sm-9">
                                    <input id="detail" type="text"
                                        class="form-control @error('offerwall_url') is-invalid @enderror"
                                        name="offerwall_url" value="{{$offer->offerwall_url}}" placeholder="http://" required />
                                    <div class="help-block with-errors"></div>
                                    @error('offerwall_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('User ID
                                    TAG')}}</label>
                                <div class="col-sm-9">
                                    <input id="detail" type="text" class="form-control @error('u_tag') is-invalid @enderror"
                                        name="u_tag" placeholder="sub={sub}" value="{{$offer->u_tag}}" required />
                                    <div class="help-block with-errors"></div>
                                    @error('u_tag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('User ID Tag
                                    Type')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('uid_type') is-invalid @enderror" name="uid_type">
                                        <option value="full" {{($offer->uid_type == 'full') ? 'selected' : ''}}>sub={subid}</option>
                                        <option value="short" {{($offer->uid_type == 'short') ? 'selected' : ''}}>/{subid}</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('uid_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Advertising ID
                                    TAG')}}</label>
                                <div class="col-sm-9">
                                    <input id="detail" type="text"
                                        class="form-control @error('advid_tag') is-invalid @enderror" name="advid_tag"
                                        placeholder="advert={advert}"  value="{{$offer->advid_tag}}" />
                                    <div class="help-block with-errors"></div>
                                    @error('advid_tag')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Open Offerwall In
                                    ')}}</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('browser_type') is-invalid @enderror"
                                        name="browser_type">
                                        <option value="0" {{($offer->browser_type == '0') ? 'selected' : ''}}>In App Browser</option>
                                        <option value="1" {{($offer->browser_type == '1') ? 'selected' : ''}}>Chrome Custom Tab</option>
                                        <option value="2" {{($offer->browser_type == '2') ? 'selected' : ''}}>External Browser</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                    @error('browser_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ __('Offerwall Order
                                    By')}}</label>
                                <div class="col-sm-9">
                                    <input id="detail" type="number"
                                        class="form-control @error('item_order') is-invalid @enderror" name="item_order"
                                        placeholder="1" value="{{$offer->item_order}}" required />
                                    <div class="help-block with-errors"></div>
                                    @error('item_order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @elseif($offer->type=='sdk')
                            @foreach((array)$offer_data as $item)
                                <div class="form-group row">
                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">{{ $item['name']}}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="keyval[]" placeholder="{{ $item['name']}}" value="{{ $item['value']}}"  required />
                                    </div>
                                </div>
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Postback Configuration')}}</h3>
                </div>
                <div class="card-body">
                    
                    
                             
                         <div class="form-group row">
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Paramater for <b>User ID</b></label>
                                    <div class="col-sm-12">
                                        <input  type="text" class="form-control" name="p_userid" value="{{$offer->p_userid}}" placeholder="{user_id}" required>
                                        @error('p_userid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>
                                
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Offer ID</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control"  value="{{$offer->p_campaing_id}}"  name="p_campaing_id" placeholder="{campaing_id}" required>
                                          @error('p_campaing_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>  
                                
                                 <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Offer Name</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control" value="{{$offer->p_offername}}" name="p_offername" placeholder="{offername}" >
                                          @error('p_offername')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>  
                                
                                
                                
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Reward amount</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control" name="p_payout" value="{{$offer->p_payout}}" placeholder="{payout}" required>
                                          @error('p_payout')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                  </div> 
                                </div>
                                </div>
                                
                            <div class="form-group row">
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Admin Payout ( For Calculate Admin Earning )</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control" name="p_admin_payout"  value="{{$offer->p_admin_payout}}" placeholder="{admin_payout}" >
                                          @error('admin_payout')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>
                          
                                
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>IP Address</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control" name="p_ip" value="{{$offer->p_ip}}" placeholder="{ip}" >
                                          @error('p_ip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>
                                
                                      
                                <div class="col-sm-3">
                                   <label for="exampleInputPassword2" class="col-sm-12 col-form-label">Parameter for <b>Offer Response Code</b></label>
                                    <div class="col-sm-12">
                                          <input id="url" type="text" class="form-control"  name="response_code"  value="{{$offer->response_code}}" placeholder="{response_code}" required>
                                          @error('response_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div> 
                                </div>  
                              
                                </div>
                

                        <button type="submit" class="btn btn-primary mr-2">
                            {{ __('Update')}}
                        </button>
                        <button class="btn btn-light">{{ __('Cancel')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <!--get role wise permissiom ajax script-->
    
        <script>
        
        $("#icon").change(function(e) {

            for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
                
                var file = e.originalEvent.srcElement.files[i];
                
                var img = document.createElement("img");
                var reader = new FileReader();
                reader.onloadend = function() {
                     img.src = reader.result;
                     img.height = 100;
                }
                
                reader.readAsDataURL(file);
                 $('#imgdiv').html(img);
                           
                // $("input").after(img);
            }
        });
    </script>
    @endpush @endsection
</div>