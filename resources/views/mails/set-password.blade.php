<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="{{ route__('user.set-password', $user) }}" method="POST">
            @csrf
            <div>
                <lable>Password</lable>
                <input type="password" name="password" >
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password">
            </div>
            <div>
                <input type="submit">
            </div>
    </main>
</body>
</html>