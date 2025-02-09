@extends('layouts.app')
@section('content')
<div class="row" style="margin-top: 3.5%;">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="header-title">{{ $title }}</h4>
                    </div>
                    @if(count($getDatas) <= 0)
                    <div class="col-md-2">
                        <p class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#create"  onclick="getForm(0)"><i class="fa fa-plus"></i> create</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                    <thead>
                        <tr>
                            <th> SL </th>
                            <th> Ex Name </th>
                            <th> certificate_origin_no</th>
                            <th> serialno </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getDatas as $data)
                        <tr>
                            <td> {{ $loop->index+1 }} </td>
                            <td> {{ $data->ex_name }} </td>
                            <td> {{ $data->certificate_origin_no}} </td>
                            <td> {{ $data->serialno }} </td>
                            <td>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create" onclick="getForm({{$data->id}})" > <i class="fa fa-edit"></i> </a>
                                <a href="{{ route('frontend::invoice.print',['serialno' => $data->serialno])}}" class="btn btn-danger" target="_blank"> <i class="fa fa-print"></i> </a>
                                {{-- <a href="{{ route('team::delete',['id'=>$data->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"> <i class="fa fa-trash"></i> </a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="create" tabindex="-1" class="modal fade"  data-focus="false" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="form">
        

    </div>
</div>
@stop
@section('js')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
<script>
    function getForm(id){

        $.ajax({
            url: "{{ url('admin/invoice/form') }}",
            method: 'get',
            data:{ id:id },
            success: function(result){
                $('#form').html(result);
            }
        });
    }
</script>
@stop
@section('css')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@stop
