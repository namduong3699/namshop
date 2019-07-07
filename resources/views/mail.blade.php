<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<div class="container" style="width: 60%; display: block; margin: 50px 20%;	position: absolute;	border: 3px solid #2f3542; font-family: 'Source Sans Pro', sans-serif;">
	<div class="header" style="position: relative; widows: 80%; text-align: center; color: #fff; font-size: 32px; background-color: #16a085; border-bottom: 3px solid #2f3542; padding: 10px;">
		Thư phản hồi từ Cozastore
	</div>
	<div class="content" style="padding: 30px; background-color: #ecf0f1; text-align: justify; font-size: 16px;">
		<p>Chào bạn, đây là nội dung mà khách truy cập đã gửi về qua website <a href="http://localhost/namshop/contact">Cozastore</a></p>
		<table width="50%">
			<tr style="width: 40%">
				<td style="color: red; font-weight: bold;">Tên khách truy cập: </td>
				<td>{{$name}}</td>
			</tr>
			<tr style="width: 60%">
				<td style="color: red; font-weight: bold;">Email: </td>
				<td>{{$email}}</td>
			</tr>
		</table>
		<p><b style="color: red">Nội dung phản hồi:</b></p>
		<p>{{$content}}</p>
	</div>
</div>