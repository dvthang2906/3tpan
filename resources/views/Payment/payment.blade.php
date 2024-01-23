<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>

    <form id="payment-form" action="/charge" method="POST">
        @csrf
        <div id="card-element">
            <!-- Stripe’s Card Element sẽ được đặt ở đây -->
        </div>
        <button id="payment-button">Thanh toán</button>
        <div id="card-errors" role="alert"></div>
    </form>


    <script>
        // Tạo một instance của Stripe
        var stripe = Stripe(
            'pk_test_51ObZ58Htqj4Z8f0JBsl2p6baMRmmFZO5KdqOVBnk2KAn0ofUd8pR8WlsHMB0mkaTlJFJ1v8Xu6bEBSMqWKyAI39p00iTMYKQro'
        );

        // Tạo một instance của elements
        var elements = stripe.elements();

        // Tùy chỉnh style cho card element
        var style = {
            base: {
                color: "#32325d",
            }
        };

        // Tạo card element và gắn nó vào div#card-element
        var card = elements.create("card", {
            style: style
        });
        card.mount("#card-element");

        // Xử lý các lỗi xảy ra khi nhập thông tin thẻ
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Xử lý form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Hiển thị lỗi trong form
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Gửi token đến server của bạn
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Tạo một hidden input để chứa token và thêm vào form
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Gửi form
            form.submit();
        }
    </script>

</body>

</html>
