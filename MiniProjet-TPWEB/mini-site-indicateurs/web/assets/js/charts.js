document.addEventListener('DOMContentLoaded', () => {
	if (!window.Chart || !window.chartData) {
		return;
	}

	const countriesCtx = document.getElementById('countriesChart');
	if (countriesCtx) {
		const labels = window.chartData.countries.map((row) => row.country);
		const values = window.chartData.countries.map((row) => Number(row.nb_solves));
		new Chart(countriesCtx, {
			type: 'bar',
			data: {
				labels,
				datasets: [{
					label: 'Nombre de solves',
					data: values,
					backgroundColor: '#d96f32'
				}]
			},
			options: {
				responsive: true,
				plugins: { legend: { display: false } }
			}
		});
	}

	const distCtx = document.getElementById('distributionChart');
	if (distCtx) {
		const pretty = {
			lt400: '< 400',
			'400_449': '400-449',
			'450_499': '450-499',
			'500_549': '500-549',
			gte550: '>= 550'
		};

		const labels = window.chartData.distribution.map((row) => pretty[row.bucket] || row.bucket);
		const values = window.chartData.distribution.map((row) => Number(row.nb));

		new Chart(distCtx, {
			type: 'doughnut',
			data: {
				labels,
				datasets: [{
					data: values,
					backgroundColor: ['#2f7c7a', '#4f9b99', '#e0ac51', '#d96f32', '#b8441d']
				}]
			},
			options: {
				responsive: true,
				plugins: { legend: { position: 'bottom' } }
			}
		});
	}
});

