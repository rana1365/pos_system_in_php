<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>

                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link" href="order-create.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                    Create Order
                </a>

                <a class="nav-link" href="orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Orders
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                   data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-briefcase"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="categories-create.php">Create Categories</a>
                        <a class="nav-link" href="categories.php">View Categories</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                   data-bs-target="#collapseProduct" aria-expanded="false" aria-controls="collapseProduct">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-shop"></i></div>
                    Products
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="collapseProduct" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="products-create.php">Create Product</a>
                        <a class="nav-link" href="products.php">View Product</a>
                    </nav>
                </div>


                <div class="sb-sidenav-menu-heading">Manage Users</div>

                <a class="nav-link collapsed" href="#"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseCustomer"
                   aria-expanded="false"
                   aria-controls="collapseCustomer">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Customers
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseCustomer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="customers-create.php">Add Customer</a>
                        <a class="nav-link" href="customers.php">View Customer</a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseAdmin"
                   aria-expanded="false"
                   aria-controls="collapseAdmin">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i>
                        <?= $_SESSION['loggedInUser']['name']; ?>
                    </div>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdmin" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="admins-create.php">Add Admin</a>
                        <a class="nav-link" href="admins.php">View Admin</a>
                    </nav>
                </div>
            </div>

        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            admin
        </div>
    </nav>
</div>