@extends('layouts.app')

@section('title', 'Login - Portfolio & BookStore')

@section('content')
<div class="custom-card" style="max-width: 28rem; margin: 2rem auto; padding: 2.5rem;">
    <h2 style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; text-align: center;">Selamat Datang</h2>
    <p style="color: #64748b; text-align: center; font-size: 0.9rem; margin-bottom: 1.5rem;">Silakan login ke akun Anda.</p>

    @if (session('success'))
    <div style="background-color: #f0fdf4; border: 1px solid #86efac; color: #166534; padding: 0.75rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.85rem;">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; padding: 0.75rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.85rem;">
        @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
    </div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" required>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; text-align: center; border: none; cursor: pointer; margin-top: 0.5rem;">Login</button>
    </form>

    <p style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: #64748b;">
        Belum punya akun? <a href="/register" style="color: #2563eb; font-weight: 600; text-decoration: none;">Daftar di sini</a>
    </p>
</div>
@endsection