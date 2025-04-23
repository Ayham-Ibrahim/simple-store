import './bootstrap';
// public/js/app.js

document.addEventListener("DOMContentLoaded", () => {

    // --- Favorites Logic (Using LocalStorage) ---
    // Initialize favorites from LocalStorage using a unique key, store array of product IDs
    let favorites = JSON.parse(localStorage.getItem('azadiMarketFavorites')) || [];

    // Function to update favorites data in LocalStorage
    function updateFavoritesLocalStorage() {
        localStorage.setItem('azadiMarketFavorites', JSON.stringify(favorites));
        console.log('Favorites updated:', favorites);
    }

    // Function to toggle favorite status for a product
    function toggleFavorite(element) {
        const productId = element.dataset.productId; // Get product ID from data attribute
        if (!productId) {
            console.error("Product ID not found for favorite toggle", element);
            return;
        }

        const index = favorites.indexOf(productId); // Find product ID in the array

        if (index > -1) {
            // Product is currently favorite, remove it
            favorites.splice(index, 1);
            element.classList.remove("active"); // Update visual state
            console.log(`Product ${productId} removed from favorites`);
        } else {
            // Product is not favorite, add it
            favorites.push(productId);
            element.classList.add("active"); // Update visual state
            console.log(`Product ${productId} added to favorites`);
        }

        updateFavoritesLocalStorage(); // Save changes
    }

    // Attach event listener to Favorite icons using Event Delegation
    document.body.addEventListener('click', function(event) {
        // Check if the clicked element OR its parent is the favorite icon container
        const favoriteIconContainer = event.target.closest('.favorite-icon');
        if (favoriteIconContainer) {
            toggleFavorite(favoriteIconContainer); // Pass the container element
        }
    });


    // Function to apply 'active' class to favorite icons on page load
    function applyFavoriteStatus() {
        const favoriteIcons = document.querySelectorAll(".favorite-icon");
        favoriteIcons.forEach(iconContainer => {
            const productId = iconContainer.dataset.productId;
            if (productId && favorites.includes(productId)) {
                iconContainer.classList.add("active");
            } else {
                iconContainer.classList.remove("active"); // Ensure it's inactive if not in favorites
            }
        });
        console.log("Applied initial favorite statuses based on:", favorites);
    }

    // --- Initial Setup Calls ---
    applyFavoriteStatus(); // Set initial visual state for favorite icons

    // Note: All cart-related functions (addToCart, updateCartLocalStorage for cart,
    // updateCartCountIndicator, and the 'add-to-cart-btn' click listener)
    // have been removed from this file.

}); // End of DOMContentLoaded
