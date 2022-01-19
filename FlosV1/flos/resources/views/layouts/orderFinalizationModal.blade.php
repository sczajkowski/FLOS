<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            OrderId: {{$orderId}}
                        </div>
                        <!-- Row -->
                        <div class="col-12">
                            <h2>Payment Method</h2>
                        </div>
                        <!-- Row -->
                        <div class="form-check col-12" >
                            <div class="col-6">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Cash
                                </label>
                            </div>
                            <div class="col-6">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Card
                                </label>
                            </div>
                        </div>
                        <!-- Row -->
                    </div>

                    <br>

                    <br>
                    <h1>Amount: {{$order->amount}}</h1>


                </div>
                <div class="modal-footer">
                    <label> You Can't change receipt after Sumbit  </label>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-primary"> Submit </button>
                </div>
            </form>

        </div>
    </div>
</div>
