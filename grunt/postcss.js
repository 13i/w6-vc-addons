module.exports = function(grunt, options) {
	return {
		options: {
			processors: [
				require('autoprefixer')({
					cascade: false,
					add: true,
					remove: false
				}),
				require('cssnano')()
			]
		},
		dist: {
			src: './elements/*/assets/css/*.css'
		}
	};
};
