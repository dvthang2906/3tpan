@extends('clients.client')

@section('title')
    <script src="https://js.stripe.com/v3/"></script>
    <title>Payment</title>
@endsection

@section('css')
    <style>
        #card-element {
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccd0d2;
            width: 90%;
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
            width: 90%;
        }

        #payment-form {
            width: 90%;
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
@endsection

<body>

    @section('content')
        <div class="ads" style="margin-left:40px; margin-top:-20px;">
            <iframe id="" width="300px" height="350px" src="https://comp.ecc.ac.jp/" title="ECCコンピュータ専門学校"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>


        <div style="margin-left: 150px;">
            <div style="display: flex; justify-content: center; ">
                <div style="width: 50%; display: flex;
            justify-content: center; ">
                    <form id="payment-form" action="/charge" method="POST" style="margin: 5%;">
                        @csrf

                        <label for="cardholder-name">クレジットカードの名義人</label>
                        <input id="cardholder-name" name="cardholder-name" type="text" placeholder="例：Monkey D. Luffy"
                            required>
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
            </div>
        </div>
    @endsection



    @section('js')
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
    @endsection
