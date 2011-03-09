<div class="info">
	Eingeloggt als "{$ID->getSubject()}"
	<a href="{$view->baseUrl('logout')}">logout</a>
</div>

<br /><br />

{$view->forwardAndExit('default','main','sanskrit')}

<br /><br />

<div class="info">
	{$textile->TextileThis('-Goodbye- +Hello+ *world!*')}
</div>