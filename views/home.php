<section class="hero">
    <p class="muted">Discover your next read</p>
    <h1>Online Book Store</h1>
    <p>Browse categories like Novel, Literature, and Sci-Fi, then explore featured books pulled from the database. Use the navigation to jump to your cart, profile, or admin panel when you are signed in as an admin.</p>
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="hero-actions">
            <a class="btn" href="index.php?action=profile">My Profile</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a class="btn" href="index.php?action=admin_dashboard">Admin Panel</a>
            <?php else: ?>
                <a class="btn" href="index.php?action=cart">Go to Cart</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<h2 class="section-title" id="categories">Categories</h2>
<div class="category-list">
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <a class="category-link" href="index.php?action=browse&category_id=<?php echo (int) $category['id']; ?>">
                <div class="chip">
                    <?php echo htmlspecialchars($category['name']); ?>
                    <?php if (!empty($category['description'])): ?>
                        <div class="muted" style="font-weight: normal; margin-top: 8px; font-size: 14px;">
                            <?php echo htmlspecialchars($category['description']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">No categories found yet. Add some using the SQL below.</div>
    <?php endif; ?>
</div>

<h2 class="section-title">Featured Books</h2>
<div class="book-grid">
    <?php if (!empty($featuredBooks)): ?>
        <?php foreach ($featuredBooks as $book): ?>
            <article class="book-card">
                <div class="book-cover">
                    <?php echo htmlspecialchars(mb_substr($book['title'], 0, 1)); ?>
                </div>
                <div class="book-body">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <div class="muted"><?php echo htmlspecialchars($book['author']); ?></div>
                    <div class="muted" style="margin-top: 6px;">Category: <?php echo htmlspecialchars($book['category_name'] ?? 'Uncategorized'); ?></div>
                    <div class="book-meta">
                        <span class="book-price">$<?php echo number_format((float) $book['price'], 2); ?></span>
                        <a class="btn" href="index.php?action=browse">View Book</a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">No featured books found yet. Insert the sample data below.</div>
    <?php endif; ?>
</div>