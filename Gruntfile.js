module.exports = function(grunt) {

  grunt.initConfig({
    // load our main definition package
    pkg: grunt.file.readJSON('package.json'),


    /*
    * url: https://github.com/ai/autoprefixer
    * description: Autoprefixer uses the data on current browser popularity and properties support to apply prefixes for you:
      a { transition: transform 1s }
      become
      a {
        -webkit-transition: -webkit-transform 1s;
        transition: -ms-transform 1s;
        transition: transform 1s
      }
    */
    autoprefixer: {
      build: {
        options: {
          browsers: ['last 2 versions', '> 1%']
        },
        files: [
          {
            cwd: 'html/wp-content/themes/murdered/assets/css/',
            src : ['*.sass.css'],
            dest: 'html/wp-content/themes/murdered/assets/css/',
            ext : '.autoprefixed.css',
            expand : true
          }
        ]
      }
    },


    /*
    * url: https://github.com/gruntjs/grunt-contrib-cssmin
    * description: minify the css
    */

    cssmin: {
      minify: {
        expand: true,
        cwd: 'html/wp-content/themes/murdered/assets/css/',
        src: ['*.css', '!*.min.css'],
        dest: 'html/wp-content/themes/murdered/assets/css/',
        ext: '.min.css'
      }
    },

    /*
    * url: https://github.com/gruntjs/grunt-contrib-concat
    * description: concat all js plugin into one js file and concat the css prefixed with the icon and font css
    */
    concat: {
      options: {
        separator: ';',
        stripBanners: true,
        banner: '/*!\n<%= pkg.name %>\nv<%= pkg.version %>\n<%= grunt.template.today("mm-dd-yyyy") %>\nMade at <%= pkg.author.name %> - <%= pkg.author.url %>\n*/'
      },
      js: {
        src: ['html/wp-content/themes/murdered/assets/vendors/modernizr/modernizr-2.6.2.min.js', 'html/wp-content/themes/murdered/assets/js/globals.js', 'html/wp-content/themes/murdered/assets/js/murdered-*.js', '!html/wp-content/themes/murdered/assets/js/murdered-agegate.js' ],
        dest: 'html/wp-content/themes/murdered/assets/js/murdered.js'
      },
      agegatejs: {
        src: ['html/wp-content/themes/murdered/assets/vendors/modernizr/modernizr-2.6.2.min.js', 'html/wp-content/themes/murdered/assets/js/globals.js', 'html/wp-content/themes/murdered/assets/js/murdered-agegate.js'],
        dest: 'html/wp-content/themes/murdered/assets/js/agegate.js'
      },
      css: {
        src: ['html/wp-content/themes/murdered/assets/vendors/icomoon/style.css', 'html/wp-content/themes/murdered/assets/css/style.autoprefixed.css'],
        dest: 'html/wp-content/themes/murdered/assets/css/style.css'
      },
      agegate: {
        src: ['html/wp-content/themes/murdered/assets/vendors/icomoon/style.css', 'html/wp-content/themes/murdered/assets/css/agegate.autoprefixed.css'],
        dest: 'html/wp-content/themes/murdered/assets/css/agegate.css'
      }
    },

    /*
    * url: https://github.com/gruntjs/grunt-contrib-copy
    * description: copy icon, js and vendors into the documentation
    */
    copy: {
      // Copy all ./assets/ folder to Jekyll folder
      icomoon: {
        files: [
          { expand: true, cwd: 'html/wp-content/themes/murdered/assets/vendors/icomoon/fonts', src: ['./**/*.*'], dest: 'html/wp-content/themes/murdered/assets/css/fonts' }
        ]
      },
    },

    /*
    * url: https://github.com/gruntjs/grunt-contrib-uglify
    * description: Minify files with UglifyJS.
    */
    uglify: {
      options: {
        report: true
      },
      js: {
        files: {
          'html/wp-content/themes/murdered/assets/js/murdered.min.js': ['html/wp-content/themes/murdered/assets/js/murdered.js']
        }
      },
      agegate: {
        files: {
          'html/wp-content/themes/murdered/assets/js/agegate.min.js': ['html/wp-content/themes/murdered/assets/js/agegate.js']
        }
      }
    },

    /*
    * https://github.com/gruntjs/grunt-contrib-sass
    * description: compile sass to css
    */
    sass: {
      build: {
        files : [
          {
            src : ['*.scss', '!_*.scss'],
            cwd : 'html/wp-content/themes/murdered/assets/scss',
            dest : 'html/wp-content/themes/murdered/assets/css/',
            ext : '.sass.css',
            expand : true
          }
        ],
        options : {
          style : 'expanded'
        }
      }
    },
    /*
    * url: https://github.com/gruntjs/grunt-contrib-watch
    * description: Run predefined tasks whenever watched file patterns are added, changed or deleted.
    */
    watch: {
      scss: {
        files: ['html/wp-content/themes/murdered/assets/scss/**/*.scss'],
        tasks: ['scss']
      },
      js: {
        files: ['html/wp-content/themes/murdered/assets/js/murdered-*.js'],
        tasks: ['js']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          'html/wp-content/themes/murdered/*.php',
          'html/wp-content/themes/murdered/*.html',
          'html/wp-content/themes/murdered/assets/css/{,*/}*.css',
          'html/wp-content/themes/murdered/assets/js/murdered.js'
        ]
      }
    }
  });

  // CSS
  grunt.registerTask('scss', ['sass', 'autoprefixer', 'concat:css', 'concat:agegate', 'cssmin']);

  grunt.registerTask('js', ['concat:js', 'concat:agegatejs', 'uglify:js', 'uglify:agegate']);

  grunt.registerTask('dev', ['watch']);

  grunt.registerTask('default', ['scss', 'js', 'copy']);

  grunt.loadNpmTasks('grunt-sass');

  grunt.loadNpmTasks('grunt-autoprefixer');

  require('matchdep').filterDev('grunt-contrib*').forEach(grunt.loadNpmTasks);
};