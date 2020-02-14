<?php foreach ($family as $d) { ?>
<div class="row">
	<div class="col-md-12">
		<img 
            class='bd-placeholder-img card-img-top' 
            src="<?=$d['image_lg']; ?>" 
            onerror="this.src='https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png';
        "/>
        <hr>
	</div>
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
				<td></td>
				<td></td>
				<td>
					
				</td>
			</tr>
		</table>
	</div>
</div> 
<?php } ?>