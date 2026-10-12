@extends('layouts.app')

@section('title', 'Edit Buku - Panel Admin')

@section('content')
<section class="custom-card admin-form-card">
    <div class="section-heading">
        <div>
            <h2>Edit Buku</h2>
            <p>Perbarui informasi inventaris buku.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn-outline">Kembali ke Panel</a>
    </div>

    @if ($errors->any())
    <div class="notice notice-error" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.books.update', $book) }}" method="POST" class="book-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label" for="book-title">Judul</label>
            <input class="form-input" id="book-title" type="text" name="title" value="{{ old('title', $book->title) }}" maxlength="255" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="book-author">Penulis</label>
            <input class="form-input" id="book-author" type="text" name="author" value="{{ old('author', $book->author) }}" maxlength="255" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="book-category">Kategori</label>
            <select class="form-input" id="book-category" name="category_id" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label" for="book-price">Harga (Rp)</label>
            <input class="form-input" id="book-price" type="number" name="price" value="{{ old('price', $book->price) }}" min="0" max="9999999999.99" step="0.01" required>
        </div>
        <div class="form-group">
            <label class="form-label" for="book-stock">Stok</label>
            <input class="form-input" id="book-stock" type="number" name="stock" value="{{ old('stock', $book->stock) }}" min="0" step="1" required>
        </div>
        <div class="form-group form-group-wide">
            <label class="form-label" for="book-description">Deskripsi</label>
            <textarea class="form-input" id="book-description" name="description" rows="5" maxlength="5000">{{ old('description', $book->description) }}</textarea>
        </div>
        <div class="form-group-wide form-actions">
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</section>
@endsection
