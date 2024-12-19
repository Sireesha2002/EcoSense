# EcoSense
### README: EcoSense Skincare Web Application

### Project Overview
EcoSense Skincare is a web-based application designed to showcase and manage skincare products across various categories. The project enables users to explore products, add them to their cart, and manage their shopping experience. It also includes functionalities for user authentication and admin-level user management.

#### Features
1. **User Functionality:**
   - Login and Signup pages for authentication.
   - Browse products by category (e.g., Cleanser, Moisturizer).
   - Add products to a shopping cart and manage quantities.
   - Search and sort products dynamically.

2. **Admin Dashboard:**
   - Manage user accounts (view, delete).
   - Add, update, and delete product information.
   - View user carts and activity.

3. **Responsive Design:**
   - Aesthetic olive-green theme with a consistent layout.
   - Optimized for desktop and mobile devices.

4. **Dynamic Product Display:**
   - Products fetched dynamically from a database or JSON file.
   - Filter and sort options for an enhanced user experience.

5. **Technologies Used:**
   - **Frontend:** HTML, CSS, JavaScript (with AJAX for dynamic content loading).
   - **Backend:** PHP for server-side scripting.
   - **Database:** MySQL (via phpMyAdmin).
   - **Styling:** Olive-green aesthetic theme and gradients.

#### **Directory Structure**

project/
├── assets/
│   ├── css/
│   │   └── styles.css        # Application-wide styling
│   ├── images/               # Product and background images
│   ├── js/
│       └── category-script.js # JavaScript for product categories
├── includes/
│   ├── db_connection.php     # Database connection script
│   ├── header.php            # Reusable header
│   ├── footer.php            # Reusable footer
├── public/
│   ├── index.php             # Home page
│   ├── categories.php        # Categories page
│   ├── cleanser.php          # Cleanser-specific page
│   ├── cart.php              # Shopping cart
│   ├── login.php             # User login
│   ├── signup.php            # User registration
├── admin/
│   ├── user_dashboard.php    # Admin user management
│   ├── product_dashboard.php # Admin product management
├── sql/
│   └── schema.sql            # Database schema for setup
└── README.md                 # Project documentation

### **Database Schema**
- **Users Table:**
  - `id`: Primary Key
  - `username`: User's name
  - `email`: User's email (unique)
  - `password_hash`: Encrypted password

- **Categories Table:**
  - `id`: Primary Key
  - `name`: Category name
  - `image_path`: Image path for the category

- **Products Table:**
  - `id`: Primary Key
  - `name`: Product name
  - `price`: Product price
  - `category`: Associated category
  - `image_path`: Image path for the product

- **Cart Table:**
  - `id`: Primary Key
  - `user_id`: Foreign key (links to Users table)
  - `product_id`: Foreign key (links to Products table)
  - `quantity`: Number of items in the cart

#### **Setup Instructions**
1. **Database Setup:**
   - Import the `schema.sql` file into phpMyAdmin to create necessary tables.

2. **Application Setup:**
   - Place all project files in a web server directory (e.g., XAMPP `htdocs` folder).
   - Update `db_connection.php` with your database credentials.

3. **Run the Application:**
   - Open `index.php` in your browser to explore the application.

#### **Key Screens**
1. **Home Page:** Introduction and navigation to categories.
2. **Login/Signup Pages:** User authentication.
3. **Admin Dashboard:** Manage users and products.
4. **Cleanser Page:** Example of a dynamically populated product page.

#### **Future Enhancements**
- Advanced filtering and recommendation system.
- Payment gateway integration.
- User reviews and ratings for products.

#### **Credits**
Developed by TEAM MEMBERS:
- JYOSTNA SREE SOMISETTY,
- SIREESHA KUCHIMANCHI, 
- MEGHANA VEERLA,
- SREE RAMA VIJAY TUMMALAPALLI 
- SAITEJA THODIGOPPULA
as part of the EcoSense Skincare project.

This README provides an overview of the application, including its functionality, structure, and setup instructions, to assist in deployment and usage.
