
function ProductViewModel() {
  const self = this;

  self.cartCount = ko.observable(0);
  self.selectedCategory = ko.observable('all');

  self.products = [
    

  { name: 'realme 11X 5G', 
category: 'Mobiles', 
image:'p1',
price:'Rs.25000',
des:'6 GB RAM | 128 GB ROM | 17.25cm (6.79 inch) Full HD Display | 50MP + 2MP 8MP Front Camera',
quantity: ko.observable(1) ,
add:'This Poco M6 Pro 5G is a resourceful smartphone helping you to carry out a horde of tasks effortlessly. Equipped with a 4nm Snapdragon processor, Turbo RAM for quick multitasking, 50 MP Dual AI Camera, and 5000 mAh mammoth battery capacity, this phone can be your best companion for all your voyages. It has a premium glass design that comes in a 16.24 cm (6.79) display and has a 90 Hz refresh rate for seamless navigation.'
}, 

{ name: 'vivo T2X 5G', 
category: 'Mobiles', 
image:'p2',
price:'Rs.32000',
des: '8 GB RAM | 128 GB ROM | 16.71 cm (6.58 inch) Full HD+ Display 50MP + 2MP  8MP Front Camera',
quantity: ko.observable(1) ,
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.'
},

{ name: 'redmi note 12', 
category: 'Mobiles', 
image:'p3',
price:'Rs.17000',
des:'6 GB RAM | 128 GB ROM | 17.25 cm (6.79 inch) Full HD+ Display | 50MP + 8MP + 2MP | 8MP Front Camera',
quantity: ko.observable(1) ,
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.'
},

{ name: 'oneplus nord 2', 
category: 'Mobiles', 
image:'p4',
price:'Rs.24000',
des: '8 GB RAM | 128 GB ROM | 16.71 cm (6.58 inch) Full HD+ Display 50MP + 2MP  8MP Front Camera',
quantity: ko.observable(1) ,
add:'This Poco M6 Pro 5G is a resourceful smartphone helping you to carry out a horde of tasks effortlessly. Equipped with a 4nm Snapdragon processor, Turbo RAM for quick multitasking, 50 MP Dual AI Camera, and 5000 mAh mammoth battery capacity, this phone can be your best companion for all your voyages. It has a premium glass design that comes in a 16.24 cm (6.79) display and has a 90 Hz refresh rate for seamless navigation.'
},

{ name: 'poco m6 5G', 
category: 'Mobiles', 
image:'p5',
price:'Rs.15000',
des:'6 GB RAM | 128 GB ROM | 17.25cm (6.79 inch) Full HD Display | 50MP + 2MP 8MP Front Camera',
quantity: ko.observable(1) ,
add:'The POCO C55 smartphone features a powerful MediaTek Helio G85 processor with 1 GHz of GPU enabling you with a smooth and hassle-free gaming experience or multitasking. It has 6 GB of Turbo RAM with an expandable RAM of up to 11 GB that allows you to switch between apps quickly. This smartphone’s leather-like texture with stitches on the panel gives it a classy look. The 50 MP dual camera featured in this smartphone has a night mode and HDR mode so you can capture life-like images. You can also enjoy long-lasting battery life with the 5000 mAh battery.'
},

{ name: 'Dell i3 X1', 
category: 'Laptops', 
image:'k1',
price:'Rs.45000',
des:'(8 GB/512 GB SSD/Windows 11 Home) New Inspiron 15 Laptop Thin and Light Laptop  (38 cm, Carbon Black, 1.65 Kg, With MS Office)',
quantity: ko.observable(1) ,
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.'    
},

{ name: 'Asus ryzen5 H', 
category: 'Laptops', 
image:'k2',
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.',
price:'Rs.52000',
des: '16 GB/512 GB SSD/Windows 11 Home/4 GB Graphics) M6500QFB-LK741WS Thin and Light Laptop  (15.6 Inch, Quiet Blue, 1.80 Kg, With MS Office)',
quantity: ko.observable(1) 
},

{ name: 'Lenovo v15', 
category: 'Laptops', 
image:'k3',
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.',
price:'Rs.67000',
quantity: ko.observable(1) ,
des:'8 GB/512 GB SSD/Windows 11 Home) V15 G2 ALC Thin and Light Laptop  (15.6 Inch, Black, 1.7 Kg)'
},

{ name: 'HP 15s', 
category: 'Laptops', 
image:'k4',
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.',
price:'Rs.54000',
quantity: ko.observable(1) ,
des: '16 GB/512 GB SSD/Windows 11 Home) 15s-fr4001TU Thin and Light Laptop  (15.6 Inch, Natural Silver, 1.69 Kg, With MS Office)'
},

{ name: 'Acer One', 
category: 'Laptops', 
image:'k5',
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.',
price:'Rs.35000',
quantity: ko.observable(1) ,
des:'8 GB/512 GB SSD/Windows 11 Home) Z8-415 Thin and Light Laptop  (14 Inch, Silver, 1.49 Kg)'
},

{ name: 'Mi tv', 
category: 'Television', 
image:'t1',
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.',
price:'Rs.21000',
quantity: ko.observable(1) ,
des:'(43 inch) Ultra HD (4K) LED Smart Android TV with Dolby Vision and 30W Dolby Audio (2022 Model)'
},

{ name: 'LG tv', 
category: 'Television', 
image:'t2',
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.',
price:'Rs.12000',
quantity: ko.observable(1) ,
des: '(32 inch) HD Ready LED Smart WebOS TV  (32LM565BPTA)'
},

{ name: 'Realme tv', 
category: 'Television', 
image:'t4',
add:'With the superb Vivo T2x 5G, you can take advantage of great pictures and a flawless user experience. With the Vivo T2x 5G, you can experience exceptional performance owing to its 7 nm 5G CPU, the octa-core Dimensity 6020, with a top clock speed of 2.2 GHz. Additionally, the 50 MP main camera on this smartphone beautifully catches every detail you see. Additionally, Super Night Selfie employs noise cancellation technology in conjunction with an Aura Screen Light to produce a calming light that is effective in low light. The pioneering Extended RAM 3.0 technology also uses ROM to expand RAM with a maximum capacity of 8 GB. This enables smooth app switching and allows up to 27 active applications to run in the background.',
price:'Rs.24000',
quantity: ko.observable(1) ,
des: '16 GB(32 inch) HD Ready LED Smart Android TV  (TV 32)/)'
}, 
  ];

  self.updateCartCount = function() {
    const cartData = sessionStorage.getItem('cart');
    const cart = cartData ? JSON.parse(cartData) : {};

    let totalCount = 0;

    for (const productName in cart) {
      totalCount += cart[productName].quantity;
    }

    self.cartCount(totalCount);
  };

  self.filteredProducts = ko.computed(function() {
    const category = self.selectedCategory();
    return category === 'all' ? self.products : self.products.filter(product => product.category === category);
  });
  self.showProductDetails = function (product) {
    sessionStorage.setItem('selectedProduct', ko.toJSON(product));
    window.location.href = 'details.html';
  };

  self.addToCart = function(product, quantity) {
if (quantity > 0) {
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
self.updateCartCount();
alert(`${quantity} ${product.name}(s) added to cart!`);
} else {
alert('Please select a valid quantity.');
}
};

  self.updateCartCount();
}

const viewModel = new ProductViewModel();
ko.applyBindings(viewModel);
