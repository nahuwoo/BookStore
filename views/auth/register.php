<?php include 'views/layout/header.php'; ?>
    <div class="card" style="max-width: 500px; margin: 40px auto;">
        <h2>Create an Account</h2>
        <?php if(!empty($errors)): ?>
            <div class="alert error"><?php echo implode('<br>', $errors); ?></div>
        <?php endif; ?>

        <form action="index.php?action=register" method="POST" id="register-form" novalidate>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="customer">CUSTOMER</option>
                    <option value="admin">ADMIN</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password (Min 8 characters)</label>
                <input type="password" name="password" required minlength="8">
            </div>
            <div class="form-group">
                <label>Default Delivery Address</label>
                <textarea name="address" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn" style="width: 100%;">Register</button>
        </form>
        <p style="text-align: center; margin-top: 15px;">Already have an account? <a href="index.php?action=login">Login here</a></p>
    </div>
<?php include 'views/layout/footer.php'; ?>