<!DOCTYPE html>
<html>

<head>
    <title>Create Student</title>
</head>

<body>
    <form action="/students" method="post">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Email:</label><br>
        <input type="email" name="email"><br>
        <label>Roll Number:</label><br>
        <input type="text" name="roll_number"><br>
        <button type="submit">Submit</button>
    </form>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif
</body>

</html>