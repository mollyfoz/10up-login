import gulp from 'gulp';
import requireDir from 'require-dir';
import runSequence from 'run-sequence';
import livereload from 'gulp-livereload';

requireDir( './gulp-tasks' );

gulp.task( 'js', () => {
	runSequence(
		'webpack',
	);
} );

gulp.task( 'cssprocess', () => {
	runSequence(
		'css',
		'cssnano',
		'cssclean'
	);
} );

gulp.task( 'watch', () => {
	process.env.NODE_ENV = 'development';
	livereload.listen( { basePath: 'dist' } );
	gulp.watch( ['./assets/css/**/*.css', '!./assets/css/src/**/*.css'], ['cssprocess'] );
	gulp.watch( './assets/js/**/*.js', ['js'] );
} );

gulp.task( 'default', () => {
	runSequence(
		'set-prod-node-env',
		'cssprocess',
		'webpack'
	);
} );
