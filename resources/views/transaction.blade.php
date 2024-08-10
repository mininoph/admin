@extends('layouts.main')
@section('title', 'User Transaction')
@section('content')
<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endpush


<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Transaction')}}</h5>
                        <span>{{ __('List of Transaction')}}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Transaction')}}</a>
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
            <div class="card p-3">
                <div class="card-header">
                    <h3>{{ __('User Transaction')}}</h3>
                </div>
                <div class="card-body">
                    <table id="trans_table" class="table">
                        <thead>
                            <tr>
                                <th>{{ __('ID.')}}</th>
                                <th>{{ __('Name')}}</th>
                                <th>{{ __('Amount')}}</th>
                                <th>{{ __('Type')}}</th>
                                <th>{{ __('Remained Coin')}}</th>
                                <th>{{ __('Remark')}}</th>
                                <th>{{ __('Date')}}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data) > 0)
                            @foreach($data as $item)
                            <tr>
                                <td class="text-sm">{{$item->id}} </td>
                                <td class="text-sm"> {{ App\Models\Users::getUserNameById($item->user_id) }} </td>
                                <td class="text-sm"> {{$item->amount}} </td>
                                <td class="text-sm">
                                    @if($item->tran_type == 'credit')
                                    <span class="badge badge-success m-1">Credit</span>
                                    @else
                                    <span class="badge badge-danger m-1">Debit</span>

                                    @endif
                                </td>
                                <td class="text-sm"> {{$item->remained_balance}} </td>
                                <td class="text-sm"> {{$item->remarks}} </td>
                                <td class="text-sm"> {{date('d-m-Y', strtotime($item->inserted_at))}} </td>
                                <td class="text-sm">
                                   <a href="/user/track/{{$item->user_id}}"><button type="button"  class="btn btn-dark tr"><i class="ik ik-activity"></i>Track User</button></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if($data->hasPages())
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-info justify-content-center">

                            <?php

                            $interval = isset($interval) ? abs(intval($interval)) : 3;
                            $from = $data->currentPage() - $interval;
                            if ($from < 1) {
                                $from = 1;
                            }

                            $to = $data->currentPage() + $interval;
                            if ($to > $data->lastPage()) {
                                $to = $data->lastPage();
                            }
                            ?>

                            <!-- first/previous -->
                            @if($data->currentPage() > 1)

                            <li class="page-item">
                                <a href="{{ $data->url(1) }}" class="page-link">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>

                            <li class="page-item">
                                <a href="{{ $data->url($data->currentPage() - 1) }}" class="page-link" aria-label="Previous">
                                    <span aria-hidden="true"><i class="ni ni-bold-left" aria-hidden="true"></i></span>
                                </a>
                            </li>
                            @endif



                            @for($i = $from; $i <= $to; $i++) <?php
                                                                $isCurrentPage = $data->currentPage() == $i;
                                                                ?> <li class="page-item {{ $isCurrentPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ !$isCurrentPage ? $data->url($i) : '#' }}">
                                    {{ $i }}
                                </a>
                                </li>
                                @endfor

                                <!-- next/last -->
                                @if($data->currentPage() < $data->lastPage())
                                    <li class="page-item">
                                        <a href="{{ $data->url($data->currentPage() + 1) }}" class="page-link" aria-label="Next">
                                            <span aria-hidden="true"><i class="ni ni-bold-right" aria-hidden="true"></i></span>
                                        </a>
                                    </li>

                                    <li class="page-item">
                                        <a href="{{ $data->url($data->lastpage()) }}" class="page-link" aria-label="Next">
                                            <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                        </a>
                                    </li>
                                    @endif
                        </ul>
                    </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- push external js -->
@push('script')
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<!--server side users table script-->

@endpush
@endsection