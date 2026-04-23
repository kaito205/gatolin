@extends('layouts.app')

@section('styles')
<style>
    .auth-container { max-width: 450px; margin: 80px auto; padding: 40px; background: white; border-radius: 25px; box-shadow: var(--shadow-lg); text-align: center; }
    .auth-container h2 { font-family: 'Playfair Display', serif; color: var(--secondary); margin-bottom: 10px; font-size: 32px; }
    .auth-container p { color: var(--text-light); margin-bottom: 30px; font-size: 14px; }
    
    .auth-form { text-align: left; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-weight: 700; font-size: 13px; color: var(--secondary); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px; }
    .auth-input { width: 100%; padding: 15px 20px; border-radius: 12px; border: 1px solid #e5e7eb; background: #f9fafb; transition: var(--transition); font-family: inherit; }
    .auth-input:focus { outline: none; border-color: var(--primary); background: white; box-shadow: 0 0 0 4px var(--primary-light); }
    
    .auth-btn { width: 100%; padding: 15px; border-radius: 12px; background: var(--primary); color: white; border: none; font-weight: 700; font-size: 16px; cursor: pointer; transition: var(--transition); margin-top: 10px; }
    .auth-btn:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 10px 20px rgba(219, 112, 147, 0.2); }
    
    .auth-footer { margin-top: 25px; padding-top: 20px; border-top: 1px solid #f3f4f6; font-size: 14px; color: var(--text-light); }
    .auth-footer a { color: var(--primary); font-weight: 700; text-decoration: none; }
</style>
@endsection

@section('content')
<div class="auth-container">
    <h2>Selamat Datang</h2>
    <p>Silakan masuk untuk melanjutkan belanja Anda di Gantol.In</p>

    <form action="{{ route('login') }}" method="POST" class="auth-form">
        @csrf

        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px;">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="auth-input" placeholder="contoh@email.com" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="auth-input" placeholder="Masukkan password" required>
        </div>
        
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="#" style="font-size: 13px; color: var(--text-light); text-decoration: none;">Lupa password?</a>
        </div>

        <button type="submit" class="auth-btn">Masuk ke Akun</button>
    </form>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
    </div>
</div>
@endsection
