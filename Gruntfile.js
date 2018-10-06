/* global module:false */

module.exports = function(grunt) {

	// Automatic config loading
	require('load-grunt-config')(grunt, {
		data: {
			pkg: grunt.file.readJSON('package.json')
		}
	});

	// Dev task.
	grunt.registerTask('dev', [
		'sass',
		'watch'
	]);

	// Dist task.
	grunt.registerTask('dist', [
		'sass',
		'postcss'
	]);

};
