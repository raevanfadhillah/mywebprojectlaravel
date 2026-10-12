@extends('layouts.app')

@section('title', 'Home - Portofolio & BookStore')

@section('content')
<div style="display: flex; flex-direction: column; gap: 3rem;">

    <!-- Hero Section Standar Portofolio -->
    <div class="custom-card" style="padding: 3rem 2rem; text-align: center; background: linear-gradient(to bottom, #ffffff, #f8fafc);">
        <span class="badge" style="margin-bottom: 1rem; font-size: 0.85rem; padding: 0.4rem 1rem;">Full-Stack Web & Game Developer</span>
        <h1 style="font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 1rem; line-height: 1.2;">
            Halo, Saya <span style="color: #2563eb;">Raevan Fadhillah</span>
        </h1>
        <p style="font-size: 1.1rem; color: #64748b; max-width: 38rem; margin: 0 auto 2rem auto; line-height: 1.6;">
            Siswa SMK Negeri 21 Jakarta yang berfokus membangun aplikasi web interaktif berbasis Laravel serta pengembangan mekanik game menggunakan Godot Engine.
        </p>
        <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="/register" class="btn-primary">Mulai Bergabung</a>
            <a href="/about" class="btn-outline">Kenali Saya Lebih Dekat</a>
        </div>
    </div>

    <!-- Section Portofolio Unggulan -->
    <div>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.5rem;">
            <div>
                <h2 style="font-size: 1.75rem; font-weight: 700; color: #1e293b;">Featured Projects</h2>
                <p style="color: #64748b; font-size: 0.95rem;">Beberapa karya pilihan dari pengembangan web dan game.</p>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">

            <!-- Project 1 -->
            <div class="custom-card" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span class="badge">Godot Engine</span>
                        <span style="font-size: 0.85rem; color: #94a3b8;">Game Dev</span>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.75rem;">Project-Revenant_2</h3>
                    <p style="color: #64748b; font-size: 0.95rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Pengembangan game dengan implementasi sistem kontrol mekanik antarmuka (UI/UX) pause menu & pengaturan sensitivitas interaktif.
                    </p>
                </div>
                <div style="border-top: 1px solid #f1f5f9; padding-top: 1rem; font-size: 0.85rem; color: #64748b; font-weight: 500;">
                    Tech: GDScript, Godot Engine, Git Workflow
                </div>
            </div>

            <!-- Project 2 -->
            <div class="custom-card" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span class="badge">Laravel Web App</span>
                        <span style="font-size: 0.85rem; color: #94a3b8;">Web App</span>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.75rem;">Teh Rempuy Kasir</h3>
                    <p style="color: #64748b; font-size: 0.95rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Aplikasi sistem kasir berbasis web untuk manajemen transaksi penjualan produk wirausaha dengan arsitektur backend yang aman dan terstruktur.
                    </p>
                </div>
                <div style="border-top: 1px solid #f1f5f9; padding-top: 1rem; font-size: 0.85rem; color: #64748b; font-weight: 500;">
                    Tech: Laravel, MySQL, XAMPP, Blade Template
                </div>
            </div>

            <!-- Project 3 -->
            <div class="custom-card" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span class="badge">BookStore System</span>
                        <span style="font-size: 0.85rem; color: #94a3b8;">E-Commerce</span>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-bottom: 0.75rem;">Platform Katalog Buku</h3>
                    <p style="color: #64748b; font-size: 0.95rem; line-height: 1.5; margin-bottom: 1.5rem;">
                        Sistem manajemen perpustakaan dan toko buku digital dengan pemisahan hak akses ketat antara panel Admin CRUD dan Dashboard User.
                    </p>
                </div>
                <div style="border-top: 1px solid #f1f5f9; padding-top: 1rem; font-size: 0.85rem; color: #64748b; font-weight: 500;">
                    Tech: Native Auth, Relational Database, Blade
                </div>
            </div>

        </div>
    </div>

</div>
@endsection