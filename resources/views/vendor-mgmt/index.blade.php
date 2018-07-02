@extends('vendor-mgmt.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">List of vendor</h3>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary" href="{{ route('vendor-management.create') }}">Add new vendor</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <form method="POST" action="{{ route('vendor-management.search') }}">
                    {{ csrf_field() }}
                    @component('layouts.search', ['title' => 'Search'])
                    @component('layouts.two-cols-search-row', ['items' => ['Company Title', 'Customer Name'],
                    'oldVals' => [isset($searchingVals) ? $searchingVals['comp_title'] : '', isset($searchingVals) ? $searchingVals['comp_name'] : '']])
                    @endcomponent
                    </br>
                    @component('layouts.two-cols-search-row', ['items' => ['Address', 'NPWP'],
                    'oldVals' => [isset($searchingVals) ? $searchingVals['address'] : '', isset($searchingVals) ? $searchingVals['address'] : '']])
                    @endcomponent
                    @endcomponent
                </form>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Company Title</th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Customer Name</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Address</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">NPWP</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Sap Number</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($vendors as $vendor)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $vendor->comp_title }}</td>
                                        <td>{{ $vendor->comp_name }}</td>
                                        <td class="hidden-xs">{{ $vendor->address }}</td>
                                        <td class="hidden-xs">{{ $vendor->npwp }}</td>
                                        <td class="hidden-xs">{{ $vendor->sap_num }}</td>
                                        <td>
                                            <form class="row" method="POST" action="{{ route('vendor-management.destroy', ['id' => $vendor->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <a href="{{ route('vendor-management.edit', ['id' => $vendor->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                                    Update
                                                </a>
                                                {{--@if ($user->name != Auth::user()->name)--}}
                                                    <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                                        Delete
                                                    </button>
                                                {{--@endif--}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th width="10%" rowspan="1" colspan="1">Company Title</th>
                                    <th width="20%" rowspan="1" colspan="1">Customer Name</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Address</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">NPWP</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Sap Number</th>
                                    <th rowspan="1" colspan="2">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($vendors)}} of {{count($vendors)}} entries</div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection