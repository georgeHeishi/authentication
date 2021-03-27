<form method="post" id="ldap-form" action="/authentication/api/ldapApi.php" class="p-4 border rounded">
    <div class="row mb-2">
        <div class="form-group col">
            <label for="username">Email</label>
        </div>
        <div class="form-group col">
            <input type="text" name="username" id="username" required>
        </div>
    </div>
    <div class="row mb-2">
        <div class="form-group col">
            <label for="password">Heslo</label>
        </div>
        <div class="form-group col">
            <input type="password" name="password" id="password" required>
        </div>
    </div>
    <div class="row mb-2">
        <button type="submit" class="btn btn-secondary mt-3">Prihlásiť</button>
    </div>
</form>