<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books-Book Companion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="loogo.png" width="125px">
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="home.html">Home</a></li>
                        <li><a href="Books.html" class="active">Books</a></li>
                        <li><a href="About.html">About Us</a></li>
                        <li><a href="Contact.html">Contact Us</a></li>
                    </ul>
                </nav>
                <div class="right">
                    <button class="btn" id="loginBtn">Log In</button>
                    <button class="btn" id="signupBtn">Sign Up</button>
                </div>
                <img src="cart.png" width="30px" height="30px">
                <img src="menu.png" width="28px" height="20px" class="menu-icon" onclick="menutoggle()">
            </div>
            </div>
            
                <div class="small-container">
                    <div class="row row-2">
                        <h2>All Books</h2>
                        <select>
                            <option>Default Sorting</option>
                            <option> Sort By Price</option>
                            <option>Sort By Popularity</option>
                        
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <img src="book.jpeg">
                        </div>
                        <div class="col-3">
                            <img src="bk1.jpeg">
                        </div>
                        <div class="col-3">
                            <img src="bk2.jpg">
                        </div>
                        <div class="col-3">
                            <img src="bk2.jpg">
                        </div>
                    </div>
                </div>
                <div class="small-container">
           
            <div class="row">
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
            </div>
        </div>
    
        <!-- Sci-fi Section -->
        <div class="small-container">
            
            <div class="row">
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
            </div>
        </div>
    
        <!-- Non-fiction Section -->
        <div class="small-container">
            
            <div class="row">
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
                <div class="col-4">
                    <img src="bk1.jpeg">
                    <h4>Candice</h4>
                    <p>Rs.100</p>
                </div>
            </div>
            <div class="page-btn">
                <span>1</span>
                <span>2</span>
                <span>3</span>
            </div>
        </div>
            
            <!-- Footer -->
        <div class="footer">
            <div class="row">
                <div class="footer-col-1">
                    <img src="loogo.png" width="50px" height="50px">
                    <p>Our Purpose is to make reading <br>affordable and easy</p>
                </div>
                <div class="footer-col-2">
                    <h3>Follow Us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Instagram</li>
                        <li>Twitter</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2024- Book Companion</p>
        </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeLogin">&times;</span>
            <form>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Log In</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeSignup">&times;</span>
            <form>
                <div class="form-group">
                    <label for="new-username">Username</label>
                    <input type="text" id="new-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="new-password">Password</label>
                    <input type="password" id="new-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="Confirm-password">Confirm-password</label>
                    <input type="Confirm-password" id="Confirm-password" name="Confirm-password" required>
                </div>
                <div class="form-group">
                    <label for="user-type">User Type</label>
                    <select id="user-type" name="user-type" required>
                        <option value="rentee">Rentee</option>
                        <option value="renter">Renter</option>
                        <option value="admin">Admin</option>
                    </select>
                <div class="form-group">
                    <button type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    

    <script src="book.js"></script>
</body>
</html>