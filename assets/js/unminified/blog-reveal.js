document.addEventListener("DOMContentLoaded", () => {
	const fadeInElements = () => fadin(".ast-fade-up", { delay: 200 });

	fadeInElements();

	// Adding a change event listener to apply fade-in effect after a delay,
	// allowing other actions to execute before the fade-in effect.
	document.addEventListener("change", () => {
		setTimeout(fadeInElements, 1000);
	});

	// addressing potential issues with slow network loading
	document.addEventListener("scroll", fadeInElements);
});
