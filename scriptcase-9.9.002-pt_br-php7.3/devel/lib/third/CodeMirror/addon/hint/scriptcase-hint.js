// CodeMirror, copyright (c) by Marijn Haverbeke and others
// Distributed under an MIT license: http://codemirror.net/LICENSE

(function(mod) {
  if (typeof exports == "object" && typeof module == "object") // CommonJS
    mod(require("../../lib/codemirror"));
  else if (typeof define == "function" && define.amd) // AMD
    define(["../../lib/codemirror"], mod);
  else // Plain browser env
    mod(CodeMirror);
})(function(CodeMirror) {
  "use strict";

  var data = "sc_redir sc_lookup".split(" ");
/*   
  function populate(obj) {
    for (var attr in globalAttrs) if (globalAttrs.hasOwnProperty(attr))
      obj.attrs[attr] = globalAttrs[attr];
  }

  for (var tag in data)
	populate(data[tag]);

  CodeMirror.htmlSchema = data;
*/
	  CodeMirror.registerHelper("hintWords", "scriptcase", data);

  function scriptcaseHint(cm, options) {
alert(cm);
    return 'hahaha';
  }
  CodeMirror.registerHelper("hint", "scriptcase", scriptcaseHint);
});
