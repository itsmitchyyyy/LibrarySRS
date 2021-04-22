</body>
<script src="../../assets/js/bootstrap.min.js"></script>
<script>

    function goBack() {
        window.location = 'books.php';
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</html>