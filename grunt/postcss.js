module.exports = function(grunt, options) {
	return {
		options: {
			processors: [
				require('autoprefixer')({
					browsers: [
						'ie >   = 8',
						'last 2 versions'
					],
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
