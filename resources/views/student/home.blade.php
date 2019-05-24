@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Home</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">
@endsection

@section('navi')
    @include('inc.naviStudent', [$totalEquip, $lastTransaction, $countCart])
@endsection

@section('content')
@if(Auth::user()->penalty>0)
<div class="alert alert-danger mt-3" role="alert">
    You still have an outstanding balance amounting to <b>PHP{{Auth::user()->penalty}}.00</b>! Please proceed to the <b>Accounting Office</b> as soon as possible to settle this.
</div>
@endif
<span class="float-right"><b>Legend:</b> <i class="fas fa-exclamation-triangle text-danger"></i> - due/overdue</span>
<div class="row pt-3">
   <div class="col-md-6">
       <table class="table table-borderless border table-md">
           <thead class="bg-dark text-light" style="font-size:14px">
               <th colspan="2" class="border-bottom text-center">Equipment in Hand</th>
           </thead>
           <tbody>
            @if($unreturnedForms->isEmpty())
               <tr>
                   <td colspan="2" class="text-center" style="font-size:22px; padding: 60px;">
                       <i class="fas fa-lg fa-check-circle text-success"></i> 
                       You're all good!
                       <br>
                       <small class="text-muted">You don't have any items due for return.</small>
                   </td>
               </tr>
            @else 
               @foreach($unreturnedForms as $form)
                    <tr>
                    <td colspan="2">
                        <b>Transaction ID:</b> {{$form->transaction_id}}
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <b>Due Date and Time:</b> {{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->end_time)->format('h:i A')}}
                        @if(\Carbon\Carbon::parse($form->due_date)->isPast() or \Carbon\Carbon::parse($form->due_date)->isToday())
                        <i class="fas fa-lg fa-exclamation-triangle text-danger"></i>
                        @endif
                        </td>
                </tr>
               <tr style="line-height: 2.5">
                   <td class="text-center" colspan="2" style="font-size:14px"><b>Items Reserved</b></td>
               </tr>
                    @foreach($equipments as $equipment)
                    @if($form->transaction_id==$equipment->transaction_id)
                    <tr class="border-top border-bottom">
                            <td class="text-right">{{$equipment->equipID}}</td>
                            <td class="text-center">{{$equipment->equip_name}}</td>
                    </tr>
                    <tr style="line-height: 2.5">
                        <td class="text-center" colspan="2" style="font-size:14px"><b>Items Reserved</b></td>
                    </tr>
                        @foreach($equipments as $equipment)
                        @if($form->transaction_id==$equipment->transaction_id && $equipment->equip_avail == 1)
                        <tr>
                                <td class="text-right">{{$equipment->equipID}}</td>
                                <td class="text-center">{{$equipment->equip_name}}</td>
                        </tr>
                        @endif
                        @endforeach
               @endforeach
            @endif
           </tbody>
       </table>
   </div>

   <div class="col-md-6">
       <table class="table table-borderless border table-md">
           <thead class="bg-dark text-light" style="font-size:14px">
               <th colspan="2" class="border-bottom text-center">Equipment to Claim</th>
           </thead>
           <tbody>
            @if($unclaimedForms->isEmpty())
                <tr>
                    <td colspan="2" class="text-center" style="font-size:22px; padding: 60px;">
                        <i class="far fa-lg fa-thumbs-up text-primary"></i> 
                        You dont have any items to claim. YET.
                        <br>
                        <small><a href="equipmentlist" class="card-link">Why not start adding items to your cart now?</a></small>
                    </td>
                </tr>
            @else 
                @foreach($unclaimedForms as $form)
                    <tr>
                    <td colspan="2">
                        <b>Transaction ID:</b> {{$form->transaction_id}}
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <b>Start Date and Time:</b> {{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->start_time)->format('h:i A')}}
                        @if(\Carbon\Carbon::parse($form->start_date)->isPast() or \Carbon\Carbon::parse($form->start_date)->isToday())
                        <i class="fas fa-lg fa-exclamation-triangle text-danger"></i>
                        @endif
                        </td>
                    </tr>
                <tr style="line-height: 2.5">
                    <td class="text-center" colspan="2" style="font-size:14px"><b>Items Reserved</b></td>
                </tr>
                    @foreach($equipments as $equipment)
                    @if($form->transaction_id==$equipment->transaction_id)
                    <tr>
                            <td class="text-right">{{$equipment->equipID}}</td>
                            <td class="text-center">{{$equipment->equip_name}}</td>
                    </tr>
                    @endif
                    @endforeach
                @endforeach
            @endif
           </tbody>
       </table>
   </div>
</div>
<div class="row pt-3">
   <div class="col-md-12">
       <table class="table table-borderless table-md table-hover border">
           <thead class="text-center" style="font-size:14px">
               <tr class="bg-dark text-light">
                   <th colspan="4">Pending Requests</th>
               </tr>
               <tr>
                   <th class="align-middle">Transaction ID</th>
                   <th class="align-middle">Date Submitted</th>
                   <th class="align-middle">Target Start Date</th>
                   <th></th>
               </tr>
           </thead>
           <tbody class="text-center">
                @if($pendingForms->isEmpty())
                <tr>
                    <td colspan="4">No pending requests</td>
                </tr>
                @else
                    @foreach($pendingForms as $form)
                        <tr>
                            <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{$form->transaction_id}}</td>
                            <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{\Carbon\Carbon::parse($form->submitted_date)->format('F d, Y h:i A')}}</td>
                            <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->start_time)->format('h:i A')}}</td>
                            <td class="align-middle"><button type="button"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmCancellation{{$form->transaction_id}}">Cancel</button></td>
                            @include('inc.confirmCancellation')
                        </tr>
                    @endforeach
                @endif
           </tbody>
       </table>
   </div>
</div>
<div class="row pt-3">
   <div class="col-md-12">
       <table class="table table-borderless table-md table-hover border">
           <thead class="text-center" style="font-size:14px">
               <tr class="bg-dark text-light">
                   <th colspan="6">Approved Requests</th>
               </tr>
               <tr>
                   <th class="align-middle">Transaction ID</th>
                   <th class="align-middle">Date Submitted</th>
                   <th class="align-middle">Start Date and Time</th>
                   <th class="align-middle">Due Date and Time</th>
                   <th class="align-middle">Status</th>
                   <th></th>
               </tr>
           </thead>
           <tbody class="text-center">
                @if($recentForms->isEmpty())
                <tr>
                    <td colspan="6">No approved requests</td>
                </tr>
                @else
                @foreach($recentForms as $form)
                <tr>
                    <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{$form->transaction_id}}</td>
                    <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{\Carbon\Carbon::parse($form->submitted_date)->format('F d, Y h:i A')}}</td>
                    <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->start_time)->format('h:i A')}}</td>
                    <td class="align-middle" data-toggle="modal" data-target ="#checkForm{{$form->transaction_id}}">{{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->end_time)->format('h:i A')}}</td>
                    <td class="align-middle">
                        @if($form->approval==1)
                            @if($form->claimed==1 and $form->returned==0)
                            <span class="badge badge-success">Approved</span>
                            <span class="badge badge-primary">Claimed</span>
                            @elseif($form->claimed==1 and $form->returned==1)
                            <span class="badge badge-success">Returned</span>
                            @else
                            <span class="badge badge-success">Approved</span>
                            <span class="badge badge-warning">Unclaimed</span>
                            @endif
                        @elseif($form->approval==0)
                        <span class="badge badge-warning">Pending</span>
                        @elseif($form->approval==-1)
                        <span class="badge badge-danger">Declined</span>
                        @else 
                        <span class="badge badge-danger">Cancelled</span>
                        @endif
                    </td>
                    <td class="align-middle">
                        @if(\Carbon\Carbon::parse($form->due_date)->isPast() or $form->approval<0 or $form->claimed == 1)
                        <button type="button" class="btn btn-sm btn-danger" disabled>Cancel</button>
                        @else 
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target ="#confirmCancellation{{$form->transaction_id}}">Cancel</button>
                        @include('inc.confirmCancellation')
                        @endif
                    </td>
                </tr>
                @endforeach
               @endif
           </tbody>
       </table>
   </div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
@endsection
