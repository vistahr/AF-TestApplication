<div class="error">
	<h1>Ein Fehler ist aufgetreten</h1>
	<h3>{$exception->getMessageByEnvironment()}</h3>
	{if $smarty.const.APPLICATION_ENV == 'development'}
		<p>Stack trace:  <br /> {$exception->getTraceAsString()}</p>
	{/if}
</div>
