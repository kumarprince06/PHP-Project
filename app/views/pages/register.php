<?php require APPROOT . '/views/includes/header.php'; ?>

<?php flashMessage('register_success'); ?>
<?php flashErrorMessage('errorMessage'); ?>

<section class="vh-90 gradient-custom">
    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-90">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light text-white" style="border-radius: 1rem;">
                    <div class="card-body p-3 text-center">

                        <div class="mb-md-3 mt-md-2 pb-2">
                            <h2 class="fw-bold mb-2 text-uppercase text-success">Register</h2>
                            <p class="text-secondary mb-2">Create a new account!</p>
                            <form action="<?php echo URLROOT; ?>/pageController/register" method="post" novalidate>

                                <!-- Floating label for Name with error handling -->
                                <div class="form-floating form-white mb-2">
                                    <input type="text" name="name"
                                        value="<?php echo $data['name']; ?>"
                                        id="name"
                                        class="form-control form-control-sm <?php echo (!empty($data['nameError'])) ? 'is-invalid' : ''; ?>"
                                        placeholder="Name" />
                                    <label for="typeEmailX" class="text-dark">Name</label>
                                    <?php if (!empty($data['nameError'])): ?>
                                        <small class="text-danger fw-bold text-start d-block"><?php echo $data['nameError']; ?></small>
                                    <?php endif; ?>
                                </div>

                                <!-- Floating label for email with error handling -->
                                <div class="form-floating form-white mb-2">
                                    <input type="email" name="email"
                                        value="<?php echo $data['email']; ?>"
                                        id="typeEmailX"
                                        class="form-control form-control-sm <?php echo (!empty($data['emailError'])) ? 'is-invalid' : ''; ?>"
                                        placeholder="Email" />
                                    <label for="typeEmailX" class="text-dark">Email</label>
                                    <?php if (!empty($data['emailError'])): ?>
                                        <small class="text-danger fw-bold text-start d-block"><?php echo $data['emailError']; ?></small>
                                    <?php endif; ?>
                                </div>

                                <!-- Floating label for password with error handling -->
                                <div class="form-floating form-white mb-2">
                                    <input type="password" name="password"
                                        value="<?php echo $data['password']; ?>"
                                        id="typePasswordX"
                                        class="form-control form-control-sm <?php echo (!empty($data['passwordError'])) ? 'is-invalid' : ''; ?>"
                                        placeholder="Password" />
                                    <label for="typePasswordX" class="text-dark">Password</label>
                                    <?php if (!empty($data['passwordError'])): ?>
                                        <small class="text-danger fw-bold text-start d-block"><?php echo $data['passwordError']; ?></small>
                                    <?php endif; ?>
                                </div>

                                <button class="btn btn-outline-dark btn-lg px-5 fw-bold" type="submit">Register</button>

                                <div class="d-flex justify-content-center text-center mt-3 pt-1 flex-column align-items-center">
                                    <p class="mb-0 text-secondary">or Login with</p>
                                    <div class="d-flex justify-content-center text-center mt-2">
                                        <a href="#!" class="text-secondary mx-2"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-secondary mx-2"><i class="fab fa-twitter fa-lg"></i></a>
                                        <a href="#!" class="text-secondary mx-2"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div>
                            <p class="mb-0 mt-0 text-secondary">Already have an account? <a href="<?php echo URLROOT; ?>/pages/login" class="text-dark fw-bold text-decoration-none">Login</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>