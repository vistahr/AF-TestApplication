{if $error neq false}
	<div class="error">
		{foreach from=$error item=e}
			- {$e} <br />
		{/foreach}
	</div>
{/if}


{if $success eq true}
	<div class="success">
		<h3>Dein Account wurde erfolgreich aktiviert, du kannst dich nun einloggen</h3>
	</div>
	
	{$view->forwardAndExit('frontend','account','login')}
{/if}