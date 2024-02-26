<?php foreach ($post_information as $post) : ?>
	<h2><?= $post['judul_post'] ?></h2>
	<div class="tab">
		<button class="tablinks" onclick="openTab(event, 'Requirement')" id="Utama">Requirement</button>
		<button class="tablinks" onclick="openTab(event, 'Registrasi')">Registrasi</button>
		<button class="tablinks" onclick="openTab(event, 'Lamaran')">lamaran</button>
		<button class="tablinks" onclick="openTab(event, 'Portofolio')">portofolio</button>
	</div>
	<div id="Requirement" class="tabcontent">
		<img src="<?= base_url('asset/image/') . $post['foto'] ?>" alt="" />
		<p></p>
	<?php endforeach; ?>
	</div>
	<div id="Registrasi" class="tabcontent">
		<form action="/action_page.php" style="max-width:500px;margin:auto">
			<h2>Register Form</h2>
			<div class="input-container">
				<i class="fa fa-user icon"></i>
				<input class="input-field" type="text" placeholder="Username" name="usrnm">
			</div>
			<div class="input-container">
				<i class="fa fa-user icon"></i>
				<input class="input-field" type="text" placeholder="Umur" name="usrnm">
			</div>

			<div class="input-container">
				<i class="fa fa-envelope icon"></i>
				<input class="input-field" type="text" placeholder="Email" name="email">
			</div>

			<div class="input-container">
				<i class="fa fa-key icon"></i>
				<input class="input-field" type="password" placeholder="Password" name="psw">
			</div>

			<button type="submit" class="btn">Register</button>
		</form>
	</div>

	<div id="Lamaran" class="tabcontent">
		<h3>Paris</h3>
		<p>Paris is the capital of France.</p>
	</div>

	<div id="Portofolio" class="tabcontent">
		<h3>Tokyo</h3>
		<p>Tokyo is the capital of Japan.</p>
	</div>
