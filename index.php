<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHaven - Your Ultimate Book Destination</title>
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

        /* Hero Section */
        .hero {
            text-align: center;
            padding: 4rem 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 20px;
            margin-bottom: 3rem;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #666;
        }

        .search-bar {
            max-width: 500px;
            margin: 0 auto;
            position: relative;
        }

        .search-bar input {
            width: 100%;
            padding: 1rem 3rem 1rem 1rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            outline: none;
        }

        .search-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Categories */
        .categories {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .category-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
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
            background: linear-gradient(45deg, #f1f2f6, #ddd);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #667eea;
            overflow: hidden;
        }

        .book-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
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

        /* Forms */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #f1f2f6;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        /* Cart */
        .cart-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-bottom: 1px solid #f1f2f6;
        }

        .cart-item-image {
            width: 60px;
            height: 80px;
            background: linear-gradient(45deg, #f1f2f6, #ddd);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            overflow: hidden;
        }

        .cart-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .cart-item-price {
            color: #667eea;
            font-weight: 500;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 50%;
            background: #667eea;
            color: white;
            cursor: pointer;
        }

        .cart-total {
            text-align: center;
            margin: 2rem 0;
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .categories {
                grid-template-columns: 1fr;
            }
            
            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        .hidden {
            display: none !important;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            max-width: 500px;
            width: 90%;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: #667eea;
        }
        /* About Section Styling */
#about {
    background: white;
    border-radius: 20px;
    padding: 2rem 3rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    line-height: 1.8;
    color: #444;
}

#about h2 {
    font-size: 2.2rem;
    color: #667eea;
    margin-bottom: 1rem;
    text-align: center;
}

#about h3 {
    color: #764ba2;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
}

#about ul {
    padding-left: 1.2rem;
    list-style-type: disc;
}

/* Contact Section Styling */
#contact {
    background: white;
    border-radius: 20px;
    padding: 2rem 3rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    color: #444;
}

#contact h2 {
    font-size: 2.2rem;
    color: #667eea;
    text-align: center;
    margin-bottom: 2rem;
}

#contact h3 {
    color: #764ba2;
    margin-bottom: 1rem;
}

#contact p {
    margin-bottom: 0.8rem;
    font-size: 1rem;
}

/* Contact form tweaks */
#contact form {
    margin-top: 1rem;
}

#contact .form-container h3 {
    text-align: center;
    margin-bottom: 1rem;
    color: #667eea;
}

    </style>
</head>
<body>
    <header>
        <nav class="container">
            <a href="#" class="logo">📚 BookHaven</a>
            <ul class="nav-links">
                <li><a href="#" onclick="showSection('home')">Home</a></li>
                <li><a href="#" onclick="showSection('books')">Books</a></li>
                <li><a href="#" onclick="showSection('about')">About Us</a></li>
                <li><a href="#" onclick="showSection('contact')">Contact</a></li>
            </ul>
            <div class="user-actions">
                <div class="cart-icon" onclick="showSection('cart')">
                    🛒
                    <span class="cart-count" id="cartCount">0</span>
                </div>
                <div id="authButtons">
                    <a href="login.php" class="btn btn-secondary">Login</a>
                    <a href="register.php" class="btn btn-primary">Register</a>
                </div>
                <div id="userMenu" class="hidden">
                    <span id="userName"></span>
                    <button class="btn btn-secondary" onclick="logout()">Logout</button>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <!-- Home Section -->
        <section id="home" class="section active">
            <div class="hero">
                <h1>Welcome to BookHaven</h1>
                <p>Discover your next favorite book from our vast collection</p>
            </div>

            <h2>Featured Books</h2>
            <div class="books-grid" id="featuredBooks"></div>
        </section>

        <!-- Books Section -->
        <section id="books" class="section">
            <h2>All Books</h2>
            <div class="books-grid" id="allBooks"></div>
        </section>

        <!-- About Section -->
        <section id="about" class="section">
            <h2>About BookHaven</h2>
            <p>BookHaven is your ultimate destination for discovering and purchasing books. Founded in 2024, we've been committed to bringing readers and books together through our carefully curated collection.</p>
            
            <h3>Our Mission</h3>
            <p>To make quality books accessible to everyone and foster a love for reading in our community.</p>
            
            <h3>Why Choose Us?</h3>
            <ul>
                <li>Vast collection of books across all genres</li>
                <li>Competitive prices and regular discounts</li>
                <li>Fast and reliable delivery</li>
                <li>Excellent customer service</li>
                <li>Easy returns and exchanges</li>
            </ul>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section">
            <h2>Contact Us</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div>
                    <h3>Get in Touch</h3>
                    <p>📍 123 Book Street, Reading City, RC 12345</p>
                    <p>📞 +1 (555) 123-4567</p>
                    <p>✉️ info@bookhaven.com</p>
                    <p>🕒 Mon-Fri: 9AM-6PM, Sat-Sun: 10AM-4PM</p>
                </div>
                <div class="form-container">
                    <h3>Send us a Message</h3>
                    <form onsubmit="sendMessage(event)">
                        <div class="form-group">
                            <label for="contactName">Name</label>
                            <input type="text" id="contactName" required>
                        </div>
                        <div class="form-group">
                            <label for="contactEmail">Email</label>
                            <input type="email" id="contactEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="contactMessage">Message</label>
                            <textarea id="contactMessage" rows="4" style="width: 100%; padding: 1rem; border: 2px solid #f1f2f6; border-radius: 10px;" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                    </form>
                </div>
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
    </main>

    <script>
        // Sample book data with cover images
        const books = [
            { 
                id: 1, 
                title: "The Great Gatsby", 
                author: "F. Scott Fitzgerald", 
                price: 12.99, 
                category: "fiction",
                cover: "https://tse4.mm.bing.net/th?id=OIP.fFaX7nKq5_5gf2nSI3QEUgHaLK&pid=Api&P=0&h=180"
            },
            { 
                id: 2, 
                title: "To Kill a Mockingbird", 
                author: "Harper Lee", 
                price: 14.99, 
                category: "fiction",
                cover: "https://tse4.mm.bing.net/th?id=OIP.T55C4BiOVfcS3WFdCM3xdwHaK2&pid=Api&P=0&h=180"
            },
            { 
                id: 3, 
                title: "1984", 
                author: "George Orwell", 
                price: 13.99, 
                category: "fiction",
                cover: "https://tse2.mm.bing.net/th?id=OIP.bcQtcf_xrZuJkIF8nHpaywHaLb&pid=Api&P=0&h=180"
            },
            { 
                id: 4, 
                title: "Pride and Prejudice", 
                author: "Jane Austen", 
                price: 11.99, 
                category: "romance",
                cover: "https://tse4.mm.bing.net/th?id=OIP.nPa6H8JOp7t2NtQdyqX2GQHaKW&pid=Api&P=0&h=180"
            },
            { 
                id: 5, 
                title: "The Catcher in the Rye", 
                author: "J.D. Salinger", 
                price: 13.99, 
                category: "fiction",
                cover: "https://tse1.mm.bing.net/th?id=OIP.WIlTXUUOYa6nqscRw9Gx6AHaKn&pid=Api&P=0&h=180"
            },
            { 
                id: 6, 
                title: "Dune", 
                author: "Frank Herbert", 
                price: 16.99, 
                category: "sci-fi",
                cover: "https://tse3.mm.bing.net/th?id=OIP.uZbN0Rj0eI384MLwpcc_swHaK9&pid=Api&P=0&h=180"
            },
            { 
                id: 7, 
                title: "The Girl with the Dragon Tattoo", 
                author: "Stieg Larsson", 
                price: 15.99, 
                category: "mystery",
                cover: "https://up.yimg.com/ib/th?id=OIP.s6TnxLCU5i4kOvl-1SYVEwHaLW&pid=Api&rs=1&c=1&qlt=95&w=79&h=121"
            },
            { 
                id: 8, 
                title: "Steve Jobs", 
                author: "Walter Isaacson", 
                price: 18.99, 
                category: "biography",
                cover: "https://tse2.mm.bing.net/th?id=OIP.1XblHvgMQnpUq_UrCebzLgAAAA&pid=Api&P=0&h=180"
            },
            { 
                id: 9, 
                title: "Sapiens", 
                author: "Yuval Noah Harari", 
                price: 17.99, 
                category: "non-fiction",
                cover: "https://tse1.mm.bing.net/th?id=OIP.xOjvBsPCYVmiG-wCavUpPQHaLR&pid=Api&P=0&h=180"
            },
            { 
                id: 10, 
                title: "The Hobbit", 
                author: "J.R.R. Tolkien", 
                price: 14.99, 
                category: "fiction",
                cover: "https://covers.openlibrary.org/b/id/6979861-L.jpg"
            },
            { 
                id: 11, 
                title: "Gone Girl", 
                author: "Gillian Flynn", 
                price: 14.99, 
                category: "mystery",
                cover: "https://sp.yimg.com/ib/th?id=OIP.J7t1RdPOHE1_HMpdQvKoGgAAAA&pid=Api&w=148&h=148&c=7&dpr=2&rs=1"
            },
            { 
                id: 12, 
                title: "The Notebook", 
                author: "Nicholas Sparks", 
                price: 12.99, 
                category: "romance",
                cover: "https://tse3.mm.bing.net/th?id=OIP.JnlF1qEqtj6P7u3n3F6MNQHaLU&pid=Api&P=0&h=180"
            }
        ];

        let cart = [];
        let currentUser = null;

        // Initialize the website
        function init() {
            displayBooks(books.slice(0, 6), 'featuredBooks');
            displayBooks(books, 'allBooks');
            updateCartDisplay();
            
            // Check if user is logged in (removed localStorage usage as per requirements)
            // User would need to log in each session
        }

        // Display books
        function displayBooks(booksToShow, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = booksToShow.map(book => `
                <div class="book-card">
                    <div class="book-image">
                        <img src="${book.cover}" alt="${book.title}" onerror="this.style.display='none'; this.parentNode.innerHTML='📖';">
                    </div>
                    <div class="book-info">
                        <div class="book-title">${book.title}</div>
                        <div class="book-author">by ${book.author}</div>
                        <div class="book-price">$${book.price}</div>
                        <button class="add-to-cart" onclick="addToCart(${book.id})">Add to Cart</button>
                    </div>
                </div>
            `).join('');
        }

        // Add to cart
        function addToCart(bookId) {
            const book = books.find(b => b.id === bookId);
            const existingItem = cart.find(item => item.id === bookId);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ ...book, quantity: 1 });
            }
            
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
            
            cartItems.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="${item.cover}" alt="${item.title}" onerror="this.style.display='none'; this.parentNode.innerHTML='📖';">
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-title">${item.title}</div>
                        <div class="cart-item-price">$${item.price}</div>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                        <span>${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                    </div>
                </div>
            `).join('');
        }

        // Update quantity
        function updateQuantity(bookId, change) {
            const item = cart.find(item => item.id === bookId);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cart = cart.filter(cartItem => cartItem.id !== bookId);
                }
                updateCartDisplay();
            }
        }

        // Clear cart
        function clearCart() {
            cart = [];
            updateCartDisplay();
        }

        // Checkout
        function checkout() {
            if (cart.length === 0) {
                alert('Your cart is empty!');
                return;
            }
            
            if (!currentUser) {
                alert('Please login to checkout.');
                return;
            }
            
            alert('Thank you for your purchase! Your order has been placed.');
            clearCart();
        }

        // Show section
        function showSection(sectionName) {
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionName).classList.add('active');
        }

        // Filter books
        function filterBooks(category) {
            const filteredBooks = books.filter(book => book.category === category);
            displayBooks(filteredBooks, 'allBooks');
            showSection('books');
        }

        // Search books
        function searchBooks() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const filteredBooks = books.filter(book => 
                book.title.toLowerCase().includes(query) || 
                book.author.toLowerCase().includes(query)
            );
            displayBooks(filteredBooks, 'allBooks');
            showSection('books');
        }

        // Modal functions
        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function hideModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Login
        function login(event) {
            event.preventDefault();
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            // Simulate login (in real app, this would be an API call)
            currentUser = { email: email, name: email.split('@')[0] };
            
            updateUserInterface();
            hideModal('loginModal');
            alert('Login successful!');
        }

        // Signup
        function signup(event) {
            event.preventDefault();
            const name = document.getElementById('signupName').value;
            const email = document.getElementById('signupEmail').value;
            const password = document.getElementById('signupPassword').value;
            
            // Simulate signup (in real app, this would be an API call)
            currentUser = { email: email, name: name };
            
            updateUserInterface();
            hideModal('signupModal');
            alert('Account created successfully!');
        }

        // Logout
        function logout() {
            currentUser = null;
            updateUserInterface();
            alert('Logged out successfully!');
        }

        // Update user interface
        function updateUserInterface() {
            const authButtons = document.getElementById('authButtons');
            const userMenu = document.getElementById('userMenu');
            const userName = document.getElementById('userName');
            
            if (currentUser) {
                authButtons.classList.add('hidden');
                userMenu.classList.remove('hidden');
                userName.textContent = `Hello, ${currentUser.name}!`;
            } else {
                authButtons.classList.remove('hidden');
                userMenu.classList.add('hidden');
            }
        }

        // Send message
        function sendMessage(event) {
            event.preventDefault();
            alert('Thank you for your message! We will get back to you soon.');
            event.target.reset();
        }

        // Initialize on page load
        window.onload = init;
    </script>
</body>
</html>