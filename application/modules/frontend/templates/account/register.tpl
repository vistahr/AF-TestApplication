
{if $error neq false}
	<div class="error">
		{foreach from=$error item=e}
			- {$e} <br />
		{/foreach}
	</div>
{/if}

<form action="{$view->baseUrl('account/register')}" method="post">

	<label>Benutzername:</label>
	<input type="text" name="username" value="{$data.username}" />
	
	<label>Password:</label>
	<input type="password" name="password" value="{$data.password}" />
	
	<label>wiederholen:</label>
	<input type="password" name="password_confirm" value="" />
	
	<label>eMail:</label>
	<input type="text" name="mail" value="{$data.mail}" />
	
	<label>Postleitzahl:</label>
	<input type="text" name="postcode" value="{$data.postcode}" />
	
	<input type="submit" value="registrieren" />
</form>