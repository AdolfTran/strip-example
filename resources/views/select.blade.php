@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-10">

            @if(session('msg'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <form accept-charset="UTF-8" action="/payment" class="require-validation"
                      data-cc-on-file="false"
                      data-stripe-publishable-key="{!! config('services.stripe.key') !!}"
                      id="payment-form" method="post">
                    {{ csrf_field() }}
                    <div class='form-row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label> <input name="card" class='form-control' size='4' type='text' value="Visa">
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' value="4242 4242 4242 4242">
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-xs-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                            type='text' value="123">
                        </div>
                        <div class='col-xs-4 form-group expiration required'>
                            <label class='control-label'>Expiration</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text' value="12">
                        </div>
                        <div class='col-xs-4 form-group expiration required'>
                            <label class='control-label'> </label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' value="2020" style="margin-top: 20px">
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12'>
                            <div class='form-control total btn btn-info'>
                                Total: <span class='amount'>{!! $products->price !!} $</span>
                                <input name="amount" class='form-control' size='4' type='hidden' value="{!! $products->price !!}">
                            </div>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 form-group'>
                            <p class='form-control btn btn-primary submit-button'
                                    style="margin-top: 10px;">Pay »</p>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>
<script type="application/javascript">
    $(document).ready(function(){
        var $form         = $('.require-validation').closest('form');
        $('.submit-button').on('click', function(e) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
            }
        }
    });
</script>