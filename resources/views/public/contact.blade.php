@extends('layouts.app')

@section('title', 'Contact - Portfolio & BookStore')

@section('content')
<div class="custom-card" style="max-width: 32rem; margin: 0 auto; padding: 2.5rem;">
    <h1 style="font-size: 2rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; text-align: center;">Hubungi Saya</h1>
    <p style="color: #64748b; text-align: center; font-size: 0.95rem; margin-bottom: 2rem;">Punya pertanyaan atau ingin berkolaborasi? Silakan isi form di bawah.</p>

    <form action="#" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-input" placeholder="Masukkan nama Anda...">
        </div>
        <div class="form-group">
            <label class="form-label">Alamat Email</label>
            <input type="email" class="form-input" placeholder="nama@email.com">
        </div>
        <div class="form-group">
            <label class="form-label">Pesan</label>
            <textarea rows="4" class="form-input" placeholder="Tuliskan pesan atau keperluan Anda..." style="resize: vertical;"></textarea>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; text-align: center; cursor: pointer; border: none;">Kirim Pesan</button>
    </form>
</div>
@endsection