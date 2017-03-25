$(function() {
    if (typeof(Storage) !== 'undefined') {

        // DOM cache
        var oCartCnt = $('#app-layout .nav.navbar-nav .cartCnt')
        var oCartModal = $('#cartModal');

        // If sessionStorage.cart has data, display count of items
        if (sessionStorage.cart) {
            oCartCnt.text(JSON.parse(sessionStorage.cart).length);
        }

        // Datatable AJAX options
        var oAjax = {
            url: '/datatables/product/cart',
            type: 'GET',
            data: function(d) {
                var _aCart = JSON.parse(sessionStorage.cart);
                var _aTmpId = [];

                d.cartItems = '';
                if (sessionStorage.cart && _aCart.length !== 0) {
                    _aCart.forEach(function(item, index) {
                        _aTmpId.push(item.id);
                    });
                    d.cartItems = _aTmpId;
                }
            }
        };

        // Initialize datatable
        var cartTable = $('#tableCart').DataTable({
            processing: true,
            ajax: oAjax,
            columns: [
                {data: 'name', name: 'name'},
                {data: 'category.name', name: 'category.name'},
                {data: 'price', render: function (data, type, row) {
                    return 'Php '+data;
                }},
                {render: function(data, type, full, meta) {
                    return '<input type="number" class="form-control" name="quantity[]" value="0">';
                }},
                {defaultContent: '<button type="button" class="btn btn-danger btn-flat btnDel"><i class="fa fa-trash"></i></button>'},
            ],
            createdRow: function(row, data, index) {
                var oThis = $(row);
                var _aCart = JSON.parse(sessionStorage.cart);

                _aCart.forEach(function(item, index) {
                    if (item.id == data.id) {
                        oThis.find('input[name="quantity[]"]').val(item.qty);
                    }
                });

                oThis.append('<input type="hidden" name="id[]" value="'+data.id+'">');
            }
        });

        // Updates the table when cart icon is clicked
        $('.cartIcon').click(function() {
            cartTable.ajax.reload();
            cartTable.draw();
        });

        // Updates the quantity of corresponding item in the cart
        oCartModal.on('change', 'input[name="quantity[]"]', function (e) {
            var oThis = $(this);
            var iId = oThis.closest('tr').find('input[name="id[]"]').val();
            var aCart = JSON.parse(sessionStorage.cart);

            aCart.forEach(function(item, index) {
                if (item.id == iId) {
                    item.qty = parseInt(oThis.val());
                }
            });

            sessionStorage.cart = JSON.stringify(aCart);
        });

        // To delete item in cart
        oCartModal.on('click', '.btnDel', function (e) {
            var oThis = $(this);
            var oParent = oThis.closest('tr');
            var iVal = oParent.find('input[name="id[]"]').val();
            var aCart = JSON.parse(sessionStorage.cart);

            aCart.forEach(function(item, index) {
                if (item.id == iVal) {
                    aCart.splice(index, 1);
                }
            });

            sessionStorage.cart = JSON.stringify(aCart);
            oCartCnt.text(JSON.parse(sessionStorage.cart).length);
            cartTable.ajax.reload();
            cartTable.draw();
        });
    } else {
        console.error('No web localstorage in this browser.');
    }
});