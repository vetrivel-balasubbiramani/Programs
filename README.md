ProjectRequirements:

You can create a shopping app with PLP and PDP
PLP - have 4 product categories with 5 products under each category        
    - each product should have an image and product name, price, quantity and add to cart        
    - clicking on product image should take to the PDPPDP 
PDP - you need to have a PDP for every product         
    - each product should have an image and product name, price, quantity and add to cart         
    - a brief description about the product should be provided         
    - you need to have a different landing page for PDP
Cart - you can show the products in cart with quantity and total price

SolutionApproach:

1.index.html 
*A html page which contains listed products of  a category and the option to change the products based on category using filter.
*Storing product data in a JavaScript array or json format. Each product object should contain properties like name, price, quantity, image and description.
*Add to cart button is also added for the product
2.details.html
*When user clicks the product image or the name, it should redirect to this page
*This page contains the brief description about the product and it also has the add to cart button.
3.cart.html
*Clicking on add to cart button , redirects to this page*It displays the products in the cart with their quantities and total price. Updating the cart ui using knockout when items are added or removed.
