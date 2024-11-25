<?php require APPROOT . '/views/admin/header.php'; ?>
<?php flashMessage('successMessage'); ?>
<?php flashErrorMessage('errorMessage'); ?>
<main id="main">
    <section class="inventory-revenue-charts mb-4">
        <div class="container-fluid inventory-page">
            <!-- Top Row with Heading and Add Button -->
            <div class="row g-3 justify-content-between mb-3">
                <div class="col-md-4">
                    <h5>Category</h5>
                </div>
                <div class="col-md-3 text-end">
                    <!-- Button to Open Add Modal -->
                    <button type="button" class="btn btn-success fw-bold text-white" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        + Add New Category
                    </button>
                </div>
            </div>

            <!-- Table with Categories -->
            <table class="w-100 table-responsive table-bordered text-center rounded">
                <thead class="bg-success text-white">
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the categories array and display each category
                    foreach ($data['category'] as $category) : ?>
                        <tr>
                            <td><?php echo $category->id; ?></td>
                            <td><?php echo $category->name; ?></td>
                            <td>
                                <!-- View Button to Trigger View Modal -->
                                <button
                                    class="btn btn-warning fw-bold text-white view-btn"
                                    data-id="<?php echo $category->id; ?>"
                                    data-name="<?php echo htmlspecialchars($category->name); ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewCategoryModal">
                                    View
                                </button>
                                <?php if ($_SESSION['sessionData']['role'] === 'admin') : ?>
                                    <!-- Edit Button to Trigger Edit Modal -->
                                    <button
                                        class="btn btn-primary fw-bold text-white edit-btn"
                                        data-id="<?php echo $category->id; ?>"
                                        data-name="<?php echo htmlspecialchars($category->name); ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editCategoryModal">
                                        Edit
                                    </button>
                                    <!-- Form for delete operation -->
                                    <form action="<?php echo URLROOT ?>/categoryController/delete/<?php echo $category->id ?>" method="POST" style="display:inline;">
                                        <button class="btn btn-danger fw-bold text-white" type="submit" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- Modal for Viewing Category -->
<div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="viewCategoryModalLabel">Category Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="viewCategoryId" class="form-label fw-bold">Category ID</label>
                    <input type="text" id="viewCategoryId" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="viewCategoryName" class="form-label fw-bold">Category Name</label>
                    <input type="text" id="viewCategoryName" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding New Category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo URLROOT; ?>/categoryController/create" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" id="categoryName" placeholder="Enter category name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Editing Category -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" action="<?php echo URLROOT; ?>/categoryController/update" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name</label>
                        <input type="hidden" name="id" id="editCategoryId">
                        <input type="text" name="name" class="form-control" id="editCategoryName" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/admin/footer.php'; ?>

<!-- Script to Populate Modals -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const viewButtons = document.querySelectorAll('.view-btn');
        const editButtons = document.querySelectorAll('.edit-btn');

        // View Modal Elements
        const viewIdInput = document.getElementById('viewCategoryId');
        const viewNameInput = document.getElementById('viewCategoryName');

        // Edit Modal Elements
        const editIdInput = document.getElementById('editCategoryId');
        const editNameInput = document.getElementById('editCategoryName');

        // Populate View Modal
        viewButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');

                viewIdInput.value = id;
                viewNameInput.value = name;
            });
        });

        // Populate Edit Modal
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');

                editIdInput.value = id;
                editNameInput.value = name;
            });
        });
    });
</script>