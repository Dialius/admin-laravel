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
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pekerja</td>
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