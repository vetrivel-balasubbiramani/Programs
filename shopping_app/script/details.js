function ProductViewModel() {
  const self = this;
  self.cartCount = ko.observable(0);
  self.selectedProduct = ko.observable();
  self.getCartData = function () {
    const cartData = sessionStorage.getItem("cart");
    return cartData ? JSON.parse(cartData) : {};
  };
  self.calculateCartCount = function () {
    const cart = self.getCartData();
    return Object.values(cart).reduce((totalCount, item) => totalCount + item.quantity, 0);;
  };
  self.addToCart = function () {
    const product = self.selectedProduct();
    const quantity = parseInt(product.quantity, 10);

    if (!isNaN(quantity) && quantity > 0) {
      const cart = self.getCartData();
      if (cart.hasOwnProperty(product.name)) {
        cart[product.name].quantity += quantity;
      } else {
        cart[product.name] = {
          quantity: quantity,
          price: product.price,
        };
      }
      sessionStorage.setItem("cart", JSON.stringify(cart));
      self.cartCount(self.calculateCartCount());
      alert(`${quantity} ${product.name}(s) added to cart!`);
    } else {
      alert("Please select a valid quantity.");
    }
  };
  ko.computed(function () {
    const selectedProductJSON = sessionStorage.getItem("selectedProduct");
    if (selectedProductJSON) {
      const parsedProduct = JSON.parse(selectedProductJSON);
      self.selectedProduct(parsedProduct);
      self.cartCount(self.calculateCartCount());
    }
  });
}
const viewModel = new ProductViewModel();
ko.applyBindings(viewModel);
