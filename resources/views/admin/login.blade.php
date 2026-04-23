<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Gantol.In</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #db7093;
            --dark: #0f172a;
            --accent: #334155;
            --white: #ffffff;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: radial-gradient(circle at top right, #1e293b, #0f172a);
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
            color: white;
        }

        .login-card { 
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            padding: 50px 40px; 
            border-radius: 30px; 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); 
            width: 400px; 
            text-align: center; 
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-area { margin-bottom: 35px; }
        .logo-area h1 { 
            font-family: 'Playfair Display', serif; 
            font-size: 32px; 
            color: var(--primary); 
            margin: 0;
            letter-spacing: -1px;
        }
        .logo-area p { 
            font-size: 13px; 
            color: #94a3b8; 
            margin-top: 5px; 
            text-transform: uppercase; 
            letter-spacing: 2px;
            font-weight: 700;
        }

        .form-group { text-align: left; margin-bottom: 20px; }
        .form-group label { 
            display: block; 
            font-size: 12px; 
            font-weight: 700; 
            color: #94a3b8; 
            margin-bottom: 8px; 
            text-transform: uppercase;
        }

        input { 
            width: 100%; 
            padding: 15px; 
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 12px; 
            color: white;
            font-size: 15px;
            transition: 0.3s;
            box-sizing: border-box;
        }
        input:focus { 
            outline: none; 
            border-color: var(--primary); 
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 4px rgba(219, 112, 147, 0.1);
        }

        button { 
            background: var(--primary); 
            color: white; 
            border: none; 
            padding: 16px; 
            width: 100%; 
            border-radius: 12px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: 800; 
            transition: 0.3s; 
            margin-top: 15px;
            box-shadow: 0 10px 15px -3px rgba(219, 112, 147, 0.3);
        }
        button:hover { 
            background: #c71585; 
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(219, 112, 147, 0.4);
        }

        .back-link { 
            display: inline-block;
            margin-top: 30px;
            color: #64748b; 
            text-decoration: none; 
            font-size: 14px; 
            transition: 0.3s;
        }
        .back-link:hover { color: var(--primary); }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-area">
            <h1>Gantol.In</h1>
            <p>Admin Portal</p>
        </div>
        
        <form action="{{ route('admin.dashboard') }}" method="GET">
            <div class="form-group">
                <label>Username</label>
                <input type="text" placeholder="Masukkan username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="••••••••" required>
            </div>
            
            <button type="submit">Akses Dashboard</button>
        </form>
        
        <a href="{{ url('/') }}" class="back-link">← Kembali ke Toko</a>
    </div>
</body>
</html>
