@extends('layout.conquer2')
@section('isi')
    @if (@session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif


    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-reorder"></i> Masukkan Hotel
            </div>
            <div class="tools">
                <a href="" class="collapse"></a>
                <a href="#portlet-config" data-toggle="modal" class="config"></a>
                <a href="" class="reload"></a>
                <a href="" class="remove"></a>
            </div>
        </div>
        <div class="portlet-body form">
            <form method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                    <small id="thumbnailHelp" class="form-text text-muted">Upload thumbnail hotel disini.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputType">Nama Hotel</label>
                    <input type="text" class="form-control" id="exampleInputType" name="hotel_name"
                        aria-describedby="nameHelp" placeholder="Masukkan Nama Hotel...">
                    <small id="nameHelp" class="form-text text-muted">Masukkan nama hotel disini.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputType">Alamat Hotel</label>
                    <input type="text" class="form-control" id="exampleInputType" name="hotel_address"
                        aria-describedby="nameHelp" placeholder="Masukkan Alamat Hotel...">
                    <small id="nameHelp" class="form-text text-muted">Masukkan alamat hotel disini.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputType">Nomer Telepon Hotel</label>
                    <input type="text" class="form-control" id="exampleInputType" name="hotel_phone"
                        aria-describedby="nameHelp" placeholder="Masukkan Nomer Telepon Hotel...">
                    <small id="nameHelp" class="form-text text-muted">Masukkan nomer telepon hotel disini.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputType">Email Hotel</label>
                    <input type="text" class="form-control" id="exampleInputType" name="hotel_email"
                        aria-describedby="nameHelp" placeholder="Masukkan Email Hotel...">
                    <small id="nameHelp" class="form-text text-muted">Masukkan email hotel disini.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputType">Bintang dari Hotel</label>
                    <input type="number" class="form-control" id="exampleInputType" name="hotel_bintang" placeholder="Masukkan Bintang Hotel...">
                    <small class="form-text text-muted">Masukkan bintang hotel disini.</small>
                  </div>


                <div class="form-group">
                    <label for="hotel_id">Tipe Hotel</label>
                    <select class="form-control" id="hotel_id" name="hotel_type">
                        @foreach ($types as $t)
                            <option 
                            value="{{ $t->id }}">{{ $t->nama }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Pilih tipe hotel dari list berikut.</small>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
    <!-- END SAMPLE FORM PORTLET-->
@endsection
@section('judul-halaman', 'Tambah Hotel')
