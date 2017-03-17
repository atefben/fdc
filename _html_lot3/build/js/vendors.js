/*!
 * jQuery JavaScript Library v2.2.4
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2016-05-20T17:23Z
 */

(function( global, factory ) {

	if ( typeof module === "object" && typeof module.exports === "object" ) {
		// For CommonJS and CommonJS-like environments where a proper `window`
		// is present, execute the factory and get jQuery.
		// For environments that do not have a `window` with a `document`
		// (such as Node.js), expose a factory as module.exports.
		// This accentuates the need for the creation of a real `window`.
		// e.g. var jQuery = require("jquery")(window);
		// See ticket #14549 for more info.
		module.exports = global.document ?
			factory( global, true ) :
			function( w ) {
				if ( !w.document ) {
					throw new Error( "jQuery requires a window with a document" );
				}
				return factory( w );
			};
	} else {
		factory( global );
	}

// Pass this if window is not defined yet
}(typeof window !== "undefined" ? window : this, function( window, noGlobal ) {

// Support: Firefox 18+
// Can't be in strict mode, several libs including ASP.NET trace
// the stack via arguments.caller.callee and Firefox dies if
// you try to trace through "use strict" call chains. (#13335)
//"use strict";
var arr = [];

var document = window.document;

var slice = arr.slice;

var concat = arr.concat;

var push = arr.push;

var indexOf = arr.indexOf;

var class2type = {};

var toString = class2type.toString;

var hasOwn = class2type.hasOwnProperty;

var support = {};



var
	version = "2.2.4",

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {

		// The jQuery object is actually just the init constructor 'enhanced'
		// Need init if jQuery is called (just allow error to be thrown if not included)
		return new jQuery.fn.init( selector, context );
	},

	// Support: Android<4.1
	// Make sure we trim BOM and NBSP
	rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,

	// Matches dashed string for camelizing
	rmsPrefix = /^-ms-/,
	rdashAlpha = /-([\da-z])/gi,

	// Used by jQuery.camelCase as callback to replace()
	fcamelCase = function( all, letter ) {
		return letter.toUpperCase();
	};

jQuery.fn = jQuery.prototype = {

	// The current version of jQuery being used
	jquery: version,

	constructor: jQuery,

	// Start with an empty selector
	selector: "",

	// The default length of a jQuery object is 0
	length: 0,

	toArray: function() {
		return slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {
		return num != null ?

			// Return just the one element from the set
			( num < 0 ? this[ num + this.length ] : this[ num ] ) :

			// Return all the elements in a clean array
			slice.call( this );
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;
		ret.context = this.context;

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	each: function( callback ) {
		return jQuery.each( this, callback );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map( this, function( elem, i ) {
			return callback.call( elem, i, elem );
		} ) );
	},

	slice: function() {
		return this.pushStack( slice.apply( this, arguments ) );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	eq: function( i ) {
		var len = this.length,
			j = +i + ( i < 0 ? len : 0 );
		return this.pushStack( j >= 0 && j < len ? [ this[ j ] ] : [] );
	},

	end: function() {
		return this.prevObject || this.constructor();
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: push,
	sort: arr.sort,
	splice: arr.splice
};

jQuery.extend = jQuery.fn.extend = function() {
	var options, name, src, copy, copyIsArray, clone,
		target = arguments[ 0 ] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;

		// Skip the boolean and the target
		target = arguments[ i ] || {};
		i++;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !jQuery.isFunction( target ) ) {
		target = {};
	}

	// Extend jQuery itself if only one argument is passed
	if ( i === length ) {
		target = this;
		i--;
	}

	for ( ; i < length; i++ ) {

		// Only deal with non-null/undefined values
		if ( ( options = arguments[ i ] ) != null ) {

			// Extend the base object
			for ( name in options ) {
				src = target[ name ];
				copy = options[ name ];

				// Prevent never-ending loop
				if ( target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject( copy ) ||
					( copyIsArray = jQuery.isArray( copy ) ) ) ) {

					if ( copyIsArray ) {
						copyIsArray = false;
						clone = src && jQuery.isArray( src ) ? src : [];

					} else {
						clone = src && jQuery.isPlainObject( src ) ? src : {};
					}

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend( {

	// Unique for each copy of jQuery on the page
	expando: "jQuery" + ( version + Math.random() ).replace( /\D/g, "" ),

	// Assume jQuery is ready without the ready module
	isReady: true,

	error: function( msg ) {
		throw new Error( msg );
	},

	noop: function() {},

	isFunction: function( obj ) {
		return jQuery.type( obj ) === "function";
	},

	isArray: Array.isArray,

	isWindow: function( obj ) {
		return obj != null && obj === obj.window;
	},

	isNumeric: function( obj ) {

		// parseFloat NaNs numeric-cast false positives (null|true|false|"")
		// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
		// subtraction forces infinities to NaN
		// adding 1 corrects loss of precision from parseFloat (#15100)
		var realStringObj = obj && obj.toString();
		return !jQuery.isArray( obj ) && ( realStringObj - parseFloat( realStringObj ) + 1 ) >= 0;
	},

	isPlainObject: function( obj ) {
		var key;

		// Not plain objects:
		// - Any object or value whose internal [[Class]] property is not "[object Object]"
		// - DOM nodes
		// - window
		if ( jQuery.type( obj ) !== "object" || obj.nodeType || jQuery.isWindow( obj ) ) {
			return false;
		}

		// Not own constructor property must be Object
		if ( obj.constructor &&
				!hasOwn.call( obj, "constructor" ) &&
				!hasOwn.call( obj.constructor.prototype || {}, "isPrototypeOf" ) ) {
			return false;
		}

		// Own properties are enumerated firstly, so to speed up,
		// if last one is own, then all properties are own
		for ( key in obj ) {}

		return key === undefined || hasOwn.call( obj, key );
	},

	isEmptyObject: function( obj ) {
		var name;
		for ( name in obj ) {
			return false;
		}
		return true;
	},

	type: function( obj ) {
		if ( obj == null ) {
			return obj + "";
		}

		// Support: Android<4.0, iOS<6 (functionish RegExp)
		return typeof obj === "object" || typeof obj === "function" ?
			class2type[ toString.call( obj ) ] || "object" :
			typeof obj;
	},

	// Evaluates a script in a global context
	globalEval: function( code ) {
		var script,
			indirect = eval;

		code = jQuery.trim( code );

		if ( code ) {

			// If the code includes a valid, prologue position
			// strict mode pragma, execute code by injecting a
			// script tag into the document.
			if ( code.indexOf( "use strict" ) === 1 ) {
				script = document.createElement( "script" );
				script.text = code;
				document.head.appendChild( script ).parentNode.removeChild( script );
			} else {

				// Otherwise, avoid the DOM node creation, insertion
				// and removal by using an indirect global eval

				indirect( code );
			}
		}
	},

	// Convert dashed to camelCase; used by the css and data modules
	// Support: IE9-11+
	// Microsoft forgot to hump their vendor prefix (#9572)
	camelCase: function( string ) {
		return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
	},

	nodeName: function( elem, name ) {
		return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();
	},

	each: function( obj, callback ) {
		var length, i = 0;

		if ( isArrayLike( obj ) ) {
			length = obj.length;
			for ( ; i < length; i++ ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		} else {
			for ( i in obj ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		}

		return obj;
	},

	// Support: Android<4.1
	trim: function( text ) {
		return text == null ?
			"" :
			( text + "" ).replace( rtrim, "" );
	},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var ret = results || [];

		if ( arr != null ) {
			if ( isArrayLike( Object( arr ) ) ) {
				jQuery.merge( ret,
					typeof arr === "string" ?
					[ arr ] : arr
				);
			} else {
				push.call( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		return arr == null ? -1 : indexOf.call( arr, elem, i );
	},

	merge: function( first, second ) {
		var len = +second.length,
			j = 0,
			i = first.length;

		for ( ; j < len; j++ ) {
			first[ i++ ] = second[ j ];
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, invert ) {
		var callbackInverse,
			matches = [],
			i = 0,
			length = elems.length,
			callbackExpect = !invert;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			callbackInverse = !callback( elems[ i ], i );
			if ( callbackInverse !== callbackExpect ) {
				matches.push( elems[ i ] );
			}
		}

		return matches;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var length, value,
			i = 0,
			ret = [];

		// Go through the array, translating each of the items to their new values
		if ( isArrayLike( elems ) ) {
			length = elems.length;
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}

		// Go through every key on the object,
		} else {
			for ( i in elems ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}
		}

		// Flatten any nested arrays
		return concat.apply( [], ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// Bind a function to a context, optionally partially applying any
	// arguments.
	proxy: function( fn, context ) {
		var tmp, args, proxy;

		if ( typeof context === "string" ) {
			tmp = fn[ context ];
			context = fn;
			fn = tmp;
		}

		// Quick check to determine if target is callable, in the spec
		// this throws a TypeError, but we will just return undefined.
		if ( !jQuery.isFunction( fn ) ) {
			return undefined;
		}

		// Simulated bind
		args = slice.call( arguments, 2 );
		proxy = function() {
			return fn.apply( context || this, args.concat( slice.call( arguments ) ) );
		};

		// Set the guid of unique handler to the same of original handler, so it can be removed
		proxy.guid = fn.guid = fn.guid || jQuery.guid++;

		return proxy;
	},

	now: Date.now,

	// jQuery.support is not used in Core but other projects attach their
	// properties to it so it needs to exist.
	support: support
} );

// JSHint would error on this code due to the Symbol not being defined in ES5.
// Defining this global in .jshintrc would create a danger of using the global
// unguarded in another place, it seems safer to just disable JSHint for these
// three lines.
/* jshint ignore: start */
if ( typeof Symbol === "function" ) {
	jQuery.fn[ Symbol.iterator ] = arr[ Symbol.iterator ];
}
/* jshint ignore: end */

// Populate the class2type map
jQuery.each( "Boolean Number String Function Array Date RegExp Object Error Symbol".split( " " ),
function( i, name ) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
} );

function isArrayLike( obj ) {

	// Support: iOS 8.2 (not reproducible in simulator)
	// `in` check used to prevent JIT error (gh-2145)
	// hasOwn isn't used here due to false negatives
	// regarding Nodelist length in IE
	var length = !!obj && "length" in obj && obj.length,
		type = jQuery.type( obj );

	if ( type === "function" || jQuery.isWindow( obj ) ) {
		return false;
	}

	return type === "array" || length === 0 ||
		typeof length === "number" && length > 0 && ( length - 1 ) in obj;
}
var Sizzle =
/*!
 * Sizzle CSS Selector Engine v2.2.1
 * http://sizzlejs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2015-10-17
 */
(function( window ) {

var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + 1 * new Date(),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// General-purpose constants
	MAX_NEGATIVE = 1 << 31,

	// Instance methods
	hasOwn = ({}).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	push_native = arr.push,
	push = arr.push,
	slice = arr.slice,
	// Use a stripped-down indexOf as it's faster than native
	// http://jsperf.com/thor-indexof-vs-for/5
	indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[i] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",

	// http://www.w3.org/TR/CSS21/syndata.html#value-def-identifier
	identifier = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + identifier + ")(?:" + whitespace +
		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +
		// "Attribute values must be CSS identifiers [capture 5] or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" + whitespace +
		"*\\]",

	pseudos = ":(" + identifier + ")(?:\\((" +
		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +
		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +
		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rwhitespace = new RegExp( whitespace + "+", "g" ),
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" + whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace + "*" ),

	rattributeQuotes = new RegExp( "=" + whitespace + "*([^\\]'\"]*?)" + whitespace + "*\\]", "g" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + identifier + ")" ),
		"CLASS": new RegExp( "^\\.(" + identifier + ")" ),
		"TAG": new RegExp( "^(" + identifier + "|[*])" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + whitespace +
			"*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" + whitespace +
			"*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),
		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
			whitespace + "*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,
	rescape = /'|\\/g,

	// CSS escapes http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\([\\da-f]{1,6}" + whitespace + "?|(" + whitespace + ")|.)", "ig" ),
	funescape = function( _, escaped, escapedWhitespace ) {
		var high = "0x" + escaped - 0x10000;
		// NaN means non-codepoint
		// Support: Firefox<24
		// Workaround erroneous numeric interpretation of +"0x"
		return high !== high || escapedWhitespace ?
			escaped :
			high < 0 ?
				// BMP codepoint
				String.fromCharCode( high + 0x10000 ) :
				// Supplemental Plane codepoint (surrogate pair)
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	},

	// Used for iframes
	// See setDocument()
	// Removing the function wrapper causes a "Permission Denied"
	// error in IE
	unloadHandler = function() {
		setDocument();
	};

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		(arr = slice.call( preferredDoc.childNodes )),
		preferredDoc.childNodes
	);
	// Support: Android<4.0
	// Detect silently failing push.apply
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			push_native.apply( target, slice.call(els) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;
			// Can't trust NodeList.length
			while ( (target[j++] = els[i++]) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var m, i, elem, nid, nidselect, match, groups, newSelector,
		newContext = context && context.ownerDocument,

		// nodeType defaults to 9, since context defaults to document
		nodeType = context ? context.nodeType : 9;

	results = results || [];

	// Return early from calls with invalid selector or context
	if ( typeof selector !== "string" || !selector ||
		nodeType !== 1 && nodeType !== 9 && nodeType !== 11 ) {

		return results;
	}

	// Try to shortcut find operations (as opposed to filters) in HTML documents
	if ( !seed ) {

		if ( ( context ? context.ownerDocument || context : preferredDoc ) !== document ) {
			setDocument( context );
		}
		context = context || document;

		if ( documentIsHTML ) {

			// If the selector is sufficiently simple, try using a "get*By*" DOM method
			// (excepting DocumentFragment context, where the methods don't exist)
			if ( nodeType !== 11 && (match = rquickExpr.exec( selector )) ) {

				// ID selector
				if ( (m = match[1]) ) {

					// Document context
					if ( nodeType === 9 ) {
						if ( (elem = context.getElementById( m )) ) {

							// Support: IE, Opera, Webkit
							// TODO: identify versions
							// getElementById can match elements by name instead of ID
							if ( elem.id === m ) {
								results.push( elem );
								return results;
							}
						} else {
							return results;
						}

					// Element context
					} else {

						// Support: IE, Opera, Webkit
						// TODO: identify versions
						// getElementById can match elements by name instead of ID
						if ( newContext && (elem = newContext.getElementById( m )) &&
							contains( context, elem ) &&
							elem.id === m ) {

							results.push( elem );
							return results;
						}
					}

				// Type selector
				} else if ( match[2] ) {
					push.apply( results, context.getElementsByTagName( selector ) );
					return results;

				// Class selector
				} else if ( (m = match[3]) && support.getElementsByClassName &&
					context.getElementsByClassName ) {

					push.apply( results, context.getElementsByClassName( m ) );
					return results;
				}
			}

			// Take advantage of querySelectorAll
			if ( support.qsa &&
				!compilerCache[ selector + " " ] &&
				(!rbuggyQSA || !rbuggyQSA.test( selector )) ) {

				if ( nodeType !== 1 ) {
					newContext = context;
					newSelector = selector;

				// qSA looks outside Element context, which is not what we want
				// Thanks to Andrew Dupont for this workaround technique
				// Support: IE <=8
				// Exclude object elements
				} else if ( context.nodeName.toLowerCase() !== "object" ) {

					// Capture the context ID, setting it first if necessary
					if ( (nid = context.getAttribute( "id" )) ) {
						nid = nid.replace( rescape, "\\$&" );
					} else {
						context.setAttribute( "id", (nid = expando) );
					}

					// Prefix every selector in the list
					groups = tokenize( selector );
					i = groups.length;
					nidselect = ridentifier.test( nid ) ? "#" + nid : "[id='" + nid + "']";
					while ( i-- ) {
						groups[i] = nidselect + " " + toSelector( groups[i] );
					}
					newSelector = groups.join( "," );

					// Expand context for sibling selectors
					newContext = rsibling.test( selector ) && testContext( context.parentNode ) ||
						context;
				}

				if ( newSelector ) {
					try {
						push.apply( results,
							newContext.querySelectorAll( newSelector )
						);
						return results;
					} catch ( qsaError ) {
					} finally {
						if ( nid === expando ) {
							context.removeAttribute( "id" );
						}
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {function(string, object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {
		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {
			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return (cache[ key + " " ] = value);
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created div and expects a boolean result
 */
function assert( fn ) {
	var div = document.createElement("div");

	try {
		return !!fn( div );
	} catch (e) {
		return false;
	} finally {
		// Remove from its parent by default
		if ( div.parentNode ) {
			div.parentNode.removeChild( div );
		}
		// release memory in IE
		div = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split("|"),
		i = arr.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[i] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			( ~b.sourceIndex || MAX_NEGATIVE ) -
			( ~a.sourceIndex || MAX_NEGATIVE );

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( (cur = cur.nextSibling) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return (name === "input" || name === "button") && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction(function( argument ) {
		argument = +argument;
		return markFunction(function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ (j = matchIndexes[i]) ] ) {
					seed[j] = !(matches[j] = seed[j]);
				}
			}
		});
	});
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== "undefined" && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	// documentElement is verified for cases where it doesn't yet exist
	// (such as loading iframes in IE - #4833)
	var documentElement = elem && (elem.ownerDocument || elem).documentElement;
	return documentElement ? documentElement.nodeName !== "HTML" : false;
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare, parent,
		doc = node ? node.ownerDocument || node : preferredDoc;

	// Return early if doc is invalid or already selected
	if ( doc === document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Update global variables
	document = doc;
	docElem = document.documentElement;
	documentIsHTML = !isXML( document );

	// Support: IE 9-11, Edge
	// Accessing iframe documents after unload throws "permission denied" errors (jQuery #13936)
	if ( (parent = document.defaultView) && parent.top !== parent ) {
		// Support: IE 11
		if ( parent.addEventListener ) {
			parent.addEventListener( "unload", unloadHandler, false );

		// Support: IE 9 - 10 only
		} else if ( parent.attachEvent ) {
			parent.attachEvent( "onunload", unloadHandler );
		}
	}

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties
	// (excepting IE8 booleans)
	support.attributes = assert(function( div ) {
		div.className = "i";
		return !div.getAttribute("className");
	});

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert(function( div ) {
		div.appendChild( document.createComment("") );
		return !div.getElementsByTagName("*").length;
	});

	// Support: IE<9
	support.getElementsByClassName = rnative.test( document.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert(function( div ) {
		docElem.appendChild( div ).id = expando;
		return !document.getElementsByName || !document.getElementsByName( expando ).length;
	});

	// ID find and filter
	if ( support.getById ) {
		Expr.find["ID"] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var m = context.getElementById( id );
				return m ? [ m ] : [];
			}
		};
		Expr.filter["ID"] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute("id") === attrId;
			};
		};
	} else {
		// Support: IE6/7
		// getElementById is not reliable as a find shortcut
		delete Expr.find["ID"];

		Expr.filter["ID"] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== "undefined" &&
					elem.getAttributeNode("id");
				return node && node.value === attrId;
			};
		};
	}

	// Tag
	Expr.find["TAG"] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== "undefined" ) {
				return context.getElementsByTagName( tag );

			// DocumentFragment nodes don't have gEBTN
			} else if ( support.qsa ) {
				return context.querySelectorAll( tag );
			}
		} :

		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,
				// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( (elem = results[i++]) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find["CLASS"] = support.getElementsByClassName && function( className, context ) {
		if ( typeof context.getElementsByClassName !== "undefined" && documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See http://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( (support.qsa = rnative.test( document.querySelectorAll )) ) {
		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert(function( div ) {
			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// http://bugs.jquery.com/ticket/12359
			docElem.appendChild( div ).innerHTML = "<a id='" + expando + "'></a>" +
				"<select id='" + expando + "-\r\\' msallowcapture=''>" +
				"<option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// http://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( div.querySelectorAll("[msallowcapture^='']").length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !div.querySelectorAll("[selected]").length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Support: Chrome<29, Android<4.4, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.8+
			if ( !div.querySelectorAll( "[id~=" + expando + "-]" ).length ) {
				rbuggyQSA.push("~=");
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":checked").length ) {
				rbuggyQSA.push(":checked");
			}

			// Support: Safari 8+, iOS 8+
			// https://bugs.webkit.org/show_bug.cgi?id=136851
			// In-page `selector#id sibing-combinator selector` fails
			if ( !div.querySelectorAll( "a#" + expando + "+*" ).length ) {
				rbuggyQSA.push(".#.+[+~]");
			}
		});

		assert(function( div ) {
			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = document.createElement("input");
			input.setAttribute( "type", "hidden" );
			div.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( div.querySelectorAll("[name=d]").length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":enabled").length ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Opera 10-11 does not throw on post-comma invalid pseudos
			div.querySelectorAll("*,:x");
			rbuggyQSA.push(",.*:");
		});
	}

	if ( (support.matchesSelector = rnative.test( (matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector) )) ) {

		assert(function( div ) {
			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( div, "div" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( div, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		});
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join("|") );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join("|") );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully self-exclusive
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			));
		} :
		function( a, b ) {
			if ( b ) {
				while ( (b = b.parentNode) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		compare = ( a.ownerDocument || a ) === ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			(!support.sortDetached && b.compareDocumentPosition( a ) === compare) ) {

			// Choose the first element that is related to our preferred document
			if ( a === document || a.ownerDocument === preferredDoc && contains(preferredDoc, a) ) {
				return -1;
			}
			if ( b === document || b.ownerDocument === preferredDoc && contains(preferredDoc, b) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {
		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {
			return a === document ? -1 :
				b === document ? 1 :
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( (cur = cur.parentNode) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( (cur = cur.parentNode) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[i] === bp[i] ) {
			i++;
		}

		return i ?
			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[i], bp[i] ) :

			// Otherwise nodes in our document sort first
			ap[i] === preferredDoc ? -1 :
			bp[i] === preferredDoc ? 1 :
			0;
	};

	return document;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	// Make sure that attribute selectors are quoted
	expr = expr.replace( rattributeQuotes, "='$1']" );

	if ( support.matchesSelector && documentIsHTML &&
		!compilerCache[ expr + " " ] &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||
					// As well, disconnected nodes are said to be in a document
					// fragment in IE 9
					elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch (e) {}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {
	// Set document vars if needed
	if ( ( context.ownerDocument || context ) !== document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],
		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			(val = elem.getAttributeNode(name)) && val.specified ?
				val.value :
				null;
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( (elem = results[i++]) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {
		// If no nodeType, this is expected to be an array
		while ( (node = elem[i++]) ) {
			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {
		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {
			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}
	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[1] = match[1].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[3] = ( match[3] || match[4] || match[5] || "" ).replace( runescape, funescape );

			if ( match[2] === "~=" ) {
				match[3] = " " + match[3] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {
			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[1] = match[1].toLowerCase();

			if ( match[1].slice( 0, 3 ) === "nth" ) {
				// nth-* requires argument
				if ( !match[3] ) {
					Sizzle.error( match[0] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[4] = +( match[4] ? match[5] + (match[6] || 1) : 2 * ( match[3] === "even" || match[3] === "odd" ) );
				match[5] = +( ( match[7] + match[8] ) || match[3] === "odd" );

			// other types prohibit arguments
			} else if ( match[3] ) {
				Sizzle.error( match[0] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[6] && match[2];

			if ( matchExpr["CHILD"].test( match[0] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[3] ) {
				match[2] = match[4] || match[5] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&
				// Get excess from tokenize (recursively)
				(excess = tokenize( unquoted, true )) &&
				// advance to the next closing parenthesis
				(excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length) ) {

				// excess is a negative index
				match[0] = match[0].slice( 0, excess );
				match[2] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() { return true; } :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				(pattern = new RegExp( "(^|" + whitespace + ")" + className + "(" + whitespace + "|$)" )) &&
				classCache( className, function( elem ) {
					return pattern.test( typeof elem.className === "string" && elem.className || typeof elem.getAttribute !== "undefined" && elem.getAttribute("class") || "" );
				});
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result.replace( rwhitespace, " " ) + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
			};
		},

		"CHILD": function( type, what, argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, context, xml ) {
					var cache, uniqueCache, outerCache, node, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType,
						diff = false;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( (node = node[ dir ]) ) {
									if ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) {

										return false;
									}
								}
								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {

							// Seek `elem` from a previously-cached index

							// ...in a gzip-friendly way
							node = parent;
							outerCache = node[ expando ] || (node[ expando ] = {});

							// Support: IE <9 only
							// Defend against cloned attroperties (jQuery gh-1709)
							uniqueCache = outerCache[ node.uniqueID ] ||
								(outerCache[ node.uniqueID ] = {});

							cache = uniqueCache[ type ] || [];
							nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
							diff = nodeIndex && cache[ 2 ];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( (node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								(diff = nodeIndex = 0) || start.pop()) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									uniqueCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						} else {
							// Use previously-cached element index if available
							if ( useCache ) {
								// ...in a gzip-friendly way
								node = elem;
								outerCache = node[ expando ] || (node[ expando ] = {});

								// Support: IE <9 only
								// Defend against cloned attroperties (jQuery gh-1709)
								uniqueCache = outerCache[ node.uniqueID ] ||
									(outerCache[ node.uniqueID ] = {});

								cache = uniqueCache[ type ] || [];
								nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
								diff = nodeIndex;
							}

							// xml :nth-child(...)
							// or :nth-last-child(...) or :nth(-last)?-of-type(...)
							if ( diff === false ) {
								// Use the same loop as above to seek `elem` from the start
								while ( (node = ++nodeIndex && node && node[ dir ] ||
									(diff = nodeIndex = 0) || start.pop()) ) {

									if ( ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) &&
										++diff ) {

										// Cache the index of each encountered element
										if ( useCache ) {
											outerCache = node[ expando ] || (node[ expando ] = {});

											// Support: IE <9 only
											// Defend against cloned attroperties (jQuery gh-1709)
											uniqueCache = outerCache[ node.uniqueID ] ||
												(outerCache[ node.uniqueID ] = {});

											uniqueCache[ type ] = [ dirruns, diff ];
										}

										if ( node === elem ) {
											break;
										}
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {
			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction(function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf( seed, matched[i] );
							seed[ idx ] = !( matches[ idx ] = matched[i] );
						}
					}) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {
		// Potentially complex pseudos
		"not": markFunction(function( selector ) {
			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction(function( seed, matches, context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( (elem = unmatched[i]) ) {
							seed[i] = !(matches[i] = elem);
						}
					}
				}) :
				function( elem, context, xml ) {
					input[0] = elem;
					matcher( input, null, xml, results );
					// Don't keep the element (issue #299)
					input[0] = null;
					return !results.pop();
				};
		}),

		"has": markFunction(function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		}),

		"contains": markFunction(function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || elem.innerText || getText( elem ) ).indexOf( text ) > -1;
			};
		}),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {
			// lang value must be a valid identifier
			if ( !ridentifier.test(lang || "") ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( (elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute("xml:lang") || elem.getAttribute("lang")) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( (elem = elem.parentNode) && elem.nodeType === 1 );
				return false;
			};
		}),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement && (!document.hasFocus || document.hasFocus()) && !!(elem.type || elem.href || ~elem.tabIndex);
		},

		// Boolean properties
		"enabled": function( elem ) {
			return elem.disabled === false;
		},

		"disabled": function( elem ) {
			return elem.disabled === true;
		},

		"checked": function( elem ) {
			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return (nodeName === "input" && !!elem.checked) || (nodeName === "option" && !!elem.selected);
		},

		"selected": function( elem ) {
			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				elem.parentNode.selectedIndex;
			}

			return elem.selected === true;
		},

		// Contents
		"empty": function( elem ) {
			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
			//   but not by others (comment: 8; processing instruction: 7; etc.)
			// nodeType < 6 works because attributes (2) do not appear as children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeType < 6 ) {
					return false;
				}
			}
			return true;
		},

		"parent": function( elem ) {
			return !Expr.pseudos["empty"]( elem );
		},

		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},

		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},

		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},

		"text": function( elem ) {
			var attr;
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&

				// Support: IE<8
				// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
				( (attr = elem.getAttribute("type")) == null || attr.toLowerCase() === "text" );
		},

		// Position-in-collection
		"first": createPositionalPseudo(function() {
			return [ 0 ];
		}),

		"last": createPositionalPseudo(function( matchIndexes, length ) {
			return [ length - 1 ];
		}),

		"eq": createPositionalPseudo(function( matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		}),

		"even": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"odd": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"lt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"gt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		})
	}
};

Expr.pseudos["nth"] = Expr.pseudos["eq"];

// Add button/input type pseudos
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}

// Easy API for creating new setFilters
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();

tokenize = Sizzle.tokenize = function( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];

	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}

	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;

	while ( soFar ) {

		// Comma and first run
		if ( !matched || (match = rcomma.exec( soFar )) ) {
			if ( match ) {
				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[0].length ) || soFar;
			}
			groups.push( (tokens = []) );
		}

		matched = false;

		// Combinators
		if ( (match = rcombinators.exec( soFar )) ) {
			matched = match.shift();
			tokens.push({
				value: matched,
				// Cast descendant combinators to space
				type: match[0].replace( rtrim, " " )
			});
			soFar = soFar.slice( matched.length );
		}

		// Filters
		for ( type in Expr.filter ) {
			if ( (match = matchExpr[ type ].exec( soFar )) && (!preFilters[ type ] ||
				(match = preFilters[ type ]( match ))) ) {
				matched = match.shift();
				tokens.push({
					value: matched,
					type: type,
					matches: match
				});
				soFar = soFar.slice( matched.length );
			}
		}

		if ( !matched ) {
			break;
		}
	}

	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :
			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
};

function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[i].value;
	}
	return selector;
}

function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		checkNonElements = base && dir === "parentNode",
		doneName = done++;

	return combinator.first ?
		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( (elem = elem[ dir ]) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
		} :

		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var oldCache, uniqueCache, outerCache,
				newCache = [ dirruns, doneName ];

			// We can't set arbitrary data on XML nodes, so they don't benefit from combinator caching
			if ( xml ) {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || (elem[ expando ] = {});

						// Support: IE <9 only
						// Defend against cloned attroperties (jQuery gh-1709)
						uniqueCache = outerCache[ elem.uniqueID ] || (outerCache[ elem.uniqueID ] = {});

						if ( (oldCache = uniqueCache[ dir ]) &&
							oldCache[ 0 ] === dirruns && oldCache[ 1 ] === doneName ) {

							// Assign to newCache so results back-propagate to previous elements
							return (newCache[ 2 ] = oldCache[ 2 ]);
						} else {
							// Reuse newcache so results back-propagate to previous elements
							uniqueCache[ dir ] = newCache;

							// A match means we're done; a fail means we have to keep checking
							if ( (newCache[ 2 ] = matcher( elem, context, xml )) ) {
								return true;
							}
						}
					}
				}
			}
		};
}

function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[i]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[0];
}

function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[i], results );
	}
	return results;
}

function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;

	for ( ; i < len; i++ ) {
		if ( (elem = unmatched[i]) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}

	return newUnmatched;
}

function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction(function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,

			// Get initial elements from seed or context
			elems = seed || multipleContexts( selector || "*", context.nodeType ? [ context ] : context, [] ),

			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,

			matcherOut = matcher ?
				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?

					// ...intermediate processing is necessary
					[] :

					// ...otherwise use results directly
					results :
				matcherIn;

		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}

		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );

			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( (elem = temp[i]) ) {
					matcherOut[ postMap[i] ] = !(matcherIn[ postMap[i] ] = elem);
				}
			}
		}

		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {
					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( (elem = matcherOut[i]) ) {
							// Restore matcherIn since elem is not yet a final match
							temp.push( (matcherIn[i] = elem) );
						}
					}
					postFinder( null, (matcherOut = []), temp, xml );
				}

				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( (elem = matcherOut[i]) &&
						(temp = postFinder ? indexOf( seed, elem ) : preMap[i]) > -1 ) {

						seed[temp] = !(results[temp] = elem);
					}
				}
			}

		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	});
}

function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[0].type ],
		implicitRelative = leadingRelative || Expr.relative[" "],
		i = leadingRelative ? 1 : 0,

		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			var ret = ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				(checkContext = context).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );
			// Avoid hanging onto element (issue #299)
			checkContext = null;
			return ret;
		} ];

	for ( ; i < len; i++ ) {
		if ( (matcher = Expr.relative[ tokens[i].type ]) ) {
			matchers = [ addCombinator(elementMatcher( matchers ), matcher) ];
		} else {
			matcher = Expr.filter[ tokens[i].type ].apply( null, tokens[i].matches );

			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {
				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[j].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(
						// If the preceding token was a descendant combinator, insert an implicit any-element `*`
						tokens.slice( 0, i - 1 ).concat({ value: tokens[ i - 2 ].type === " " ? "*" : "" })
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( (tokens = tokens.slice( j )) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}

	return elementMatcher( matchers );
}

function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	var bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, outermost ) {
			var elem, j, matcher,
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				setMatched = [],
				contextBackup = outermostContext,
				// We must always have either seed elements or outermost context
				elems = seed || byElement && Expr.find["TAG"]( "*", outermost ),
				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = (dirruns += contextBackup == null ? 1 : Math.random() || 0.1),
				len = elems.length;

			if ( outermost ) {
				outermostContext = context === document || context || outermost;
			}

			// Add elements passing elementMatchers directly to results
			// Support: IE<9, Safari
			// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
			for ( ; i !== len && (elem = elems[i]) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;
					if ( !context && elem.ownerDocument !== document ) {
						setDocument( elem );
						xml = !documentIsHTML;
					}
					while ( (matcher = elementMatchers[j++]) ) {
						if ( matcher( elem, context || document, xml) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
					}
				}

				// Track unmatched elements for set filters
				if ( bySet ) {
					// They will have gone through all possible matchers
					if ( (elem = !matcher && elem) ) {
						matchedCount--;
					}

					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}

			// `i` is now the count of elements visited above, and adding it to `matchedCount`
			// makes the latter nonnegative.
			matchedCount += i;

			// Apply set filters to unmatched elements
			// NOTE: This can be skipped if there are no unmatched elements (i.e., `matchedCount`
			// equals `i`), unless we didn't visit _any_ elements in the above loop because we have
			// no element matchers and no seed.
			// Incrementing an initially-string "0" `i` allows `i` to remain a string only in that
			// case, which will result in a "00" `matchedCount` that differs from `i` but is also
			// numerically zero.
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( (matcher = setMatchers[j++]) ) {
					matcher( unmatched, setMatched, context, xml );
				}

				if ( seed ) {
					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !(unmatched[i] || setMatched[i]) ) {
								setMatched[i] = pop.call( results );
							}
						}
					}

					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}

				// Add matches to results
				push.apply( results, setMatched );

				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {

					Sizzle.uniqueSort( results );
				}
			}

			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}

			return unmatched;
		};

	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}

compile = Sizzle.compile = function( selector, match /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];

	if ( !cached ) {
		// Generate a function of recursive functions that can be used to check each element
		if ( !match ) {
			match = tokenize( selector );
		}
		i = match.length;
		while ( i-- ) {
			cached = matcherFromTokens( match[i] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}

		// Cache the compiled function
		cached = compilerCache( selector, matcherFromGroupMatchers( elementMatchers, setMatchers ) );

		// Save selector and tokenization
		cached.selector = selector;
	}
	return cached;
};

/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
select = Sizzle.select = function( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		compiled = typeof selector === "function" && selector,
		match = !seed && tokenize( (selector = compiled.selector || selector) );

	results = results || [];

	// Try to minimize operations if there is only one selector in the list and no seed
	// (the latter of which guarantees us context)
	if ( match.length === 1 ) {

		// Reduce context if the leading compound selector is an ID
		tokens = match[0] = match[0].slice( 0 );
		if ( tokens.length > 2 && (token = tokens[0]).type === "ID" &&
				support.getById && context.nodeType === 9 && documentIsHTML &&
				Expr.relative[ tokens[1].type ] ) {

			context = ( Expr.find["ID"]( token.matches[0].replace(runescape, funescape), context ) || [] )[0];
			if ( !context ) {
				return results;

			// Precompiled matchers will still verify ancestry, so step up a level
			} else if ( compiled ) {
				context = context.parentNode;
			}

			selector = selector.slice( tokens.shift().value.length );
		}

		// Fetch a seed set for right-to-left matching
		i = matchExpr["needsContext"].test( selector ) ? 0 : tokens.length;
		while ( i-- ) {
			token = tokens[i];

			// Abort if we hit a combinator
			if ( Expr.relative[ (type = token.type) ] ) {
				break;
			}
			if ( (find = Expr.find[ type ]) ) {
				// Search, expanding context for leading sibling combinators
				if ( (seed = find(
					token.matches[0].replace( runescape, funescape ),
					rsibling.test( tokens[0].type ) && testContext( context.parentNode ) || context
				)) ) {

					// If seed is empty or no tokens remain, we can return early
					tokens.splice( i, 1 );
					selector = seed.length && toSelector( tokens );
					if ( !selector ) {
						push.apply( results, seed );
						return results;
					}

					break;
				}
			}
		}
	}

	// Compile and execute a filtering function if one is not provided
	// Provide `match` to avoid retokenization if we modified the selector above
	( compiled || compile( selector, match ) )(
		seed,
		context,
		!documentIsHTML,
		results,
		!context || rsibling.test( selector ) && testContext( context.parentNode ) || context
	);
	return results;
};

// One-time assignments

// Sort stability
support.sortStable = expando.split("").sort( sortOrder ).join("") === expando;

// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
support.detectDuplicates = !!hasDuplicate;

// Initialize against the default document
setDocument();

// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
support.sortDetached = assert(function( div1 ) {
	// Should return 1, but returns 4 (following)
	return div1.compareDocumentPosition( document.createElement("div") ) & 1;
});

// Support: IE<8
// Prevent attribute/property "interpolation"
// http://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !assert(function( div ) {
	div.innerHTML = "<a href='#'></a>";
	return div.firstChild.getAttribute("href") === "#" ;
}) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	});
}

// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if ( !support.attributes || !assert(function( div ) {
	div.innerHTML = "<input/>";
	div.firstChild.setAttribute( "value", "" );
	return div.firstChild.getAttribute( "value" ) === "";
}) ) {
	addHandle( "value", function( elem, name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	});
}

// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if ( !assert(function( div ) {
	return div.getAttribute("disabled") == null;
}) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return elem[ name ] === true ? name.toLowerCase() :
					(val = elem.getAttributeNode( name )) && val.specified ?
					val.value :
				null;
		}
	});
}

return Sizzle;

})( window );



jQuery.find = Sizzle;
jQuery.expr = Sizzle.selectors;
jQuery.expr[ ":" ] = jQuery.expr.pseudos;
jQuery.uniqueSort = jQuery.unique = Sizzle.uniqueSort;
jQuery.text = Sizzle.getText;
jQuery.isXMLDoc = Sizzle.isXML;
jQuery.contains = Sizzle.contains;



var dir = function( elem, dir, until ) {
	var matched = [],
		truncate = until !== undefined;

	while ( ( elem = elem[ dir ] ) && elem.nodeType !== 9 ) {
		if ( elem.nodeType === 1 ) {
			if ( truncate && jQuery( elem ).is( until ) ) {
				break;
			}
			matched.push( elem );
		}
	}
	return matched;
};


var siblings = function( n, elem ) {
	var matched = [];

	for ( ; n; n = n.nextSibling ) {
		if ( n.nodeType === 1 && n !== elem ) {
			matched.push( n );
		}
	}

	return matched;
};


var rneedsContext = jQuery.expr.match.needsContext;

var rsingleTag = ( /^<([\w-]+)\s*\/?>(?:<\/\1>|)$/ );



var risSimple = /^.[^:#\[\.,]*$/;

// Implement the identical functionality for filter and not
function winnow( elements, qualifier, not ) {
	if ( jQuery.isFunction( qualifier ) ) {
		return jQuery.grep( elements, function( elem, i ) {
			/* jshint -W018 */
			return !!qualifier.call( elem, i, elem ) !== not;
		} );

	}

	if ( qualifier.nodeType ) {
		return jQuery.grep( elements, function( elem ) {
			return ( elem === qualifier ) !== not;
		} );

	}

	if ( typeof qualifier === "string" ) {
		if ( risSimple.test( qualifier ) ) {
			return jQuery.filter( qualifier, elements, not );
		}

		qualifier = jQuery.filter( qualifier, elements );
	}

	return jQuery.grep( elements, function( elem ) {
		return ( indexOf.call( qualifier, elem ) > -1 ) !== not;
	} );
}

jQuery.filter = function( expr, elems, not ) {
	var elem = elems[ 0 ];

	if ( not ) {
		expr = ":not(" + expr + ")";
	}

	return elems.length === 1 && elem.nodeType === 1 ?
		jQuery.find.matchesSelector( elem, expr ) ? [ elem ] : [] :
		jQuery.find.matches( expr, jQuery.grep( elems, function( elem ) {
			return elem.nodeType === 1;
		} ) );
};

jQuery.fn.extend( {
	find: function( selector ) {
		var i,
			len = this.length,
			ret = [],
			self = this;

		if ( typeof selector !== "string" ) {
			return this.pushStack( jQuery( selector ).filter( function() {
				for ( i = 0; i < len; i++ ) {
					if ( jQuery.contains( self[ i ], this ) ) {
						return true;
					}
				}
			} ) );
		}

		for ( i = 0; i < len; i++ ) {
			jQuery.find( selector, self[ i ], ret );
		}

		// Needed because $( selector, context ) becomes $( context ).find( selector )
		ret = this.pushStack( len > 1 ? jQuery.unique( ret ) : ret );
		ret.selector = this.selector ? this.selector + " " + selector : selector;
		return ret;
	},
	filter: function( selector ) {
		return this.pushStack( winnow( this, selector || [], false ) );
	},
	not: function( selector ) {
		return this.pushStack( winnow( this, selector || [], true ) );
	},
	is: function( selector ) {
		return !!winnow(
			this,

			// If this is a positional/relative selector, check membership in the returned set
			// so $("p:first").is("p:last") won't return true for a doc with two "p".
			typeof selector === "string" && rneedsContext.test( selector ) ?
				jQuery( selector ) :
				selector || [],
			false
		).length;
	}
} );


// Initialize a jQuery object


// A central reference to the root jQuery(document)
var rootjQuery,

	// A simple way to check for HTML strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	// Strict HTML recognition (#11290: must start with <)
	rquickExpr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,

	init = jQuery.fn.init = function( selector, context, root ) {
		var match, elem;

		// HANDLE: $(""), $(null), $(undefined), $(false)
		if ( !selector ) {
			return this;
		}

		// Method init() accepts an alternate rootjQuery
		// so migrate can support jQuery.sub (gh-2101)
		root = root || rootjQuery;

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			if ( selector[ 0 ] === "<" &&
				selector[ selector.length - 1 ] === ">" &&
				selector.length >= 3 ) {

				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = rquickExpr.exec( selector );
			}

			// Match html or make sure no context is specified for #id
			if ( match && ( match[ 1 ] || !context ) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[ 1 ] ) {
					context = context instanceof jQuery ? context[ 0 ] : context;

					// Option to run scripts is true for back-compat
					// Intentionally let the error be thrown if parseHTML is not present
					jQuery.merge( this, jQuery.parseHTML(
						match[ 1 ],
						context && context.nodeType ? context.ownerDocument || context : document,
						true
					) );

					// HANDLE: $(html, props)
					if ( rsingleTag.test( match[ 1 ] ) && jQuery.isPlainObject( context ) ) {
						for ( match in context ) {

							// Properties of context are called as methods if possible
							if ( jQuery.isFunction( this[ match ] ) ) {
								this[ match ]( context[ match ] );

							// ...and otherwise set as attributes
							} else {
								this.attr( match, context[ match ] );
							}
						}
					}

					return this;

				// HANDLE: $(#id)
				} else {
					elem = document.getElementById( match[ 2 ] );

					// Support: Blackberry 4.6
					// gEBID returns nodes no longer in the document (#6963)
					if ( elem && elem.parentNode ) {

						// Inject the element directly into the jQuery object
						this.length = 1;
						this[ 0 ] = elem;
					}

					this.context = document;
					this.selector = selector;
					return this;
				}

			// HANDLE: $(expr, $(...))
			} else if ( !context || context.jquery ) {
				return ( context || root ).find( selector );

			// HANDLE: $(expr, context)
			// (which is just equivalent to: $(context).find(expr)
			} else {
				return this.constructor( context ).find( selector );
			}

		// HANDLE: $(DOMElement)
		} else if ( selector.nodeType ) {
			this.context = this[ 0 ] = selector;
			this.length = 1;
			return this;

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( jQuery.isFunction( selector ) ) {
			return root.ready !== undefined ?
				root.ready( selector ) :

				// Execute immediately if ready is not present
				selector( jQuery );
		}

		if ( selector.selector !== undefined ) {
			this.selector = selector.selector;
			this.context = selector.context;
		}

		return jQuery.makeArray( selector, this );
	};

// Give the init function the jQuery prototype for later instantiation
init.prototype = jQuery.fn;

// Initialize central reference
rootjQuery = jQuery( document );


var rparentsprev = /^(?:parents|prev(?:Until|All))/,

	// Methods guaranteed to produce a unique set when starting from a unique set
	guaranteedUnique = {
		children: true,
		contents: true,
		next: true,
		prev: true
	};

jQuery.fn.extend( {
	has: function( target ) {
		var targets = jQuery( target, this ),
			l = targets.length;

		return this.filter( function() {
			var i = 0;
			for ( ; i < l; i++ ) {
				if ( jQuery.contains( this, targets[ i ] ) ) {
					return true;
				}
			}
		} );
	},

	closest: function( selectors, context ) {
		var cur,
			i = 0,
			l = this.length,
			matched = [],
			pos = rneedsContext.test( selectors ) || typeof selectors !== "string" ?
				jQuery( selectors, context || this.context ) :
				0;

		for ( ; i < l; i++ ) {
			for ( cur = this[ i ]; cur && cur !== context; cur = cur.parentNode ) {

				// Always skip document fragments
				if ( cur.nodeType < 11 && ( pos ?
					pos.index( cur ) > -1 :

					// Don't pass non-elements to Sizzle
					cur.nodeType === 1 &&
						jQuery.find.matchesSelector( cur, selectors ) ) ) {

					matched.push( cur );
					break;
				}
			}
		}

		return this.pushStack( matched.length > 1 ? jQuery.uniqueSort( matched ) : matched );
	},

	// Determine the position of an element within the set
	index: function( elem ) {

		// No argument, return index in parent
		if ( !elem ) {
			return ( this[ 0 ] && this[ 0 ].parentNode ) ? this.first().prevAll().length : -1;
		}

		// Index in selector
		if ( typeof elem === "string" ) {
			return indexOf.call( jQuery( elem ), this[ 0 ] );
		}

		// Locate the position of the desired element
		return indexOf.call( this,

			// If it receives a jQuery object, the first element is used
			elem.jquery ? elem[ 0 ] : elem
		);
	},

	add: function( selector, context ) {
		return this.pushStack(
			jQuery.uniqueSort(
				jQuery.merge( this.get(), jQuery( selector, context ) )
			)
		);
	},

	addBack: function( selector ) {
		return this.add( selector == null ?
			this.prevObject : this.prevObject.filter( selector )
		);
	}
} );

function sibling( cur, dir ) {
	while ( ( cur = cur[ dir ] ) && cur.nodeType !== 1 ) {}
	return cur;
}

jQuery.each( {
	parent: function( elem ) {
		var parent = elem.parentNode;
		return parent && parent.nodeType !== 11 ? parent : null;
	},
	parents: function( elem ) {
		return dir( elem, "parentNode" );
	},
	parentsUntil: function( elem, i, until ) {
		return dir( elem, "parentNode", until );
	},
	next: function( elem ) {
		return sibling( elem, "nextSibling" );
	},
	prev: function( elem ) {
		return sibling( elem, "previousSibling" );
	},
	nextAll: function( elem ) {
		return dir( elem, "nextSibling" );
	},
	prevAll: function( elem ) {
		return dir( elem, "previousSibling" );
	},
	nextUntil: function( elem, i, until ) {
		return dir( elem, "nextSibling", until );
	},
	prevUntil: function( elem, i, until ) {
		return dir( elem, "previousSibling", until );
	},
	siblings: function( elem ) {
		return siblings( ( elem.parentNode || {} ).firstChild, elem );
	},
	children: function( elem ) {
		return siblings( elem.firstChild );
	},
	contents: function( elem ) {
		return elem.contentDocument || jQuery.merge( [], elem.childNodes );
	}
}, function( name, fn ) {
	jQuery.fn[ name ] = function( until, selector ) {
		var matched = jQuery.map( this, fn, until );

		if ( name.slice( -5 ) !== "Until" ) {
			selector = until;
		}

		if ( selector && typeof selector === "string" ) {
			matched = jQuery.filter( selector, matched );
		}

		if ( this.length > 1 ) {

			// Remove duplicates
			if ( !guaranteedUnique[ name ] ) {
				jQuery.uniqueSort( matched );
			}

			// Reverse order for parents* and prev-derivatives
			if ( rparentsprev.test( name ) ) {
				matched.reverse();
			}
		}

		return this.pushStack( matched );
	};
} );
var rnotwhite = ( /\S+/g );



// Convert String-formatted options into Object-formatted ones
function createOptions( options ) {
	var object = {};
	jQuery.each( options.match( rnotwhite ) || [], function( _, flag ) {
		object[ flag ] = true;
	} );
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

	// Convert options from String-formatted to Object-formatted if needed
	// (we check in cache first)
	options = typeof options === "string" ?
		createOptions( options ) :
		jQuery.extend( {}, options );

	var // Flag to know if list is currently firing
		firing,

		// Last fire value for non-forgettable lists
		memory,

		// Flag to know if list was already fired
		fired,

		// Flag to prevent firing
		locked,

		// Actual callback list
		list = [],

		// Queue of execution data for repeatable lists
		queue = [],

		// Index of currently firing callback (modified by add/remove as needed)
		firingIndex = -1,

		// Fire callbacks
		fire = function() {

			// Enforce single-firing
			locked = options.once;

			// Execute callbacks for all pending executions,
			// respecting firingIndex overrides and runtime changes
			fired = firing = true;
			for ( ; queue.length; firingIndex = -1 ) {
				memory = queue.shift();
				while ( ++firingIndex < list.length ) {

					// Run callback and check for early termination
					if ( list[ firingIndex ].apply( memory[ 0 ], memory[ 1 ] ) === false &&
						options.stopOnFalse ) {

						// Jump to end and forget the data so .add doesn't re-fire
						firingIndex = list.length;
						memory = false;
					}
				}
			}

			// Forget the data if we're done with it
			if ( !options.memory ) {
				memory = false;
			}

			firing = false;

			// Clean up if we're done firing for good
			if ( locked ) {

				// Keep an empty list if we have data for future add calls
				if ( memory ) {
					list = [];

				// Otherwise, this object is spent
				} else {
					list = "";
				}
			}
		},

		// Actual Callbacks object
		self = {

			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {

					// If we have memory from a past run, we should fire after adding
					if ( memory && !firing ) {
						firingIndex = list.length - 1;
						queue.push( memory );
					}

					( function add( args ) {
						jQuery.each( args, function( _, arg ) {
							if ( jQuery.isFunction( arg ) ) {
								if ( !options.unique || !self.has( arg ) ) {
									list.push( arg );
								}
							} else if ( arg && arg.length && jQuery.type( arg ) !== "string" ) {

								// Inspect recursively
								add( arg );
							}
						} );
					} )( arguments );

					if ( memory && !firing ) {
						fire();
					}
				}
				return this;
			},

			// Remove a callback from the list
			remove: function() {
				jQuery.each( arguments, function( _, arg ) {
					var index;
					while ( ( index = jQuery.inArray( arg, list, index ) ) > -1 ) {
						list.splice( index, 1 );

						// Handle firing indexes
						if ( index <= firingIndex ) {
							firingIndex--;
						}
					}
				} );
				return this;
			},

			// Check if a given callback is in the list.
			// If no argument is given, return whether or not list has callbacks attached.
			has: function( fn ) {
				return fn ?
					jQuery.inArray( fn, list ) > -1 :
					list.length > 0;
			},

			// Remove all callbacks from the list
			empty: function() {
				if ( list ) {
					list = [];
				}
				return this;
			},

			// Disable .fire and .add
			// Abort any current/pending executions
			// Clear all callbacks and values
			disable: function() {
				locked = queue = [];
				list = memory = "";
				return this;
			},
			disabled: function() {
				return !list;
			},

			// Disable .fire
			// Also disable .add unless we have memory (since it would have no effect)
			// Abort any pending executions
			lock: function() {
				locked = queue = [];
				if ( !memory ) {
					list = memory = "";
				}
				return this;
			},
			locked: function() {
				return !!locked;
			},

			// Call all callbacks with the given context and arguments
			fireWith: function( context, args ) {
				if ( !locked ) {
					args = args || [];
					args = [ context, args.slice ? args.slice() : args ];
					queue.push( args );
					if ( !firing ) {
						fire();
					}
				}
				return this;
			},

			// Call all the callbacks with the given arguments
			fire: function() {
				self.fireWith( this, arguments );
				return this;
			},

			// To know if the callbacks have already been called at least once
			fired: function() {
				return !!fired;
			}
		};

	return self;
};


jQuery.extend( {

	Deferred: function( func ) {
		var tuples = [

				// action, add listener, listener list, final state
				[ "resolve", "done", jQuery.Callbacks( "once memory" ), "resolved" ],
				[ "reject", "fail", jQuery.Callbacks( "once memory" ), "rejected" ],
				[ "notify", "progress", jQuery.Callbacks( "memory" ) ]
			],
			state = "pending",
			promise = {
				state: function() {
					return state;
				},
				always: function() {
					deferred.done( arguments ).fail( arguments );
					return this;
				},
				then: function( /* fnDone, fnFail, fnProgress */ ) {
					var fns = arguments;
					return jQuery.Deferred( function( newDefer ) {
						jQuery.each( tuples, function( i, tuple ) {
							var fn = jQuery.isFunction( fns[ i ] ) && fns[ i ];

							// deferred[ done | fail | progress ] for forwarding actions to newDefer
							deferred[ tuple[ 1 ] ]( function() {
								var returned = fn && fn.apply( this, arguments );
								if ( returned && jQuery.isFunction( returned.promise ) ) {
									returned.promise()
										.progress( newDefer.notify )
										.done( newDefer.resolve )
										.fail( newDefer.reject );
								} else {
									newDefer[ tuple[ 0 ] + "With" ](
										this === promise ? newDefer.promise() : this,
										fn ? [ returned ] : arguments
									);
								}
							} );
						} );
						fns = null;
					} ).promise();
				},

				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					return obj != null ? jQuery.extend( obj, promise ) : promise;
				}
			},
			deferred = {};

		// Keep pipe for back-compat
		promise.pipe = promise.then;

		// Add list-specific methods
		jQuery.each( tuples, function( i, tuple ) {
			var list = tuple[ 2 ],
				stateString = tuple[ 3 ];

			// promise[ done | fail | progress ] = list.add
			promise[ tuple[ 1 ] ] = list.add;

			// Handle state
			if ( stateString ) {
				list.add( function() {

					// state = [ resolved | rejected ]
					state = stateString;

				// [ reject_list | resolve_list ].disable; progress_list.lock
				}, tuples[ i ^ 1 ][ 2 ].disable, tuples[ 2 ][ 2 ].lock );
			}

			// deferred[ resolve | reject | notify ]
			deferred[ tuple[ 0 ] ] = function() {
				deferred[ tuple[ 0 ] + "With" ]( this === deferred ? promise : this, arguments );
				return this;
			};
			deferred[ tuple[ 0 ] + "With" ] = list.fireWith;
		} );

		// Make the deferred a promise
		promise.promise( deferred );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( subordinate /* , ..., subordinateN */ ) {
		var i = 0,
			resolveValues = slice.call( arguments ),
			length = resolveValues.length,

			// the count of uncompleted subordinates
			remaining = length !== 1 ||
				( subordinate && jQuery.isFunction( subordinate.promise ) ) ? length : 0,

			// the master Deferred.
			// If resolveValues consist of only a single Deferred, just use that.
			deferred = remaining === 1 ? subordinate : jQuery.Deferred(),

			// Update function for both resolve and progress values
			updateFunc = function( i, contexts, values ) {
				return function( value ) {
					contexts[ i ] = this;
					values[ i ] = arguments.length > 1 ? slice.call( arguments ) : value;
					if ( values === progressValues ) {
						deferred.notifyWith( contexts, values );
					} else if ( !( --remaining ) ) {
						deferred.resolveWith( contexts, values );
					}
				};
			},

			progressValues, progressContexts, resolveContexts;

		// Add listeners to Deferred subordinates; treat others as resolved
		if ( length > 1 ) {
			progressValues = new Array( length );
			progressContexts = new Array( length );
			resolveContexts = new Array( length );
			for ( ; i < length; i++ ) {
				if ( resolveValues[ i ] && jQuery.isFunction( resolveValues[ i ].promise ) ) {
					resolveValues[ i ].promise()
						.progress( updateFunc( i, progressContexts, progressValues ) )
						.done( updateFunc( i, resolveContexts, resolveValues ) )
						.fail( deferred.reject );
				} else {
					--remaining;
				}
			}
		}

		// If we're not waiting on anything, resolve the master
		if ( !remaining ) {
			deferred.resolveWith( resolveContexts, resolveValues );
		}

		return deferred.promise();
	}
} );


// The deferred used on DOM ready
var readyList;

jQuery.fn.ready = function( fn ) {

	// Add the callback
	jQuery.ready.promise().done( fn );

	return this;
};

jQuery.extend( {

	// Is the DOM ready to be used? Set to true once it occurs.
	isReady: false,

	// A counter to track how many items to wait for before
	// the ready event fires. See #6781
	readyWait: 1,

	// Hold (or release) the ready event
	holdReady: function( hold ) {
		if ( hold ) {
			jQuery.readyWait++;
		} else {
			jQuery.ready( true );
		}
	},

	// Handle when the DOM is ready
	ready: function( wait ) {

		// Abort if there are pending holds or we're already ready
		if ( wait === true ? --jQuery.readyWait : jQuery.isReady ) {
			return;
		}

		// Remember that the DOM is ready
		jQuery.isReady = true;

		// If a normal DOM Ready event fired, decrement, and wait if need be
		if ( wait !== true && --jQuery.readyWait > 0 ) {
			return;
		}

		// If there are functions bound, to execute
		readyList.resolveWith( document, [ jQuery ] );

		// Trigger any bound ready events
		if ( jQuery.fn.triggerHandler ) {
			jQuery( document ).triggerHandler( "ready" );
			jQuery( document ).off( "ready" );
		}
	}
} );

/**
 * The ready event handler and self cleanup method
 */
function completed() {
	document.removeEventListener( "DOMContentLoaded", completed );
	window.removeEventListener( "load", completed );
	jQuery.ready();
}

jQuery.ready.promise = function( obj ) {
	if ( !readyList ) {

		readyList = jQuery.Deferred();

		// Catch cases where $(document).ready() is called
		// after the browser event has already occurred.
		// Support: IE9-10 only
		// Older IE sometimes signals "interactive" too soon
		if ( document.readyState === "complete" ||
			( document.readyState !== "loading" && !document.documentElement.doScroll ) ) {

			// Handle it asynchronously to allow scripts the opportunity to delay ready
			window.setTimeout( jQuery.ready );

		} else {

			// Use the handy event callback
			document.addEventListener( "DOMContentLoaded", completed );

			// A fallback to window.onload, that will always work
			window.addEventListener( "load", completed );
		}
	}
	return readyList.promise( obj );
};

// Kick off the DOM ready check even if the user does not
jQuery.ready.promise();




// Multifunctional method to get and set values of a collection
// The value/s can optionally be executed if it's a function
var access = function( elems, fn, key, value, chainable, emptyGet, raw ) {
	var i = 0,
		len = elems.length,
		bulk = key == null;

	// Sets many values
	if ( jQuery.type( key ) === "object" ) {
		chainable = true;
		for ( i in key ) {
			access( elems, fn, i, key[ i ], true, emptyGet, raw );
		}

	// Sets one value
	} else if ( value !== undefined ) {
		chainable = true;

		if ( !jQuery.isFunction( value ) ) {
			raw = true;
		}

		if ( bulk ) {

			// Bulk operations run against the entire set
			if ( raw ) {
				fn.call( elems, value );
				fn = null;

			// ...except when executing function values
			} else {
				bulk = fn;
				fn = function( elem, key, value ) {
					return bulk.call( jQuery( elem ), value );
				};
			}
		}

		if ( fn ) {
			for ( ; i < len; i++ ) {
				fn(
					elems[ i ], key, raw ?
					value :
					value.call( elems[ i ], i, fn( elems[ i ], key ) )
				);
			}
		}
	}

	return chainable ?
		elems :

		// Gets
		bulk ?
			fn.call( elems ) :
			len ? fn( elems[ 0 ], key ) : emptyGet;
};
var acceptData = function( owner ) {

	// Accepts only:
	//  - Node
	//    - Node.ELEMENT_NODE
	//    - Node.DOCUMENT_NODE
	//  - Object
	//    - Any
	/* jshint -W018 */
	return owner.nodeType === 1 || owner.nodeType === 9 || !( +owner.nodeType );
};




function Data() {
	this.expando = jQuery.expando + Data.uid++;
}

Data.uid = 1;

Data.prototype = {

	register: function( owner, initial ) {
		var value = initial || {};

		// If it is a node unlikely to be stringify-ed or looped over
		// use plain assignment
		if ( owner.nodeType ) {
			owner[ this.expando ] = value;

		// Otherwise secure it in a non-enumerable, non-writable property
		// configurability must be true to allow the property to be
		// deleted with the delete operator
		} else {
			Object.defineProperty( owner, this.expando, {
				value: value,
				writable: true,
				configurable: true
			} );
		}
		return owner[ this.expando ];
	},
	cache: function( owner ) {

		// We can accept data for non-element nodes in modern browsers,
		// but we should not, see #8335.
		// Always return an empty object.
		if ( !acceptData( owner ) ) {
			return {};
		}

		// Check if the owner object already has a cache
		var value = owner[ this.expando ];

		// If not, create one
		if ( !value ) {
			value = {};

			// We can accept data for non-element nodes in modern browsers,
			// but we should not, see #8335.
			// Always return an empty object.
			if ( acceptData( owner ) ) {

				// If it is a node unlikely to be stringify-ed or looped over
				// use plain assignment
				if ( owner.nodeType ) {
					owner[ this.expando ] = value;

				// Otherwise secure it in a non-enumerable property
				// configurable must be true to allow the property to be
				// deleted when data is removed
				} else {
					Object.defineProperty( owner, this.expando, {
						value: value,
						configurable: true
					} );
				}
			}
		}

		return value;
	},
	set: function( owner, data, value ) {
		var prop,
			cache = this.cache( owner );

		// Handle: [ owner, key, value ] args
		if ( typeof data === "string" ) {
			cache[ data ] = value;

		// Handle: [ owner, { properties } ] args
		} else {

			// Copy the properties one-by-one to the cache object
			for ( prop in data ) {
				cache[ prop ] = data[ prop ];
			}
		}
		return cache;
	},
	get: function( owner, key ) {
		return key === undefined ?
			this.cache( owner ) :
			owner[ this.expando ] && owner[ this.expando ][ key ];
	},
	access: function( owner, key, value ) {
		var stored;

		// In cases where either:
		//
		//   1. No key was specified
		//   2. A string key was specified, but no value provided
		//
		// Take the "read" path and allow the get method to determine
		// which value to return, respectively either:
		//
		//   1. The entire cache object
		//   2. The data stored at the key
		//
		if ( key === undefined ||
				( ( key && typeof key === "string" ) && value === undefined ) ) {

			stored = this.get( owner, key );

			return stored !== undefined ?
				stored : this.get( owner, jQuery.camelCase( key ) );
		}

		// When the key is not a string, or both a key and value
		// are specified, set or extend (existing objects) with either:
		//
		//   1. An object of properties
		//   2. A key and value
		//
		this.set( owner, key, value );

		// Since the "set" path can have two possible entry points
		// return the expected data based on which path was taken[*]
		return value !== undefined ? value : key;
	},
	remove: function( owner, key ) {
		var i, name, camel,
			cache = owner[ this.expando ];

		if ( cache === undefined ) {
			return;
		}

		if ( key === undefined ) {
			this.register( owner );

		} else {

			// Support array or space separated string of keys
			if ( jQuery.isArray( key ) ) {

				// If "name" is an array of keys...
				// When data is initially created, via ("key", "val") signature,
				// keys will be converted to camelCase.
				// Since there is no way to tell _how_ a key was added, remove
				// both plain key and camelCase key. #12786
				// This will only penalize the array argument path.
				name = key.concat( key.map( jQuery.camelCase ) );
			} else {
				camel = jQuery.camelCase( key );

				// Try the string as a key before any manipulation
				if ( key in cache ) {
					name = [ key, camel ];
				} else {

					// If a key with the spaces exists, use it.
					// Otherwise, create an array by matching non-whitespace
					name = camel;
					name = name in cache ?
						[ name ] : ( name.match( rnotwhite ) || [] );
				}
			}

			i = name.length;

			while ( i-- ) {
				delete cache[ name[ i ] ];
			}
		}

		// Remove the expando if there's no more data
		if ( key === undefined || jQuery.isEmptyObject( cache ) ) {

			// Support: Chrome <= 35-45+
			// Webkit & Blink performance suffers when deleting properties
			// from DOM nodes, so set to undefined instead
			// https://code.google.com/p/chromium/issues/detail?id=378607
			if ( owner.nodeType ) {
				owner[ this.expando ] = undefined;
			} else {
				delete owner[ this.expando ];
			}
		}
	},
	hasData: function( owner ) {
		var cache = owner[ this.expando ];
		return cache !== undefined && !jQuery.isEmptyObject( cache );
	}
};
var dataPriv = new Data();

var dataUser = new Data();



//	Implementation Summary
//
//	1. Enforce API surface and semantic compatibility with 1.9.x branch
//	2. Improve the module's maintainability by reducing the storage
//		paths to a single mechanism.
//	3. Use the same single mechanism to support "private" and "user" data.
//	4. _Never_ expose "private" data to user code (TODO: Drop _data, _removeData)
//	5. Avoid exposing implementation details on user objects (eg. expando properties)
//	6. Provide a clear path for implementation upgrade to WeakMap in 2014

var rbrace = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
	rmultiDash = /[A-Z]/g;

function dataAttr( elem, key, data ) {
	var name;

	// If nothing was found internally, try to fetch any
	// data from the HTML5 data-* attribute
	if ( data === undefined && elem.nodeType === 1 ) {
		name = "data-" + key.replace( rmultiDash, "-$&" ).toLowerCase();
		data = elem.getAttribute( name );

		if ( typeof data === "string" ) {
			try {
				data = data === "true" ? true :
					data === "false" ? false :
					data === "null" ? null :

					// Only convert to a number if it doesn't change the string
					+data + "" === data ? +data :
					rbrace.test( data ) ? jQuery.parseJSON( data ) :
					data;
			} catch ( e ) {}

			// Make sure we set the data so it isn't changed later
			dataUser.set( elem, key, data );
		} else {
			data = undefined;
		}
	}
	return data;
}

jQuery.extend( {
	hasData: function( elem ) {
		return dataUser.hasData( elem ) || dataPriv.hasData( elem );
	},

	data: function( elem, name, data ) {
		return dataUser.access( elem, name, data );
	},

	removeData: function( elem, name ) {
		dataUser.remove( elem, name );
	},

	// TODO: Now that all calls to _data and _removeData have been replaced
	// with direct calls to dataPriv methods, these can be deprecated.
	_data: function( elem, name, data ) {
		return dataPriv.access( elem, name, data );
	},

	_removeData: function( elem, name ) {
		dataPriv.remove( elem, name );
	}
} );

jQuery.fn.extend( {
	data: function( key, value ) {
		var i, name, data,
			elem = this[ 0 ],
			attrs = elem && elem.attributes;

		// Gets all values
		if ( key === undefined ) {
			if ( this.length ) {
				data = dataUser.get( elem );

				if ( elem.nodeType === 1 && !dataPriv.get( elem, "hasDataAttrs" ) ) {
					i = attrs.length;
					while ( i-- ) {

						// Support: IE11+
						// The attrs elements can be null (#14894)
						if ( attrs[ i ] ) {
							name = attrs[ i ].name;
							if ( name.indexOf( "data-" ) === 0 ) {
								name = jQuery.camelCase( name.slice( 5 ) );
								dataAttr( elem, name, data[ name ] );
							}
						}
					}
					dataPriv.set( elem, "hasDataAttrs", true );
				}
			}

			return data;
		}

		// Sets multiple values
		if ( typeof key === "object" ) {
			return this.each( function() {
				dataUser.set( this, key );
			} );
		}

		return access( this, function( value ) {
			var data, camelKey;

			// The calling jQuery object (element matches) is not empty
			// (and therefore has an element appears at this[ 0 ]) and the
			// `value` parameter was not undefined. An empty jQuery object
			// will result in `undefined` for elem = this[ 0 ] which will
			// throw an exception if an attempt to read a data cache is made.
			if ( elem && value === undefined ) {

				// Attempt to get data from the cache
				// with the key as-is
				data = dataUser.get( elem, key ) ||

					// Try to find dashed key if it exists (gh-2779)
					// This is for 2.2.x only
					dataUser.get( elem, key.replace( rmultiDash, "-$&" ).toLowerCase() );

				if ( data !== undefined ) {
					return data;
				}

				camelKey = jQuery.camelCase( key );

				// Attempt to get data from the cache
				// with the key camelized
				data = dataUser.get( elem, camelKey );
				if ( data !== undefined ) {
					return data;
				}

				// Attempt to "discover" the data in
				// HTML5 custom data-* attrs
				data = dataAttr( elem, camelKey, undefined );
				if ( data !== undefined ) {
					return data;
				}

				// We tried really hard, but the data doesn't exist.
				return;
			}

			// Set the data...
			camelKey = jQuery.camelCase( key );
			this.each( function() {

				// First, attempt to store a copy or reference of any
				// data that might've been store with a camelCased key.
				var data = dataUser.get( this, camelKey );

				// For HTML5 data-* attribute interop, we have to
				// store property names with dashes in a camelCase form.
				// This might not apply to all properties...*
				dataUser.set( this, camelKey, value );

				// *... In the case of properties that might _actually_
				// have dashes, we need to also store a copy of that
				// unchanged property.
				if ( key.indexOf( "-" ) > -1 && data !== undefined ) {
					dataUser.set( this, key, value );
				}
			} );
		}, null, value, arguments.length > 1, null, true );
	},

	removeData: function( key ) {
		return this.each( function() {
			dataUser.remove( this, key );
		} );
	}
} );


jQuery.extend( {
	queue: function( elem, type, data ) {
		var queue;

		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			queue = dataPriv.get( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !queue || jQuery.isArray( data ) ) {
					queue = dataPriv.access( elem, type, jQuery.makeArray( data ) );
				} else {
					queue.push( data );
				}
			}
			return queue || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			startLength = queue.length,
			fn = queue.shift(),
			hooks = jQuery._queueHooks( elem, type ),
			next = function() {
				jQuery.dequeue( elem, type );
			};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
			startLength--;
		}

		if ( fn ) {

			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			// Clear up the last queue stop function
			delete hooks.stop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && hooks ) {
			hooks.empty.fire();
		}
	},

	// Not public - generate a queueHooks object, or return the current one
	_queueHooks: function( elem, type ) {
		var key = type + "queueHooks";
		return dataPriv.get( elem, key ) || dataPriv.access( elem, key, {
			empty: jQuery.Callbacks( "once memory" ).add( function() {
				dataPriv.remove( elem, [ type + "queue", key ] );
			} )
		} );
	}
} );

jQuery.fn.extend( {
	queue: function( type, data ) {
		var setter = 2;

		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
			setter--;
		}

		if ( arguments.length < setter ) {
			return jQuery.queue( this[ 0 ], type );
		}

		return data === undefined ?
			this :
			this.each( function() {
				var queue = jQuery.queue( this, type, data );

				// Ensure a hooks for this queue
				jQuery._queueHooks( this, type );

				if ( type === "fx" && queue[ 0 ] !== "inprogress" ) {
					jQuery.dequeue( this, type );
				}
			} );
	},
	dequeue: function( type ) {
		return this.each( function() {
			jQuery.dequeue( this, type );
		} );
	},
	clearQueue: function( type ) {
		return this.queue( type || "fx", [] );
	},

	// Get a promise resolved when queues of a certain type
	// are emptied (fx is the type by default)
	promise: function( type, obj ) {
		var tmp,
			count = 1,
			defer = jQuery.Deferred(),
			elements = this,
			i = this.length,
			resolve = function() {
				if ( !( --count ) ) {
					defer.resolveWith( elements, [ elements ] );
				}
			};

		if ( typeof type !== "string" ) {
			obj = type;
			type = undefined;
		}
		type = type || "fx";

		while ( i-- ) {
			tmp = dataPriv.get( elements[ i ], type + "queueHooks" );
			if ( tmp && tmp.empty ) {
				count++;
				tmp.empty.add( resolve );
			}
		}
		resolve();
		return defer.promise( obj );
	}
} );
var pnum = ( /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/ ).source;

var rcssNum = new RegExp( "^(?:([+-])=|)(" + pnum + ")([a-z%]*)$", "i" );


var cssExpand = [ "Top", "Right", "Bottom", "Left" ];

var isHidden = function( elem, el ) {

		// isHidden might be called from jQuery#filter function;
		// in that case, element will be second argument
		elem = el || elem;
		return jQuery.css( elem, "display" ) === "none" ||
			!jQuery.contains( elem.ownerDocument, elem );
	};



function adjustCSS( elem, prop, valueParts, tween ) {
	var adjusted,
		scale = 1,
		maxIterations = 20,
		currentValue = tween ?
			function() { return tween.cur(); } :
			function() { return jQuery.css( elem, prop, "" ); },
		initial = currentValue(),
		unit = valueParts && valueParts[ 3 ] || ( jQuery.cssNumber[ prop ] ? "" : "px" ),

		// Starting value computation is required for potential unit mismatches
		initialInUnit = ( jQuery.cssNumber[ prop ] || unit !== "px" && +initial ) &&
			rcssNum.exec( jQuery.css( elem, prop ) );

	if ( initialInUnit && initialInUnit[ 3 ] !== unit ) {

		// Trust units reported by jQuery.css
		unit = unit || initialInUnit[ 3 ];

		// Make sure we update the tween properties later on
		valueParts = valueParts || [];

		// Iteratively approximate from a nonzero starting point
		initialInUnit = +initial || 1;

		do {

			// If previous iteration zeroed out, double until we get *something*.
			// Use string for doubling so we don't accidentally see scale as unchanged below
			scale = scale || ".5";

			// Adjust and apply
			initialInUnit = initialInUnit / scale;
			jQuery.style( elem, prop, initialInUnit + unit );

		// Update scale, tolerating zero or NaN from tween.cur()
		// Break the loop if scale is unchanged or perfect, or if we've just had enough.
		} while (
			scale !== ( scale = currentValue() / initial ) && scale !== 1 && --maxIterations
		);
	}

	if ( valueParts ) {
		initialInUnit = +initialInUnit || +initial || 0;

		// Apply relative offset (+=/-=) if specified
		adjusted = valueParts[ 1 ] ?
			initialInUnit + ( valueParts[ 1 ] + 1 ) * valueParts[ 2 ] :
			+valueParts[ 2 ];
		if ( tween ) {
			tween.unit = unit;
			tween.start = initialInUnit;
			tween.end = adjusted;
		}
	}
	return adjusted;
}
var rcheckableType = ( /^(?:checkbox|radio)$/i );

var rtagName = ( /<([\w:-]+)/ );

var rscriptType = ( /^$|\/(?:java|ecma)script/i );



// We have to close these tags to support XHTML (#13200)
var wrapMap = {

	// Support: IE9
	option: [ 1, "<select multiple='multiple'>", "</select>" ],

	// XHTML parsers do not magically insert elements in the
	// same way that tag soup parsers do. So we cannot shorten
	// this by omitting <tbody> or other required elements.
	thead: [ 1, "<table>", "</table>" ],
	col: [ 2, "<table><colgroup>", "</colgroup></table>" ],
	tr: [ 2, "<table><tbody>", "</tbody></table>" ],
	td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],

	_default: [ 0, "", "" ]
};

// Support: IE9
wrapMap.optgroup = wrapMap.option;

wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
wrapMap.th = wrapMap.td;


function getAll( context, tag ) {

	// Support: IE9-11+
	// Use typeof to avoid zero-argument method invocation on host objects (#15151)
	var ret = typeof context.getElementsByTagName !== "undefined" ?
			context.getElementsByTagName( tag || "*" ) :
			typeof context.querySelectorAll !== "undefined" ?
				context.querySelectorAll( tag || "*" ) :
			[];

	return tag === undefined || tag && jQuery.nodeName( context, tag ) ?
		jQuery.merge( [ context ], ret ) :
		ret;
}


// Mark scripts as having already been evaluated
function setGlobalEval( elems, refElements ) {
	var i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		dataPriv.set(
			elems[ i ],
			"globalEval",
			!refElements || dataPriv.get( refElements[ i ], "globalEval" )
		);
	}
}


var rhtml = /<|&#?\w+;/;

function buildFragment( elems, context, scripts, selection, ignored ) {
	var elem, tmp, tag, wrap, contains, j,
		fragment = context.createDocumentFragment(),
		nodes = [],
		i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		elem = elems[ i ];

		if ( elem || elem === 0 ) {

			// Add nodes directly
			if ( jQuery.type( elem ) === "object" ) {

				// Support: Android<4.1, PhantomJS<2
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, elem.nodeType ? [ elem ] : elem );

			// Convert non-html into a text node
			} else if ( !rhtml.test( elem ) ) {
				nodes.push( context.createTextNode( elem ) );

			// Convert html into DOM nodes
			} else {
				tmp = tmp || fragment.appendChild( context.createElement( "div" ) );

				// Deserialize a standard representation
				tag = ( rtagName.exec( elem ) || [ "", "" ] )[ 1 ].toLowerCase();
				wrap = wrapMap[ tag ] || wrapMap._default;
				tmp.innerHTML = wrap[ 1 ] + jQuery.htmlPrefilter( elem ) + wrap[ 2 ];

				// Descend through wrappers to the right content
				j = wrap[ 0 ];
				while ( j-- ) {
					tmp = tmp.lastChild;
				}

				// Support: Android<4.1, PhantomJS<2
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, tmp.childNodes );

				// Remember the top-level container
				tmp = fragment.firstChild;

				// Ensure the created nodes are orphaned (#12392)
				tmp.textContent = "";
			}
		}
	}

	// Remove wrapper from fragment
	fragment.textContent = "";

	i = 0;
	while ( ( elem = nodes[ i++ ] ) ) {

		// Skip elements already in the context collection (trac-4087)
		if ( selection && jQuery.inArray( elem, selection ) > -1 ) {
			if ( ignored ) {
				ignored.push( elem );
			}
			continue;
		}

		contains = jQuery.contains( elem.ownerDocument, elem );

		// Append to fragment
		tmp = getAll( fragment.appendChild( elem ), "script" );

		// Preserve script evaluation history
		if ( contains ) {
			setGlobalEval( tmp );
		}

		// Capture executables
		if ( scripts ) {
			j = 0;
			while ( ( elem = tmp[ j++ ] ) ) {
				if ( rscriptType.test( elem.type || "" ) ) {
					scripts.push( elem );
				}
			}
		}
	}

	return fragment;
}


( function() {
	var fragment = document.createDocumentFragment(),
		div = fragment.appendChild( document.createElement( "div" ) ),
		input = document.createElement( "input" );

	// Support: Android 4.0-4.3, Safari<=5.1
	// Check state lost if the name is set (#11217)
	// Support: Windows Web Apps (WWA)
	// `name` and `type` must use .setAttribute for WWA (#14901)
	input.setAttribute( "type", "radio" );
	input.setAttribute( "checked", "checked" );
	input.setAttribute( "name", "t" );

	div.appendChild( input );

	// Support: Safari<=5.1, Android<4.2
	// Older WebKit doesn't clone checked state correctly in fragments
	support.checkClone = div.cloneNode( true ).cloneNode( true ).lastChild.checked;

	// Support: IE<=11+
	// Make sure textarea (and checkbox) defaultValue is properly cloned
	div.innerHTML = "<textarea>x</textarea>";
	support.noCloneChecked = !!div.cloneNode( true ).lastChild.defaultValue;
} )();


var
	rkeyEvent = /^key/,
	rmouseEvent = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
	rtypenamespace = /^([^.]*)(?:\.(.+)|)/;

function returnTrue() {
	return true;
}

function returnFalse() {
	return false;
}

// Support: IE9
// See #13393 for more info
function safeActiveElement() {
	try {
		return document.activeElement;
	} catch ( err ) { }
}

function on( elem, types, selector, data, fn, one ) {
	var origFn, type;

	// Types can be a map of types/handlers
	if ( typeof types === "object" ) {

		// ( types-Object, selector, data )
		if ( typeof selector !== "string" ) {

			// ( types-Object, data )
			data = data || selector;
			selector = undefined;
		}
		for ( type in types ) {
			on( elem, type, selector, data, types[ type ], one );
		}
		return elem;
	}

	if ( data == null && fn == null ) {

		// ( types, fn )
		fn = selector;
		data = selector = undefined;
	} else if ( fn == null ) {
		if ( typeof selector === "string" ) {

			// ( types, selector, fn )
			fn = data;
			data = undefined;
		} else {

			// ( types, data, fn )
			fn = data;
			data = selector;
			selector = undefined;
		}
	}
	if ( fn === false ) {
		fn = returnFalse;
	} else if ( !fn ) {
		return elem;
	}

	if ( one === 1 ) {
		origFn = fn;
		fn = function( event ) {

			// Can use an empty set, since event contains the info
			jQuery().off( event );
			return origFn.apply( this, arguments );
		};

		// Use same guid so caller can remove using origFn
		fn.guid = origFn.guid || ( origFn.guid = jQuery.guid++ );
	}
	return elem.each( function() {
		jQuery.event.add( this, types, fn, data, selector );
	} );
}

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

	global: {},

	add: function( elem, types, handler, data, selector ) {

		var handleObjIn, eventHandle, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.get( elem );

		// Don't attach events to noData or text/comment nodes (but allow plain objects)
		if ( !elemData ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
			selector = handleObjIn.selector;
		}

		// Make sure that the handler has a unique ID, used to find/remove it later
		if ( !handler.guid ) {
			handler.guid = jQuery.guid++;
		}

		// Init the element's event structure and main handler, if this is the first
		if ( !( events = elemData.events ) ) {
			events = elemData.events = {};
		}
		if ( !( eventHandle = elemData.handle ) ) {
			eventHandle = elemData.handle = function( e ) {

				// Discard the second event of a jQuery.event.trigger() and
				// when an event is called after a page has unloaded
				return typeof jQuery !== "undefined" && jQuery.event.triggered !== e.type ?
					jQuery.event.dispatch.apply( elem, arguments ) : undefined;
			};
		}

		// Handle multiple events separated by a space
		types = ( types || "" ).match( rnotwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// There *must* be a type, no attaching namespace-only handlers
			if ( !type ) {
				continue;
			}

			// If event changes its type, use the special event handlers for the changed type
			special = jQuery.event.special[ type ] || {};

			// If selector defined, determine special event api type, otherwise given type
			type = ( selector ? special.delegateType : special.bindType ) || type;

			// Update special based on newly reset type
			special = jQuery.event.special[ type ] || {};

			// handleObj is passed to all event handlers
			handleObj = jQuery.extend( {
				type: type,
				origType: origType,
				data: data,
				handler: handler,
				guid: handler.guid,
				selector: selector,
				needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
				namespace: namespaces.join( "." )
			}, handleObjIn );

			// Init the event handler queue if we're the first
			if ( !( handlers = events[ type ] ) ) {
				handlers = events[ type ] = [];
				handlers.delegateCount = 0;

				// Only use addEventListener if the special events handler returns false
				if ( !special.setup ||
					special.setup.call( elem, data, namespaces, eventHandle ) === false ) {

					if ( elem.addEventListener ) {
						elem.addEventListener( type, eventHandle );
					}
				}
			}

			if ( special.add ) {
				special.add.call( elem, handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.handler.guid = handler.guid;
				}
			}

			// Add to the element's handler list, delegates in front
			if ( selector ) {
				handlers.splice( handlers.delegateCount++, 0, handleObj );
			} else {
				handlers.push( handleObj );
			}

			// Keep track of which events have ever been used, for event optimization
			jQuery.event.global[ type ] = true;
		}

	},

	// Detach an event or set of events from an element
	remove: function( elem, types, handler, selector, mappedTypes ) {

		var j, origCount, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.hasData( elem ) && dataPriv.get( elem );

		if ( !elemData || !( events = elemData.events ) ) {
			return;
		}

		// Once for each type.namespace in types; type may be omitted
		types = ( types || "" ).match( rnotwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// Unbind all events (on this namespace, if provided) for the element
			if ( !type ) {
				for ( type in events ) {
					jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
				}
				continue;
			}

			special = jQuery.event.special[ type ] || {};
			type = ( selector ? special.delegateType : special.bindType ) || type;
			handlers = events[ type ] || [];
			tmp = tmp[ 2 ] &&
				new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" );

			// Remove matching events
			origCount = j = handlers.length;
			while ( j-- ) {
				handleObj = handlers[ j ];

				if ( ( mappedTypes || origType === handleObj.origType ) &&
					( !handler || handler.guid === handleObj.guid ) &&
					( !tmp || tmp.test( handleObj.namespace ) ) &&
					( !selector || selector === handleObj.selector ||
						selector === "**" && handleObj.selector ) ) {
					handlers.splice( j, 1 );

					if ( handleObj.selector ) {
						handlers.delegateCount--;
					}
					if ( special.remove ) {
						special.remove.call( elem, handleObj );
					}
				}
			}

			// Remove generic event handler if we removed something and no more handlers exist
			// (avoids potential for endless recursion during removal of special event handlers)
			if ( origCount && !handlers.length ) {
				if ( !special.teardown ||
					special.teardown.call( elem, namespaces, elemData.handle ) === false ) {

					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove data and the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			dataPriv.remove( elem, "handle events" );
		}
	},

	dispatch: function( event ) {

		// Make a writable jQuery.Event from the native event object
		event = jQuery.event.fix( event );

		var i, j, ret, matched, handleObj,
			handlerQueue = [],
			args = slice.call( arguments ),
			handlers = ( dataPriv.get( this, "events" ) || {} )[ event.type ] || [],
			special = jQuery.event.special[ event.type ] || {};

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[ 0 ] = event;
		event.delegateTarget = this;

		// Call the preDispatch hook for the mapped type, and let it bail if desired
		if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
			return;
		}

		// Determine handlers
		handlerQueue = jQuery.event.handlers.call( this, event, handlers );

		// Run delegates first; they may want to stop propagation beneath us
		i = 0;
		while ( ( matched = handlerQueue[ i++ ] ) && !event.isPropagationStopped() ) {
			event.currentTarget = matched.elem;

			j = 0;
			while ( ( handleObj = matched.handlers[ j++ ] ) &&
				!event.isImmediatePropagationStopped() ) {

				// Triggered event must either 1) have no namespace, or 2) have namespace(s)
				// a subset or equal to those in the bound event (both can have no namespace).
				if ( !event.rnamespace || event.rnamespace.test( handleObj.namespace ) ) {

					event.handleObj = handleObj;
					event.data = handleObj.data;

					ret = ( ( jQuery.event.special[ handleObj.origType ] || {} ).handle ||
						handleObj.handler ).apply( matched.elem, args );

					if ( ret !== undefined ) {
						if ( ( event.result = ret ) === false ) {
							event.preventDefault();
							event.stopPropagation();
						}
					}
				}
			}
		}

		// Call the postDispatch hook for the mapped type
		if ( special.postDispatch ) {
			special.postDispatch.call( this, event );
		}

		return event.result;
	},

	handlers: function( event, handlers ) {
		var i, matches, sel, handleObj,
			handlerQueue = [],
			delegateCount = handlers.delegateCount,
			cur = event.target;

		// Support (at least): Chrome, IE9
		// Find delegate handlers
		// Black-hole SVG <use> instance trees (#13180)
		//
		// Support: Firefox<=42+
		// Avoid non-left-click in FF but don't block IE radio events (#3861, gh-2343)
		if ( delegateCount && cur.nodeType &&
			( event.type !== "click" || isNaN( event.button ) || event.button < 1 ) ) {

			for ( ; cur !== this; cur = cur.parentNode || this ) {

				// Don't check non-elements (#13208)
				// Don't process clicks on disabled elements (#6911, #8165, #11382, #11764)
				if ( cur.nodeType === 1 && ( cur.disabled !== true || event.type !== "click" ) ) {
					matches = [];
					for ( i = 0; i < delegateCount; i++ ) {
						handleObj = handlers[ i ];

						// Don't conflict with Object.prototype properties (#13203)
						sel = handleObj.selector + " ";

						if ( matches[ sel ] === undefined ) {
							matches[ sel ] = handleObj.needsContext ?
								jQuery( sel, this ).index( cur ) > -1 :
								jQuery.find( sel, this, null, [ cur ] ).length;
						}
						if ( matches[ sel ] ) {
							matches.push( handleObj );
						}
					}
					if ( matches.length ) {
						handlerQueue.push( { elem: cur, handlers: matches } );
					}
				}
			}
		}

		// Add the remaining (directly-bound) handlers
		if ( delegateCount < handlers.length ) {
			handlerQueue.push( { elem: this, handlers: handlers.slice( delegateCount ) } );
		}

		return handlerQueue;
	},

	// Includes some event props shared by KeyEvent and MouseEvent
	props: ( "altKey bubbles cancelable ctrlKey currentTarget detail eventPhase " +
		"metaKey relatedTarget shiftKey target timeStamp view which" ).split( " " ),

	fixHooks: {},

	keyHooks: {
		props: "char charCode key keyCode".split( " " ),
		filter: function( event, original ) {

			// Add which for key events
			if ( event.which == null ) {
				event.which = original.charCode != null ? original.charCode : original.keyCode;
			}

			return event;
		}
	},

	mouseHooks: {
		props: ( "button buttons clientX clientY offsetX offsetY pageX pageY " +
			"screenX screenY toElement" ).split( " " ),
		filter: function( event, original ) {
			var eventDoc, doc, body,
				button = original.button;

			// Calculate pageX/Y if missing and clientX/Y available
			if ( event.pageX == null && original.clientX != null ) {
				eventDoc = event.target.ownerDocument || document;
				doc = eventDoc.documentElement;
				body = eventDoc.body;

				event.pageX = original.clientX +
					( doc && doc.scrollLeft || body && body.scrollLeft || 0 ) -
					( doc && doc.clientLeft || body && body.clientLeft || 0 );
				event.pageY = original.clientY +
					( doc && doc.scrollTop  || body && body.scrollTop  || 0 ) -
					( doc && doc.clientTop  || body && body.clientTop  || 0 );
			}

			// Add which for click: 1 === left; 2 === middle; 3 === right
			// Note: button is not normalized, so don't use it
			if ( !event.which && button !== undefined ) {
				event.which = ( button & 1 ? 1 : ( button & 2 ? 3 : ( button & 4 ? 2 : 0 ) ) );
			}

			return event;
		}
	},

	fix: function( event ) {
		if ( event[ jQuery.expando ] ) {
			return event;
		}

		// Create a writable copy of the event object and normalize some properties
		var i, prop, copy,
			type = event.type,
			originalEvent = event,
			fixHook = this.fixHooks[ type ];

		if ( !fixHook ) {
			this.fixHooks[ type ] = fixHook =
				rmouseEvent.test( type ) ? this.mouseHooks :
				rkeyEvent.test( type ) ? this.keyHooks :
				{};
		}
		copy = fixHook.props ? this.props.concat( fixHook.props ) : this.props;

		event = new jQuery.Event( originalEvent );

		i = copy.length;
		while ( i-- ) {
			prop = copy[ i ];
			event[ prop ] = originalEvent[ prop ];
		}

		// Support: Cordova 2.5 (WebKit) (#13255)
		// All events should have a target; Cordova deviceready doesn't
		if ( !event.target ) {
			event.target = document;
		}

		// Support: Safari 6.0+, Chrome<28
		// Target should not be a text node (#504, #13143)
		if ( event.target.nodeType === 3 ) {
			event.target = event.target.parentNode;
		}

		return fixHook.filter ? fixHook.filter( event, originalEvent ) : event;
	},

	special: {
		load: {

			// Prevent triggered image.load events from bubbling to window.load
			noBubble: true
		},
		focus: {

			// Fire native event if possible so blur/focus sequence is correct
			trigger: function() {
				if ( this !== safeActiveElement() && this.focus ) {
					this.focus();
					return false;
				}
			},
			delegateType: "focusin"
		},
		blur: {
			trigger: function() {
				if ( this === safeActiveElement() && this.blur ) {
					this.blur();
					return false;
				}
			},
			delegateType: "focusout"
		},
		click: {

			// For checkbox, fire native event so checked state will be right
			trigger: function() {
				if ( this.type === "checkbox" && this.click && jQuery.nodeName( this, "input" ) ) {
					this.click();
					return false;
				}
			},

			// For cross-browser consistency, don't fire native .click() on links
			_default: function( event ) {
				return jQuery.nodeName( event.target, "a" );
			}
		},

		beforeunload: {
			postDispatch: function( event ) {

				// Support: Firefox 20+
				// Firefox doesn't alert if the returnValue field is not set.
				if ( event.result !== undefined && event.originalEvent ) {
					event.originalEvent.returnValue = event.result;
				}
			}
		}
	}
};

jQuery.removeEvent = function( elem, type, handle ) {

	// This "if" is needed for plain objects
	if ( elem.removeEventListener ) {
		elem.removeEventListener( type, handle );
	}
};

jQuery.Event = function( src, props ) {

	// Allow instantiation without the 'new' keyword
	if ( !( this instanceof jQuery.Event ) ) {
		return new jQuery.Event( src, props );
	}

	// Event object
	if ( src && src.type ) {
		this.originalEvent = src;
		this.type = src.type;

		// Events bubbling up the document may have been marked as prevented
		// by a handler lower down the tree; reflect the correct value.
		this.isDefaultPrevented = src.defaultPrevented ||
				src.defaultPrevented === undefined &&

				// Support: Android<4.0
				src.returnValue === false ?
			returnTrue :
			returnFalse;

	// Event type
	} else {
		this.type = src;
	}

	// Put explicitly provided properties onto the event object
	if ( props ) {
		jQuery.extend( this, props );
	}

	// Create a timestamp if incoming event doesn't have one
	this.timeStamp = src && src.timeStamp || jQuery.now();

	// Mark it as fixed
	this[ jQuery.expando ] = true;
};

// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
jQuery.Event.prototype = {
	constructor: jQuery.Event,
	isDefaultPrevented: returnFalse,
	isPropagationStopped: returnFalse,
	isImmediatePropagationStopped: returnFalse,
	isSimulated: false,

	preventDefault: function() {
		var e = this.originalEvent;

		this.isDefaultPrevented = returnTrue;

		if ( e && !this.isSimulated ) {
			e.preventDefault();
		}
	},
	stopPropagation: function() {
		var e = this.originalEvent;

		this.isPropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopPropagation();
		}
	},
	stopImmediatePropagation: function() {
		var e = this.originalEvent;

		this.isImmediatePropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopImmediatePropagation();
		}

		this.stopPropagation();
	}
};

// Create mouseenter/leave events using mouseover/out and event-time checks
// so that event delegation works in jQuery.
// Do the same for pointerenter/pointerleave and pointerover/pointerout
//
// Support: Safari 7 only
// Safari sends mouseenter too often; see:
// https://code.google.com/p/chromium/issues/detail?id=470258
// for the description of the bug (it existed in older Chrome versions as well).
jQuery.each( {
	mouseenter: "mouseover",
	mouseleave: "mouseout",
	pointerenter: "pointerover",
	pointerleave: "pointerout"
}, function( orig, fix ) {
	jQuery.event.special[ orig ] = {
		delegateType: fix,
		bindType: fix,

		handle: function( event ) {
			var ret,
				target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj;

			// For mouseenter/leave call the handler if related is outside the target.
			// NB: No relatedTarget if the mouse left/entered the browser window
			if ( !related || ( related !== target && !jQuery.contains( target, related ) ) ) {
				event.type = handleObj.origType;
				ret = handleObj.handler.apply( this, arguments );
				event.type = fix;
			}
			return ret;
		}
	};
} );

jQuery.fn.extend( {
	on: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn );
	},
	one: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn, 1 );
	},
	off: function( types, selector, fn ) {
		var handleObj, type;
		if ( types && types.preventDefault && types.handleObj ) {

			// ( event )  dispatched jQuery.Event
			handleObj = types.handleObj;
			jQuery( types.delegateTarget ).off(
				handleObj.namespace ?
					handleObj.origType + "." + handleObj.namespace :
					handleObj.origType,
				handleObj.selector,
				handleObj.handler
			);
			return this;
		}
		if ( typeof types === "object" ) {

			// ( types-object [, selector] )
			for ( type in types ) {
				this.off( type, selector, types[ type ] );
			}
			return this;
		}
		if ( selector === false || typeof selector === "function" ) {

			// ( types [, fn] )
			fn = selector;
			selector = undefined;
		}
		if ( fn === false ) {
			fn = returnFalse;
		}
		return this.each( function() {
			jQuery.event.remove( this, types, fn, selector );
		} );
	}
} );


var
	rxhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,

	// Support: IE 10-11, Edge 10240+
	// In IE/Edge using regex groups here causes severe slowdowns.
	// See https://connect.microsoft.com/IE/feedback/details/1736512/
	rnoInnerhtml = /<script|<style|<link/i,

	// checked="checked" or checked
	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
	rscriptTypeMasked = /^true\/(.*)/,
	rcleanScript = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

// Manipulating tables requires a tbody
function manipulationTarget( elem, content ) {
	return jQuery.nodeName( elem, "table" ) &&
		jQuery.nodeName( content.nodeType !== 11 ? content : content.firstChild, "tr" ) ?

		elem.getElementsByTagName( "tbody" )[ 0 ] ||
			elem.appendChild( elem.ownerDocument.createElement( "tbody" ) ) :
		elem;
}

// Replace/restore the type attribute of script elements for safe DOM manipulation
function disableScript( elem ) {
	elem.type = ( elem.getAttribute( "type" ) !== null ) + "/" + elem.type;
	return elem;
}
function restoreScript( elem ) {
	var match = rscriptTypeMasked.exec( elem.type );

	if ( match ) {
		elem.type = match[ 1 ];
	} else {
		elem.removeAttribute( "type" );
	}

	return elem;
}

function cloneCopyEvent( src, dest ) {
	var i, l, type, pdataOld, pdataCur, udataOld, udataCur, events;

	if ( dest.nodeType !== 1 ) {
		return;
	}

	// 1. Copy private data: events, handlers, etc.
	if ( dataPriv.hasData( src ) ) {
		pdataOld = dataPriv.access( src );
		pdataCur = dataPriv.set( dest, pdataOld );
		events = pdataOld.events;

		if ( events ) {
			delete pdataCur.handle;
			pdataCur.events = {};

			for ( type in events ) {
				for ( i = 0, l = events[ type ].length; i < l; i++ ) {
					jQuery.event.add( dest, type, events[ type ][ i ] );
				}
			}
		}
	}

	// 2. Copy user data
	if ( dataUser.hasData( src ) ) {
		udataOld = dataUser.access( src );
		udataCur = jQuery.extend( {}, udataOld );

		dataUser.set( dest, udataCur );
	}
}

// Fix IE bugs, see support tests
function fixInput( src, dest ) {
	var nodeName = dest.nodeName.toLowerCase();

	// Fails to persist the checked state of a cloned checkbox or radio button.
	if ( nodeName === "input" && rcheckableType.test( src.type ) ) {
		dest.checked = src.checked;

	// Fails to return the selected option to the default selected state when cloning options
	} else if ( nodeName === "input" || nodeName === "textarea" ) {
		dest.defaultValue = src.defaultValue;
	}
}

function domManip( collection, args, callback, ignored ) {

	// Flatten any nested arrays
	args = concat.apply( [], args );

	var fragment, first, scripts, hasScripts, node, doc,
		i = 0,
		l = collection.length,
		iNoClone = l - 1,
		value = args[ 0 ],
		isFunction = jQuery.isFunction( value );

	// We can't cloneNode fragments that contain checked, in WebKit
	if ( isFunction ||
			( l > 1 && typeof value === "string" &&
				!support.checkClone && rchecked.test( value ) ) ) {
		return collection.each( function( index ) {
			var self = collection.eq( index );
			if ( isFunction ) {
				args[ 0 ] = value.call( this, index, self.html() );
			}
			domManip( self, args, callback, ignored );
		} );
	}

	if ( l ) {
		fragment = buildFragment( args, collection[ 0 ].ownerDocument, false, collection, ignored );
		first = fragment.firstChild;

		if ( fragment.childNodes.length === 1 ) {
			fragment = first;
		}

		// Require either new content or an interest in ignored elements to invoke the callback
		if ( first || ignored ) {
			scripts = jQuery.map( getAll( fragment, "script" ), disableScript );
			hasScripts = scripts.length;

			// Use the original fragment for the last item
			// instead of the first because it can end up
			// being emptied incorrectly in certain situations (#8070).
			for ( ; i < l; i++ ) {
				node = fragment;

				if ( i !== iNoClone ) {
					node = jQuery.clone( node, true, true );

					// Keep references to cloned scripts for later restoration
					if ( hasScripts ) {

						// Support: Android<4.1, PhantomJS<2
						// push.apply(_, arraylike) throws on ancient WebKit
						jQuery.merge( scripts, getAll( node, "script" ) );
					}
				}

				callback.call( collection[ i ], node, i );
			}

			if ( hasScripts ) {
				doc = scripts[ scripts.length - 1 ].ownerDocument;

				// Reenable scripts
				jQuery.map( scripts, restoreScript );

				// Evaluate executable scripts on first document insertion
				for ( i = 0; i < hasScripts; i++ ) {
					node = scripts[ i ];
					if ( rscriptType.test( node.type || "" ) &&
						!dataPriv.access( node, "globalEval" ) &&
						jQuery.contains( doc, node ) ) {

						if ( node.src ) {

							// Optional AJAX dependency, but won't run scripts if not present
							if ( jQuery._evalUrl ) {
								jQuery._evalUrl( node.src );
							}
						} else {
							jQuery.globalEval( node.textContent.replace( rcleanScript, "" ) );
						}
					}
				}
			}
		}
	}

	return collection;
}

function remove( elem, selector, keepData ) {
	var node,
		nodes = selector ? jQuery.filter( selector, elem ) : elem,
		i = 0;

	for ( ; ( node = nodes[ i ] ) != null; i++ ) {
		if ( !keepData && node.nodeType === 1 ) {
			jQuery.cleanData( getAll( node ) );
		}

		if ( node.parentNode ) {
			if ( keepData && jQuery.contains( node.ownerDocument, node ) ) {
				setGlobalEval( getAll( node, "script" ) );
			}
			node.parentNode.removeChild( node );
		}
	}

	return elem;
}

jQuery.extend( {
	htmlPrefilter: function( html ) {
		return html.replace( rxhtmlTag, "<$1></$2>" );
	},

	clone: function( elem, dataAndEvents, deepDataAndEvents ) {
		var i, l, srcElements, destElements,
			clone = elem.cloneNode( true ),
			inPage = jQuery.contains( elem.ownerDocument, elem );

		// Fix IE cloning issues
		if ( !support.noCloneChecked && ( elem.nodeType === 1 || elem.nodeType === 11 ) &&
				!jQuery.isXMLDoc( elem ) ) {

			// We eschew Sizzle here for performance reasons: http://jsperf.com/getall-vs-sizzle/2
			destElements = getAll( clone );
			srcElements = getAll( elem );

			for ( i = 0, l = srcElements.length; i < l; i++ ) {
				fixInput( srcElements[ i ], destElements[ i ] );
			}
		}

		// Copy the events from the original to the clone
		if ( dataAndEvents ) {
			if ( deepDataAndEvents ) {
				srcElements = srcElements || getAll( elem );
				destElements = destElements || getAll( clone );

				for ( i = 0, l = srcElements.length; i < l; i++ ) {
					cloneCopyEvent( srcElements[ i ], destElements[ i ] );
				}
			} else {
				cloneCopyEvent( elem, clone );
			}
		}

		// Preserve script evaluation history
		destElements = getAll( clone, "script" );
		if ( destElements.length > 0 ) {
			setGlobalEval( destElements, !inPage && getAll( elem, "script" ) );
		}

		// Return the cloned set
		return clone;
	},

	cleanData: function( elems ) {
		var data, elem, type,
			special = jQuery.event.special,
			i = 0;

		for ( ; ( elem = elems[ i ] ) !== undefined; i++ ) {
			if ( acceptData( elem ) ) {
				if ( ( data = elem[ dataPriv.expando ] ) ) {
					if ( data.events ) {
						for ( type in data.events ) {
							if ( special[ type ] ) {
								jQuery.event.remove( elem, type );

							// This is a shortcut to avoid jQuery.event.remove's overhead
							} else {
								jQuery.removeEvent( elem, type, data.handle );
							}
						}
					}

					// Support: Chrome <= 35-45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataPriv.expando ] = undefined;
				}
				if ( elem[ dataUser.expando ] ) {

					// Support: Chrome <= 35-45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataUser.expando ] = undefined;
				}
			}
		}
	}
} );

jQuery.fn.extend( {

	// Keep domManip exposed until 3.0 (gh-2225)
	domManip: domManip,

	detach: function( selector ) {
		return remove( this, selector, true );
	},

	remove: function( selector ) {
		return remove( this, selector );
	},

	text: function( value ) {
		return access( this, function( value ) {
			return value === undefined ?
				jQuery.text( this ) :
				this.empty().each( function() {
					if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
						this.textContent = value;
					}
				} );
		}, null, value, arguments.length );
	},

	append: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.appendChild( elem );
			}
		} );
	},

	prepend: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.insertBefore( elem, target.firstChild );
			}
		} );
	},

	before: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this );
			}
		} );
	},

	after: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this.nextSibling );
			}
		} );
	},

	empty: function() {
		var elem,
			i = 0;

		for ( ; ( elem = this[ i ] ) != null; i++ ) {
			if ( elem.nodeType === 1 ) {

				// Prevent memory leaks
				jQuery.cleanData( getAll( elem, false ) );

				// Remove any remaining nodes
				elem.textContent = "";
			}
		}

		return this;
	},

	clone: function( dataAndEvents, deepDataAndEvents ) {
		dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
		deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;

		return this.map( function() {
			return jQuery.clone( this, dataAndEvents, deepDataAndEvents );
		} );
	},

	html: function( value ) {
		return access( this, function( value ) {
			var elem = this[ 0 ] || {},
				i = 0,
				l = this.length;

			if ( value === undefined && elem.nodeType === 1 ) {
				return elem.innerHTML;
			}

			// See if we can take a shortcut and just use innerHTML
			if ( typeof value === "string" && !rnoInnerhtml.test( value ) &&
				!wrapMap[ ( rtagName.exec( value ) || [ "", "" ] )[ 1 ].toLowerCase() ] ) {

				value = jQuery.htmlPrefilter( value );

				try {
					for ( ; i < l; i++ ) {
						elem = this[ i ] || {};

						// Remove element nodes and prevent memory leaks
						if ( elem.nodeType === 1 ) {
							jQuery.cleanData( getAll( elem, false ) );
							elem.innerHTML = value;
						}
					}

					elem = 0;

				// If using innerHTML throws an exception, use the fallback method
				} catch ( e ) {}
			}

			if ( elem ) {
				this.empty().append( value );
			}
		}, null, value, arguments.length );
	},

	replaceWith: function() {
		var ignored = [];

		// Make the changes, replacing each non-ignored context element with the new content
		return domManip( this, arguments, function( elem ) {
			var parent = this.parentNode;

			if ( jQuery.inArray( this, ignored ) < 0 ) {
				jQuery.cleanData( getAll( this ) );
				if ( parent ) {
					parent.replaceChild( elem, this );
				}
			}

		// Force callback invocation
		}, ignored );
	}
} );

jQuery.each( {
	appendTo: "append",
	prependTo: "prepend",
	insertBefore: "before",
	insertAfter: "after",
	replaceAll: "replaceWith"
}, function( name, original ) {
	jQuery.fn[ name ] = function( selector ) {
		var elems,
			ret = [],
			insert = jQuery( selector ),
			last = insert.length - 1,
			i = 0;

		for ( ; i <= last; i++ ) {
			elems = i === last ? this : this.clone( true );
			jQuery( insert[ i ] )[ original ]( elems );

			// Support: QtWebKit
			// .get() because push.apply(_, arraylike) throws
			push.apply( ret, elems.get() );
		}

		return this.pushStack( ret );
	};
} );


var iframe,
	elemdisplay = {

		// Support: Firefox
		// We have to pre-define these values for FF (#10227)
		HTML: "block",
		BODY: "block"
	};

/**
 * Retrieve the actual display of a element
 * @param {String} name nodeName of the element
 * @param {Object} doc Document object
 */

// Called only from within defaultDisplay
function actualDisplay( name, doc ) {
	var elem = jQuery( doc.createElement( name ) ).appendTo( doc.body ),

		display = jQuery.css( elem[ 0 ], "display" );

	// We don't have any data stored on the element,
	// so use "detach" method as fast way to get rid of the element
	elem.detach();

	return display;
}

/**
 * Try to determine the default display value of an element
 * @param {String} nodeName
 */
function defaultDisplay( nodeName ) {
	var doc = document,
		display = elemdisplay[ nodeName ];

	if ( !display ) {
		display = actualDisplay( nodeName, doc );

		// If the simple way fails, read from inside an iframe
		if ( display === "none" || !display ) {

			// Use the already-created iframe if possible
			iframe = ( iframe || jQuery( "<iframe frameborder='0' width='0' height='0'/>" ) )
				.appendTo( doc.documentElement );

			// Always write a new HTML skeleton so Webkit and Firefox don't choke on reuse
			doc = iframe[ 0 ].contentDocument;

			// Support: IE
			doc.write();
			doc.close();

			display = actualDisplay( nodeName, doc );
			iframe.detach();
		}

		// Store the correct default display
		elemdisplay[ nodeName ] = display;
	}

	return display;
}
var rmargin = ( /^margin/ );

var rnumnonpx = new RegExp( "^(" + pnum + ")(?!px)[a-z%]+$", "i" );

var getStyles = function( elem ) {

		// Support: IE<=11+, Firefox<=30+ (#15098, #14150)
		// IE throws on elements created in popups
		// FF meanwhile throws on frame elements through "defaultView.getComputedStyle"
		var view = elem.ownerDocument.defaultView;

		if ( !view || !view.opener ) {
			view = window;
		}

		return view.getComputedStyle( elem );
	};

var swap = function( elem, options, callback, args ) {
	var ret, name,
		old = {};

	// Remember the old values, and insert the new ones
	for ( name in options ) {
		old[ name ] = elem.style[ name ];
		elem.style[ name ] = options[ name ];
	}

	ret = callback.apply( elem, args || [] );

	// Revert the old values
	for ( name in options ) {
		elem.style[ name ] = old[ name ];
	}

	return ret;
};


var documentElement = document.documentElement;



( function() {
	var pixelPositionVal, boxSizingReliableVal, pixelMarginRightVal, reliableMarginLeftVal,
		container = document.createElement( "div" ),
		div = document.createElement( "div" );

	// Finish early in limited (non-browser) environments
	if ( !div.style ) {
		return;
	}

	// Support: IE9-11+
	// Style of cloned element affects source element cloned (#8908)
	div.style.backgroundClip = "content-box";
	div.cloneNode( true ).style.backgroundClip = "";
	support.clearCloneStyle = div.style.backgroundClip === "content-box";

	container.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;" +
		"padding:0;margin-top:1px;position:absolute";
	container.appendChild( div );

	// Executing both pixelPosition & boxSizingReliable tests require only one layout
	// so they're executed at the same time to save the second computation.
	function computeStyleTests() {
		div.style.cssText =

			// Support: Firefox<29, Android 2.3
			// Vendor-prefix box-sizing
			"-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;" +
			"position:relative;display:block;" +
			"margin:auto;border:1px;padding:1px;" +
			"top:1%;width:50%";
		div.innerHTML = "";
		documentElement.appendChild( container );

		var divStyle = window.getComputedStyle( div );
		pixelPositionVal = divStyle.top !== "1%";
		reliableMarginLeftVal = divStyle.marginLeft === "2px";
		boxSizingReliableVal = divStyle.width === "4px";

		// Support: Android 4.0 - 4.3 only
		// Some styles come back with percentage values, even though they shouldn't
		div.style.marginRight = "50%";
		pixelMarginRightVal = divStyle.marginRight === "4px";

		documentElement.removeChild( container );
	}

	jQuery.extend( support, {
		pixelPosition: function() {

			// This test is executed only once but we still do memoizing
			// since we can use the boxSizingReliable pre-computing.
			// No need to check if the test was already performed, though.
			computeStyleTests();
			return pixelPositionVal;
		},
		boxSizingReliable: function() {
			if ( boxSizingReliableVal == null ) {
				computeStyleTests();
			}
			return boxSizingReliableVal;
		},
		pixelMarginRight: function() {

			// Support: Android 4.0-4.3
			// We're checking for boxSizingReliableVal here instead of pixelMarginRightVal
			// since that compresses better and they're computed together anyway.
			if ( boxSizingReliableVal == null ) {
				computeStyleTests();
			}
			return pixelMarginRightVal;
		},
		reliableMarginLeft: function() {

			// Support: IE <=8 only, Android 4.0 - 4.3 only, Firefox <=3 - 37
			if ( boxSizingReliableVal == null ) {
				computeStyleTests();
			}
			return reliableMarginLeftVal;
		},
		reliableMarginRight: function() {

			// Support: Android 2.3
			// Check if div with explicit width and no margin-right incorrectly
			// gets computed margin-right based on width of container. (#3333)
			// WebKit Bug 13343 - getComputedStyle returns wrong value for margin-right
			// This support function is only executed once so no memoizing is needed.
			var ret,
				marginDiv = div.appendChild( document.createElement( "div" ) );

			// Reset CSS: box-sizing; display; margin; border; padding
			marginDiv.style.cssText = div.style.cssText =

				// Support: Android 2.3
				// Vendor-prefix box-sizing
				"-webkit-box-sizing:content-box;box-sizing:content-box;" +
				"display:block;margin:0;border:0;padding:0";
			marginDiv.style.marginRight = marginDiv.style.width = "0";
			div.style.width = "1px";
			documentElement.appendChild( container );

			ret = !parseFloat( window.getComputedStyle( marginDiv ).marginRight );

			documentElement.removeChild( container );
			div.removeChild( marginDiv );

			return ret;
		}
	} );
} )();


function curCSS( elem, name, computed ) {
	var width, minWidth, maxWidth, ret,
		style = elem.style;

	computed = computed || getStyles( elem );
	ret = computed ? computed.getPropertyValue( name ) || computed[ name ] : undefined;

	// Support: Opera 12.1x only
	// Fall back to style even without computed
	// computed is undefined for elems on document fragments
	if ( ( ret === "" || ret === undefined ) && !jQuery.contains( elem.ownerDocument, elem ) ) {
		ret = jQuery.style( elem, name );
	}

	// Support: IE9
	// getPropertyValue is only needed for .css('filter') (#12537)
	if ( computed ) {

		// A tribute to the "awesome hack by Dean Edwards"
		// Android Browser returns percentage for some values,
		// but width seems to be reliably pixels.
		// This is against the CSSOM draft spec:
		// http://dev.w3.org/csswg/cssom/#resolved-values
		if ( !support.pixelMarginRight() && rnumnonpx.test( ret ) && rmargin.test( name ) ) {

			// Remember the original values
			width = style.width;
			minWidth = style.minWidth;
			maxWidth = style.maxWidth;

			// Put in the new values to get a computed value out
			style.minWidth = style.maxWidth = style.width = ret;
			ret = computed.width;

			// Revert the changed values
			style.width = width;
			style.minWidth = minWidth;
			style.maxWidth = maxWidth;
		}
	}

	return ret !== undefined ?

		// Support: IE9-11+
		// IE returns zIndex value as an integer.
		ret + "" :
		ret;
}


function addGetHookIf( conditionFn, hookFn ) {

	// Define the hook, we'll check on the first run if it's really needed.
	return {
		get: function() {
			if ( conditionFn() ) {

				// Hook not needed (or it's not possible to use it due
				// to missing dependency), remove it.
				delete this.get;
				return;
			}

			// Hook needed; redefine it so that the support test is not executed again.
			return ( this.get = hookFn ).apply( this, arguments );
		}
	};
}


var

	// Swappable if display is none or starts with table
	// except "table", "table-cell", or "table-caption"
	// See here for display values: https://developer.mozilla.org/en-US/docs/CSS/display
	rdisplayswap = /^(none|table(?!-c[ea]).+)/,

	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
	cssNormalTransform = {
		letterSpacing: "0",
		fontWeight: "400"
	},

	cssPrefixes = [ "Webkit", "O", "Moz", "ms" ],
	emptyStyle = document.createElement( "div" ).style;

// Return a css property mapped to a potentially vendor prefixed property
function vendorPropName( name ) {

	// Shortcut for names that are not vendor prefixed
	if ( name in emptyStyle ) {
		return name;
	}

	// Check for vendor prefixed names
	var capName = name[ 0 ].toUpperCase() + name.slice( 1 ),
		i = cssPrefixes.length;

	while ( i-- ) {
		name = cssPrefixes[ i ] + capName;
		if ( name in emptyStyle ) {
			return name;
		}
	}
}

function setPositiveNumber( elem, value, subtract ) {

	// Any relative (+/-) values have already been
	// normalized at this point
	var matches = rcssNum.exec( value );
	return matches ?

		// Guard against undefined "subtract", e.g., when used as in cssHooks
		Math.max( 0, matches[ 2 ] - ( subtract || 0 ) ) + ( matches[ 3 ] || "px" ) :
		value;
}

function augmentWidthOrHeight( elem, name, extra, isBorderBox, styles ) {
	var i = extra === ( isBorderBox ? "border" : "content" ) ?

		// If we already have the right measurement, avoid augmentation
		4 :

		// Otherwise initialize for horizontal or vertical properties
		name === "width" ? 1 : 0,

		val = 0;

	for ( ; i < 4; i += 2 ) {

		// Both box models exclude margin, so add it if we want it
		if ( extra === "margin" ) {
			val += jQuery.css( elem, extra + cssExpand[ i ], true, styles );
		}

		if ( isBorderBox ) {

			// border-box includes padding, so remove it if we want content
			if ( extra === "content" ) {
				val -= jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );
			}

			// At this point, extra isn't border nor margin, so remove border
			if ( extra !== "margin" ) {
				val -= jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		} else {

			// At this point, extra isn't content, so add padding
			val += jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );

			// At this point, extra isn't content nor padding, so add border
			if ( extra !== "padding" ) {
				val += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		}
	}

	return val;
}

function getWidthOrHeight( elem, name, extra ) {

	// Start with offset property, which is equivalent to the border-box value
	var valueIsBorderBox = true,
		val = name === "width" ? elem.offsetWidth : elem.offsetHeight,
		styles = getStyles( elem ),
		isBorderBox = jQuery.css( elem, "boxSizing", false, styles ) === "border-box";

	// Some non-html elements return undefined for offsetWidth, so check for null/undefined
	// svg - https://bugzilla.mozilla.org/show_bug.cgi?id=649285
	// MathML - https://bugzilla.mozilla.org/show_bug.cgi?id=491668
	if ( val <= 0 || val == null ) {

		// Fall back to computed then uncomputed css if necessary
		val = curCSS( elem, name, styles );
		if ( val < 0 || val == null ) {
			val = elem.style[ name ];
		}

		// Computed unit is not pixels. Stop here and return.
		if ( rnumnonpx.test( val ) ) {
			return val;
		}

		// Check for style in case a browser which returns unreliable values
		// for getComputedStyle silently falls back to the reliable elem.style
		valueIsBorderBox = isBorderBox &&
			( support.boxSizingReliable() || val === elem.style[ name ] );

		// Normalize "", auto, and prepare for extra
		val = parseFloat( val ) || 0;
	}

	// Use the active box-sizing model to add/subtract irrelevant styles
	return ( val +
		augmentWidthOrHeight(
			elem,
			name,
			extra || ( isBorderBox ? "border" : "content" ),
			valueIsBorderBox,
			styles
		)
	) + "px";
}

function showHide( elements, show ) {
	var display, elem, hidden,
		values = [],
		index = 0,
		length = elements.length;

	for ( ; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}

		values[ index ] = dataPriv.get( elem, "olddisplay" );
		display = elem.style.display;
		if ( show ) {

			// Reset the inline display of this element to learn if it is
			// being hidden by cascaded rules or not
			if ( !values[ index ] && display === "none" ) {
				elem.style.display = "";
			}

			// Set elements which have been overridden with display: none
			// in a stylesheet to whatever the default browser style is
			// for such an element
			if ( elem.style.display === "" && isHidden( elem ) ) {
				values[ index ] = dataPriv.access(
					elem,
					"olddisplay",
					defaultDisplay( elem.nodeName )
				);
			}
		} else {
			hidden = isHidden( elem );

			if ( display !== "none" || !hidden ) {
				dataPriv.set(
					elem,
					"olddisplay",
					hidden ? display : jQuery.css( elem, "display" )
				);
			}
		}
	}

	// Set the display of most of the elements in a second loop
	// to avoid the constant reflow
	for ( index = 0; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}
		if ( !show || elem.style.display === "none" || elem.style.display === "" ) {
			elem.style.display = show ? values[ index ] || "" : "none";
		}
	}

	return elements;
}

jQuery.extend( {

	// Add in style property hooks for overriding the default
	// behavior of getting and setting a style property
	cssHooks: {
		opacity: {
			get: function( elem, computed ) {
				if ( computed ) {

					// We should always get a number back from opacity
					var ret = curCSS( elem, "opacity" );
					return ret === "" ? "1" : ret;
				}
			}
		}
	},

	// Don't automatically add "px" to these possibly-unitless properties
	cssNumber: {
		"animationIterationCount": true,
		"columnCount": true,
		"fillOpacity": true,
		"flexGrow": true,
		"flexShrink": true,
		"fontWeight": true,
		"lineHeight": true,
		"opacity": true,
		"order": true,
		"orphans": true,
		"widows": true,
		"zIndex": true,
		"zoom": true
	},

	// Add in properties whose names you wish to fix before
	// setting or getting the value
	cssProps: {
		"float": "cssFloat"
	},

	// Get and set the style property on a DOM Node
	style: function( elem, name, value, extra ) {

		// Don't set styles on text and comment nodes
		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style ) {
			return;
		}

		// Make sure that we're working with the right name
		var ret, type, hooks,
			origName = jQuery.camelCase( name ),
			style = elem.style;

		name = jQuery.cssProps[ origName ] ||
			( jQuery.cssProps[ origName ] = vendorPropName( origName ) || origName );

		// Gets hook for the prefixed version, then unprefixed version
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// Check if we're setting a value
		if ( value !== undefined ) {
			type = typeof value;

			// Convert "+=" or "-=" to relative numbers (#7345)
			if ( type === "string" && ( ret = rcssNum.exec( value ) ) && ret[ 1 ] ) {
				value = adjustCSS( elem, name, ret );

				// Fixes bug #9237
				type = "number";
			}

			// Make sure that null and NaN values aren't set (#7116)
			if ( value == null || value !== value ) {
				return;
			}

			// If a number was passed in, add the unit (except for certain CSS properties)
			if ( type === "number" ) {
				value += ret && ret[ 3 ] || ( jQuery.cssNumber[ origName ] ? "" : "px" );
			}

			// Support: IE9-11+
			// background-* props affect original clone's values
			if ( !support.clearCloneStyle && value === "" && name.indexOf( "background" ) === 0 ) {
				style[ name ] = "inherit";
			}

			// If a hook was provided, use that value, otherwise just set the specified value
			if ( !hooks || !( "set" in hooks ) ||
				( value = hooks.set( elem, value, extra ) ) !== undefined ) {

				style[ name ] = value;
			}

		} else {

			// If a hook was provided get the non-computed value from there
			if ( hooks && "get" in hooks &&
				( ret = hooks.get( elem, false, extra ) ) !== undefined ) {

				return ret;
			}

			// Otherwise just get the value from the style object
			return style[ name ];
		}
	},

	css: function( elem, name, extra, styles ) {
		var val, num, hooks,
			origName = jQuery.camelCase( name );

		// Make sure that we're working with the right name
		name = jQuery.cssProps[ origName ] ||
			( jQuery.cssProps[ origName ] = vendorPropName( origName ) || origName );

		// Try prefixed name followed by the unprefixed name
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// If a hook was provided get the computed value from there
		if ( hooks && "get" in hooks ) {
			val = hooks.get( elem, true, extra );
		}

		// Otherwise, if a way to get the computed value exists, use that
		if ( val === undefined ) {
			val = curCSS( elem, name, styles );
		}

		// Convert "normal" to computed value
		if ( val === "normal" && name in cssNormalTransform ) {
			val = cssNormalTransform[ name ];
		}

		// Make numeric if forced or a qualifier was provided and val looks numeric
		if ( extra === "" || extra ) {
			num = parseFloat( val );
			return extra === true || isFinite( num ) ? num || 0 : val;
		}
		return val;
	}
} );

jQuery.each( [ "height", "width" ], function( i, name ) {
	jQuery.cssHooks[ name ] = {
		get: function( elem, computed, extra ) {
			if ( computed ) {

				// Certain elements can have dimension info if we invisibly show them
				// but it must have a current display style that would benefit
				return rdisplayswap.test( jQuery.css( elem, "display" ) ) &&
					elem.offsetWidth === 0 ?
						swap( elem, cssShow, function() {
							return getWidthOrHeight( elem, name, extra );
						} ) :
						getWidthOrHeight( elem, name, extra );
			}
		},

		set: function( elem, value, extra ) {
			var matches,
				styles = extra && getStyles( elem ),
				subtract = extra && augmentWidthOrHeight(
					elem,
					name,
					extra,
					jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
					styles
				);

			// Convert to pixels if value adjustment is needed
			if ( subtract && ( matches = rcssNum.exec( value ) ) &&
				( matches[ 3 ] || "px" ) !== "px" ) {

				elem.style[ name ] = value;
				value = jQuery.css( elem, name );
			}

			return setPositiveNumber( elem, value, subtract );
		}
	};
} );

jQuery.cssHooks.marginLeft = addGetHookIf( support.reliableMarginLeft,
	function( elem, computed ) {
		if ( computed ) {
			return ( parseFloat( curCSS( elem, "marginLeft" ) ) ||
				elem.getBoundingClientRect().left -
					swap( elem, { marginLeft: 0 }, function() {
						return elem.getBoundingClientRect().left;
					} )
				) + "px";
		}
	}
);

// Support: Android 2.3
jQuery.cssHooks.marginRight = addGetHookIf( support.reliableMarginRight,
	function( elem, computed ) {
		if ( computed ) {
			return swap( elem, { "display": "inline-block" },
				curCSS, [ elem, "marginRight" ] );
		}
	}
);

// These hooks are used by animate to expand properties
jQuery.each( {
	margin: "",
	padding: "",
	border: "Width"
}, function( prefix, suffix ) {
	jQuery.cssHooks[ prefix + suffix ] = {
		expand: function( value ) {
			var i = 0,
				expanded = {},

				// Assumes a single number if not a string
				parts = typeof value === "string" ? value.split( " " ) : [ value ];

			for ( ; i < 4; i++ ) {
				expanded[ prefix + cssExpand[ i ] + suffix ] =
					parts[ i ] || parts[ i - 2 ] || parts[ 0 ];
			}

			return expanded;
		}
	};

	if ( !rmargin.test( prefix ) ) {
		jQuery.cssHooks[ prefix + suffix ].set = setPositiveNumber;
	}
} );

jQuery.fn.extend( {
	css: function( name, value ) {
		return access( this, function( elem, name, value ) {
			var styles, len,
				map = {},
				i = 0;

			if ( jQuery.isArray( name ) ) {
				styles = getStyles( elem );
				len = name.length;

				for ( ; i < len; i++ ) {
					map[ name[ i ] ] = jQuery.css( elem, name[ i ], false, styles );
				}

				return map;
			}

			return value !== undefined ?
				jQuery.style( elem, name, value ) :
				jQuery.css( elem, name );
		}, name, value, arguments.length > 1 );
	},
	show: function() {
		return showHide( this, true );
	},
	hide: function() {
		return showHide( this );
	},
	toggle: function( state ) {
		if ( typeof state === "boolean" ) {
			return state ? this.show() : this.hide();
		}

		return this.each( function() {
			if ( isHidden( this ) ) {
				jQuery( this ).show();
			} else {
				jQuery( this ).hide();
			}
		} );
	}
} );


function Tween( elem, options, prop, end, easing ) {
	return new Tween.prototype.init( elem, options, prop, end, easing );
}
jQuery.Tween = Tween;

Tween.prototype = {
	constructor: Tween,
	init: function( elem, options, prop, end, easing, unit ) {
		this.elem = elem;
		this.prop = prop;
		this.easing = easing || jQuery.easing._default;
		this.options = options;
		this.start = this.now = this.cur();
		this.end = end;
		this.unit = unit || ( jQuery.cssNumber[ prop ] ? "" : "px" );
	},
	cur: function() {
		var hooks = Tween.propHooks[ this.prop ];

		return hooks && hooks.get ?
			hooks.get( this ) :
			Tween.propHooks._default.get( this );
	},
	run: function( percent ) {
		var eased,
			hooks = Tween.propHooks[ this.prop ];

		if ( this.options.duration ) {
			this.pos = eased = jQuery.easing[ this.easing ](
				percent, this.options.duration * percent, 0, 1, this.options.duration
			);
		} else {
			this.pos = eased = percent;
		}
		this.now = ( this.end - this.start ) * eased + this.start;

		if ( this.options.step ) {
			this.options.step.call( this.elem, this.now, this );
		}

		if ( hooks && hooks.set ) {
			hooks.set( this );
		} else {
			Tween.propHooks._default.set( this );
		}
		return this;
	}
};

Tween.prototype.init.prototype = Tween.prototype;

Tween.propHooks = {
	_default: {
		get: function( tween ) {
			var result;

			// Use a property on the element directly when it is not a DOM element,
			// or when there is no matching style property that exists.
			if ( tween.elem.nodeType !== 1 ||
				tween.elem[ tween.prop ] != null && tween.elem.style[ tween.prop ] == null ) {
				return tween.elem[ tween.prop ];
			}

			// Passing an empty string as a 3rd parameter to .css will automatically
			// attempt a parseFloat and fallback to a string if the parse fails.
			// Simple values such as "10px" are parsed to Float;
			// complex values such as "rotate(1rad)" are returned as-is.
			result = jQuery.css( tween.elem, tween.prop, "" );

			// Empty strings, null, undefined and "auto" are converted to 0.
			return !result || result === "auto" ? 0 : result;
		},
		set: function( tween ) {

			// Use step hook for back compat.
			// Use cssHook if its there.
			// Use .style if available and use plain properties where available.
			if ( jQuery.fx.step[ tween.prop ] ) {
				jQuery.fx.step[ tween.prop ]( tween );
			} else if ( tween.elem.nodeType === 1 &&
				( tween.elem.style[ jQuery.cssProps[ tween.prop ] ] != null ||
					jQuery.cssHooks[ tween.prop ] ) ) {
				jQuery.style( tween.elem, tween.prop, tween.now + tween.unit );
			} else {
				tween.elem[ tween.prop ] = tween.now;
			}
		}
	}
};

// Support: IE9
// Panic based approach to setting things on disconnected nodes
Tween.propHooks.scrollTop = Tween.propHooks.scrollLeft = {
	set: function( tween ) {
		if ( tween.elem.nodeType && tween.elem.parentNode ) {
			tween.elem[ tween.prop ] = tween.now;
		}
	}
};

jQuery.easing = {
	linear: function( p ) {
		return p;
	},
	swing: function( p ) {
		return 0.5 - Math.cos( p * Math.PI ) / 2;
	},
	_default: "swing"
};

jQuery.fx = Tween.prototype.init;

// Back Compat <1.8 extension point
jQuery.fx.step = {};




var
	fxNow, timerId,
	rfxtypes = /^(?:toggle|show|hide)$/,
	rrun = /queueHooks$/;

// Animations created synchronously will run synchronously
function createFxNow() {
	window.setTimeout( function() {
		fxNow = undefined;
	} );
	return ( fxNow = jQuery.now() );
}

// Generate parameters to create a standard animation
function genFx( type, includeWidth ) {
	var which,
		i = 0,
		attrs = { height: type };

	// If we include width, step value is 1 to do all cssExpand values,
	// otherwise step value is 2 to skip over Left and Right
	includeWidth = includeWidth ? 1 : 0;
	for ( ; i < 4 ; i += 2 - includeWidth ) {
		which = cssExpand[ i ];
		attrs[ "margin" + which ] = attrs[ "padding" + which ] = type;
	}

	if ( includeWidth ) {
		attrs.opacity = attrs.width = type;
	}

	return attrs;
}

function createTween( value, prop, animation ) {
	var tween,
		collection = ( Animation.tweeners[ prop ] || [] ).concat( Animation.tweeners[ "*" ] ),
		index = 0,
		length = collection.length;
	for ( ; index < length; index++ ) {
		if ( ( tween = collection[ index ].call( animation, prop, value ) ) ) {

			// We're done with this property
			return tween;
		}
	}
}

function defaultPrefilter( elem, props, opts ) {
	/* jshint validthis: true */
	var prop, value, toggle, tween, hooks, oldfire, display, checkDisplay,
		anim = this,
		orig = {},
		style = elem.style,
		hidden = elem.nodeType && isHidden( elem ),
		dataShow = dataPriv.get( elem, "fxshow" );

	// Handle queue: false promises
	if ( !opts.queue ) {
		hooks = jQuery._queueHooks( elem, "fx" );
		if ( hooks.unqueued == null ) {
			hooks.unqueued = 0;
			oldfire = hooks.empty.fire;
			hooks.empty.fire = function() {
				if ( !hooks.unqueued ) {
					oldfire();
				}
			};
		}
		hooks.unqueued++;

		anim.always( function() {

			// Ensure the complete handler is called before this completes
			anim.always( function() {
				hooks.unqueued--;
				if ( !jQuery.queue( elem, "fx" ).length ) {
					hooks.empty.fire();
				}
			} );
		} );
	}

	// Height/width overflow pass
	if ( elem.nodeType === 1 && ( "height" in props || "width" in props ) ) {

		// Make sure that nothing sneaks out
		// Record all 3 overflow attributes because IE9-10 do not
		// change the overflow attribute when overflowX and
		// overflowY are set to the same value
		opts.overflow = [ style.overflow, style.overflowX, style.overflowY ];

		// Set display property to inline-block for height/width
		// animations on inline elements that are having width/height animated
		display = jQuery.css( elem, "display" );

		// Test default display if display is currently "none"
		checkDisplay = display === "none" ?
			dataPriv.get( elem, "olddisplay" ) || defaultDisplay( elem.nodeName ) : display;

		if ( checkDisplay === "inline" && jQuery.css( elem, "float" ) === "none" ) {
			style.display = "inline-block";
		}
	}

	if ( opts.overflow ) {
		style.overflow = "hidden";
		anim.always( function() {
			style.overflow = opts.overflow[ 0 ];
			style.overflowX = opts.overflow[ 1 ];
			style.overflowY = opts.overflow[ 2 ];
		} );
	}

	// show/hide pass
	for ( prop in props ) {
		value = props[ prop ];
		if ( rfxtypes.exec( value ) ) {
			delete props[ prop ];
			toggle = toggle || value === "toggle";
			if ( value === ( hidden ? "hide" : "show" ) ) {

				// If there is dataShow left over from a stopped hide or show
				// and we are going to proceed with show, we should pretend to be hidden
				if ( value === "show" && dataShow && dataShow[ prop ] !== undefined ) {
					hidden = true;
				} else {
					continue;
				}
			}
			orig[ prop ] = dataShow && dataShow[ prop ] || jQuery.style( elem, prop );

		// Any non-fx value stops us from restoring the original display value
		} else {
			display = undefined;
		}
	}

	if ( !jQuery.isEmptyObject( orig ) ) {
		if ( dataShow ) {
			if ( "hidden" in dataShow ) {
				hidden = dataShow.hidden;
			}
		} else {
			dataShow = dataPriv.access( elem, "fxshow", {} );
		}

		// Store state if its toggle - enables .stop().toggle() to "reverse"
		if ( toggle ) {
			dataShow.hidden = !hidden;
		}
		if ( hidden ) {
			jQuery( elem ).show();
		} else {
			anim.done( function() {
				jQuery( elem ).hide();
			} );
		}
		anim.done( function() {
			var prop;

			dataPriv.remove( elem, "fxshow" );
			for ( prop in orig ) {
				jQuery.style( elem, prop, orig[ prop ] );
			}
		} );
		for ( prop in orig ) {
			tween = createTween( hidden ? dataShow[ prop ] : 0, prop, anim );

			if ( !( prop in dataShow ) ) {
				dataShow[ prop ] = tween.start;
				if ( hidden ) {
					tween.end = tween.start;
					tween.start = prop === "width" || prop === "height" ? 1 : 0;
				}
			}
		}

	// If this is a noop like .hide().hide(), restore an overwritten display value
	} else if ( ( display === "none" ? defaultDisplay( elem.nodeName ) : display ) === "inline" ) {
		style.display = display;
	}
}

function propFilter( props, specialEasing ) {
	var index, name, easing, value, hooks;

	// camelCase, specialEasing and expand cssHook pass
	for ( index in props ) {
		name = jQuery.camelCase( index );
		easing = specialEasing[ name ];
		value = props[ index ];
		if ( jQuery.isArray( value ) ) {
			easing = value[ 1 ];
			value = props[ index ] = value[ 0 ];
		}

		if ( index !== name ) {
			props[ name ] = value;
			delete props[ index ];
		}

		hooks = jQuery.cssHooks[ name ];
		if ( hooks && "expand" in hooks ) {
			value = hooks.expand( value );
			delete props[ name ];

			// Not quite $.extend, this won't overwrite existing keys.
			// Reusing 'index' because we have the correct "name"
			for ( index in value ) {
				if ( !( index in props ) ) {
					props[ index ] = value[ index ];
					specialEasing[ index ] = easing;
				}
			}
		} else {
			specialEasing[ name ] = easing;
		}
	}
}

function Animation( elem, properties, options ) {
	var result,
		stopped,
		index = 0,
		length = Animation.prefilters.length,
		deferred = jQuery.Deferred().always( function() {

			// Don't match elem in the :animated selector
			delete tick.elem;
		} ),
		tick = function() {
			if ( stopped ) {
				return false;
			}
			var currentTime = fxNow || createFxNow(),
				remaining = Math.max( 0, animation.startTime + animation.duration - currentTime ),

				// Support: Android 2.3
				// Archaic crash bug won't allow us to use `1 - ( 0.5 || 0 )` (#12497)
				temp = remaining / animation.duration || 0,
				percent = 1 - temp,
				index = 0,
				length = animation.tweens.length;

			for ( ; index < length ; index++ ) {
				animation.tweens[ index ].run( percent );
			}

			deferred.notifyWith( elem, [ animation, percent, remaining ] );

			if ( percent < 1 && length ) {
				return remaining;
			} else {
				deferred.resolveWith( elem, [ animation ] );
				return false;
			}
		},
		animation = deferred.promise( {
			elem: elem,
			props: jQuery.extend( {}, properties ),
			opts: jQuery.extend( true, {
				specialEasing: {},
				easing: jQuery.easing._default
			}, options ),
			originalProperties: properties,
			originalOptions: options,
			startTime: fxNow || createFxNow(),
			duration: options.duration,
			tweens: [],
			createTween: function( prop, end ) {
				var tween = jQuery.Tween( elem, animation.opts, prop, end,
						animation.opts.specialEasing[ prop ] || animation.opts.easing );
				animation.tweens.push( tween );
				return tween;
			},
			stop: function( gotoEnd ) {
				var index = 0,

					// If we are going to the end, we want to run all the tweens
					// otherwise we skip this part
					length = gotoEnd ? animation.tweens.length : 0;
				if ( stopped ) {
					return this;
				}
				stopped = true;
				for ( ; index < length ; index++ ) {
					animation.tweens[ index ].run( 1 );
				}

				// Resolve when we played the last frame; otherwise, reject
				if ( gotoEnd ) {
					deferred.notifyWith( elem, [ animation, 1, 0 ] );
					deferred.resolveWith( elem, [ animation, gotoEnd ] );
				} else {
					deferred.rejectWith( elem, [ animation, gotoEnd ] );
				}
				return this;
			}
		} ),
		props = animation.props;

	propFilter( props, animation.opts.specialEasing );

	for ( ; index < length ; index++ ) {
		result = Animation.prefilters[ index ].call( animation, elem, props, animation.opts );
		if ( result ) {
			if ( jQuery.isFunction( result.stop ) ) {
				jQuery._queueHooks( animation.elem, animation.opts.queue ).stop =
					jQuery.proxy( result.stop, result );
			}
			return result;
		}
	}

	jQuery.map( props, createTween, animation );

	if ( jQuery.isFunction( animation.opts.start ) ) {
		animation.opts.start.call( elem, animation );
	}

	jQuery.fx.timer(
		jQuery.extend( tick, {
			elem: elem,
			anim: animation,
			queue: animation.opts.queue
		} )
	);

	// attach callbacks from options
	return animation.progress( animation.opts.progress )
		.done( animation.opts.done, animation.opts.complete )
		.fail( animation.opts.fail )
		.always( animation.opts.always );
}

jQuery.Animation = jQuery.extend( Animation, {
	tweeners: {
		"*": [ function( prop, value ) {
			var tween = this.createTween( prop, value );
			adjustCSS( tween.elem, prop, rcssNum.exec( value ), tween );
			return tween;
		} ]
	},

	tweener: function( props, callback ) {
		if ( jQuery.isFunction( props ) ) {
			callback = props;
			props = [ "*" ];
		} else {
			props = props.match( rnotwhite );
		}

		var prop,
			index = 0,
			length = props.length;

		for ( ; index < length ; index++ ) {
			prop = props[ index ];
			Animation.tweeners[ prop ] = Animation.tweeners[ prop ] || [];
			Animation.tweeners[ prop ].unshift( callback );
		}
	},

	prefilters: [ defaultPrefilter ],

	prefilter: function( callback, prepend ) {
		if ( prepend ) {
			Animation.prefilters.unshift( callback );
		} else {
			Animation.prefilters.push( callback );
		}
	}
} );

jQuery.speed = function( speed, easing, fn ) {
	var opt = speed && typeof speed === "object" ? jQuery.extend( {}, speed ) : {
		complete: fn || !fn && easing ||
			jQuery.isFunction( speed ) && speed,
		duration: speed,
		easing: fn && easing || easing && !jQuery.isFunction( easing ) && easing
	};

	opt.duration = jQuery.fx.off ? 0 : typeof opt.duration === "number" ?
		opt.duration : opt.duration in jQuery.fx.speeds ?
			jQuery.fx.speeds[ opt.duration ] : jQuery.fx.speeds._default;

	// Normalize opt.queue - true/undefined/null -> "fx"
	if ( opt.queue == null || opt.queue === true ) {
		opt.queue = "fx";
	}

	// Queueing
	opt.old = opt.complete;

	opt.complete = function() {
		if ( jQuery.isFunction( opt.old ) ) {
			opt.old.call( this );
		}

		if ( opt.queue ) {
			jQuery.dequeue( this, opt.queue );
		}
	};

	return opt;
};

jQuery.fn.extend( {
	fadeTo: function( speed, to, easing, callback ) {

		// Show any hidden elements after setting opacity to 0
		return this.filter( isHidden ).css( "opacity", 0 ).show()

			// Animate to the value specified
			.end().animate( { opacity: to }, speed, easing, callback );
	},
	animate: function( prop, speed, easing, callback ) {
		var empty = jQuery.isEmptyObject( prop ),
			optall = jQuery.speed( speed, easing, callback ),
			doAnimation = function() {

				// Operate on a copy of prop so per-property easing won't be lost
				var anim = Animation( this, jQuery.extend( {}, prop ), optall );

				// Empty animations, or finishing resolves immediately
				if ( empty || dataPriv.get( this, "finish" ) ) {
					anim.stop( true );
				}
			};
			doAnimation.finish = doAnimation;

		return empty || optall.queue === false ?
			this.each( doAnimation ) :
			this.queue( optall.queue, doAnimation );
	},
	stop: function( type, clearQueue, gotoEnd ) {
		var stopQueue = function( hooks ) {
			var stop = hooks.stop;
			delete hooks.stop;
			stop( gotoEnd );
		};

		if ( typeof type !== "string" ) {
			gotoEnd = clearQueue;
			clearQueue = type;
			type = undefined;
		}
		if ( clearQueue && type !== false ) {
			this.queue( type || "fx", [] );
		}

		return this.each( function() {
			var dequeue = true,
				index = type != null && type + "queueHooks",
				timers = jQuery.timers,
				data = dataPriv.get( this );

			if ( index ) {
				if ( data[ index ] && data[ index ].stop ) {
					stopQueue( data[ index ] );
				}
			} else {
				for ( index in data ) {
					if ( data[ index ] && data[ index ].stop && rrun.test( index ) ) {
						stopQueue( data[ index ] );
					}
				}
			}

			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this &&
					( type == null || timers[ index ].queue === type ) ) {

					timers[ index ].anim.stop( gotoEnd );
					dequeue = false;
					timers.splice( index, 1 );
				}
			}

			// Start the next in the queue if the last step wasn't forced.
			// Timers currently will call their complete callbacks, which
			// will dequeue but only if they were gotoEnd.
			if ( dequeue || !gotoEnd ) {
				jQuery.dequeue( this, type );
			}
		} );
	},
	finish: function( type ) {
		if ( type !== false ) {
			type = type || "fx";
		}
		return this.each( function() {
			var index,
				data = dataPriv.get( this ),
				queue = data[ type + "queue" ],
				hooks = data[ type + "queueHooks" ],
				timers = jQuery.timers,
				length = queue ? queue.length : 0;

			// Enable finishing flag on private data
			data.finish = true;

			// Empty the queue first
			jQuery.queue( this, type, [] );

			if ( hooks && hooks.stop ) {
				hooks.stop.call( this, true );
			}

			// Look for any active animations, and finish them
			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this && timers[ index ].queue === type ) {
					timers[ index ].anim.stop( true );
					timers.splice( index, 1 );
				}
			}

			// Look for any animations in the old queue and finish them
			for ( index = 0; index < length; index++ ) {
				if ( queue[ index ] && queue[ index ].finish ) {
					queue[ index ].finish.call( this );
				}
			}

			// Turn off finishing flag
			delete data.finish;
		} );
	}
} );

jQuery.each( [ "toggle", "show", "hide" ], function( i, name ) {
	var cssFn = jQuery.fn[ name ];
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return speed == null || typeof speed === "boolean" ?
			cssFn.apply( this, arguments ) :
			this.animate( genFx( name, true ), speed, easing, callback );
	};
} );

// Generate shortcuts for custom animations
jQuery.each( {
	slideDown: genFx( "show" ),
	slideUp: genFx( "hide" ),
	slideToggle: genFx( "toggle" ),
	fadeIn: { opacity: "show" },
	fadeOut: { opacity: "hide" },
	fadeToggle: { opacity: "toggle" }
}, function( name, props ) {
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return this.animate( props, speed, easing, callback );
	};
} );

jQuery.timers = [];
jQuery.fx.tick = function() {
	var timer,
		i = 0,
		timers = jQuery.timers;

	fxNow = jQuery.now();

	for ( ; i < timers.length; i++ ) {
		timer = timers[ i ];

		// Checks the timer has not already been removed
		if ( !timer() && timers[ i ] === timer ) {
			timers.splice( i--, 1 );
		}
	}

	if ( !timers.length ) {
		jQuery.fx.stop();
	}
	fxNow = undefined;
};

jQuery.fx.timer = function( timer ) {
	jQuery.timers.push( timer );
	if ( timer() ) {
		jQuery.fx.start();
	} else {
		jQuery.timers.pop();
	}
};

jQuery.fx.interval = 13;
jQuery.fx.start = function() {
	if ( !timerId ) {
		timerId = window.setInterval( jQuery.fx.tick, jQuery.fx.interval );
	}
};

jQuery.fx.stop = function() {
	window.clearInterval( timerId );

	timerId = null;
};

jQuery.fx.speeds = {
	slow: 600,
	fast: 200,

	// Default speed
	_default: 400
};


// Based off of the plugin by Clint Helfers, with permission.
// http://web.archive.org/web/20100324014747/http://blindsignals.com/index.php/2009/07/jquery-delay/
jQuery.fn.delay = function( time, type ) {
	time = jQuery.fx ? jQuery.fx.speeds[ time ] || time : time;
	type = type || "fx";

	return this.queue( type, function( next, hooks ) {
		var timeout = window.setTimeout( next, time );
		hooks.stop = function() {
			window.clearTimeout( timeout );
		};
	} );
};


( function() {
	var input = document.createElement( "input" ),
		select = document.createElement( "select" ),
		opt = select.appendChild( document.createElement( "option" ) );

	input.type = "checkbox";

	// Support: iOS<=5.1, Android<=4.2+
	// Default value for a checkbox should be "on"
	support.checkOn = input.value !== "";

	// Support: IE<=11+
	// Must access selectedIndex to make default options select
	support.optSelected = opt.selected;

	// Support: Android<=2.3
	// Options inside disabled selects are incorrectly marked as disabled
	select.disabled = true;
	support.optDisabled = !opt.disabled;

	// Support: IE<=11+
	// An input loses its value after becoming a radio
	input = document.createElement( "input" );
	input.value = "t";
	input.type = "radio";
	support.radioValue = input.value === "t";
} )();


var boolHook,
	attrHandle = jQuery.expr.attrHandle;

jQuery.fn.extend( {
	attr: function( name, value ) {
		return access( this, jQuery.attr, name, value, arguments.length > 1 );
	},

	removeAttr: function( name ) {
		return this.each( function() {
			jQuery.removeAttr( this, name );
		} );
	}
} );

jQuery.extend( {
	attr: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set attributes on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		// Fallback to prop when attributes are not supported
		if ( typeof elem.getAttribute === "undefined" ) {
			return jQuery.prop( elem, name, value );
		}

		// All attributes are lowercase
		// Grab necessary hook if one is defined
		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {
			name = name.toLowerCase();
			hooks = jQuery.attrHooks[ name ] ||
				( jQuery.expr.match.bool.test( name ) ? boolHook : undefined );
		}

		if ( value !== undefined ) {
			if ( value === null ) {
				jQuery.removeAttr( elem, name );
				return;
			}

			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			elem.setAttribute( name, value + "" );
			return value;
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		ret = jQuery.find.attr( elem, name );

		// Non-existent attributes return null, we normalize to undefined
		return ret == null ? undefined : ret;
	},

	attrHooks: {
		type: {
			set: function( elem, value ) {
				if ( !support.radioValue && value === "radio" &&
					jQuery.nodeName( elem, "input" ) ) {
					var val = elem.value;
					elem.setAttribute( "type", value );
					if ( val ) {
						elem.value = val;
					}
					return value;
				}
			}
		}
	},

	removeAttr: function( elem, value ) {
		var name, propName,
			i = 0,
			attrNames = value && value.match( rnotwhite );

		if ( attrNames && elem.nodeType === 1 ) {
			while ( ( name = attrNames[ i++ ] ) ) {
				propName = jQuery.propFix[ name ] || name;

				// Boolean attributes get special treatment (#10870)
				if ( jQuery.expr.match.bool.test( name ) ) {

					// Set corresponding property to false
					elem[ propName ] = false;
				}

				elem.removeAttribute( name );
			}
		}
	}
} );

// Hooks for boolean attributes
boolHook = {
	set: function( elem, value, name ) {
		if ( value === false ) {

			// Remove boolean attributes when set to false
			jQuery.removeAttr( elem, name );
		} else {
			elem.setAttribute( name, name );
		}
		return name;
	}
};
jQuery.each( jQuery.expr.match.bool.source.match( /\w+/g ), function( i, name ) {
	var getter = attrHandle[ name ] || jQuery.find.attr;

	attrHandle[ name ] = function( elem, name, isXML ) {
		var ret, handle;
		if ( !isXML ) {

			// Avoid an infinite loop by temporarily removing this function from the getter
			handle = attrHandle[ name ];
			attrHandle[ name ] = ret;
			ret = getter( elem, name, isXML ) != null ?
				name.toLowerCase() :
				null;
			attrHandle[ name ] = handle;
		}
		return ret;
	};
} );




var rfocusable = /^(?:input|select|textarea|button)$/i,
	rclickable = /^(?:a|area)$/i;

jQuery.fn.extend( {
	prop: function( name, value ) {
		return access( this, jQuery.prop, name, value, arguments.length > 1 );
	},

	removeProp: function( name ) {
		return this.each( function() {
			delete this[ jQuery.propFix[ name ] || name ];
		} );
	}
} );

jQuery.extend( {
	prop: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set properties on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {

			// Fix name and attach hooks
			name = jQuery.propFix[ name ] || name;
			hooks = jQuery.propHooks[ name ];
		}

		if ( value !== undefined ) {
			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			return ( elem[ name ] = value );
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		return elem[ name ];
	},

	propHooks: {
		tabIndex: {
			get: function( elem ) {

				// elem.tabIndex doesn't always return the
				// correct value when it hasn't been explicitly set
				// http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
				// Use proper attribute retrieval(#12072)
				var tabindex = jQuery.find.attr( elem, "tabindex" );

				return tabindex ?
					parseInt( tabindex, 10 ) :
					rfocusable.test( elem.nodeName ) ||
						rclickable.test( elem.nodeName ) && elem.href ?
							0 :
							-1;
			}
		}
	},

	propFix: {
		"for": "htmlFor",
		"class": "className"
	}
} );

// Support: IE <=11 only
// Accessing the selectedIndex property
// forces the browser to respect setting selected
// on the option
// The getter ensures a default option is selected
// when in an optgroup
if ( !support.optSelected ) {
	jQuery.propHooks.selected = {
		get: function( elem ) {
			var parent = elem.parentNode;
			if ( parent && parent.parentNode ) {
				parent.parentNode.selectedIndex;
			}
			return null;
		},
		set: function( elem ) {
			var parent = elem.parentNode;
			if ( parent ) {
				parent.selectedIndex;

				if ( parent.parentNode ) {
					parent.parentNode.selectedIndex;
				}
			}
		}
	};
}

jQuery.each( [
	"tabIndex",
	"readOnly",
	"maxLength",
	"cellSpacing",
	"cellPadding",
	"rowSpan",
	"colSpan",
	"useMap",
	"frameBorder",
	"contentEditable"
], function() {
	jQuery.propFix[ this.toLowerCase() ] = this;
} );




var rclass = /[\t\r\n\f]/g;

function getClass( elem ) {
	return elem.getAttribute && elem.getAttribute( "class" ) || "";
}

jQuery.fn.extend( {
	addClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( jQuery.isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).addClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		if ( typeof value === "string" && value ) {
			classes = value.match( rnotwhite ) || [];

			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );
				cur = elem.nodeType === 1 &&
					( " " + curValue + " " ).replace( rclass, " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {
						if ( cur.indexOf( " " + clazz + " " ) < 0 ) {
							cur += clazz + " ";
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = jQuery.trim( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	removeClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( jQuery.isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).removeClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		if ( !arguments.length ) {
			return this.attr( "class", "" );
		}

		if ( typeof value === "string" && value ) {
			classes = value.match( rnotwhite ) || [];

			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );

				// This expression is here for better compressibility (see addClass)
				cur = elem.nodeType === 1 &&
					( " " + curValue + " " ).replace( rclass, " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {

						// Remove *all* instances
						while ( cur.indexOf( " " + clazz + " " ) > -1 ) {
							cur = cur.replace( " " + clazz + " ", " " );
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = jQuery.trim( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	toggleClass: function( value, stateVal ) {
		var type = typeof value;

		if ( typeof stateVal === "boolean" && type === "string" ) {
			return stateVal ? this.addClass( value ) : this.removeClass( value );
		}

		if ( jQuery.isFunction( value ) ) {
			return this.each( function( i ) {
				jQuery( this ).toggleClass(
					value.call( this, i, getClass( this ), stateVal ),
					stateVal
				);
			} );
		}

		return this.each( function() {
			var className, i, self, classNames;

			if ( type === "string" ) {

				// Toggle individual class names
				i = 0;
				self = jQuery( this );
				classNames = value.match( rnotwhite ) || [];

				while ( ( className = classNames[ i++ ] ) ) {

					// Check each className given, space separated list
					if ( self.hasClass( className ) ) {
						self.removeClass( className );
					} else {
						self.addClass( className );
					}
				}

			// Toggle whole class name
			} else if ( value === undefined || type === "boolean" ) {
				className = getClass( this );
				if ( className ) {

					// Store className if set
					dataPriv.set( this, "__className__", className );
				}

				// If the element has a class name or if we're passed `false`,
				// then remove the whole classname (if there was one, the above saved it).
				// Otherwise bring back whatever was previously saved (if anything),
				// falling back to the empty string if nothing was stored.
				if ( this.setAttribute ) {
					this.setAttribute( "class",
						className || value === false ?
						"" :
						dataPriv.get( this, "__className__" ) || ""
					);
				}
			}
		} );
	},

	hasClass: function( selector ) {
		var className, elem,
			i = 0;

		className = " " + selector + " ";
		while ( ( elem = this[ i++ ] ) ) {
			if ( elem.nodeType === 1 &&
				( " " + getClass( elem ) + " " ).replace( rclass, " " )
					.indexOf( className ) > -1
			) {
				return true;
			}
		}

		return false;
	}
} );




var rreturn = /\r/g,
	rspaces = /[\x20\t\r\n\f]+/g;

jQuery.fn.extend( {
	val: function( value ) {
		var hooks, ret, isFunction,
			elem = this[ 0 ];

		if ( !arguments.length ) {
			if ( elem ) {
				hooks = jQuery.valHooks[ elem.type ] ||
					jQuery.valHooks[ elem.nodeName.toLowerCase() ];

				if ( hooks &&
					"get" in hooks &&
					( ret = hooks.get( elem, "value" ) ) !== undefined
				) {
					return ret;
				}

				ret = elem.value;

				return typeof ret === "string" ?

					// Handle most common string cases
					ret.replace( rreturn, "" ) :

					// Handle cases where value is null/undef or number
					ret == null ? "" : ret;
			}

			return;
		}

		isFunction = jQuery.isFunction( value );

		return this.each( function( i ) {
			var val;

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( isFunction ) {
				val = value.call( this, i, jQuery( this ).val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to string
			if ( val == null ) {
				val = "";

			} else if ( typeof val === "number" ) {
				val += "";

			} else if ( jQuery.isArray( val ) ) {
				val = jQuery.map( val, function( value ) {
					return value == null ? "" : value + "";
				} );
			}

			hooks = jQuery.valHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

			// If set returns undefined, fall back to normal setting
			if ( !hooks || !( "set" in hooks ) || hooks.set( this, val, "value" ) === undefined ) {
				this.value = val;
			}
		} );
	}
} );

jQuery.extend( {
	valHooks: {
		option: {
			get: function( elem ) {

				var val = jQuery.find.attr( elem, "value" );
				return val != null ?
					val :

					// Support: IE10-11+
					// option.text throws exceptions (#14686, #14858)
					// Strip and collapse whitespace
					// https://html.spec.whatwg.org/#strip-and-collapse-whitespace
					jQuery.trim( jQuery.text( elem ) ).replace( rspaces, " " );
			}
		},
		select: {
			get: function( elem ) {
				var value, option,
					options = elem.options,
					index = elem.selectedIndex,
					one = elem.type === "select-one" || index < 0,
					values = one ? null : [],
					max = one ? index + 1 : options.length,
					i = index < 0 ?
						max :
						one ? index : 0;

				// Loop through all the selected options
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// IE8-9 doesn't update selected after form reset (#2551)
					if ( ( option.selected || i === index ) &&

							// Don't return options that are disabled or in a disabled optgroup
							( support.optDisabled ?
								!option.disabled : option.getAttribute( "disabled" ) === null ) &&
							( !option.parentNode.disabled ||
								!jQuery.nodeName( option.parentNode, "optgroup" ) ) ) {

						// Get the specific value for the option
						value = jQuery( option ).val();

						// We don't need an array for one selects
						if ( one ) {
							return value;
						}

						// Multi-Selects return an array
						values.push( value );
					}
				}

				return values;
			},

			set: function( elem, value ) {
				var optionSet, option,
					options = elem.options,
					values = jQuery.makeArray( value ),
					i = options.length;

				while ( i-- ) {
					option = options[ i ];
					if ( option.selected =
						jQuery.inArray( jQuery.valHooks.option.get( option ), values ) > -1
					) {
						optionSet = true;
					}
				}

				// Force browsers to behave consistently when non-matching value is set
				if ( !optionSet ) {
					elem.selectedIndex = -1;
				}
				return values;
			}
		}
	}
} );

// Radios and checkboxes getter/setter
jQuery.each( [ "radio", "checkbox" ], function() {
	jQuery.valHooks[ this ] = {
		set: function( elem, value ) {
			if ( jQuery.isArray( value ) ) {
				return ( elem.checked = jQuery.inArray( jQuery( elem ).val(), value ) > -1 );
			}
		}
	};
	if ( !support.checkOn ) {
		jQuery.valHooks[ this ].get = function( elem ) {
			return elem.getAttribute( "value" ) === null ? "on" : elem.value;
		};
	}
} );




// Return jQuery for attributes-only inclusion


var rfocusMorph = /^(?:focusinfocus|focusoutblur)$/;

jQuery.extend( jQuery.event, {

	trigger: function( event, data, elem, onlyHandlers ) {

		var i, cur, tmp, bubbleType, ontype, handle, special,
			eventPath = [ elem || document ],
			type = hasOwn.call( event, "type" ) ? event.type : event,
			namespaces = hasOwn.call( event, "namespace" ) ? event.namespace.split( "." ) : [];

		cur = tmp = elem = elem || document;

		// Don't do events on text and comment nodes
		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
			return;
		}

		// focus/blur morphs to focusin/out; ensure we're not firing them right now
		if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
			return;
		}

		if ( type.indexOf( "." ) > -1 ) {

			// Namespaced trigger; create a regexp to match event type in handle()
			namespaces = type.split( "." );
			type = namespaces.shift();
			namespaces.sort();
		}
		ontype = type.indexOf( ":" ) < 0 && "on" + type;

		// Caller can pass in a jQuery.Event object, Object, or just an event type string
		event = event[ jQuery.expando ] ?
			event :
			new jQuery.Event( type, typeof event === "object" && event );

		// Trigger bitmask: & 1 for native handlers; & 2 for jQuery (always true)
		event.isTrigger = onlyHandlers ? 2 : 3;
		event.namespace = namespaces.join( "." );
		event.rnamespace = event.namespace ?
			new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" ) :
			null;

		// Clean up the event in case it is being reused
		event.result = undefined;
		if ( !event.target ) {
			event.target = elem;
		}

		// Clone any incoming data and prepend the event, creating the handler arg list
		data = data == null ?
			[ event ] :
			jQuery.makeArray( data, [ event ] );

		// Allow special events to draw outside the lines
		special = jQuery.event.special[ type ] || {};
		if ( !onlyHandlers && special.trigger && special.trigger.apply( elem, data ) === false ) {
			return;
		}

		// Determine event propagation path in advance, per W3C events spec (#9951)
		// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
		if ( !onlyHandlers && !special.noBubble && !jQuery.isWindow( elem ) ) {

			bubbleType = special.delegateType || type;
			if ( !rfocusMorph.test( bubbleType + type ) ) {
				cur = cur.parentNode;
			}
			for ( ; cur; cur = cur.parentNode ) {
				eventPath.push( cur );
				tmp = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( tmp === ( elem.ownerDocument || document ) ) {
				eventPath.push( tmp.defaultView || tmp.parentWindow || window );
			}
		}

		// Fire handlers on the event path
		i = 0;
		while ( ( cur = eventPath[ i++ ] ) && !event.isPropagationStopped() ) {

			event.type = i > 1 ?
				bubbleType :
				special.bindType || type;

			// jQuery handler
			handle = ( dataPriv.get( cur, "events" ) || {} )[ event.type ] &&
				dataPriv.get( cur, "handle" );
			if ( handle ) {
				handle.apply( cur, data );
			}

			// Native handler
			handle = ontype && cur[ ontype ];
			if ( handle && handle.apply && acceptData( cur ) ) {
				event.result = handle.apply( cur, data );
				if ( event.result === false ) {
					event.preventDefault();
				}
			}
		}
		event.type = type;

		// If nobody prevented the default action, do it now
		if ( !onlyHandlers && !event.isDefaultPrevented() ) {

			if ( ( !special._default ||
				special._default.apply( eventPath.pop(), data ) === false ) &&
				acceptData( elem ) ) {

				// Call a native DOM method on the target with the same name name as the event.
				// Don't do default actions on window, that's where global variables be (#6170)
				if ( ontype && jQuery.isFunction( elem[ type ] ) && !jQuery.isWindow( elem ) ) {

					// Don't re-trigger an onFOO event when we call its FOO() method
					tmp = elem[ ontype ];

					if ( tmp ) {
						elem[ ontype ] = null;
					}

					// Prevent re-triggering of the same event, since we already bubbled it above
					jQuery.event.triggered = type;
					elem[ type ]();
					jQuery.event.triggered = undefined;

					if ( tmp ) {
						elem[ ontype ] = tmp;
					}
				}
			}
		}

		return event.result;
	},

	// Piggyback on a donor event to simulate a different one
	// Used only for `focus(in | out)` events
	simulate: function( type, elem, event ) {
		var e = jQuery.extend(
			new jQuery.Event(),
			event,
			{
				type: type,
				isSimulated: true
			}
		);

		jQuery.event.trigger( e, null, elem );
	}

} );

jQuery.fn.extend( {

	trigger: function( type, data ) {
		return this.each( function() {
			jQuery.event.trigger( type, data, this );
		} );
	},
	triggerHandler: function( type, data ) {
		var elem = this[ 0 ];
		if ( elem ) {
			return jQuery.event.trigger( type, data, elem, true );
		}
	}
} );


jQuery.each( ( "blur focus focusin focusout load resize scroll unload click dblclick " +
	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
	"change select submit keydown keypress keyup error contextmenu" ).split( " " ),
	function( i, name ) {

	// Handle event binding
	jQuery.fn[ name ] = function( data, fn ) {
		return arguments.length > 0 ?
			this.on( name, null, data, fn ) :
			this.trigger( name );
	};
} );

jQuery.fn.extend( {
	hover: function( fnOver, fnOut ) {
		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
	}
} );




support.focusin = "onfocusin" in window;


// Support: Firefox
// Firefox doesn't have focus(in | out) events
// Related ticket - https://bugzilla.mozilla.org/show_bug.cgi?id=687787
//
// Support: Chrome, Safari
// focus(in | out) events fire after focus & blur events,
// which is spec violation - http://www.w3.org/TR/DOM-Level-3-Events/#events-focusevent-event-order
// Related ticket - https://code.google.com/p/chromium/issues/detail?id=449857
if ( !support.focusin ) {
	jQuery.each( { focus: "focusin", blur: "focusout" }, function( orig, fix ) {

		// Attach a single capturing handler on the document while someone wants focusin/focusout
		var handler = function( event ) {
			jQuery.event.simulate( fix, event.target, jQuery.event.fix( event ) );
		};

		jQuery.event.special[ fix ] = {
			setup: function() {
				var doc = this.ownerDocument || this,
					attaches = dataPriv.access( doc, fix );

				if ( !attaches ) {
					doc.addEventListener( orig, handler, true );
				}
				dataPriv.access( doc, fix, ( attaches || 0 ) + 1 );
			},
			teardown: function() {
				var doc = this.ownerDocument || this,
					attaches = dataPriv.access( doc, fix ) - 1;

				if ( !attaches ) {
					doc.removeEventListener( orig, handler, true );
					dataPriv.remove( doc, fix );

				} else {
					dataPriv.access( doc, fix, attaches );
				}
			}
		};
	} );
}
var location = window.location;

var nonce = jQuery.now();

var rquery = ( /\?/ );



// Support: Android 2.3
// Workaround failure to string-cast null input
jQuery.parseJSON = function( data ) {
	return JSON.parse( data + "" );
};


// Cross-browser xml parsing
jQuery.parseXML = function( data ) {
	var xml;
	if ( !data || typeof data !== "string" ) {
		return null;
	}

	// Support: IE9
	try {
		xml = ( new window.DOMParser() ).parseFromString( data, "text/xml" );
	} catch ( e ) {
		xml = undefined;
	}

	if ( !xml || xml.getElementsByTagName( "parsererror" ).length ) {
		jQuery.error( "Invalid XML: " + data );
	}
	return xml;
};


var
	rhash = /#.*$/,
	rts = /([?&])_=[^&]*/,
	rheaders = /^(.*?):[ \t]*([^\r\n]*)$/mg,

	// #7653, #8125, #8152: local protocol detection
	rlocalProtocol = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
	rnoContent = /^(?:GET|HEAD)$/,
	rprotocol = /^\/\//,

	/* Prefilters
	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
	 * 2) These are called:
	 *    - BEFORE asking for a transport
	 *    - AFTER param serialization (s.data is a string if s.processData is true)
	 * 3) key is the dataType
	 * 4) the catchall symbol "*" can be used
	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
	 */
	prefilters = {},

	/* Transports bindings
	 * 1) key is the dataType
	 * 2) the catchall symbol "*" can be used
	 * 3) selection will start with transport dataType and THEN go to "*" if needed
	 */
	transports = {},

	// Avoid comment-prolog char sequence (#10098); must appease lint and evade compression
	allTypes = "*/".concat( "*" ),

	// Anchor tag for parsing the document origin
	originAnchor = document.createElement( "a" );
	originAnchor.href = location.href;

// Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
function addToPrefiltersOrTransports( structure ) {

	// dataTypeExpression is optional and defaults to "*"
	return function( dataTypeExpression, func ) {

		if ( typeof dataTypeExpression !== "string" ) {
			func = dataTypeExpression;
			dataTypeExpression = "*";
		}

		var dataType,
			i = 0,
			dataTypes = dataTypeExpression.toLowerCase().match( rnotwhite ) || [];

		if ( jQuery.isFunction( func ) ) {

			// For each dataType in the dataTypeExpression
			while ( ( dataType = dataTypes[ i++ ] ) ) {

				// Prepend if requested
				if ( dataType[ 0 ] === "+" ) {
					dataType = dataType.slice( 1 ) || "*";
					( structure[ dataType ] = structure[ dataType ] || [] ).unshift( func );

				// Otherwise append
				} else {
					( structure[ dataType ] = structure[ dataType ] || [] ).push( func );
				}
			}
		}
	};
}

// Base inspection function for prefilters and transports
function inspectPrefiltersOrTransports( structure, options, originalOptions, jqXHR ) {

	var inspected = {},
		seekingTransport = ( structure === transports );

	function inspect( dataType ) {
		var selected;
		inspected[ dataType ] = true;
		jQuery.each( structure[ dataType ] || [], function( _, prefilterOrFactory ) {
			var dataTypeOrTransport = prefilterOrFactory( options, originalOptions, jqXHR );
			if ( typeof dataTypeOrTransport === "string" &&
				!seekingTransport && !inspected[ dataTypeOrTransport ] ) {

				options.dataTypes.unshift( dataTypeOrTransport );
				inspect( dataTypeOrTransport );
				return false;
			} else if ( seekingTransport ) {
				return !( selected = dataTypeOrTransport );
			}
		} );
		return selected;
	}

	return inspect( options.dataTypes[ 0 ] ) || !inspected[ "*" ] && inspect( "*" );
}

// A special extend for ajax options
// that takes "flat" options (not to be deep extended)
// Fixes #9887
function ajaxExtend( target, src ) {
	var key, deep,
		flatOptions = jQuery.ajaxSettings.flatOptions || {};

	for ( key in src ) {
		if ( src[ key ] !== undefined ) {
			( flatOptions[ key ] ? target : ( deep || ( deep = {} ) ) )[ key ] = src[ key ];
		}
	}
	if ( deep ) {
		jQuery.extend( true, target, deep );
	}

	return target;
}

/* Handles responses to an ajax request:
 * - finds the right dataType (mediates between content-type and expected dataType)
 * - returns the corresponding response
 */
function ajaxHandleResponses( s, jqXHR, responses ) {

	var ct, type, finalDataType, firstDataType,
		contents = s.contents,
		dataTypes = s.dataTypes;

	// Remove auto dataType and get content-type in the process
	while ( dataTypes[ 0 ] === "*" ) {
		dataTypes.shift();
		if ( ct === undefined ) {
			ct = s.mimeType || jqXHR.getResponseHeader( "Content-Type" );
		}
	}

	// Check if we're dealing with a known content-type
	if ( ct ) {
		for ( type in contents ) {
			if ( contents[ type ] && contents[ type ].test( ct ) ) {
				dataTypes.unshift( type );
				break;
			}
		}
	}

	// Check to see if we have a response for the expected dataType
	if ( dataTypes[ 0 ] in responses ) {
		finalDataType = dataTypes[ 0 ];
	} else {

		// Try convertible dataTypes
		for ( type in responses ) {
			if ( !dataTypes[ 0 ] || s.converters[ type + " " + dataTypes[ 0 ] ] ) {
				finalDataType = type;
				break;
			}
			if ( !firstDataType ) {
				firstDataType = type;
			}
		}

		// Or just use first one
		finalDataType = finalDataType || firstDataType;
	}

	// If we found a dataType
	// We add the dataType to the list if needed
	// and return the corresponding response
	if ( finalDataType ) {
		if ( finalDataType !== dataTypes[ 0 ] ) {
			dataTypes.unshift( finalDataType );
		}
		return responses[ finalDataType ];
	}
}

/* Chain conversions given the request and the original response
 * Also sets the responseXXX fields on the jqXHR instance
 */
function ajaxConvert( s, response, jqXHR, isSuccess ) {
	var conv2, current, conv, tmp, prev,
		converters = {},

		// Work with a copy of dataTypes in case we need to modify it for conversion
		dataTypes = s.dataTypes.slice();

	// Create converters map with lowercased keys
	if ( dataTypes[ 1 ] ) {
		for ( conv in s.converters ) {
			converters[ conv.toLowerCase() ] = s.converters[ conv ];
		}
	}

	current = dataTypes.shift();

	// Convert to each sequential dataType
	while ( current ) {

		if ( s.responseFields[ current ] ) {
			jqXHR[ s.responseFields[ current ] ] = response;
		}

		// Apply the dataFilter if provided
		if ( !prev && isSuccess && s.dataFilter ) {
			response = s.dataFilter( response, s.dataType );
		}

		prev = current;
		current = dataTypes.shift();

		if ( current ) {

		// There's only work to do if current dataType is non-auto
			if ( current === "*" ) {

				current = prev;

			// Convert response if prev dataType is non-auto and differs from current
			} else if ( prev !== "*" && prev !== current ) {

				// Seek a direct converter
				conv = converters[ prev + " " + current ] || converters[ "* " + current ];

				// If none found, seek a pair
				if ( !conv ) {
					for ( conv2 in converters ) {

						// If conv2 outputs current
						tmp = conv2.split( " " );
						if ( tmp[ 1 ] === current ) {

							// If prev can be converted to accepted input
							conv = converters[ prev + " " + tmp[ 0 ] ] ||
								converters[ "* " + tmp[ 0 ] ];
							if ( conv ) {

								// Condense equivalence converters
								if ( conv === true ) {
									conv = converters[ conv2 ];

								// Otherwise, insert the intermediate dataType
								} else if ( converters[ conv2 ] !== true ) {
									current = tmp[ 0 ];
									dataTypes.unshift( tmp[ 1 ] );
								}
								break;
							}
						}
					}
				}

				// Apply converter (if not an equivalence)
				if ( conv !== true ) {

					// Unless errors are allowed to bubble, catch and return them
					if ( conv && s.throws ) {
						response = conv( response );
					} else {
						try {
							response = conv( response );
						} catch ( e ) {
							return {
								state: "parsererror",
								error: conv ? e : "No conversion from " + prev + " to " + current
							};
						}
					}
				}
			}
		}
	}

	return { state: "success", data: response };
}

jQuery.extend( {

	// Counter for holding the number of active queries
	active: 0,

	// Last-Modified header cache for next request
	lastModified: {},
	etag: {},

	ajaxSettings: {
		url: location.href,
		type: "GET",
		isLocal: rlocalProtocol.test( location.protocol ),
		global: true,
		processData: true,
		async: true,
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		/*
		timeout: 0,
		data: null,
		dataType: null,
		username: null,
		password: null,
		cache: null,
		throws: false,
		traditional: false,
		headers: {},
		*/

		accepts: {
			"*": allTypes,
			text: "text/plain",
			html: "text/html",
			xml: "application/xml, text/xml",
			json: "application/json, text/javascript"
		},

		contents: {
			xml: /\bxml\b/,
			html: /\bhtml/,
			json: /\bjson\b/
		},

		responseFields: {
			xml: "responseXML",
			text: "responseText",
			json: "responseJSON"
		},

		// Data converters
		// Keys separate source (or catchall "*") and destination types with a single space
		converters: {

			// Convert anything to text
			"* text": String,

			// Text to html (true = no transformation)
			"text html": true,

			// Evaluate text as a json expression
			"text json": jQuery.parseJSON,

			// Parse text as xml
			"text xml": jQuery.parseXML
		},

		// For options that shouldn't be deep extended:
		// you can add your own custom options here if
		// and when you create one that shouldn't be
		// deep extended (see ajaxExtend)
		flatOptions: {
			url: true,
			context: true
		}
	},

	// Creates a full fledged settings object into target
	// with both ajaxSettings and settings fields.
	// If target is omitted, writes into ajaxSettings.
	ajaxSetup: function( target, settings ) {
		return settings ?

			// Building a settings object
			ajaxExtend( ajaxExtend( target, jQuery.ajaxSettings ), settings ) :

			// Extending ajaxSettings
			ajaxExtend( jQuery.ajaxSettings, target );
	},

	ajaxPrefilter: addToPrefiltersOrTransports( prefilters ),
	ajaxTransport: addToPrefiltersOrTransports( transports ),

	// Main method
	ajax: function( url, options ) {

		// If url is an object, simulate pre-1.5 signature
		if ( typeof url === "object" ) {
			options = url;
			url = undefined;
		}

		// Force options to be an object
		options = options || {};

		var transport,

			// URL without anti-cache param
			cacheURL,

			// Response headers
			responseHeadersString,
			responseHeaders,

			// timeout handle
			timeoutTimer,

			// Url cleanup var
			urlAnchor,

			// To know if global events are to be dispatched
			fireGlobals,

			// Loop variable
			i,

			// Create the final options object
			s = jQuery.ajaxSetup( {}, options ),

			// Callbacks context
			callbackContext = s.context || s,

			// Context for global events is callbackContext if it is a DOM node or jQuery collection
			globalEventContext = s.context &&
				( callbackContext.nodeType || callbackContext.jquery ) ?
					jQuery( callbackContext ) :
					jQuery.event,

			// Deferreds
			deferred = jQuery.Deferred(),
			completeDeferred = jQuery.Callbacks( "once memory" ),

			// Status-dependent callbacks
			statusCode = s.statusCode || {},

			// Headers (they are sent all at once)
			requestHeaders = {},
			requestHeadersNames = {},

			// The jqXHR state
			state = 0,

			// Default abort message
			strAbort = "canceled",

			// Fake xhr
			jqXHR = {
				readyState: 0,

				// Builds headers hashtable if needed
				getResponseHeader: function( key ) {
					var match;
					if ( state === 2 ) {
						if ( !responseHeaders ) {
							responseHeaders = {};
							while ( ( match = rheaders.exec( responseHeadersString ) ) ) {
								responseHeaders[ match[ 1 ].toLowerCase() ] = match[ 2 ];
							}
						}
						match = responseHeaders[ key.toLowerCase() ];
					}
					return match == null ? null : match;
				},

				// Raw string
				getAllResponseHeaders: function() {
					return state === 2 ? responseHeadersString : null;
				},

				// Caches the header
				setRequestHeader: function( name, value ) {
					var lname = name.toLowerCase();
					if ( !state ) {
						name = requestHeadersNames[ lname ] = requestHeadersNames[ lname ] || name;
						requestHeaders[ name ] = value;
					}
					return this;
				},

				// Overrides response content-type header
				overrideMimeType: function( type ) {
					if ( !state ) {
						s.mimeType = type;
					}
					return this;
				},

				// Status-dependent callbacks
				statusCode: function( map ) {
					var code;
					if ( map ) {
						if ( state < 2 ) {
							for ( code in map ) {

								// Lazy-add the new callback in a way that preserves old ones
								statusCode[ code ] = [ statusCode[ code ], map[ code ] ];
							}
						} else {

							// Execute the appropriate callbacks
							jqXHR.always( map[ jqXHR.status ] );
						}
					}
					return this;
				},

				// Cancel the request
				abort: function( statusText ) {
					var finalText = statusText || strAbort;
					if ( transport ) {
						transport.abort( finalText );
					}
					done( 0, finalText );
					return this;
				}
			};

		// Attach deferreds
		deferred.promise( jqXHR ).complete = completeDeferred.add;
		jqXHR.success = jqXHR.done;
		jqXHR.error = jqXHR.fail;

		// Remove hash character (#7531: and string promotion)
		// Add protocol if not provided (prefilters might expect it)
		// Handle falsy url in the settings object (#10093: consistency with old signature)
		// We also use the url parameter if available
		s.url = ( ( url || s.url || location.href ) + "" ).replace( rhash, "" )
			.replace( rprotocol, location.protocol + "//" );

		// Alias method option to type as per ticket #12004
		s.type = options.method || options.type || s.method || s.type;

		// Extract dataTypes list
		s.dataTypes = jQuery.trim( s.dataType || "*" ).toLowerCase().match( rnotwhite ) || [ "" ];

		// A cross-domain request is in order when the origin doesn't match the current origin.
		if ( s.crossDomain == null ) {
			urlAnchor = document.createElement( "a" );

			// Support: IE8-11+
			// IE throws exception if url is malformed, e.g. http://example.com:80x/
			try {
				urlAnchor.href = s.url;

				// Support: IE8-11+
				// Anchor's host property isn't correctly set when s.url is relative
				urlAnchor.href = urlAnchor.href;
				s.crossDomain = originAnchor.protocol + "//" + originAnchor.host !==
					urlAnchor.protocol + "//" + urlAnchor.host;
			} catch ( e ) {

				// If there is an error parsing the URL, assume it is crossDomain,
				// it can be rejected by the transport if it is invalid
				s.crossDomain = true;
			}
		}

		// Convert data if not already a string
		if ( s.data && s.processData && typeof s.data !== "string" ) {
			s.data = jQuery.param( s.data, s.traditional );
		}

		// Apply prefilters
		inspectPrefiltersOrTransports( prefilters, s, options, jqXHR );

		// If request was aborted inside a prefilter, stop there
		if ( state === 2 ) {
			return jqXHR;
		}

		// We can fire global events as of now if asked to
		// Don't fire events if jQuery.event is undefined in an AMD-usage scenario (#15118)
		fireGlobals = jQuery.event && s.global;

		// Watch for a new set of requests
		if ( fireGlobals && jQuery.active++ === 0 ) {
			jQuery.event.trigger( "ajaxStart" );
		}

		// Uppercase the type
		s.type = s.type.toUpperCase();

		// Determine if request has content
		s.hasContent = !rnoContent.test( s.type );

		// Save the URL in case we're toying with the If-Modified-Since
		// and/or If-None-Match header later on
		cacheURL = s.url;

		// More options handling for requests with no content
		if ( !s.hasContent ) {

			// If data is available, append data to url
			if ( s.data ) {
				cacheURL = ( s.url += ( rquery.test( cacheURL ) ? "&" : "?" ) + s.data );

				// #9682: remove data so that it's not used in an eventual retry
				delete s.data;
			}

			// Add anti-cache in url if needed
			if ( s.cache === false ) {
				s.url = rts.test( cacheURL ) ?

					// If there is already a '_' parameter, set its value
					cacheURL.replace( rts, "$1_=" + nonce++ ) :

					// Otherwise add one to the end
					cacheURL + ( rquery.test( cacheURL ) ? "&" : "?" ) + "_=" + nonce++;
			}
		}

		// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
		if ( s.ifModified ) {
			if ( jQuery.lastModified[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-Modified-Since", jQuery.lastModified[ cacheURL ] );
			}
			if ( jQuery.etag[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-None-Match", jQuery.etag[ cacheURL ] );
			}
		}

		// Set the correct header, if data is being sent
		if ( s.data && s.hasContent && s.contentType !== false || options.contentType ) {
			jqXHR.setRequestHeader( "Content-Type", s.contentType );
		}

		// Set the Accepts header for the server, depending on the dataType
		jqXHR.setRequestHeader(
			"Accept",
			s.dataTypes[ 0 ] && s.accepts[ s.dataTypes[ 0 ] ] ?
				s.accepts[ s.dataTypes[ 0 ] ] +
					( s.dataTypes[ 0 ] !== "*" ? ", " + allTypes + "; q=0.01" : "" ) :
				s.accepts[ "*" ]
		);

		// Check for headers option
		for ( i in s.headers ) {
			jqXHR.setRequestHeader( i, s.headers[ i ] );
		}

		// Allow custom headers/mimetypes and early abort
		if ( s.beforeSend &&
			( s.beforeSend.call( callbackContext, jqXHR, s ) === false || state === 2 ) ) {

			// Abort if not done already and return
			return jqXHR.abort();
		}

		// Aborting is no longer a cancellation
		strAbort = "abort";

		// Install callbacks on deferreds
		for ( i in { success: 1, error: 1, complete: 1 } ) {
			jqXHR[ i ]( s[ i ] );
		}

		// Get transport
		transport = inspectPrefiltersOrTransports( transports, s, options, jqXHR );

		// If no transport, we auto-abort
		if ( !transport ) {
			done( -1, "No Transport" );
		} else {
			jqXHR.readyState = 1;

			// Send global event
			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxSend", [ jqXHR, s ] );
			}

			// If request was aborted inside ajaxSend, stop there
			if ( state === 2 ) {
				return jqXHR;
			}

			// Timeout
			if ( s.async && s.timeout > 0 ) {
				timeoutTimer = window.setTimeout( function() {
					jqXHR.abort( "timeout" );
				}, s.timeout );
			}

			try {
				state = 1;
				transport.send( requestHeaders, done );
			} catch ( e ) {

				// Propagate exception as error if not done
				if ( state < 2 ) {
					done( -1, e );

				// Simply rethrow otherwise
				} else {
					throw e;
				}
			}
		}

		// Callback for when everything is done
		function done( status, nativeStatusText, responses, headers ) {
			var isSuccess, success, error, response, modified,
				statusText = nativeStatusText;

			// Called once
			if ( state === 2 ) {
				return;
			}

			// State is "done" now
			state = 2;

			// Clear timeout if it exists
			if ( timeoutTimer ) {
				window.clearTimeout( timeoutTimer );
			}

			// Dereference transport for early garbage collection
			// (no matter how long the jqXHR object will be used)
			transport = undefined;

			// Cache response headers
			responseHeadersString = headers || "";

			// Set readyState
			jqXHR.readyState = status > 0 ? 4 : 0;

			// Determine if successful
			isSuccess = status >= 200 && status < 300 || status === 304;

			// Get response data
			if ( responses ) {
				response = ajaxHandleResponses( s, jqXHR, responses );
			}

			// Convert no matter what (that way responseXXX fields are always set)
			response = ajaxConvert( s, response, jqXHR, isSuccess );

			// If successful, handle type chaining
			if ( isSuccess ) {

				// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
				if ( s.ifModified ) {
					modified = jqXHR.getResponseHeader( "Last-Modified" );
					if ( modified ) {
						jQuery.lastModified[ cacheURL ] = modified;
					}
					modified = jqXHR.getResponseHeader( "etag" );
					if ( modified ) {
						jQuery.etag[ cacheURL ] = modified;
					}
				}

				// if no content
				if ( status === 204 || s.type === "HEAD" ) {
					statusText = "nocontent";

				// if not modified
				} else if ( status === 304 ) {
					statusText = "notmodified";

				// If we have data, let's convert it
				} else {
					statusText = response.state;
					success = response.data;
					error = response.error;
					isSuccess = !error;
				}
			} else {

				// Extract error from statusText and normalize for non-aborts
				error = statusText;
				if ( status || !statusText ) {
					statusText = "error";
					if ( status < 0 ) {
						status = 0;
					}
				}
			}

			// Set data for the fake xhr object
			jqXHR.status = status;
			jqXHR.statusText = ( nativeStatusText || statusText ) + "";

			// Success/Error
			if ( isSuccess ) {
				deferred.resolveWith( callbackContext, [ success, statusText, jqXHR ] );
			} else {
				deferred.rejectWith( callbackContext, [ jqXHR, statusText, error ] );
			}

			// Status-dependent callbacks
			jqXHR.statusCode( statusCode );
			statusCode = undefined;

			if ( fireGlobals ) {
				globalEventContext.trigger( isSuccess ? "ajaxSuccess" : "ajaxError",
					[ jqXHR, s, isSuccess ? success : error ] );
			}

			// Complete
			completeDeferred.fireWith( callbackContext, [ jqXHR, statusText ] );

			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxComplete", [ jqXHR, s ] );

				// Handle the global AJAX counter
				if ( !( --jQuery.active ) ) {
					jQuery.event.trigger( "ajaxStop" );
				}
			}
		}

		return jqXHR;
	},

	getJSON: function( url, data, callback ) {
		return jQuery.get( url, data, callback, "json" );
	},

	getScript: function( url, callback ) {
		return jQuery.get( url, undefined, callback, "script" );
	}
} );

jQuery.each( [ "get", "post" ], function( i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {

		// Shift arguments if data argument was omitted
		if ( jQuery.isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}

		// The url can be an options object (which then must have .url)
		return jQuery.ajax( jQuery.extend( {
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		}, jQuery.isPlainObject( url ) && url ) );
	};
} );


jQuery._evalUrl = function( url ) {
	return jQuery.ajax( {
		url: url,

		// Make this explicit, since user can override this through ajaxSetup (#11264)
		type: "GET",
		dataType: "script",
		async: false,
		global: false,
		"throws": true
	} );
};


jQuery.fn.extend( {
	wrapAll: function( html ) {
		var wrap;

		if ( jQuery.isFunction( html ) ) {
			return this.each( function( i ) {
				jQuery( this ).wrapAll( html.call( this, i ) );
			} );
		}

		if ( this[ 0 ] ) {

			// The elements to wrap the target around
			wrap = jQuery( html, this[ 0 ].ownerDocument ).eq( 0 ).clone( true );

			if ( this[ 0 ].parentNode ) {
				wrap.insertBefore( this[ 0 ] );
			}

			wrap.map( function() {
				var elem = this;

				while ( elem.firstElementChild ) {
					elem = elem.firstElementChild;
				}

				return elem;
			} ).append( this );
		}

		return this;
	},

	wrapInner: function( html ) {
		if ( jQuery.isFunction( html ) ) {
			return this.each( function( i ) {
				jQuery( this ).wrapInner( html.call( this, i ) );
			} );
		}

		return this.each( function() {
			var self = jQuery( this ),
				contents = self.contents();

			if ( contents.length ) {
				contents.wrapAll( html );

			} else {
				self.append( html );
			}
		} );
	},

	wrap: function( html ) {
		var isFunction = jQuery.isFunction( html );

		return this.each( function( i ) {
			jQuery( this ).wrapAll( isFunction ? html.call( this, i ) : html );
		} );
	},

	unwrap: function() {
		return this.parent().each( function() {
			if ( !jQuery.nodeName( this, "body" ) ) {
				jQuery( this ).replaceWith( this.childNodes );
			}
		} ).end();
	}
} );


jQuery.expr.filters.hidden = function( elem ) {
	return !jQuery.expr.filters.visible( elem );
};
jQuery.expr.filters.visible = function( elem ) {

	// Support: Opera <= 12.12
	// Opera reports offsetWidths and offsetHeights less than zero on some elements
	// Use OR instead of AND as the element is not visible if either is true
	// See tickets #10406 and #13132
	return elem.offsetWidth > 0 || elem.offsetHeight > 0 || elem.getClientRects().length > 0;
};




var r20 = /%20/g,
	rbracket = /\[\]$/,
	rCRLF = /\r?\n/g,
	rsubmitterTypes = /^(?:submit|button|image|reset|file)$/i,
	rsubmittable = /^(?:input|select|textarea|keygen)/i;

function buildParams( prefix, obj, traditional, add ) {
	var name;

	if ( jQuery.isArray( obj ) ) {

		// Serialize array item.
		jQuery.each( obj, function( i, v ) {
			if ( traditional || rbracket.test( prefix ) ) {

				// Treat each array item as a scalar.
				add( prefix, v );

			} else {

				// Item is non-scalar (array or object), encode its numeric index.
				buildParams(
					prefix + "[" + ( typeof v === "object" && v != null ? i : "" ) + "]",
					v,
					traditional,
					add
				);
			}
		} );

	} else if ( !traditional && jQuery.type( obj ) === "object" ) {

		// Serialize object item.
		for ( name in obj ) {
			buildParams( prefix + "[" + name + "]", obj[ name ], traditional, add );
		}

	} else {

		// Serialize scalar item.
		add( prefix, obj );
	}
}

// Serialize an array of form elements or a set of
// key/values into a query string
jQuery.param = function( a, traditional ) {
	var prefix,
		s = [],
		add = function( key, value ) {

			// If value is a function, invoke it and return its value
			value = jQuery.isFunction( value ) ? value() : ( value == null ? "" : value );
			s[ s.length ] = encodeURIComponent( key ) + "=" + encodeURIComponent( value );
		};

	// Set traditional to true for jQuery <= 1.3.2 behavior.
	if ( traditional === undefined ) {
		traditional = jQuery.ajaxSettings && jQuery.ajaxSettings.traditional;
	}

	// If an array was passed in, assume that it is an array of form elements.
	if ( jQuery.isArray( a ) || ( a.jquery && !jQuery.isPlainObject( a ) ) ) {

		// Serialize the form elements
		jQuery.each( a, function() {
			add( this.name, this.value );
		} );

	} else {

		// If traditional, encode the "old" way (the way 1.3.2 or older
		// did it), otherwise encode params recursively.
		for ( prefix in a ) {
			buildParams( prefix, a[ prefix ], traditional, add );
		}
	}

	// Return the resulting serialization
	return s.join( "&" ).replace( r20, "+" );
};

jQuery.fn.extend( {
	serialize: function() {
		return jQuery.param( this.serializeArray() );
	},
	serializeArray: function() {
		return this.map( function() {

			// Can add propHook for "elements" to filter or add form elements
			var elements = jQuery.prop( this, "elements" );
			return elements ? jQuery.makeArray( elements ) : this;
		} )
		.filter( function() {
			var type = this.type;

			// Use .is( ":disabled" ) so that fieldset[disabled] works
			return this.name && !jQuery( this ).is( ":disabled" ) &&
				rsubmittable.test( this.nodeName ) && !rsubmitterTypes.test( type ) &&
				( this.checked || !rcheckableType.test( type ) );
		} )
		.map( function( i, elem ) {
			var val = jQuery( this ).val();

			return val == null ?
				null :
				jQuery.isArray( val ) ?
					jQuery.map( val, function( val ) {
						return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
					} ) :
					{ name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
		} ).get();
	}
} );


jQuery.ajaxSettings.xhr = function() {
	try {
		return new window.XMLHttpRequest();
	} catch ( e ) {}
};

var xhrSuccessStatus = {

		// File protocol always yields status code 0, assume 200
		0: 200,

		// Support: IE9
		// #1450: sometimes IE returns 1223 when it should be 204
		1223: 204
	},
	xhrSupported = jQuery.ajaxSettings.xhr();

support.cors = !!xhrSupported && ( "withCredentials" in xhrSupported );
support.ajax = xhrSupported = !!xhrSupported;

jQuery.ajaxTransport( function( options ) {
	var callback, errorCallback;

	// Cross domain only allowed if supported through XMLHttpRequest
	if ( support.cors || xhrSupported && !options.crossDomain ) {
		return {
			send: function( headers, complete ) {
				var i,
					xhr = options.xhr();

				xhr.open(
					options.type,
					options.url,
					options.async,
					options.username,
					options.password
				);

				// Apply custom fields if provided
				if ( options.xhrFields ) {
					for ( i in options.xhrFields ) {
						xhr[ i ] = options.xhrFields[ i ];
					}
				}

				// Override mime type if needed
				if ( options.mimeType && xhr.overrideMimeType ) {
					xhr.overrideMimeType( options.mimeType );
				}

				// X-Requested-With header
				// For cross-domain requests, seeing as conditions for a preflight are
				// akin to a jigsaw puzzle, we simply never set it to be sure.
				// (it can always be set on a per-request basis or even using ajaxSetup)
				// For same-domain requests, won't change header if already provided.
				if ( !options.crossDomain && !headers[ "X-Requested-With" ] ) {
					headers[ "X-Requested-With" ] = "XMLHttpRequest";
				}

				// Set headers
				for ( i in headers ) {
					xhr.setRequestHeader( i, headers[ i ] );
				}

				// Callback
				callback = function( type ) {
					return function() {
						if ( callback ) {
							callback = errorCallback = xhr.onload =
								xhr.onerror = xhr.onabort = xhr.onreadystatechange = null;

							if ( type === "abort" ) {
								xhr.abort();
							} else if ( type === "error" ) {

								// Support: IE9
								// On a manual native abort, IE9 throws
								// errors on any property access that is not readyState
								if ( typeof xhr.status !== "number" ) {
									complete( 0, "error" );
								} else {
									complete(

										// File: protocol always yields status 0; see #8605, #14207
										xhr.status,
										xhr.statusText
									);
								}
							} else {
								complete(
									xhrSuccessStatus[ xhr.status ] || xhr.status,
									xhr.statusText,

									// Support: IE9 only
									// IE9 has no XHR2 but throws on binary (trac-11426)
									// For XHR2 non-text, let the caller handle it (gh-2498)
									( xhr.responseType || "text" ) !== "text"  ||
									typeof xhr.responseText !== "string" ?
										{ binary: xhr.response } :
										{ text: xhr.responseText },
									xhr.getAllResponseHeaders()
								);
							}
						}
					};
				};

				// Listen to events
				xhr.onload = callback();
				errorCallback = xhr.onerror = callback( "error" );

				// Support: IE9
				// Use onreadystatechange to replace onabort
				// to handle uncaught aborts
				if ( xhr.onabort !== undefined ) {
					xhr.onabort = errorCallback;
				} else {
					xhr.onreadystatechange = function() {

						// Check readyState before timeout as it changes
						if ( xhr.readyState === 4 ) {

							// Allow onerror to be called first,
							// but that will not handle a native abort
							// Also, save errorCallback to a variable
							// as xhr.onerror cannot be accessed
							window.setTimeout( function() {
								if ( callback ) {
									errorCallback();
								}
							} );
						}
					};
				}

				// Create the abort callback
				callback = callback( "abort" );

				try {

					// Do send the request (this may raise an exception)
					xhr.send( options.hasContent && options.data || null );
				} catch ( e ) {

					// #14683: Only rethrow if this hasn't been notified as an error yet
					if ( callback ) {
						throw e;
					}
				}
			},

			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




// Install script dataType
jQuery.ajaxSetup( {
	accepts: {
		script: "text/javascript, application/javascript, " +
			"application/ecmascript, application/x-ecmascript"
	},
	contents: {
		script: /\b(?:java|ecma)script\b/
	},
	converters: {
		"text script": function( text ) {
			jQuery.globalEval( text );
			return text;
		}
	}
} );

// Handle cache's special case and crossDomain
jQuery.ajaxPrefilter( "script", function( s ) {
	if ( s.cache === undefined ) {
		s.cache = false;
	}
	if ( s.crossDomain ) {
		s.type = "GET";
	}
} );

// Bind script tag hack transport
jQuery.ajaxTransport( "script", function( s ) {

	// This transport only deals with cross domain requests
	if ( s.crossDomain ) {
		var script, callback;
		return {
			send: function( _, complete ) {
				script = jQuery( "<script>" ).prop( {
					charset: s.scriptCharset,
					src: s.url
				} ).on(
					"load error",
					callback = function( evt ) {
						script.remove();
						callback = null;
						if ( evt ) {
							complete( evt.type === "error" ? 404 : 200, evt.type );
						}
					}
				);

				// Use native DOM manipulation to avoid our domManip AJAX trickery
				document.head.appendChild( script[ 0 ] );
			},
			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




var oldCallbacks = [],
	rjsonp = /(=)\?(?=&|$)|\?\?/;

// Default jsonp settings
jQuery.ajaxSetup( {
	jsonp: "callback",
	jsonpCallback: function() {
		var callback = oldCallbacks.pop() || ( jQuery.expando + "_" + ( nonce++ ) );
		this[ callback ] = true;
		return callback;
	}
} );

// Detect, normalize options and install callbacks for jsonp requests
jQuery.ajaxPrefilter( "json jsonp", function( s, originalSettings, jqXHR ) {

	var callbackName, overwritten, responseContainer,
		jsonProp = s.jsonp !== false && ( rjsonp.test( s.url ) ?
			"url" :
			typeof s.data === "string" &&
				( s.contentType || "" )
					.indexOf( "application/x-www-form-urlencoded" ) === 0 &&
				rjsonp.test( s.data ) && "data"
		);

	// Handle iff the expected data type is "jsonp" or we have a parameter to set
	if ( jsonProp || s.dataTypes[ 0 ] === "jsonp" ) {

		// Get callback name, remembering preexisting value associated with it
		callbackName = s.jsonpCallback = jQuery.isFunction( s.jsonpCallback ) ?
			s.jsonpCallback() :
			s.jsonpCallback;

		// Insert callback into url or form data
		if ( jsonProp ) {
			s[ jsonProp ] = s[ jsonProp ].replace( rjsonp, "$1" + callbackName );
		} else if ( s.jsonp !== false ) {
			s.url += ( rquery.test( s.url ) ? "&" : "?" ) + s.jsonp + "=" + callbackName;
		}

		// Use data converter to retrieve json after script execution
		s.converters[ "script json" ] = function() {
			if ( !responseContainer ) {
				jQuery.error( callbackName + " was not called" );
			}
			return responseContainer[ 0 ];
		};

		// Force json dataType
		s.dataTypes[ 0 ] = "json";

		// Install callback
		overwritten = window[ callbackName ];
		window[ callbackName ] = function() {
			responseContainer = arguments;
		};

		// Clean-up function (fires after converters)
		jqXHR.always( function() {

			// If previous value didn't exist - remove it
			if ( overwritten === undefined ) {
				jQuery( window ).removeProp( callbackName );

			// Otherwise restore preexisting value
			} else {
				window[ callbackName ] = overwritten;
			}

			// Save back as free
			if ( s[ callbackName ] ) {

				// Make sure that re-using the options doesn't screw things around
				s.jsonpCallback = originalSettings.jsonpCallback;

				// Save the callback name for future use
				oldCallbacks.push( callbackName );
			}

			// Call if it was a function and we have a response
			if ( responseContainer && jQuery.isFunction( overwritten ) ) {
				overwritten( responseContainer[ 0 ] );
			}

			responseContainer = overwritten = undefined;
		} );

		// Delegate to script
		return "script";
	}
} );




// Argument "data" should be string of html
// context (optional): If specified, the fragment will be created in this context,
// defaults to document
// keepScripts (optional): If true, will include scripts passed in the html string
jQuery.parseHTML = function( data, context, keepScripts ) {
	if ( !data || typeof data !== "string" ) {
		return null;
	}
	if ( typeof context === "boolean" ) {
		keepScripts = context;
		context = false;
	}
	context = context || document;

	var parsed = rsingleTag.exec( data ),
		scripts = !keepScripts && [];

	// Single tag
	if ( parsed ) {
		return [ context.createElement( parsed[ 1 ] ) ];
	}

	parsed = buildFragment( [ data ], context, scripts );

	if ( scripts && scripts.length ) {
		jQuery( scripts ).remove();
	}

	return jQuery.merge( [], parsed.childNodes );
};


// Keep a copy of the old load method
var _load = jQuery.fn.load;

/**
 * Load a url into a page
 */
jQuery.fn.load = function( url, params, callback ) {
	if ( typeof url !== "string" && _load ) {
		return _load.apply( this, arguments );
	}

	var selector, type, response,
		self = this,
		off = url.indexOf( " " );

	if ( off > -1 ) {
		selector = jQuery.trim( url.slice( off ) );
		url = url.slice( 0, off );
	}

	// If it's a function
	if ( jQuery.isFunction( params ) ) {

		// We assume that it's the callback
		callback = params;
		params = undefined;

	// Otherwise, build a param string
	} else if ( params && typeof params === "object" ) {
		type = "POST";
	}

	// If we have elements to modify, make the request
	if ( self.length > 0 ) {
		jQuery.ajax( {
			url: url,

			// If "type" variable is undefined, then "GET" method will be used.
			// Make value of this field explicit since
			// user can override it through ajaxSetup method
			type: type || "GET",
			dataType: "html",
			data: params
		} ).done( function( responseText ) {

			// Save response for use in complete callback
			response = arguments;

			self.html( selector ?

				// If a selector was specified, locate the right elements in a dummy div
				// Exclude scripts to avoid IE 'Permission Denied' errors
				jQuery( "<div>" ).append( jQuery.parseHTML( responseText ) ).find( selector ) :

				// Otherwise use the full result
				responseText );

		// If the request succeeds, this function gets "data", "status", "jqXHR"
		// but they are ignored because response was set above.
		// If it fails, this function gets "jqXHR", "status", "error"
		} ).always( callback && function( jqXHR, status ) {
			self.each( function() {
				callback.apply( this, response || [ jqXHR.responseText, status, jqXHR ] );
			} );
		} );
	}

	return this;
};




// Attach a bunch of functions for handling common AJAX events
jQuery.each( [
	"ajaxStart",
	"ajaxStop",
	"ajaxComplete",
	"ajaxError",
	"ajaxSuccess",
	"ajaxSend"
], function( i, type ) {
	jQuery.fn[ type ] = function( fn ) {
		return this.on( type, fn );
	};
} );




jQuery.expr.filters.animated = function( elem ) {
	return jQuery.grep( jQuery.timers, function( fn ) {
		return elem === fn.elem;
	} ).length;
};




/**
 * Gets a window from an element
 */
function getWindow( elem ) {
	return jQuery.isWindow( elem ) ? elem : elem.nodeType === 9 && elem.defaultView;
}

jQuery.offset = {
	setOffset: function( elem, options, i ) {
		var curPosition, curLeft, curCSSTop, curTop, curOffset, curCSSLeft, calculatePosition,
			position = jQuery.css( elem, "position" ),
			curElem = jQuery( elem ),
			props = {};

		// Set position first, in-case top/left are set even on static elem
		if ( position === "static" ) {
			elem.style.position = "relative";
		}

		curOffset = curElem.offset();
		curCSSTop = jQuery.css( elem, "top" );
		curCSSLeft = jQuery.css( elem, "left" );
		calculatePosition = ( position === "absolute" || position === "fixed" ) &&
			( curCSSTop + curCSSLeft ).indexOf( "auto" ) > -1;

		// Need to be able to calculate position if either
		// top or left is auto and position is either absolute or fixed
		if ( calculatePosition ) {
			curPosition = curElem.position();
			curTop = curPosition.top;
			curLeft = curPosition.left;

		} else {
			curTop = parseFloat( curCSSTop ) || 0;
			curLeft = parseFloat( curCSSLeft ) || 0;
		}

		if ( jQuery.isFunction( options ) ) {

			// Use jQuery.extend here to allow modification of coordinates argument (gh-1848)
			options = options.call( elem, i, jQuery.extend( {}, curOffset ) );
		}

		if ( options.top != null ) {
			props.top = ( options.top - curOffset.top ) + curTop;
		}
		if ( options.left != null ) {
			props.left = ( options.left - curOffset.left ) + curLeft;
		}

		if ( "using" in options ) {
			options.using.call( elem, props );

		} else {
			curElem.css( props );
		}
	}
};

jQuery.fn.extend( {
	offset: function( options ) {
		if ( arguments.length ) {
			return options === undefined ?
				this :
				this.each( function( i ) {
					jQuery.offset.setOffset( this, options, i );
				} );
		}

		var docElem, win,
			elem = this[ 0 ],
			box = { top: 0, left: 0 },
			doc = elem && elem.ownerDocument;

		if ( !doc ) {
			return;
		}

		docElem = doc.documentElement;

		// Make sure it's not a disconnected DOM node
		if ( !jQuery.contains( docElem, elem ) ) {
			return box;
		}

		box = elem.getBoundingClientRect();
		win = getWindow( doc );
		return {
			top: box.top + win.pageYOffset - docElem.clientTop,
			left: box.left + win.pageXOffset - docElem.clientLeft
		};
	},

	position: function() {
		if ( !this[ 0 ] ) {
			return;
		}

		var offsetParent, offset,
			elem = this[ 0 ],
			parentOffset = { top: 0, left: 0 };

		// Fixed elements are offset from window (parentOffset = {top:0, left: 0},
		// because it is its only offset parent
		if ( jQuery.css( elem, "position" ) === "fixed" ) {

			// Assume getBoundingClientRect is there when computed position is fixed
			offset = elem.getBoundingClientRect();

		} else {

			// Get *real* offsetParent
			offsetParent = this.offsetParent();

			// Get correct offsets
			offset = this.offset();
			if ( !jQuery.nodeName( offsetParent[ 0 ], "html" ) ) {
				parentOffset = offsetParent.offset();
			}

			// Add offsetParent borders
			parentOffset.top += jQuery.css( offsetParent[ 0 ], "borderTopWidth", true );
			parentOffset.left += jQuery.css( offsetParent[ 0 ], "borderLeftWidth", true );
		}

		// Subtract parent offsets and element margins
		return {
			top: offset.top - parentOffset.top - jQuery.css( elem, "marginTop", true ),
			left: offset.left - parentOffset.left - jQuery.css( elem, "marginLeft", true )
		};
	},

	// This method will return documentElement in the following cases:
	// 1) For the element inside the iframe without offsetParent, this method will return
	//    documentElement of the parent window
	// 2) For the hidden or detached element
	// 3) For body or html element, i.e. in case of the html node - it will return itself
	//
	// but those exceptions were never presented as a real life use-cases
	// and might be considered as more preferable results.
	//
	// This logic, however, is not guaranteed and can change at any point in the future
	offsetParent: function() {
		return this.map( function() {
			var offsetParent = this.offsetParent;

			while ( offsetParent && jQuery.css( offsetParent, "position" ) === "static" ) {
				offsetParent = offsetParent.offsetParent;
			}

			return offsetParent || documentElement;
		} );
	}
} );

// Create scrollLeft and scrollTop methods
jQuery.each( { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function( method, prop ) {
	var top = "pageYOffset" === prop;

	jQuery.fn[ method ] = function( val ) {
		return access( this, function( elem, method, val ) {
			var win = getWindow( elem );

			if ( val === undefined ) {
				return win ? win[ prop ] : elem[ method ];
			}

			if ( win ) {
				win.scrollTo(
					!top ? val : win.pageXOffset,
					top ? val : win.pageYOffset
				);

			} else {
				elem[ method ] = val;
			}
		}, method, val, arguments.length );
	};
} );

// Support: Safari<7-8+, Chrome<37-44+
// Add the top/left cssHooks using jQuery.fn.position
// Webkit bug: https://bugs.webkit.org/show_bug.cgi?id=29084
// Blink bug: https://code.google.com/p/chromium/issues/detail?id=229280
// getComputedStyle returns percent when specified for top/left/bottom/right;
// rather than make the css module depend on the offset module, just check for it here
jQuery.each( [ "top", "left" ], function( i, prop ) {
	jQuery.cssHooks[ prop ] = addGetHookIf( support.pixelPosition,
		function( elem, computed ) {
			if ( computed ) {
				computed = curCSS( elem, prop );

				// If curCSS returns percentage, fallback to offset
				return rnumnonpx.test( computed ) ?
					jQuery( elem ).position()[ prop ] + "px" :
					computed;
			}
		}
	);
} );


// Create innerHeight, innerWidth, height, width, outerHeight and outerWidth methods
jQuery.each( { Height: "height", Width: "width" }, function( name, type ) {
	jQuery.each( { padding: "inner" + name, content: type, "": "outer" + name },
		function( defaultExtra, funcName ) {

		// Margin is only for outerHeight, outerWidth
		jQuery.fn[ funcName ] = function( margin, value ) {
			var chainable = arguments.length && ( defaultExtra || typeof margin !== "boolean" ),
				extra = defaultExtra || ( margin === true || value === true ? "margin" : "border" );

			return access( this, function( elem, type, value ) {
				var doc;

				if ( jQuery.isWindow( elem ) ) {

					// As of 5/8/2012 this will yield incorrect results for Mobile Safari, but there
					// isn't a whole lot we can do. See pull request at this URL for discussion:
					// https://github.com/jquery/jquery/pull/764
					return elem.document.documentElement[ "client" + name ];
				}

				// Get document width or height
				if ( elem.nodeType === 9 ) {
					doc = elem.documentElement;

					// Either scroll[Width/Height] or offset[Width/Height] or client[Width/Height],
					// whichever is greatest
					return Math.max(
						elem.body[ "scroll" + name ], doc[ "scroll" + name ],
						elem.body[ "offset" + name ], doc[ "offset" + name ],
						doc[ "client" + name ]
					);
				}

				return value === undefined ?

					// Get width or height on the element, requesting but not forcing parseFloat
					jQuery.css( elem, type, extra ) :

					// Set width or height on the element
					jQuery.style( elem, type, value, extra );
			}, type, chainable ? margin : undefined, chainable, null );
		};
	} );
} );


jQuery.fn.extend( {

	bind: function( types, data, fn ) {
		return this.on( types, null, data, fn );
	},
	unbind: function( types, fn ) {
		return this.off( types, null, fn );
	},

	delegate: function( selector, types, data, fn ) {
		return this.on( types, selector, data, fn );
	},
	undelegate: function( selector, types, fn ) {

		// ( namespace ) or ( selector, types [, fn] )
		return arguments.length === 1 ?
			this.off( selector, "**" ) :
			this.off( types, selector || "**", fn );
	},
	size: function() {
		return this.length;
	}
} );

jQuery.fn.andSelf = jQuery.fn.addBack;




// Register as a named AMD module, since jQuery can be concatenated with other
// files that may use define, but not via a proper concatenation script that
// understands anonymous AMD modules. A named AMD is safest and most robust
// way to register. Lowercase jquery is used because AMD module names are
// derived from file names, and jQuery is normally delivered in a lowercase
// file name. Do this after creating the global so that if an AMD module wants
// to call noConflict to hide this version of jQuery, it will work.

// Note that for maximum portability, libraries that are not jQuery should
// declare themselves as anonymous modules, and avoid setting a global if an
// AMD loader is present. jQuery is a special case. For more information, see
// https://github.com/jrburke/requirejs/wiki/Updating-existing-libraries#wiki-anon

if ( typeof define === "function" && define.amd ) {
	define( "jquery", [], function() {
		return jQuery;
	} );
}



var

	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$;

jQuery.noConflict = function( deep ) {
	if ( window.$ === jQuery ) {
		window.$ = _$;
	}

	if ( deep && window.jQuery === jQuery ) {
		window.jQuery = _jQuery;
	}

	return jQuery;
};

// Expose jQuery and $ identifiers, even in AMD
// (#7102#comment:10, https://github.com/jquery/jquery/pull/557)
// and CommonJS for browser emulators (#13566)
if ( !noGlobal ) {
	window.jQuery = window.$ = jQuery;
}

return jQuery;
}));

/*!
 * Isotope PACKAGED v2.2.2
 *
 * Licensed GPLv3 for open source use
 * or Isotope Commercial License for commercial use
 *
 * http://isotope.metafizzy.co
 * Copyright 2015 Metafizzy
 */

/**
 * Bridget makes jQuery widgets
 * v1.1.0
 * MIT license
 */

( function( window ) {



// -------------------------- utils -------------------------- //

var slice = Array.prototype.slice;

function noop() {}

// -------------------------- definition -------------------------- //

function defineBridget( $ ) {

// bail if no jQuery
if ( !$ ) {
  return;
}

// -------------------------- addOptionMethod -------------------------- //

/**
 * adds option method -> $().plugin('option', {...})
 * @param {Function} PluginClass - constructor class
 */
function addOptionMethod( PluginClass ) {
  // don't overwrite original option method
  if ( PluginClass.prototype.option ) {
    return;
  }

  // option setter
  PluginClass.prototype.option = function( opts ) {
    // bail out if not an object
    if ( !$.isPlainObject( opts ) ){
      return;
    }
    this.options = $.extend( true, this.options, opts );
  };
}

// -------------------------- plugin bridge -------------------------- //

// helper function for logging errors
// $.error breaks jQuery chaining
var logError = typeof console === 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

/**
 * jQuery plugin bridge, access methods like $elem.plugin('method')
 * @param {String} namespace - plugin name
 * @param {Function} PluginClass - constructor class
 */
function bridge( namespace, PluginClass ) {
  // add to jQuery fn namespace
  $.fn[ namespace ] = function( options ) {
    if ( typeof options === 'string' ) {
      // call plugin method when first argument is a string
      // get arguments for method
      var args = slice.call( arguments, 1 );

      for ( var i=0, len = this.length; i < len; i++ ) {
        var elem = this[i];
        var instance = $.data( elem, namespace );
        if ( !instance ) {
          logError( "cannot call methods on " + namespace + " prior to initialization; " +
            "attempted to call '" + options + "'" );
          continue;
        }
        if ( !$.isFunction( instance[options] ) || options.charAt(0) === '_' ) {
          logError( "no such method '" + options + "' for " + namespace + " instance" );
          continue;
        }

        // trigger method with arguments
        var returnValue = instance[ options ].apply( instance, args );

        // break look and return first value if provided
        if ( returnValue !== undefined ) {
          return returnValue;
        }
      }
      // return this if no return value
      return this;
    } else {
      return this.each( function() {
        var instance = $.data( this, namespace );
        if ( instance ) {
          // apply options & init
          instance.option( options );
          instance._init();
        } else {
          // initialize new instance
          instance = new PluginClass( this, options );
          $.data( this, namespace, instance );
        }
      });
    }
  };

}

// -------------------------- bridget -------------------------- //

/**
 * converts a Prototypical class into a proper jQuery plugin
 *   the class must have a ._init method
 * @param {String} namespace - plugin name, used in $().pluginName
 * @param {Function} PluginClass - constructor class
 */
$.bridget = function( namespace, PluginClass ) {
  addOptionMethod( PluginClass );
  bridge( namespace, PluginClass );
};

return $.bridget;

}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'jquery-bridget/jquery.bridget',[ 'jquery' ], defineBridget );
} else if ( typeof exports === 'object' ) {
  defineBridget( require('jquery') );
} else {
  // get jquery from browser global
  defineBridget( window.jQuery );
}

})( window );

/*!
 * eventie v1.0.6
 * event binding helper
 *   eventie.bind( elem, 'click', myFn )
 *   eventie.unbind( elem, 'click', myFn )
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true */
/*global define: false, module: false */

( function( window ) {



var docElem = document.documentElement;

var bind = function() {};

function getIEEvent( obj ) {
  var event = window.event;
  // add event.target
  event.target = event.target || event.srcElement || obj;
  return event;
}

if ( docElem.addEventListener ) {
  bind = function( obj, type, fn ) {
    obj.addEventListener( type, fn, false );
  };
} else if ( docElem.attachEvent ) {
  bind = function( obj, type, fn ) {
    obj[ type + fn ] = fn.handleEvent ?
      function() {
        var event = getIEEvent( obj );
        fn.handleEvent.call( fn, event );
      } :
      function() {
        var event = getIEEvent( obj );
        fn.call( obj, event );
      };
    obj.attachEvent( "on" + type, obj[ type + fn ] );
  };
}

var unbind = function() {};

if ( docElem.removeEventListener ) {
  unbind = function( obj, type, fn ) {
    obj.removeEventListener( type, fn, false );
  };
} else if ( docElem.detachEvent ) {
  unbind = function( obj, type, fn ) {
    obj.detachEvent( "on" + type, obj[ type + fn ] );
    try {
      delete obj[ type + fn ];
    } catch ( err ) {
      // can't delete window object properties
      obj[ type + fn ] = undefined;
    }
  };
}

var eventie = {
  bind: bind,
  unbind: unbind
};

// ----- module definition ----- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'eventie/eventie',eventie );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = eventie;
} else {
  // browser global
  window.eventie = eventie;
}

})( window );

/*!
 * EventEmitter v4.2.11 - git.io/ee
 * Unlicense - http://unlicense.org/
 * Oliver Caldwell - http://oli.me.uk/
 * @preserve
 */

;(function () {
    'use strict';

    /**
     * Class for managing events.
     * Can be extended to provide event functionality in other classes.
     *
     * @class EventEmitter Manages event registering and emitting.
     */
    function EventEmitter() {}

    // Shortcuts to improve speed and size
    var proto = EventEmitter.prototype;
    var exports = this;
    var originalGlobalValue = exports.EventEmitter;

    /**
     * Finds the index of the listener for the event in its storage array.
     *
     * @param {Function[]} listeners Array of listeners to search through.
     * @param {Function} listener Method to look for.
     * @return {Number} Index of the specified listener, -1 if not found
     * @api private
     */
    function indexOfListener(listeners, listener) {
        var i = listeners.length;
        while (i--) {
            if (listeners[i].listener === listener) {
                return i;
            }
        }

        return -1;
    }

    /**
     * Alias a method while keeping the context correct, to allow for overwriting of target method.
     *
     * @param {String} name The name of the target method.
     * @return {Function} The aliased method
     * @api private
     */
    function alias(name) {
        return function aliasClosure() {
            return this[name].apply(this, arguments);
        };
    }

    /**
     * Returns the listener array for the specified event.
     * Will initialise the event object and listener arrays if required.
     * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
     * Each property in the object response is an array of listener functions.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Function[]|Object} All listener functions for the event.
     */
    proto.getListeners = function getListeners(evt) {
        var events = this._getEvents();
        var response;
        var key;

        // Return a concatenated array of all matching events if
        // the selector is a regular expression.
        if (evt instanceof RegExp) {
            response = {};
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    response[key] = events[key];
                }
            }
        }
        else {
            response = events[evt] || (events[evt] = []);
        }

        return response;
    };

    /**
     * Takes a list of listener objects and flattens it into a list of listener functions.
     *
     * @param {Object[]} listeners Raw listener objects.
     * @return {Function[]} Just the listener functions.
     */
    proto.flattenListeners = function flattenListeners(listeners) {
        var flatListeners = [];
        var i;

        for (i = 0; i < listeners.length; i += 1) {
            flatListeners.push(listeners[i].listener);
        }

        return flatListeners;
    };

    /**
     * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Object} All listener functions for an event in an object.
     */
    proto.getListenersAsObject = function getListenersAsObject(evt) {
        var listeners = this.getListeners(evt);
        var response;

        if (listeners instanceof Array) {
            response = {};
            response[evt] = listeners;
        }

        return response || listeners;
    };

    /**
     * Adds a listener function to the specified event.
     * The listener will not be added if it is a duplicate.
     * If the listener returns true then it will be removed after it is called.
     * If you pass a regular expression as the event name then the listener will be added to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListener = function addListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var listenerIsWrapped = typeof listener === 'object';
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
                listeners[key].push(listenerIsWrapped ? listener : {
                    listener: listener,
                    once: false
                });
            }
        }

        return this;
    };

    /**
     * Alias of addListener
     */
    proto.on = alias('addListener');

    /**
     * Semi-alias of addListener. It will add a listener that will be
     * automatically removed after its first execution.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addOnceListener = function addOnceListener(evt, listener) {
        return this.addListener(evt, {
            listener: listener,
            once: true
        });
    };

    /**
     * Alias of addOnceListener.
     */
    proto.once = alias('addOnceListener');

    /**
     * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
     * You need to tell it what event names should be matched by a regex.
     *
     * @param {String} evt Name of the event to create.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvent = function defineEvent(evt) {
        this.getListeners(evt);
        return this;
    };

    /**
     * Uses defineEvent to define multiple events.
     *
     * @param {String[]} evts An array of event names to define.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvents = function defineEvents(evts) {
        for (var i = 0; i < evts.length; i += 1) {
            this.defineEvent(evts[i]);
        }
        return this;
    };

    /**
     * Removes a listener function from the specified event.
     * When passed a regular expression as the event name, it will remove the listener from all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to remove the listener from.
     * @param {Function} listener Method to remove from the event.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListener = function removeListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var index;
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                index = indexOfListener(listeners[key], listener);

                if (index !== -1) {
                    listeners[key].splice(index, 1);
                }
            }
        }

        return this;
    };

    /**
     * Alias of removeListener
     */
    proto.off = alias('removeListener');

    /**
     * Adds listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
     * You can also pass it a regular expression to add the array of listeners to all events that match it.
     * Yeah, this function does quite a bit. That's probably a bad thing.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListeners = function addListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(false, evt, listeners);
    };

    /**
     * Removes listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be removed.
     * You can also pass it a regular expression to remove the listeners from all events that match it.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListeners = function removeListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(true, evt, listeners);
    };

    /**
     * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
     * The first argument will determine if the listeners are removed (true) or added (false).
     * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be added/removed.
     * You can also pass it a regular expression to manipulate the listeners of all events that match it.
     *
     * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
        var i;
        var value;
        var single = remove ? this.removeListener : this.addListener;
        var multiple = remove ? this.removeListeners : this.addListeners;

        // If evt is an object then pass each of its properties to this method
        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
            for (i in evt) {
                if (evt.hasOwnProperty(i) && (value = evt[i])) {
                    // Pass the single listener straight through to the singular method
                    if (typeof value === 'function') {
                        single.call(this, i, value);
                    }
                    else {
                        // Otherwise pass back to the multiple function
                        multiple.call(this, i, value);
                    }
                }
            }
        }
        else {
            // So evt must be a string
            // And listeners must be an array of listeners
            // Loop over it and pass each one to the multiple method
            i = listeners.length;
            while (i--) {
                single.call(this, evt, listeners[i]);
            }
        }

        return this;
    };

    /**
     * Removes all listeners from a specified event.
     * If you do not specify an event then all listeners will be removed.
     * That means every event will be emptied.
     * You can also pass a regex to remove all events that match it.
     *
     * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeEvent = function removeEvent(evt) {
        var type = typeof evt;
        var events = this._getEvents();
        var key;

        // Remove different things depending on the state of evt
        if (type === 'string') {
            // Remove all listeners for the specified event
            delete events[evt];
        }
        else if (evt instanceof RegExp) {
            // Remove all events matching the regex.
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    delete events[key];
                }
            }
        }
        else {
            // Remove all listeners in all events
            delete this._events;
        }

        return this;
    };

    /**
     * Alias of removeEvent.
     *
     * Added to mirror the node API.
     */
    proto.removeAllListeners = alias('removeEvent');

    /**
     * Emits an event of your choice.
     * When emitted, every listener attached to that event will be executed.
     * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
     * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
     * So they will not arrive within the array on the other side, they will be separate.
     * You can also pass a regular expression to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {Array} [args] Optional array of arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emitEvent = function emitEvent(evt, args) {
        var listeners = this.getListenersAsObject(evt);
        var listener;
        var i;
        var key;
        var response;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                i = listeners[key].length;

                while (i--) {
                    // If the listener returns true then it shall be removed from the event
                    // The function is executed either with a basic call or an apply if there is an args array
                    listener = listeners[key][i];

                    if (listener.once === true) {
                        this.removeListener(evt, listener.listener);
                    }

                    response = listener.listener.apply(this, args || []);

                    if (response === this._getOnceReturnValue()) {
                        this.removeListener(evt, listener.listener);
                    }
                }
            }
        }

        return this;
    };

    /**
     * Alias of emitEvent
     */
    proto.trigger = alias('emitEvent');

    /**
     * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
     * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {...*} Optional additional arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emit = function emit(evt) {
        var args = Array.prototype.slice.call(arguments, 1);
        return this.emitEvent(evt, args);
    };

    /**
     * Sets the current value to check against when executing listeners. If a
     * listeners return value matches the one set here then it will be removed
     * after execution. This value defaults to true.
     *
     * @param {*} value The new value to check for when executing listeners.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.setOnceReturnValue = function setOnceReturnValue(value) {
        this._onceReturnValue = value;
        return this;
    };

    /**
     * Fetches the current value to check against when executing listeners. If
     * the listeners return value matches this one then it should be removed
     * automatically. It will return true by default.
     *
     * @return {*|Boolean} The current value to check for or the default, true.
     * @api private
     */
    proto._getOnceReturnValue = function _getOnceReturnValue() {
        if (this.hasOwnProperty('_onceReturnValue')) {
            return this._onceReturnValue;
        }
        else {
            return true;
        }
    };

    /**
     * Fetches the events object and creates one if required.
     *
     * @return {Object} The events storage object.
     * @api private
     */
    proto._getEvents = function _getEvents() {
        return this._events || (this._events = {});
    };

    /**
     * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
     *
     * @return {Function} Non conflicting EventEmitter class.
     */
    EventEmitter.noConflict = function noConflict() {
        exports.EventEmitter = originalGlobalValue;
        return EventEmitter;
    };

    // Expose the class either via AMD, CommonJS or the global object
    if (typeof define === 'function' && define.amd) {
        define('eventEmitter/EventEmitter',[],function () {
            return EventEmitter;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = EventEmitter;
    }
    else {
        exports.EventEmitter = EventEmitter;
    }
}.call(this));

/*!
 * getStyleProperty v1.0.4
 * original by kangax
 * http://perfectionkills.com/feature-testing-css-properties/
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false, exports: false, module: false */

( function( window ) {



var prefixes = 'Webkit Moz ms Ms O'.split(' ');
var docElemStyle = document.documentElement.style;

function getStyleProperty( propName ) {
  if ( !propName ) {
    return;
  }

  // test standard property first
  if ( typeof docElemStyle[ propName ] === 'string' ) {
    return propName;
  }

  // capitalize
  propName = propName.charAt(0).toUpperCase() + propName.slice(1);

  // test vendor specific properties
  var prefixed;
  for ( var i=0, len = prefixes.length; i < len; i++ ) {
    prefixed = prefixes[i] + propName;
    if ( typeof docElemStyle[ prefixed ] === 'string' ) {
      return prefixed;
    }
  }
}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'get-style-property/get-style-property',[],function() {
    return getStyleProperty;
  });
} else if ( typeof exports === 'object' ) {
  // CommonJS for Component
  module.exports = getStyleProperty;
} else {
  // browser global
  window.getStyleProperty = getStyleProperty;
}

})( window );

/*!
 * getSize v1.2.2
 * measure size of elements
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, exports: false, require: false, module: false, console: false */

( function( window, undefined ) {



// -------------------------- helpers -------------------------- //

// get a number from a string, not a percentage
function getStyleSize( value ) {
  var num = parseFloat( value );
  // not a percent like '100%', and a number
  var isValid = value.indexOf('%') === -1 && !isNaN( num );
  return isValid && num;
}

function noop() {}

var logError = typeof console === 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

// -------------------------- measurements -------------------------- //

var measurements = [
  'paddingLeft',
  'paddingRight',
  'paddingTop',
  'paddingBottom',
  'marginLeft',
  'marginRight',
  'marginTop',
  'marginBottom',
  'borderLeftWidth',
  'borderRightWidth',
  'borderTopWidth',
  'borderBottomWidth'
];

function getZeroSize() {
  var size = {
    width: 0,
    height: 0,
    innerWidth: 0,
    innerHeight: 0,
    outerWidth: 0,
    outerHeight: 0
  };
  for ( var i=0, len = measurements.length; i < len; i++ ) {
    var measurement = measurements[i];
    size[ measurement ] = 0;
  }
  return size;
}



function defineGetSize( getStyleProperty ) {

// -------------------------- setup -------------------------- //

var isSetup = false;

var getStyle, boxSizingProp, isBoxSizeOuter;

/**
 * setup vars and functions
 * do it on initial getSize(), rather than on script load
 * For Firefox bug https://bugzilla.mozilla.org/show_bug.cgi?id=548397
 */
function setup() {
  // setup once
  if ( isSetup ) {
    return;
  }
  isSetup = true;

  var getComputedStyle = window.getComputedStyle;
  getStyle = ( function() {
    var getStyleFn = getComputedStyle ?
      function( elem ) {
        return getComputedStyle( elem, null );
      } :
      function( elem ) {
        return elem.currentStyle;
      };

      return function getStyle( elem ) {
        var style = getStyleFn( elem );
        if ( !style ) {
          logError( 'Style returned ' + style +
            '. Are you running this code in a hidden iframe on Firefox? ' +
            'See http://bit.ly/getsizebug1' );
        }
        return style;
      };
  })();

  // -------------------------- box sizing -------------------------- //

  boxSizingProp = getStyleProperty('boxSizing');

  /**
   * WebKit measures the outer-width on style.width on border-box elems
   * IE & Firefox measures the inner-width
   */
  if ( boxSizingProp ) {
    var div = document.createElement('div');
    div.style.width = '200px';
    div.style.padding = '1px 2px 3px 4px';
    div.style.borderStyle = 'solid';
    div.style.borderWidth = '1px 2px 3px 4px';
    div.style[ boxSizingProp ] = 'border-box';

    var body = document.body || document.documentElement;
    body.appendChild( div );
    var style = getStyle( div );

    isBoxSizeOuter = getStyleSize( style.width ) === 200;
    body.removeChild( div );
  }

}

// -------------------------- getSize -------------------------- //

function getSize( elem ) {
  setup();

  // use querySeletor if elem is string
  if ( typeof elem === 'string' ) {
    elem = document.querySelector( elem );
  }

  // do not proceed on non-objects
  if ( !elem || typeof elem !== 'object' || !elem.nodeType ) {
    return;
  }

  var style = getStyle( elem );

  // if hidden, everything is 0
  if ( style.display === 'none' ) {
    return getZeroSize();
  }

  var size = {};
  size.width = elem.offsetWidth;
  size.height = elem.offsetHeight;

  var isBorderBox = size.isBorderBox = !!( boxSizingProp &&
    style[ boxSizingProp ] && style[ boxSizingProp ] === 'border-box' );

  // get all measurements
  for ( var i=0, len = measurements.length; i < len; i++ ) {
    var measurement = measurements[i];
    var value = style[ measurement ];
    value = mungeNonPixel( elem, value );
    var num = parseFloat( value );
    // any 'auto', 'medium' value will be 0
    size[ measurement ] = !isNaN( num ) ? num : 0;
  }

  var paddingWidth = size.paddingLeft + size.paddingRight;
  var paddingHeight = size.paddingTop + size.paddingBottom;
  var marginWidth = size.marginLeft + size.marginRight;
  var marginHeight = size.marginTop + size.marginBottom;
  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

  // overwrite width and height if we can get it from style
  var styleWidth = getStyleSize( style.width );
  if ( styleWidth !== false ) {
    size.width = styleWidth +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
  }

  var styleHeight = getStyleSize( style.height );
  if ( styleHeight !== false ) {
    size.height = styleHeight +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
  }

  size.innerWidth = size.width - ( paddingWidth + borderWidth );
  size.innerHeight = size.height - ( paddingHeight + borderHeight );

  size.outerWidth = size.width + marginWidth;
  size.outerHeight = size.height + marginHeight;

  return size;
}

// IE8 returns percent values, not pixels
// taken from jQuery's curCSS
function mungeNonPixel( elem, value ) {
  // IE8 and has percent value
  if ( window.getComputedStyle || value.indexOf('%') === -1 ) {
    return value;
  }
  var style = elem.style;
  // Remember the original values
  var left = style.left;
  var rs = elem.runtimeStyle;
  var rsLeft = rs && rs.left;

  // Put in the new values to get a computed value out
  if ( rsLeft ) {
    rs.left = elem.currentStyle.left;
  }
  style.left = value;
  value = style.pixelLeft;

  // Revert the changed values
  style.left = left;
  if ( rsLeft ) {
    rs.left = rsLeft;
  }

  return value;
}

return getSize;

}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD for RequireJS
  define( 'get-size/get-size',[ 'get-style-property/get-style-property' ], defineGetSize );
} else if ( typeof exports === 'object' ) {
  // CommonJS for Component
  module.exports = defineGetSize( require('desandro-get-style-property') );
} else {
  // browser global
  window.getSize = defineGetSize( window.getStyleProperty );
}

})( window );

/*!
 * docReady v1.0.4
 * Cross browser DOMContentLoaded event emitter
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true*/
/*global define: false, require: false, module: false */

( function( window ) {



var document = window.document;
// collection of functions to be triggered on ready
var queue = [];

function docReady( fn ) {
  // throw out non-functions
  if ( typeof fn !== 'function' ) {
    return;
  }

  if ( docReady.isReady ) {
    // ready now, hit it
    fn();
  } else {
    // queue function when ready
    queue.push( fn );
  }
}

docReady.isReady = false;

// triggered on various doc ready events
function onReady( event ) {
  // bail if already triggered or IE8 document is not ready just yet
  var isIE8NotReady = event.type === 'readystatechange' && document.readyState !== 'complete';
  if ( docReady.isReady || isIE8NotReady ) {
    return;
  }

  trigger();
}

function trigger() {
  docReady.isReady = true;
  // process queue
  for ( var i=0, len = queue.length; i < len; i++ ) {
    var fn = queue[i];
    fn();
  }
}

function defineDocReady( eventie ) {
  // trigger ready if page is ready
  if ( document.readyState === 'complete' ) {
    trigger();
  } else {
    // listen for events
    eventie.bind( document, 'DOMContentLoaded', onReady );
    eventie.bind( document, 'readystatechange', onReady );
    eventie.bind( window, 'load', onReady );
  }

  return docReady;
}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'doc-ready/doc-ready',[ 'eventie/eventie' ], defineDocReady );
} else if ( typeof exports === 'object' ) {
  module.exports = defineDocReady( require('eventie') );
} else {
  // browser global
  window.docReady = defineDocReady( window.eventie );
}

})( window );

/**
 * matchesSelector v1.0.3
 * matchesSelector( element, '.selector' )
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false */

( function( ElemProto ) {

  'use strict';

  var matchesMethod = ( function() {
    // check for the standard method name first
    if ( ElemProto.matches ) {
      return 'matches';
    }
    // check un-prefixed
    if ( ElemProto.matchesSelector ) {
      return 'matchesSelector';
    }
    // check vendor prefixes
    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

    for ( var i=0, len = prefixes.length; i < len; i++ ) {
      var prefix = prefixes[i];
      var method = prefix + 'MatchesSelector';
      if ( ElemProto[ method ] ) {
        return method;
      }
    }
  })();

  // ----- match ----- //

  function match( elem, selector ) {
    return elem[ matchesMethod ]( selector );
  }

  // ----- appendToFragment ----- //

  function checkParent( elem ) {
    // not needed if already has parent
    if ( elem.parentNode ) {
      return;
    }
    var fragment = document.createDocumentFragment();
    fragment.appendChild( elem );
  }

  // ----- query ----- //

  // fall back to using QSA
  // thx @jonathantneal https://gist.github.com/3062955
  function query( elem, selector ) {
    // append to fragment if no parent
    checkParent( elem );

    // match elem with all selected elems of parent
    var elems = elem.parentNode.querySelectorAll( selector );
    for ( var i=0, len = elems.length; i < len; i++ ) {
      // return true if match
      if ( elems[i] === elem ) {
        return true;
      }
    }
    // otherwise return false
    return false;
  }

  // ----- matchChild ----- //

  function matchChild( elem, selector ) {
    checkParent( elem );
    return match( elem, selector );
  }

  // ----- matchesSelector ----- //

  var matchesSelector;

  if ( matchesMethod ) {
    // IE9 supports matchesSelector, but doesn't work on orphaned elems
    // check for that
    var div = document.createElement('div');
    var supportsOrphans = match( div, 'div' );
    matchesSelector = supportsOrphans ? match : matchChild;
  } else {
    matchesSelector = query;
  }

  // transport
  if ( typeof define === 'function' && define.amd ) {
    // AMD
    define( 'matches-selector/matches-selector',[],function() {
      return matchesSelector;
    });
  } else if ( typeof exports === 'object' ) {
    module.exports = matchesSelector;
  }
  else {
    // browser global
    window.matchesSelector = matchesSelector;
  }

})( Element.prototype );

/**
 * Fizzy UI utils v1.0.1
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true, strict: true */

( function( window, factory ) {
  /*global define: false, module: false, require: false */
  'use strict';
  // universal module definition

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'fizzy-ui-utils/utils',[
      'doc-ready/doc-ready',
      'matches-selector/matches-selector'
    ], function( docReady, matchesSelector ) {
      return factory( window, docReady, matchesSelector );
    });
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      window,
      require('doc-ready'),
      require('desandro-matches-selector')
    );
  } else {
    // browser global
    window.fizzyUIUtils = factory(
      window,
      window.docReady,
      window.matchesSelector
    );
  }

}( window, function factory( window, docReady, matchesSelector ) {



var utils = {};

// ----- extend ----- //

// extends objects
utils.extend = function( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
};

// ----- modulo ----- //

utils.modulo = function( num, div ) {
  return ( ( num % div ) + div ) % div;
};

// ----- isArray ----- //
  
var objToString = Object.prototype.toString;
utils.isArray = function( obj ) {
  return objToString.call( obj ) == '[object Array]';
};

// ----- makeArray ----- //

// turn element or nodeList into an array
utils.makeArray = function( obj ) {
  var ary = [];
  if ( utils.isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( obj && typeof obj.length == 'number' ) {
    // convert nodeList to array
    for ( var i=0, len = obj.length; i < len; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
};

// ----- indexOf ----- //

// index of helper cause IE8
utils.indexOf = Array.prototype.indexOf ? function( ary, obj ) {
    return ary.indexOf( obj );
  } : function( ary, obj ) {
    for ( var i=0, len = ary.length; i < len; i++ ) {
      if ( ary[i] === obj ) {
        return i;
      }
    }
    return -1;
  };

// ----- removeFrom ----- //

utils.removeFrom = function( ary, obj ) {
  var index = utils.indexOf( ary, obj );
  if ( index != -1 ) {
    ary.splice( index, 1 );
  }
};

// ----- isElement ----- //

// http://stackoverflow.com/a/384380/182183
utils.isElement = ( typeof HTMLElement == 'function' || typeof HTMLElement == 'object' ) ?
  function isElementDOM2( obj ) {
    return obj instanceof HTMLElement;
  } :
  function isElementQuirky( obj ) {
    return obj && typeof obj == 'object' &&
      obj.nodeType == 1 && typeof obj.nodeName == 'string';
  };

// ----- setText ----- //

utils.setText = ( function() {
  var setTextProperty;
  function setText( elem, text ) {
    // only check setTextProperty once
    setTextProperty = setTextProperty || ( document.documentElement.textContent !== undefined ? 'textContent' : 'innerText' );
    elem[ setTextProperty ] = text;
  }
  return setText;
})();

// ----- getParent ----- //

utils.getParent = function( elem, selector ) {
  while ( elem != document.body ) {
    elem = elem.parentNode;
    if ( matchesSelector( elem, selector ) ) {
      return elem;
    }
  }
};

// ----- getQueryElement ----- //

// use element as selector string
utils.getQueryElement = function( elem ) {
  if ( typeof elem == 'string' ) {
    return document.querySelector( elem );
  }
  return elem;
};

// ----- handleEvent ----- //

// enable .ontype to trigger from .addEventListener( elem, 'type' )
utils.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

// ----- filterFindElements ----- //

utils.filterFindElements = function( elems, selector ) {
  // make array of elems
  elems = utils.makeArray( elems );
  var ffElems = [];

  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    // check that elem is an actual element
    if ( !utils.isElement( elem ) ) {
      continue;
    }
    // filter & find items if we have a selector
    if ( selector ) {
      // filter siblings
      if ( matchesSelector( elem, selector ) ) {
        ffElems.push( elem );
      }
      // find children
      var childElems = elem.querySelectorAll( selector );
      // concat childElems to filterFound array
      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
        ffElems.push( childElems[j] );
      }
    } else {
      ffElems.push( elem );
    }
  }

  return ffElems;
};

// ----- debounceMethod ----- //

utils.debounceMethod = function( _class, methodName, threshold ) {
  // original method
  var method = _class.prototype[ methodName ];
  var timeoutName = methodName + 'Timeout';

  _class.prototype[ methodName ] = function() {
    var timeout = this[ timeoutName ];
    if ( timeout ) {
      clearTimeout( timeout );
    }
    var args = arguments;

    var _this = this;
    this[ timeoutName ] = setTimeout( function() {
      method.apply( _this, args );
      delete _this[ timeoutName ];
    }, threshold || 100 );
  };
};

// ----- htmlInit ----- //

// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
utils.toDashed = function( str ) {
  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
    return $1 + '-' + $2;
  }).toLowerCase();
};

var console = window.console;
/**
 * allow user to initialize classes via .js-namespace class
 * htmlInit( Widget, 'widgetName' )
 * options are parsed from data-namespace-option attribute
 */
utils.htmlInit = function( WidgetClass, namespace ) {
  docReady( function() {
    var dashedNamespace = utils.toDashed( namespace );
    var elems = document.querySelectorAll( '.js-' + dashedNamespace );
    var dataAttr = 'data-' + dashedNamespace + '-options';

    for ( var i=0, len = elems.length; i < len; i++ ) {
      var elem = elems[i];
      var attr = elem.getAttribute( dataAttr );
      var options;
      try {
        options = attr && JSON.parse( attr );
      } catch ( error ) {
        // log error, do not initialize
        if ( console ) {
          console.error( 'Error parsing ' + dataAttr + ' on ' +
            elem.nodeName.toLowerCase() + ( elem.id ? '#' + elem.id : '' ) + ': ' +
            error );
        }
        continue;
      }
      // initialize
      var instance = new WidgetClass( elem, options );
      // make available via $().data('layoutname')
      var jQuery = window.jQuery;
      if ( jQuery ) {
        jQuery.data( elem, namespace, instance );
      }
    }
  });
};

// -----  ----- //

return utils;

}));

/**
 * Outlayer Item
 */

( function( window, factory ) {
  'use strict';
  // universal module definition
  if ( typeof define === 'function' && define.amd ) {
    // AMD
    define( 'outlayer/item',[
        'eventEmitter/EventEmitter',
        'get-size/get-size',
        'get-style-property/get-style-property',
        'fizzy-ui-utils/utils'
      ],
      function( EventEmitter, getSize, getStyleProperty, utils ) {
        return factory( window, EventEmitter, getSize, getStyleProperty, utils );
      }
    );
  } else if (typeof exports === 'object') {
    // CommonJS
    module.exports = factory(
      window,
      require('wolfy87-eventemitter'),
      require('get-size'),
      require('desandro-get-style-property'),
      require('fizzy-ui-utils')
    );
  } else {
    // browser global
    window.Outlayer = {};
    window.Outlayer.Item = factory(
      window,
      window.EventEmitter,
      window.getSize,
      window.getStyleProperty,
      window.fizzyUIUtils
    );
  }

}( window, function factory( window, EventEmitter, getSize, getStyleProperty, utils ) {
'use strict';

// ----- helpers ----- //

var getComputedStyle = window.getComputedStyle;
var getStyle = getComputedStyle ?
  function( elem ) {
    return getComputedStyle( elem, null );
  } :
  function( elem ) {
    return elem.currentStyle;
  };


function isEmptyObj( obj ) {
  for ( var prop in obj ) {
    return false;
  }
  prop = null;
  return true;
}

// -------------------------- CSS3 support -------------------------- //

var transitionProperty = getStyleProperty('transition');
var transformProperty = getStyleProperty('transform');
var supportsCSS3 = transitionProperty && transformProperty;
var is3d = !!getStyleProperty('perspective');

var transitionEndEvent = {
  WebkitTransition: 'webkitTransitionEnd',
  MozTransition: 'transitionend',
  OTransition: 'otransitionend',
  transition: 'transitionend'
}[ transitionProperty ];

// properties that could have vendor prefix
var prefixableProperties = [
  'transform',
  'transition',
  'transitionDuration',
  'transitionProperty'
];

// cache all vendor properties
var vendorProperties = ( function() {
  var cache = {};
  for ( var i=0, len = prefixableProperties.length; i < len; i++ ) {
    var prop = prefixableProperties[i];
    var supportedProp = getStyleProperty( prop );
    if ( supportedProp && supportedProp !== prop ) {
      cache[ prop ] = supportedProp;
    }
  }
  return cache;
})();

// -------------------------- Item -------------------------- //

function Item( element, layout ) {
  if ( !element ) {
    return;
  }

  this.element = element;
  // parent layout class, i.e. Masonry, Isotope, or Packery
  this.layout = layout;
  this.position = {
    x: 0,
    y: 0
  };

  this._create();
}

// inherit EventEmitter
utils.extend( Item.prototype, EventEmitter.prototype );

Item.prototype._create = function() {
  // transition objects
  this._transn = {
    ingProperties: {},
    clean: {},
    onEnd: {}
  };

  this.css({
    position: 'absolute'
  });
};

// trigger specified handler for event type
Item.prototype.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

Item.prototype.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * apply CSS styles to element
 * @param {Object} style
 */
Item.prototype.css = function( style ) {
  var elemStyle = this.element.style;

  for ( var prop in style ) {
    // use vendor property if available
    var supportedProp = vendorProperties[ prop ] || prop;
    elemStyle[ supportedProp ] = style[ prop ];
  }
};

 // measure position, and sets it
Item.prototype.getPosition = function() {
  var style = getStyle( this.element );
  var layoutOptions = this.layout.options;
  var isOriginLeft = layoutOptions.isOriginLeft;
  var isOriginTop = layoutOptions.isOriginTop;
  var xValue = style[ isOriginLeft ? 'left' : 'right' ];
  var yValue = style[ isOriginTop ? 'top' : 'bottom' ];
  // convert percent to pixels
  var layoutSize = this.layout.size;
  var x = xValue.indexOf('%') != -1 ?
    ( parseFloat( xValue ) / 100 ) * layoutSize.width : parseInt( xValue, 10 );
  var y = yValue.indexOf('%') != -1 ?
    ( parseFloat( yValue ) / 100 ) * layoutSize.height : parseInt( yValue, 10 );

  // clean up 'auto' or other non-integer values
  x = isNaN( x ) ? 0 : x;
  y = isNaN( y ) ? 0 : y;
  // remove padding from measurement
  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

  this.position.x = x;
  this.position.y = y;
};

// set settled position, apply padding
Item.prototype.layoutPosition = function() {
  var layoutSize = this.layout.size;
  var layoutOptions = this.layout.options;
  var style = {};

  // x
  var xPadding = layoutOptions.isOriginLeft ? 'paddingLeft' : 'paddingRight';
  var xProperty = layoutOptions.isOriginLeft ? 'left' : 'right';
  var xResetProperty = layoutOptions.isOriginLeft ? 'right' : 'left';

  var x = this.position.x + layoutSize[ xPadding ];
  // set in percentage or pixels
  style[ xProperty ] = this.getXValue( x );
  // reset other property
  style[ xResetProperty ] = '';

  // y
  var yPadding = layoutOptions.isOriginTop ? 'paddingTop' : 'paddingBottom';
  var yProperty = layoutOptions.isOriginTop ? 'top' : 'bottom';
  var yResetProperty = layoutOptions.isOriginTop ? 'bottom' : 'top';

  var y = this.position.y + layoutSize[ yPadding ];
  // set in percentage or pixels
  style[ yProperty ] = this.getYValue( y );
  // reset other property
  style[ yResetProperty ] = '';

  this.css( style );
  this.emitEvent( 'layout', [ this ] );
};

Item.prototype.getXValue = function( x ) {
  var layoutOptions = this.layout.options;
  return layoutOptions.percentPosition && !layoutOptions.isHorizontal ?
    ( ( x / this.layout.size.width ) * 100 ) + '%' : x + 'px';
};

Item.prototype.getYValue = function( y ) {
  var layoutOptions = this.layout.options;
  return layoutOptions.percentPosition && layoutOptions.isHorizontal ?
    ( ( y / this.layout.size.height ) * 100 ) + '%' : y + 'px';
};


Item.prototype._transitionTo = function( x, y ) {
  this.getPosition();
  // get current x & y from top/left
  var curX = this.position.x;
  var curY = this.position.y;

  var compareX = parseInt( x, 10 );
  var compareY = parseInt( y, 10 );
  var didNotMove = compareX === this.position.x && compareY === this.position.y;

  // save end position
  this.setPosition( x, y );

  // if did not move and not transitioning, just go to layout
  if ( didNotMove && !this.isTransitioning ) {
    this.layoutPosition();
    return;
  }

  var transX = x - curX;
  var transY = y - curY;
  var transitionStyle = {};
  transitionStyle.transform = this.getTranslate( transX, transY );

  this.transition({
    to: transitionStyle,
    onTransitionEnd: {
      transform: this.layoutPosition
    },
    isCleaning: true
  });
};

Item.prototype.getTranslate = function( x, y ) {
  // flip cooridinates if origin on right or bottom
  var layoutOptions = this.layout.options;
  x = layoutOptions.isOriginLeft ? x : -x;
  y = layoutOptions.isOriginTop ? y : -y;

  if ( is3d ) {
    return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
  }

  return 'translate(' + x + 'px, ' + y + 'px)';
};

// non transition + transform support
Item.prototype.goTo = function( x, y ) {
  this.setPosition( x, y );
  this.layoutPosition();
};

// use transition and transforms if supported
Item.prototype.moveTo = supportsCSS3 ?
  Item.prototype._transitionTo : Item.prototype.goTo;

Item.prototype.setPosition = function( x, y ) {
  this.position.x = parseInt( x, 10 );
  this.position.y = parseInt( y, 10 );
};

// ----- transition ----- //

/**
 * @param {Object} style - CSS
 * @param {Function} onTransitionEnd
 */

// non transition, just trigger callback
Item.prototype._nonTransition = function( args ) {
  this.css( args.to );
  if ( args.isCleaning ) {
    this._removeStyles( args.to );
  }
  for ( var prop in args.onTransitionEnd ) {
    args.onTransitionEnd[ prop ].call( this );
  }
};

/**
 * proper transition
 * @param {Object} args - arguments
 *   @param {Object} to - style to transition to
 *   @param {Object} from - style to start transition from
 *   @param {Boolean} isCleaning - removes transition styles after transition
 *   @param {Function} onTransitionEnd - callback
 */
Item.prototype._transition = function( args ) {
  // redirect to nonTransition if no transition duration
  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
    this._nonTransition( args );
    return;
  }

  var _transition = this._transn;
  // keep track of onTransitionEnd callback by css property
  for ( var prop in args.onTransitionEnd ) {
    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
  }
  // keep track of properties that are transitioning
  for ( prop in args.to ) {
    _transition.ingProperties[ prop ] = true;
    // keep track of properties to clean up when transition is done
    if ( args.isCleaning ) {
      _transition.clean[ prop ] = true;
    }
  }

  // set from styles
  if ( args.from ) {
    this.css( args.from );
    // force redraw. http://blog.alexmaccaw.com/css-transitions
    var h = this.element.offsetHeight;
    // hack for JSHint to hush about unused var
    h = null;
  }
  // enable transition
  this.enableTransition( args.to );
  // set styles that are transitioning
  this.css( args.to );

  this.isTransitioning = true;

};

// dash before all cap letters, including first for
// WebkitTransform => -webkit-transform
function toDashedAll( str ) {
  return str.replace( /([A-Z])/g, function( $1 ) {
    return '-' + $1.toLowerCase();
  });
}

var transitionProps = 'opacity,' +
  toDashedAll( vendorProperties.transform || 'transform' );

Item.prototype.enableTransition = function(/* style */) {
  // HACK changing transitionProperty during a transition
  // will cause transition to jump
  if ( this.isTransitioning ) {
    return;
  }

  // make `transition: foo, bar, baz` from style object
  // HACK un-comment this when enableTransition can work
  // while a transition is happening
  // var transitionValues = [];
  // for ( var prop in style ) {
  //   // dash-ify camelCased properties like WebkitTransition
  //   prop = vendorProperties[ prop ] || prop;
  //   transitionValues.push( toDashedAll( prop ) );
  // }
  // enable transition styles
  this.css({
    transitionProperty: transitionProps,
    transitionDuration: this.layout.options.transitionDuration
  });
  // listen for transition end event
  this.element.addEventListener( transitionEndEvent, this, false );
};

Item.prototype.transition = Item.prototype[ transitionProperty ? '_transition' : '_nonTransition' ];

// ----- events ----- //

Item.prototype.onwebkitTransitionEnd = function( event ) {
  this.ontransitionend( event );
};

Item.prototype.onotransitionend = function( event ) {
  this.ontransitionend( event );
};

// properties that I munge to make my life easier
var dashedVendorProperties = {
  '-webkit-transform': 'transform',
  '-moz-transform': 'transform',
  '-o-transform': 'transform'
};

Item.prototype.ontransitionend = function( event ) {
  // disregard bubbled events from children
  if ( event.target !== this.element ) {
    return;
  }
  var _transition = this._transn;
  // get property name of transitioned property, convert to prefix-free
  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

  // remove property that has completed transitioning
  delete _transition.ingProperties[ propertyName ];
  // check if any properties are still transitioning
  if ( isEmptyObj( _transition.ingProperties ) ) {
    // all properties have completed transitioning
    this.disableTransition();
  }
  // clean style
  if ( propertyName in _transition.clean ) {
    // clean up style
    this.element.style[ event.propertyName ] = '';
    delete _transition.clean[ propertyName ];
  }
  // trigger onTransitionEnd callback
  if ( propertyName in _transition.onEnd ) {
    var onTransitionEnd = _transition.onEnd[ propertyName ];
    onTransitionEnd.call( this );
    delete _transition.onEnd[ propertyName ];
  }

  this.emitEvent( 'transitionEnd', [ this ] );
};

Item.prototype.disableTransition = function() {
  this.removeTransitionStyles();
  this.element.removeEventListener( transitionEndEvent, this, false );
  this.isTransitioning = false;
};

/**
 * removes style property from element
 * @param {Object} style
**/
Item.prototype._removeStyles = function( style ) {
  // clean up transition styles
  var cleanStyle = {};
  for ( var prop in style ) {
    cleanStyle[ prop ] = '';
  }
  this.css( cleanStyle );
};

var cleanTransitionStyle = {
  transitionProperty: '',
  transitionDuration: ''
};

Item.prototype.removeTransitionStyles = function() {
  // remove transition
  this.css( cleanTransitionStyle );
};

// ----- show/hide/remove ----- //

// remove element from DOM
Item.prototype.removeElem = function() {
  this.element.parentNode.removeChild( this.element );
  // remove display: none
  this.css({ display: '' });
  this.emitEvent( 'remove', [ this ] );
};

Item.prototype.remove = function() {
  // just remove element if no transition support or no transition
  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
    this.removeElem();
    return;
  }

  // start transition
  var _this = this;
  this.once( 'transitionEnd', function() {
    _this.removeElem();
  });
  this.hide();
};

Item.prototype.reveal = function() {
  delete this.isHidden;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('visibleStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onRevealTransitionEnd;

  this.transition({
    from: options.hiddenStyle,
    to: options.visibleStyle,
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

Item.prototype.onRevealTransitionEnd = function() {
  // check if still visible
  // during transition, item may have been hidden
  if ( !this.isHidden ) {
    this.emitEvent('reveal');
  }
};

/**
 * get style property use for hide/reveal transition end
 * @param {String} styleProperty - hiddenStyle/visibleStyle
 * @returns {String}
 */
Item.prototype.getHideRevealTransitionEndProperty = function( styleProperty ) {
  var optionStyle = this.layout.options[ styleProperty ];
  // use opacity
  if ( optionStyle.opacity ) {
    return 'opacity';
  }
  // get first property
  for ( var prop in optionStyle ) {
    return prop;
  }
};

Item.prototype.hide = function() {
  // set flag
  this.isHidden = true;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('hiddenStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onHideTransitionEnd;

  this.transition({
    from: options.visibleStyle,
    to: options.hiddenStyle,
    // keep hidden stuff hidden
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

Item.prototype.onHideTransitionEnd = function() {
  // check if still hidden
  // during transition, item may have been un-hidden
  if ( this.isHidden ) {
    this.css({ display: 'none' });
    this.emitEvent('hide');
  }
};

Item.prototype.destroy = function() {
  this.css({
    position: '',
    left: '',
    right: '',
    top: '',
    bottom: '',
    transition: '',
    transform: ''
  });
};

return Item;

}));

/*!
 * Outlayer v1.4.2
 * the brains and guts of a layout library
 * MIT license
 */

( function( window, factory ) {
  'use strict';
  // universal module definition

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'outlayer/outlayer',[
        'eventie/eventie',
        'eventEmitter/EventEmitter',
        'get-size/get-size',
        'fizzy-ui-utils/utils',
        './item'
      ],
      function( eventie, EventEmitter, getSize, utils, Item ) {
        return factory( window, eventie, EventEmitter, getSize, utils, Item);
      }
    );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      window,
      require('eventie'),
      require('wolfy87-eventemitter'),
      require('get-size'),
      require('fizzy-ui-utils'),
      require('./item')
    );
  } else {
    // browser global
    window.Outlayer = factory(
      window,
      window.eventie,
      window.EventEmitter,
      window.getSize,
      window.fizzyUIUtils,
      window.Outlayer.Item
    );
  }

}( window, function factory( window, eventie, EventEmitter, getSize, utils, Item ) {
'use strict';

// ----- vars ----- //

var console = window.console;
var jQuery = window.jQuery;
var noop = function() {};

// -------------------------- Outlayer -------------------------- //

// globally unique identifiers
var GUID = 0;
// internal store of all Outlayer intances
var instances = {};


/**
 * @param {Element, String} element
 * @param {Object} options
 * @constructor
 */
function Outlayer( element, options ) {
  var queryElement = utils.getQueryElement( element );
  if ( !queryElement ) {
    if ( console ) {
      console.error( 'Bad element for ' + this.constructor.namespace +
        ': ' + ( queryElement || element ) );
    }
    return;
  }
  this.element = queryElement;
  // add jQuery
  if ( jQuery ) {
    this.$element = jQuery( this.element );
  }

  // options
  this.options = utils.extend( {}, this.constructor.defaults );
  this.option( options );

  // add id for Outlayer.getFromElement
  var id = ++GUID;
  this.element.outlayerGUID = id; // expando
  instances[ id ] = this; // associate via id

  // kick it off
  this._create();

  if ( this.options.isInitLayout ) {
    this.layout();
  }
}

// settings are for internal use only
Outlayer.namespace = 'outlayer';
Outlayer.Item = Item;

// default options
Outlayer.defaults = {
  containerStyle: {
    position: 'relative'
  },
  isInitLayout: true,
  isOriginLeft: true,
  isOriginTop: true,
  isResizeBound: true,
  isResizingContainer: true,
  // item options
  transitionDuration: '0.4s',
  hiddenStyle: {
    opacity: 0,
    transform: 'scale(0.001)'
  },
  visibleStyle: {
    opacity: 1,
    transform: 'scale(1)'
  }
};

// inherit EventEmitter
utils.extend( Outlayer.prototype, EventEmitter.prototype );

/**
 * set options
 * @param {Object} opts
 */
Outlayer.prototype.option = function( opts ) {
  utils.extend( this.options, opts );
};

Outlayer.prototype._create = function() {
  // get items from children
  this.reloadItems();
  // elements that affect layout, but are not laid out
  this.stamps = [];
  this.stamp( this.options.stamp );
  // set container style
  utils.extend( this.element.style, this.options.containerStyle );

  // bind resize method
  if ( this.options.isResizeBound ) {
    this.bindResize();
  }
};

// goes through all children again and gets bricks in proper order
Outlayer.prototype.reloadItems = function() {
  // collection of item elements
  this.items = this._itemize( this.element.children );
};


/**
 * turn elements into Outlayer.Items to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - collection of new Outlayer Items
 */
Outlayer.prototype._itemize = function( elems ) {

  var itemElems = this._filterFindItemElements( elems );
  var Item = this.constructor.Item;

  // create new Outlayer Items for collection
  var items = [];
  for ( var i=0, len = itemElems.length; i < len; i++ ) {
    var elem = itemElems[i];
    var item = new Item( elem, this );
    items.push( item );
  }

  return items;
};

/**
 * get item elements to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - item elements
 */
Outlayer.prototype._filterFindItemElements = function( elems ) {
  return utils.filterFindElements( elems, this.options.itemSelector );
};

/**
 * getter method for getting item elements
 * @returns {Array} elems - collection of item elements
 */
Outlayer.prototype.getItemElements = function() {
  var elems = [];
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    elems.push( this.items[i].element );
  }
  return elems;
};

// ----- init & layout ----- //

/**
 * lays out all items
 */
Outlayer.prototype.layout = function() {
  this._resetLayout();
  this._manageStamps();

  // don't animate first layout
  var isInstant = this.options.isLayoutInstant !== undefined ?
    this.options.isLayoutInstant : !this._isLayoutInited;
  this.layoutItems( this.items, isInstant );

  // flag for initalized
  this._isLayoutInited = true;
};

// _init is alias for layout
Outlayer.prototype._init = Outlayer.prototype.layout;

/**
 * logic before any new layout
 */
Outlayer.prototype._resetLayout = function() {
  this.getSize();
};


Outlayer.prototype.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * get measurement from option, for columnWidth, rowHeight, gutter
 * if option is String -> get element from selector string, & get size of element
 * if option is Element -> get size of element
 * else use option as a number
 *
 * @param {String} measurement
 * @param {String} size - width or height
 * @private
 */
Outlayer.prototype._getMeasurement = function( measurement, size ) {
  var option = this.options[ measurement ];
  var elem;
  if ( !option ) {
    // default to 0
    this[ measurement ] = 0;
  } else {
    // use option as an element
    if ( typeof option === 'string' ) {
      elem = this.element.querySelector( option );
    } else if ( utils.isElement( option ) ) {
      elem = option;
    }
    // use size of element, if element
    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
  }
};

/**
 * layout a collection of item elements
 * @api public
 */
Outlayer.prototype.layoutItems = function( items, isInstant ) {
  items = this._getItemsForLayout( items );

  this._layoutItems( items, isInstant );

  this._postLayout();
};

/**
 * get the items to be laid out
 * you may want to skip over some items
 * @param {Array} items
 * @returns {Array} items
 */
Outlayer.prototype._getItemsForLayout = function( items ) {
  var layoutItems = [];
  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    if ( !item.isIgnored ) {
      layoutItems.push( item );
    }
  }
  return layoutItems;
};

/**
 * layout items
 * @param {Array} items
 * @param {Boolean} isInstant
 */
Outlayer.prototype._layoutItems = function( items, isInstant ) {
  this._emitCompleteOnItems( 'layout', items );

  if ( !items || !items.length ) {
    // no items, emit event with empty array
    return;
  }

  var queue = [];

  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    // get x/y object from method
    var position = this._getItemLayoutPosition( item );
    // enqueue
    position.item = item;
    position.isInstant = isInstant || item.isLayoutInstant;
    queue.push( position );
  }

  this._processLayoutQueue( queue );
};

/**
 * get item layout position
 * @param {Outlayer.Item} item
 * @returns {Object} x and y position
 */
Outlayer.prototype._getItemLayoutPosition = function( /* item */ ) {
  return {
    x: 0,
    y: 0
  };
};

/**
 * iterate over array and position each item
 * Reason being - separating this logic prevents 'layout invalidation'
 * thx @paul_irish
 * @param {Array} queue
 */
Outlayer.prototype._processLayoutQueue = function( queue ) {
  for ( var i=0, len = queue.length; i < len; i++ ) {
    var obj = queue[i];
    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant );
  }
};

/**
 * Sets position of item in DOM
 * @param {Outlayer.Item} item
 * @param {Number} x - horizontal position
 * @param {Number} y - vertical position
 * @param {Boolean} isInstant - disables transitions
 */
Outlayer.prototype._positionItem = function( item, x, y, isInstant ) {
  if ( isInstant ) {
    // if not transition, just set CSS
    item.goTo( x, y );
  } else {
    item.moveTo( x, y );
  }
};

/**
 * Any logic you want to do after each layout,
 * i.e. size the container
 */
Outlayer.prototype._postLayout = function() {
  this.resizeContainer();
};

Outlayer.prototype.resizeContainer = function() {
  if ( !this.options.isResizingContainer ) {
    return;
  }
  var size = this._getContainerSize();
  if ( size ) {
    this._setContainerMeasure( size.width, true );
    this._setContainerMeasure( size.height, false );
  }
};

/**
 * Sets width or height of container if returned
 * @returns {Object} size
 *   @param {Number} width
 *   @param {Number} height
 */
Outlayer.prototype._getContainerSize = noop;

/**
 * @param {Number} measure - size of width or height
 * @param {Boolean} isWidth
 */
Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
  if ( measure === undefined ) {
    return;
  }

  var elemSize = this.size;
  // add padding and border width if border box
  if ( elemSize.isBorderBox ) {
    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
      elemSize.borderLeftWidth + elemSize.borderRightWidth :
      elemSize.paddingBottom + elemSize.paddingTop +
      elemSize.borderTopWidth + elemSize.borderBottomWidth;
  }

  measure = Math.max( measure, 0 );
  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
};

/**
 * emit eventComplete on a collection of items events
 * @param {String} eventName
 * @param {Array} items - Outlayer.Items
 */
Outlayer.prototype._emitCompleteOnItems = function( eventName, items ) {
  var _this = this;
  function onComplete() {
    _this.dispatchEvent( eventName + 'Complete', null, [ items ] );
  }

  var count = items.length;
  if ( !items || !count ) {
    onComplete();
    return;
  }

  var doneCount = 0;
  function tick() {
    doneCount++;
    if ( doneCount === count ) {
      onComplete();
    }
  }

  // bind callback
  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    item.once( eventName, tick );
  }
};

/**
 * emits events via eventEmitter and jQuery events
 * @param {String} type - name of event
 * @param {Event} event - original event
 * @param {Array} args - extra arguments
 */
Outlayer.prototype.dispatchEvent = function( type, event, args ) {
  // add original event to arguments
  var emitArgs = event ? [ event ].concat( args ) : args;
  this.emitEvent( type, emitArgs );

  if ( jQuery ) {
    // set this.$element
    this.$element = this.$element || jQuery( this.element );
    if ( event ) {
      // create jQuery event
      var $event = jQuery.Event( event );
      $event.type = type;
      this.$element.trigger( $event, args );
    } else {
      // just trigger with type if no event available
      this.$element.trigger( type, args );
    }
  }
};

// -------------------------- ignore & stamps -------------------------- //


/**
 * keep item in collection, but do not lay it out
 * ignored items do not get skipped in layout
 * @param {Element} elem
 */
Outlayer.prototype.ignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    item.isIgnored = true;
  }
};

/**
 * return item to layout collection
 * @param {Element} elem
 */
Outlayer.prototype.unignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    delete item.isIgnored;
  }
};

/**
 * adds elements to stamps
 * @param {NodeList, Array, Element, or String} elems
 */
Outlayer.prototype.stamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ) {
    return;
  }

  this.stamps = this.stamps.concat( elems );
  // ignore
  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    this.ignore( elem );
  }
};

/**
 * removes elements to stamps
 * @param {NodeList, Array, or Element} elems
 */
Outlayer.prototype.unstamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ){
    return;
  }

  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    // filter out removed stamp elements
    utils.removeFrom( this.stamps, elem );
    this.unignore( elem );
  }

};

/**
 * finds child elements
 * @param {NodeList, Array, Element, or String} elems
 * @returns {Array} elems
 */
Outlayer.prototype._find = function( elems ) {
  if ( !elems ) {
    return;
  }
  // if string, use argument as selector string
  if ( typeof elems === 'string' ) {
    elems = this.element.querySelectorAll( elems );
  }
  elems = utils.makeArray( elems );
  return elems;
};

Outlayer.prototype._manageStamps = function() {
  if ( !this.stamps || !this.stamps.length ) {
    return;
  }

  this._getBoundingRect();

  for ( var i=0, len = this.stamps.length; i < len; i++ ) {
    var stamp = this.stamps[i];
    this._manageStamp( stamp );
  }
};

// update boundingLeft / Top
Outlayer.prototype._getBoundingRect = function() {
  // get bounding rect for container element
  var boundingRect = this.element.getBoundingClientRect();
  var size = this.size;
  this._boundingRect = {
    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
  };
};

/**
 * @param {Element} stamp
**/
Outlayer.prototype._manageStamp = noop;

/**
 * get x/y position of element relative to container element
 * @param {Element} elem
 * @returns {Object} offset - has left, top, right, bottom
 */
Outlayer.prototype._getElementOffset = function( elem ) {
  var boundingRect = elem.getBoundingClientRect();
  var thisRect = this._boundingRect;
  var size = getSize( elem );
  var offset = {
    left: boundingRect.left - thisRect.left - size.marginLeft,
    top: boundingRect.top - thisRect.top - size.marginTop,
    right: thisRect.right - boundingRect.right - size.marginRight,
    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
  };
  return offset;
};

// -------------------------- resize -------------------------- //

// enable event handlers for listeners
// i.e. resize -> onresize
Outlayer.prototype.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

/**
 * Bind layout to window resizing
 */
Outlayer.prototype.bindResize = function() {
  // bind just one listener
  if ( this.isResizeBound ) {
    return;
  }
  eventie.bind( window, 'resize', this );
  this.isResizeBound = true;
};

/**
 * Unbind layout to window resizing
 */
Outlayer.prototype.unbindResize = function() {
  if ( this.isResizeBound ) {
    eventie.unbind( window, 'resize', this );
  }
  this.isResizeBound = false;
};

// original debounce by John Hann
// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

// this fires every resize
Outlayer.prototype.onresize = function() {
  if ( this.resizeTimeout ) {
    clearTimeout( this.resizeTimeout );
  }

  var _this = this;
  function delayed() {
    _this.resize();
    delete _this.resizeTimeout;
  }

  this.resizeTimeout = setTimeout( delayed, 100 );
};

// debounced, layout on resize
Outlayer.prototype.resize = function() {
  // don't trigger if size did not change
  // or if resize was unbound. See #9
  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
    return;
  }

  this.layout();
};

/**
 * check if layout is needed post layout
 * @returns Boolean
 */
Outlayer.prototype.needsResizeLayout = function() {
  var size = getSize( this.element );
  // check that this.size and size are there
  // IE8 triggers resize on body size change, so they might not be
  var hasSizes = this.size && size;
  return hasSizes && size.innerWidth !== this.size.innerWidth;
};

// -------------------------- methods -------------------------- //

/**
 * add items to Outlayer instance
 * @param {Array or NodeList or Element} elems
 * @returns {Array} items - Outlayer.Items
**/
Outlayer.prototype.addItems = function( elems ) {
  var items = this._itemize( elems );
  // add items to collection
  if ( items.length ) {
    this.items = this.items.concat( items );
  }
  return items;
};

/**
 * Layout newly-appended item elements
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.appended = function( elems ) {
  var items = this.addItems( elems );
  if ( !items.length ) {
    return;
  }
  // layout and reveal just the new items
  this.layoutItems( items, true );
  this.reveal( items );
};

/**
 * Layout prepended elements
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.prepended = function( elems ) {
  var items = this._itemize( elems );
  if ( !items.length ) {
    return;
  }
  // add items to beginning of collection
  var previousItems = this.items.slice(0);
  this.items = items.concat( previousItems );
  // start new layout
  this._resetLayout();
  this._manageStamps();
  // layout new stuff without transition
  this.layoutItems( items, true );
  this.reveal( items );
  // layout previous items
  this.layoutItems( previousItems );
};

/**
 * reveal a collection of items
 * @param {Array of Outlayer.Items} items
 */
Outlayer.prototype.reveal = function( items ) {
  this._emitCompleteOnItems( 'reveal', items );

  var len = items && items.length;
  for ( var i=0; len && i < len; i++ ) {
    var item = items[i];
    item.reveal();
  }
};

/**
 * hide a collection of items
 * @param {Array of Outlayer.Items} items
 */
Outlayer.prototype.hide = function( items ) {
  this._emitCompleteOnItems( 'hide', items );

  var len = items && items.length;
  for ( var i=0; len && i < len; i++ ) {
    var item = items[i];
    item.hide();
  }
};

/**
 * reveal item elements
 * @param {Array}, {Element}, {NodeList} items
 */
Outlayer.prototype.revealItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.reveal( items );
};

/**
 * hide item elements
 * @param {Array}, {Element}, {NodeList} items
 */
Outlayer.prototype.hideItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.hide( items );
};

/**
 * get Outlayer.Item, given an Element
 * @param {Element} elem
 * @param {Function} callback
 * @returns {Outlayer.Item} item
 */
Outlayer.prototype.getItem = function( elem ) {
  // loop through items to get the one that matches
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    var item = this.items[i];
    if ( item.element === elem ) {
      // return item
      return item;
    }
  }
};

/**
 * get collection of Outlayer.Items, given Elements
 * @param {Array} elems
 * @returns {Array} items - Outlayer.Items
 */
Outlayer.prototype.getItems = function( elems ) {
  elems = utils.makeArray( elems );
  var items = [];
  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    var item = this.getItem( elem );
    if ( item ) {
      items.push( item );
    }
  }

  return items;
};

/**
 * remove element(s) from instance and DOM
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.remove = function( elems ) {
  var removeItems = this.getItems( elems );

  this._emitCompleteOnItems( 'remove', removeItems );

  // bail if no items to remove
  if ( !removeItems || !removeItems.length ) {
    return;
  }

  for ( var i=0, len = removeItems.length; i < len; i++ ) {
    var item = removeItems[i];
    item.remove();
    // remove item from collection
    utils.removeFrom( this.items, item );
  }
};

// ----- destroy ----- //

// remove and disable Outlayer instance
Outlayer.prototype.destroy = function() {
  // clean up dynamic styles
  var style = this.element.style;
  style.height = '';
  style.position = '';
  style.width = '';
  // destroy items
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    var item = this.items[i];
    item.destroy();
  }

  this.unbindResize();

  var id = this.element.outlayerGUID;
  delete instances[ id ]; // remove reference to instance by id
  delete this.element.outlayerGUID;
  // remove data for jQuery
  if ( jQuery ) {
    jQuery.removeData( this.element, this.constructor.namespace );
  }

};

// -------------------------- data -------------------------- //

/**
 * get Outlayer instance from element
 * @param {Element} elem
 * @returns {Outlayer}
 */
Outlayer.data = function( elem ) {
  elem = utils.getQueryElement( elem );
  var id = elem && elem.outlayerGUID;
  return id && instances[ id ];
};


// -------------------------- create Outlayer class -------------------------- //

/**
 * create a layout class
 * @param {String} namespace
 */
Outlayer.create = function( namespace, options ) {
  // sub-class Outlayer
  function Layout() {
    Outlayer.apply( this, arguments );
  }
  // inherit Outlayer prototype, use Object.create if there
  if ( Object.create ) {
    Layout.prototype = Object.create( Outlayer.prototype );
  } else {
    utils.extend( Layout.prototype, Outlayer.prototype );
  }
  // set contructor, used for namespace and Item
  Layout.prototype.constructor = Layout;

  Layout.defaults = utils.extend( {}, Outlayer.defaults );
  // apply new options
  utils.extend( Layout.defaults, options );
  // keep prototype.settings for backwards compatibility (Packery v1.2.0)
  Layout.prototype.settings = {};

  Layout.namespace = namespace;

  Layout.data = Outlayer.data;

  // sub-class Item
  Layout.Item = function LayoutItem() {
    Item.apply( this, arguments );
  };

  Layout.Item.prototype = new Item();

  // -------------------------- declarative -------------------------- //

  utils.htmlInit( Layout, namespace );

  // -------------------------- jQuery bridge -------------------------- //

  // make into jQuery plugin
  if ( jQuery && jQuery.bridget ) {
    jQuery.bridget( namespace, Layout );
  }

  return Layout;
};

// ----- fin ----- //

// back in global
Outlayer.Item = Item;

return Outlayer;

}));


/**
 * Isotope Item
**/

( function( window, factory ) {
'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/js/item',[
        'outlayer/outlayer'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('outlayer')
    );
  } else {
    // browser global
    window.Isotope = window.Isotope || {};
    window.Isotope.Item = factory(
      window.Outlayer
    );
  }

}( window, function factory( Outlayer ) {
'use strict';

// -------------------------- Item -------------------------- //

// sub-class Outlayer Item
function Item() {
  Outlayer.Item.apply( this, arguments );
}

Item.prototype = new Outlayer.Item();

Item.prototype._create = function() {
  // assign id, used for original-order sorting
  this.id = this.layout.itemGUID++;
  Outlayer.Item.prototype._create.call( this );
  this.sortData = {};
};

Item.prototype.updateSortData = function() {
  if ( this.isIgnored ) {
    return;
  }
  // default sorters
  this.sortData.id = this.id;
  // for backward compatibility
  this.sortData['original-order'] = this.id;
  this.sortData.random = Math.random();
  // go thru getSortData obj and apply the sorters
  var getSortData = this.layout.options.getSortData;
  var sorters = this.layout._sorters;
  for ( var key in getSortData ) {
    var sorter = sorters[ key ];
    this.sortData[ key ] = sorter( this.element, this );
  }
};

var _destroy = Item.prototype.destroy;
Item.prototype.destroy = function() {
  // call super
  _destroy.apply( this, arguments );
  // reset display, #741
  this.css({
    display: ''
  });
};

return Item;

}));

/**
 * Isotope LayoutMode
 */

( function( window, factory ) {
  'use strict';
  // universal module definition

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/js/layout-mode',[
        'get-size/get-size',
        'outlayer/outlayer'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('get-size'),
      require('outlayer')
    );
  } else {
    // browser global
    window.Isotope = window.Isotope || {};
    window.Isotope.LayoutMode = factory(
      window.getSize,
      window.Outlayer
    );
  }

}( window, function factory( getSize, Outlayer ) {
  'use strict';

  // layout mode class
  function LayoutMode( isotope ) {
    this.isotope = isotope;
    // link properties
    if ( isotope ) {
      this.options = isotope.options[ this.namespace ];
      this.element = isotope.element;
      this.items = isotope.filteredItems;
      this.size = isotope.size;
    }
  }

  /**
   * some methods should just defer to default Outlayer method
   * and reference the Isotope instance as `this`
  **/
  ( function() {
    var facadeMethods = [
      '_resetLayout',
      '_getItemLayoutPosition',
      '_manageStamp',
      '_getContainerSize',
      '_getElementOffset',
      'needsResizeLayout'
    ];

    for ( var i=0, len = facadeMethods.length; i < len; i++ ) {
      var methodName = facadeMethods[i];
      LayoutMode.prototype[ methodName ] = getOutlayerMethod( methodName );
    }

    function getOutlayerMethod( methodName ) {
      return function() {
        return Outlayer.prototype[ methodName ].apply( this.isotope, arguments );
      };
    }
  })();

  // -----  ----- //

  // for horizontal layout modes, check vertical size
  LayoutMode.prototype.needsVerticalResizeLayout = function() {
    // don't trigger if size did not change
    var size = getSize( this.isotope.element );
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var hasSizes = this.isotope.size && size;
    return hasSizes && size.innerHeight != this.isotope.size.innerHeight;
  };

  // ----- measurements ----- //

  LayoutMode.prototype._getMeasurement = function() {
    this.isotope._getMeasurement.apply( this, arguments );
  };

  LayoutMode.prototype.getColumnWidth = function() {
    this.getSegmentSize( 'column', 'Width' );
  };

  LayoutMode.prototype.getRowHeight = function() {
    this.getSegmentSize( 'row', 'Height' );
  };

  /**
   * get columnWidth or rowHeight
   * segment: 'column' or 'row'
   * size 'Width' or 'Height'
  **/
  LayoutMode.prototype.getSegmentSize = function( segment, size ) {
    var segmentName = segment + size;
    var outerSize = 'outer' + size;
    // columnWidth / outerWidth // rowHeight / outerHeight
    this._getMeasurement( segmentName, outerSize );
    // got rowHeight or columnWidth, we can chill
    if ( this[ segmentName ] ) {
      return;
    }
    // fall back to item of first element
    var firstItemSize = this.getFirstItemSize();
    this[ segmentName ] = firstItemSize && firstItemSize[ outerSize ] ||
      // or size of container
      this.isotope.size[ 'inner' + size ];
  };

  LayoutMode.prototype.getFirstItemSize = function() {
    var firstItem = this.isotope.filteredItems[0];
    return firstItem && firstItem.element && getSize( firstItem.element );
  };

  // ----- methods that should reference isotope ----- //

  LayoutMode.prototype.layout = function() {
    this.isotope.layout.apply( this.isotope, arguments );
  };

  LayoutMode.prototype.getSize = function() {
    this.isotope.getSize();
    this.size = this.isotope.size;
  };

  // -------------------------- create -------------------------- //

  LayoutMode.modes = {};

  LayoutMode.create = function( namespace, options ) {

    function Mode() {
      LayoutMode.apply( this, arguments );
    }

    Mode.prototype = new LayoutMode();

    // default options
    if ( options ) {
      Mode.options = options;
    }

    Mode.prototype.namespace = namespace;
    // register in Isotope
    LayoutMode.modes[ namespace ] = Mode;

    return Mode;
  };

  return LayoutMode;

}));

/*!
 * Masonry v3.3.1
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

( function( window, factory ) {
  'use strict';
  // universal module definition
  if ( typeof define === 'function' && define.amd ) {
    // AMD
    define( 'masonry/masonry',[
        'outlayer/outlayer',
        'get-size/get-size',
        'fizzy-ui-utils/utils'
      ],
      factory );
  } else if ( typeof exports === 'object' ) {
    // CommonJS
    module.exports = factory(
      require('outlayer'),
      require('get-size'),
      require('fizzy-ui-utils')
    );
  } else {
    // browser global
    window.Masonry = factory(
      window.Outlayer,
      window.getSize,
      window.fizzyUIUtils
    );
  }

}( window, function factory( Outlayer, getSize, utils ) {



// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var Masonry = Outlayer.create('masonry');

  Masonry.prototype._resetLayout = function() {
    this.getSize();
    this._getMeasurement( 'columnWidth', 'outerWidth' );
    this._getMeasurement( 'gutter', 'outerWidth' );
    this.measureColumns();

    // reset column Y
    var i = this.cols;
    this.colYs = [];
    while (i--) {
      this.colYs.push( 0 );
    }

    this.maxY = 0;
  };

  Masonry.prototype.measureColumns = function() {
    this.getContainerWidth();
    // if columnWidth is 0, default to outerWidth of first item
    if ( !this.columnWidth ) {
      var firstItem = this.items[0];
      var firstItemElem = firstItem && firstItem.element;
      // columnWidth fall back to item of first element
      this.columnWidth = firstItemElem && getSize( firstItemElem ).outerWidth ||
        // if first elem has no width, default to size of container
        this.containerWidth;
    }

    var columnWidth = this.columnWidth += this.gutter;

    // calculate columns
    var containerWidth = this.containerWidth + this.gutter;
    var cols = containerWidth / columnWidth;
    // fix rounding errors, typically with gutters
    var excess = columnWidth - containerWidth % columnWidth;
    // if overshoot is less than a pixel, round up, otherwise floor it
    var mathMethod = excess && excess < 1 ? 'round' : 'floor';
    cols = Math[ mathMethod ]( cols );
    this.cols = Math.max( cols, 1 );
  };

  Masonry.prototype.getContainerWidth = function() {
    // container is parent if fit width
    var container = this.options.isFitWidth ? this.element.parentNode : this.element;
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var size = getSize( container );
    this.containerWidth = size && size.innerWidth;
  };

  Masonry.prototype._getItemLayoutPosition = function( item ) {
    item.getSize();
    // how many columns does this brick span
    var remainder = item.size.outerWidth % this.columnWidth;
    var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
    // round if off by 1 pixel, otherwise use ceil
    var colSpan = Math[ mathMethod ]( item.size.outerWidth / this.columnWidth );
    colSpan = Math.min( colSpan, this.cols );

    var colGroup = this._getColGroup( colSpan );
    // get the minimum Y value from the columns
    var minimumY = Math.min.apply( Math, colGroup );
    var shortColIndex = utils.indexOf( colGroup, minimumY );

    // position the brick
    var position = {
      x: this.columnWidth * shortColIndex,
      y: minimumY
    };

    // apply setHeight to necessary columns
    var setHeight = minimumY + item.size.outerHeight;
    var setSpan = this.cols + 1 - colGroup.length;
    for ( var i = 0; i < setSpan; i++ ) {
      this.colYs[ shortColIndex + i ] = setHeight;
    }

    return position;
  };

  /**
   * @param {Number} colSpan - number of columns the element spans
   * @returns {Array} colGroup
   */
  Masonry.prototype._getColGroup = function( colSpan ) {
    if ( colSpan < 2 ) {
      // if brick spans only one column, use all the column Ys
      return this.colYs;
    }

    var colGroup = [];
    // how many different places could this brick fit horizontally
    var groupCount = this.cols + 1 - colSpan;
    // for each group potential horizontal position
    for ( var i = 0; i < groupCount; i++ ) {
      // make an array of colY values for that one group
      var groupColYs = this.colYs.slice( i, i + colSpan );
      // and get the max value of the array
      colGroup[i] = Math.max.apply( Math, groupColYs );
    }
    return colGroup;
  };

  Masonry.prototype._manageStamp = function( stamp ) {
    var stampSize = getSize( stamp );
    var offset = this._getElementOffset( stamp );
    // get the columns that this stamp affects
    var firstX = this.options.isOriginLeft ? offset.left : offset.right;
    var lastX = firstX + stampSize.outerWidth;
    var firstCol = Math.floor( firstX / this.columnWidth );
    firstCol = Math.max( 0, firstCol );
    var lastCol = Math.floor( lastX / this.columnWidth );
    // lastCol should not go over if multiple of columnWidth #425
    lastCol -= lastX % this.columnWidth ? 0 : 1;
    lastCol = Math.min( this.cols - 1, lastCol );
    // set colYs to bottom of the stamp
    var stampMaxY = ( this.options.isOriginTop ? offset.top : offset.bottom ) +
      stampSize.outerHeight;
    for ( var i = firstCol; i <= lastCol; i++ ) {
      this.colYs[i] = Math.max( stampMaxY, this.colYs[i] );
    }
  };

  Masonry.prototype._getContainerSize = function() {
    this.maxY = Math.max.apply( Math, this.colYs );
    var size = {
      height: this.maxY
    };

    if ( this.options.isFitWidth ) {
      size.width = this._getContainerFitWidth();
    }

    return size;
  };

  Masonry.prototype._getContainerFitWidth = function() {
    var unusedCols = 0;
    // count unused columns
    var i = this.cols;
    while ( --i ) {
      if ( this.colYs[i] !== 0 ) {
        break;
      }
      unusedCols++;
    }
    // fit container to columns that have been used
    return ( this.cols - unusedCols ) * this.columnWidth - this.gutter;
  };

  Masonry.prototype.needsResizeLayout = function() {
    var previousWidth = this.containerWidth;
    this.getContainerWidth();
    return previousWidth !== this.containerWidth;
  };

  return Masonry;

}));

/*!
 * Masonry layout mode
 * sub-classes Masonry
 * http://masonry.desandro.com
 */

( function( window, factory ) {
  'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/js/layout-modes/masonry',[
        '../layout-mode',
        'masonry/masonry'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode'),
      require('masonry-layout')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode,
      window.Masonry
    );
  }

}( window, function factory( LayoutMode, Masonry ) {
'use strict';

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var MasonryMode = LayoutMode.create('masonry');

  // save on to these methods
  var _getElementOffset = MasonryMode.prototype._getElementOffset;
  var layout = MasonryMode.prototype.layout;
  var _getMeasurement = MasonryMode.prototype._getMeasurement;

  // sub-class Masonry
  extend( MasonryMode.prototype, Masonry.prototype );

  // set back, as it was overwritten by Masonry
  MasonryMode.prototype._getElementOffset = _getElementOffset;
  MasonryMode.prototype.layout = layout;
  MasonryMode.prototype._getMeasurement = _getMeasurement;

  var measureColumns = MasonryMode.prototype.measureColumns;
  MasonryMode.prototype.measureColumns = function() {
    // set items, used if measuring first item
    this.items = this.isotope.filteredItems;
    measureColumns.call( this );
  };

  // HACK copy over isOriginLeft/Top options
  var _manageStamp = MasonryMode.prototype._manageStamp;
  MasonryMode.prototype._manageStamp = function() {
    this.options.isOriginLeft = this.isotope.options.isOriginLeft;
    this.options.isOriginTop = this.isotope.options.isOriginTop;
    _manageStamp.apply( this, arguments );
  };

  return MasonryMode;

}));

/**
 * fitRows layout mode
 */

( function( window, factory ) {
  'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/js/layout-modes/fit-rows',[
        '../layout-mode'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( LayoutMode ) {
'use strict';

var FitRows = LayoutMode.create('fitRows');

FitRows.prototype._resetLayout = function() {
  this.x = 0;
  this.y = 0;
  this.maxY = 0;
  this._getMeasurement( 'gutter', 'outerWidth' );
};

FitRows.prototype._getItemLayoutPosition = function( item ) {
  item.getSize();

  var itemWidth = item.size.outerWidth + this.gutter;
  // if this element cannot fit in the current row
  var containerWidth = this.isotope.size.innerWidth + this.gutter;
  if ( this.x !== 0 && itemWidth + this.x > containerWidth ) {
    this.x = 0;
    this.y = this.maxY;
  }

  var position = {
    x: this.x,
    y: this.y
  };

  this.maxY = Math.max( this.maxY, this.y + item.size.outerHeight );
  this.x += itemWidth;

  return position;
};

FitRows.prototype._getContainerSize = function() {
  return { height: this.maxY };
};

return FitRows;

}));

/**
 * vertical layout mode
 */

( function( window, factory ) {
  'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'isotope/js/layout-modes/vertical',[
        '../layout-mode'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( LayoutMode ) {
'use strict';

var Vertical = LayoutMode.create( 'vertical', {
  horizontalAlignment: 0
});

Vertical.prototype._resetLayout = function() {
  this.y = 0;
};

Vertical.prototype._getItemLayoutPosition = function( item ) {
  item.getSize();
  var x = ( this.isotope.size.innerWidth - item.size.outerWidth ) *
    this.options.horizontalAlignment;
  var y = this.y;
  this.y += item.size.outerHeight;
  return { x: x, y: y };
};

Vertical.prototype._getContainerSize = function() {
  return { height: this.y };
};

return Vertical;

}));

/*!
 * Isotope v2.2.2
 *
 * Licensed GPLv3 for open source use
 * or Isotope Commercial License for commercial use
 *
 * http://isotope.metafizzy.co
 * Copyright 2015 Metafizzy
 */

( function( window, factory ) {
  'use strict';
  // universal module definition

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( [
        'outlayer/outlayer',
        'get-size/get-size',
        'matches-selector/matches-selector',
        'fizzy-ui-utils/utils',
        'isotope/js/item',
        'isotope/js/layout-mode',
        // include default layout modes
        'isotope/js/layout-modes/masonry',
        'isotope/js/layout-modes/fit-rows',
        'isotope/js/layout-modes/vertical'
      ],
      function( Outlayer, getSize, matchesSelector, utils, Item, LayoutMode ) {
        return factory( window, Outlayer, getSize, matchesSelector, utils, Item, LayoutMode );
      });
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      window,
      require('outlayer'),
      require('get-size'),
      require('desandro-matches-selector'),
      require('fizzy-ui-utils'),
      require('./item'),
      require('./layout-mode'),
      // include default layout modes
      require('./layout-modes/masonry'),
      require('./layout-modes/fit-rows'),
      require('./layout-modes/vertical')
    );
  } else {
    // browser global
    window.Isotope = factory(
      window,
      window.Outlayer,
      window.getSize,
      window.matchesSelector,
      window.fizzyUIUtils,
      window.Isotope.Item,
      window.Isotope.LayoutMode
    );
  }

}( window, function factory( window, Outlayer, getSize, matchesSelector, utils,
  Item, LayoutMode ) {



// -------------------------- vars -------------------------- //

var jQuery = window.jQuery;

// -------------------------- helpers -------------------------- //

var trim = String.prototype.trim ?
  function( str ) {
    return str.trim();
  } :
  function( str ) {
    return str.replace( /^\s+|\s+$/g, '' );
  };

var docElem = document.documentElement;

var getText = docElem.textContent ?
  function( elem ) {
    return elem.textContent;
  } :
  function( elem ) {
    return elem.innerText;
  };

// -------------------------- isotopeDefinition -------------------------- //

  // create an Outlayer layout class
  var Isotope = Outlayer.create( 'isotope', {
    layoutMode: "masonry",
    isJQueryFiltering: true,
    sortAscending: true
  });

  Isotope.Item = Item;
  Isotope.LayoutMode = LayoutMode;

  Isotope.prototype._create = function() {
    this.itemGUID = 0;
    // functions that sort items
    this._sorters = {};
    this._getSorters();
    // call super
    Outlayer.prototype._create.call( this );

    // create layout modes
    this.modes = {};
    // start filteredItems with all items
    this.filteredItems = this.items;
    // keep of track of sortBys
    this.sortHistory = [ 'original-order' ];
    // create from registered layout modes
    for ( var name in LayoutMode.modes ) {
      this._initLayoutMode( name );
    }
  };

  Isotope.prototype.reloadItems = function() {
    // reset item ID counter
    this.itemGUID = 0;
    // call super
    Outlayer.prototype.reloadItems.call( this );
  };

  Isotope.prototype._itemize = function() {
    var items = Outlayer.prototype._itemize.apply( this, arguments );
    // assign ID for original-order
    for ( var i=0, len = items.length; i < len; i++ ) {
      var item = items[i];
      item.id = this.itemGUID++;
    }
    this._updateItemsSortData( items );
    return items;
  };


  // -------------------------- layout -------------------------- //

  Isotope.prototype._initLayoutMode = function( name ) {
    var Mode = LayoutMode.modes[ name ];
    // set mode options
    // HACK extend initial options, back-fill in default options
    var initialOpts = this.options[ name ] || {};
    this.options[ name ] = Mode.options ?
      utils.extend( Mode.options, initialOpts ) : initialOpts;
    // init layout mode instance
    this.modes[ name ] = new Mode( this );
  };


  Isotope.prototype.layout = function() {
    // if first time doing layout, do all magic
    if ( !this._isLayoutInited && this.options.isInitLayout ) {
      this.arrange();
      return;
    }
    this._layout();
  };

  // private method to be used in layout() & magic()
  Isotope.prototype._layout = function() {
    // don't animate first layout
    var isInstant = this._getIsInstant();
    // layout flow
    this._resetLayout();
    this._manageStamps();
    this.layoutItems( this.filteredItems, isInstant );

    // flag for initalized
    this._isLayoutInited = true;
  };

  // filter + sort + layout
  Isotope.prototype.arrange = function( opts ) {
    // set any options pass
    this.option( opts );
    this._getIsInstant();
    // filter, sort, and layout

    // filter
    var filtered = this._filter( this.items );
    this.filteredItems = filtered.matches;

    var _this = this;
    function hideReveal() {
      _this.reveal( filtered.needReveal );
      _this.hide( filtered.needHide );
    }

    this._bindArrangeComplete();

    if ( this._isInstant ) {
      this._noTransition( hideReveal );
    } else {
      hideReveal();
    }

    this._sort();
    this._layout();
  };
  // alias to _init for main plugin method
  Isotope.prototype._init = Isotope.prototype.arrange;

  // HACK
  // Don't animate/transition first layout
  // Or don't animate/transition other layouts
  Isotope.prototype._getIsInstant = function() {
    var isInstant = this.options.isLayoutInstant !== undefined ?
      this.options.isLayoutInstant : !this._isLayoutInited;
    this._isInstant = isInstant;
    return isInstant;
  };

  // listen for layoutComplete, hideComplete and revealComplete
  // to trigger arrangeComplete
  Isotope.prototype._bindArrangeComplete = function() {
    // listen for 3 events to trigger arrangeComplete
    var isLayoutComplete, isHideComplete, isRevealComplete;
    var _this = this;
    function arrangeParallelCallback() {
      if ( isLayoutComplete && isHideComplete && isRevealComplete ) {
        _this.dispatchEvent( 'arrangeComplete', null, [ _this.filteredItems ] );
      }
    }
    this.once( 'layoutComplete', function() {
      isLayoutComplete = true;
      arrangeParallelCallback();
    });
    this.once( 'hideComplete', function() {
      isHideComplete = true;
      arrangeParallelCallback();
    });
    this.once( 'revealComplete', function() {
      isRevealComplete = true;
      arrangeParallelCallback();
    });
  };

  // -------------------------- filter -------------------------- //

  Isotope.prototype._filter = function( items ) {
    var filter = this.options.filter;
    filter = filter || '*';
    var matches = [];
    var hiddenMatched = [];
    var visibleUnmatched = [];

    var test = this._getFilterTest( filter );

    // test each item
    for ( var i=0, len = items.length; i < len; i++ ) {
      var item = items[i];
      if ( item.isIgnored ) {
        continue;
      }
      // add item to either matched or unmatched group
      var isMatched = test( item );
      // item.isFilterMatched = isMatched;
      // add to matches if its a match
      if ( isMatched ) {
        matches.push( item );
      }
      // add to additional group if item needs to be hidden or revealed
      if ( isMatched && item.isHidden ) {
        hiddenMatched.push( item );
      } else if ( !isMatched && !item.isHidden ) {
        visibleUnmatched.push( item );
      }
    }

    // return collections of items to be manipulated
    return {
      matches: matches,
      needReveal: hiddenMatched,
      needHide: visibleUnmatched
    };
  };

  // get a jQuery, function, or a matchesSelector test given the filter
  Isotope.prototype._getFilterTest = function( filter ) {
    if ( jQuery && this.options.isJQueryFiltering ) {
      // use jQuery
      return function( item ) {
        return jQuery( item.element ).is( filter );
      };
    }
    if ( typeof filter == 'function' ) {
      // use filter as function
      return function( item ) {
        return filter( item.element );
      };
    }
    // default, use filter as selector string
    return function( item ) {
      return matchesSelector( item.element, filter );
    };
  };

  // -------------------------- sorting -------------------------- //

  /**
   * @params {Array} elems
   * @public
   */
  Isotope.prototype.updateSortData = function( elems ) {
    // get items
    var items;
    if ( elems ) {
      elems = utils.makeArray( elems );
      items = this.getItems( elems );
    } else {
      // update all items if no elems provided
      items = this.items;
    }

    this._getSorters();
    this._updateItemsSortData( items );
  };

  Isotope.prototype._getSorters = function() {
    var getSortData = this.options.getSortData;
    for ( var key in getSortData ) {
      var sorter = getSortData[ key ];
      this._sorters[ key ] = mungeSorter( sorter );
    }
  };

  /**
   * @params {Array} items - of Isotope.Items
   * @private
   */
  Isotope.prototype._updateItemsSortData = function( items ) {
    // do not update if no items
    var len = items && items.length;

    for ( var i=0; len && i < len; i++ ) {
      var item = items[i];
      item.updateSortData();
    }
  };

  // ----- munge sorter ----- //

  // encapsulate this, as we just need mungeSorter
  // other functions in here are just for munging
  var mungeSorter = ( function() {
    // add a magic layer to sorters for convienent shorthands
    // `.foo-bar` will use the text of .foo-bar querySelector
    // `[foo-bar]` will use attribute
    // you can also add parser
    // `.foo-bar parseInt` will parse that as a number
    function mungeSorter( sorter ) {
      // if not a string, return function or whatever it is
      if ( typeof sorter != 'string' ) {
        return sorter;
      }
      // parse the sorter string
      var args = trim( sorter ).split(' ');
      var query = args[0];
      // check if query looks like [an-attribute]
      var attrMatch = query.match( /^\[(.+)\]$/ );
      var attr = attrMatch && attrMatch[1];
      var getValue = getValueGetter( attr, query );
      // use second argument as a parser
      var parser = Isotope.sortDataParsers[ args[1] ];
      // parse the value, if there was a parser
      sorter = parser ? function( elem ) {
        return elem && parser( getValue( elem ) );
      } :
      // otherwise just return value
      function( elem ) {
        return elem && getValue( elem );
      };

      return sorter;
    }

    // get an attribute getter, or get text of the querySelector
    function getValueGetter( attr, query ) {
      var getValue;
      // if query looks like [foo-bar], get attribute
      if ( attr ) {
        getValue = function( elem ) {
          return elem.getAttribute( attr );
        };
      } else {
        // otherwise, assume its a querySelector, and get its text
        getValue = function( elem ) {
          var child = elem.querySelector( query );
          return child && getText( child );
        };
      }
      return getValue;
    }

    return mungeSorter;
  })();

  // parsers used in getSortData shortcut strings
  Isotope.sortDataParsers = {
    'parseInt': function( val ) {
      return parseInt( val, 10 );
    },
    'parseFloat': function( val ) {
      return parseFloat( val );
    }
  };

  // ----- sort method ----- //

  // sort filteredItem order
  Isotope.prototype._sort = function() {
    var sortByOpt = this.options.sortBy;
    if ( !sortByOpt ) {
      return;
    }
    // concat all sortBy and sortHistory
    var sortBys = [].concat.apply( sortByOpt, this.sortHistory );
    // sort magic
    var itemSorter = getItemSorter( sortBys, this.options.sortAscending );
    this.filteredItems.sort( itemSorter );
    // keep track of sortBy History
    if ( sortByOpt != this.sortHistory[0] ) {
      // add to front, oldest goes in last
      this.sortHistory.unshift( sortByOpt );
    }
  };

  // returns a function used for sorting
  function getItemSorter( sortBys, sortAsc ) {
    return function sorter( itemA, itemB ) {
      // cycle through all sortKeys
      for ( var i = 0, len = sortBys.length; i < len; i++ ) {
        var sortBy = sortBys[i];
        var a = itemA.sortData[ sortBy ];
        var b = itemB.sortData[ sortBy ];
        if ( a > b || a < b ) {
          // if sortAsc is an object, use the value given the sortBy key
          var isAscending = sortAsc[ sortBy ] !== undefined ? sortAsc[ sortBy ] : sortAsc;
          var direction = isAscending ? 1 : -1;
          return ( a > b ? 1 : -1 ) * direction;
        }
      }
      return 0;
    };
  }

  // -------------------------- methods -------------------------- //

  // get layout mode
  Isotope.prototype._mode = function() {
    var layoutMode = this.options.layoutMode;
    var mode = this.modes[ layoutMode ];
    if ( !mode ) {
      // TODO console.error
      throw new Error( 'No layout mode: ' + layoutMode );
    }
    // HACK sync mode's options
    // any options set after init for layout mode need to be synced
    mode.options = this.options[ layoutMode ];
    return mode;
  };

  Isotope.prototype._resetLayout = function() {
    // trigger original reset layout
    Outlayer.prototype._resetLayout.call( this );
    this._mode()._resetLayout();
  };

  Isotope.prototype._getItemLayoutPosition = function( item  ) {
    return this._mode()._getItemLayoutPosition( item );
  };

  Isotope.prototype._manageStamp = function( stamp ) {
    this._mode()._manageStamp( stamp );
  };

  Isotope.prototype._getContainerSize = function() {
    return this._mode()._getContainerSize();
  };

  Isotope.prototype.needsResizeLayout = function() {
    return this._mode().needsResizeLayout();
  };

  // -------------------------- adding & removing -------------------------- //

  // HEADS UP overwrites default Outlayer appended
  Isotope.prototype.appended = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    // filter, layout, reveal new items
    var filteredItems = this._filterRevealAdded( items );
    // add to filteredItems
    this.filteredItems = this.filteredItems.concat( filteredItems );
  };

  // HEADS UP overwrites default Outlayer prepended
  Isotope.prototype.prepended = function( elems ) {
    var items = this._itemize( elems );
    if ( !items.length ) {
      return;
    }
    // start new layout
    this._resetLayout();
    this._manageStamps();
    // filter, layout, reveal new items
    var filteredItems = this._filterRevealAdded( items );
    // layout previous items
    this.layoutItems( this.filteredItems );
    // add to items and filteredItems
    this.filteredItems = filteredItems.concat( this.filteredItems );
    this.items = items.concat( this.items );
  };

  Isotope.prototype._filterRevealAdded = function( items ) {
    var filtered = this._filter( items );
    this.hide( filtered.needHide );
    // reveal all new items
    this.reveal( filtered.matches );
    // layout new items, no transition
    this.layoutItems( filtered.matches, true );
    return filtered.matches;
  };

  /**
   * Filter, sort, and layout newly-appended item elements
   * @param {Array or NodeList or Element} elems
   */
  Isotope.prototype.insert = function( elems ) {
    var items = this.addItems( elems );
    if ( !items.length ) {
      return;
    }
    // append item elements
    var i, item;
    var len = items.length;
    for ( i=0; i < len; i++ ) {
      item = items[i];
      this.element.appendChild( item.element );
    }
    // filter new stuff
    var filteredInsertItems = this._filter( items ).matches;
    // set flag
    for ( i=0; i < len; i++ ) {
      items[i].isLayoutInstant = true;
    }
    this.arrange();
    // reset flag
    for ( i=0; i < len; i++ ) {
      delete items[i].isLayoutInstant;
    }
    this.reveal( filteredInsertItems );
  };

  var _remove = Isotope.prototype.remove;
  Isotope.prototype.remove = function( elems ) {
    elems = utils.makeArray( elems );
    var removeItems = this.getItems( elems );
    // do regular thing
    _remove.call( this, elems );
    // bail if no items to remove
    var len = removeItems && removeItems.length;
    if ( !len ) {
      return;
    }
    // remove elems from filteredItems
    for ( var i=0; i < len; i++ ) {
      var item = removeItems[i];
      // remove item from collection
      utils.removeFrom( this.filteredItems, item );
    }
  };

  Isotope.prototype.shuffle = function() {
    // update random sortData
    for ( var i=0, len = this.items.length; i < len; i++ ) {
      var item = this.items[i];
      item.sortData.random = Math.random();
    }
    this.options.sortBy = 'random';
    this._sort();
    this._layout();
  };

  /**
   * trigger fn without transition
   * kind of hacky to have this in the first place
   * @param {Function} fn
   * @returns ret
   * @private
   */
  Isotope.prototype._noTransition = function( fn ) {
    // save transitionDuration before disabling
    var transitionDuration = this.options.transitionDuration;
    // disable transition
    this.options.transitionDuration = 0;
    // do it
    var returnValue = fn.call( this );
    // re-enable transition for reveal
    this.options.transitionDuration = transitionDuration;
    return returnValue;
  };

  // ----- helper methods ----- //

  /**
   * getter method for getting filtered item elements
   * @returns {Array} elems - collection of item elements
   */
  Isotope.prototype.getFilteredItemElements = function() {
    var elems = [];
    for ( var i=0, len = this.filteredItems.length; i < len; i++ ) {
      elems.push( this.filteredItems[i].element );
    }
    return elems;
  };

  // -----  ----- //

  return Isotope;

}));


/*!
 * Packery PACKAGED v1.4.3
 * bin-packing layout library
 *
 * Licensed GPLv3 for open source use
 * or Flickity Commercial License for commercial use
 *
 * http://packery.metafizzy.co
 * Copyright 2015 Metafizzy
 */

/**
 * Bridget makes jQuery widgets
 * v1.1.0
 * MIT license
 */

( function( window ) {



// -------------------------- utils -------------------------- //

var slice = Array.prototype.slice;

function noop() {}

// -------------------------- definition -------------------------- //

function defineBridget( $ ) {

// bail if no jQuery
if ( !$ ) {
  return;
}

// -------------------------- addOptionMethod -------------------------- //

/**
 * adds option method -> $().plugin('option', {...})
 * @param {Function} PluginClass - constructor class
 */
function addOptionMethod( PluginClass ) {
  // don't overwrite original option method
  if ( PluginClass.prototype.option ) {
    return;
  }

  // option setter
  PluginClass.prototype.option = function( opts ) {
    // bail out if not an object
    if ( !$.isPlainObject( opts ) ){
      return;
    }
    this.options = $.extend( true, this.options, opts );
  };
}

// -------------------------- plugin bridge -------------------------- //

// helper function for logging errors
// $.error breaks jQuery chaining
var logError = typeof console === 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

/**
 * jQuery plugin bridge, access methods like $elem.plugin('method')
 * @param {String} namespace - plugin name
 * @param {Function} PluginClass - constructor class
 */
function bridge( namespace, PluginClass ) {
  // add to jQuery fn namespace
  $.fn[ namespace ] = function( options ) {
    if ( typeof options === 'string' ) {
      // call plugin method when first argument is a string
      // get arguments for method
      var args = slice.call( arguments, 1 );

      for ( var i=0, len = this.length; i < len; i++ ) {
        var elem = this[i];
        var instance = $.data( elem, namespace );
        if ( !instance ) {
          logError( "cannot call methods on " + namespace + " prior to initialization; " +
            "attempted to call '" + options + "'" );
          continue;
        }
        if ( !$.isFunction( instance[options] ) || options.charAt(0) === '_' ) {
          logError( "no such method '" + options + "' for " + namespace + " instance" );
          continue;
        }

        // trigger method with arguments
        var returnValue = instance[ options ].apply( instance, args );

        // break look and return first value if provided
        if ( returnValue !== undefined ) {
          return returnValue;
        }
      }
      // return this if no return value
      return this;
    } else {
      return this.each( function() {
        var instance = $.data( this, namespace );
        if ( instance ) {
          // apply options & init
          instance.option( options );
          instance._init();
        } else {
          // initialize new instance
          instance = new PluginClass( this, options );
          $.data( this, namespace, instance );
        }
      });
    }
  };

}

// -------------------------- bridget -------------------------- //

/**
 * converts a Prototypical class into a proper jQuery plugin
 *   the class must have a ._init method
 * @param {String} namespace - plugin name, used in $().pluginName
 * @param {Function} PluginClass - constructor class
 */
$.bridget = function( namespace, PluginClass ) {
  addOptionMethod( PluginClass );
  bridge( namespace, PluginClass );
};

return $.bridget;

}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'jquery-bridget/jquery.bridget',[ 'jquery' ], defineBridget );
} else if ( typeof exports === 'object' ) {
  defineBridget( require('jquery') );
} else {
  // get jquery from browser global
  defineBridget( window.jQuery );
}

})( window );

/*!
 * classie v1.0.1
 * class helper functions
 * from bonzo https://github.com/ded/bonzo
 * MIT license
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false */

( function( window ) {



// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'classie/classie',classie );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = classie;
} else {
  // browser global
  window.classie = classie;
}

})( window );

/*!
 * getStyleProperty v1.0.4
 * original by kangax
 * http://perfectionkills.com/feature-testing-css-properties/
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false, exports: false, module: false */

( function( window ) {



var prefixes = 'Webkit Moz ms Ms O'.split(' ');
var docElemStyle = document.documentElement.style;

function getStyleProperty( propName ) {
  if ( !propName ) {
    return;
  }

  // test standard property first
  if ( typeof docElemStyle[ propName ] === 'string' ) {
    return propName;
  }

  // capitalize
  propName = propName.charAt(0).toUpperCase() + propName.slice(1);

  // test vendor specific properties
  var prefixed;
  for ( var i=0, len = prefixes.length; i < len; i++ ) {
    prefixed = prefixes[i] + propName;
    if ( typeof docElemStyle[ prefixed ] === 'string' ) {
      return prefixed;
    }
  }
}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'get-style-property/get-style-property',[],function() {
    return getStyleProperty;
  });
} else if ( typeof exports === 'object' ) {
  // CommonJS for Component
  module.exports = getStyleProperty;
} else {
  // browser global
  window.getStyleProperty = getStyleProperty;
}

})( window );

/*!
 * getSize v1.2.2
 * measure size of elements
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, exports: false, require: false, module: false, console: false */

( function( window, undefined ) {



// -------------------------- helpers -------------------------- //

// get a number from a string, not a percentage
function getStyleSize( value ) {
  var num = parseFloat( value );
  // not a percent like '100%', and a number
  var isValid = value.indexOf('%') === -1 && !isNaN( num );
  return isValid && num;
}

function noop() {}

var logError = typeof console === 'undefined' ? noop :
  function( message ) {
    console.error( message );
  };

// -------------------------- measurements -------------------------- //

var measurements = [
  'paddingLeft',
  'paddingRight',
  'paddingTop',
  'paddingBottom',
  'marginLeft',
  'marginRight',
  'marginTop',
  'marginBottom',
  'borderLeftWidth',
  'borderRightWidth',
  'borderTopWidth',
  'borderBottomWidth'
];

function getZeroSize() {
  var size = {
    width: 0,
    height: 0,
    innerWidth: 0,
    innerHeight: 0,
    outerWidth: 0,
    outerHeight: 0
  };
  for ( var i=0, len = measurements.length; i < len; i++ ) {
    var measurement = measurements[i];
    size[ measurement ] = 0;
  }
  return size;
}



function defineGetSize( getStyleProperty ) {

// -------------------------- setup -------------------------- //

var isSetup = false;

var getStyle, boxSizingProp, isBoxSizeOuter;

/**
 * setup vars and functions
 * do it on initial getSize(), rather than on script load
 * For Firefox bug https://bugzilla.mozilla.org/show_bug.cgi?id=548397
 */
function setup() {
  // setup once
  if ( isSetup ) {
    return;
  }
  isSetup = true;

  var getComputedStyle = window.getComputedStyle;
  getStyle = ( function() {
    var getStyleFn = getComputedStyle ?
      function( elem ) {
        return getComputedStyle( elem, null );
      } :
      function( elem ) {
        return elem.currentStyle;
      };

      return function getStyle( elem ) {
        var style = getStyleFn( elem );
        if ( !style ) {
          logError( 'Style returned ' + style +
            '. Are you running this code in a hidden iframe on Firefox? ' +
            'See http://bit.ly/getsizebug1' );
        }
        return style;
      };
  })();

  // -------------------------- box sizing -------------------------- //

  boxSizingProp = getStyleProperty('boxSizing');

  /**
   * WebKit measures the outer-width on style.width on border-box elems
   * IE & Firefox measures the inner-width
   */
  if ( boxSizingProp ) {
    var div = document.createElement('div');
    div.style.width = '200px';
    div.style.padding = '1px 2px 3px 4px';
    div.style.borderStyle = 'solid';
    div.style.borderWidth = '1px 2px 3px 4px';
    div.style[ boxSizingProp ] = 'border-box';

    var body = document.body || document.documentElement;
    body.appendChild( div );
    var style = getStyle( div );

    isBoxSizeOuter = getStyleSize( style.width ) === 200;
    body.removeChild( div );
  }

}

// -------------------------- getSize -------------------------- //

function getSize( elem ) {
  setup();

  // use querySeletor if elem is string
  if ( typeof elem === 'string' ) {
    elem = document.querySelector( elem );
  }

  // do not proceed on non-objects
  if ( !elem || typeof elem !== 'object' || !elem.nodeType ) {
    return;
  }

  var style = getStyle( elem );

  // if hidden, everything is 0
  if ( style.display === 'none' ) {
    return getZeroSize();
  }

  var size = {};
  size.width = elem.offsetWidth;
  size.height = elem.offsetHeight;

  var isBorderBox = size.isBorderBox = !!( boxSizingProp &&
    style[ boxSizingProp ] && style[ boxSizingProp ] === 'border-box' );

  // get all measurements
  for ( var i=0, len = measurements.length; i < len; i++ ) {
    var measurement = measurements[i];
    var value = style[ measurement ];
    value = mungeNonPixel( elem, value );
    var num = parseFloat( value );
    // any 'auto', 'medium' value will be 0
    size[ measurement ] = !isNaN( num ) ? num : 0;
  }

  var paddingWidth = size.paddingLeft + size.paddingRight;
  var paddingHeight = size.paddingTop + size.paddingBottom;
  var marginWidth = size.marginLeft + size.marginRight;
  var marginHeight = size.marginTop + size.marginBottom;
  var borderWidth = size.borderLeftWidth + size.borderRightWidth;
  var borderHeight = size.borderTopWidth + size.borderBottomWidth;

  var isBorderBoxSizeOuter = isBorderBox && isBoxSizeOuter;

  // overwrite width and height if we can get it from style
  var styleWidth = getStyleSize( style.width );
  if ( styleWidth !== false ) {
    size.width = styleWidth +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingWidth + borderWidth );
  }

  var styleHeight = getStyleSize( style.height );
  if ( styleHeight !== false ) {
    size.height = styleHeight +
      // add padding and border unless it's already including it
      ( isBorderBoxSizeOuter ? 0 : paddingHeight + borderHeight );
  }

  size.innerWidth = size.width - ( paddingWidth + borderWidth );
  size.innerHeight = size.height - ( paddingHeight + borderHeight );

  size.outerWidth = size.width + marginWidth;
  size.outerHeight = size.height + marginHeight;

  return size;
}

// IE8 returns percent values, not pixels
// taken from jQuery's curCSS
function mungeNonPixel( elem, value ) {
  // IE8 and has percent value
  if ( window.getComputedStyle || value.indexOf('%') === -1 ) {
    return value;
  }
  var style = elem.style;
  // Remember the original values
  var left = style.left;
  var rs = elem.runtimeStyle;
  var rsLeft = rs && rs.left;

  // Put in the new values to get a computed value out
  if ( rsLeft ) {
    rs.left = elem.currentStyle.left;
  }
  style.left = value;
  value = style.pixelLeft;

  // Revert the changed values
  style.left = left;
  if ( rsLeft ) {
    rs.left = rsLeft;
  }

  return value;
}

return getSize;

}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD for RequireJS
  define( 'get-size/get-size',[ 'get-style-property/get-style-property' ], defineGetSize );
} else if ( typeof exports === 'object' ) {
  // CommonJS for Component
  module.exports = defineGetSize( require('desandro-get-style-property') );
} else {
  // browser global
  window.getSize = defineGetSize( window.getStyleProperty );
}

})( window );

/*!
 * eventie v1.0.6
 * event binding helper
 *   eventie.bind( elem, 'click', myFn )
 *   eventie.unbind( elem, 'click', myFn )
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true */
/*global define: false, module: false */

( function( window ) {



var docElem = document.documentElement;

var bind = function() {};

function getIEEvent( obj ) {
  var event = window.event;
  // add event.target
  event.target = event.target || event.srcElement || obj;
  return event;
}

if ( docElem.addEventListener ) {
  bind = function( obj, type, fn ) {
    obj.addEventListener( type, fn, false );
  };
} else if ( docElem.attachEvent ) {
  bind = function( obj, type, fn ) {
    obj[ type + fn ] = fn.handleEvent ?
      function() {
        var event = getIEEvent( obj );
        fn.handleEvent.call( fn, event );
      } :
      function() {
        var event = getIEEvent( obj );
        fn.call( obj, event );
      };
    obj.attachEvent( "on" + type, obj[ type + fn ] );
  };
}

var unbind = function() {};

if ( docElem.removeEventListener ) {
  unbind = function( obj, type, fn ) {
    obj.removeEventListener( type, fn, false );
  };
} else if ( docElem.detachEvent ) {
  unbind = function( obj, type, fn ) {
    obj.detachEvent( "on" + type, obj[ type + fn ] );
    try {
      delete obj[ type + fn ];
    } catch ( err ) {
      // can't delete window object properties
      obj[ type + fn ] = undefined;
    }
  };
}

var eventie = {
  bind: bind,
  unbind: unbind
};

// ----- module definition ----- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'eventie/eventie',eventie );
} else if ( typeof exports === 'object' ) {
  // CommonJS
  module.exports = eventie;
} else {
  // browser global
  window.eventie = eventie;
}

})( window );

/*!
 * EventEmitter v4.2.11 - git.io/ee
 * Unlicense - http://unlicense.org/
 * Oliver Caldwell - http://oli.me.uk/
 * @preserve
 */

;(function () {
    

    /**
     * Class for managing events.
     * Can be extended to provide event functionality in other classes.
     *
     * @class EventEmitter Manages event registering and emitting.
     */
    function EventEmitter() {}

    // Shortcuts to improve speed and size
    var proto = EventEmitter.prototype;
    var exports = this;
    var originalGlobalValue = exports.EventEmitter;

    /**
     * Finds the index of the listener for the event in its storage array.
     *
     * @param {Function[]} listeners Array of listeners to search through.
     * @param {Function} listener Method to look for.
     * @return {Number} Index of the specified listener, -1 if not found
     * @api private
     */
    function indexOfListener(listeners, listener) {
        var i = listeners.length;
        while (i--) {
            if (listeners[i].listener === listener) {
                return i;
            }
        }

        return -1;
    }

    /**
     * Alias a method while keeping the context correct, to allow for overwriting of target method.
     *
     * @param {String} name The name of the target method.
     * @return {Function} The aliased method
     * @api private
     */
    function alias(name) {
        return function aliasClosure() {
            return this[name].apply(this, arguments);
        };
    }

    /**
     * Returns the listener array for the specified event.
     * Will initialise the event object and listener arrays if required.
     * Will return an object if you use a regex search. The object contains keys for each matched event. So /ba[rz]/ might return an object containing bar and baz. But only if you have either defined them with defineEvent or added some listeners to them.
     * Each property in the object response is an array of listener functions.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Function[]|Object} All listener functions for the event.
     */
    proto.getListeners = function getListeners(evt) {
        var events = this._getEvents();
        var response;
        var key;

        // Return a concatenated array of all matching events if
        // the selector is a regular expression.
        if (evt instanceof RegExp) {
            response = {};
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    response[key] = events[key];
                }
            }
        }
        else {
            response = events[evt] || (events[evt] = []);
        }

        return response;
    };

    /**
     * Takes a list of listener objects and flattens it into a list of listener functions.
     *
     * @param {Object[]} listeners Raw listener objects.
     * @return {Function[]} Just the listener functions.
     */
    proto.flattenListeners = function flattenListeners(listeners) {
        var flatListeners = [];
        var i;

        for (i = 0; i < listeners.length; i += 1) {
            flatListeners.push(listeners[i].listener);
        }

        return flatListeners;
    };

    /**
     * Fetches the requested listeners via getListeners but will always return the results inside an object. This is mainly for internal use but others may find it useful.
     *
     * @param {String|RegExp} evt Name of the event to return the listeners from.
     * @return {Object} All listener functions for an event in an object.
     */
    proto.getListenersAsObject = function getListenersAsObject(evt) {
        var listeners = this.getListeners(evt);
        var response;

        if (listeners instanceof Array) {
            response = {};
            response[evt] = listeners;
        }

        return response || listeners;
    };

    /**
     * Adds a listener function to the specified event.
     * The listener will not be added if it is a duplicate.
     * If the listener returns true then it will be removed after it is called.
     * If you pass a regular expression as the event name then the listener will be added to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListener = function addListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var listenerIsWrapped = typeof listener === 'object';
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key) && indexOfListener(listeners[key], listener) === -1) {
                listeners[key].push(listenerIsWrapped ? listener : {
                    listener: listener,
                    once: false
                });
            }
        }

        return this;
    };

    /**
     * Alias of addListener
     */
    proto.on = alias('addListener');

    /**
     * Semi-alias of addListener. It will add a listener that will be
     * automatically removed after its first execution.
     *
     * @param {String|RegExp} evt Name of the event to attach the listener to.
     * @param {Function} listener Method to be called when the event is emitted. If the function returns true then it will be removed after calling.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addOnceListener = function addOnceListener(evt, listener) {
        return this.addListener(evt, {
            listener: listener,
            once: true
        });
    };

    /**
     * Alias of addOnceListener.
     */
    proto.once = alias('addOnceListener');

    /**
     * Defines an event name. This is required if you want to use a regex to add a listener to multiple events at once. If you don't do this then how do you expect it to know what event to add to? Should it just add to every possible match for a regex? No. That is scary and bad.
     * You need to tell it what event names should be matched by a regex.
     *
     * @param {String} evt Name of the event to create.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvent = function defineEvent(evt) {
        this.getListeners(evt);
        return this;
    };

    /**
     * Uses defineEvent to define multiple events.
     *
     * @param {String[]} evts An array of event names to define.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.defineEvents = function defineEvents(evts) {
        for (var i = 0; i < evts.length; i += 1) {
            this.defineEvent(evts[i]);
        }
        return this;
    };

    /**
     * Removes a listener function from the specified event.
     * When passed a regular expression as the event name, it will remove the listener from all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to remove the listener from.
     * @param {Function} listener Method to remove from the event.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListener = function removeListener(evt, listener) {
        var listeners = this.getListenersAsObject(evt);
        var index;
        var key;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                index = indexOfListener(listeners[key], listener);

                if (index !== -1) {
                    listeners[key].splice(index, 1);
                }
            }
        }

        return this;
    };

    /**
     * Alias of removeListener
     */
    proto.off = alias('removeListener');

    /**
     * Adds listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can add to multiple events at once. The object should contain key value pairs of events and listeners or listener arrays. You can also pass it an event name and an array of listeners to be added.
     * You can also pass it a regular expression to add the array of listeners to all events that match it.
     * Yeah, this function does quite a bit. That's probably a bad thing.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add to multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.addListeners = function addListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(false, evt, listeners);
    };

    /**
     * Removes listeners in bulk using the manipulateListeners method.
     * If you pass an object as the second argument you can remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be removed.
     * You can also pass it a regular expression to remove the listeners from all events that match it.
     *
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeListeners = function removeListeners(evt, listeners) {
        // Pass through to manipulateListeners
        return this.manipulateListeners(true, evt, listeners);
    };

    /**
     * Edits listeners in bulk. The addListeners and removeListeners methods both use this to do their job. You should really use those instead, this is a little lower level.
     * The first argument will determine if the listeners are removed (true) or added (false).
     * If you pass an object as the second argument you can add/remove from multiple events at once. The object should contain key value pairs of events and listeners or listener arrays.
     * You can also pass it an event name and an array of listeners to be added/removed.
     * You can also pass it a regular expression to manipulate the listeners of all events that match it.
     *
     * @param {Boolean} remove True if you want to remove listeners, false if you want to add.
     * @param {String|Object|RegExp} evt An event name if you will pass an array of listeners next. An object if you wish to add/remove from multiple events at once.
     * @param {Function[]} [listeners] An optional array of listener functions to add/remove.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.manipulateListeners = function manipulateListeners(remove, evt, listeners) {
        var i;
        var value;
        var single = remove ? this.removeListener : this.addListener;
        var multiple = remove ? this.removeListeners : this.addListeners;

        // If evt is an object then pass each of its properties to this method
        if (typeof evt === 'object' && !(evt instanceof RegExp)) {
            for (i in evt) {
                if (evt.hasOwnProperty(i) && (value = evt[i])) {
                    // Pass the single listener straight through to the singular method
                    if (typeof value === 'function') {
                        single.call(this, i, value);
                    }
                    else {
                        // Otherwise pass back to the multiple function
                        multiple.call(this, i, value);
                    }
                }
            }
        }
        else {
            // So evt must be a string
            // And listeners must be an array of listeners
            // Loop over it and pass each one to the multiple method
            i = listeners.length;
            while (i--) {
                single.call(this, evt, listeners[i]);
            }
        }

        return this;
    };

    /**
     * Removes all listeners from a specified event.
     * If you do not specify an event then all listeners will be removed.
     * That means every event will be emptied.
     * You can also pass a regex to remove all events that match it.
     *
     * @param {String|RegExp} [evt] Optional name of the event to remove all listeners for. Will remove from every event if not passed.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.removeEvent = function removeEvent(evt) {
        var type = typeof evt;
        var events = this._getEvents();
        var key;

        // Remove different things depending on the state of evt
        if (type === 'string') {
            // Remove all listeners for the specified event
            delete events[evt];
        }
        else if (evt instanceof RegExp) {
            // Remove all events matching the regex.
            for (key in events) {
                if (events.hasOwnProperty(key) && evt.test(key)) {
                    delete events[key];
                }
            }
        }
        else {
            // Remove all listeners in all events
            delete this._events;
        }

        return this;
    };

    /**
     * Alias of removeEvent.
     *
     * Added to mirror the node API.
     */
    proto.removeAllListeners = alias('removeEvent');

    /**
     * Emits an event of your choice.
     * When emitted, every listener attached to that event will be executed.
     * If you pass the optional argument array then those arguments will be passed to every listener upon execution.
     * Because it uses `apply`, your array of arguments will be passed as if you wrote them out separately.
     * So they will not arrive within the array on the other side, they will be separate.
     * You can also pass a regular expression to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {Array} [args] Optional array of arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emitEvent = function emitEvent(evt, args) {
        var listeners = this.getListenersAsObject(evt);
        var listener;
        var i;
        var key;
        var response;

        for (key in listeners) {
            if (listeners.hasOwnProperty(key)) {
                i = listeners[key].length;

                while (i--) {
                    // If the listener returns true then it shall be removed from the event
                    // The function is executed either with a basic call or an apply if there is an args array
                    listener = listeners[key][i];

                    if (listener.once === true) {
                        this.removeListener(evt, listener.listener);
                    }

                    response = listener.listener.apply(this, args || []);

                    if (response === this._getOnceReturnValue()) {
                        this.removeListener(evt, listener.listener);
                    }
                }
            }
        }

        return this;
    };

    /**
     * Alias of emitEvent
     */
    proto.trigger = alias('emitEvent');

    /**
     * Subtly different from emitEvent in that it will pass its arguments on to the listeners, as opposed to taking a single array of arguments to pass on.
     * As with emitEvent, you can pass a regex in place of the event name to emit to all events that match it.
     *
     * @param {String|RegExp} evt Name of the event to emit and execute listeners for.
     * @param {...*} Optional additional arguments to be passed to each listener.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.emit = function emit(evt) {
        var args = Array.prototype.slice.call(arguments, 1);
        return this.emitEvent(evt, args);
    };

    /**
     * Sets the current value to check against when executing listeners. If a
     * listeners return value matches the one set here then it will be removed
     * after execution. This value defaults to true.
     *
     * @param {*} value The new value to check for when executing listeners.
     * @return {Object} Current instance of EventEmitter for chaining.
     */
    proto.setOnceReturnValue = function setOnceReturnValue(value) {
        this._onceReturnValue = value;
        return this;
    };

    /**
     * Fetches the current value to check against when executing listeners. If
     * the listeners return value matches this one then it should be removed
     * automatically. It will return true by default.
     *
     * @return {*|Boolean} The current value to check for or the default, true.
     * @api private
     */
    proto._getOnceReturnValue = function _getOnceReturnValue() {
        if (this.hasOwnProperty('_onceReturnValue')) {
            return this._onceReturnValue;
        }
        else {
            return true;
        }
    };

    /**
     * Fetches the events object and creates one if required.
     *
     * @return {Object} The events storage object.
     * @api private
     */
    proto._getEvents = function _getEvents() {
        return this._events || (this._events = {});
    };

    /**
     * Reverts the global {@link EventEmitter} to its previous value and returns a reference to this version.
     *
     * @return {Function} Non conflicting EventEmitter class.
     */
    EventEmitter.noConflict = function noConflict() {
        exports.EventEmitter = originalGlobalValue;
        return EventEmitter;
    };

    // Expose the class either via AMD, CommonJS or the global object
    if (typeof define === 'function' && define.amd) {
        define('eventEmitter/EventEmitter',[],function () {
            return EventEmitter;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = EventEmitter;
    }
    else {
        exports.EventEmitter = EventEmitter;
    }
}.call(this));

/*!
 * docReady v1.0.4
 * Cross browser DOMContentLoaded event emitter
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true*/
/*global define: false, require: false, module: false */

( function( window ) {



var document = window.document;
// collection of functions to be triggered on ready
var queue = [];

function docReady( fn ) {
  // throw out non-functions
  if ( typeof fn !== 'function' ) {
    return;
  }

  if ( docReady.isReady ) {
    // ready now, hit it
    fn();
  } else {
    // queue function when ready
    queue.push( fn );
  }
}

docReady.isReady = false;

// triggered on various doc ready events
function onReady( event ) {
  // bail if already triggered or IE8 document is not ready just yet
  var isIE8NotReady = event.type === 'readystatechange' && document.readyState !== 'complete';
  if ( docReady.isReady || isIE8NotReady ) {
    return;
  }

  trigger();
}

function trigger() {
  docReady.isReady = true;
  // process queue
  for ( var i=0, len = queue.length; i < len; i++ ) {
    var fn = queue[i];
    fn();
  }
}

function defineDocReady( eventie ) {
  // trigger ready if page is ready
  if ( document.readyState === 'complete' ) {
    trigger();
  } else {
    // listen for events
    eventie.bind( document, 'DOMContentLoaded', onReady );
    eventie.bind( document, 'readystatechange', onReady );
    eventie.bind( window, 'load', onReady );
  }

  return docReady;
}

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( 'doc-ready/doc-ready',[ 'eventie/eventie' ], defineDocReady );
} else if ( typeof exports === 'object' ) {
  module.exports = defineDocReady( require('eventie') );
} else {
  // browser global
  window.docReady = defineDocReady( window.eventie );
}

})( window );

/**
 * matchesSelector v1.0.3
 * matchesSelector( element, '.selector' )
 * MIT license
 */

/*jshint browser: true, strict: true, undef: true, unused: true */
/*global define: false, module: false */

( function( ElemProto ) {

  

  var matchesMethod = ( function() {
    // check for the standard method name first
    if ( ElemProto.matches ) {
      return 'matches';
    }
    // check un-prefixed
    if ( ElemProto.matchesSelector ) {
      return 'matchesSelector';
    }
    // check vendor prefixes
    var prefixes = [ 'webkit', 'moz', 'ms', 'o' ];

    for ( var i=0, len = prefixes.length; i < len; i++ ) {
      var prefix = prefixes[i];
      var method = prefix + 'MatchesSelector';
      if ( ElemProto[ method ] ) {
        return method;
      }
    }
  })();

  // ----- match ----- //

  function match( elem, selector ) {
    return elem[ matchesMethod ]( selector );
  }

  // ----- appendToFragment ----- //

  function checkParent( elem ) {
    // not needed if already has parent
    if ( elem.parentNode ) {
      return;
    }
    var fragment = document.createDocumentFragment();
    fragment.appendChild( elem );
  }

  // ----- query ----- //

  // fall back to using QSA
  // thx @jonathantneal https://gist.github.com/3062955
  function query( elem, selector ) {
    // append to fragment if no parent
    checkParent( elem );

    // match elem with all selected elems of parent
    var elems = elem.parentNode.querySelectorAll( selector );
    for ( var i=0, len = elems.length; i < len; i++ ) {
      // return true if match
      if ( elems[i] === elem ) {
        return true;
      }
    }
    // otherwise return false
    return false;
  }

  // ----- matchChild ----- //

  function matchChild( elem, selector ) {
    checkParent( elem );
    return match( elem, selector );
  }

  // ----- matchesSelector ----- //

  var matchesSelector;

  if ( matchesMethod ) {
    // IE9 supports matchesSelector, but doesn't work on orphaned elems
    // check for that
    var div = document.createElement('div');
    var supportsOrphans = match( div, 'div' );
    matchesSelector = supportsOrphans ? match : matchChild;
  } else {
    matchesSelector = query;
  }

  // transport
  if ( typeof define === 'function' && define.amd ) {
    // AMD
    define( 'matches-selector/matches-selector',[],function() {
      return matchesSelector;
    });
  } else if ( typeof exports === 'object' ) {
    module.exports = matchesSelector;
  }
  else {
    // browser global
    window.matchesSelector = matchesSelector;
  }

})( Element.prototype );

/**
 * Fizzy UI utils v1.0.1
 * MIT license
 */

/*jshint browser: true, undef: true, unused: true, strict: true */

( function( window, factory ) {
  /*global define: false, module: false, require: false */
  
  // universal module definition

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'fizzy-ui-utils/utils',[
      'doc-ready/doc-ready',
      'matches-selector/matches-selector'
    ], function( docReady, matchesSelector ) {
      return factory( window, docReady, matchesSelector );
    });
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      window,
      require('doc-ready'),
      require('desandro-matches-selector')
    );
  } else {
    // browser global
    window.fizzyUIUtils = factory(
      window,
      window.docReady,
      window.matchesSelector
    );
  }

}( window, function factory( window, docReady, matchesSelector ) {



var utils = {};

// ----- extend ----- //

// extends objects
utils.extend = function( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
};

// ----- modulo ----- //

utils.modulo = function( num, div ) {
  return ( ( num % div ) + div ) % div;
};

// ----- isArray ----- //
  
var objToString = Object.prototype.toString;
utils.isArray = function( obj ) {
  return objToString.call( obj ) == '[object Array]';
};

// ----- makeArray ----- //

// turn element or nodeList into an array
utils.makeArray = function( obj ) {
  var ary = [];
  if ( utils.isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( obj && typeof obj.length == 'number' ) {
    // convert nodeList to array
    for ( var i=0, len = obj.length; i < len; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
};

// ----- indexOf ----- //

// index of helper cause IE8
utils.indexOf = Array.prototype.indexOf ? function( ary, obj ) {
    return ary.indexOf( obj );
  } : function( ary, obj ) {
    for ( var i=0, len = ary.length; i < len; i++ ) {
      if ( ary[i] === obj ) {
        return i;
      }
    }
    return -1;
  };

// ----- removeFrom ----- //

utils.removeFrom = function( ary, obj ) {
  var index = utils.indexOf( ary, obj );
  if ( index != -1 ) {
    ary.splice( index, 1 );
  }
};

// ----- isElement ----- //

// http://stackoverflow.com/a/384380/182183
utils.isElement = ( typeof HTMLElement == 'function' || typeof HTMLElement == 'object' ) ?
  function isElementDOM2( obj ) {
    return obj instanceof HTMLElement;
  } :
  function isElementQuirky( obj ) {
    return obj && typeof obj == 'object' &&
      obj.nodeType == 1 && typeof obj.nodeName == 'string';
  };

// ----- setText ----- //

utils.setText = ( function() {
  var setTextProperty;
  function setText( elem, text ) {
    // only check setTextProperty once
    setTextProperty = setTextProperty || ( document.documentElement.textContent !== undefined ? 'textContent' : 'innerText' );
    elem[ setTextProperty ] = text;
  }
  return setText;
})();

// ----- getParent ----- //

utils.getParent = function( elem, selector ) {
  while ( elem != document.body ) {
    elem = elem.parentNode;
    if ( matchesSelector( elem, selector ) ) {
      return elem;
    }
  }
};

// ----- getQueryElement ----- //

// use element as selector string
utils.getQueryElement = function( elem ) {
  if ( typeof elem == 'string' ) {
    return document.querySelector( elem );
  }
  return elem;
};

// ----- handleEvent ----- //

// enable .ontype to trigger from .addEventListener( elem, 'type' )
utils.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

// ----- filterFindElements ----- //

utils.filterFindElements = function( elems, selector ) {
  // make array of elems
  elems = utils.makeArray( elems );
  var ffElems = [];

  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    // check that elem is an actual element
    if ( !utils.isElement( elem ) ) {
      continue;
    }
    // filter & find items if we have a selector
    if ( selector ) {
      // filter siblings
      if ( matchesSelector( elem, selector ) ) {
        ffElems.push( elem );
      }
      // find children
      var childElems = elem.querySelectorAll( selector );
      // concat childElems to filterFound array
      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
        ffElems.push( childElems[j] );
      }
    } else {
      ffElems.push( elem );
    }
  }

  return ffElems;
};

// ----- debounceMethod ----- //

utils.debounceMethod = function( _class, methodName, threshold ) {
  // original method
  var method = _class.prototype[ methodName ];
  var timeoutName = methodName + 'Timeout';

  _class.prototype[ methodName ] = function() {
    var timeout = this[ timeoutName ];
    if ( timeout ) {
      clearTimeout( timeout );
    }
    var args = arguments;

    var _this = this;
    this[ timeoutName ] = setTimeout( function() {
      method.apply( _this, args );
      delete _this[ timeoutName ];
    }, threshold || 100 );
  };
};

// ----- htmlInit ----- //

// http://jamesroberts.name/blog/2010/02/22/string-functions-for-javascript-trim-to-camel-case-to-dashed-and-to-underscore/
utils.toDashed = function( str ) {
  return str.replace( /(.)([A-Z])/g, function( match, $1, $2 ) {
    return $1 + '-' + $2;
  }).toLowerCase();
};

var console = window.console;
/**
 * allow user to initialize classes via .js-namespace class
 * htmlInit( Widget, 'widgetName' )
 * options are parsed from data-namespace-option attribute
 */
utils.htmlInit = function( WidgetClass, namespace ) {
  docReady( function() {
    var dashedNamespace = utils.toDashed( namespace );
    var elems = document.querySelectorAll( '.js-' + dashedNamespace );
    var dataAttr = 'data-' + dashedNamespace + '-options';

    for ( var i=0, len = elems.length; i < len; i++ ) {
      var elem = elems[i];
      var attr = elem.getAttribute( dataAttr );
      var options;
      try {
        options = attr && JSON.parse( attr );
      } catch ( error ) {
        // log error, do not initialize
        if ( console ) {
          console.error( 'Error parsing ' + dataAttr + ' on ' +
            elem.nodeName.toLowerCase() + ( elem.id ? '#' + elem.id : '' ) + ': ' +
            error );
        }
        continue;
      }
      // initialize
      var instance = new WidgetClass( elem, options );
      // make available via $().data('layoutname')
      var jQuery = window.jQuery;
      if ( jQuery ) {
        jQuery.data( elem, namespace, instance );
      }
    }
  });
};

// -----  ----- //

return utils;

}));

/**
 * Outlayer Item
 */

( function( window, factory ) {
  
  // universal module definition
  if ( typeof define === 'function' && define.amd ) {
    // AMD
    define( 'outlayer/item',[
        'eventEmitter/EventEmitter',
        'get-size/get-size',
        'get-style-property/get-style-property',
        'fizzy-ui-utils/utils'
      ],
      function( EventEmitter, getSize, getStyleProperty, utils ) {
        return factory( window, EventEmitter, getSize, getStyleProperty, utils );
      }
    );
  } else if (typeof exports === 'object') {
    // CommonJS
    module.exports = factory(
      window,
      require('wolfy87-eventemitter'),
      require('get-size'),
      require('desandro-get-style-property'),
      require('fizzy-ui-utils')
    );
  } else {
    // browser global
    window.Outlayer = {};
    window.Outlayer.Item = factory(
      window,
      window.EventEmitter,
      window.getSize,
      window.getStyleProperty,
      window.fizzyUIUtils
    );
  }

}( window, function factory( window, EventEmitter, getSize, getStyleProperty, utils ) {


// ----- helpers ----- //

var getComputedStyle = window.getComputedStyle;
var getStyle = getComputedStyle ?
  function( elem ) {
    return getComputedStyle( elem, null );
  } :
  function( elem ) {
    return elem.currentStyle;
  };


function isEmptyObj( obj ) {
  for ( var prop in obj ) {
    return false;
  }
  prop = null;
  return true;
}

// -------------------------- CSS3 support -------------------------- //

var transitionProperty = getStyleProperty('transition');
var transformProperty = getStyleProperty('transform');
var supportsCSS3 = transitionProperty && transformProperty;
var is3d = !!getStyleProperty('perspective');

var transitionEndEvent = {
  WebkitTransition: 'webkitTransitionEnd',
  MozTransition: 'transitionend',
  OTransition: 'otransitionend',
  transition: 'transitionend'
}[ transitionProperty ];

// properties that could have vendor prefix
var prefixableProperties = [
  'transform',
  'transition',
  'transitionDuration',
  'transitionProperty'
];

// cache all vendor properties
var vendorProperties = ( function() {
  var cache = {};
  for ( var i=0, len = prefixableProperties.length; i < len; i++ ) {
    var prop = prefixableProperties[i];
    var supportedProp = getStyleProperty( prop );
    if ( supportedProp && supportedProp !== prop ) {
      cache[ prop ] = supportedProp;
    }
  }
  return cache;
})();

// -------------------------- Item -------------------------- //

function Item( element, layout ) {
  if ( !element ) {
    return;
  }

  this.element = element;
  // parent layout class, i.e. Masonry, Isotope, or Packery
  this.layout = layout;
  this.position = {
    x: 0,
    y: 0
  };

  this._create();
}

// inherit EventEmitter
utils.extend( Item.prototype, EventEmitter.prototype );

Item.prototype._create = function() {
  // transition objects
  this._transn = {
    ingProperties: {},
    clean: {},
    onEnd: {}
  };

  this.css({
    position: 'absolute'
  });
};

// trigger specified handler for event type
Item.prototype.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

Item.prototype.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * apply CSS styles to element
 * @param {Object} style
 */
Item.prototype.css = function( style ) {
  var elemStyle = this.element.style;

  for ( var prop in style ) {
    // use vendor property if available
    var supportedProp = vendorProperties[ prop ] || prop;
    elemStyle[ supportedProp ] = style[ prop ];
  }
};

 // measure position, and sets it
Item.prototype.getPosition = function() {
  var style = getStyle( this.element );
  var layoutOptions = this.layout.options;
  var isOriginLeft = layoutOptions.isOriginLeft;
  var isOriginTop = layoutOptions.isOriginTop;
  var xValue = style[ isOriginLeft ? 'left' : 'right' ];
  var yValue = style[ isOriginTop ? 'top' : 'bottom' ];
  // convert percent to pixels
  var layoutSize = this.layout.size;
  var x = xValue.indexOf('%') != -1 ?
    ( parseFloat( xValue ) / 100 ) * layoutSize.width : parseInt( xValue, 10 );
  var y = yValue.indexOf('%') != -1 ?
    ( parseFloat( yValue ) / 100 ) * layoutSize.height : parseInt( yValue, 10 );

  // clean up 'auto' or other non-integer values
  x = isNaN( x ) ? 0 : x;
  y = isNaN( y ) ? 0 : y;
  // remove padding from measurement
  x -= isOriginLeft ? layoutSize.paddingLeft : layoutSize.paddingRight;
  y -= isOriginTop ? layoutSize.paddingTop : layoutSize.paddingBottom;

  this.position.x = x;
  this.position.y = y;
};

// set settled position, apply padding
Item.prototype.layoutPosition = function() {
  var layoutSize = this.layout.size;
  var layoutOptions = this.layout.options;
  var style = {};

  // x
  var xPadding = layoutOptions.isOriginLeft ? 'paddingLeft' : 'paddingRight';
  var xProperty = layoutOptions.isOriginLeft ? 'left' : 'right';
  var xResetProperty = layoutOptions.isOriginLeft ? 'right' : 'left';

  var x = this.position.x + layoutSize[ xPadding ];
  // set in percentage or pixels
  style[ xProperty ] = this.getXValue( x );
  // reset other property
  style[ xResetProperty ] = '';

  // y
  var yPadding = layoutOptions.isOriginTop ? 'paddingTop' : 'paddingBottom';
  var yProperty = layoutOptions.isOriginTop ? 'top' : 'bottom';
  var yResetProperty = layoutOptions.isOriginTop ? 'bottom' : 'top';

  var y = this.position.y + layoutSize[ yPadding ];
  // set in percentage or pixels
  style[ yProperty ] = this.getYValue( y );
  // reset other property
  style[ yResetProperty ] = '';

  this.css( style );
  this.emitEvent( 'layout', [ this ] );
};

Item.prototype.getXValue = function( x ) {
  var layoutOptions = this.layout.options;
  return layoutOptions.percentPosition && !layoutOptions.isHorizontal ?
    ( ( x / this.layout.size.width ) * 100 ) + '%' : x + 'px';
};

Item.prototype.getYValue = function( y ) {
  var layoutOptions = this.layout.options;
  return layoutOptions.percentPosition && layoutOptions.isHorizontal ?
    ( ( y / this.layout.size.height ) * 100 ) + '%' : y + 'px';
};


Item.prototype._transitionTo = function( x, y ) {
  this.getPosition();
  // get current x & y from top/left
  var curX = this.position.x;
  var curY = this.position.y;

  var compareX = parseInt( x, 10 );
  var compareY = parseInt( y, 10 );
  var didNotMove = compareX === this.position.x && compareY === this.position.y;

  // save end position
  this.setPosition( x, y );

  // if did not move and not transitioning, just go to layout
  if ( didNotMove && !this.isTransitioning ) {
    this.layoutPosition();
    return;
  }

  var transX = x - curX;
  var transY = y - curY;
  var transitionStyle = {};
  transitionStyle.transform = this.getTranslate( transX, transY );

  this.transition({
    to: transitionStyle,
    onTransitionEnd: {
      transform: this.layoutPosition
    },
    isCleaning: true
  });
};

Item.prototype.getTranslate = function( x, y ) {
  // flip cooridinates if origin on right or bottom
  var layoutOptions = this.layout.options;
  x = layoutOptions.isOriginLeft ? x : -x;
  y = layoutOptions.isOriginTop ? y : -y;

  if ( is3d ) {
    return 'translate3d(' + x + 'px, ' + y + 'px, 0)';
  }

  return 'translate(' + x + 'px, ' + y + 'px)';
};

// non transition + transform support
Item.prototype.goTo = function( x, y ) {
  this.setPosition( x, y );
  this.layoutPosition();
};

// use transition and transforms if supported
Item.prototype.moveTo = supportsCSS3 ?
  Item.prototype._transitionTo : Item.prototype.goTo;

Item.prototype.setPosition = function( x, y ) {
  this.position.x = parseInt( x, 10 );
  this.position.y = parseInt( y, 10 );
};

// ----- transition ----- //

/**
 * @param {Object} style - CSS
 * @param {Function} onTransitionEnd
 */

// non transition, just trigger callback
Item.prototype._nonTransition = function( args ) {
  this.css( args.to );
  if ( args.isCleaning ) {
    this._removeStyles( args.to );
  }
  for ( var prop in args.onTransitionEnd ) {
    args.onTransitionEnd[ prop ].call( this );
  }
};

/**
 * proper transition
 * @param {Object} args - arguments
 *   @param {Object} to - style to transition to
 *   @param {Object} from - style to start transition from
 *   @param {Boolean} isCleaning - removes transition styles after transition
 *   @param {Function} onTransitionEnd - callback
 */
Item.prototype._transition = function( args ) {
  // redirect to nonTransition if no transition duration
  if ( !parseFloat( this.layout.options.transitionDuration ) ) {
    this._nonTransition( args );
    return;
  }

  var _transition = this._transn;
  // keep track of onTransitionEnd callback by css property
  for ( var prop in args.onTransitionEnd ) {
    _transition.onEnd[ prop ] = args.onTransitionEnd[ prop ];
  }
  // keep track of properties that are transitioning
  for ( prop in args.to ) {
    _transition.ingProperties[ prop ] = true;
    // keep track of properties to clean up when transition is done
    if ( args.isCleaning ) {
      _transition.clean[ prop ] = true;
    }
  }

  // set from styles
  if ( args.from ) {
    this.css( args.from );
    // force redraw. http://blog.alexmaccaw.com/css-transitions
    var h = this.element.offsetHeight;
    // hack for JSHint to hush about unused var
    h = null;
  }
  // enable transition
  this.enableTransition( args.to );
  // set styles that are transitioning
  this.css( args.to );

  this.isTransitioning = true;

};

// dash before all cap letters, including first for
// WebkitTransform => -webkit-transform
function toDashedAll( str ) {
  return str.replace( /([A-Z])/g, function( $1 ) {
    return '-' + $1.toLowerCase();
  });
}

var transitionProps = 'opacity,' +
  toDashedAll( vendorProperties.transform || 'transform' );

Item.prototype.enableTransition = function(/* style */) {
  // HACK changing transitionProperty during a transition
  // will cause transition to jump
  if ( this.isTransitioning ) {
    return;
  }

  // make `transition: foo, bar, baz` from style object
  // HACK un-comment this when enableTransition can work
  // while a transition is happening
  // var transitionValues = [];
  // for ( var prop in style ) {
  //   // dash-ify camelCased properties like WebkitTransition
  //   prop = vendorProperties[ prop ] || prop;
  //   transitionValues.push( toDashedAll( prop ) );
  // }
  // enable transition styles
  this.css({
    transitionProperty: transitionProps,
    transitionDuration: this.layout.options.transitionDuration
  });
  // listen for transition end event
  this.element.addEventListener( transitionEndEvent, this, false );
};

Item.prototype.transition = Item.prototype[ transitionProperty ? '_transition' : '_nonTransition' ];

// ----- events ----- //

Item.prototype.onwebkitTransitionEnd = function( event ) {
  this.ontransitionend( event );
};

Item.prototype.onotransitionend = function( event ) {
  this.ontransitionend( event );
};

// properties that I munge to make my life easier
var dashedVendorProperties = {
  '-webkit-transform': 'transform',
  '-moz-transform': 'transform',
  '-o-transform': 'transform'
};

Item.prototype.ontransitionend = function( event ) {
  // disregard bubbled events from children
  if ( event.target !== this.element ) {
    return;
  }
  var _transition = this._transn;
  // get property name of transitioned property, convert to prefix-free
  var propertyName = dashedVendorProperties[ event.propertyName ] || event.propertyName;

  // remove property that has completed transitioning
  delete _transition.ingProperties[ propertyName ];
  // check if any properties are still transitioning
  if ( isEmptyObj( _transition.ingProperties ) ) {
    // all properties have completed transitioning
    this.disableTransition();
  }
  // clean style
  if ( propertyName in _transition.clean ) {
    // clean up style
    this.element.style[ event.propertyName ] = '';
    delete _transition.clean[ propertyName ];
  }
  // trigger onTransitionEnd callback
  if ( propertyName in _transition.onEnd ) {
    var onTransitionEnd = _transition.onEnd[ propertyName ];
    onTransitionEnd.call( this );
    delete _transition.onEnd[ propertyName ];
  }

  this.emitEvent( 'transitionEnd', [ this ] );
};

Item.prototype.disableTransition = function() {
  this.removeTransitionStyles();
  this.element.removeEventListener( transitionEndEvent, this, false );
  this.isTransitioning = false;
};

/**
 * removes style property from element
 * @param {Object} style
**/
Item.prototype._removeStyles = function( style ) {
  // clean up transition styles
  var cleanStyle = {};
  for ( var prop in style ) {
    cleanStyle[ prop ] = '';
  }
  this.css( cleanStyle );
};

var cleanTransitionStyle = {
  transitionProperty: '',
  transitionDuration: ''
};

Item.prototype.removeTransitionStyles = function() {
  // remove transition
  this.css( cleanTransitionStyle );
};

// ----- show/hide/remove ----- //

// remove element from DOM
Item.prototype.removeElem = function() {
  this.element.parentNode.removeChild( this.element );
  // remove display: none
  this.css({ display: '' });
  this.emitEvent( 'remove', [ this ] );
};

Item.prototype.remove = function() {
  // just remove element if no transition support or no transition
  if ( !transitionProperty || !parseFloat( this.layout.options.transitionDuration ) ) {
    this.removeElem();
    return;
  }

  // start transition
  var _this = this;
  this.once( 'transitionEnd', function() {
    _this.removeElem();
  });
  this.hide();
};

Item.prototype.reveal = function() {
  delete this.isHidden;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('visibleStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onRevealTransitionEnd;

  this.transition({
    from: options.hiddenStyle,
    to: options.visibleStyle,
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

Item.prototype.onRevealTransitionEnd = function() {
  // check if still visible
  // during transition, item may have been hidden
  if ( !this.isHidden ) {
    this.emitEvent('reveal');
  }
};

/**
 * get style property use for hide/reveal transition end
 * @param {String} styleProperty - hiddenStyle/visibleStyle
 * @returns {String}
 */
Item.prototype.getHideRevealTransitionEndProperty = function( styleProperty ) {
  var optionStyle = this.layout.options[ styleProperty ];
  // use opacity
  if ( optionStyle.opacity ) {
    return 'opacity';
  }
  // get first property
  for ( var prop in optionStyle ) {
    return prop;
  }
};

Item.prototype.hide = function() {
  // set flag
  this.isHidden = true;
  // remove display: none
  this.css({ display: '' });

  var options = this.layout.options;

  var onTransitionEnd = {};
  var transitionEndProperty = this.getHideRevealTransitionEndProperty('hiddenStyle');
  onTransitionEnd[ transitionEndProperty ] = this.onHideTransitionEnd;

  this.transition({
    from: options.visibleStyle,
    to: options.hiddenStyle,
    // keep hidden stuff hidden
    isCleaning: true,
    onTransitionEnd: onTransitionEnd
  });
};

Item.prototype.onHideTransitionEnd = function() {
  // check if still hidden
  // during transition, item may have been un-hidden
  if ( this.isHidden ) {
    this.css({ display: 'none' });
    this.emitEvent('hide');
  }
};

Item.prototype.destroy = function() {
  this.css({
    position: '',
    left: '',
    right: '',
    top: '',
    bottom: '',
    transition: '',
    transform: ''
  });
};

return Item;

}));

/*!
 * Outlayer v1.4.2
 * the brains and guts of a layout library
 * MIT license
 */

( function( window, factory ) {
  
  // universal module definition

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'outlayer/outlayer',[
        'eventie/eventie',
        'eventEmitter/EventEmitter',
        'get-size/get-size',
        'fizzy-ui-utils/utils',
        './item'
      ],
      function( eventie, EventEmitter, getSize, utils, Item ) {
        return factory( window, eventie, EventEmitter, getSize, utils, Item);
      }
    );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      window,
      require('eventie'),
      require('wolfy87-eventemitter'),
      require('get-size'),
      require('fizzy-ui-utils'),
      require('./item')
    );
  } else {
    // browser global
    window.Outlayer = factory(
      window,
      window.eventie,
      window.EventEmitter,
      window.getSize,
      window.fizzyUIUtils,
      window.Outlayer.Item
    );
  }

}( window, function factory( window, eventie, EventEmitter, getSize, utils, Item ) {


// ----- vars ----- //

var console = window.console;
var jQuery = window.jQuery;
var noop = function() {};

// -------------------------- Outlayer -------------------------- //

// globally unique identifiers
var GUID = 0;
// internal store of all Outlayer intances
var instances = {};


/**
 * @param {Element, String} element
 * @param {Object} options
 * @constructor
 */
function Outlayer( element, options ) {
  var queryElement = utils.getQueryElement( element );
  if ( !queryElement ) {
    if ( console ) {
      console.error( 'Bad element for ' + this.constructor.namespace +
        ': ' + ( queryElement || element ) );
    }
    return;
  }
  this.element = queryElement;
  // add jQuery
  if ( jQuery ) {
    this.$element = jQuery( this.element );
  }

  // options
  this.options = utils.extend( {}, this.constructor.defaults );
  this.option( options );

  // add id for Outlayer.getFromElement
  var id = ++GUID;
  this.element.outlayerGUID = id; // expando
  instances[ id ] = this; // associate via id

  // kick it off
  this._create();

  if ( this.options.isInitLayout ) {
    this.layout();
  }
}

// settings are for internal use only
Outlayer.namespace = 'outlayer';
Outlayer.Item = Item;

// default options
Outlayer.defaults = {
  containerStyle: {
    position: 'relative'
  },
  isInitLayout: true,
  isOriginLeft: true,
  isOriginTop: true,
  isResizeBound: true,
  isResizingContainer: true,
  // item options
  transitionDuration: '0.4s',
  hiddenStyle: {
    opacity: 0,
    transform: 'scale(0.001)'
  },
  visibleStyle: {
    opacity: 1,
    transform: 'scale(1)'
  }
};

// inherit EventEmitter
utils.extend( Outlayer.prototype, EventEmitter.prototype );

/**
 * set options
 * @param {Object} opts
 */
Outlayer.prototype.option = function( opts ) {
  utils.extend( this.options, opts );
};

Outlayer.prototype._create = function() {
  // get items from children
  this.reloadItems();
  // elements that affect layout, but are not laid out
  this.stamps = [];
  this.stamp( this.options.stamp );
  // set container style
  utils.extend( this.element.style, this.options.containerStyle );

  // bind resize method
  if ( this.options.isResizeBound ) {
    this.bindResize();
  }
};

// goes through all children again and gets bricks in proper order
Outlayer.prototype.reloadItems = function() {
  // collection of item elements
  this.items = this._itemize( this.element.children );
};


/**
 * turn elements into Outlayer.Items to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - collection of new Outlayer Items
 */
Outlayer.prototype._itemize = function( elems ) {

  var itemElems = this._filterFindItemElements( elems );
  var Item = this.constructor.Item;

  // create new Outlayer Items for collection
  var items = [];
  for ( var i=0, len = itemElems.length; i < len; i++ ) {
    var elem = itemElems[i];
    var item = new Item( elem, this );
    items.push( item );
  }

  return items;
};

/**
 * get item elements to be used in layout
 * @param {Array or NodeList or HTMLElement} elems
 * @returns {Array} items - item elements
 */
Outlayer.prototype._filterFindItemElements = function( elems ) {
  return utils.filterFindElements( elems, this.options.itemSelector );
};

/**
 * getter method for getting item elements
 * @returns {Array} elems - collection of item elements
 */
Outlayer.prototype.getItemElements = function() {
  var elems = [];
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    elems.push( this.items[i].element );
  }
  return elems;
};

// ----- init & layout ----- //

/**
 * lays out all items
 */
Outlayer.prototype.layout = function() {
  this._resetLayout();
  this._manageStamps();

  // don't animate first layout
  var isInstant = this.options.isLayoutInstant !== undefined ?
    this.options.isLayoutInstant : !this._isLayoutInited;
  this.layoutItems( this.items, isInstant );

  // flag for initalized
  this._isLayoutInited = true;
};

// _init is alias for layout
Outlayer.prototype._init = Outlayer.prototype.layout;

/**
 * logic before any new layout
 */
Outlayer.prototype._resetLayout = function() {
  this.getSize();
};


Outlayer.prototype.getSize = function() {
  this.size = getSize( this.element );
};

/**
 * get measurement from option, for columnWidth, rowHeight, gutter
 * if option is String -> get element from selector string, & get size of element
 * if option is Element -> get size of element
 * else use option as a number
 *
 * @param {String} measurement
 * @param {String} size - width or height
 * @private
 */
Outlayer.prototype._getMeasurement = function( measurement, size ) {
  var option = this.options[ measurement ];
  var elem;
  if ( !option ) {
    // default to 0
    this[ measurement ] = 0;
  } else {
    // use option as an element
    if ( typeof option === 'string' ) {
      elem = this.element.querySelector( option );
    } else if ( utils.isElement( option ) ) {
      elem = option;
    }
    // use size of element, if element
    this[ measurement ] = elem ? getSize( elem )[ size ] : option;
  }
};

/**
 * layout a collection of item elements
 * @api public
 */
Outlayer.prototype.layoutItems = function( items, isInstant ) {
  items = this._getItemsForLayout( items );

  this._layoutItems( items, isInstant );

  this._postLayout();
};

/**
 * get the items to be laid out
 * you may want to skip over some items
 * @param {Array} items
 * @returns {Array} items
 */
Outlayer.prototype._getItemsForLayout = function( items ) {
  var layoutItems = [];
  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    if ( !item.isIgnored ) {
      layoutItems.push( item );
    }
  }
  return layoutItems;
};

/**
 * layout items
 * @param {Array} items
 * @param {Boolean} isInstant
 */
Outlayer.prototype._layoutItems = function( items, isInstant ) {
  this._emitCompleteOnItems( 'layout', items );

  if ( !items || !items.length ) {
    // no items, emit event with empty array
    return;
  }

  var queue = [];

  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    // get x/y object from method
    var position = this._getItemLayoutPosition( item );
    // enqueue
    position.item = item;
    position.isInstant = isInstant || item.isLayoutInstant;
    queue.push( position );
  }

  this._processLayoutQueue( queue );
};

/**
 * get item layout position
 * @param {Outlayer.Item} item
 * @returns {Object} x and y position
 */
Outlayer.prototype._getItemLayoutPosition = function( /* item */ ) {
  return {
    x: 0,
    y: 0
  };
};

/**
 * iterate over array and position each item
 * Reason being - separating this logic prevents 'layout invalidation'
 * thx @paul_irish
 * @param {Array} queue
 */
Outlayer.prototype._processLayoutQueue = function( queue ) {
  for ( var i=0, len = queue.length; i < len; i++ ) {
    var obj = queue[i];
    this._positionItem( obj.item, obj.x, obj.y, obj.isInstant );
  }
};

/**
 * Sets position of item in DOM
 * @param {Outlayer.Item} item
 * @param {Number} x - horizontal position
 * @param {Number} y - vertical position
 * @param {Boolean} isInstant - disables transitions
 */
Outlayer.prototype._positionItem = function( item, x, y, isInstant ) {
  if ( isInstant ) {
    // if not transition, just set CSS
    item.goTo( x, y );
  } else {
    item.moveTo( x, y );
  }
};

/**
 * Any logic you want to do after each layout,
 * i.e. size the container
 */
Outlayer.prototype._postLayout = function() {
  this.resizeContainer();
};

Outlayer.prototype.resizeContainer = function() {
  if ( !this.options.isResizingContainer ) {
    return;
  }
  var size = this._getContainerSize();
  if ( size ) {
    this._setContainerMeasure( size.width, true );
    this._setContainerMeasure( size.height, false );
  }
};

/**
 * Sets width or height of container if returned
 * @returns {Object} size
 *   @param {Number} width
 *   @param {Number} height
 */
Outlayer.prototype._getContainerSize = noop;

/**
 * @param {Number} measure - size of width or height
 * @param {Boolean} isWidth
 */
Outlayer.prototype._setContainerMeasure = function( measure, isWidth ) {
  if ( measure === undefined ) {
    return;
  }

  var elemSize = this.size;
  // add padding and border width if border box
  if ( elemSize.isBorderBox ) {
    measure += isWidth ? elemSize.paddingLeft + elemSize.paddingRight +
      elemSize.borderLeftWidth + elemSize.borderRightWidth :
      elemSize.paddingBottom + elemSize.paddingTop +
      elemSize.borderTopWidth + elemSize.borderBottomWidth;
  }

  measure = Math.max( measure, 0 );
  this.element.style[ isWidth ? 'width' : 'height' ] = measure + 'px';
};

/**
 * emit eventComplete on a collection of items events
 * @param {String} eventName
 * @param {Array} items - Outlayer.Items
 */
Outlayer.prototype._emitCompleteOnItems = function( eventName, items ) {
  var _this = this;
  function onComplete() {
    _this.dispatchEvent( eventName + 'Complete', null, [ items ] );
  }

  var count = items.length;
  if ( !items || !count ) {
    onComplete();
    return;
  }

  var doneCount = 0;
  function tick() {
    doneCount++;
    if ( doneCount === count ) {
      onComplete();
    }
  }

  // bind callback
  for ( var i=0, len = items.length; i < len; i++ ) {
    var item = items[i];
    item.once( eventName, tick );
  }
};

/**
 * emits events via eventEmitter and jQuery events
 * @param {String} type - name of event
 * @param {Event} event - original event
 * @param {Array} args - extra arguments
 */
Outlayer.prototype.dispatchEvent = function( type, event, args ) {
  // add original event to arguments
  var emitArgs = event ? [ event ].concat( args ) : args;
  this.emitEvent( type, emitArgs );

  if ( jQuery ) {
    // set this.$element
    this.$element = this.$element || jQuery( this.element );
    if ( event ) {
      // create jQuery event
      var $event = jQuery.Event( event );
      $event.type = type;
      this.$element.trigger( $event, args );
    } else {
      // just trigger with type if no event available
      this.$element.trigger( type, args );
    }
  }
};

// -------------------------- ignore & stamps -------------------------- //


/**
 * keep item in collection, but do not lay it out
 * ignored items do not get skipped in layout
 * @param {Element} elem
 */
Outlayer.prototype.ignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    item.isIgnored = true;
  }
};

/**
 * return item to layout collection
 * @param {Element} elem
 */
Outlayer.prototype.unignore = function( elem ) {
  var item = this.getItem( elem );
  if ( item ) {
    delete item.isIgnored;
  }
};

/**
 * adds elements to stamps
 * @param {NodeList, Array, Element, or String} elems
 */
Outlayer.prototype.stamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ) {
    return;
  }

  this.stamps = this.stamps.concat( elems );
  // ignore
  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    this.ignore( elem );
  }
};

/**
 * removes elements to stamps
 * @param {NodeList, Array, or Element} elems
 */
Outlayer.prototype.unstamp = function( elems ) {
  elems = this._find( elems );
  if ( !elems ){
    return;
  }

  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    // filter out removed stamp elements
    utils.removeFrom( this.stamps, elem );
    this.unignore( elem );
  }

};

/**
 * finds child elements
 * @param {NodeList, Array, Element, or String} elems
 * @returns {Array} elems
 */
Outlayer.prototype._find = function( elems ) {
  if ( !elems ) {
    return;
  }
  // if string, use argument as selector string
  if ( typeof elems === 'string' ) {
    elems = this.element.querySelectorAll( elems );
  }
  elems = utils.makeArray( elems );
  return elems;
};

Outlayer.prototype._manageStamps = function() {
  if ( !this.stamps || !this.stamps.length ) {
    return;
  }

  this._getBoundingRect();

  for ( var i=0, len = this.stamps.length; i < len; i++ ) {
    var stamp = this.stamps[i];
    this._manageStamp( stamp );
  }
};

// update boundingLeft / Top
Outlayer.prototype._getBoundingRect = function() {
  // get bounding rect for container element
  var boundingRect = this.element.getBoundingClientRect();
  var size = this.size;
  this._boundingRect = {
    left: boundingRect.left + size.paddingLeft + size.borderLeftWidth,
    top: boundingRect.top + size.paddingTop + size.borderTopWidth,
    right: boundingRect.right - ( size.paddingRight + size.borderRightWidth ),
    bottom: boundingRect.bottom - ( size.paddingBottom + size.borderBottomWidth )
  };
};

/**
 * @param {Element} stamp
**/
Outlayer.prototype._manageStamp = noop;

/**
 * get x/y position of element relative to container element
 * @param {Element} elem
 * @returns {Object} offset - has left, top, right, bottom
 */
Outlayer.prototype._getElementOffset = function( elem ) {
  var boundingRect = elem.getBoundingClientRect();
  var thisRect = this._boundingRect;
  var size = getSize( elem );
  var offset = {
    left: boundingRect.left - thisRect.left - size.marginLeft,
    top: boundingRect.top - thisRect.top - size.marginTop,
    right: thisRect.right - boundingRect.right - size.marginRight,
    bottom: thisRect.bottom - boundingRect.bottom - size.marginBottom
  };
  return offset;
};

// -------------------------- resize -------------------------- //

// enable event handlers for listeners
// i.e. resize -> onresize
Outlayer.prototype.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

/**
 * Bind layout to window resizing
 */
Outlayer.prototype.bindResize = function() {
  // bind just one listener
  if ( this.isResizeBound ) {
    return;
  }
  eventie.bind( window, 'resize', this );
  this.isResizeBound = true;
};

/**
 * Unbind layout to window resizing
 */
Outlayer.prototype.unbindResize = function() {
  if ( this.isResizeBound ) {
    eventie.unbind( window, 'resize', this );
  }
  this.isResizeBound = false;
};

// original debounce by John Hann
// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

// this fires every resize
Outlayer.prototype.onresize = function() {
  if ( this.resizeTimeout ) {
    clearTimeout( this.resizeTimeout );
  }

  var _this = this;
  function delayed() {
    _this.resize();
    delete _this.resizeTimeout;
  }

  this.resizeTimeout = setTimeout( delayed, 100 );
};

// debounced, layout on resize
Outlayer.prototype.resize = function() {
  // don't trigger if size did not change
  // or if resize was unbound. See #9
  if ( !this.isResizeBound || !this.needsResizeLayout() ) {
    return;
  }

  this.layout();
};

/**
 * check if layout is needed post layout
 * @returns Boolean
 */
Outlayer.prototype.needsResizeLayout = function() {
  var size = getSize( this.element );
  // check that this.size and size are there
  // IE8 triggers resize on body size change, so they might not be
  var hasSizes = this.size && size;
  return hasSizes && size.innerWidth !== this.size.innerWidth;
};

// -------------------------- methods -------------------------- //

/**
 * add items to Outlayer instance
 * @param {Array or NodeList or Element} elems
 * @returns {Array} items - Outlayer.Items
**/
Outlayer.prototype.addItems = function( elems ) {
  var items = this._itemize( elems );
  // add items to collection
  if ( items.length ) {
    this.items = this.items.concat( items );
  }
  return items;
};

/**
 * Layout newly-appended item elements
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.appended = function( elems ) {
  var items = this.addItems( elems );
  if ( !items.length ) {
    return;
  }
  // layout and reveal just the new items
  this.layoutItems( items, true );
  this.reveal( items );
};

/**
 * Layout prepended elements
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.prepended = function( elems ) {
  var items = this._itemize( elems );
  if ( !items.length ) {
    return;
  }
  // add items to beginning of collection
  var previousItems = this.items.slice(0);
  this.items = items.concat( previousItems );
  // start new layout
  this._resetLayout();
  this._manageStamps();
  // layout new stuff without transition
  this.layoutItems( items, true );
  this.reveal( items );
  // layout previous items
  this.layoutItems( previousItems );
};

/**
 * reveal a collection of items
 * @param {Array of Outlayer.Items} items
 */
Outlayer.prototype.reveal = function( items ) {
  this._emitCompleteOnItems( 'reveal', items );

  var len = items && items.length;
  for ( var i=0; len && i < len; i++ ) {
    var item = items[i];
    item.reveal();
  }
};

/**
 * hide a collection of items
 * @param {Array of Outlayer.Items} items
 */
Outlayer.prototype.hide = function( items ) {
  this._emitCompleteOnItems( 'hide', items );

  var len = items && items.length;
  for ( var i=0; len && i < len; i++ ) {
    var item = items[i];
    item.hide();
  }
};

/**
 * reveal item elements
 * @param {Array}, {Element}, {NodeList} items
 */
Outlayer.prototype.revealItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.reveal( items );
};

/**
 * hide item elements
 * @param {Array}, {Element}, {NodeList} items
 */
Outlayer.prototype.hideItemElements = function( elems ) {
  var items = this.getItems( elems );
  this.hide( items );
};

/**
 * get Outlayer.Item, given an Element
 * @param {Element} elem
 * @param {Function} callback
 * @returns {Outlayer.Item} item
 */
Outlayer.prototype.getItem = function( elem ) {
  // loop through items to get the one that matches
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    var item = this.items[i];
    if ( item.element === elem ) {
      // return item
      return item;
    }
  }
};

/**
 * get collection of Outlayer.Items, given Elements
 * @param {Array} elems
 * @returns {Array} items - Outlayer.Items
 */
Outlayer.prototype.getItems = function( elems ) {
  elems = utils.makeArray( elems );
  var items = [];
  for ( var i=0, len = elems.length; i < len; i++ ) {
    var elem = elems[i];
    var item = this.getItem( elem );
    if ( item ) {
      items.push( item );
    }
  }

  return items;
};

/**
 * remove element(s) from instance and DOM
 * @param {Array or NodeList or Element} elems
 */
Outlayer.prototype.remove = function( elems ) {
  var removeItems = this.getItems( elems );

  this._emitCompleteOnItems( 'remove', removeItems );

  // bail if no items to remove
  if ( !removeItems || !removeItems.length ) {
    return;
  }

  for ( var i=0, len = removeItems.length; i < len; i++ ) {
    var item = removeItems[i];
    item.remove();
    // remove item from collection
    utils.removeFrom( this.items, item );
  }
};

// ----- destroy ----- //

// remove and disable Outlayer instance
Outlayer.prototype.destroy = function() {
  // clean up dynamic styles
  var style = this.element.style;
  style.height = '';
  style.position = '';
  style.width = '';
  // destroy items
  for ( var i=0, len = this.items.length; i < len; i++ ) {
    var item = this.items[i];
    item.destroy();
  }

  this.unbindResize();

  var id = this.element.outlayerGUID;
  delete instances[ id ]; // remove reference to instance by id
  delete this.element.outlayerGUID;
  // remove data for jQuery
  if ( jQuery ) {
    jQuery.removeData( this.element, this.constructor.namespace );
  }

};

// -------------------------- data -------------------------- //

/**
 * get Outlayer instance from element
 * @param {Element} elem
 * @returns {Outlayer}
 */
Outlayer.data = function( elem ) {
  elem = utils.getQueryElement( elem );
  var id = elem && elem.outlayerGUID;
  return id && instances[ id ];
};


// -------------------------- create Outlayer class -------------------------- //

/**
 * create a layout class
 * @param {String} namespace
 */
Outlayer.create = function( namespace, options ) {
  // sub-class Outlayer
  function Layout() {
    Outlayer.apply( this, arguments );
  }
  // inherit Outlayer prototype, use Object.create if there
  if ( Object.create ) {
    Layout.prototype = Object.create( Outlayer.prototype );
  } else {
    utils.extend( Layout.prototype, Outlayer.prototype );
  }
  // set contructor, used for namespace and Item
  Layout.prototype.constructor = Layout;

  Layout.defaults = utils.extend( {}, Outlayer.defaults );
  // apply new options
  utils.extend( Layout.defaults, options );
  // keep prototype.settings for backwards compatibility (Packery v1.2.0)
  Layout.prototype.settings = {};

  Layout.namespace = namespace;

  Layout.data = Outlayer.data;

  // sub-class Item
  Layout.Item = function LayoutItem() {
    Item.apply( this, arguments );
  };

  Layout.Item.prototype = new Item();

  // -------------------------- declarative -------------------------- //

  utils.htmlInit( Layout, namespace );

  // -------------------------- jQuery bridge -------------------------- //

  // make into jQuery plugin
  if ( jQuery && jQuery.bridget ) {
    jQuery.bridget( namespace, Layout );
  }

  return Layout;
};

// ----- fin ----- //

// back in global
Outlayer.Item = Item;

return Outlayer;

}));


/**
 * Rect
 * low-level utility class for basic geometry
 */

( function( window, factory ) {
  
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'packery/js/rect',factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory();
  } else {
    // browser global
    window.Packery = window.Packery || {};
    window.Packery.Rect = factory();
  }

}( window, function factory() {


// -------------------------- Packery -------------------------- //

// global namespace
var Packery = window.Packery = function() {};

// -------------------------- Rect -------------------------- //

function Rect( props ) {
  // extend properties from defaults
  for ( var prop in Rect.defaults ) {
    this[ prop ] = Rect.defaults[ prop ];
  }

  for ( prop in props ) {
    this[ prop ] = props[ prop ];
  }

}

// make available
Packery.Rect = Rect;

Rect.defaults = {
  x: 0,
  y: 0,
  width: 0,
  height: 0
};

/**
 * Determines whether or not this rectangle wholly encloses another rectangle or point.
 * @param {Rect} rect
 * @returns {Boolean}
**/
Rect.prototype.contains = function( rect ) {
  // points don't have width or height
  var otherWidth = rect.width || 0;
  var otherHeight = rect.height || 0;
  return this.x <= rect.x &&
    this.y <= rect.y &&
    this.x + this.width >= rect.x + otherWidth &&
    this.y + this.height >= rect.y + otherHeight;
};

/**
 * Determines whether or not the rectangle intersects with another.
 * @param {Rect} rect
 * @returns {Boolean}
**/
Rect.prototype.overlaps = function( rect ) {
  var thisRight = this.x + this.width;
  var thisBottom = this.y + this.height;
  var rectRight = rect.x + rect.width;
  var rectBottom = rect.y + rect.height;

  // http://stackoverflow.com/a/306332
  return this.x < rectRight &&
    thisRight > rect.x &&
    this.y < rectBottom &&
    thisBottom > rect.y;
};

/**
 * @param {Rect} rect - the overlapping rect
 * @returns {Array} freeRects - rects representing the area around the rect
**/
Rect.prototype.getMaximalFreeRects = function( rect ) {

  // if no intersection, return false
  if ( !this.overlaps( rect ) ) {
    return false;
  }

  var freeRects = [];
  var freeRect;

  var thisRight = this.x + this.width;
  var thisBottom = this.y + this.height;
  var rectRight = rect.x + rect.width;
  var rectBottom = rect.y + rect.height;

  // top
  if ( this.y < rect.y ) {
    freeRect = new Rect({
      x: this.x,
      y: this.y,
      width: this.width,
      height: rect.y - this.y
    });
    freeRects.push( freeRect );
  }

  // right
  if ( thisRight > rectRight ) {
    freeRect = new Rect({
      x: rectRight,
      y: this.y,
      width: thisRight - rectRight,
      height: this.height
    });
    freeRects.push( freeRect );
  }

  // bottom
  if ( thisBottom > rectBottom ) {
    freeRect = new Rect({
      x: this.x,
      y: rectBottom,
      width: this.width,
      height: thisBottom - rectBottom
    });
    freeRects.push( freeRect );
  }

  // left
  if ( this.x < rect.x ) {
    freeRect = new Rect({
      x: this.x,
      y: this.y,
      width: rect.x - this.x,
      height: this.height
    });
    freeRects.push( freeRect );
  }

  return freeRects;
};

Rect.prototype.canFit = function( rect ) {
  return this.width >= rect.width && this.height >= rect.height;
};

return Rect;

}));

/**
 * Packer
 * bin-packing algorithm
 */

( function( window, factory ) {
  
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'packery/js/packer',[ './rect' ], factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('./rect')
    );
  } else {
    // browser global
    var Packery = window.Packery = window.Packery || {};
    Packery.Packer = factory( Packery.Rect );
  }

}( window, function factory( Rect ) {


// -------------------------- Packer -------------------------- //

/**
 * @param {Number} width
 * @param {Number} height
 * @param {String} sortDirection
 *   topLeft for vertical, leftTop for horizontal
 */
function Packer( width, height, sortDirection ) {
  this.width = width || 0;
  this.height = height || 0;
  this.sortDirection = sortDirection || 'downwardLeftToRight';

  this.reset();
}

Packer.prototype.reset = function() {
  this.spaces = [];
  this.newSpaces = [];

  var initialSpace = new Rect({
    x: 0,
    y: 0,
    width: this.width,
    height: this.height
  });

  this.spaces.push( initialSpace );
  // set sorter
  this.sorter = sorters[ this.sortDirection ] || sorters.downwardLeftToRight;
};

// change x and y of rect to fit with in Packer's available spaces
Packer.prototype.pack = function( rect ) {
  for ( var i=0, len = this.spaces.length; i < len; i++ ) {
    var space = this.spaces[i];
    if ( space.canFit( rect ) ) {
      this.placeInSpace( rect, space );
      break;
    }
  }
};

Packer.prototype.placeInSpace = function( rect, space ) {
  // place rect in space
  rect.x = space.x;
  rect.y = space.y;

  this.placed( rect );
};

// update spaces with placed rect
Packer.prototype.placed = function( rect ) {
  // update spaces
  var revisedSpaces = [];
  for ( var i=0, len = this.spaces.length; i < len; i++ ) {
    var space = this.spaces[i];
    var newSpaces = space.getMaximalFreeRects( rect );
    // add either the original space or the new spaces to the revised spaces
    if ( newSpaces ) {
      revisedSpaces.push.apply( revisedSpaces, newSpaces );
    } else {
      revisedSpaces.push( space );
    }
  }

  this.spaces = revisedSpaces;

  this.mergeSortSpaces();
};

Packer.prototype.mergeSortSpaces = function() {
  // remove redundant spaces
  Packer.mergeRects( this.spaces );
  this.spaces.sort( this.sorter );
};

// add a space back
Packer.prototype.addSpace = function( rect ) {
  this.spaces.push( rect );
  this.mergeSortSpaces();
};

// -------------------------- utility functions -------------------------- //

/**
 * Remove redundant rectangle from array of rectangles
 * @param {Array} rects: an array of Rects
 * @returns {Array} rects: an array of Rects
**/
Packer.mergeRects = function( rects ) {
  for ( var i=0, len = rects.length; i < len; i++ ) {
    var rect = rects[i];
    // skip over this rect if it was already removed
    if ( !rect ) {
      continue;
    }
    // clone rects we're testing, remove this rect
    var compareRects = rects.slice(0);
    // do not compare with self
    compareRects.splice( i, 1 );
    // compare this rect with others
    var removedCount = 0;
    for ( var j=0, jLen = compareRects.length; j < jLen; j++ ) {
      var compareRect = compareRects[j];
      // if this rect contains another,
      // remove that rect from test collection
      var indexAdjust = i > j ? 0 : 1;
      if ( rect.contains( compareRect ) ) {
        // console.log( 'current test rects:' + testRects.length, testRects );
        // console.log( i, j, indexAdjust, rect, compareRect );
        rects.splice( j + indexAdjust - removedCount, 1 );
        removedCount++;
      }
    }
  }

  return rects;
};


// -------------------------- sorters -------------------------- //

// functions for sorting rects in order
var sorters = {
  // top down, then left to right
  downwardLeftToRight: function( a, b ) {
    return a.y - b.y || a.x - b.x;
  },
  // left to right, then top down
  rightwardTopToBottom: function( a, b ) {
    return a.x - b.x || a.y - b.y;
  }
};


// --------------------------  -------------------------- //

return Packer;

}));
/**
 * Packery Item Element
**/

( function( window, factory ) {
  
  // universal module definition

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( 'packery/js/item',[
        'get-style-property/get-style-property',
        'outlayer/outlayer',
        './rect'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('desandro-get-style-property'),
      require('outlayer'),
      require('./rect')
    );
  } else {
    // browser global
    window.Packery.Item = factory(
      window.getStyleProperty,
      window.Outlayer,
      window.Packery.Rect
    );
  }

}( window, function factory( getStyleProperty, Outlayer, Rect ) {


// -------------------------- Item -------------------------- //

var transformProperty = getStyleProperty('transform');

// sub-class Item
var Item = function PackeryItem() {
  Outlayer.Item.apply( this, arguments );
};

Item.prototype = new Outlayer.Item();

var protoCreate = Item.prototype._create;
Item.prototype._create = function() {
  // call default _create logic
  protoCreate.call( this );
  this.rect = new Rect();
  // rect used for placing, in drag or Packery.fit()
  this.placeRect = new Rect();
};

// -------------------------- drag -------------------------- //

Item.prototype.dragStart = function() {
  this.getPosition();
  this.removeTransitionStyles();
  // remove transform property from transition
  if ( this.isTransitioning && transformProperty ) {
    this.element.style[ transformProperty ] = 'none';
  }
  this.getSize();
  // create place rect, used for position when dragged then dropped
  // or when positioning
  this.isPlacing = true;
  this.needsPositioning = false;
  this.positionPlaceRect( this.position.x, this.position.y );
  this.isTransitioning = false;
  this.didDrag = false;
};

/**
 * handle item when it is dragged
 * @param {Number} x - horizontal position of dragged item
 * @param {Number} y - vertical position of dragged item
 */
Item.prototype.dragMove = function( x, y ) {
  this.didDrag = true;
  var packerySize = this.layout.size;
  x -= packerySize.paddingLeft;
  y -= packerySize.paddingTop;
  this.positionPlaceRect( x, y );
};

Item.prototype.dragStop = function() {
  this.getPosition();
  var isDiffX = this.position.x != this.placeRect.x;
  var isDiffY = this.position.y != this.placeRect.y;
  // set post-drag positioning flag
  this.needsPositioning = isDiffX || isDiffY;
  // reset flag
  this.didDrag = false;
};

// -------------------------- placing -------------------------- //

/**
 * position a rect that will occupy space in the packer
 * @param {Number} x
 * @param {Number} y
 * @param {Boolean} isMaxYContained
 */
Item.prototype.positionPlaceRect = function( x, y, isMaxYOpen ) {
  this.placeRect.x = this.getPlaceRectCoord( x, true );
  this.placeRect.y = this.getPlaceRectCoord( y, false, isMaxYOpen );
};

/**
 * get x/y coordinate for place rect
 * @param {Number} coord - x or y
 * @param {Boolean} isX
 * @param {Boolean} isMaxOpen - does not limit value to outer bound
 * @returns {Number} coord - processed x or y
 */
Item.prototype.getPlaceRectCoord = function( coord, isX, isMaxOpen ) {
  var measure = isX ? 'Width' : 'Height';
  var size = this.size[ 'outer' + measure ];
  var segment = this.layout[ isX ? 'columnWidth' : 'rowHeight' ];
  var parentSize = this.layout.size[ 'inner' + measure ];

  // additional parentSize calculations for Y
  if ( !isX ) {
    parentSize = Math.max( parentSize, this.layout.maxY );
    // prevent gutter from bumping up height when non-vertical grid
    if ( !this.layout.rowHeight ) {
      parentSize -= this.layout.gutter;
    }
  }

  var max;

  if ( segment ) {
    segment += this.layout.gutter;
    // allow for last column to reach the edge
    parentSize += isX ? this.layout.gutter : 0;
    // snap to closest segment
    coord = Math.round( coord / segment );
    // contain to outer bound
    // contain non-growing bound, allow growing bound to grow
    var mathMethod;
    if ( this.layout.options.isHorizontal ) {
      mathMethod = !isX ? 'floor' : 'ceil';
    } else {
      mathMethod = isX ? 'floor' : 'ceil';
    }
    var maxSegments = Math[ mathMethod ]( parentSize / segment );
    maxSegments -= Math.ceil( size / segment );
    max = maxSegments;
  } else {
    max = parentSize - size;
  }

  coord = isMaxOpen ? coord : Math.min( coord, max );
  coord *= segment || 1;

  return Math.max( 0, coord );
};

Item.prototype.copyPlaceRectPosition = function() {
  this.rect.x = this.placeRect.x;
  this.rect.y = this.placeRect.y;
};

// -----  ----- //

// remove element from DOM
Item.prototype.removeElem = function() {
  this.element.parentNode.removeChild( this.element );
  // add space back to packer
  this.layout.packer.addSpace( this.rect );
  this.emitEvent( 'remove', [ this ] );
};

// -----  ----- //

return Item;

}));

/*!
 * Packery v1.4.3
 * bin-packing layout library
 *
 * Licensed GPLv3 for open source use
 * or Flickity Commercial License for commercial use
 *
 * http://packery.metafizzy.co
 * Copyright 2015 Metafizzy
 */

( function( window, factory ) {
  
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( [
        'classie/classie',
        'get-size/get-size',
        'outlayer/outlayer',
        'packery/js/rect',
        'packery/js/packer',
        'packery/js/item'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('desandro-classie'),
      require('get-size'),
      require('outlayer'),
      require('./rect'),
      require('./packer'),
      require('./item')
    );
  } else {
    // browser global
    window.Packery = factory(
      window.classie,
      window.getSize,
      window.Outlayer,
      window.Packery.Rect,
      window.Packery.Packer,
      window.Packery.Item
    );
  }

}( window, function factory( classie, getSize, Outlayer, Rect, Packer, Item ) {


// ----- Rect ----- //

// allow for pixel rounding errors IE8-IE11 & Firefox; #227
Rect.prototype.canFit = function( rect ) {
  return this.width >= rect.width - 1 && this.height >= rect.height - 1;
};

// -------------------------- Packery -------------------------- //

// create an Outlayer layout class
var Packery = Outlayer.create('packery');
Packery.Item = Item;

Packery.prototype._create = function() {
  // call super
  Outlayer.prototype._create.call( this );

  // initial properties
  this.packer = new Packer();

  // Left over from v1.0
  this.stamp( this.options.stamped );

  // create drag handlers
  var _this = this;
  this.handleDraggabilly = {
    dragStart: function() {
      _this.itemDragStart( this.element );
    },
    dragMove: function() {
      _this.itemDragMove( this.element, this.position.x, this.position.y );
    },
    dragEnd: function() {
      _this.itemDragEnd( this.element );
    }
  };

  this.handleUIDraggable = {
    start: function handleUIDraggableStart( event, ui ) {
      // HTML5 may trigger dragstart, dismiss HTML5 dragging
      if ( !ui ) {
        return;
      }
      _this.itemDragStart( event.currentTarget );
    },
    drag: function handleUIDraggableDrag( event, ui ) {
      if ( !ui ) {
        return;
      }
      _this.itemDragMove( event.currentTarget, ui.position.left, ui.position.top );
    },
    stop: function handleUIDraggableStop( event, ui ) {
      if ( !ui ) {
        return;
      }
      _this.itemDragEnd( event.currentTarget );
    }
  };

};


// ----- init & layout ----- //

/**
 * logic before any new layout
 */
Packery.prototype._resetLayout = function() {
  this.getSize();

  this._getMeasurements();

  // reset packer
  var packer = this.packer;
  // packer settings, if horizontal or vertical
  if ( this.options.isHorizontal ) {
    packer.width = Number.POSITIVE_INFINITY;
    packer.height = this.size.innerHeight + this.gutter;
    packer.sortDirection = 'rightwardTopToBottom';
  } else {
    packer.width = this.size.innerWidth + this.gutter;
    packer.height = Number.POSITIVE_INFINITY;
    packer.sortDirection = 'downwardLeftToRight';
  }

  packer.reset();

  // layout
  this.maxY = 0;
  this.maxX = 0;
};

/**
 * update columnWidth, rowHeight, & gutter
 * @private
 */
Packery.prototype._getMeasurements = function() {
  this._getMeasurement( 'columnWidth', 'width' );
  this._getMeasurement( 'rowHeight', 'height' );
  this._getMeasurement( 'gutter', 'width' );
};

Packery.prototype._getItemLayoutPosition = function( item ) {
  this._packItem( item );
  return item.rect;
};


/**
 * layout item in packer
 * @param {Packery.Item} item
 */
Packery.prototype._packItem = function( item ) {
  this._setRectSize( item.element, item.rect );
  // pack the rect in the packer
  this.packer.pack( item.rect );
  this._setMaxXY( item.rect );
};

/**
 * set max X and Y value, for size of container
 * @param {Packery.Rect} rect
 * @private
 */
Packery.prototype._setMaxXY = function( rect ) {
  this.maxX = Math.max( rect.x + rect.width, this.maxX );
  this.maxY = Math.max( rect.y + rect.height, this.maxY );
};

/**
 * set the width and height of a rect, applying columnWidth and rowHeight
 * @param {Element} elem
 * @param {Packery.Rect} rect
 */
Packery.prototype._setRectSize = function( elem, rect ) {
  var size = getSize( elem );
  var w = size.outerWidth;
  var h = size.outerHeight;
  // size for columnWidth and rowHeight, if available
  // only check if size is non-zero, #177
  if ( w || h ) {
    w = this._applyGridGutter( w, this.columnWidth );
    h = this._applyGridGutter( h, this.rowHeight );
  }
  // rect must fit in packer
  rect.width = Math.min( w, this.packer.width );
  rect.height = Math.min( h, this.packer.height );
};

/**
 * fits item to columnWidth/rowHeight and adds gutter
 * @param {Number} measurement - item width or height
 * @param {Number} gridSize - columnWidth or rowHeight
 * @returns measurement
 */
Packery.prototype._applyGridGutter = function( measurement, gridSize ) {
  // just add gutter if no gridSize
  if ( !gridSize ) {
    return measurement + this.gutter;
  }
  gridSize += this.gutter;
  // fit item to columnWidth/rowHeight
  var remainder = measurement % gridSize;
  var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
  measurement = Math[ mathMethod ]( measurement / gridSize ) * gridSize;
  return measurement;
};

Packery.prototype._getContainerSize = function() {
  if ( this.options.isHorizontal ) {
    return {
      width: this.maxX - this.gutter
    };
  } else {
    return {
      height: this.maxY - this.gutter
    };
  }
};


// -------------------------- stamp -------------------------- //

/**
 * makes space for element
 * @param {Element} elem
 */
Packery.prototype._manageStamp = function( elem ) {

  var item = this.getItem( elem );
  var rect;
  if ( item && item.isPlacing ) {
    rect = item.placeRect;
  } else {
    var offset = this._getElementOffset( elem );
    rect = new Rect({
      x: this.options.isOriginLeft ? offset.left : offset.right,
      y: this.options.isOriginTop ? offset.top : offset.bottom
    });
  }

  this._setRectSize( elem, rect );
  // save its space in the packer
  this.packer.placed( rect );
  this._setMaxXY( rect );
};

// -------------------------- methods -------------------------- //

function verticalSorter( a, b ) {
  return a.position.y - b.position.y || a.position.x - b.position.x;
}

function horizontalSorter( a, b ) {
  return a.position.x - b.position.x || a.position.y - b.position.y;
}

Packery.prototype.sortItemsByPosition = function() {
  var sorter = this.options.isHorizontal ? horizontalSorter : verticalSorter;
  this.items.sort( sorter );
};

/**
 * Fit item element in its current position
 * Packery will position elements around it
 * useful for expanding elements
 *
 * @param {Element} elem
 * @param {Number} x - horizontal destination position, optional
 * @param {Number} y - vertical destination position, optional
 */
Packery.prototype.fit = function( elem, x, y ) {
  var item = this.getItem( elem );
  if ( !item ) {
    return;
  }

  // prepare internal properties
  this._getMeasurements();

  // stamp item to get it out of layout
  this.stamp( item.element );
  // required for positionPlaceRect
  item.getSize();
  // set placing flag
  item.isPlacing = true;
  // fall back to current position for fitting
  x = x === undefined ? item.rect.x: x;
  y = y === undefined ? item.rect.y: y;

  // position it best at its destination
  item.positionPlaceRect( x, y, true );

  this._bindFitEvents( item );
  item.moveTo( item.placeRect.x, item.placeRect.y );
  // layout everything else
  this.layout();

  // return back to regularly scheduled programming
  this.unstamp( item.element );
  this.sortItemsByPosition();
  // un set placing flag, back to normal
  item.isPlacing = false;
  // copy place rect position
  item.copyPlaceRectPosition();
};

/**
 * emit event when item is fit and other items are laid out
 * @param {Packery.Item} item
 * @private
 */
Packery.prototype._bindFitEvents = function( item ) {
  var _this = this;
  var ticks = 0;
  function tick() {
    ticks++;
    if ( ticks != 2 ) {
      return;
    }
    _this.dispatchEvent( 'fitComplete', null, [ item ] );
  }
  // when item is laid out
  item.on( 'layout', function() {
    tick();
    return true;
  });
  // when all items are laid out
  this.on( 'layoutComplete', function() {
    tick();
    return true;
  });
};

// -------------------------- resize -------------------------- //

// debounced, layout on resize
Packery.prototype.resize = function() {
  // don't trigger if size did not change
  var size = getSize( this.element );
  // check that this.size and size are there
  // IE8 triggers resize on body size change, so they might not be
  var hasSizes = this.size && size;
  var innerSize = this.options.isHorizontal ? 'innerHeight' : 'innerWidth';
  if ( hasSizes && size[ innerSize ] == this.size[ innerSize ] ) {
    return;
  }

  this.layout();
};

// -------------------------- drag -------------------------- //

/**
 * handle an item drag start event
 * @param {Element} elem
 */
Packery.prototype.itemDragStart = function( elem ) {
  this.stamp( elem );
  var item = this.getItem( elem );
  if ( item ) {
    item.dragStart();
  }
};

/**
 * handle an item drag move event
 * @param {Element} elem
 * @param {Number} x - horizontal change in position
 * @param {Number} y - vertical change in position
 */
Packery.prototype.itemDragMove = function( elem, x, y ) {
  var item = this.getItem( elem );
  if ( item ) {
    item.dragMove( x, y );
  }

  // debounce
  var _this = this;
  // debounce triggering layout
  function delayed() {
    _this.layout();
    delete _this.dragTimeout;
  }

  this.clearDragTimeout();

  this.dragTimeout = setTimeout( delayed, 40 );
};

Packery.prototype.clearDragTimeout = function() {
  if ( this.dragTimeout ) {
    clearTimeout( this.dragTimeout );
  }
};

/**
 * handle an item drag end event
 * @param {Element} elem
 */
Packery.prototype.itemDragEnd = function( elem ) {
  var item = this.getItem( elem );
  var itemDidDrag;
  if ( item ) {
    itemDidDrag = item.didDrag;
    item.dragStop();
  }
  // if elem didn't move, or if it doesn't need positioning
  // unignore and unstamp and call it a day
  if ( !item || ( !itemDidDrag && !item.needsPositioning ) ) {
    this.unstamp( elem );
    return;
  }
  // procced with dragged item

  classie.add( item.element, 'is-positioning-post-drag' );

  // save this var, as it could get reset in dragStart
  var onLayoutComplete = this._getDragEndLayoutComplete( elem, item );

  if ( item.needsPositioning ) {
    item.on( 'layout', onLayoutComplete );
    item.moveTo( item.placeRect.x, item.placeRect.y );
  } else if ( item ) {
    // item didn't need placement
    item.copyPlaceRectPosition();
  }

  this.clearDragTimeout();
  this.on( 'layoutComplete', onLayoutComplete );
  this.layout();

};

/**
 * get drag end callback
 * @param {Element} elem
 * @param {Packery.Item} item
 * @returns {Function} onLayoutComplete
 */
Packery.prototype._getDragEndLayoutComplete = function( elem, item ) {
  var itemNeedsPositioning = item && item.needsPositioning;
  var completeCount = 0;
  var asyncCount = itemNeedsPositioning ? 2 : 1;
  var _this = this;

  return function onLayoutComplete() {
    completeCount++;
    // don't proceed if not complete
    if ( completeCount != asyncCount ) {
      return true;
    }
    // reset item
    if ( item ) {
      classie.remove( item.element, 'is-positioning-post-drag' );
      item.isPlacing = false;
      item.copyPlaceRectPosition();
    }

    _this.unstamp( elem );
    // only sort when item moved
    _this.sortItemsByPosition();

    // emit item drag event now that everything is done
    if ( itemNeedsPositioning ) {
      _this.dispatchEvent( 'dragItemPositioned', null, [ item ] );
    }
    // listen once
    return true;
  };
};

/**
 * binds Draggabilly events
 * @param {Draggabilly} draggie
 */
Packery.prototype.bindDraggabillyEvents = function( draggie ) {
  draggie.on( 'dragStart', this.handleDraggabilly.dragStart );
  draggie.on( 'dragMove', this.handleDraggabilly.dragMove );
  draggie.on( 'dragEnd', this.handleDraggabilly.dragEnd );
};

/**
 * binds jQuery UI Draggable events
 * @param {jQuery} $elems
 */
Packery.prototype.bindUIDraggableEvents = function( $elems ) {
  $elems
    .on( 'dragstart', this.handleUIDraggable.start )
    .on( 'drag', this.handleUIDraggable.drag )
    .on( 'dragstop', this.handleUIDraggable.stop );
};

Packery.Rect = Rect;
Packery.Packer = Packer;

return Packery;

}));


/*!
 * Packery layout mode v1.1.3
 * sub-classes Packery
 * http://packery.metafizzy.co
 */

/*jshint browser: true, strict: true, undef: true, unused: true */

( function( window, factory ) {
  'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( [
        'isotope/js/layout-mode',
        'packery/js/packery',
        'get-size/get-size'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('isotope-layout/js/layout-mode'),
      require('packery'),
      require('get-size')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode,
      window.Packery,
      window.getSize
    );
  }

}( window, function factor( LayoutMode, Packery, getSize ) {
'use strict';

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var PackeryMode = LayoutMode.create('packery');

  // save on to these methods
  var _getElementOffset = PackeryMode.prototype._getElementOffset;
  // var layout = PackeryMode.prototype.layout;
  var _getMeasurement = PackeryMode.prototype._getMeasurement;

  // sub-class Masonry
  extend( PackeryMode.prototype, Packery.prototype );

  // set back, as it was overwritten by Packery
  PackeryMode.prototype._getElementOffset = _getElementOffset;
  // PackeryMode.prototype.layout = layout;
  PackeryMode.prototype._getMeasurement = _getMeasurement;

  // set packery in _resetLayout
  var _resetLayout = PackeryMode.prototype._resetLayout;
  PackeryMode.prototype._resetLayout = function() {
    this.packer = this.packer || new Packery.Packer();
    _resetLayout.apply( this, arguments );
  };

  var _getItemLayoutPosition = PackeryMode.prototype._getItemLayoutPosition;
  PackeryMode.prototype._getItemLayoutPosition = function( item ) {
    // set packery rect
    item.rect = item.rect || new Packery.Rect();
    return _getItemLayoutPosition.call( this, item );
  };

  // HACK copy over isOriginLeft/Top options
  var _manageStamp = PackeryMode.prototype._manageStamp;
  PackeryMode.prototype._manageStamp = function() {
    this.options.isOriginLeft = this.isotope.options.isOriginLeft;
    this.options.isOriginTop = this.isotope.options.isOriginTop;
    _manageStamp.apply( this, arguments );
  };

  PackeryMode.prototype.needsResizeLayout = function() {
    // don't trigger if size did not change
    var size = getSize( this.element );
    // check that this.size and size are there
    // IE8 triggers resize on body size change, so they might not be
    var hasSizes = this.size && size;
    var innerSize = this.options.isHorizontal ? 'innerHeight' : 'innerWidth';
    return hasSizes && size[ innerSize ] != this.size[ innerSize ];
  };

  return PackeryMode;
}));

/**
 * EvEmitter v1.0.3
 * Lil' event emitter
 * MIT License
 */

/* jshint unused: true, undef: true, strict: true */

( function( global, factory ) {
  // universal module definition
  /* jshint strict: false */ /* globals define, module, window */
  if ( typeof define == 'function' && define.amd ) {
    // AMD - RequireJS
    define( factory );
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS - Browserify, Webpack
    module.exports = factory();
  } else {
    // Browser globals
    global.EvEmitter = factory();
  }

}( typeof window != 'undefined' ? window : this, function() {

"use strict";

function EvEmitter() {}

var proto = EvEmitter.prototype;

proto.on = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // set events hash
  var events = this._events = this._events || {};
  // set listeners array
  var listeners = events[ eventName ] = events[ eventName ] || [];
  // only add once
  if ( listeners.indexOf( listener ) == -1 ) {
    listeners.push( listener );
  }

  return this;
};

proto.once = function( eventName, listener ) {
  if ( !eventName || !listener ) {
    return;
  }
  // add event
  this.on( eventName, listener );
  // set once flag
  // set onceEvents hash
  var onceEvents = this._onceEvents = this._onceEvents || {};
  // set onceListeners object
  var onceListeners = onceEvents[ eventName ] = onceEvents[ eventName ] || {};
  // set flag
  onceListeners[ listener ] = true;

  return this;
};

proto.off = function( eventName, listener ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  var index = listeners.indexOf( listener );
  if ( index != -1 ) {
    listeners.splice( index, 1 );
  }

  return this;
};

proto.emitEvent = function( eventName, args ) {
  var listeners = this._events && this._events[ eventName ];
  if ( !listeners || !listeners.length ) {
    return;
  }
  var i = 0;
  var listener = listeners[i];
  args = args || [];
  // once stuff
  var onceListeners = this._onceEvents && this._onceEvents[ eventName ];

  while ( listener ) {
    var isOnce = onceListeners && onceListeners[ listener ];
    if ( isOnce ) {
      // remove listener
      // remove before trigger to prevent recursion
      this.off( eventName, listener );
      // unset once flag
      delete onceListeners[ listener ];
    }
    // trigger listener
    listener.apply( this, args );
    // get next listener
    i += isOnce ? 0 : 1;
    listener = listeners[i];
  }

  return this;
};

return EvEmitter;

}));

/*!
 * imagesLoaded v4.1.1
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

( function( window, factory ) { 'use strict';
  // universal module definition

  /*global define: false, module: false, require: false */

  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( [
      'ev-emitter/ev-emitter'
    ], function( EvEmitter ) {
      return factory( window, EvEmitter );
    });
  } else if ( typeof module == 'object' && module.exports ) {
    // CommonJS
    module.exports = factory(
      window,
      require('ev-emitter')
    );
  } else {
    // browser global
    window.imagesLoaded = factory(
      window,
      window.EvEmitter
    );
  }

})( window,

// --------------------------  factory -------------------------- //

function factory( window, EvEmitter ) {

'use strict';

var $ = window.jQuery;
var console = window.console;

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

// turn element or nodeList into an array
function makeArray( obj ) {
  var ary = [];
  if ( Array.isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( typeof obj.length == 'number' ) {
    // convert nodeList to array
    for ( var i=0; i < obj.length; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
}

// -------------------------- imagesLoaded -------------------------- //

/**
 * @param {Array, Element, NodeList, String} elem
 * @param {Object or Function} options - if function, use as callback
 * @param {Function} onAlways - callback function
 */
function ImagesLoaded( elem, options, onAlways ) {
  // coerce ImagesLoaded() without new, to be new ImagesLoaded()
  if ( !( this instanceof ImagesLoaded ) ) {
    return new ImagesLoaded( elem, options, onAlways );
  }
  // use elem as selector string
  if ( typeof elem == 'string' ) {
    elem = document.querySelectorAll( elem );
  }

  this.elements = makeArray( elem );
  this.options = extend( {}, this.options );

  if ( typeof options == 'function' ) {
    onAlways = options;
  } else {
    extend( this.options, options );
  }

  if ( onAlways ) {
    this.on( 'always', onAlways );
  }

  this.getImages();

  if ( $ ) {
    // add jQuery Deferred object
    this.jqDeferred = new $.Deferred();
  }

  // HACK check async to allow time to bind listeners
  setTimeout( function() {
    this.check();
  }.bind( this ));
}

ImagesLoaded.prototype = Object.create( EvEmitter.prototype );

ImagesLoaded.prototype.options = {};

ImagesLoaded.prototype.getImages = function() {
  this.images = [];

  // filter & find items if we have an item selector
  this.elements.forEach( this.addElementImages, this );
};

/**
 * @param {Node} element
 */
ImagesLoaded.prototype.addElementImages = function( elem ) {
  // filter siblings
  if ( elem.nodeName == 'IMG' ) {
    this.addImage( elem );
  }
  // get background image on element
  if ( this.options.background === true ) {
    this.addElementBackgroundImages( elem );
  }

  // find children
  // no non-element nodes, #143
  var nodeType = elem.nodeType;
  if ( !nodeType || !elementNodeTypes[ nodeType ] ) {
    return;
  }
  var childImgs = elem.querySelectorAll('img');
  // concat childElems to filterFound array
  for ( var i=0; i < childImgs.length; i++ ) {
    var img = childImgs[i];
    this.addImage( img );
  }

  // get child background images
  if ( typeof this.options.background == 'string' ) {
    var children = elem.querySelectorAll( this.options.background );
    for ( i=0; i < children.length; i++ ) {
      var child = children[i];
      this.addElementBackgroundImages( child );
    }
  }
};

var elementNodeTypes = {
  1: true,
  9: true,
  11: true
};

ImagesLoaded.prototype.addElementBackgroundImages = function( elem ) {
  var style = getComputedStyle( elem );
  if ( !style ) {
    // Firefox returns null if in a hidden iframe https://bugzil.la/548397
    return;
  }
  // get url inside url("...")
  var reURL = /url\((['"])?(.*?)\1\)/gi;
  var matches = reURL.exec( style.backgroundImage );
  while ( matches !== null ) {
    var url = matches && matches[2];
    if ( url ) {
      this.addBackground( url, elem );
    }
    matches = reURL.exec( style.backgroundImage );
  }
};

/**
 * @param {Image} img
 */
ImagesLoaded.prototype.addImage = function( img ) {
  var loadingImage = new LoadingImage( img );
  this.images.push( loadingImage );
};

ImagesLoaded.prototype.addBackground = function( url, elem ) {
  var background = new Background( url, elem );
  this.images.push( background );
};

ImagesLoaded.prototype.check = function() {
  var _this = this;
  this.progressedCount = 0;
  this.hasAnyBroken = false;
  // complete if no images
  if ( !this.images.length ) {
    this.complete();
    return;
  }

  function onProgress( image, elem, message ) {
    // HACK - Chrome triggers event before object properties have changed. #83
    setTimeout( function() {
      _this.progress( image, elem, message );
    });
  }

  this.images.forEach( function( loadingImage ) {
    loadingImage.once( 'progress', onProgress );
    loadingImage.check();
  });
};

ImagesLoaded.prototype.progress = function( image, elem, message ) {
  this.progressedCount++;
  this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
  // progress event
  this.emitEvent( 'progress', [ this, image, elem ] );
  if ( this.jqDeferred && this.jqDeferred.notify ) {
    this.jqDeferred.notify( this, image );
  }
  // check if completed
  if ( this.progressedCount == this.images.length ) {
    this.complete();
  }

  if ( this.options.debug && console ) {
    console.log( 'progress: ' + message, image, elem );
  }
};

ImagesLoaded.prototype.complete = function() {
  var eventName = this.hasAnyBroken ? 'fail' : 'done';
  this.isComplete = true;
  this.emitEvent( eventName, [ this ] );
  this.emitEvent( 'always', [ this ] );
  if ( this.jqDeferred ) {
    var jqMethod = this.hasAnyBroken ? 'reject' : 'resolve';
    this.jqDeferred[ jqMethod ]( this );
  }
};

// --------------------------  -------------------------- //

function LoadingImage( img ) {
  this.img = img;
}

LoadingImage.prototype = Object.create( EvEmitter.prototype );

LoadingImage.prototype.check = function() {
  // If complete is true and browser supports natural sizes,
  // try to check for image status manually.
  var isComplete = this.getIsImageComplete();
  if ( isComplete ) {
    // report based on naturalWidth
    this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
    return;
  }

  // If none of the checks above matched, simulate loading on detached element.
  this.proxyImage = new Image();
  this.proxyImage.addEventListener( 'load', this );
  this.proxyImage.addEventListener( 'error', this );
  // bind to image as well for Firefox. #191
  this.img.addEventListener( 'load', this );
  this.img.addEventListener( 'error', this );
  this.proxyImage.src = this.img.src;
};

LoadingImage.prototype.getIsImageComplete = function() {
  return this.img.complete && this.img.naturalWidth !== undefined;
};

LoadingImage.prototype.confirm = function( isLoaded, message ) {
  this.isLoaded = isLoaded;
  this.emitEvent( 'progress', [ this, this.img, message ] );
};

// ----- events ----- //

// trigger specified handler for event type
LoadingImage.prototype.handleEvent = function( event ) {
  var method = 'on' + event.type;
  if ( this[ method ] ) {
    this[ method ]( event );
  }
};

LoadingImage.prototype.onload = function() {
  this.confirm( true, 'onload' );
  this.unbindEvents();
};

LoadingImage.prototype.onerror = function() {
  this.confirm( false, 'onerror' );
  this.unbindEvents();
};

LoadingImage.prototype.unbindEvents = function() {
  this.proxyImage.removeEventListener( 'load', this );
  this.proxyImage.removeEventListener( 'error', this );
  this.img.removeEventListener( 'load', this );
  this.img.removeEventListener( 'error', this );
};

// -------------------------- Background -------------------------- //

function Background( url, element ) {
  this.url = url;
  this.element = element;
  this.img = new Image();
}

// inherit LoadingImage prototype
Background.prototype = Object.create( LoadingImage.prototype );

Background.prototype.check = function() {
  this.img.addEventListener( 'load', this );
  this.img.addEventListener( 'error', this );
  this.img.src = this.url;
  // check if image is already complete
  var isComplete = this.getIsImageComplete();
  if ( isComplete ) {
    this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
    this.unbindEvents();
  }
};

Background.prototype.unbindEvents = function() {
  this.img.removeEventListener( 'load', this );
  this.img.removeEventListener( 'error', this );
};

Background.prototype.confirm = function( isLoaded, message ) {
  this.isLoaded = isLoaded;
  this.emitEvent( 'progress', [ this, this.element, message ] );
};

// -------------------------- jQuery -------------------------- //

ImagesLoaded.makeJQueryPlugin = function( jQuery ) {
  jQuery = jQuery || window.jQuery;
  if ( !jQuery ) {
    return;
  }
  // set local variable
  $ = jQuery;
  // $().imagesLoaded()
  $.fn.imagesLoaded = function( options, callback ) {
    var instance = new ImagesLoaded( this, options, callback );
    return instance.jqDeferred.promise( $(this) );
  };
};
// try making plugin
ImagesLoaded.makeJQueryPlugin();

// --------------------------  -------------------------- //

return ImagesLoaded;

});

/*!
 * JavaScript Cookie v2.1.3
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
;(function (factory) {
	var registeredInModuleLoader = false;
	if (typeof define === 'function' && define.amd) {
		define(factory);
		registeredInModuleLoader = true;
	}
	if (typeof exports === 'object') {
		module.exports = factory();
		registeredInModuleLoader = true;
	}
	if (!registeredInModuleLoader) {
		var OldCookies = window.Cookies;
		var api = window.Cookies = factory();
		api.noConflict = function () {
			window.Cookies = OldCookies;
			return api;
		};
	}
}(function () {
	function extend () {
		var i = 0;
		var result = {};
		for (; i < arguments.length; i++) {
			var attributes = arguments[ i ];
			for (var key in attributes) {
				result[key] = attributes[key];
			}
		}
		return result;
	}

	function init (converter) {
		function api (key, value, attributes) {
			var result;
			if (typeof document === 'undefined') {
				return;
			}

			// Write

			if (arguments.length > 1) {
				attributes = extend({
					path: '/'
				}, api.defaults, attributes);

				if (typeof attributes.expires === 'number') {
					var expires = new Date();
					expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
					attributes.expires = expires;
				}

				try {
					result = JSON.stringify(value);
					if (/^[\{\[]/.test(result)) {
						value = result;
					}
				} catch (e) {}

				if (!converter.write) {
					value = encodeURIComponent(String(value))
						.replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
				} else {
					value = converter.write(value, key);
				}

				key = encodeURIComponent(String(key));
				key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
				key = key.replace(/[\(\)]/g, escape);

				return (document.cookie = [
					key, '=', value,
					attributes.expires ? '; expires=' + attributes.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
					attributes.path ? '; path=' + attributes.path : '',
					attributes.domain ? '; domain=' + attributes.domain : '',
					attributes.secure ? '; secure' : ''
				].join(''));
			}

			// Read

			if (!key) {
				result = {};
			}

			// To prevent the for loop in the first place assign an empty array
			// in case there are no cookies at all. Also prevents odd result when
			// calling "get()"
			var cookies = document.cookie ? document.cookie.split('; ') : [];
			var rdecode = /(%[0-9A-Z]{2})+/g;
			var i = 0;

			for (; i < cookies.length; i++) {
				var parts = cookies[i].split('=');
				var cookie = parts.slice(1).join('=');

				if (cookie.charAt(0) === '"') {
					cookie = cookie.slice(1, -1);
				}

				try {
					var name = parts[0].replace(rdecode, decodeURIComponent);
					cookie = converter.read ?
						converter.read(cookie, name) : converter(cookie, name) ||
						cookie.replace(rdecode, decodeURIComponent);

					if (this.json) {
						try {
							cookie = JSON.parse(cookie);
						} catch (e) {}
					}

					if (key === name) {
						result = cookie;
						break;
					}

					if (!key) {
						result[name] = cookie;
					}
				} catch (e) {}
			}

			return result;
		}

		api.set = api;
		api.get = function (key) {
			return api.call(api, key);
		};
		api.getJSON = function () {
			return api.apply({
				json: true
			}, [].slice.call(arguments));
		};
		api.defaults = {};

		api.remove = function (key, attributes) {
			api(key, '', extend(attributes, {
				expires: -1
			}));
		};

		api.withConverter = init;

		return api;
	}

	return init(function () {});
}));

/*! nouislider - 8.5.1 - 2016-04-24 16:00:29 */

(function (factory) {

    if ( typeof define === 'function' && define.amd ) {

        // AMD. Register as an anonymous module.
        define([], factory);

    } else if ( typeof exports === 'object' ) {

        // Node/CommonJS
        module.exports = factory();

    } else {

        // Browser globals
        window.noUiSlider = factory();
    }

}(function( ){

	'use strict';


	// Removes duplicates from an array.
	function unique(array) {
		return array.filter(function(a){
			return !this[a] ? this[a] = true : false;
		}, {});
	}

	// Round a value to the closest 'to'.
	function closest ( value, to ) {
		return Math.round(value / to) * to;
	}

	// Current position of an element relative to the document.
	function offset ( elem ) {

	var rect = elem.getBoundingClientRect(),
		doc = elem.ownerDocument,
		docElem = doc.documentElement,
		pageOffset = getPageOffset();

		// getBoundingClientRect contains left scroll in Chrome on Android.
		// I haven't found a feature detection that proves this. Worst case
		// scenario on mis-match: the 'tap' feature on horizontal sliders breaks.
		if ( /webkit.*Chrome.*Mobile/i.test(navigator.userAgent) ) {
			pageOffset.x = 0;
		}

		return {
			top: rect.top + pageOffset.y - docElem.clientTop,
			left: rect.left + pageOffset.x - docElem.clientLeft
		};
	}

	// Checks whether a value is numerical.
	function isNumeric ( a ) {
		return typeof a === 'number' && !isNaN( a ) && isFinite( a );
	}

	// Sets a class and removes it after [duration] ms.
	function addClassFor ( element, className, duration ) {
		addClass(element, className);
		setTimeout(function(){
			removeClass(element, className);
		}, duration);
	}

	// Limits a value to 0 - 100
	function limit ( a ) {
		return Math.max(Math.min(a, 100), 0);
	}

	// Wraps a variable as an array, if it isn't one yet.
	function asArray ( a ) {
		return Array.isArray(a) ? a : [a];
	}

	// Counts decimals
	function countDecimals ( numStr ) {
		var pieces = numStr.split(".");
		return pieces.length > 1 ? pieces[1].length : 0;
	}

	// http://youmightnotneedjquery.com/#add_class
	function addClass ( el, className ) {
		if ( el.classList ) {
			el.classList.add(className);
		} else {
			el.className += ' ' + className;
		}
	}

	// http://youmightnotneedjquery.com/#remove_class
	function removeClass ( el, className ) {
		if ( el.classList ) {
			el.classList.remove(className);
		} else {
			el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
		}
	}

	// https://plainjs.com/javascript/attributes/adding-removing-and-testing-for-classes-9/
	function hasClass ( el, className ) {
		return el.classList ? el.classList.contains(className) : new RegExp('\\b' + className + '\\b').test(el.className);
	}

	// https://developer.mozilla.org/en-US/docs/Web/API/Window/scrollY#Notes
	function getPageOffset ( ) {

		var supportPageOffset = window.pageXOffset !== undefined,
			isCSS1Compat = ((document.compatMode || "") === "CSS1Compat"),
			x = supportPageOffset ? window.pageXOffset : isCSS1Compat ? document.documentElement.scrollLeft : document.body.scrollLeft,
			y = supportPageOffset ? window.pageYOffset : isCSS1Compat ? document.documentElement.scrollTop : document.body.scrollTop;

		return {
			x: x,
			y: y
		};
	}

	// we provide a function to compute constants instead
	// of accessing window.* as soon as the module needs it
	// so that we do not compute anything if not needed
	function getActions ( ) {

		// Determine the events to bind. IE11 implements pointerEvents without
		// a prefix, which breaks compatibility with the IE10 implementation.
		return window.navigator.pointerEnabled ? {
			start: 'pointerdown',
			move: 'pointermove',
			end: 'pointerup'
		} : window.navigator.msPointerEnabled ? {
			start: 'MSPointerDown',
			move: 'MSPointerMove',
			end: 'MSPointerUp'
		} : {
			start: 'mousedown touchstart',
			move: 'mousemove touchmove',
			end: 'mouseup touchend'
		};
	}


// Value calculation

	// Determine the size of a sub-range in relation to a full range.
	function subRangeRatio ( pa, pb ) {
		return (100 / (pb - pa));
	}

	// (percentage) How many percent is this value of this range?
	function fromPercentage ( range, value ) {
		return (value * 100) / ( range[1] - range[0] );
	}

	// (percentage) Where is this value on this range?
	function toPercentage ( range, value ) {
		return fromPercentage( range, range[0] < 0 ?
			value + Math.abs(range[0]) :
				value - range[0] );
	}

	// (value) How much is this percentage on this range?
	function isPercentage ( range, value ) {
		return ((value * ( range[1] - range[0] )) / 100) + range[0];
	}


// Range conversion

	function getJ ( value, arr ) {

		var j = 1;

		while ( value >= arr[j] ){
			j += 1;
		}

		return j;
	}

	// (percentage) Input a value, find where, on a scale of 0-100, it applies.
	function toStepping ( xVal, xPct, value ) {

		if ( value >= xVal.slice(-1)[0] ){
			return 100;
		}

		var j = getJ( value, xVal ), va, vb, pa, pb;

		va = xVal[j-1];
		vb = xVal[j];
		pa = xPct[j-1];
		pb = xPct[j];

		return pa + (toPercentage([va, vb], value) / subRangeRatio (pa, pb));
	}

	// (value) Input a percentage, find where it is on the specified range.
	function fromStepping ( xVal, xPct, value ) {

		// There is no range group that fits 100
		if ( value >= 100 ){
			return xVal.slice(-1)[0];
		}

		var j = getJ( value, xPct ), va, vb, pa, pb;

		va = xVal[j-1];
		vb = xVal[j];
		pa = xPct[j-1];
		pb = xPct[j];

		return isPercentage([va, vb], (value - pa) * subRangeRatio (pa, pb));
	}

	// (percentage) Get the step that applies at a certain value.
	function getStep ( xPct, xSteps, snap, value ) {

		if ( value === 100 ) {
			return value;
		}

		var j = getJ( value, xPct ), a, b;

		// If 'snap' is set, steps are used as fixed points on the slider.
		if ( snap ) {

			a = xPct[j-1];
			b = xPct[j];

			// Find the closest position, a or b.
			if ((value - a) > ((b-a)/2)){
				return b;
			}

			return a;
		}

		if ( !xSteps[j-1] ){
			return value;
		}

		return xPct[j-1] + closest(
			value - xPct[j-1],
			xSteps[j-1]
		);
	}


// Entry parsing

	function handleEntryPoint ( index, value, that ) {

		var percentage;

		// Wrap numerical input in an array.
		if ( typeof value === "number" ) {
			value = [value];
		}

		// Reject any invalid input, by testing whether value is an array.
		if ( Object.prototype.toString.call( value ) !== '[object Array]' ){
			throw new Error("noUiSlider: 'range' contains invalid value.");
		}

		// Covert min/max syntax to 0 and 100.
		if ( index === 'min' ) {
			percentage = 0;
		} else if ( index === 'max' ) {
			percentage = 100;
		} else {
			percentage = parseFloat( index );
		}

		// Check for correct input.
		if ( !isNumeric( percentage ) || !isNumeric( value[0] ) ) {
			throw new Error("noUiSlider: 'range' value isn't numeric.");
		}

		// Store values.
		that.xPct.push( percentage );
		that.xVal.push( value[0] );

		// NaN will evaluate to false too, but to keep
		// logging clear, set step explicitly. Make sure
		// not to override the 'step' setting with false.
		if ( !percentage ) {
			if ( !isNaN( value[1] ) ) {
				that.xSteps[0] = value[1];
			}
		} else {
			that.xSteps.push( isNaN(value[1]) ? false : value[1] );
		}
	}

	function handleStepPoint ( i, n, that ) {

		// Ignore 'false' stepping.
		if ( !n ) {
			return true;
		}

		// Factor to range ratio
		that.xSteps[i] = fromPercentage([
			 that.xVal[i]
			,that.xVal[i+1]
		], n) / subRangeRatio (
			that.xPct[i],
			that.xPct[i+1] );
	}


// Interface

	// The interface to Spectrum handles all direction-based
	// conversions, so the above values are unaware.

	function Spectrum ( entry, snap, direction, singleStep ) {

		this.xPct = [];
		this.xVal = [];
		this.xSteps = [ singleStep || false ];
		this.xNumSteps = [ false ];

		this.snap = snap;
		this.direction = direction;

		var index, ordered = [ /* [0, 'min'], [1, '50%'], [2, 'max'] */ ];

		// Map the object keys to an array.
		for ( index in entry ) {
			if ( entry.hasOwnProperty(index) ) {
				ordered.push([entry[index], index]);
			}
		}

		// Sort all entries by value (numeric sort).
		if ( ordered.length && typeof ordered[0][0] === "object" ) {
			ordered.sort(function(a, b) { return a[0][0] - b[0][0]; });
		} else {
			ordered.sort(function(a, b) { return a[0] - b[0]; });
		}


		// Convert all entries to subranges.
		for ( index = 0; index < ordered.length; index++ ) {
			handleEntryPoint(ordered[index][1], ordered[index][0], this);
		}

		// Store the actual step values.
		// xSteps is sorted in the same order as xPct and xVal.
		this.xNumSteps = this.xSteps.slice(0);

		// Convert all numeric steps to the percentage of the subrange they represent.
		for ( index = 0; index < this.xNumSteps.length; index++ ) {
			handleStepPoint(index, this.xNumSteps[index], this);
		}
	}

	Spectrum.prototype.getMargin = function ( value ) {
		return this.xPct.length === 2 ? fromPercentage(this.xVal, value) : false;
	};

	Spectrum.prototype.toStepping = function ( value ) {

		value = toStepping( this.xVal, this.xPct, value );

		// Invert the value if this is a right-to-left slider.
		if ( this.direction ) {
			value = 100 - value;
		}

		return value;
	};

	Spectrum.prototype.fromStepping = function ( value ) {

		// Invert the value if this is a right-to-left slider.
		if ( this.direction ) {
			value = 100 - value;
		}

		return fromStepping( this.xVal, this.xPct, value );
	};

	Spectrum.prototype.getStep = function ( value ) {

		// Find the proper step for rtl sliders by search in inverse direction.
		// Fixes issue #262.
		if ( this.direction ) {
			value = 100 - value;
		}

		value = getStep(this.xPct, this.xSteps, this.snap, value );

		if ( this.direction ) {
			value = 100 - value;
		}

		return value;
	};

	Spectrum.prototype.getApplicableStep = function ( value ) {

		// If the value is 100%, return the negative step twice.
		var j = getJ(value, this.xPct), offset = value === 100 ? 2 : 1;
		return [this.xNumSteps[j-2], this.xVal[j-offset], this.xNumSteps[j-offset]];
	};

	// Outside testing
	Spectrum.prototype.convert = function ( value ) {
		return this.getStep(this.toStepping(value));
	};

/*	Every input option is tested and parsed. This'll prevent
	endless validation in internal methods. These tests are
	structured with an item for every option available. An
	option can be marked as required by setting the 'r' flag.
	The testing function is provided with three arguments:
		- The provided value for the option;
		- A reference to the options object;
		- The name for the option;

	The testing function returns false when an error is detected,
	or true when everything is OK. It can also modify the option
	object, to make sure all values can be correctly looped elsewhere. */

	var defaultFormatter = { 'to': function( value ){
		return value !== undefined && value.toFixed(2);
	}, 'from': Number };

	function testStep ( parsed, entry ) {

		if ( !isNumeric( entry ) ) {
			throw new Error("noUiSlider: 'step' is not numeric.");
		}

		// The step option can still be used to set stepping
		// for linear sliders. Overwritten if set in 'range'.
		parsed.singleStep = entry;
	}

	function testRange ( parsed, entry ) {

		// Filter incorrect input.
		if ( typeof entry !== 'object' || Array.isArray(entry) ) {
			throw new Error("noUiSlider: 'range' is not an object.");
		}

		// Catch missing start or end.
		if ( entry.min === undefined || entry.max === undefined ) {
			throw new Error("noUiSlider: Missing 'min' or 'max' in 'range'.");
		}

		// Catch equal start or end.
		if ( entry.min === entry.max ) {
			throw new Error("noUiSlider: 'range' 'min' and 'max' cannot be equal.");
		}

		parsed.spectrum = new Spectrum(entry, parsed.snap, parsed.dir, parsed.singleStep);
	}

	function testStart ( parsed, entry ) {

		entry = asArray(entry);

		// Validate input. Values aren't tested, as the public .val method
		// will always provide a valid location.
		if ( !Array.isArray( entry ) || !entry.length || entry.length > 2 ) {
			throw new Error("noUiSlider: 'start' option is incorrect.");
		}

		// Store the number of handles.
		parsed.handles = entry.length;

		// When the slider is initialized, the .val method will
		// be called with the start options.
		parsed.start = entry;
	}

	function testSnap ( parsed, entry ) {

		// Enforce 100% stepping within subranges.
		parsed.snap = entry;

		if ( typeof entry !== 'boolean' ){
			throw new Error("noUiSlider: 'snap' option must be a boolean.");
		}
	}

	function testAnimate ( parsed, entry ) {

		// Enforce 100% stepping within subranges.
		parsed.animate = entry;

		if ( typeof entry !== 'boolean' ){
			throw new Error("noUiSlider: 'animate' option must be a boolean.");
		}
	}

	function testAnimationDuration ( parsed, entry ) {

		parsed.animationDuration = entry;

		if ( typeof entry !== 'number' ){
			throw new Error("noUiSlider: 'animationDuration' option must be a number.");
		}
	}

	function testConnect ( parsed, entry ) {

		if ( entry === 'lower' && parsed.handles === 1 ) {
			parsed.connect = 1;
		} else if ( entry === 'upper' && parsed.handles === 1 ) {
			parsed.connect = 2;
		} else if ( entry === true && parsed.handles === 2 ) {
			parsed.connect = 3;
		} else if ( entry === false ) {
			parsed.connect = 0;
		} else {
			throw new Error("noUiSlider: 'connect' option doesn't match handle count.");
		}
	}

	function testOrientation ( parsed, entry ) {

		// Set orientation to an a numerical value for easy
		// array selection.
		switch ( entry ){
		  case 'horizontal':
			parsed.ort = 0;
			break;
		  case 'vertical':
			parsed.ort = 1;
			break;
		  default:
			throw new Error("noUiSlider: 'orientation' option is invalid.");
		}
	}

	function testMargin ( parsed, entry ) {

		if ( !isNumeric(entry) ){
			throw new Error("noUiSlider: 'margin' option must be numeric.");
		}

		// Issue #582
		if ( entry === 0 ) {
			return;
		}

		parsed.margin = parsed.spectrum.getMargin(entry);

		if ( !parsed.margin ) {
			throw new Error("noUiSlider: 'margin' option is only supported on linear sliders.");
		}
	}

	function testLimit ( parsed, entry ) {

		if ( !isNumeric(entry) ){
			throw new Error("noUiSlider: 'limit' option must be numeric.");
		}

		parsed.limit = parsed.spectrum.getMargin(entry);

		if ( !parsed.limit ) {
			throw new Error("noUiSlider: 'limit' option is only supported on linear sliders.");
		}
	}

	function testDirection ( parsed, entry ) {

		// Set direction as a numerical value for easy parsing.
		// Invert connection for RTL sliders, so that the proper
		// handles get the connect/background classes.
		switch ( entry ) {
		  case 'ltr':
			parsed.dir = 0;
			break;
		  case 'rtl':
			parsed.dir = 1;
			parsed.connect = [0,2,1,3][parsed.connect];
			break;
		  default:
			throw new Error("noUiSlider: 'direction' option was not recognized.");
		}
	}

	function testBehaviour ( parsed, entry ) {

		// Make sure the input is a string.
		if ( typeof entry !== 'string' ) {
			throw new Error("noUiSlider: 'behaviour' must be a string containing options.");
		}

		// Check if the string contains any keywords.
		// None are required.
		var tap = entry.indexOf('tap') >= 0,
			drag = entry.indexOf('drag') >= 0,
			fixed = entry.indexOf('fixed') >= 0,
			snap = entry.indexOf('snap') >= 0,
			hover = entry.indexOf('hover') >= 0;

		// Fix #472
		if ( drag && !parsed.connect ) {
			throw new Error("noUiSlider: 'drag' behaviour must be used with 'connect': true.");
		}

		parsed.events = {
			tap: tap || snap,
			drag: drag,
			fixed: fixed,
			snap: snap,
			hover: hover
		};
	}

	function testTooltips ( parsed, entry ) {

		var i;

		if ( entry === false ) {
			return;
		} else if ( entry === true ) {

			parsed.tooltips = [];

			for ( i = 0; i < parsed.handles; i++ ) {
				parsed.tooltips.push(true);
			}

		} else {

			parsed.tooltips = asArray(entry);

			if ( parsed.tooltips.length !== parsed.handles ) {
				throw new Error("noUiSlider: must pass a formatter for all handles.");
			}

			parsed.tooltips.forEach(function(formatter){
				if ( typeof formatter !== 'boolean' && (typeof formatter !== 'object' || typeof formatter.to !== 'function') ) {
					throw new Error("noUiSlider: 'tooltips' must be passed a formatter or 'false'.");
				}
			});
		}
	}

	function testFormat ( parsed, entry ) {

		parsed.format = entry;

		// Any object with a to and from method is supported.
		if ( typeof entry.to === 'function' && typeof entry.from === 'function' ) {
			return true;
		}

		throw new Error("noUiSlider: 'format' requires 'to' and 'from' methods.");
	}

	function testCssPrefix ( parsed, entry ) {

		if ( entry !== undefined && typeof entry !== 'string' && entry !== false ) {
			throw new Error("noUiSlider: 'cssPrefix' must be a string or `false`.");
		}

		parsed.cssPrefix = entry;
	}

	function testCssClasses ( parsed, entry ) {

		if ( entry !== undefined && typeof entry !== 'object' ) {
			throw new Error("noUiSlider: 'cssClasses' must be an object.");
		}

		if ( typeof parsed.cssPrefix === 'string' ) {
			parsed.cssClasses = {};

			for ( var key in entry ) {
				if ( !entry.hasOwnProperty(key) ) { continue; }

				parsed.cssClasses[key] = parsed.cssPrefix + entry[key];
			}
		} else {
			parsed.cssClasses = entry;
		}
	}

	// Test all developer settings and parse to assumption-safe values.
	function testOptions ( options ) {

		// To prove a fix for #537, freeze options here.
		// If the object is modified, an error will be thrown.
		// Object.freeze(options);

		var parsed = {
			margin: 0,
			limit: 0,
			animate: true,
			animationDuration: 300,
			format: defaultFormatter
		}, tests;

		// Tests are executed in the order they are presented here.
		tests = {
			'step': { r: false, t: testStep },
			'start': { r: true, t: testStart },
			'connect': { r: true, t: testConnect },
			'direction': { r: true, t: testDirection },
			'snap': { r: false, t: testSnap },
			'animate': { r: false, t: testAnimate },
			'animationDuration': { r: false, t: testAnimationDuration },
			'range': { r: true, t: testRange },
			'orientation': { r: false, t: testOrientation },
			'margin': { r: false, t: testMargin },
			'limit': { r: false, t: testLimit },
			'behaviour': { r: true, t: testBehaviour },
			'format': { r: false, t: testFormat },
			'tooltips': { r: false, t: testTooltips },
			'cssPrefix': { r: false, t: testCssPrefix },
			'cssClasses': { r: false, t: testCssClasses }
		};

		var defaults = {
			'connect': false,
			'direction': 'ltr',
			'behaviour': 'tap',
			'orientation': 'horizontal',
			'cssPrefix' : 'noUi-',
			'cssClasses': {
				target: 'target',
				base: 'base',
				origin: 'origin',
				handle: 'handle',
				handleLower: 'handle-lower',
				handleUpper: 'handle-upper',
				horizontal: 'horizontal',
				vertical: 'vertical',
				background: 'background',
				connect: 'connect',
				ltr: 'ltr',
				rtl: 'rtl',
				draggable: 'draggable',
				drag: 'state-drag',
				tap: 'state-tap',
				active: 'active',
				stacking: 'stacking',
				tooltip: 'tooltip',
				pips: 'pips',
				pipsHorizontal: 'pips-horizontal',
				pipsVertical: 'pips-vertical',
				marker: 'marker',
				markerHorizontal: 'marker-horizontal',
				markerVertical: 'marker-vertical',
				markerNormal: 'marker-normal',
				markerLarge: 'marker-large',
				markerSub: 'marker-sub',
				value: 'value',
				valueHorizontal: 'value-horizontal',
				valueVertical: 'value-vertical',
				valueNormal: 'value-normal',
				valueLarge: 'value-large',
				valueSub: 'value-sub'
			}
		};

		// Run all options through a testing mechanism to ensure correct
		// input. It should be noted that options might get modified to
		// be handled properly. E.g. wrapping integers in arrays.
		Object.keys(tests).forEach(function( name ){

			// If the option isn't set, but it is required, throw an error.
			if ( options[name] === undefined && defaults[name] === undefined ) {

				if ( tests[name].r ) {
					throw new Error("noUiSlider: '" + name + "' is required.");
				}

				return true;
			}

			tests[name].t( parsed, options[name] === undefined ? defaults[name] : options[name] );
		});

		// Forward pips options
		parsed.pips = options.pips;

		// Pre-define the styles.
		parsed.style = parsed.ort ? 'top' : 'left';

		return parsed;
	}


function closure ( target, options, originalOptions ){
	var
		actions = getActions( ),
		// All variables local to 'closure' are prefixed with 'scope_'
		scope_Target = target,
		scope_Locations = [-1, -1],
		scope_Base,
		scope_Handles,
		scope_Spectrum = options.spectrum,
		scope_Values = [],
		scope_Events = {},
		scope_Self;


	// Delimit proposed values for handle positions.
	function getPositions ( a, b, delimit ) {

		// Add movement to current position.
		var c = a + b[0], d = a + b[1];

		// Only alter the other position on drag,
		// not on standard sliding.
		if ( delimit ) {
			if ( c < 0 ) {
				d += Math.abs(c);
			}
			if ( d > 100 ) {
				c -= ( d - 100 );
			}

			// Limit values to 0 and 100.
			return [limit(c), limit(d)];
		}

		return [c,d];
	}

	// Provide a clean event with standardized offset values.
	function fixEvent ( e, pageOffset ) {

		// Prevent scrolling and panning on touch events, while
		// attempting to slide. The tap event also depends on this.
		e.preventDefault();

		// Filter the event to register the type, which can be
		// touch, mouse or pointer. Offset changes need to be
		// made on an event specific basis.
		var touch = e.type.indexOf('touch') === 0,
			mouse = e.type.indexOf('mouse') === 0,
			pointer = e.type.indexOf('pointer') === 0,
			x,y, event = e;

		// IE10 implemented pointer events with a prefix;
		if ( e.type.indexOf('MSPointer') === 0 ) {
			pointer = true;
		}

		if ( touch ) {
			// noUiSlider supports one movement at a time,
			// so we can select the first 'changedTouch'.
			x = e.changedTouches[0].pageX;
			y = e.changedTouches[0].pageY;
		}

		pageOffset = pageOffset || getPageOffset();

		if ( mouse || pointer ) {
			x = e.clientX + pageOffset.x;
			y = e.clientY + pageOffset.y;
		}

		event.pageOffset = pageOffset;
		event.points = [x, y];
		event.cursor = mouse || pointer; // Fix #435

		return event;
	}

	// Append a handle to the base.
	function addHandle ( direction, index ) {

		var origin = document.createElement('div'),
			handle = document.createElement('div'),
			classModifier = [options.cssClasses.handleLower, options.cssClasses.handleUpper];

		if ( direction ) {
			classModifier.reverse();
		}

		addClass(handle, options.cssClasses.handle);
		addClass(handle, classModifier[index]);

		addClass(origin, options.cssClasses.origin);
		origin.appendChild(handle);

		return origin;
	}

	// Add the proper connection classes.
	function addConnection ( connect, target, handles ) {

		// Apply the required connection classes to the elements
		// that need them. Some classes are made up for several
		// segments listed in the class list, to allow easy
		// renaming and provide a minor compression benefit.
		switch ( connect ) {
			case 1:	addClass(target, options.cssClasses.connect);
					addClass(handles[0], options.cssClasses.background);
					break;
			case 3: addClass(handles[1], options.cssClasses.background);
					/* falls through */
			case 2: addClass(handles[0], options.cssClasses.connect);
					/* falls through */
			case 0: addClass(target, options.cssClasses.background);
					break;
		}
	}

	// Add handles to the slider base.
	function addHandles ( nrHandles, direction, base ) {

		var index, handles = [];

		// Append handles.
		for ( index = 0; index < nrHandles; index += 1 ) {

			// Keep a list of all added handles.
			handles.push( base.appendChild(addHandle( direction, index )) );
		}

		return handles;
	}

	// Initialize a single slider.
	function addSlider ( direction, orientation, target ) {

		// Apply classes and data to the target.
		addClass(target, options.cssClasses.target);

		if ( direction === 0 ) {
			addClass(target, options.cssClasses.ltr);
		} else {
			addClass(target, options.cssClasses.rtl);
		}

		if ( orientation === 0 ) {
			addClass(target, options.cssClasses.horizontal);
		} else {
			addClass(target, options.cssClasses.vertical);
		}

		var div = document.createElement('div');
		addClass(div, options.cssClasses.base);
		target.appendChild(div);
		return div;
	}


	function addTooltip ( handle, index ) {

		if ( !options.tooltips[index] ) {
			return false;
		}

		var element = document.createElement('div');
		element.className = options.cssClasses.tooltip;
		return handle.firstChild.appendChild(element);
	}

	// The tooltips option is a shorthand for using the 'update' event.
	function tooltips ( ) {

		if ( options.dir ) {
			options.tooltips.reverse();
		}

		// Tooltips are added with options.tooltips in original order.
		var tips = scope_Handles.map(addTooltip);

		if ( options.dir ) {
			tips.reverse();
			options.tooltips.reverse();
		}

		bindEvent('update', function(f, o, r) {
			if ( tips[o] ) {
				tips[o].innerHTML = options.tooltips[o] === true ? f[o] : options.tooltips[o].to(r[o]);
			}
		});
	}


	function getGroup ( mode, values, stepped ) {

		// Use the range.
		if ( mode === 'range' || mode === 'steps' ) {
			return scope_Spectrum.xVal;
		}

		if ( mode === 'count' ) {

			// Divide 0 - 100 in 'count' parts.
			var spread = ( 100 / (values-1) ), v, i = 0;
			values = [];

			// List these parts and have them handled as 'positions'.
			while ((v=i++*spread) <= 100 ) {
				values.push(v);
			}

			mode = 'positions';
		}

		if ( mode === 'positions' ) {

			// Map all percentages to on-range values.
			return values.map(function( value ){
				return scope_Spectrum.fromStepping( stepped ? scope_Spectrum.getStep( value ) : value );
			});
		}

		if ( mode === 'values' ) {

			// If the value must be stepped, it needs to be converted to a percentage first.
			if ( stepped ) {

				return values.map(function( value ){

					// Convert to percentage, apply step, return to value.
					return scope_Spectrum.fromStepping( scope_Spectrum.getStep( scope_Spectrum.toStepping( value ) ) );
				});

			}

			// Otherwise, we can simply use the values.
			return values;
		}
	}

	function generateSpread ( density, mode, group ) {

		function safeIncrement(value, increment) {
			// Avoid floating point variance by dropping the smallest decimal places.
			return (value + increment).toFixed(7) / 1;
		}

		var originalSpectrumDirection = scope_Spectrum.direction,
			indexes = {},
			firstInRange = scope_Spectrum.xVal[0],
			lastInRange = scope_Spectrum.xVal[scope_Spectrum.xVal.length-1],
			ignoreFirst = false,
			ignoreLast = false,
			prevPct = 0;

		// This function loops the spectrum in an ltr linear fashion,
		// while the toStepping method is direction aware. Trick it into
		// believing it is ltr.
		scope_Spectrum.direction = 0;

		// Create a copy of the group, sort it and filter away all duplicates.
		group = unique(group.slice().sort(function(a, b){ return a - b; }));

		// Make sure the range starts with the first element.
		if ( group[0] !== firstInRange ) {
			group.unshift(firstInRange);
			ignoreFirst = true;
		}

		// Likewise for the last one.
		if ( group[group.length - 1] !== lastInRange ) {
			group.push(lastInRange);
			ignoreLast = true;
		}

		group.forEach(function ( current, index ) {

			// Get the current step and the lower + upper positions.
			var step, i, q,
				low = current,
				high = group[index+1],
				newPct, pctDifference, pctPos, type,
				steps, realSteps, stepsize;

			// When using 'steps' mode, use the provided steps.
			// Otherwise, we'll step on to the next subrange.
			if ( mode === 'steps' ) {
				step = scope_Spectrum.xNumSteps[ index ];
			}

			// Default to a 'full' step.
			if ( !step ) {
				step = high-low;
			}

			// Low can be 0, so test for false. If high is undefined,
			// we are at the last subrange. Index 0 is already handled.
			if ( low === false || high === undefined ) {
				return;
			}

			// Find all steps in the subrange.
			for ( i = low; i <= high; i = safeIncrement(i, step) ) {

				// Get the percentage value for the current step,
				// calculate the size for the subrange.
				newPct = scope_Spectrum.toStepping( i );
				pctDifference = newPct - prevPct;

				steps = pctDifference / density;
				realSteps = Math.round(steps);

				// This ratio represents the ammount of percentage-space a point indicates.
				// For a density 1 the points/percentage = 1. For density 2, that percentage needs to be re-devided.
				// Round the percentage offset to an even number, then divide by two
				// to spread the offset on both sides of the range.
				stepsize = pctDifference/realSteps;

				// Divide all points evenly, adding the correct number to this subrange.
				// Run up to <= so that 100% gets a point, event if ignoreLast is set.
				for ( q = 1; q <= realSteps; q += 1 ) {

					// The ratio between the rounded value and the actual size might be ~1% off.
					// Correct the percentage offset by the number of points
					// per subrange. density = 1 will result in 100 points on the
					// full range, 2 for 50, 4 for 25, etc.
					pctPos = prevPct + ( q * stepsize );
					indexes[pctPos.toFixed(5)] = ['x', 0];
				}

				// Determine the point type.
				type = (group.indexOf(i) > -1) ? 1 : ( mode === 'steps' ? 2 : 0 );

				// Enforce the 'ignoreFirst' option by overwriting the type for 0.
				if ( !index && ignoreFirst ) {
					type = 0;
				}

				if ( !(i === high && ignoreLast)) {
					// Mark the 'type' of this point. 0 = plain, 1 = real value, 2 = step value.
					indexes[newPct.toFixed(5)] = [i, type];
				}

				// Update the percentage count.
				prevPct = newPct;
			}
		});

		// Reset the spectrum.
		scope_Spectrum.direction = originalSpectrumDirection;

		return indexes;
	}

	function addMarking ( spread, filterFunc, formatter ) {

		var element = document.createElement('div'),
			out = '',
			valueSizeClasses = [
				options.cssClasses.valueNormal,
				options.cssClasses.valueLarge,
				options.cssClasses.valueSub
			],
			markerSizeClasses = [
				options.cssClasses.markerNormal,
				options.cssClasses.markerLarge,
				options.cssClasses.markerSub
			],
			valueOrientationClasses = [
				options.cssClasses.valueHorizontal,
				options.cssClasses.valueVertical
			],
			markerOrientationClasses = [
				options.cssClasses.markerHorizontal,
				options.cssClasses.markerVertical
			];

		addClass(element, options.cssClasses.pips);
		addClass(element, options.ort === 0 ? options.cssClasses.pipsHorizontal : options.cssClasses.pipsVertical);

		function getClasses( type, source ){
			var a = source === options.cssClasses.value,
				orientationClasses = a ? valueOrientationClasses : markerOrientationClasses,
				sizeClasses = a ? valueSizeClasses : markerSizeClasses;

			return source + ' ' + orientationClasses[options.ort] + ' ' + sizeClasses[type];
		}

		function getTags( offset, source, values ) {
			return 'class="' + getClasses(values[1], source) + '" style="' + options.style + ': ' + offset + '%"';
		}

		function addSpread ( offset, values ){

			if ( scope_Spectrum.direction ) {
				offset = 100 - offset;
			}

			// Apply the filter function, if it is set.
			values[1] = (values[1] && filterFunc) ? filterFunc(values[0], values[1]) : values[1];

			// Add a marker for every point
			out += '<div ' + getTags(offset, options.cssClasses.marker, values) + '></div>';

			// Values are only appended for points marked '1' or '2'.
			if ( values[1] ) {
				out += '<div ' + getTags(offset, options.cssClasses.value, values) + '>' + formatter.to(values[0]) + '</div>';
			}
		}

		// Append all points.
		Object.keys(spread).forEach(function(a){
			addSpread(a, spread[a]);
		});

		element.innerHTML = out;

		return element;
	}

	function pips ( grid ) {

	var mode = grid.mode,
		density = grid.density || 1,
		filter = grid.filter || false,
		values = grid.values || false,
		stepped = grid.stepped || false,
		group = getGroup( mode, values, stepped ),
		spread = generateSpread( density, mode, group ),
		format = grid.format || {
			to: Math.round
		};

		return scope_Target.appendChild(addMarking(
			spread,
			filter,
			format
		));
	}


	// Shorthand for base dimensions.
	function baseSize ( ) {
		var rect = scope_Base.getBoundingClientRect(), alt = 'offset' + ['Width', 'Height'][options.ort];
		return options.ort === 0 ? (rect.width||scope_Base[alt]) : (rect.height||scope_Base[alt]);
	}

	// External event handling
	function fireEvent ( event, handleNumber, tap ) {

		var i;

		// During initialization, do not fire events.
		for ( i = 0; i < options.handles; i++ ) {
			if ( scope_Locations[i] === -1 ) {
				return;
			}
		}

		if ( handleNumber !== undefined && options.handles !== 1 ) {
			handleNumber = Math.abs(handleNumber - options.dir);
		}

		Object.keys(scope_Events).forEach(function( targetEvent ) {

			var eventType = targetEvent.split('.')[0];

			if ( event === eventType ) {
				scope_Events[targetEvent].forEach(function( callback ) {

					callback.call(
						// Use the slider public API as the scope ('this')
						scope_Self,
						// Return values as array, so arg_1[arg_2] is always valid.
						asArray(valueGet()),
						// Handle index, 0 or 1
						handleNumber,
						// Unformatted slider values
						asArray(inSliderOrder(Array.prototype.slice.call(scope_Values))),
						// Event is fired by tap, true or false
						tap || false,
						// Left offset of the handle, in relation to the slider
						scope_Locations
					);
				});
			}
		});
	}

	// Returns the input array, respecting the slider direction configuration.
	function inSliderOrder ( values ) {

		// If only one handle is used, return a single value.
		if ( values.length === 1 ){
			return values[0];
		}

		if ( options.dir ) {
			return values.reverse();
		}

		return values;
	}


	// Handler for attaching events trough a proxy.
	function attach ( events, element, callback, data ) {

		// This function can be used to 'filter' events to the slider.
		// element is a node, not a nodeList

		var method = function ( e ){

			if ( scope_Target.hasAttribute('disabled') ) {
				return false;
			}

			// Stop if an active 'tap' transition is taking place.
			if ( hasClass(scope_Target, options.cssClasses.tap) ) {
				return false;
			}

			e = fixEvent(e, data.pageOffset);

			// Ignore right or middle clicks on start #454
			if ( events === actions.start && e.buttons !== undefined && e.buttons > 1 ) {
				return false;
			}

			// Ignore right or middle clicks on start #454
			if ( data.hover && e.buttons ) {
				return false;
			}

			e.calcPoint = e.points[ options.ort ];

			// Call the event handler with the event [ and additional data ].
			callback ( e, data );

		}, methods = [];

		// Bind a closure on the target for every event type.
		events.split(' ').forEach(function( eventName ){
			element.addEventListener(eventName, method, false);
			methods.push([eventName, method]);
		});

		return methods;
	}

	// Handle movement on document for handle and range drag.
	function move ( event, data ) {

		// Fix #498
		// Check value of .buttons in 'start' to work around a bug in IE10 mobile (data.buttonsProperty).
		// https://connect.microsoft.com/IE/feedback/details/927005/mobile-ie10-windows-phone-buttons-property-of-pointermove-event-always-zero
		// IE9 has .buttons and .which zero on mousemove.
		// Firefox breaks the spec MDN defines.
		if ( navigator.appVersion.indexOf("MSIE 9") === -1 && event.buttons === 0 && data.buttonsProperty !== 0 ) {
			return end(event, data);
		}

		var handles = data.handles || scope_Handles, positions, state = false,
			proposal = ((event.calcPoint - data.start) * 100) / data.baseSize,
			handleNumber = handles[0] === scope_Handles[0] ? 0 : 1, i;

		// Calculate relative positions for the handles.
		positions = getPositions( proposal, data.positions, handles.length > 1);

		state = setHandle ( handles[0], positions[handleNumber], handles.length === 1 );

		if ( handles.length > 1 ) {

			state = setHandle ( handles[1], positions[handleNumber?0:1], false ) || state;

			if ( state ) {
				// fire for both handles
				for ( i = 0; i < data.handles.length; i++ ) {
					fireEvent('slide', i);
				}
			}
		} else if ( state ) {
			// Fire for a single handle
			fireEvent('slide', handleNumber);
		}
	}

	// Unbind move events on document, call callbacks.
	function end ( event, data ) {

		// The handle is no longer active, so remove the class.
		var active = scope_Base.querySelector( '.' + options.cssClasses.active ),
			handleNumber = data.handles[0] === scope_Handles[0] ? 0 : 1;

		if ( active !== null ) {
			removeClass(active, options.cssClasses.active);
		}

		// Remove cursor styles and text-selection events bound to the body.
		if ( event.cursor ) {
			document.body.style.cursor = '';
			document.body.removeEventListener('selectstart', document.body.noUiListener);
		}

		var d = document.documentElement;

		// Unbind the move and end events, which are added on 'start'.
		d.noUiListeners.forEach(function( c ) {
			d.removeEventListener(c[0], c[1]);
		});

		// Remove dragging class.
		removeClass(scope_Target, options.cssClasses.drag);

		// Fire the change and set events.
		fireEvent('set', handleNumber);
		fireEvent('change', handleNumber);

		// If this is a standard handle movement, fire the end event.
		if ( data.handleNumber !== undefined ) {
			fireEvent('end', data.handleNumber);
		}
	}

	// Fire 'end' when a mouse or pen leaves the document.
	function documentLeave ( event, data ) {
		if ( event.type === "mouseout" && event.target.nodeName === "HTML" && event.relatedTarget === null ){
			end ( event, data );
		}
	}

	// Bind move events on document.
	function start ( event, data ) {

		var d = document.documentElement;

		// Mark the handle as 'active' so it can be styled.
		if ( data.handles.length === 1 ) {
			// Support 'disabled' handles
			if ( data.handles[0].hasAttribute('disabled') ) {
				return false;
			}

			addClass(data.handles[0].children[0], options.cssClasses.active);
		}

		// Fix #551, where a handle gets selected instead of dragged.
		event.preventDefault();

		// A drag should never propagate up to the 'tap' event.
		event.stopPropagation();

		// Attach the move and end events.
		var moveEvent = attach(actions.move, d, move, {
			start: event.calcPoint,
			baseSize: baseSize(),
			pageOffset: event.pageOffset,
			handles: data.handles,
			handleNumber: data.handleNumber,
			buttonsProperty: event.buttons,
			positions: [
				scope_Locations[0],
				scope_Locations[scope_Handles.length - 1]
			]
		}), endEvent = attach(actions.end, d, end, {
			handles: data.handles,
			handleNumber: data.handleNumber
		});

		var outEvent = attach("mouseout", d, documentLeave, {
			handles: data.handles,
			handleNumber: data.handleNumber
		});

		d.noUiListeners = moveEvent.concat(endEvent, outEvent);

		// Text selection isn't an issue on touch devices,
		// so adding cursor styles can be skipped.
		if ( event.cursor ) {

			// Prevent the 'I' cursor and extend the range-drag cursor.
			document.body.style.cursor = getComputedStyle(event.target).cursor;

			// Mark the target with a dragging state.
			if ( scope_Handles.length > 1 ) {
				addClass(scope_Target, options.cssClasses.drag);
			}

			var f = function(){
				return false;
			};

			document.body.noUiListener = f;

			// Prevent text selection when dragging the handles.
			document.body.addEventListener('selectstart', f, false);
		}

		if ( data.handleNumber !== undefined ) {
			fireEvent('start', data.handleNumber);
		}
	}

	// Move closest handle to tapped location.
	function tap ( event ) {

		var location = event.calcPoint, total = 0, handleNumber, to;

		// The tap event shouldn't propagate up and cause 'edge' to run.
		event.stopPropagation();

		// Add up the handle offsets.
		scope_Handles.forEach(function(a){
			total += offset(a)[ options.style ];
		});

		// Find the handle closest to the tapped position.
		handleNumber = ( location < total/2 || scope_Handles.length === 1 ) ? 0 : 1;

		// Check if handler is not disablet if yes set number to the next handler
		if (scope_Handles[handleNumber].hasAttribute('disabled')) {
			handleNumber = handleNumber ? 0 : 1;
		}

		location -= offset(scope_Base)[ options.style ];

		// Calculate the new position.
		to = ( location * 100 ) / baseSize();

		if ( !options.events.snap ) {
			// Flag the slider as it is now in a transitional state.
			// Transition takes a configurable amount of ms (default 300). Re-enable the slider after that.
			addClassFor( scope_Target, options.cssClasses.tap, options.animationDuration );
		}

		// Support 'disabled' handles
		if ( scope_Handles[handleNumber].hasAttribute('disabled') ) {
			return false;
		}

		// Find the closest handle and calculate the tapped point.
		// The set handle to the new position.
		setHandle( scope_Handles[handleNumber], to );

		fireEvent('slide', handleNumber, true);
		fireEvent('set', handleNumber, true);
		fireEvent('change', handleNumber, true);

		if ( options.events.snap ) {
			start(event, { handles: [scope_Handles[handleNumber]] });
		}
	}

	// Fires a 'hover' event for a hovered mouse/pen position.
	function hover ( event ) {

		var location = event.calcPoint - offset(scope_Base)[ options.style ],
			to = scope_Spectrum.getStep(( location * 100 ) / baseSize()),
			value = scope_Spectrum.fromStepping( to );

		Object.keys(scope_Events).forEach(function( targetEvent ) {
			if ( 'hover' === targetEvent.split('.')[0] ) {
				scope_Events[targetEvent].forEach(function( callback ) {
					callback.call( scope_Self, value );
				});
			}
		});
	}

	// Attach events to several slider parts.
	function events ( behaviour ) {

		// Attach the standard drag event to the handles.
		if ( !behaviour.fixed ) {

			scope_Handles.forEach(function( handle, index ){

				// These events are only bound to the visual handle
				// element, not the 'real' origin element.
				attach ( actions.start, handle.children[0], start, {
					handles: [ handle ],
					handleNumber: index
				});
			});
		}

		// Attach the tap event to the slider base.
		if ( behaviour.tap ) {

			attach ( actions.start, scope_Base, tap, {
				handles: scope_Handles
			});
		}

		// Fire hover events
		if ( behaviour.hover ) {
			attach ( actions.move, scope_Base, hover, { hover: true } );
		}

		// Make the range draggable.
		if ( behaviour.drag ){

			var drag = [scope_Base.querySelector( '.' + options.cssClasses.connect )];
			addClass(drag[0], options.cssClasses.draggable);

			// When the range is fixed, the entire range can
			// be dragged by the handles. The handle in the first
			// origin will propagate the start event upward,
			// but it needs to be bound manually on the other.
			if ( behaviour.fixed ) {
				drag.push(scope_Handles[(drag[0] === scope_Handles[0] ? 1 : 0)].children[0]);
			}

			drag.forEach(function( element ) {
				attach ( actions.start, element, start, {
					handles: scope_Handles
				});
			});
		}
	}


	// Test suggested values and apply margin, step.
	function setHandle ( handle, to, noLimitOption ) {

		var trigger = handle !== scope_Handles[0] ? 1 : 0,
			lowerMargin = scope_Locations[0] + options.margin,
			upperMargin = scope_Locations[1] - options.margin,
			lowerLimit = scope_Locations[0] + options.limit,
			upperLimit = scope_Locations[1] - options.limit;

		// For sliders with multiple handles,
		// limit movement to the other handle.
		// Apply the margin option by adding it to the handle positions.
		if ( scope_Handles.length > 1 ) {
			to = trigger ? Math.max( to, lowerMargin ) : Math.min( to, upperMargin );
		}

		// The limit option has the opposite effect, limiting handles to a
		// maximum distance from another. Limit must be > 0, as otherwise
		// handles would be unmoveable. 'noLimitOption' is set to 'false'
		// for the .val() method, except for pass 4/4.
		if ( noLimitOption !== false && options.limit && scope_Handles.length > 1 ) {
			to = trigger ? Math.min ( to, lowerLimit ) : Math.max( to, upperLimit );
		}

		// Handle the step option.
		to = scope_Spectrum.getStep( to );

		// Limit percentage to the 0 - 100 range
		to = limit(to);

		// Return false if handle can't move
		if ( to === scope_Locations[trigger] ) {
			return false;
		}

		// Set the handle to the new position.
		// Use requestAnimationFrame for efficient painting.
		// No significant effect in Chrome, Edge sees dramatic
		// performace improvements.
		if ( window.requestAnimationFrame ) {
			window.requestAnimationFrame(function(){
				handle.style[options.style] = to + '%';
			});
		} else {
			handle.style[options.style] = to + '%';
		}

		// Force proper handle stacking
		if ( !handle.previousSibling ) {
			removeClass(handle, options.cssClasses.stacking);
			if ( to > 50 ) {
				addClass(handle, options.cssClasses.stacking);
			}
		}

		// Update locations.
		scope_Locations[trigger] = to;

		// Convert the value to the slider stepping/range.
		scope_Values[trigger] = scope_Spectrum.fromStepping( to );

		fireEvent('update', trigger);

		return true;
	}

	// Loop values from value method and apply them.
	function setValues ( count, values ) {

		var i, trigger, to;

		// With the limit option, we'll need another limiting pass.
		if ( options.limit ) {
			count += 1;
		}

		// If there are multiple handles to be set run the setting
		// mechanism twice for the first handle, to make sure it
		// can be bounced of the second one properly.
		for ( i = 0; i < count; i += 1 ) {

			trigger = i%2;

			// Get the current argument from the array.
			to = values[trigger];

			// Setting with null indicates an 'ignore'.
			// Inputting 'false' is invalid.
			if ( to !== null && to !== false ) {

				// If a formatted number was passed, attemt to decode it.
				if ( typeof to === 'number' ) {
					to = String(to);
				}

				to = options.format.from( to );

				// Request an update for all links if the value was invalid.
				// Do so too if setting the handle fails.
				if ( to === false || isNaN(to) || setHandle( scope_Handles[trigger], scope_Spectrum.toStepping( to ), i === (3 - options.dir) ) === false ) {
					fireEvent('update', trigger);
				}
			}
		}
	}

	// Set the slider value.
	function valueSet ( input, fireSetEvent ) {

		var count, values = asArray( input ), i;

		// Event fires by default
		fireSetEvent = (fireSetEvent === undefined ? true : !!fireSetEvent);

		// The RTL settings is implemented by reversing the front-end,
		// internal mechanisms are the same.
		if ( options.dir && options.handles > 1 ) {
			values.reverse();
		}

		// Animation is optional.
		// Make sure the initial values where set before using animated placement.
		if ( options.animate && scope_Locations[0] !== -1 ) {
			addClassFor( scope_Target, options.cssClasses.tap, options.animationDuration );
		}

		// Determine how often to set the handles.
		count = scope_Handles.length > 1 ? 3 : 1;

		if ( values.length === 1 ) {
			count = 1;
		}

		setValues ( count, values );

		// Fire the 'set' event for both handles.
		for ( i = 0; i < scope_Handles.length; i++ ) {

			// Fire the event only for handles that received a new value, as per #579
			if ( values[i] !== null && fireSetEvent ) {
				fireEvent('set', i);
			}
		}
	}

	// Get the slider value.
	function valueGet ( ) {

		var i, retour = [];

		// Get the value from all handles.
		for ( i = 0; i < options.handles; i += 1 ){
			retour[i] = options.format.to( scope_Values[i] );
		}

		return inSliderOrder( retour );
	}

	// Removes classes from the root and empties it.
	function destroy ( ) {

		for ( var key in options.cssClasses ) {
			if ( !options.cssClasses.hasOwnProperty(key) ) { continue; }
			removeClass(scope_Target, options.cssClasses[key]);
		}

		while (scope_Target.firstChild) {
			scope_Target.removeChild(scope_Target.firstChild);
		}

		delete scope_Target.noUiSlider;
	}

	// Get the current step size for the slider.
	function getCurrentStep ( ) {

		// Check all locations, map them to their stepping point.
		// Get the step point, then find it in the input list.
		var retour = scope_Locations.map(function( location, index ){

			var step = scope_Spectrum.getApplicableStep( location ),

				// As per #391, the comparison for the decrement step can have some rounding issues.
				// Round the value to the precision used in the step.
				stepDecimals = countDecimals(String(step[2])),

				// Get the current numeric value
				value = scope_Values[index],

				// To move the slider 'one step up', the current step value needs to be added.
				// Use null if we are at the maximum slider value.
				increment = location === 100 ? null : step[2],

				// Going 'one step down' might put the slider in a different sub-range, so we
				// need to switch between the current or the previous step.
				prev = Number((value - step[2]).toFixed(stepDecimals)),

				// If the value fits the step, return the current step value. Otherwise, use the
				// previous step. Return null if the slider is at its minimum value.
				decrement = location === 0 ? null : (prev >= step[1]) ? step[2] : (step[0] || false);

			return [decrement, increment];
		});

		// Return values in the proper order.
		return inSliderOrder( retour );
	}

	// Attach an event to this slider, possibly including a namespace
	function bindEvent ( namespacedEvent, callback ) {
		scope_Events[namespacedEvent] = scope_Events[namespacedEvent] || [];
		scope_Events[namespacedEvent].push(callback);

		// If the event bound is 'update,' fire it immediately for all handles.
		if ( namespacedEvent.split('.')[0] === 'update' ) {
			scope_Handles.forEach(function(a, index){
				fireEvent('update', index);
			});
		}
	}

	// Undo attachment of event
	function removeEvent ( namespacedEvent ) {

		var event = namespacedEvent && namespacedEvent.split('.')[0],
			namespace = event && namespacedEvent.substring(event.length);

		Object.keys(scope_Events).forEach(function( bind ){

			var tEvent = bind.split('.')[0],
				tNamespace = bind.substring(tEvent.length);

			if ( (!event || event === tEvent) && (!namespace || namespace === tNamespace) ) {
				delete scope_Events[bind];
			}
		});
	}

	// Updateable: margin, limit, step, range, animate, snap
	function updateOptions ( optionsToUpdate, fireSetEvent ) {

		// Spectrum is created using the range, snap, direction and step options.
		// 'snap' and 'step' can be updated, 'direction' cannot, due to event binding.
		// If 'snap' and 'step' are not passed, they should remain unchanged.
		var v = valueGet(), newOptions = testOptions({
			start: [0, 0],
			margin: optionsToUpdate.margin,
			limit: optionsToUpdate.limit,
			step: optionsToUpdate.step === undefined ? options.singleStep : optionsToUpdate.step,
			range: optionsToUpdate.range,
			animate: optionsToUpdate.animate,
			snap: optionsToUpdate.snap === undefined ? options.snap : optionsToUpdate.snap
		});

		['margin', 'limit', 'range', 'animate'].forEach(function(name){

			// Only change options that we're actually passed to update.
			if ( optionsToUpdate[name] !== undefined ) {
				options[name] = optionsToUpdate[name];
			}
		});

		// Save current spectrum direction as testOptions in testRange call
		// doesn't rely on current direction
		newOptions.spectrum.direction = scope_Spectrum.direction;
		scope_Spectrum = newOptions.spectrum;

		// Invalidate the current positioning so valueSet forces an update.
		scope_Locations = [-1, -1];
		valueSet(optionsToUpdate.start || v, fireSetEvent);
	}


	// Throw an error if the slider was already initialized.
	if ( scope_Target.noUiSlider ) {
		throw new Error('Slider was already initialized.');
	}

	// Create the base element, initialise HTML and set classes.
	// Add handles and links.
	scope_Base = addSlider( options.dir, options.ort, scope_Target );
	scope_Handles = addHandles( options.handles, options.dir, scope_Base );

	// Set the connect classes.
	addConnection ( options.connect, scope_Target, scope_Handles );

	if ( options.pips ) {
		pips(options.pips);
	}

	if ( options.tooltips ) {
		tooltips();
	}

	scope_Self = {
		destroy: destroy,
		steps: getCurrentStep,
		on: bindEvent,
		off: removeEvent,
		get: valueGet,
		set: valueSet,
		updateOptions: updateOptions,
		options: originalOptions, // Issue #600
		target: scope_Target, // Issue #597
		pips: pips // Issue #594
	};

	// Attach user events.
	events( options.events );

	return scope_Self;

}


	// Run the standard initializer
	function initialize ( target, originalOptions ) {

		if ( !target.nodeName ) {
			throw new Error('noUiSlider.create requires a single element.');
		}

		// Test the options and create the slider environment;
		var options = testOptions( originalOptions, target ),
			slider = closure( target, options, originalOptions );

		// Use the public value method to set the start values.
		slider.set(options.start);

		target.noUiSlider = slider;
		return slider;
	}

	// Use an object instead of a function for future expansibility;
	return {
		create: initialize
	};

}));
/*!
* Clamp.js 0.5.1
*
* Copyright 2011-2013, Joseph Schmitt http://joe.sh
* Released under the WTFPL license
* http://sam.zoy.org/wtfpl/
*/
(function(){window.$clamp=function(c,d){function s(a,b){n.getComputedStyle||(n.getComputedStyle=function(a,b){this.el=a;this.getPropertyValue=function(b){var c=/(\-([a-z]){1})/g;"float"==b&&(b="styleFloat");c.test(b)&&(b=b.replace(c,function(a,b,c){return c.toUpperCase()}));return a.currentStyle&&a.currentStyle[b]?a.currentStyle[b]:null};return this});return n.getComputedStyle(a,null).getPropertyValue(b)}function t(a){a=a||c.clientHeight;var b=u(c);return Math.max(Math.floor(a/b),0)}function x(a){return u(c)*
a}function u(a){var b=s(a,"line-height");"normal"==b&&(b=1.2*parseInt(s(a,"font-size")));return parseInt(b)}function l(a){if(a.lastChild.children&&0<a.lastChild.children.length)return l(Array.prototype.slice.call(a.children).pop());if(a.lastChild&&a.lastChild.nodeValue&&""!=a.lastChild.nodeValue&&a.lastChild.nodeValue!=b.truncationChar)return a.lastChild;a.lastChild.parentNode.removeChild(a.lastChild);return l(c)}function p(a,d){if(d){var e=a.nodeValue.replace(b.truncationChar,"");f||(h=0<k.length?
k.shift():"",f=e.split(h));1<f.length?(q=f.pop(),r(a,f.join(h))):f=null;m&&(a.nodeValue=a.nodeValue.replace(b.truncationChar,""),c.innerHTML=a.nodeValue+" "+m.innerHTML+b.truncationChar);if(f){if(c.clientHeight<=d)if(0<=k.length&&""!=h)r(a,f.join(h)+h+q),f=null;else return c.innerHTML}else""==h&&(r(a,""),a=l(c),k=b.splitOnChars.slice(0),h=k[0],q=f=null);if(b.animate)setTimeout(function(){p(a,d)},!0===b.animate?10:b.animate);else return p(a,d)}}function r(a,c){a.nodeValue=c+b.truncationChar}d=d||{};
var n=window,b={clamp:d.clamp||2,useNativeClamp:"undefined"!=typeof d.useNativeClamp?d.useNativeClamp:!0,splitOnChars:d.splitOnChars||[".","-","\u2013","\u2014"," "],animate:d.animate||!1,truncationChar:d.truncationChar||"\u2026",truncationHTML:d.truncationHTML},e=c.style,y=c.innerHTML,z="undefined"!=typeof c.style.webkitLineClamp,g=b.clamp,v=g.indexOf&&(-1<g.indexOf("px")||-1<g.indexOf("em")),m;b.truncationHTML&&(m=document.createElement("span"),m.innerHTML=b.truncationHTML);var k=b.splitOnChars.slice(0),
h=k[0],f,q;"auto"==g?g=t():v&&(g=t(parseInt(g)));var w;z&&b.useNativeClamp?(e.overflow="hidden",e.textOverflow="ellipsis",e.webkitBoxOrient="vertical",e.display="-webkit-box",e.webkitLineClamp=g,v&&(e.height=b.clamp+"px")):(e=x(g),e<=c.clientHeight&&(w=p(l(c),e)));return{original:y,clamped:w}}})();
/*!
 * clipboard.js v1.5.5
 * https://zenorocha.github.io/clipboard.js
 *
 * Licensed MIT © Zeno Rocha
 */
!function(t){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=t();else if("function"==typeof define&&define.amd)define([],t);else{var e;e="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,e.Clipboard=t()}}(function(){var t,e,n;return function t(e,n,r){function o(a,c){if(!n[a]){if(!e[a]){var s="function"==typeof require&&require;if(!c&&s)return s(a,!0);if(i)return i(a,!0);var u=new Error("Cannot find module '"+a+"'");throw u.code="MODULE_NOT_FOUND",u}var l=n[a]={exports:{}};e[a][0].call(l.exports,function(t){var n=e[a][1][t];return o(n?n:t)},l,l.exports,t,e,n,r)}return n[a].exports}for(var i="function"==typeof require&&require,a=0;a<r.length;a++)o(r[a]);return o}({1:[function(t,e,n){var r=t("matches-selector");e.exports=function(t,e,n){for(var o=n?t:t.parentNode;o&&o!==document;){if(r(o,e))return o;o=o.parentNode}}},{"matches-selector":2}],2:[function(t,e,n){function r(t,e){if(i)return i.call(t,e);for(var n=t.parentNode.querySelectorAll(e),r=0;r<n.length;++r)if(n[r]==t)return!0;return!1}var o=Element.prototype,i=o.matchesSelector||o.webkitMatchesSelector||o.mozMatchesSelector||o.msMatchesSelector||o.oMatchesSelector;e.exports=r},{}],3:[function(t,e,n){function r(t,e,n,r){var i=o.apply(this,arguments);return t.addEventListener(n,i),{destroy:function(){t.removeEventListener(n,i)}}}function o(t,e,n,r){return function(n){n.delegateTarget=i(n.target,e,!0),n.delegateTarget&&r.call(t,n)}}var i=t("closest");e.exports=r},{closest:1}],4:[function(t,e,n){n.node=function(t){return void 0!==t&&t instanceof HTMLElement&&1===t.nodeType},n.nodeList=function(t){var e=Object.prototype.toString.call(t);return void 0!==t&&("[object NodeList]"===e||"[object HTMLCollection]"===e)&&"length"in t&&(0===t.length||n.node(t[0]))},n.string=function(t){return"string"==typeof t||t instanceof String},n.function=function(t){var e=Object.prototype.toString.call(t);return"[object Function]"===e}},{}],5:[function(t,e,n){function r(t,e,n){if(!t&&!e&&!n)throw new Error("Missing required arguments");if(!c.string(e))throw new TypeError("Second argument must be a String");if(!c.function(n))throw new TypeError("Third argument must be a Function");if(c.node(t))return o(t,e,n);if(c.nodeList(t))return i(t,e,n);if(c.string(t))return a(t,e,n);throw new TypeError("First argument must be a String, HTMLElement, HTMLCollection, or NodeList")}function o(t,e,n){return t.addEventListener(e,n),{destroy:function(){t.removeEventListener(e,n)}}}function i(t,e,n){return Array.prototype.forEach.call(t,function(t){t.addEventListener(e,n)}),{destroy:function(){Array.prototype.forEach.call(t,function(t){t.removeEventListener(e,n)})}}}function a(t,e,n){return s(document.body,t,e,n)}var c=t("./is"),s=t("delegate");e.exports=r},{"./is":4,delegate:3}],6:[function(t,e,n){function r(t){var e;if("INPUT"===t.nodeName||"TEXTAREA"===t.nodeName)t.focus(),t.setSelectionRange(0,t.value.length),e=t.value;else{t.hasAttribute("contenteditable")&&t.focus();var n=window.getSelection(),r=document.createRange();r.selectNodeContents(t),n.removeAllRanges(),n.addRange(r),e=n.toString()}return e}e.exports=r},{}],7:[function(t,e,n){function r(){}r.prototype={on:function(t,e,n){var r=this.e||(this.e={});return(r[t]||(r[t]=[])).push({fn:e,ctx:n}),this},once:function(t,e,n){function r(){o.off(t,r),e.apply(n,arguments)}var o=this;return r._=e,this.on(t,r,n)},emit:function(t){var e=[].slice.call(arguments,1),n=((this.e||(this.e={}))[t]||[]).slice(),r=0,o=n.length;for(r;o>r;r++)n[r].fn.apply(n[r].ctx,e);return this},off:function(t,e){var n=this.e||(this.e={}),r=n[t],o=[];if(r&&e)for(var i=0,a=r.length;a>i;i++)r[i].fn!==e&&r[i].fn._!==e&&o.push(r[i]);return o.length?n[t]=o:delete n[t],this}},e.exports=r},{}],8:[function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}n.__esModule=!0;var i=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),a=t("select"),c=r(a),s=function(){function t(e){o(this,t),this.resolveOptions(e),this.initSelection()}return t.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action=e.action,this.emitter=e.emitter,this.target=e.target,this.text=e.text,this.trigger=e.trigger,this.selectedText=""},t.prototype.initSelection=function t(){if(this.text&&this.target)throw new Error('Multiple attributes declared, use either "target" or "text"');if(this.text)this.selectFake();else{if(!this.target)throw new Error('Missing required attributes, use either "target" or "text"');this.selectTarget()}},t.prototype.selectFake=function t(){var e=this;this.removeFake(),this.fakeHandler=document.body.addEventListener("click",function(){return e.removeFake()}),this.fakeElem=document.createElement("textarea"),this.fakeElem.style.position="absolute",this.fakeElem.style.left="-9999px",this.fakeElem.style.top=(window.pageYOffset||document.documentElement.scrollTop)+"px",this.fakeElem.setAttribute("readonly",""),this.fakeElem.value=this.text,document.body.appendChild(this.fakeElem),this.selectedText=c.default(this.fakeElem),this.copyText()},t.prototype.removeFake=function t(){this.fakeHandler&&(document.body.removeEventListener("click"),this.fakeHandler=null),this.fakeElem&&(document.body.removeChild(this.fakeElem),this.fakeElem=null)},t.prototype.selectTarget=function t(){this.selectedText=c.default(this.target),this.copyText()},t.prototype.copyText=function t(){var e=void 0;try{e=document.execCommand(this.action)}catch(n){e=!1}this.handleResult(e)},t.prototype.handleResult=function t(e){e?this.emitter.emit("success",{action:this.action,text:this.selectedText,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)}):this.emitter.emit("error",{action:this.action,trigger:this.trigger,clearSelection:this.clearSelection.bind(this)})},t.prototype.clearSelection=function t(){this.target&&this.target.blur(),window.getSelection().removeAllRanges()},t.prototype.destroy=function t(){this.removeFake()},i(t,[{key:"action",set:function t(){var e=arguments.length<=0||void 0===arguments[0]?"copy":arguments[0];if(this._action=e,"copy"!==this._action&&"cut"!==this._action)throw new Error('Invalid "action" value, use either "copy" or "cut"')},get:function t(){return this._action}},{key:"target",set:function t(e){if(void 0!==e){if(!e||"object"!=typeof e||1!==e.nodeType)throw new Error('Invalid "target" value, use a valid Element');this._target=e}},get:function t(){return this._target}}]),t}();n.default=s,e.exports=n.default},{select:6}],9:[function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{"default":t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function a(t,e){var n="data-clipboard-"+t;if(e.hasAttribute(n))return e.getAttribute(n)}n.__esModule=!0;var c=t("./clipboard-action"),s=r(c),u=t("tiny-emitter"),l=r(u),f=t("good-listener"),d=r(f),h=function(t){function e(n,r){o(this,e),t.call(this),this.resolveOptions(r),this.listenClick(n)}return i(e,t),e.prototype.resolveOptions=function t(){var e=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];this.action="function"==typeof e.action?e.action:this.defaultAction,this.target="function"==typeof e.target?e.target:this.defaultTarget,this.text="function"==typeof e.text?e.text:this.defaultText},e.prototype.listenClick=function t(e){var n=this;this.listener=d.default(e,"click",function(t){return n.onClick(t)})},e.prototype.onClick=function t(e){var n=e.delegateTarget||e.currentTarget;this.clipboardAction&&(this.clipboardAction=null),this.clipboardAction=new s.default({action:this.action(n),target:this.target(n),text:this.text(n),trigger:n,emitter:this})},e.prototype.defaultAction=function t(e){return a("action",e)},e.prototype.defaultTarget=function t(e){var n=a("target",e);return n?document.querySelector(n):void 0},e.prototype.defaultText=function t(e){return a("text",e)},e.prototype.destroy=function t(){this.listener.destroy(),this.clipboardAction&&(this.clipboardAction.destroy(),this.clipboardAction=null)},e}(l.default);n.default=h,e.exports=n.default},{"./clipboard-action":8,"good-listener":5,"tiny-emitter":7}]},{},[9])(9)});
//nothing
/* 
Native FullScreen JavaScript API
https://gist.github.com/rzg/2947434
CopyRight: Johndyer, http://johndyer.name/native-fullscreen-javascript-api-plus-jquery-plugin/
-------------
Assumes Mozilla naming conventions instead of W3C for now
*/

// msExitFullscreen

(function() {
    var
        fullScreenApi = {
            supportsFullScreen: false,
            isFullScreen: function() { return false; },
            requestFullScreen: function() {},
            cancelFullScreen: function() {},
            fullScreenEventName: '',
            prefix: ''
        },
        browserPrefixes = 'webkit moz o ms khtml'.split(' ');

    // check for native support
    if (typeof document.cancelFullScreen != 'undefined') {
        fullScreenApi.supportsFullScreen = true;
    } else {
        // check for fullscreen support by vendor prefix
        for (var i = 0, il = browserPrefixes.length; i < il; i++ ) {
            fullScreenApi.prefix = browserPrefixes[i];

            if (typeof document[fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ||
                typeof document[fullScreenApi.prefix + 'ExitFullscreen' ] != 'undefined' 
                ) {
                fullScreenApi.supportsFullScreen = true;

                break;
            }
        }
    }

    // update methods to do something useful
    if (fullScreenApi.supportsFullScreen) {
        if(navigator.userAgent.indexOf("Edge") > -1) {
            fullScreenApi.fullScreenEventName = 'fullscreenchange';
        } else if (fullScreenApi.prefix == 'ms') {
            fullScreenApi.fullScreenEventName = 'MSFullscreenChange';
        } else {
            fullScreenApi.fullScreenEventName = fullScreenApi.prefix + 'fullscreenchange';
        }

        fullScreenApi.isFullScreen = function() {
            switch (this.prefix) {
                case '':
                    return document.fullScreen;
                case 'ms':
                    return document.msFullscreenElement;
                case 'webkit':
                    return document.webkitIsFullScreen;
                default:
                    return document[this.prefix + 'FullScreen'];
            }
        }
        fullScreenApi.requestFullScreen = function(el) {
            switch (this.prefix) {
                case '':
                    return el.requestFullScreen();
                case 'ms':
                    return el[this.prefix + 'RequestFullscreen']();
                default:
                    return el[this.prefix + 'RequestFullScreen']();
            }
        }
        fullScreenApi.cancelFullScreen = function(el) {
            switch (this.prefix) {
                case '':
                    return document.cancelFullScreen();
                case 'ms':
                    return document[this.prefix + 'ExitFullscreen']();
                default:
                    return document[this.prefix + 'CancelFullScreen']();
            }
        }
    }

    // jQuery plugin
    if (typeof jQuery != 'undefined') {
        jQuery.fn.requestFullScreen = function() {

            return this.each(function() {
                if (fullScreenApi.supportsFullScreen) {
                    fullScreenApi.requestFullScreen(this);
                }
            });
        };
    }

    // export api
    window.fullScreenApi = fullScreenApi;
})();

!function(a,b){"object"==typeof exports&&"object"==typeof module?module.exports=b():"function"==typeof define&&define.amd?define([],b):"object"==typeof exports?exports.jwplayer=b():a.jwplayer=b()}(this,function(){return function(a){function b(c){if(d[c])return d[c].exports;var e=d[c]={exports:{},id:c,loaded:!1};return a[c].call(e.exports,e,e.exports,b),e.loaded=!0,e.exports}var c=window.webpackJsonpjwplayer;window.webpackJsonpjwplayer=function(d,f){for(var g,h,i=0,j=[];i<d.length;i++)h=d[i],e[h]&&j.push.apply(j,e[h]),e[h]=0;for(g in f)a[g]=f[g];for(c&&c(d,f);j.length;)j.shift().call(null,b)};var d={},e={0:0};return b.e=function(a,c){if(0===e[a])return c.call(null,b);if(void 0!==e[a])e[a].push(c);else{e[a]=[c];var d=document.getElementsByTagName("head")[0],f=document.createElement("script");f.type="text/javascript",f.charset="utf-8",f.async=!0,f.src=b.p+""+({2:"provider.youtube",3:"provider.dashjs",4:"provider.shaka",5:"provider.cast"}[a]||a)+".js",d.appendChild(f)}},b.m=a,b.c=d,b.p="",b(0)}([function(a,b,c){a.exports=c(38)},,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,function(a,b,c){var d,e;d=[c(39),c(171),c(47)],e=function(a,b,c){return window.jwplayer?window.jwplayer:c.extend(a,b)}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(40),c(45),c(165)],e=function(a,b){return c.p=b.loadFrom(),a.selectPlayer}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(41),c(93),c(47)],e=function(a,b,c){var d=a.selectPlayer,e=function(){var a=d.apply(this,arguments);return a?a:{registerPlugin:function(a,c,d){"jwpsrv"!==a&&b.registerPlugin(a,c,d)}}};return c.extend(a,{selectPlayer:e})}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(42),c(47),c(76),c(74),c(70),c(93)],e=function(a,b,c,d,e,f){function g(a){var f=a.getName().name;if(!b.find(e,b.matches({name:f}))){if(!b.isFunction(a.supports))throw{message:"Tried to register a provider with an invalid object"};e.unshift({name:f,supports:a.supports})}var g=function(){};g.prototype=c,a.prototype=new g,d[f]=a}var h=[],i=0,j=function(b){var c,d;return b?"string"==typeof b?(c=k(b),c||(d=document.getElementById(b))):"number"==typeof b?c=h[b]:b.nodeType&&(d=b,c=k(d.id)):c=h[0],c?c:d?l(new a(d,m)):{registerPlugin:f.registerPlugin}},k=function(a){for(var b=0;b<h.length;b++)if(h[b].id===a)return h[b];return null},l=function(a){return i++,a.uniqueId=i,h.push(a),a},m=function(a){for(var b=h.length;b--;)if(h[b].uniqueId===a.uniqueId){h.splice(b,1);break}},n={selectPlayer:j,registerProvider:g,availableProviders:e,registerPlugin:f.registerPlugin};return j.api=n,n}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(66),c(65),c(63),c(45),c(81),c(47),c(43),c(162),c(163),c(164),c(58)],e=function(a,b,c,d,e,f,g,h,i,j,k){function l(a){d.addClass(a,"jw-tab-focus")}function m(a){d.removeClass(a,"jw-tab-focus")}var n=function(n,o){var p,q=this,r=!1,s={};f.extend(this,c),this.utils=d,this._=f,this.Events=c,this.version=k,this.trigger=function(a,b){return b=f.isObject(b)?f.extend({},b):{},b.type=a,c.trigger.call(q,a,b)},this.on=function(a,b){if(f.isString(b))throw new TypeError("eval callbacks depricated");var e=function(){try{b.apply(this,arguments)}catch(c){d.log('There was an error calling back an event handler for "'+a+'". Error: '+c.message)}};return c.on.call(q,a,e)},this.dispatchEvent=this.trigger,this.removeEventListener=this.off.bind(this);var t=function(){p=new g(n),h(q,p),i(q,p),p.on(a.JWPLAYER_PLAYLIST_ITEM,function(){s={}}),p.on(a.JWPLAYER_MEDIA_META,function(a){f.extend(s,a.metadata)}),p.on(a.JWPLAYER_VIEW_TAB_FOCUS,function(a){a.hasFocus===!0?l(this.getContainer()):m(this.getContainer())}),p.on(a.JWPLAYER_READY,function(a){r=!0,u.tick("ready"),a.setupTime=u.between("setup","ready")}),p.on("all",q.trigger)};t(),j(this),this.id=n.id;var u=this._qoe=new e;u.tick("init");var v=function(){r=!1,s={},q.off(),p&&p.off(),p&&p.playerDestroy&&p.playerDestroy()},w=function(a){var b=q.plugins;return b&&b[a]};return this.setup=function(a){return u.tick("setup"),v(),t(),d.foreach(a.events,function(a,b){var c=q[a];"function"==typeof c&&c.call(q,b)}),a.id=q.id,p.setup(a,this),q},this.qoe=function(){var b=p.getItemQoe(),c=u.between("setup","ready"),d=b.between(a.JWPLAYER_MEDIA_PLAY_ATTEMPT,a.JWPLAYER_MEDIA_FIRST_FRAME);return{setupTime:c,firstFrame:d,player:u.dump(),item:b.dump()}},this.getContainer=function(){return p.getContainer?p.getContainer():n},this.getMeta=this.getItemMeta=function(){return s},this.getPlaylistItem=function(a){if(!d.exists(a))return p._model.get("playlistItem");var b=q.getPlaylist();return b?b[a]:null},this.getRenderingMode=function(){return"html5"},this.load=function(a){var b=w("vast")||w("googima");return b&&b.destroy(),p.load(a),q},this.play=function(a){if(a===!0)return p.play(),q;if(a===!1)return p.pause(),q;switch(a=q.getState()){case b.PLAYING:case b.BUFFERING:p.pause();break;default:p.play()}return q},this.pause=function(a){return f.isBoolean(a)?this.play(!a):this.play()},this.createInstream=function(){return p.createInstream()},this.castToggle=function(){p&&p.castToggle&&p.castToggle()},this.playAd=this.pauseAd=d.noop,this.remove=function(){return o(q),q.trigger("remove"),v(),q},this};return n}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(44),c(71)],e=function(a,b){var d=a.prototype.setup;return a.prototype.setup=function(){d.apply(this,arguments);var a=this._model.get("edition"),e=b(a),f=this._model.get("cast"),g=this;e("casting")&&f&&f.appid&&c.e(5,function(a){var b=c(156);g._castController=new b(g,g._model),g.castToggle=g._castController.castToggle.bind(g._castController)})},a}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(59),c(113),c(61),c(47),c(88),c(110),c(67),c(99),c(45),c(114),c(63),c(64),c(65),c(66),c(154)],e=function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o){function p(a){return function(){var b=Array.prototype.slice.call(arguments,0);this.eventsQueue.push([a,b])}}function q(a){return a===m.LOADING||a===m.STALLED?m.BUFFERING:a}var r=function(a){this.originalContainer=this.currentContainer=a,this.eventsQueue=[],d.extend(this,k),this._model=new g};return r.prototype={play:p("play"),pause:p("pause"),setVolume:p("setVolume"),setMute:p("setMute"),seek:p("seek"),stop:p("stop"),load:p("load"),playlistNext:p("playlistNext"),playlistPrev:p("playlistPrev"),playlistItem:p("playlistItem"),setFullscreen:p("setFullscreen"),setCurrentCaptions:p("setCurrentCaptions"),setCurrentQuality:p("setCurrentQuality"),setup:function(g,k){function o(){S.mediaModel.on("change:state",function(a,b){var c=q(b);S.set("state",c)})}function p(){V=null,S.on("change:state",l,this),S.on("change:castState",function(a,b){$.trigger(n.JWPLAYER_CAST_SESSION,b)}),S.on("change:fullscreen",function(a,b){$.trigger(n.JWPLAYER_FULLSCREEN,{fullscreen:b})}),S.on("change:playlistItem",function(a,b){$.trigger(n.JWPLAYER_PLAYLIST_ITEM,{index:a.get("item"),item:b})}),S.on("change:playlist",function(a,b){b.length&&$.trigger(n.JWPLAYER_PLAYLIST_LOADED,{playlist:b})}),S.on("change:volume",function(a,b){$.trigger(n.JWPLAYER_MEDIA_VOLUME,{volume:b})}),S.on("change:mute",function(a,b){$.trigger(n.JWPLAYER_MEDIA_MUTE,{mute:b})}),S.on("change:scrubbing",function(a,b){b?x():v()}),S.on("change:captionsList",function(a,b){$.trigger(n.JWPLAYER_CAPTIONS_LIST,{tracks:b,track:N()})}),S.mediaController.on("all",$.trigger.bind($)),T.on("all",$.trigger.bind($)),this.showView(T.element()),window.addEventListener("beforeunload",function(){Q()||w(!0)}),d.defer(r)}function r(){for($.trigger(n.JWPLAYER_READY,{setupTime:0}),$.trigger(n.JWPLAYER_PLAYLIST_LOADED,{playlist:S.get("playlist")}),$.trigger(n.JWPLAYER_PLAYLIST_ITEM,{index:S.get("item"),item:S.get("playlistItem")}),$.trigger(n.JWPLAYER_CAPTIONS_LIST,{tracks:S.get("captionsList"),track:S.get("captionsIndex")}),S.get("autostart")&&v();$.eventsQueue.length>0;){var a=$.eventsQueue.shift(),b=a[0],c=a[1]||[];$[b].apply($,c)}}function s(a){switch(w(!0),S.get("autostart")&&S.once("setItem",v),typeof a){case"string":t(a);break;case"object":S.setPlaylist(a),S.setItem(0);break;case"number":S.setItem(a)}}function t(a){var b=new h;b.on(n.JWPLAYER_PLAYLIST_LOADED,function(a){s(a.playlist)}),b.on(n.JWPLAYER_ERROR,function(a){S.set("state",m.ERROR),s([]),a.message="Could not load playlist: "+a.message,$.trigger.call($,a.type,a)}),b.load(a)}function u(){var a=$._instreamAdapter&&$._instreamAdapter.getState();return d.isString(a)?a:S.get("state")}function v(){var a;if(S.get("state")!==m.ERROR){var b=$._instreamAdapter&&$._instreamAdapter.getState();if(d.isString(b))return k.pauseAd(!1);if(S.get("state")===m.COMPLETE&&(w(!0),S.setItem(0)),!Y&&(Y=!0,$.trigger(n.JWPLAYER_MEDIA_BEFOREPLAY,{}),Y=!1,X))return X=!1,void(W=null);if(y()){if(0===S.get("playlist").length)return!1;a=i.tryCatch(function(){S.loadVideo()})}else S.get("state")===m.PAUSED&&(a=i.tryCatch(function(){S.playVideo()}));return a instanceof i.Error?($.trigger(n.JWPLAYER_ERROR,a),W=null,!1):!0}}function w(a){S.off("setItem",v);var b=!a;W=null;var c=i.tryCatch(function(){_().stop()},$);return c instanceof i.Error?($.trigger(n.JWPLAYER_ERROR,c),!1):(b&&(Z=!0),Y&&(X=!0),!0)}function x(){W=null;var a=$._instreamAdapter&&$._instreamAdapter.getState();if(d.isString(a))return k.pauseAd(!0);switch(S.get("state")){case m.ERROR:return!1;case m.PLAYING:case m.BUFFERING:var b=i.tryCatch(function(){_().pause()},this);if(b instanceof i.Error)return $.trigger(n.JWPLAYER_ERROR,b),!1;break;default:Y&&(X=!0)}return!0}function y(){var a=S.get("state");return a===m.IDLE||a===m.COMPLETE||a===m.ERROR}function z(a){S.get("state")!==m.ERROR&&(S.get("scrubbing")||S.get("state")===m.PLAYING||v(!0),_().seek(a))}function A(a){w(!0),S.setItem(a),v()}function B(){A(S.get("item")-1)}function C(){A(S.get("item")+1)}function D(){if(y()){if(Z)return void(Z=!1);W=D;var a=S.get("item");return a===S.get("playlist").length-1?void(S.get("repeat")?C():(S.set("state",m.COMPLETE),$.trigger(n.JWPLAYER_PLAYLIST_COMPLETE,{}))):void C()}}function E(a){_().setCurrentQuality(a)}function F(){return _()?_().getCurrentQuality():-1}function G(){return this._model?this._model.getConfiguration():void 0}function H(){if(this._model.mediaModel)return this._model.mediaModel.get("visualQuality");var a=I();if(a){var b=F(),c=a[b];if(c)return{level:d.extend({index:b},c),mode:"",reason:""}}return null}function I(){return _()?_().getQualityLevels():null}function J(a){_().setCurrentAudioTrack(a)}function K(){return _()?_().getCurrentAudioTrack():-1}function L(){return _()?_().getAudioTracks():null}function M(a){S.setVideoSubtitleTrack(a),$.trigger(n.JWPLAYER_CAPTIONS_CHANGED,{tracks:O(),track:a})}function N(){return U.getCurrentIndex()}function O(){return U.getCaptionsList()}function P(){var a=S.getVideo();if(a){var b=a.detachMedia();if(b instanceof HTMLVideoElement)return b}return null}function Q(){var a=S.getVideo();return a?a.isCaster:!1}function R(a){var b=i.tryCatch(function(){S.getVideo().attachMedia(a)});return b instanceof i.Error?void i.log("Error calling _attachMedia",b):void("function"==typeof W&&W())}var S,T,U,V,W,X,Y=!1,Z=!1,$=this,_=function(){return S.getVideo()},aa=new a(g);S=this._model.setup(aa),T=this._view=new j(k,S),U=new f(k,S),V=new e(k,S,T),V.on(n.JWPLAYER_READY,p,this),V.on(n.JWPLAYER_SETUP_ERROR,function(a){$.setupError(a.message)}),S.mediaController.on(n.JWPLAYER_MEDIA_COMPLETE,function(){d.defer(D)}),S.mediaController.on(n.JWPLAYER_MEDIA_ERROR,function(a){S.set("state",m.ERROR);var b=d.extend({},a);b.type=n.JWPLAYER_ERROR,this.trigger(b.type,b)},this),o(),S.on("change:mediaModel",o),this.play=v,this.pause=x,this.seek=z,this.stop=w,this.load=s,this.playlistNext=C,this.playlistPrev=B,this.playlistItem=A,this.setCurrentCaptions=M,this.setCurrentQuality=E,this.detachMedia=P,this.attachMedia=R,this.getCurrentQuality=F,this.getQualityLevels=I,this.setCurrentAudioTrack=J,this.getCurrentAudioTrack=K,this.getAudioTracks=L,this.getCurrentCaptions=N,this.getCaptionsList=O,this.getVisualQuality=H,this.getConfig=G,this.getState=u,this.setVolume=S.setVolume,this.setMute=S.setMute,this.getProvider=function(){return S.get("provider")},this.getWidth=function(){return S.get("containerWidth")},this.getHeight=function(){return S.get("containerHeight")},this.getContainer=function(){return this.currentContainer},this.resize=T.resize,this.getSafeRegion=T.getSafeRegion,this.setCues=T.addCues,this.setFullscreen=T.fullscreen,this.addButton=function(a,b,c,e){var f={img:a,tooltip:b,callback:c,id:e},g=S.get("dock");g=g?g.slice(0):[],g=d.reject(g,d.matches({id:f.id})),g.push(f),S.set("dock",g)},this.removeButton=function(a){var b=S.get("dock")||[];b=d.reject(b,d.matches({id:a})),S.set("dock",b)},this.checkBeforePlay=function(){return Y},this.getItemQoe=function(){return S._qoeItem},this.setControls=function(a){S.set("controls",a)},this.playerDestroy=function(){this.stop(),this.showView(this.originalContainer),T&&T.destroy(),S&&S.destroy(),V&&(V.destroy(),V=null)},this.isBeforePlay=this.checkBeforePlay,this.isBeforeComplete=function(){return S.getVideo().checkComplete()},this.createInstream=function(){return this.instreamDestroy(),this._instreamAdapter=new c(this,S,T),this._instreamAdapter},this.skipAd=function(){this._instreamAdapter&&this._instreamAdapter.skipAd()},this.instreamDestroy=function(){$._instreamAdapter&&$._instreamAdapter.destroy()},b(k,this),V.start()},showView:function(a){(document.documentElement.contains(this.currentContainer)||(this.currentContainer=document.getElementById(this._model.get("id")),this.currentContainer))&&(this.currentContainer.parentElement&&this.currentContainer.parentElement.replaceChild(a,this.currentContainer),this.currentContainer=a)},setupError:function(a){var b=i.createElement(o(this._model.get("id"),this._model.get("skin"),a)),c=this._model.get("width"),e=this._model.get("height");i.style(b,{width:c.toString().indexOf("%")>0?c:c+"px",height:e.toString().indexOf("%")>0?e:e+"px"}),this.showView(b);var f=this;d.defer(function(){f.trigger(n.JWPLAYER_SETUP_ERROR,{message:a})})}},r}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50),c(47),c(51),c(52),c(54),c(46),c(55),c(48),c(56),c(49)],e=function(a,b,c,d,e,f,g,h,i,j){var k={};return k.log=function(){window.console&&("object"==typeof console.log?console.log(Array.prototype.slice.call(arguments,0)):console.log.apply(console,arguments))},k.between=function(a,b,c){return Math.max(Math.min(a,c),b)},k.foreach=function(a,b){var c,d;for(c in a)"function"===k.typeOf(a.hasOwnProperty)?a.hasOwnProperty(c)&&(d=a[c],b(c,d)):(d=a[c],b(c,d))},k.indexOf=b.indexOf,k.noop=function(){},k.seconds=a.seconds,k.prefix=a.prefix,k.suffix=a.suffix,b.extend(k,f,h,c,g,d,e,i,j),k}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(48),c(49)],e=function(a,b,c){function d(a){return/^(?:(?:https?|file)\:)?\/\//.test(a)}var e={};return e.getAbsolutePath=function(a,c){if(b.exists(c)||(c=document.location.href),b.exists(a)){if(d(a))return a;var e,f=c.substring(0,c.indexOf("://")+3),g=c.substring(f.length,c.indexOf("/",f.length+1));if(0===a.indexOf("/"))e=a.split("/");else{var h=c.split("?")[0];h=h.substring(f.length+g.length+1,h.lastIndexOf("/")),e=h.split("/").concat(a.split("/"))}for(var i=[],j=0;j<e.length;j++)e[j]&&b.exists(e[j])&&"."!==e[j]&&(".."===e[j]?i.pop():i.push(e[j]));return f+g+"/"+i.join("/")}},e.getScriptPath=a.memoize(function(a){for(var b=document.getElementsByTagName("script"),c=0;c<b.length;c++){var d=b[c].src;if(d&&d.indexOf(a)>=0)return d.substr(0,d.indexOf(a))}return""}),e.parseXML=function(a){var b=null;return c.tryCatch(function(){if(window.DOMParser){b=(new window.DOMParser).parseFromString(a,"text/xml");var c=b.childNodes;c&&c.length&&c[0].firstChild&&"parsererror"===c[0].firstChild.nodeName&&(b=null)}else b=new window.ActiveXObject("Microsoft.XMLDOM"),b.async="false",b.loadXML(a)}),b},e.serialize=function(a){if(void 0===a)return null;if("string"==typeof a&&a.length<6){var b=a.toLowerCase();if("true"===b)return!0;if("false"===b)return!1;if(!isNaN(Number(a))&&!isNaN(parseFloat(a)))return Number(a)}return a},e.parseDimension=function(a){return"string"==typeof a?""===a?0:a.lastIndexOf("%")>-1?a:parseInt(a.replace("px",""),10):a},e.timeFormat=function(a){if(a>0){var b=Math.floor(a/3600),c=Math.floor((a-3600*b)/60),d=Math.floor(a%60);return(b?b+":":"")+(10>c?"0":"")+c+":"+(10>d?"0":"")+d}return"00:00"},e.adaptiveType=function(a){if(-1!==a){var b=-120;if(b>=a)return"DVR";if(0>a||a===1/0)return"LIVE"}return"VOD"},e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a={},b=Array.prototype,c=Object.prototype,d=Function.prototype,e=b.slice,f=b.concat,g=c.toString,h=c.hasOwnProperty,i=b.map,j=b.forEach,k=b.filter,l=b.every,m=b.some,n=b.indexOf,o=Array.isArray,p=Object.keys,q=d.bind,r=function(a){return a instanceof r?a:this instanceof r?void 0:new r(a)},s=r.each=r.forEach=function(b,c,d){if(null==b)return b;if(j&&b.forEach===j)b.forEach(c,d);else if(b.length===+b.length){for(var e=0,f=b.length;f>e;e++)if(c.call(d,b[e],e,b)===a)return}else for(var g=r.keys(b),e=0,f=g.length;f>e;e++)if(c.call(d,b[g[e]],g[e],b)===a)return;return b};r.map=r.collect=function(a,b,c){var d=[];return null==a?d:i&&a.map===i?a.map(b,c):(s(a,function(a,e,f){d.push(b.call(c,a,e,f))}),d)},r.find=r.detect=function(a,b,c){var d;return t(a,function(a,e,f){return b.call(c,a,e,f)?(d=a,!0):void 0}),d},r.filter=r.select=function(a,b,c){var d=[];return null==a?d:k&&a.filter===k?a.filter(b,c):(s(a,function(a,e,f){b.call(c,a,e,f)&&d.push(a)}),d)},r.reject=function(a,b,c){return r.filter(a,function(a,d,e){return!b.call(c,a,d,e)},c)},r.compact=function(a){return r.filter(a,r.identity)},r.every=r.all=function(b,c,d){c||(c=r.identity);var e=!0;return null==b?e:l&&b.every===l?b.every(c,d):(s(b,function(b,f,g){return(e=e&&c.call(d,b,f,g))?void 0:a}),!!e)};var t=r.some=r.any=function(b,c,d){c||(c=r.identity);var e=!1;return null==b?e:m&&b.some===m?b.some(c,d):(s(b,function(b,f,g){return e||(e=c.call(d,b,f,g))?a:void 0}),!!e)};r.size=function(a){return null==a?0:a.length===+a.length?a.length:r.keys(a).length},r.after=function(a,b){return function(){return--a<1?b.apply(this,arguments):void 0}},r.before=function(a,b){var c;return function(){return--a>0&&(c=b.apply(this,arguments)),1>=a&&(b=null),c}};var u=function(a){return null==a?r.identity:r.isFunction(a)?a:r.property(a)};r.sortedIndex=function(a,b,c,d){c=u(c);for(var e=c.call(d,b),f=0,g=a.length;g>f;){var h=f+g>>>1;c.call(d,a[h])<e?f=h+1:g=h}return f};var t=r.some=r.any=function(b,c,d){c||(c=r.identity);var e=!1;return null==b?e:m&&b.some===m?b.some(c,d):(s(b,function(b,f,g){return e||(e=c.call(d,b,f,g))?a:void 0}),!!e)};r.contains=r.include=function(a,b){return null==a?!1:(a.length!==+a.length&&(a=r.values(a)),r.indexOf(a,b)>=0)},r.where=function(a,b){return r.filter(a,r.matches(b))},r.findWhere=function(a,b){return r.find(a,r.matches(b))},r.max=function(a,b,c){if(!b&&r.isArray(a)&&a[0]===+a[0]&&a.length<65535)return Math.max.apply(Math,a);var d=-(1/0),e=-(1/0);return s(a,function(a,f,g){var h=b?b.call(c,a,f,g):a;h>e&&(d=a,e=h)}),d},r.difference=function(a){var c=f.apply(b,e.call(arguments,1));return r.filter(a,function(a){return!r.contains(c,a)})},r.without=function(a){return r.difference(a,e.call(arguments,1))},r.indexOf=function(a,b,c){if(null==a)return-1;var d=0,e=a.length;if(c){if("number"!=typeof c)return d=r.sortedIndex(a,b),a[d]===b?d:-1;d=0>c?Math.max(0,e+c):c}if(n&&a.indexOf===n)return a.indexOf(b,c);for(;e>d;d++)if(a[d]===b)return d;return-1};var v=function(){};r.bind=function(a,b){var c,d;if(q&&a.bind===q)return q.apply(a,e.call(arguments,1));if(!r.isFunction(a))throw new TypeError;return c=e.call(arguments,2),d=function(){if(!(this instanceof d))return a.apply(b,c.concat(e.call(arguments)));v.prototype=a.prototype;var f=new v;v.prototype=null;var g=a.apply(f,c.concat(e.call(arguments)));return Object(g)===g?g:f}},r.partial=function(a){var b=e.call(arguments,1);return function(){for(var c=0,d=b.slice(),e=0,f=d.length;f>e;e++)d[e]===r&&(d[e]=arguments[c++]);for(;c<arguments.length;)d.push(arguments[c++]);return a.apply(this,d)}},r.once=r.partial(r.before,2),r.memoize=function(a,b){var c={};return b||(b=r.identity),function(){var d=b.apply(this,arguments);return r.has(c,d)?c[d]:c[d]=a.apply(this,arguments)}},r.delay=function(a,b){var c=e.call(arguments,2);return setTimeout(function(){return a.apply(null,c)},b)},r.defer=function(a){return r.delay.apply(r,[a,1].concat(e.call(arguments,1)))},r.throttle=function(a,b,c){var d,e,f,g=null,h=0;c||(c={});var i=function(){h=c.leading===!1?0:r.now(),g=null,f=a.apply(d,e),d=e=null};return function(){var j=r.now();h||c.leading!==!1||(h=j);var k=b-(j-h);return d=this,e=arguments,0>=k?(clearTimeout(g),g=null,h=j,f=a.apply(d,e),d=e=null):g||c.trailing===!1||(g=setTimeout(i,k)),f}},r.keys=function(a){if(!r.isObject(a))return[];if(p)return p(a);var b=[];for(var c in a)r.has(a,c)&&b.push(c);return b},r.invert=function(a){for(var b={},c=r.keys(a),d=0,e=c.length;e>d;d++)b[a[c[d]]]=c[d];return b},r.defaults=function(a){return s(e.call(arguments,1),function(b){if(b)for(var c in b)void 0===a[c]&&(a[c]=b[c])}),a},r.extend=function(a){return s(e.call(arguments,1),function(b){if(b)for(var c in b)a[c]=b[c]}),a},r.pick=function(a){var c={},d=f.apply(b,e.call(arguments,1));return s(d,function(b){b in a&&(c[b]=a[b])}),c},r.omit=function(a){var c={},d=f.apply(b,e.call(arguments,1));for(var g in a)r.contains(d,g)||(c[g]=a[g]);return c},r.clone=function(a){return r.isObject(a)?r.isArray(a)?a.slice():r.extend({},a):a},r.isArray=o||function(a){return"[object Array]"==g.call(a)},r.isObject=function(a){return a===Object(a)},s(["Arguments","Function","String","Number","Date","RegExp"],function(a){r["is"+a]=function(b){return g.call(b)=="[object "+a+"]"}}),r.isArguments(arguments)||(r.isArguments=function(a){return!(!a||!r.has(a,"callee"))}),r.isFunction=function(a){return"function"==typeof a},r.isFinite=function(a){return isFinite(a)&&!isNaN(parseFloat(a))},r.isNaN=function(a){return r.isNumber(a)&&a!=+a},r.isBoolean=function(a){return a===!0||a===!1||"[object Boolean]"==g.call(a)},r.isNull=function(a){return null===a},r.isUndefined=function(a){return void 0===a},r.has=function(a,b){return h.call(a,b)},r.identity=function(a){return a},r.constant=function(a){return function(){return a}},r.property=function(a){return function(b){return b[a]}},r.propertyOf=function(a){return null==a?function(){}:function(b){return a[b]}},r.matches=function(a){return function(b){if(b===a)return!0;for(var c in a)if(a[c]!==b[c])return!1;return!0}},r.now=Date.now||function(){return(new Date).getTime()},r.result=function(a,b){if(null==a)return void 0;var c=a[b];return r.isFunction(c)?c.call(a):c};var w=0;return r.uniqueId=function(a){var b=++w+"";return a?a+b:b},r}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(49)],e=function(a,b){var c={};return c.exists=function(a){switch(typeof a){case"string":return a.length>0;case"object":return null!==a;case"undefined":return!1}return!0},c.isHTTPS=function(){return 0===window.location.href.indexOf("https")},c.isRtmp=function(a,b){return 0===a.indexOf("rtmp")||"rtmp"===b},c.isYouTube=function(a,b){return"youtube"===b||/^(http|\/\/).*(youtube\.com|youtu\.be)\/.+/.test(a)},c.youTubeID=function(a){var c=b.tryCatch(function(){return/v[=\/]([^?&]*)|youtu\.be\/([^?]*)|^([\w-]*)$/i.exec(a).slice(1).join("").replace("?","")});return c instanceof b.Error?"":c},c.typeOf=function(b){if(null===b)return"null";var c=typeof b;return"object"===c&&a.isArray(b)?"array":c},c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a=function(a,c,d){if(c=c||this,d=d||[],window.jwplayer&&window.jwplayer.debug)return a.apply(c,d);try{return a.apply(c,d)}catch(e){return new b(a.name,e)}},b=function(a,b){this.name=a,this.message=b};return{tryCatch:a,Error:b}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){function b(a){return a.indexOf("(format=m3u8-")>-1?"m3u8":!1}var c=function(a){return a.replace(/^\s+|\s+$/g,"")},d=function(a,b,c){for(a=""+a,c=c||"0";a.length<b;)a=c+a;return a},e=function(a,b){for(var c=0;c<a.attributes.length;c++)if(a.attributes[c].name&&a.attributes[c].name.toLowerCase()===b.toLowerCase())return a.attributes[c].value.toString();return""},f=function(a){if(!a||"rtmp"===a.substr(0,4))return"";var c=b(a);return c?c:(a=a.substring(a.lastIndexOf("/")+1,a.length).split("?")[0].split("#")[0],a.lastIndexOf(".")>-1?a.substr(a.lastIndexOf(".")+1,a.length).toLowerCase():void 0)},g=function(a){var b=parseInt(a/3600),c=parseInt(a/60)%60,e=a%60;return d(b,2)+":"+d(c,2)+":"+d(e.toFixed(3),6)},h=function(b){if(a.isNumber(b))return b;b=b.replace(",",".");var c=b.split(":"),d=0;return"s"===b.slice(-1)?d=parseFloat(b):"m"===b.slice(-1)?d=60*parseFloat(b):"h"===b.slice(-1)?d=3600*parseFloat(b):c.length>1?(d=parseFloat(c[c.length-1]),d+=60*parseFloat(c[c.length-2]),3===c.length&&(d+=3600*parseFloat(c[c.length-3]))):d=parseFloat(b),d},i=function(b,c){return a.map(b,function(a){return c+a})},j=function(b,c){return a.map(b,function(a){return a+c})};return{trim:c,pad:d,xmlAttribute:e,extension:f,hms:g,seconds:h,suffix:j,prefix:i}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(49)],e=function(a,b){function c(a){return function(){return e(a)}}var d={},e=a.memoize(function(a){var b=navigator.userAgent.toLowerCase();return null!==b.match(a)}),f=d.isInt=function(a){return parseFloat(a)%1===0};d.isFlashSupported=function(){var a=d.flashVersion();return a&&a>=11.2},d.isFF=c(/firefox/i),d.isChrome=c(/chrome/i),d.isIPod=c(/iP(hone|od)/i),d.isIPad=c(/iPad/i),d.isSafari602=c(/Macintosh.*Mac OS X 10_8.*6\.0\.\d* Safari/i);var g=d.isIETrident=function(a){return a?(a=parseFloat(a).toFixed(1),e(new RegExp("trident/.+rv:\\s*"+a,"i"))):e(/trident/i)},h=d.isMSIE=function(a){return a?(a=parseFloat(a).toFixed(1),e(new RegExp("msie\\s*"+a,"i"))):e(/msie/i)};d.isIE=function(a){return a?(a=parseFloat(a).toFixed(1),a>=11?g(a):h(a)):h()||g()},d.isSafari=function(){return e(/safari/i)&&!e(/chrome/i)&&!e(/chromium/i)&&!e(/android/i)};var i=d.isIOS=function(a){return e(a?new RegExp("iP(hone|ad|od).+\\sOS\\s"+a,"i"):/iP(hone|ad|od)/i)};d.isAndroidNative=function(a){return j(a,!0)};var j=d.isAndroid=function(a,b){return b&&e(/chrome\/[123456789]/i)&&!e(/chrome\/18/)?!1:a?(f(a)&&!/\./.test(a)&&(a=""+a+"."),e(new RegExp("Android\\s*"+a,"i"))):e(/Android/i)};return d.isMobile=function(){return i()||j()},d.isIframe=function(){return window.frameElement&&"IFRAME"===window.frameElement.nodeName},d.flashVersion=function(){if(d.isAndroid())return 0;var a,c=navigator.plugins;if(c&&(a=c["Shockwave Flash"],a&&a.description))return parseFloat(a.description.replace(/\D+(\d+\.?\d*).*/,"$1"));if("undefined"!=typeof window.ActiveXObject){var e=b.tryCatch(function(){return a=new window.ActiveXObject("ShockwaveFlash.ShockwaveFlash"),a?parseFloat(a.GetVariable("$version").split(" ")[1].replace(/\s*,\s*/,".")):void 0});return e instanceof b.Error?0:e}return 0},d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50),c(47),c(53)],e=function(a,b,c){var d={};return d.createElement=function(a){var b=document.createElement("div");return b.innerHTML=a,b.firstChild},d.styleDimension=function(a){return a+(a.toString().indexOf("%")>0?"":"px")},d.classList=function(a){return a.classList?a.classList:a.className.split(" ")},d.hasClass=c.hasClass,d.addClass=function(c,d){var e=b.isString(c.className)?c.className.split(" "):[],f=b.isArray(d)?d:d.split(" ");b.each(f,function(a){b.contains(e,a)||e.push(a)}),c.className=a.trim(e.join(" "))},d.removeClass=function(c,d){var e=b.isString(c.className)?c.className.split(" "):[],f=b.isArray(d)?d:d.split(" ");c.className=a.trim(b.difference(e,f).join(" "))},d.toggleClass=function(a,c,e){var f=d.hasClass(a,c);e=b.isBoolean(e)?e:!f,e!==f&&(e?d.addClass(a,c):d.removeClass(a,c))},d.emptyElement=function(a){for(;a.firstChild;)a.removeChild(a.firstChild)},d.addStyleSheet=function(a){var b=document.createElement("link");b.rel="stylesheet",b.href=a,document.getElementsByTagName("head")[0].appendChild(b)},d.empty=function(a){if(a)for(;a.childElementCount>0;)a.removeChild(a.children[0])},d.bounds=function(a){var b={left:0,right:0,width:0,height:0,top:0,bottom:0};if(!a||!document.body.contains(a))return b;if(a.getBoundingClientRect){var c=a.getBoundingClientRect(a),d=window.pageYOffset,e=window.pageXOffset;if(!(c.width||c.height||c.left||c.top))return b;b.left=c.left+e,b.right=c.right+e,b.top=c.top+d,b.bottom=c.bottom+d,b.width=c.right-c.left,b.height=c.bottom-c.top}else{b.width=0|a.offsetWidth,b.height=0|a.offsetHeight;do b.left+=0|a.offsetLeft,b.top+=0|a.offsetTop;while(a=a.offsetParent);b.right=b.left+b.width,b.bottom=b.top+b.height}return b},d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return{hasClass:function(a,b){var c=" "+b+" ";return 1===a.nodeType&&(" "+a.className+" ").replace(/[\t\r\n\f]/g," ").indexOf(c)>=0}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){function b(a){a=a.split("-");for(var b=1;b<a.length;b++)a[b]=a[b].charAt(0).toUpperCase()+a[b].slice(1);return a.join("")}function c(b,c,d){if(""===c||void 0===c||null===c)return"";var e=d?" !important":"";return"string"==typeof c&&isNaN(c)?/png|gif|jpe?g/i.test(c)&&c.indexOf("url")<0?"url("+c+")":c+e:0===c||"z-index"===b||"opacity"===b?""+c+e:/color/i.test(b)?"#"+a.pad(c.toString(16).replace(/^0x/i,""),6)+e:Math.ceil(c)+"px"+e}var d,e={},f=function(a,b){d||(d=document.createElement("style"),d.type="text/css",document.getElementsByTagName("head")[0].appendChild(d));var c=a+JSON.stringify(b).replace(/"/g,""),f=document.createTextNode(c);e[a]&&d.removeChild(e[a]),e[a]=f,d.appendChild(f)},g=function(a,d){if(void 0!==a&&null!==a){void 0===a.length&&(a=[a]);var e,f={};for(e in d)f[e]=c(e,d[e]);for(var g=0;g<a.length;g++){var h,i=a[g];if(void 0!==i&&null!==i)for(e in f)h=b(e),i.style[h]!==f[e]&&(i.style[h]=f[e])}}},h=function(a){for(var b in e)b.indexOf(a)>=0&&(d.removeChild(e[b]),delete e[b])},i=function(a,b){var c="transform",d={};b=b||"",d[c]=b,d["-webkit-"+c]=b,d["-ms-"+c]=b,d["-moz-"+c]=b,d["-o-"+c]=b,g(a,d)},j=function(a,b){var c="rgb";a?(a=String(a).replace("#",""),3===a.length&&(a=a[0]+a[0]+a[1]+a[1]+a[2]+a[2])):a="000000";var d=[parseInt(a.substr(0,2),16),parseInt(a.substr(2,2),16),parseInt(a.substr(4,2),16)];return void 0!==b&&100!==b&&(c+="a",d.push(b/100)),c+"("+d.join(",")+")"};return{css:f,style:g,clearCss:h,transform:i,hexToRgba:j}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(48),c(46),c(49)],e=function(a,b,c,d){function e(a){return a&&a.indexOf("://")>=0&&a.split("/")[2]!==window.location.href.split("/")[2]}function f(a,b,c){return function(){a("Error loading file",b,c)}}function g(a,b,c,d,e){return function(){if(4===a.readyState)switch(a.status){case 200:h(a,b,c,d,e)();break;case 404:d("File not found",b,a)}}}function h(b,d,e,f,g){return function(){var h,i;if(g)e(b);else{try{if(h=b.responseXML,h&&(i=h.firstChild,h.lastChild&&"parsererror"===h.lastChild.nodeName))return void(f&&f("Invalid XML",d,b))}catch(j){}if(h&&i)return e(b);var k=c.parseXML(b.responseText);if(!k||!k.firstChild)return void(f&&f(b.responseText?"Invalid XML":d,d,b));b=a.extend({},b,{responseXML:k}),e(b)}}}var i={};return i.ajax=function(a,c,i,j){var k,l=!1;if(a.indexOf("#")>0&&(a=a.replace(/#.*$/,"")),e(a)&&b.exists(window.XDomainRequest))k=new window.XDomainRequest,k.onload=h(k,a,c,i,j),k.ontimeout=k.onprogress=function(){},k.timeout=5e3;else{if(!b.exists(window.XMLHttpRequest))return i&&i("",a,k),k;k=new window.XMLHttpRequest,k.onreadystatechange=g(k,a,c,i,j)}k.overrideMimeType&&k.overrideMimeType("text/xml"),k.onerror=f(i,a,k);var m=d.tryCatch(function(){k.open("GET",a,!0)});return m instanceof d.Error&&(l=!0),setTimeout(function(){if(l)return void(i&&i(a,a,k));var b=d.tryCatch(function(){k.send()});b instanceof d.Error&&i&&i(a,a,k);
},0),k},i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(57),c(47),c(48),c(46),c(58)],e=function(a,b,c,d,e){var f={};return f.repo=b.memoize(function(){var b=e.split("+")[0],d=a.repo+b+"/";return c.isHTTPS()?d.replace("http://","https://ssl."):d}),f.versionCheck=function(a){var b=("0"+a).split(/\W/),c=e.split(/\W/),d=parseFloat(b[0]),f=parseFloat(c[0]);return d>f?!1:d===f&&parseFloat("0"+b[1])>parseFloat(c[1])?!1:!0},f.loadFrom=function(){return f.repo()},f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return{repo:"http://p.jwpcdn.com/player/v/",SkinsIncluded:["seven"],SkinsLoadable:["beelden","bekle","five","glow","roundster","six","stormtrooper","vapor"]}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return"7.1.5+commercial_v7-1-5.57.commercial.9fb008.jwplayer.742351.analytics.44220f.vast.3f7507.googima.3b8231.plugins.a856bc"}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(60),c(47)],e=function(a,b,d){function e(b){d.each(b,function(c,d){b[d]=a.serialize(c)})}function f(a){return a.slice&&"px"===a.slice(-2)&&(a=a.slice(0,-2)),a}function g(b,c){if(-1===c.toString().indexOf("%"))return 0;if("string"!=typeof b||!a.exists(b))return 0;var d=b.indexOf(":");if(-1===d)return 0;var e=parseFloat(b.substr(0,d)),f=parseFloat(b.substr(d+1));return 0>=e||0>=f?0:f/e*100+"%"}var h={autostart:!1,controls:!0,cookies:!0,displaytitle:!0,displaydescription:!0,mobilecontrols:!1,repeat:!1,castAvailable:!1,skin:"seven",stretching:b.UNIFORM,mute:!1,volume:90,width:480,height:270},i=function(b){var i=d.extend({},(window.jwplayer||{}).defaults,b);e(i);var j=d.extend({},h,i);return"."===j.base&&(j.base=a.getScriptPath("jwplayer.js")),j.base=(j.base||a.loadFrom()).replace(/\/?$/,"/"),c.p=j.base,j.width=f(j.width),j.height=f(j.height),j.flashplayer=j.flashplayer||a.getScriptPath("jwplayer.js")+"jwplayer.flash.swf","http:"===window.location.protocol&&(j.flashplayer=j.flashplayer.replace("https","http")),j.aspectratio=g(j.aspectratio,j.width),d.isObject(j.skin)&&(j.skinUrl=j.skin.url,j.skinColorInactive=j.skin.inactive,j.skinColorActive=j.skin.active,j.skinColorBackground=j.skin.background,j.skin=d.isString(j.skin.name)?j.skin.name:h.skin),d.isString(j.skin)&&j.skin.indexOf(".xml")>0&&(console.log("JW Player does not support XML skins, please update your config"),j.skin=j.skin.replace(".xml","")),j.aspectratio||delete j.aspectratio,j.playlist||(j.playlist=d.clone(j)),j};return i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45),c(54)],e=function(a,b,c){var d={NONE:"none",FILL:"fill",UNIFORM:"uniform",EXACTFIT:"exactfit"},e=function(a,b,d,e,f){var g="";b=b||1,d=d||1,e=0|e,f=0|f,(1!==b||1!==d)&&(g="scale("+b+", "+d+")"),(e||f)&&(g&&(g+=" "),g="translate("+e+"px, "+f+"px)"),c.transform(a,g)},f=e,g=function(e,g,h,i,j,k){if(!g)return!1;if(!(h&&i&&j&&k))return!1;e=e||d.UNIFORM;var l=2*Math.ceil(h/2)/j,m=2*Math.ceil(i/2)/k,n="video"===g.tagName.toLowerCase(),o=!1,p="jw-stretch-"+e.toLowerCase(),q=!1;switch(e.toLowerCase()){case d.FILL:l>m?m=l:l=m,o=!0;break;case d.NONE:l=m=1;case d.EXACTFIT:o=!0;break;case d.UNIFORM:default:l>m?(j*m/h>.95?(o=!0,p="jw-stretch-exactfit"):(j*=m,k*=m),q=!0):(k*l/i>.95?(o=!0,p="jw-stretch-exactfit"):(j*=l,k*=l),q=!1),o&&(l=2*Math.ceil(h/2)/j,m=2*Math.ceil(i/2)/k)}if(n){var r={left:"",right:"",width:"",height:""};if(o?(j>h&&(r.left=r.right=Math.ceil((h-j)/2)),k>i&&(r.top=r.bottom=Math.ceil((i-k)/2)),r.width=j,r.height=k,f(g,l,m,0,0)):(o=!1,c.transform(g)),b.isIOS(8)&&o===!1){var s={width:"auto",height:"auto"};e.toLowerCase()===d.UNIFORM&&(s[q===!1?"width":"height"]="100%"),a.extend(r,s)}c.style(g,r)}else g.className=g.className.replace(/\s*jw\-stretch\-(none|exactfit|uniform|fill)/g,"")+" "+p;return o};return{scale:e,stretching:d,stretch:g}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(62),c(87),c(66),c(65),c(45),c(63),c(47)],e=function(a,b,c,d,e,f,g){function h(c){var d=c.get("provider").name||"";return d.indexOf("flash")>=0?b:a}var i={skipoffset:null,tag:null},j=function(a,b,f){function j(a,b){b=b||{},u.tag&&!b.tag&&(b.tag=u.tag),this.trigger(a,b)}function k(a){s._adModel.set("duration",a.duration),s._adModel.set("position",a.position)}function l(a){if(m&&t+1<m.length){s._adModel.set("state","buffering"),b.set("skipButton",!1),t++;var d,e=m[t];n&&(d=n[t]),this.loadItem(e,d)}else a.type===c.JWPLAYER_MEDIA_COMPLETE&&(j.call(this,a.type,a),this.trigger(c.JWPLAYER_PLAYLIST_COMPLETE,{})),this.destroy()}var m,n,o,p,q,r=h(b),s=new r(a,b),t=0,u={},v=g.bind(function(a){a=a||{},a.hasControls=!!b.get("controls"),this.trigger(c.JWPLAYER_INSTREAM_CLICK,a),s&&s._adModel&&(s._adModel.get("state")===d.PAUSED?a.hasControls&&s.instreamPlay():s.instreamPause())},this),w=g.bind(function(){s&&s._adModel&&s._adModel.get("state")===d.PAUSED&&b.get("controls")&&(a.setFullscreen(),a.play())},this);this.type="instream",this.init=function(){o=b.getVideo(),p=b.get("position"),q=b.get("playlist")[b.get("item")],s.on("all",j,this),s.on(c.JWPLAYER_MEDIA_TIME,k,this),s.on(c.JWPLAYER_MEDIA_COMPLETE,l,this),s.init(),o.detachMedia(),b.mediaModel.set("state",d.BUFFERING),a.checkBeforePlay()||0===p&&!o.checkComplete()?(p=0,b.set("preInstreamState","instream-preroll")):o&&o.checkComplete()||b.get("state")===d.COMPLETE?b.set("preInstreamState","instream-postroll"):b.set("preInstreamState","instream-midroll");var g=b.get("state");return(g===d.PLAYING||g===d.BUFFERING)&&o.pause(),f.setupInstream(s._adModel),s._adModel.set("state",d.BUFFERING),f.clickHandler().setAlternateClickHandlers(e.noop,null),this.setText("Loading ad"),this},this.loadItem=function(a,d){return e.isAndroid(2.3)?void this.trigger({type:c.JWPLAYER_ERROR,message:"Error loading instream: Cannot play instream on Android 2.3"}):(g.isArray(a)&&(m=a,n=d,a=m[t],n&&(d=n[t])),this.trigger(c.JWPLAYER_PLAYLIST_ITEM,{index:t,item:a}),u=g.extend({},i,d),s.load(a),this.addClickHandler(),void(u.skipoffset&&(s._adModel.set("skipMessage",u.skipMessage),s._adModel.set("skipText",u.skipText),s._adModel.set("skipOffset",u.skipoffset),b.set("skipButton",!0))))},this.play=function(){s.instreamPlay()},this.pause=function(){s.instreamPause()},this.hide=function(){s.hide()},this.addClickHandler=function(){f.clickHandler().setAlternateClickHandlers(v,w),s.on(c.JWPLAYER_MEDIA_META,this.metaHandler,this)},this.skipAd=function(a){var b=c.JWPLAYER_AD_SKIPPED;this.trigger(b,a),l.call(this,{type:b})},this.metaHandler=function(a){a.width&&a.height&&f.resizeMedia()},this.destroy=function(){if(this.off(),b.set("skipButton",!1),s){f.clickHandler()&&f.clickHandler().revertAlternateClickHandlers(),s.instreamDestroy(),f.destroyInstream(),s=null,a.attachMedia();var c=b.get("preInstreamState");switch(c){case"instream-preroll":case"instream-midroll":var d=g.extend({},q);d.starttime=p,b.loadVideo(d),o.play();break;case"instream-postroll":case"instream-idle":o.stop()}}},this.getState=function(){return s&&s._adModel?s._adModel.get("state"):!1},this.setText=function(a){f.setAltText(a?a:"")},this.hide=function(){f.useExternalControls()}};return g.extend(j.prototype,f),j}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(63),c(64),c(66),c(65),c(67)],e=function(a,b,c,d,e,f){var g=function(g,h){function i(){var b=m.getVideo();if(n!==b){if(n=b,!b)return;b.off(),b.on("all",function(b,c){c=a.extend({},c,{type:b}),this.trigger(b,c)},o),b.on(d.JWPLAYER_MEDIA_BUFFER_FULL,l),b.on(d.JWPLAYER_PLAYER_STATE,j),b.attachMedia(),b.mute(h.get("mute")),b.volume(h.get("volume")),m.on("change:state",c,o)}}function j(a){switch(a.newstate){case e.PLAYING:m.set("state",a.newstate);break;case e.PAUSED:m.set("state",a.newstate)}}function k(a){h.trigger(a.type,a),o.trigger(d.JWPLAYER_FULLSCREEN,{fullscreen:a.jwstate})}function l(){m.getVideo().play()}var m,n,o=a.extend(this,b);return g.on(d.JWPLAYER_FULLSCREEN,function(a){this.trigger(d.JWPLAYER_FULLSCREEN,a)},o),this.init=function(){m=(new f).setup({id:h.get("id"),volume:h.get("volume"),fullscreen:h.get("fullscreen"),mute:h.get("mute")}),m.on("fullscreenchange",k),this._adModel=m},o.load=function(a){m.setPlaylist([a]),m.setItem(0),i(),m.off(d.JWPLAYER_ERROR),m.on(d.JWPLAYER_ERROR,function(a){this.trigger(d.JWPLAYER_ERROR,a)},o),m.loadVideo()},this.instreamDestroy=function(){m&&(m.off(),this.off(),n&&(n.detachMedia(),n.off(),n.destroy()),m=null,g.off(null,null,this),g=null)},o.instreamPlay=function(){m.getVideo()&&m.getVideo().play(!0)},o.instreamPause=function(){m.getVideo()&&m.getVideo().pause(!0)},o};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=[],c=b.slice,d={on:function(a,b,c){if(!f(this,"on",a,[b,c])||!b)return this;this._events||(this._events={});var d=this._events[a]||(this._events[a]=[]);return d.push({callback:b,context:c}),this},once:function(b,c,d){if(!f(this,"once",b,[c,d])||!c)return this;var e=this,g=a.once(function(){e.off(b,g),c.apply(this,arguments)});return g._callback=c,this.on(b,g,d)},off:function(b,c,d){var e,g,h,i,j,k,l,m;if(!this._events||!f(this,"off",b,[c,d]))return this;if(!b&&!c&&!d)return this._events=void 0,this;for(i=b?[b]:a.keys(this._events),j=0,k=i.length;k>j;j++)if(b=i[j],h=this._events[b]){if(this._events[b]=e=[],c||d)for(l=0,m=h.length;m>l;l++)g=h[l],(c&&c!==g.callback&&c!==g.callback._callback||d&&d!==g.context)&&e.push(g);e.length||delete this._events[b]}return this},trigger:function(a){if(!this._events)return this;var b=c.call(arguments,1);if(!f(this,"trigger",a,b))return this;var d=this._events[a],e=this._events.all;return d&&g(d,b,this),e&&g(e,arguments,this),this}},e=/\s+/,f=function(a,b,c,d){if(!c)return!0;if("object"==typeof c){for(var f in c)a[b].apply(a,[f,c[f]].concat(d));return!1}if(e.test(c)){for(var g=c.split(e),h=0,i=g.length;i>h;h++)a[b].apply(a,[g[h]].concat(d));return!1}return!0},g=function(a,b,c){var d,e=-1,f=a.length,g=b[0],h=b[1],i=b[2];switch(b.length){case 0:for(;++e<f;)(d=a[e]).callback.call(d.context||c);return;case 1:for(;++e<f;)(d=a[e]).callback.call(d.context||c,g);return;case 2:for(;++e<f;)(d=a[e]).callback.call(d.context||c,g,h);return;case 3:for(;++e<f;)(d=a[e]).callback.call(d.context||c,g,h,i);return;default:for(;++e<f;)(d=a[e]).callback.apply(d.context||c,b);return}};return d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(65)],e=function(a){function b(b){return b===a.COMPLETE||b===a.ERROR?a.IDLE:b}return function(a,c,d){if(c=b(c),d=b(d),c!==d){var e=c.replace(/(?:ing|d)$/,""),f={type:e,newstate:c,oldstate:d,reason:a.mediaModel.get("state")};this.trigger(e,f)}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return{BUFFERING:"buffering",IDLE:"idle",COMPLETE:"complete",PAUSED:"paused",PLAYING:"playing",ERROR:"error",LOADING:"loading",STALLED:"stalled"}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a={DRAG:"drag",DRAG_START:"dragStart",DRAG_END:"dragEnd",CLICK:"click",DOUBLE_CLICK:"doubleClick",TAP:"tap",DOUBLE_TAP:"doubleTap",OVER:"over",OUT:"out"},b={COMPLETE:"complete",ERROR:"error",JWPLAYER_AD_CLICK:"adClick",JWPLAYER_AD_COMPANIONS:"adCompanions",JWPLAYER_AD_COMPLETE:"adComplete",JWPLAYER_AD_ERROR:"adError",JWPLAYER_AD_IMPRESSION:"adImpression",JWPLAYER_AD_META:"adMeta",JWPLAYER_AD_PAUSE:"adPause",JWPLAYER_AD_PLAY:"adPlay",JWPLAYER_AD_SKIPPED:"adSkipped",JWPLAYER_AD_TIME:"adTime",JWPLAYER_CAST_AD_CHANGED:"castAdChanged",JWPLAYER_MEDIA_COMPLETE:"complete",JWPLAYER_READY:"ready",JWPLAYER_MEDIA_SEEK:"seek",JWPLAYER_MEDIA_BEFOREPLAY:"beforePlay",JWPLAYER_MEDIA_BEFORECOMPLETE:"beforeComplete",JWPLAYER_MEDIA_BUFFER_FULL:"bufferFull",JWPLAYER_DISPLAY_CLICK:"displayClick",JWPLAYER_PLAYLIST_COMPLETE:"playlistComplete",JWPLAYER_CAST_SESSION:"cast",JWPLAYER_MEDIA_ERROR:"mediaError",JWPLAYER_MEDIA_FIRST_FRAME:"firstFrame",JWPLAYER_MEDIA_PLAY_ATTEMPT:"playAttempt",JWPLAYER_MEDIA_LOADED:"loaded",JWPLAYER_MEDIA_SEEKED:"seeked",JWPLAYER_SETUP_ERROR:"setupError",JWPLAYER_ERROR:"error",JWPLAYER_PLAYER_STATE:"state",JWPLAYER_CAST_AVAILABLE:"castAvailable",JWPLAYER_MEDIA_BUFFER:"bufferChange",JWPLAYER_MEDIA_TIME:"time",JWPLAYER_MEDIA_TYPE:"mediaType",JWPLAYER_MEDIA_VOLUME:"volume",JWPLAYER_MEDIA_MUTE:"mute",JWPLAYER_MEDIA_META:"meta",JWPLAYER_MEDIA_LEVELS:"levels",JWPLAYER_MEDIA_LEVEL_CHANGED:"levelsChanged",JWPLAYER_CONTROLS:"controls",JWPLAYER_FULLSCREEN:"fullscreen",JWPLAYER_RESIZE:"resize",JWPLAYER_PLAYLIST_ITEM:"playlistItem",JWPLAYER_PLAYLIST_LOADED:"playlist",JWPLAYER_AUDIO_TRACKS:"audioTracks",JWPLAYER_AUDIO_TRACK_CHANGED:"audioTrackChanged",JWPLAYER_LOGO_CLICK:"logoClick",JWPLAYER_CAPTIONS_LIST:"captionsList",JWPLAYER_CAPTIONS_CHANGED:"captionsChanged",JWPLAYER_PROVIDER_CHANGED:"providerChanged",JWPLAYER_PROVIDER_FIRST_FRAME:"providerFirstFrame",JWPLAYER_USER_ACTION:"userAction",JWPLAYER_PROVIDER_CLICK:"providerClick",JWPLAYER_VIEW_TAB_FOCUS:"tabFocus",JWPLAYER_CONTROLBAR_DRAGGING:"scrubbing",JWPLAYER_INSTREAM_CLICK:"instreamClick"};return b.touchEvents=a,b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(82),c(68),c(79),c(80),c(47),c(63),c(86),c(66),c(65)],e=function(a,b,c,d,e,f,g,h,i,j){var k=function(){function h(a,b){switch(a){case"flashBlocked":return void this.set("flashBlocked",!0);case"flashUnblocked":return void this.set("flashBlocked",!1);case"volume":case"mute":return void this.set(a,b[a]);case i.JWPLAYER_MEDIA_TYPE:this.mediaModel.set("mediaType",b.mediaType);break;case i.JWPLAYER_PLAYER_STATE:return void this.mediaModel.set("state",b.newstate);case i.JWPLAYER_MEDIA_BUFFER:this.set("buffer",b.bufferPercent);break;case i.JWPLAYER_MEDIA_BUFFER_FULL:this.playVideo();break;case i.JWPLAYER_MEDIA_TIME:this.mediaModel.set("position",b.position),this.mediaModel.set("duration",b.duration),this.set("position",b.position),this.set("duration",b.duration);break;case i.JWPLAYER_PROVIDER_CHANGED:this.set("provider",m.getName());break;case i.JWPLAYER_MEDIA_LEVELS:this.setQualityLevel(b.currentQuality,b.levels),this.mediaModel.set("levels",b.levels);break;case i.JWPLAYER_MEDIA_LEVEL_CHANGED:this.setQualityLevel(b.currentQuality,b.levels);break;case i.JWPLAYER_AUDIO_TRACKS:this.setCurrentAudioTrack(b.currentTrack,b.tracks),this.mediaModel.set("audioTracks",b.tracks);break;case i.JWPLAYER_AUDIO_TRACK_CHANGED:this.setCurrentAudioTrack(b.currentTrack,b.tracks);break;case"visualQuality":var c=f.extend({},b);this.mediaModel.set("visualQuality",c)}var d=f.extend({},b,{type:a});this.mediaController.trigger(a,d)}var k,m,n=this,o={},p=a.noop;this.mediaController=f.extend({},g),this.mediaModel=new l,this.set("mediaModel",this.mediaModel),e.model(this),this.setup=function(b){return b.cookies&&(d.model(this),o=d.getAllItems()),f.extend(this.attributes,b,o,{state:j.IDLE,flashBlocked:!1,fullscreen:!1,compactUI:!1,scrubbing:!1,duration:0,position:0,buffer:0}),a.isMobile()&&this.set("autostart",!1),this.updateProviders(),this},this.getConfiguration=function(){return f.omit(this.clone(),["mediaModel"])},this.updateProviders=function(){k=new c(this.getConfiguration())},this.setQualityLevel=function(a,b){a>-1&&b.length>1&&"youtube"!==m.getName().name&&this.mediaModel.set("currentLevel",parseInt(a))},this.setCurrentAudioTrack=function(a,b){a>-1&&b.length>1&&this.mediaModel.set("currentAudioTrack",parseInt(a))},this.changeVideoProvider=function(a){var b;m&&(m.off(null,null,this),b=m.getContainer(),b&&m.remove()),p=new a(n.get("id"),n.getConfiguration()),b&&p.setContainer(b),this.set("provider",p.getName()),m=p,m.volume(n.get("volume")),m.mute(n.get("mute")),m.on("all",h,this)},this.destroy=function(){m&&(m.off(null,null,this),m.destroy())},this.getVideo=function(){return m},this.setFullscreen=function(a){a=!!a,a!==n.get("fullscreen")&&n.set("fullscreen",a)},this.setPlaylist=function(a){var c=b(a);return c=b.filterPlaylist(c,k,n.get("androidhls"),this.get("drm")),this.set("playlist",c),0===c.length?void this.mediaController.trigger(i.JWPLAYER_ERROR,{message:"Error loading playlist: No playable sources found"}):void 0},this.chooseProvider=function(a){return k.choose(a).provider},this.setItem=function(a){var b=n.get("playlist"),c=(a+b.length)%b.length;this.mediaModel.off(),this.mediaModel=new l,this.set("mediaModel",this.mediaModel),this.set("item",c);var d=this.get("playlist")[c];this.set("playlistItem",d);var e=d&&d.sources&&d.sources[0];if(void 0!==e){var f=this.chooseProvider(e);if(!f)throw new Error("No suitable provider found");p instanceof f||n.changeVideoProvider(f),p.init&&p.init(d),this.trigger("setItem")}},this.resetProvider=function(){p=null},this.setVolume=function(a){a=Math.round(a),n.set("volume",a),m&&m.volume(a);var b=0===a;b!==n.get("mute")&&n.setMute(b)},this.setMute=function(b){if(a.exists(b)||(b=!n.get("mute")),n.set("mute",b),m&&m.mute(b),!b){var c=Math.max(10,n.get("volume"));this.setVolume(c)}},this.loadVideo=function(a){if(this.mediaController.trigger(i.JWPLAYER_MEDIA_PLAY_ATTEMPT),!a){var b=this.get("item");a=this.get("playlist")[b]}this.set("position",a.starttime||0),this.set("duration",a.duration||0),m.load(a)},this.playVideo=function(){m.play()},this.setVideoSubtitleTrack=function(a){this.set("captionsIndex",a),m.setSubtitlesTrack&&m.setSubtitlesTrack(a)}},l=k.MediaModel=function(){this.set("state",j.IDLE)};return f.extend(k.prototype,h),f.extend(l.prototype,h),k}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(69)],e=function(a){return a.prototype.providerSupports=function(a,b){return a.supports(b,this.config.edition)},a}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(70),c(74),c(47)],e=function(a,b,c){function d(b){this.providers=a.slice(),this.config=b||{},"flash"===this.config.primary&&f(this.providers,"html5","flash")}function e(a,b){for(var c=0;c<a.length;c++)if(a[c].name===b)return c;return-1}function f(a,b,c){var d=e(a,b),f=e(a,c),g=a[d];a[d]=a[f],a[f]=g}return c.extend(d.prototype,{providerSupports:function(a,b){return a.supports(b)},choose:function(a){a=c.isObject(a)?a:{};for(var d=this.providers.length,e=0;d>e;e++){var f=this.providers[e];if(this.providerSupports(f,a)){var g=d-e-1;return{priority:g,name:f.name,type:a.type,provider:b[f.name]}}}return null}}),d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(71),c(47),c(72)],e=function(a,b,c,d){var e=c.find(d,c.matches({name:"flash"})),f=e.supports;return e.supports=function(c,d){if(!a.isFlashSupported())return!1;var e=c&&c.type;if("hls"===e||"m3u8"===e){var g=b(d);return g("hls")}return f.apply(this,arguments)},d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b={setup:["free","premium","enterprise","ads","trial"],"custom-rightclick":["premium","enterprise","ads","trial"],dash:["premium","enterprise","ads","trial"],drm:["enterprise","ads","trial"],hls:["premium","ads","enterprise","trial"],ads:["ads","trial"],casting:["premium","enterprise","ads","trial"]},c=function(c){return function(d){return a.contains(b[d],c)}};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(47),c(73)],e=function(a,b,c){function d(b){if("hls"===b.type)if(b.androidhls!==!1){var c=a.isAndroidNative;if(c(2)||c(3)||c("4.0"))return!1;if(a.isAndroid())return!0}else if(a.isAndroid())return!1;return null}var e=[{name:"youtube",supports:function(b){return a.isYouTube(b.file,b.type)}},{name:"html5",supports:function(b){var e={aac:"audio/mp4",mp4:"video/mp4",f4v:"video/mp4",m4v:"video/mp4",mov:"video/mp4",mp3:"audio/mpeg",mpeg:"audio/mpeg",ogv:"video/ogg",ogg:"video/ogg",oga:"video/ogg",vorbis:"video/ogg",webm:"video/webm",f4a:"video/aac",m3u8:"application/vnd.apple.mpegurl",m3u:"application/vnd.apple.mpegurl",hls:"application/vnd.apple.mpegurl"},f=b.file,g=b.type,h=d(b);if(null!==h)return h;if(a.isRtmp(f,g))return!1;if(!e[g])return!1;if(c.canPlayType){var i=c.canPlayType(e[g]);return!!i}return!1}},{name:"flash",supports:function(c){var d={flv:"video",f4v:"video",mov:"video",m4a:"video",m4v:"video",mp4:"video",aac:"video",f4a:"video",mp3:"sound",mpeg:"sound",smil:"rtmp"},e=b.keys(d);if(!a.isFlashSupported())return!1;var f=c.file,g=c.type;return a.isRtmp(f,g)?!0:b.contains(e,g)}}];return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return document.createElement("video")}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(75),c(77)],e=function(a,b){var c={html5:a,flash:b};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(54),c(45),c(60),c(47),c(66),c(65),c(76),c(63)],e=function(a,b,c,d,e,f,g,h){function i(a,c){b.foreach(a,function(a,b){c.addEventListener(a,b,!1)})}function j(a,c){b.foreach(a,function(a,b){c.removeEventListener(a,b,!1)})}function k(a){if("hls"===a.type)if(a.androidhls!==!1){var c=b.isAndroidNative;if(c(2)||c(3)||c("4.0"))return!1;if(b.isAndroid())return!0}else if(b.isAndroid())return!1;return null}function l(g,l){function v(a){$.trigger("click",a)}function w(){if(fa){var a=la.duration;W!==a&&(W=a),s&&ba>0&&a>ba&&$.seek(ba),x()}}function x(a){B(a),fa&&($.state===f.PLAYING&&(ea=d.now(),X=la.currentTime,a&&(aa=!0),$.trigger(e.JWPLAYER_MEDIA_TIME,{position:X,duration:W})),$.state===f.STALLED&&$.setState(f.PLAYING))}function y(){$.trigger(e.JWPLAYER_MEDIA_META,{duration:la.duration,height:la.videoHeight,width:la.videoWidth})}function z(){fa&&(aa||(aa=!0,C()))}function A(){fa&&(z(),la.muted&&(la.muted=!1,la.muted=!0),y())}function B(){aa&&ba>0&&!s&&(p?setTimeout(function(){ba>0&&$.seek(ba)},200):$.seek(ba))}function C(){Y||(Y=!0,$.trigger(e.JWPLAYER_MEDIA_BUFFER_FULL))}function D(){fa&&(ea=d.now(),$.setState(f.PLAYING),$.trigger(e.JWPLAYER_PROVIDER_FIRST_FRAME,{}))}function E(){fa&&(ha||la.paused||la.ended||$.state!==f.LOADING&&($.seeking||$.setState(f.STALLED)))}function F(){fa&&(b.log("Error playing media: %o %s",la.error,la.src||V.file),$.trigger(e.JWPLAYER_MEDIA_ERROR,{message:"Error loading media: File could not be played"}))}function G(a){var c;return"array"===b.typeOf(a)&&a.length>0&&(c=d.map(a,function(a,b){return{label:a.label||b}})),c}function H(a){Z=a,ga=I(a);var b=G(a);b&&$.trigger(e.JWPLAYER_MEDIA_LEVELS,{levels:b,currentQuality:ga})}function I(a){var b=Math.max(0,ga),c=l.qualityLabel;if(a)for(var d=0;d<a.length;d++)if(a[d]["default"]&&(b=d),c&&a[d].label===c)return d;return b}function J(){return q||r}function K(a,c){V=Z[ga],m(ca),ca=setInterval(N,o),ba=0;var d=la.src!==V.file;d||J()?(q||$.setState(f.LOADING),aa=!1,Y=!1,W=c,ha=k(V),la.src=V.file,la.load()):(0===a&&(ba=-1,$.seek(a)),y(),la.play()),X=la.currentTime,q&&C(),b.isIOS()&&$.getFullScreen()&&(la.controls=!0),a>0&&$.seek(a)}function L(){$.seeking=!1,$.trigger(e.JWPLAYER_MEDIA_SEEKED)}function M(){$.trigger("volume",{volume:Math.round(100*la.volume)}),$.trigger("mute",{mute:la.muted})}function N(){if(fa){var a=O();a!==da&&(da=a,$.trigger(e.JWPLAYER_MEDIA_BUFFER,{bufferPercent:100*a}));var b=la.currentTime;b===X?d.now()-ea>n&&E():(ea=d.now(),X=b)}}function O(){var a=la.buffered,c=la.duration;return!a||0===a.length||0>=c||c===1/0?0:b.between(a.end(a.length-1)/c,0,1)}function P(){if(fa&&$.state!==f.IDLE&&$.state!==f.COMPLETE){if(m(ca),ga=-1,ia=!0,$.trigger(e.JWPLAYER_MEDIA_BEFORECOMPLETE),!fa)return;Q()}}function Q(){$.setState(f.COMPLETE),ia=!1,$.trigger(e.JWPLAYER_MEDIA_COMPLETE)}function R(a){ja=!0,T(a),b.isIOS()&&(la.controls=!1)}function S(a){ja=!1,T(a),b.isIOS()&&(la.controls=!1)}function T(a){$.trigger("fullscreenchange",{target:a.target,jwstate:ja})}this.state=f.IDLE,this.seeking=!1,d.extend(this,h),this.trigger=function(a,b){return fa?h.trigger.call(this,a,b):void 0};var U,V,W,X,Y,Z,$=this,_={click:v,durationchange:w,ended:P,error:F,loadedmetadata:A,canplay:z,playing:D,progress:B,seeked:L,timeupdate:x,volumechange:M,webkitbeginfullscreen:R,webkitendfullscreen:S},aa=!1,ba=0,ca=-1,da=-1,ea=-1,fa=!0,ga=-1,ha=null,ia=!1,ja=!1,ka=document.getElementById(g),la=ka?ka.querySelector("video"):void 0;la=la||document.createElement("video"),la.className="jw-video jw-reset",i(_,la),t||(la.controls=!0,la.controls=!1),la.setAttribute("x-webkit-airplay","allow"),la.setAttribute("webkit-playsinline",""),this.stop=function(){fa&&(m(ca),la.removeAttribute("src"),p||la.load(),ga=-1,this.setState(f.IDLE))},this.destroy=function(){j(_,la),this.remove(),this.off()},this.load=function(a){fa&&(H(a.sources),this.sendMediaType(a.sources),K(a.starttime||0,a.duration||0))},this.play=function(){return $.seeking?($.setState(f.LOADING),void $.once(e.JWPLAYER_MEDIA_SEEKED,$.play)):void la.play()},this.pause=function(){la.pause(),this.setState(f.PAUSED)},this.seek=function(a){if(fa)if(0===ba&&this.trigger(e.JWPLAYER_MEDIA_SEEK,{position:la.currentTime,offset:a}),aa){ba=0;var c=b.tryCatch(function(){$.seeking=!0,la.currentTime=a});c instanceof b.Error&&(ba=a)}else ba=a},this.volume=function(a){a=b.between(a/100,0,1),la.volume=a},this.mute=function(a){la.muted=!!a},this.checkComplete=function(){return ia},this.detachMedia=function(){return m(ca),fa=!1,la},this.attachMedia=function(a){fa=!0,a||(aa=!1),la.loop=!1,ia&&Q()},this.setContainer=function(a){U=a,a.appendChild(la)},this.getContainer=function(){return U},this.remove=function(){la&&(la.removeAttribute("src"),p||la.load()),m(ca),ga=-1,U===la.parentNode&&U.removeChild(la)},this.setVisibility=function(b){b=!!b,b||s?a.style(U,{visibility:"visible",opacity:1}):a.style(U,{visibility:"",opacity:0})},this.resize=function(a,b,d){return c.stretch(d,la,a,b,la.videoWidth,la.videoHeight)},this.setFullscreen=function(a){if(a=!!a){var c=b.tryCatch(function(){var a=la.webkitEnterFullscreen||la.webkitEnterFullScreen;a&&a.apply(la)});return c instanceof b.Error?!1:$.getFullScreen()}var d=la.webkitExitFullscreen||la.webkitExitFullScreen;return d&&d.apply(la),a},$.getFullScreen=function(){return ja||!!la.webkitDisplayingFullscreen},this.setCurrentQuality=function(a){if(ga!==a&&(a=parseInt(a,10),a>=0&&Z&&Z.length>a)){ga=a,this.trigger(e.JWPLAYER_MEDIA_LEVEL_CHANGED,{currentQuality:a,levels:G(Z)});var b=la.currentTime||0,c=la.duration;0>=c&&(c=W),K(b,c||0)}},this.getCurrentQuality=function(){return ga},this.getQualityLevels=function(){return G(Z)},this.getName=function(){return{name:u}}}var m=window.clearInterval,n=256,o=100,p=b.isMSIE(),q=b.isMobile(),r=b.isSafari(),s=b.isAndroidNative(),t=b.isIOS(7),u="html5",v=function(){};return v.prototype=g,l.prototype=new v,l}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(66),c(65),c(47)],e=function(a,b,c,d){var e=a.noop,f=d.constant(!1),g={supports:f,play:e,load:e,stop:e,volume:e,mute:e,seek:e,resize:e,remove:e,destroy:e,setVisibility:e,setFullscreen:f,getFullscreen:e,getContainer:e,setContainer:f,getName:e,getQualityLevels:e,getCurrentQuality:e,setCurrentQuality:e,getAudioTracks:e,getCurrentAudioTrack:e,setCurrentAudioTrack:e,checkComplete:e,setControls:e,attachMedia:e,detachMedia:e,setState:function(a){var d=this.state||c.IDLE;this.state=a,a!==d&&this.trigger(b.JWPLAYER_PLAYER_STATE,{newstate:a})},sendMediaType:function(a){var c=a[0].type,d="oga"===c||"aac"===c||"mp3"===c||"mpeg"===c||"vorbis"===c;this.trigger(b.JWPLAYER_MEDIA_TYPE,{mediaType:d?"audio":"video"})}};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(47),c(66),c(65),c(78),c(76),c(63)],e=function(a,b,c,d,e,f,g){function h(a){return a+"_swf_"+j++}function i(i,j){function k(a){if(B)for(var b=0;b<a.length;b++){var c=a[b];if(c.bitrate){var d=Math.round(c.bitrate/1024);c.label=l(d)}}}function l(a){var b=B[a];if(!b){for(var c=1/0,d=B.bitrates.length;d--;){var e=Math.abs(B.bitrates[d]-a);if(e>c)break;c=e}b=B.labels[B.bitrates[d+1]],B[a]=b}return b}function m(){var a=j.hlslabels;if(!a)return null;var b={},c=[];for(var d in a){var e=parseFloat(d);if(!isNaN(e)){var f=Math.round(e);b[f]=a[d],c.push(f)}}return 0===c.length?null:(c.sort(function(a,b){return a-b}),{labels:b,bitrates:c})}var n,o,p,q=null,r=-1,s=!1,t=-1,u=null,v=-1,w=null,x=!0,y=!1,z=function(){return o&&o.__ready},A=function(){o&&o.triggerFlash.apply(o,arguments)},B=m();b.extend(this,g,{load:function(a){q=a,s=!1,this.setState(d.LOADING),A("load",a),this.sendMediaType(a.sources)},play:function(){A("play")},pause:function(){A("pause"),this.setState(d.PAUSED)},stop:function(){A("stop"),t=-1,q=null,this.setState(d.IDLE)},seek:function(a){A("seek",a)},volume:function(a){if(b.isNumber(a)){var c=Math.min(Math.max(0,a),100);z()&&A("volume",c)}},mute:function(a){z()&&A("mute",a)},setState:function(){return f.setState.apply(this,arguments)},checkComplete:function(){return s},attachMedia:function(){x=!0,s&&(this.setState(d.COMPLETE),this.trigger(c.JWPLAYER_MEDIA_COMPLETE),s=!1)},detachMedia:function(){return x=!1,null},getSwfObject:function(a){var b=a.getElementsByTagName("object")[0];return b?(b.off(null,null,this),b):e.embed(j.flashplayer,a,h(i))},getContainer:function(){return n},setContainer:function(e){function f(a){clearTimeout(r),"resume"===a.state?g.trigger.call(h,"flashUnblocked"):r=setTimeout(function(){g.trigger.call(h,"flashBlocked")},250)}if(n!==e){n=e,o=this.getSwfObject(e);var h=this;r=setTimeout(function(){g.trigger.call(h,"flashBlocked")},2e3),o.once("embedded",function(){clearTimeout(r),g.trigger.call(h,"flashUnblocked")},this),o.once("ready",function(){o.once("pluginsLoaded",function(){o.queueCommands=!1,A("setupCommandQueue",o.__commandQueue),o.__commandQueue=[]});var a=b.extend({},j);A("setup",a),o.__ready=!0},this);var i=[c.JWPLAYER_MEDIA_META,c.JWPLAYER_MEDIA_ERROR,"subtitlesTracks","subtitlesTrackChanged","subtitlesTrackData"],l=[c.JWPLAYER_MEDIA_BUFFER,c.JWPLAYER_MEDIA_TIME],m=[c.JWPLAYER_MEDIA_BUFFER_FULL];o.on(c.JWPLAYER_MEDIA_LEVELS,function(a){k(a.levels),t=a.currentQuality,u=a.levels,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_MEDIA_LEVEL_CHANGED,function(a){k(a.levels),t=a.currentQuality,u=a.levels,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_AUDIO_TRACKS,function(a){v=a.currentTrack,w=a.tracks,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_AUDIO_TRACK_CHANGED,function(a){v=a.currentTrack,w=a.tracks,this.trigger(a.type,a)},this),o.on(c.JWPLAYER_PLAYER_STATE,function(a){var b=a.newstate;b!==d.IDLE&&this.setState(b)},this),o.on(l.join(" "),function(a){"Infinity"===a.duration&&(a.duration=1/0),this.trigger(a.type,a)},this),o.on(i.join(" "),function(a){this.trigger(a.type,a)},this),o.on(m.join(" "),function(a){this.trigger(a.type)},this),o.on(c.JWPLAYER_MEDIA_BEFORECOMPLETE,function(a){s=!0,this.trigger(a.type),x===!0&&(s=!1)},this),o.on(c.JWPLAYER_MEDIA_COMPLETE,function(a){s||(this.setState(d.COMPLETE),this.trigger(a.type))},this),o.on(c.JWPLAYER_MEDIA_SEEK,function(a){this.trigger(c.JWPLAYER_MEDIA_SEEK,a)},this),o.on("visualQuality",function(a){a.reason=a.reason||"api",this.trigger("visualQuality",a),this.trigger(c.JWPLAYER_PROVIDER_FIRST_FRAME,{})},this),o.on(c.JWPLAYER_PROVIDER_CHANGED,function(a){p=a.message,this.trigger(c.JWPLAYER_PROVIDER_CHANGED,a)},this),o.on(c.JWPLAYER_ERROR,function(b){a.log("Error playing media: %o %s",b.code,b.message,b),this.trigger(c.JWPLAYER_MEDIA_ERROR,b)},this),a.isChrome()&&o.on("throttle",f,this)}},remove:function(){t=-1,u=null,e.remove(o)},setVisibility:function(a){a=!!a,n.style.opacity=a?1:0},resize:function(a,b,c){c&&A("stretch",c)},setControls:function(a){A("setControls",a)},setFullscreen:function(a){y=a,A("fullscreen",a)},getFullScreen:function(){return y},setCurrentQuality:function(a){A("setCurrentQuality",a)},getCurrentQuality:function(){return t},setSubtitlesTrack:function(a){A("setSubtitlesTrack",a)},getName:function(){return p?{name:"flash_"+p}:{name:"flash"}},getQualityLevels:function(){return u||q.sources},getAudioTracks:function(){return w},getCurrentAudioTrack:function(){return v},setCurrentAudioTrack:function(a){A("setCurrentAudioTrack",a)},destroy:function(){this.remove(),o&&(o.off(),o=null),n=null,q=null,this.off()}}),this.trigger=function(a,b){return x?g.trigger.call(this,a,b):void 0}}var j=0,k=function(){};return k.prototype=f,i.prototype=new k,i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){
var d,e;d=[c(45),c(63),c(47)],e=function(a,b,c){function d(a,b,c){var d=document.createElement("param");d.setAttribute("name",b),d.setAttribute("value",c),a.appendChild(d)}function e(e,f,h,i){var j;if(i=i||"opaque",a.isMSIE()){var k=document.createElement("div");f.appendChild(k),k.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="'+h+'" name="'+h+'" tabindex="0"><param name="movie" value="'+e+'"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="wmode" value="'+i+'"><param name="bgcolor" value="'+g+'"><param name="menu" value="false"></object>';for(var l=f.getElementsByTagName("object"),m=l.length;m--;)l[m].id===h&&(j=l[m])}else j=document.createElement("object"),j.setAttribute("type","application/x-shockwave-flash"),j.setAttribute("data",e),j.setAttribute("width","100%"),j.setAttribute("height","100%"),j.setAttribute("bgcolor",g),j.setAttribute("id",h),j.setAttribute("name",h),d(j,"allowfullscreen","true"),d(j,"allowscriptaccess","always"),d(j,"wmode",i),d(j,"menu","false"),f.appendChild(j,f);return j.className="jw-swf jw-reset",j.style.display="block",j.style.position="absolute",j.style.left=0,j.style.right=0,j.style.top=0,j.style.bottom=0,c.extend(j,b),j.queueCommands=!0,j.triggerFlash=function(b){var c=this;if("setup"!==b&&c.queueCommands||!c.__externalCall){for(var d=c.__commandQueue,e=d.length;e--;)d[e][0]===b&&d.splice(e,1);return d.push(Array.prototype.slice.call(arguments)),c}var f=Array.prototype.slice.call(arguments,1),g=a.tryCatch(function(){if(f.length){var a=JSON.stringify(f);c.__externalCall(b,a)}else c.__externalCall(b)});return g instanceof a.Error&&console.error({command:b,error:g}),c},j.__commandQueue=[],j}function f(a){a&&a.parentNode&&(a.style.display="none",a.parentNode.removeChild(a))}var g="#000000";return{embed:e,remove:f}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45)],e=function(a,b){function c(){for(var a={},c=document.cookie.split("; "),d=0;d<c.length;d++){var e=c[d].split("=");if("jwplayer."===e[0].substr(0,9)){var f=e[0].substr(9);a[f]=b.serialize(e[1])}}return a}function d(a){return c()[a]}function e(a,b){document.cookie="jwplayer."+a+"="+b+"; path=/"}function f(a){e(a,"; expires=Thu, 01 Jan 1970 00:00:01 GMT")}function g(){var b=c();a.each(b,function(a,b){f(b)})}function h(b){a.each(i,function(a){b.on("change:"+a,function(b,c){e(a,c)})})}var i=["volume","mute","captionLabel","qualityLabel"];return{model:h,getAllItems:c,getItem:d,setItem:e,removeItem:f,clear:g}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(81),c(66),c(47)],e=function(a,b,c){function d(a){a.mediaController.off(b.JWPLAYER_MEDIA_PLAY_ATTEMPT,a._onPlayAttempt),a.mediaController.off(b.JWPLAYER_PROVIDER_FIRST_FRAME,a._triggerFirstFrame),a.mediaController.off(b.JWPLAYER_MEDIA_TIME,a._onTime)}function e(a){d(a),a._triggerFirstFrame=c.once(function(){var c=a._qoeItem;c.tick(b.JWPLAYER_MEDIA_FIRST_FRAME);var e=c.between(b.JWPLAYER_MEDIA_PLAY_ATTEMPT,b.JWPLAYER_MEDIA_FIRST_FRAME);a.mediaController.trigger(b.JWPLAYER_MEDIA_FIRST_FRAME,{loadTime:e}),d(a)}),a._onTime=g(a._triggerFirstFrame),a._onPlayAttempt=function(){a._qoeItem.tick(b.JWPLAYER_MEDIA_PLAY_ATTEMPT)},a.mediaController.once(b.JWPLAYER_MEDIA_PLAY_ATTEMPT,a._onPlayAttempt),a.mediaController.once(b.JWPLAYER_PROVIDER_FIRST_FRAME,a._triggerFirstFrame),a.mediaController.on(b.JWPLAYER_MEDIA_TIME,a._onTime)}function f(c){c.on("change:mediaModel",function(c,d,f){c._qoeItem&&c._qoeItem.end(f.get("state")),c._qoeItem=new a,c._qoeItem.tick(b.JWPLAYER_PLAYLIST_ITEM),c._qoeItem.start(d.get("state")),e(c),d.on("change:state",function(a,b,d){c._qoeItem.end(d),c._qoeItem.start(b)})})}var g=function(a){var b=Number.MIN_VALUE;return function(c){c.position>b&&a(),b=c.position}};return{model:f}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=function(){var b={},c={},d={},e={};return{start:function(c){b[c]=a.now(),d[c]=d[c]+1||1},end:function(d){if(b[d]){var e=a.now()-b[d];c[d]=c[d]+e||e}},dump:function(){return{counts:d,sums:c,events:e}},tick:function(b,c){e[b]=c||a.now()},between:function(a,b){return e[b]&&e[a]?e[b]-e[a]:-1}}};return b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(83),c(84),c(47),c(68)],e=function(a,b,c,d){function e(a,b){for(var c=0;c<a.length;c++){var d=a[c],e=b.choose(d);if(e)return d.type}return null}var f=function(b){return b=c.isArray(b)?b:[b],c.compact(c.map(b,a))};f.filterPlaylist=function(a,b,d,e){var f=[];return c.each(a,function(a){a=c.extend({},a),a.sources=g(a.sources,b,d,a.drm||e),a.sources.length&&(a.file=a.sources[0].file,f.push(a))}),f};var g=f.filterSources=function(a,f,g,h){f&&f.choose||(f=new d({primary:f?"flash":null})),a=c.compact(c.map(a,function(a){return c.isObject(a)?(g&&(a.androidhls=g),(a.drm||h)&&(a.drm=a.drm||h),b(a)):void 0}));var i=e(a,f);return c.where(a,{type:i})};return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(84),c(85)],e=function(a,b,c){var d={sources:[],tracks:[]},e=function(e){e=e||{},a.isArray(e.tracks)||delete e.tracks;var f=a.extend({},d,e);a.isObject(f.sources)&&!a.isArray(f.sources)&&(f.sources=[b(f.sources)]),a.isArray(f.sources)&&0!==f.sources.length||(e.levels?f.sources=e.levels:f.sources=[b(e)]);for(var g=0;g<f.sources.length;g++){var h=f.sources[g];if(h){var i=h["default"];i?h["default"]="true"===i.toString():h["default"]=!1,f.sources[g].label||(f.sources[g].label=g.toString()),f.sources[g]=b(f.sources[g])}}return f.sources=a.compact(f.sources),a.isArray(f.tracks)||(f.tracks=[]),a.isArray(f.captions)&&(f.tracks=f.tracks.concat(f.captions),delete f.captions),f.tracks=a.compact(a.map(f.tracks,c)),f};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(50),c(47)],e=function(a,b,c){var d={"default":!1},e=function(e){if(e&&e.file){var f=c.extend({},d,e);f.file=b.trim(""+f.file);var g=/^[^\/]+\/(?:x-)?([^\/]+)$/;if(g.test(f.type)&&(f.type=f.type.replace(g,"$1")),!f.type)if(a.isYouTube(f.file))f.type="youtube";else if(a.isRtmp(f.file))f.type="rtmp";else{var h=b.extension(f.file);f.type=h}if(f.type)return"m3u8"===f.type&&(f.type="hls"),"smil"===f.type&&(f.type="rtmp"),"m4a"===f.type&&(f.type="aac"),c.each(f,function(a,b){""===a&&delete f[b]}),f}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b={kind:"captions","default":!1},c=function(c){return c&&c.file?a.extend({},b,c):void 0};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(63)],e=function(a,b){var c=a.extend({get:function(a){return this.attributes=this.attributes||{},this.attributes[a]},set:function(a,b){if(this.attributes=this.attributes||{},this.attributes[a]!==b){var c=this.attributes[a];this.attributes[a]=b,this.trigger("change:"+a,this,b,c)}},clone:function(){return a.clone(this.attributes)}},b);return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(63),c(67),c(64),c(66),c(65),c(47)],e=function(a,b,c,d,e,f){var g=function(a,d){this.model=d,this._adModel=(new b).setup({id:d.get("id"),volume:d.get("volume"),fullscreen:d.get("fullscreen"),mute:d.get("mute")}),this._adModel.on("change:state",c,this);var e=a.getContainer();this.swf=e.querySelector("object")};return g.prototype=f.extend({init:function(){this.swf.on("instream:state",function(a){switch(a.newstate){case e.PLAYING:this._adModel.set("state",a.newstate);break;case e.PAUSED:this._adModel.set("state",a.newstate)}},this).on("instream:time",function(a){this._adModel.set("position",a.position),this._adModel.set("duration",a.duration),this.trigger(d.JWPLAYER_MEDIA_TIME,a)},this).on("instream:complete",function(a){this.trigger(d.JWPLAYER_MEDIA_COMPLETE,a)},this).on("instream:error",function(a){this.trigger(d.JWPLAYER_MEDIA_ERROR,a)},this),this.swf.triggerFlash("instream:init")},instreamDestroy:function(){this._adModel&&(this.off(),this.swf.off(null,null,this),this.swf.triggerFlash("instream:destroy"),this.swf=null,this._adModel.off(),this._adModel=null,this.model=null)},load:function(a){this.swf.triggerFlash("instream:load",a)},instreamPlay:function(){this.swf.triggerFlash("instream:play")},instreamPause:function(){this.swf.triggerFlash("instream:pause")}},a),g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(89),c(63),c(47),c(66)],e=function(a,b,c,d){var e=function(b,e,f,g){function h(){m("Setup Timeout Error","Setup took longer than "+g+" seconds to complete.")}function i(){c.each(p,function(a){a.complete!==!0&&a.running!==!0&&null!==b&&k(a.depends)&&(a.running=!0,j(a))})}function j(a){var c=function(b){b=b||{},l(a,b)};a.method(c,e,b,f)}function k(a){return c.all(a,function(a){return p[a].complete})}function l(a,b){"error"===b.type?m(b.msg,b.reason):"complete"===b.type?(clearTimeout(n),o.trigger(d.JWPLAYER_READY)):(a.complete=!0,i())}function m(a,b){clearTimeout(n),o.trigger(d.JWPLAYER_SETUP_ERROR,{message:a+": "+b}),o.destroy()}var n,o=this,p=a.getQueue();g=g||10,this.start=function(){n=setTimeout(h,1e3*g),i()},this.destroy=function(){clearTimeout(n),this.off(),p.length=0,b=null,e=null,f=null}};return e.prototype=b,e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(90),c(71),c(47),c(45),c(92)],e=function(a,b,d,e,f){function g(a,b,c){if(b){var d=b.client;delete b.client,/\.(js|swf)$/.test(d||"")||(d=e.repo()+c),a[d]=b}}function h(a,c){var f=d.clone(c.get("plugins"))||{},h=c.get("edition"),i=b(h),j=/\.(js|swf)$/,k=e.repo(),l=c.get("advertising");i("ads")&&l&&(j.test(l.client)?f[l.client]=l:f[k+l.client+".js"]=l,delete l.client);var m=c.get("analytics");d.isObject(m)||(m={}),g(f,m,"jwpsrv.js"),g(f,c.get("ga"),"gapro.js"),g(f,c.get("sharing"),"sharing.js"),g(f,c.get("related"),"related.js"),c.set("plugins",f),a()}function i(b,c){var d=c.get("key")||window.jwplayer&&window.jwplayer.key,e=new a(d),g=e.edition();c.set("key",d),c.set("edition",g),c.updateProviders(),"invalid"===g?f.error(b,"Error setting up player",(void 0===d?"Missing":"Invalid")+" license key"):b()}function j(a,b){var d=b.get("dash");"dashjs"===d?c.e(3,function(d){var e=c(106);e.register(window.jwplayer),b.updateProviders(),a()}):d?c.e(4,function(d){var e=c(108);e.register(window.jwplayer),b.updateProviders(),a()}):a()}function k(){var a=f.getQueue();return a.LOAD_PLAYLIST.depends.push("LOAD_PROVIDERS"),a.LOAD_PROVIDERS={method:j,depends:[]},a.LOAD_PROVIDERS.depends.push("CHECK_KEY"),a.CHECK_KEY={method:i,depends:["LOAD_POLYFILLS"]},a.FILTER_PLUGINS={method:h,depends:["CHECK_KEY"]},a.LOAD_PLUGINS.depends.push("CHECK_KEY"),a.LOAD_PLUGINS.depends.push("FILTER_PLUGINS"),a}return{getQueue:k}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(91),c(71)],e=function(a,b,c){var d="invalid",e="RnXcsftYjWRDA^Uy",f=function(f){function g(f){a.exists(f)||(f="");try{f=b.decrypt(f,e);var g=f.split("/");h=g[0],"pro"===h&&(h="premium");var k=c(h);if(g.length>2&&k("setup")){i=g[1];var l=parseInt(g[2]);l>0&&(j=new Date,j.setTime(l))}else h=d}catch(m){h=d}}var h,i,j;this.edition=function(){return j&&j.getTime()<(new Date).getTime()?d:h},this.token=function(){return i},this.expiration=function(){return j},g(f)};return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){var a=function(a){return window.atob(a)},b=function(a){return unescape(encodeURIComponent(a))},c=function(a){try{return decodeURIComponent(escape(a))}catch(b){return a}},d=function(a){for(var b=new Array(Math.ceil(a.length/4)),c=0;c<b.length;c++)b[c]=a.charCodeAt(4*c)+(a.charCodeAt(4*c+1)<<8)+(a.charCodeAt(4*c+2)<<16)+(a.charCodeAt(4*c+3)<<24);return b},e=function(a){for(var b=new Array(a.length),c=0;c<a.length;c++)b[c]=String.fromCharCode(255&a[c],a[c]>>>8&255,a[c]>>>16&255,a[c]>>>24&255);return b.join("")};return{decrypt:function(f,g){if(f=String(f),g=String(g),0==f.length)return"";for(var h,i,j=d(a(f)),k=d(b(g).slice(0,16)),l=j.length,m=j[l-1],n=j[0],o=2654435769,p=Math.floor(6+52/l),q=p*o;0!=q;){i=q>>>2&3;for(var r=l-1;r>=0;r--)m=j[r>0?r-1:l-1],h=(m>>>5^n<<2)+(n>>>3^m<<4)^(q^n)+(k[3&r^i]^m),n=j[r]-=h;q-=o}var s=e(j);return s=s.replace(/\0+$/,""),c(s)}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(93),c(99),c(96),c(57),c(47),c(45),c(66)],e=function(a,b,d,e,f,g,h){function i(){var a={LOAD_POLYFILLS:{method:j,depends:[]},LOAD_PLUGINS:{method:k,depends:["LOAD_POLYFILLS"]},LOAD_YOUTUBE:{method:u,depends:["LOAD_PLAYLIST"]},LOAD_SKIN:{method:t,depends:[]},LOAD_PLAYLIST:{method:o,depends:["LOAD_PLUGINS"]},SETUP_COMPONENTS:{method:v,depends:["LOAD_PLAYLIST","LOAD_SKIN","LOAD_YOUTUBE"]},SEND_READY:{method:w,depends:["LOAD_PLUGINS","SETUP_COMPONENTS"]}};return a}function j(a){window.btoa&&window.atob?a():c.e(1,function(b){c(104),a()})}function k(b,c,d){y=a.loadPlugins(c.get("id"),c.get("plugins")),y.on(h.COMPLETE,f.partial(l,b,c,d)),y.on(h.ERROR,f.partial(n,b)),y.load()}function l(a,b,c){y.setupPlugins(c,b,f.partial(m,c)),a()}function m(a,b,c,d){var e=a.id;return function(){var a=document.querySelector("#"+e+" .jw-overlays");a&&d&&a.appendChild(c),"function"==typeof b.resize&&(b.resize(a.clientWidth,a.clientHeight),setTimeout(function(){b.resize(a.clientWidth,a.clientHeight)},400)),a&&a.style&&(c.left=a.style.left,c.top=a.style.top)}}function n(a,b){x(a,"Could not load plugin",b.message)}function o(a,c){var d=c.get("playlist");f.isString(d)?(z=new b,z.on(h.JWPLAYER_PLAYLIST_LOADED,function(b){p(a,c,b.playlist)}),z.on(h.JWPLAYER_ERROR,f.partial(q,a)),z.load(d)):p(a,c,d)}function p(a,b,c){b.setPlaylist(c);var d=b.get("playlist");return f.isArray(d)&&0!==d.length?void a():void q(a,"Playlist type not supported")}function q(a,b){b&&b.message?x(a,"Error loading playlist",b.message):x(a,"Error loading player","No playable sources found")}function r(a,b){return f.contains(e.SkinsLoadable,a)?b+"skins/"+a+".css":void 0}function s(a){for(var b=document.styleSheets,c=0,d=b.length;d>c;c++)if(b[c].href===a)return!0;return!1}function t(a,b){var c=b.get("skin"),g=b.get("skinUrl");if(f.contains(e.SkinsIncluded,c))return void a();if(g||(g=r(c,b.get("base"))),f.isString(g)&&!s(g)){b.set("skin-loading",!0);var i=!0,j=new d(g,i);j.addEventListener(h.COMPLETE,function(){b.set("skin-loading",!1)}),j.addEventListener(h.ERROR,function(){console.log("The given skin failed to load : ",g),b.set("skin","seven"),b.set("skin-loading",!1)}),j.load()}f.defer(function(){a()})}function u(a,b){var d=b.get("playlist"),e=f.some(d,function(a){return g.isYouTube(a.file,a.type)});e?c.e(2,function(b){var d=c(105);d.register(window.jwplayer),a()}):a()}function v(a,b,c,d){b.setItem(0),d.setup(),a()}function w(a){a({type:"complete"})}function x(a,b,c){a({type:"error",msg:b,reason:c})}var y,z;return{getQueue:i,error:x}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(94),c(97),c(98),c(95)],e=function(a,b,c,d){var e={},f={},g=function(c,d){return f[c]=new a(new b(e),d),f[c]},h=function(a,b,f,g){var h=d.getPluginName(a);e[h]||(e[h]=new c(a)),e[h].registerPlugin(a,b,f,g)};return{loadPlugins:g,registerPlugin:h}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(95),c(45),c(66),c(63),c(47),c(96)],e=function(a,b,c,d,e,f){var g=function(g,h){function i(){o||(o=!0,n=f.loaderstatus.COMPLETE,m.trigger(c.COMPLETE))}function j(){if(!q&&(h&&0!==e.keys(h).length||i(),!o)){var d=g.getPlugins();l=e.after(p,i),e.each(h,function(e,g){var h=a.getPluginName(g),i=d[h],j=i.getJS(),k=i.getTarget(),n=i.getStatus();n!==f.loaderstatus.LOADING&&n!==f.loaderstatus.NEW&&(j&&!b.versionCheck(k)&&m.trigger(c.ERROR,{message:"Incompatible player version"}),l())})}}function k(a){if(!q){var d="File not found";a.url&&b.log(d,a.url),this.off(),this.trigger(c.ERROR,{message:d}),j()}}var l,m=e.extend(this,d),n=f.loaderstatus.NEW,o=!1,p=e.size(h),q=!1;this.setupPlugins=function(c,d,f){var h=[],i={},j=g.getPlugins(),k=d.get("plugins");e.each(k,function(d,g){var l=a.getPluginName(g),m=j[l],n=m.getFlashPath(),o=m.getJS(),p=m.getURL();if(n){var q=e.extend({name:l,swf:n,pluginmode:m.getPluginmode()},d);h.push(q)}var r=b.tryCatch(function(){if(o&&k[p]){var a=document.createElement("div");a.id=c.id+"_"+l,a.className="jw-plugin jw-reset",i[l]=m.getNewInstance(c,e.extend({},k[p]),a),c.onReady(f(i[l],a,!0)),c.onResize(f(i[l],a))}});r instanceof b.Error&&b.log("ERROR: Failed to load "+l+".")}),c.plugins=i,d.set("flashPlugins",h)},this.load=function(){if(b.exists(h)&&"object"!==b.typeOf(h))return void j();n=f.loaderstatus.LOADING,e.each(h,function(a,d){if(b.exists(d)){var e=g.addPlugin(d);e.on(c.COMPLETE,j),e.on(c.ERROR,k)}});var a=g.getPlugins();e.each(a,function(a){a.load()}),j()},this.destroy=function(){q=!0,this.off()},this.getStatus=function(){return n}};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){var b={},c=b.pluginPathType={ABSOLUTE:0,RELATIVE:1,CDN:2};return b.getPluginPathType=function(b){if("string"==typeof b){b=b.split("?")[0];var d=b.indexOf("://");if(d>0)return c.ABSOLUTE;var e=b.indexOf("/"),f=a.extension(b);return!(0>d&&0>e)||f&&isNaN(f)?c.RELATIVE:c.CDN}},b.getPluginName=function(a){return a.replace(/^(.*\/)?([^-]*)-?.*\.(swf|js)$/,"$2")},b.getPluginVersion=function(a){return a.replace(/[^-]*-?([^\.]*).*$/,"$1")},b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(66),c(63),c(47)],e=function(a,b,c){var d={},e={NEW:0,LOADING:1,ERROR:2,COMPLETE:3},f=function(f,g){function h(b){k=e.ERROR,j.trigger(a.ERROR,b)}function i(b){k=e.COMPLETE,j.trigger(a.COMPLETE,b)}var j=c.extend(this,b),k=e.NEW;this.addEventListener=this.on,this.removeEventListener=this.off,this.makeStyleLink=function(a){var b=document.createElement("link");return b.type="text/css",b.rel="stylesheet",b.href=a,b},this.makeScriptTag=function(a){var b=document.createElement("script");return b.src=a,b},this.makeTag=g?this.makeStyleLink:this.makeScriptTag,this.load=function(){if(k===e.NEW){var b=d[f];if(b&&(k=b.getStatus(),2>k))return b.on(a.ERROR,h),void b.on(a.COMPLETE,i);var c=document.getElementsByTagName("head")[0]||document.documentElement,j=this.makeTag(f),l=!1;j.onload=j.onreadystatechange=function(a){l||this.readyState&&"loaded"!==this.readyState&&"complete"!==this.readyState||(l=!0,i(a),j.onload=j.onreadystatechange=null,c&&j.parentNode&&!g&&c.removeChild(j))},j.onerror=h,c.insertBefore(j,c.firstChild),k=e.LOADING,d[f]=this}},this.getStatus=function(){return k}};return f.loaderstatus=e,f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(95),c(98)],e=function(a,b){var c=function(c){this.addPlugin=function(d){var e=a.getPluginName(d);return c[e]||(c[e]=new b(d)),c[e]},this.getPlugins=function(){return c}};return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(95),c(66),c(63),c(96),c(47)],e=function(a,b,c,d,e,f){var g={FLASH:0,JAVASCRIPT:1,HYBRID:2},h=function(h){function i(){switch(b.getPluginPathType(h)){case b.pluginPathType.ABSOLUTE:return h;case b.pluginPathType.RELATIVE:return a.getAbsolutePath(h,window.location.href)}}function j(){f.defer(function(){q=e.loaderstatus.COMPLETE,p.trigger(c.COMPLETE)})}function k(){q=e.loaderstatus.ERROR,p.trigger(c.ERROR,{url:h})}var l,m,n,o,p=f.extend(this,d),q=e.loaderstatus.NEW;this.load=function(){if(q===e.loaderstatus.NEW){if(h.lastIndexOf(".swf")>0)return l=h,q=e.loaderstatus.COMPLETE,void p.trigger(c.COMPLETE);if(b.getPluginPathType(h)===b.pluginPathType.CDN)return q=e.loaderstatus.COMPLETE,void p.trigger(c.COMPLETE);q=e.loaderstatus.LOADING;var a=new e(i());a.on(c.COMPLETE,j),a.on(c.ERROR,k),a.load()}},this.registerPlugin=function(a,b,d,f){o&&(clearTimeout(o),o=void 0),n=b,d&&f?(l=f,m=d):"string"==typeof d?l=d:"function"==typeof d?m=d:d||f||(l=a),q=e.loaderstatus.COMPLETE,p.trigger(c.COMPLETE)},this.getStatus=function(){return q},this.getPluginName=function(){return b.getPluginName(h)},this.getFlashPath=function(){if(l)switch(b.getPluginPathType(l)){case b.pluginPathType.ABSOLUTE:return l;case b.pluginPathType.RELATIVE:return h.lastIndexOf(".swf")>0?a.getAbsolutePath(l,window.location.href):a.getAbsolutePath(l,i())}return null},this.getJS=function(){return m},this.getTarget=function(){return n},this.getPluginmode=function(){return void 0!==typeof l&&void 0!==typeof m?g.HYBRID:void 0!==typeof l?g.FLASH:void 0!==typeof m?g.JAVASCRIPT:void 0},this.getNewInstance=function(a,b,c){return new m(a,b,c)},this.getURL=function(){return h}};return h}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(100),c(101),c(45),c(66),c(63),c(47)],e=function(a,b,c,d,e,f){var g=function(){function g(e){var f=c.tryCatch(function(){for(var c=e.responseXML.childNodes,f="",g=0;g<c.length&&(f=c[g],8===f.nodeType);g++);if("xml"===a.localName(f)&&(f=f.nextSibling),"rss"!==a.localName(f))return void i("Not a valid RSS feed");var h=b.parse(f);k.trigger(d.JWPLAYER_PLAYLIST_LOADED,{playlist:h})});f instanceof c.Error&&i()}function h(a){i(a.match(/invalid/i)?"Not a valid RSS feed":"")}function i(a){k.trigger(d.JWPLAYER_ERROR,{message:a?a:"Error loading file"})}var j,k=f.extend(this,e);this.load=function(a){j=c.ajax(a,g,h)},this.destroy=function(){this.off(),j=null}};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){return{localName:function(a){return a?a.localName?a.localName:a.baseName?a.baseName:"":""},textContent:function(b){return b?b.textContent?a.trim(b.textContent):b.text?a.trim(b.text):"":""},getChildNode:function(a,b){return a.childNodes[b]},numChildren:function(a){return a.childNodes?a.childNodes.length:0}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50),c(100),c(102),c(103),c(83)],e=function(a,b,c,d,e){function f(b){for(var f={},h=0;h<b.childNodes.length;h++){var i=b.childNodes[h],k=j(i);if(k)switch(k.toLowerCase()){case"enclosure":f.file=a.xmlAttribute(i,"url");break;case"title":f.title=g(i);break;case"guid":f.mediaid=g(i);break;case"pubdate":f.date=g(i);break;case"description":f.description=g(i);break;case"link":f.link=g(i);break;case"category":f.tags?f.tags+=g(i):f.tags=g(i)}}return f=d(b,f),f=c(b,f),new e(f)}var g=b.textContent,h=b.getChildNode,i=b.numChildren,j=b.localName,k={};return k.parse=function(a){for(var b=[],c=0;c<i(a);c++){var d=h(a,c),e=j(d).toLowerCase();if("channel"===e)for(var g=0;g<i(d);g++){var k=h(d,g);"item"===j(k).toLowerCase()&&b.push(f(k))}}return b},k}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(100),c(50),c(45)],e=function(a,b,c){var d="jwplayer",e=function(e,f){for(var g=[],h=[],i=b.xmlAttribute,j="default",k="label",l="file",m="type",n=0;n<e.childNodes.length;n++){var o=e.childNodes[n];if(o.prefix===d){var p=a.localName(o);"source"===p?(delete f.sources,g.push({file:i(o,l),"default":i(o,j),label:i(o,k),type:i(o,m)})):"track"===p?(delete f.tracks,h.push({file:i(o,l),"default":i(o,j),kind:i(o,"kind"),label:i(o,k)})):(f[p]=c.serialize(a.textContent(o)),"file"===p&&f.sources&&delete f.sources)}f[l]||(f[l]=f.link)}if(g.length)for(f.sources=[],n=0;n<g.length;n++)g[n].file.length>0&&(g[n][j]="true"===g[n][j]?!0:!1,g[n].label.length||delete g[n].label,f.sources.push(g[n]));if(h.length)for(f.tracks=[],n=0;n<h.length;n++)h[n].file.length>0&&(h[n][j]="true"===h[n][j]?!0:!1,h[n].kind=h[n].kind.length?h[n].kind:"captions",h[n].label.length||delete h[n].label,f.tracks.push(h[n]));return f};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(100),c(50),c(45)],e=function(a,b,c){var d=b.xmlAttribute,e=a.localName,f=a.textContent,g=a.numChildren,h="media",i=function(a,b){function j(a){var b={zh:"Chinese",nl:"Dutch",en:"English",fr:"French",de:"German",it:"Italian",ja:"Japanese",pt:"Portuguese",ru:"Russian",es:"Spanish"};return b[a]?b[a]:a}var k,l,m="tracks",n=[];for(l=0;l<g(a);l++)if(k=a.childNodes[l],k.prefix===h){if(!e(k))continue;switch(e(k).toLowerCase()){case"content":d(k,"duration")&&(b.duration=c.seconds(d(k,"duration"))),g(k)>0&&(b=i(k,b)),d(k,"url")&&(b.sources||(b.sources=[]),b.sources.push({file:d(k,"url"),type:d(k,"type"),width:d(k,"width"),label:d(k,"label")}));break;case"title":b.title=f(k);break;case"description":b.description=f(k);break;case"guid":b.mediaid=f(k);break;case"thumbnail":b.image||(b.image=d(k,"url"));break;case"player":break;case"group":i(k,b);break;case"subtitle":var o={};o.file=d(k,"url"),o.kind="captions",d(k,"lang").length>0&&(o.label=j(d(k,"lang"))),n.push(o)}}for(b.hasOwnProperty(m)||(b[m]=[]),l=0;l<n.length;l++)b[m].push(n[l]);return b};return i}.apply(b,d),!(void 0!==e&&(a.exports=e))},,,,,,,function(a,b,c){var d,e;d=[c(100),c(111),c(112),c(45)],e=function(a,b,c,d){var e=function(e,f){function g(a){d.log("CAPTIONS("+a+")")}function h(a,b){q=[],r={},s={},t=0;var c,d,e,f=b.tracks;for(e=0;e<f.length;e++)c=f[e],d=c.kind.toLowerCase(),("captions"===d||"subtitles"===d)&&(c.file?(j(c),k(c)):c.data&&j(c));var g=o();this.setCaptionsList(g),p()}function i(a,b){return 0===b?void n(a,null):void n(a,q[b-1])}function j(a){"number"!=typeof a.id&&(a.id=a.name||a.file||"cc"+q.length),a.data=a.data||[],a.label||(a.label="Unknown CC",t++,t>1&&(a.label+=" ("+t+")")),q.push(a),r[a.id]=a}function k(a){d.ajax(a.file,function(b){l(b,a)},m,!0)}function l(e,f){var h,i=e.responseXML?e.responseXML.firstChild:null;if(i)for("xml"===a.localName(i)&&(i=i.nextSibling);i.nodeType===i.COMMENT_NODE;)i=i.nextSibling;h=i&&"tt"===a.localName(i)?d.tryCatch(function(){f.data=c(e.responseXML)}):d.tryCatch(function(){f.data=b(e.responseText)}),h instanceof d.Error&&g(h.message+": "+f.file)}function m(a){g(a)}function n(a,b){a.set("captionsTrack",b),b?a.set("captionLabel",b.label):a.set("captionLabel","Off")}function o(){for(var a=[{id:"off",label:"Off"}],b=0;b<q.length;b++)a.push({id:q[b].id,label:q[b].label});return a}function p(){for(var a=0,b=f.get("captionLabel"),c=0;c<q.length;c++){var d=q[c];if(b&&b===d.label){a=c+1;break}d["default"]||d.defaulttrack?a=c+1:d.autoselect}f.set("captionsIndex",a)}f.on("change:playlistItem",h,this),f.on("change:captionsIndex",i,this),f.mediaController.on("subtitlesTracks",function(a){if(a.tracks.length){f.mediaController.off("meta"),q=[],r={},s={},t=0;for(var b=a.tracks||[],c=0;c<b.length;c++){var d=b[c];d.id=d.name,d.label=d.name||d.language,j(d)}var e=o();this.setCaptionsList(e),p()}},this),f.mediaController.on("subtitlesTrackData",function(a){var b=r[a.name];if(b){for(var c=a.captions||[],d=!1,e=0;e<c.length;e++){var f=c[e],g=a.name+"_"+f.begin+"_"+f.end;s[g]||(s[g]=f,b.data.push(f),d=!0)}d&&b.data.sort(function(a,b){return a.begin-b.begin})}},this),f.mediaController.on("meta",function(a){var b=a.metadata;if(b&&"textdata"===b.type){var c=r[b.trackid];if(!c){c={kind:"captions",id:b.trackid,data:[]},j(c);var d=o();this.setCaptionsList(d)}var e=a.position||f.get("position"),g=""+Math.round(10*e)+"_"+b.text,h=s[g];h||(h={begin:e,text:b.text},s[g]=h,c.data.push(h))}},this);var q=[],r={},s={},t=0;this.getCurrentIndex=function(){return f.get("captionsIndex")},this.getCaptionsList=function(){return f.get("captionsList")},this.setCurrentIndex=function(a){e.setCurrentCaptions(a)},this.setCaptionsList=function(a){f.set("captionsList",a)}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(50)],e=function(a,b){function c(a){var b={},c=a.split("\r\n");1===c.length&&(c=a.split("\n"));var e=1;if(c[0].indexOf(" --> ")>0&&(e=0),c.length>e+1&&c[e+1]){var f=c[e],g=f.indexOf(" --> ");g>0&&(b.begin=d(f.substr(0,g)),b.end=d(f.substr(g+5)),b.text=c.slice(e+1).join("<br/>"))}return b}var d=a.seconds;return function(a){var d=[];a=b.trim(a);var e=a.split("\r\n\r\n");1===e.length&&(e=a.split("\n\n"));for(var f=0;f<e.length;f++)if("WEBVTT"!==e[f]){var g=c(e[f]);g.text&&d.push(g)}if(!d.length)throw new Error("Invalid SRT file");return d}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(50)],e=function(a){function b(a){a||c()}function c(){throw new Error("Invalid DFXP file")}var d=a.seconds;return function(e){b(e);var f=[],g=e.getElementsByTagName("p");b(g),g.length||(g=e.getElementsByTagName("tt:p"),g.length||(g=e.getElementsByTagName("tts:p")));for(var h=0;h<g.length;h++){var i=g[h],j=i.innerHTML||i.textContent||i.text||"",k=a.trim(j).replace(/>\s+</g,"><").replace(/tts?:/g,"");if(k){var l=i.getAttribute("begin"),m=i.getAttribute("dur"),n=i.getAttribute("end"),o={begin:d(l),text:k};n?o.end=d(n):m&&(o.end=o.begin+d(m)),f.push(o)}}return f.length||c(),f}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[],e=function(){return function(a,b){a.getPlaylistIndex=a.getItem;var c={jwPlay:b.play,jwPause:b.pause,jwSetMute:b.setMute,jwLoad:b.load,jwPlaylistItem:b.item,jwGetAudioTracks:b.getAudioTracks,jwDetachMedia:b.detachMedia,jwAttachMedia:b.attachMedia,jwAddEventListener:b.on,jwRemoveEventListener:b.off,jwStop:b.stop,jwSeek:b.seek,jwSetVolume:b.setVolume,jwPlaylistNext:b.next,jwPlaylistPrev:b.prev,jwSetFullscreen:b.setFullscreen,jwGetQualityLevels:b.getQualityLevels,jwGetCurrentQuality:b.getCurrentQuality,jwSetCurrentQuality:b.setCurrentQuality,jwSetCurrentAudioTrack:b.setCurrentAudioTrack,jwGetCurrentAudioTrack:b.getCurrentAudioTrack,jwGetCaptionsList:b.getCaptionsList,jwGetCurrentCaptions:b.getCurrentCaptions,jwSetCurrentCaptions:b.setCurrentCaptions,jwSetCues:b.setCues};a.callInternal=function(a){console.log("You are using the deprecated callInternal method for "+a);var d=Array.prototype.slice.call(arguments,1);c[a].apply(b,d)}}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(115),c(66),c(152)],e=function(a,b,c){var d=function(d,e){var f=new a(d,e),g=f.setup;return f.setup=function(){if(g.call(this),"trial"===e.get("edition")){var a=document.createElement("div");a.className="jw-icon jw-rightclick-logo jw-watermark",this.element().appendChild(a)}e.on("change:skipButton",this.onSkipButton,this),e.on("change:castActive change:playlistItem",this.showDisplayIconImage,this)},f.showDisplayIconImage=function(a){var b=a.get("castActive"),c=a.get("playlistItem"),d=f.controlsContainer().getElementsByClassName("jw-display-icon-container")[0];b?(d.style.backgroundImage="url("+c.image+")",d.style.backgroundSize="contain"):(d.style.backgroundImage="",d.style.backgroundSize="")},f.onSkipButton=function(a,b){b?this.addSkipButton():this._skipButton&&(this._skipButton.destroy(),this._skipButton=null)},f.addSkipButton=function(){this._skipButton=new c(this.instreamModel),this._skipButton.on(b.JWPLAYER_AD_SKIPPED,function(){this.api.skipAd()},this),this.controlsContainer().appendChild(this._skipButton.element())},f};return d}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(66),c(63),c(65),c(126),c(127),c(128),c(130),c(116),c(132),c(146),c(147),c(150),c(47),c(151)],e=function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o){var p=a.style,q=a.bounds,r=a.isMobile(),s=["fullscreenchange","webkitfullscreenchange","mozfullscreenchange","MSFullscreenChange"],t=function(t,u){function v(b){var c=a.between(u.get("position")+b,0,u.get("duration"));t.seek(c)}function w(b){var c=a.between(u.get("volume")+b,0,100);t.setVolume(c)}function x(a){return a.ctrlKey||a.metaKey?!1:u.get("controls")?!0:!1}function y(a){if(!x(a))return!0;switch(Ha||aa(),a.keyCode){case 27:t.setFullscreen(!1);break;case 13:case 32:t.play();break;case 37:Ha||v(-5);break;case 39:Ha||v(5);break;case 38:w(10);break;case 40:w(-10);break;case 77:t.setMute();break;case 70:t.setFullscreen();break;default:if(a.keyCode>=48&&a.keyCode<=59){var b=a.keyCode-48,c=b/10*u.get("duration");t.seek(c)}}return/13|32|37|38|39|40/.test(a.keyCode)?(a.preventDefault(),!1):void 0}function z(){Ma=!0,Na.trigger(b.JWPLAYER_VIEW_TAB_FOCUS,{hasFocus:!1})}function A(){var a=!Ma;Ma=!1,a&&Na.trigger(b.JWPLAYER_VIEW_TAB_FOCUS,{hasFocus:!0}),Ha||aa()}function B(){Ma=!1,Na.trigger(b.JWPLAYER_VIEW_TAB_FOCUS,{hasFocus:!1})}function C(){var a=q(ia),c=Math.round(a.width),d=Math.round(a.height);return document.body.contains(ia)?c&&d&&(c!==ma||d!==na)&&(ma=c,na=d,clearTimeout(Ka),Ka=setTimeout(W,50),u.set("containerWidth",c),
u.set("containerHeight",d),Na.trigger(b.JWPLAYER_RESIZE,{width:c,height:d})):(window.removeEventListener("resize",C),r&&window.removeEventListener("orientationchange",C)),a}function D(b,c){c=c||!1,a.toggleClass(ia,"jw-flag-casting",c)}function E(b,c){a.toggleClass(ia,"jw-flag-cast-available",c),a.toggleClass(ja,"jw-flag-cast-available",c)}function F(b,c,d){d&&a.removeClass(ia,"jw-stretch-"+d),a.addClass(ia,"jw-stretch-"+c)}function G(b,c){a.toggleClass(ia,"jw-flag-compact-player",c)}function H(a){a&&!r&&(a.element().addEventListener("mousemove",K,!1),a.element().addEventListener("mouseout",L,!1))}function I(){u.get("state")!==d.IDLE&&u.get("state")!==d.COMPLETE||!u.get("controls")||t.play(),Ja?_():aa()}function J(a){a.link?(t.pause(!0),t.setFullscreen(!1),window.open(a.link,a.linktarget)):t.play()}function K(){clearTimeout(Ea)}function L(){aa()}function M(a){Na.trigger(a.type,a)}function N(b,c){c?(za&&za.destroy(),a.addClass(ia,"jw-flag-flash-blocked")):(za&&za.setup(u,ia,ia),a.removeClass(ia,"jw-flag-flash-blocked"))}function O(){u.get("controls")&&t.setFullscreen()}function P(){ra=new f(u,ka),ra.on("click",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),u.get("controls")&&t.play()}),ra.on("tap",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),I()}),ra.on("doubleClick",O);var c=new g(u);c.on("click",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),t.play()}),c.on("tap",function(){M({type:b.JWPLAYER_DISPLAY_CLICK}),I()}),ja.appendChild(c.element()),ta=new h(u),ua=new i(u),ua.on(b.JWPLAYER_LOGO_CLICK,J);var d=document.createElement("div");d.className="jw-controls-right jw-reset",u.get("logo")&&d.appendChild(ua.element()),d.appendChild(ta.element()),ja.appendChild(d),wa=new e(u),wa.setup(u.get("captions")),ja.parentNode.insertBefore(wa.element(),va.element());var k=u.get("height");r&&("string"==typeof k||k>=1.5*Ga)?a.addClass(ia,"jw-flag-touch"):(za=new l,za.setup(u,ia,ia)),pa=new j(t,u),pa.on(b.JWPLAYER_USER_ACTION,aa),u.on("change:scrubbing",R),u.on("change:compactUI",G),ja.appendChild(pa.element()),ia.onfocusin=A,ia.onfocusout=B,ia.addEventListener("focus",A),ia.addEventListener("blur",B),ia.addEventListener("keydown",y),ia.onmousedown=z}function Q(b){return b.get("state")===d.PAUSED?void b.once("change:state",Q):void(b.get("scrubbing")===!1&&a.removeClass(ia,"jw-flag-dragging"))}function R(b,c){b.off("change:state",Q),c?a.addClass(ia,"jw-flag-dragging"):Q(b)}function S(b,c,d){var e,f=ia.className;d=!!d,d&&(f=f.replace(/\s*aspectMode/,""),ia.className!==f&&(ia.className=f),a.style(ia,{display:"block"},d)),a.exists(b)&&a.exists(c)&&(u.set("width",b),u.set("height",c)),e={width:b},a.hasClass(ia,"jw-flag-aspect-mode")||(e.height=c),p(ia,e,!0),ua&&ua.offset(pa&&ua.position().indexOf("bottom")>=0?pa.element().clientHeight:0),T(c),W(b,c)}function T(b){if(xa=U(b),pa&&!xa){var c=Ha?oa:u;ha(c.get("state"))}a.toggleClass(ia,"jw-flag-audio-player",xa)}function U(a){if(u.get("aspectratio"))return!1;if(n.isString(a)&&a.indexOf("%")>-1)return!1;var b=n.isNumber(a)?a:u.get("containerHeight");return V(b)}function V(a){return a&&Ga*(r?1.75:1)>=a}function W(b,c){if(!b||isNaN(Number(b))){if(!ka)return;b=ka.clientWidth}if(!c||isNaN(Number(c))){if(!ka)return;c=ka.clientHeight}a.isMSIE(9)&&document.all&&!window.atob&&(b=c="100%");var d=u.getVideo();if(d){var e=d.resize(b,c,u.get("stretching"));e&&(clearTimeout(Ka),Ka=setTimeout(W,250)),wa.resize(),pa.checkCompactMode(b)}}function X(){if(La){var a=document.fullscreenElement||document.webkitCurrentFullScreenElement||document.mozFullScreenElement||document.msFullscreenElement;return!(!a||a.id!==u.get("id"))}return Ha?oa.getVideo().getFullScreen():u.getVideo().getFullScreen()}function Y(a){var b=void 0!==a.jwstate?a.jwstate:X();La?Z(ia,b):$(b)}function Z(b,c){a.removeClass(b,"jw-flag-fullscreen"),c?(a.addClass(b,"jw-flag-fullscreen"),p(document.body,{"overflow-y":"hidden"}),aa()):p(document.body,{"overflow-y":""}),W(),$(c)}function $(a){u.setFullscreen(a),oa&&oa.setFullscreen(a),a&&(clearTimeout(Ka),Ka=setTimeout(W,200))}function _(){Ja=!1,clearTimeout(Ea),pa.hideComponents(),a.addClass(ia,"jw-flag-user-inactive")}function aa(){Ja||(a.removeClass(ia,"jw-flag-user-inactive"),pa.checkCompactMode(ka.clientWidth)),Ja=!0,clearTimeout(Ea),Ea=setTimeout(_,Fa)}function ba(){ya=!0,Ra(!1)}function ca(){sa&&sa.setState(u.get("state")),u.mediaModel.on("change:mediaType",function(b,c){var d="audio"===c;a.toggleClass(ia,"jw-flag-media-audio",d)})}function da(b,c){var d="LIVE"===a.adaptiveType(c);a.toggleClass(ia,"jw-flag-live",d),Na.setAltText(d?"Live Broadcast":"")}function ea(a,b){ya=!1,ha(b)}function fa(a){ea(u,d.ERROR),va.updateText(u,{title:a.message})}function ga(){var a=u.getVideo();return a?a.isCaster:!1}function ha(b){if(a.removeClass(ia,"jw-state-"+Aa),a.addClass(ia,"jw-state-"+b),Aa=b,ga())return void a.addClass(ka,"jw-media-show");switch(b){case d.PLAYING:W();break;case d.PAUSED:aa()}}var ia,ja,ka,la,ma,na,oa,pa,qa,ra,sa,ta,ua,va,wa,xa,ya,za,Aa,Ba,Ca,Da,Ea=-1,Fa=r?4e3:2e3,Ga=40,Ha=!1,Ia=!1,Ja=!1,Ka=-1,La=!1,Ma=!1,Na=n.extend(this,c);this.model=u,this.api=t,ia=a.createElement(o({id:u.get("id")}));var Oa=u.get("width"),Pa=u.get("height");p(ia,{width:Oa.toString().indexOf("%")>0?Oa:Oa+"px",height:Pa.toString().indexOf("%")>0?Pa:Pa+"px"}),Ca=ia.requestFullscreen||ia.webkitRequestFullscreen||ia.webkitRequestFullScreen||ia.mozRequestFullScreen||ia.msRequestFullscreen,Da=document.exitFullscreen||document.webkitExitFullscreen||document.webkitCancelFullScreen||document.mozCancelFullScreen||document.msExitFullscreen,La=Ca&&Da,this.onChangeSkin=function(b,c,d){d&&a.removeClass(ia,"jw-skin-"+d),c&&a.addClass(ia,"jw-skin-"+c)},this.handleColorOverrides=function(){function b(b,d,e){if(e){b=a.prefix(b,"#"+c+" ");var f={};f[d]=e,a.css(b.join(", "),f)}}var c=u.get("id"),d=u.get("skinColorActive"),e=u.get("skinColorInactive"),f=u.get("skinColorBackground");b([".jw-toggle",".jw-button-color:hover"],"color",d),b([".jw-active-option",".jw-progress",".jw-playlist-container .jw-option.jw-active-option",".jw-playlist-container .jw-option:hover"],"background",d),b([".jw-text",".jw-option",".jw-button-color",".jw-toggle.jw-off",".jw-tooltip-title",".jw-skip .jw-skip-icon",".jw-playlist-container .jw-icon"],"color",e),b([".jw-cue",".jw-knob"],"background",e),b([".jw-playlist-container .jw-option"],"border-bottom-color",e),b([".jw-background-color",".jw-tooltip-title",".jw-playlist",".jw-playlist-container .jw-option"],"background",f),b([".jw-playlist-container ::-webkit-scrollbar"],"border-color",f)},this.setup=function(){if(!Ia){this.handleColorOverrides(),u.get("skin-loading")===!0&&(a.addClass(ia,"jw-flag-skin-loading"),u.once("change:skin-loading",function(){a.removeClass(ia,"jw-flag-skin-loading")})),this.onChangeSkin(u,u.get("skin"),""),u.on("change:skin",this.onChangeSkin,this),ka=ia.getElementsByClassName("jw-media")[0],ja=ia.getElementsByClassName("jw-controls")[0],la=ia.getElementsByClassName("jw-aspect")[0];var c=ia.getElementsByClassName("jw-preview")[0];qa=new k(u),qa.setup(c);var e=ia.getElementsByClassName("jw-title")[0];va=new m(u),va.setup(e),P(),aa(),u.getVideo().setContainer(ka),u.mediaController.on("fullscreenchange",Y);for(var f=s.length;f--;)document.addEventListener(s[f],Y,!1);window.removeEventListener("resize",C),window.addEventListener("resize",C,!1),r&&(window.removeEventListener("orientationchange",C),window.addEventListener("orientationchange",C,!1)),u.on("change:controls",Qa),Qa(u,u.get("controls")),u.on("change:state",ea),u.on("change:duration",da,this),u.on("change:flashBlocked",N),N(u,u.get("flashBlocked")),u.mediaController.on(b.JWPLAYER_MEDIA_ERROR,fa),t.onPlaylistComplete(ba),t.onPlaylistItem(ca),u.on("change:castAvailable",E),E(u,u.get("castAvailable")),u.on("change:castActive",D),D(u,u.get("castActive")),u.get("stretching")&&F(u,u.get("stretching")),u.on("change:stretching",F),ea(null,d.IDLE),r||(ra.element().addEventListener("mouseout",aa,!1),ra.element().addEventListener("mousemove",aa,!1)),H(pa),H(ua),u.get("aspectratio")&&(a.addClass(ia,"jw-flag-aspect-mode"),a.style(la,{"padding-top":u.get("aspectratio")})),setTimeout(function(){C(),S(u.get("width"),u.get("height"))},0)}};var Qa=function(b,c){if(c){var d=Ha?oa.get("state"):u.get("state");ea(b,d)}c?a.removeClass(ia,"jw-flag-controls-disabled"):a.addClass(ia,"jw-flag-controls-disabled"),b.getVideo().setControls(c)},Ra=this.fullscreen=function(b){if(a.exists(b)||(b=!u.get("fullscreen")),b=!!b,b!==u.get("fullscreen")){var c=u.getVideo();La?(b?Ca.apply(ia):Da.apply(document),Z(ia,b)):a.isIE()?Z(ia,b):(oa&&oa.getVideo()&&oa.getVideo().setFullscreen(b),c.setFullscreen(b)),c&&0===c.getName().name.indexOf("flash")&&c.setFullscreen(b)}};this.resize=function(a,b){var c=!0;S(a,b,c),C()},this.resizeMedia=W,this.reset=function(){document.contains(ia)&&ia.parentNode.replaceChild(Ba,ia),a.emptyElement(ia)},this.setupInstream=function(b){this.instreamModel=oa=b,oa.on("change:controls",Qa,this),oa.on("change:state",ea,this),Ha=!0,a.addClass(ia,"jw-flag-ads"),aa()},this.setAltText=function(a){pa.setAltText(a)},this.useExternalControls=function(){a.addClass(ia,"jw-flag-ads-hide-controls")},this.destroyInstream=function(){if(Ha=!1,oa&&(oa.off(null,null,this),oa=null),this.setAltText(""),a.removeClass(ia,"jw-flag-ads"),a.removeClass(ia,"jw-flag-ads-hide-controls"),u.getVideo){var b=u.getVideo();b.setContainer(ka)}da(u,u.get("duration")),ra.revertAlternateClickHandlers()},this.addCues=function(a){pa&&pa.addCues(a)},this.clickHandler=function(){return ra},this.controlsContainer=function(){return ja},this.getContainer=this.element=function(){return ia},this.getSafeRegion=function(b){var c={x:0,y:0,width:u.get("containerWidth")||0,height:u.get("containerHeight")||0},d=u.get("dock");return d&&d.length&&u.get("controls")&&(c.y=ta.element().clientHeight,c.height-=c.y),b=b||!a.exists(b),b&&u.get("controls")&&(c.height-=pa.element().clientHeight),c},this.destroy=function(){window.removeEventListener("resize",C),window.removeEventListener("orientationchange",C);for(var b=s.length;b--;)document.removeEventListener(s[b],Y,!1);u.mediaController&&u.mediaController.off("fullscreenchange",Y),ia.removeEventListener("keydown",y,!1),za&&za.destroy(),sa&&(u.off("change:state",sa.statusDelegate),sa.destroy(),sa=null),ja&&(ra.element().removeEventListener("mousemove",aa),ra.element().removeEventListener("mouseout",aa)),Ha&&this.destroyInstream(),a.clearCss("#"+u.get("id"))}};return t}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(117),c(45),c(66),c(47),c(63),c(118)],e=function(a,b,c,d,e,f){var g=b.style,h={linktarget:"_blank",margin:8,hide:!1,position:"top-right"},i=function(i){function j(){n=d.extend({},h,p),n.hide="true"===n.hide.toString(),k()}function k(){if(m=b.createElement(f({file:n.file})),n.file){if(n.hide&&b.addClass(m,"jw-hide"),n.position!==h.position||n.margin!==h.margin){var c=/(\w+)-(\w+)/.exec(n.position),d={top:"auto",right:"auto",bottom:"auto",left:"auto"};3===c.length&&(d[c[1]]=n.margin,d[c[2]]=n.margin,g(m,d))}var e=new a(m);e.on("click tap",l)}}function l(a){b.exists(a)&&a.stopPropagation&&a.stopPropagation(),o.trigger(c.JWPLAYER_LOGO_CLICK,{link:n.link,linktarget:n.linktarget})}var m,n,o=this,p=d.extend({},i.get("logo"));return d.extend(this,e),this.element=function(){return m},this.offset=function(a){g(m,{marginBottom:a})},this.position=function(){return n.position},this.margin=function(){return parseInt(n.margin,10)},j(),this};return i}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(63),c(66),c(47),c(45)],e=function(a,b,c,d){function e(a,b){return/touch/.test(a.type)?(a.originalEvent||a).changedTouches[0]["page"+b]:a["page"+b]}function f(a){var b=a||window.event;return a instanceof MouseEvent?"which"in b?3===b.which:"button"in b?2===b.button:!1:!1}function g(a,b,c){var d;return d=b instanceof MouseEvent||!b.touches&&!b.changedTouches?b:b.touches&&b.touches.length?b.touches[0]:b.changedTouches[0],{type:a,target:b.target,currentTarget:c,pageX:d.pageX,pageY:d.pageY}}function h(a){(a instanceof MouseEvent||a instanceof window.TouchEvent)&&(a.preventManipulation&&a.preventManipulation(),a.cancelable&&a.preventDefault&&a.preventDefault())}var i=!c.isUndefined(window.PointerEvent),j=!i&&d.isMobile(),k=!i&&!j,l=function(a,d){function j(a){(k||i&&"touch"!==a.pointerType)&&p(b.touchEvents.OVER,a)}function l(c){(k||i&&"touch"!==c.pointerType&&!a.contains(document.elementFromPoint(c.x,c.y)))&&p(b.touchEvents.OUT,c)}function m(b){q=b.target,u=e(b,"X"),v=e(b,"Y"),f(b)||(i?b.isPrimary&&(d.preventScrolling&&(r=b.pointerId,a.setPointerCapture(r)),a.addEventListener("pointermove",n),a.addEventListener("pointerup",o),a.addEventListener("pointercancel",o)):k&&(document.addEventListener("mousemove",n),document.addEventListener("mouseup",o)),q.addEventListener("touchmove",n),q.addEventListener("touchend",o),q.addEventListener("touchcancel",o))}function n(a){var c=b.touchEvents,f=6;if(t)p(c.DRAG,a);else{var g=e(a,"X"),i=e(a,"Y"),j=g-u,k=i-v;j*j+k*k>f*f&&(p(c.DRAG_START,a),t=!0,p(c.DRAG,a))}d.preventScrolling&&h(a)}function o(c){var e=b.touchEvents;i?(d.preventScrolling&&a.releasePointerCapture(r),a.removeEventListener("pointermove",n),a.removeEventListener("pointercancel",o),a.removeEventListener("pointerup",o)):k&&(document.removeEventListener("mousemove",n),document.removeEventListener("mouseup",o)),q.removeEventListener("touchmove",n),q.removeEventListener("touchcancel",o),q.removeEventListener("touchend",o),t?p(e.DRAG_END,c):d.directSelect&&c.target!==a||(i&&c instanceof window.PointerEvent?"touch"===c.pointerType?p(e.TAP,c):p(e.CLICK,c):k?p(e.CLICK,c):(p(e.TAP,c),h(c))),q=null,t=!1}function p(a,e){var f;if(d.enableDoubleTap&&(a===b.touchEvents.CLICK||a===b.touchEvents.TAP))if(c.now()-w<x){var h=a===b.touchEvents.CLICK?b.touchEvents.DOUBLE_CLICK:b.touchEvents.DOUBLE_TAP;f=g(h,e,s),y.trigger(h,f),w=0}else w=c.now();f=g(a,e,s),y.trigger(a,f)}var q,r,s=a,t=!1,u=0,v=0,w=0,x=300;d=d||{},i?(a.addEventListener("pointerdown",m),d.useHover&&(a.addEventListener("pointerover",j),a.addEventListener("pointerout",l))):k&&(a.addEventListener("mousedown",m),d.useHover&&(a.addEventListener("mouseover",j),a.addEventListener("mouseout",l))),a.addEventListener("touchstart",m);var y=this;return this.triggerEvent=p,this.destroy=function(){a.removeEventListener("touchstart",m),a.removeEventListener("mousedown",m),q&&(q.removeEventListener("touchmove",n),q.removeEventListener("touchcancel",o),q.removeEventListener("touchend",o)),i&&(d.preventScrolling&&a.releasePointerCapture(r),a.removeEventListener("pointerdown",m),a.removeEventListener("pointermove",n),a.removeEventListener("pointercancel",o),a.removeEventListener("pointerup",o)),document.removeEventListener("mousemove",n),document.removeEventListener("mouseup",o)},this};return c.extend(l.prototype,a),l}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'src="'+h((e=null!=(e=b.file||(null!=a?a.file:a))?e:g,typeof e===f?e.call(a,{name:"file",hash:{},data:d}):e))+'"'},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-logo jw-reset">\n    <img class="jw-logo-image" ';return e=b["if"].call(a,null!=a?a.file:a,{name:"if",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+">\n</div>"},useData:!0})},function(a,b,c){a.exports=c(120)},function(a,b,c){"use strict";var d=c(121),e=c(123)["default"],f=c(124)["default"],g=c(122),h=c(125),i=function(){var a=new d.HandlebarsEnvironment;return g.extend(a,d),a.SafeString=e,a.Exception=f,a.Utils=g,a.escapeExpression=g.escapeExpression,a.VM=h,a.template=function(b){return h.template(b,a)},a},j=i();j.create=i,j["default"]=j,b["default"]=j},function(a,b,c){"use strict";function d(a,b){this.helpers=a||{},this.partials=b||{},e(this)}function e(a){a.registerHelper("helperMissing",function(){if(1===arguments.length)return void 0;throw new g("Missing helper: '"+arguments[arguments.length-1].name+"'")}),a.registerHelper("blockHelperMissing",function(b,c){var d=c.inverse,e=c.fn;if(b===!0)return e(this);if(b===!1||null==b)return d(this);if(k(b))return b.length>0?(c.ids&&(c.ids=[c.name]),a.helpers.each(b,c)):d(this);if(c.data&&c.ids){var g=q(c.data);g.contextPath=f.appendContextPath(c.data.contextPath,c.name),c={data:g}}return e(b,c)}),a.registerHelper("each",function(a,b){if(!b)throw new g("Must pass iterator to #each");var c,d,e=b.fn,h=b.inverse,i=0,j="";if(b.data&&b.ids&&(d=f.appendContextPath(b.data.contextPath,b.ids[0])+"."),l(a)&&(a=a.call(this)),b.data&&(c=q(b.data)),a&&"object"==typeof a)if(k(a))for(var m=a.length;m>i;i++)c&&(c.index=i,c.first=0===i,c.last=i===a.length-1,d&&(c.contextPath=d+i)),j+=e(a[i],{data:c});else for(var n in a)a.hasOwnProperty(n)&&(c&&(c.key=n,c.index=i,c.first=0===i,d&&(c.contextPath=d+n)),j+=e(a[n],{data:c}),i++);return 0===i&&(j=h(this)),j}),a.registerHelper("if",function(a,b){return l(a)&&(a=a.call(this)),!b.hash.includeZero&&!a||f.isEmpty(a)?b.inverse(this):b.fn(this)}),a.registerHelper("unless",function(b,c){return a.helpers["if"].call(this,b,{fn:c.inverse,inverse:c.fn,hash:c.hash})}),a.registerHelper("with",function(a,b){l(a)&&(a=a.call(this));var c=b.fn;if(f.isEmpty(a))return b.inverse(this);if(b.data&&b.ids){var d=q(b.data);d.contextPath=f.appendContextPath(b.data.contextPath,b.ids[0]),b={data:d}}return c(a,b)}),a.registerHelper("log",function(b,c){var d=c.data&&null!=c.data.level?parseInt(c.data.level,10):1;a.log(d,b)}),a.registerHelper("lookup",function(a,b){return a&&a[b]})}var f=c(122),g=c(124)["default"],h="2.0.0";b.VERSION=h;var i=6;b.COMPILER_REVISION=i;var j={1:"<= 1.0.rc.2",2:"== 1.0.0-rc.3",3:"== 1.0.0-rc.4",4:"== 1.x.x",5:"== 2.0.0-alpha.x",6:">= 2.0.0-beta.1"};b.REVISION_CHANGES=j;var k=f.isArray,l=f.isFunction,m=f.toString,n="[object Object]";b.HandlebarsEnvironment=d,d.prototype={constructor:d,logger:o,log:p,registerHelper:function(a,b){if(m.call(a)===n){if(b)throw new g("Arg not supported with multiple helpers");f.extend(this.helpers,a)}else this.helpers[a]=b},unregisterHelper:function(a){delete this.helpers[a]},registerPartial:function(a,b){m.call(a)===n?f.extend(this.partials,a):this.partials[a]=b},unregisterPartial:function(a){delete this.partials[a]}};var o={methodMap:{0:"debug",1:"info",2:"warn",3:"error"},DEBUG:0,INFO:1,WARN:2,ERROR:3,level:3,log:function(a,b){if(o.level<=a){var c=o.methodMap[a];"undefined"!=typeof console&&console[c]&&console[c].call(console,b)}}};b.logger=o;var p=o.log;b.log=p;var q=function(a){var b=f.extend({},a);return b._parent=a,b};b.createFrame=q},function(a,b,c){"use strict";function d(a){return j[a]}function e(a){for(var b=1;b<arguments.length;b++)for(var c in arguments[b])Object.prototype.hasOwnProperty.call(arguments[b],c)&&(a[c]=arguments[b][c]);return a}function f(a){return a instanceof i?a.toString():null==a?"":a?(a=""+a,l.test(a)?a.replace(k,d):a):a+""}function g(a){return a||0===a?o(a)&&0===a.length?!0:!1:!0}function h(a,b){return(a?a+".":"")+b}var i=c(123)["default"],j={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},k=/[&<>"'`]/g,l=/[&<>"'`]/;b.extend=e;var m=Object.prototype.toString;b.toString=m;var n=function(a){return"function"==typeof a};n(/x/)&&(n=function(a){return"function"==typeof a&&"[object Function]"===m.call(a)});var n;b.isFunction=n;var o=Array.isArray||function(a){return a&&"object"==typeof a?"[object Array]"===m.call(a):!1};b.isArray=o,b.escapeExpression=f,b.isEmpty=g,b.appendContextPath=h},function(a,b){"use strict";function c(a){this.string=a}c.prototype.toString=function(){return""+this.string},b["default"]=c},function(a,b){"use strict";function c(a,b){var c;b&&b.firstLine&&(c=b.firstLine,a+=" - "+c+":"+b.firstColumn);for(var e=Error.prototype.constructor.call(this,a),f=0;f<d.length;f++)this[d[f]]=e[d[f]];c&&(this.lineNumber=c,this.column=b.firstColumn)}var d=["description","fileName","lineNumber","message","name","number","stack"];c.prototype=new Error,b["default"]=c},function(a,b,c){"use strict";function d(a){var b=a&&a[0]||1,c=l;if(b!==c){if(c>b){var d=m[c],e=m[b];throw new k("Template was precompiled with an older version of Handlebars than the current runtime. Please update your precompiler to a newer version ("+d+") or downgrade your runtime to an older version ("+e+").")}throw new k("Template was precompiled with a newer version of Handlebars than the current runtime. Please update your runtime to a newer version ("+a[1]+").")}}function e(a,b){if(!b)throw new k("No environment passed to template");if(!a||!a.main)throw new k("Unknown template object: "+typeof a);b.VM.checkRevision(a.compiler);var c=function(c,d,e,f,g,h,i,l,m){g&&(f=j.extend({},f,g));var n=b.VM.invokePartial.call(this,c,e,f,h,i,l,m);if(null==n&&b.compile){var o={helpers:h,partials:i,data:l,depths:m};i[e]=b.compile(c,{data:void 0!==l,compat:a.compat},b),n=i[e](f,o)}if(null!=n){if(d){for(var p=n.split("\n"),q=0,r=p.length;r>q&&(p[q]||q+1!==r);q++)p[q]=d+p[q];n=p.join("\n")}return n}throw new k("The partial "+e+" could not be compiled when running in runtime-only mode")},d={lookup:function(a,b){for(var c=a.length,d=0;c>d;d++)if(a[d]&&null!=a[d][b])return a[d][b]},lambda:function(a,b){return"function"==typeof a?a.call(b):a},escapeExpression:j.escapeExpression,invokePartial:c,fn:function(b){return a[b]},programs:[],program:function(a,b,c){var d=this.programs[a],e=this.fn(a);return b||c?d=f(this,a,e,b,c):d||(d=this.programs[a]=f(this,a,e)),d},data:function(a,b){for(;a&&b--;)a=a._parent;return a},merge:function(a,b){var c=a||b;return a&&b&&a!==b&&(c=j.extend({},b,a)),c},noop:b.VM.noop,compilerInfo:a.compiler},e=function(b,c){c=c||{};var f=c.data;e._setup(c),!c.partial&&a.useData&&(f=i(b,f));var g;return a.useDepths&&(g=c.depths?[b].concat(c.depths):[b]),a.main.call(d,b,d.helpers,d.partials,f,g)};return e.isTop=!0,e._setup=function(c){c.partial?(d.helpers=c.helpers,d.partials=c.partials):(d.helpers=d.merge(c.helpers,b.helpers),a.usePartial&&(d.partials=d.merge(c.partials,b.partials)))},e._child=function(b,c,e){if(a.useDepths&&!e)throw new k("must pass parent depths");return f(d,b,a[b],c,e)},e}function f(a,b,c,d,e){var f=function(b,f){return f=f||{},c.call(a,b,a.helpers,a.partials,f.data||d,e&&[b].concat(e))};return f.program=b,f.depth=e?e.length:0,f}function g(a,b,c,d,e,f,g){var h={partial:!0,helpers:d,partials:e,data:f,depths:g};if(void 0===a)throw new k("The partial "+b+" could not be found");return a instanceof Function?a(c,h):void 0}function h(){return""}function i(a,b){return b&&"root"in b||(b=b?n(b):{},b.root=a),b}var j=c(122),k=c(124)["default"],l=c(121).COMPILER_REVISION,m=c(121).REVISION_CHANGES,n=c(121).createFrame;b.checkRevision=d,b.template=e,b.program=f,b.invokePartial=g,b.noop=h},function(a,b,c){var d,e;d=[c(45),c(54),c(65),c(47)],e=function(a,b,c,d){var e=b.style,f={back:!0,fontSize:15,fontFamily:"Arial,sans-serif",fontOpacity:100,color:"#FFF",backgroundColor:"#000",backgroundOpacity:100,edgeStyle:null,windowColor:"#FFF",windowOpacity:0},g=function(g){function h(b){b=b||"";var c="jw-captions-window jw-reset";b?(r.innerHTML=b,q.className=c+" jw-captions-window-active"):(q.className=c,a.empty(r))}function i(a){o=a,m&&j(m.data,o)}function j(a,b){if(a&&b){var c=-1;if(!(n>=0&&k(a,b,n))){for(var d=0;d<a.length;d++)if(k(a,b,d)){c=d;break}-1===c?h(""):c!==n&&(n=c,h(a[n].text))}}}function k(a,b,c){var e=b.position;if(a[c].useMPEGTS){if(!b.metadata||!d.isNumber(b.metadata.mpegts))return!1;e=b.metadata.mpegts}return a[c].begin<=e&&(!a[c].end||a[c].end>=e)&&(c===a.length-1||a[c+1].begin>=e)}function l(a,c,d){var e=b.hexToRgba("#000000",d);"dropshadow"===a?c.textShadow="0 2px 1px "+e:"raised"===a?c.textShadow="0 0 5px "+e+", 0 1px 5px "+e+", 0 2px 5px "+e:"depressed"===a?c.textShadow="0 -2px 1px "+e:"uniform"===a&&(c.textShadow="-2px 0 1px "+e+",2px 0 1px "+e+",0 -2px 1px "+e+",0 2px 1px "+e+",-1px 1px 1px "+e+",1px 1px 1px "+e+",1px -1px 1px "+e+",1px 1px 1px "+e)}var m,n,o,p,q,r,s={};p=document.createElement("div"),p.className="jw-captions jw-reset",this.show=function(){p.className="jw-captions jw-captions-enabled jw-reset"},this.hide=function(){p.className="jw-captions jw-reset"},this.populate=function(a){return n=-1,m=a,a?void j(a.data,o):void h("")},this.resize=function(){var a=p.clientWidth,b=Math.pow(a/400,.6);if(b){var c=s.fontSize*b;e(p,{fontSize:Math.round(c)+"px"})}},this.setup=function(a){if(q=document.createElement("div"),r=document.createElement("span"),q.className="jw-captions-window jw-reset",r.className="jw-captions-text jw-reset",s=d.extend({},f,a),a){var c=s.fontOpacity,h=s.windowOpacity,i=s.edgeStyle,j=s.backgroundColor,k={},m={color:b.hexToRgba(s.color,c),fontFamily:s.fontFamily,fontStyle:s.fontStyle,fontWeight:s.fontWeight,textDecoration:s.textDecoration};h&&(k.backgroundColor=b.hexToRgba(s.windowColor,h)),l(i,m,c),s.back?m.backgroundColor=b.hexToRgba(j,s.backgroundOpacity):null===i&&l("uniform",m),e(q,k),e(r,m)}q.appendChild(r),p.appendChild(q),this.populate(g.get("captionsTrack"))},this.element=function(){return p},g.on("change:item",function(){o=null,n=-1,h("")},this),g.on("change:captionsTrack",function(a,b){this.populate(b)},this),g.mediaController.on("seek",function(){n=-1},this),g.mediaController.on("time seek",function(a){i(a)},this),g.mediaController.on("subtitlesTrackData",function(){m&&j(m.data,o)},this),g.on("change:state",function(a,b){switch(b){case c.IDLE:case c.ERROR:case c.COMPLETE:this.hide();break;default:this.show()}},this)};return g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(117),c(66),c(63),c(47)],e=function(a,b,c,d){var e=function(e,f){function g(a){return e.get("flashBlocked")?void 0:j?void j(a):void m.trigger(a.type===b.touchEvents.CLICK?"click":"tap")}function h(){return k?void k():void m.trigger("doubleClick")}var i,j,k;d.extend(this,c),i=f,this.element=function(){return i};var l=new a(i,{enableDoubleTap:!0});l.on("click tap",g),l.on("doubleClick doubleTap",h),this.clickHandler=g;var m=this;this.setAlternateClickHandlers=function(a,b){j=a,k=b||null},this.revertAlternateClickHandlers=function(){j=null,k=null}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(63),c(117),c(129),c(47)],e=function(a,b,c,d,e){var f=function(f){e.extend(this,b),this.model=f,this.el=a.createElement(d({}));var g=this;this.iconUI=new c(this.el).on("click tap",function(a){g.trigger(a.type)})};return e.extend(f.prototype,{element:function(){return this.el}}),f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){return'<div class="jw-display-icon-container jw-background-color jw-reset">\n    <div class="jw-icon jw-icon-display jw-button-color jw-reset"></div>\n</div>\n'},useData:!0})},function(a,b,c){var d,e;d=[c(131),c(45),c(47),c(117)],e=function(a,b,c,d){var e=function(a){this.model=a,this.setup(),this.model.on("change:dock",this.render,this)};return c.extend(e.prototype,{setup:function(){var c=this.model.get("dock"),e=this.click.bind(this),f=a(c);this.el=b.createElement(f),new d(this.el).on("click tap",e)},getDockButton:function(a){return b.hasClass(a.target,"jw-dock-button")?a.target:b.hasClass(a.target,"jw-dock-text")?a.target.parentElement.parentElement:a.target.parentElement},click:function(a){var b=this.getDockButton(a),d=b.getAttribute("button"),e=this.model.get("dock"),f=c.findWhere(e,{id:d});f&&f.callback&&f.callback()},render:function(){var c=this.model.get("dock"),d=a(c),e=b.createElement(d);this.el.innerHTML=e.innerHTML},element:function(){return this.el}}),e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f,g="function",h=b.helperMissing,i=this.escapeExpression,j='    <div class="jw-dock-button jw-background-color jw-reset" button="'+i((f=null!=(f=b.id||(null!=a?a.id:a))?f:h,typeof f===g?f.call(a,{name:"id",hash:{},data:d}):f))+'">\n        <div class="jw-icon jw-dock-image jw-reset" style="background-image: url('+i((f=null!=(f=b.img||(null!=a?a.img:a))?f:h,typeof f===g?f.call(a,{name:"img",hash:{},data:d}):f))+')"></div>\n        <div class="jw-arrow jw-reset"></div>\n';return e=b["if"].call(a,null!=a?a.tooltip:a,{name:"if",hash:{},fn:this.program(2,d),inverse:this.noop,data:d}),null!=e&&(j+=e),j+"    </div>\n"},2:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'        <div class="jw-overlay jw-background-color jw-reset">\n            <span class="jw-text jw-dock-text jw-reset">'+h((e=null!=(e=b.tooltip||(null!=a?a.tooltip:a))?e:g,typeof e===f?e.call(a,{name:"tooltip",hash:{},data:d}):e))+"</span>\n        </div>\n"},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-dock jw-reset">\n';return e=b.each.call(a,a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"</div>"},useData:!0})},function(a,b,c){var d,e;d=[c(45),c(47),c(63),c(117),c(134),c(133),c(140),c(142),c(144),c(145)],e=function(a,b,c,d,e,f,g,h,i,j){function k(a,b){var c=document.createElement("div");return c.className="jw-icon jw-icon-inline jw-button-color jw-reset "+a,c.style.display="none",b&&new d(c).on("click tap",function(){b()}),{element:function(){return c},toggle:function(a){a?this.show():this.hide()},show:function(){c.style.display=""},hide:function(){c.style.display="none"}}}function l(a){var b=document.createElement("span");return b.className="jw-text jw-reset "+a,b}function m(a){var b=new g(a);return b}function n(a,c){var d=document.createElement("div");return d.className="jw-group jw-controlbar-"+a+"-group jw-reset",b.each(c,function(a){a.element&&(a=a.element()),d.appendChild(a)}),d}function o(b,c){this._api=b,this._model=c,this._isMobile=a.isMobile(),this._compactModeMaxSize=400,this._maxCompactWidth=-1,this.setup()}return b.extend(o.prototype,c,{setup:function(){this.build(),this.initialize()},build:function(){var a,c,d,g,o=new f(this._model,this._api),p=new j("jw-icon-more");this._model.get("visualplaylist")!==!1&&(a=new h("jw-icon-playlist")),this._isMobile||(g=k("jw-icon-volume",this._api.setMute),c=new e("jw-slider-volume","horizontal"),d=new i(this._model,"jw-icon-volume")),this.elements={alt:l("jw-text-alt"),play:k("jw-icon-playback",this._api.play),prev:k("jw-icon-prev",this._api.playlistPrev),next:k("jw-icon-next",this._api.playlistNext),playlist:a,elapsed:l("jw-text-elapsed"),time:o,duration:l("jw-text-duration"),drawer:p,hd:m("jw-icon-hd"),cc:m("jw-icon-cc"),audiotracks:m("jw-icon-audio-tracks"),mute:g,volume:c,volumetooltip:d,cast:k("jw-icon-cast jw-off",this._api.castToggle),fullscreen:k("jw-icon-fullscreen",this._api.setFullscreen)},this.layout={left:[this.elements.play,this.elements.prev,this.elements.playlist,this.elements.next,this.elements.elapsed],center:[this.elements.time,this.elements.alt],right:[this.elements.duration,this.elements.hd,this.elements.cc,this.elements.audiotracks,this.elements.drawer,this.elements.mute,this.elements.cast,this.elements.volume,this.elements.volumetooltip,this.elements.fullscreen],drawer:[this.elements.hd,this.elements.cc,this.elements.audiotracks]},this.menus=b.compact([this.elements.playlist,this.elements.hd,this.elements.cc,this.elements.audiotracks,this.elements.volumetooltip]),this.layout.left=b.compact(this.layout.left),this.layout.center=b.compact(this.layout.center),this.layout.right=b.compact(this.layout.right),this.layout.drawer=b.compact(this.layout.drawer),this.el=document.createElement("div"),this.el.className="jw-controlbar jw-background-color jw-reset",this.elements.left=n("left",this.layout.left),this.elements.center=n("center",this.layout.center),this.elements.right=n("right",this.layout.right),this.el.appendChild(this.elements.left),this.el.appendChild(this.elements.center),this.el.appendChild(this.elements.right)},initialize:function(){this.elements.play.show(),this.elements.fullscreen.show(),this.elements.mute&&this.elements.mute.show(),
this.onVolume(this._model,this._model.get("volume")),this.onPlaylist(this._model,this._model.get("playlist")),this.onPlaylistItem(this._model,this._model.get("playlistItem")),this.onCastAvailable(this._model,this._model.get("castAvailable")),this.onCaptionsList(this._model,this._model.get("captionsList")),this._model.on("change:volume",this.onVolume,this),this._model.on("change:mute",this.onMute,this),this._model.on("change:playlist",this.onPlaylist,this),this._model.on("change:playlistItem",this.onPlaylistItem,this),this._model.on("change:castAvailable",this.onCastAvailable,this),this._model.on("change:duration",this.onDuration,this),this._model.on("change:position",this.onElapsed,this),this._model.on("change:fullscreen",this.onFullscreen,this),this._model.on("change:captionsList",this.onCaptionsList,this),this._model.on("change:captionsIndex",this.onCaptionsIndex,this),this._model.on("change:compactUI",this.onCompactUI,this),this.elements.volume&&this.elements.volume.on("update",function(a){var b=a.percentage;this._api.setVolume(b)},this),this.elements.volumetooltip&&(this.elements.volumetooltip.on("update",function(a){var b=a.percentage;this._api.setVolume(b)},this),this.elements.volumetooltip.on("toggleValue",function(){this._api.setMute()},this)),this.elements.playlist&&this.elements.playlist.on("select",function(a){this._model.once("setItem",function(){this._api.play()},this),this._api.load(a)},this),this.elements.hd.on("select",function(a){this._model.getVideo().setCurrentQuality(a)},this),this.elements.hd.on("toggleValue",function(){this._model.getVideo().setCurrentQuality(0===this._model.getVideo().getCurrentQuality()?1:0)},this),this.elements.cc.on("select",function(a){this._api.setCurrentCaptions(a)},this),this.elements.cc.on("toggleValue",function(){var a=this._model.get("captionsIndex");this._api.setCurrentCaptions(a?0:1)},this),this.elements.audiotracks.on("select",function(a){this._model.getVideo().setCurrentAudioTrack(a)},this),new d(this.elements.duration).on("click tap",function(){"DVR"===a.adaptiveType(this._model.get("duration"))&&this._api.seek(-.1)},this),new d(this.el).on("click tap drag",function(){this.trigger("userAction")},this),this.elements.drawer.on("open-drawer close-drawer",function(b,c){a.toggleClass(this.el,"jw-drawer-expanded",c.isOpen),c.isOpen||this.closeMenus()},this),b.each(this.menus,function(a){a.on("open-tooltip",this.closeMenus,this)},this)},onCaptionsList:function(a,b){var c=a.get("captionsIndex");this.elements.cc.setup(b,c),this.clearCompactMode()},onCaptionsIndex:function(a,b){this.elements.cc.selectItem(b)},onPlaylist:function(a,b){var c=b.length>1;this.elements.next.toggle(c),this.elements.prev.toggle(c),this.elements.playlist&&this.elements.playlist.setup(b,a.get("item"))},onPlaylistItem:function(c){this.elements.time.updateBuffer(0),this.elements.time.render(0),this.elements.duration.innerHTML="00:00",this.elements.elapsed.innerHTML="00:00",this.clearCompactMode();var d=c.get("item");this.elements.playlist&&this.elements.playlist.selectItem(d),this.elements.audiotracks.setup(),this._model.mediaModel.on("change:levels",function(a,b){this.elements.hd.setup(b,a.get("currentLevel")),this.clearCompactMode()},this),this._model.mediaModel.on("change:currentLevel",function(a,b){this.elements.hd.selectItem(b)},this),this._model.mediaModel.on("change:audioTracks",function(a,c){var d=b.map(c,function(a){return{label:a.name}});this.elements.audiotracks.setup(d,a.get("currentAudioTrack"),{toggle:!1}),this.clearCompactMode()},this),this._model.mediaModel.on("change:currentAudioTrack",function(a,b){this.elements.audiotracks.selectItem(b)},this),this._model.mediaModel.on("change:state",function(b,c){"complete"===c&&(this.elements.drawer.closeTooltip(),a.removeClass(this.el,"jw-drawer-expanded"))},this)},onVolume:function(a,b){this.renderVolume(a.get("mute"),b)},onMute:function(a,b){this.renderVolume(b,a.get("volume"))},renderVolume:function(b,c){this.elements.mute&&a.toggleClass(this.elements.mute.element(),"jw-off",b),this.elements.volume&&this.elements.volume.render(b?0:c),this.elements.volumetooltip&&(this.elements.volumetooltip.volumeSlider.render(b?0:c),a.toggleClass(this.elements.volumetooltip.element(),"jw-off",b))},onCastAvailable:function(a,b){this.elements.cast.toggle(b),this.clearCompactMode()},onElapsed:function(b,c){var d,e=b.get("duration");d="DVR"===a.adaptiveType(e)?"-"+a.timeFormat(-e):a.timeFormat(c),this.elements.elapsed.innerHTML=d},onDuration:function(b,c){var d;"DVR"===a.adaptiveType(c)?(d="Live",this.clearCompactMode()):d=a.timeFormat(c),this.elements.duration.innerHTML=d},onFullscreen:function(b,c){a.toggleClass(this.elements.fullscreen.element(),"jw-off",c)},element:function(){return this.el},getVisibleBounds:function(){var b,c=this.el,d=getComputedStyle?getComputedStyle(c):c.currentStyle;return"table"===d.display?a.bounds(c):(c.style.visibility="hidden",c.style.display="table",b=a.bounds(c),c.style.visibility=c.style.display="",b)},setAltText:function(a){this.elements.alt.innerHTML=a},addCues:function(a){this.elements.time&&(b.each(a,function(a){this.elements.time.addCue(a)},this),this.elements.time.drawCues())},closeMenus:function(a){b.each(this.menus,function(b){a&&a.target===b.el||b.closeTooltip(a)})},hideComponents:function(){this.closeMenus(),this.elements.drawer.closeTooltip(),a.removeClass(this.el,"jw-drawer-expanded")},clearCompactMode:function(){this._maxCompactWidth=-1,this._model.set("compactUI",!1)},setCompactModeBounds:function(){if(this.element().offsetWidth>0){var b=this.elements.left.offsetWidth+this.elements.right.offsetWidth;if("LIVE"===a.adaptiveType(this._model.get("duration")))this._maxCompactWidth=b+this.elements.alt.offsetWidth;else{var c=b+(this.elements.center.offsetWidth-this.elements.time.el.offsetWidth),d=.25;this._maxCompactWidth=c/(1-d)}}},checkCompactMode:function(a){-1===this._maxCompactWidth&&this.setCompactModeBounds(),-1!==this._maxCompactWidth&&(this._model.get("compactUI")?a>this._compactModeMaxSize&&a>this._maxCompactWidth&&this._model.set("compactUI",!1):(a<=this._compactModeMaxSize||a<=this._maxCompactWidth)&&this._model.set("compactUI",!0))},onCompactUI:function(c,d){a.removeClass(this.el,"jw-drawer-expanded"),this.elements.drawer.setup(this.layout.drawer,d),(!d||this.elements.drawer.activeContents.length<2)&&b.each(this.layout.drawer,function(a){this.elements.right.insertBefore(a.el,this.elements.drawer.el)},this)}}),o}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(134),c(45),c(137),c(138),c(139)],e=function(a,b,c,d,e,f){var g=d.extend({setup:function(){this.text=document.createElement("span"),this.text.className="jw-text jw-reset",this.img=document.createElement("div"),this.img.className="jw-reset";var a=document.createElement("div");a.className="jw-time-tip jw-background-color jw-reset",a.appendChild(this.img),a.appendChild(this.text),c.removeClass(this.el,"jw-hidden"),this.addContent(a)},image:function(a){c.style(this.img,a)},update:function(a){this.text.innerHTML=a}}),h=b.extend({constructor:function(c,d){this._model=c,this._api=d,this.timeTip=new g("jw-tooltip-time"),this.timeTip.setup(),this.seekThrottled=a.throttle(this.performSeek,400),this._model.on("change:playlistItem",this.onPlaylistItem,this).on("change:position",this.onPosition,this).on("change:buffer",this.onBuffer,this),b.call(this,"jw-slider-time","horizontal")},setup:function(){b.prototype.setup.apply(this,arguments),this.onPlaylistItem(this._model,this._model.get("playlistItem")),this.elementRail.appendChild(this.timeTip.element()),this.elementRail.addEventListener("mousemove",this.showTimeTooltip.bind(this),!1),this.elementRail.addEventListener("mouseout",this.hideTimeTooltip.bind(this),!1)},update:function(c){this.activeCue&&a.isNumber(this.activeCue.pct)?this.seekTo=this.activeCue.pct:this.seekTo=c,this.seekThrottled(),b.prototype.update.apply(this,arguments)},dragStart:function(){this._model.set("scrubbing",!0),b.prototype.dragStart.apply(this,arguments)},dragEnd:function(){b.prototype.dragEnd.apply(this,arguments),this._model.set("scrubbing",!1)},onSeeked:function(){this._model.get("scrubbing")&&this.performSeek()},onBuffer:function(a,b){this.updateBuffer(b)},onPosition:function(a,b){var d=0,e=this._model.get("duration");if(e){var f=c.adaptiveType(e);"DVR"===f?d=(e-b)/e*100:"VOD"===f&&(d=b/e*100)}this.render(d)},onPlaylistItem:function(b,c){this.reset(),b.mediaModel.on("seeked",this.onSeeked,this);var d=c.tracks;a.each(d,function(a){a&&a.kind&&"thumbnails"===a.kind.toLowerCase()?this.loadThumbnails(a.file):a&&a.kind&&"chapters"===a.kind.toLowerCase()&&this.loadChapters(a.file)},this)},performSeek:function(){var a,b=this._model.get("duration"),d=c.adaptiveType(b);"LIVE"===d||0===b?this._api.play():"DVR"===d?(a=(1-this.seekTo/100)*b,this._api.seek(Math.min(a,-.25))):(a=this.seekTo/100*b,this._api.seek(Math.min(a,b-.25)))},showTimeTooltip:function(a){var b=this._model.get("duration");if(!(0>=b)){var d=c.bounds(this.elementRail),e=a.pageX?a.pageX-d.left:a.x;e=c.between(e,0,d.width);var f,g=e/d.width,h=b*g;f=this.activeCue?this.activeCue.text:c.timeFormat(h),this.timeTip.update(f),this.showThumbnail(h),c.addClass(this.timeTip.el,"jw-open"),this.timeTip.el.style.left=100*g+"%"}},hideTimeTooltip:function(){c.removeClass(this.timeTip.el,"jw-open")},reset:function(){this.resetChapters(),this.resetThumbnails()}});return a.extend(h.prototype,e,f),h}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(135),c(117),c(136),c(45)],e=function(a,b,c,d){var e=a.extend({constructor:function(a,b){this.className=a+" jw-background-color jw-reset",this.orientation=b,this.dragStartListener=this.dragStart.bind(this),this.dragMoveListener=this.dragMove.bind(this),this.dragEndListener=this.dragEnd.bind(this),this.tapListener=this.tap.bind(this),this.setup()},setup:function(){var a={"default":this["default"],className:this.className,orientation:"jw-slider-"+this.orientation};this.el=d.createElement(c(a)),this.elementRail=this.el.getElementsByClassName("jw-slider-container")[0],this.elementBuffer=this.el.getElementsByClassName("jw-buffer")[0],this.elementProgress=this.el.getElementsByClassName("jw-progress")[0],this.elementThumb=this.el.getElementsByClassName("jw-knob")[0],this.userInteract=new b(this.element(),{preventScrolling:!0}),this.userInteract.on("dragStart",this.dragStartListener),this.userInteract.on("drag",this.dragMoveListener),this.userInteract.on("dragEnd",this.dragEndListener),this.userInteract.on("tap click",this.tapListener)},dragStart:function(){this.trigger("dragStart"),this.railBounds=d.bounds(this.elementRail)},dragEnd:function(a){this.dragMove(a),this.trigger("dragEnd")},dragMove:function(a){var b,c,e=this.railBounds=this.railBounds?this.railBounds:d.bounds(this.elementRail);return"horizontal"===this.orientation?(b=a.pageX,c=b<e.left?0:b>e.right?100:100*d.between((b-e.left)/e.width,0,1)):(b=a.pageY,c=b>=e.bottom?0:b<=e.top?100:100*d.between((e.height-(b-e.top))/e.height,0,1)),this.render(c),this.update(c),!1},tap:function(a){this.railBounds=d.bounds(this.elementRail),this.dragMove(a)},update:function(a){this.trigger("update",{percentage:a})},render:function(a){a=Math.max(0,Math.min(a,100)),"horizontal"===this.orientation?(this.elementThumb.style.left=a+"%",this.elementProgress.style.width=a+"%"):(this.elementThumb.style.bottom=a+"%",this.elementProgress.style.height=a+"%")},updateBuffer:function(a){this.elementBuffer.style.width=a+"%"},element:function(){return this.el}});return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(63),c(47)],e=function(a,b){function c(){}var d=function(a,c){var d,e=this;d=a&&b.has(a,"constructor")?a.constructor:function(){return e.apply(this,arguments)},b.extend(d,e,c);var f=function(){this.constructor=d};return f.prototype=e.prototype,d.prototype=new f,a&&b.extend(d.prototype,a),d.__super__=e.prototype,d};return c.extend=d,b.extend(c.prototype,a),c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'<div class="'+h((e=null!=(e=b.className||(null!=a?a.className:a))?e:g,typeof e===f?e.call(a,{name:"className",hash:{},data:d}):e))+" "+h((e=null!=(e=b.orientation||(null!=a?a.orientation:a))?e:g,typeof e===f?e.call(a,{name:"orientation",hash:{},data:d}):e))+' jw-reset">\n    <div class="jw-slider-container jw-reset">\n        <div class="jw-rail jw-reset"></div>\n        <div class="jw-buffer jw-reset"></div>\n        <div class="jw-progress jw-reset"></div>\n        <div class="jw-knob jw-reset"></div>\n    </div>\n</div>'},useData:!0})},function(a,b,c){var d,e;d=[c(135),c(45)],e=function(a,b){var c=a.extend({constructor:function(a){this.el=document.createElement("div"),this.el.className="jw-icon jw-icon-tooltip "+a+" jw-button-color jw-reset jw-hidden",this.container=document.createElement("div"),this.container.className="jw-overlay jw-reset",this.openClass="jw-open",this.componentType="tooltip",this.el.appendChild(this.container)},addContent:function(a){this.content&&this.removeContent(),this.content=a,this.container.appendChild(a)},removeContent:function(){this.content&&(this.container.removeChild(this.content),this.content=null)},hasContent:function(){return!!this.content},element:function(){return this.el},openTooltip:function(a){this.trigger("open-"+this.componentType,a,{isOpen:!0}),this.isOpen=!0,b.toggleClass(this.el,this.openClass,this.isOpen)},closeTooltip:function(a){this.trigger("close-"+this.componentType,a,{isOpen:!1}),this.isOpen=!1,b.toggleClass(this.el,this.openClass,this.isOpen)},toggleOpenState:function(a){this.isOpen?this.closeTooltip(a):this.openTooltip(a)}});return c}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45),c(111)],e=function(a,b,c){function d(a,b){this.time=a,this.text=b,this.el=document.createElement("div"),this.el.className="jw-cue jw-reset"}a.extend(d.prototype,{align:function(a){"%"===this.time.toString().slice(-1)?this.pct=this.time:this.pct=this.time/a*100,this.el.style.left=this.pct+"%"}});var e={loadChapters:function(a){b.ajax(a,this.chaptersLoaded.bind(this),this.chaptersFailed,!0)},chaptersLoaded:function(b){var d=c(b.responseText);a.isArray(d)&&(a.each(d,this.addCue,this),this.drawCues())},chaptersFailed:function(){},addCue:function(a){this.cues.push(new d(a.begin,a.text))},drawCues:function(){var b=this._model.mediaModel.get("duration");if(!b||0>=b)return void this._model.mediaModel.once("change:duration",this.drawCues,this);var c=this;a.each(this.cues,function(a){a.align(b),a.el.addEventListener("mouseover",function(){c.activeCue=a}),a.el.addEventListener("mouseout",function(){c.activeCue=null}),c.elementRail.appendChild(a.el)})},resetChapters:function(){a.each(this.cues,function(a){a.el.parentNode&&a.el.parentNode.removeChild(a.el)},this),this.cues=[]}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(45),c(111)],e=function(a,b,c){function d(a){this.begin=a.begin,this.end=a.end,this.img=a.text}var e={loadThumbnails:function(a){a&&(this.vttPath=a.split("?")[0].split("/").slice(0,-1).join("/"),this.individualImage=null,b.ajax(a,this.thumbnailsLoaded.bind(this),this.thumbnailsFailed.bind(this),!0))},thumbnailsLoaded:function(b){var e=c(b.responseText);a.isArray(e)&&(a.each(e,function(a){this.thumbnails.push(new d(a))},this),this.drawCues())},thumbnailsFailed:function(){},chooseThumbnail:function(b){var c=a.sortedIndex(this.thumbnails,{end:b},a.property("end"));c>=this.thumbnails.length&&(c=this.thumbnails.length-1);var d=this.thumbnails[c].img;return d.indexOf("://")<0&&(d=this.vttPath?this.vttPath+"/"+d:d),d},loadThumbnail:function(b){var c=this.chooseThumbnail(b),d={display:"block",margin:"0 auto",backgroundPosition:"0 0"},e=c.indexOf("#xywh");if(e>0)try{var f=/(.+)\#xywh=(\d+),(\d+),(\d+),(\d+)/.exec(c);c=f[1],d.backgroundPosition=-1*f[2]+"px "+-1*f[3]+"px",d.width=f[4],d.height=f[5]}catch(g){return}else this.individualImage||(this.individualImage=new Image,this.individualImage.onload=a.bind(function(){this.individualImage.onload=null,this.timeTip.image({width:this.individualImage.width,height:this.individualImage.height})},this),this.individualImage.src=c);return d.backgroundImage=c,d},showThumbnail:function(a){this.thumbnails.length<1||this.timeTip.image(this.loadThumbnail(a))},resetThumbnails:function(){this.timeTip.image({backgroundImage:"",width:0,height:0}),this.thumbnails=[]}};return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(137),c(45),c(47),c(117),c(141)],e=function(a,b,c,d,e){var f=a.extend({setup:function(a,f,g){this.iconUI||(this.iconUI=new d(this.el,{useHover:!0,directSelect:!0}),this.toggleValueListener=this.toggleValue.bind(this),this.toggleOpenStateListener=this.toggleOpenState.bind(this),this.openTooltipListener=this.openTooltip.bind(this),this.closeTooltipListener=this.closeTooltip.bind(this),this.selectListener=this.select.bind(this)),this.reset(),a=c.isArray(a)?a:[],b.toggleClass(this.el,"jw-hidden",a.length<2);var h=a.length>2||2===a.length&&g&&g.toggle===!1,i=!h&&2===a.length;if(b.toggleClass(this.el,"jw-toggle",i),b.toggleClass(this.el,"jw-button-color",!i),this.isActive=h||i,h){b.removeClass(this.el,"jw-off"),this.iconUI.on("tap",this.toggleOpenStateListener).on("over",this.openTooltipListener).on("out",this.closeTooltipListener);var j=e(a),k=b.createElement(j);this.addContent(k),this.contentUI=new d(this.content).on("click tap",this.selectListener)}else i&&this.iconUI.on("click tap",this.toggleValueListener);this.selectItem(f)},toggleValue:function(){this.trigger("toggleValue")},select:function(a){if(a.target.parentElement===this.content){var d=b.classList(a.target),e=c.find(d,function(a){return 0===a.indexOf("jw-item")});e&&(this.trigger("select",parseInt(e.split("-")[2])),this.closeTooltipListener())}},selectItem:function(a){if(this.content)for(var c=0;c<this.content.children.length;c++)b.toggleClass(this.content.children[c],"jw-active-option",a===c);else b.toggleClass(this.el,"jw-off",0===a)},reset:function(){b.addClass(this.el,"jw-off"),this.iconUI.off(),this.contentUI&&this.contentUI.off().destroy(),this.removeContent()}});return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e=this.lambda,f=this.escapeExpression;return"        <li class='jw-text jw-option jw-item-"+f(e(d&&d.index,a))+" jw-reset'>"+f(e(null!=a?a.label:a,a))+"</li>\n"},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<ul class="jw-menu jw-background-color jw-reset">\n';return e=b.each.call(a,a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"</ul>"},useData:!0})},function(a,b,c){var d,e;d=[c(45),c(47),c(137),c(117),c(143)],e=function(a,b,c,d,e){var f=c.extend({setup:function(c,e){if(this.iconUI||(this.iconUI=new d(this.el,{useHover:!0}),this.toggleOpenStateListener=this.toggleOpenState.bind(this),this.openTooltipListener=this.openTooltip.bind(this),this.closeTooltipListener=this.closeTooltip.bind(this),this.selectListener=this.onSelect.bind(this)),this.reset(),c=b.isArray(c)?c:[],a.toggleClass(this.el,"jw-hidden",c.length<2),c.length>=2){this.iconUI=new d(this.el,{useHover:!0}).on("tap",this.toggleOpenStateListener).on("over",this.openTooltipListener).on("out",this.closeTooltipListener);var f=this.menuTemplate(c,e),g=a.createElement(f);this.addContent(g),this.contentUI=new d(this.content),this.contentUI.on("click tap",this.selectListener)}this.originalList=c},menuTemplate:function(a,c){var d=b.map(a,function(a,b){return{active:b===c,label:b+1+".",title:a.title}});return e(d)},onSelect:function(c){var d=c.target;if("UL"!==d.tagName){"LI"!==d.tagName&&(d=d.parentElement);var e=a.classList(d),f=b.find(e,function(a){return 0===a.indexOf("jw-item")});f&&(this.trigger("select",parseInt(f.split("-")[2])),this.closeTooltip())}},selectItem:function(a){this.setup(this.originalList,a)},reset:function(){this.iconUI.off(),this.contentUI&&this.contentUI.off().destroy(),this.removeContent()}});return f}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f="";return e=b["if"].call(a,null!=a?a.active:a,{name:"if",hash:{},fn:this.program(2,d),inverse:this.program(4,d),data:d}),null!=e&&(f+=e),f},2:function(a,b,c,d){var e=this.lambda,f=this.escapeExpression;return"                <li class='jw-option jw-text jw-active-option jw-item-"+f(e(d&&d.index,a))+' jw-reset\'>\n                    <span class="jw-label jw-reset"><span class="jw-icon jw-icon-play jw-reset"></span></span>\n                    <span class="jw-name jw-reset">'+f(e(null!=a?a.title:a,a))+"</span>\n                </li>\n"},4:function(a,b,c,d){var e=this.lambda,f=this.escapeExpression;return"                <li class='jw-option jw-text jw-item-"+f(e(d&&d.index,a))+' jw-reset\'>\n                    <span class="jw-label jw-reset">'+f(e(null!=a?a.label:a,a))+'</span>\n                    <span class="jw-name jw-reset">'+f(e(null!=a?a.title:a,a))+"</span>\n                </li>\n"},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-menu jw-playlist-container jw-background-color jw-reset">\n\n    <div class="jw-tooltip-title jw-reset">\n        <span class="jw-icon jw-icon-inline jw-icon-playlist jw-reset"></span>\n        <span class="jw-text jw-reset">PLAYLIST</span>\n    </div>\n\n    <ul class="jw-playlist jw-reset">\n';return e=b.each.call(a,a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"    </ul>\n</div>"},useData:!0})},function(a,b,c){var d,e;d=[c(137),c(134),c(117),c(45)],e=function(a,b,c,d){var e=a.extend({constructor:function(e,f){this._model=e,a.call(this,f),this.volumeSlider=new b("jw-slider-volume jw-volume-tip","vertical"),this.addContent(this.volumeSlider.element()),this.volumeSlider.on("update",function(a){this.trigger("update",a)},this),d.removeClass(this.el,"jw-hidden"),new c(this.el,{useHover:!0,directSelect:!0}).on("click",this.toggleValue,this).on("tap",this.toggleOpenState,this).on("over",this.openTooltip,this).on("out",this.closeTooltip,this),this._model.on("change:volume",this.onVolume,this)},toggleValue:function(){this.trigger("toggleValue")}});return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(137),c(45),c(47),c(117)],e=function(a,b,c,d){var e=a.extend({constructor:function(b){a.call(this,b),this.container.className="jw-overlay-horizontal jw-reset",this.openClass="jw-open-drawer",this.componentType="drawer"},setup:function(a,e){this.iconUI||(this.iconUI=new d(this.el,{useHover:!0,directSelect:!0}),this.toggleOpenStateListener=this.toggleOpenState.bind(this),this.openTooltipListener=this.openTooltip.bind(this),this.closeTooltipListener=this.closeTooltip.bind(this)),this.reset(),a=c.isArray(a)?a:[],this.activeContents=c.filter(a,function(a){return a.isActive}),b.toggleClass(this.el,"jw-hidden",!e||this.activeContents.length<2),e&&this.activeContents.length>1&&(b.removeClass(this.el,"jw-off"),this.iconUI.on("tap",this.toggleOpenStateListener).on("over",this.openTooltipListener).on("out",this.closeTooltipListener),c.each(a,function(a){this.container.appendChild(a.el)},this))},reset:function(){b.addClass(this.el,"jw-off"),this.iconUI.off(),this.contentUI&&this.contentUI.off().destroy(),this.removeContent()}});return e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=function(a){this.model=a,this.model.on("change:playlistItem",this.loadImage,this)};return a.extend(b.prototype,{setup:function(a){this.el=a,this.loadImage(this.model,this.model.get("playlistItem"))},loadImage:function(b,c){var d=c.image;a.isString(d)?(d=encodeURI(d),this.el.style.backgroundImage='url("'+d+'")'):this.el.style.backgroundImage=""},element:function(){return this.el}}),b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(71),c(148),c(47),c(58)],e=function(a,b,c,d){function e(a){return a.charAt(0).toUpperCase()+a.slice(1)}function f(a){return"pro"===a?"p":"premium"===a?"r":"enterprise"===a?"e":"ads"===a?"a":"f"}var g=function(){};return c.extend(g.prototype,b.prototype,{buildArray:function(){var c=b.prototype.buildArray.apply(this,arguments),g=this.model.get("edition"),h=d.split("+")[0],i="//jwplayer.com/learn-more/?m=h&e="+f(g)+"&v="+d;c.items[0].link=i,c.items[0].title="About JW Player "+e(g)+" "+h;var j=a(g);if(!j("custom-rightclick"))return c;if(this.model.get("abouttext")){var k={title:this.model.get("abouttext"),link:this.model.get("aboutlink")||i};c.items.splice(1,0,k)}return c}}),g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(45),c(149),c(47),c(58)],e=function(a,b,c,d){var e=function(){};return c.extend(e.prototype,{buildArray:function(){var b=d.split("+"),c=b[0],e={items:[{title:"About JW Player "+c,featured:!0,link:"//jwplayer.com/learn-more/?m=h&e=o&v="+d}]},f=c.indexOf("-")>0,g=b[1];if(f&&g){var h=g.split(".");e.items.push({title:"build: ("+h[0]+"."+h[1]+")",link:"#"})}var i=this.model.get("provider").name;if(i.indexOf("flash")>=0){var j="Flash Version "+a.flashVersion();e.items.push({title:j,link:"http://www.adobe.com/software/flash/about/"})}return e},buildMenu:function(){var c=this.buildArray();return a.createElement(b(c))},updateHtml:function(){this.el.innerHTML=this.buildMenu().innerHTML},rightClick:function(a){return this.lazySetup(),this.mouseOverContext?!1:(this.hideMenu(),this.showMenu(a),!1)},getOffset:function(a){for(var b=a.target,c=a.offsetX||a.layerX,d=a.offsetY||a.layerY;b!==this.playerElement;)c+=b.offsetLeft,d+=b.offsetTop,b=b.parentNode;return{x:c,y:d}},showMenu:function(b){var c=this.getOffset(b);return this.el.style.left=c.x+"px",this.el.style.top=c.y+"px",a.addClass(this.playerElement,"jw-flag-rightclick-open"),a.addClass(this.el,"jw-open"),!1},hideMenu:function(){this.mouseOverContext||(a.removeClass(this.playerElement,"jw-flag-rightclick-open"),a.removeClass(this.el,"jw-open"))},lazySetup:function(){this.el||(this.el=this.buildMenu(),this.layer.appendChild(this.el),this.hideMenuCallback=this.hideMenu.bind(this),this.playerElement.onclick=this.hideMenuCallback,document.addEventListener("mousedown",this.hideMenuCallback,!1),this.model.on("change:provider",this.updateHtml,this),this.el.onmouseover=function(){this.mouseOverContext=!0}.bind(this),this.el.onmouseout=function(){this.mouseOverContext=!1}.bind(this))},setup:function(a,b,c){this.playerElement=b,this.model=a,this.mouseOverContext=!1,this.layer=c,b.oncontextmenu=this.rightClick.bind(this)},destroy:function(){this.el&&this.hideMenu(),this.playerElement&&(this.playerElement.oncontextmenu=null),this.model&&(this.model.off("change:provider",this.updateHtml),this.model=null)}}),e}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({1:function(a,b,c,d){var e,f,g="function",h=b.helperMissing,i=this.escapeExpression,j='        <li class="jw-reset';return e=b["if"].call(a,null!=a?a.featured:a,{name:"if",hash:{},fn:this.program(2,d),inverse:this.noop,data:d}),null!=e&&(j+=e),j+='">\n            <a href="'+i((f=null!=(f=b.link||(null!=a?a.link:a))?f:h,typeof f===g?f.call(a,{name:"link",hash:{},data:d}):f))+'" class="jw-reset" target="_top">\n',e=b["if"].call(a,null!=a?a.featured:a,{name:"if",hash:{},fn:this.program(4,d),inverse:this.noop,data:d}),null!=e&&(j+=e),j+"                "+i((f=null!=(f=b.title||(null!=a?a.title:a))?f:h,typeof f===g?f.call(a,{name:"title",hash:{},data:d}):f))+"\n            </a>\n        </li>\n"},2:function(a,b,c,d){return" jw-featured"},4:function(a,b,c,d){return'                <span class="jw-icon jw-rightclick-logo jw-reset"></span>\n'},compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f='<div class="jw-rightclick jw-reset">\n    <ul class="jw-reset">\n';return e=b.each.call(a,null!=a?a.items:a,{name:"each",hash:{},fn:this.program(1,d),inverse:this.noop,data:d}),null!=e&&(f+=e),f+"    </ul>\n</div>"},useData:!0})},function(a,b,c){var d,e;d=[c(47)],e=function(a){var b=function(a){this.model=a};return a.extend(b.prototype,{hide:function(){this.el.style.display="none"},show:function(){this.el.style.display=""},setup:function(a){this.el=a;var b=this.el.getElementsByTagName("div");this.title=b[0],this.description=b[1],this.model.on("change:playlistItem",this.playlistItem,this),this.playlistItem(this.model,this.model.get("playlistItem"))},playlistItem:function(a,b){a.get("displaytitle")||a.get("displaydescription")?this.updateText(a,b):this.hide()},updateText:function(a,b){this.title.innerHTML=b.title&&a.get("displaytitle")?b.title:"",this.description.innerHTML=b.description&&a.get("displaydescription")?b.description:"",this.title.firstChild||this.description.firstChild?this.show():this.hide()},element:function(){return this.el}}),b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'<div id="'+h((e=null!=(e=b.id||(null!=a?a.id:a))?e:g,typeof e===f?e.call(a,{name:"id",hash:{},data:d}):e))+'" class="jwplayer jw-reset" tabindex="0">\n    <div class="jw-aspect jw-reset"></div>\n    <div class="jw-media jw-reset"></div>\n    <div class="jw-preview jw-reset"></div>\n    <div class="jw-title jw-reset">\n        <div class="jw-title-primary jw-reset"></div>\n        <div class="jw-title-secondary jw-reset"></div>\n    </div>\n    <div class="jw-overlays jw-reset"></div>\n    <div class="jw-controls jw-reset"></div>\n</div>'},useData:!0})},function(a,b,c){var d,e;d=[c(45),c(66),c(117),c(63),c(47),c(153)],e=function(a,b,c,d,e,f){var g=function(a){this.model=a,this.setup()};return e.extend(g.prototype,d,{setup:function(){this.destroy(),this.skipMessage=this.model.get("skipText"),this.skipMessageCountdown=this.model.get("skipMessage"),this.setWaitTime(this.model.get("skipOffset"));var b=f();this.el=a.createElement(b),this.skiptext=this.el.getElementsByClassName("jw-skiptext")[0],this.skipAdOnce=e.once(this.skipAd.bind(this)),new c(this.el).on("click tap",e.bind(function(){this.skippable&&this.skipAdOnce()},this)),this.model.on("change:duration",this.onChangeDuration,this),this.model.on("change:position",this.onChangePosition,this),this.onChangeDuration(this.model,this.model.get("duration")),this.onChangePosition(this.model,this.model.get("position"))},updateMessage:function(a){this.skiptext.innerHTML=a},updateCountdown:function(a){this.updateMessage(this.skipMessageCountdown.replace(/xx/gi,Math.ceil(this.waitTime-a)))},onChangeDuration:function(b,c){if(c){if(this.waitPercentage){if(!c)return;this.itemDuration=c,this.setWaitTime(this.waitPercentage),delete this.waitPercentage}a.removeClass(this.el,"jw-hidden")}},onChangePosition:function(b,c){this.waitTime-c>0?this.updateCountdown(c):(this.updateMessage(this.skipMessage),this.skippable=!0,a.addClass(this.el,"jw-skippable"))},element:function(){return this.el},setWaitTime:function(b){if(e.isString(b)&&"%"===b.slice(-1)){var c=parseFloat(b);return void(this.itemDuration&&!isNaN(c)?this.waitTime=this.itemDuration*c/100:this.waitPercentage=b)}e.isNumber(b)?this.waitTime=b:"string"===a.typeOf(b)?this.waitTime=a.seconds(b):isNaN(Number(b))?this.waitTime=0:this.waitTime=Number(b)},skipAd:function(){this.trigger(b.JWPLAYER_AD_SKIPPED)},destroy:function(){this.el&&(this.el.removeEventListener("click",this.skipAdOnce),this.el.parentElement&&this.el.parentElement.removeChild(this.el)),delete this.skippable,delete this.itemDuration,delete this.waitPercentage}}),g}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){return'<div class="jw-skip jw-background-color jw-hidden jw-reset">\n    <span class="jw-text jw-skiptext jw-reset"></span>\n    <span class="jw-icon-inline jw-skip-icon jw-reset"></span>\n</div>';
},useData:!0})},function(a,b,c){var d,e;d=[c(155)],e=function(a){function b(b,c,d,e){return a({id:b,skin:c,title:d,body:e})}return b}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(119);a.exports=(d["default"]||d).template({compiler:[6,">= 2.0.0-beta.1"],main:function(a,b,c,d){var e,f="function",g=b.helperMissing,h=this.escapeExpression;return'<div id="'+h((e=null!=(e=b.id||(null!=a?a.id:a))?e:g,typeof e===f?e.call(a,{name:"id",hash:{},data:d}):e))+'"class="jw-skin-'+h((e=null!=(e=b.skin||(null!=a?a.skin:a))?e:g,typeof e===f?e.call(a,{name:"skin",hash:{},data:d}):e))+' jw-error jw-reset">\n    <div class="jw-title jw-reset">\n        <div class="jw-title-primary jw-reset">'+h((e=null!=(e=b.title||(null!=a?a.title:a))?e:g,typeof e===f?e.call(a,{name:"title",hash:{},data:d}):e))+'</div>\n        <div class="jw-title-secondary jw-reset">'+h((e=null!=(e=b.body||(null!=a?a.body:a))?e:g,typeof e===f?e.call(a,{name:"body",hash:{},data:d}):e))+'</div>\n    </div>\n\n    <div class="jw-icon-container jw-reset">\n        <div class="jw-display-icon-container jw-background-color jw-reset">\n            <div class="jw-icon jw-icon-display jw-reset"></div>\n        </div>\n    </div>\n</div>\n'},useData:!0})},,,,function(a,b,c){var d,e;d=[],e=function(){var a=window.chrome,b={};return b.NS="urn:x-cast:com.longtailvideo.jwplayer",b.debug=!1,b.availability=null,b.available=function(c){c=c||b.availability;var d="available";return a&&a.cast&&a.cast.ReceiverAvailability&&(d=a.cast.ReceiverAvailability.AVAILABLE),c===d},b.log=function(){if(b.debug){var a=Array.prototype.slice.call(arguments,0);console.log.apply(console,a)}},b.error=function(){var a=Array.prototype.slice.call(arguments,0);console.error.apply(console,a)},b}.apply(b,d),!(void 0!==e&&(a.exports=e))},,,function(a,b,c){var d,e;d=[c(93),c(47)],e=function(a,b){return function(c,d){var e=["seek","skipAd","stop","playlistNext","playlistPrev","playlistItem","resize","addButton","removeButton","registerPlugin","attachMedia"];b.each(e,function(a){c[a]=function(){return d[a].apply(d,arguments),c}}),c.registerPlugin=a.registerPlugin}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47)],e=function(a){return function(b,c){var d=["buffer","controls","position","duration","fullscreen","volume","mute","item","stretching","playlist"];a.each(d,function(a){var d=a.slice(0,1).toUpperCase()+a.slice(1);b["get"+d]=function(){return c._model.get(a)}});var e=["getAudioTracks","getCaptionsList","getWidth","getHeight","getCurrentAudioTrack","setCurrentAudioTrack","getCurrentCaptions","setCurrentCaptions","getCurrentQuality","setCurrentQuality","getQualityLevels","getVisualQuality","getConfig","getState","getSafeRegion","isBeforeComplete","isBeforePlay","getProvider","detachMedia"],f=["setControls","setFullscreen","setVolume","setMute","setCues"];a.each(e,function(a){b[a]=function(){return c[a]?c[a].apply(c,arguments):null}}),a.each(f,function(a){b[a]=function(){return c[a].apply(c,arguments),b}})}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d,e;d=[c(47),c(66)],e=function(a,b){return function(c){var d={onBufferChange:b.JWPLAYER_MEDIA_BUFFER,onBufferFull:b.JWPLAYER_MEDIA_BUFFER_FULL,onError:b.JWPLAYER_ERROR,onSetupError:b.JWPLAYER_SETUP_ERROR,onFullscreen:b.JWPLAYER_FULLSCREEN,onMeta:b.JWPLAYER_MEDIA_META,onMute:b.JWPLAYER_MEDIA_MUTE,onPlaylist:b.JWPLAYER_PLAYLIST_LOADED,onPlaylistItem:b.JWPLAYER_PLAYLIST_ITEM,onPlaylistComplete:b.JWPLAYER_PLAYLIST_COMPLETE,onReady:b.JWPLAYER_READY,onResize:b.JWPLAYER_RESIZE,onComplete:b.JWPLAYER_MEDIA_COMPLETE,onSeek:b.JWPLAYER_MEDIA_SEEK,onTime:b.JWPLAYER_MEDIA_TIME,onVolume:b.JWPLAYER_MEDIA_VOLUME,onBeforePlay:b.JWPLAYER_MEDIA_BEFOREPLAY,onBeforeComplete:b.JWPLAYER_MEDIA_BEFORECOMPLETE,onDisplayClick:b.JWPLAYER_DISPLAY_CLICK,onControls:b.JWPLAYER_CONTROLS,onQualityLevels:b.JWPLAYER_MEDIA_LEVELS,onQualityChange:b.JWPLAYER_MEDIA_LEVEL_CHANGED,onCaptionsList:b.JWPLAYER_CAPTIONS_LIST,onCaptionsChange:b.JWPLAYER_CAPTIONS_CHANGED,onAdError:b.JWPLAYER_AD_ERROR,onAdClick:b.JWPLAYER_AD_CLICK,onAdImpression:b.JWPLAYER_AD_IMPRESSION,onAdTime:b.JWPLAYER_AD_TIME,onAdComplete:b.JWPLAYER_AD_COMPLETE,onAdCompanions:b.JWPLAYER_AD_COMPANIONS,onAdSkipped:b.JWPLAYER_AD_SKIPPED,onAdPlay:b.JWPLAYER_AD_PLAY,onAdPause:b.JWPLAYER_AD_PAUSE,onAdMeta:b.JWPLAYER_AD_META,onCast:b.JWPLAYER_CAST_SESSION,onAudioTrackChange:b.JWPLAYER_AUDIO_TRACK_CHANGED,onAudioTracks:b.JWPLAYER_AUDIO_TRACKS},e={onBuffer:"buffer",onPause:"pause",onPlay:"play",onIdle:"idle"};a.each(e,function(b,d){c[d]=a.partial(c.on,b,a)}),a.each(d,function(b,d){c[d]=a.partial(c.on,b,a)})}}.apply(b,d),!(void 0!==e&&(a.exports=e))},function(a,b,c){var d=c(166);"string"==typeof d&&(d=[[a.id,d,""]]);c(170)(d,{});d.locals&&(a.exports=d.locals)},function(a,b,c){b=a.exports=c(167)(),b.push([a.id,".jw-reset{color:inherit;background-color:transparent;padding:0;margin:0;float:none;font-family:Arial,Helvetica,sans-serif;font-size:1em;line-height:1em;list-style:none;text-align:left;text-transform:none;vertical-align:baseline;border:0;direction:ltr;font-variant:inherit;font-stretch:inherit;-webkit-tap-highlight-color:rgba(255,255,255,0)}@font-face{font-family:'jw-icons';src:url("+c(168)+") format('woff'),url("+c(169)+') format(\'truetype\');font-weight:normal;font-style:normal}.jw-icon-inline,.jw-icon-tooltip,.jw-icon-display,.jw-controlbar .jw-menu .jw-option:before{font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}.jw-icon-audio-tracks:before{content:"\\E600"}.jw-icon-buffer:before{content:"\\E601"}.jw-icon-cast:before{content:"\\E603"}.jw-icon-cast.jw-off:before{content:"\\E602"}.jw-icon-cc:before{content:"\\E605"}.jw-icon-cue:before{content:"\\E606"}.jw-icon-menu-bullet:before{content:"\\E606"}.jw-icon-error:before{content:"\\E607"}.jw-icon-fullscreen:before{content:"\\E608"}.jw-icon-fullscreen.jw-off:before{content:"\\E613"}.jw-icon-hd:before{content:"\\E60A"}.jw-rightclick-logo:before{content:"\\E60B"}.jw-icon-next:before{content:"\\E60C"}.jw-icon-pause:before{content:"\\E60D"}.jw-icon-play:before{content:"\\E60E"}.jw-icon-prev:before{content:"\\E60F"}.jw-icon-replay:before{content:"\\E610"}.jw-icon-volume:before{content:"\\E612"}.jw-icon-volume.jw-off:before{content:"\\E611"}.jw-icon-more:before{content:"\\E614"}.jw-icon-close:before{content:"\\E615"}.jw-icon-playlist:before{content:"\\E616"}.jwplayer{width:100%;font-size:16px;position:relative;display:block;min-height:0;overflow:hidden;box-sizing:border-box;font-family:Arial,Helvetica,sans-serif;background-color:#000;-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.jwplayer *{box-sizing:inherit}.jwplayer.jw-flag-aspect-mode{height:auto !important}.jwplayer.jw-flag-aspect-mode .jw-aspect{display:block}.jwplayer .jw-aspect{display:none}.jwplayer:focus,.jwplayer .jw-swf{outline:none}.jwplayer:hover .jw-display-icon-container{background-color:#333;background:#333;background-size:#333}.jw-media,.jw-preview,.jw-overlays,.jw-controls{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}.jw-media{overflow:hidden;cursor:pointer}.jw-media.jw-media-show{visibility:visible;opacity:1}.jw-media video{position:absolute;top:0;right:0;bottom:0;left:0;width:100%;height:100%;margin:auto;background:transparent}.jw-media video::-webkit-media-controls-start-playback-button{display:none}.jw-controls.jw-controls-disabled{display:none}.jw-controls .jw-controls-right{position:absolute;top:0;right:0}.jw-text{height:1em;font-family:Arial,Helvetica,sans-serif;font-size:.75em;font-style:normal;font-weight:normal;color:white;text-align:center;font-variant:normal;font-stretch:normal}.jw-plugin{position:absolute}.jw-cast-screen{width:100%;height:100%}.jw-instream{position:absolute;top:0;right:0;bottom:0;left:0;display:none}.jw-icon-playback:before{content:"\\E60E"}.jw-tab-focus:focus{outline:solid 2px #0b7ef4}.jw-preview,.jw-captions,.jw-title,.jw-overlays,.jw-controls{pointer-events:none}.jw-overlays>div,.jw-media,.jw-controlbar,.jw-dock,.jw-logo,.jw-skip,.jw-display-icon-container{pointer-events:all}.jw-click{position:absolute;width:100%;height:100%}.jw-preview{position:absolute;display:none;opacity:1;visibility:visible;width:100%;height:100%;background:#000 no-repeat 50% 50%}.jwplayer .jw-preview,.jw-error .jw-preview,.jw-stretch-uniform .jw-preview{background-size:contain}.jw-stretch-none .jw-preview{background-size:auto auto}.jw-stretch-fill .jw-preview{background-size:cover}.jw-stretch-exactfit .jw-preview{background-size:100% 100%}.jw-display-icon-container{position:relative;top:50%;display:table;height:3.5em;width:3.5em;margin:-1.75em auto 0;cursor:pointer}.jw-display-icon-container .jw-icon-display{position:relative;display:table-cell;text-align:center;vertical-align:middle !important;background-position:50% 50%;background-repeat:no-repeat;font-size:2em}.jw-flag-audio-player .jw-display-icon-container,.jw-flag-dragging .jw-display-icon-container{display:none}.jw-icon{font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}.jw-controlbar{display:table;position:absolute;right:0;left:0;bottom:0;height:2em;padding:0 .25em}.jw-controlbar .jw-hidden{display:none}.jw-controlbar.jw-drawer-expanded .jw-controlbar-left-group,.jw-controlbar.jw-drawer-expanded .jw-controlbar-center-group{opacity:0}.jw-background-color{background-color:#414040}.jw-group{display:table-cell}.jw-controlbar-center-group{width:100%;padding:0 .25em}.jw-controlbar-center-group .jw-slider-time,.jw-controlbar-center-group .jw-text-alt{padding:0}.jw-controlbar-center-group .jw-text-alt{display:none}.jw-controlbar-left-group,.jw-controlbar-right-group{white-space:nowrap}.jw-knob:hover,.jw-icon-inline:hover,.jw-icon-tooltip:hover,.jw-icon-display:hover,.jw-option:before:hover{color:#eee}.jw-icon-inline,.jw-icon-tooltip,.jw-slider-horizontal,.jw-text-elapsed,.jw-text-duration{display:inline-block;height:2em;position:relative;line-height:2em;vertical-align:middle;cursor:pointer}.jw-icon-inline,.jw-icon-tooltip{min-width:1.25em;text-align:center}.jw-icon-playback{min-width:2.25em}.jw-icon-volume{min-width:1.75em;text-align:left}.jw-time-tip{line-height:1em}.jw-icon-inline:after,.jw-icon-tooltip:after{width:100%;height:100%;font-size:1em}.jw-icon-cast{display:none}.jw-slider-volume.jw-slider-horizontal,.jw-icon-inline.jw-icon-volume{display:none}.jw-dock{margin:.75em;display:block;opacity:1;clear:right}.jw-dock:after{content:\'\';clear:both;display:block}.jw-dock-button{cursor:pointer;float:right;position:relative;width:2.5em;height:2.5em;margin:.5em}.jw-dock-button .jw-arrow{display:none;position:absolute;bottom:-0.2em;width:.5em;height:.2em;left:50%;margin-left:-0.25em}.jw-dock-button .jw-overlay{display:none;position:absolute;top:2.5em;right:0;margin-top:.25em;padding:.5em;white-space:nowrap}.jw-dock-button:hover .jw-overlay,.jw-dock-button:hover .jw-arrow{display:block}.jw-dock-image{width:100%;height:100%;background-position:50% 50%;background-repeat:no-repeat;opacity:.75}.jw-title{display:none;position:absolute;top:0;width:100%;font-size:.875em;height:8em;background:-webkit-linear-gradient(top, #000 0, #000 18%, rgba(0,0,0,0) 100%);background:linear-gradient(to bottom, #000 0, #000 18%, rgba(0,0,0,0) 100%)}.jw-title-primary,.jw-title-secondary{padding:.75em 1.5em;min-height:2.5em;width:75%;color:white;white-space:nowrap;text-overflow:ellipsis;overflow-x:hidden}.jw-title-primary{font-weight:bold}.jw-title-secondary{margin-top:-0.5em}.jw-slider-container{display:inline-block;height:1em;position:relative;-ms-touch-action:none;touch-action:none}.jw-rail,.jw-buffer,.jw-progress{position:absolute;cursor:pointer}.jw-progress{background-color:#fff}.jw-rail{background-color:#aaa}.jw-buffer{background-color:#202020}.jw-cue,.jw-knob{position:absolute;cursor:pointer}.jw-cue{background-color:#fff;width:.1em;height:.4em}.jw-knob{background-color:#aaa;width:.4em;height:.4em}.jw-slider-horizontal{width:4em;height:1em}.jw-slider-horizontal.jw-slider-volume{margin-right:5px}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-buffer,.jw-slider-horizontal .jw-progress{width:100%;height:.4em}.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-buffer{width:0}.jw-slider-horizontal .jw-rail,.jw-slider-horizontal .jw-progress,.jw-slider-horizontal .jw-slider-container{width:100%}.jw-slider-horizontal .jw-knob{left:0;margin-left:-0.325em}.jw-slider-vertical{width:.75em;height:4em;bottom:0;position:absolute;padding:1em}.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-buffer,.jw-slider-vertical .jw-progress{bottom:0;height:100%}.jw-slider-vertical .jw-progress,.jw-slider-vertical .jw-buffer{height:0}.jw-slider-vertical .jw-slider-container,.jw-slider-vertical .jw-rail,.jw-slider-vertical .jw-progress{bottom:0;width:.75em;height:100%;left:0;right:0;margin:0 auto}.jw-slider-vertical .jw-slider-container{height:4em;position:relative}.jw-slider-vertical .jw-knob{bottom:0;left:0;right:0;margin:0 auto}.jw-slider-time{right:0;left:0;width:100%}.jw-tooltip-time{position:absolute}.jw-slider-volume .jw-buffer{display:none}.jw-captions{position:absolute;display:none;margin:0 auto;width:100%;left:0;bottom:1.75em;right:0;max-width:90%;text-align:center}.jw-captions.jw-captions-enabled{display:block}.jw-captions-window{display:none;padding:.25em;border-radius:.25em}.jw-captions-window.jw-captions-window-active{display:inline-block}.jw-captions-text{display:inline-block;color:white;background-color:black;word-wrap:break-word;white-space:pre-line;font-style:normal;font-weight:normal;text-align:center;text-decoration:none;line-height:1.3em;padding:.1em .8em}.jw-rightclick{display:none}.jw-rightclick.jw-open{display:block}.jw-rightclick{position:absolute;white-space:nowrap}.jw-rightclick ul{list-style:none;font-weight:bold;border-radius:.15em;margin:0;border:1px solid #d9dde6;padding-left:0}.jw-rightclick .jw-rightclick-logo{font-size:2em;color:#ff0147;vertical-align:middle;padding-right:.3em;margin-right:.3em;border-right:1px solid #d9dde6}.jw-rightclick a{color:#000;text-decoration:none;padding:1em;display:block;font-size:.6875em}.jw-rightclick li{background-color:#f2f3f6;border-bottom:1px solid #d9dde6}.jw-rightclick li:last-child{border-bottom:none}.jw-rightclick li:hover a,.jw-rightclick li.jw-featured:hover{background-color:#e4e6ed;cursor:pointer;color:#ff0046}.jw-rightclick li.jw-featured{background-color:#fff;vertical-align:middle}.jw-rightclick li.jw-featured a{color:#aab4c8}.jw-logo{float:right;padding:.75em;cursor:pointer;pointer-events:all}.jw-logo .jw-flag-audio-player{display:none}.jw-watermark{position:relative;top:45%;height:100%;width:100%;text-align:center;font-size:14em;color:#eee;opacity:.33;pointer-events:none}.jw-icon-tooltip.jw-open .jw-overlay{opacity:1;visibility:visible}.jw-icon-tooltip.jw-hidden{display:none}.jw-overlay-horizontal{display:none}.jw-icon-tooltip.jw-open-drawer:before{display:none}.jw-icon-tooltip.jw-open-drawer .jw-overlay-horizontal{opacity:1;display:inline-block;vertical-align:top}.jw-overlay:before{position:absolute;top:0;bottom:0;left:-50%;width:100%;background-color:rgba(0,0,0,0);content:" "}.jw-time-tip,.jw-volume-tip,.jw-menu{position:relative;left:-50%;border:solid 1px #000;margin:0}.jw-volume-tip{width:100%;height:100%;display:block}.jw-time-tip{text-align:center;font-family:inherit;color:#aaa;bottom:1em;border:solid 4px #000}.jw-time-tip .jw-text{line-height:1em}.jw-controlbar .jw-overlay{margin:0;position:absolute;bottom:2em;left:50%;opacity:0;visibility:hidden}.jw-controlbar .jw-overlay .jw-contents{position:relative}.jw-controlbar .jw-option{position:relative;white-space:nowrap;cursor:pointer;list-style:none;height:1.5em;font-family:inherit;line-height:1.5em;color:#aaa;padding:0 .5em;font-size:.8em}.jw-controlbar .jw-option:hover,.jw-controlbar .jw-option:before:hover{color:#eee}.jw-controlbar .jw-option:before{padding-right:.125em}.jw-playlist-container ::-webkit-scrollbar-track{background-color:#333;border-radius:10px}.jw-playlist-container ::-webkit-scrollbar{width:5px;border:10px solid black;border-bottom:0;border-top:0}.jw-playlist-container ::-webkit-scrollbar-thumb{background-color:white;border-radius:5px}.jw-tooltip-title{border-bottom:1px solid #444;text-align:left;padding-left:.7em}.jw-playlist{max-height:11em;min-height:4.5em;overflow-x:hidden;overflow-y:scroll;width:calc(100% - 4px)}.jw-playlist .jw-option{height:3em;margin-right:5px;color:white;padding-left:1em;font-size:.8em}.jw-playlist .jw-label,.jw-playlist .jw-name{display:inline-block;line-height:3em;text-align:left;overflow:hidden;white-space:nowrap}.jw-playlist .jw-label{width:1em}.jw-playlist .jw-name{width:11em}.jw-skip{cursor:default;position:absolute;float:right;display:inline-block;right:.75em;bottom:3em}.jw-skip.jw-skippable{cursor:pointer}.jw-skip.jw-hidden{visibility:hidden}.jw-skip .jw-skip-icon{display:none;margin-left:-0.75em}.jw-skip .jw-skip-icon:before{content:"\\E60C"}.jw-skip .jw-text,.jw-skip .jw-skip-icon{color:#aaa;vertical-align:middle;line-height:1.5em;font-size:.7em}.jw-skip.jw-skippable:hover{cursor:pointer}.jw-skip.jw-skippable:hover .jw-text,.jw-skip.jw-skippable:hover .jw-skip-icon{color:#eee}.jw-skip.jw-skippable .jw-skip-icon{display:inline;margin:0}.jwplayer.jw-state-playing.jw-flag-casting .jw-display-icon-container,.jwplayer.jw-state-paused.jw-flag-casting .jw-display-icon-container{display:table}.jwplayer.jw-flag-casting .jw-display-icon-container{border-radius:0;top:8em;padding:2em 5em;border:1px solid white}.jwplayer.jw-flag-casting .jw-display-icon-container .jw-icon{font-size:3em}.jw-cast{position:absolute;width:100%;height:100%;background-repeat:no-repeat;background-size:auto;background-position:50% 50%}.jw-cast-label{position:absolute;left:10px;right:10px;bottom:50%;margin-bottom:100px;text-align:center}.jw-cast-name{color:#ccc}.jwplayer.jw-state-idle .jw-preview{display:block}.jwplayer.jw-state-idle .jw-icon-display:before{content:"\\E60E"}.jwplayer.jw-state-idle .jw-controlbar{display:none}.jwplayer.jw-state-idle .jw-captions{display:none}.jwplayer.jw-state-idle .jw-title{display:block}.jwplayer.jw-state-playing .jw-display-icon-container{display:none}.jwplayer.jw-state-playing .jw-display-icon-container .jw-icon-display:before{content:"\\E60D"}.jwplayer.jw-state-playing .jw-icon-playback:before{content:"\\E60D"}.jwplayer.jw-state-paused .jw-display-icon-container{display:none}.jwplayer.jw-state-paused .jw-display-icon-container .jw-icon-display:before{content:"\\E60E"}.jwplayer.jw-state-paused .jw-icon-playback:before{content:"\\E60E"}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-icon-display{-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-icon-display:before{content:"\\E601"}@-webkit-keyframes spin{100%{-webkit-transform:rotate(360deg)}}@keyframes spin{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.jwplayer.jw-state-buffering .jw-display-icon-container .jw-text{display:none}.jwplayer.jw-state-buffering .jw-icon-playback:before{content:"\\E60D"}.jwplayer.jw-state-complete .jw-preview{display:block}.jwplayer.jw-state-complete .jw-display-icon-container .jw-icon-display:before{content:"\\E610"}.jwplayer.jw-state-complete .jw-display-icon-container .jw-text{display:none}.jwplayer.jw-state-complete .jw-icon-playback:before{content:"\\E60E"}.jwplayer.jw-state-complete .jw-captions{display:none}body .jw-error .jw-title,.jwplayer.jw-state-error .jw-title{display:block}body .jw-error .jw-title .jw-title-primary,.jwplayer.jw-state-error .jw-title .jw-title-primary{white-space:normal}body .jw-error .jw-preview,.jwplayer.jw-state-error .jw-preview{display:block}body .jw-error .jw-controlbar,.jwplayer.jw-state-error .jw-controlbar{display:none}body .jw-error .jw-captions,.jwplayer.jw-state-error .jw-captions{display:none}body .jw-error:hover .jw-display-icon-container,.jwplayer.jw-state-error:hover .jw-display-icon-container{cursor:default;color:#fff;background:#000}body .jw-error .jw-icon-display,.jwplayer.jw-state-error .jw-icon-display{cursor:default;font-family:\'jw-icons\';-webkit-font-smoothing:antialiased;font-style:normal;font-weight:normal;text-transform:none;background-color:transparent;font-variant:normal;-webkit-font-feature-settings:"liga";-ms-font-feature-settings:"liga" 1;-o-font-feature-settings:"liga";font-feature-settings:"liga";-moz-osx-font-smoothing:grayscale}body .jw-error .jw-icon-display:before,.jwplayer.jw-state-error .jw-icon-display:before{content:"\\E607"}body .jw-error .jw-icon-display:hover,.jwplayer.jw-state-error .jw-icon-display:hover{color:#fff}body .jw-error{font-size:16px;background-color:#000;color:#eee;width:100%;height:100%;display:table;opacity:1;position:relative}body .jw-error .jw-icon-container{position:absolute;width:100%;height:100%;top:0;left:0;bottom:0;right:0}.jwplayer.jw-flag-cast-available .jw-controlbar{display:table}.jwplayer.jw-flag-cast-available .jw-icon-cast{display:inline-block}.jwplayer.jw-flag-skin-loading .jw-captions,.jwplayer.jw-flag-skin-loading .jw-controls,.jwplayer.jw-flag-skin-loading .jw-title{display:none}.jwplayer.jw-flag-fullscreen{width:100% !important;height:100% !important;top:0;right:0;bottom:0;left:0;z-index:1000;margin:0;position:fixed}.jwplayer.jw-flag-fullscreen.jw-flag-user-inactive{cursor:none;-webkit-cursor-visibility:auto-hide}.jwplayer.jw-flag-live .jw-controlbar .jw-text-elapsed,.jwplayer.jw-flag-live .jw-controlbar .jw-text-duration,.jwplayer.jw-flag-live .jw-controlbar .jw-slider-time{display:none}.jwplayer.jw-flag-live .jw-controlbar .jw-text-alt{display:inline}.jw-flag-user-inactive.jw-state-playing .jw-controlbar,.jw-flag-user-inactive.jw-state-playing .jw-dock{display:none}.jw-flag-user-inactive.jw-state-playing .jw-logo.jw-hide{display:none}.jw-flag-audio-player{background-color:transparent}.jw-flag-audio-player .jw-media{visibility:hidden}.jw-flag-audio-player .jw-controlbar{display:table;bottom:0;margin:0;width:100%;min-width:100%;opacity:1}.jw-flag-audio-player .jw-controlbar .jw-icon-fullscreen{display:none}.jw-flag-audio-player .jw-controlbar .jw-icon-tooltip{display:none}.jw-flag-audio-player .jw-controlbar .jw-slider-volume.jw-slider-horizontal,.jw-flag-audio-player .jw-controlbar .jw-icon-inline.jw-icon-volume{display:inline-block}.jw-flag-audio-player .jw-controlbar .jw-icon-tooltip.jw-icon-volume{display:none}.jwplayer.jw-flag-audio-player .jw-controlbar{display:table;left:0}.jwplayer.jw-flag-audio-player .jw-controlbar{height:auto}.jwplayer.jw-flag-audio-player .jw-preview{display:none}.jwplayer.jw-flag-media-audio .jw-controlbar{display:table}.jw-flag-media-audio .jw-preview{display:block}.jwplayer.jw-flag-ads .jw-preview,.jwplayer.jw-flag-ads .jw-dock{display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-inline,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-tooltip,.jwplayer.jw-flag-ads .jw-controlbar .jw-text,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-horizontal{display:none}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-playback,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-volume,.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-volume,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-fullscreen{display:inline-block}.jwplayer.jw-flag-ads .jw-controlbar .jw-text-alt{display:inline}.jwplayer.jw-flag-ads .jw-controlbar .jw-slider-volume.jw-slider-horizontal,.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-inline.jw-icon-volume{display:inline-block}.jwplayer.jw-flag-ads .jw-controlbar .jw-icon-tooltip.jw-icon-volume{display:none}.jwplayer.jw-flag-ads .jw-logo{display:none}.jwplayer.jw-flag-ads-hide-controls .jw-controls{display:none !important}.jwplayer.jw-flag-ads.jw-flag-touch .jw-controlbar{display:table}.jwplayer.jw-flag-rightclick-open{overflow:visible}.jwplayer.jw-flag-rightclick-open .jw-rightclick{z-index:16777215}.jw-flag-controls-disabled .jw-controls{display:none}.jw-flag-controls-disabled .jw-media{cursor:auto}body .jwplayer.jw-flag-flash-blocked .jw-controls{display:none}body .jwplayer.jw-flag-flash-blocked .jw-overlays{display:none}body .jwplayer.jw-flag-flash-blocked .jw-preview{display:none}.jw-flag-touch .jw-controlbar{font-size:1.5em}.jw-flag-touch .jw-icon-tooltip.jw-open-drawer:before{display:inline}.jw-flag-touch .jw-icon-tooltip.jw-open-drawer:before{content:"\\E615"}.jw-flag-touch .jw-display-icon-container{pointer-events:none}.jw-flag-compact-player .jw-icon-playlist,.jw-flag-compact-player .jw-icon-next,.jw-flag-compact-player .jw-icon-prev,.jw-flag-compact-player .jw-text-elapsed,.jw-flag-compact-player .jw-text-duration{display:none}.jw-skin-seven .jw-background-color{background:#000}.jw-skin-seven .jw-controlbar{border-top:#333 1px solid;height:2.5em}.jw-skin-seven .jw-group{vertical-align:middle}.jw-skin-seven .jw-playlist{background-color:rgba(0,0,0,0.5)}.jw-skin-seven .jw-playlist-container{left:-43%;background-color:rgba(0,0,0,0.5)}.jw-skin-seven .jw-playlist-container .jw-option{border-bottom:1px solid #444}.jw-skin-seven .jw-playlist-container .jw-option:hover,.jw-skin-seven .jw-playlist-container .jw-option.jw-active-option{background-color:black}.jw-skin-seven .jw-playlist-container .jw-option:hover .jw-label{color:#FF0046}.jw-skin-seven .jw-playlist-container .jw-icon-playlist{margin-left:0}.jw-skin-seven .jw-playlist-container .jw-label .jw-icon-play{color:#FF0046}.jw-skin-seven .jw-playlist-container .jw-label .jw-icon-play:before{padding-left:0}.jw-skin-seven .jw-tooltip-title{background-color:#000;color:#fff}.jw-skin-seven .jw-text{color:#fff}.jw-skin-seven .jw-button-color{color:#fff}.jw-skin-seven .jw-button-color:hover{color:#FF0046}.jw-skin-seven .jw-toggle{color:#FF0046}.jw-skin-seven .jw-toggle.jw-off{color:#fff}.jw-skin-seven .jw-controlbar .jw-icon:before,.jw-skin-seven .jw-text-elapsed,.jw-skin-seven .jw-text-duration{padding:0 .7em}.jw-skin-seven .jw-controlbar .jw-icon-prev:before{padding-right:.25em}.jw-skin-seven .jw-controlbar .jw-icon-playlist:before{padding:0 .45em}.jw-skin-seven .jw-controlbar .jw-icon-next:before{padding-left:.25em}.jw-skin-seven .jw-icon-prev,.jw-skin-seven .jw-icon-next{font-size:.7em}.jw-skin-seven .jw-icon-prev:before{border-left:1px solid #666}.jw-skin-seven .jw-icon-next:before{border-right:1px solid #666}.jw-skin-seven .jw-icon-display{color:#fff}.jw-skin-seven .jw-icon-display:before{padding-left:0}.jw-skin-seven .jw-display-icon-container{border-radius:50%;border:1px solid #333}.jw-skin-seven .jw-rail{background-color:#384154;box-shadow:none}.jw-skin-seven .jw-buffer{background-color:#666F82}.jw-skin-seven .jw-progress{background:#FF0046}.jw-skin-seven .jw-knob{width:.6em;height:.6em;background-color:#fff;box-shadow:0 0 0 1px #000;border-radius:1em}.jw-skin-seven .jw-slider-horizontal .jw-slider-container{height:.95em}.jw-skin-seven .jw-slider-horizontal .jw-rail,.jw-skin-seven .jw-slider-horizontal .jw-buffer,.jw-skin-seven .jw-slider-horizontal .jw-progress{height:.2em;border-radius:0}.jw-skin-seven .jw-slider-horizontal .jw-knob{top:-0.2em}.jw-skin-seven .jw-slider-horizontal .jw-cue{top:-0.05em;width:.3em;height:.3em;background-color:#fff;border-radius:50%}.jw-skin-seven .jw-slider-vertical .jw-rail,.jw-skin-seven .jw-slider-vertical .jw-buffer,.jw-skin-seven .jw-slider-vertical .jw-progress{width:.2em}.jw-skin-seven .jw-volume-tip{width:100%;left:-45%;padding-bottom:.7em}.jw-skin-seven .jw-text-duration{color:#666F82}.jw-skin-seven .jw-controlbar-right-group .jw-icon-tooltip:before,.jw-skin-seven .jw-controlbar-right-group .jw-icon-inline:before{border-left:1px solid #666}.jw-skin-seven .jw-controlbar-right-group .jw-icon-inline:first-child:before{border:none}.jw-skin-seven .jw-dock .jw-dock-button{border-radius:50%;border:1px solid #333}.jw-skin-seven .jw-dock .jw-overlay{border-radius:2.5em}.jw-skin-seven .jw-icon-tooltip .jw-active-option{background-color:#FF0046;color:#fff}.jw-skin-seven .jw-icon-volume{min-width:2.6em}.jw-skin-seven .jw-time-tip,.jw-skin-seven .jw-menu,.jw-skin-seven .jw-volume-tip,.jw-skin-seven .jw-skip{border:1px solid #333}.jw-skin-seven .jw-time-tip{padding:.2em;bottom:1.3em}.jw-skin-seven .jw-menu,.jw-skin-seven .jw-volume-tip{bottom:.24em}.jw-skin-seven .jw-skip{padding:.4em;border-radius:1.75em}.jw-skin-seven .jw-skip .jw-text,.jw-skin-seven .jw-skip .jw-icon-inline{color:#fff;line-height:1.75em}.jw-skin-seven .jw-skip.jw-skippable:hover .jw-text,.jw-skin-seven .jw-skip.jw-skippable:hover .jw-icon-inline{color:#FF0046}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon:before,.jw-skin-seven.jw-flag-touch .jw-text-elapsed,.jw-skin-seven.jw-flag-touch .jw-text-duration{padding:0 .35em}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon-prev:before{padding:0 .125em 0 .7em}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon-next:before{padding:0 .7em 0 .125em}.jw-skin-seven.jw-flag-touch .jw-controlbar .jw-icon-playlist:before{padding:0 .225em}',""])},function(a,b){a.exports=function(){var a=[];return a.toString=function(){for(var a=[],b=0;b<this.length;b++){var c=this[b];c[2]?a.push("@media "+c[2]+"{"+c[1]+"}"):a.push(c[1])}return a.join("")},a.i=function(b,c){"string"==typeof b&&(b=[[null,b,""]]);for(var d={},e=0;e<this.length;e++){var f=this[e][0];"number"==typeof f&&(d[f]=!0)}for(e=0;e<b.length;e++){var g=b[e];"number"==typeof g[0]&&d[g[0]]||(c&&!g[2]?g[2]=c:c&&(g[2]="("+g[2]+") and ("+c+")"),a.push(g))}},a}},function(a,b){a.exports="data:application/font-woff;base64,d09GRgABAAAAABQ4AAsAAAAAE+wAAQABAAAAAAAAAAAAAAAAAAAAAAAAAABPUy8yAAABCAAAAGAAAABgDxID2WNtYXAAAAFoAAAAVAAAAFQaVsydZ2FzcAAAAbwAAAAIAAAACAAAABBnbHlmAAABxAAAD3AAAA9wKJaoQ2hlYWQAABE0AAAANgAAADYIhqKNaGhlYQAAEWwAAAAkAAAAJAmCBdxobXR4AAARkAAAAGwAAABscmAHPWxvY2EAABH8AAAAOAAAADg2EDnwbWF4cAAAEjQAAAAgAAAAIAAiANFuYW1lAAASVAAAAcIAAAHCwZOZtHBvc3QAABQYAAAAIAAAACAAAwAAAAMEmQGQAAUAAAKZAswAAACPApkCzAAAAesAMwEJAAAAAAAAAAAAAAAAAAAAARAAAAAAAAAAAAAAAAAAAAAAQAAA5hYDwP/AAEADwABAAAAAAQAAAAAAAAAAAAAAIAAAAAAAAwAAAAMAAAAcAAEAAwAAABwAAwABAAAAHAAEADgAAAAKAAgAAgACAAEAIOYW//3//wAAAAAAIOYA//3//wAB/+MaBAADAAEAAAAAAAAAAAAAAAEAAf//AA8AAQAAAAAAAAAAAAIAADc5AQAAAAABAAAAAAAAAAAAAgAANzkBAAAAAAEAAAAAAAAAAAACAAA3OQEAAAAABABgAAAFoAOAADoAPwBEAEkAACUVIi4CNTQ2Ny4BNTQ+AjMyHgIVFAYHHgEVFA4CIxEyFhc+ATU0LgIjIg4CFRQWFz4BMxExARUhNSEXFSE1IRcVITUhAUAuUj0jCgoKCkZ6o11do3pGCgoKCiM9Ui4qSh4BAjpmiE1NiGY6AQIeSioCVQIL/fWWAXX+i0oBK/7VHh4jPVIuGS4VH0MiXaN6RkZ6o10iQx8VLhkuUj0jAcAdGQ0bDk2IZjo6ZohNDhsNGR3+XgNilZXglZXglZUAAAABAEAAAAPAA4AAIQAAExQeAjMyPgI1MxQOAiMiLgI1ND4CMxUiDgIVMYs6ZohNTYhmOktGeqNdXaN6RkZ6o11NiGY6AcBNiGY6OmaITV2jekZGeqNdXaN6Rks6ZohNAAAEAEAAAATAA4AADgAcACoAMQAAJS4BJyERIREuAScRIREhByMuAyc1HgMXMSsBLgMnNR4DFzErATUeARcxAn8DBQQCDPxGCysLBDz9v1NaCERrjE9irINTCLVbByc6Sio9a1I1CLaBL0YMQgsoCgLB/ukDCgIBSPzCQk6HaEIIWAhQgKdgKUg5JgdYBzRRZzx9C0QuAAAAAAUAQAAABMADgAAOABkAJwA1ADwAACUuASchESERLgEnESERIQE1IREhLgMnMQEjLgMnNR4DFzErAS4DJzUeAxcxKwE1HgEXMQKAAgYFAg38QAwqCgRA/cD+gANA/iAYRVlsPgEtWghFa4xPYq2DUgmzWgcnO0oqPGpSNgm6gDBEDEAMKAwCwP7tAggDAUb8wAHQ8P3APWdUQRf98E2IaEIHWghQgKhgKUg4JgdaCDVRZzt9DEMuAAAEAEAAAAXAA4AABAAJAGcAxQAANxEhESEBIREhEQU+ATc+ATMyFhceARceARceARcjLgEnLgEnLgEnLgEjIgYHDgEHDgEHDgEVFBYXHgEXHgEXHgEzMjY3PgE3Mw4BBw4BBw4BBw4BIyImJy4BJy4BJy4BNTQ2Nz4BNzEhPgE3PgEzMhYXHgEXHgEXHgEXIy4BJy4BJy4BJy4BIyIGBw4BBw4BBw4BFRQWFx4BFx4BFx4BMzI2Nz4BNzMOAQcOAQcOAQcOASMiJicuAScuAScuATU0Njc+ATcxQAWA+oAFNvsUBOz8Iw4hExQsGBIhEA8cDQwUCAgLAlsBBQUECgYHDggIEAkQGgsLEgcHCgMDAwMDAwoHBxILCxoQFiEMDA8DWgIJBwgTDQwcERAkFBgsFBMhDg0VBwcHBwcHFQ0Bug0hFBMsGREhEBAcDAwVCAgKAloCBQQECwYGDggIEQgQGwsLEgcHCgMDAwMDAwoHBxILCxsQFSIMDA4DWwIJCAcUDAwdEBEkExksExQhDQ4UBwcICAcHFA4AA4D8gAM1/RYC6tcQGAgJCQUFBQ8KChgPDiETCQ4HBwwFBQgDAwIGBgYRCgoYDQ0cDg0aDQ0XCgoRBgYGDQ0OIhYUJBEQHAsLEgYGBgkICRcPDyQUFCwXGC0VFCQPEBgICQkFBQUPCgoYDw4hEwkOBwcMBQUIAwMCBgYGEQoKGA0NHA4NGg0NFwoKEQYGBg0NDiIWFCQREBwLCxIGBgYJCAkXDw8kFBQsFxgtFRQkDwAAAAADAEAAAAXAA4AAEABvAM4AACUhIiY1ETQ2MyEyFhURFAYjAT4BNz4BNz4BMzIWFx4BFx4BFx4BFzMuAScuAScuAScuASMiBgcOAQcOAQcOARUUFhceARceARceATMyNjc+ATc+ATc+ATcjDgEHDgEjIiYnLgEnLgEnLgE1NDY3OQEhPgE3PgE3PgEzMhYXHgEXHgEXHgEXMy4BJy4BJy4BJy4BIyIGBw4BBw4BBw4BFRQWFx4BFx4BFx4BMzI2Nz4BNz4BNz4BNyMOAQcOASMiJicuAScuAScuATU0Njc5AQUs+6g9V1c9BFg9V1c9/JoDCgcGEgsLGxAJEAgIDgYHCgQEBgFaAgoICBQNDBwQDyESGCwUEyEODRUHBwcHBwcVDQ4hExQrGRQkEBAdDAwUCAcJAloDDwwMIhUQGwsLEgYHCgMEAwMEAbkDCgcHEgsLGxAIEQgHDwYGCwQEBQFbAgoICBUMDBwQECERGSwTFCENDhQHBwgIBwcUDg0hFBMsGRMkERAdDAwUBwgJAlsDDgwNIRUQGwsLEgcHCgMDAwMDAFc+AlY+V1c+/ao+VwH0DRgKCxAGBgYCAwMIBQUMBwcOCRMhDg8YCgoOBgUFCQkIGBAPJBQVLRgXLBQUJA8PFwkICQYGBhILCxwQESQUFiIODQ0GBgYRCgoXDQ0aDg4bDQ0YCgsQBgYGAgMDCAUFDAcHDgkTIQ4PGAoKDgYFBQkJCBgQDyQUFS0YFywUFCQPDxcJCAkGBgYSCwscEBEkFBYiDg0NBgYGEQoKFw0NGg4OGw0AAAABAOAAoAMgAuAAFAAAARQOAiMiLgI1ND4CMzIeAhUDIC1OaTw8aU4tLU5pPDxpTi0BwDxpTi0tTmk8PGlOLS1OaTwAAAMAQAAQBEADkAADABAAHwAANwkBISUyNjU0JiMiBhUUFjMTNCYjIgYVERQWMzI2NRFAAgACAPwAAgAOFRUODhUVDiMVDg4VFQ4OFRADgPyAcBYQDxgWERAWAeYPGBYR/tcPGBYRASkAAgBAAAADwAOAAAcADwAANxEXNxcHFyEBIREnByc3J0CAsI2wgP5zAfMBjYCwjbCAAAGNgLCNsIADgP5zgLCNsIAAAAAFAEAAAAXAA4AABAAJABYAMwBPAAA3ESERIQEhESERATM1MxEjNSMVIxEzFSUeARceARceARUUBgcOAQcOAQcOASsBETMeARcxBxEzMjY3PgE3PgE3PgE1NCYnLgEnLgEnLgErAUAFgPqABTb7FATs/FS2YGC2ZGQCXBQeDg8UBwcJBgcHEwwMIRMTLBuwsBYqE6BHCRcJChIIBw0FBQUEAwINBwcTDAwgETcAA4D8gAM2/RcC6f7Arf5AwMABwK2dBxQODyIWFTAbGC4TFiIPDhgKCQcBwAIHB0P+5gQDAg0HBxcMDCETER0PDhgKCQ8EBQUABAA9AAAFwAOAABAAHQA7AFkAACUhIiY1ETQ2MyEyFhURFAYjASMVIzUjETM1MxUzEQUuAScuAScuASsBETMyNjc+ATc+ATc+ATUuASc5AQcOAQcOASsBETMyFhceARceARceARUUBgcOAQc5AQUq+6k+WFg+BFc+WFg+/bNgs2Rks2ABsAcXDA4fExMnFrCwGywTEx4PDBMHBwYCCAl3CBIKCRQMRzcTHgwMEwcHCwQDBAUFBQ0HAFg+AlQ+WFg+/aw+WAKdra3+QMDAAcB9FiIODxQHBwb+QAkHCRgPDiUTFiwYHTAW4ggNAgMEAR8EBQUPCgoYDw4fERMfDwwXBwAAAAABAEMABgOgA3oAjwAAExQiNScwJic0JicuAQcOARUcARUeARceATc+ATc+ATE2MhUwFAcUFhceARceATMyNjc+ATc+ATc+AzE2MhUwDgIVFBYXHgEXFjY3PgE3PgE3PgE3PgM3PAE1NCYnJgYHDgMxBiI1MDwCNTQmJyYGBw4BBw4DMQYiNTAmJy4BJyYGBw4BMRWQBgQIBAgCBQ4KBwkDFgcHIQ8QDwcHNgUEAwMHBQsJChcMBQ0FBwsHDBMICR8cFQUFAwQDCAUHFRERJBEMEwgJEgUOGQwGMjgvBAkHDBYEAz1IPAQFLyQRIhEQFgoGIiUcBQUEAgMYKCcmCgcsAboFBQwYDwUKBwUEAgMNBwcLBxRrDhENBwggDxOTCgqdMBM1EQwTCAcFBAIFCgcPIw4UQ0IxCgpTc3glEyMREBgIBwEKBxUKESUQJ00mE6/JrA8FBgIHDQMECAkGla2PCQk1VGYxNTsHAgUKChwQC2BqVQoKehYfTwUDRx8TkAMAAAAAAgBGAAAENgOAAAQACAAAJREzESMJAhEDxnBw/IADgPyAAAOA/IADgP5A/kADgAAAAgCAAAADgAOAAAQACQAAJREhESEBIREhEQKAAQD/AP4AAQD/AAADgPyAA4D8gAOAAAAAAAEAgAAABAADgAADAAAJAREBBAD8gAOAAcD+QAOA/kAAAgBKAAAEOgOAAAQACAAANxEjETMJAhG6cHADgPyAA4AAA4D8gAOA/kD+QAOAAAAAAQBDACADQwOgACkAAAEeARUUDgIjIi4CNTQ+AjM1DQE1Ig4CFRQeAjMyPgI1NCYnNwMNGhw8aYxPT4xoPT1ojE8BQP7APGlOLS1OaTw8aU4tFhNTAmMrYzVPjGg9PWiMT0+MaD2ArbOALU5pPDxpTi0tTmk8KUsfMAAAAAEAQABmAiADEwAGAAATETMlESUjQM0BE/7tzQEzARPN/VPNAAQAQAAABJADgAAXACsAOgBBAAAlJz4DNTQuAic3HgMVFA4CBzEvAT4BNTQmJzceAxUOAwcxJz4BNTQmJzceARUUBgcnBREzJRElIwPaKiY+KxcXKz4mKipDMBkZMEMqpCk5REQ5KSE0JBQBFCQzIcMiKCgiKiYwMCYq/c3NARP+7c0AIyheaXI8PHFpXikjK2ZyfEFBfHJmK4MjNZFUVJE1Ix5IUFgvL1lRRx2zFkgpK0YVIxxcNDVZHykDARPN/VPNAAACAEAAAAPDA4AABwAPAAABFyERFzcXBwEHJzcnIREnAypw/qlwl3mZ/iaWepZwAVdtAnNwAVdwlnqT/iOWepZw/qpsAAMAQAETBcACYAAMABkAJgAAARQGIyImNTQ2MzIWFSEUBiMiJjU0NjMyFhUhFAYjIiY1NDYzMhYVAY1iRUVhYUVFYgIWYUVFYmJFRWECHWFFRWJiRUVhAbpFYmJFRWFhRUViYkVFYWFFRWJiRUVhYUUAAAAAAQBmACYDmgNaACAAAAEXFhQHBiIvAQcGIicmND8BJyY0NzYyHwE3NjIXFhQPAQKj9yQkJGMd9vYkYx0kJPf3JCQkYx329iRjHSQk9wHA9iRjHSQk9/ckJCRjHfb2JGMdJCT39yQkJGMd9gAABgBEAAQDvAN8AAQACQAOABMAGAAdAAABIRUhNREhFSE1ESEVITUBMxUjNREzFSM1ETMVIzUBpwIV/esCFf3rAhX96/6dsrKysrKyA3xZWf6dWVn+nVlZAsaysv6dsrL+nbKyAAEAAAABGZqh06s/Xw889QALBAAAAAAA0dQiKwAAAADR1CIrAAAAAAXAA6AAAAAIAAIAAAAAAAAAAQAAA8D/wAAABgAAAAAABcAAAQAAAAAAAAAAAAAAAAAAABsEAAAAAAAAAAAAAAACAAAABgAAYAQAAEAFAABABQAAQAYAAEAGAABABAAA4ASAAEAEAABABgAAQAYAAD0D4ABDBIAARgQAAIAEAACABIAASgOAAEMEwABABMAAQAQAAEAGAABABAAAZgQAAEQAAAAAAAoAFAAeAIgAuAEEAWAChgOyA9QECAQqBKQFJgXoBgAGGgYqBkIGgAaSBvQHFgdQB4YHuAABAAAAGwDPAAYAAAAAAAIAAAAAAAAAAAAAAAAAAAAAAAAADgCuAAEAAAAAAAEADAAAAAEAAAAAAAIABwCNAAEAAAAAAAMADABFAAEAAAAAAAQADACiAAEAAAAAAAUACwAkAAEAAAAAAAYADABpAAEAAAAAAAoAGgDGAAMAAQQJAAEAGAAMAAMAAQQJAAIADgCUAAMAAQQJAAMAGABRAAMAAQQJAAQAGACuAAMAAQQJAAUAFgAvAAMAAQQJAAYAGAB1AAMAAQQJAAoANADganctc2l4LWljb25zAGoAdwAtAHMAaQB4AC0AaQBjAG8AbgBzVmVyc2lvbiAxLjEAVgBlAHIAcwBpAG8AbgAgADEALgAxanctc2l4LWljb25zAGoAdwAtAHMAaQB4AC0AaQBjAG8AbgBzanctc2l4LWljb25zAGoAdwAtAHMAaQB4AC0AaQBjAG8AbgBzUmVndWxhcgBSAGUAZwB1AGwAYQByanctc2l4LWljb25zAGoAdwAtAHMAaQB4AC0AaQBjAG8AbgBzRm9udCBnZW5lcmF0ZWQgYnkgSWNvTW9vbi4ARgBvAG4AdAAgAGcAZQBuAGUAcgBhAHQAZQBkACAAYgB5ACAASQBjAG8ATQBvAG8AbgAuAAAAAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==";
},function(a,b){a.exports="data:application/octet-stream;base64,AAEAAAALAIAAAwAwT1MvMg8SA9kAAAC8AAAAYGNtYXAaVsydAAABHAAAAFRnYXNwAAAAEAAAAXAAAAAIZ2x5ZiiWqEMAAAF4AAAPcGhlYWQIhqKNAAAQ6AAAADZoaGVhCYIF3AAAESAAAAAkaG10eHJgBz0AABFEAAAAbGxvY2E2EDnwAAARsAAAADhtYXhwACIA0QAAEegAAAAgbmFtZcGTmbQAABIIAAABwnBvc3QAAwAAAAATzAAAACAAAwSZAZAABQAAApkCzAAAAI8CmQLMAAAB6wAzAQkAAAAAAAAAAAAAAAAAAAABEAAAAAAAAAAAAAAAAAAAAABAAADmFgPA/8AAQAPAAEAAAAABAAAAAAAAAAAAAAAgAAAAAAADAAAAAwAAABwAAQADAAAAHAADAAEAAAAcAAQAOAAAAAoACAACAAIAAQAg5hb//f//AAAAAAAg5gD//f//AAH/4xoEAAMAAQAAAAAAAAAAAAAAAQAB//8ADwABAAAAAAAAAAAAAgAANzkBAAAAAAEAAAAAAAAAAAACAAA3OQEAAAAAAQAAAAAAAAAAAAIAADc5AQAAAAAEAGAAAAWgA4AAOgA/AEQASQAAJRUiLgI1NDY3LgE1ND4CMzIeAhUUBgceARUUDgIjETIWFz4BNTQuAiMiDgIVFBYXPgEzETEBFSE1IRcVITUhFxUhNSEBQC5SPSMKCgoKRnqjXV2jekYKCgoKIz1SLipKHgECOmaITU2IZjoBAh5KKgJVAgv99ZYBdf6LSgEr/tUeHiM9Ui4ZLhUfQyJdo3pGRnqjXSJDHxUuGS5SPSMBwB0ZDRsOTYhmOjpmiE0OGw0ZHf5eA2KVleCVleCVlQAAAAEAQAAAA8ADgAAhAAATFB4CMzI+AjUzFA4CIyIuAjU0PgIzFSIOAhUxizpmiE1NiGY6S0Z6o11do3pGRnqjXU2IZjoBwE2IZjo6ZohNXaN6RkZ6o11do3pGSzpmiE0AAAQAQAAABMADgAAOABwAKgAxAAAlLgEnIREhES4BJxEhESEHIy4DJzUeAxcxKwEuAyc1HgMXMSsBNR4BFzECfwMFBAIM/EYLKwsEPP2/U1oIRGuMT2Ksg1MItVsHJzpKKj1rUjUItoEvRgxCCygKAsH+6QMKAgFI/MJCTodoQghYCFCAp2ApSDkmB1gHNFFnPH0LRC4AAAAABQBAAAAEwAOAAA4AGQAnADUAPAAAJS4BJyERIREuAScRIREhATUhESEuAycxASMuAyc1HgMXMSsBLgMnNR4DFzErATUeARcxAoACBgUCDfxADCoKBED9wP6AA0D+IBhFWWw+AS1aCEVrjE9irYNSCbNaByc7Sio8alI2CbqAMEQMQAwoDALA/u0CCAMBRvzAAdDw/cA9Z1RBF/3wTYhoQgdaCFCAqGApSDgmB1oINVFnO30MQy4AAAQAQAAABcADgAAEAAkAZwDFAAA3ESERIQEhESERBT4BNz4BMzIWFx4BFx4BFx4BFyMuAScuAScuAScuASMiBgcOAQcOAQcOARUUFhceARceARceATMyNjc+ATczDgEHDgEHDgEHDgEjIiYnLgEnLgEnLgE1NDY3PgE3MSE+ATc+ATMyFhceARceARceARcjLgEnLgEnLgEnLgEjIgYHDgEHDgEHDgEVFBYXHgEXHgEXHgEzMjY3PgE3Mw4BBw4BBw4BBw4BIyImJy4BJy4BJy4BNTQ2Nz4BNzFABYD6gAU2+xQE7PwjDiETFCwYEiEQDxwNDBQICAsCWwEFBQQKBgcOCAgQCRAaCwsSBwcKAwMDAwMDCgcHEgsLGhAWIQwMDwNaAgkHCBMNDBwRECQUGCwUEyEODRUHBwcHBwcVDQG6DSEUEywZESEQEBwMDBUICAoCWgIFBAQLBgYOCAgRCBAbCwsSBwcKAwMDAwMDCgcHEgsLGxAVIgwMDgNbAgkIBxQMDB0QESQTGSwTFCENDhQHBwgIBwcUDgADgPyAAzX9FgLq1xAYCAkJBQUFDwoKGA8OIRMJDgcHDAUFCAMDAgYGBhEKChgNDRwODRoNDRcKChEGBgYNDQ4iFhQkERAcCwsSBgYGCQgJFw8PJBQULBcYLRUUJA8QGAgJCQUFBQ8KChgPDiETCQ4HBwwFBQgDAwIGBgYRCgoYDQ0cDg0aDQ0XCgoRBgYGDQ0OIhYUJBEQHAsLEgYGBgkICRcPDyQUFCwXGC0VFCQPAAAAAAMAQAAABcADgAAQAG8AzgAAJSEiJjURNDYzITIWFREUBiMBPgE3PgE3PgEzMhYXHgEXHgEXHgEXMy4BJy4BJy4BJy4BIyIGBw4BBw4BBw4BFRQWFx4BFx4BFx4BMzI2Nz4BNz4BNz4BNyMOAQcOASMiJicuAScuAScuATU0Njc5ASE+ATc+ATc+ATMyFhceARceARceARczLgEnLgEnLgEnLgEjIgYHDgEHDgEHDgEVFBYXHgEXHgEXHgEzMjY3PgE3PgE3PgE3Iw4BBw4BIyImJy4BJy4BJy4BNTQ2NzkBBSz7qD1XVz0EWD1XVz38mgMKBwYSCwsbEAkQCAgOBgcKBAQGAVoCCggIFA0MHBAPIRIYLBQTIQ4NFQcHBwcHBxUNDiETFCsZFCQQEB0MDBQIBwkCWgMPDAwiFRAbCwsSBgcKAwQDAwQBuQMKBwcSCwsbEAgRCAcPBgYLBAQFAVsCCggIFQwMHBAQIREZLBMUIQ0OFAcHCAgHBxQODSEUEywZEyQREB0MDBQHCAkCWwMODA0hFRAbCwsSBwcKAwMDAwMAVz4CVj5XVz79qj5XAfQNGAoLEAYGBgIDAwgFBQwHBw4JEyEODxgKCg4GBQUJCQgYEA8kFBUtGBcsFBQkDw8XCQgJBgYGEgsLHBARJBQWIg4NDQYGBhEKChcNDRoODhsNDRgKCxAGBgYCAwMIBQUMBwcOCRMhDg8YCgoOBgUFCQkIGBAPJBQVLRgXLBQUJA8PFwkICQYGBhILCxwQESQUFiIODQ0GBgYRCgoXDQ0aDg4bDQAAAAEA4ACgAyAC4AAUAAABFA4CIyIuAjU0PgIzMh4CFQMgLU5pPDxpTi0tTmk8PGlOLQHAPGlOLS1OaTw8aU4tLU5pPAAAAwBAABAEQAOQAAMAEAAfAAA3CQEhJTI2NTQmIyIGFRQWMxM0JiMiBhURFBYzMjY1EUACAAIA/AACAA4VFQ4OFRUOIxUODhUVDg4VEAOA/IBwFhAPGBYREBYB5g8YFhH+1w8YFhEBKQACAEAAAAPAA4AABwAPAAA3ERc3FwcXIQEhEScHJzcnQICwjbCA/nMB8wGNgLCNsIAAAY2AsI2wgAOA/nOAsI2wgAAAAAUAQAAABcADgAAEAAkAFgAzAE8AADcRIREhASERIREBMzUzESM1IxUjETMVJR4BFx4BFx4BFRQGBw4BBw4BBw4BKwERMx4BFzEHETMyNjc+ATc+ATc+ATU0JicuAScuAScuASsBQAWA+oAFNvsUBOz8VLZgYLZkZAJcFB4ODxQHBwkGBwcTDAwhExMsG7CwFioToEcJFwkKEggHDQUFBQQDAg0HBxMMDCARNwADgPyAAzb9FwLp/sCt/kDAwAHArZ0HFA4PIhYVMBsYLhMWIg8OGAoJBwHAAgcHQ/7mBAMCDQcHFwwMIRMRHQ8OGAoJDwQFBQAEAD0AAAXAA4AAEAAdADsAWQAAJSEiJjURNDYzITIWFREUBiMBIxUjNSMRMzUzFTMRBS4BJy4BJy4BKwERMzI2Nz4BNz4BNz4BNS4BJzkBBw4BBw4BKwERMzIWFx4BFx4BFx4BFRQGBw4BBzkBBSr7qT5YWD4EVz5YWD79s2CzZGSzYAGwBxcMDh8TEycWsLAbLBMTHg8MEwcHBgIICXcIEgoJFAxHNxMeDAwTBwcLBAMEBQUFDQcAWD4CVD5YWD79rD5YAp2trf5AwMABwH0WIg4PFAcHBv5ACQcJGA8OJRMWLBgdMBbiCA0CAwQBHwQFBQ8KChgPDh8REx8PDBcHAAAAAAEAQwAGA6ADegCPAAATFCI1JzAmJzQmJy4BBw4BFRwBFR4BFx4BNz4BNz4BMTYyFTAUBxQWFx4BFx4BMzI2Nz4BNz4BNz4DMTYyFTAOAhUUFhceARcWNjc+ATc+ATc+ATc+Azc8ATU0JicmBgcOAzEGIjUwPAI1NCYnJgYHDgEHDgMxBiI1MCYnLgEnJgYHDgExFZAGBAgECAIFDgoHCQMWBwchDxAPBwc2BQQDAwcFCwkKFwwFDQUHCwcMEwgJHxwVBQUDBAMIBQcVEREkEQwTCAkSBQ4ZDAYyOC8ECQcMFgQDPUg8BAUvJBEiERAWCgYiJRwFBQQCAxgoJyYKBywBugUFDBgPBQoHBQQCAw0HBwsHFGsOEQ0HCCAPE5MKCp0wEzURDBMIBwUEAgUKBw8jDhRDQjEKClNzeCUTIxEQGAgHAQoHFQoRJRAnTSYTr8msDwUGAgcNAwQICQaVrY8JCTVUZjE1OwcCBQoKHBALYGpVCgp6Fh9PBQNHHxOQAwAAAAACAEYAAAQ2A4AABAAIAAAlETMRIwkCEQPGcHD8gAOA/IAAA4D8gAOA/kD+QAOAAAACAIAAAAOAA4AABAAJAAAlESERIQEhESERAoABAP8A/gABAP8AAAOA/IADgPyAA4AAAAAAAQCAAAAEAAOAAAMAAAkBEQEEAPyAA4ABwP5AA4D+QAACAEoAAAQ6A4AABAAIAAA3ESMRMwkCEbpwcAOA/IADgAADgPyAA4D+QP5AA4AAAAABAEMAIANDA6AAKQAAAR4BFRQOAiMiLgI1ND4CMzUNATUiDgIVFB4CMzI+AjU0Jic3Aw0aHDxpjE9PjGg9PWiMTwFA/sA8aU4tLU5pPDxpTi0WE1MCYytjNU+MaD09aIxPT4xoPYCts4AtTmk8PGlOLS1OaTwpSx8wAAAAAQBAAGYCIAMTAAYAABMRMyURJSNAzQET/u3NATMBE839U80ABABAAAAEkAOAABcAKwA6AEEAACUnPgM1NC4CJzceAxUUDgIHMS8BPgE1NCYnNx4DFQ4DBzEnPgE1NCYnNx4BFRQGBycFETMlESUjA9oqJj4rFxcrPiYqKkMwGRkwQyqkKTlERDkpITQkFAEUJDMhwyIoKCIqJjAwJir9zc0BE/7tzQAjKF5pcjw8cWleKSMrZnJ8QUF8cmYrgyM1kVRUkTUjHkhQWC8vWVFHHbMWSCkrRhUjHFw0NVkfKQMBE839U80AAAIAQAAAA8MDgAAHAA8AAAEXIREXNxcHAQcnNychEScDKnD+qXCXeZn+JpZ6lnABV20Cc3ABV3CWepP+I5Z6lnD+qmwAAwBAARMFwAJgAAwAGQAmAAABFAYjIiY1NDYzMhYVIRQGIyImNTQ2MzIWFSEUBiMiJjU0NjMyFhUBjWJFRWFhRUViAhZhRUViYkVFYQIdYUVFYmJFRWEBukViYkVFYWFFRWJiRUVhYUVFYmJFRWFhRQAAAAABAGYAJgOaA1oAIAAAARcWFAcGIi8BBwYiJyY0PwEnJjQ3NjIfATc2MhcWFA8BAqP3JCQkYx329iRjHSQk9/ckJCRjHfb2JGMdJCT3AcD2JGMdJCT39yQkJGMd9vYkYx0kJPf3JCQkYx32AAAGAEQABAO8A3wABAAJAA4AEwAYAB0AAAEhFSE1ESEVITURIRUhNQEzFSM1ETMVIzURMxUjNQGnAhX96wIV/esCFf3r/p2ysrKysrIDfFlZ/p1ZWf6dWVkCxrKy/p2ysv6dsrIAAQAAAAEZmqHTqz9fDzz1AAsEAAAAAADR1CIrAAAAANHUIisAAAAABcADoAAAAAgAAgAAAAAAAAABAAADwP/AAAAGAAAAAAAFwAABAAAAAAAAAAAAAAAAAAAAGwQAAAAAAAAAAAAAAAIAAAAGAABgBAAAQAUAAEAFAABABgAAQAYAAEAEAADgBIAAQAQAAEAGAABABgAAPQPgAEMEgABGBAAAgAQAAIAEgABKA4AAQwTAAEAEwABABAAAQAYAAEAEAABmBAAARAAAAAAACgAUAB4AiAC4AQQBYAKGA7ID1AQIBCoEpAUmBegGAAYaBioGQgaABpIG9AcWB1AHhge4AAEAAAAbAM8ABgAAAAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAOAK4AAQAAAAAAAQAMAAAAAQAAAAAAAgAHAI0AAQAAAAAAAwAMAEUAAQAAAAAABAAMAKIAAQAAAAAABQALACQAAQAAAAAABgAMAGkAAQAAAAAACgAaAMYAAwABBAkAAQAYAAwAAwABBAkAAgAOAJQAAwABBAkAAwAYAFEAAwABBAkABAAYAK4AAwABBAkABQAWAC8AAwABBAkABgAYAHUAAwABBAkACgA0AOBqdy1zaXgtaWNvbnMAagB3AC0AcwBpAHgALQBpAGMAbwBuAHNWZXJzaW9uIDEuMQBWAGUAcgBzAGkAbwBuACAAMQAuADFqdy1zaXgtaWNvbnMAagB3AC0AcwBpAHgALQBpAGMAbwBuAHNqdy1zaXgtaWNvbnMAagB3AC0AcwBpAHgALQBpAGMAbwBuAHNSZWd1bGFyAFIAZQBnAHUAbABhAHJqdy1zaXgtaWNvbnMAagB3AC0AcwBpAHgALQBpAGMAbwBuAHNGb250IGdlbmVyYXRlZCBieSBJY29Nb29uLgBGAG8AbgB0ACAAZwBlAG4AZQByAGEAdABlAGQAIABiAHkAIABJAGMAbwBNAG8AbwBuAC4AAAADAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA"},function(a,b,c){function d(a,b){for(var c=0;c<a.length;c++){var d=a[c],e=l[d.id];if(e){e.refs++;for(var f=0;f<e.parts.length;f++)e.parts[f](d.parts[f]);for(;f<d.parts.length;f++)e.parts.push(h(d.parts[f],b))}else{for(var g=[],f=0;f<d.parts.length;f++)g.push(h(d.parts[f],b));l[d.id]={id:d.id,refs:1,parts:g}}}}function e(a){for(var b=[],c={},d=0;d<a.length;d++){var e=a[d],f=e[0],g=e[1],h=e[2],i=e[3],j={css:g,media:h,sourceMap:i};c[f]?c[f].parts.push(j):b.push(c[f]={id:f,parts:[j]})}return b}function f(){var a=document.createElement("style"),b=o();return a.type="text/css",b.appendChild(a),a}function g(){var a=document.createElement("link"),b=o();return a.rel="stylesheet",b.appendChild(a),a}function h(a,b){var c,d,e;if(b.singleton){var h=q++;c=p||(p=f()),d=i.bind(null,c,h,!1),e=i.bind(null,c,h,!0)}else a.sourceMap&&"function"==typeof URL&&"function"==typeof URL.createObjectURL&&"function"==typeof URL.revokeObjectURL&&"function"==typeof Blob&&"function"==typeof btoa?(c=g(),d=k.bind(null,c),e=function(){c.parentNode.removeChild(c),c.href&&URL.revokeObjectURL(c.href)}):(c=f(),d=j.bind(null,c),e=function(){c.parentNode.removeChild(c)});return d(a),function(b){if(b){if(b.css===a.css&&b.media===a.media&&b.sourceMap===a.sourceMap)return;d(a=b)}else e()}}function i(a,b,c,d){var e=c?"":d.css;if(a.styleSheet)a.styleSheet.cssText=r(b,e);else{var f=document.createTextNode(e),g=a.childNodes;g[b]&&a.removeChild(g[b]),g.length?a.insertBefore(f,g[b]):a.appendChild(f)}}function j(a,b){var c=b.css,d=b.media;b.sourceMap;if(d&&a.setAttribute("media",d),a.styleSheet)a.styleSheet.cssText=c;else{for(;a.firstChild;)a.removeChild(a.firstChild);a.appendChild(document.createTextNode(c))}}function k(a,b){var c=b.css,d=(b.media,b.sourceMap);d&&(c+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(d))))+" */");var e=new Blob([c],{type:"text/css"}),f=a.href;a.href=URL.createObjectURL(e),f&&URL.revokeObjectURL(f)}var l={},m=function(a){var b;return function(){return"undefined"==typeof b&&(b=a.apply(this,arguments)),b}},n=m(function(){return/msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())}),o=m(function(){return document.head||document.getElementsByTagName("head")[0]}),p=null,q=0;a.exports=function(a,b){b=b||{},"undefined"==typeof b.singleton&&(b.singleton=n());var c=e(a);return d(c,b),function(a){for(var f=[],g=0;g<c.length;g++){var h=c[g],i=l[h.id];i.refs--,f.push(i)}if(a){var j=e(a);d(j,b)}for(var g=0;g<f.length;g++){var i=f[g];if(0===i.refs){for(var k=0;k<i.parts.length;k++)i.parts[k]();delete l[i.id]}}}};var r=function(){var a=[];return function(b,c){return a[b]=c,a.filter(Boolean).join("\n")}}()},function(a,b,c){var d,e;d=[c(40),c(47),c(58),c(45),c(79),c(50),c(117),c(90),c(96),c(91),c(73),c(66),c(65),c(82),c(83),c(159),c(101),c(93)],e=function(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r){var s={};return s.api=a,s._=b,s.version=c,s.utils=b.extend(d,f,{canCast:p.available,getCookies:e.getAllItems,saveCookie:e.setItem,key:h,extend:b.extend,scriptloader:i,rssparser:q,tea:j,UI:g}),s.utils.css.style=s.utils.style,s.vid=k,s.events=b.extend({},l,{state:m}),s.playlist=b.extend({},n,{item:o}),s.plugins=r,s.cast=p,s}.apply(b,d),!(void 0!==e&&(a.exports=e))}])});
/*! object-fit-polyfill - 2015-11-04 */!function(window,document){"use strict";var supports=function(){var div=document.createElement("div"),vendors="Khtml Ms O Moz Webkit".split(" "),len=vendors.length;return function(prop){if(prop in div.style)return!0;for(prop=prop.replace(/^[a-z]/,function(val){return val.toUpperCase()});len--;)if(vendors[len]+prop in div.style)return!0;return!1}}(),copyComputedStyle=function(from,to){var computed_style_object=!1;if(computed_style_object=from.currentStyle||document.defaultView.getComputedStyle(from,null),!computed_style_object)return null;var stylePropertyValid=function(name,value){return"undefined"!=typeof value&&"object"!=typeof value&&"function"!=typeof value&&value.length>0&&value!=parseInt(value)};for(var property in computed_style_object)stylePropertyValid(property,computed_style_object[property])&&(to.style[property]=computed_style_object[property])};if(supports("object-fit")===!1)for(var oDiv,sSource,oImages=document.querySelectorAll("[data-object-fit]"),nKey=0;nKey<oImages.length;nKey++){switch(oDiv=document.createElement("div"),sSource=oImages[nKey].getAttribute("data-src-retina")?oImages[nKey].getAttribute("data-src-retina"):oImages[nKey].getAttribute("data-src")?oImages[nKey].getAttribute("data-src"):oImages[nKey].src,copyComputedStyle(oImages[nKey],oDiv),oDiv.style.display="block",oDiv.style.backgroundImage="url("+sSource+")",oDiv.style.backgroundPosition="center center",oDiv.style.className=oImages[nKey].className,oDiv.style.backgroundRepeat="no-repeat",oImages[nKey].getAttribute("data-object-fit")){case"cover":oDiv.style.backgroundSize="cover";break;case"contain":oDiv.style.backgroundSize="contain";break;case"fill":oDiv.style.backgroundSize="100% 100%";break;case"none":oDiv.style.backgroundSize="auto"}oImages[nKey].parentNode.replaceChild(oDiv,oImages[nKey])}}(window,document);

/**
 * Owl carousel
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 * @todo Lazy Load Icon
 * @todo prevent animationend bubling
 * @todo itemsScaleUp
 * @todo Test Zepto
 * @todo stagePadding calculate wrong active classes
 */
;(function($, window, document, undefined) {

	var drag, state, e;

	/**
	 * Template for status information about drag and touch events.
	 * @private
	 */
	drag = {
		start: 0,
		startX: 0,
		startY: 0,
		current: 0,
		currentX: 0,
		currentY: 0,
		offsetX: 0,
		offsetY: 0,
		distance: null,
		startTime: 0,
		endTime: 0,
		updatedX: 0,
		targetEl: null
	};

	/**
	 * Template for some status informations.
	 * @private
	 */
	state = {
		isTouch: false,
		isScrolling: false,
		isSwiping: false,
		direction: false,
		inMotion: false
	};

	/**
	 * Event functions references.
	 * @private
	 */
	e = {
		_onDragStart: null,
		_onDragMove: null,
		_onDragEnd: null,
		_transitionEnd: null,
		_resizer: null,
		_responsiveCall: null,
		_goToLoop: null,
		_checkVisibile: null
	};

	/**
	 * Creates a carousel.
	 * @class The Owl Carousel.
	 * @public
	 * @param {HTMLElement|jQuery} element - The element to create the carousel for.
	 * @param {Object} [options] - The options
	 */
	function Owl(element, options) {

		/**
		 * Current settings for the carousel.
		 * @public
		 */
		this.settings = null;

		/**
		 * Current options set by the caller including defaults.
		 * @public
		 */
		this.options = $.extend({}, Owl.Defaults, options);

		/**
		 * Plugin element.
		 * @public
		 */
		this.$element = $(element);

		/**
		 * Caches informations about drag and touch events.
		 */
		this.drag = $.extend({}, drag);

		/**
		 * Caches some status informations.
		 * @protected
		 */
		this.state = $.extend({}, state);

		/**
		 * @protected
		 * @todo Must be documented
		 */
		this.e = $.extend({}, e);

		/**
		 * References to the running plugins of this carousel.
		 * @protected
		 */
		this._plugins = {};

		/**
		 * Currently suppressed events to prevent them from beeing retriggered.
		 * @protected
		 */
		this._supress = {};

		/**
		 * Absolute current position.
		 * @protected
		 */
		this._current = null;

		/**
		 * Animation speed in milliseconds.
		 * @protected
		 */
		this._speed = null;

		/**
		 * Coordinates of all items in pixel.
		 * @todo The name of this member is missleading.
		 * @protected
		 */
		this._coordinates = [];

		/**
		 * Current breakpoint.
		 * @todo Real media queries would be nice.
		 * @protected
		 */
		this._breakpoint = null;

		/**
		 * Current width of the plugin element.
		 */
		this._width = null;

		/**
		 * All real items.
		 * @protected
		 */
		this._items = [];

		/**
		 * All cloned items.
		 * @protected
		 */
		this._clones = [];

		/**
		 * Merge values of all items.
		 * @todo Maybe this could be part of a plugin.
		 * @protected
		 */
		this._mergers = [];

		/**
		 * Invalidated parts within the update process.
		 * @protected
		 */
		this._invalidated = {};

		/**
		 * Ordered list of workers for the update process.
		 * @protected
		 */
		this._pipe = [];

		$.each(Owl.Plugins, $.proxy(function(key, plugin) {
			this._plugins[key[0].toLowerCase() + key.slice(1)]
				= new plugin(this);
		}, this));

		$.each(Owl.Pipe, $.proxy(function(priority, worker) {
			this._pipe.push({
				'filter': worker.filter,
				'run': $.proxy(worker.run, this)
			});
		}, this));

		this.setup();
		this.initialize();
	}

	/**
	 * Default options for the carousel.
	 * @public
	 */
	Owl.Defaults = {
		items: 3,
		loop: false,
		center: false,

		mouseDrag: true,
		touchDrag: true,
		pullDrag: true,
		freeDrag: false,

		margin: 0,
		stagePadding: 0,

		merge: false,
		mergeFit: true,
		autoWidth: false,

		startPosition: 0,
		rtl: false,

		smartSpeed: 250,
		fluidSpeed: false,
		dragEndSpeed: false,

		responsive: {},
		responsiveRefreshRate: 200,
		responsiveBaseElement: window,
		responsiveClass: false,

		fallbackEasing: 'swing',

		info: false,

		nestedItemSelector: false,
		itemElement: 'div',
		stageElement: 'div',

		// Classes and Names
		themeClass: 'owl-theme',
		baseClass: 'owl-carousel',
		itemClass: 'owl-item',
		centerClass: 'center',
		activeClass: 'active'
	};

	/**
	 * Enumeration for width.
	 * @public
	 * @readonly
	 * @enum {String}
	 */
	Owl.Width = {
		Default: 'default',
		Inner: 'inner',
		Outer: 'outer'
	};

	/**
	 * Contains all registered plugins.
	 * @public
	 */
	Owl.Plugins = {};

	/**
	 * Update pipe.
	 */
	Owl.Pipe = [ {
		filter: [ 'width', 'items', 'settings' ],
		run: function(cache) {
			cache.current = this._items && this._items[this.relative(this._current)];
		}
	}, {
		filter: [ 'items', 'settings' ],
		run: function() {
			var cached = this._clones,
				clones = this.$stage.children('.cloned');

			if (clones.length !== cached.length || (!this.settings.loop && cached.length > 0)) {
				this.$stage.children('.cloned').remove();
				this._clones = [];
			}
		}
	}, {
		filter: [ 'items', 'settings' ],
		run: function() {
			var i, n,
				clones = this._clones,
				items = this._items,
				delta = this.settings.loop ? clones.length - Math.max(this.settings.items * 2, 4) : 0;

			for (i = 0, n = Math.abs(delta / 2); i < n; i++) {
				if (delta > 0) {
					this.$stage.children().eq(items.length + clones.length - 1).remove();
					clones.pop();
					this.$stage.children().eq(0).remove();
					clones.pop();
				} else {
					clones.push(clones.length / 2);
					this.$stage.append(items[clones[clones.length - 1]].clone().addClass('cloned'));
					clones.push(items.length - 1 - (clones.length - 1) / 2);
					this.$stage.prepend(items[clones[clones.length - 1]].clone().addClass('cloned'));
				}
			}
		}
	}, {
		filter: [ 'width', 'items', 'settings' ],
		run: function() {
			var rtl = (this.settings.rtl ? 1 : -1),
				width = (this.width() / this.settings.items).toFixed(3),
				coordinate = 0, merge, i, n;

			this._coordinates = [];
			for (i = 0, n = this._clones.length + this._items.length; i < n; i++) {
				merge = this._mergers[this.relative(i)];
				merge = (this.settings.mergeFit && Math.min(merge, this.settings.items)) || merge;
				coordinate += (this.settings.autoWidth ? this._items[this.relative(i)].width() + this.settings.margin : width * merge) * rtl;

				this._coordinates.push(coordinate);
			}
		}
	}, {
		filter: [ 'width', 'items', 'settings' ],
		run: function() {
			var i, n, width = (this.width() / this.settings.items).toFixed(3), css = {
				'width': Math.abs(this._coordinates[this._coordinates.length - 1]) + this.settings.stagePadding * 2,
				'padding-left': this.settings.stagePadding || '',
				'padding-right': this.settings.stagePadding || ''
			};

			this.$stage.css(css);

			css = { 'width': this.settings.autoWidth ? 'auto' : width - this.settings.margin };
			css[this.settings.rtl ? 'margin-left' : 'margin-right'] = this.settings.margin;

			if (!this.settings.autoWidth && $.grep(this._mergers, function(v) { return v > 1 }).length > 0) {
				for (i = 0, n = this._coordinates.length; i < n; i++) {
					css.width = Math.abs(this._coordinates[i]) - Math.abs(this._coordinates[i - 1] || 0) - this.settings.margin;
					this.$stage.children().eq(i).css(css);
				}
			} else {
				this.$stage.children().css(css);
			}
		}
	}, {
		filter: [ 'width', 'items', 'settings' ],
		run: function(cache) {
			cache.current && this.reset(this.$stage.children().index(cache.current));
		}
	}, {
		filter: [ 'position' ],
		run: function() {
			this.animate(this.coordinates(this._current));
		}
	}, {
		filter: [ 'width', 'position', 'items', 'settings' ],
		run: function() {
			var rtl = this.settings.rtl ? 1 : -1,
				padding = this.settings.stagePadding * 2,
				begin = this.coordinates(this.current()) + padding,
				end = begin + this.width() * rtl,
				inner, outer, matches = [], i, n;

			for (i = 0, n = this._coordinates.length; i < n; i++) {
				inner = this._coordinates[i - 1] || 0;
				outer = Math.abs(this._coordinates[i]) + padding * rtl;

				if ((this.op(inner, '<=', begin) && (this.op(inner, '>', end)))
					|| (this.op(outer, '<', begin) && this.op(outer, '>', end))) {
					matches.push(i);
				}
			}

			this.$stage.children('.' + this.settings.activeClass).removeClass(this.settings.activeClass);
			this.$stage.children(':eq(' + matches.join('), :eq(') + ')').addClass(this.settings.activeClass);

			if (this.settings.center) {
				this.$stage.children('.' + this.settings.centerClass).removeClass(this.settings.centerClass);
				this.$stage.children().eq(this.current()).addClass(this.settings.centerClass);
			}
		}
	} ];

	/**
	 * Initializes the carousel.
	 * @protected
	 */
	Owl.prototype.initialize = function() {
		this.trigger('initialize');

		this.$element
			.addClass(this.settings.baseClass)
			.addClass(this.settings.themeClass)
			.toggleClass('owl-rtl', this.settings.rtl);

		// check support
		this.browserSupport();

		if (this.settings.autoWidth && this.state.imagesLoaded !== true) {
			var imgs, nestedSelector, width;
			imgs = this.$element.find('img');
			nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined;
			width = this.$element.children(nestedSelector).width();

			if (imgs.length && width <= 0) {
				this.preloadAutoWidthImages(imgs);
				return false;
			}
		}

		this.$element.addClass('owl-loading');

		// create stage
		this.$stage = $('<' + this.settings.stageElement + ' class="owl-stage"/>')
			.wrap('<div class="owl-stage-outer">');

		// append stage
		this.$element.append(this.$stage.parent());

		// append content
		this.replace(this.$element.children().not(this.$stage.parent()));

		// set view width
		this._width = this.$element.width();

		// update view
		this.refresh();

		this.$element.removeClass('owl-loading').addClass('owl-loaded');

		// attach generic events
		this.eventsCall();

		// attach generic events
		this.internalEvents();

		// attach custom control events
		this.addTriggerableEvents();

		this.trigger('initialized');
	};

	/**
	 * Setups the current settings.
	 * @todo Remove responsive classes. Why should adaptive designs be brought into IE8?
	 * @todo Support for media queries by using `matchMedia` would be nice.
	 * @public
	 */
	Owl.prototype.setup = function() {
		var viewport = this.viewport(),
			overwrites = this.options.responsive,
			match = -1,
			settings = null;

		if (!overwrites) {
			settings = $.extend({}, this.options);
		} else {
			$.each(overwrites, function(breakpoint) {
				if (breakpoint <= viewport && breakpoint > match) {
					match = Number(breakpoint);
				}
			});

			settings = $.extend({}, this.options, overwrites[match]);
			delete settings.responsive;

			// responsive class
			if (settings.responsiveClass) {
				this.$element.attr('class', function(i, c) {
					return c.replace(/\b owl-responsive-\S+/g, '');
				}).addClass('owl-responsive-' + match);
			}
		}

		if (this.settings === null || this._breakpoint !== match) {
			this.trigger('change', { property: { name: 'settings', value: settings } });
			this._breakpoint = match;
			this.settings = settings;
			this.invalidate('settings');
			this.trigger('changed', { property: { name: 'settings', value: this.settings } });
		}
	};

	/**
	 * Updates option logic if necessery.
	 * @protected
	 */
	Owl.prototype.optionsLogic = function() {
		// Toggle Center class
		this.$element.toggleClass('owl-center', this.settings.center);

		// if items number is less than in body
		if (this.settings.loop && this._items.length < this.settings.items) {
			this.settings.loop = false;
		}

		if (this.settings.autoWidth) {
			this.settings.stagePadding = false;
			this.settings.merge = false;
		}
	};

	/**
	 * Prepares an item before add.
	 * @todo Rename event parameter `content` to `item`.
	 * @protected
	 * @returns {jQuery|HTMLElement} - The item container.
	 */
	Owl.prototype.prepare = function(item) {
		var event = this.trigger('prepare', { content: item });

		if (!event.data) {
			event.data = $('<' + this.settings.itemElement + '/>')
				.addClass(this.settings.itemClass).append(item)
		}

		this.trigger('prepared', { content: event.data });

		return event.data;
	};

	/**
	 * Updates the view.
	 * @public
	 */
	Owl.prototype.update = function() {
		var i = 0,
			n = this._pipe.length,
			filter = $.proxy(function(p) { return this[p] }, this._invalidated),
			cache = {};

		while (i < n) {
			if (this._invalidated.all || $.grep(this._pipe[i].filter, filter).length > 0) {
				this._pipe[i].run(cache);
			}
			i++;
		}

		this._invalidated = {};
	};

	/**
	 * Gets the width of the view.
	 * @public
	 * @param {Owl.Width} [dimension=Owl.Width.Default] - The dimension to return.
	 * @returns {Number} - The width of the view in pixel.
	 */
	Owl.prototype.width = function(dimension) {
		dimension = dimension || Owl.Width.Default;
		switch (dimension) {
			case Owl.Width.Inner:
			case Owl.Width.Outer:
				return this._width;
			default:
				return this._width - this.settings.stagePadding * 2 + this.settings.margin;
		}
	};

	/**
	 * Refreshes the carousel primarily for adaptive purposes.
	 * @public
	 */
	Owl.prototype.refresh = function() {
		if (this._items.length === 0) {
			return false;
		}

		var start = new Date().getTime();

		this.trigger('refresh');

		this.setup();

		this.optionsLogic();

		// hide and show methods helps here to set a proper widths,
		// this prevents scrollbar to be calculated in stage width
		this.$stage.addClass('owl-refresh');

		this.update();

		this.$stage.removeClass('owl-refresh');

		this.state.orientation = window.orientation;

		this.watchVisibility();

		this.trigger('refreshed');
	};

	/**
	 * Save internal event references and add event based functions.
	 * @protected
	 */
	Owl.prototype.eventsCall = function() {
		// Save events references
		this.e._onDragStart = $.proxy(function(e) {
			this.onDragStart(e);
		}, this);
		this.e._onDragMove = $.proxy(function(e) {
			this.onDragMove(e);
		}, this);
		this.e._onDragEnd = $.proxy(function(e) {
			this.onDragEnd(e);
		}, this);
		this.e._onResize = $.proxy(function(e) {
			this.onResize(e);
		}, this);
		this.e._transitionEnd = $.proxy(function(e) {
			this.transitionEnd(e);
		}, this);
		this.e._preventClick = $.proxy(function(e) {
			this.preventClick(e);
		}, this);
	};

	/**
	 * Checks window `resize` event.
	 * @protected
	 */
	Owl.prototype.onThrottledResize = function() {
		window.clearTimeout(this.resizeTimer);
		this.resizeTimer = window.setTimeout(this.e._onResize, this.settings.responsiveRefreshRate);
	};

	/**
	 * Checks window `resize` event.
	 * @protected
	 */
	Owl.prototype.onResize = function() {
		if (!this._items.length) {
			return false;
		}

		if (this._width === this.$element.width()) {
			return false;
		}

		if (this.trigger('resize').isDefaultPrevented()) {
			return false;
		}

		this._width = this.$element.width();

		this.invalidate('width');

		this.refresh();

		this.trigger('resized');
	};

	/**
	 * Checks for touch/mouse drag event type and add run event handlers.
	 * @protected
	 */
	Owl.prototype.eventsRouter = function(event) {
		var type = event.type;

		if (type === "mousedown" || type === "touchstart") {
			this.onDragStart(event);
		} else if (type === "mousemove" || type === "touchmove") {
			this.onDragMove(event);
		} else if (type === "mouseup" || type === "touchend") {
			this.onDragEnd(event);
		} else if (type === "touchcancel") {
			this.onDragEnd(event);
		}
	};

	/**
	 * Checks for touch/mouse drag options and add necessery event handlers.
	 * @protected
	 */
	Owl.prototype.internalEvents = function() {
		var isTouch = isTouchSupport(),
			isTouchIE = isTouchSupportIE();

		if (this.settings.mouseDrag){
			this.$stage.on('mousedown', $.proxy(function(event) { this.eventsRouter(event) }, this));
			this.$stage.on('dragstart', function() { return false });
			this.$stage.get(0).onselectstart = function() { return false };
		} else {
			this.$element.addClass('owl-text-select-on');
		}

		if (this.settings.touchDrag && !isTouchIE){
			this.$stage.on('touchstart touchcancel', $.proxy(function(event) { this.eventsRouter(event) }, this));
		}

		// catch transitionEnd event
		if (this.transitionEndVendor) {
			this.on(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd, false);
		}

		// responsive
		if (this.settings.responsive !== false) {
			this.on(window, 'resize', $.proxy(this.onThrottledResize, this));
		}
	};

	/**
	 * Handles touchstart/mousedown event.
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	Owl.prototype.onDragStart = function(event) {
		var ev, isTouchEvent, pageX, pageY, animatedPos;

		ev = event.originalEvent || event || window.event;

		// prevent right click
		if (ev.which === 3 || this.state.isTouch) {
			return false;
		}

		if (ev.type === 'mousedown') {
			this.$stage.addClass('owl-grab');
		}

		this.trigger('drag');
		this.drag.startTime = new Date().getTime();
		this.speed(0);
		this.state.isTouch = true;
		this.state.isScrolling = false;
		this.state.isSwiping = false;
		this.drag.distance = 0;

		pageX = getTouches(ev).x;
		pageY = getTouches(ev).y;

		// get stage position left
		this.drag.offsetX = this.$stage.position().left;
		this.drag.offsetY = this.$stage.position().top;

		if (this.settings.rtl) {
			this.drag.offsetX = this.$stage.position().left + this.$stage.width() - this.width()
				+ this.settings.margin;
		}

		// catch position // ie to fix
		if (this.state.inMotion && this.support3d) {
			animatedPos = this.getTransformProperty();
			this.drag.offsetX = animatedPos;
			this.animate(animatedPos);
			this.state.inMotion = true;
		} else if (this.state.inMotion && !this.support3d) {
			this.state.inMotion = false;
			return false;
		}

		this.drag.startX = pageX - this.drag.offsetX;
		this.drag.startY = pageY - this.drag.offsetY;

		this.drag.start = pageX - this.drag.startX;
		this.drag.targetEl = ev.target || ev.srcElement;
		this.drag.updatedX = this.drag.start;

		// to do/check
		// prevent links and images dragging;
		if (this.drag.targetEl.tagName === "IMG" || this.drag.targetEl.tagName === "A") {
			this.drag.targetEl.draggable = false;
		}

		$(document).on('mousemove.owl.dragEvents mouseup.owl.dragEvents touchmove.owl.dragEvents touchend.owl.dragEvents', $.proxy(function(event) {this.eventsRouter(event)},this));
	};

	/**
	 * Handles the touchmove/mousemove events.
	 * @todo Simplify
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	Owl.prototype.onDragMove = function(event) {
		var ev, isTouchEvent, pageX, pageY, minValue, maxValue, pull;

		if (!this.state.isTouch) {
			return;
		}

		if (this.state.isScrolling) {
			return;
		}

		ev = event.originalEvent || event || window.event;

		pageX = getTouches(ev).x;
		pageY = getTouches(ev).y;

		// Drag Direction
		this.drag.currentX = pageX - this.drag.startX;
		this.drag.currentY = pageY - this.drag.startY;
		this.drag.distance = this.drag.currentX - this.drag.offsetX;

		// Check move direction
		if (this.drag.distance < 0) {
			this.state.direction = this.settings.rtl ? 'right' : 'left';
		} else if (this.drag.distance > 0) {
			this.state.direction = this.settings.rtl ? 'left' : 'right';
		}
		// Loop
		if (this.settings.loop) {
			if (this.op(this.drag.currentX, '>', this.coordinates(this.minimum())) && this.state.direction === 'right') {
				this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length);
			} else if (this.op(this.drag.currentX, '<', this.coordinates(this.maximum())) && this.state.direction === 'left') {
				this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length);
			}
		} else {
			// pull
			minValue = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
			maxValue = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
			pull = this.settings.pullDrag ? this.drag.distance / 5 : 0;
			this.drag.currentX = Math.max(Math.min(this.drag.currentX, minValue + pull), maxValue + pull);
		}

		// Lock browser if swiping horizontal

		if ((this.drag.distance > 8 || this.drag.distance < -8)) {
			if (ev.preventDefault !== undefined) {
				ev.preventDefault();
			} else {
				ev.returnValue = false;
			}
			this.state.isSwiping = true;
		}

		this.drag.updatedX = this.drag.currentX;

		// Lock Owl if scrolling
		if ((this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === false) {
			this.state.isScrolling = true;
			this.drag.updatedX = this.drag.start;
		}

		this.animate(this.drag.updatedX);
	};

	/**
	 * Handles the touchend/mouseup events.
	 * @protected
	 */
	Owl.prototype.onDragEnd = function(event) {
		var compareTimes, distanceAbs, closest;

		if (!this.state.isTouch) {
			return;
		}

		if (event.type === 'mouseup') {
			this.$stage.removeClass('owl-grab');
		}

		this.trigger('dragged');

		// prevent links and images dragging;
		this.drag.targetEl.removeAttribute("draggable");

		// remove drag event listeners

		this.state.isTouch = false;
		this.state.isScrolling = false;
		this.state.isSwiping = false;

		// to check
		if (this.drag.distance === 0 && this.state.inMotion !== true) {
			this.state.inMotion = false;
			return false;
		}

		// prevent clicks while scrolling

		this.drag.endTime = new Date().getTime();
		compareTimes = this.drag.endTime - this.drag.startTime;
		distanceAbs = Math.abs(this.drag.distance);

		// to test
		if (distanceAbs > 3 || compareTimes > 300) {
			this.removeClick(this.drag.targetEl);
		}

		closest = this.closest(this.drag.updatedX);

		this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
		this.current(closest);
		this.invalidate('position');
		this.update();

		// if pullDrag is off then fire transitionEnd event manually when stick
		// to border
		if (!this.settings.pullDrag && this.drag.updatedX === this.coordinates(closest)) {
			this.transitionEnd();
		}

		this.drag.distance = 0;

		$(document).off('.owl.dragEvents');
	};

	/**
	 * Attaches `preventClick` to disable link while swipping.
	 * @protected
	 * @param {HTMLElement} [target] - The target of the `click` event.
	 */
	Owl.prototype.removeClick = function(target) {
		this.drag.targetEl = target;
		$(target).on('click.preventClick', this.e._preventClick);
		// to make sure click is removed:
		window.setTimeout(function() {
			$(target).off('click.preventClick');
		}, 300);
	};

	/**
	 * Suppresses click event.
	 * @protected
	 * @param {Event} ev - The event arguments.
	 */
	Owl.prototype.preventClick = function(ev) {
		if (ev.preventDefault) {
			ev.preventDefault();
		} else {
			ev.returnValue = false;
		}
		if (ev.stopPropagation) {
			ev.stopPropagation();
		}
		$(ev.target).off('click.preventClick');
	};

	/**
	 * Catches stage position while animate (only CSS3).
	 * @protected
	 * @returns
	 */
	Owl.prototype.getTransformProperty = function() {
		var transform, matrix3d;

		transform = window.getComputedStyle(this.$stage.get(0), null).getPropertyValue(this.vendorName + 'transform');
		// var transform = this.$stage.css(this.vendorName + 'transform')
		transform = transform.replace(/matrix(3d)?\(|\)/g, '').split(',');
		matrix3d = transform.length === 16;

		return matrix3d !== true ? transform[4] : transform[12];
	};

	/**
	 * Gets absolute position of the closest item for a coordinate.
	 * @todo Setting `freeDrag` makes `closest` not reusable. See #165.
	 * @protected
	 * @param {Number} coordinate - The coordinate in pixel.
	 * @return {Number} - The absolute position of the closest item.
	 */
	Owl.prototype.closest = function(coordinate) {
		var position = -1, pull = 30, width = this.width(), coordinates = this.coordinates();

		if (!this.settings.freeDrag) {
			// check closest item
			$.each(coordinates, $.proxy(function(index, value) {
				if (coordinate > value - pull && coordinate < value + pull) {
					position = index;
				} else if (this.op(coordinate, '<', value)
					&& this.op(coordinate, '>', coordinates[index + 1] || value - width)) {
					position = this.state.direction === 'left' ? index + 1 : index;
				}
				return position === -1;
			}, this));
		}

		if (!this.settings.loop) {
			// non loop boundries
			if (this.op(coordinate, '>', coordinates[this.minimum()])) {
				position = coordinate = this.minimum();
			} else if (this.op(coordinate, '<', coordinates[this.maximum()])) {
				position = coordinate = this.maximum();
			}
		}

		return position;
	};

	/**
	 * Animates the stage.
	 * @public
	 * @param {Number} coordinate - The coordinate in pixels.
	 */
	Owl.prototype.animate = function(coordinate) {
		this.trigger('translate');
		this.state.inMotion = this.speed() > 0;

		if (this.support3d) {
			this.$stage.css({
				transform: 'translate3d(' + coordinate + 'px' + ',0px, 0px)',
				transition: (this.speed() / 1000) + 's'
			});
		} else if (this.state.isTouch) {
			this.$stage.css({
				left: coordinate + 'px'
			});
		} else {
			this.$stage.animate({
				left: coordinate
			}, this.speed() / 1000, this.settings.fallbackEasing, $.proxy(function() {
				if (this.state.inMotion) {
					this.transitionEnd();
				}
			}, this));
		}
	};

	/**
	 * Sets the absolute position of the current item.
	 * @public
	 * @param {Number} [position] - The new absolute position or nothing to leave it unchanged.
	 * @returns {Number} - The absolute position of the current item.
	 */
	Owl.prototype.current = function(position) {
		if (position === undefined) {
			return this._current;
		}

		if (this._items.length === 0) {
			return undefined;
		}

		position = this.normalize(position);

		if (this._current !== position) {
			var event = this.trigger('change', { property: { name: 'position', value: position } });

			if (event.data !== undefined) {
				position = this.normalize(event.data);
			}

			this._current = position;

			this.invalidate('position');

			this.trigger('changed', { property: { name: 'position', value: this._current } });
		}

		return this._current;
	};

	/**
	 * Invalidates the given part of the update routine.
	 * @param {String} part - The part to invalidate.
	 */
	Owl.prototype.invalidate = function(part) {
		this._invalidated[part] = true;
	}

	/**
	 * Resets the absolute position of the current item.
	 * @public
	 * @param {Number} position - The absolute position of the new item.
	 */
	Owl.prototype.reset = function(position) {
		position = this.normalize(position);

		if (position === undefined) {
			return;
		}

		this._speed = 0;
		this._current = position;

		this.suppress([ 'translate', 'translated' ]);

		this.animate(this.coordinates(position));

		this.release([ 'translate', 'translated' ]);
	};

	/**
	 * Normalizes an absolute or a relative position for an item.
	 * @public
	 * @param {Number} position - The absolute or relative position to normalize.
	 * @param {Boolean} [relative=false] - Whether the given position is relative or not.
	 * @returns {Number} - The normalized position.
	 */
	Owl.prototype.normalize = function(position, relative) {
		var n = (relative ? this._items.length : this._items.length + this._clones.length);

		if (!$.isNumeric(position) || n < 1) {
			return undefined;
		}

		if (this._clones.length) {
			position = ((position % n) + n) % n;
		} else {
			position = Math.max(this.minimum(relative), Math.min(this.maximum(relative), position));
		}

		return position;
	};

	/**
	 * Converts an absolute position for an item into a relative position.
	 * @public
	 * @param {Number} position - The absolute position to convert.
	 * @returns {Number} - The converted position.
	 */
	Owl.prototype.relative = function(position) {
		position = this.normalize(position);
		position = position - this._clones.length / 2;
		return this.normalize(position, true);
	};

	/**
	 * Gets the maximum position for an item.
	 * @public
	 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
	 * @returns {Number}
	 */
	Owl.prototype.maximum = function(relative) {
		var maximum, width, i = 0, coordinate,
			settings = this.settings;

		if (relative) {
			return this._items.length - 1;
		}

		if (!settings.loop && settings.center) {
			maximum = this._items.length - 1;
		} else if (!settings.loop && !settings.center) {
			maximum = this._items.length - settings.items;
		} else if (settings.loop || settings.center) {
			maximum = this._items.length + settings.items;
		} else if (settings.autoWidth || settings.merge) {
			revert = settings.rtl ? 1 : -1;
			width = this.$stage.width() - this.$element.width();
			while (coordinate = this.coordinates(i)) {
				if (coordinate * revert >= width) {
					break;
				}
				maximum = ++i;
			}
		} else {
			throw 'Can not detect maximum absolute position.'
		}

		return maximum;
	};

	/**
	 * Gets the minimum position for an item.
	 * @public
	 * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
	 * @returns {Number}
	 */
	Owl.prototype.minimum = function(relative) {
		if (relative) {
			return 0;
		}

		return this._clones.length / 2;
	};

	/**
	 * Gets an item at the specified relative position.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
	 */
	Owl.prototype.items = function(position) {
		if (position === undefined) {
			return this._items.slice();
		}

		position = this.normalize(position, true);
		return this._items[position];
	};

	/**
	 * Gets an item at the specified relative position.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
	 */
	Owl.prototype.mergers = function(position) {
		if (position === undefined) {
			return this._mergers.slice();
		}

		position = this.normalize(position, true);
		return this._mergers[position];
	};

	/**
	 * Gets the absolute positions of clones for an item.
	 * @public
	 * @param {Number} [position] - The relative position of the item.
	 * @returns {Array.<Number>} - The absolute positions of clones for the item or all if no position was given.
	 */
	Owl.prototype.clones = function(position) {
		var odd = this._clones.length / 2,
			even = odd + this._items.length,
			map = function(index) { return index % 2 === 0 ? even + index / 2 : odd - (index + 1) / 2 };

		if (position === undefined) {
			return $.map(this._clones, function(v, i) { return map(i) });
		}

		return $.map(this._clones, function(v, i) { return v === position ? map(i) : null });
	};

	/**
	 * Sets the current animation speed.
	 * @public
	 * @param {Number} [speed] - The animation speed in milliseconds or nothing to leave it unchanged.
	 * @returns {Number} - The current animation speed in milliseconds.
	 */
	Owl.prototype.speed = function(speed) {
		if (speed !== undefined) {
			this._speed = speed;
		}

		return this._speed;
	};

	/**
	 * Gets the coordinate of an item.
	 * @todo The name of this method is missleanding.
	 * @public
	 * @param {Number} position - The absolute position of the item within `minimum()` and `maximum()`.
	 * @returns {Number|Array.<Number>} - The coordinate of the item in pixel or all coordinates.
	 */
	Owl.prototype.coordinates = function(position) {
		var coordinate = null;

		if (position === undefined) {
			return $.map(this._coordinates, $.proxy(function(coordinate, index) {
				return this.coordinates(index);
			}, this));
		}

		if (this.settings.center) {
			coordinate = this._coordinates[position];
			coordinate += (this.width() - coordinate + (this._coordinates[position - 1] || 0)) / 2 * (this.settings.rtl ? -1 : 1);
		} else {
			coordinate = this._coordinates[position - 1] || 0;
		}

		return coordinate;
	};

	/**
	 * Calculates the speed for a translation.
	 * @protected
	 * @param {Number} from - The absolute position of the start item.
	 * @param {Number} to - The absolute position of the target item.
	 * @param {Number} [factor=undefined] - The time factor in milliseconds.
	 * @returns {Number} - The time in milliseconds for the translation.
	 */
	Owl.prototype.duration = function(from, to, factor) {
		return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
	};

	/**
	 * Slides to the specified item.
	 * @public
	 * @param {Number} position - The position of the item.
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
	Owl.prototype.to = function(position, speed) {
		if (this.settings.loop) {
			var distance = position - this.relative(this.current()),
				revert = this.current(),
				before = this.current(),
				after = this.current() + distance,
				direction = before - after < 0 ? true : false,
				items = this._clones.length + this._items.length;

			if (after < this.settings.items && direction === false) {
				revert = before + this._items.length;
				this.reset(revert);
			} else if (after >= items - this.settings.items && direction === true) {
				revert = before - this._items.length;
				this.reset(revert);
			}
			window.clearTimeout(this.e._goToLoop);
			this.e._goToLoop = window.setTimeout($.proxy(function() {
				this.speed(this.duration(this.current(), revert + distance, speed));
				this.current(revert + distance);
				this.update();
			}, this), 30);
		} else {
			this.speed(this.duration(this.current(), position, speed));
			this.current(position);
			this.update();
		}
	};

	/**
	 * Slides to the next item.
	 * @public
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
	Owl.prototype.next = function(speed) {
		speed = speed || false;
		this.to(this.relative(this.current()) + 1, speed);
	};

	/**
	 * Slides to the previous item.
	 * @public
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 */
	Owl.prototype.prev = function(speed) {
		speed = speed || false;
		this.to(this.relative(this.current()) - 1, speed);
	};

	/**
	 * Handles the end of an animation.
	 * @protected
	 * @param {Event} event - The event arguments.
	 */
	Owl.prototype.transitionEnd = function(event) {

		// if css2 animation then event object is undefined
		if (event !== undefined) {
			event.stopPropagation();

			// Catch only owl-stage transitionEnd event
			if ((event.target || event.srcElement || event.originalTarget) !== this.$stage.get(0)) {
				return false;
			}
		}

		this.state.inMotion = false;
		this.trigger('translated');
	};

	/**
	 * Gets viewport width.
	 * @protected
	 * @return {Number} - The width in pixel.
	 */
	Owl.prototype.viewport = function() {
		var width;
		if (this.options.responsiveBaseElement !== window) {
			width = $(this.options.responsiveBaseElement).width();
		} else if (window.innerWidth) {
			width = window.innerWidth;
		} else if (document.documentElement && document.documentElement.clientWidth) {
			width = document.documentElement.clientWidth;
		} else {
			throw 'Can not detect viewport width.';
		}
		return width;
	};

	/**
	 * Replaces the current content.
	 * @public
	 * @param {HTMLElement|jQuery|String} content - The new content.
	 */
	Owl.prototype.replace = function(content) {
		this.$stage.empty();
		this._items = [];

		if (content) {
			content = (content instanceof jQuery) ? content : $(content);
		}

		if (this.settings.nestedItemSelector) {
			content = content.find('.' + this.settings.nestedItemSelector);
		}

		content.filter(function() {
			return this.nodeType === 1;
		}).each($.proxy(function(index, item) {
			item = this.prepare(item);
			this.$stage.append(item);
			this._items.push(item);
			this._mergers.push(item.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
		}, this));

		this.reset($.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0);

		this.invalidate('items');
	};

	/**
	 * Adds an item.
	 * @todo Use `item` instead of `content` for the event arguments.
	 * @public
	 * @param {HTMLElement|jQuery|String} content - The item content to add.
	 * @param {Number} [position] - The relative position at which to insert the item otherwise the item will be added to the end.
	 */
	Owl.prototype.add = function(content, position) {
		position = position === undefined ? this._items.length : this.normalize(position, true);

		this.trigger('add', { content: content, position: position });

		if (this._items.length === 0 || position === this._items.length) {
			this.$stage.append(content);
			this._items.push(content);
			this._mergers.push(content.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
		} else {
			this._items[position].before(content);
			this._items.splice(position, 0, content);
			this._mergers.splice(position, 0, content.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
		}

		this.invalidate('items');

		this.trigger('added', { content: content, position: position });
	};

	/**
	 * Removes an item by its position.
	 * @todo Use `item` instead of `content` for the event arguments.
	 * @public
	 * @param {Number} position - The relative position of the item to remove.
	 */
	Owl.prototype.remove = function(position) {
		position = this.normalize(position, true);

		if (position === undefined) {
			return;
		}

		this.trigger('remove', { content: this._items[position], position: position });

		this._items[position].remove();
		this._items.splice(position, 1);
		this._mergers.splice(position, 1);

		this.invalidate('items');

		this.trigger('removed', { content: null, position: position });
	};

	/**
	 * Adds triggerable events.
	 * @protected
	 */
	Owl.prototype.addTriggerableEvents = function() {
		var handler = $.proxy(function(callback, event) {
			return $.proxy(function(e) {
				if (e.relatedTarget !== this) {
					this.suppress([ event ]);
					callback.apply(this, [].slice.call(arguments, 1));
					this.release([ event ]);
				}
			}, this);
		}, this);

		$.each({
			'next': this.next,
			'prev': this.prev,
			'to': this.to,
			'destroy': this.destroy,
			'refresh': this.refresh,
			'replace': this.replace,
			'add': this.add,
			'remove': this.remove
		}, $.proxy(function(event, callback) {
			this.$element.on(event + '.owl.carousel', handler(callback, event + '.owl.carousel'));
		}, this));

	};

	/**
	 * Watches the visibility of the carousel element.
	 * @protected
	 */
	Owl.prototype.watchVisibility = function() {

		// test on zepto
		if (!isElVisible(this.$element.get(0))) {
			this.$element.addClass('owl-hidden');
			window.clearInterval(this.e._checkVisibile);
			this.e._checkVisibile = window.setInterval($.proxy(checkVisible, this), 500);
		}

		function isElVisible(el) {
			return el.offsetWidth > 0 && el.offsetHeight > 0;
		}

		function checkVisible() {
			if (isElVisible(this.$element.get(0))) {
				this.$element.removeClass('owl-hidden');
				this.refresh();
				window.clearInterval(this.e._checkVisibile);
			}
		}
	};

	/**
	 * Preloads images with auto width.
	 * @protected
	 * @todo Still to test
	 */
	Owl.prototype.preloadAutoWidthImages = function(imgs) {
		var loaded, that, $el, img;

		loaded = 0;
		that = this;
		imgs.each(function(i, el) {
			$el = $(el);
			img = new Image();

			img.onload = function() {
				loaded++;
				$el.attr('src', img.src);
				$el.css('opacity', 1);
				if (loaded >= imgs.length) {
					that.state.imagesLoaded = true;
					that.initialize();
				}
			};

			img.src = $el.attr('src') || $el.attr('data-src') || $el.attr('data-src-retina');
		});
	};

	/**
	 * Destroys the carousel.
	 * @public
	 */
	Owl.prototype.destroy = function() {

		if (this.$element.hasClass(this.settings.themeClass)) {
			this.$element.removeClass(this.settings.themeClass);
		}

		if (this.settings.responsive !== false) {
			$(window).off('resize.owl.carousel');
		}

		if (this.transitionEndVendor) {
			this.off(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd);
		}

		for ( var i in this._plugins) {
			this._plugins[i].destroy();
		}

		if (this.settings.mouseDrag || this.settings.touchDrag) {
			this.$stage.off('mousedown touchstart touchcancel');
			$(document).off('.owl.dragEvents');
			this.$stage.get(0).onselectstart = function() {};
			this.$stage.off('dragstart', function() { return false });
		}

		// remove event handlers in the ".owl.carousel" namespace
		this.$element.off('.owl');

		this.$stage.children('.cloned').remove();
		this.e = null;
		this.$element.removeData('owlCarousel');

		this.$stage.children().contents().unwrap();
		this.$stage.children().unwrap();
		this.$stage.unwrap();
	};

	/**
	 * Operators to calculate right-to-left and left-to-right.
	 * @protected
	 * @param {Number} [a] - The left side operand.
	 * @param {String} [o] - The operator.
	 * @param {Number} [b] - The right side operand.
	 */
	Owl.prototype.op = function(a, o, b) {
		var rtl = this.settings.rtl;
		switch (o) {
			case '<':
				return rtl ? a > b : a < b;
			case '>':
				return rtl ? a < b : a > b;
			case '>=':
				return rtl ? a <= b : a >= b;
			case '<=':
				return rtl ? a >= b : a <= b;
			default:
				break;
		}
	};

	/**
	 * Attaches to an internal event.
	 * @protected
	 * @param {HTMLElement} element - The event source.
	 * @param {String} event - The event name.
	 * @param {Function} listener - The event handler to attach.
	 * @param {Boolean} capture - Wether the event should be handled at the capturing phase or not.
	 */
	Owl.prototype.on = function(element, event, listener, capture) {
		if (element.addEventListener) {
			element.addEventListener(event, listener, capture);
		} else if (element.attachEvent) {
			element.attachEvent('on' + event, listener);
		}
	};

	/**
	 * Detaches from an internal event.
	 * @protected
	 * @param {HTMLElement} element - The event source.
	 * @param {String} event - The event name.
	 * @param {Function} listener - The attached event handler to detach.
	 * @param {Boolean} capture - Wether the attached event handler was registered as a capturing listener or not.
	 */
	Owl.prototype.off = function(element, event, listener, capture) {
		if (element.removeEventListener) {
			element.removeEventListener(event, listener, capture);
		} else if (element.detachEvent) {
			element.detachEvent('on' + event, listener);
		}
	};

	/**
	 * Triggers an public event.
	 * @protected
	 * @param {String} name - The event name.
	 * @param {*} [data=null] - The event data.
	 * @param {String} [namespace=.owl.carousel] - The event namespace.
	 * @returns {Event} - The event arguments.
	 */
	Owl.prototype.trigger = function(name, data, namespace) {
		var status = {
			item: { count: this._items.length, index: this.current() }
		}, handler = $.camelCase(
			$.grep([ 'on', name, namespace ], function(v) { return v })
				.join('-').toLowerCase()
		), event = $.Event(
			[ name, 'owl', namespace || 'carousel' ].join('.').toLowerCase(),
			$.extend({ relatedTarget: this }, status, data)
		);

		if (!this._supress[name]) {
			$.each(this._plugins, function(name, plugin) {
				if (plugin.onTrigger) {
					plugin.onTrigger(event);
				}
			});

			this.$element.trigger(event);

			if (this.settings && typeof this.settings[handler] === 'function') {
				this.settings[handler].apply(this, event);
			}
		}

		return event;
	};

	/**
	 * Suppresses events.
	 * @protected
	 * @param {Array.<String>} events - The events to suppress.
	 */
	Owl.prototype.suppress = function(events) {
		$.each(events, $.proxy(function(index, event) {
			this._supress[event] = true;
		}, this));
	}

	/**
	 * Releases suppressed events.
	 * @protected
	 * @param {Array.<String>} events - The events to release.
	 */
	Owl.prototype.release = function(events) {
		$.each(events, $.proxy(function(index, event) {
			delete this._supress[event];
		}, this));
	}

	/**
	 * Checks the availability of some browser features.
	 * @protected
	 */
	Owl.prototype.browserSupport = function() {
		this.support3d = isPerspective();

		if (this.support3d) {
			this.transformVendor = isTransform();

			// take transitionend event name by detecting transition
			var endVendors = [ 'transitionend', 'webkitTransitionEnd', 'transitionend', 'oTransitionEnd' ];
			this.transitionEndVendor = endVendors[isTransition()];

			// take vendor name from transform name
			this.vendorName = this.transformVendor.replace(/Transform/i, '');
			this.vendorName = this.vendorName !== '' ? '-' + this.vendorName.toLowerCase() + '-' : '';
		}

		this.state.orientation = window.orientation;
	};

	/**
	 * Get touch/drag coordinats.
	 * @private
	 * @param {event} - mousedown/touchstart event
	 * @returns {object} - Contains X and Y of current mouse/touch position
	 */

	function getTouches(event) {
		if (event.touches !== undefined) {
			return {
				x: event.touches[0].pageX,
				y: event.touches[0].pageY
			};
		}

		if (event.touches === undefined) {
			if (event.pageX !== undefined) {
				return {
					x: event.pageX,
					y: event.pageY
				};
			}

		if (event.pageX === undefined) {
			return {
					x: event.clientX,
					y: event.clientY
				};
			}
		}
	}

	/**
	 * Checks for CSS support.
	 * @private
	 * @param {Array} array - The CSS properties to check for.
	 * @returns {Array} - Contains the supported CSS property name and its index or `false`.
	 */
	function isStyleSupported(array) {
		var p, s, fake = document.createElement('div'), list = array;
		for (p in list) {
			s = list[p];
			if (typeof fake.style[s] !== 'undefined') {
				fake = null;
				return [ s, p ];
			}
		}
		return [ false ];
	}

	/**
	 * Checks for CSS transition support.
	 * @private
	 * @todo Realy bad design
	 * @returns {Number}
	 */
	function isTransition() {
		return isStyleSupported([ 'transition', 'WebkitTransition', 'MozTransition', 'OTransition' ])[1];
	}

	/**
	 * Checks for CSS transform support.
	 * @private
	 * @returns {String} The supported property name or false.
	 */
	function isTransform() {
		return isStyleSupported([ 'transform', 'WebkitTransform', 'MozTransform', 'OTransform', 'msTransform' ])[0];
	}

	/**
	 * Checks for CSS perspective support.
	 * @private
	 * @returns {String} The supported property name or false.
	 */
	function isPerspective() {
		return isStyleSupported([ 'perspective', 'webkitPerspective', 'MozPerspective', 'OPerspective', 'MsPerspective' ])[0];
	}

	/**
	 * Checks wether touch is supported or not.
	 * @private
	 * @returns {Boolean}
	 */
	function isTouchSupport() {
		return 'ontouchstart' in window || !!(navigator.msMaxTouchPoints);
	}

	/**
	 * Checks wether touch is supported or not for IE.
	 * @private
	 * @returns {Boolean}
	 */
	function isTouchSupportIE() {
		return window.navigator.msPointerEnabled;
	}

	/**
	 * The jQuery Plugin for the Owl Carousel
	 * @public
	 */
	$.fn.owlCarousel = function(options) {
		return this.each(function() {
			if (!$(this).data('owlCarousel')) {
				$(this).data('owlCarousel', new Owl(this, options));
			}
		});
	};

	/**
	 * The constructor for the jQuery Plugin
	 * @public
	 */
	$.fn.owlCarousel.Constructor = Owl;

})(window.Zepto || window.jQuery, window, document);

/**
 * Lazy Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the lazy plugin.
	 * @class The Lazy Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var Lazy = function(carousel) {

		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Already loaded items.
		 * @protected
		 * @type {Array.<jQuery>}
		 */
		this._loaded = [];

		/**
		 * Event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'initialized.owl.carousel change.owl.carousel': $.proxy(function(e) {
				if (!e.namespace) {
					return;
				}

				if (!this._core.settings || !this._core.settings.lazyLoad) {
					return;
				}

				if ((e.property && e.property.name == 'position') || e.type == 'initialized') {
					var settings = this._core.settings,
						n = (settings.center && Math.ceil(settings.items / 2) || settings.items),
						i = ((settings.center && n * -1) || 0),
						position = ((e.property && e.property.value) || this._core.current()) + i,
						clones = this._core.clones().length,
						load = $.proxy(function(i, v) { this.load(v) }, this);

					while (i++ < n) {
						this.load(clones / 2 + this._core.relative(position));
						clones && $.each(this._core.clones(this._core.relative(position++)), load);
					}
				}
			}, this)
		};

		// set the default options
		this._core.options = $.extend({}, Lazy.Defaults, this._core.options);

		// register event handler
		this._core.$element.on(this._handlers);
	}

	/**
	 * Default options.
	 * @public
	 */
	Lazy.Defaults = {
		lazyLoad: false
	}

	/**
	 * Loads all resources of an item at the specified position.
	 * @param {Number} position - The absolute position of the item.
	 * @protected
	 */
	Lazy.prototype.load = function(position) {
		var $item = this._core.$stage.children().eq(position),
			$elements = $item && $item.find('.owl-lazy');

		if (!$elements || $.inArray($item.get(0), this._loaded) > -1) {
			return;
		}

		$elements.each($.proxy(function(index, element) {
			var $element = $(element), image,
				url = (window.devicePixelRatio > 1 && $element.attr('data-src-retina')) || $element.attr('data-src');

			this._core.trigger('load', { element: $element, url: url }, 'lazy');

			if ($element.is('img')) {
				$element.one('load.owl.lazy', $.proxy(function() {
					$element.css('opacity', 1);
					this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
				}, this)).attr('src', url);
			} else {
				image = new Image();
				image.onload = $.proxy(function() {
					$element.css({
						'background-image': 'url(' + url + ')',
						'opacity': '1'
					});
					this._core.trigger('loaded', { element: $element, url: url }, 'lazy');
				}, this);
				image.src = url;
			}
		}, this));

		this._loaded.push($item.get(0));
	}

	/**
	 * Destroys the plugin.
	 * @public
	 */
	Lazy.prototype.destroy = function() {
		var handler, property;

		for (handler in this.handlers) {
			this._core.$element.off(handler, this.handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	}

	$.fn.owlCarousel.Constructor.Plugins.Lazy = Lazy;

})(window.Zepto || window.jQuery, window, document);

/**
 * AutoHeight Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the auto height plugin.
	 * @class The Auto Height Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var AutoHeight = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'initialized.owl.carousel': $.proxy(function() {
				if (this._core.settings.autoHeight) {
					this.update();
				}
			}, this),
			'changed.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.autoHeight && e.property.name == 'position'){
					this.update();
				}
			}, this),
			'loaded.owl.lazy': $.proxy(function(e) {
				if (this._core.settings.autoHeight && e.element.closest('.' + this._core.settings.itemClass)
					=== this._core.$stage.children().eq(this._core.current())) {
					this.update();
				}
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, AutoHeight.Defaults, this._core.options);

		// register event handlers
		this._core.$element.on(this._handlers);
	};

	/**
	 * Default options.
	 * @public
	 */
	AutoHeight.Defaults = {
		autoHeight: false,
		autoHeightClass: 'owl-height'
	};

	/**
	 * Updates the view.
	 */
	AutoHeight.prototype.update = function() {
		this._core.$stage.parent()
			.height(this._core.$stage.children().eq(this._core.current()).height())
			.addClass(this._core.settings.autoHeightClass);
	};

	AutoHeight.prototype.destroy = function() {
		var handler, property;

		for (handler in this._handlers) {
			this._core.$element.off(handler, this._handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.AutoHeight = AutoHeight;

})(window.Zepto || window.jQuery, window, document);

/**
 * Video Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the video plugin.
	 * @class The Video Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var Video = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Cache all video URLs.
		 * @protected
		 * @type {Object}
		 */
		this._videos = {};

		/**
		 * Current playing item.
		 * @protected
		 * @type {jQuery}
		 */
		this._playing = null;

		/**
		 * Whether this is in fullscreen or not.
		 * @protected
		 * @type {Boolean}
		 */
		this._fullscreen = false;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'resize.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.video && !this.isInFullScreen()) {
					e.preventDefault();
				}
			}, this),
			'refresh.owl.carousel changed.owl.carousel': $.proxy(function(e) {
				if (this._playing) {
					this.stop();
				}
			}, this),
			'prepared.owl.carousel': $.proxy(function(e) {
				var $element = $(e.content).find('.owl-video');
				if ($element.length) {
					$element.css('display', 'none');
					this.fetch($element, $(e.content));
				}
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, Video.Defaults, this._core.options);

		// register event handlers
		this._core.$element.on(this._handlers);

		this._core.$element.on('click.owl.video', '.owl-video-play-icon', $.proxy(function(e) {
			this.play(e);
		}, this));
	};

	/**
	 * Default options.
	 * @public
	 */
	Video.Defaults = {
		video: false,
		videoHeight: false,
		videoWidth: false
	};

	/**
	 * Gets the video ID and the type (YouTube/Vimeo only).
	 * @protected
	 * @param {jQuery} target - The target containing the video data.
	 * @param {jQuery} item - The item containing the video.
	 */
	Video.prototype.fetch = function(target, item) {

		var type = target.attr('data-vimeo-id') ? 'vimeo' : 'youtube',
			id = target.attr('data-vimeo-id') || target.attr('data-youtube-id'),
			width = target.attr('data-width') || this._core.settings.videoWidth,
			height = target.attr('data-height') || this._core.settings.videoHeight,
			url = target.attr('href');

		if (url) {
			id = url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

			if (id[3].indexOf('youtu') > -1) {
				type = 'youtube';
			} else if (id[3].indexOf('vimeo') > -1) {
				type = 'vimeo';
			} else {
				throw new Error('Video URL not supported.');
			}
			id = id[6];
		} else {
			throw new Error('Missing video URL.');
		}

		this._videos[url] = {
			type: type,
			id: id,
			width: width,
			height: height
		};

		item.attr('data-video', url);

		this.thumbnail(target, this._videos[url]);
	};

	/**
	 * Creates video thumbnail.
	 * @protected
	 * @param {jQuery} target - The target containing the video data.
	 * @param {Object} info - The video info object.
	 * @see `fetch`
	 */
	Video.prototype.thumbnail = function(target, video) {

		var tnLink,
			icon,
			path,
			dimensions = video.width && video.height ? 'style="width:' + video.width + 'px;height:' + video.height + 'px;"' : '',
			customTn = target.find('img'),
			srcType = 'src',
			lazyClass = '',
			settings = this._core.settings,
			create = function(path) {
				icon = '<div class="owl-video-play-icon"></div>';

				if (settings.lazyLoad) {
					tnLink = '<div class="owl-video-tn ' + lazyClass + '" ' + srcType + '="' + path + '"></div>';
				} else {
					tnLink = '<div class="owl-video-tn" style="opacity:1;background-image:url(' + path + ')"></div>';
				}
				target.after(tnLink);
				target.after(icon);
			};

		// wrap video content into owl-video-wrapper div
		target.wrap('<div class="owl-video-wrapper"' + dimensions + '></div>');

		if (this._core.settings.lazyLoad) {
			srcType = 'data-src';
			lazyClass = 'owl-lazy';
		}

		// custom thumbnail
		if (customTn.length) {
			create(customTn.attr(srcType));
			customTn.remove();
			return false;
		}

		if (video.type === 'youtube') {
			path = "http://img.youtube.com/vi/" + video.id + "/hqdefault.jpg";
			create(path);
		} else if (video.type === 'vimeo') {
			$.ajax({
				type: 'GET',
				url: 'http://vimeo.com/api/v2/video/' + video.id + '.json',
				jsonp: 'callback',
				dataType: 'jsonp',
				success: function(data) {
					path = data[0].thumbnail_large;
					create(path);
				}
			});
		}
	};

	/**
	 * Stops the current video.
	 * @public
	 */
	Video.prototype.stop = function() {
		this._core.trigger('stop', null, 'video');
		this._playing.find('.owl-video-frame').remove();
		this._playing.removeClass('owl-video-playing');
		this._playing = null;
	};

	/**
	 * Starts the current video.
	 * @public
	 * @param {Event} ev - The event arguments.
	 */
	Video.prototype.play = function(ev) {
		this._core.trigger('play', null, 'video');

		if (this._playing) {
			this.stop();
		}

		var target = $(ev.target || ev.srcElement),
			item = target.closest('.' + this._core.settings.itemClass),
			video = this._videos[item.attr('data-video')],
			width = video.width || '100%',
			height = video.height || this._core.$stage.height(),
			html, wrap;

		if (video.type === 'youtube') {
			html = '<iframe width="' + width + '" height="' + height + '" src="http://www.youtube.com/embed/'
				+ video.id + '?autoplay=1&v=' + video.id + '" frameborder="0" allowfullscreen></iframe>';
		} else if (video.type === 'vimeo') {
			html = '<iframe src="http://player.vimeo.com/video/' + video.id + '?autoplay=1" width="' + width
				+ '" height="' + height
				+ '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		}

		item.addClass('owl-video-playing');
		this._playing = item;

		wrap = $('<div style="height:' + height + 'px; width:' + width + 'px" class="owl-video-frame">'
			+ html + '</div>');
		target.after(wrap);
	};

	/**
	 * Checks whether an video is currently in full screen mode or not.
	 * @todo Bad style because looks like a readonly method but changes members.
	 * @protected
	 * @returns {Boolean}
	 */
	Video.prototype.isInFullScreen = function() {

		// if Vimeo Fullscreen mode
		var element = document.fullscreenElement || document.mozFullScreenElement
			|| document.webkitFullscreenElement;

		if (element && $(element).parent().hasClass('owl-video-frame')) {
			this._core.speed(0);
			this._fullscreen = true;
		}

		if (element && this._fullscreen && this._playing) {
			return false;
		}

		// comming back from fullscreen
		if (this._fullscreen) {
			this._fullscreen = false;
			return false;
		}

		// check full screen mode and window orientation
		if (this._playing) {
			if (this._core.state.orientation !== window.orientation) {
				this._core.state.orientation = window.orientation;
				return false;
			}
		}

		return true;
	};

	/**
	 * Destroys the plugin.
	 */
	Video.prototype.destroy = function() {
		var handler, property;

		this._core.$element.off('click.owl.video');

		for (handler in this._handlers) {
			this._core.$element.off(handler, this._handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.Video = Video;

})(window.Zepto || window.jQuery, window, document);

/**
 * Animate Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the animate plugin.
	 * @class The Navigation Plugin
	 * @param {Owl} scope - The Owl Carousel
	 */
	var Animate = function(scope) {
		this.core = scope;
		this.core.options = $.extend({}, Animate.Defaults, this.core.options);
		this.swapping = true;
		this.previous = undefined;
		this.next = undefined;

		this.handlers = {
			'change.owl.carousel': $.proxy(function(e) {
				if (e.property.name == 'position') {
					this.previous = this.core.current();
					this.next = e.property.value;
				}
			}, this),
			'drag.owl.carousel dragged.owl.carousel translated.owl.carousel': $.proxy(function(e) {
				this.swapping = e.type == 'translated';
			}, this),
			'translate.owl.carousel': $.proxy(function(e) {
				if (this.swapping && (this.core.options.animateOut || this.core.options.animateIn)) {
					this.swap();
				}
			}, this)
		};

		this.core.$element.on(this.handlers);
	};

	/**
	 * Default options.
	 * @public
	 */
	Animate.Defaults = {
		animateOut: false,
		animateIn: false
	};

	/**
	 * Toggles the animation classes whenever an translations starts.
	 * @protected
	 * @returns {Boolean|undefined}
	 */
	Animate.prototype.swap = function() {

		if (this.core.settings.items !== 1 || !this.core.support3d) {
			return;
		}

		this.core.speed(0);

		var left,
			clear = $.proxy(this.clear, this),
			previous = this.core.$stage.children().eq(this.previous),
			next = this.core.$stage.children().eq(this.next),
			incoming = this.core.settings.animateIn,
			outgoing = this.core.settings.animateOut;

		if (this.core.current() === this.previous) {
			return;
		}

		if (outgoing) {
			left = this.core.coordinates(this.previous) - this.core.coordinates(this.next);
			previous.css( { 'left': left + 'px' } )
				.addClass('animated owl-animated-out')
				.addClass(outgoing)
				.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
		}

		if (incoming) {
			next.addClass('animated owl-animated-in')
				.addClass(incoming)
				.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', clear);
		}
	};

	Animate.prototype.clear = function(e) {
		$(e.target).css( { 'left': '' } )
			.removeClass('animated owl-animated-out owl-animated-in')
			.removeClass(this.core.settings.animateIn)
			.removeClass(this.core.settings.animateOut);
		this.core.transitionEnd();
	}

	/**
	 * Destroys the plugin.
	 * @public
	 */
	Animate.prototype.destroy = function() {
		var handler, property;

		for (handler in this.handlers) {
			this.core.$element.off(handler, this.handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.Animate = Animate;

})(window.Zepto || window.jQuery, window, document);

/**
 * Autoplay Plugin
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {

	/**
	 * Creates the autoplay plugin.
	 * @class The Autoplay Plugin
	 * @param {Owl} scope - The Owl Carousel
	 */
	var Autoplay = function(scope) {
		this.core = scope;
		this.core.options = $.extend({}, Autoplay.Defaults, this.core.options);

		this.handlers = {
			'translated.owl.carousel refreshed.owl.carousel': $.proxy(function() {
				this.autoplay();
			}, this),
			'play.owl.autoplay': $.proxy(function(e, t, s) {
				this.play(t, s);
			}, this),
			'stop.owl.autoplay': $.proxy(function() {
				this.stop();
			}, this),
			'mouseover.owl.autoplay': $.proxy(function() {
				if (this.core.settings.autoplayHoverPause) {
					this.pause();
				}
			}, this),
			'mouseleave.owl.autoplay': $.proxy(function() {
				if (this.core.settings.autoplayHoverPause) {
					this.autoplay();
				}
			}, this)
		};

		this.core.$element.on(this.handlers);
	};

	/**
	 * Default options.
	 * @public
	 */
	Autoplay.Defaults = {
		autoplay: false,
		autoplayTimeout: 5000,
		autoplayHoverPause: false,
		autoplaySpeed: false
	};

	/**
	 * @protected
	 * @todo Must be documented.
	 */
	Autoplay.prototype.autoplay = function() {
		if (this.core.settings.autoplay && !this.core.state.videoPlay) {
			window.clearInterval(this.interval);

			this.interval = window.setInterval($.proxy(function() {
				this.play();
			}, this), this.core.settings.autoplayTimeout);
		} else {
			window.clearInterval(this.interval);
		}
	};

	/**
	 * Starts the autoplay.
	 * @public
	 * @param {Number} [timeout] - ...
	 * @param {Number} [speed] - ...
	 * @returns {Boolean|undefined} - ...
	 * @todo Must be documented.
	 */
	Autoplay.prototype.play = function(timeout, speed) {
		// if tab is inactive - doesnt work in <IE10
		if (document.hidden === true) {
			return;
		}

		if (this.core.state.isTouch || this.core.state.isScrolling
			|| this.core.state.isSwiping || this.core.state.inMotion) {
			return;
		}

		if (this.core.settings.autoplay === false) {
			window.clearInterval(this.interval);
			return;
		}

		this.core.next(this.core.settings.autoplaySpeed);
	};

	/**
	 * Stops the autoplay.
	 * @public
	 */
	Autoplay.prototype.stop = function() {
		window.clearInterval(this.interval);
	};

	/**
	 * Pauses the autoplay.
	 * @public
	 */
	Autoplay.prototype.pause = function() {
		window.clearInterval(this.interval);
	};

	/**
	 * Destroys the plugin.
	 */
	Autoplay.prototype.destroy = function() {
		var handler, property;

		window.clearInterval(this.interval);

		for (handler in this.handlers) {
			this.core.$element.off(handler, this.handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	};

	$.fn.owlCarousel.Constructor.Plugins.autoplay = Autoplay;

})(window.Zepto || window.jQuery, window, document);

/**
 * Navigation Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
	'use strict';

	/**
	 * Creates the navigation plugin.
	 * @class The Navigation Plugin
	 * @param {Owl} carousel - The Owl Carousel.
	 */
	var Navigation = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Indicates whether the plugin is initialized or not.
		 * @protected
		 * @type {Boolean}
		 */
		this._initialized = false;

		/**
		 * The current paging indexes.
		 * @protected
		 * @type {Array}
		 */
		this._pages = [];

		/**
		 * All DOM elements of the user interface.
		 * @protected
		 * @type {Object}
		 */
		this._controls = {};

		/**
		 * Markup for an indicator.
		 * @protected
		 * @type {Array.<String>}
		 */
		this._templates = [];

		/**
		 * The carousel element.
		 * @type {jQuery}
		 */
		this.$element = this._core.$element;

		/**
		 * Overridden methods of the carousel.
		 * @protected
		 * @type {Object}
		 */
		this._overrides = {
			next: this._core.next,
			prev: this._core.prev,
			to: this._core.to
		};

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'prepared.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.dotsData) {
					this._templates.push($(e.content).find('[data-dot]').andSelf('[data-dot]').attr('data-dot'));
				}
			}, this),
			'add.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.dotsData) {
					this._templates.splice(e.position, 0, $(e.content).find('[data-dot]').andSelf('[data-dot]').attr('data-dot'));
				}
			}, this),
			'remove.owl.carousel prepared.owl.carousel': $.proxy(function(e) {
				if (this._core.settings.dotsData) {
					this._templates.splice(e.position, 1);
				}
			}, this),
			'change.owl.carousel': $.proxy(function(e) {
				if (e.property.name == 'position') {
					if (!this._core.state.revert && !this._core.settings.loop && this._core.settings.navRewind) {
						var current = this._core.current(),
							maximum = this._core.maximum(),
							minimum = this._core.minimum();
						e.data = e.property.value > maximum
							? current >= maximum ? minimum : maximum
							: e.property.value < minimum ? maximum : e.property.value;
					}
				}
			}, this),
			'changed.owl.carousel': $.proxy(function(e) {
				if (e.property.name == 'position') {
					this.draw();
				}
			}, this),
			'refreshed.owl.carousel': $.proxy(function() {
				if (!this._initialized) {
					this.initialize();
					this._initialized = true;
				}
				this._core.trigger('refresh', null, 'navigation');
				this.update();
				this.draw();
				this._core.trigger('refreshed', null, 'navigation');
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, Navigation.Defaults, this._core.options);

		// register event handlers
		this.$element.on(this._handlers);
	}

	/**
	 * Default options.
	 * @public
	 * @todo Rename `slideBy` to `navBy`
	 */
	Navigation.Defaults = {
		nav: false,
		navRewind: true,
		navText: [ 'prev', 'next' ],
		navSpeed: false,
		navElement: 'div',
		navContainer: false,
		navContainerClass: 'owl-nav',
		navClass: [ 'owl-prev', 'owl-next' ],
		slideBy: 1,
		dotClass: 'owl-dot',
		dotsClass: 'owl-dots',
		dots: true,
		dotsEach: false,
		dotData: false,
		dotsSpeed: false,
		dotsContainer: false,
		controlsClass: 'owl-controls'
	}

	/**
	 * Initializes the layout of the plugin and extends the carousel.
	 * @protected
	 */
	Navigation.prototype.initialize = function() {
		var $container, override,
			options = this._core.settings;

		// create the indicator template
		if (!options.dotsData) {
			this._templates = [ $('<div>')
				.addClass(options.dotClass)
				.append($('<span>'))
				.prop('outerHTML') ];
		}

		// create controls container if needed
		if (!options.navContainer || !options.dotsContainer) {
			this._controls.$container = $('<div>')
				.addClass(options.controlsClass)
				.appendTo(this.$element);
		}

		// create DOM structure for absolute navigation
		this._controls.$indicators = options.dotsContainer ? $(options.dotsContainer)
			: $('<div>').hide().addClass(options.dotsClass).appendTo(this._controls.$container);

		this._controls.$indicators.on('click', 'div', $.proxy(function(e) {
			var index = $(e.target).parent().is(this._controls.$indicators)
				? $(e.target).index() : $(e.target).parent().index();

			e.preventDefault();

			this.to(index, options.dotsSpeed);
		}, this));

		// create DOM structure for relative navigation
		$container = options.navContainer ? $(options.navContainer)
			: $('<div>').addClass(options.navContainerClass).prependTo(this._controls.$container);

		this._controls.$next = $('<' + options.navElement + '>');
		this._controls.$previous = this._controls.$next.clone();

		this._controls.$previous
			.addClass(options.navClass[0])
			.html(options.navText[0])
			.hide()
			.prependTo($container)
			.on('click', $.proxy(function(e) {
				this.prev(options.navSpeed);
			}, this));
		this._controls.$next
			.addClass(options.navClass[1])
			.html(options.navText[1])
			.hide()
			.appendTo($container)
			.on('click', $.proxy(function(e) {
				this.next(options.navSpeed);
			}, this));

		// override public methods of the carousel
		for (override in this._overrides) {
			this._core[override] = $.proxy(this[override], this);
		}
	}

	/**
	 * Destroys the plugin.
	 * @protected
	 */
	Navigation.prototype.destroy = function() {
		var handler, control, property, override;

		for (handler in this._handlers) {
			this.$element.off(handler, this._handlers[handler]);
		}
		for (control in this._controls) {
			this._controls[control].remove();
		}
		for (override in this.overides) {
			this._core[override] = this._overrides[override];
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	}

	/**
	 * Updates the internal state.
	 * @protected
	 */
	Navigation.prototype.update = function() {
		var i, j, k,
			options = this._core.settings,
			lower = this._core.clones().length / 2,
			upper = lower + this._core.items().length,
			size = options.center || options.autoWidth || options.dotData
				? 1 : options.dotsEach || options.items;

		if (options.slideBy !== 'page') {
			options.slideBy = Math.min(options.slideBy, options.items);
		}

		if (options.dots || options.slideBy == 'page') {
			this._pages = [];

			for (i = lower, j = 0, k = 0; i < upper; i++) {
				if (j >= size || j === 0) {
					this._pages.push({
						start: i - lower,
						end: i - lower + size - 1
					});
					j = 0, ++k;
				}
				j += this._core.mergers(this._core.relative(i));
			}
		}
	}

	/**
	 * Draws the user interface.
	 * @todo The option `dotData` wont work.
	 * @protected
	 */
	Navigation.prototype.draw = function() {
		var difference, i, html = '',
			options = this._core.settings,
			$items = this._core.$stage.children(),
			index = this._core.relative(this._core.current());

		if (options.nav && !options.loop && !options.navRewind) {
			this._controls.$previous.toggleClass('disabled', index <= 0);
			this._controls.$next.toggleClass('disabled', index >= this._core.maximum());
		}

		this._controls.$previous.toggle(options.nav);
		this._controls.$next.toggle(options.nav);

		if (options.dots) {
			difference = this._pages.length - this._controls.$indicators.children().length;

			if (options.dotData && difference !== 0) {
				for (i = 0; i < this._controls.$indicators.children().length; i++) {
					html += this._templates[this._core.relative(i)];
				}
				this._controls.$indicators.html(html);
			} else if (difference > 0) {
				html = new Array(difference + 1).join(this._templates[0]);
				this._controls.$indicators.append(html);
			} else if (difference < 0) {
				this._controls.$indicators.children().slice(difference).remove();
			}

			this._controls.$indicators.find('.active').removeClass('active');
			this._controls.$indicators.children().eq($.inArray(this.current(), this._pages)).addClass('active');
		}

		this._controls.$indicators.toggle(options.dots);
	}

	/**
	 * Extends event data.
	 * @protected
	 * @param {Event} event - The event object which gets thrown.
	 */
	Navigation.prototype.onTrigger = function(event) {
		var settings = this._core.settings;

		event.page = {
			index: $.inArray(this.current(), this._pages),
			count: this._pages.length,
			size: settings && (settings.center || settings.autoWidth || settings.dotData
				? 1 : settings.dotsEach || settings.items)
		};
	}

	/**
	 * Gets the current page position of the carousel.
	 * @protected
	 * @returns {Number}
	 */
	Navigation.prototype.current = function() {
		var index = this._core.relative(this._core.current());
		return $.grep(this._pages, function(o) {
			return o.start <= index && o.end >= index;
		}).pop();
	}

	/**
	 * Gets the current succesor/predecessor position.
	 * @protected
	 * @returns {Number}
	 */
	Navigation.prototype.getPosition = function(successor) {
		var position, length,
			options = this._core.settings;

		if (options.slideBy == 'page') {
			position = $.inArray(this.current(), this._pages);
			length = this._pages.length;
			successor ? ++position : --position;
			position = this._pages[((position % length) + length) % length].start;
		} else {
			position = this._core.relative(this._core.current());
			length = this._core.items().length;
			successor ? position += options.slideBy : position -= options.slideBy;
		}
		return position;
	}

	/**
	 * Slides to the next item or page.
	 * @public
	 * @param {Number} [speed=false] - The time in milliseconds for the transition.
	 */
	Navigation.prototype.next = function(speed) {
		$.proxy(this._overrides.to, this._core)(this.getPosition(true), speed);
	}

	/**
	 * Slides to the previous item or page.
	 * @public
	 * @param {Number} [speed=false] - The time in milliseconds for the transition.
	 */
	Navigation.prototype.prev = function(speed) {
		$.proxy(this._overrides.to, this._core)(this.getPosition(false), speed);
	}

	/**
	 * Slides to the specified item or page.
	 * @public
	 * @param {Number} position - The position of the item or page.
	 * @param {Number} [speed] - The time in milliseconds for the transition.
	 * @param {Boolean} [standard=false] - Whether to use the standard behaviour or not.
	 */
	Navigation.prototype.to = function(position, speed, standard) {
		var length;

		if (!standard) {
			length = this._pages.length;
			$.proxy(this._overrides.to, this._core)(this._pages[((position % length) + length) % length].start, speed);
		} else {
			$.proxy(this._overrides.to, this._core)(position, speed);
		}
	}

	$.fn.owlCarousel.Constructor.Plugins.Navigation = Navigation;

})(window.Zepto || window.jQuery, window, document);

/**
 * Hash Plugin
 * @version 2.0.0
 * @author Artus Kolanowski
 * @license The MIT License (MIT)
 */
;(function($, window, document, undefined) {
	'use strict';

	/**
	 * Creates the hash plugin.
	 * @class The Hash Plugin
	 * @param {Owl} carousel - The Owl Carousel
	 */
	var Hash = function(carousel) {
		/**
		 * Reference to the core.
		 * @protected
		 * @type {Owl}
		 */
		this._core = carousel;

		/**
		 * Hash table for the hashes.
		 * @protected
		 * @type {Object}
		 */
		this._hashes = {};

		/**
		 * The carousel element.
		 * @type {jQuery}
		 */
		this.$element = this._core.$element;

		/**
		 * All event handlers.
		 * @protected
		 * @type {Object}
		 */
		this._handlers = {
			'initialized.owl.carousel': $.proxy(function() {
				if (this._core.settings.startPosition == 'URLHash') {
					$(window).trigger('hashchange.owl.navigation');
				}
			}, this),
			'prepared.owl.carousel': $.proxy(function(e) {
				var hash = $(e.content).find('[data-hash]').andSelf('[data-hash]').attr('data-hash');
				this._hashes[hash] = e.content;
			}, this)
		};

		// set default options
		this._core.options = $.extend({}, Hash.Defaults, this._core.options);

		// register the event handlers
		this.$element.on(this._handlers);

		// register event listener for hash navigation
		$(window).on('hashchange.owl.navigation', $.proxy(function() {
			var hash = window.location.hash.substring(1),
				items = this._core.$stage.children(),
				position = this._hashes[hash] && items.index(this._hashes[hash]) || 0;

			if (!hash) {
				return false;
			}

			this._core.to(position, false, true);
		}, this));
	}

	/**
	 * Default options.
	 * @public
	 */
	Hash.Defaults = {
		URLhashListener: false
	}

	/**
	 * Destroys the plugin.
	 * @public
	 */
	Hash.prototype.destroy = function() {
		var handler, property;

		$(window).off('hashchange.owl.navigation');

		for (handler in this._handlers) {
			this._core.$element.off(handler, this._handlers[handler]);
		}
		for (property in Object.getOwnPropertyNames(this)) {
			typeof this[property] != 'function' && (this[property] = null);
		}
	}

	$.fn.owlCarousel.Constructor.Plugins.Hash = Hash;

})(window.Zepto || window.jQuery, window, document);

/*! sly 1.6.1 - 8th Aug 2015 | https://github.com/darsain/sly */
!function(a,b,c){"use strict";function d(b,p,q){function K(c){var d=0,e=Gb.length;if(yb.old=a.extend({},yb),wb=tb?0:ub[rb.horizontal?"width":"height"](),Bb=zb[rb.horizontal?"width":"height"](),xb=tb?b:vb[rb.horizontal?"outerWidth":"outerHeight"](),Gb.length=0,yb.start=0,yb.end=H(xb-wb,0),Rb){d=Ib.length,Hb=vb.children(rb.itemSelector),Ib.length=0;var f,g=j(vb,rb.horizontal?"paddingLeft":"paddingTop"),h=j(vb,rb.horizontal?"paddingRight":"paddingBottom"),i="border-box"===a(Hb).css("boxSizing"),l="none"!==Hb.css("float"),m=0,n=Hb.length-1;xb=0,Hb.each(function(b,c){var d=a(c),e=c.getBoundingClientRect(),i=G(rb.horizontal?e.width||e.right-e.left:e.height||e.bottom-e.top),k=j(d,rb.horizontal?"marginLeft":"marginTop"),o=j(d,rb.horizontal?"marginRight":"marginBottom"),p=i+k+o,q=!k||!o,r={};r.el=c,r.size=q?i:p,r.half=r.size/2,r.start=xb+(q?k:0),r.center=r.start-G(wb/2-r.size/2),r.end=r.start-wb+r.size,b||(xb+=g),xb+=p,rb.horizontal||l||o&&k&&b>0&&(xb-=I(k,o)),b===n&&(r.end+=h,xb+=h,m=q?o:0),Ib.push(r),f=r}),vb[0].style[rb.horizontal?"width":"height"]=(i?xb:xb-g-h)+"px",xb-=m,Ib.length?(yb.start=Ib[0][Pb?"center":"start"],yb.end=Pb?f.center:xb>wb?f.end:yb.start):yb.start=yb.end=0}if(yb.center=G(yb.end/2+yb.start/2),V(),Ab.length&&Bb>0&&(rb.dynamicHandle?(Cb=yb.start===yb.end?Bb:G(Bb*wb/xb),Cb=k(Cb,rb.minHandleSize,Bb),Ab[0].style[rb.horizontal?"width":"height"]=Cb+"px"):Cb=Ab[rb.horizontal?"outerWidth":"outerHeight"](),Db.end=Bb-Cb,ec||N()),!tb&&wb>0){var o=yb.start,p="";if(Rb)a.each(Ib,function(a,b){Pb?Gb.push(b.center):b.start+b.size>o&&o<=yb.end&&(o=b.start,Gb.push(o),o+=wb,o>yb.end&&o<yb.end+wb&&Gb.push(yb.end))});else for(;o-wb<yb.end;)Gb.push(o),o+=wb;if(Eb[0]&&e!==Gb.length){for(var q=0;q<Gb.length;q++)p+=rb.pageBuilder.call(sb,q);Fb=Eb.html(p).children(),Fb.eq(Jb.activePage).addClass(rb.activeClass)}}if(Jb.slideeSize=xb,Jb.frameSize=wb,Jb.sbSize=Bb,Jb.handleSize=Cb,Rb){c&&null!=rb.startAt&&(T(rb.startAt),sb[Qb?"toCenter":"toStart"](rb.startAt));var r=Ib[Jb.activeItem];L(Qb&&r?r.center:k(yb.dest,yb.start,yb.end))}else c?null!=rb.startAt&&L(rb.startAt,1):L(k(yb.dest,yb.start,yb.end));ob("load")}function L(a,b,c){if(Rb&&cc.released&&!c){var d=U(a),e=a>yb.start&&a<yb.end;Qb?(e&&(a=Ib[d.centerItem].center),Pb&&rb.activateMiddle&&T(d.centerItem)):e&&(a=Ib[d.firstItem].start)}cc.init&&cc.slidee&&rb.elasticBounds?a>yb.end?a=yb.end+(a-yb.end)/6:a<yb.start&&(a=yb.start+(a-yb.start)/6):a=k(a,yb.start,yb.end),ac.start=+new Date,ac.time=0,ac.from=yb.cur,ac.to=a,ac.delta=a-yb.cur,ac.tweesing=cc.tweese||cc.init&&!cc.slidee,ac.immediate=!ac.tweesing&&(b||cc.init&&cc.slidee||!rb.speed),cc.tweese=0,a!==yb.dest&&(yb.dest=a,ob("change"),ec||M()),Z(),V(),W(),O()}function M(){if(sb.initialized){if(!ec)return ec=t(M),void(cc.released&&ob("moveStart"));ac.immediate?yb.cur=ac.to:ac.tweesing?(ac.tweeseDelta=ac.to-yb.cur,D(ac.tweeseDelta)<.1?yb.cur=ac.to:yb.cur+=ac.tweeseDelta*(cc.released?rb.swingSpeed:rb.syncSpeed)):(ac.time=I(+new Date-ac.start,rb.speed),yb.cur=ac.from+ac.delta*a.easing[rb.easing](ac.time/rb.speed,ac.time,0,1,rb.speed)),ac.to===yb.cur?(yb.cur=ac.to,cc.tweese=ec=0):ec=t(M),ob("move"),tb||(m?vb[0].style[m]=n+(rb.horizontal?"translateX":"translateY")+"("+-yb.cur+"px)":vb[0].style[rb.horizontal?"left":"top"]=-G(yb.cur)+"px"),!ec&&cc.released&&ob("moveEnd"),N()}}function N(){Ab.length&&(Db.cur=yb.start===yb.end?0:((cc.init&&!cc.slidee?yb.dest:yb.cur)-yb.start)/(yb.end-yb.start)*Db.end,Db.cur=k(G(Db.cur),Db.start,Db.end),_b.hPos!==Db.cur&&(_b.hPos=Db.cur,m?Ab[0].style[m]=n+(rb.horizontal?"translateX":"translateY")+"("+Db.cur+"px)":Ab[0].style[rb.horizontal?"left":"top"]=Db.cur+"px"))}function O(){Fb[0]&&_b.page!==Jb.activePage&&(_b.page=Jb.activePage,Fb.removeClass(rb.activeClass).eq(Jb.activePage).addClass(rb.activeClass),ob("activePage",_b.page))}function P(){bc.speed&&yb.cur!==(bc.speed>0?yb.end:yb.start)||sb.stop(),hc=cc.init?t(P):0,bc.now=+new Date,bc.pos=yb.cur+(bc.now-bc.lastTime)/1e3*bc.speed,L(cc.init?bc.pos:G(bc.pos)),cc.init||yb.cur!==yb.dest||ob("moveEnd"),bc.lastTime=bc.now}function Q(a,b,d){if("boolean"===e(b)&&(d=b,b=c),b===c)L(yb[a],d);else{if(Qb&&"center"!==a)return;var f=sb.getPos(b);f&&L(f[a],d,!Qb)}}function R(a){return null!=a?i(a)?a>=0&&a<Ib.length?a:-1:Hb.index(a):-1}function S(a){return R(i(a)&&0>a?a+Ib.length:a)}function T(a,b){var c=R(a);return!Rb||0>c?!1:((_b.active!==c||b)&&(Hb.eq(Jb.activeItem).removeClass(rb.activeClass),Hb.eq(c).addClass(rb.activeClass),_b.active=Jb.activeItem=c,W(),ob("active",c)),c)}function U(a){a=k(i(a)?a:yb.dest,yb.start,yb.end);var b={},c=Pb?0:wb/2;if(!tb)for(var d=0,e=Gb.length;e>d;d++){if(a>=yb.end||d===Gb.length-1){b.activePage=Gb.length-1;break}if(a<=Gb[d]+c){b.activePage=d;break}}if(Rb){for(var f=!1,g=!1,h=!1,j=0,l=Ib.length;l>j;j++)if(f===!1&&a<=Ib[j].start+Ib[j].half&&(f=j),h===!1&&a<=Ib[j].center+Ib[j].half&&(h=j),j===l-1||a<=Ib[j].end+Ib[j].half){g=j;break}b.firstItem=i(f)?f:0,b.centerItem=i(h)?h:b.firstItem,b.lastItem=i(g)?g:b.centerItem}return b}function V(b){a.extend(Jb,U(b))}function W(){var a=yb.dest<=yb.start,b=yb.dest>=yb.end,c=(a?1:0)|(b?2:0);if(_b.slideePosState!==c&&(_b.slideePosState=c,Yb.is("button,input")&&Yb.prop("disabled",a),Zb.is("button,input")&&Zb.prop("disabled",b),Yb.add(Vb)[a?"addClass":"removeClass"](rb.disabledClass),Zb.add(Ub)[b?"addClass":"removeClass"](rb.disabledClass)),_b.fwdbwdState!==c&&cc.released&&(_b.fwdbwdState=c,Vb.is("button,input")&&Vb.prop("disabled",a),Ub.is("button,input")&&Ub.prop("disabled",b)),Rb&&null!=Jb.activeItem){var d=0===Jb.activeItem,e=Jb.activeItem>=Ib.length-1,f=(d?1:0)|(e?2:0);_b.itemsButtonState!==f&&(_b.itemsButtonState=f,Wb.is("button,input")&&Wb.prop("disabled",d),Xb.is("button,input")&&Xb.prop("disabled",e),Wb[d?"addClass":"removeClass"](rb.disabledClass),Xb[e?"addClass":"removeClass"](rb.disabledClass))}}function X(a,b,c){if(a=S(a),b=S(b),a>-1&&b>-1&&a!==b&&(!c||b!==a-1)&&(c||b!==a+1)){Hb.eq(a)[c?"insertAfter":"insertBefore"](Ib[b].el);var d=b>a?a:c?b:b-1,e=a>b?a:c?b+1:b,f=a>b;null!=Jb.activeItem&&(a===Jb.activeItem?_b.active=Jb.activeItem=c?f?b+1:b:f?b:b-1:Jb.activeItem>d&&Jb.activeItem<e&&(_b.active=Jb.activeItem+=f?1:-1)),K()}}function Y(a,b){for(var c=0,d=$b[a].length;d>c;c++)if($b[a][c]===b)return c;return-1}function Z(){cc.released&&!sb.isPaused&&sb.resume()}function $(a){return G(k(a,Db.start,Db.end)/Db.end*(yb.end-yb.start))+yb.start}function _(){cc.history[0]=cc.history[1],cc.history[1]=cc.history[2],cc.history[2]=cc.history[3],cc.history[3]=cc.delta}function ab(a){cc.released=0,cc.source=a,cc.slidee="slidee"===a}function bb(b){var c="touchstart"===b.type,d=b.data.source,e="slidee"===d;cc.init||!c&&eb(b.target)||("handle"!==d||rb.dragHandle&&Db.start!==Db.end)&&(!e||(c?rb.touchDragging:rb.mouseDragging&&b.which<2))&&(c||f(b),ab(d),cc.init=0,cc.$source=a(b.target),cc.touch=c,cc.pointer=c?b.originalEvent.touches[0]:b,cc.initX=cc.pointer.pageX,cc.initY=cc.pointer.pageY,cc.initPos=e?yb.cur:Db.cur,cc.start=+new Date,cc.time=0,cc.path=0,cc.delta=0,cc.locked=0,cc.history=[0,0,0,0],cc.pathToLock=e?c?30:10:0,u.on(c?x:w,cb),sb.pause(1),(e?vb:Ab).addClass(rb.draggedClass),ob("moveStart"),e&&(fc=setInterval(_,10)))}function cb(a){if(cc.released="mouseup"===a.type||"touchend"===a.type,cc.pointer=cc.touch?a.originalEvent[cc.released?"changedTouches":"touches"][0]:a,cc.pathX=cc.pointer.pageX-cc.initX,cc.pathY=cc.pointer.pageY-cc.initY,cc.path=E(F(cc.pathX,2)+F(cc.pathY,2)),cc.delta=rb.horizontal?cc.pathX:cc.pathY,cc.released||!(cc.path<1)){if(!cc.init){if(cc.path<rb.dragThreshold)return cc.released?db():c;if(!(rb.horizontal?D(cc.pathX)>D(cc.pathY):D(cc.pathX)<D(cc.pathY)))return db();cc.init=1}f(a),!cc.locked&&cc.path>cc.pathToLock&&cc.slidee&&(cc.locked=1,cc.$source.on(z,g)),cc.released&&(db(),rb.releaseSwing&&cc.slidee&&(cc.swing=(cc.delta-cc.history[0])/40*300,cc.delta+=cc.swing,cc.tweese=D(cc.swing)>10)),L(cc.slidee?G(cc.initPos-cc.delta):$(cc.initPos+cc.delta))}}function db(){clearInterval(fc),cc.released=!0,u.off(cc.touch?x:w,cb),(cc.slidee?vb:Ab).removeClass(rb.draggedClass),setTimeout(function(){cc.$source.off(z,g)}),yb.cur===yb.dest&&cc.init&&ob("moveEnd"),sb.resume(1),cc.init=0}function eb(b){return~a.inArray(b.nodeName,B)||a(b).is(rb.interactive)}function fb(){sb.stop(),u.off("mouseup",fb)}function gb(a){switch(f(a),this){case Ub[0]:case Vb[0]:sb.moveBy(Ub.is(this)?rb.moveBy:-rb.moveBy),u.on("mouseup",fb);break;case Wb[0]:sb.prev();break;case Xb[0]:sb.next();break;case Yb[0]:sb.prevPage();break;case Zb[0]:sb.nextPage()}}function hb(a){return dc.curDelta=(rb.horizontal?a.deltaY||a.deltaX:a.deltaY)||-a.wheelDelta,dc.curDelta/=1===a.deltaMode?3:100,Rb?(o=+new Date,dc.last<o-dc.resetTime&&(dc.delta=0),dc.last=o,dc.delta+=dc.curDelta,D(dc.delta)<1?dc.finalDelta=0:(dc.finalDelta=G(dc.delta/1),dc.delta%=1),dc.finalDelta):dc.curDelta}function ib(a){a.originalEvent[r]=sb;var b=+new Date;if(J+rb.scrollHijack>b&&Sb[0]!==document&&Sb[0]!==window)return void(J=b);if(rb.scrollBy&&yb.start!==yb.end){var c=hb(a.originalEvent);(rb.scrollTrap||c>0&&yb.dest<yb.end||0>c&&yb.dest>yb.start)&&f(a,1),sb.slideBy(rb.scrollBy*c)}}function jb(a){rb.clickBar&&a.target===zb[0]&&(f(a),L($((rb.horizontal?a.pageX-zb.offset().left:a.pageY-zb.offset().top)-Cb/2)))}function kb(a){if(rb.keyboardNavBy)switch(a.which){case rb.horizontal?37:38:f(a),sb["pages"===rb.keyboardNavBy?"prevPage":"prev"]();break;case rb.horizontal?39:40:f(a),sb["pages"===rb.keyboardNavBy?"nextPage":"next"]()}}function lb(a){return eb(this)?void(a.originalEvent[r+"ignore"]=!0):void(this.parentNode!==vb[0]||a.originalEvent[r+"ignore"]||sb.activate(this))}function mb(){this.parentNode===Eb[0]&&sb.activatePage(Fb.index(this))}function nb(a){rb.pauseOnHover&&sb["mouseenter"===a.type?"pause":"resume"](2)}function ob(a,b){if($b[a]){for(qb=$b[a].length,C.length=0,pb=0;qb>pb;pb++)C.push($b[a][pb]);for(pb=0;qb>pb;pb++)C[pb].call(sb,a,b)}}if(!(this instanceof d))return new d(b,p,q);var pb,qb,rb=a.extend({},d.defaults,p),sb=this,tb=i(b),ub=a(b),vb=rb.slidee?a(rb.slidee).eq(0):ub.children().eq(0),wb=0,xb=0,yb={start:0,center:0,end:0,cur:0,dest:0},zb=a(rb.scrollBar).eq(0),Ab=zb.children().eq(0),Bb=0,Cb=0,Db={start:0,end:0,cur:0},Eb=a(rb.pagesBar),Fb=0,Gb=[],Hb=0,Ib=[],Jb={firstItem:0,lastItem:0,centerItem:0,activeItem:null,activePage:0},Kb=new l(ub[0]),Lb=new l(vb[0]),Mb=new l(zb[0]),Nb=new l(Ab[0]),Ob="basic"===rb.itemNav,Pb="forceCentered"===rb.itemNav,Qb="centered"===rb.itemNav||Pb,Rb=!tb&&(Ob||Qb||Pb),Sb=rb.scrollSource?a(rb.scrollSource):ub,Tb=rb.dragSource?a(rb.dragSource):ub,Ub=a(rb.forward),Vb=a(rb.backward),Wb=a(rb.prev),Xb=a(rb.next),Yb=a(rb.prevPage),Zb=a(rb.nextPage),$b={},_b={},ac={},bc={},cc={released:1},dc={last:0,delta:0,resetTime:200},ec=0,fc=0,gc=0,hc=0;tb||(b=ub[0]),sb.initialized=0,sb.frame=b,sb.slidee=vb[0],sb.pos=yb,sb.rel=Jb,sb.items=Ib,sb.pages=Gb,sb.isPaused=0,sb.options=rb,sb.dragging=cc,sb.reload=function(){K()},sb.getPos=function(a){if(Rb){var b=R(a);return-1!==b?Ib[b]:!1}var c=vb.find(a).eq(0);if(c[0]){var d=rb.horizontal?c.offset().left-vb.offset().left:c.offset().top-vb.offset().top,e=c[rb.horizontal?"outerWidth":"outerHeight"]();return{start:d,center:d-wb/2+e/2,end:d-wb+e,size:e}}return!1},sb.moveBy=function(a){bc.speed=a,!cc.init&&bc.speed&&yb.cur!==(bc.speed>0?yb.end:yb.start)&&(bc.lastTime=+new Date,bc.startPos=yb.cur,ab("button"),cc.init=1,ob("moveStart"),s(hc),P())},sb.stop=function(){"button"===cc.source&&(cc.init=0,cc.released=1)},sb.prev=function(){sb.activate(null==Jb.activeItem?0:Jb.activeItem-1)},sb.next=function(){sb.activate(null==Jb.activeItem?0:Jb.activeItem+1)},sb.prevPage=function(){sb.activatePage(Jb.activePage-1)},sb.nextPage=function(){sb.activatePage(Jb.activePage+1)},sb.slideBy=function(a,b){a&&(Rb?sb[Qb?"toCenter":"toStart"](k((Qb?Jb.centerItem:Jb.firstItem)+rb.scrollBy*a,0,Ib.length)):L(yb.dest+a,b))},sb.slideTo=function(a,b){L(a,b)},sb.toStart=function(a,b){Q("start",a,b)},sb.toEnd=function(a,b){Q("end",a,b)},sb.toCenter=function(a,b){Q("center",a,b)},sb.getIndex=R,sb.activate=function(a,b){var c=T(a);rb.smart&&c!==!1&&(Qb?sb.toCenter(c,b):c>=Jb.lastItem?sb.toStart(c,b):c<=Jb.firstItem?sb.toEnd(c,b):Z())},sb.activatePage=function(a,b){i(a)&&L(Gb[k(a,0,Gb.length-1)],b)},sb.resume=function(a){rb.cycleBy&&rb.cycleInterval&&("items"!==rb.cycleBy||Ib[0]&&null!=Jb.activeItem)&&!(a<sb.isPaused)&&(sb.isPaused=0,gc?gc=clearTimeout(gc):ob("resume"),gc=setTimeout(function(){switch(ob("cycle"),rb.cycleBy){case"items":sb.activate(Jb.activeItem>=Ib.length-1?0:Jb.activeItem+1);break;case"pages":sb.activatePage(Jb.activePage>=Gb.length-1?0:Jb.activePage+1)}},rb.cycleInterval))},sb.pause=function(a){a<sb.isPaused||(sb.isPaused=a||100,gc&&(gc=clearTimeout(gc),ob("pause")))},sb.toggle=function(){sb[gc?"pause":"resume"]()},sb.set=function(b,c){a.isPlainObject(b)?a.extend(rb,b):rb.hasOwnProperty(b)&&(rb[b]=c)},sb.add=function(b,c){var d=a(b);Rb?(null==c||!Ib[0]||c>=Ib.length?d.appendTo(vb):Ib.length&&d.insertBefore(Ib[c].el),null!=Jb.activeItem&&c<=Jb.activeItem&&(_b.active=Jb.activeItem+=d.length)):vb.append(d),K()},sb.remove=function(b){if(Rb){var c=S(b);if(c>-1){Hb.eq(c).remove();var d=c===Jb.activeItem;null!=Jb.activeItem&&c<Jb.activeItem&&(_b.active=--Jb.activeItem),K(),d&&(_b.active=null,sb.activate(Jb.activeItem))}}else a(b).remove(),K()},sb.moveAfter=function(a,b){X(a,b,1)},sb.moveBefore=function(a,b){X(a,b)},sb.on=function(a,b){if("object"===e(a))for(var c in a)a.hasOwnProperty(c)&&sb.on(c,a[c]);else if("function"===e(b))for(var d=a.split(" "),f=0,g=d.length;g>f;f++)$b[d[f]]=$b[d[f]]||[],-1===Y(d[f],b)&&$b[d[f]].push(b);else if("array"===e(b))for(var h=0,i=b.length;i>h;h++)sb.on(a,b[h])},sb.one=function(a,b){function c(){b.apply(sb,arguments),sb.off(a,c)}sb.on(a,c)},sb.off=function(a,b){if(b instanceof Array)for(var c=0,d=b.length;d>c;c++)sb.off(a,b[c]);else for(var e=a.split(" "),f=0,g=e.length;g>f;f++)if($b[e[f]]=$b[e[f]]||[],null==b)$b[e[f]].length=0;else{var h=Y(e[f],b);-1!==h&&$b[e[f]].splice(h,1)}},sb.destroy=function(){return d.removeInstance(b),Sb.add(Ab).add(zb).add(Eb).add(Ub).add(Vb).add(Wb).add(Xb).add(Yb).add(Zb).off("."+r),u.off("keydown",kb),Wb.add(Xb).add(Yb).add(Zb).removeClass(rb.disabledClass),Hb&&null!=Jb.activeItem&&Hb.eq(Jb.activeItem).removeClass(rb.activeClass),Eb.empty(),tb||(ub.off("."+r),Kb.restore(),Lb.restore(),Mb.restore(),Nb.restore(),a.removeData(b,r)),Ib.length=Gb.length=0,_b={},sb.initialized=0,sb},sb.init=function(){if(!sb.initialized){if(d.getInstance(b))throw new Error("There is already a Sly instance on this element");d.storeInstance(b,sb),sb.on(q);var a=["overflow","position"],c=["position","webkitTransform","msTransform","transform","left","top","width","height"];Kb.save.apply(Kb,a),Mb.save.apply(Mb,a),Lb.save.apply(Lb,c),Nb.save.apply(Nb,c);var e=Ab;return tb||(e=e.add(vb),ub.css("overflow","hidden"),m||"static"!==ub.css("position")||ub.css("position","relative")),m?n&&e.css(m,n):("static"===zb.css("position")&&zb.css("position","relative"),e.css({position:"absolute"})),rb.forward&&Ub.on(A,gb),rb.backward&&Vb.on(A,gb),rb.prev&&Wb.on(z,gb),rb.next&&Xb.on(z,gb),rb.prevPage&&Yb.on(z,gb),rb.nextPage&&Zb.on(z,gb),Sb.on(y,ib),zb[0]&&zb.on(z,jb),Rb&&rb.activateOn&&ub.on(rb.activateOn+"."+r,"*",lb),Eb[0]&&rb.activatePageOn&&Eb.on(rb.activatePageOn+"."+r,"*",mb),Tb.on(v,{source:"slidee"},bb),Ab&&Ab.on(v,{source:"handle"},bb),u.on("keydown",kb),tb||(ub.on("mouseenter."+r+" mouseleave."+r,nb),ub.on("scroll."+r,h)),sb.initialized=1,K(!0),rb.cycleBy&&!tb&&sb[rb.startPaused?"pause":"resume"](),sb}}}function e(a){return null==a?String(a):"object"==typeof a||"function"==typeof a?Object.prototype.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase()||"object":typeof a}function f(a,b){a.preventDefault(),b&&a.stopPropagation()}function g(b){f(b,1),a(this).off(b.type,g)}function h(){this.scrollLeft=0,this.scrollTop=0}function i(a){return!isNaN(parseFloat(a))&&isFinite(a)}function j(a,b){return 0|G(String(a.css(b)).replace(/[^\-0-9.]/g,""))}function k(a,b,c){return b>a?b:a>c?c:a}function l(a){var b={};return b.style={},b.save=function(){if(a&&a.nodeType){for(var c=0;c<arguments.length;c++)b.style[arguments[c]]=a.style[arguments[c]];return b}},b.restore=function(){if(a&&a.nodeType){for(var c in b.style)b.style.hasOwnProperty(c)&&(a.style[c]=b.style[c]);return b}},b}var m,n,o,p="sly",q="Sly",r=p,s=b.cancelAnimationFrame||b.cancelRequestAnimationFrame,t=b.requestAnimationFrame,u=a(document),v="touchstart."+r+" mousedown."+r,w="mousemove."+r+" mouseup."+r,x="touchmove."+r+" touchend."+r,y=(document.implementation.hasFeature("Event.wheel","3.0")?"wheel.":"mousewheel.")+r,z="click."+r,A="mousedown."+r,B=["INPUT","SELECT","BUTTON","TEXTAREA"],C=[],D=Math.abs,E=Math.sqrt,F=Math.pow,G=Math.round,H=Math.max,I=Math.min,J=0;u.on(y,function(a){var b=a.originalEvent[r],c=+new Date;(!b||b.options.scrollHijack<c-J)&&(J=c)}),d.getInstance=function(b){return a.data(b,r)},d.storeInstance=function(b,c){return a.data(b,r,c)},d.removeInstance=function(b){return a.removeData(b,r)},function(a){function b(a){var b=(new Date).getTime(),d=Math.max(0,16-(b-c)),e=setTimeout(a,d);return c=b,e}t=a.requestAnimationFrame||a.webkitRequestAnimationFrame||b;var c=(new Date).getTime(),d=a.cancelAnimationFrame||a.webkitCancelAnimationFrame||a.clearTimeout;s=function(b){d.call(a,b)}}(window),function(){function a(a){for(var d=0,e=b.length;e>d;d++){var f=b[d]?b[d]+a.charAt(0).toUpperCase()+a.slice(1):a;if(null!=c.style[f])return f}}var b=["","Webkit","Moz","ms","O"],c=document.createElement("div");m=a("transform"),n=a("perspective")?"translateZ(0) ":""}(),b[q]=d,a.fn[p]=function(b,c){var f,g;return a.isPlainObject(b)||(("string"===e(b)||b===!1)&&(f=b===!1?"destroy":b,g=Array.prototype.slice.call(arguments,1)),b={}),this.each(function(a,e){var h=d.getInstance(e);h||f?h&&f&&h[f]&&h[f].apply(h,g):h=new d(e,b,c).init()})},d.defaults={slidee:null,horizontal:!1,itemNav:null,itemSelector:null,smart:!1,activateOn:null,activateMiddle:!1,scrollSource:null,scrollBy:0,scrollHijack:300,scrollTrap:!1,dragSource:null,mouseDragging:!1,touchDragging:!1,releaseSwing:!1,swingSpeed:.2,elasticBounds:!1,dragThreshold:3,interactive:null,scrollBar:null,dragHandle:!1,dynamicHandle:!1,minHandleSize:50,clickBar:!1,syncSpeed:.5,pagesBar:null,activatePageOn:null,pageBuilder:function(a){return"<li>"+(a+1)+"</li>"},forward:null,backward:null,prev:null,next:null,prevPage:null,nextPage:null,cycleBy:null,cycleInterval:5e3,pauseOnHover:!1,startPaused:!1,moveBy:300,speed:0,easing:"swing",startAt:null,keyboardNavBy:null,draggedClass:"dragged",activeClass:"active",disabledClass:"disabled"}}(jQuery,window);