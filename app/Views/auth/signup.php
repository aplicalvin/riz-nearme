<!-- Mirip dengan login.php, tapi form registrasi -->
<form action="/register" method="post">
    <div class="mb-3">
        <label for="full_name" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="full_name" name="full_name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-success w-100">Daftar</button>
</form>