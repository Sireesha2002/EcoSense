// Get the current page URL path
const currentPage = window.location.pathname.split('/').pop();

// Get all menu items
const menuItems = document.querySelectorAll('.nav-links');

// Loop through the menu items and add the "active" class to the matching page
menuItems.forEach(item => {
    const page = item.getAttribute('data-page');
    if (currentPage.includes(page)) {
        item.classList.add('active');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const categoriesLink = document.querySelector('a[href="categories.html"]');
    if (categoriesLink) {
        categoriesLink.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior
            fetch('php/fetch_categories.php')
                .then(response => response.json())
                .then(data => {
                    const categories = data.categories;
                    const mainContent = document.querySelector('main');
                    if (mainContent) {
                        mainContent.innerHTML = `
                                    <div class="categories-container">
                                        <h2>Categories</h2>
                                        <div class="categories-grid">
                                            ${categories
                                .map(category => `
                                                    <div class="category-tile">
                                                        <img src="assets/images/${category.toLowerCase().replace(/\s+/g, '_')}.png" alt="${category}" class="category-image" />
                                                        <p>${category}</p>
                                                    </div>
                                                `)
                                .join('')}
                                        </div>
                                    </div>`;
                    }
                })
                .catch(error => console.error('Error fetching categories:', error));
        });
    }
});
