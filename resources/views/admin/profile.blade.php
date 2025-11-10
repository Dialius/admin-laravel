@extends('layouts.app')

@section('title', 'Profil Administrator')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Profil Administrator</li>
@endsection

@section('content')
    <div class="row">
        <!-- Kolom Foto Profil -->
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if(auth()->user()->profile_image)
                            <img class="profile-user-img img-fluid img-circle" 
                                 src="{{ auth()->user()->profile_image }}" 
                                 alt="User profile picture"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img class="profile-user-img img-fluid img-circle" 
                                 src="https://via.placeholder.com/150?text={{ substr(auth()->user()->name, 0, 1) }}" 
                                 alt="User profile picture">
                        @endif
                    </div>

                    <h3 class="profile-username text-center mt-3">{{ auth()->user()->name }}</h3>
                    <p class="text-muted text-center">Administrator</p>
                    <p class="text-center">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Kolom Form Upload -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-camera"></i> Upload Foto Profil
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="icon fas fa-check"></i> {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="icon fas fa-ban"></i> {{ session('error') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('admin.profile.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Pilih Foto Baru</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="profile_image" class="custom-file-input" id="profileImage" accept="image/*" required>
                                    <label class="custom-file-label" for="profileImage">Pilih file...</label>
                                </div>
                            </div>
                            @error('profile_image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <small class="form-text text-muted">
                                Format yang didukung: JPG, PNG, GIF. Ukuran maksimal: 2MB
                            </small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Foto
                        </button>
                        <a href="{{ route('pekerja.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i> Informasi Akun
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Nama</th>
                            <td>: {{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>: Administrator</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Sejak</th>
                            <td>: {{ auth()->user()->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Update label file input dengan nama file yang dipilih
$('#profileImage').on('change', function() {
    var fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').html(fileName);
});
</script>
@endpush