<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <!-- Include Bulma CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>
<body>
    <section class="section">
        <div class="container">
        <form>
            <div class="field">
                <label class="label">Product Name</label>
                <div class="control">
                    <input class="input" name="productName" type="text" placeholder="Product Name">
                </div>
            </div>

            <div class="field">
                <label class="label">Price</label>
                <div class="control">
                    <input class="input" name="productPrice" type="text" placeholder="Price">
                </div>
            </div>

            <div class="control">
                <button class="button is-primary">SAVE</button>
            </div>

        </form>
        </div>
    </section>
    <script>
        const form = document.querySelector('form');
        
        // save product to database 
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const product_name = form.productName.value;
            const product_price = form.productPrice.value;

            try {
                await fetch('/product/create', {
                    method: "POST",
                    body: JSON.stringify({ product_name, product_price }),
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }); 
                location.assign('/product');
            } catch (err) {
                console.log(err);
            }
        });
        
    </script>
</body>
</html>