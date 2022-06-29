<!DOCTYPE html>
<html>
<head>
<title>test</title>
</head>
<body>

    @if( $details['type'] == 'login')

        <p>Dear {{ $details['name'] }},</p>
       
        <p>You have account has been created as {{ $details['role'] }}. The login Details are:</p>
        <p>Username : {{ $details['email'] }}</p>
        <p>Password : {{ $details['password'] }}</p>
        
        <p>All the best!</p>
     @endif  

</body>
</html>