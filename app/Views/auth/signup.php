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
                                <img src="<?= base_url('assets/images/signup.png') ?>" alt="Sign Up Illustration" class="img-fluid mb-4" style="max-width: 80%;">
                                <h4 class="text-center mb-3">Bergabung Dengan Kami</h4>
                                <p class="text-center small opacity-75">Daftar sekarang untuk mulai menjelajahi penginapan terbaik</p>
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
                                
                                <h3 class="text-center mb-4 font-heading">Buat Akun Baru</h3>
                                
                                <!-- Flash Message -->
                                <?php if(session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?= session()->getFlashdata('error') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <form action="/register" method="post" class="mt-4">
                                    <?= csrf_field() ?>
                                    
                                    <!-- Nama Lengkap -->
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                                            <input type="text" class="form-control <?= session('errors.full_name') ? 'is-invalid' : '' ?>" 
                                                   id="full_name" name="full_name" value="<?= old('full_name') ?>" 
                                                   placeholder="Nama lengkap Anda" required>
                                        </div>
                                        <?php if(session('errors.full_name')): ?>
                                            <div class="invalid-feedback d-block">
                                                <?= session('errors.full_name') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Username -->
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-at text-muted"></i></span>
                                            <input type="text" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" 
                                                   id="username" name="username" value="<?= old('username') ?>" 
                                                   placeholder="username" required>
                                        </div>
                                        <?php if(session('errors.username')): ?>
                                            <div class="invalid-feedback d-block">
                                                <?= session('errors.username') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-envelope text-muted"></i></span>
                                            <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" 
                                                   id="email" name="email" value="<?= old('email') ?>" 
                                                   placeholder="email@contoh.com" required>
                                        </div>
                                        <?php if(session('errors.email')): ?>
                                            <div class="invalid-feedback d-block">
                                                <?= session('errors.email') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Nomor Telepon -->
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Nomor Telepon</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-phone text-muted"></i></span>
                                            <input type="tel" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" 
                                                   id="phone" name="phone" value="<?= old('phone') ?>" 
                                                   placeholder="0812-3456-7890">
                                        </div>
                                        <?php if(session('errors.phone')): ?>
                                            <div class="invalid-feedback d-block">
                                                <?= session('errors.phone') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                                            <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" 
                                                   id="password" name="password" placeholder="••••••••" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <?php if(session('errors.password')): ?>
                                            <div class="invalid-feedback d-block">
                                                <?= session('errors.password') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Konfirmasi Password -->
                                    <div class="mb-4">
                                        <label for="pass_confirm" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                                            <input type="password" class="form-control <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>" 
                                                   id="pass_confirm" name="pass_confirm" placeholder="••••••••" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <?php if(session('errors.pass_confirm')): ?>
                                            <div class="invalid-feedback d-block">
                                                <?= session('errors.pass_confirm') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-2" style="background-color: #0176C8; border: none;">
                                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                                    </button>

                                    <div class="position-relative my-4">
                                        <hr>
                                        <div class="position-absolute top-50 start-50 translate-middle bg-white px-2 small text-muted">ATAU</div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="fab fa-google me-2"></i> Daftar dengan Google
                                        </a>
                                        <a href="#" class="btn btn-outline-primary">
                                            <i class="fab fa-facebook-f me-2"></i> Daftar dengan Facebook
                                        </a>
                                    </div>

                                    <div class="text-center mt-4">
                                        <p class="small mb-0">Sudah punya akun? <a href="/login" class="text-decoration-none fw-bold" style="color: #0176C8;">Login disini</a></p>
                                    </div>
                                </form>
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
        
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }
        
        .is-invalid ~ .invalid-feedback,
        .is-invalid ~ .invalid-feedback.d-block {
            display: block;
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