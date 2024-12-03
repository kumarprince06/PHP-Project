document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const tableBody = document.querySelector("#productTable tbody");

  // Event listener for input change
  searchInput.addEventListener("input", () => {
    const query = searchInput.value.trim(); // Define query by getting the input value
    console.log(query);

    // Send AJAX request to the server
    fetch(`${URLROOT}/productController/search`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ searchQuery: query }), // Send the query as JSON data
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Response Data:", data); // Log the response to the console for debugging
        // Clear the table body
        tableBody.innerHTML = "";

        if (data.products.length > 0) {
          // Populate the table with new rows
          data.products.forEach((product) => {
            const row = `
                            <tr>
                                <td>${product.id}</td>
                                <td>${product.name}</td>
                                <td>${product.category_name}</td>
                                <td>${product.stock}</td>
                                <td>₹${parseFloat(
                                  product.selling_price
                                ).toFixed(2)}</td>
                                <td>${product.brand}</td>
                                <td><img src="${URLROOT}/public/images/products/${
              product.image
            }" alt="Product Image" width="60px"></td>
                                <td>
                                    <button class="btn btn-sm btn-info view-product" data-bs-toggle="modal"
                                                data-bs-target="#productDetailModal" data-product='${JSON.stringify(
                                                  product
                                                )}'>
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <a href="${URLROOT}/adminController/editProduct/${
              product.id
            }"><button class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                    <form action="${URLROOT}/productController/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                                        <button class="btn btn-danger text-white btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        `;
            tableBody.insertAdjacentHTML("beforeend", row);
          });
        } else {
          // Display "No products found" message
          const noProductRow = `
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    `;
          tableBody.insertAdjacentHTML("beforeend", noProductRow);
        }
      })
      .catch((error) => console.error("Error:", error));
  });
});
