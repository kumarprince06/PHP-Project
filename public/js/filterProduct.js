document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const tableBody = document.querySelector("#productTable tbody");
  const paginationContainer = document.querySelector(".pagination");
  let currentPage = 1; // Track current page

  const fetchProducts = (query = "", page = 1) => {
    fetch(`${URLROOT}/productController/search`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ searchQuery: query, page }), // Send query and page as JSON data
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Response Data:", data); // Log the response for debugging
        tableBody.innerHTML = "";

        if (data.products.length > 0) {
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
          const noProductRow = `
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    `;
          tableBody.insertAdjacentHTML("beforeend", noProductRow);
        }

        updatePagination(data.totalPages, data.currentPage);
      })
      .catch((error) => console.error("Error:", error));
  };

  const updatePagination = (totalPages, currentPage) => {
    paginationContainer.innerHTML = "";

    if (totalPages > 1) {
      // Previous Button
      if (currentPage > 1) {
        const prevBtn = `<li class="page-item">
                            <a class="page-link bg-success text-white" href="#" data-page="${
                              currentPage - 1
                            }">Previous</a>
                         </li>`;
        paginationContainer.insertAdjacentHTML("beforeend", prevBtn);
      }

      // Page Numbers
      for (let i = 1; i <= totalPages; i++) {
        const pageBtn = `<li class="page-item ${
          i === currentPage ? "active" : ""
        }">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
                         </li>`;
        paginationContainer.insertAdjacentHTML("beforeend", pageBtn);
      }

      // Next Button
      if (currentPage < totalPages) {
        const nextBtn = `<li class="page-item">
                            <a class="page-link bg-success text-white" href="#" data-page="${
                              currentPage + 1
                            }">Next</a>
                         </li>`;
        paginationContainer.insertAdjacentHTML("beforeend", nextBtn);
      }

      // Add event listeners to pagination buttons
      paginationContainer.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", (e) => {
          e.preventDefault();
          currentPage = parseInt(link.getAttribute("data-page"));
          fetchProducts(searchInput.value.trim(), currentPage);
        });
      });
    }
  };

  // Fetch products on search input change
  searchInput.addEventListener("input", () => {
    currentPage = 1; // Reset to the first page for new search
    fetchProducts(searchInput.value.trim(), currentPage);
  });

  // Initial fetch
  fetchProducts();
});

// view Ordered product detailed

document.addEventListener("DOMContentLoaded", () => {
  const orderModal = document.getElementById("orderModal");
  const productDetailsTable = document.getElementById("productDetailsTable");

  // Event delegation for "View" buttons
  document.body.addEventListener("click", (e) => {
    const viewOrderButton = e.target.closest(".view-order");
    if (viewOrderButton) {
      const orderId = viewOrderButton.getAttribute("data-order-id"); // Get the order ID

      // Send AJAX request to fetch order details
      fetch(`${URLROOT}/orderController/getOrderedProductDetails`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ order_id: orderId }), // Send order ID to the server
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          // Clear the table
          productDetailsTable.innerHTML = "";

          if (data.products && data.products.length > 0) {
            // Populate table with product details
            data.products.forEach((product, index) => {
              const row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${product.product_name}</td>
                                    <td>${product.quantity}</td>
                                    <td>₹${parseFloat(product.price).toFixed(
                                      2
                                    )}</td>
                                    <td>₹${(
                                      product.quantity * product.price
                                    ).toFixed(2)}</td>
                                    <td>
                                        <img src="${URLROOT}/public/images/products/${
                product.image
              }" alt="${product.name}" width="60px">
                                    </td>
                                    
                                </tr>
                            `;
              productDetailsTable.insertAdjacentHTML("beforeend", row);
            });
          } else {
            // If no products are found
            const noDataRow = `
                            <tr>
                                <td colspan="6" class="text-center">No product details available.</td>
                            </tr>
                        `;
            productDetailsTable.insertAdjacentHTML("beforeend", noDataRow);
          }
        })
        .catch((error) => {
          console.error("Error fetching product details:", error);
          productDetailsTable.innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center text-danger">Failed to load product details.</td>
                        </tr>
                    `;
        });
    }
  });
});
