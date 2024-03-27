$(function () {
    $('#datatable').DataTable({
        language: {
            url: "/js/translate_pt-br.json"
        },
        paging: false
    });

    $('[data-toggle="switch"]').bootstrapSwitch();
    $('[data-toggle="tooltip"]').tooltip();

    $('#status').bootstrapToggle({
        on: 'Ativo',
        off: 'Inativo'
    });
    $('#profile').bootstrapToggle({
        on: 'Administrador',
        off: 'Usuário'
    });
});

function confirmarExclusao(registro) {
    const url = registro.getAttribute("data-rota");
    alertExclusao(url);
}

function alertExclusao(url) {
    swal.fire({
        title: 'Deseja excluir esse registro?',
        text: "O registro atualmente selecionado será excluído.",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
    }).then(function (success) {
        if (success.value === true) {
            window.location.href = url;
        }
    })
}