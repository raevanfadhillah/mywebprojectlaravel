@extends('layouts.app')

@section('title', 'Panel Admin - BookStore')

@section('content')
<div class="dashboard-stack">
    <div class="custom-card dashboard-heading">
        <div>
            <h2>Panel Admin</h2>
            <p>Halo, <strong>{{ Auth::user()->name }}</strong>. Kelola kategori dan inventaris buku dari sini.</p>
        </div>
        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-danger">Logout</button>
        </form>
    </div>

    @if (session('success'))
    <div class="notice notice-success" role="status">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="notice notice-error" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="custom-card">
        <div class="section-heading">
            <div>
                <h3>Kategori Buku</h3>
                <p>Tambahkan, ubah, atau hapus kategori katalog.</p>
            </div>
            <span class="badge">{{ $categories->count() }} kategori</span>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="inline-create-form">
            @csrf
            <div class="form-group">
                <label class="form-label" for="category-name">Nama kategori</label>
                <input class="form-input" id="category-name" type="text" name="name" value="{{ old('name') }}" maxlength="255" required>
            </div>
            <button type="submit" class="btn-primary">Tambah Kategori</button>
        </form>

        @if ($categories->isNotEmpty())
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Jumlah Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="table-edit-form">
                                @csrf
                                @method('PUT')
                                <input class="form-input" type="text" name="name" value="{{ $category->name }}" maxlength="255" aria-label="Nama kategori {{ $category->name }}" required>
                                <button type="submit" class="btn-outline btn-small">Simpan</button>
                            </form>
                        </td>
                        <td>{{ number_format($category->books_count) }}</td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Kategori yang masih dipakai buku tidak dapat dihapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger btn-small">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="empty-state">Belum ada kategori. Tambahkan kategori sebelum memasukkan buku.</p>
        @endif
    </section>

    <section class="custom-card">
        <div class="section-heading">
            <div>
                <h3>Tambah Buku</h3>
                <p>Isi data inventaris buku untuk menampilkannya di katalog user.</p>
            </div>
        </div>

        @if ($categories->isEmpty())
        <p class="empty-state">Buat kategori terlebih dahulu untuk dapat menambahkan buku.</p>
        @else
        <form action="{{ route('admin.books.store') }}" method="POST" class="book-form">
            @csrf
            <div class="form-group">
                <label class="form-label" for="book-title">Judul</label>
                <input class="form-input" id="book-title" type="text" name="title" value="{{ old('title') }}" maxlength="255" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="book-author">Penulis</label>
                <input class="form-input" id="book-author" type="text" name="author" value="{{ old('author') }}" maxlength="255" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="book-category">Kategori</label>
                <select class="form-input" id="book-category" name="category_id" required>
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="book-price">Harga (Rp)</label>
                <input class="form-input" id="book-price" type="number" name="price" value="{{ old('price') }}" min="0" max="9999999999.99" step="0.01" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="book-stock">Stok</label>
                <input class="form-input" id="book-stock" type="number" name="stock" value="{{ old('stock', 0) }}" min="0" step="1" required>
            </div>
            <div class="form-group form-group-wide">
                <label class="form-label" for="book-description">Deskripsi</label>
                <textarea class="form-input" id="book-description" name="description" rows="4" maxlength="5000">{{ old('description') }}</textarea>
            </div>
            <div class="form-group-wide">
                <button type="submit" class="btn-primary">Simpan Buku</button>
            </div>
        </form>
        @endif
    </section>

    <section class="custom-card">
        <div class="section-heading">
            <div>
                <h3>Inventaris Buku</h3>
                <p>{{ number_format($books->total()) }} judul buku tersimpan.</p>
            </div>
        </div>

        @if ($books->isNotEmpty())
        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>Rp {{ number_format((float) $book->price, 0, ',', '.') }}</td>
                        <td>{{ number_format($book->stock) }}</td>
                        <td>
                            <div class="table-actions">
                                <a class="btn-outline btn-small" href="{{ route('admin.books.edit', $book) }}">Edit</a>
                                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini dari inventaris?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger btn-small">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $books->links() }}
        @else
        <p class="empty-state">Belum ada buku di inventaris.</p>
        @endif
    </section>
</div>
@endsection
