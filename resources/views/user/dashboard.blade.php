@extends('layouts.app')

@section('title', 'Dashboard User - BookStore')

@section('content')
<div class="dashboard-stack">

    <!-- Bagian Atas: Profil & Statistik Singkat -->
    <div class="custom-card dashboard-heading">
        <div>
            <h2 style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-bottom: 0.25rem;">Dashboard User</h2>
            <p style="color: #64748b; font-size: 0.95rem;">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>! Berikut ringkasan aktivitas dan katalog buku Anda.</p>
        </div>
        <div>
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" style="background-color: #ef4444; color: white; padding: 0.6rem 1.25rem; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background-color 0.2s;">Logout</button>
            </form>
        </div>
    </div>

    <!-- Kotak Statistik Singkat -->
    <div class="stats-grid">
        <div class="custom-card" style="padding: 1.5rem; border-left: 4px solid #2563eb;">
            <p style="font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Total Judul Buku</p>
            <h3 style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 0.5rem;">{{ number_format($stats['titles']) }}</h3>
        </div>
        <div class="custom-card" style="padding: 1.5rem; border-left: 4px solid #10b981;">
            <p style="font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Total Stok Buku</p>
            <h3 style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 0.5rem;">{{ number_format($stats['stock']) }}</h3>
        </div>
        <div class="custom-card" style="padding: 1.5rem; border-left: 4px solid #f59e0b;">
            <p style="font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Kategori Buku</p>
            <h3 style="font-size: 1.75rem; font-weight: 800; color: #1e293b; margin-top: 0.5rem;">{{ number_format($stats['categories']) }}</h3>
        </div>
    </div>

    <!-- Bagian Utama: Katalog Buku dalam Bentuk Grid -->
    <div>
        <div style="margin-bottom: 1.5rem;">
            <h3 style="font-size: 1.5rem; font-weight: 700; color: #1e293b;">Katalog Buku Pilihan</h3>
            <p style="color: #64748b; font-size: 0.95rem;">Jelajahi berbagai referensi buku pemrograman dan pengembangan teknologi.</p>
        </div>

        <div class="book-grid">
            @foreach($books as $book)
            <article class="custom-card book-card">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span class="badge">{{ $book->category->name }}</span>
                        <span style="font-size: 0.85rem; color: #64748b; font-weight: 600;">Stok: {{ number_format($book->stock) }}</span>
                    </div>
                    <h4 style="font-size: 1.15rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.4;">{{ $book->title }}</h4>
                    <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 1rem;">Penulis: {{ $book->author }}</p>
                    @if ($book->description)
                    <p class="book-description">{{ $book->description }}</p>
                    @endif
                </div>
                <div style="border-top: 1px solid #f1f5f9; padding-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-weight: 700; color: #2563eb; font-size: 1.05rem;">Rp {{ number_format((float) $book->price, 0, ',', '.') }}</span>
                </div>
            </article>
            @endforeach
        </div>
        @if ($books->isEmpty())
        <div class="custom-card empty-state">
            <h4>Belum ada buku di katalog</h4>
            <p>Admin akan menambahkan buku ke katalog ini.</p>
        </div>
        @endif
        {{ $books->links() }}
    </div>

</div>
@endsection