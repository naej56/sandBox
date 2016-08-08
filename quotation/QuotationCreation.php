<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Création devis</title>

		<!-- jQuery -->
		<script src="//localhost/quoma/public/lib/jquery/jquery.min.js"></script>
		<!-- Bootstrap core CSS -->
		<link href="//localhost/cdn/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<!-- font-awesome -->
		<link href="//localhost/cdn/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
		<!-- Bootstrap custom -->
		<!--<link href="//localhost/quoma/public/css/bootstrap-kowa.css" rel="stylesheet">-->
		<!-- quoma -->
		<link href="//localhost/quoma/public/css/quoma.css" rel="stylesheet">

	</head>

	<body>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Creation d'un nouveau devis</h4>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th class="col-md-1 text-center"><strong><i class="fa fa-wrench" aria-hidden="true"></i> <i class="fa fa-hashtag" aria-hidden="true"></i></strong></th>
								<th class="col-md-7"><strong><i class="fa fa-dropbox" aria-hidden="true"></i> Produit</strong></th>
								<th class="col-md-1 text-center"><strong><i class="fa fa-shopping-basket" aria-hidden="true"></i> Qte</strong></th>
								<th class="col-md-1 text-center"><strong><i class="fa fa-tag" aria-hidden="true"></i> P.U.</strong></th>
								<th class="col-md-1 text-center"><strong><i class="fa fa-tumblr" aria-hidden="true"></i> TVA</strong></th>
								<th class="col-md-1 text-center"><strong><i class="fa fa-tags" aria-hidden="true"></i> PTTC</strong></th>
							</tr>
						</thead>
						<tbody id="Quotation">
							<!--<tr>
								<td><button onclick="AddLine(quotation)" type="button" class="btn btn-success btn-xs"><strong><i class="fa fa-plus" aria-hidden="true"></i></strong></button></td>
								<td></td>
								<td></td>
							</tr>-->
						</tbody>
					</table>
				</div>
				<div class="panel-footer text-right">
				<div class="row">
					<div class="col-md-1" style="display: block">
						<button onclick="AddLine(quotation)" type="button" class="btn btn-success btn-xs"><strong><i class="fa fa-plus" aria-hidden="true"></i></strong></button>
					</div>
					<div class="col-md-1 col-md-offset-11" id="footer">
						
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/QuotationCreation.js"></script>

	</body>
</html>