@extends('layouts.master')

@section('title')
{{ __('sentence.All Drugs') }}
@endsection

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-2">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Drugs') }}</h6>
         </div>
         {{-- import and export section --}}
        <div class="col-2">
            <div >
                <div class="d-flex my-2">
                    <a  href="{{ route('drug.export_csv') }}" class="btn btn-primary me-1 mr-2">Export Data</a>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Import Data
                    </button>
                </div>
            </div>
        </div>
         <div class="col-8">
            @can('create drug')
            <a href="{{ route('drug.create') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> {{ __('sentence.Add Drug') }}</a>
            @endcan
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>{{ __('sentence.Trade Name') }}</th>
                  <th>{{ __('sentence.Generic Name') }}</th>
                  <th>{{ __('sentence.Price') }}</th>
                  <th>{{ __('sentence.Stock') }}</th>
                  <th class="text-center">{{ __('sentence.Total Use') }}</th>
                  <th class="text-center">{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @foreach($drugs as $drug)
               <tr>
                  <td>{{ $drug->id }}</td>
                  <td>{{ $drug->trade_name }}</td>
                  <td>{{ $drug->generic_name }}</td>
                  <td>{{ $drug->Price }}</td>
                  <td>{{ $drug->Stock }}</td>
                  <td align="center">{{ __('sentence.In Prescription') }} : {{ $drug->Prescription->count() }} {{ __('sentence.time use') }}</td>
                  <td class="text-center">
                     @can('edit drug')
                     <a href="{{ url('drug/edit/'.$drug->id) }}" class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                     @endcan
                     @can('delete drug')
                     <a class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal" data-target="#DeleteModal" data-link="{{ route('drug.destroy' , ['id' => $drug->id ]) }}"><i class="fas fa-trash"></i></a>
                     @endcan
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
{{-- modal --}}
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import CSV</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('drug.import_csv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
