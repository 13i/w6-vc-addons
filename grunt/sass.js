const sass = require('node-sass');

module.exports = function(grunt, options) {
	var scssFiles = {};
	for (var element of grunt.file.expand('elements/*')) {
		for (var file of grunt.file.expand(element + '/assets/src/scss/front.scss')) {
			scssFiles['./' + element + '/assets/css/front.css'] = './' + element + '/assets/src/scss/front.scss';
		}
		for (var file of grunt.file.expand(element + '/assets/src/scss/admin.scss')) {
			scssFiles['./' + element + '/assets/css/admin.css'] = './' + element + '/assets/src/scss/admin.scss';
		}
	}
	return {
		options: {
			implementation: sass,
			outputStyle: 'compact',
			sourceComments: false,
			sourceMap: false,
			includePaths: ['.']
		},
		dev: {
			files: scssFiles
		}
	};
};
