document.addEventListener('DOMContentLoaded', () => {
	const showMessage = (form, messages) => {
		let messageBox = form.querySelector('.form-message');
		if (!messageBox) {
			messageBox = document.createElement('div');
			messageBox.className = 'alert error form-message';
			form.prepend(messageBox);
		}

		messageBox.innerHTML = messages.map((message) => `<div>${message}</div>`).join('');
		messageBox.style.display = 'block';
		messageBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
	};

	const clearMessage = (form) => {
		const messageBox = form.querySelector('.form-message');
		if (messageBox) {
			messageBox.innerHTML = '';
			messageBox.style.display = 'none';
		}
	};

	const registerForm = document.getElementById('register-form');
	if (registerForm) {
		registerForm.addEventListener('submit', (event) => {
			const messages = [];
			const name = registerForm.elements.name.value.trim();
			const phone = registerForm.elements.phone.value.trim();
			const email = registerForm.elements.email.value.trim();
			const password = registerForm.elements.password.value;
			const address = registerForm.elements.address.value.trim();

			if (name.length < 2) messages.push('Name must be at least 2 characters.');
			if (!/^[0-9+\-\s]{7,15}$/.test(phone)) messages.push('Enter a valid phone number.');
			if (!/^\S+@\S+\.\S+$/.test(email)) messages.push('Enter a valid email address.');
			if (password.length < 8) messages.push('Password must be at least 8 characters.');
			if (address.length < 5) messages.push('Delivery address must be at least 5 characters.');

			if (messages.length > 0) {
				event.preventDefault();
				showMessage(registerForm, messages);
			} else {
				clearMessage(registerForm);
			}
		});
	}

	const profileForm = document.getElementById('profile-form');
	if (profileForm) {
		profileForm.addEventListener('submit', (event) => {
			const messages = [];
			const name = profileForm.elements.name.value.trim();
			const email = profileForm.elements.email.value.trim();
			const phone = profileForm.elements.phone.value.trim();
			const address = profileForm.elements.address.value.trim();
			const currentPassword = profileForm.elements.current_password.value;
			const newPassword = profileForm.elements.new_password.value;

			if (name.length < 2) messages.push('Name must be at least 2 characters.');
			if (!/^\S+@\S+\.\S+$/.test(email)) messages.push('Enter a valid email address.');
			if (phone && !/^[0-9+\-\s]{7,15}$/.test(phone)) messages.push('Enter a valid phone number.');
			if (address.length < 5) messages.push('Delivery address must be at least 5 characters.');
			if (newPassword && newPassword.length < 8) messages.push('New password must be at least 8 characters.');
			if (newPassword && !currentPassword) messages.push('Current password is required to change your password.');

			if (messages.length > 0) {
				event.preventDefault();
				showMessage(profileForm, messages);
			} else {
				clearMessage(profileForm);
			}
		});
	}
});
