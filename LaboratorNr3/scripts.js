document.addEventListener('DOMContentLoaded', () => {

    const addButtons = document.querySelectorAll('.btn-add-cart');
    
    addButtons.forEach(button => {
        button.addEventListener('click', function() {
            const img = this.getAttribute('data-img');
            const name = this.getAttribute('data-name');
            const price = this.getAttribute('data-price');
            let cart = JSON.parse(localStorage.getItem('getTechCart')) || [];
            cart.push({ img: img, name: name, price: price });

            localStorage.setItem('getTechCart', JSON.stringify(cart));

            alert(`${name} added to cart!`);
        });
    });

   
    const cartWrapper = document.getElementById('cart-items-wrapper');
    
    if (cartWrapper) {
        let cart = JSON.parse(localStorage.getItem('getTechCart')) || [];

        if (cart.length === 0) {
            cartWrapper.innerHTML = "<p>Your cart is empty.</p>";
        } else {
            cart.forEach((item, index) => {
                const itemHTML = `
                    <div class="cart-item" data-index="${index}">
                        <div class="cart-item-left">
                            <input type="checkbox" class="cart-checkbox" checked>
                            <img src="${item.img}" alt="${item.name}" class="cart-item-img">
                        </div>
                        
                        <div class="cart-item-right">
                            <div class="cart-item-header">
                                <span class="cart-item-title">${item.name}</span>
                                <button class="btn-delete" title="Remove item">🗑️</button>
                            </div>
                            
                            <div class="cart-item-footer">
                                <div class="cart-item-price">${item.price}</div>
                                <div class="cart-qty-wrapper">
                                    <select class="qty-select">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                cartWrapper.insertAdjacentHTML('beforeend', itemHTML);
            });
        }
    }

    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-delete')) {
            const cartItemElement = e.target.closest('.cart-item');
            
            if (cartWrapper) {
                const index = cartItemElement.getAttribute('data-index');
                let cart = JSON.parse(localStorage.getItem('getTechCart')) || [];
                

                cart.splice(index, 1);
                
                localStorage.setItem('getTechCart', JSON.stringify(cart));
                location.reload(); 
            } else {
                cartItemElement.remove();
            }
        }
    });

});