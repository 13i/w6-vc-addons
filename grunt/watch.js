module.exports = function(grunt, options) {

	return {
		sass: {
			files: ['elements/*/assets/src/scss/**/*.scss'],
			tasks: ['sass']
		}
	}
}
