/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"application/views/web/index.php",
		"assets/revamp/js/script.js",
		"application/views/globals/revamp/header.php",
		"application/views/globals/revamp/footer.php",
		"application/views/web/new-dashboard.php",
		"application/views/web/partials/dashboard_content.php",
		"application/views/web/partials/dashboard_sidebar.php",
	],
	theme: {
		extend: {
			colors: {
				background: "#1b070a",
				primary: "#491820",
				secondary: "#7b2936",
				accent: "#db570f",
			},
			fontFamily: {
				inter: ["Inter", "sans-serif"],
			},
		},
	},
	plugins: [require("daisyui")],

	// daisyUI config (optional - here are the default values)
	daisyui: {
		themes: false, // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
		darkTheme: "dark", // name of one of the included themes for dark mode
		base: true, // applies background color and foreground color for root element by default
		styled: true, // include daisyUI colors and design decisions for all components
		utils: true, // adds responsive and modifier utility classes
		prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
		logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
		themeRoot: ":root", // The element that receives theme color CSS variables
	},
};
