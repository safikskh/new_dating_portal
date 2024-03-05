<!-- Developed By CBS -->
  @extends('layouts.app')
  @section('pageTitle', 'Kortopdatering')
  @section('content')
    <!-- Main Content-->
      <div class="main-content pt-0">
        <div class="container">

            <!-- Page Header -->
              <div class="page-header">
              </div>
            <!-- End Page Header -->
              
            <div class="row justify-content-center">

                <div class="col-md-6">
                      <div class="card custom-card">

                          <div class="card-header" style="margin-bottom: 10px;">
                            <h5 class="card-title mb-1" style="font-weight: bold; text-transform:uppercase;">Tilføj dine kortoplysninger</h5>
                          </div>

                          <div class="card-body">
                              <form action="{{ route('card.update') }}" method="post" id="payment-form">
                                  @csrf
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                      <div class="form-group">
                                        <div id="card-element">
                                            <!-- A Stripe Element will be inserted here. -->
                                        </div>
                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                        {{-- <input type="hidden" name="plan" value="{{ $plan->id }}" /> --}}
                                      </div>
                                      <div class="card-footer" align="right">
                                          <button class="btn ripple btn-success" type="submit" style="font-weight: bold;text-transform: uppercase;">Betal</button>
                                      </div>
                                  </div>
                              </form>
                          </div>

                      </div>
                </div>

            </div>
            
        </div>
      </div>
    <!-- End Main Content-->
  @endsection
  @push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('{{ env("STRIPE_KEY") }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
          base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {hidePostalCode: true, style: style});
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
          var displayError = document.getElementById('card-errors');
          if (event.error) {
            displayError.textContent = event.error.message;
          } else {
            displayError.textContent = '';
          }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
          event.preventDefault();

          stripe.createToken(card).then(function(result) {
            if (result.error) {
              // Inform the user if there was an error.
              var errorElement = document.getElementById('card-errors');
              errorElement.textContent = result.error.message;
            } else {
              // Send the token to your server.
              stripeTokenHandler(result.token);
            }
          });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
          // Insert the token ID into the form so it gets submitted to the server
          var form = document.getElementById('payment-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'stripeToken');
          hiddenInput.setAttribute('value', token.id);
          form.appendChild(hiddenInput);

          // Submit the form
          form.submit();
        }

    </script>
  @endpush
<!-- Developed By CBS -->