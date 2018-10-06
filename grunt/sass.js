const sass = require('node-sass');

module.exports = function(grunt, options) {
	var scssFiles = {};
	for (var element of grunt.file.expand('elements/*')) {
		for (var file of grunt.file.expand(element + '/assets/scss/front.scss')) {
			scssFiles['./' + element + '/front.css'] = './' + element + '/assets/scss/front.scss';
		}
		for (var file of grunt.file.expand(element + '/assets/scss/admin.scss')) {
			scssFiles['./' + element + '/admin.css'] = './' + element + '/assets/scss/admin.scss';
		}
	}
	return {
		options: {
			implementation: sass,
			outputStyle: 'compact',
			sourceComments: false,
			sourceMap: true,
			includePaths: ['.']
		},
		dev: {
			files: scssFiles
		}
	};
};
