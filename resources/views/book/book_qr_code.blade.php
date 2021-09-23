<html>
	<head>
	</head>
	<body>
		@foreach ($accession as $data)
			@if($data->id==$id)
			<div style="margin:-40px;">
				<img style="margin-left: 30px" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate(
		                 'Accession No : '.$data->accession_no.
		                 '      Place : '.$data->place .
		                 '      Book ID : '.$data->book_id)) }} ">
		        <p style="margin-top: -10px;font-size: 14px;text-align: center" >SDJ International College Library</p>
		    </div>
		    @endif
        @endforeach
	</body>
</html>