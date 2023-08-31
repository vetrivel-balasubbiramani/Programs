
  
  function CartViewModel() {
  const self = this;

  self.cartData = sessionStorage.getItem('cart');
  self.cart = self.cartData ? JSON.parse(self.cartData) : {};

  self.cartItems = ko.observableArray([]);

  for (const productName in self.cart) {
    if (self.cart.hasOwnProperty(productName)) {
      const item = self.cart[productName];
      const itemTotalPrice = item.quantity * parseFloat(item.price.replace('Rs.', '').replace(',', ''));
      self.cartItems.push({
        name: productName,
        quantity: item.quantity,
        totalPrice: `Rs.${itemTotalPrice.toFixed(2)}`
      });
    }
  }

  self.totalCartValue = ko.computed(function () {
    let total = 0;
    self.cartItems().forEach(item => {
      total += parseFloat(item.totalPrice.replace('Rs.', '').replace(',', ''));
    });
    return total.toFixed(2);
  });
}

const viewModel = new CartViewModel();
ko.applyBindings(viewModel);

