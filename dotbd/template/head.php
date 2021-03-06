
        <!-- mobile menu -->
        <div class="mobile-menu-area d-md-none">
            <div class="mobile-menu-area-inner">
                <ul class="m-menu">
                    <li><a href="#">Home</a>
                        <ul class="m-submenu">
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Brands</a></li>
                    <li><a href="#">New arrival</a></li>
                    <li><a href="#">Hot sale</a>
                        <ul class="m-submenu">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul>
                    </li>
                    <li><a href="">Perfume Sho</a></li>
                    <li><a href="#">contact</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">All catagory</a>
                        <ul class="m-submenu">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end mobile menu -->

		<!-- header section -->
        <header class="header header1">
            <nav class="primary-menu">
                <div class="header-top">
                    <div class="container">
                        <div class="row no-gutters">
                            <div class="header-logo">
                                <a class="navbar-logo" href="index.html"><img src="assets/images/1.png" alt=""></a>
                            </div>
                            <div class="search-btn d-none d-sm-block">
                                <input type="text" name="text" placeholder="Search Here......." class="">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="header-bar d-block d-md-none">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="social-item d-none d-lg-block">
                                <ul class="social-link-list">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                            <div class="top-header d-none d-xl-block">
                                <span><i class="fas fa-phone-volume"></i> 01711 340 080</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom">
                    <div class="container">
                    <div class="row no-gutters">
                        <div class="search-btn d-block  d-sm-none">
                            <input type="text" name="text" placeholder="Search.." class="">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="header-catagori d-none d-lg-block">
                            <a href="">All Catagory</a>
                            <ul class="cata-submenu">
                                <li class="active"><a href="#">All Catagory </a>
                                    <ul class="cata-submenu">
                                        <li><a href="#">mac</a></li>
                                        <li><a href="#">kara</a></li>
                                        <li class="active"><a href="#">balm</a>
                                            <ul class="cata-submenu">
                                                <li><a href="#">mac</a></li>
                                                <li><a href="#">kara</a></li>
                                                <li><a href="#">balm</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Brands </a></li>
                                <li><a href="#">New arrival </a></li>
                                <li><a href="#"> Hot sale </a></li>
                                <li><a href="#">Perfume Shop</a></li>
                                <li><a href="#">contact</a></li>
                                <li><a href="#">About Us</a></li>
                            </ul>
                        </div>
                        <div class="menu-area d-none d-md-block">
                            <div class="main-menu-area justify-content-between">
                                <ul class="main-menu">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Brands </a></li>
                                    <li class="active"><a href="#">New arrival </a>
                                        <ul class="submenu">
                                            <li class="active"><a href="#">mac</a>
                                                <ul class="submenu">
                                                    <li><a href="#">mac</a></li>
                                                    <li><a href="#">kara</a></li>
                                                    <li><a href="#">balm</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">kara</a></li>
                                            <li class="active"><a href="#">balm</a>
                                                <ul class="submenu">
                                                    <li><a href="#">mac</a></li>
                                                    <li><a href="#">kara</a></li>
                                                    <li><a href="#">balm</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#"> Hot sale </a></li>
                                    <li><a href="#">Perfume Shop</a></li>
                                    <li><a href="#">blog</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="buy-cart d-none  d-md-block">
                            <!-- <i class="fas fa-cart-plus"></i> -->
                            <i class="fas fa-shopping-bag"></i> {{cart.length}} 
                            <p class="d-none d-xl-block"> Item</p>
                            <div class="cart-content">
                                <div class="cart-item" ng-repeat="item in cart">
                                    <div class="cart-img">
                                        <a href="#"><img src="upload/productImage/{{item.image}}" alt=""></a>
                                    </div>
                                    <div class="cart-des">
                                        <a href="#">{{item.name}}</a>
                                        <p>??? {{item.rprice}}</p>
                                        <span>in stock</span>
                                    </div>
                                    <div class="cart-btn">
                                        <a href="" ng-click="remove(item)"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                
                                <div class="cart-bottom">
                                    <div class="cart-subtotal">
                                        <p>Total: <span>???40.00</span></p>
                                    </div>
                                    <div class="cart-action">
                                        <a href="#!cart" class="btn btn-info">View cart</a>
                                        <a href="#!checkout" class="btn btn-danger">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="top-header d-block d-sm-none ">
                            <span><i class="fas fa-phone-volume"></i>01711 340 080</span>
                        </div>
                    </div>
                    </div>
                </div>
            </nav>
        </header>