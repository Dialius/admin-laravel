@extends('layouts.app')

@section('title', 'Daftar Pekerja')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Daftar Pekerja</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pekerja</h3>
                    <div class="card-tools">
                        <a href="{{ route('pekerja.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Pekerja
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
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

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <!-- ✅ TAMBAHAN: Kolom Foto -->
                                <th style="width: 80px" class="text-center">Foto</th>
                                <!-- ✅ AKHIR TAMBAHAN -->
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Skill</th>
                                <th style="width: 200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($daftar_pekerja as $index => $pekerja)
                                <tr>
                                    <td>{{ $daftar_pekerja->firstItem() + $index }}</td>
                                    
                                    <!-- ✅ TAMBAHAN: Tampilkan Foto -->
                                    <td class="text-center">
                                        @if($pekerja->profile_image)
                                            <img src="{{ $pekerja->profile_image }}" alt="Profile" class="img-circle elevation-2" width="40" height="40" style="object-fit: cover;">
                                        @else
                                            <img src="https://via.placeholder.com/40?text=No" alt="No Image" class="img-circle" width="40" height="40">
                                        @endif
                                    </td>
                                    <!-- ✅ AKHIR TAMBAHAN -->
                                    
                                    <td>{{ $pekerja->nama }}</td>
                                    <td>{{ $pekerja->email }}</td>
                                    <td>{{ $pekerja->skill }}</td>
                                    <td>
                                        <a href="{{ route('pekerja.show', $pekerja->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('pekerja.edit', $pekerja->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pekerja.destroy', $pekerja->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        
                                        <!-- ✅ TAMBAHAN: Tombol Upload Foto -->
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadModal{{ $pekerja->id }}" title="Upload Foto">
                                            <i class="fas fa-camera"></i>
                                        </button>
                                        <!-- ✅ AKHIR TAMBAHAN -->
                                    </td>
                                </tr>
                                
                                <!-- ✅ TAMBAHAN: Modal Upload Foto -->
                                <div class="modal fade" id="uploadModal{{ $pekerja->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white">Upload Foto - {{ $pekerja->nama }}</h5>
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
                                
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data pekerja</td> <!-- ⚠️ UBAH colspan dari 5 menjadi 6 -->
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $daftar_pekerja->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection