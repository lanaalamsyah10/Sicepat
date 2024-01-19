@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Dashboard</h4>
            </div>
        </div>

        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>District</th>
                                    <th>Saran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sarans as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->district }}</td>
                                        <td>{!! Str::limit(strip_tags($item->saran), 200) !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6 col-lg-6 col-xl-6 dashboard">
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <p class="mb-0 text-muted">Total saldo kas masjid</p>
                    <h5 class="mt-0 round-inner"></h5>
                    <div class="round">
                        <i class=" mdi mdi-book-multiple"></i>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md-6 col-lg-6 col-xl-6 dashboard">
            <div class="card-header bg-success text-white">
                Cancel
            </div>
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="round">
                                <i class=" mdi mdi-close-octagon"></i>
                            </div>
                            <h6 class="mt-0 text-center round-inner">{{ $cancel }} Paket</h6>
                        </li>
                        <li class="list-group-item">
                            <div class="round">
                                <i class=" mdi mdi-account"></i>
                            </div>
                            <h6 class="mt-0 text-center round-inner">{{ $usercancel }} Driver</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6 dashboard">
            <div class="card-header bg-danger text-white">
                On Hold
            </div>
            <div class="card m-b-30 text-center">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="round">
                                <i class=" mdi mdi-timetable"></i>
                            </div>
                            <h6 class="mt-0 text-center round-inner">{{ $onhold }} Paket</h6>
                        </li>
                        <li class="list-group-item">
                            <div class="round">
                                <i class=" mdi mdi-account"></i>
                            </div>
                            <h6 class="mt-0 text-center round-inner">{{ $useronhold }} Driver</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
