<script>
    // Show fields based on product type
    function showProductFields() {
        const productType = document.getElementById('productType').value;
        document.getElementById('physicalFields').style.display = productType === 'physical' ? 'block' : 'none';
        document.getElementById('digitalFields').style.display = productType === 'digital' ? 'block' : 'none';
    }
</script>

</body>

</html>