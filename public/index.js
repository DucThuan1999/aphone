function removeCart(rowId) {
    $.ajax({
        method: "POST",
        url: "/cart/remove",
        data: {
            rowId: rowId,
            inCartPage: true,
        },
    }).done(function (data) {
        $(`.products_row_${rowId}`).hide();
        showSnackbar("Đã xoá sản phẩm trong giỏ hàng !!!");

        let count_cart = document.getElementById("count_cart");
        count_cart.innerText = parseInt(count_cart.textContent) - 1;
        if (data) {
            $("#showTotalPrice").html(data[0]);
            $("#showTotalPriceMiniCart").html(data[1] + " đ");
        }
    });
}

function updateQtyItemCart(rowId, qty) {
    $.ajax({
        method: "POST",
        url: "/cart/update",
        data: {
            rowId,
            qty,
            inCartPage: true,
        },
    }).done(function (data) {
        showSnackbar("Đã cập nhật sản phẩm trong giỏ hàng !!!");
        if (data) {
            $("#showTotalPrice").html(data.totalPrice);
            $(`#subtotal_${rowId}`).html(data.subtotal + " đ");
        }
        // console.log(data);
    });
}

function getColorsProduct(id, rowId) {
    $.get("/ajax/colors/getcolorsbyproduct/" + id, function (data) {
        $(`#select_colors_${rowId}`).html(data);
        $(".nice-select").niceSelect();
    });
}
function quickviewModal(id) {
    $.get("/ajax/" + id, function (data) {
        $("#exampleModalCenter").html(data);
    }).then(function () {
        $("#exampleModalCenter").modal("show");
    });
}

function addWishList(id) {
    $.ajax({
        method: "POST",
        url: "/wishlist/add",
        data: { id: id },
    }).done(function () {
        showSnackbar("Đã thêm sản phẩm vào danh sách yêu thích !!!");
        let count_wishlist = document.getElementById("count_wishlist");
        count_wishlist.innerText = parseInt(count_wishlist.textContent) + 1;
    });
}

function addCart(id, discount = null) {
    if ($("#select-colors").val() == "") {
        $("#color-alert").html("Vui lòng chọn màu");
    } else {
        let color = $("#select-colors option:selected").val()
            ? $("#select-colors option:selected").val()
            : null;
        let qty = $("#input_qty").length ? parseInt($("#input_qty").val()) : 1;

        $.ajax({
            method: "POST",
            url: "/cart/add",
            data: {
                id,
                qty,
                color,
                discount,
            },
        }).done(function (data) {
            showSnackbar("Đã thêm sản phẩm vào giỏ hàng !!!");
            let count_cart = document.getElementById("count_cart");
            // count_cart.innerText =
            //     parseInt(count_cart.textContent) + data.count;
            count_cart.innerText = data.count;
            console.log(data);
            $("#minicart-ul").html(data.miniCart);
            // console.log(data);
        });
    }
}
$("#eliminate-filter").click(function () {
    $(location).prop("href", "/products");
});

$("#button-filter").click(function () {
    let searchParams = new URLSearchParams(window.location.search);
    let url = window.location.href;
    if (url.includes("?")) {
        if (searchParams.has("search")) {
            url = url.split("?")[0] + "?search=" + searchParams.get("search");
        } else url = url.split("?")[0] + "?";
    } else url += "?";
    url = addParam(url);
    window.location.replace(url);
});

function addParam(url) {
    let categories = $('input[name="categories"]:checked').val();
    let suppliers = $('input[name="suppliers"]:checked').val();
    let screen_size = $('select[name="screen-size"]').val();
    let colors = $('select[name="colors"]').val();
    let ram = $('select[name="ram"]').val();
    let memory = $('select[name="memory"]').val();
    let battery = $('select[name="battery"]').val();
    let os = $('select[name="os"]').val();
    let price_from = $('input[name="price-from"]').val();
    let price_to = $('input[name="price-to"]').val();

    if (categories) url += "&categories=" + categories;
    if (suppliers) url += "&suppliers=" + suppliers;
    if (screen_size) url += "&screen-size=" + screen_size;
    if (colors) url += "&colors=" + colors;
    if (ram) url += "&ram=" + ram;
    if (memory) url += "&memory=" + memory;
    if (battery) url += "&battery=" + battery;
    if (os) url += "&os=" + os;
    if (price_from) url += "&price_from=" + price_from;
    if (price_to) url += "&price_to=" + price_to;
    return url;
}

$("#select-filter").change(function () {
    let searchParams = new URLSearchParams(window.location.search);
    let url = window.location.href;
    if (!searchParams.has("sort")) {
        if (url.includes("?")) url = url + "&sort=" + $(this).val();
        else url = url + "?sort=" + $(this).val();
    } else {
        let newValue = $("#select-filter option:selected").val();
        let oldValue = searchParams.get("sort");
        url = url.replace(oldValue, newValue);
        // chưa + params
    }
    window.location.replace(url);
});

$(document).ready(function () {
    $("#input-search").on("keyup keypress", function () {
        let query = $(this).val();

        if (query != "") {
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "ajax/suggestsearch",
                method: "POST",
                data: { query: query, _token: _token },
            }).success(function (data) {
                $("#searchList").fadeIn();
                $("#searchList").html(data);
            });
        }
    });
    if ($("#input-email").length) {
        let urlParams = new URLSearchParams(window.location.search);
        let email = urlParams.get("email");
        $("#input-email").val(email);
    }
    if ($("#select_another_province").length)
        $.ajax({
            method: "GET",
            url: `ajax/location/province`,
        })
            .done(function (data) {
                let text = "<option disabled selected>Tỉnh/Thành phố</option>";
                data.forEach((province) => {
                    return (text += `<option value='${province.id}'>${province._name}</option>`);
                });

                $("#select_another_province").html(text);
            })
            .then(function () {
                $("#select_another_province").niceSelect();
            });
    if ($("#paypal-button-script").length) {
        $.ajax({
            method: "POST",
            url: "/cart/paypal/getbutton",
            data: {},
        }).then(function (data) {
            console.log(data);
            $("#paypal-button-script").html(data.button);
        });
    }
    if ($("#paypal-button-deposit-script").length) {
        $.ajax({
            method: "POST",
            url: "/cart/paypal/getbuttondeposit",
            data: {},
        }).then(function (data) {
            console.log(data);
            $("#paypal-button-deposit-script").html(data.button);
        });
    }
});

function handleChangepasswordCheckbox() {
    $(".changepassword-input").toggleClass("hide");
}

function handleRemoveWishlist(id) {
    $(`#products_row_${id}`).hide();
    $.ajax({
        method: "POST",
        url: "wishlist/remove",
        data: { id: id },
    }).done(function () {
        let count_wishlist = document.getElementById("count_wishlist");
        count_wishlist.innerText = parseInt(count_wishlist.textContent) - 1;
    });
}

$("#input-search").focusout(function () {
    if ($("#searchList").hasClass("show-searchList")) {
        $("#searchList").toggleClass("show-searchList");
    }
    $("#searchList").toggleClass("hide");
});
$("#input-search").focusin(function () {
    $("#searchList").toggleClass("show-searchList");
    if ($("#searchList").hasClass("hide")) {
        $("#searchList").toggleClass("hide");
    }
});

$("#input_qty").change(function () {
    let route = window.location.href.split("/");
    let id = route[route.length - 1];
    let color = $("#select-colors option:selected").val();

    $.ajax({
        method: "POST",
        url: "/ajax/qty/getqtybycolor",
        data: {
            id,
            color,
        },
    }).done(function (data) {
        let max = parseInt(data.qty);
        if (parseInt($("#input_qty").val()) > max) $("#input_qty").val(max);
        if (parseInt($("#input_qty").val()) <= 0) $("#input_qty").val(1);
    });
});

// $("#a_checkout").on("click", function (e) {
//     // e.preventDefault();
//     let array_qty = $(':input[type="number"]').map(function () {
//         // if ($(this).val() != "1") {
//         //     $(this).after(
//         //         '<span class="text-danger">Tối đa 1 sản phẩm 1 đơn hàng</span>'
//         //     );
//         //     console.log($(this).val());
//         // }
//         return $(this);
//     });

//     alert("run");
// });

function validateCheckout() {
    let over_qty = 0;
    let array_qty = $(':input[type="number"]').map(function () {
        if ($(this).val() != "1") {
            over_qty++;
            $("#alert-qty").html(
                '<span class="text-danger">Tối đa 1 sản phẩm</span>'
            );
        }
    });
    if (over_qty == 0) {
        window.location.href = "/checkout";
    }
}
function changeCity() {
    let id = $("#select_city").val();
    loadDistrict(id);
}
function loadDistrict(id) {
    $.ajax({
        method: "GET",
        url: `ajax/location/province/${id}/district`,
    }).done(function (data) {
        $("#select_district").html(data);
        $("#select_district").niceSelect();
    });
}
function changeDistrict() {
    let id = $("#select_district").val();
    loadWard(id);
}
function loadWard(id) {
    $.ajax({
        method: "GET",
        url: `ajax/location/district/${id}/ward`,
    }).done(function (data) {
        $("#select_ward").html(data);
        $("#select_ward").niceSelect();
    });
}

function changeAnotherProvince() {
    let id = $("#select_another_province").val();
    loadAnotherDistrict(id);
}
function loadAnotherDistrict(id) {
    $.ajax({
        method: "GET",
        url: `ajax/location/province/${id}/district`,
    }).done(function (data) {
        $("#select_another_district").html(data);
        $("#select_another_district").niceSelect();
    });
}
function changeAnotherDistrict() {
    let id = $("#select_another_district").val();
    loadAnotherWard(id);
}
function loadAnotherWard(id) {
    $.ajax({
        method: "GET",
        url: `ajax/location/district/${id}/ward`,
    }).done(function (data) {
        $("#select_another_ward").html(data);
        $("#select_another_ward").niceSelect();
    });
}

function handlePaymentMethod() {
    $("#paypal-button-container").toggleClass("hide");
}

function handleCheckShipAnother() {
    $(".radio-custom[name='address']").prop("checked", false);
}

function handleAddressRadio() {
    if ($("#ship-box:checked").length) {
        $("#ship-box-info").slideToggle(1000);
    }
    $("#ship-box").prop("checked", false);
}

///////////////////////////////////////////////////
function showproduct1(value) {
    $.ajax({
        type: "POST",
        url: "/compare",
        data: {
            search: value,
        },
        success: function (data) {
            var product = data[0];
            var image = product.image;
            $("#image1").html(
                '<a href="products/' +
                    product.product_id +
                    '.html"><img src="' +
                    image +
                    '" alt="Product Image" height="300" width="300"></a>'
            );
            $("#cart1").fadeIn();
            $("#name1").html(
                '<a href="products/' +
                    product.product_id +
                    '.html">' +
                    value +
                    "</a>"
            );
            $("#content1").html(product.content);
            let price = product.price.toLocaleString("it-IT", {
                style: "currency",
                currency: "VND",
            });
            $("#price1").html(price);
            var color = "";
            for (var i = 0; i < data.length - 1; i++) {
                color += data[i].name + ", ";
            }
            color += data[data.length - 1].name;
            $("#color1").html(color);
            $("#tinhtrang1").html(tinhtrang(product.qty));
            $("#cpu1").html(product.cpu);
            $("#ram1").html(product.ram + " GB");
            $("#memory1").html(product.memory);
            $("#screensize1").html(product.screen_size + " inch");
            $("#resolution1").html(product.resolution + " px");
            $("#os1").html(product.os);
            $("#os_version1").html(product.os_version);
            $("#front_camera1").html(product.front_camera);
            $("#back_camera1").html(product.back_camera);
            $("#bluetooth1").html(product.bluetooth);
            $("#battery1").html(product.battery + " mah");
            $("#danhgia1").html(rate(product.rate));
            // $('#sosanh').html(data);
            // let cart1 =
            //     '<button onclick="addCart(' +
            //     product.product_id +
            //     ')" class="ho-button ho-button-sm btn btn-warning" type="button"><span>THÊM VÀO GIỎ</span></button>';
            // $("#cart1").html(cart1);
        },
        error: function () {
            alert("fail");
        },
    });
}
$(document).ready(function () {
    $("#search1").on("keyup keypress", function () {
        let query = $(this).val();

        if (query != "") {
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "/ajax/suggestsearch1",
                method: "POST",
                data: { query: query, _token: _token },
            }).success(function (data) {
                $("#searchList1").fadeIn();
                $("#searchList1").html(data);
            });
        }
    });
    $(document).on("click", ".li1", function () {
        $("#search1").val($(this).text());
        $("#searchList1").fadeOut();
        let value = $(this).text();
        showproduct1(value);
    });
});

$("#search1").focusout(function () {
    $("#searchList1").fadeOut();
});

$("#search1").focusin(function () {
    $("#searchList1").fadeIn();
});
function showproduct2(value) {
    $.ajax({
        type: "POST",
        url: "/compare",
        data: {
            search: value,
        },
        success: function (data) {
            var product = data[0];
            var image = product.image;
            $("#image2").html(
                '<a href="products/' +
                    product.product_id +
                    '.html"><img src="' +
                    image +
                    '" alt="Product Image" height="300" width="300"></a>'
            );
            $("#cart2").fadeIn();
            $("#name2").html(
                '<a href="products/' +
                    product.product_id +
                    '.html">' +
                    value +
                    "</a>"
            );
            $("#content2").html(product.content);
            let price = product.price.toLocaleString("it-IT", {
                style: "currency",
                currency: "VND",
            });
            $("#price2").html(price);
            var color = "";
            for (var i = 0; i < data.length - 1; i++) {
                color += data[i].name + ", ";
            }
            color += data[data.length - 1].name;
            $("#color2").html(color);
            $("#tinhtrang2").html(tinhtrang(product.qty));
            $("#cpu2").html(product.cpu);
            $("#ram2").html(product.ram + " GB");
            $("#memory2").html(product.memory + " GB");
            $("#screensize2").html(product.screen_size + " inch");
            $("#resolution2").html(product.resolution + " px");
            $("#os2").html(product.os);
            $("#os_version2").html(product.os_version);
            $("#front_camera2").html(product.front_camera);
            $("#back_camera2").html(product.back_camera);
            $("#bluetooth2").html(product.bluetooth);
            $("#battery2").html(product.battery + " mah");
            $("#danhgia2").html(rate(product.rate));
            // $('#sosanh').html(data);
            // let cart2 =
            //     '<button onclick="addCart(' +
            //     product.product_id +
            //     ')" class="ho-button ho-button-sm btn btn-warning" type="button"><span>THÊM VÀO GIỎ</span></button>';
            // $("#cart2").html(cart2);
        },
        error: function () {
            alert("fail");
        },
    });
}
$(document).ready(function () {
    $("#search2").on("keyup keypress", function () {
        let query = $(this).val();

        if (query != "") {
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "/ajax/suggestsearch2",
                method: "POST",
                data: { query: query, _token: _token },
            }).success(function (data) {
                $("#searchList2").fadeIn();
                $("#searchList2").html(data);
            });
        }
    });
    $(document).on("click", ".li2", function () {
        $("#search2").val($(this).text());
        $("#searchList2").fadeOut();
        $value = $(this).text();
        showproduct2($value);
    });
});
$("#search2").focusout(function () {
    $("#searchList2").fadeOut();
});
$("#search2").focusin(function () {
    $("#searchList2").fadeIn();
});

function tinhtrang(qty) {
    var s = "";
    if (qty > 0) s += "Còn hàng";
    else s += "Hết hàng";
    return s;
}
function rate(rate) {
    var html = "";
    var num = parseInt(rate);
    for (i = 0; i < num; i++) {
        html += '<span><i class="fa fa-star"></i></span>';
    }
    for (i = 0; i < 5 - num; i++) {
        html += '<span><i class="fa fa-star-o"></i></span>';
    }
    return html;
}

function handleCheckout() {
    if (
        !$('input[name="address"]').is(":checked") &&
        !$("#ship-box").is(":checked")
    ) {
        alert("Vui lòng nhập địa chỉ");
    } else {
        $("#formCheckout").submit();
    }
}
