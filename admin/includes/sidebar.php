<?php 
$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/")+1);
?>

<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                            <div class="nav">
                            <div class="sb-sidenav-menu-heading">User</div>
                            <div class="sb-sidenav-footer">
                                <?php if(isset($_SESSION['loggedIn'])): ?>
                                    <div>Logged in as: <?=$_SESSION['loggedInUser']['name']; ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link <?=$page == 'index.php'? 'active': '';?>" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link <?=$page == 'order-create.php'? 'active': '';?>" href="order-create.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                                Create order
                            </a>
                            <a class="nav-link <?=$page == 'orders.php'? 'active': '';?>" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Order
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link <?=($page == 'categories-create.php') || ($page == 'categories.php') ? 'collapse active': 'collapsed';?>"
                             href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?=($page == 'categories-create.php') || ($page == 'categories.php')? 'show':''?>" 
                            id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=$page == 'categories-create.php'? 'active': '';?>" href="categories-create.php">Create Category</a>
                                    <a class="nav-link <?=$page == 'categories.php'? 'active': '';?>" href="categories.php">View Category</a>
                                </nav>
                            </div>

                            <a class="nav-link <?=($page == 'products-create.php') || ($page == 'products.php') ? 'collapse active': 'collapsed';?>"
                             href="#" data-bs-toggle="collapse" data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?=($page == 'products-create.php') || ($page == 'products.php')? 'show':''?>
                            " id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=$page == 'products-create.php'? 'active': '';?>" href="products-create.php">Create Product</a>
                                    <a class="nav-link <?=$page == 'products.php'? 'active': '';?>" href="products.php">View Product</a>
                                </nav>
                            </div>
                            
                            <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> -->
                            <div class="sb-sidenav-menu-heading">Manage Staff</div>
                            <a class="nav-link <?=($page == 'admins-create.php') || ($page == 'admins.php') ? 'collapse active': 'collapsed';?>" 
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                staff
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse  <?=($page == 'admins-create.php') || ($page == 'admins.php')? 'show':''?>"
                             id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=$page == 'admins-create.php'? 'active': '';?>" href="admins-create.php">Add Staff</a>
                                    <a class="nav-link <?=$page == 'admins.php'? 'active': '';?>" href="admins.php">View Staff</a>
                                </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Manage users</div>
                            <a class="nav-link <?=($page == 'customers-create.php') || ($page == 'customer.php') ? 'collapse active': 'collapsed';?> " 
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomer" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Customers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?=($page == 'customers-create.php') || ($page == 'customer.php')? 'show':''?>
                            " id="collapseCustomer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?=$page == 'customers-create.php'? 'active': '';?>" href="customers-create.php">Add Customer</a>
                                    <a class="nav-link <?=$page == 'customer.php'? 'active': '';?>" href="customer.php">View Customer</a>
                                </nav>

                          
                        </div>
                        <!-- <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                    <div class="sb-sidenav-footer">
                        <div class="small">Agriyield Crop Inventory System</div>
                        <!-- Start Bootstrap  -->
                    </div>
                </nav>
            </div>