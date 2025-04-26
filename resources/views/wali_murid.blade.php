<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wali Murid</title>
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
            max-width: 300px;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="card card-shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0"><i class="bi bi-person-vcard me-2"></i>Data Wali Murid</h2>
                    <a href="{{route('siswa.index')}}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali ke Siswa
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{session('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <a href="{{route('wali-murid.create')}}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Tambah Wali Murid
                    </a>
                    
                    <form method="GET" class="d-flex search-container" action="{{route('wali-murid.index')}}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari wali murid..." value="{{request('search')}}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama Wali</th>
                                <th>Kontak</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wali_murids as $wali_murid)
                                <tr>
                                    <td>{{$wali_murid->nama_wali}}</td>
                                    <td>{{$wali_murid->kontak}}</td>
                                    <td class="action-buttons text-center">
                                        <a href="{{route('wali-murid.edit', $wali_murid)}}" class="btn btn-sm btn-warning me-1" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('wali-murid.destroy', $wali_murid) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus data wali murid ini?')">
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
                    {{ $wali_murids->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>