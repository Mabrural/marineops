@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Backup & Restore</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('dashboard') }}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="#">Backup & Restore</a></li>
                </ul>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><div class="card-title">Backup Data</div></div>
                        <div class="card-body">
                            <p class="text-muted mb-0">Unduh arsip ZIP yang berisi seluruh data operasional (<code>database.json</code>) dan semua lampiran. Akun, password, hak akses, dan assignment user tidak dimasukkan.</p>
                        </div>
                        <div class="card-action">
                            <form action="{{ route('backup-restore.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i class="fas fa-download me-1"></i>Create & Download Backup</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-danger">
                        <div class="card-header"><div class="card-title text-danger">Reset All Data</div></div>
                        <div class="card-body">
                            <p class="text-danger">Menghapus seluruh data operasional dan lampiran. Tindakan ini tidak dapat dikembalikan. Akun, password, dan hak akses user tetap aman.</p>
                            <form id="resetDataForm" action="{{ route('backup-restore.reset') }}" method="POST">
                                @csrf
                                <label for="resetConfirmation" class="form-label fw-semibold">Ketik <code>RESET SEMUA DATA</code> untuk melanjutkan</label>
                                <input type="text" class="form-control mb-3" id="resetConfirmation" name="confirmation" autocomplete="off" required placeholder="RESET SEMUA DATA">
                                <button type="submit" id="resetDataButton" class="btn btn-danger" disabled><i class="fas fa-trash me-1"></i>Reset All Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header"><div class="card-title">Restore dari File ZIP</div></div>
                <div class="card-body border-bottom">
                    <form action="{{ route('backup-restore.restore') }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-end restore-form">
                        @csrf
                        <div class="col-md">
                            <label for="backup_file" class="form-label">Pilih file backup ZIP</label>
                            <input type="file" class="form-control" id="backup_file" name="backup_file" accept=".zip,application/zip" required>
                            <div class="form-text">Unggah file backup ZIP MarineOps untuk memulihkan data operasional dan seluruh lampiran.</div>
                        </div>
                        <div class="col-md-auto"><button type="submit" class="btn btn-warning"><i class="fas fa-upload me-1"></i>Upload & Restore</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.restore-form').forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (! window.confirm('Restore backup? Data operasional saat ini akan diganti. Akun dan akses user tidak akan diubah.')) {
                    event.preventDefault();
                }
            });
        });

        const resetConfirmation = document.getElementById('resetConfirmation');
        const resetDataButton = document.getElementById('resetDataButton');

        resetConfirmation.addEventListener('input', () => {
            resetDataButton.disabled = resetConfirmation.value !== 'RESET SEMUA DATA';
        });
    </script>
@endpush
