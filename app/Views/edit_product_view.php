<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
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
                    <input class="input" name="productName" type="text" value="<?= esc($data['product_name'])?>" placeholder="Product Name">
                </div>
            </div>

            <div class="field">
                <label class="label">Price</label>
                <div class="control">
                    <input class="input" name="productPrice" type="text" value="<?= esc($data['product_price'])?>" placeholder="Price">
                </div>
            </div>

            <div class="control">
                <!-- Input Hidden ID -->
                <input type="hidden" name="productId" value="<?= esc($data['product_id'])?>">
                <button class="button is-primary">UPDATE</button>
            </div>

        </form>
        </div>
    </section>
    <script>
        const form = document.querySelector('form');

        // update product to database
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const product_id = form.productId.value;
            const product_name = form.productName.value;
            const product_price = form.productPrice.value;

            try {
                await fetch(`/product/update/${product_id}`, {
                    method: "PUT",
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