@extends('sourcing-dshbrd.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">List of sourcing</h3>
                    </div>
                    <div class="col-sm-4">
                        <a class="btn btn-primary" href="{{ route('sourcing-dashboard.create') }}">Add new data</a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6"></div>
                </div>
                <form method="POST" action="{{ route('user-management.search') }}">
                    {{ csrf_field() }}
                    @component('layouts.search', ['title' => 'Search'])
                    @component('layouts.two-cols-search-row', ['items' => ['id_loc_lvl1', 'id_loc_lvl2'],
                    'oldVals' => [isset($searchingVals) ? $searchingVals['id_loc_lvl1'] : '', isset($searchingVals) ? $searchingVals['id_loc_lvl2'] : '']])
                    @endcomponent
                    </br>
                    @component('layouts.two-cols-search-row', ['items' => ['id_vendor', 'id_fish'],
                    'oldVals' => [isset($searchingVals) ? $searchingVals['id_vendor'] : '', isset($searchingVals) ? $searchingVals['id_fish'] : '']])
                    @endcomponent
                    </br>
                    @component('layouts.two-cols-search-row', ['items' => ['qty', 'id_measurement'],
                    'oldVals' => [isset($searchingVals) ? $searchingVals['qty'] : '', isset($searchingVals) ? $searchingVals['id_measurement'] : '']])
                    @endcomponent
                    </br>
                    @component('layouts.two-cols-search-row', ['items' => ['price', 'valid_until'],
                    'oldVals' => [isset($searchingVals) ? $searchingVals['price'] : '', isset($searchingVals) ? $searchingVals['valid_until'] : '']])
                    @endcomponent
                    @endcomponent
                </form>
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">ID Location Lvl 1</th>
                                    <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ID Location Lvl 2</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ID Vendor</th>
                                    <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">ID Fish</th>
                                    <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Quantity</th>
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">ID Measurement</th>
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Price</th>
                                    <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Valid Until</th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($sourcings as $sourcing)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $sourcing->id_loc_lvl1 }}</td>
                                        <td class="sorting_1">{{ $sourcing->id_loc_lvl2 }}</td>
                                        <td class="sorting_1">{{ $sourcing->id_vendor }}</td>
                                        <td class="sorting_1">{{ $sourcing->id_fish }}</td>
                                        <td>{{ $sourcing->qty }}</td>
                                        <td class="sorting_1">{{ $sourcing->id_measurement }}</td>
                                        <td class="hidden-xs">{{ $sourcing->price }}</td>
                                        <td class="hidden-xs">{{ $sourcing->valid_until }}</td>
                                        <td>
                                            <form class="row" method="POST" action="{{ route('sourcing-dashboard.destroy', ['id' => $sourcing->id]) }}" onsubmit = "return confirm('Are you sure?')">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <a href="{{ route('sourcing-dashboard.edit', ['id' => $sourcing->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                                    Update
                                                </a>
                                                @if ($user->name != Auth::user()->name)
                                                    <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                                        Delete
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th width="10%" rowspan="1" colspan="1">ID Location Lvl 1</th>
                                    <th width="20%" rowspan="1" colspan="1">ID Location Lvl 2</th>
                                    <th width="10%" rowspan="1" colspan="1">ID Vendor</th>
                                    <th width="20%" rowspan="1" colspan="1">ID Fish</th>
                                    <th width="10%" rowspan="1" colspan="1">Quantity</th>
                                    <th width="20%" rowspan="1" colspan="1">ID Measurement</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Price</th>
                                    <th class="hidden-xs" width="20%" rowspan="1" colspan="1">Valid Until</th>
                                    <th rowspan="1" colspan="2">Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($sourcings)}} of {{count($sourcings)}} entries</div>
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