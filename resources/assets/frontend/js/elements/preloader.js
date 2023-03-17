preloader = () => {
	const preloaderBlock = document.getElementById('cube-loader');
	preloaderBlock.classList.add('close');
	preloaderBlock.remove();
	// setTimeout(() => { preloaderBlock.remove() },500);
};

document.addEventListener('DOMContentLoaded', () => {
	// setTimeout(() => { preloader() },2500);
	preloader();
});
