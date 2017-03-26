<div id="cartModal" class="modal modal-default fade" role="dialog">
    <form id="cartForm" action="{{ url('order') }}" method="POST">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-btn fa-shopping-cart"></i> Cart</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tableCart" class="display table table-hover" cellspacing="0">
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
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        Total: Php <span id="total">0.00</span>
                    </div>
                </div>
                <hr>
                @if(Auth::user() && Auth::user()->is_admin == 0)
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="shipAd">Shipping Address:</label>
                            <input id="shipAd" type="text" class="form-control" name="shipAd" value="{{ Auth::user()->shipping_address }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input id="phone" type="text" class="form-control" name="phone" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile">Mobile:</label>
                            <input id="mobile" type="text" class="form-control" name="mobile" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="fare">Fare Type:</label>
                            <div id="fare">
                                <label class="radio-inline"><input type="radio" name="fare" value="cash"><i class="fa fa-money"></i>&nbsp;Cash</label>
                                <label class="radio-inline"><input type="radio" name="fare" value="paypal"><i class="fa fa-paypal"></i>&nbsp;Paypal</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="msg">Optional Message:</label>
                            <textarea id="msg" type="text" class="form-control" name="msg"></textarea>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                @if(!Auth::user())
                <button type="button" class="btn btn-outline" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Log In</button>
                @endif
                @if(Auth::user() && Auth::user()->is_admin == 0)
                <button type="submit" class="btn btn-outline">Checkout</button>
                @endif
            </div>
        </div>
    </form>
</div>
