<script type="text/javascript">
function errorImg(that) {
    $(that).attr('src', '/images/default-thumbnail.jpg');
}

$(function() {
    $('.prodPanel .btn-success').click(function() {
        var _prodVal = $(this).closest('.prodPanel').find('input[name="id"]').val();

        if (typeof(Storage) !== 'undefined') {
            sCart = [];
            if (sessionStorage.cart) {
                sCart = JSON.parse(sessionStorage.cart);
                if ($.inArray(_prodVal, sCart) !== -1) {
                    return false;
                }
            }
            sCart.push(_prodVal);
            $('#app-layout .nav.navbar-nav .cartCnt').text(sCart.length);
            sessionStorage.setItem('cart', JSON.stringify(sCart));
        } else {
            console.error('No web localstorage in this browser.');
        }
    });
});
</script>

<div id="cartModal" class="modal modal-default fade" role="dialog">
    <form action="" method="POST">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-btn fa-shopping-cart"></i> Cart</h4>
            </div>
            <div class="modal-body">
                <table id="tableCart" class="display table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <hr>
                Total: Php <span id="total">0.00</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Checkout</button>
            </div>
        </div>
    </form>
</div>
