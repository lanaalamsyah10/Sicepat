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
                    <div class="text-left mb-4">
                        <a class="btn btn-success" href="{{ route('dashboard.onhold.create') }}" role="button">Tambah
                            Data</a>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>District</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($onholds as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->user->name }}</td>
                                        <td>{{ $user->district }}</td>
                                        <td>
                                            <div class="d-flex button-items">
                                                <a class="btn btn-info"
                                                    href="{{ route('dashboard.onhold.show', $user->user_id) }}"
                                                    role="button"><i class="mdi mdi-eye"></i></a>
                                                <form action="{{ route('dashboard.onhold.destroy', $user->user_id) }}"
                                                    method="POST" onsubmit="return deleteConfirmation(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class="mdi mdi-delete"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
