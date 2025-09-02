@extends('user.product.layout')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Order Summary -->
            <div class="col-md-5">
                <div class="card shadow-sm p-3">
                    <h4 class="mb-3">Order Summary</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Image</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach ($order->orderDetails as $item)
                                @php $total = $item->price * $item->quantity; @endphp
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}" width="60" height="60"
                                            class="img-thumbnail">
                                    </td>
                                    <td>${{ number_format($total, 2) }}</td>
                                </tr>
                                @php $grandTotal += $total; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <h5 class="text-end">Grand Total:
                        <strong>${{ number_format($grandTotal, 2) }}</strong>
                    </h5>
                </div>
            </div>


            <!-- Payment Form -->
            <div class="col-md-7">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-3">Payment</h4>
                    <div id="payment-message" style="display: none" class="alert alert-info"></div>

                    <form id="payment-form" method="POST">
                        @csrf
                        <div id="payment-element"></div>
                        <button id="submit" class="btn btn-primary mt-3 w-100">
                            <span id="button-text">Pay ${{ number_format($grandTotal, 2) }}</span>
                            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                style="display:none"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.publishable_key') }}");
        let elements;

        initialize();

        async function initialize() {
            const response = await fetch("{{ route('stripe.paymentIntent.create', $order->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}"
                })
            });

            const {
                clientSecret
            } = await response.json();

            elements = stripe.elements({
                clientSecret
            });
            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");
        }

        document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const {
                error
            } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "{{ route('stripe.return', $order->id) }}",
                },
            });

            if (error) {
                showMessage(error.message);
                setLoading(false);
            }
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");
            messageContainer.style.display = "block";
            messageContainer.textContent = messageText;

            setTimeout(() => {
                messageContainer.style.display = "none";
                messageContainer.textContent = "";
            }, 5000);
        }

        function setLoading(isLoading) {
            if (isLoading) {
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").style.display = "inline-block";
                document.querySelector("#button-text").style.display = "none";
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").style.display = "none";
                document.querySelector("#button-text").style.display = "inline-block";
            }
        }
    </script>
@endsection
