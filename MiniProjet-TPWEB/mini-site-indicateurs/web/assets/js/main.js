document.addEventListener('DOMContentLoaded', () => {
	const cards = document.querySelectorAll('.card');
	cards.forEach((card, index) => {
		card.style.opacity = '0';
		card.style.transform = 'translateY(8px)';
		setTimeout(() => {
			card.style.transition = 'all 280ms ease';
			card.style.opacity = '1';
			card.style.transform = 'translateY(0)';
		}, index * 40);
	});
});

