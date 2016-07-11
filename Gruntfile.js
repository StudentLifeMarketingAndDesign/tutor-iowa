module.exports = function(grunt) {

  var globalConfig = {
    themeDir: 'themes/tutor-foundation'
  };

  // Project configuration.
  grunt.initConfig({
    globalConfig: globalConfig,
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      dist: {
        files: {
          '<%=globalConfig.themeDir %>/css/app.css' : '<%=globalConfig.themeDir %>/scss/app.scss'
        },                  // Target
        options: {              // Target options
          outputStyle: 'compressed',
          includePaths: [
          '<%=globalConfig.themeDir %>/bower_components/foundation/scss'
          ]
        }
      }
    },
    //concat all the files into the build folder includePaths: 

    concat: {
      js:{
        src: [
          '<%=globalConfig.themeDir %>/bower_components/foundation/js/foundation.min.js',
          '<%=globalConfig.themeDir %>/bower_components/waypoints/lib/jquery.waypoints.min.js',
          '<%=globalConfig.themeDir %>/bower_components/waypoints/lib/shortcuts/infinite.min.js',
          'division-bar/js/division-bar.js',
          '<%=globalConfig.themeDir %>/bower_components/blazy/blazy.js',
          '<%=globalConfig.themeDir %>/javascript/*.js'

        ],
        dest: '<%=globalConfig.themeDir %>/build/build.src.js'
      }
    },

    //minify those concated files
    //toggle mangle to leave variable names intact

    uglify: {
      my_target:{
        files:{
        '<%=globalConfig.themeDir %>/build/build.js': ['<%=globalConfig.themeDir %>/build/build.src.js'],
        }
      }
    },

    watch: {
      scripts: {
        files: ['<%=globalConfig.themeDir %>/javascript/*.js', '<%=globalConfig.themeDir %>/javascript/**/*.js'],
        tasks: ['concat', 'uglify'],
        options: {
          spawn: true,
        }
      },
      css: {
        files: ['<%=globalConfig.themeDir %>/scss/*.scss',
                '<%=globalConfig.themeDir %>/scss/**/*.scss',
                'division-bar/scss/*.scss'
                ],
        tasks: ['sass'],
        options: {
          spawn: true,
        }
      }
    },

     criticalcss: {
            custom: {
                options: {
                    url: "http://localhost:8888/tutor-iowa/",
                    width: 1200,
                    height: 900,
                    outputfile: "<%=globalConfig.themeDir %>/templates/Includes/CriticalCss.ss",
                    filename: "<%=globalConfig.themeDir %>/css/app.css", // Using path.resolve( path.join( ... ) ) is a good idea here
                    buffer: 800*1024,
                    ignoreConsole: false
                }
            }
        }

  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-criticalcss');

  // Default task(s).
  // Note: order of tasks is very important
  grunt.registerTask('default', ['sass', 'concat', 'uglify', 'criticalcss', 'watch']);

};