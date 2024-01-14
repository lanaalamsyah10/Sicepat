@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">On Hold</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Resi</th>
                                    <th>Qr Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($onholds as $onhold)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $onhold->user->name }}</td>
                                        <td>{{ $onhold->no_resi }}</td>
                                        <td> {!! QrCode::size(100)->generate($onhold->no_resi) !!} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <a href="javascript:window.history.go(-1)" class="btn btn-secondary waves-effect m-l-5"><i
                            class="mdi mdi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
