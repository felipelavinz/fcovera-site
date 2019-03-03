const gulp = require('gulp');
const wpPot = require('gulp-wp-pot');

gulp.task('makepot', function(){
	return gulp.src( '**/*.php' )
		.pipe( wpPot({
			domain: 'chopan_2019',
			package: 'Chopan_2019'
		}) )
		.pipe( gulp.dest('languages/chopan-2019.pot') );
});