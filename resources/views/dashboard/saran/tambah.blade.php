@extends('dashboard.layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="btn-group float-left">Tambah Komentar</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <form method="post" action="{{ route('dashboard.saran.store') }}"enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <div>
                                    <textarea required class="form-control @error('saran') is-invalid @enderror" rows="5" name="saran"
                                        id="deskripsi">{{ htmlspecialchars(old('saran')) }}</textarea>
                                    @error('saran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"
                                            onclick="disableButton2(this);">
                                            <span id="buttonText">Simpan</span>
                                        </button>
                                        <a href="javascript:window.history.go(-1)"
                                            class="btn btn-secondary waves-effect m-l-5">
                                            Batal
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    </div>
    </div>
    </div> <!-- end col -->

    </div> <!-- end row -->
    @push('javascript')
        <script>
            function disableButton(button) {
                button.disabled = true;
                var buttonText = document.getElementById("buttonText");
                buttonText.innerText = "Tunggu...";
                // Menjalankan submit form setelah 500ms
                setTimeout(function() {
                    button.form.submit();
                }, 500);
            }
        </script>
        <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace('deskripsi');
        </script>
        <script>
            function previewImage() {
                const image = document.querySelector('#gambar');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        </script>
    @endpush
@endsection
