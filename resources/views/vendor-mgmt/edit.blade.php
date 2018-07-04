@extends('vendor-mgmt.base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update vendor</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('vendor-management.update', ['id' => $vendor->id]) }}">
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group{{ $errors->has('comp_title') ? ' has-error' : '' }}">
                                <label for="comp_title" class="col-md-4 control-label">Company Title</label>

                                <div class="col-md-6">
                                    <input id="comp_title" type="text" class="form-control" name="comp_title" value="{{ $vendor->comp_title }}" required autofocus>

                                    @if ($errors->has('comp_title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('comp_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('comp_name') ? ' has-error' : '' }}">
                                <label for="comp_name" class="col-md-4 control-label">Customer Name</label>

                                <div class="col-md-6">
                                    <input id="comp_name" type="text" class="form-control" name="comp_name" value="{{ $vendor->comp_name }}" required autofocus>

                                    @if ($errors->has('comp_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('comp_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="address" class="form-control" name="address" value="{{ $vendor->address }}" required>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('npwp') ? ' has-error' : '' }}">
                                <label for="npwp" class="col-md-4 control-label">NPWP</label>

                                <div class="col-md-6">
                                    <input id="npwp" type="text" class="form-control" name="npwp" value="{{ $vendor->npwp }}" required>

                                    @if ($errors->has('npwp'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('npwp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('sap_num') ? ' has-error' : '' }}">
                                <label for="sap_num" class="col-md-4 control-label">Sap Number</label>

                                <div class="col-md-6">
                                    <input id="sap_num" type="text" class="form-control" name="sap_num" value="{{$vendor->sap_num }}" required>

                                    @if ($errors->has('sap_num'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sap_num') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
