<!DOCTYPE html>
<html>
	<head>
		{{  partial("partials/head") }}
	</head>
	<body>
		{{ content() }}
		{{ assets.outputJs() }}
	</body>
</html>