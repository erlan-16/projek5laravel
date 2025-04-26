<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .card-shadow {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .action-buttons {
            white-space: nowrap;
        }
        .search-container {
            max-width: 400px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table th {
            white-space: nowrap;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="card card-shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0"><i class="bi bi-people-fill me-2"></i>Data Siswa</h2>
                    <div>
                        <a href="{{route('siswa.create')}}" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle"></i> Tambah Siswa
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <div class="d-flex gap-2">
                        <a href="{{route('kelas.index')}}" class="btn btn-outline-primary">
                            <i class="bi bi-journal-bookmark"></i> Kelola Kelas
                        </a>
                        <a href="{{route('wali-murid.index')}}" class="btn btn-outline-primary">
                            <i class="bi bi-person-vcard"></i> Kelola Wali Murid
                        </a>
                    </div>
                    
                    <form method="GET" class="d-flex search-container" action="{{route('siswa.index')}}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari siswa..." value="{{request('search')}}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark align-middle">
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Kelas</th>
                                <th>Wali Murid</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswas as $siswa)
                                <tr>
                                    <td>{{$siswa->NIS}}</td>
                                    <td>{{$siswa->nama_siswa}}</td>
                                    <td>{{$siswa->jenis_kelamin}}</td>
                                    <td>{{$siswa->tempat_lahir}}</td>
                                    <td>{{$siswa->tanggal_lahir}}</td>
                                    <td>{{$siswa->kelas->nama_kelas}}</td>
                                    <td>{{$siswa->wali_murid->nama_wali}}</td>
                                    <td class="action-buttons text-center">
                                        <a href="{{route('siswa.edit', $siswa)}}" class="btn btn-sm btn-warning me-1" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('siswa.destroy', $siswa) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data siswa ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <nav aria-label="Page navigation" class="mt-4">
                    {{ $siswas->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
