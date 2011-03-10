
{if $retrieve_fail eq true}
	<div class="error">
		Daten inkorrekt
	</div>
{/if}

<form action="{$view->baseUrl('dev.php/account/retrieve-password')}" method="post">

	<input type="text" name="user" placeholder="Benutzername" />
	<input type="text" name="mail" placeholder="eMail" />
	
	<input type="password" name="new_passwd" placeholder="neues Passwort" />
	
	<input type="submit" value="Passwort per eMail anfordern" />
</form>