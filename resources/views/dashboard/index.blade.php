@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Tambahan dan override style modern */
    .dashboard-header-card {
        max-width: 650px;
        margin: 3.2rem auto 2.2rem auto;
        background: rgba(255,255,255,0.92);
        border-radius: 28px;
        box-shadow: 0 8px 32px rgba(99,102,241,0.15), 0 2px 8px rgba(0,0,0,0.04);
        padding: 0;
        border: none;
        text-align: left;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(8px);
    }
    .dashboard-header-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 2.2rem 2.2rem 1.2rem 2.2rem;
        position: relative;
        z-index: 2;
    }
    .dashboard-user-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366f1 60%, #06b6d4 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        box-shadow: 0 2px 12px rgba(99,102,241,0.13);
        font-size: 2.1rem;
        color: #fff;
    }
    .dashboard-title {
        font-size: 2rem;
        font-weight: 900;
        color: #22223b;
        margin-bottom: 0.1rem;
        letter-spacing: 0.5px;
    }
    .dashboard-info {
        font-size: 1.13rem;
        color: #06b6d4;
        font-weight: 600;
        margin-bottom: 0.2rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .dashboard-status {
        font-size: 1.01rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .dashboard-status .verified {
        color: #10b981;
        font-weight: 700;
        margin-left: 0.3em;
    }
    .dashboard-status .not-verified {
        color: #ef4444;
        font-weight: 700;
        margin-left: 0.3em;
    }
    /* Jam modern pojok kanan atas */
    .dashboard-clock-absolute, .dashboard-clock-wrap { display: none !important; }
    .dashboard-clock-modern {
        position: absolute;
        top: 1.2rem;
        right: 2.2rem;
        z-index: 10;
        text-align: right;
        font-family: 'Courier New', monospace;
        font-size: 1.13rem;
        font-weight: 700;
        color: #6366f1;
        letter-spacing: 1.5px;
    }
    .dashboard-clock-modern .dashboard-date {
        font-size: 0.98rem;
        font-weight: 600;
        color: #06b6d4;
        letter-spacing: 0.5px;
    }
    /* Card buku modern */
    .dashboard-books-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1.2rem;
        max-width: 1200px;
        margin: 0 auto 2.5rem auto;
        padding: 0;
    }
    @media (max-width: 1100px) {
        .dashboard-books-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 900px) {
        .dashboard-books-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 700px) {
        .dashboard-books-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 500px) {
        .dashboard-books-grid { grid-template-columns: 1fr; }
    }
    .dashboard-book-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        transition: transform 0.18s, box-shadow 0.18s;
        display: flex;
        flex-direction: column;
        min-width: 0;
        min-height: 270px;
        padding: 0;
        border: none;
        align-items: stretch;
    }
    .dashboard-book-card:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 8px 32px rgba(99,102,241,0.13);
    }
    .dashboard-book-image {
        width: 100%;
        aspect-ratio: 3/4;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
        overflow: hidden;
    }
    .dashboard-book-thumb {
        width: 100%;
        height: auto;
        max-height: 100%;
        object-fit: contain;
        padding: 0.5rem;
        background-color: #f9fafb;
        border-radius: 0;
        box-shadow: none;
        margin-bottom: 0;
        transition: transform 0.18s;
    }
    .dashboard-book-content {
        padding: 1rem 1rem 0.7rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        flex: 1;
    }
    .dashboard-book-title {
        font-size: 1.05rem;
        font-weight: 700;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        color: #4338ca;
        margin-bottom: 0.1rem;
        letter-spacing: 0.1px;
    }
    .dashboard-book-author {
        color: #06b6d4;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0.1rem;
    }
    .dashboard-book-rating {
        font-size: 1rem;
        color: #fbbf24;
        font-weight: 700;
        margin-bottom: 0.1rem;
    }
    .dashboard-book-rating .star-gray {
        color: #e5e7eb;
    }
    .dashboard-book-footer {
        margin-top: auto;
        display: flex;
        justify-content: flex-end;
        font-size: 0.9rem;
        color: #6b7280;
        align-items: center;
        gap: 0.5rem;
    }
    .dashboard-book-status {
        padding: 0.25rem 0.7rem;
        background: #06b6d4;
        color: white;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-left: 0.2em;
        box-shadow: 0 1px 4px rgba(99,102,241,0.10);
    }
    .dashboard-book-status.baru {
        background: #6366f1;
    }
    @media (max-width: 600px) {
        .dashboard-books-grid { grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.7rem; }
        .dashboard-book-content { padding: 0.7rem 0.5rem 0.5rem 0.5rem; }
    }
    @media (max-width: 700px) {
        .dashboard-header-card { padding: 1.2rem 0.5rem; }
        .dashboard-books-title, .dashboard-books-grid { max-width: 100%; padding: 0 0.5rem; }
        .dashboard-header-content { flex-direction: column; align-items: flex-start; padding: 1.2rem 1rem 1.2rem 1rem; }
        .dashboard-tip-quote { padding: 1rem 0.5rem; }
    }
</style>


<div class="dashboard-clock-modern">
    <span id="clock"></span><br>
    <span class="dashboard-date" id="date"></span>
</div>


<div class="dashboard-header-card">
    <div class="dashboard-header-bg"></div>
    <div class="dashboard-header-content">
        <div class="dashboard-user-icon">
            <svg width="48" height="48" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="8.5" r="4.5" fill="#fff" stroke="#6366f1" stroke-width="2"/><ellipse cx="12" cy="17.5" rx="7.5" ry="4.5" fill="#fff" stroke="#06b6d4" stroke-width="2"/></svg>
        </div>
        <div style="flex:1;text-align:left;min-width:0;">
            <div class="dashboard-title">Halo, <span style="color:#6366f1;font-weight:900;">{{ $user->name }}</span>!</div>
            <div class="dashboard-info"><svg width="18" height="18" fill="none" stroke="#06b6d4" stroke-width="2" style="vertical-align:middle;margin-right:4px;" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6l-10 7L2 6"/></svg> {{ $user->email }}</div>
            <div class="dashboard-status">
                <svg width="18" height="18" fill="none" stroke="#6366f1" stroke-width="2" style="vertical-align:middle;margin-right:4px;" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2l4-4"/></svg>
                Status:
                @if($user->hasVerifiedEmail())
                    <span class="verified">Terverifikasi <span style="font-size:1.1em;">✅</span></span>
                @else
                    <span class="not-verified">Belum Verifikasi <span style="font-size:1.1em;">❌</span></span>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="dashboard-tip dashboard-tip-quote" style="margin-bottom:1.5rem;background:linear-gradient(90deg,#e0e7ff 0%,#f0f4ff 100%);color:#6366f1;border-radius:16px;padding:1.3rem 2rem 1.1rem 2rem;font-size:1.18rem;text-align:center;box-shadow:0 2px 12px rgba(99,102,241,0.09);font-style:italic;font-weight:700;max-width:650px;margin-left:auto;margin-right:auto;position:relative;overflow:hidden;">
    <svg width="32" height="32" fill="none" stroke="#6366f1" stroke-width="2" style="position:absolute;top:18px;left:18px;opacity:0.13;z-index:0;" viewBox="0 0 24 24"><path d="M9 7h.01M15 7h.01M8 13h8a4 4 0 0 1-8 0Z"/><circle cx="12" cy="12" r="10"/></svg>
    <span class="tip-quote" style="font-size:1.22rem;font-weight:800;color:#06b6d4;display:block;margin-bottom:0.4em;position:relative;z-index:1;">"Buku adalah jendela dunia, dan kamu penulis kisahmu sendiri."</span>
    <span style="font-size:1.04rem;font-weight:500;display:block;margin-top:0.5em;position:relative;z-index:1;">Jaga keamanan akunmu, gunakan password yang kuat, dan jangan bagikan ke siapapun.<br>
    Selamat berkarya & berbagi buku di <b>FANBook</b>!</span>
</div>

<div class="dashboard-books-title" style="display:flex;align-items:center;gap:0.7rem;max-width:900px;margin:2.7rem auto 1.2rem auto;padding:0.7rem 1.2rem 0.7rem 1.2rem;background:linear-gradient(90deg,#f0f4ff 0%,#e0e7ff 100%);border-radius:12px;box-shadow:0 2px 8px rgba(99,102,241,0.06);font-size:1.22rem;font-weight:800;color:#4338ca;letter-spacing:0.4px;">
    <svg width="28" height="28" fill="none" stroke="#6366f1" stroke-width="2.2" style="vertical-align:middle;" viewBox="0 0 24 24">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
        <path d="M20 22V6a2 2 0 0 0-2-2H6.5A2.5 2.5 0 0 0 4 6.5v13"/>
    </svg>
    <span>Buku yang Kamu Upload</span>
    <span style="font-size:0.97rem;font-weight:500;color:#6366f1;margin-left:0.7em;opacity:0.85;">(Hanya kamu yang bisa melihat daftar ini)</span>
</div>

<div class="dashboard-books-grid">
    @forelse($user->books as $book)
        <div class="dashboard-book-card">
            <div class="dashboard-book-image">
                <img class="dashboard-book-thumb" src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail Buku">
            </div>
            <div class="dashboard-book-content">
                <div class="dashboard-book-title">{{ $book->title }}</div>
                <div class="dashboard-book-author">Penulis: {{ $book->author }}</div>
                <div class="dashboard-book-rating">
                    @for ($star = 1; $star <= 5; $star++)
                        @if ($star <= $book->rating)
                            <span>&#9733;</span>
                        @else
                            <span class="star-gray">&#9733;</span>
                        @endif
                    @endfor
                    <span style="color:#6b7280;font-size:0.97em;">({{ $book->rating }})</span>
                </div>
                <div class="dashboard-book-footer">
                    <span class="dashboard-book-status{{ $book->rating < 4 ? ' baru' : '' }}">
                        {{ $book->rating >= 4 ? 'Populer' : 'Baru' }}
                    </span>
                </div>
            </div>
        </div>
    @empty
        <div style="color:#64748b;text-align:center;font-size:1.1rem;padding:2.2rem 0;grid-column:1/-1;">
            <svg width="48" height="48" fill="none" viewBox="0 0 24 24" style="margin-bottom:0.5em;"><rect x="3" y="6" width="18" height="12" rx="3" fill="#e0e7ff"/><rect x="7" y="10" width="10" height="4" rx="1" fill="#6366f1" fill-opacity="0.13"/></svg><br>
            Belum ada buku yang kamu upload.<br>
            Yuk, mulai berbagi buku pertamamu!
        </div>
    @endforelse
</div>

<script>
    function updateClock() {
        const now = new Date();
        const jam = now.getHours().toString().padStart(2, '0');
        const menit = now.getMinutes().toString().padStart(2, '0');
        const detik = now.getSeconds().toString().padStart(2, '0');
        document.getElementById('clock').textContent = `${jam}:${menit}:${detik}`;

        const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const tgl = now.getDate();
        const bln = bulan[now.getMonth()];
        const thn = now.getFullYear();
        const hariStr = hari[now.getDay()];
        document.getElementById('date').textContent = `${hariStr}, ${tgl} ${bln} ${thn}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection
