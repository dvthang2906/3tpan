<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        #card-element {
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccd0d2;
            width: 60%;
            box-sizing: border-box;
            height: 40px;
        }

        #card-element:focus {
            border-color: blue;
        }

        #cardholder-name,
        #card-zip {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccd0d2;
            border-radius: 4px;
            width: 56%;
        }

        #payment-form {
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 8px;
            display: block;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #card-element {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 16px;
        }

        #card-errors {
            color: red;
            margin-bottom: 16px;
        }

        .bt_pay {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .bt_pay:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div style="width: 100%;">
        <form id="payment-form" action="/charge" method="POST" style="margin: 5%;">
            @csrf

            <label for="cardholder-name">クレジットカードの名義人</label>
            <br>
            <input id="cardholder-name" name="cardholder-name" type="text" placeholder="例：Monkey D. Luffy" required>
            <br>
            <label for="card-element">カード番号：</label>
            <div id="card-element">
                <!-- Stripe’s Card Element sẽ được đặt ở đây -->
            </div>
            <div id="card-errors" role="alert" style="color: red"></div>
            <br>
            <button id="payment-button" class="bt_pay">支払い</button>

        </form>
    </div>



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

        // CSS cho card element
        var style = {
            base: {
                color: "#32325d",
                fontWeight: '500',
                fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
                fontSize: '16px',
                lineHeight: '24px',
                fontSmoothing: 'antialiased',

                '::placeholder': {
                    color: '#aab7c4'
                },
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Tạo card element và gắn nó vào div#card-element
        var card = elements.create("card", {
            style: style,
            hidePostalCode: true
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


            var additionalData = {
                name: document.getElementById('cardholder-name').value,
                // address_zip: document.getElementById('card-zip').value
            };


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
