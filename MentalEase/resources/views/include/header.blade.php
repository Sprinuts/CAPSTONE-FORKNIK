<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Add user data for JavaScript -->
    @if(session('user'))
    <div id="userData" data-user="{{ json_encode(session('user')) }}" style="display: none;"></div>
    <script src="{{ asset('javascript/profile-check.js') }}"></script>
    @endif

    <title>MentalEase</title>
</head>
<body>
    <div class="container-flex0"></div>

</body>
</html>


