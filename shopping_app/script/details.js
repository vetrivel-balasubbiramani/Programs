

function ProductViewModel() {
  const self = this;

  self.cartCount = ko.observable(0);

  self.selectedProduct = ko.observable();

  self.calculateCartCount = function() {
    const cartData = sessionStorage.getItem('cart');
    const cart = cartData ? JSON.parse(cartData) : {};

    let totalCount = 0;

    for (const productName in cart) {
      totalCount += cart[productName].quantity;
    }

    return totalCount;
  };

  self.addToCart = function() {
    const product = self.selectedProduct();
    const quantity = parseInt(product.quantity, 10);

    if (!isNaN(quantity) && quantity > 0) { <script data-main="index" src="require.js"> </script>
      const cartData = sessionStorage.getItem('cart');
      const cart = cartData ? JSON.parse(cartData) : {};

      if (cart.hasOwnProperty(product.name)) {
        cart[product.name].quantity += quantity;
      } else {
        cart[product.name] = {
          quantity: quantity,
          price: product.price
        };
      }

      sessionStorage.setItem('cart', JSON.stringify(cart));
      self.cartCount(self.calculateCartCount());
      alert(`${quantity} ${product.name}(s) added to cart!`);
    } else {
      alert('Please select a valid quantity.');
    }
  };

  ko.computed(function () {
    const selectedProductJSON = sessionStorage.getItem('selectedProduct');
    if (selectedProductJSON) {
      const parsedProduct = JSON.parse(selectedProductJSON);
      self.selectedProduct(parsedProduct);
      self.cartCount(self.calculateCartCount());
    }
  });
}

const viewModel = new ProductViewModel();
ko.applyBindings(viewModel);

