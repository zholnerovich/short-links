<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Short Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Short Links</h1>
    <form id="linkForm">
        <div class="mb-3">
            <div id="submitFeedback"></div>
            <input type="text" class="form-control" name="url">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">short link</th>
            <th scope="col">url</th>
        </tr>
        </thead>
        <tbody id="linkTableBody"></tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">
    $('#linkForm').on('submit', function (e) {
        e.preventDefault();

        $('submitFeedback').text('');
        $.ajax({
            url: "/links/store",
            type: "POST",
            data: $(this).serialize(),
            success: function () {
                $('#submitFeedback').text('success');
                getLatest();
            },
            error: function (response) {
                $('#submitFeedback').text(response.responseJSON.errors.url);
            },
        });
    });

    const getLatest = function () {
        $.ajax({
            url: "/links/latest",
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                let tableDataHtml = response.map(function (item) {
                    return '<tr><td><a target="_blank" href="' + item.path + '">' + item.path + '</a></td><td>'
                        + item.url + '</td></tr>'
                });

                $('#linkTableBody').html(tableDataHtml);
            },
        });
    }

    getLatest();
</script>
</body>
</html>
