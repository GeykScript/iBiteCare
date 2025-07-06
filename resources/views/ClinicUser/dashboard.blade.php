<h1>Welcome, clinic!</h1>
<form method="POST" action="{{ route('clinic.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>