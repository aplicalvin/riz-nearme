<?php echo $this->extend("layout/l_clean"); ?>
<?php echo $this->section("main_content"); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                    <div class="row g-0">
                        <!-- Left Column - Illustration -->
                        <div class="col-md-6 d-none d-md-block" style="background: linear-gradient(135deg, #0176C8 0%, #0197F8 100%);">
                            <div class="d-flex flex-column justify-content-center align-items-center h-100 p-4 text-white">
                                <img src="<?= base_url('assets/images/login.png') ?>" alt="Login Illustration" class="img-fluid mb-4" style="max-width: 80%;">
                                <h4 class="text-center mb-3">Selamat Datang Kembali</h4>
                                <p class="text-center small opacity-75">Masuk untuk mengakses semua fitur NearMe</p>
                            </div>
                        </div>
                        
                        <!-- Right Column - Form -->
                        <div class="col-md-6">
                            <div class="card-body p-4 p-xl-5">
                                <div class="text-center mb-4">
                                    <a href="<?= base_url('/') ?>">
                                        <span class="font-heading fw-bold" style="color: #0176C8; font-size: 1.5rem;">NearMe</span>
                                    </a>
                                </div>
                                
                                <h3 class="text-center mb-4 font-heading">Masuk ke Akun Anda</h3>
                                
                                <!-- Flash Message -->
                                <?php if(session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('error') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <form action="/login" method="post" class="mt-4">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Alamat Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="email@contoh.com" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                            <label class="form-check-label small" for="remember">Ingat saya</label>
                                        </div>
                                        <a href="/forgot-password" class="small text-decoration-none">Lupa password?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2" style="background-color: #0176C8; border: none;">
                                        <i class="fas fa-sign-in-alt me-2"></i> Masuk
                                    </button>
                                </form>

                                <div class="position-relative my-4">
                                    <hr>
                                    <div class="position-absolute top-50 start-50 translate-middle bg-white px-2 small text-muted">ATAU</div>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fab fa-google me-2"></i> Lanjutkan dengan Google
                                    </a>
                                    <a href="#" class="btn btn-outline-primary">
                                        <i class="fab fa-facebook-f me-2"></i> Lanjutkan dengan Facebook
                                    </a>
                                </div>

                                <div class="text-center mt-4">
                                    <p class="small mb-0">Belum punya akun? <a href="/signup" class="text-decoration-none fw-bold" style="color: #0176C8;">Daftar sekarang</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }
        
        .form-control:focus {
            border-color: #0176C8;
            box-shadow: 0 0 0 0.25rem rgba(1, 118, 200, 0.25);
        }
        
        .btn-outline-primary {
            color: #0176C8;
            border-color: #0176C8;
        }
        
        .btn-outline-primary:hover {
            background-color: #0176C8;
            color: white;
        }
        
        .toggle-password {
            cursor: pointer;
        }
    </style>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const passwordInput = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
<?php echo $this->endSection() ?>