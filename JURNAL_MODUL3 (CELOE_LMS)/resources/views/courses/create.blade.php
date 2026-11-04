@extends('layouts.app')

@section('title', 'Tambah Mata Kuliah Baru')

@section('content')
<div style="max-width: 760px; margin: 0 auto;">
    <div style="margin-bottom: 1.25rem;">
        <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-sm">
            Kembali ke Daftar Mata Kuliah
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <div>
                <h1 class="card-title">Tambah Mata Kuliah Baru</h1>
                <p class="card-subtitle">Buat mata kuliah baru yang akan Anda ampu pada semester aktif ini.</p>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.25rem;">
                    <!-- Kode Mata Kuliah -->
                    <div class="form-group">
                        <label for="kode_mk" class="form-label">
                            Kode Mata Kuliah <span style="color: var(--danger, #dc2626);">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="kode_mk" 
                            id="kode_mk" 
                            class="form-control @error('kode_mk') is-invalid @enderror" 
                            value="{{ old('kode_mk') }}" 
                            placeholder="Contoh: CSH3B3"
                        >
                        @error('kode_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nama Mata Kuliah -->
                    <div class="form-group">
                        <label for="nama_mk" class="form-label">
                            Nama Mata Kuliah <span style="color: var(--danger, #dc2626);">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nama_mk" 
                            id="nama_mk" 
                            class="form-control @error('nama_mk') is-invalid @enderror" 
                            value="{{ old('nama_mk') }}" 
                            placeholder="Contoh: Pemrograman Aplikasi Web"
                        >
                        @error('nama_mk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-top: 1rem;">
                    <!-- SKS -->
                    <div class="form-group">
                        <label for="sks" class="form-label">
                            Jumlah SKS <span style="color: var(--danger, #dc2626);">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="sks" 
                            id="sks" 
                            min="1" 
                            max="6" 
                            class="form-control @error('sks') is-invalid @enderror" 
                            value="{{ old('sks') }}" 
                            placeholder="1 - 6"
                        >
                        @error('sks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Semester -->
                    <div class="form-group">
                        <label for="semester" class="form-label">
                            Semester Perkuliahan <span style="color: var(--danger, #dc2626);">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="semester" 
                            id="semester" 
                            class="form-control @error('semester') is-invalid @enderror" 
                            value="{{ old('semester', 'Ganjil 2026/2027') }}" 
                            placeholder="Contoh: Ganjil 2026/2027"
                        >
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="margin-top: 1rem;">
                    <!-- Dosen Pengampu (Otomatis akun Dosen yang login) -->
                    <div class="form-group">
                        <label class="form-label">
                            Dosen Pengampu Kelas
                        </label>
                        <div style="padding: 0.625rem 0.875rem; background-color: var(--slate-50); border: 1px solid var(--slate-200); border-radius: 6px; font-size: 0.875rem; color: var(--slate-800); font-weight: 600;">
                            {{ Auth::user()->name }} ({{ Auth::user()->nomor_induk ?: Auth::user()->email }})
                        </div>
                        <div class="form-help">Mata kuliah ini akan otomatis tercatat di bawah akun Dosen Anda.</div>
                    </div>

                    <!-- Deskripsi / Silabus -->
                    <div class="form-group">
                        <label for="deskripsi" class="form-label">
                            Silabus / Deskripsi Mata Kuliah
                        </label>
                        <textarea 
                            name="deskripsi" 
                            id="deskripsi" 
                            rows="4" 
                            class="form-control @error('deskripsi') is