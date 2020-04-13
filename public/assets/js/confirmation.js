function confirmation(msg, url) {

    Swal.fire({
        title: "Você tem certeza que deseja deletar <br /> " + msg + "?",
        text: "Esta ação não poderá ser desfeita!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Sim, deletar!"
    }).then(function (t) {
        if (t.value === true) {
            document.getElementById(url).submit();
        }
    });
}
