@extends('layouts.app')

@section('title', 'Edit Data Pekerja')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pekerja.index') }}">Daftar Pekerja</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i> Edit Data Pekerja
                    </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('pekerja.update', $pekerja->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama', $pekerja->nama) }}"
                                   placeholder="Masukkan Nama Lengkap">
                            @error('nama') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="umur">Umur <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('umur') is-invalid @enderror" 
                                           id="umur" 
                                           name="umur" 
                                           value="{{ old('umur', $pekerja->umur) }}"
                                           placeholder="Min. 17">
                                    @error('umur') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                                            id="jenis_kelamin" 
                                            name="jenis_kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin', $pekerja->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $pekerja->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin') 
                                        <div class="invalid-feedback">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                      id="alamat" 
                                      name="alamat" 
                                      rows="3"
                                      placeholder="Masukkan Alamat Lengkap">{{ old('alamat', $pekerja->alamat) }}</textarea>
                            @error('alamat') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_hp">Nomor HP <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" 
                                               class="form-control @error('nomor_hp') is-invalid @enderror" 
                                               id="nomor_hp" 
                                               name="nomor_hp" 
                                               value="{{ old('nomor_hp', $pekerja->nomor_hp) }}"
                                               placeholder="08123456789">
                                        @error('nomor_hp') 
                                            <div class="invalid-feedback">{{ $message }}</div> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $pekerja->email) }}"
                                               placeholder="email@contoh.com">
                                        @error('email') 
                                            <div class="invalid-feedback">{{ $message }}</div> 
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="skill">Skill / Keahlian <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('skill') is-invalid @enderror" 
                                      id="skill" 
                                      name="skill" 
                                      rows="3"
                                      placeholder="Contoh: Tukang kayu, service AC, bersih-bersih, dll">{{ old('skill', $pekerja->skill) }}</textarea>
                            @error('skill') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                            <small class="form-text text-muted">Pisahkan dengan koma jika lebih dari satu keahlian</small>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('pekerja.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection