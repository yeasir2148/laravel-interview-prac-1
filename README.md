# Laravel Interview Practical

The website in this repository has many bugs and hasn't been written very well. The parts below are designed to test how you address these problems and add new features.

We aren't worried about page layout or styling.

***Please clone this repository and commit your changes for each part.***

## Part 1
- Improve the routing used in the site.
- Add validation to the new product process and make sure the product's name is unique.

## Part 2
- Fix any security issues you notice in the controller.
- Fix any security issues, bugs / make improvements to the blade template (don't worry about layout and styling).

## Part 3
Currently the "description" field in the form doesn't do anything.
- Please update the products table to include a "description" field, and populate it from this form.

## Part 4
- Create a new Product service class (perhaps in App/Service/Product) whose job it is to manage a product.
- Refactor the code so that this new class is doing the work for *new()* and *delete()* instead of the controller.

## Part 5
Currently the "tags" field in the form doesn't do anything. We would like to create tags for new products:
- Create a new Tag model, and a new pivot table to link the Products to the Tags (many-to-many).
- Take the tags string when the form is submitted and split it by commas.
- Create a tag for each save it - but only if it's unique.
- Link the product to each one (whether the tags were new or existed from before).

## Part 6
- Fire a new ProductCreated event when a product is created.
- Listen for the ProductCreated event and send a simple notification to all the users to let them know that it was created.
