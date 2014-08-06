window.undefined = window.undefined;
	zgw = {	
			version : '1.0.0',
			versionDetail : {major : 1,minor : 0,patch : 0}
		};

	zgw.isTrue = function(obj){
		if(obj == 1) {return true}
		else if(obj == undefined){return false}
		else if(obj == 'true'){return true}
		else if(obj == 'false'){return false}
		else if(obj == Object){return true}
		else {return obj && true}
	}

	zgw.alias = function(obj,name,alias){
		obj.prototype[alias] = obj.prototype[name];
	}
	
	zgw.getCurrentTime = function() {
	    var d = new Date();
	    return d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate() + ' ' 
	            + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
	}

	//copy properties from c to o
	zgw.apply = function(o, c, defaults){
				if(defaults){
					zgw.apply(o, defaults);
				}
				if(o && c && typeof c == 'object'){
					for(var p in c){
						o[p] = c[p];
					}
				}
				return o;
	};
    
(function(){
        var idSeed = 0,
		toString = Object.prototype.toString,
        ua = navigator.userAgent.toLowerCase(),
        check = function(r){
            return r.test(ua);
        },
		
        DOC = document,
        docMode = DOC.documentMode,
        isStrict = DOC.compatMode == "CSS1Compat",
        isOpera = check(/opera/),
        isChrome = check(/\bchrome\b/),
        isWebKit = check(/webkit/),
        isSafari = !isChrome && check(/safari/),
        isSafari2 = isSafari && check(/applewebkit\/4/), // unique to Safari 2
        isSafari3 = isSafari && check(/version\/3/),
        isSafari4 = isSafari && check(/version\/4/),
        isIE = !isOpera && check(/msie/),
        isIE7 = isIE && (check(/msie 7/) || docMode == 7),
        isIE8 = isIE && (check(/msie 8/) && docMode != 7),
        isIE6 = isIE && !isIE7 && !isIE8,
        isGecko = !isWebKit && check(/gecko/),
        isGecko2 = isGecko && check(/rv:1\.8/),
        isGecko3 = isGecko && check(/rv:1\.9/),
        isBorderBox = isIE && !isStrict,
        isWindows = check(/windows|win32/),
        isMac = check(/macintosh|mac os x/),
        isAir = check(/adobeair/),
        isLinux = check(/linux/),
        isSecure = /^https/i.test(window.location.protocol);
		
		if(isIE6){
       		try{
            	DOC.execCommand("BackgroundImageCache", false, true);
        	}catch(e){}
    	}
        
	
		zgw.apply(zgw,{
				SSL_SECURE_URL : isSecure && isIE ? 'javascript:""' : 'about:blank',
				isStrict : isStrict,
				isSecure : isSecure,
				isReady : false,
				
				isOpera : isOpera,
				isWebKit : isWebKit,
				isChrome : isChrome,
				isSafari : isSafari,
				isSafari3 : isSafari3,
				isSafari4 : isSafari4,
				isSafari2 : isSafari2,
				isIE : isIE,
				isIE6 : isIE6,
				isIE7 : isIE7,
				isIE8 : isIE8,
				isGecko : isGecko,
				isGecko2 : isGecko2,
				isGecko3 : isGecko3,
				isBorderBox : isBorderBox,
				isLinux : isLinux,
				isWindows : isWindows,
				isMac : isMac,
				isAir : isAir,
				debugMode: false,
				//isFirefox: zgw.isTrue($.browser.mozilla) ,
				isArray : function(v){
					return v && toString.apply(v) === '[object Array]';
				},
				
				//add a new properties or wverwrite existing properties
				//changes made will affact all instance of original object
				override : function(origclass, overrides){
            			if(overrides){
                			var p = origclass.prototype;
                			zgw.apply(p, overrides);
                			if(zgw.isIE && overrides.hasOwnProperty('toString')){
                    			p.toString = overrides.toString;
                			}
            			}
        		},
				
				//extend a object , generate a subclass for a object
				//with new properties and overwrite existing property
				extend:function(){
            		// inline overrides
            		var io = function(o){
                		for(var m in o){
                    		this[m] = o[m];
                		}
            		};
            		var oc = Object.prototype.constructor;

					//create the actual function - extend
            		return function(sb, sp, overrides){
                		if(typeof sp == 'object'){
                    		overrides = sp;
                    		sp = sb;
                    		sb = overrides.constructor != oc ? overrides.constructor : function(){sp.apply(this, arguments);};
                		}
                		var F = function(){},
                    	sbp,
                    	spp = sp.prototype;

                		F.prototype = spp;
                		sbp = sb.prototype = new F();
                		sbp.constructor=sb;
                		sb.superclass=spp;
                		if(spp.constructor == oc){
                    		spp.constructor=sp;
                		}
                		sb.override = function(o){
                    		zgw.override(sb, o);
                		};
                		sbp.superclass = sbp.supr = (function(){
                    		return spp;
                		});
                		sbp.override = io;
                		zgw.override(sb, overrides);
                		sb.extend = function(o){return zgw.extend(sb, o);};
                		return sb;
            		};
        		}(),
				
                id : function(prefix){
					var temp = prefix || 'zgwEl'
                    return temp + '_' + (++idSeed)
                },

				isArray : function(v){
            		return toString.apply(v) === '[object Array]';
        		},
		
				isEmpty : function(v, allowBlank){
            		return v === null 
            				|| v === undefined 
            				|| ((zgw.isArray(v) && !v.length)) 
            				|| ((zgw.isObject(v) && !(Object.keys(v).length))) 
            				|| (!allowBlank ? v === '' : false);
        		},
		
		        isDate : function(v){
            		return toString.apply(v) === '[object Date]';
        		},
				
				isObject : function(v){
            		return !!v && Object.prototype.toString.call(v) === '[object Object]';
        		},
				
				isPrimitive : function(v){
            		return zgw.isString(v) || zgw.isNumber(v) || zgw.isBoolean(v);
        		},
		
		        isFunction : function(v){
            		return toString.apply(v) === '[object Function]';
        		},
		
		        isNumber : function(v){
            		return typeof v === 'number' && isFinite(v);
        		},
				
				isString : function(v){
            		return typeof v === 'string';
        		},
		
				
				isArrayText:function(v){
					if(zgw.isString(v)){
					
					}
					return false;
				},
				
				isJSONText:function(v){
					//https://github.com/douglascrockford/JSON-js/blob/master/json2.js
					return zgw.isString(v) && /^[\],:{}\s]*$/.test(
						v.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@')
                        .replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']')
                        .replace(/(?:^|:|,)(?:\s*\[)+/g, ''));
				},
				
				isXMLText:function(v){
					if(zgw.isString(v)){
						
					}
					return false;
				},
				
		        isBoolean : function(v){
            		return typeof v === 'boolean';
        		},
				
				isElement : function(v) {
            		return v ? !!v.tagName : false;
        		},
				
				isDefined : function(v){
            		return typeof v !== 'undefined';
        		},
		
        	    //declare global namespace base on the namespace name
	            //the input could be a namespace or a list of namespaces with delimiter ','
	            declare :function(){
                    var o, d;
                    zgw.each(arguments, function(v) {
        	            d = v.split(".");
                        o = window[d[0]] = window[d[0]] || {};
                        zgw.each(d.slice(1), function(v2){
                            o = o[v2] = o[v2] || {};
                        });
                    });
                    return o;
	            },

				applyIf : function(o, c){
            		if(o){
                		for(var p in c){
                    	if(!zgw.isDefined(o[p])){
                        	o[p] = c[p];
                    		}
                		}
            		}	
            		return o;
        		},
		
         		toArray : function(){
             		return isIE ?
                 	function(a, i, j, res){
                     	res = [];
                     	for(var x = 0, len = a.length; x < len; x++) {
                         	res.push(a[x]);
                     	}
                     	return res.slice(i || 0, j || res.length);
                 	} :
                 	function(a, i, j){
                     	return Array.prototype.slice.call(a, i || 0, j || a.length);
                 	};
         		}(),
		 
		 		isIterable : function(v){
            		//check for array or arguments
            		if(zgw.isArray(v) || v.callee){
                		return true;
            		}
            		//check for node list type
            		if(/NodeList|HTMLCollection/.test(toString.call(v))){
                		return true;
            		}
            		//NodeList has an item and length property
            		//IXMLDOMNodeList has nextNode method, needs to be checked first.
            		return ((typeof v.nextNode != 'undefined' || v.item) && zgw.isNumber(v.length));
        		},
		
				supportCookies : function(){
					var cookieEnabled=(navigator.cookieEnabled)? true : false
					//if not IE4+ nor NS6+
					if (typeof navigator.cookieEnabled=="undefined" && !cookieEnabled){ 
						document.cookie="testcookie"
						cookieEnabled=(document.cookie.indexOf("testcookie")!=-1)? true : false
					}
					return cookieEnabled;
				},
				
				supportLocalStorage : function(){
					try {
    					return window['localStorage'] != undefined;
  					} catch(e){
    					return false;
  					}
				},
				
				
        		each : function(array, fn, scope){
            		if(zgw.isEmpty(array, true)){
                		return;
            		}
            		if(!zgw.isIterable(array) || zgw.isPrimitive(array)){
                		array = [array];
            		}
            		for(var i = 0, len = array.length; i < len; i++){
            			var result = fn.call(scope || array[i], array[i], i, array);
                		if(result === false){
                    		return i;
                		};
            		}
        		},
		
				urlEncode : function(o, pre){
            		var empty,
                		buf = [],
                		e = encodeURIComponent;

            		zgw.iterate(o, function(key, item){
                			empty = zgw.isEmpty(item);
                			zgw.each(empty ? key : item, function(val){
                    			buf.push('&', e(key), '=', (!zgw.isEmpty(val) && (val != key || !empty)) ? (zgw.isDate(val) ? zgw.encode(val).replace(/"/g, '') : e(val)) : '');
                			});
            		});
            		if(!pre){
                		buf.shift();
                		pre = '';
            		}
            		return pre + buf.join('');
        		},
				
				urlDecode : function(string, overwrite){
            		if(zgw.isEmpty(string)){
                		return {};
            		}
            		var obj = {},
                			pairs = string.split('&'),
                			d = decodeURIComponent,
                			name,
                		value;
            		zgw.each(pairs, function(pair) {
                		pair = pair.split('=');
                		name = d(pair[0]);
                		value = d(pair[1]);
                		obj[name] = overwrite || !obj[name] ? value :
                            [].concat(obj[name]).concat(value);
            		});
            		return obj;
        		},
				
				trim: function(str){
					if(!str){
						return '';
					}
					return String.prototype.trim ? 
							str.trim():
							str.replace(/^\s+|\s+$/g, '');
				},
				
				urlAppend : function(url, s){
            		if(!zgw.isEmpty(s)){
                		return url + (url.indexOf('?') === -1 ? '?' : '&') + s;
            		}
            		return url;
        		},
				
				escapeRe : function (s) {
    				return s.replace(/([-.*+?^${}()|[\]\/\\])/g, "\\$1");
				},

                wait: function(millis){
                    var date = new Date();
                    var curDate = null;
                    do { 
                        curDate = new Date(); 
                    } 
                    while(curDate-date < millis);
                },
				
				format:function(){
					var exp = /\{(\d+)\}/igm;
					var subs = arguments;
					var input = arguments[0];
					return input.replace(exp,function(match){
						var temp = parseInt(match.replace('{','').replace('}',''));
						return subs[temp+1];
					})
				},

                getPairKey: function(key1, key2) {
                    var temp = [];
                    temp.push(key1);
                    temp.push(key2);
                    temp.sort();
                    return temp[0] + '_' + temp[1];
                },

				debug: function(){
					if(zgw.debugMode){
						zgw.each(arguments,function(arg){
							if(zgw.isIE)
							{
								alert(arg);
							}
							else if(zgw.isWebKit || zgw.isGecko)
							{
								console.log(arg);
							}
						});
					}
				}
                //format
                //            function parseDate(input) {
//                var re = new RegExp('\\/Date\\(([-+])?(\\d+)(?:[+-]\\d{4})?\\)\\/');
//                var r = (input || '').match(re);
//                return r ? new Date(((r[1] || '') + r[2]) * 1) : null;
//            }

            //alert(parseDate('/Date(1283222745517)/'));
        });
	})();
	
	//Function Linkage
	zgw.apply(Function.prototype, {
    	 /**
     		* Creates an interceptor function. The passed function is called before the original one. If it returns false,
     		* the original one is not called. The resulting function returns the results of the original function.
     		* The passed function is called with the parameters of the original function. Example usage:
     		* <pre><code>
				var sayHi = function(name){
    				alert('Hi, ' + name);
				}

				sayHi('Fred'); // alerts "Hi, Fred"

			// create a new function that validates input without
			// directly modifying the original function:
			var sayHiToFriend = sayHi.createInterceptor(function(name){
    			return name == 'Brian';
			});

			sayHiToFriend('Fred');  // no alert
			sayHiToFriend('Brian'); // alerts "Hi, Brian"
			</code></pre>
     		* @param {Function} fcn The function to call before the original
     		* @param {Object} scope (optional) The scope (<code><b>this</b></code> reference) in which the passed function is executed.
     		* <b>If omitted, defaults to the scope in which the original function is called or the browser window.</b>
     		* @return {Function} The new function
     	*/
    	createInterceptor : function(fcn, scope){
        	var method = this;
        	return !zgw.isFunction(fcn) ?
                this :
                function() {
                    var me = this,
                        args = arguments;
                    fcn.target = me;
                    fcn.method = method;
                    return (fcn.apply(scope || me || window, args) !== false) ?
                            method.apply(me || window, args) :
                            null;
                };
    	},

     	/**
     	* Creates a callback that passes arguments[0], arguments[1], arguments[2], ...
     	* Call directly on any function. Example: <code>myFunction.createCallback(arg1, arg2)</code>
     	* Will create a function that is bound to those 2 args. <b>If a specific scope is required in the
     	* callback, use {@link #createDelegate} instead.</b> The function returned by createCallback always
     	* executes in the window scope.
     	* <p>This method is required when you want to pass arguments to a callback function.  If no arguments
     	* are needed, you can simply pass a reference to the function as a callback (e.g., callback: myFn).
     	* However, if you tried to pass a function with arguments (e.g., callback: myFn(arg1, arg2)) the function
    	 * would simply execute immediately when the code is parsed. Example usage:
     	* <pre><code>
		var sayHi = function(name){
    		alert('Hi, ' + name);
		}

		// clicking the button alerts "Hi, Fred"
		new Ext.Button({
    		text: 'Say Hi',
   	 		renderTo: Ext.getBody(),
    		handler: sayHi.createCallback('Fred')
		});
		</code></pre>
     	* @return {Function} The new function
    	*/
    	createCallback : function(/*args...*/){
        	// make args available, in function below
        	var args = arguments,
            	method = this;
        	return function() {
            	return method.apply(window, args);
        	};
    	},

    	/**
    	 * Creates a delegate (callback) that sets the scope to obj.
     	* Call directly on any function. Example: <code>this.myFunction.createDelegate(this, [arg1, arg2])</code>
     	* Will create a function that is automatically scoped to obj so that the <tt>this</tt> variable inside the
     	* callback points to obj. Example usage:
     	* <pre><code>
			var sayHi = function(name){
    		// Note this use of "this.text" here.  This function expects to
    		// execute within a scope that contains a text property.  In this
    		// example, the "this" variable is pointing to the btn object that
    		// was passed in createDelegate below.
    		alert('Hi, ' + name + '. You clicked the "' + this.text + '" button.');
			}

			var btn = new Ext.Button({
    			text: 'Say Hi',
    			renderTo: Ext.getBody()
			});

			// This callback will execute in the scope of the
			// button instance. Clicking the button alerts
			// "Hi, Fred. You clicked the "Say Hi" button."
			btn.on('click', sayHi.createDelegate(btn, ['Fred']));
			</code></pre>
     		* @param {Object} scope (optional) The scope (<code><b>this</b></code> reference) in which the function is executed.
     		* <b>If omitted, defaults to the browser window.</b>
     		* @param {Array} args (optional) Overrides arguments for the call. (Defaults to the arguments passed by the caller)
     		* @param {Boolean/Number} appendArgs (optional) if True args are appended to call args instead of overriding,
     		* if a number the args are inserted at the specified position
     		* @return {Function} The new function
     	*/
    	createDelegate : function(obj, args, appendArgs){
        	var method = this;
        	return function() {
            	var callArgs = args || arguments;
            	if (appendArgs === true){
                	callArgs = Array.prototype.slice.call(arguments, 0);
                	callArgs = callArgs.concat(args);
            	}else if (zgw.isNumber(appendArgs)){
                	callArgs = Array.prototype.slice.call(arguments, 0); // copy arguments first
                	var applyArgs = [appendArgs, 0].concat(args); // create method call params
                	Array.prototype.splice.apply(callArgs, applyArgs); // splice them in
            	}
            	return method.apply(obj || window, callArgs);
        	};
    	},

 

    	/**
     	* Calls this function after the number of millseconds specified, optionally in a specific scope. Example usage:
     	* <pre><code>
			var sayHi = function(name){
    		alert('Hi, ' + name);
			}

			// executes immediately:
			sayHi('Fred');

			// executes after 2 seconds:
			sayHi.defer(2000, this, ['Fred']);

			// this syntax is sometimes useful for deferring
			// execution of an anonymous function:
			(function(){
    			alert('Anonymous');
			}).defer(100);
		</code></pre>
     	* @param {Number} millis The number of milliseconds for the setTimeout call (if less than or equal to 0 the function is executed immediately)
     	* @param {Object} scope (optional) The scope (<code><b>this</b></code> reference) in which the function is executed.
     	* <b>If omitted, defaults to the browser window.</b>
     	* @param {Array} args (optional) Overrides arguments for the call. (Defaults to the arguments passed by the caller)
     	* @param {Boolean/Number} appendArgs (optional) if True args are appended to call args instead of overriding,
     	* if a number the args are inserted at the specified position
     	* @return {Number} The timeout id that can be used with clearTimeout
     	*/
	
    	defer : function(millis, obj, args, appendArgs){
        	var fn = this.createDelegate(obj, args, appendArgs);
        	if(millis > 0){
            	return setTimeout(fn, millis);
        	}
			
        	fn();
        	return 0;
    	},
		
    	/**
     	* Create a combined function call sequence of the original function + the passed function.
     	* The resulting function returns the results of the original function.
     	* The passed fcn is called with the parameters of the original function. Example usage:
     	* 

		var sayHi = function(name){
    		alert('Hi, ' + name);
		}

		sayHi('Fred'); // alerts "Hi, Fred"

		var sayGoodbye = Ext.createSequence(sayHi, function(name){
    		alert('Bye, ' + name);
		});

		sayGoodbye('Fred'); // both alerts show

     	* @param {Function} origFn The original function.
     	* @param {Function} newFn The function to sequence
     	* @param {Object} scope (optional) The scope (this reference) in which the passed function is executed.
     	* If omitted, defaults to the scope in which the original function is called or the browser window.
     	* @return {Function} The new function
     	*/
	
		createSequence: function(newFn, scope) {
        	if (!zgw.isFunction(newFn)) {
            	return this;
        	}
        	else {
				var me = this;
            	return function() {
                	var retval = me.apply(this || window, arguments);
                	newFn.apply(scope || this || window, arguments);
                	return retval;
            	};
        	}
    	},
    	
    	createRouting: function(millis, scope, args, appendArgs, stopFn,stopFnScope, stopFnArgs) {
    		if(millis > 0){
    			var fn = this.createDelegate(scope, args, appendArgs);
    			if(stopFn){
    				var stopFnDelegate = stopFn.createDelegate(stopFnScope,stopFnArgs,true);
    			}
    			var routeFn = function(){
    				var timer = setTimeout(function(){
	        				if(stopFnDelegate && stopFnDelegate()){
	        					clearTimeout(timer);
	        					return;
	        				}
	        				fn();
	        				setTimeout(routeFn,millis);
	        		},millis)
    			}
    			return routeFn;
    		}
    		else{
    			return this;
    		}
    		
    	},
    	
    	once : function(millis,scope,args,checkFn,checkFnScope,checkFnArgs){
    		var checkFnDele = checkFn.createDelegate(checkFnScope, checkFnArgs, true);
    		var exeFn = this.createDelegate(scope, args, true);
    		if(millis > 0){
    			if(checkFnDele()){
    				exeFn();
    			}
    			else{
    				var routeFn = function(){
    					var timer = setTimeout(function(){
    						var result = checkFnDele();
	        				if(result){
	        					clearTimeout(timer);
	        					exeFn();
	        				}
	        				else{
	        					setTimeout(routeFn,millis);
	        				}
	        				
	        			},millis)
	        			
    				}
    				routeFn();
    			}
    		}
    		else{
    			exeFn();
    		}
    	}
    	
    	
	});
		
(function(){
	zgw.DelayedTask = function(fn, scope, args){
    	var me = this,
			id,    	
    		call = function(){
    			clearInterval(id);
	        	id = null;
	        	fn.apply(scope, args || []);
	    	};
	    
    	/**
     	* Cancels any pending timeout and queues a new one
     	* @param {Number} delay The milliseconds to delay
     	* @param {Function} newFn (optional) Overrides function passed to constructor
     	* @param {Object} newScope (optional) Overrides scope passed to constructor. Remember that if no scope
     	* is specified, <code>this</code> will refer to the browser window.
     	* @param {Array} newArgs (optional) Overrides args passed to constructor
     	*/
    	this.delay = function(delay, newFn, newScope, newArgs){
        	me.cancel();
        	fn = newFn || fn;
        	scope = newScope || scope;
        	args = newArgs || args;
        	id = setInterval(call, delay);
    	};

    	/**
     	* Cancel the last queued timeout
     	*/
   		this.cancel = function(){
        	if(id){
            	clearInterval(id);
            	id = null;
        	}
    	};
	};


	function createTargeted(h, o, scope){
    	return function(){
        	if(o.target == arguments[0]){
            	h.apply(scope, Array.prototype.slice.call(arguments, 0));
        	}
    	};
	};
	
	function createBuffered(h, o, l, scope){
    	l.task = new zgw.DelayedTask();
    	return function(){
        	l.task.delay(o.buffer, h, scope, Array.prototype.slice.call(arguments, 0));
    	};
	};
	
	function createSingle(h, e, fn, scope){
    	return function(){
        	e.removeListener(fn, scope);
        	return h.apply(scope, arguments);
    	};
	};
	
	function createDelayed(h, o, l, scope){
    	return function(){
        	var task = new zgw.DelayedTask(),
            	args = Array.prototype.slice.call(arguments, 0);
        		if(!l.tasks) {
            		l.tasks = [];
        	}
        	l.tasks.push(task);
        	task.delay(o.delay || 10, function(){
            	l.tasks.remove(task);
            	h.apply(scope, args);
        	}, scope);
    	};
	};
	
	zgw.event = function(obj, name){
    	this.name = name;
    	this.obj = obj;
    	this.listeners = [];
	};
	
	zgw.event.prototype = {
    	addListener : function(fn, scope, options){
        	var me = this,l;
        	scope = scope || me.obj;
        	if(!me.isListening(fn, scope)){
            	l = me.createListener(fn, scope, options);
            	if(me.firing){ // if we are currently firing this event, don't disturb the listener loop
                	me.listeners = me.listeners.slice(0);
            	}
            	me.listeners.push(l);
        	}
    	},

    	createListener: function(fn, scope, o){
        	o = o || {};
        	scope = scope || this.obj;
        	var l = {	
						fn: fn,
            			scope: scope,
            			options: o}, 
				h = fn;
        		if(o.target){
            		h = createTargeted(h, o, scope);
        		}
        		if(o.delay){
            		h = createDelayed(h, o, l, scope);
        		}
        		if(o.single){
            		h = createSingle(h, this, fn, scope);
        		}
        		if(o.buffer){
            		h = createBuffered(h, o, l, scope);
        		}
				
        		l.fireFn = h;
        		return l;
    	},

    	findListener : function(fn, scope){
        	var list = this.listeners,
            	i = list.length,
            	l;
        	scope = scope || this.obj;
       		while(i--){
            	l = list[i];
	
            	if(l){
                	if(l.fn == fn && l.scope == scope){
                    	return i;
                	}
            	}
        	}
        	return -1;
    	},

    	isListening : function(fn, scope){
        	return this.findListener(fn, scope) != -1;
    	},

    	removeListener : function(fn, scope){
        	var index,l,k,
            	me = this,
            	ret = false;

        	if((index = me.findListener(fn, scope)) != -1){
            	if (me.firing) {
                	me.listeners = me.listeners.slice(0);
            	}
            	l = me.listeners[index];
            	if(l.task) {
                	l.task.cancel();
                	delete l.task;
            	}
            	k = l.tasks && l.tasks.length;
            	if(k) {
                	while(k--) {
                    	l.tasks[k].cancel();
                	}
                	delete l.tasks;
            	}
            	me.listeners.splice(index, 1);
            	ret = true;
        	}
        	return ret;
    	},

    	// Iterate to stop any buffered/delayed events
    	clearListeners : function(){
        	var me = this,
            	l = me.listeners,
            	i = l.length;
        	while(i--) {
            	me.removeListener(l[i].fn, l[i].scope);
        	}
    	},

    	fire : function(){
        	var me = this,
            	listeners = me.listeners,
            	len = listeners.length,
            	i = 0,
            	l;

        	if(len > 0){
            	me.firing = true;
            	var args = Array.prototype.slice.call(arguments, 0);
            	for (; i < len; i++) {
                	l = listeners[i];
                	if(l && l.fireFn.apply(l.scope || me.obj || window, args) === false) {
                    	return (me.firing = false);
                	}
            	}
        	}
        	me.firing = false;
        	return true;
    	}
	};
	
	/*zgw._singleInstances = {};
	zgw.newSingleObject = function(name) {
		if(zgw.isEmpty(zgw._singleInstances[name])){
			
		}
		else{
			
		}
	}
	
	
	zgw.makeOnlyOneInstance = function(name){
		if(zgw.isTrue(zgw._singleInstances[name])){
			throw new Error('this single-instance object -'+name+' already has one instance');
		}
		zgw._singleInstances[name] = true;
	}*?
	
	/**
 		* Removes <b>all</b> added captures from 
 		* @param {Observable} o The Observable to release
 		* @static
 	*/
	//zgw.declare('zgw.baseObject');
	zgw.baseObject = function(){
		var me = this,  e = me.events;
    	if(me.listeners){
        	me.on(me.listeners);
        	delete me.listeners;
    	}
    	me.events = e || {};
	}
	
	zgw.baseObject.releaseCapture = function(o){
    	o.fireEvent = zgw.baseObject.fireEvent;
	};
	
	zgw.apply(zgw.baseObject.prototype, {
		filterOptRe : /^(?:scope|delay|buffer|single)$/,
		
		/**
     	* <p>Fires the specified event with the passed parameters (minus the event name).</p>
     	* <p>An event may be set to bubble up an Observable parent hierarchy (See {@link Ext.Component#getBubbleTarget})
     	* by calling {@link #enableBubble}.</p>
     	* @param {String} eventName The name of the event to fire.
     	* @param {Object...} args Variable number of parameters are passed to handlers.
     	* @return {Boolean} returns false if any of the handlers return false otherwise it returns true.
     	*/
		fireEvent : function(){
        	var a = Array.prototype.slice.call(arguments, 0),
            	ename = a[0].toLowerCase(),
            	me = this, ret = true, ce = me.events[ename],
            	cc, q, c;
			
        	if (me.eventsSuspended === true) {
            	if (q = me.eventQueue) {
                	q.push(a);
            	}
        	}
        	else if(typeof ce == 'object') {
            	if (ce.bubble){
                	if(ce.fire.apply(ce, a.slice(1)) === false) {
                    	return false;
                	}
                	c = me.getBubbleTarget && me.getBubbleTarget();
                	if(c && c.enableBubble) {
                    	cc = c.events[ename];
                    	if(!cc || typeof cc != 'object' || !cc.bubble) {
                        	c.enableBubble(ename);
                    	}
                    	return c.fireEvent.apply(c, a);
                	}
            	}
            	else {
                	a.shift();
                	ret = ce.fire.apply(ce, a);
            	}
        	}
        	return ret;
    	},
		
		
    	/**
     	* Appends an event handler to this object.
     	* @param {String}   eventName The name of the event to listen for.
     	* @param {Function} handler The method the event invokes.
     	* @param {Object}   scope (optional) The scope (<code><b>this</b></code> reference) in which the handler function is executed.
     	* <b>If omitted, defaults to the object which fired the event.</b>
     	* @param {Object}   options (optional) An object containing handler configuration.
     	* properties. This may contain any of the following properties:<ul>
     	* <li><b>scope</b> : Object<div class="sub-desc">The scope (<code><b>this</b></code> reference) in which the handler function is executed.
     	* <b>If omitted, defaults to the object which fired the event.</b></div></li>
     	* <li><b>delay</b> : Number<div class="sub-desc">The number of milliseconds to delay the invocation of the handler after the event fires.</div></li>
     	* <li><b>single</b> : Boolean<div class="sub-desc">True to add a handler to handle just the next firing of the event, and then remove itself.</div></li>
     	* <li><b>buffer</b> : Number<div class="sub-desc">Causes the handler to be scheduled to run in an {@link Ext.util.DelayedTask} delayed
     	* by the specified number of milliseconds. If the event fires again within that time, the original
    	 * handler is <em>not</em> invoked, but the new handler is scheduled in its place.</div></li>
     	* <li><b>target</b> : Observable<div class="sub-desc">Only call the handler if the event was fired on the target Observable, <i>not</i>
     	* if the event was bubbled up from a child Observable.</div></li>
     	* </ul><br>
     	* <p>
     	* <b>Combining Options</b><br>
     	* Using the options argument, it is possible to combine different types of listeners:<br>
     	* <br>
     	* A delayed, one-time listener.
     	* <pre><code>
		myDataView.on('click', this.onClick, this, {
		single: true,
		delay: 100
		});</code></pre>
     	* <p>
     	* <b>Attaching multiple handlers in 1 call</b><br>
     	* The method also allows for a single argument to be passed which is a config object containing properties
     	* which specify multiple handlers.
     	* <p>
     	* <pre><code>
			myGridPanel.on({
				'click' : {
    			fn: this.onClick,
    			scope: this,
    			delay: 100
			},
			'mouseover' : {
    			fn: this.onMouseOver,
    			scope: this
			},
			'mouseout' : {
    			fn: this.onMouseOut,
    			scope: this
			}
			});</code></pre>
 			* <p>
 			* Or a shorthand syntax:<br>
 			* <pre><code>
			myGridPanel.on({
			'click' : this.onClick,
			'mouseover' : this.onMouseOver,
			'mouseout' : this.onMouseOut,
			 scope: this
			});</code></pre>
     	*/
		addListener : function(eventName, fn, scope, o){
        	var me = this,e,oe,ce;
            
        	if (typeof eventName == 'object') {
            	o = eventName;
            	for (e in o) {
                	oe = o[e];
                	if (!me.filterOptRe.test(e)) {
                    	me.addListener(e, oe.fn || oe, oe.scope || o.scope, oe.fn ? oe : o);
                	}
            	}
        	} else {
            	eventName = eventName.toLowerCase();
            	ce = me.events[eventName] || true;
            	if (typeof ce == 'boolean') {
                	me.events[eventName] = ce = new zgw.event(me, eventName);
            	}
            	ce.addListener(fn, scope, typeof o == 'object' ? o : {});
        	}
    	},
		
		/**
     		* Removes an event handler.
     		* @param {String}   eventName The type of event the handler was associated with.
     		* @param {Function} handler   The handler to remove. <b>This must be a reference to the function passed into the {@link #addListener} call.</b>
     		* @param {Object}   scope     (optional) The scope originally specified for the handler.
     	*/
		removeListener : function(eventName, fn, scope){
        	var ce = this.events[eventName.toLowerCase()];
        	if (typeof ce == 'object') {
            	ce.removeListener(fn, scope);
        	}
    	},
		
		/**
     		* Removes all listeners for this object
     	*/
		purgeListeners : function(){
        	var events = this.events,
            	evt,
            	key;
        	for(key in events){
            	evt = events[key];
            	if(typeof evt == 'object'){
                	evt.clearListeners();
            	}
        	}
    	},
		
    	/**
     	* Adds the specified events to the list of events which this Observable may fire.
     	* @param {Object|String} o Either an object with event names as properties with a value of <code>true</code>
     	* or the first event name string if multiple event names are being passed as separate parameters.
     	* @param {string} Optional. Event name if multiple event names are being passed as separate parameters.
     	* Usage:<pre><code>
				this.addEvents('storeloaded', 'storecleared');
		</code></pre>
     	*/
		addEvents : function(o){
        	var me = this;
        	me.events = me.events || {};
        	if (typeof o == 'string') {
            	var a = arguments,
                i = a.length;
            	while(i--) {
                	me.events[a[i]] = me.events[a[i]] || true;
            	}
        	} else {
            	zgw.applyIf(me.events, o);
        	}
    	},
		
		/**
     		* Checks to see if this object has any listeners for a specified event
     		* @param {String} eventName The name of the event to check for
     		* @return {Boolean} True if the event is being listened for, else false
     	*/
    	hasListener : function(eventName){
        	var e = this.events[eventName.toLowerCase()];
        	return typeof e == 'object' && e.listeners.length > 0;
    	},
		
		/**
     		* Suspend the firing of all events. (see {@link #resumeEvents})
     		* @param {Boolean} queueSuspended Pass as true to queue up suspended events to be fired
     		* after the {@link #resumeEvents} call instead of discarding all suspended events;
     	*/
		suspendEvents : function(queueSuspended){
        	this.eventsSuspended = true;

        	if(queueSuspended && !this.eventQueue){
				//this queue will store all events need to be fired ,refer to "fireEvent"
            	this.eventQueue = [];
        	}
    	},
		
		/**
     		* Resume firing events. (see {@link #suspendEvents})
     		* If events were suspended using the <tt><b>queueSuspended</b></tt> parameter, then all
     		* events fired during event suspension will be sent to any listeners now.
     	*/
		resumeEvents : function(){
        	var me = this,
            	queued = me.eventQueue || [];
        	me.eventsSuspended = false;
        	delete me.eventQueue;
			
        	zgw.each(queued, function(e) {
            	me.fireEvent.apply(me, e);
        	});
    	}
	});
	
	zgw.alias(zgw.baseObject,'addListener','on');
	zgw.alias(zgw.baseObject,'removeListener','un');
	
	zgw._singleObjects = {};
	
	//short-cut for create a object based on zgw.baseObject
	zgw.createObject = function(para){
		if(arguments.length == 0 || !zgw.isObject(para)){
			return new zgw.baseObject();
		}
		para.init = para.init && zgw.isFunction(para.init)? para.init : function(){};
		if(para.single){
			var init = para.init;
			para.init = function(){
				var objName = para.single;
				if(zgw.isDefined(zgw._singleObjects[objName])){
					//console.log(zgw._singleObjects[objName]);
					return zgw._singleObjects[objName];
				}
				else{
					init.apply(this,arguments);
					zgw._singleObjects[objName] = this;
				}
			}
		}
		para.member = para.member||{};
		para.extend = para.extend || zgw.baseObject;
		return zgw.extend(para.init,para.extend,para.member);
	}






}(zgw));

(function(z){
	/*
	if(!window.z){
		window.z = zgw;
	}*/
	
	/*
	 * <pre><code>
	 * z.create('store.reststore',
	 * 	function(uri){this.uri=uri},
	 * 	{
	 * 		
	 * 	}
	 * )
	 * </pre></code>
	 */
	z.create = function(name,constructor,members){
		var fullname = "zgw." + name;
		z.declare(fullname);
		eval(fullname+"=z.createObject({init:constructor,member:members});")
	}
	
	/*
	 * <pre><code>
	 * z.extend(z.store).as('z.fastsrore',function(){},{})
	 * </pre></code>
	 */
	z.ext = function(superName){
		return {
			as:function(name,constructor,members){
				var superFullname = "zgw." + superName;
				var fullname = "zgw." + name;
				z.declare(fullname);
				eval(fullname+"=z.createObject({init:constructor,member:members, extend:" + superFullname + "})");
			}
		}
	}

	
	
}(zgw));