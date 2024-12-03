document.addEventListener("DOMContentLoaded", () => {
  // Get references to the search input, table rows, and table body
  const searchInput = document.getElementById("searchInput");
  const tableBody = document.querySelector("#productTable tbody");
  const tableRows = document.querySelectorAll("#productTable tbody tr");

  // Function to filter table rows
  const filterTable = () => {
    const query = searchInput.value.trim().toLowerCase(); // Get input value
    let visibleRowCount = 0; // Track number of visible rows

    // Loop through each row and filter based on the query
    tableRows.forEach((row) => {
      const productName = row.cells[1].textContent.toLowerCase(); // Product Name
      const categoryName = row.cells[2].textContent.toLowerCase(); // Category
      const brandName = row.cells[5].textContent.toLowerCase(); // Brand

      // Check if the query matches any of the relevant fields
      if (
        productName.includes(query) ||
        categoryName.includes(query) ||
        brandName.includes(query)
      ) {
        row.style.display = ""; // Show row
        visibleRowCount++; // Increment visible row count
      } else {
        row.style.display = "none"; // Hide row
      }
    });

    // Check if there are no visible rows and show "No products found" if needed
    let noProductRow = document.getElementById("noProductRow"); // Check for existing "No products found" row
    if (visibleRowCount === 0) {
      if (!noProductRow) {
        // Create a new "No products found" row if it doesn't exist
        noProductRow = document.createElement("tr");
        noProductRow.id = "noProductRow";
        noProductRow.innerHTML = `
                    <td colspan="8" class="text-center">No products found.</td>
                `;
        tableBody.appendChild(noProductRow);
      }
    } else {
      // Remove the "No products found" row if visible rows exist
      if (noProductRow) {
        noProductRow.remove();
      }
    }
  };

  // Attach the real-time search handler to the input field
  searchInput.addEventListener("input", filterTable);
});
