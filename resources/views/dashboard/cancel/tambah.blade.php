@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Resi</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <form method="post" action="{{ route('dashboard.cancel.store') }}"enctype="multipart/form-data">
                        @csrf
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <tr>
                                <th>Nomor Resi</th>
                                <th>Aksi</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="no_resi[]" placeholder="Nomor resi" class="form-control" />
                                </td>
                                <td><button type="button" name="add" id="dynamic-ar"
                                        class="btn btn-outline-info">Tambah</button></td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    onclick="disableButton2(this);">
                                    <span id="buttonText">Simpan</span>
                                </button>

                                <a href="javascript:window.history.go(-1)" class="btn btn-secondary waves-effect m-l-5">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> <!-- end col -->

    </div> <!-- end row -->
    @push('javascript')
        <script type="text/javascript">
            var i = 0;
            $("#dynamic-ar").click(function() {
                ++i;
                $("#dynamicAddRemove").append(
                    '<tr><td><input type="text" name="no_resi[]" placeholder="Nomor resi" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
                );
            });
            $(document).on('click', '.remove-input-field', function() {
                $(this).parents('tr').remove();
            });
        </script>
    @endpush
@endsection
