#!/bin/bash

# Root folder
PROJECT="laidback-cafe"

# Buat struktur folder
mkdir -p $PROJECT/app/Http/Controllers/Customer
mkdir -p $PROJECT/app/Http/Controllers/Cashier
mkdir -p $PROJECT/app/Http/Controllers/Owner
mkdir -p $PROJECT/app/Http/Middleware
mkdir -p $PROJECT/app/Models
mkdir -p $PROJECT/resources/views/customer
mkdir -p $PROJECT/resources/views/cashier
mkdir -p $PROJECT/resources/views/owner

# Buat file Controllers Customer
touch $PROJECT/app/Http/Controllers/Customer/MenuController.php
touch $PROJECT/app/Http/Controllers/Customer/CartController.php
touch $PROJECT/app/Http/Controllers/Customer/OrderController.php

# Buat file Controllers Cashier
touch $PROJECT/app/Http/Controllers/Cashier/TransactionController.php
touch $PROJECT/app/Http/Controllers/Cashier/PaymentController.php

# Buat file Controllers Owner
touch $PROJECT/app/Http/Controllers/Owner/DashboardController.php
touch $PROJECT/app/Http/Controllers/Owner/ProductController.php
touch $PROJECT/app/Http/Controllers/Owner/UserController.php
touch $PROJECT/app/Http/Controllers/Owner/ReportController.php

# Buat file Middleware
touch $PROJECT/app/Http/Middleware/CustomerMiddleware.php
touch $PROJECT/app/Http/Middleware/CashierMiddleware.php
touch $PROJECT/app/Http/Middleware/OwnerMiddleware.php

# Buat file Models
touch $PROJECT/app/Models/Product.php
touch $PROJECT/app/Models/Category.php
touch $PROJECT/app/Models/Order.php
touch $PROJECT/app/Models/OrderItem.php

# Buat file Views Customer
touch $PROJECT/resources/views/customer/welcome.blade.php
touch $PROJECT/resources/views/customer/menu.blade.php
touch $PROJECT/resources/views/customer/cart.blade.php
touch $PROJECT/resources/views/customer/checkout.blade.php

# Buat file Views Cashier
touch $PROJECT/resources/views/cashier/dashboard.blade.php
touch $PROJECT/resources/views/cashier/transactions.blade.php
touch $PROJECT/resources/views/cashier/payment.blade.php

# Buat file Views Owner
touch $PROJECT/resources/views/owner/dashboard.blade.php
touch $PROJECT/resources/views/owner/products.blade.php
touch $PROJECT/resources/views/owner/users.blade.php
touch $PROJECT/resources/views/owner/reports.blade.php

echo "Struktur folder & file untuk $PROJECT berhasil dibuat!"
