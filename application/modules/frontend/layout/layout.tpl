<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

	<head>
	    {$layout->headMeta()}
		{$layout->headTitle()}
		{$layout->headScript()}
		{$layout->headStyle()}
	</head>
	
	<body>
		<div style="margin:50px;">
			{if $layout->getID()->isLogged() neq true}
				<a href="{$layout->baseUrl('account/register')}">register</a>
				<a href="{$layout->baseUrl('account/login')}">login</a>
				<a href="{$layout->baseUrl('account/retrieve-password')}">retrieve password</a>
			{else}
				<a href="{$layout->baseUrl('account/data')}">data</a>
				<a href="{$layout->baseUrl('account/logout')}">logout</a>
			{/if}
		</div>
		
		<div style="margin:50px;">
			{$layout->getContent()}
		</div>
		
	</body>

</html>