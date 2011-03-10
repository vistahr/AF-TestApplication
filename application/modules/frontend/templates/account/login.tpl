
{if $login_fail eq true}
	<div class="error">
		Logindaten sind inkorrekt
	</div>
{/if}

<form action="{$view->baseUrl('account/login')}" method="post">

	<input type="text" name="user" placeholder="Benutzername" />
	<input type="password" name="password" placeholder="Passwort" />
	
	<input type="submit" />
</form>