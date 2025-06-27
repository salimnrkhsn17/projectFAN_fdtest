<style>
    .books-form-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(99, 102, 241, 0.10);
        padding: 2.2rem 2.2rem 1.7rem 2.2rem;
        max-width: 440px;
        min-width: 280px;
        margin: 2.5rem auto;
        border: 1.5px solid #e0e7ff;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .books-form-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #4f46e5;
        margin-bottom: 1.3rem;
        text-align: center;
        letter-spacing: 0.5px;
    }
    .books-form-group {
        margin-bottom: 1.1rem;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }
    .books-form-label {
        font-weight: 600;
        color: #22223b;
        margin-bottom: 0.2rem;
        display: block;
    }
    .books-form-input, .books-form-textarea {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 1.04rem;
        color: #1f2937;
        background: #f8fafc;
        transition: border 0.18s;
        resize: none;
        margin-left: 0;
        box-sizing: border-box;
    }
    .books-form-input:focus, .books-form-textarea:focus {
        border-color: #6366f1;
        outline: none;
    }
    .books-form-btn {
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 0.8rem 1.3rem;
        font-size: 1.08rem;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(99, 102, 241, 0.10);
        transition: background 0.18s;
        width: 100%;
        margin-top: 0.7rem;
        letter-spacing: 0.2px;
    }
    .books-form-btn:hover {
        background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
    }
    @media (max-width: 600px) {
        .books-form-card {
            max-width: 98vw;
            padding: 1.1rem 0.5rem;
        }
    }
</style>
<div class="books-form-card">
    <div class="books-form-title">Tambah Buku Baru</div>
    <form id="form-create-book" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="books-form-group">
            <label class="books-form-label">Judul</label>
            <input type="text" name="title" class="books-form-input" value="{{ old('title') }}" required>
        </div>
        <div class="books-form-group">
            <label class="books-form-label">Penulis</label>
            <input type="text" name="author" class="books-form-input" value="{{ old('author') }}" required>
        </div>
        <div class="books-form-group">
            <label class="books-form-label">Deskripsi</label>
            <textarea name="description" class="books-form-textarea" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="books-form-group">
            <label class="books-form-label">Rating (1-5)</label>
            <input type="number" name="rating" class="books-form-input" min="1" max="5" value="{{ old('rating') }}" required>
        </div>
        <div class="books-form-group">
            <label class="books-form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="books-form-input">
        </div>
        <button type="submit" class="books-form-btn">Simpan</button>
    </form>
</div>
