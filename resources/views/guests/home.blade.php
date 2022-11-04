<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>Deliveboo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
        

        {{-- Bootstrap icon --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/front.css') }}">

        <!-- includes the Braintree JS client SDK -->
        <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script>

        <!-- includes jQuery -->
        <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>

        <!-- Script -->
        <script defer src="{{ asset('js/front.js') }}"></script>
        
    </head>
    <body>
        
            
         <!-- Vue js element -->   
            
        <div id="root">
    
        </div>
    </body>
</html>
