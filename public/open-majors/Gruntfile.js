module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),


		sass: {
			dist: {
				options: {
					style: 'compressed',
					compass: true
				},
				files: {
					'stylesheets/app.css': 'scss/app.scss',
				}
			}
		},

		watch: {
			css: {
				files: ['scss/*.scss', 'scss/**/*.scss'],
				tasks: ['sass'],
				options: {
					spawn: false,
				}
			},
		},

	});

	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default task(s).
	grunt.registerTask('default', ['sass', 'watch']);

};