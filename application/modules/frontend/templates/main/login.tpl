
<div class="info">
	
	{if $login_fail neq false}
		<div class="error">	
			{$login_fail}
		</div>
	{/if}
	
	<form action="{$view->baseUrl('login')}" method="post">
		<label>Benutzer</label>
		<input type="text" name="user" />
		
		<label>Passwort</label>
		<input type="password" name="passwd" />
		
		<input type="submit" />
	</form>
	
</div>