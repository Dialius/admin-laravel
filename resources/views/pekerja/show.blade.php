@extends('layouts.app')

@section('title', 'Detail Data Pekerja')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pekerja.index') }}">Daftar Pekerja</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <!-- ✅ TAMBAHAN: Alert Success/Error -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('error') }}
                </div>
            @endif
            <!-- ✅ AKHIR TAMBAHAN -->

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user"></i> Detail Data Pekerja
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('pekerja.edit', $pekerja->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('pekerja.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <div class="mb-3">
                                <!-- ✅ TAMBAHAN: Ganti icon dengan foto profil -->
                                @if($pekerja->profile_image)
                                    <img src="{{ $pekerja->profile_image }}" alt="Profile" class="img-circle elevation-2" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle fa-5x text-primary"></i>
                                @endif
                                <!-- ✅ AKHIR TAMBAHAN -->
                            </div>
                            <h4 class="mb-0">{{ $pekerja->nama }}</h4>
                            <p class="text-muted">
                                <i class="fas fa-briefcase"></i> {{ $pekerja->skill }}
                            </p>
                            <!-- ✅ TAMBAHAN: Tombol Upload Foto -->
                            <button class="btn btn-success btn-sm mt-2" data-toggle="modal" data-target="#uploadModal">
                                <i class="fas fa-camera"></i> 
                                @if($pekerja->profile_image)
                                    Ubah Foto
                                @else
                                    Upload Foto
                                @endif
                            </button>
                            <!-- ✅ AKHIR TAMBAHAN -->
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong><i class="fas fa-birthday-cake mr-1"></i> Umur</strong>
                            <p class="text-muted">{{ $pekerja->umur }} tahun</p>
                        </div>

                        <div class="col-md-6">
                            <strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>
                            <p class="text-muted">
                                @if($pekerja->jenis_kelamin == 'L')
                                    <span class="badge badge-primary">Laki-laki</span>
                                @else
                                    <span class="badge badge-danger">Perempuan</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                            <p class="text-muted">{{ $pekerja->alamat }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong><i class="fas fa-phone mr-1"></i> Nomor HP</strong>
                            <p class="text-muted">
                                <a href="tel:{{ $pekerja->nomor_hp }}">{{ $pekerja->nomor_hp }}</a>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">
                                <a href="mailto:{{ $pekerja->email }}">{{ $pekerja->email }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <strong><i class="fas fa-tools mr-1"></i> Skill / Keahlian</strong>
                            <p class="text-muted">{{ $pekerja->skill }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-calendar-plus"></i> Dibuat: {{ $pekerja->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>
                        <div class="col-md-6 text-right">
                            <small class="text-muted">
                                <i class="fas fa-calendar-check"></i> Diperbarui: {{ $pekerja->updated_at->format('d M Y, H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('pekerja.edit', $pekerja->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            <form action="{{ route('pekerja.destroy', $pekerja->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data pekerja ini?')">
                                    <i class="fas fa-trash"></i> Hapus Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- ✅ TAMBAHAN: Modal Upload Foto -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Upload Foto Profil - {{ $pekerja->nama }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pekerja.upload.profile', $pekerja->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @if($pekerja->profile_image)
                            <div class="text-center mb-3">
                                <img src="{{ $pekerja->profile_image }}" alt="Current" class="img-thumbnail" width="150">
                                <p class="text-muted mt-2 small">Foto saat ini</p>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Pilih Foto Baru</label>
                            <input type="file" name="profile_image" class="form-control" accept="image/*" required>
                            <small class="text-muted">Format: JPG, PNG, GIF. Max: 2MB</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ✅ AKHIR TAMBAHAN -->
@endsection