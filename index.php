<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

	<form class="contact__form" action="<?php echo get_template_directory_uri(); ?>/send.php" method="POST">
		<span class="single-input-box">
			<label for="name">Name</label>
			<input type="text" id="name" name="name" placeholder="Your Name">
		</span>
		<span class="single-input-box">
			<label for="email">Email</label>
			<input type="text" id="email" name="email" placeholder="Your Email Address">
		</span>
		<span class="single-input-box">
			<label for="phone">Phone</label>
			<input type="text" id="phone" name="phone" placeholder="Your Phone Number">
		</span>
		<span class="single-input-box">
			<span class="form-heading p-com">
				<label for="">Treatment Type</label>
			</span>
			<span class="model-select">
				<span class="select">
					<select name="format" id="format">
						<option selected disabled>Treatment Type</option>
						<option value="Medication Management">Medication Management</option>
						<option value="Psychotherapy">Psychotherapy</option>
						<option value="Telepsychiatry">Telepsychiatry</option>
						<option value="Counseling">Counseling</option>
						<option value="Addiction treatment">Addiction treatment</option>
					</select>
				</span>
			</span>
		</span>
		<span class="single-input-box text-box">
			<label for="message">Message</label>
			<textarea id="message" name="message" placeholder="Your Message Goes Here…"></textarea>
		</span>

		<div class="g-recaptcha" data-sitekey="6LeaO3MaAAAAAE1xhhwQL1-kgFCVuU3nTfBAhQJv"></div>

		<span class="single-input-box submit-box">
			<span class="submit-arrow">&rarr;</span>
			<input type="submit" name="submit" value="submit">
		</span>

		<span class="success-msg contact__msg"> Your message was sent successfully. </span>
	</form>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script src="send.js"></script>
</body>
</html>

