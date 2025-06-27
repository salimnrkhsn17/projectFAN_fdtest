@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<style>
    .profile-container {
        max-width: 480px;
        margin: 0 auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(99,102,241,0.10);
        padding: 2.2rem 2rem 2.5rem 2rem;
        position: relative;
        overflow: hidden;
    }
    .profile-avatar {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 1.2rem;
    }
    .profile-avatar-img {
        width: 92px;
        height: 92px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #6366f1;
        background: #f3f4f6;
        box-shadow: 0 2px 12px rgba(99,102,241,0.10);
        margin-bottom: 0.7rem;
    }
    .profile-avatar-name {
        font-size: 1.18rem;
        font-weight: 700;
        color: #22223b;
        margin-bottom: 0.1rem;
        text-align: center;
    }
    .profile-avatar-email {
        font-size: 0.98rem;
        color: #6366f1;
        text-align: center;
        margin-bottom: 0.2rem;
        word-break: break-all;
    }
    .profile-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #22223b;
        margin-bottom: 1.7rem;
        letter-spacing: 0.5px;
        text-align: center;
    }
    .profile-form label {
        font-weight: 600;
        color: #6366f1;
        margin-bottom: 0.5rem;
        display: block;
        font-size: 1.05rem;
    }
    .profile-form input[type="text"],
    .profile-form input[type="password"] {
        width: 100%;
        padding: 0.8rem 1.1rem;
        border: 1.5px solid #e0e7ff;
        border-radius: 10px;
        font-size: 1.08rem;
        background: #f8fafc;
        margin-bottom: 1.2rem;
        transition: border 0.18s;
    }
    .profile-form input[type="text"]:focus,
    .profile-form input[type="password"]:focus {
        border-color: #6366f1;
        outline: none;
    }
    .profile-form .profile-btn {
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 0.8rem 1.7rem;
        font-size: 1.08rem;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        transition: background 0.18s;
        display: block;
        width: 100%;
        margin-bottom: 1.2rem;
    }
    .profile-form .profile-btn:hover {
        background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
    }
    .profile-form .profile-link-reset {
        display: block;
        text-align: center;
        color: #06b6d4;
        font-weight: 600;
        margin-top: 1.2rem;
        text-decoration: none;
        font-size: 1.05rem;
        transition: color 0.18s;
    }
    .profile-form .profile-link-reset:hover {
        color: #6366f1;
        text-decoration: underline;
    }
    .profile-success {
        color: #10b981;
        background: #d1fae5;
        border-radius: 8px;
        padding: 0.7rem 1rem;
        margin-bottom: 1.2rem;
        font-size: 1rem;
        text-align: center;
    }
    .profile-error {
        color: #ef4444;
        background: #fee2e2;
        border-radius: 8px;
        padding: 0.7rem 1rem;
        margin-bottom: 1.2rem;
        font-size: 1rem;
        text-align: center;
    }
    .profile-divider {
        height: 1px;
        background: linear-gradient(90deg, #e0e7ff 0%, #f3f4f6 100%);
        margin: 2.1rem 0 1.7rem 0;
        border: none;
    }
</style>
<div class="profile-container">
    <div class="profile-avatar">
        <img class="profile-avatar-img" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6366f1&color=fff&size=180" alt="Avatar">
        <div class="profile-avatar-name">{{ $user->name }}</div>
        <div class="profile-avatar-email">{{ $user->email }}</div>
    </div>
    <div class="profile-title">Profil Saya</div>
    <div id="profile-success" class="profile-success" style="display:none;"></div>
    <div id="profile-error" class="profile-error" style="display:none;"></div>
    @if(session('success'))
        <div class="profile-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="profile-error">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    <form class="profile-form" id="profile-form" method="POST" action="{{ route('profile.update') }}">
        @csrf
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="off">
        <button type="submit" class="profile-btn">Simpan Perubahan</button>
    </form>
    <hr class="profile-divider">
    <button id="show-password-modal" type="button" class="profile-btn" style="margin-bottom:0.5rem;display:flex;align-items:center;justify-content:center;gap:0.6em;">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin-right:0.3em;"><path d="M12 17v1m-6 2h12a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2h-1V7a5 5 0 0 0-10 0v2H6a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2z"/></svg>
        Ganti Kata Sandi
    </button>
    <!-- Modal Ganti Sandi -->
    <div id="password-modal-backdrop" style="display:none;position:fixed;z-index:1000;top:0;left:0;width:100vw;height:100vh;background:rgba(30,41,59,0.18);backdrop-filter:blur(2.5px);"></div>
    <div id="password-modal" style="display:none;position:fixed;z-index:1010;top:0;left:0;width:100vw;height:100vh;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:18px;box-shadow:0 8px 32px rgba(99,102,241,0.18);padding:2.3rem 2.1rem 2.1rem 2.1rem;max-width:370px;width:95vw;margin:auto;position:relative;display:flex;flex-direction:column;align-items:center;">
            <button id="close-password-modal" type="button" style="position:absolute;top:16px;right:16px;background:none;border:none;font-size:1.7rem;color:#6366f1;cursor:pointer;line-height:1;">&times;</button>
            <div style="font-size:1.22rem;font-weight:800;color:#22223b;text-align:center;margin-bottom:1.3rem;letter-spacing:0.2px;">Ganti Kata Sandi</div>
            <form class="profile-form" id="password-form" method="POST" action="{{ route('profile.password') }}" autocomplete="off" style="width:100%;max-width:320px;">
                @csrf
                <div style="margin-bottom:1.1rem;">
                    <label for="current_password" style="margin-bottom:0.4rem;">Kata Sandi Lama</label>
                    <input type="password" id="current_password" name="current_password" required autocomplete="off" style="margin-bottom:0;">
                </div>
                <div style="margin-bottom:1.1rem;">
                    <label for="password" style="margin-bottom:0.4rem;">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" required autocomplete="off" style="margin-bottom:0;">
                </div>
                <div style="margin-bottom:1.3rem;">
                    <label for="password_confirmation" style="margin-bottom:0.4rem;">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="off" style="margin-bottom:0;">
                </div>
                <button type="submit" class="profile-btn" style="margin-bottom:0;background:linear-gradient(90deg,#6366f1 0%,#06b6d4 100%);font-size:1.08rem;">Simpan Kata Sandi</button>
            </form>
            <div id="password-success" class="profile-success" style="display:none;margin-top:1.1rem;"></div>
            <div id="password-error" class="profile-error" style="display:none;margin-top:1.1rem;"></div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Modal logic
    const showModalBtn = document.getElementById('show-password-modal');
    const modal = document.getElementById('password-modal');
    const backdrop = document.getElementById('password-modal-backdrop');
    const closeModalBtn = document.getElementById('close-password-modal');
    function openModal() {
        modal.style.display = 'flex';
        backdrop.style.display = 'block';
        setTimeout(() => {modal.querySelector('input[type="password"]').focus();}, 200);
    }
    function closeModal() {
        modal.style.display = 'none';
        backdrop.style.display = 'none';
        // reset form and feedback
        modal.querySelector('form').reset();
        document.getElementById('password-success').style.display = 'none';
        document.getElementById('password-error').style.display = 'none';
    }
    showModalBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
    document.addEventListener('keydown', function(e){
        if(e.key === 'Escape' && modal.style.display === 'flex') closeModal();
    });

    // AJAX update nama
    document.getElementById('profile-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        let data = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': data.get('_token'),
            },
            body: data
        })
        .then(res => res.json())
        .then(res => {
            let success = document.getElementById('profile-success');
            let error = document.getElementById('profile-error');
            if(res.success) {
                success.textContent = res.success;
                success.style.display = 'block';
                error.style.display = 'none';
                // update name in avatar
                document.querySelector('.profile-avatar-name').textContent = data.get('name');
                document.querySelector('.profile-avatar-img').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(data.get('name'))}&background=6366f1&color=fff&size=180`;
            } else if(res.error) {
                // hanya tampilkan error jika memang ada error validasi/gagal update
                if(res.error !== 'no_password_change') {
                    error.textContent = res.error;
                    error.style.display = 'block';
                    success.style.display = 'none';
                } else {
                    // error dummy dari backend karena password kosong, diabaikan
                    error.style.display = 'none';
                }
            } else if(res.errors) {
                error.innerHTML = Object.values(res.errors).join('<br>');
                error.style.display = 'block';
                success.style.display = 'none';
            }
        })
        .catch(() => {
            let error = document.getElementById('profile-error');
            error.textContent = 'Terjadi kesalahan. Coba lagi.';
            error.style.display = 'block';
        });
    });

    // AJAX ganti password (modal)
    document.getElementById('password-form').addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        let data = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': data.get('_token'),
            },
            body: data
        })
        .then(res => res.json())
        .then(res => {
            let success = document.getElementById('password-success');
            let error = document.getElementById('password-error');
            if(res.success) {
                success.textContent = res.success;
                success.style.display = 'block';
                error.style.display = 'none';
                form.reset();
                setTimeout(closeModal, 1200);
            } else if(res.error) {
                error.textContent = res.error;
                error.style.display = 'block';
                success.style.display = 'none';
            } else if(res.errors) {
                error.innerHTML = Object.values(res.errors).join('<br>');
                error.style.display = 'block';
                success.style.display = 'none';
            }
        })
        .catch(() => {
            let error = document.getElementById('password-error');
            error.textContent = 'Terjadi kesalahan. Coba lagi.';
            error.style.display = 'block';
        });
    });
});
</script>
@endsection
