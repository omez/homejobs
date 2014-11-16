var args = process.argv.slice(2);

var fs = require('fs');

/*var source = fs.readFileSync('../Tests/Decoder/stub.js', {
	encoding : 'UTF-8'
});*/

var safe_eval = eval;
eval = function(code) {
	return code;
}

var decode = function(data) {
	
	var regexp = /^\s*;\s*eval\((.*)\);\s*$/im;
	
	// console.log(data.slice(0,20));
	// console.log(regexp.test(data));
	
	if (regexp.test(data)) {
		var matches = data.match(regexp);
		var code = '(' + matches[1] + ')';
		
		//console.log(code);
		//console.log('----');
		
		if (/^\(function/i.test(code)) {
			return decode(safe_eval(code));
		} else {
			return code;
		}
	}
	
	return data;
}

if (args.length) {
	process.stdout.write(decode(args[0]));
	process.exit(0);
} else {
	process.exit(1);
}
