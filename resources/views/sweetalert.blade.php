<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showDeleteAlert(callback) {
        Swal.fire({
            title: "Êtes-vous sûr de vouloir supprimer ?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Supprimer",
            cancelButtonText: "Annuler"
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }
</script>
