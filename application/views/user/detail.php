<?php foreach ($family as $d) { ?>
<div class="row"> 
	<div class="col-md-12">
		<table class="table table-borderless table-sm">
			<tr>
				<td width="100">Nama</td>
				<td width="1">:</td>
				<td><?=$d['name']?></td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td><?=$d['title']?></td>
			</tr>
			<tr>
				<td>E-mail</td>
				<td>:</td>
				<td><?=$d['email']?></td>
			</tr>
			<tr>
				<td>Keahlian</td>
				<td>:</td>
				<td><?=$d['skill']?></td>
			</tr>
			<tr>
				<td colspan='3'>
					<?php if($d['link_fb'] != "") {?>
						<a href="<?=$d['link_fb']?>" class='social'><i class="fab fa-facebook " style="font-size:36px"></i></a>
					<?php } if($d['link_git'] != "") { ?>
					<a href="<?=$d['link_git']?>" class='social'><i class="fab fa-github" style="font-size:36px"></i></a>
					<?php } if($d['link_in'] != "") { ?>
					<a href="<?=$d['link_in']?>" class='social'><i class="fab fa-linkedin" style="font-size:36px"></i></a>
					<?php } ?>
				</td>
			</tr>
		</table>
	</div>
</div> 
<?php } ?>