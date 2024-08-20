// Cart Variables
let cart = JSON.parse(localStorage.getItem('cart')) || [];
const cartIcon = document.querySelector('.cart-icon');
const cartModal = document.querySelector('.cart-modal');
const closeModal = document.querySelector('.cart-close');
const cartItemsContainer = document.querySelector('.cart-items');
const totalPriceElement = document.querySelector('.total-price');
const clearCartButton = document.querySelector('.clear-cart');

// Show cart modal
cartIcon.addEventListener('click', () => {
  cartModal.style.display = 'block';
  renderCartItems();
  updateTotal();
});

// Close cart modal
closeModal.addEventListener('click', () => {
  cartModal.style.display = 'none';
});

// Add product to cart
function addToCart(productId, name, price, image) {
  const existingProduct = cart.find(product => product.id === productId);
  if (existingProduct) {
    alert(`The product "${name}" is already in your cart.`);
  } else {
    const newProduct = { id: productId, name, price, image, quantity: 1 };
    cart.push(newProduct);
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCartItems();
    updateTotal();
  }
}

// Remove product from the cart
function removeFromCart(productId) {
  cart = cart.filter(product => product.id !== productId);
  localStorage.setItem('cart', JSON.stringify(cart));
  renderCartItems();
  updateTotal();
}

// Update product quantity
function updateQuantity(productId, newQuantity) {
  const product = cart.find(product => product.id === productId);
  if (product && newQuantity > 0) {
    product.quantity = newQuantity;
    localStorage.setItem('cart', JSON.stringify(cart));
    renderCartItems();
    updateTotal();
  } else if (newQuantity <= 0) {
    removeFromCart(productId);
  }
}

// Clear the entire cart
clearCartButton.addEventListener('click', () => {
  cart = [];
  localStorage.setItem('cart', JSON.stringify(cart));
  renderCartItems();
  updateTotal();
});

// Render cart items
function renderCartItems() {
  cartItemsContainer.innerHTML = '';
  cart.forEach(product => {
    const cartItem = `
      <div class="cart-box">
        <img src="../../images/products/${product.image}" class="cart-img" alt="${product.name}">
        <div class="detail-box">
          <div class="cart-food-title">${product.name}</div>
          <div class="price-box">
            <div class="cart-price">Price: ${product.price.toFixed(2)} Rwf</div>
            <div class="cart-amt">Total: ${(product.price * product.quantity).toFixed(2)} Rwf</div>
          </div>
          <input type="number" value="${product.quantity}" class="cart-quantity" data-id="${product.id}">
        </div>
        <ion-icon name="trash-outline" class="cart-remove" data-id="${product.id}"></ion-icon>
        <!-- Fallback icon if Ionicon doesn't load -->
        <span class="cart-remove-fallback" data-id="${product.id}">🗑️</span>
      </div>
    `;
    cartItemsContainer.insertAdjacentHTML('beforeend', cartItem);
  });

  // Handle quantity changes
  document.querySelectorAll('.cart-quantity').forEach(input => {
    input.addEventListener('change', (e) => {
      const newQuantity = parseInt(e.target.value);
      const productId = parseInt(e.target.getAttribute('data-id'));
      updateQuantity(productId, newQuantity);
    });
  });

  // Handle removing items using ion-icon or fallback icon
  document.querySelectorAll('.cart-remove, .cart-remove-fallback').forEach(icon => {
    icon.addEventListener('click', (e) => {
      const productId = parseInt(e.target.getAttribute('data-id'));
      removeFromCart(productId);
    });
  });
}

// Update total price
function updateTotal() {
  const total = cart.reduce((sum, product) => sum + product.price * product.quantity, 0);
  totalPriceElement.innerText = `Total: ${total.toFixed(2)} Rwf`;
  document.querySelector('.cart-badge').innerText = cart.length;
}

// Add to cart buttons functionality
document.querySelectorAll('.add-to-cart').forEach(button => {
  button.addEventListener('click', (e) => {
    const productId = parseInt(button.getAttribute('data-id'));
    const name = button.getAttribute('data-name');
    const price = parseFloat(button.getAttribute('data-price'));
    const image = button.getAttribute('data-image');
    addToCart(productId, name, price, image);
  });
});
