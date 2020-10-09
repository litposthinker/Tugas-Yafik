var namaitem = []
var varianitem = []
var hargaitem = []
var semua = []
var vocer = ''



var tampil = document.getElementById('tampildata')

function hapusdata(i) {
    namaitem.splice(i, 1);
    varianitem.splice(i, 1);
    hargaitem.splice(i, 1);
    showData();
}

if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }

    var addToCartButtons = document.getElementsByClassName('shop-item-button')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }
}

function purchaseClicked() {
    alert('Thank you for your purchase')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.removeChild(cartItems.firstChild)
    }
    updateKeranjang()
}

function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateKeranjang()
}

function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1
    }
    updateKeranjang()
}

function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var nama = shopItem.getElementsByClassName('shop-item-title')[0].innerText
    var varian = shopItem.getElementsByClassName('cart-varian')[0].value
    var harga = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    var imageSrc = shopItem.getElementsByClassName('shop-item-image')[0].src
    addItemToCart(nama, harga, varian, imageSrc)
    updateKeranjang()
}

function addItemToCart(nama, harga, varian, imageSrc) {
    alert('Dimasukkan ke Keranjang')

    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == nama) {
            alert('This item is already added to the cart')
            return
        }
    }
    var cartRowContents = `
        <div class = "row mb-4">
        <div class="cart-item cart-column col">
            <img class="cart-item-image rounded" src="${imageSrc}" width="100" height="100">
            <span class="cart-item-title">${nama}</span>
        </div>
        <div class = "col">
            <span class="cart-varian">${varian}</span>
        </div>
        <div class="text-center cart-quantity cart-column col">
            <input class="cart-quantity-input" type="number" value="1">
        </div>
        <div class="col">
        <span class="cart-price">${harga}</span>
        </div>
        <button class='btn-danger btn' href='#' onclick='hapusdata(" + i +
            ")'>Hapus</button>
        </div>`
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

function updateKeranjang() {
    vocer = document.getElementById('kodevocer').value
    var diskonElemen = document.getElementById('cart-diskon')
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var hargaElemen = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var harga = parseFloat(hargaElemen.innerText.replace('Rp', ''))
        var quantity = quantityElement.value
        if (vocer.value = 'OMG50') {
            total = total + (harga * quantity / 50)
        } else {
            total = total + (harga * quantity)
        }

    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = 'Rp ' + total
}

var saldo
if (saldo = prompt('Silahkan Masukkan Saldo anda untuk pembayaran')) {

} else {
    alert('Anda wajib memasukkan saldo')
}

function bayar() {

}

var diskonElemen = document.getElementById('cart-diskon')

function submitkode() {
    var vocer = ''
    vocer = document.getElementById('kodevocer').value

    switch (vocer) {
        case 'OMG50':
            alert('Kode Voucher Berhasil')
            discount = 50;
            diskonElemen.innerHTML += `
            <strong class="cart-diskon">Diskon${discount}%</strong>`
            break;

        default:
            if (vocer === false) {
                document.write('Kode voucher salah!')
            }

    }

}