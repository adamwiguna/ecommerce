<h3>
    Hello, Mr/Mrs {{ $user->name }}
</h3> 
<br>
Here is your token to reset password your Account in {{ env('APP_NAME') }}
<br>
<br>
{{ $token }}