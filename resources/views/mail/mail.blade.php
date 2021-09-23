<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
}
</style>
</head>
<body>

Hi, <strong>{{ $name }}</strong><br>
<p>This is a Reminder Mail from SDJ International College Libray to Return Book that you haven taken from library.<p>

<strong>Transaction Details</strong>
<table style="border:1px solid black">
	<tr>
		<td><strong>Transaction ID</strong></td>
		<td>{{$transaction_id}}</td>
	</tr>
	<tr>
		<td><strong>Book ID</strong></td>
		<td>{{$book_id}}</td>
	</tr>
	<tr>
		<td><strong>Accession No</strong></td>
		<td>{{$accession_no}}</td>
	</tr>
	<tr>
		<td><strong>Book Name</strong></td>
		<td>{{$book_name}}</td>
	</tr>
	<tr>
		<td><strong>Book Author</strong></td>
		<td>{{$author_name}}</td>
	</tr>
	<tr>
		<td><strong>Issue Date</strong></td>
		<td>{{$issue_date}}</td>
	</tr>
	<tr>
		<td><strong>Return Date</strong></td>
		<td>{{$return_date}}</td>
	</tr>
	<tr>
		<td><strong>No of Days Delay</strong></td>
		<td>{{$delay_days}}</td>
	</tr>
	<tr>
		<td><strong>Fine Amount</strong></td>
		<td>{{$fine_amt}}</td>
	</tr>
</table>
</body>
</html>