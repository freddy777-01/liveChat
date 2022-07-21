const inputs = document.querySelectorAll(".input-container input");

const alter = {
	addClass: (e) => {
		let inputTarget = e.target;
		let parent = inputTarget.parentNode;
		parent.classList.add("focus");
	},
	remClass: (e) => {
		let inputTarget = e.target;
		let parent = inputTarget.parentNode;
		if (e.target.value == "") {
			parent.classList.remove("focus");
		}
	},
};
inputs.forEach((el) => {
	el.addEventListener("focus", alter.addClass);
	el.addEventListener("blur", alter.remClass);
});
