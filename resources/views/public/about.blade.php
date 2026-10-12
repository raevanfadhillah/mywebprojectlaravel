@extends('layouts.app')

@section('title', 'Tentang Saya - Portfolio & BookStore')

@section('content')
<div class="custom-card" style="max-width: 50rem; margin: 0 auto; padding: 2.5rem;">
    <h1 style="font-size: 2rem; font-weight: 800; color: #1e293b; margin-bottom: 1.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">Tentang Saya</h1>

    <div style="display: flex; flex-direction: column; gap: 1.25rem; color: #475569; line-height: 1.7; font-size: 1.05rem;">
        <p>
            Halo! Nama saya <strong>Raevan Fadhillah</strong> (Absen 26), seorang siswa kelas XI PPLG di <strong>SMKN 21 Jakarta</strong> yang memiliki antusiasme tinggi di dunia teknologi, khususnya rekayasa perangkat lunak dan pemrograman web.
        </p>
        <p>
            Website ini dirancang khusus sebagai proyek hybrid yang menggabungkan portofolio personal dan sistem manajemen toko buku (BookStore). Seluruh kode dibangun menggunakan arsitektur Laravel murni dan Blade Template untuk memastikan performa yang ringan, bersih, serta mudah dipahami secara mendalam.
        </p>

        <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin-top: 1rem;">Keahlian & Stack Teknologi</h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 0.5rem;">
            <div style="background-color: #f8fafc; padding: 1rem; border-radius: 8px; border: 1px solid #e2e8f0;">
                <h4 style="font-weight: 700; color: #2563eb; margin-bottom: 0.5rem;">Backend & Web</h4>
                <p style="font-size: 0.9rem; color: #64748b;">Laravel, PHP, MySQL, PostgreSQL, Next.js</p>
            </div>
            <div style="background-color: #f8fafc; padding: 1rem; border-radius: 8px; border: 1px solid #e2e8f0;">
                <h4 style="font-weight: 700; color: #2563eb; margin-bottom: 0.5rem;">Game Dev</h4>
                <p style="font-size: 0.9rem; color: #64748b;">Godot Engine, GDScript, OBB Logic</p>
            </div>
            <div style="background-color: #f8fafc; padding: 1rem; border-radius: 8px; border: 1px solid #e2e8f0;">
                <h4 style="font-weight: 700; color: #2563eb; margin-bottom: 0.5rem;">Tools & OS</h4>
                <p style="font-size: 0.9rem; color: #64748b;">Git, GitHub, VS Code, PowerShell, Windows</p>
            </div>
        </div>
    </div>
</div>
@endsection