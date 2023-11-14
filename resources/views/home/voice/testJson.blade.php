<h1>json</h1>
<div class="get-json"></div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let div = '';
    $.get('http://127.0.0.1:8000/api/input-json-data', function(res) {
        // Lặp qua các phần tử trong đối tượng JSON bằng $.each()
        $.each(res, function(key, value) {
            div += '<p>' + key + '</p>';
        });
        console.log(div);

        $('.get-json').html(div); // Sử dụng class "get-json" thay vì id "#get-json"
    });
</script>
