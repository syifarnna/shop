<!DOCTYPE html>
<html>
<head>
    <title>Register Manual</title>
</head>
<body>
    <h2>Bikin Akun Baru</h2>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf 
        
        <div>
            <label>Nama Lengkap:</label>
            <input type="text" name="name" required>
        </div>
        <br>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <br>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <br>
        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="/login">Login di sini</a></p>

</body>
</html>