// Fetch products from JSON
async function fetchProducts() {
    const response = await fetch('products.json'); // Ensure products.json is in the same directory
    return await response.json();
}

// Load products dynamically based on the category
async function loadProducts() {
    const products = await fetchProducts();
    const productList = document.getElementById("product-list");

    // Filter products by category
    const filteredProducts = products.filter(product => product.category === category);

    if (filteredProducts.length === 0) {
        productList.innerHTML = "<p>No products found for this category.</p>";
        return;
    }

    filteredProducts.forEach(product => {
        const productCard = `
            <div class="product-card">
                <img src="${product.image_url}" alt="${product.product_name}" class="product-image">
                <h3>${product.product_name}</h3>
                <p>Brand: ${product.brand_name}</p>
                <p class="price">Price: $${product.price_usd}</p>
                <p>Size: ${product.size_ml} ml</p>
                <p>Main Ingredient: ${product.main_ingredient}</p>
                <p>Packaging: ${product.packaging}</p>
                <p>pH Level: ${product.ph_level}</p>
                <p>Rating: ⭐ ${product.rating} / 5</p>
                <p>Sustainable Packaging: ${product.sustainable_packaging}</p>
                <button onclick="addToCart('${product.product_name}', ${product.price_usd})">Add to Cart</button>
            </div>
        `;
        productList.innerHTML += productCard;
    });
}

// Add to Cart Functionality
let cart = [];
function addToCart(productName, price) {
    cart.push({ productName, price });
    alert(`${productName} added to cart!`);
    updateCartCount();
}

// Update Cart Count
function updateCartCount() {
    const cartCount = document.getElementById("cart-count");
    cartCount.textContent = cart.length;
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
        sortedCards = productCards.sort((a, b) =>
            parseFloat(a.querySelector(".price").textContent.replace("$", "")) -
            parseFloat(b.querySelector(".price").textContent.replace("$", ""))
        );
    } else if (sortOption === "price-high-low") {
        sortedCards = productCards.sort((a, b) =>
            parseFloat(b.querySelector(".price").textContent.replace("$", "")) -
            parseFloat(a.querySelector(".price").textContent.replace("$", ""))
        );
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
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        button.style.display = "block";
    } else {
        button.style.display = "none";
    }
};

// Call the function to load products on page load
loadProducts();
