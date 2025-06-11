<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Sample books data organized by category
$books_by_category = [
    'fiction' => [
        ['id' => 1, 'title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'price' => 12.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1490528560i/4671.jpg'],
        ['id' => 2, 'title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'price' => 14.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1553383690i/2657.jpg'],
        ['id' => 3, 'title' => '1984', 'author' => 'George Orwell', 'price' => 13.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1532714506i/40961427.jpg'],
        ['id' => 5, 'title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'price' => 13.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1398034300i/5107.jpg'],
        ['id' => 10, 'title' => 'The Hobbit', 'author' => 'J.R.R. Tolkien', 'price' => 14.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1546071216i/5907.jpg'],
    ],
    'non-fiction' => [
        ['id' => 9, 'title' => 'Sapiens', 'author' => 'Yuval Noah Harari', 'price' => 17.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1420585954i/23692271.jpg'],
        ['id' => 13, 'title' => 'Educated', 'author' => 'Tara Westover', 'price' => 16.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1506026635i/35133922.jpg'],
        ['id' => 14, 'title' => 'Atomic Habits', 'author' => 'James Clear', 'price' => 18.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1535115320i/40121378.jpg'],
        ['id' => 15, 'title' => 'Thinking, Fast and Slow', 'author' => 'Daniel Kahneman', 'price' => 19.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1317793965i/11468377.jpg'],
    ],
    'mystery' => [
        ['id' => 7, 'title' => 'The Girl with the Dragon Tattoo', 'author' => 'Stieg Larsson', 'price' => 15.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1327868566i/2429135.jpg'],
        ['id' => 11, 'title' => 'Gone Girl', 'author' => 'Gillian Flynn', 'price' => 14.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1554086139i/19288043.jpg'],
        ['id' => 16, 'title' => 'The Silent Patient', 'author' => 'Alex Michaelides', 'price' => 16.99, 'image' => 'https://tse4.mm.bing.net/th?id=OIP.NFHcKYxHqdgnaqxVIwplNQHaLV&pid=Api&P=0&h=180'],
        ['id' => 17, 'title' => 'Big Little Lies', 'author' => 'Liane Moriarty', 'price' => 15.99, 'image' => 'https://tse4.mm.bing.net/th?id=OIP.8-DmdZniSRRlT0zYG6KqlQHaKZ&pid=Api&P=0&h=180'],
    ],
    'romance' => [
        ['id' => 4, 'title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'price' => 11.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1320399351i/1885.jpg'],
        ['id' => 12, 'title' => 'The Notebook', 'author' => 'Nicholas Sparks', 'price' => 12.99, 'image' => 'https://tse4.mm.bing.net/th?id=OIP.Fwo_r8JjvJ3chmp3j5IylQAAAA&pid=Api&P=0&h=180'],
        ['id' => 18, 'title' => 'Me Before You', 'author' => 'Jojo Moyes', 'price' => 14.99, 'image' => 'https://tse4.mm.bing.net/th?id=OIP.J6d7qlj0JA7Q-tUiWfJwDwHaLW&pid=Api&P=0&h=180'],
        ['id' => 19, 'title' => 'The Fault in Our Stars', 'author' => 'John Green', 'price' => 13.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1360206420i/11870085.jpg'],
    ],
    'sci-fi' => [
        ['id' => 6, 'title' => 'Dune', 'author' => 'Frank Herbert', 'price' => 16.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1555447414i/44767458.jpg'],
        ['id' => 20, 'title' => 'The Martian', 'author' => 'Andy Weir', 'price' => 15.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1413706054i/18007564.jpg'],
        ['id' => 21, 'title' => 'Neuromancer', 'author' => 'William Gibson', 'price' => 14.99, 'image' => 'https://tse1.mm.bing.net/th?id=OIP.HutZIRospfSnEmEfXWsAOQHaKe&pid=Api&P=0&h=180'],
        ['id' => 22, 'title' => 'Foundation', 'author' => 'Isaac Asimov', 'price' => 16.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1417900846i/29579.jpg'],
    ],
    'biography' => [
        ['id' => 8, 'title' => 'Steve Jobs', 'author' => 'Walter Isaacson', 'price' => 18.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1511288482i/11084145.jpg'],
        ['id' => 23, 'title' => 'Becoming', 'author' => 'Michelle Obama', 'price' => 19.99, 'image' => 'https://tse3.mm.bing.net/th?id=OIP.e__NEYvJpiqMPy4lAR_zHgHaLQ&pid=Api&P=0&h=180'],
        ['id' => 24, 'title' => 'Long Walk to Freedom', 'author' => 'Nelson Mandela', 'price' => 17.99, 'image' => 'https://tse3.mm.bing.net/th?id=OIP.ro3rbor1nlBv8-7DazmFzwHaLp&pid=Api&P=0&h=180'],
        ['id' => 25, 'title' => 'The Diary of a Young Girl', 'author' => 'Anne Frank', 'price' => 12.99, 'image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1560816565i/48855.jpg'],
    ]
];

$user_name = $_SESSION['user_name'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BookHaven</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .user-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        .cart-icon {
            position: relative;
            font-size: 1.5rem;
            cursor: pointer;
            color: #667eea;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Main Content */
        main {
            margin-top: 80px;
            padding: 2rem 0;
        }

        .section {
            display: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            margin: 2rem 0;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .section.active {
            display: block;
        }

        /* Dashboard Hero */
        .dashboard-hero {
            text-align: center;
            padding: 3rem 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 20px;
            margin-bottom: 3rem;
        }

        .dashboard-hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dashboard-hero p {
            font-size: 1.2rem;
            color: #666;
        }

        /* Categories Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .category-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 2.5rem;
            border-radius: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .category-card:hover::before {
            left: 100%;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .category-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        .category-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .category-card p {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .book-count {
            font-size: 0.9rem;
            opacity: 0.8;
            font-weight: 300;
        }

        /* Books Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .book-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-image {
            width: 100%;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .book-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .book-card:hover .book-image img {
            transform: scale(1.05);
        }

        .book-info {
            padding: 1.5rem;
        }

        .book-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .book-author {
            color: #666;
            margin-bottom: 1rem;
        }

        .book-price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .add-to-cart {
            width: 100%;
            padding: 0.8rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            transition: transform 0.2s ease;
        }

        .add-to-cart:hover {
            transform: scale(1.05);
        }

        .back-btn {
            margin-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .dashboard-hero h1 {
                font-size: 2.5rem;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        .hidden {
            display: none !important;
        }

        .user-welcome {
            color: #667eea;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <header>
        <nav class="container">
            <a href="dashboard.php" class="logo">📚 BookHaven</a>
            <ul class="nav-links">
                <li><a href="#" onclick="showSection('dashboard')">Dashboard</a></li>
                <li><a href="#" onclick="showSection('all-books')">All Books</a></li>
            </ul>
            <div class="user-actions">
                <div class="cart-icon" onclick="showSection('cart')">
                    🛒
                    <span class="cart-count" id="cartCount">0</span>
                </div>
                <span class="user-welcome">Hello, <?php echo htmlspecialchars($user_name); ?>!</span>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </nav>
    </header>

    <main class="container">
        <!-- Dashboard Section -->
        <section id="dashboard" class="section active">
            <div class="dashboard-hero">
                <h1>Welcome to Your Dashboard</h1>
                <p>Discover amazing books across different genres</p>
            </div>

            <h2>Browse by Category</h2>
            <div class="categories-grid">
                <div class="category-card" onclick="showCategoryBooks('fiction')">
                    <span class="category-icon">📖</span>
                    <h3>Fiction</h3>
                    <p>Immerse yourself in captivating stories and adventures</p>
                    <div class="book-count"><?php echo count($books_by_category['fiction']); ?> books available</div>
                </div>
                
                <div class="category-card" onclick="showCategoryBooks('non-fiction')">
                    <span class="category-icon">📚</span>
                    <h3>Non-Fiction</h3>
                    <p>Learn and grow with factual and educational content</p>
                    <div class="book-count"><?php echo count($books_by_category['non-fiction']); ?> books available</div>
                </div>
                
                <div class="category-card" onclick="showCategoryBooks('mystery')">
                    <span class="category-icon">🔍</span>
                    <h3>Mystery</h3>
                    <p>Solve puzzles and uncover thrilling secrets</p>
                    <div class="book-count"><?php echo count($books_by_category['mystery']); ?> books available</div>
                </div>
                
                <div class="category-card" onclick="showCategoryBooks('romance')">
                    <span class="category-icon">💕</span>
                    <h3>Romance</h3>
                    <p>Fall in love with heartwarming stories</p>
                    <div class="book-count"><?php echo count($books_by_category['romance']); ?> books available</div>
                </div>
                
                <div class="category-card" onclick="showCategoryBooks('sci-fi')">
                    <span class="category-icon">🚀</span>
                    <h3>Sci-Fi</h3>
                    <p>Explore futuristic worlds and technology</p>
                    <div class="book-count"><?php echo count($books_by_category['sci-fi']); ?> books available</div>
                </div>
                
                <div class="category-card" onclick="showCategoryBooks('biography')">
                    <span class="category-icon">👤</span>
                    <h3>Biography</h3>
                    <p>Discover inspiring life stories of remarkable people</p>
                    <div class="book-count"><?php echo count($books_by_category['biography']); ?> books available</div>
                </div>
            </div>
        </section>

        <!-- Category Books Sections -->
        <?php foreach ($books_by_category as $category => $books): ?>
        <section id="<?php echo $category; ?>-books" class="section">
            <button class="btn btn-secondary back-btn" onclick="showSection('dashboard')">← Back to Dashboard</button>
            <h2><?php echo ucfirst(str_replace('-', ' ', $category)); ?> Books</h2>
            <div class="books-grid">
                <?php foreach ($books as $book): ?>
                <div class="book-card">
                    <div class="book-image">
                        <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'width:100%; height:100%; background: linear-gradient(45deg, #f1f2f6, #ddd); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #667eea;\'>📖</div>';">
                    </div>
                    <div class="book-info">
                        <div class="book-title"><?php echo htmlspecialchars($book['title']); ?></div>
                        <div class="book-author">by <?php echo htmlspecialchars($book['author']); ?></div>
                        <div class="book-price">$<?php echo number_format($book['price'], 2); ?></div>
                        <button class="add-to-cart" onclick="addToCart(<?php echo $book['id']; ?>)">Add to Cart</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>

        <!-- All Books Section -->
        <section id="all-books" class="section">
            <h2>All Books</h2>
            <div class="books-grid">
                <?php 
                $all_books = [];
                foreach ($books_by_category as $category_books) {
                    $all_books = array_merge($all_books, $category_books);
                }
                foreach ($all_books as $book): 
                ?>
                <div class="book-card">
                    <div class="book-image">
                        <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'width:100%; height:100%; background: linear-gradient(45deg, #f1f2f6, #ddd); display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #667eea;\'>📖</div>';">
                    </div>
                    <div class="book-info">
                        <div class="book-title"><?php echo htmlspecialchars($book['title']); ?></div>
                        <div class="book-author">by <?php echo htmlspecialchars($book['author']); ?></div>
                        <div class="book-price">$<?php echo number_format($book['price'], 2); ?></div>
                        <button class="add-to-cart" onclick="addToCart(<?php echo $book['id']; ?>)">Add to Cart</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Cart Section -->
        <section id="cart" class="section">
            <h2>Shopping Cart</h2>
            <div id="cartItems"></div>
            <div class="cart-total" id="cartTotal">Total: $0.00</div>
            <div style="text-align: center;">
                <button class="btn btn-primary" onclick="checkout()" style="margin-right: 1rem;">Checkout</button>
                <button class="btn btn-secondary" onclick="clearCart()">Clear Cart</button>
            </div>
        </section>

        <!-- Orders Section -->
        <section id="orders" class="section">
            <h2>My Orders</h2>
            <p>Your order history will appear here.</p>
        </section>

        <!-- Profile Section -->
        <section id="profile" class="section">
            <h2>My Profile</h2>
            <p>Profile management options will be available here.</p>
        </section>
    </main>

    <script>
        
        // Book data for JavaScript
        const allBooks = <?php echo json_encode(array_merge(...array_values($books_by_category))); ?>;
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');

        // Initialize
        function init() {
            updateCartDisplay();
        }

        // Show section
        function showSection(sectionName) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionName).classList.add('active');
        }

        // Show category books
        function showCategoryBooks(category) {
            showSection(category + '-books');
        }

        // Add to cart
        function addToCart(bookId) {
            const book = allBooks.find(b => b.id === bookId);
            if (!book) return;

            const existingItem = cart.find(item => item.id === bookId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ ...book, quantity: 1 });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
            alert('Book added to cart!');
        }

        // Update cart display
        function updateCartDisplay() {
            const cartCount = document.getElementById('cartCount');
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            cartCount.textContent = totalItems;
            cartTotal.textContent = `Total: $${totalPrice.toFixed(2)}`;
            
            if (cartItems) {
                cartItems.innerHTML = cart.map(item => `
                    <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; border-bottom: 1px solid #f1f2f6;">
                        <div style="width: 60px; height: 80px; background: linear-gradient(45deg, #f1f2f6, #ddd); border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #667eea; overflow: hidden;">
                            ${item.image ? `<img src="${item.image}" alt="${item.title}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none'; this.parentNode.innerHTML='📖';">` : '📖'}
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: bold; margin-bottom: 0.5rem;">${item.title}</div>
                            <div style="color: #667eea; font-weight: 500;">$${item.price}</div>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <button style="width: 30px; height: 30px; border: none; border-radius: 50%; background: #667eea; color: white; cursor: pointer;" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button style="width: 30px; height: 30px; border: none; border-radius: 50%; background: #667eea; color: white; cursor: pointer;" onclick="updateQuantity(${item.id}, 1)">+</button>
                        </div>
                    </div>
                `).join('');
            }
        }

        // Update quantity
        function updateQuantity(bookId, change) {
            const item = cart.find(item => item.id === bookId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cart = cart.filter(cartItem => cartItem.id !== bookId);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay();
            }
        }

        // Clear cart
        function clearCart() {
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
        }

        // Checkout
        function checkout() {
            if (cart.length === 0) {
                alert('Your cart is empty!');
                return;
            }
            
            alert('Thank you for your purchase! Your order has been placed.');
            clearCart();
        }

        // Initialize on page load
        window.onload = init;
    </script>
</body>
</html>id}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button style="width: 30px; height: 30px; border: none; border-radius: 50%; background: #667eea; color: white; cursor: pointer;" onclick="updateQuantity(${item.