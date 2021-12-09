<style>
table {  font-family: arial, sans-serif;  border-collapse: collapse;  width: 100%;}
td, th {  border: 1px solid #dddddd;  text-align: left;  padding: 8px;}
</style>
<h2>Users Issue Layout List</h2>
@php
$issue_detail = $issuesdata['issues'];
@endphp
<table>
<tbody>
<tr>
<th>Zone Name</th>
<th>Activity Name</th>
<th>Purpose</th>
<th>Issue Facing</th>
</tr>
@foreach($issue_detail as $issue)
<tr>
<td>{{$issue->zone_name}}</td>
<td>{{$issue->activity_name}}</td>
<td>{{$issue->purpose_name}}</td>
<td>{{$issue->issue_facing}}</td>
</tr>
@endforeach
</tbody>
</table>