<?php
require_once __DIR__ . '/../includes/header.php';
$activePage = 'cars';
?>

<div class="page-header">
    <h1>Add New Car</h1>
    <a href="index.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Cars
    </a>
</div>

<div class="content-wrapper">
    <div class="form-container">
        <form id="carForm" action="controllers/CarController.php?action=add" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group">
                    <label for="make">Make *</label>
                    <input type="text" id="make" name="make" required>
                </div>
                <div class="form-group">
                    <label for="model">Model *</label>
                    <input type="text" id="model" name="model" required>
                </div>
                <div class="form-group">
                    <label for="year">Year *</label>
                    <input type="number" id="year" name="year" min="1900" max="2100" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="price">Price ($) *</label>
                    <input type="number" id="price" name="price" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="rental_price">Rental Price ($/day) *</label>
                    <input type="number" id="rental_price" name="rental_price" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="status">Status *</label>
                    <select id="status" name="status" required>
                        <option value="available">Available</option>
                        <option value="rented">Rented</option>
                        <option value="sold">Sold</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Car Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                <div class="image-preview" id="imagePreview">
                    <img src="<?php echo SITE_URL; ?>/assets/images/default-car.jpg" alt="Preview">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Car
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>
