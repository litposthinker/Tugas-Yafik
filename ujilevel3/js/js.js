// SEARCH
$('#search').keyup(function () {
    value = $(this).val();
    $(".produk").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
})


function tambahBarang(id) {
    $.get('setsession.php?session=' + id);
    location.reload();
}

function kurangBarang(id) {
    $.get('sessionKurang.php?session=' + id);
    location.reload();
}

function hapusBarang(id) {
    $.get('delSession.php?session=' + id);
    location.reload();
}

function bayarAlert () {
    Swal.fire({
    icon: 'success',
    title: 'Terimakasih',
    showConfirmButton: false,
    timer: 1500
})
}
