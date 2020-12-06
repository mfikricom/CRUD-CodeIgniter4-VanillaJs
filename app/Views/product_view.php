<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Include Bulma CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>
<body>
    
    <section class="section">
        <div class="container">
        <!-- Add New Product Button -->
        <a href="/product/create" class="button is-primary mb-3">Add New</a>
        <!-- Product List Table -->
        <table class="table is-bordered is-fullwidth">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th class="has-text-centered">Actions</th>
                </tr>
            </thead>
            <tbody>
            
            </tbody>    
        </table>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Call function showData on loaded content
            showData();
        });

        // show data from database
        const showData = async () => {
            try {
                const response = await fetch('/product/getProduct', {
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                const data = await response.json();
                
                const table = document.querySelector('table tbody');
                let rowData = "";
                data.forEach(({ product_id, product_name, product_price }) => {
                    rowData += `<tr>`;
                    rowData += `<td>${product_name}</td>`;
                    rowData += `<td>${product_price}</td>`;
                    rowData += `<td class="has-text-centered">`;
                    rowData += `<a href="/product/update/${product_id}" class="button is-info is-small">Edit</a>`;
                    rowData += `<a class="button is-danger is-small" data-id="${product_id}">Delete</a>`;
                    rowData += `</td>`;
                    rowData += `</tr>`;
                });
                table.innerHTML = rowData;
            } catch (err) {
                console.log(err);
            }
        }

        // Delete product method
        document.querySelector('table tbody').addEventListener('click', async (event) => {
            const id = event.target.dataset.id;
            try {
                await fetch(`/product/delete/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                }); 
                showData();
            } catch (err) {
                console.log(err);
            }
        });

    </script>
</body>
</html>