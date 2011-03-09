{if $error neq false}
	<div class="error">
		{foreach from=$error item=e}
			- {$e} <br />
		{/foreach}
	</div>
{/if}