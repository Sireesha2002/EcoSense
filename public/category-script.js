// Fetch products from JSON
async function fetchProducts() {
    try {
        const response = await fetch('products.json');
        if (!response.ok) {
            throw new Error('Failed to fetch products');
        }
        return await response.json();
    } catch (error) {
        console.error('Error fetching products:', error);
        const productList = document.getElementById("product-list");
        if (productList) {
            productList.innerHTML = "<p>Error loading products. Please try again later.</p>";
        }
        return [];
    }
}

// Load products dynamically based on the category
async function loadProducts() {
    // Check if category is defined, if not try to extract from page title
    if (typeof category === 'undefined') {
        const pageTitle = document.querySelector('title').textContent.replace(' Products', '');
        window.category = pageTitle;
    }

    const products = await fetchProducts();
    const productList = document.getElementById("product-list");

    // Filter products by category (case-insensitive)
    const filteredProducts = products.filter(product => 
        product.category.toLowerCase() === category.toLowerCase()
    );

    if (filteredProducts.length === 0) {
        if (productList) {
            productList.innerHTML = "<p>No products found for this category.</p>";
        }
        return;
    }

    // Clear existing content
    if (productList) {
        productList.innerHTML = '';

        filteredProducts.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.innerHTML = `
                <img src="${product.image_path}" alt="${product.product_name}" class="product-image" onerror="this.onerror=null; this.src='images/placeholder.jpg';">
                <h3>${product.product_name}</h3>
                <p>Brand: ${product.brand_name}</p>
                <p class="price">Price: $${product.price_usd.toFixed(2)}</p>
                <p>Size: ${product.size_ml} ml</p>
                <p>Main Ingredient: ${product.main_ingredient}</p>
                <p>Packaging: ${product.packaging}</p>
                <p>pH Level: ${product.ph_level}</p>
                <p>Rating: ⭐ ${product.rating} / 5</p>
                <p>Sustainable Packaging: ${product.sustainable_packaging}</p>
                <button onclick="redirectToDetail('${product.product_id}')">View Details</button>
            `;
            productList.appendChild(productCard);
        });
    }
}

// Redirect to product detail page
function redirectToDetail(productId) {
    localStorage.setItem("selectedProduct", productId);
    window.location.href = "product-detail.html";
}

// Cart Management (remains unchanged)
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(productName, price) {
    const existingProduct = cart.find(item => item.productName === productName);
    
    if (existingProduct) {
        existingProduct.quantity++;
    } else {
        cart.push({ 
            productName, 
            price, 
            quantity: 1 
        });
    }

    // Save to local storage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    alert(`${productName} added to cart!`);
    updateCartCount();
}

// Update Cart Count
function updateCartCount() {
    const cartCount = document.getElementById("cart-count");
    if (cartCount) {
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = totalItems;
    }
}

// Search Products
function filterProducts() {
    const searchInput = document.getElementById("search-input").value.toLowerCase();
    const productCards = document.querySelectorAll(".product-card");

    productCards.forEach(card => {
        const productName = card.querySelector("h3").textContent.toLowerCase();
        card.style.display = productName.includes(searchInput) ? "block" : "none";
    });
}

// Sort Products
function sortProducts() {
    const sortOption = document.getElementById("sort-options").value;
    const productList = document.getElementById("product-list");
    const productCards = Array.from(productList.children);

    let sortedCards;
    if (sortOption === "price-low-high") {
        sortedCards = productCards.sort((a, b) => {
            const priceA = parseFloat(a.querySelector(".price").textContent.replace("Price: $", ""));
            const priceB = parseFloat(b.querySelector(".price").textContent.replace("Price: $", ""));
            return priceA - priceB;
        });
    } else if (sortOption === "price-high-low") {
        sortedCards = productCards.sort((a, b) => {
            const priceA = parseFloat(a.querySelector(".price").textContent.replace("Price: $", ""));
            const priceB = parseFloat(b.querySelector(".price").textContent.replace("Price: $", ""));
            return priceB - priceA;
        });
    } else if (sortOption === "name-az") {
        sortedCards = productCards.sort((a, b) =>
            a.querySelector("h3").textContent.localeCompare(b.querySelector("h3").textContent)
        );
    } else if (sortOption === "name-za") {
        sortedCards = productCards.sort((a, b) =>
            b.querySelector("h3").textContent.localeCompare(a.querySelector("h3").textContent)
        );
    } else {
        return; // No sorting
    }

    // Clear and re-add sorted cards
    productList.innerHTML = "";
    sortedCards.forEach(card => productList.appendChild(card));
}

// Scroll to Top Functionality
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

// Show Back-to-Top Button on Scroll
window.onscroll = function () {
    const button = document.getElementById("back-to-top");
    if (button) {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    }
};

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    loadProducts();
});
