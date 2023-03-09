
/** Add or remove CSS class
* @param HTMLElement
* @param string
* @param [bool]
*/
function alterClass(el, className, enable) {
	if (el) {
		el.className = el.className.replace(RegExp('(^|\\s)' + className + '(\\s|$)'), '$2') + (enable ? ' ' + className : '');
	}
}

/** Toggle visibility
* @param string
* @return boolean
*/
function toggle(id) {
	var el = document.getElementById(id);
	el.className = (el.className == 'hidden' ? '' : 'hidden');
	return true;
}

/** Set permanent cookie
* @param string
* @param number
* @param string optional
*/
function cookie(assign, days) {
	var date = new Date();
	date.setDate(date.getDate() + days);
	document.cookie = assign + '; expires=' + date;
}

/** Verify current Adminer version
* @param string
*/
function verifyVersion(current) {
	cookie('adminer_version=0', 1);
	var iframe = document.createElement('iframe');
	iframe.src = location.protocol + '//www.adminer.org/version/?current=' + current;
	iframe.frameBorder = 0;
	iframe.marginHeight = 0;
	iframe.scrolling = 'no';
	iframe.style.width = '7ex';
	iframe.style.height = '1.25em';
	if (window.postMessage && window.addEventListener) {
		iframe.style.display = 'none';
		addEventListener('message', function (event) {
			if (event.origin == location.protocol + '//www.adminer.org') {
				var match = /version=(.+)/.exec(event.data);
				if (match) {
					cookie('adminer_version=' + match[1], 1);
				}
			}
		}, false);
	}
	document.getElementById('version').appendChild(iframe);
}

/** Get value of select
* @param HTMLElement <select> or <input>
* @return string
*/
function selectValue(select) {
	if (!select.selectedIndex) {
		return select.value;
	}
	var selected = select.options[select.selectedIndex];
	return ((selected.attributes.value || {}).specified ? selected.value : selected.text);
}

/** Verify if element has a specified tag name
 * @param HTMLElement
 * @param string regular expression
 * @return bool
 */
function isTag(el, tag) {
	var re = new RegExp('^(' + tag + ')$', 'i');
	return re.test(el.tagName);
}

/** Get parent node with specified tag name
 * @param HTMLElement
 * @param string regular expression
 * @return HTMLElement
 */
function parentTag(el, tag) {
	while (el && !isTag(el, tag)) {
		el = el.parentNode;
	}
	return el;
}

/** Set checked class
* @param HTMLInputElement
*/
function trCheck(el) {
	var tr = parentTag(el, 'tr');
	alterClass(tr, 'checked', el.checked);
	if (el.form && el.form['all'] && el.form['all'].onclick) { // Opera treats form.all as document.all
		el.form['all'].onclick();
	}
}

/** Fill number of selected items
* @param string
* @param string
*/
function selectCount(id, count) {
	setHtml(id, (count === '' ? '' : '(' + (count + '').replace(/\B(?=(\d{3})+$)/g, ' ') + ')'));
	var inputs = document.getElementById(id).parentNode.parentNode.getElementsByTagName('input');
	for (var i = 0; i < inputs.length; i++) {
		var input = inputs[i];
		if (input.type == 'submit') {
			input.disabled = (count == '0');
		}
	}
}

/** Check all elements matching given name
* @param HTMLInputElement
* @param RegExp
*/
function formCheck(el, name) {
	var elems = el.form.elements;
	for (var i=0; i < elems.length; i++) {
		if (name.test(elems[i].name)) {
			elems[i].checked = el.checked;
			trCheck(elems[i]);
		}
	}
}

/** Check all rows in <table class="checkable">
*/
function tableCheck() {
	var tables = document.getElementsByTagName('table');
	for (var i=0; i < tables.length; i++) {
		if (/(^|\s)checkable(\s|$)/.test(tables[i].className)) {
			var trs = tables[i].getElementsByTagName('tr');
			for (var j=0; j < trs.length; j++) {
				trCheck(trs[j].firstChild.firstChild);
			}
		}
	}
}

/** Uncheck single element
* @param string
*/
function formUncheck(id) {
	var el = document.getElementById(id);
	el.checked = false;
	trCheck(el);
}

/** Get number of checked elements matching given name
* @param HTMLInputElement
* @param RegExp
* @return number
*/
function formChecked(el, name) {
	var checked = 0;
	var elems = el.form.elements;
	for (var i=0; i < elems.length; i++) {
		if (name.test(elems[i].name) && elems[i].checked) {
			checked++;
		}
	}
	return checked;
}

/** Select clicked row
* @param MouseEvent
* @param [boolean] force click
*/
function tableClick(event, click) {
	click = (click || !window.getSelection || getSelection().isCollapsed);
	var el = getTarget(event);
	while (!isTag(el, 'tr')) {
		if (isTag(el, 'table|a|input|textarea')) {
			if (el.type != 'checkbox') {
				return;
			}
			checkboxClick(event, el);
			click = false;
		}
		el = el.parentNode;
	}
	el = el.firstChild.firstChild;
	if (click) {
		el.checked = !el.checked;
		el.onclick && el.onclick();
	}
	trCheck(el);
}

var lastChecked;

/** Shift-click on checkbox for multiple selection.
 * @param MouseEvent
 * @param HTMLInputElement
 */
function checkboxClick(event, el) {
	if (!el.name) {
		return;
	}
	if (event.shiftKey && (!lastChecked || lastChecked.name == el.name)) {
		var checked = (lastChecked ? lastChecked.checked : true);
		var inputs = parentTag(el, 'table').getElementsByTagName('input');
		var checking = !lastChecked;
		for (var i=0; i < inputs.length; i++) {
			var input = inputs[i];
			if (input.name === el.name) {
				if (checking) {
					input.checked = checked;
					trCheck(input);
				}
				if (input === el || input === lastChecked) {
					if (checking) {
						break;
					}
					checking = true;
				}
			}
		}
	} else {
		lastChecked = el;
	}
}

/** Set HTML code of an element
* @param string
* @param string undefined to set parentNode to &nbsp;
*/
function setHtml(id, html) {
	var el = document.getElementById(id);
	if (el) {
		if (html == undefined) {
			el.parentNode.innerHTML = '&nbsp;';
		} else {
			el.innerHTML = html;
		}
	}
}

/** Find node position
* @param Node
* @return number
*/
function nodePosition(el) {
	var pos = 0;
	while (el = el.previousSibling) {
		pos++;
	}
	return pos;
}

/** Go to the specified page
* @param string
* @param string
* @param [MouseEvent]
*/
function pageClick(href, page, event) {
	if (!isNaN(page) && page) {
		href += (page != 1 ? '&page=' + (page - 1) : '');
		location.href = href;
	}
}



/** Display items in menu
* @param HTMLElement
* @param MouseEvent
*/
function menuOver(el, event) {
	var a = getTarget(event);
	if (isTag(a, 'a|span') && a.offsetLeft + a.offsetWidth > a.parentNode.offsetWidth - 15) { // 15 - ellipsis
		el.style.overflow = 'visible';
	}
}

/** Hide items in menu
* @param HTMLElement
*/
function menuOut(el) {
	el.style.overflow = 'auto';
}



/** Add row in select fieldset
* @param HTMLSelectElement
*/
function selectAddRow(field) {
	field.onchange = function () {
		selectFieldChange(field.form);
	};
	field.onchange();
	var row = cloneNode(field.parentNode);
	var selects = row.getElementsByTagName('select');
	for (var i=0; i < selects.length; i++) {
		selects[i].name = selects[i].name.replace(/[a-z]\[\d+/, '$&1');
		selects[i].selectedIndex = 0;
	}
	var inputs = row.getElementsByTagName('input');
	for (var i=0; i < inputs.length; i++) {
		inputs[i].name = inputs[i].name.replace(/[a-z]\[\d+/, '$&1');
		inputs[i].value = '';
		inputs[i].className = '';
	}
	field.parentNode.parentNode.appendChild(row);
}

/** Prevent onsearch handler on Enter
* @param HTMLInputElement
* @param KeyboardEvent
*/
function selectSearchKeydown(el, event) {
	if (event.keyCode == 13 || event.keyCode == 10) {
		el.onsearch = function () {
		};
	}
}

/** Clear column name after resetting search
* @param HTMLInputElement
*/
function selectSearchSearch(el) {
	if (!el.value) {
		el.parentNode.firstChild.selectedIndex = 0;
	}
}



/** Toggles column context menu
 * @param HTMLElement
 * @param [string] extra class name
 */
function columnMouse(el, className) {
	var spans = el.getElementsByTagName('span');
	for (var i=0; i < spans.length; i++) {
		if (/column/.test(spans[i].className)) {
			spans[i].className = 'column' + (className || '');
		}
	}
}



/** Fill column in search field
 * @param string
 */
function selectSearch(name) {
	var el = document.getElementById('fieldset-search');
	el.className = '';
	var divs = el.getElementsByTagName('div');
	for (var i=0; i < divs.length; i++) {
		var div = divs[i];
		if (isTag(div.firstChild, 'select') && selectValue(div.firstChild) == name) {
			break;
		}
	}
	if (i == divs.length) {
		div.firstChild.value = name;
		div.firstChild.onchange();
	}
	div.lastChild.focus();
}


/** Check if Ctrl key (Command key on Mac) was pressed
* @param KeyboardEvent|MouseEvent
* @return boolean
*/
function isCtrl(event) {
	return (event.ctrlKey || event.metaKey) && !event.altKey; // shiftKey allowed
}

/** Return event target
* @param Event
* @return HTMLElement
*/
function getTarget(event) {
	return event.target || event.srcElement;
}



/** Send form by Ctrl+Enter on <select> and <textarea>
* @param KeyboardEvent
* @param [string]
* @return boolean
*/
function bodyKeydown(event, button) {
	var target = getTarget(event);
	if (target.jushTextarea) {
		target = target.jushTextarea;
	}
	if (isCtrl(event) && (event.keyCode == 13 || event.keyCode == 10) && isTag(target, 'select|textarea|input')) { // 13|10 - Enter
		target.blur();
		if (button) {
			target.form[button].click();
		} else {
			target.form.submit();
		}
		target.focus();
		return false;
	}
	return true;
}

/** Open form to a new window on Ctrl+click or Shift+click
* @param MouseEvent
*/
function bodyClick(event) {
	var target = getTarget(event);
	if ((isCtrl(event) || event.shiftKey) && target.type == 'submit' && isTag(target, 'input')) {
		target.form.target = '_blank';
		setTimeout(function () {
			// if (isCtrl(event)) { focus(); } doesn't work
			target.form.target = '';
		}, 0);
	}
}



/** Change focus by Ctrl+Up or Ctrl+Down
* @param KeyboardEvent
* @return boolean
*/
function editingKeydown(event) {
	if ((event.keyCode == 40 || event.keyCode == 38) && isCtrl(event)) { // 40 - Down, 38 - Up
		var target = getTarget(event);
		var sibling = (event.keyCode == 40 ? 'nextSibling' : 'previousSibling');
		var el = target.parentNode.parentNode[sibling];
		if (el && (isTag(el, 'tr') || (el = el[sibling])) && isTag(el, 'tr') && (el = el.childNodes[nodePosition(target.parentNode)]) && (el = el.childNodes[nodePosition(target)])) {
			el.focus();
		}
		return false;
	}
	if (event.shiftKey && !bodyKeydown(event, 'insert')) {
		eventStop(event);
		return false;
	}
	return true;
}

/** Disable maxlength for functions
* @param HTMLSelectElement
*/
function functionChange(select) {
	var input = select.form[select.name.replace(/^function/, 'fields')];
	if (selectValue(select)) {
		if (input.origType === undefined) {
			input.origType = input.type;
			input.origMaxLength = input.maxLength;
		}
		input.removeAttribute('maxlength');
		input.type = 'text';
	} else if (input.origType) {
		input.type = input.origType;
		if (input.origMaxLength >= 0) {
			input.maxLength = input.origMaxLength;
		}
	}
	helpClose();
}

/** Call this.onchange() if value changes
* @this HTMLInputElement
*/
function keyupChange() {
	if (this.value != this.getAttribute('value')) {
		this.onchange();
		this.setAttribute('value', this.value);
	}
}

/** Add new field in schema-less edit
* @param HTMLInputElement
*/
function fieldChange(field) {
	var row = cloneNode(parentTag(field, 'tr'));
	var inputs = row.getElementsByTagName('input');
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].value = '';
	}
	// keep value in <select> (function)
	parentTag(field, 'table').appendChild(row);
	field.onchange = function () { };
}



/** Create AJAX request
* @param string
* @param function (XMLHttpRequest)
* @param [string]
* @return XMLHttpRequest or false in case of an error
*/
function ajax(url, callback, data) {
	var request = (window.XMLHttpRequest ? new XMLHttpRequest() : (window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : false));
	if (request) {
		request.open((data ? 'POST' : 'GET'), url);
		if (data) {
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		}
		request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		request.onreadystatechange = function () {
			if (request.readyState == 4) {
				callback(request);
			}
		};
		request.send(data);
	}
	return request;
}

/** Use setHtml(key, value) for JSON response
* @param string
* @return XMLHttpRequest or false in case of an error
*/
function ajaxSetHtml(url) {
	return ajax(url, function (request) {
		if (request.status) {
			var data = eval('(' + request.responseText + ')');
			for (var key in data) {
				setHtml(key, data[key]);
			}
		}
	});
}

/** Save form contents through AJAX
* @param HTMLFormElement
* @param string
* @param [HTMLInputElement]
* @return boolean
*/
function ajaxForm(form, message, button) {
	var data = [];
	var els = form.elements;
	for (var i = 0; i < els.length; i++) {
		var el = els[i];
		if (el.name && !el.disabled) {
			if (/^file$/i.test(el.type) && el.value) {
				return false;
			}
			if (!/^(checkbox|radio|submit|file)$/i.test(el.type) || el.checked || el == button) {
				data.push(encodeURIComponent(el.name) + '=' + encodeURIComponent(isTag(el, 'select') ? selectValue(el) : el.value));
			}
		}
	}
	data = data.join('&');
	
	setHtml('message', '<div class="message">' + message + '</div>');
	var url = form.action;
	if (!/post/i.test(form.method)) {
		url = url.replace(/\?.*/, '') + '?' + data;
		data = '';
	}
	return ajax(url, function (request) {
		setHtml('message', request.responseText);
		if (window.jush) {
			jush.highlight_tag(document.getElementById('message').getElementsByTagName('code'), 0);
		}
	}, data);
}



/** Display edit field
* @param HTMLElement
* @param MouseEvent
* @param number display textarea instead of input, 2 - load long text
* @param string warning to display
*/
function selectClick(td, event, text, warning) {
	var target = getTarget(event);
	if (!isCtrl(event) || isTag(td.firstChild, 'input|textarea') || isTag(target, 'a')) {
		return;
	}
	if (warning) {
		return alert(warning);
	}
	var original = td.innerHTML;
	text = text || /\n/.test(original);
	var input = document.createElement(text ? 'textarea' : 'input');
	input.onkeydown = function (event) {
		if (!event) {
			event = window.event;
		}
		if (event.keyCode == 27 && !event.shiftKey && !event.altKey && !isCtrl(event)) { // 27 - Esc
			inputBlur.apply(input);
			td.innerHTML = original;
		}
	};
	var pos = event.rangeOffset;
	var value = td.firstChild.alt || td.textContent || td.innerText;
	input.style.width = Math.max(td.clientWidth - 14, 20) + 'px'; // 14 = 2 * (td.border + td.padding + input.border)
	if (text) {
		var rows = 1;
		value.replace(/\n/g, function () {
			rows++;
		});
		input.rows = rows;
	}
	if (value == '\u00A0' || td.getElementsByTagName('i').length) { // &nbsp; or i - NULL
		value = '';
	}
	if (document.selection) {
		var range = document.selection.createRange();
		range.moveToPoint(event.clientX, event.clientY);
		var range2 = range.duplicate();
		range2.moveToElementText(td);
		range2.setEndPoint('EndToEnd', range);
		pos = range2.text.length;
	}
	td.innerHTML = '';
	td.appendChild(input);
	setupSubmitHighlight(td);
	input.focus();
	if (text == 2) { // long text
		return ajax(location.href + '&' + encodeURIComponent(td.id) + '=', function (request) {
			if (request.status && request.responseText) {
				input.value = request.responseText;
				input.name = td.id;
			}
		});
	}
	input.value = value;
	input.name = td.id;
	input.selectionStart = pos;
	input.selectionEnd = pos;
	if (document.selection) {
		var range = document.selection.createRange();
		range.moveEnd('character', -input.value.length + pos);
		range.select();
	}
}



/** Load and display next page in select
* @param HTMLLinkElement
* @param number
* @param string
* @return boolean
*/
function selectLoadMore(a, limit, loading) {
	var title = a.innerHTML;
	var href = a.href;
	a.innerHTML = loading;
	if (href) {
		a.removeAttribute('href');
		return ajax(href, function (request) {
			var tbody = document.createElement('tbody');
			tbody.innerHTML = request.responseText;
			document.getElementById('table').appendChild(tbody);
			if (tbody.children.length < limit) {
				a.parentNode.removeChild(a);
			} else {
				a.href = href.replace(/\d+$/, function (page) {
					return +page + 1;
				});
				a.innerHTML = title;
			}
		});
	}
}



/** Stop event propagation
* @param Event
*/
function eventStop(event) {
	if (event.stopPropagation) {
		event.stopPropagation();
	} else {
		event.cancelBubble = true;
	}
}



/** Setup highlighting of default submit button on form field focus
* @param HTMLElement
*/
function setupSubmitHighlight(parent) {
	for (var key in { input: 1, select: 1, textarea: 1 }) {
		var inputs = parent.getElementsByTagName(key);
		for (var i = 0; i < inputs.length; i++) {
			setupSubmitHighlightInput(inputs[i])
		}
	}
}

/** Setup submit highlighting for single element
* @param HTMLElement
*/
function setupSubmitHighlightInput(input) {
	if (!/submit|image|file/.test(input.type)) {
		addEvent(input, 'focus', inputFocus);
		addEvent(input, 'blur', inputBlur);
	}
}

/** Highlight default submit button
* @this HTMLInputElement
*/
function inputFocus() {
	var submit = findDefaultSubmit(this);
	if (submit) {
		alterClass(submit, 'default', true);
	}
}

/** Unhighlight default submit button
* @this HTMLInputElement
*/
function inputBlur() {
	var submit = findDefaultSubmit(this);
	if (submit) {
		alterClass(submit, 'default');
	}
}

/** Find submit button used by Enter
* @param HTMLElement
* @return HTMLInputElement
*/
function findDefaultSubmit(el) {
	if (el.jushTextarea) {
		el = el.jushTextarea;
	}
	var inputs = el.form.getElementsByTagName('input');
	for (var i = 0; i < inputs.length; i++) {
		var input = inputs[i];
		if (input.type == 'submit' && !input.style.zIndex) {
			return input;
		}
	}
}



/** Add event listener
* @param HTMLElement
* @param string without 'on'
* @param function
*/
function addEvent(el, action, handler) {
	if (el.addEventListener) {
		el.addEventListener(action, handler, false);
	} else {
		el.attachEvent('on' + action, handler);
	}
}

/** Defer focusing element
* @param HTMLElement
*/
function focus(el) {
	setTimeout(function () { // this has to be an anonymous function because Firefox passes some arguments to setTimeout callback
		el.focus();
	}, 0);
}

/** Clone node and setup submit highlighting
* @param HTMLElement
* @return HTMLElement
*/
function cloneNode(el) {
	var el2 = el.cloneNode(true);
	setupSubmitHighlight(el2);
	return el2;
}
/*############################################################################*/
/*############################  Editing.js  ##################################*/
/*############################################################################*/
/*############################################################################*/

// Adminer specific functions

/** Load syntax highlighting
 * @param string first three characters of database system version
 */
function bodyLoad(version) {
    if (window.jush) {
        jush.create_links = ' target="_blank" rel="noreferrer"';
        if (version) {
            for (var key in jush.urls) {
                var obj = jush.urls;
                if (typeof obj[key] != 'string') {
                    obj = obj[key];
                    key = 0;
                }
                obj[key] = obj[key]
                    .replace(/\/doc\/mysql/, '/doc/refman/' + version) // MySQL
                    .replace(/\/docs\/current/, '/docs/' + version) // PostgreSQL
                ;
            }
        }
        if (window.jushLinks) {
            jush.custom_links = jushLinks;
        }
        jush.highlight_tag('code', 0);
        var tags = document.getElementsByTagName('textarea');
        for (var i = 0; i < tags.length; i++) {
            if (/(^|\s)jush-/.test(tags[i].className)) {
                var pre = jush.textarea(tags[i]);
                if (pre) {
                    setupSubmitHighlightInput(pre);
                }
            }
        }
    }
}

/** Get value of dynamically created form field
 * @param HTMLFormElement
 * @param string
 * @return HTMLElement
 */
function formField(form, name) {
    // required in IE < 8, form.elements[name] doesn't work
    for (var i=0; i < form.length; i++) {
        if (form[i].name == name) {
            return form[i];
        }
    }
}

/** Try to change input type to password or to text
 * @param HTMLInputElement
 * @param boolean
 */
function typePassword(el, disable) {
    try {
        el.type = (disable ? 'text' : 'password');
    } catch (e) {
    }
}

/** Hide or show some login rows for selected driver
 * @param HTMLSelectElement
 */
function loginDriver(driver) {
    var trs = parentTag(driver, 'table').rows;
    for (var i=1; i < trs.length - 1; i++) {
        var disabled = /sqlite/.test(driver.value);
        alterClass(trs[i], 'hidden', disabled);
        trs[i].getElementsByTagName('input')[0].disabled = disabled;
    }
}



var dbCtrl;
var dbPrevious = {};

/** Check if database should be opened to a new window
 * @param MouseEvent
 * @param HTMLSelectElement
 */
function dbMouseDown(event, el) {
    dbCtrl = isCtrl(event);
    if (dbPrevious[el.name] == undefined) {
        dbPrevious[el.name] = el.value;
    }
}

/** Load database after selecting it
 * @param HTMLSelectElement
 */
function dbChange(el) {
    if (dbCtrl) {
        el.form.target = '_blank';
    }
    el.form.submit();
    el.form.target = '';
    if (dbCtrl && dbPrevious[el.name] != undefined) {
        el.value = dbPrevious[el.name];
        dbPrevious[el.name] = undefined;
    }
}



/** Check whether the query will be executed with index
 * @param HTMLFormElement
 */
function selectFieldChange(form) {
    var ok = (function () {
        var inputs = form.getElementsByTagName('input');
        for (var i=0; i < inputs.length; i++) {
            if (inputs[i].value && /^fulltext/.test(inputs[i].name)) {
                return true;
            }
        }
        var ok = form.limit.value;
        var selects = form.getElementsByTagName('select');
        var group = false;
        var columns = {};
        for (var i=0; i < selects.length; i++) {
            var select = selects[i];
            var col = selectValue(select);
            var match = /^(where.+)col\]/.exec(select.name);
            if (match) {
                var op = selectValue(form[match[1] + 'op]']);
                var val = form[match[1] + 'val]'].value;
                if (col in indexColumns && (!/LIKE|REGEXP/.test(op) || (op == 'LIKE' && val.charAt(0) != '%'))) {
                    return true;
                } else if (col || val) {
                    ok = false;
                }
            }
            if ((match = /^(columns.+)fun\]/.exec(select.name))) {
                if (/^(avg|count|count distinct|group_concat|max|min|sum)$/.test(col)) {
                    group = true;
                }
                var val = selectValue(form[match[1] + 'col]']);
                if (val) {
                    columns[col && col != 'count' ? '' : val] = 1;
                }
            }
            if (col && /^order/.test(select.name)) {
                if (!(col in indexColumns)) {
                    ok = false;
                }
                break;
            }
        }
        if (group) {
            for (var col in columns) {
                if (!(col in indexColumns)) {
                    ok = false;
                }
            }
        }
        return ok;
    })();
    setHtml('noindex', (ok ? '' : '!'));
}



var added = '.', rowCount;

/** Check if val is equal to a-delimiter-b where delimiter is '_', '' or big letter
 * @param string
 * @param string
 * @param string
 * @return boolean
 */
function delimiterEqual(val, a, b) {
    return (val == a + '_' + b || val == a + b || val == a + b.charAt(0).toUpperCase() + b.substr(1));
}

/** Escape string to use as identifier
 * @param string
 * @return string
 */
function idfEscape(s) {
    return s.replace(/`/, '``');
}

/** Detect foreign key
 * @param HTMLInputElement
 */
function editingNameChange(field) {
    var name = field.name.substr(0, field.name.length - 7);
    var type = formField(field.form, name + '[type]');
    var opts = type.options;
    var candidate; // don't select anything with ambiguous match (like column `id`)
    var val = field.value;
    for (var i = opts.length; i--; ) {
        var match = /(.+)`(.+)/.exec(opts[i].value);
        if (!match) { // common type
            if (candidate && i == opts.length - 2 && val == opts[candidate].value.replace(/.+`/, '') && name == 'fields[1]') { // single target table, link to column, first field - probably `id`
                return;
            }
            break;
        }
        var table = match[1];
        var column = match[2];
        var tables = [ table, table.replace(/s$/, ''), table.replace(/es$/, '') ];
        for (var j=0; j < tables.length; j++) {
            table = tables[j];
            if (val == column || val == table || delimiterEqual(val, table, column) || delimiterEqual(val, column, table)) {
                if (candidate) {
                    return;
                }
                candidate = i;
                break;
            }
        }
    }
    if (candidate) {
        type.selectedIndex = candidate;
        type.onchange();
    }
}

/** Add table row for next field
 * @param HTMLInputElement
 * @param boolean
 * @return boolean
 */
function editingAddRow(button, focus) {
    var match = /(\d+)(\.\d+)?/.exec(button.name);
    var x = match[0] + (match[2] ? added.substr(match[2].length) : added) + '1';
    var row = parentTag(button, 'tr');
    var row2 = cloneNode(row);
    var tags = row.getElementsByTagName('select');
    var tags2 = row2.getElementsByTagName('select');
    for (var i=0; i < tags.length; i++) {
        tags2[i].name = tags[i].name.replace(/[0-9.]+/, x);
        tags2[i].selectedIndex = tags[i].selectedIndex;
    }
    tags = row.getElementsByTagName('input');
    tags2 = row2.getElementsByTagName('input');
    var input = tags2[0]; // IE loose tags2 after insertBefore()
    for (var i=0; i < tags.length; i++) {
        if (tags[i].name == 'auto_increment_col') {
            tags2[i].value = x;
            tags2[i].checked = false;
        }
        tags2[i].name = tags[i].name.replace(/([0-9.]+)/, x);
        if (/\[(orig|field|comment|default)/.test(tags[i].name)) {
            tags2[i].value = '';
        }
        if (/\[(has_default)/.test(tags[i].name)) {
            tags2[i].checked = false;
        }
    }
    tags[0].onchange = function () {
        editingNameChange(tags[0]);
    };
    tags[0].onkeyup = function () {
    };
    row.parentNode.insertBefore(row2, row.nextSibling);
    if (focus) {
        input.onchange = function () {
            editingNameChange(input);
        };
        input.onkeyup = function () {
        };
        input.focus();
    }
    added += '0';
    rowCount++;
    return true;
}

/** Remove table row for field
 * @param HTMLInputElement
 * @param string
 * @return boolean
 */
function editingRemoveRow(button, name) {
    var field = formField(button.form, button.name.replace(/[^\[]+(.+)/, name));
    field.parentNode.removeChild(field);
    parentTag(button, 'tr').style.display = 'none';
    return true;
}

var lastType = '';

/** Clear length and hide collation or unsigned
 * @param HTMLSelectElement
 */
function editingTypeChange(type) {
    var name = type.name.substr(0, type.name.length - 6);
    var text = selectValue(type);
    for (var i=0; i < type.form.elements.length; i++) {
        var el = type.form.elements[i];
        if (el.name == name + '[length]') {
            if (!(
                (/(char|binary)$/.test(lastType) && /(char|binary)$/.test(text))
                || (/(enum|set)$/.test(lastType) && /(enum|set)$/.test(text))
                )) {
                el.value = '';
            }
            el.onchange.apply(el);
        }
        if (lastType == 'timestamp' && el.name == name + '[has_default]' && /timestamp/i.test(formField(type.form, name + '[default]').value)) {
            el.checked = false;
        }
        if (el.name == name + '[collation]') {
            alterClass(el, 'hidden', !/(char|text|enum|set)$/.test(text));
        }
        if (el.name == name + '[unsigned]') {
            alterClass(el, 'hidden', !/((^|[^o])int|float|double|decimal)$/.test(text));
        }
        if (el.name == name + '[on_update]') {
            alterClass(el, 'hidden', !/timestamp|datetime/.test(text)); // MySQL supports datetime since 5.6.5
        }
        if (el.name == name + '[on_delete]') {
            alterClass(el, 'hidden', !/`/.test(text));
        }
    }
    helpClose();
}

/** Mark length as required
 * @param HTMLInputElement
 */
function editingLengthChange(el) {
    alterClass(el, 'required', !el.value.length && /var(char|binary)$/.test(selectValue(el.parentNode.previousSibling.firstChild)));
}

/** Edit enum or set
 * @param HTMLInputElement
 */
function editingLengthFocus(field) {
    var td = field.parentNode;
    if (/(enum|set)$/.test(selectValue(td.previousSibling.firstChild))) {
        var edit = document.getElementById('enum-edit');
        var val = field.value;
        edit.value = (/^'.+'$/.test(val) ? val.substr(1, val.length - 2).replace(/','/g, "\n").replace(/''/g, "'") : val); //! doesn't handle 'a'',''b' correctly
        td.appendChild(edit);
        field.style.display = 'none';
        edit.style.display = 'inline';
        edit.focus();
    }
}

/** Finish editing of enum or set
 * @param HTMLTextAreaElement
 */
function editingLengthBlur(edit) {
    var field = edit.parentNode.firstChild;
    var val = edit.value;
    field.value = (/^'[^\n]+'$/.test(val) ? val : "'" + val.replace(/\n+$/, '').replace(/'/g, "''").replace(/\n/g, "','") + "'");
    field.style.display = 'inline';
    edit.style.display = 'none';
}

/** Show or hide selected table column
 * @param boolean
 * @param number
 */
function columnShow(checked, column) {
    var trs = document.getElementById('edit-fields').getElementsByTagName('tr');
    for (var i=0; i < trs.length; i++) {
        alterClass(trs[i].getElementsByTagName('td')[column], 'hidden', !checked);
    }
}

/** Hide column with default values in narrow window
 */
function editingHideDefaults() {
    if (innerWidth < document.documentElement.scrollWidth) {
        document.getElementById('form')['defaults'].checked = false;
        columnShow(false, 5);
    }
}

/** Display partition options
 * @param HTMLSelectElement
 */
function partitionByChange(el) {
    var partitionTable = /RANGE|LIST/.test(selectValue(el));
    alterClass(el.form['partitions'], 'hidden', partitionTable || !el.selectedIndex);
    alterClass(document.getElementById('partition-table'), 'hidden', !partitionTable);
    helpClose();
}

/** Add next partition row
 * @param HTMLInputElement
 */
function partitionNameChange(el) {
    var row = cloneNode(parentTag(el, 'tr'));
    row.firstChild.firstChild.value = '';
    parentTag(el, 'table').appendChild(row);
    el.onchange = function () {};
}



/** Add row for foreign key
 * @param HTMLSelectElement
 */
function foreignAddRow(field) {
    field.onchange = function () { };
    var row = cloneNode(parentTag(field, 'tr'));
    var selects = row.getElementsByTagName('select');
    for (var i=0; i < selects.length; i++) {
        selects[i].name = selects[i].name.replace(/\]/, '1$&');
        selects[i].selectedIndex = 0;
    }
    parentTag(field, 'table').appendChild(row);
}



/** Add row for indexes
 * @param HTMLSelectElement
 */
function indexesAddRow(field) {
    field.onchange = function () { };
    var row = cloneNode(parentTag(field, 'tr'));
    var selects = row.getElementsByTagName('select');
    for (var i=0; i < selects.length; i++) {
        selects[i].name = selects[i].name.replace(/indexes\[\d+/, '$&1');
        selects[i].selectedIndex = 0;
    }
    var inputs = row.getElementsByTagName('input');
    for (var i=0; i < inputs.length; i++) {
        inputs[i].name = inputs[i].name.replace(/indexes\[\d+/, '$&1');
        inputs[i].value = '';
    }
    parentTag(field, 'table').appendChild(row);
}

/** Change column in index
 * @param HTMLSelectElement
 * @param string name prefix
 */
function indexesChangeColumn(field, prefix) {
    var names = [];
    for (var tag in { 'select': 1, 'input': 1 }) {
        var columns = parentTag(field, 'td').getElementsByTagName(tag);
        for (var i=0; i < columns.length; i++) {
            if (/\[columns\]/.test(columns[i].name)) {
                var value = selectValue(columns[i]);
                if (value) {
                    names.push(value);
                }
            }
        }
    }
    field.form[field.name.replace(/\].*/, '][name]')].value = prefix + names.join('_');
}

/** Add column for index
 * @param HTMLSelectElement
 * @param string name prefix
 */
function indexesAddColumn(field, prefix) {
    field.onchange = function () {
        indexesChangeColumn(field, prefix);
    };
    var select = field.form[field.name.replace(/\].*/, '][type]')];
    if (!select.selectedIndex) {
        while (selectValue(select) != "INDEX" && select.selectedIndex < select.options.length) {
            select.selectedIndex++;
        }
        select.onchange();
    }
    var column = cloneNode(field.parentNode);
    var selects = column.getElementsByTagName('select');
    for (var i = 0; i < selects.length; i++) {
        select = selects[i];
        select.name = select.name.replace(/\]\[\d+/, '$&1');
        select.selectedIndex = 0;
    }
    var inputs = column.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        input.name = input.name.replace(/\]\[\d+/, '$&1');
        if (input.type != 'checkbox') {
            input.value = '';
        }
    }
    parentTag(field, 'td').appendChild(column);
    field.onchange();
}



/** Handle changing trigger time or event
 * @param RegExp
 * @param string
 * @param HTMLFormElement
 */
function triggerChange(tableRe, table, form) {
    var formEvent = selectValue(form['Event']);
    if (tableRe.test(form['Trigger'].value)) {
        form['Trigger'].value = table + '_' + (selectValue(form['Timing']).charAt(0) + formEvent.charAt(0)).toLowerCase();
    }
    alterClass(form['Of'], 'hidden', formEvent != 'UPDATE OF');
}



var that, x, y; // em and tablePos defined in schema.inc.php

/** Get mouse position
 * @param HTMLElement
 * @param MouseEvent
 */
function schemaMousedown(el, event) {
    if ((event.which ? event.which : event.button) == 1) {
        that = el;
        x = event.clientX - el.offsetLeft;
        y = event.clientY - el.offsetTop;
    }
}

/** Move object
 * @param MouseEvent
 */
function schemaMousemove(ev) {
    if (that !== undefined) {
        ev = ev || event;
        var left = (ev.clientX - x) / em;
        var top = (ev.clientY - y) / em;
        var divs = that.getElementsByTagName('div');
        var lineSet = { };
        for (var i=0; i < divs.length; i++) {
            if (divs[i].className == 'references') {
                var div2 = document.getElementById((/^refs/.test(divs[i].id) ? 'refd' : 'refs') + divs[i].id.substr(4));
                var ref = (tablePos[divs[i].title] ? tablePos[divs[i].title] : [ div2.parentNode.offsetTop / em, 0 ]);
                var left1 = -1;
                var id = divs[i].id.replace(/^ref.(.+)-.+/, '$1');
                if (divs[i].parentNode != div2.parentNode) {
                    left1 = Math.min(0, ref[1] - left) - 1;
                    divs[i].style.left = left1 + 'em';
                    divs[i].getElementsByTagName('div')[0].style.width = -left1 + 'em';
                    var left2 = Math.min(0, left - ref[1]) - 1;
                    div2.style.left = left2 + 'em';
                    div2.getElementsByTagName('div')[0].style.width = -left2 + 'em';
                }
                if (!lineSet[id]) {
                    var line = document.getElementById(divs[i].id.replace(/^....(.+)-.+$/, 'refl$1'));
                    var top1 = top + divs[i].offsetTop / em;
                    var top2 = top + div2.offsetTop / em;
                    if (divs[i].parentNode != div2.parentNode) {
                        top2 += ref[0] - top;
                        line.getElementsByTagName('div')[0].style.height = Math.abs(top1 - top2) + 'em';
                    }
                    line.style.left = (left + left1) + 'em';
                    line.style.top = Math.min(top1, top2) + 'em';
                    lineSet[id] = true;
                }
            }
        }
        that.style.left = left + 'em';
        that.style.top = top + 'em';
    }
}

/** Finish move
 * @param MouseEvent
 * @param string
 */
function schemaMouseup(ev, db) {
    if (that !== undefined) {
        ev = ev || event;
        tablePos[that.firstChild.firstChild.firstChild.data] = [ (ev.clientY - y) / em, (ev.clientX - x) / em ];
        that = undefined;
        var s = '';
        for (var key in tablePos) {
            s += '_' + key + ':' + Math.round(tablePos[key][0] * 10000) / 10000 + 'x' + Math.round(tablePos[key][1] * 10000) / 10000;
        }
        s = encodeURIComponent(s.substr(1));
        var link = document.getElementById('schema-link');
        link.href = link.href.replace(/[^=]+$/, '') + s;
        cookie('adminer_schema-' + db + '=' + s, 30); //! special chars in db
    }
}



var helpOpen, helpIgnore; // when mouse outs <option> then it mouse overs border of <select> - ignore it

/** Display help
 * @param HTMLElement
 * @param MouseEvent
 * @param string
 * @param bool display on left side (otherwise on top)
 */
function helpMouseover(el, event, text, side) {
    var target = getTarget(event);
    if (!text) {
        helpClose();
    } else if (window.jush && (!helpIgnore || el != target)) {
        helpOpen = 1;
        var help = document.getElementById('help');
        help.innerHTML = text;
        jush.highlight_tag([ help ]);
        alterClass(help, 'hidden');
        var rect = target.getBoundingClientRect();
        var body = document.documentElement;
        help.style.top = (body.scrollTop + rect.top - (side ? (help.offsetHeight - target.offsetHeight) / 2 : help.offsetHeight)) + 'px';
        help.style.left = (body.scrollLeft + rect.left - (side ? help.offsetWidth : (help.offsetWidth - target.offsetWidth) / 2)) + 'px';
    }
}

/** Close help after timeout
 * @param HTMLElement
 * @param MouseEvent
 */
function helpMouseout(el, event) {
    helpOpen = 0;
    helpIgnore = (el != getTarget(event));
    setTimeout(function () {
        if (!helpOpen) {
            helpClose();
        }
    }, 200);
}

/** Close help
 */
function helpClose() {
    alterClass(document.getElementById('help'), 'hidden', true);
}
