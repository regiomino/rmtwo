/*!
 * Bootstrap's Gruntfile
 * http://getbootstrap.com
 * Copyright 2013-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

module.exports = function (grunt) {
  'use strict';

  // Force use of Unix newlines
  grunt.util.linefeed = '\n';

  RegExp.quote = function (string) {
    return string.replace(/[-\\^$*+?.()|[\]{}]/g, '\\$&');
  };

  var fs = require('fs');
  var path = require('path');
  var npmShrinkwrap = require('npm-shrinkwrap');
  var generateGlyphiconsData = require('./grunt/bs-glyphicons-data-generator.js');
  var BsLessdocParser = require('./grunt/bs-lessdoc-parser.js');
  var generateRawFiles = require('./grunt/bs-raw-files-generator.js');

  // Project configuration.
  grunt.initConfig({

    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
   
    // Task configuration.
    clean: {
      dist: ['css']
    },
    
    less: {
        compileCss: {
            options: {
              strictMath: true,
              sourceMap: false,
              outputSourceFiles: false
            },
            
            files: {
              'css/style.css': 'less/all_front.less',
              'css/style-back.css': 'less/all_back.less'
            }
        }
    },
    
    cssmin: {
        options: {
            compatibility: 'ie8',
            noAdvanced: true
        },
        core: {
            files: {
              'css/style.min.css': 'css/style.css',
              'css/style-back.min.css': 'css/style-back.css'
            }
        }
    },

    concat: {
        options: {
          stripBanners: true
        },
      
        regiominoJSFront: {
            src: [
                'js/bootstrap/transition.js',
                'js/bootstrap/alert.js',
                'js/bootstrap/button.js',
                'js/bootstrap/carousel.js',
                'js/bootstrap/collapse.js',
                'js/bootstrap/dropdown.js',
                'js/bootstrap/modal.js',
                'js/bootstrap/tooltip.js',
                'js/bootstrap/popover.js',
              //  'js/bootstrap/scrollspy.js',
                'js/bootstrap/tab.js',
                'js/bootstrap/affix.js',
                //'js/custom/jquery.jCounter-0.1.2.js',
               
                'js/global/global.js',
                           
                'js/frontend/custom/main.js'
                
            ],
            dest: 'js/regiomino.js'
        },
        
        regiominoJSBack: {
            src: [
                
                //Bootstrap
                'js/bootstrap/transition.js',
                'js/bootstrap/alert.js',
                'js/bootstrap/button.js',
                'js/bootstrap/carousel.js',
                'js/bootstrap/collapse.js',
                'js/bootstrap/dropdown.js',
                'js/bootstrap/modal.js',
                'js/bootstrap/tooltip.js',
                'js/bootstrap/popover.js',
                'js/bootstrap/scrollspy.js',
                'js/bootstrap/tab.js',
                'js/bootstrap/affix.js',
                
                //Plugins
                
                //Metis Menu
                'js/backend/plugins/metisMenu/metisMenu.min.js',
                
                //Data Tables
                'js/backend/plugins/dataTables/jquery.dataTables.js',
                'js/backend/plugins/dataTables/dataTables.bootstrap.js',
             
               /* //Flot
                'js/backend/plugins/flot/excanvas.min.js', */
                'js/backend/plugins/flot/jquery.flot.js',
                'js/backend/plugins/flot/jquery.flot.time.js',
                'js/backend/plugins/flot/jquery.flot.resize.js',
                'js/backend/plugins/flot/jquery.flot.tooltip.min.js',
              /*  'js/backend/plugins/flot/jquery.flot.pie.js',
                'js/backend/plugins/flot/jquery.flot.resize.js',
                'js/backend/plugins/flot/jquery.flot.tooltip.min.js',
                'js/backend/plugins/flot/flot-data.js',
                
                //Morris
               // 'js/backend/plugins/morris/raphael.min.js',
                'js/backend/plugins/morris/morris.min.js',
                'js/backend/plugins/morris/morris-data.js', 
                */
               
               
                'js/global/global.js',
                
                'js/backend/sb-admin-2.js' 
                
            ],
            dest: 'js/regiomino-back.js'
        }
        
    },

    uglify: {
      options: {
        preserveComments: 'some'
      },
      jsfront: {
        src: '<%= concat.regiominoJSFront.dest %>',
        dest: 'js/regiomino.min.js'
      },
      
      jsback: {
        src: '<%= concat.regiominoJSBack.dest %>',
        dest: 'js/regiomino-back.min.js'
      }
    },

    autoprefixer: {
        options: {
            browsers: [
                'Android 2.3',
                'Android >= 4',
                'Chrome >= 20',
                'Firefox >= 10', // Firefox 24 is the latest ESR
                'Explorer >= 8',
                'iOS >= 6',
                'Opera >= 12',
                'Safari >= 6'
            ]
        },
       
        dist: { // Target
          files: {
            'css/style.css': 'css/style.css',
            'css/style-back.css': 'css/style-back.css',
          }
        }
    },

    copy: {
        fonts: {
            expand: true,
            src: 'fonts/*',
            dest: 'dist/'
        }
    },

    watch: {
        less: {
            files: 'less/**/*.less',
            tasks: ['less','autoprefixer', 'cssmin']
        },
        
        js: {
            files: ['js/backend/**/*.js', 'js/bootstrap/*.js','js/frontend/custom/*.js','js/global/**/*.js'],
            tasks : ['concat','uglify']
        }
    },

    exec: {
        npmUpdate: {
            command: 'npm update'
        } 
    }
  });


  // These plugins provide necessary tasks.
  require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });
  
/******************************/
// Tasks
/******************************/

  // JS distribution task.
  grunt.registerTask('dist-js', ['uglify']);

  // CSS distribution task.
  
  grunt.registerTask('dist-css', ['less-compile', 'autoprefixer', 'cssmin']);
 
  // Full distribution task.
  grunt.registerTask('dist', ['clean', 'dist-css', 'copy:fonts', 'dist-js', 'dist-docs']);

  // Default task.
  grunt.registerTask('default', ['test', 'dist', 'build-glyphicons-data', 'build-customizer']);

  // Version numbering task.
  // grunt change-version-number --oldver=A.B.C --newver=X.Y.Z
  // This can be overzealous, so its changes should always be manually reviewed!
  grunt.registerTask('change-version-number', 'sed');

  grunt.registerTask('build-glyphicons-data', function () { generateGlyphiconsData.call(this, grunt); });

 

  // Task for updating the cached npm packages used by the Travis build (which are controlled by test-infra/npm-shrinkwrap.json).
  // This task should be run and the updated file should be committed whenever Bootstrap's dependencies change.
  grunt.registerTask('update-shrinkwrap', ['exec:npmUpdate', '_update-shrinkwrap']);
  grunt.registerTask('_update-shrinkwrap', function () {
    var done = this.async();
    npmShrinkwrap({ dev: true, dirname: __dirname }, function (err) {
      if (err) {
        grunt.fail.warn(err)
      }
      var dest = 'test-infra/npm-shrinkwrap.json';
      fs.renameSync('npm-shrinkwrap.json', dest);
      grunt.log.writeln('File ' + dest.cyan + ' updated.');
      done();
    });
  });
};
