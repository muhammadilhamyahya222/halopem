        <div class="row">
          <div class="col s12 m9">
            <h3 class="green-text">Pengaduan</h3>
          </div>
        </div>

        <table class="display responsive-table" style="width:100%">
          <thead>
              <tr style="background-color: #8FBC8F;">
				<th class="white-text">No</th>
				<th class="white-text">NIK</th>
				<th class="white-text">Nama</th>
				<th class="white-text">Tanggal Masuk</th>
				<th class="white-text">Status</th>
				<th class="white-text">Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik WHERE pengaduan.status='proses' ORDER BY pengaduan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nik']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><b><i><?php echo $r['status']; ?></td>
			<td><a class="btn modal-trigger blue" href="#more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>">More</a> </td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4>Detail</h4>
            <div class="col s12 m6">
				<p><b>NIK :</b> <?php echo $r['nik']; ?></p>
            	<p><b>Dari :</b> <?php echo $r['nama']; ?></p>
				<p><b>Tanggal Masuk :</b> <?php echo $r['tgl_pengaduan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
            </div>
            <?php 
            	if($r['status']=="proses"){ ?>
	            <div class="col s12 m6">
	            </div>
					<form method="POST">
						<div class="col s12 input-field">
							<label for="textarea">Isi Tanggapan</label>
							<textarea id="textarea" name="tanggapan" class="materialize-textarea" required></textarea>
						</div>
						<div class="col s12 input-field">
							<input type="submit" name="tanggapi" value="Kirim" class="btn right">
						</div>
					</form>
            <?php	}
             ?>

			<?php 
				if(isset($_POST['tanggapi'])){
					$tgl = date('Y-m-d');
					$query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','".$_SESSION['data']['id_petugas']."')");
					if($query){
						$update=mysqli_query($koneksi,"UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='".$r['id_pengaduan']."'");
						if($update){
							echo "<script>alert('Tanggapan Terkirim')</script>";
							echo "<script>location='index.php?p=pengaduan';</script>";
						}
					}
				}
			 ?>
          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        