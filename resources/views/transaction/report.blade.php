<html>
	<head>
		<!-- <script src='{{public_path("js/jquery.min.js")}}'></script>
		<script src='{{public_path("js/bootstrap.js")}}'></script>
		<link rel="stylesheet" href='{{public_path("css/bootstrap.css")}}'/> -->
		<style>
		.page-break {
		    page-break-after: always;
		}
		</style>
	</head>
	<body>
		@foreach ($transaction as $data)
			@if($data->id==$id)
				<div class="container-fluid" style="margin:-20px;">
				<img style="text-align: center;" src='{{ public_path("images/sdj_logo.png") }}' width="30%">
		        <hr>
		        
				<table>
					<tr>
						<td>
							<p>
					            SDJ Internation College Library<br>Plot No. : 166, Opp IDI,<br>B/h Someshwara Bungalows,<br>Vesu, Surat, Gujarat-395007 <br>
					        </p>
					        <?php
					        	$date=date('Y');
					        ?>
					        <p style="font-size: 22px;margin-top: 20px">
					            Report No : R/{{$date}}/{{$data->id}}/{{$data->accession->accession_no}}/ {{$data->student_id}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					        </p>
					        <br>
						</td>
						<?php 
							if($data->status=='4')
							{
								$status=$data->actual_return_date;
							}
							else
							{
								$status="Pending";
							}
						?>
						<td>
		                 <img style="margin-left: 30px" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(180)->generate(
		                 'Report No : R/'.$date.'/'.$data->id.'/'.$data->book_id.'/'.$data->student_id.
		                 '          Transaction ID : ' .$data->id.
		                 '          Accession ID : ' .$data->accession_id.
		                 '          Book ID : ' . $data->accession->book_id.
		                 '          Book Name : ' . $data->accession->book->book_name.
		                 '          Student ID : ' . $data->student_id.
		                 '          Student Name : ' . $data->student->student_name.
		                 '          From Date : ' . $data->from_date.
		                 '          To Date : ' . $data->ro_date.
		                 '          Actural Return Date : ' . $status
		                 )) }} ">
						</td>
					</tr>
				</table>
				
		        
		        <?php
		        	$date=date('Y-m-d');
		        ?>
		        

		        <table>
		        	<tr>
		        		<th style="margin-right: 20px">Report Date:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		        		<th style="margin-right: 20px">Issue Date:&nbsp;&nbsp;&nbsp;&nbsp;</th>
		        		<th>Return Date:</th>
		        	</tr>
		        	<tr>
		        		<td>{{$date}}</td>
		        		<td>{{$data->from_date}}</td>
		        		<td>{{$data->to_date}}</td>
		        	</tr>
		        </table>
		        <br>
        		<table style="margin-top: 20px;border-collapse: collapse;border: 1px solid black;">
		   			<tr>
		        		<th style="border: 1px solid black;"> Accession No </th><td style="border: 1px solid black;">{{$data->accession->accession_no}}</td>
		        	</tr>

		        	<tr>
		        		<th style="border: 1px solid black;"> Book ID/Name </th><td style="border: 1px solid black;">{{$data->accession->book_id}} /{{$data->accession->book->book_name}}</td>
		        	</tr>
		        	<tr>
		        		<th style="border: 1px solid black;"> Student ID/Name </th><td style="border: 1px solid black;">{{$data->student_id}}/{{$data->student->student_name}}</td>
		        	</tr>
		        	<tr>
		        		<th style="border: 1px solid black;"> Student Contact </th><td style="border: 1px solid black;">{{$data->student->student_contact}}</td>
		        	</tr>
		        	<tr>
		        		<th style="border: 1px solid black;"> Student College </th><td style="border: 1px solid black;">{{$data->student->college->college_name}}</td>
		        	</tr>
		        	<tr>
		        		<th style="border: 1px solid black;"> Student Department </th><td>{{$data->student->department->department_name}}</td style="border: 1px solid black;">
		        	</tr>
		        	@if($data->status=='4')
		        	<tr>
		        		<th style="border: 1px solid black;"> Actual Return Date</th><td style="border: 1px solid black;">{{$data->actual_return_date}}</td>
		        	</tr>
		        	@else
		        	<tr>
		        		<th style="border: 1px solid black;"> Actual Return Date</th><td style="border: 1px solid black;">Pending</td>
		        	</tr>
		        	@endif
		        	<tr>
		        		<th style="border: 1px solid black;"> Issued By : </th><td style="border: 1px solid black;">{{$data->issued_by}}</td>
		        	</tr>
		        	@if($data->status=='4')
						<tr>
			        		<th style="border: 1px solid black;"> Taken By : </th><td style="border: 1px solid black;">{{$data->taken_by}}</td>
			        	</tr>
			       	@endif

<?php
date_default_timezone_set("Asia/Kolkata");                             
$date1 = $data->to_date;
$date2 = date('Y-m-d');
$days=0;
if($date2>$date1)
{
$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
}
?>			       	
					@if($data->status=="3")
					<tr>
		        		<th style="border: 1px solid black;"> No of Days Delay </th><td style="border: 1px solid black;">{{$days}}</td>
		        	</tr>
		        	<tr>
		        		<th style="border: 1px solid black;"> Fine Amount </th><td style="border: 1px solid black;">{{$days*10}}</td>
		        	</tr>					
					@else
			       	<tr>
		        		<th style="border: 1px solid black;"> No of Days Delay </th><td style="border: 1px solid black;">Returned</td>
		        	</tr>
		        	<tr>
		        		<th style="border: 1px solid black;"> Fine Amount </th><td style="border: 1px solid black;">Returned</td>
		        	</tr>
		        	@endif

		        </table>
		        
				</div>
		    @endif
        @endforeach
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <table width="100%">
        	<tr>
        		<td>
        			<p>
			        	_______________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			        </p>
        		</td>
        		<td>
        			<p>
			        	_______________
			        </p>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<p>
			        	 &nbsp;&nbsp;&nbsp;&nbsp;Student Sign&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			        </p>
        		</td>
        		<td>
        			<p>
			        	&nbsp;&nbsp;&nbsp;&nbsp;Librarian Sign
			        </p>
        		</td>
        	</tr>
        </table>
        


        <div class="page-break"></div>
        <b>Library Rules & Regulations</b>
        <ul>
        	<li>Library will be open from 10:00 AM to 5 PM.</li>
        	<li>Reading Room will be open from 10:00 AM to 5 PM.</li>
        	<li>No student will be allowed to avail library facility without valid ID card and library card. The borrower cards are not transferable.</li>
        	<li>Users should maintain peace in the library & should not disturb other readers in the library otherwise library facility will be withdrawn.</li>
        	<li>Unauthorized removal of books or damaging the property of library or misbehavior with library staff shall be considered as an act of indiscipline, which will call for strict action and or fine.</li>
        	<li>Books must be return on or before the due date otherwise the fine of Rs. 5 will be charged per day/book.</li>
        	<li>At the time of deposition of late fine you must collect receipt for the payment from the library.</li>
        	<li>Absence & illness are not acceptable excuses for exemption from paying overdue charges.</li>
        	<li>If the Due Date falls on holiday declare by collage, then students may return their books on the next week on scheduled day.</li>
        	<li>In spite of repeated reminders, if the book is not returned, the borrowing facility may be withdrawn for a period decided by the authority.</li>
        	<li>While entering the library, users have to keep all the belongings outside the reading room and the authority will not be responsible for any loss.</li>
        	<li>Students should take care of cleanliness of the library.</li>
        	<li>Students will only read the newspapers on the newspaper reading stand.</li>
        	<li>Students should not disturb the arrangements of the library furniture.</li>
        	<li>Mobile use is strictly prohibited in Library.</li>
        	<li>Student can issue 1 extra book for semester exam after library no dues.</li>
        	<li>The double cost of the book will have to pay if the issued book has lost.</li>
        	<li>It is mandatory for all members who are using facilities to follow the library rules & regulations. For any dispute or problem, Librarian may be contacted.</li>
        	<li>All members of the library team are available for any assistance you may need in using the library resources, facilities & services. Library will welcome any suggestion for better use of library facilities.</li>
        </ul>
	</body>
</html>