module.exports = function(grunt, options) {

	return {
		sass: {
			files: ['elements/*/assets/scss/**/*.scss'],
			tasks: ['sass']
		}
	}
}
