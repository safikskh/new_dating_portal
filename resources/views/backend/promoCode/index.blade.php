@extends('backend.layouts.app')


@section('content')
<!-- Breadcrumbs-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/admin')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Promo Code</li>
    </ol>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
        <div class="pull-left">
            <p> 
                <form class="d-inline" action="{{action('Backend\PromoCodeController@exportCSV')}}" method="post">
                @csrf
                    <button type="submit" class="btn btn-success">
                    <i class="fas fa-download"></i> CSV</button>
                </form>
                <form class="d-inline" action="{{action('Backend\PromoCodeController@exportXL')}}" method="post">
                @csrf
                    <button type="submit" class="btn btn-info">
                    <i class="fas fa-download"></i> XL</button>
                </form>
                <form class="d-inline" method='post' action="{{action('Backend\PromoCodeController@uploadFile')}}" enctype='multipart/form-data'>
                @csrf
                    <input type='file' name='file' >
                    <button type="submit" name='submit' value='Import' class="btn btn-info">
                    <i class="fas fa-upload"></i>Upload CSV</button>
                </form>
            </p>
        </div>
        <div class="pull-right">
            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#regionCreateModal" href="#"><i class="fa fa-plus" aria-hidden="true"></i>Random</a>
            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#promoCreateModal" href="#"><i class="fa fa-plus" aria-hidden="true"></i>Custom</a>
        </div>   
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Promo Code</th>
                    <th>Discount</th>
                    <th>Expire at</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                     <th>No</th>
                    <th>Promo Code</th>
                    <th>Discount</th>
                    <th>Expire at</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($promoCodeList as $index=> $item)
                <tr>
                <td>{{++$index}}</td>
                    <td>{{$item->promoCode}}</td>
                    <td>{{$item->discount}}@if($item->isFixed)$@else%@endif</td>
                    <td>{{date('d-m-Y', strtotime($item->edate))}}</td>
                </tr>               
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>

{{-- Start Modal 'for' post category create --}}
<div class="modal fade" id="regionCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Random Generate Promocode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            {!! Form::open(array('route' => 'promocode.store','method'=>'POST')) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Quantity:</strong>
                        <input type="number" name="quantity" class="form-control" placeholder="Quantity of promocode" required/>
                    </div>
                    <div class="form-group">
                    <strong>Type:</strong>
                    <select name="type" class="custom-select mr-sm-2" id="inlineFormCustomSelect" required>                            
                        <option value="0">Percentage</option>
                        <option value="1">Fixed</option>
                    </select>
                    </div>
                    <strong>Discount:</strong>
                    <div class="input-group mb-3">
                        <input name="discount" placeholder="Discount value" type="number" class="form-control" aria-label="Amount (to the nearest dollar)" required>
                        
                    </div>
                    <strong>Expaire Date:</strong>
                    <div class="input-group mb-3">
                        <input name="edate" placeholder="Discount value" type="date" class="form-control" aria-label="Amount (to the nearest dollar)" required>                        
                    </div>
                   
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>
{{-- End post category create Modal --}}

{{-- Start Modal 'for' post category create --}}
<div class="modal fade" id="promoCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Custom Generate Promocode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            {!! Form::open(array('route' => 'custom','method'=>'POST')) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Promo Code:</strong>
                        <input type="text" name="pcode" class="form-control" placeholder="Promo Code..." required/>
                    </div>
                    <div class="form-group">
                        <strong>Type:</strong>
                        <select name="type" class="custom-select mr-sm-2" id="inlineFormCustomSelect" required>                            
                                            <option value="0">Percentage</option>
                                            <option value="1">Fixed</option>
                                        </select>
                    </div>
                    <strong>Discount:</strong>
                    <div class="input-group mb-3">
                        <input name="discount" placeholder="Discount value" type="number" class="form-control" aria-label="Amount (to the nearest dollar)"
                            required>
                    
                    </div>
                    <strong>Expaire Date:</strong>
                    <div class="input-group mb-3">
                        <input name="edate" placeholder="Discount value" type="date" class="form-control" aria-label="Amount (to the nearest dollar)"
                            required>
                    </div>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>
{{-- End post category create Modal --}}


{{-- Start Modal 'for' Post category edit --}}
<div class="modal fade" id="regionEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Region Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body regionEditAdd">

        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>
{{-- End Post category edit Modal --}}
@endsection
@section('style')
<style>
    a.btn.btn-sm.btn-light.showModal {
        background: #b9a4a436;
    }
</style>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        //edit region in modal
        $(document).on('click', 'a.editRegion', function() {
            var id = $(this).attr('data-id');
            $.get('regionEdit/'+id, function(data){
                $('#regionEditModal').find('.regionEditAdd').first().html(data);
            });
        });
       
    });
</script>
@endsection