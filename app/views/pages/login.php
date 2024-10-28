<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Login</h1>
<?php flashMessage('register_success'); ?>
<a href="<?php echo URLROOT ?>/pages"><button type="button">Back</button></a>
<p style="color: red;">* required fields</p>
<form action="<?php echo URLROOT ?>/pages/login" method="post" novalidate>

    <!-- User Email Name -->
    <div class="register" style="margin-bottom: 5px;">
        <label for="email">Email:</label>
        <input
            type="email"
            name="email"
            value="<?php echo htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8'); ?>"
            id="name"
            style="border: 1px solid <?php echo !empty($data['emailError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['emailError']; ?></span>
    </div>

    <!-- Product Name -->
    <div class="register" style="margin-bottom: 5px;">
        <label for="password">Password:</label>
        <input
            type="password"
            name="password"
            value="<?php echo htmlspecialchars($data['password'], ENT_QUOTES, 'UTF-8'); ?>"
            id="name"
            style="border: 1px solid <?php echo !empty($data['passwordError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['passwordError']; ?></span>
    </div>

    <button type="submit" name="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<p>Don't have account? <a href="<?php echo URLROOT; ?>/pages/register">Register</a></p>

<?php require APPROOT . '/views/includes/footer.php'; ?>