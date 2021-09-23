<html>
	<head>
	</head>
	<body>
		@foreach ($student as $data)
			@if($data->id==$id)
				<div style="margin:-20px;margin-top:-40px;margin-bottom:-50px">
		         <img  src='{{ public_path("images/sdj_logo.png") }}' width="100%">
		         <hr>
		         <table width="100%" style=" border-collapse: collapse; border: 0px;">
		          <tr>
		            <td style="text-align:center" colspan="2">
		                <img style="border-radius:5px"src='{{ public_path("images/".$data->student_image) }}' width="140px" height="140px">
		            </td>
		        </tr>
		        <tr>
		            <td  style="text-transform: uppercase;color:#751A11;text-align:center;font-size:22px;" colspan="2">{{$data->student_name}}</td>
		        </tr>
		        </table>
		        <table style="margin-top:10px">
		        <tr >
		            <td style="text-align:left">ID</td>
		            <td style="text-align:left"> : {{$data->student_id}}</td>
		            <td style="text-align:right" rowspan="5"> <img style="margin-left: 30px" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(115)->generate(
		                 'ID : '.$data->id.
		                 '      Name : '.$data->student_name .
		                 '      Gender : '.$data->student_gender .
		                 '      DOB : '.$data->student_dob .
		                 '      Contact : '.$data->student_contact .
		                 '      College : '.$data->college->college_name .
		                 '      Department : '.$data->department->department_name.
		                 '      Batch : '.$data->batch->batch_name)) }} ">
		             </td>
		        </tr>
		        
		        <tr>
		            <td style="text-align:left">Gender</td>
		            <td style="text-align:left"> : {{$data->student_gender}}</td>
		        </tr>
		        <tr>
		            <td style="text-align:left">DOB</td>
		            <td style="text-align:left"> : {{$data->student_dob}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		        </tr>
		        <tr>
		            <td style="text-align:left">Contact</td>
		            <td style="text-align:left"> : {{$data->student_contact}}</td>
		        </tr>
		        <tr>
		            <td style="text-align:left">Department</td>
		            <td style="text-align:left"> : {{$data->department->department_name}}</td>
		        </tr>
		        <tr>
		            <td style="text-align:left">College</td>
		            <td style="text-align:left" colspan="2"> : {{$data->college->college_name}}</td>
		        </tr>
		        </table>
		        <br>
		        <p style="text-align:left;color:red">Validity {{$data->batch->batch_name}}
		         <span style="color:black"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Director's Sign_______</span>
		        </p>
		        <hr>
		        <center>
		            <p style="margin-top:0px;font-size: 14px">
		                Plot No. : 166, Opp IDI, B/h Someshwara Bungalows,<br>Vesu, Surat, Gujarat-395007 <br>Tel : +91 261 656 9800 | Fax : +91 261 400 9222<br>Email : admin@sdjgroup.org Website : www.sdjgroup.orc
		            </p>
		        </center>
		        </div>
		    @endif
        @endforeach
	</body>
</html>