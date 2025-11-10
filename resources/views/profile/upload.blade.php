<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Picture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Upload Foto Profil</h4>
                    </div>
                    <div class="card-body">
                        
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Pilih Gambar</label>
                                <input type="file" name="profile_image" class="form-control" accept="image/*" required>
                                @error('profile_image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                        @if(auth()->user()->profile_image)
                            <div class="mt-4">
                                <h5>Foto Profil Saat Ini:</h5>
                                <img src="{{ auth()->user()->profile_image }}" alt="Profile" class="img-thumbnail" width="200">
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>