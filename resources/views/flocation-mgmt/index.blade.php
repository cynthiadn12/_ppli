@extends('flocation-mgmt.base')

@section('title')
    Daftar Lokasi
@endsection

@section('breadcrumb')
    @parent
    <li>lokasi</li>
@endsection

@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
                    </div>
                    <div class="box-body">

                        <table id="table" class="table table-striped">
                            <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Nama Lokasi</th>
                                <th width="100">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr class="item{{$item->id}}">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->loc_lvl1}}</td>
                                    <td><button class="edit-modal btn btn-info"
                                                data-info="{{$item->id}}">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </button>
                                        <button class="delete-modal btn btn-danger"
                                                data-info="{{$item->id}}">
                                            <span class="glyphicon glyphicon-trash"></span> Delete
                                        </button></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        @include('flocation-mgmt.form')
    </section>
    <!-- /.content -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTables({
                "processing" : true,
                "serverside" : true,
                "ajax" : "{{ route('flocation-management.listData') }}",
                "columns": [
                    {"data": "id"},
                    {"data": "loc_lvl1"}
                ],
            });
        });
    </script>
@endsection
