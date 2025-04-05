@extends('frontend.master')

@section('home')

<style>
    .container-result {
        justify-self: center;
        align-self: center;
        text-align: center;
        margin:80px;
        padding:80px;
    }
    .container-result h2 {
        font-size: 50px;
    }
    .container-result a {
        padding: 10px;
        font-weight: bold;
        margin: 0 20px;
        border-radius: 15px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 50px;
    }

</style>

    <div class="container-result">
        <h2 class="mb-3">Confirm the Payment</h2>
        <p class="mb-3">Note: After completing the payment, please click “Ok” promptly.</p>
        <label>
            <input type="checkbox" id="confirm-read" /><strong>
            Please check this box to continue and confirm that you have read the note.</strong>
          </label>
          <div class="btn-group">
              <a href="#" id="pay-button" class="btn btn-primary disabled" style="pointer-events: none;">Pay Now</a>
            </div>
    </div>

    <input type="hidden" id="order_id" value="{{ $order_id }}"> 
    @foreach($carts as $item)
        <input type="hidden" name="course_title[]" value="{{ $item->name }}">
    @endforeach


    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-cwIBpgeY9rbFbDGI"></script>
<script>
    const snapToken = '{{ $snap_token }}';
    const checkbox = document.getElementById('confirm-read');
    const payButton = document.getElementById('pay-button');

    checkbox.addEventListener('change', function () {
        if (this.checked) {
        payButton.classList.remove('disabled');
        payButton.style.pointerEvents = 'auto';
        } else {
        payButton.classList.add('disabled');
        payButton.style.pointerEvents = 'none';
        }
    });

    function checkPaymentStatus() {
        fetch(`/check-payment-status/${orderId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'confirm' || data.status === 'settlement') {
                    payButton.classList.remove('disabled');
                    payButton.style.pointerEvents = 'auto';
                    payButton.textContent = 'Back to Home';
                    payButton.href = '{{ route('index') }}';
                }
            })
            .catch(error => console.error('Error checking payment status:', error));
    }

    setInterval(checkPaymentStatus, 2000);

document.getElementById('pay-button').addEventListener('click', function () {
    if (snapToken) {
        window.snap.pay(snapToken, {
            onSuccess: function(result){
                fetch("{{ route('midtrans_order') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        result: result
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    toastr.success(data.message);
                    window.location.href = "{{ route('index') }}";
                })
                .catch(error => {
                    console.error('Payment error:', error);
                });
            },
            onPending: function(result){
                toastr.error(data.message);
                window.location.href = "{{ route('index') }}";
                console.log('pending', result);
            },
            onError: function(result){
                toastr.error(data.message);
                window.location.href = "{{ route('index') }}";
                console.log('error', result);
            },
            onClose: function(){
                alert('Payment popup closed!');
            }
        });
    } else {
        alert('Snap Token not available!');
    }
});
</script>

@endsection
