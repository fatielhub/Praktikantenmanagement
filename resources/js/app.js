import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// AOS (Animate On Scroll) - provide smooth scroll-triggered animations
import AOS from 'aos';
import 'aos/dist/aos.css';

window.addEventListener('DOMContentLoaded', () => {
	// Initialize AOS
	AOS.init({
		once: true,
		duration: 650,
		easing: 'ease-out-cubic',
		offset: 120,
	});

	// Map existing utility classes to AOS for views that already use them
	document.querySelectorAll('.animate-fade-in').forEach(el => el.setAttribute('data-aos', 'fade-up'));
	document.querySelectorAll('.animate-fade-in-up').forEach(el => el.setAttribute('data-aos', 'fade-up'));
});
